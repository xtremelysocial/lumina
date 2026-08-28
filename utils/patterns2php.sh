#!/bin/zsh

# ==============================================================================
# Lumina Theme Pattern Converter (patterns2php.sh)
# ==============================================================================
# Converts raw HTML block pattern layouts from /patterns/html into production-ready
# WordPress PHP pattern files in /patterns/converted with i18n text domain wrapper
# functions, asset URI helpers, and clean block comment manifests.
#
# USAGE EXAMPLES (Run from Theme Root):
#   ./utils/patterns2php.sh                 # Process all HTML files (skips existing)
#   ./utils/patterns2php.sh hero            # Process only HTML files matching "hero"
#   ./utils/patterns2php.sh --force         # Overwrite all converted PHP pattern files
#   ./utils/patterns2php.sh hero -f         # Force overwrite only "hero" patterns
# ==============================================================================

# Enforce script directory anchoring (Script lives in /utils)
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
SOURCE_DIR="${THEME_ROOT}/patterns/html"
OUTPUT_DIR="${THEME_ROOT}/patterns/converted"

# Comprehensive Block Type Keyword Mappings
typeset -A BLOCK_MAP
BLOCK_MAP=(
    "button"        "core/buttons"
    "buttons"       "core/buttons"
    "columns"       "core/columns"
    "cover"         "core/cover"
    "banner"        "core/cover"
    "details"       "core/details"
    "faq"           "core/details"
    "gallery"       "core/gallery"
    "image"         "core/image"
    "media"         "core/media-text"
    "page"          "core/page"
    "query"         "core/query"
    "social-icons"  "core/social-icons"
    "site-title"    "core/site-title"
    "text"          "core/paragraph"
    "header"        "core/template-part/header"
    "footer"        "core/template-part/footer"
)

# Capture options ($1 can be a filter string or --force / -f)
FORCE_OVERWRITE=false
FILTER=""

for arg in "$@"; do
    if [[ "$arg" == "--force" || "$arg" == "-f" ]]; then
        FORCE_OVERWRITE=true
    else
        FILTER="$arg"
    fi
done

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

# Pre-sort block keys by length descending so 'gallery' matches before 'image'
sorted_block_keys=(${(f)"$(for k in ${(k)BLOCK_MAP}; do echo "${#k} $k"; done | sort -rn | cut -d' ' -f2-)"})

for file in "$SOURCE_DIR"/*.html(N); do
    [[ -f "$file" ]] || continue

    filename=$(basename "$file")
    slug_base="${filename%.*}"

    # 1. Apply filename search filter if provided
    if [[ -n "$FILTER" && "$slug_base" != *"$FILTER"* ]]; then
        continue
    fi

    output_file="$OUTPUT_DIR/$slug_base.php"

    # 2. Overwrite Protection Check
    if [[ -e "$output_file" && "$FORCE_OVERWRITE" == false ]]; then
        echo "⚠️  Skipping: $slug_base.php (Already exists. Use --force or -f to overwrite)"
        continue
    fi

    # 3. Establish Namespace Slug
    slug="lumina/$slug_base"

    # 4. Compute Taxonomy Categories Array
    categories=("lumina")

    # A. Harvest categories directly from root block JSON metadata if present
    raw_json_cats=$(perl -0777 -ne 'if (/<!-- wp:[^{]*\{.*?"metadata":\{.*?"categories":\[(.*?)\]/s) { my $c = $1; $c =~ s/"//g; print $c; }' "$file")

    if [[ -n "$raw_json_cats" ]]; then
        for cat in ${(s:,:)raw_json_cats}; do
            trimmed=$(echo "$cat" | xargs)
            if [[ -n "$trimmed" ]]; then
                categories+=("$trimmed")
            fi
        done
    fi

    # B. Supplemental keyword guessing from filename
    if [[ "$slug_base" == *button* ]]; then categories+=("buttons" "call-to-action"); fi
    if [[ "$slug_base" == *column* ]]; then categories+=("column"); fi
    if [[ "$slug_base" == *cover* || "$slug_base" == *banner* || "$slug_base" == *bokeh* ]]; then categories+=("banner"); fi
    if [[ "$slug_base" == *image* || "$slug_base" == *media* || "$slug_base" == *gallery* ]]; then categories+=("media"); fi
    if [[ "$slug_base" == *text* || "$slug_base" == *faq* || "$slug_base" == *testimonial* || "$slug_base" == *copyright* || "$slug_base" == *tagline* || "$slug_base" == *bio* ]]; then categories+=("text"); fi
    if [[ "$slug_base" == *team* ]]; then categories+=("team"); fi
    if [[ "$slug_base" == *pricing* ]]; then categories+=("pricing"); fi
    if [[ "$slug_base" == *query* ]]; then categories+=("query"); fi

    # C. Deduplicate array with Zsh built-in (u) flag
    unique_categories=(${(u)categories})
    categories_str="${(j:, :)unique_categories}"

    # 5. Search for block keywords anywhere in filename (longest keys first)
    block_type=""
    for key in $sorted_block_keys; do
        if [[ "$slug_base" == *"$key"* ]]; then
            block_type="${BLOCK_MAP[$key]}"
            break
        fi
    done

    # 6. Build Title and Case Definitions
    clean_spaces="${slug_base//-/ }"
    clean_spaces="${clean_spaces//_/ }"
    title=$(echo "$clean_spaces" | perl -pe 's/\b(\w)/uc($1)/eg')

    echo "✅ Converting: $filename -> patterns/converted/$slug_base.php (Block Type: ${block_type:-None})"

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
    
        # Safely strip "id":123, "mediaID":123, and "patternName":"..." from block JSON comments
        if (/<!--\s*wp:/) {
            s/"(?:id|mediaID)":\s*\d+,\s*|,\s*"(?:id|mediaID)":\s*\d+|"(?:id|mediaID)":\s*\d+//g;
            s/"patternName":"[^"]+",\s*|,\s*"patternName":"[^"]+"|"patternName":"[^"]+"//g;
        }
    
        # Replace image URLs across src, href, JSON attributes, and CSS url()
        s/src="([^"]*\/)?([^\/"]+\.(jpg|jpeg|png|gif|svg|webp))"/src="<?php echo esc_url( get_theme_file_uri( "assets\/images\/$2" ) ); ?>"/g;
        s/href="([^"]*\/)?([^\/"]+\.(jpg|jpeg|png|gif|svg|webp))"/href="<?php echo esc_url( get_theme_file_uri( "assets\/images\/$2" ) ); ?>"/g;
        s/"url":"([^"]*\/)?([^\/"]+\.(jpg|jpeg|png|gif|svg|webp))"/"url":"<?php echo esc_url( get_theme_file_uri( "assets\/images\/$2" ) ); ?>"/g;
        s/url\((&quot;|"|)?([^"()\s]*\/)?([^\/"()\s]+\.(jpg|jpeg|png|gif|svg|webp))\1\)/url("<?php echo esc_url( get_theme_file_uri( "assets\/images\/$3" ) ); ?>")/g;

        # Translate inner text on non-comment lines
        if (!/<!--/) {
            s/>\s*([A-Za-z][^<>\n]*[A-Za-z0-9\.!?,])\s*</><?php esc_html_e("$1", "lumina"); ?></g;
        }
    ' < "$file" >> "$output_file"

    ((count++))
done

echo "\n🎉 Conversion complete! Processed $count file(s) into $OUTPUT_DIR."