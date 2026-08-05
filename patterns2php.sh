#!/bin/zsh

# Enforce script directory anchoring
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
SOURCE_DIR="${SCRIPT_DIR}/patterns/html"
OUTPUT_DIR="${SCRIPT_DIR}/patterns/converted"

# Capture optional search filter (e.g., ./convert.sh cover)
FILTER="${1:-}"

if [[ ! -d "$SOURCE_DIR" ]]; then
    echo "❌ Error: Source folder '$SOURCE_DIR' does not exist."
    exit 1
fi

mkdir -p "$OUTPUT_DIR"

if [[ -n "$FILTER" ]]; then
    echo "🔍 Sweeping '$SOURCE_DIR' for string: '$FILTER'"
else
    echo "🚀 Sweeping all HTML layouts in '$SOURCE_DIR'..."
fi

count=0

# Enable Zsh null globbing
setopt NULL_GLOB 2>/dev/null || true

for file in "$SOURCE_DIR"/*.html(N); do
    [[ -f "$file" ]] || continue

    filename=$(basename "$file")
    slug_base="${filename%.*}"

    # 1. Apply filename search filter if provided
    if [[ -n "$FILTER" && "$slug_base" != *"$FILTER"* ]]; then
        continue
    fi

    output_file="$OUTPUT_DIR/$slug_base.php"

    # 2. Safety & Overwrite Protection Checks
    if [[ "$(realpath "$file" 2>/dev/null)" == "$(realpath "$output_file" 2>/dev/null)" ]]; then
        echo "❌ Fatal Error: Source ($file) and Output ($output_file) resolve to the same path! Skipping."
        continue
    fi

    if [[ -e "$output_file" ]]; then
        echo "⚠️  Skipping: $slug_base.php (Already exists in patterns/converted, protecting manual changes)"
        continue
    fi

    # 3. Establish Namespace Slug
    slug="lumina/$slug_base"

    # 4. Compute Taxonomy Categories Array
    categories=("lumina")

    if [[ "$slug_base" == *button* ]]; then categories+=("buttons" "call-to-action"); fi
    if [[ "$slug_base" == *column* ]]; then categories+=("column"); fi
    if [[ "$slug_base" == *cover* || "$slug_base" == *banner* || "$slug_base" == *bokeh* ]]; then categories+=("banner"); fi
    if [[ "$slug_base" == *image* || "$slug_base" == *media* || "$slug_base" == *gallery* ]]; then categories+=("media"); fi
    if [[ "$slug_base" == *text* || "$slug_base" == *faq* || "$slug_base" == *testimonial* || "$slug_base" == *copyright* || "$slug_base" == *tagline* || "$slug_base" == *bio* ]]; then categories+=("text"); fi
    if [[ "$slug_base" == *team* ]]; then categories+=("team"); fi
    if [[ "$slug_base" == *pricing* ]]; then categories+=("pricing"); fi
    if [[ "$slug_base" == *query* ]]; then categories+=("query"); fi

    # Convert array to clean comma-separated string
	categories_str="${(j:, :)categories}"

    # 5. Compute Block Type Contextual Mapping Configurations
    if [[ "$slug_base" == *query* ]]; then
        block_type="core/query"
    elif [[ "$slug_base" == *header* ]]; then
        block_type="core/template-part/header"
    elif [[ "$slug_base" == *footer* ]]; then
        block_type="core/template-part/footer"
    else
        block_type=""
    fi

    # 6. Build Title and Case Definitions
    clean_spaces="${slug_base//-/ }"
    title=$(echo "$clean_spaces" | perl -pe 's/\b(\w)/uc($1)/eg')

    echo "✅ Converting: $filename -> patterns/converted/$slug_base.php"

    # Write out the fresh PHP pattern header manifest block
    if [[ -n "$block_type" ]]; then
        cat << EOF > "$output_file"
<?php
/**
 * Title: $title
 * Description: $title
 * Slug: $slug
 * Categories: $categories_str
 * Block Types: $block_type
 */
?>
EOF
    else
        cat << EOF > "$output_file"
<?php
/**
 * Title: $title
 * Description: $title
 * Slug: $slug
 * Categories: $categories_str
 */
?>
EOF
    fi

    # 7. Execute Perl Translation engine safely via standard input (< "$file")
    perl -pe '
        # Skip Gutenberg comment lines (<!-- wp:... -->)
        if (!/<!--/) {
            s/>\s*([A-Za-z][^<>\n]*[A-Za-z0-9\.!?,])\s*</><?php esc_html_e("$1", "lumina"); ?></g;
        }
        # Replace image src paths with get_theme_file_uri()
        s/src="([^"]*\/)?([^\/"]+\.(jpg|jpeg|png|gif|svg|webp))"/src="<?php echo esc_url( get_theme_file_uri( '\''assets\/images\/$2'\'' ) ); ?>"/g;
    ' < "$file" >> "$output_file"

    ((count++))
done

echo "\n🎉 Conversion complete! Processed $count file(s) into $OUTPUT_DIR."