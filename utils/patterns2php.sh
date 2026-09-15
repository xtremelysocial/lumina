#!/bin/zsh

# ==============================================================================
# Lumina Theme Pattern Converter (patterns2php.sh)
# ==============================================================================
# Converts raw HTML block pattern layouts from /patterns/html (or any specified
# subfolder like /parts) into production-ready WordPress PHP pattern files in 
# /patterns/converted with i18n text domain wrapper functions, asset URI helpers, 
# and clean block comment manifests.
# ==============================================================================

# Enforce script directory anchoring (Script lives in /utils)
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"

# Default directories
SOURCE_DIR="${THEME_ROOT}/patterns/html"
OUTPUT_DIR="${THEME_ROOT}/patterns/converted"

# Comprehensive Block Type Keyword Mappings
typeset -A BLOCK_MAP
BLOCK_MAP=(
    "button"        "core/buttons"
    "buttons"       "core/buttons"
    "columns"       "core/columns"
    "cover"         "core/cover"
    "details"       "core/details"
    "faq"           "core/details"
    "gallery"       "core/gallery"
    "image"         "core/image"
    "media-text"    "core/media-text"
    "page"          "core/page"
    "query"         "core/query"
    "social-icons"  "core/social-icons"
    "site-title"    "core/site-title"
    "text"          "core/paragraph"
    "header"        "core/template-part/header"
    "footer"        "core/template-part/footer"
)

# Capture options ($1 can be a filter string, folder path, or --force / -f)
FORCE_OVERWRITE=false
FILTER=""

for arg in "$@"; do
    if [[ "$arg" == "--force" || "$arg" == "-f" ]]; then
        FORCE_OVERWRITE=true
    elif [[ -d "${THEME_ROOT}/$arg" ]]; then
        SOURCE_DIR="${THEME_ROOT}/$arg"
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

# Enable Zsh null globbing & globstar for recursive subfolder scanning
setopt NULL_GLOB GLOB_STAR_SHORT 2>/devnull || true

# Pre-sort block keys by length descending so 'gallery' matches before 'image'
sorted_block_keys=(${(f)"$(for k in ${(k)BLOCK_MAP}; do echo "${#k} $k"; done | sort -rn | cut -d' ' -f2-)"})

# Sweep both root folder and numbered subdirectories recursively
for file in "$SOURCE_DIR"/**/*.html(N); do
    [[ -f "$file" ]] || continue

    filename=$(basename "$file")
    raw_slug_base="${filename%.*}"

    # 0. STRIP LEADING ORDERING NUMBERS (e.g., "01-banner-hero" -> "banner-hero")
    slug_base=$(echo "$raw_slug_base" | perl -pe 's/^\d+[-_.\s]*//')

    # 1. Apply filename search filter if provided (matches against raw or clean name)
    if [[ -n "$FILTER" && "$raw_slug_base" != *"$FILTER"* && "$slug_base" != *"$FILTER"* ]]; then
        continue
    fi

    output_file="$OUTPUT_DIR/$slug_base.php"

    # 2. Overwrite Protection Check
    if [[ -e "$output_file" && "$FORCE_OVERWRITE" == false ]]; then
        echo "⚠️  Skipping: $slug_base.php (Already exists. Use --force or -f to overwrite)"
        continue
    fi

    # 3. Establish Namespace Slug (Sanitize special characters like '+' into '-')
    clean_slug_base="${slug_base//[^a-zA-Z0-9_-]/-}"
    slug="lumina/$clean_slug_base"

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

    # B. Supplemental keyword guessing from clean filename
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

    echo "✅ Converting: $filename -> patterns/converted/$slug_base.php (Title: '$title')"

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

    # 7. Execute Perl Translation engine safely in slurping mode (-0777)
    perl -0777 -pe '
    
        # Safely strip "id":123, "mediaID":123, and "patternName":"..." from block JSON comments
        s{<!--\s*wp:.*?-->}{
            my $c = $&;
            $c =~ s/"(?:id|mediaID)":\s*\d+,\s*|,\s*"(?:id|mediaID)":\s*\d+|"(?:id|mediaID)":\s*\d+//g;
            $c =~ s/"patternName":"[^"]+",\s*|,\s*"patternName":"[^"]+"|"patternName":"[^"]+"//g;
            $c;
        }gse;
    
        # Preserve subfolders while anchoring on assets/images/
        s{src="([^"]*?assets\/images\/)?([^"]+\.(jpg|jpeg|png|gif|svg|webp))"}{src="<?php echo esc_url( get_theme_file_uri( "assets\/images\/$2" ) ); ?>"}g;
        s{href="([^"]*?assets\/images\/)?([^"]+\.(jpg|jpeg|png|gif|svg|webp))"}{href="<?php echo esc_url( get_theme_file_uri( "assets\/images\/$2" ) ); ?>"}g;
        s{"url":"([^"]*?assets\/images\/)?([^"]+\.(jpg|jpeg|png|gif|svg|webp))"}{"url":"<?php echo esc_url( get_theme_file_uri( "assets\/images\/$2" ) ); ?>"}g;
        s{url\((&quot;|"|)?([^"()\s]*?assets\/images\/)?([^"()\s]+\.(jpg|jpeg|png|gif|svg|webp))\1\)}{url("<?php echo esc_url( get_theme_file_uri( "assets\/images\/$3" ) ); ?>")}g;

        # 1. Stash HTML comments using a strictly numeric placeholder (___INDEX___)
        my @comments;
        s{<!--.*?-->}{ push(@comments, $&); "___" . $#comments . "___" }gse;

        # 2. Translate inner tag text containing letters
        s{>\s*([^<>\n]*?[a-zA-Z][^<>\n]*?)\s*<}{
            my $txt = $1;
            if ($txt !~ /^<\?php/) {
                $txt =~ s/"/\\"/g;
                "><" . "?php esc_html_e(\"$txt\", \"lumina\"); ?>" . "<";
            } else {
                ">$txt<";
            }
        }ge;

        # 3. Restore stashed HTML block comments back to exact positions
        s{___(\d+)___}{$comments[$1]}ge;

    ' < "$file" >> "$output_file"

    ((count++))
done

echo "\n🎉 Conversion complete! Processed $count file(s) into $OUTPUT_DIR."