# Site images — drop-in guide

The homepage auto-detects these files. Add a file with the exact name below and
it replaces the placeholder automatically (no code changes). Until then, an
elegant labeled placeholder shows in its place.

## Expected filenames (site root: `assets/img/`)

| File                 | Where it appears            | Suggested size (px)      |
|----------------------|-----------------------------|--------------------------|
| `hero.jpg`           | Full-bleed hero background  | 2400 × 1400 (landscape)  |
| `studio.jpg`         | "Welcome" section           | 1200 × 1500 (portrait)   |
| `artist.jpg`         | "Meet Your Artist" section  | 1400 × 1600 (portrait)   |
| `cta.jpg`            | Final CTA background        | 2400 × 1200 (landscape)  |
| `og-default.jpg`     | Social share preview (Open Graph/Twitter) | **1200 × 630** (exact) |
| `portfolio-01.jpg` … `portfolio-08.jpg` | Home portfolio carousel + lightbox | 1200 × 1600 (portrait) |

Home page uses **6–8** portfolio images (per the brief). The full set goes on
the Portfolio page, built later.

## How the portfolio images behave (per Carlos)
- The **on-page thumbnail is styled with CSS only** (subtle grayscale/contrast that
  lifts to full colour on hover). The source file is never altered.
- **Clicking a thumbnail opens the untouched original at full size** in a lightbox
  (arrow keys / swipe to move between pieces, Esc to close).
- Because one file serves both, export each portfolio image at a good full-size
  resolution (~1200–1600px long edge) and let the browser scale the thumbnail.

## Preparing the Drive files (they are NOT web-ready yet)
The Drive folder holds ~47 originals mixing **DNG (raw), HEIC, PNG and large JPGs**
(up to ~7 MB). Before adding them here:
1. **Pick 6–8** strongest pieces for the home page.
2. **Convert** HEIC/DNG → JPG (or WebP).
3. **Resize** to the sizes above and **compress** (aim < 300 KB each; hero/cta can
   be a bit larger). Tools: Squoosh, ImageOptim, `cwebp`, or `sips`/ImageMagick.
4. Rename to the filenames in the table and drop them in this folder.

Keep raw/unoptimized drops out of git — put them in `assets/img/raw/` (git-ignored).
