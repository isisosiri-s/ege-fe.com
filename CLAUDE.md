# CLAUDE.md — Frontend Website Rules (ege-fe.com)

## Always Do First
- **Invoke the `frontend-design` skill** before writing any frontend code, every session, no exceptions. If it is not installed in the session, say so and apply the rules in this file directly.

## Project Shape (overrides generic defaults below)
- This is a multi-page PHP site in `site/` (not a single `index.html`). Shared parts live in `site/inc/` (header, footer, forms, CTA).
- `site/**/index.php`, `site/inc/meta.php`, `hizmetler.php`, `hub-giris.php`, `blog.php` and `sitemap.xml` are **generated** by `node tools/build.mjs` from `kaynak/` — change the generator/sources, not the output, or edits will be overwritten.
- `site/css/style.css` and `site/js/site.js` are hand-maintained — style changes go there.
- Content is real (scraped from the live site). Do not use placeholder copy or `placehold.co` images; do not invent facts — ask.
- Icons: Tabler Icons only, self-hosted in `site/img/ikon/` (no emoji / text arrows / other libraries).
- Fonts are self-hosted (`site/fonts/`, `site/css/fonts.css`); do not load Google Fonts or any other external resource.

## Reference Images
- If a reference image is provided: match layout, spacing, typography, and color exactly. Keep the site's real content. Do not improve or add to the design.
- If no reference image: design with high craft (see guardrails below).
- Screenshot your output, compare, fix mismatches, re-screenshot. Do at least 2 comparison rounds. Stop only when no visible differences remain or user says so.

## Local Server
- **Always serve on localhost** — never screenshot a `file:///` URL (PHP won't run there anyway).
- Start the dev server: `node serve.mjs` → `http://localhost:3000` (PHP built-in server on `site/` with `tools/dev-router.php`, which mimics the live `.htaccess`).
- Start it in the background before taking any screenshots. If it is already running, `serve.mjs` exits without starting a second instance.
- `npm run dev` (port 8080) is the older equivalent; prefer port 3000.

## Screenshot Workflow
- Uses **Playwright** (installed in `node_modules/`), not Puppeteer.
- `node screenshot.mjs http://localhost:3000/<path>/ [label] [--mobil]` → `./temporary screenshots/screenshot-N[-label].png` (auto-incremented, never overwritten). `--mobil` = 390×844, default = 1366×900.
- `php -S` is single-threaded: the script scrolls slowly and waits for visible images. Empty image boxes in a screenshot are usually a loading/timing issue — verify in the browser before touching CSS.
- After screenshotting, read the PNG with the Read tool.
- Check at least: homepage, a service page, `/blog/`, a blog post, and mobile.
- When comparing, be specific: "heading is 32px but reference shows ~24px", "card gap is 16px but should be 24px".
- Check: spacing/padding, font size/weight/line-height, colors (exact hex), alignment, border-radius, shadows, image sizing.

## Output Defaults
- Custom CSS with CSS variables (no Tailwind). Tokens live in `:root` of `site/css/style.css`: colors (brand), `--b-1…--b-11` spacing, `--golge-1/2/3` shadows, `--yay`/`--yumusak` easing, `--gren` grain, `--izleme-*` tracking.
- Use existing tokens; add new ones to `:root` rather than hard-coding values.
- Mobile-first responsive; the mobile menu is `position: fixed` inside the header.

## Brand Assets
- Always check the `brand_guideline/` folder before designing (`Egefe-sirket-kimlik-rehberi.html`).
- Use the exact palette from the guideline — do not invent brand colors. `--gold` is in the guideline's `:root` but not its palette → not used.
- Logo: `site/img/logo.png` on light backgrounds, `site/img/logo-koyu.png` on dark; no effects, no white box.

## Anti-Generic Guardrails
- **Colors:** Brand palette only. Never default Tailwind colors.
- **Shadows:** Layered, teal-deep–tinted, low opacity (`--golge-1` elevated, `--golge-2` stronger, `--golge-3` floating/hover). Never a single flat shadow.
- **Typography:** DM Serif Display (headings) + Nunito Sans (body). Tight tracking on large headings (`--izleme-buyuk: -0.03em`, h2 `-0.02em`), body line-height `1.7`.
- **Gradients:** Layer multiple radial gradients (patterns from the brand guideline) + grain via the SVG noise `--gren` on a `::before` layer (`.acilis`, `.sayfa-bas`, `.bolum-koyu`, `.cta`, `.site-alt`).
- **Animations:** Only animate `transform` and `opacity`. Never `transition-all`. Spring easing `--yay`. Hover shadows fade in via a pseudo-element's `opacity`, not by transitioning `box-shadow`. Exception: dropdown `visibility` flips instantly (not animated) so hidden menus stay out of keyboard focus.
- **Interactive states:** Every clickable element needs hover, focus-visible, and active states. No exceptions.
- **Images:** Photos get a bottom dark gradient overlay (`rgba(0,0,0,.6)` → transparent) and a `--teal-deep` `mix-blend-mode: multiply` layer (hero, blog cards, blog post cover). **Not** on in-content figures or service page banners — they contain product shots/text that must stay legible.
- **Spacing:** Only the `--b-*` scale and the section tokens (`--bolum-y`, `--bolum-y-ince`, `--izgara-bosluk`, `--kenar-bosluk`).
- **Depth:** base (page) → elevated (cards, boxes) → floating (header, dropdowns); z-index via `--z-*` tokens.
- **No `backdrop-filter` on the header** — it traps the fixed mobile menu inside the header.

## Hard Rules
- Do not add sections, features, or content that are not on the site / in the reference
- Do not "improve" a reference design — match it
- Do not stop after one screenshot pass
- Do not use `transition-all`
- Do not use default Tailwind blue/indigo as primary color
- Do not edit generated files in `site/` directly — use `tools/build.mjs`
