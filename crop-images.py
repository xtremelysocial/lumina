#!/usr/bin/env python3
import os
import sys
from PIL import Image

# ==============================================================================
# CONFIGURATION FROM ENVIRONMENT VARIABLES
# ==============================================================================
SOURCE_DIR = os.environ.get("SOURCE_DIR", ".")
OUTPUT_DIR = os.environ.get("OUTPUT_DIR", os.path.join(SOURCE_DIR, "cropped_1600x900"))
QUALITY = int(os.environ.get("QUALITY", "85"))
OUTPUT_FORMAT = os.environ.get("OUTPUT_FORMAT", "webp").lower()
TARGET_W = 1600
TARGET_H = 900
TARGET_RATIO = TARGET_W / TARGET_H

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