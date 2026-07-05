# Lumina Theme Project Charter  
  
## Lumina Charter: Section 1 - Project Vision & Objectives  
***v0.9.8 NEEDS UPDATES FOR v09.9***  
  
### 1.1 The "Modern Post-Flat Era" (Flat 3.0)  
  
Lumina defines the next evolution of web aesthetics by moving past the sterile, functional constraints of the early flat design era. It introduces **Flat 3.0**, a highly disciplined visual system where structural minimalism meets realistic ambient lighting, depth, and kinetic responsiveness. Lumina does not rely on heavy skeuomorphic textures; instead, it establishes an intentional digital physics engine that leverages the natural properties of light, transparency, and motion to create a premium, tactile, and highly interactive user experience.  
  
### 1.2 Mood-Based Global Theme Styles  
  
Rather than enforcing static, rigid design patterns, Lumina is architected around the concept of **Mood-Based Global Styles**. Every aesthetic element—including subtle monochromatic variations, targeted font pairings, and sophisticated visual effects like glassmorphism and liquid glass—adapts contextually to evoke specific user emotions. Color palettes shift through highly intentional variations, anchoring complex box-shadow layering and structural depth to perfectly complement the emotional and functional tone of the content.  
  
### 1.3 Objectives & Technical Philosophy  
  
• **Dynamic Opt-In Physics:** Build a completely non-destructive engine where kinetic animations, micro-interactions, and visual transitions are injected via an advanced, opt-in layer without polluting standard WordPress Core HTML or raw block configurations.  
  
• **Ambient Depth & Interactivity:** Use multi-layered box shadows, responsive translation offsets, and controlled physics to mimic realistic physical interaction, providing continuous visual feedback as the user navigates.  
  
• **Cascade Isolation:** Ensure complete separation between functional layouts and advanced interactive design tokens through clean specificity ceiling rules.  
  
## Lumina Charter: Section 2 - Lumina Theme Guidelines  
  
To preserve the visual integrity of the "Modern Post-Flat Era" (Flat 3.0), the theme adheres to strict design and structural constraints:  
  
### 2.1 **The Ambient Light Model:**   
All depth effects, structural shadows, and edge highlights must follow a single, unified directional light source. Box-shadow layering must utilize multiple transparent offsets rather than a single dark blur.  
  
### 2.2 **True Neutral Palette Control:**   
Mood-based color variations must derive from a calculated scale of true neutrals and muted tones. High-chroma saturated colors are forbidden in background layers; they are reserved strictly for intentional accents.  
  
### 2.3. **Typography Structural Integrity:**   
Font pairings must balance high-contrast weight distributions. Large headings are locked to intentional fluid scales, while reading layers preserve line-length boundaries (60-75 characters) to ensure readability across all viewports.  
  
### 2.4. **The Kinetic Continuity Guardrail:**   
No movement, scaling, or interactive translation offset can occur instantly. Every hover, focus, and exit animation must follow unified timing functions and duration tokens defined in the config.  
  
## Lumina Charter: Section 3 - Lumina Physics Engine Guidelines  
  
**Hard Line Stance on Specificity by Role**. Returning to this foundational logic is exactly how we solve the nested dard lift without breaking the system or escalating weights arbitrarily.  
The entire principle rests on giving every single role in the engine an immutable, programmatic **Specificity Tier**. We do this by controlling exactly how many raw class tokens sit *outside* of the flattening :where() wrapper.  
  
## The Strict Specificity Scale Blueprint  
By enforcing these exact scores across your files, the browser handles cascade victories automatically, entirely eliminating the need for !important hacks.  
  
**Tier 10: Objects & Floors (Score: 0,1,0 — 10 Points)**  
Objects and basic Floor anchors represent the baseline elements of your site. They must carry exactly **one** primary class weight.  
* **The Rule:** Only the raw $trigger class sits outside :where(). Gates and filters are completely flattened inside.  
* **The Compiled Output Examples:**  
    * .wp-block-column:where(:is(.has-background):not(.alignfull)) → **10 points**  
    * .is-style-object-plain → **10 points**  
  
**Tier 11: Object Portals / Images (Score: 0,1,1 to 0,1,2 — 11-12 Points)**  
Images and linked portals need a tiny single-digit tie-breaker advantage to cleanly execute bounded scales over their static states, which is why their loop checks for the tag (img or a > img) on the outside of the gate structure.  
* **The Compiled Output Example:** * .wp-block-image:where() img → **11 points**  
  
**Tier 20: Cards / Containers (Score: 0,2,0 — 20 Points)**  
Cards are massive layout boxes (Groups, Columns, Media-Texts). They must *always* carry exactly **two** class weights on the outside of the gate so they natively crush object actions sitting inside them.  
* **The Rule:** The primary $trigger class **AND** the dynamic $gate (like .has-background) must both stand outside :where(). Only the $filter state stays hidden inside.  
* **The Compiled Output Example:**  
    * .wp-block-group.has-background:where(:not(.alignfull)) → **20 points**  
  
**Tier 21: The Programmatic Floor Wildcard (Score: 0,2,1 — 21 Points)**  
This is where the magic happens. By structuring Track B in your floors loop to match the Card tier weight (0,2,0) and appending the descendant wildcard attribute selector ([class*=wp-block-]), the resulting score instantly scales to **21 points**.  
* **The Compiled Output Example:**  
    * .wp-block-media-text.has-background:where(:not(.alignfull)) [class*=wp-block-] → **21 points**  
Because **21 points** cleanly defeats a child dard's independent **20 points**, the parent container effortlessly commands its nested groups to freeze, eliminating the double-lift naturally!  
  
**Tier 30: Buttons (Score: 0,3,0 — 30 Points)**  
Buttons are high-intent interactive buttons or icons. They stand completely outside of protective wrappers to assert total authority over the page cascade.  
* **The Compiled Output Example:**  
    * .wp-block-button__link → **30 points**  
  

| Role Entry | Compiled Selector Target Example | Rest Spec | Hover Spec | Tier Level & Authority |
| ----------------- | ---------------------------------------------------------- | --------- | ---------- | ------------------------------------------------------------------------------------------ |
| Object | .wp-block-paragraph

.wp-block-image | 10 | 11 | Tier 10 (Baseline)

Standard internal content assets; easily tamed. |
| Portal (Promoted) | .wp-block-image:has(a):hover

a:has(.wp-block-image):hover | 11 / 12 | 21 / 22 | Tier 11-12 (Elevated)

Interactive content links engineered to beat standard objects. |
| Card-by-Attribute | .wp-block-group:is(.has-background) | 20 | 21 | Tier 20 (Kinetic Containers)

Global block wrappers carrying structural color traits. |
| Card-by-Class | .wp-block-group.is-style-rounded-border | 20 | 21 | Tier 20 (Kinetic Containers)

Custom block styles engineered to match attribute cards. |
| Button Link | .wp-site-blocks ... .wp-element-button | 30 | 40 | Tier 30+ (Fast-Pass Authority)

Absolute freedom layout-blind; shatters all floor freezes. |
  
## Lumina Charter: Section 4: WordPress Core Governing Map  
  
  
  
## Most Interesting things to animate  
- [ ] Always Button  
    - [ ] Buttons => Grow  
    - [ ] Social Links => Grow  
- [ ] Conditional Button  
    - [ ] Images w/Links => Zoom (overflow:hidden)  
    - [ ] Images w/Lightbox => Zoom (overflow:hidden)  
    - [ ] [Tag-cloud-link.is](http://Tag-cloud-link.is)-outline? => Grow  
    - [ ] wp-block-post-featured-image:has(a) => Zoom (overflow:hidden)  
    - [ ] Wp-block-latest-posts__featured-image:has(a) => Zoom  
    - [ ] Wp-block-avatar:has(a) => Grow  
    - [ ] .wp-block-latest-comments__comment:has(a)  
    - [ ] .wp-block-post-author__avatar:has(a)  
- [ ] Always Cards  
    - [ ] Is-style-rounded-border  
    - [ ] Is-style-rounded-corners  
    - [ ] Is-style-object-passive  
    - [ ] Is-style-thick-rounded-border  
- [ ] Conditional Cards  
    - [ ] Wp-block-group.has-background  
    - [ ] wp-block-columns.has-background  
    - [ ] Wp-block-column.has-background  
    - [ ] Table Cells (or whatever is colored: rows or columns?).has-background  
- [ ] Never Animate ($lumina-static-floors)  
    - [ ] Alignfull  
    - [ ] Is-style-object-plain  
  
## Physics Engine Rules  
1. Cards are detected first based on classes that are always cards or containers with background color but we don’t treat them as cards if full-width. So,   
    1. We ignore full-width containers (.alignfull) and is-style-object-plain.  
    2. We don’t add padding or rounded corners to the always dard classes so that the user can style these.  
    3. For the ones being promoted to cards We lightly style them with padding and rounded corners.  
2. Buttons (buttons and button-like blocks) are *always* 100% of the time activated. Even if full-width (and we won’t add a custom class of is-style-object-plain for them)  
3. Images are tagged as “object” in the physics map (wp-block-image, wp-block-gallery wp-block-image, featured post images, etc.). They are complex and should have their own logic in the engine that is similar in principle to cards, but based on different “promotion” criteria. They will behave one of two ways:  
    1. If they are links, then they are promoted to Button, meaning always active regardless of parent.   
    2. If thy are not links, then they animate when not in a dard only. If in a dard, they “stand down”. If we were to leave them static, then a user scrolling through page content is going to get “bored” in colored edge-to-edge sections that aren’t cards. In Lumina, our block patterns should be designed specifically to “train” the user on how to build patterns that work *with* the engine as opposed to against it (i.e. most patterns *not* full-width so the containers are cards), but we can’t force this on users that want to have static colored sections.   
    3. We do need some way to make sure the user isn’t confused on what images are decoration and just slightly reacting to touch versus ready to leap into action. We can’t rely on resting shadow because images on dark backgrounds, they won’t be visible. We can’t just add a border to the linked ones because images could have borders already. Unless we handle images similar to cards but we use .has-border instead of has-background. We could also have always-bordered css classes for images in the map. We could potentially remove the border on images that aren’t links but that may irritate users. We are currently growing linked images, but it would be much better if could have them “zoom-in in place” (set overflow hidden on the figure wp-block-image and zoom the image itself). With Grow, we have to deal with the caption within the wp-block-image too. With zoom in place, we should be able to handle the caption somehow.  
4. Non-Image objects (e.g. wp-block-column, wp-block-table rows/columns/cells) are “object” in the physics map. These won’t have links so the logic is simpler.  
    1. If in a dard, they stand down.  
    2. If not in a dard, they are allowed to animate.  
  
## Physics Engine Components  
5. The registry (almos-engine.css)  
    1. Will use low specificity to set resting transitions and transforms (and debug outlines). It has “weed out” logic to apply these only to things that will be animated for sure or are highly likely to be.   
6. The animation (atoms-interactions.css)  
    1. :hover will be applied to the *exact same* selectors above so there are always fluid animations.  
7. The veto  
    1. When there are complex rules around conditional promotion of buttons or images or objects, we will use just slightly higher specificity to “stand down” the ones we aren’t promoting. This keeps the hornets nests of css selectors down. We will avoid using !important if it all possible. We should focus on leveraging how CSS cascades.   
  
## Lumina Charter: Section 5 - Coding Rules & Protocols  
  
### 5.1. Rule of the Ceiling  
No selector written in any layer below Layer 6 may ever exceed **31 points** of specificity unless using explicit opt-in overrides.  
  
### 5.2. The Direct Target Principle  
Always apply transitions directly to the specific DOM element being animated (`, `) rather than transforming the parent layout container (`<figure>`, ``).  
  
### 5.3. No Phantom Nesting  
Avoid chaining arbitrary layout classes to the front of target selectors. If a component lives standalone in the DOM, target it directly using `:is()` to keep the cascade math uniform.  
  
### 5.4 No overly broad wildcards  
Scanners must explicitly match specific background, border, and shadow properties (e.g., [class*="has-background"]) rather than using short catch-alls like [class*="has-"].  
  
  
### Token System  
- Duration: var(--wp--custom--animation--duration--normal, 250ms)  
- Timing: var(--wp--custom--animation--timing-function, cubic-bezier(0.4, 0, 0.2, 1))  
- Transform: var(--wp--custom--animation--default--object-transform, translateY(-4px))  
- Resting Shadow: var(--wp--custom--shadow--default, var(--wp--custom--shadow--natural, 0 2px 8px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.08)))  
- Hover Shadow: var(--wp--custom--shadow--hover, var(--wp--custom--shadow--deep, 0 8px 16px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.10)))  
