#!/usr/bin/env python3
"""
==============================================================================
IMAGE CENTER-CROPPER & RESCALER (1600x900 / 16:9)
==============================================================================

This script scans a directory for images, center-crops them to a 16:9 aspect 
ratio, resizes them down to 1600x900 using Lanczos resampling, and exports 
them to a specified output folder.

Configured entirely via environment variables.

------------------------------------------------------------------------------
ENVIRONMENT VARIABLES & DEFAULTS
------------------------------------------------------------------------------
  SOURCE_DIR    : Folder containing input images.       (Default: ".")
  OUTPUT_DIR    : Folder to save cropped images.        (Default: SOURCE_DIR/cropped_1600x900)
  QUALITY       : Export compression quality (1-100).   (Default: "85")
  OUTPUT_FORMAT : Target image format (webp, jpg, png). (Default: "webp")

------------------------------------------------------------------------------
USAGE EXAMPLES
------------------------------------------------------------------------------

1. DEFAULT RUN (NO INPUTS):
   Processes images in the current directory ('.') and saves 1600x900 WebP 
   files into a subfolder named './cropped_1600x900/' at 85% quality.

   $ python3 crop-images.py
   # Or if executable (chmod +x crop-images.py):
   $ ./crop-images.py

2. CUSTOM SOURCE DIRECTORY (SINGLE TARGET):
   Process images from raw-blue directory using default WebP / 85% quality:

   $ SOURCE_DIR="./zz_unused/zz_raw-images/raw-blue" ./crop-images.py

3. CUSTOM SOURCE & OUTPUT DIRECTORIES:
   Process images from raw-blue and output directly into theme assets:

   $ SOURCE_DIR="./zz_unused/zz_raw-images/raw-blue" OUTPUT_DIR="./assets/images/heroes" ./crop-images.py

4. CUSTOM FORMAT & QUALITY:
   Process raw-blue folder images into high-quality JPEG files (95% quality):

   $ SOURCE_DIR="./zz_unused/zz_raw-images/raw-blue" OUTPUT_FORMAT="jpg" QUALITY=95 ./crop-images.py

5. COMBINED INLINE RUN (ALL VARIABLES):
   Set custom source, destination, format, and quality in one line:

   $ SOURCE_DIR="./zz_unused/zz_raw-images/raw-blue" \
     OUTPUT_DIR="./assets/images/patterns" \
     OUTPUT_FORMAT="webp" \
     QUALITY=90 \
     ./crop-images.py

6. EXPORTING VARIABLES (MULTIPLE RUNS IN A SESSION):
   Set variables once in your terminal session before executing sequentially:

   $ export SOURCE_DIR="./zz_unused/zz_raw-images/raw-blue"
   $ export OUTPUT_DIR="./assets/images/heroes"
   $ export OUTPUT_FORMAT="webp"
   $ export QUALITY=90
   $ ./crop-images.py

==============================================================================
"""

import os
import sys
from PIL import Image

# ==============================================================================
# CONFIGURATION FROM ENVIRONMENT VARIABLES
# ==============================================================================
QUALITY = int(os.environ.get("QUALITY", "85"))
OUTPUT_FORMAT = os.environ.get("OUTPUT_FORMAT", "webp").lower()
TARGET_W = 1600
TARGET_H = 900
#TARGET_H = 686
TARGET_RATIO = TARGET_W / TARGET_H

SOURCE_DIR = os.environ.get("SOURCE_DIR", ".")
#OUTPUT_DIR = os.environ.get("OUTPUT_DIR", os.path.join(SOURCE_DIR, "cropped_1600x900"))
OUTPUT_DIR = os.environ.get("OUTPUT_DIR", os.path.join(SOURCE_DIR, f"cropped_{TARGET_W}x{TARGET_H}"))

VALID_EXTS = (".jpg", ".jpeg", ".png", ".webp", ".bmp", ".tiff")

if not os.path.exists(SOURCE_DIR):
    print(f"❌ Error: Source folder '{SOURCE_DIR}' does not exist.")
    sys.exit(1)

os.makedirs(OUTPUT_DIR, exist_ok=True)

print(f"🚀 Rescaling & Center-Cropping in '{SOURCE_DIR}' (Format: .{OUTPUT_FORMAT}, Quality: {QUALITY}%)...")

count = 0
for filename in sorted(os.listdir(SOURCE_DIR)):
    if not filename.startswith(".") and filename.lower().endswith(VALID_EXTS):
        src_path = os.path.join(SOURCE_DIR, filename)

        # Skip directories
        if not os.path.isfile(src_path):
            continue

        base_name = os.path.splitext(filename)[0]
        out_filename = f"{base_name}.{OUTPUT_FORMAT}"
        out_path = os.path.join(OUTPUT_DIR, out_filename)

        try:
            with Image.open(src_path) as img:
                # Convert color modes for WebP compatibility
                if img.mode in ("RGBA", "LA") or (img.mode == "P" and "transparency" in img.info):
                    img = img.convert("RGBA")
                else:
                    img = img.convert("RGB")

                orig_w, orig_h = img.size
                orig_ratio = orig_w / orig_h

                # Calculate center-crop dimensions for 16:9 ratio
                if orig_ratio > TARGET_RATIO:
                    # Image is wider than 16:9 -> crop left/right
                    crop_w = int(orig_h * TARGET_RATIO)
                    crop_h = orig_h
                else:
                    # Image is taller or equal -> crop top/bottom
                    crop_w = orig_w
                    crop_h = int(orig_w / TARGET_RATIO)

                left = (orig_w - crop_w) // 2
                top = (orig_h - crop_h) // 2
                right = left + crop_w
                bottom = top + crop_h

                cropped = img.crop((left, top, right, bottom))
                
                # High quality Lanczos resize down to 1600x900
                resample_filter = getattr(Image, "Resampling", Image).LANCZOS
                resized = cropped.resize((TARGET_W, TARGET_H), resample_filter)

                # Export to WebP
                resized.save(out_path, format=OUTPUT_FORMAT.upper(), quality=QUALITY, method=6)
                print(f"✂️  Processed: {filename} ({orig_w}x{orig_h}) -> {out_path}")
                count += 1
        except Exception as e:
            print(f"⚠️  Skipped {filename}: {e}")

if count == 0:
    print(f"⚠️  No matching images found in '{SOURCE_DIR}'.")
else:
    print(f"\n🎉 Success! Processed {count} image(s) to {TARGET_W}x{TARGET_H} (.{OUTPUT_FORMAT}) in '{OUTPUT_DIR}/'.")