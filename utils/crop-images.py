#!/usr/bin/env python3
"""
==============================================================================
IMAGE CENTER-CROPPER, RESCALER & EXIF METADATA EMBEDDER (1600x900 / 16:9)
==============================================================================

This script scans a directory for raw images, center-crops them to a 16:9 aspect 
ratio, resizes them down to 1600x900 using Lanczos resampling (unless NO_CROP=1 
is enabled), intelligently parses structured filenames into EXIF metadata, and 
exports sequentially numbered WebP files (01.webp, 02.webp, etc.).

EXIF TAG MAP (WordPress Auto-Extraction Compatible):
  - Tag 270   (ImageDescription) : Title & Keywords -> Auto-populates WP Caption/Title
  - Tag 315   (Artist)           : Photo Source / Author -> Auto-populates WP Credit
  - Tag 33432 (Copyright)        : License Status -> Auto-populates WP Copyright
  - Tag 37510 (UserComment)      : Full Raw Original Filename -> Complete Audit Trail

Configured entirely via environment variables.

------------------------------------------------------------------------------
USAGE EXAMPLES (RUN FROM REPO ROOT OR SCRIPT FOLDER):
------------------------------------------------------------------------------

1. DEFAULT RUN (Crop & Resize to 1600x900, output to default folder):
   $ python3 utils/crop-images.py
   
2. CUSTOM SOURCE DIRECTORY:
   $ SOURCE_DIR="./zz_unused/zz_raw-images/raw-lumina/final_manual_crops_1600x900" python3 utils/crop-images.py

3. CUSTOM SOURCE & OUTPUT DIRECTORIES:
   $ SOURCE_DIR="./zz_unused/zz_raw-images/raw-blue" \
     OUTPUT_DIR="./assets/images/patterns/lumina" \
     QUALITY=85 \
     python3 utils/crop-images.py

4. NO-CROP PASS-THROUGH (Preserve original dimensions, convert format & embed EXIF):
   $ NO_CROP=1 python3 utils/crop-images.py

5. COMBINED NO-CROP PASS-THROUGH WITH CUSTOM PATHS:
   $ NO_CROP=1 \
     SOURCE_DIR="./assets/images/samples/raw" \
     OUTPUT_DIR="./assets/images/samples" \
     python3 utils/crop-images.py

==============================================================================
"""

import os
import sys
import plistlib
import subprocess
from PIL import Image

# ==============================================================================
# PATH RESOLUTION & CONFIGURATION FROM ENVIRONMENT VARIABLES
# ==============================================================================
# Script lives in /utils/ -> move up 1 level to reach repo root
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
DEFAULT_SOURCE = os.path.abspath(os.path.join(SCRIPT_DIR, "../zz_unused/zz_raw-images"))

QUALITY = int(os.environ.get("QUALITY", "85"))
OUTPUT_FORMAT = os.environ.get("OUTPUT_FORMAT", "webp").lower()
NO_CROP = os.environ.get("NO_CROP", "0").lower() in ("1", "true", "yes")

TARGET_W = 1600
TARGET_H = 900
TARGET_RATIO = TARGET_W / TARGET_H

SOURCE_DIR = os.environ.get("SOURCE_DIR", DEFAULT_SOURCE)
DEFAULT_OUT_NAME = f"converted_{OUTPUT_FORMAT}" if NO_CROP else f"cropped_{TARGET_W}x{TARGET_H}"
OUTPUT_DIR = os.environ.get("OUTPUT_DIR", os.path.join(SOURCE_DIR, DEFAULT_OUT_NAME))

VALID_EXTS = (".jpg", ".jpeg", ".png", ".webp", ".bmp", ".tiff")


def get_mac_where_from_url(filepath):
    """
    Extracts the 'Where from' download URL from macOS Extended Attributes using native xattr CLI.
    """
    try:
        # Capture stdout as raw bytes (no text=True)
        result = subprocess.run(
            ["xattr", "-p", "com.apple.metadata:kMDItemWhereFroms", filepath],
            capture_output=True
        )
        if result.returncode == 0 and result.stdout:
            # Parse binary plist directly from raw bytes
            urls = plistlib.loads(result.stdout)
            if urls and isinstance(urls, list) and len(urls) > 0:
                return urls[0]
    except Exception:
        pass
    return None


def copy_mac_where_from_attr(src_path, dest_path):
    """
    Copies the macOS 'Where from' attribute to the target file using macOS native xattr CLI.
    """
    try:
        # 1. Read raw binary bytes from source file
        get_res = subprocess.run(
            ["xattr", "-p", "com.apple.metadata:kMDItemWhereFroms", src_path],
            capture_output=True
        )
        if get_res.returncode == 0 and get_res.stdout:
            raw_hex = get_res.stdout.hex()
            # 2. Write raw hex data to destination file using -wx
            set_res = subprocess.run(
                ["xattr", "-wx", "com.apple.metadata:kMDItemWhereFroms", raw_hex, dest_path],
                capture_output=True, text=True
            )
            if set_res.returncode == 0:
                return True
    except Exception:
        pass
    return False


def parse_filename_metadata(filename, src_path):
    """
    Parses structured filenames and extracts source URLs into metadata fields.
    Expected format: 01_green_nature_beach-and-sky_pexels.jpg
    """
    base_name = os.path.splitext(filename)[0]
    parts = base_name.split('_')

    if len(parts) >= 5:
        # 5-part structure: sequence_color_topic_title_source
        color = parts[1].title()
        topic = parts[2].title()
        title = parts[3].replace('-', ' ').title()
        source = parts[4].title()
        description = f"{title} ({color} / {topic})"
    elif len(parts) == 4:
        # 4-part structure: sequence_topic_title_source
        topic = parts[1].title()
        title = parts[2].replace('-', ' ').title()
        source = parts[3].title()
        description = f"{title} ({topic})"
    else:
        # Fallback for simple or unformatted filenames
        title = base_name.replace('-', ' ').replace('_', ' ').title()
        source = "Pexels" if "pexels" in base_name.lower() else "Stock Source"
        description = title

    where_from_url = get_mac_where_from_url(src_path)
    
    if where_from_url:
        user_comment = f"Original File: {filename} | URL: {where_from_url}"
    else:
        user_comment = f"Original File: {filename}"

    copyright_notice = f"{source} License (GPL Compatible)"

    return {
        "title": description,
        "artist": source,
        "copyright": copyright_notice,
        "comment": user_comment,
        "url": where_from_url
    }


if not os.path.exists(SOURCE_DIR):
    print(f"❌ Error: Source folder '{SOURCE_DIR}' does not exist.")
    sys.exit(1)

os.makedirs(OUTPUT_DIR, exist_ok=True)

# Gather and sort valid source files
source_files = [
    f for f in sorted(os.listdir(SOURCE_DIR))
    if not f.startswith(".") and f.lower().endswith(VALID_EXTS) and os.path.isfile(os.path.join(SOURCE_DIR, f))
]

if not source_files:
    print(f"⚠️  No matching images found in '{SOURCE_DIR}'.")
    sys.exit(0)

crop_mode_str = "PASSTHROUGH (No Crop)" if NO_CROP else f"CROP & RESIZE ({TARGET_W}x{TARGET_H})"
print(f"🚀 Processing {len(source_files)} image(s) [{crop_mode_str}]")
print(f"   Source: '{SOURCE_DIR}' -> Output: '{OUTPUT_DIR}'...")

for idx, filename in enumerate(source_files, start=1):
    src_path = os.path.join(SOURCE_DIR, filename)

    # Standardized output filename: 01.webp, 02.webp, etc.
    out_filename = f"{idx:02d}.{OUTPUT_FORMAT}"
    out_path = os.path.join(OUTPUT_DIR, out_filename)

    try:
        with Image.open(src_path) as img:
            exif_data = img.getexif()

            # Parse metadata & extract 'Where from' URL
            meta = parse_filename_metadata(filename, src_path)

            # Assign EXIF tags
            exif_data[270] = meta["title"]       # ImageDescription -> WP Title / Caption
            exif_data[315] = meta["artist"]      # Artist -> WP Credit
            exif_data[33432] = meta["copyright"] # Copyright -> WP Copyright
            exif_data[37510] = meta["comment"]   # UserComment -> Audit Trail + URL

            # Convert color modes for WebP compatibility
            if img.mode in ("RGBA", "LA") or (img.mode == "P" and "transparency" in img.info):
                img = img.convert("RGBA")
            else:
                img = img.convert("RGB")

            orig_w, orig_h = img.size

            if NO_CROP:
                # Direct pass-through: keep original dimensions
                final_img = img
                proc_status = f"Native ({orig_w}x{orig_h})"
            else:
                orig_ratio = orig_w / orig_h

                # Calculate center-crop dimensions for 16:9 ratio
                if orig_ratio > TARGET_RATIO:
                    crop_w = int(orig_h * TARGET_RATIO)
                    crop_h = orig_h
                else:
                    crop_w = orig_w
                    crop_h = int(orig_w / TARGET_RATIO)

                left = (orig_w - crop_w) // 2
                top = (orig_h - crop_h) // 2
                right = left + crop_w
                bottom = top + crop_h

                cropped = img.crop((left, top, right, bottom))

                # Resample down to target dimensions
                resample_filter = getattr(Image, "Resampling", Image).LANCZOS
                final_img = cropped.resize((TARGET_W, TARGET_H), resample_filter)
                proc_status = f"Cropped ({TARGET_W}x{TARGET_H})"

            save_kwargs = {
                "format": OUTPUT_FORMAT.upper(),
                "quality": QUALITY,
                "exif": exif_data.tobytes() if hasattr(exif_data, "tobytes") else exif_data
            }
            if OUTPUT_FORMAT == "webp":
                save_kwargs["method"] = 6

            final_img.save(out_path, **save_kwargs)

            # Copy macOS 'Where from' attribute to output file for Finder Get Info
            copy_mac_where_from_attr(src_path, out_path)

            url_status = "🔗 URL Preserved" if meta["url"] else "ℹ️ No URL xattr"
            print(f"✂️  [{idx:02d}] {filename} -> {out_filename} | {proc_status} | {meta['title']} [{url_status}]")

    except Exception as e:
        print(f"⚠️  Skipped {filename}: {e}")

print(f"\n🎉 Success! Processed {len(source_files)} image(s) into '{OUTPUT_DIR}/'.")