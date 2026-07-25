# Lumina Theme Project Charter  
  
# Lumina Charter: Section 1 - Project Vision & Features  
  
## 1.1 Project Vision: Modern Full-Site Editing  
###   
### Lumina represents a modern evolution of WordPress Full-Site Editing (FSE). Inspired by the colors, ambient light, and natural depth of the physical environment around us, Lumina bridges organic aesthetics with high-performance digital web architecture. We believe website layouts should feel balanced, tactile, and natural—bringing the structural rhythms and light behavior of the physical world directly onto the digital canvas.  
  
## 1.2 Dynamic Moods & Global Style Flexibility  
  
Global Style variations in Lumina go far beyond superficial color swaps or font changes. Powered by modular theme.json style variations, Lumina enables site creators to instantly transform the entire physical personality, spatial geometry, and kinetic energy of a site with a single click in the Site Editor.  
Rather than applying static rules, each **Lumina Mood** re-engineers the site's structural physics, corner radii, spatial gaps, and motion easing curves:  
  
* **Architectural & Weighted (*Lumina Gallery*):** Designed for high-end exhibition spaces and editorial layouts. Features sharp, architectural 6px corners, structured 30px layout gaps, and luxurious, deliberate animation curves (cubic-bezier(0.2, 0, 0, 1) with up to 800ms transitions) that give interactive elements a weighted, physical presence.  
* **High-Performance & Precision (*Lumina Tactical*):** Tailored for utility, speed, and dense information architecture. Employs rugged 9px corner radii, compact 20px layout gaps, and crisp, rapid animation response times (180ms–300ms) for near-instantaneous user feedback.  
* **Fluid & Organic (*Lumina Spacious*):** An ultra-modern, fluid mood. Introduces soft 30px "pebble" corner radii, pill buttons (999px), expansive 34px layout gaps, and playful spring physics (cubic-bezier(0.34, 1.56, 0.64, 1)) where cards and buttons expand and bounce dynamically on interaction.  
  
## 1.3 Ambient Light & Organic Depth  
  
Lumina captures the natural depth of physical surroundings to make content layouts completely intuitive. By structuring blocks to mimic how ambient light and shadow cast subtle gradients across architectural spaces, text, images, and container blocks interact within a visual ecosystem that feels native to the eye.  
  
## 1.4 Beautiful Colors & Smart Color Logic  
Colors in Lumina are drawn from nature rather than computer screens—utilizing rich earthy mid-tones, deep darks, and subtle organic backdrops that give site creators the flexibility to direct user attention exactly where it belongs.  
  
* **Automated Color Contrast Engine:** Lumina eliminates the need to manually tweak layout styling panel parameters in the block editor.  
* **Dynamic Background Perception:** The theme engine automatically tracks background color selections and calculates reasonable, WCAG-compliant default colors for body text, major headlines, and navigation links.  
* **Zero-Touch Readability:** Site builders can simply drop element blocks into any section and select a tint layout; the theme manages perfect legibility for the audience automatically.  
  
## 1.5 Interactive Depth & Kinetic Physics  
Lumina establishes an active layout track that users can actually feel:  
* **Automated Card Detection:** Container blocks carrying interactive elements—such as action buttons or links—are automatically detected by the theme logic.  
* **Kinetic Lift-Off:** Detected interactive cards gently lift off the page with soft, realistic ambient shadows.  
* **Mood-Engineered Motion:** Hover scales (ranging from conservative 1.02× scale up to elastic 1.15× expansion) and y-axis displacement tokens (translateY(-3px) to translateY(-5px)) adapt dynamically to the active Global Style Mood.  
* **Omni-Input Responsiveness:** Cards respond instantly to mouse hovers and mobile touch gestures alike, drawing closer to the user to signify action readiness.  
  
## 1.6 Full Editor Freedom (WordPress FSE Philosophy)  
Lumina delivers complete layout control without technical hurdles or cascade pollution:  
* **Modular Assembly:** Easily switch custom site headers, personalized footers, visual article grids, and global style variations directly within a unified Site Editor setup.  
* **Adaptable & Fresh:** Layout components and template parts can be swapped periodically to keep the site modern and fresh while preserving developer-controlled underlying CSS logic.  
  
# Lumina Charter: Section 2 - Lumina Color Engine & Master Palette Architecture  
  
## 2.1 The Four-Tier Color Track Architecture  
Every chromatic family in Lumina (Greens, Oranges, Reds, Blues, Neutral Grays) is mathematically calibrated into a four-tier track structure:  
  
1. **Primary Tier:** The core brand anchor used for high-impact elements, primary buttons, and hero callouts.  
2. **Alt Tier (Primary Alt):** A dark anchor alternative used for hover states, active indicators, and secondary callouts.  
3. **Subtle Tier:** A soft, chromatic backdrop designed for container wells, cards, and section backgrounds.  
4. **Subtle Alt Tier:** An alternate tinted backdrop for nested wells, alternating table rows, or sidebar panels.  
##   
## 2.2 Contrast & Text Pairing Rules (WCAG AA Standard)  
To guarantee 100% automated readability across dynamic block assembly, Lumina enforces strict HSL-calibrated contrast rules:  
  
* **The White Text Rule (Primary & Alt Tiers):**  
    * Backgrounds assigned to Primary or Alt tiers **MUST** pair with **Pure White text (#FFFFFF / var(--wp--preset--color--foreground-alt))**.  
    * Primary HSL Lightness (L) parameters are strictly bound (L≤50%) so that white text clears at least **3.0:1 contrast** for UI components and large text (18pt+ or 14pt+ bold) and **4.5:1** for standard body text.  
* **The Dark Text Standard (Subtle & Subtle Alt Tiers):**  
    * Backgrounds assigned to Subtle or Subtle Alt tiers **MUST** pair with **Dark Text (#1B1B1B / var(--wp--preset--color--contrast))**.  
    * Subtle tier light values (L≥80%) are tuned to guarantee a minimum **4.5:1 contrast ratio** against dark body text.  
##   
## 2.3 Tier Compression & Hue Preservation Philosophy  
  
* **No Muddy Blacks:** Primary dark anchors must remain rich and saturated; lightness calculations must never push a primary color into muddy, flat black.  
* **Pigmented Warmth for Subtles:** Subtle tiers must never degrade into sterile, lifeless grays. They carry intentional chromatic character (pigmented warmth or organic tint) derived directly from the primary hue.  
* **Compressed Tier Gap:** The mathematical lightness gap between subtle tiers and primary anchors is compressed so container wells and primary controls feel unified within the same color space.  
##   
## 2.4 High-Chroma Link Exceptions ("The Unicorns")  
  
High-chroma coordinates in HSL space—such as *Pine Tech* (#15803D), *High-Chroma Mint* (#038031), and *Deep Forest*(#047857)—act as structural exceptions. They pack enough pure saturation to stand out as active interactive links while maintaining sufficient depth to clear dual contrast thresholds:  
* ≥4.5:1 against Light Backdrops (#FAF9F6 / Subtle Tiers).  
* ≥3.0:1 against Body Text (#1B1B1B).  
* *Result:* Safe to deploy as active inline link colors without requiring text underlines.  
##   
## 2.5 Gutenberg UI Safety Protocols & Banned Palette Patterns  
To maintain admin stability, dynamic or context-dependent variables are excluded from selectable palette pickers in theme.json:  
  
* 🚫 **BANNED from the Selectable Color Palette:** Dynamic values like currentColor or dynamic "Muted Text" variations must **NEVER** be registered as circular color dots in theme.json.  
    * *Reason 1 (Inverted Dot Bug):* The Gutenberg sidebar applies its own text color context, causing the circular color dot preview in the admin inspector to display inaccurate colors.  
    * *Reason 2 (Background Feedback Loop):* Applying currentColor as a background color causes the container background to match the text color, making content completely invisible.  
* ✅ **The Standard:** Palette-agnostic dynamic values are implemented via developer-controlled CSS custom properties (--wp--custom--color--muted-text) or scoped block styles.  
##   
## 2.6 Color Palette and Intended Usage  
  
The Lumina Master Color Palette operates on a 5-tier structural hierarchy designed for WCAG 2.1 AA/AAA compliance, Gutenberg editor UI safety, and Flat 3.0 ambient lighting physics. Every color token possesses an explicit functional role across light and dark surfaces:  
  

| Token Slug | Preset Name | HSL Value | Architectural Role & Intended Usage |
| -------------------- | ----------------------------------------------- | ------------------ | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| primary | Primary (Crisp Sage 48%) | hsl(154, 24%, 48%) | Primary brand callout fill, main CTA buttons, badge indicators, and primary visual focal points. Formulated for white/light text readability. |
| secondary | Secondary (Ocean Blue 44%) | hsl(206, 24%, 44%) | Secondary action buttons, active navigation markers, informational callouts, and key structural accents. |
| tertiary | Tertiary (Antique Gold 48%) | hsl(34, 32%, 48%) | Warm accent highlights, heading separators, featured tags, and editorial quote accents. |
| primary-alt | Primary Alt (Deep Alpine Sage 38%) | hsl(154, 26%, 38%) | Hover/active states for primary CTAs, focused button outlines, and high-contrast primary container headers. |
| secondary-alt | Secondary Alt (Storm Navy 34%) | hsl(206, 26%, 34%) | Hover/active states for secondary components, dark navigation links, and structural card headers. |
| tertiary-alt | Tertiary Alt (Burnished Ochre 38%) | hsl(34, 34%, 38%) | Hover/active states for tertiary accents, focus borders on warm wells, and deep warm badges. |
| primary-subtle | Primary Subtle (Whisper Sage Fill 91%) | hsl(154, 20%, 91%) | Soft tinted background wells for success alerts, primary card fills, and highlighted group block backgrounds. Uses dark text ink (#1B1B1B / --wp--preset--color--contrast). |
| secondary-subtle | Secondary Subtle (Whisper Sky Fill 91%) | hsl(206, 24%, 91%) | Soft background wells for info boxes, secondary card containers, and code/quote block fills. |
| tertiary-subtle | Tertiary Subtle (Whisper Parchment Fill 91%) | hsl(34, 22%, 91%) | Warm tinted background wells for warning banners, featured block panels, and editorial excerpts. |
| primary-subtle-alt | Primary Subtle Alt (Sage Border Seam 83%) | hsl(154, 16%, 83%) | Subtle structural borders and card seams surrounding primary-subtle containers. |
| secondary-subtle-alt | Secondary Subtle Alt (Sky Border Seam 83%) | hsl(206, 18%, 83%) | Subtle structural borders and dividers surrounding secondary-subtle containers. |
| tertiary-subtle-alt | Tertiary Subtle Alt (Parchment Border Seam 83%) | hsl(34, 16%, 83%) | Subtle structural borders and field outlines surrounding tertiary-subtlecontainers. |
| neutral | Neutral (Crisp Sand Well 96%) | hsl(32, 16%, 96%) | Neutral background well fill for sidebar panels, off-canvas drawers, and unaccented content cards. |
| neutral-alt | Neutral Alt (Sand Border Seam 88%) | hsl(32, 12%, 88%) | Default neutral border stroke for structural dividers, field outlines, and standard card borders. |
| base | Base (Almond White) | hsl(32, 20%, 97%) | Primary viewport canvas background color for light theme modes. Anchors global layout wrappers. |
| contrast | Contrast (Midnight Indigo Typographic Ink) | hsl(214, 12%, 11%) | Primary typographic ink for body copy, H1–H6 headings, and core text elements on light backdrops. |
| foreground-alt | Foreground Alt (Light Almond White) | hsl(32, 20%, 98%) | Elevated light surface containers, elevated card backgrounds, and button text ink on dark surfaces. |
| very-light-gray | Very Light Gray (Warm Sand Footer Floor 91%) | hsl(32, 14%, 91%) | Light sand background fills for primary footers, sub-footers, and secondary wells. |
| light-gray | Light Gray (Warm Sand Inner Well 83%) | hsl(32, 10%, 83%) | Inner wells, search input backgrounds, and subtle content separator lines. |
| gray | Gray (Warm Structural Border 71%) | hsl(32, 6%, 71%) | Medium-contrast structural borders, disabled button borders, and form input outlines. |
| dark-gray | Dark Gray (Muted Espresso Typography 44%) | hsl(32, 4%, 44%) | Muted typography, post metadata, captions, author bios, and secondary text labels. |
| very-dark-gray | Very Dark Gray (Smoky Sand Shadow 25%) | hsl(32, 2%, 25%) | Deep ambient shadow tint parameter and high-contrast neutral elements. |
| primary-dark | Primary Dark (Deep Forest Sage) | hsl(170, 45%, 20%) | Dark mode primary container base, deep green hero headers, and dark accent cards. |
| dark | Dark (Lumina Midnight Balanced 22%) | hsl(208, 21%, 22%) | Primary canvas base for dark mode themes (is-dark-theme) and dark site headers/footers. |
| tertiary-dark | Dark Tertiary (Antique Gold Deep 22%) | hsl(34, 34%, 22%) | Dark mode warm accent container base and deep gold hero background panels. |
| primary-dark-alt | Primary Dark Alt (Rich Hero Green) | hsl(170, 50%, 15%) | Deepest green anchor fill for dark hero sections and high-impact CTA wrappers. |
| dark-alt | Dark Alt (Lumina Midnight Balanced 16%) | hsl(209, 24%, 16%) | Abyssal canvas base, secondary dark mode surface cards, and deep inset wells. |
| tertiary-dark-alt | Dark Tertiary Alt (Antique Gold Abyssal 14%) | hsl(34, 34%, 14%) | Abyssal warm anchor background fill for featured dark sections. |
| highlight | Highlight (Electric Sage for Dark BG) | hsl(154, 65%, 68%) | High-chroma interactive link ink, focus rings, and bright indicators on dark backgrounds. |
| highlight-alt | Highlight Alt (Vivid Pine Link Ink) | hsl(154, 75%, 28%) | High-chroma link ink for light, text-heavy container layouts without forced underlines. |
| white | White | hsl(0, 0%, 100%) | Pure light anchor, modal backdrops, and text ink for primary buttons/badges. |
| off-white | Off White (Desert Alabaster) | hsl(32, 20%, 97%) | Soft off-white surface cards and warm light container backdrops. |
| almost-black | Almost Black (Pure Carbon Floor) | hsl(0, 0%, 18%) | High-contrast dark surface fill, dark mode cards, and carbon footer grounds. |
| not-quite-black | Not Quite Black (Rich Carbon Body Copy) | hsl(0, 0%, 11%) | Ultra-deep typographic ink for high-contrast reading surfaces. |
| black | Black (True Black) | hsl(0, 0%, 0%) | Absolute dark bound, high-contrast modal backdrops, and true black border strokes. |
  
  
## 2.7 Colors-Related theme.json Custom Variables  
To ensure full isolation between user-editable palette presets and core theme styling logic, all component-level color references in Lumina are abstracted into settings.custom.color tokens in theme.json.  
  
### 2.7.1 Structural Variables Mapping (theme.json)  
JSON  
  
```
{
  "settings": {
    "custom": {
      "color": {
        "theme": {
          "mode": "is-light-theme",
          "scheme": "lumina"
        },
        "border": "var(--wp--preset--color--neutral-alt)",
        "field": {
          "outline": "rgba(0, 0, 0, 0.25)"
        },
        "button": {
          "background": "var(--wp--preset--color--primary)",
          "text": "var(--wp--preset--color--foreground-alt)",
          "hover": "var(--wp--preset--color--primary-alt)",
          "hoverOpacity": "0.8"
        },
        "link": {
          "hoverOpacity": "0.6"
        },
        "heading": {
          "text": "var(--wp--preset--color--contrast)",
          "separator": "var(--wp--preset--color--tertiary)"
        },
        "navigation": {
          "background": "var(--wp--preset--color--base)"
        },
        "shadow": {
          "natural": "1px 3px 6px rgba(42, 50, 61, 0.08)"
        }
      }
    }
  }
}

```
  
### 2.7.2 Token Definition Table  

| Variable Key | Target Preset / Value | Purpose & Architectural Mechanics |
| ---------------------------------- | -------------------------------------------- | ------------------------------------------------------------------------------------ |
| custom.color.theme.mode | "is-light-theme" / "is-dark-theme" | Global state flag set on <body> to route theme physics and contrast overrides. |
| custom.color.theme.scheme | "lumina", "sol", "heritage", "tide" | Identifies active Global Style Mood variations. |
| custom.color.border | var(--wp--preset--color--neutral-alt) | Default stroke for cards, fields, dividers, and structural containers. |
| custom.color.field.outline | rgba(0, 0, 0, 0.25) / rgba(45, 35, 25, 0.25) | Focus and border stroke for form fields adapting dynamically across warm/cool bases. |
| custom.color.button.background | var(--wp--preset--color--primary) | Base fill for standard core/button blocks. |
| custom.color.button.text | var(--wp--preset--color--foreground-alt) | Text ink for standard core/button blocks. |
| custom.color.button.hover | var(--wp--preset--color--primary-alt) | Fill state transition on button hover/focus. |
| custom.color.button.hoverOpacity | 0.8 / 0.9 | Alpha opacity scaling applied on button hover, scaled by active Mood. |
| custom.color.link.hoverOpacity | 0.6 / 0.8 | Alpha transparency shift for text links on hover without triggering layout reflow. |
| custom.color.heading.text | var(--wp--preset--color--contrast) | Default typographic ink for headings (<h1>–<h6>). |
| custom.color.heading.separator | var(--wp--preset--color--tertiary) | Decorative underline accent color for entry headings. |
| custom.color.navigation.background | var(--wp--preset--color--base) | Backdrop fill for sticky header navigation wrappers. |
| custom.color.shadow.natural | 1px 3px 6px rgba(42, 50, 61, 0.08) | Base ambient shadow parameter token with blue/gray undertones for realistic depth. |
  
  
### 2.7.3 Developer Custom Properties & Gutenberg Safety Directives  
1. **The currentColor Exclusion Protocol (--wp--custom--color--muted-text):**  
    * **Banned from theme.json Palette Dots:** Secondary/muted text colors using currentColor must **never** be registered as selectable palette items in theme.json.  
    * **Reasoning:** Gutenberg renders palette dots in the sidebar UI using the string value. Registering currentColorcauses the "Inverted Dot Bug" (dot matches admin sidebar text color) and the "Background Feedback Loop" (users selecting Muted Text for group backgrounds make content invisible).  
    * **Implementation:** Injected strictly via CSS custom properties:  
  
CSS  
```
:where(.wp-site-blocks) {
  --wp--custom--color--muted-text: currentColor;

```
```
} 

```
2. **Dark Theme Contrast Overrides (:where(.is-dark-theme)):**  
    * In dark mode variations, standard gray steps dynamically remap to preserve WCAG 2.1 contrast targets:   
CSS  
```
:where(.is-dark-theme) .has-very-light-gray-background-color {
  color: var(--wp--custom--color--contrast--very-light-gray, var(--wp--preset--color--foreground-alt));
}
:where(.is-dark-theme) .has-dark-gray-background-color {
  color: var(--wp--custom--color--contrast--dark-gray, var(--wp--preset--color--almost-black));
} 

```
##   
# Lumina Charter: Section 3 - Digital Physics & Kinetic Effects Engine  
##   
## 3.1 Architecture Overview & Block Registry Schema  
The Lumina Physics Engine (v0.9.9 Build 30) operates as a declarative, data-driven kinetic framework. Rather than applying loose CSS hover rules, all interactive components are declared within a centralized Map Registry (_00-config.scss). This registry maps WordPress Gutenberg blocks to physical roles, structural gates, and interaction scopes.  
SCSS+ 4  
  
### The Centralized Block Registry Schema (_00-config.scss)  
Every block entry merges with programmatic system defaults ($registry-defaults) to guarantee structural consistency across theme styles:  
  
CSS  
  
```
/ Default Registry Configuration Map
$registry-defaults: (
    block:   '*',            // Base block selector or wildcard [class*="wp-block-"]
    is:      'none',         // Mandatory CSS class filters (e.g., .has-background)
    has:     'a, button',    // Required structural child gate (e.g., embedded links)
    exclude: '.alignfull',   // Excluded container contexts (e.g., full-width sections)
    trigger: 'self',        // Action boundary selector
    target:  'self',        // Kinetic animation target selector
    spacing: false,         // Structural spacing override flag
    role:    'object'       // Role classification: card | object | object-zoom | button

```
```
); 

```
### Registry Manifest Mapping  

| Block Target | Structural Filter (is) | Required Gate (has) | Trigger / Target | Assigned Role | Architectural Behavior |
| ----------------------------------------------- | --------------------------------------- | --------------------------------------------- | --------------------------------- | ----------------- | ------------------------------------------------------------------------ |
| Wildcard Container (*) | Backgrounds, Custom Borders, Cover
SCSS | a:not(figcaption a), .wp-element-button

SCSS | self / self

SCSS | card

SCSS | Kinetic container with subtle lift and ambient shadow elevation.
SCSS+ 1 |
| Core Image (.wp-block-image) | none

SCSS | a:not(figcaption a)

SCSS | self / img

SCSS | object

SCSS | Standard linked media figure with depth shadow lift.
SCSS+ 1 |
| Column Image (.wp-block-column .wp-block-image) | none

SCSS | a:not(figcaption a)

SCSS | self / img

SCSS | object-zoom

SCSS | Bounded zoom portal framed within column geometry.
SCSS+ 1 |
| Media & Text (.wp-block-media-text__media) | none

SCSS | a:not(figcaption a)

SCSS | self / img

SCSS | object-zoom

SCSS | Framed viewport zoom with overflow containment.
SCSS+ 1 |
| Sovereign Buttons (*) | none

SCSS | none

SCSS | .wp-element-button / self

SCSS | button

SCSS | Tier-30 sovereign control with primary scale expansion.
SCSS+ 1 |
| Social Links (.wp-block-social-links) | none

SCSS | none

SCSS | .wp-block-social-link/ self

SCSS | button

SCSS | Micro-interaction button logic.
SCSS |
| Legacy HTML Buttons | none

SCSS | none

SCSS | input[type="submit"], file

SCSS | button

SCSS | Legacy element spacing injection (var(--wp--preset--spacing--30)).
SCSS |
  
  
## 3.2 Dynamic Specificity Scale & Selector Compilation (_01-compiler.scss)  
To eliminate specificity wars and prevent structural usage of !important, the engine uses compile-selector() to compile clean, predictable CSS selectors.  
  
### 1. compile-selector Evaluation Pipeline  

| Pipeline Step | Target Parameter | Logic & Output Mechanism | Compiled Output Example |
| ---------------------------- | ----------------- | ------------------------------------------------------------------------------------------------------------- | ------------------------------------ |
| 1. Base Block Initialization | $block | Adds specified block selector or injects the global wildcard [class*="wp-block-"] if unassigned.
SCSS | [class*="wp-block-"]

SCSS |
| 2. Exclusion Gate | $exclude | Appends :not() structural exclusions unless the role is set to button.
SCSS | :not(.alignfull)

SCSS |
| 3. Modifier Filter | $is | Appends clean class filters via :is() pseudo-class wrappers.
SCSS | :is(.has-background)

SCSS |
| 4. Link Gate | $has | Injects required descendant checks using :has().
SCSS | :has(a)

SCSS |
| 5. Pseudo-State Injection | $scope | Injects :hover or accessible keyboard focus gates (:has(:focus-visible)).
SCSS | :hover or :has(:focus-visible)

SCSS |
| 6. Scope & Target Path | $trigger, $target | Assembles final path evaluating whether action triggers and visual targets are self-contained or nested.
SCSS | [class*="wp-block-"]:hover img

SCSS |
  
  
**Programmatic Specificity Scores**  
SCSS  
  
```
// Tier 10: Baseline Object Target (Score: 0,1,0)
.wp-block-image:where(:not(.alignfull)) img

// Tier 20: Kinetic Card Container (Score: 0,2,0)
[class*="wp-block-"]:not(.alignfull):is(.has-background)

// Tier 21: Card Floor Wildcard (Score: 0,2,1)
[class*="wp-block-"]:not(.alignfull):is(.has-background) [class*="wp-block-"]

// Tier 30: Sovereign Control (Score: 0,3,0)
.wp-site-blocks .wp-element-button 

```
## 3.3 Two-Phase Build Architecture & Execution Tracks  
The engine compiles into two separate CSS stylesheets to isolate static structural styles from interactive kinetics:  
  
1. **Phase 1: Resting Geometry (lumina-engine.css / $interactive: false)**: Establishes layout bounds, radii, baseline transforms (translateY(0) scale(1)), and resting shadows. SCSS+ 2    
2. **Phase 2: Active Kinetics (lumina-interactions.css / $interactive: true)**: Handles hover (:hover) and keyboard focus (:has(:focus-visible)) transforms, shadow shifts, and veil reveals. SCSS+ 3   
### Air Traffic Controller (Execution Tracks)  

| Track | Authority Tier | Role Key | Active Kinetics & Transforms | Default Shadow Level | Scope & Element Types |
| --------- | -------------------------- | -------------------- | ----------------------------------------------------------------------- | -------------------------------------------------- | ------------------------------------------------------------------------------- |
| Track A | Tier 30 (Sovereign)
SCSS | button

SCSS+ 1 | Large scale expansion ($grow-large / scale(1.08))
SCSS+ 1 | $shadow-high (0 8px 16px rgba(0,0,0,0.15))
SCSS+ 1 | Core buttons, avatars, social links, tag clouds, legacy form submits.
SCSS |
| Track B.1 | Tier 11–12 (Elevated)
SCSS | object-zoom

SCSS+ 1 | Static outer frame; inner asset expands (scale(1.08))
SCSS+ 2 | Outer wrapper receives $shadow-deep

SCSS+ 1 | Column images, Media & Text frames, custom image viewports.
SCSS |
| Track B.2 | Tier 11–12 (Elevated)
SCSS | object-grow

SCSS+ 1 | Subtle image expansion ($grow-small / scale(1.03))
SCSS+ 1 | Direct asset receives $shadow-deep

SCSS+ 1 | Gallery images, post featured media figures.
SCSS |
| Track B.3 | Tier 10 (Baseline)
SCSS | object

SCSS+ 1 | Vertical displacement lift ($shift-standard / translateY(-4px))
SCSS+ 1 | Direct asset receives $shadow-deep

SCSS+ 1 | Standalone linked images, standard content figures.
SCSS |
| Track C | Tier 20 (Container)
SCSS | card

SCSS+ 1 | Subtle container lift ($shift-subtle / translateY(-3px))
SCSS+ 1 | Container receives $shadow-deep

SCSS+ 1 | Group blocks, columns, and layout wells with background or custom borders.
SCSS |
  
  
## 3.4 Passenger-Zoom Mechanics & Structural Isolation (_02-resting.scss & _03-actions.scss)  
Media blocks assigned to the object-zoom role (such as column images and Media & Text blocks) enforce strict isolation between outer container visual styling and inner graphic scale transforms.  
  
**Passenger-Zoom Mechanics (Structural Isolation)**  

| Structural Layer | Key CSS Properties & Mixins | Architectural Function & Mechanical Behavior |
| ----------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Outer Visual Perimeter | %physics-zoom-wrapper-visuals

SCSS


• border-radius: var(--wp--custom--border--radius)

SCSS


• border: 1px solid var(--wp--custom--color--border)

SCSS


• padding: var(--wp--preset--spacing--20)

SCSS


• @include __blueprint-shadow-natural

SCSS | Holds the static visual container bounds (borders, default shadows, and inner frame padding). Strips borders and padding from the internal media element so outer layout geometry remains unclipped during animations.
SCSS+ 1 |
| Clipped Anchor Viewport | %physics-zoom-wrapper-clipped

SCSS


• position: relative

SCSS


• display: inline-block

SCSS


• vertical-align: middle

SCSS


• overflow: hidden

SCSS | Applied directly to the child <a> element. Binds absolute veil/overlay positioning contexts and traps the zooming media graphic within the internal frame without causing page layout reflow.
SCSS+ 1 |
| Dynamic Inner Radius | Applied to child > a:
SCSS


border-radius: clamp(calc(radius * 0.5), calc(radius - spacing), radius)

SCSS | Programmatically calculates the nested anchor's border radius relative to the outer container radius and frame padding, ensuring perfectly concentric curved corners.
SCSS |
| Inner Graphic Media | Applied to img, video:
SCSS


• border: none; padding: 0

SCSS


• border-radius: inherit; box-shadow: none

SCSS


• transform: scale(1.08)on hover/focus
SCSS+ 1 | Receives all kinetic scale transforms exclusively. Inherits clipped radius boundaries while keeping outer perimeter dimensions and shadows completely static.
SCSS+ 2 |
  
  
### Layout Containment Rules  
* **The Outer Wrapper (%physics-zoom-wrapper-visuals)**: Holds static layout geometry (borders, default natural shadows, $spacing-20 padding). Borders and padding are stripped from the inner <img> element.   
* **The Clipped Viewport (%physics-zoom-wrapper-clipped)**: Applied directly to the child <a> anchor, setting overflow: hidden and position: relative.   
* **Inner Asset Scaling (%physics-grow-large)**: Scaling transforms (scale(1.08)) apply exclusively to the inner <img> or <video> element, leaving the outer container dimensions unaffected.   
## 3.5 Collision Engine & Three-Tier Veto System (_40-vetos.scss)  
When interactive components are nested within an active parent card, the collision engine enforces structural vetoes to prevent compound transforms ("double-lift") or overlapping shadow states:  
  
SCSS  
```
// Veto Boundary Loop Execution (_40-vetos.scss)
@each $parent in $cards {
    // TRACK A: CARD-IN-CARD BOUNDARIES
    // Silences nested cards (e.g., inner columns/groups) inside a parent card
    @each $child-card in $cards {
        #{$parent}:hover #{$child-card} {
            @include phys.apply-silence($interactive: true); // Strips transform & shadow
        }
    }

    // TRACK B: OBJECT-IN-CARD BOUNDARIES
    // Silences nested layout objects inside an active parent card
    @each $child-object in $objects {
        #{$parent}:hover #{$child-object} {
            @include phys.apply-silence($interactive: true); // Strips transform & shadow
        }
    }

    // TRACK C: IMAGE-IN-CARD BOUNDARIES (Selective Veto)
    // Silences ONLY shadows on embedded images, preserving zoom/scale kinetics!
    @each $child-image in $images {
        #{$parent}:hover #{$child-image} {
            @include phys.apply-silence-shadow($interactive: true); // Strips shadow ONLY
        }
    }
} 

```
**Key Architectural Nuance**: Unlike structural containers which have all hover mechanics neutralized when nested (apply-silence), embedded image portals retain their internal zoom kinetic capabilities while their outer box shadows are suppressed (apply-silence-shadow).  
  
## 3.6 Layout Brakes & Global Theme Overrides (_02-global-overrides.scss)  
The engine includes system-level safeguards, accessibility adaptors, and specialized UI components outside the standard registry loops.  
  
### Layout Brakes & Rounding Stops (_00-config.scss)  
* **Hard Stop ($blocks-no-rounding)**: Hard-coded exclusion list (.wp-block-column, .wp-block-media-text__media, .wp-block-media-text__content) where the engine does not generate border-radius CSS. SCSS    
* **Conditional Stop ($blocks-layout-brakes)**: Specific style utility classes (.is-style-object-plain, .is-style-image-no-border, .is-style-no-gap *) that suppress active transforms and default shadows. SCSS+ 2    
### Accessibility Mechanics (prefers-reduced-motion)  
When reduced motion is requested by the user, CSS variable tokens are re-mapped dynamically:  
SCSS  
  
* Transition timing shifts from 250ms/500ms up to 500ms/800ms.   
* Scale growth transforms damp down from 1.05x / 1.08x to 1.01x / 1.04x.   
* Vertical displacement dampens from -3px / -4px down to -1px / -2px.   
### Interactive Card Arrow Badge Overlay (.lumina-card-arrow-overlay)  
Interactive cards (.is-interactive-card) support an absolute-positioned floating arrow overlay badge that neutralizes Gutenberg block-gap margins:  
  
SCSS  
```
/* Floating Arrow Overlay Styling */
.is-interactive-card {
    position: relative !important;
}

.lumina-card-arrow-overlay {
    position: absolute;
    margin: 0 !important; /* Neutralizes WP layout block-gap */
    top: var(--wp--preset--spacing--40, 1.5rem);
    right: var(--wp--preset--spacing--40, 1.5rem);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--wp--preset--color--foreground, #000000);
    color: var(--wp--preset--color--background, #ffffff);
    opacity: 0;
    transform: scale(0.65);
    transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1), 
                transform 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.is-interactive-card:hover > .lumina-card-arrow-overlay {
    opacity: 1;
    transform: scale(1);
} 

```
## 3.7 Visual Debug Engine Configuration  
When developer debugging is enabled ($lumina-debug: true), the engine draws color-coded outlines and offset indicators across the layout viewport:  
  
SCSS  
```
// Configuration Debug Parameters (_00-config.scss)
$lumina-debug: true;

$debug-registry:       1px dashed #ff8c00; // Orange: Registry active
$debug-wrapper:        1px dashed #ff8c00; // Orange: Clipped wrapper
$debug-wrapper-active: 1px solid  #ff00ff; // Purple: Wrapper hover active
$debug-card:           1px solid  #00ffff; // Cyan: Tier 20 Container Card
$debug-object:         1px solid  #00ffff; // Cyan: Tier 10 Layout Asset
$debug-button:         1px solid  #00ffff; // Cyan: Tier 30 Sovereign Button
$debug-silence:        1px dashed #ff3b30; // Red: Veto active (resting)
$debug-silence-active: 1px solid  #ff3b30; // Red: Veto active (hover) 

```
##   
# Lumina Charter: Section 4 - WordPress Core Governing Map  
  
## 4.1 Overview & WordPress Standards Alignment  
To ensure long-term maintainability, high performance, and seamless compatibility with WordPress Core, Lumina adheres strictly to official **WordPress Coding Standards (WPCS)** across all languages and file types. Every contribution—whether in PHP, JavaScript, SCSS/CSS, or JSON—must comply with strict sniffer rules, accessibility standards, and standard WordPress architectures.  
##   
## 4.2 SCSS & CSS Architecture Rules  
SCSS development follows five non-negotiable architectural rules derived from the Lumina Physics Engine (src/scss/):  
##   
## Rule 1: Sass Module System Enforcement (@use / @forward)  
Traditional @import statements are strictly banned to avoid global namespace pollution, duplicate CSS output, and circular dependency traps.  
* **Namespace Isolation**: All configuration settings and helper mixins must be imported explicitly via @use with local namespaces or aliases (e.g., @use '../engine/00-config' as config;). SCSS+ 4    
* **Public API Manifests**: Entry points and index files must expose functions and mixins explicitly using @forwardwith show directives (_index.scss). SCSS    
## Rule 2: Specificity Governance via Declarative Compilation  
No SCSS module may contain raw specificity overrides or !important flags to force style priority.  
  
* **Central Compiler Utility**: All dynamic selectors must pass through compile-selector() in _01-compiler.scss.   
* **Tier Bounds**: CSS selectors must strictly conform to their assigned Authority Tier (Tier 10 Objects 0,1,0, Tier 20 Cards 0,2,0, Tier 30 Sovereigns 0,3,0).   
* **Pseudo Wrappers**: Structural filters must be wrapped inside :is() and :not() pseudo-classes to keep compiled specificity scores flattened and mathematically predictable.   
## Rule 3: Defensive Schema Merging (map.merge)  
Block registry definitions inside SCSS maps must never require redundant key declarations.  
SCSS+ 3  
  
* Every loop iterating over $lumina-block-registry must merge target maps with $registry-defaults (_00-config.scss) before extracting properties. This guarantees that unassigned parameters safely inherit default values (such as trigger: 'self' or role: 'object') without throwing Sass compilation errors. SCSS+ 4    
## Rule 4: Gutenberg UI Safety & Variable Separation  
Theme styles must never break the WordPress Block Editor interface or create visual feedback loops.  
SCSS  
  
* **Banned Palette Patterns**: Dynamic or context-dependent tokens such as currentColor must **never** be registered as selectable circular color dots in theme.json.  
* **CSS Custom Property Abstraction**: Palette-agnostic dynamic tokens must be scoped strictly via developer-controlled CSS custom properties (--wp--custom--color--muted-text) or injected via class styles. SCSS    
## Rule 5: Single-Class Refactor Pattern for Visual Effects  
Complex visual effects (e.g., Liquid Glass, frosted glass, ambient depth badges) must be authored as single-class refactor blocks using pseudo-elements (::before and ::after):  
* **Parent Element (.is-style-*)**: Sets relative positioning, layout mode, text typography, base border-radius: inherit, and z-index positioning. SCSS    
* **::before (Backdrop Filter Layer)**: Manages backdrop blurs (backdrop-filter: blur()), background fills, opacity tints, and element isolation (isolation: isolate).  
* **::after (Edge Refraction Layer)**: Manages inset highlights (box-shadow: inset ...) and light refraction without requiring extra wrapper elements in the HTML DOM.  
## 4.3 JavaScript Engine Standards (lumina-physics.js)  
JavaScript in Lumina turns static WordPress Gutenberg blocks into intuitive, interactive surface areas while maintaining strict event isolation and client-side stability. All theme scripts must conform to the following jQuery coding standards:  
JS+ 1  
  
## Rule 1: Standard No-Conflict jQuery Wrapper  
All JavaScript files must wrap execution inside the standard WordPress no-conflict Immediately Invoked Function Expression (IIFE). Unscoped global variables or direct $() execution outside of this closure are prohibited.  
JS+ 1  
  
JavaScript  
  
```
// WordPress Standard jQuery IIFE Wrapper
( function( $ ) {
    $( document ).ready( function() {
        // Theme initialization logic
    } );
} )( jQuery );

```
## Rule 2: Dynamic Target Validation (getValidTarget)  
Before altering DOM classes, applying dynamic cursor styles (cursor: pointer), or attaching event interceptors to container blocks, scripts must run target elements through validation logic:  
JS  
  
* **Form Protection**: Containers containing interactive HTML forms, textareas, selects, or text inputs (form, input:not([type="hidden"]), textarea, select) must **never** be converted into card click targets. JS    
* **Single Interactive Target Guarantee**: Cards are validated only if they contain **exactly one** primary link or button ($buttons.length === 1 && $links.length === 0 or vice versa). Multi-link containers are ignored to prevent ambiguous navigation behavior. JS+ 1    
## Rule 3: Event Delegation & Interception Safety Valves  
To ensure compatibility with dynamic AJAX content loading, scripts must use delegated document listeners ($(document).on('click', selector, handler)):  
JS  
  
* **Safety Valve Interception**: When a user clicks directly on an inner button, anchor link, or form control nested inside an interactive card, the handler must immediately exit (return) and allow native browser navigation or smooth-scroll scripts to process the event naturally without infinite click loops. JS    
JavaScript  
  
```
// Safety Valve Guard Example
if ($(e.target).closest('button, a, .wp-element-button, input, select').length) {
    $card.removeClass('is-active');
    return; // Pass control to native element
}

```
## Rule 4: Touch-First Two-Tap Gesture Handling  
To eliminate mobile touch bugs (where hover states flicker or accidental link jumps occur during page scrolling), all card interactions must implement two-tap touch handling:  
JS  
  
* **Tap 1 (Activation)**: Tap 1 adds the .is-active state class, revealing visual badges (such as the .lumina-card-arrow-overlay)and suppressing immediate link navigation. SCSS+ 2    
* **Tap 2 (Execution)**: Tap 2 executes the actual navigation action. JS    
* **Scroll/Swipe Cancellation**: Listening to touchmove events immediately cancels pending tap activation flags (just-activated = false) so swiping or scrolling through content never triggers unintended card clicks. JS    
## Rule 5: Scoped Client-Side Preference Persistence (localStorage)  
Interactive UI components that retain user display states (such as HTML <details> disclosure accordions) must utilize localStorage with multi-tier key scoping:  
JS  
  
* **Page-Path & ID Scoping**: Keys must combine the sanitized window pathname, element identifier, and DOM loop index ('details_state_' + pagePath + '_' + elementIdentifier + '_' + index) so user settings do not bleed across different pages. JS    
* **Hash Anchor Override**: On page load, if window.location.hash targets an element nested inside a collapsed details block, the script must automatically force .prop('open', true) wrapped inside a defensive try/catch block. JS    
## 4.4 PHP & Full-Site Editing (FSE) Standards  
PHP code in Lumina forms the foundation for block registration, template hierarchy routing, and theme.json dynamic data filtering.  
## Rule 1: Strict WPCS Syntax & Namespace Rules  
* **Code Style**: All PHP files must pass WordPress Coding Standards via PHP_CodeSniffer (WordPress-Core, WordPress-Docs, WordPress-Extra).  
* **Strict Typing & Direct Access Protection**: All standalone PHP files must include direct-access prevention guards and declare strict types:  
PHP  
  
```
<?php
/**
 * Lumina Theme Functions
 *
 * @package Lumina
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

```
* **Global Namespace Prefixing**: All functions, classes, constants, and global hooks must carry the strict lumina_ or LUMINA_ prefix (e.g., lumina_setup(), LUMINA_VERSION).  
## Rule 2: FSE-Native Philosophy (Zero Legacy Bloat)  
* **No Custom Metaboxes**: Layout settings, color configurations, and spatial adjustments must rely exclusively on native Block Editor controls and theme.json capabilities.  
* **Block Style Registration**: Custom visual variants must be registered cleanly via register_block_style() with inline style dependencies or modular SCSS handles rather than heavy custom shortcodes or custom PHP render wrappers.  
## Rule 3: Context-Aware Escaping & Security  
* **Output Escaping**: Every PHP variable rendered in template parts or administrative panels must be escaped using context-specific functions (esc_html(), esc_attr(), esc_url(), wp_kses_post()).  
* **Database & Query Hygiene**: Raw database queries ($wpdb) are prohibited. Template data fetching must utilize native WordPress WP_Query instances or Gutenberg block data bindings.  
## 4.5 Code Quality Compliance Matrix  
Before any pull request or theme update is merged into the Lumina codebase, it must pass the following multi-layer validation matrix:  

| Layer / File Type | Tooling / Engine | Key Verification Requirement | Success Criteria |
| ----------------- | ------------------------------- | ----------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------- |
| PHP | PHP_CodeSniffer (WPCS) | Strict typing, prefixing (lumina_), zero unescaped output, WPCS compliance. | 0 Errors / 0 Warnings |
| SCSS / CSS | Stylelint / Sass Compiler | Sass Module compliance (@use), specificity score alignment (Tiers 10–30), zero !important rules.
SCSS+ 2 | Clean compilation without deprecated imports.
SCSS+ 2 |
| JavaScript | WordPress jQuery Standards | WP IIFE wrapper, getValidTarget form protection, mobile two-tap touch isolation, scoped localStorage persistence.
JS+ 3 | Smooth card navigation, zero recursion loops.
JS |
| JSON | theme.json Schema Validator | WCAG AA color pair validation, Settings/Styles separation, zero currentColor selectable palette dots.
SCSS+ 1 | Valid WP 6.x JSON Schema confirmation. |
| Kinetics Engine | Visual Debugger ($lumina-debug) | Correct role outline assignment, proper parent-child veto execution (apply-silence).
SCSS+ 2 | Zero double-lift artifacts in visual inspector.
SCSS+ 2 |
  
