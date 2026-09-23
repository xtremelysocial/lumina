#!/usr/bin/env python3
"""
==============================================================================
IMAGE CENTER-CROPPER, RESCALER & EXIF METADATA EMBEDDER (1600x900 / 16:9)
==============================================================================

This script recursively scans a directory and its subdirectories for raw images, 
center-crops them to a 16:9 aspect ratio, resizes them down to 1600x900 using 
Lanczos resampling (unless NO_CROP=1 is enabled), intelligently parses structured 
filenames into EXIF metadata, and exports sequentially numbered WebP files 
(01.webp, 02.webp, etc.) within each corresponding output subdirectory.

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
   
2. CUSTOM SOURCE DIRECTORY (Processes all subfolders recursively):
   $ SOURCE_DIR="./assets/images/samples" python3 utils/crop-images.py

3. CUSTOM SOURCE & OUTPUT DIRECTORIES:
   $ SOURCE_DIR="./zz_unused/zz_raw-images" \
     OUTPUT_DIR="./assets/images/samples" \
     QUALITY=85 \
     python3 utils/crop-images.py

4. NO-CROP PASS-THROUGH (Preserve original dimensions, convert format & embed EXIF):
   $ NO_CROP=1 python3 utils/crop-images.py

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
        result = subprocess.run(
            ["xattr", "-p", "com.apple.metadata:kMDItemWhereFroms", filepath],
            capture_output=True
        )
        if result.returncode == 0 and result.stdout:
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
        get_res = subprocess.run(
            ["xattr", "-p", "com.apple.metadata:kMDItemWhereFroms", src_path],
            capture_output=True
        )
        if get_res.returncode == 0 and get_res.stdout:
            raw_hex = get_res.stdout.hex()
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
        color = parts[1].title()
        topic = parts[2].title()
        title = parts[3].replace('-', ' ').title()
        source = parts[4].title()
        description = f"{title} ({color} / {topic})"
    elif len(parts) == 4:
        topic = parts[1].title()
        title = parts[2].replace('-', ' ').title()
        source = parts[3].title()
        description = f"{title} ({topic})"
    else:
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

crop_mode_str = "PASSTHROUGH (No Crop)" if NO_CROP else f"CROP & RESIZE ({TARGET_W}x{TARGET_H})"
print(f"🚀 Sweeping subdirectories in '{SOURCE_DIR}' [{crop_mode_str}]")
print(f"   Target Base Output: '{OUTPUT_DIR}'\n")

total_processed = 0

# Walk recursively through all subdirectories
for current_root, dirs, files in os.walk(SOURCE_DIR):
    # Prevent infinite recursion/re-processing if OUTPUT_DIR sits inside SOURCE_DIR
    dirs[:] = [
        d for d in dirs 
        if not d.startswith(".") 
        and not d.startswith("cropped_") 
        and not d.startswith("converted_")
        and os.path.abspath(os.path.join(current_root, d)) != os.path.abspath(OUTPUT_DIR)
    ]

    # Filter and sort matching image files in the current folder
    source_files = sorted([
        f for f in files 
        if not f.startswith(".") and f.lower().endswith(VALID_EXTS)
    ])

    if not source_files:
        continue

    # Determine relative subfolder path and construct target output folder
    rel_path = os.path.relpath(current_root, SOURCE_DIR)
    if rel_path == ".":
        target_out_dir = OUTPUT_DIR
        display_folder = "/"
    else:
        target_out_dir = os.path.join(OUTPUT_DIR, rel_path)
        display_folder = f"/{rel_path}/"

    os.makedirs(target_out_dir, exist_ok=True)
    print(f"📁 Folder: {display_folder} ({len(source_files)} image(s))")

    # Reset index counter to 1 for every subdirectory
    for idx, filename in enumerate(source_files, start=1):
        src_path = os.path.join(current_root, filename)
        out_filename = f"{idx:02d}.{OUTPUT_FORMAT}"
        out_path = os.path.join(target_out_dir, out_filename)

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
                    final_img = img
                    proc_status = f"Native ({orig_w}x{orig_h})"
                else:
                    orig_ratio = orig_w / orig_h

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

                copy_mac_where_from_attr(src_path, out_path)

                url_status = "🔗 URL Preserved" if meta["url"] else "ℹ️ No URL xattr"
                print(f"  ✂️  [{idx:02d}] {filename} -> {out_filename} | {proc_status} | {meta['title']} [{url_status}]")
                total_processed += 1

        except Exception as e:
            print(f"  ⚠️  Skipped {filename}: {e}")
    print()

if total_processed == 0:
    print(f"⚠️  No matching images found in '{SOURCE_DIR}'.")
else:
    print(f"🎉 Success! Processed {total_processed} image(s) across all subdirectories into '{OUTPUT_DIR}/'.")