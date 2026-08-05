#!/bin/zsh

# Define folders
SOURCE_DIR="parts"
OUTPUT_DIR="patterns"

# Capture optional search filter from the command line argument (e.g., ./script.sh header)
FILTER="${1:-}"

# Ensure the target directory is available
mkdir -p "$OUTPUT_DIR"

# Print filter state to console
if [[ -n "$FILTER" ]]; then
    echo "🔍 Filtering source files containing the string: '$FILTER'"
else
    echo "🚀 Processing all HTML components in /$SOURCE_DIR"
fi

for file in "$SOURCE_DIR"/*.html; do
    # Prevent errors if the folder is empty
    [[ -e "$file" ]] || continue

    filename=$(basename "$file")
    slug_base="${filename%.*}"
    
    # 1. Apply filename search filter if one was provided
    if [[ -n "$FILTER" && "$slug_base" != *"$FILTER"* ]]; then
        continue
    fi
    
    # Define target path
    output_file="$OUTPUT_DIR/$slug_base.php"
    
    # 2. OVERWRITE PROTECTION CHECK
    # Skips the file completely if a converted PHP file already exists in patterns/
    if [[ -e "$output_file" ]]; then
        echo "⚠️  Skipping: $slug_base.php (Already exists, protecting manual changes)"
        continue
    fi
    
    # 3. Establish the namespace slug
    slug="lumina/$slug_base"
    
    # 4. Set theme categories
    if [[ "$slug_base" == *header* ]]; then
        category="header"
    elif [[ "$slug_base" == *footer* ]]; then
        category="footer"
    else
        category="general"
    fi

	# NEW: Set theme categories AND block type contextual bindings
    if [[ "$slug_base" == *header* ]]; then
        category="header"
        block_type="core/template-part/header"
    elif [[ "$slug_base" == *footer* ]]; then
        category="footer"
        block_type="core/template-part/footer"
    else
        category="general"
        block_type=""
    fi
    
    # 5. Build identical Title and Description variables
    clean_spaces="${slug_base//-/ }"
    title="${(C)clean_spaces}"
    
    echo "✅ Converting: $filename -> $slug_base.php"
    
    # Construct the file manifest
    cat << EOF > "$output_file"
<?php
/**
 * Title: $title
 * Description: $title
 * Slug: $slug
 * Categories: $category
 * Block Types: $block_type 
 */
?>
EOF

    # Pipe the raw HTML configuration layout into place
    cat "$file" >> "$output_file"
done

echo "🎉 Batch conversion sequence finalized!"