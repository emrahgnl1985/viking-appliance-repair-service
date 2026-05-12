# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What This Is

A WordPress theme (`Samsung Appliance Repair`) for appliance repair businesses. Pure PHP/CSS/JS — no build tools, no npm, no Composer. Requires WordPress 6.0+ and PHP 8.0+. Deploy by uploading to `/wp-content/themes/` and activating.

Required plugins: **Advanced Custom Fields (ACF)**, **Yoast SEO** or **RankMath**, a caching plugin.

## No Build Step

There is no build process. Edit PHP, CSS, and JS files directly. Increment `AR_VERSION` in `functions.php` to bust asset caches after CSS/JS changes.

## Architecture

All theme logic lives in `functions.php` (CPT registration, taxonomies, rewrite rules, enqueue, AJAX handler, helpers, settings page). The files in `inc/` (`schema-markup.php`, `seo-meta.php`) are stubs — the actual implementations are in `functions.php`.

**Template routing** is handled by a `template_include` filter, not standard WordPress hierarchy. CPT singles map to `templates/template-{type}.php`; CPT archives map to `templates/archive-{type}.php`.

**Custom Post Types** and their URL slugs:
- `service_page` → `/services/`
- `location_page` → `/locations/`
- `error_code` → `/error-codes/` (nested: `/error-codes/{appliance}/{slug}/`)
- `guide` → `/guides/`
- `recall` → `/recalls/`
- `appointment_lead` → private, admin-only

**Taxonomies:** `brand` (flat), `appliance_type` (hierarchical), `city` (hierarchical), `blog_category`.

**ACF field groups** are stored in `acf-json/` and sync automatically. ACF meta keys use `_ar_` prefix (e.g., `_ar_brand`, `_ar_city`, `_ar_error_code`).

**Theme settings** (phone, business name, address, email, license) are stored in `wp_options` with `ar_` prefix. Read via helpers: `ar_get_phone()`, `ar_get_business_name()`.

## CSS Architecture

CSS loads in dependency order: `variables.css` → `base.css` → `components.css` → `templates.css`. Design tokens (colors, spacing, type) are defined as CSS custom properties in `assets/css/variables.css`. Editor styles come from `assets/css/editor.css`.

## JavaScript

`assets/js/main.js` is vanilla JS (no jQuery). It receives `arAjax` (url, nonce, phone) via `wp_localize_script`. The AJAX action for the appointment form is `ar_appointment` (handler: `ar_handle_form` in `functions.php`).

## Reusable Parts

Three template parts in `parts/` called via wrapper functions:
- `ar_trust_bar()` — renders `parts/trust-bar.php`
- `ar_appointment_form(string $context, string $heading)` — renders `parts/appointment-form.php`
- `ar_faq_section(array $faqs, string $heading)` — renders `parts/faq-accordion.php`

Schema JSON-LD is output via `ar_output_schema(array $schema)` which calls `wp_json_encode` and echoes a `<script type="application/ld+json">` block.

## SEO / Schema Behaviour

`ar_output_seo_meta()` only fires when neither Yoast (`WPSEO_VERSION`) nor RankMath (`RANK_MATH_VERSION`) is active. Schema JSON-LD is always output independently of SEO plugins.

The `ar_disclaimer()` function must be called in every template — it outputs the required independent-service notice.

## After Changing Permalinks / Adding CPTs

Always go to **Settings → Permalinks → Save Changes** to flush rewrite rules. On theme activation this happens automatically via `flush_rewrite_rules()`.

## ACF Field Sync

If ACF field groups don't appear in the editor, go to **Custom Fields → Tools → Sync** and sync all groups from `acf-json/`.
