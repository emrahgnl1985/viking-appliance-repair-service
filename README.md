# Viking Appliance Repair — WordPress Theme

A WordPress theme for independent appliance repair businesses operating in the US market. Covers multiple brands (Bosch, Electrolux, Frigidaire, KitchenAid, LG, Maytag, Viking, Whirlpool) and appliance types (Washer, Dryer, Dishwasher, Refrigerator, Oven/Range). Built with pure PHP/CSS/JS — no build tools required.

---

## 1. Project Overview

| Item | Detail |
|------|--------|
| Theme Name | Viking Appliance Repair |
| WordPress | 6.0+ |
| PHP | 8.0+ |
| Build step | None — edit files directly |
| Required plugins | Advanced Custom Fields (ACF), Yoast SEO or RankMath |
| Markets | United States only |

### Brands Covered

- Bosch, Electrolux, Frigidaire, KitchenAid, LG, Maytag, Viking, Whirlpool

### Appliance Types

- Washer, Dryer, Dishwasher, Refrigerator, Oven/Range

### Content at a Glance

- **Services pages** — one per brand × appliance type combination (e.g., Bosch Dishwasher Repair, LG Washer Repair)
- **Error code pages** — one per error code per brand (e.g., Bosch E22, Viking 4E, LG OE)
- **Location pages** — one per service city
- **Guides** — how-to repair and maintenance articles
- **Recalls** — CPSC-sourced recall notices

### URL Structure

```
/services/                          ← service archive
/services/{brand}-{appliance}-repair/

/error-codes/                       ← error code archive
/error-codes/{appliance}/{slug}/    ← single error code

/locations/                         ← location archive
/locations/{city}/

/guides/                            ← guides archive
/guides/{slug}/

/recalls/                           ← recalls archive
/recalls/{slug}/
```

---

## 2. File Structure

```
wp-appliancerepair-theme/
│
├── style.css                   ← Theme header (name, version, description)
├── functions.php               ← ALL theme logic (CPTs, taxonomies, enqueue, AJAX, helpers, settings)
├── index.php                   ← Fallback template
├── front-page.php              ← Homepage template
├── archive.php                 ← Generic archive fallback
├── single.php                  ← Generic single fallback
├── header.php                  ← Shared <head>, nav, sticky CTA
├── footer.php                  ← Shared footer with schema, scripts
│
├── templates/
│   ├── template-service.php        ← Single service page
│   ├── template-location.php       ← Single location page
│   ├── template-error-code.php     ← Single error code page
│   ├── template-guide.php          ← Single guide page
│   ├── template-recall.php         ← Single recall page
│   ├── archive-service.php         ← Service archive (by brand)
│   ├── archive-location.php        ← Location archive (by city)
│   ├── archive-error-code.php      ← Error code archive (grouped by appliance)
│   ├── archive-guide.php           ← Guides archive
│   └── archive-recall.php          ← Recalls archive
│
├── parts/
│   ├── trust-bar.php               ← Trust signal bar (ratings, warranty, years)
│   ├── appointment-form.php        ← Lead capture form
│   └── faq-accordion.php           ← FAQ accordion component
│
├── inc/
│   ├── all-brands-error-codes-data.php   ← Error code content (one function per brand)
│   ├── all-brands-content-data.php       ← Service page content (one function per brand)
│   ├── schema-markup.php                 ← Stub (logic lives in functions.php)
│   └── seo-meta.php                      ← Stub (logic lives in functions.php)
│
├── acf-json/
│   └── *.json                      ← ACF field group definitions (auto-synced)
│
└── assets/
    ├── css/
    │   ├── variables.css           ← Design tokens (colors, spacing, typography)
    │   ├── base.css                ← Reset, body, typography base
    │   ├── components.css          ← Reusable UI components
    │   ├── templates.css           ← Page-specific template styles
    │   └── editor.css              ← Block editor styles
    └── js/
        └── main.js                 ← Vanilla JS (forms, accordion, sticky nav)
```

---

## 3. Architecture

### No Build Step

There is no webpack, Vite, npm, or Composer. Edit PHP, CSS, and JS files directly. After changing CSS or JS, bump `AR_VERSION` in `functions.php` to bust browser caches:

```php
define('AR_VERSION', '1.3.0');
```

### Functions-First Design

All theme logic lives in `functions.php`:
- Custom Post Type registration
- Taxonomy registration
- Rewrite rules
- Asset enqueue
- AJAX handler (`ar_handle_form`)
- All helper functions (`ar_get_phone()`, `ar_disclaimer()`, etc.)
- Theme settings page (under Appearance → Theme Settings)
- Schema JSON-LD output
- SEO meta tag output

The files in `inc/schema-markup.php` and `inc/seo-meta.php` are stubs only — do not add logic there.

### Template Routing

Standard WordPress template hierarchy is **bypassed**. A `template_include` filter maps CPT singles and archives to the correct file:

```
CPT single  → templates/template-{post_type}.php
CPT archive → templates/archive-{post_type}.php
```

Exception: `error_code` singles use nested URLs (`/error-codes/{appliance}/{slug}/`) handled via custom rewrite rules.

---

## 4. Custom Post Types

| Post Type | Slug | Archive URL | Template |
|-----------|------|-------------|----------|
| `service_page` | `/services/` | `/services/` | `templates/template-service.php` |
| `location_page` | `/locations/` | `/locations/` | `templates/template-location.php` |
| `error_code` | `/error-codes/` | `/error-codes/` | `templates/template-error-code.php` |
| `guide` | `/guides/` | `/guides/` | `templates/template-guide.php` |
| `recall` | `/recalls/` | `/recalls/` | `templates/template-recall.php` |
| `appointment_lead` | private | admin-only | — |

### error_code Nested URLs

Error code pages use a two-level URL:
```
/error-codes/{appliance-slug}/{error-code-slug}/
```
Example: `/error-codes/dishwasher/bosch-e22-error-code/`

This is handled by custom rewrite rules registered in `functions.php`. After adding new appliance types, always flush rewrite rules at **Settings → Permalinks → Save Changes**.

---

## 5. Taxonomies

| Taxonomy | Type | Used By | Description |
|----------|------|---------|-------------|
| `brand` | Flat | `service_page`, `error_code`, `guide`, `recall` | Appliance brand (Bosch, LG, etc.) |
| `appliance_type` | Hierarchical | `service_page`, `error_code`, `guide` | Appliance category (Washer, Dryer, etc.) |
| `city` | Hierarchical | `location_page` | Service city |
| `blog_category` | Flat | `guide` | Guide category |

---

## 6. ACF Meta Fields

ACF fields use the `_ar_` prefix. Field groups are defined in `acf-json/` and sync automatically.

### service_page

| Field Key | Type | Description |
|-----------|------|-------------|
| `_ar_brand` | text | Brand name |
| `_ar_appliance_type` | text | Appliance type label |
| `_ar_intro` | textarea | Intro paragraph |
| `_ar_services_list` | repeater | List of services offered |
| `_ar_why_us` | textarea | Why choose us section |
| `_ar_faqs` | repeater | FAQs (question + answer) |

### error_code

| Field Key | Type | Description |
|-----------|------|-------------|
| `_ar_brand` | text | Brand name |
| `_ar_appliance_type` | text | Appliance type |
| `_ar_error_code` | text | The error code (e.g., E22, F8 E1) |
| `_ar_code_meaning` | textarea | Full explanation of the error code |
| `_ar_causes` | repeater | Causes (title + description) |
| `_ar_diy_steps` | repeater | DIY troubleshooting steps |
| `_ar_cost_range` | text | Estimated repair cost (e.g., $145 – $385) |
| `_ar_faqs` | repeater | FAQs |
| `_ar_us_models` | text | US model numbers affected |

### location_page

| Field Key | Type | Description |
|-----------|------|-------------|
| `_ar_city` | text | City name |
| `_ar_state` | text | State abbreviation |
| `_ar_zip_codes` | text | Zip codes served |
| `_ar_neighborhoods` | textarea | Neighborhoods/areas covered |
| `_ar_intro` | textarea | City intro paragraph |
| `_ar_faqs` | repeater | Local FAQs |

### guide

| Field Key | Type | Description |
|-----------|------|-------------|
| `_ar_brand` | text | Brand name (if brand-specific) |
| `_ar_appliance_type` | text | Appliance type |
| `_ar_intro` | textarea | Guide introduction |
| `_ar_steps` | repeater | How-to steps |
| `_ar_faqs` | repeater | FAQs |

---

## 7. Template Routing Detail

The `template_include` filter in `functions.php` runs on every request:

```php
add_filter('template_include', function($template) {
    if (is_singular('service_page'))   return get_template_directory() . '/templates/template-service.php';
    if (is_singular('error_code'))     return get_template_directory() . '/templates/template-error-code.php';
    if (is_singular('location_page'))  return get_template_directory() . '/templates/template-location.php';
    if (is_singular('guide'))          return get_template_directory() . '/templates/template-guide.php';
    if (is_singular('recall'))         return get_template_directory() . '/templates/template-recall.php';
    if (is_post_type_archive('service_page'))  return get_template_directory() . '/templates/archive-service.php';
    if (is_post_type_archive('error_code'))    return get_template_directory() . '/templates/archive-error-code.php';
    if (is_post_type_archive('location_page')) return get_template_directory() . '/templates/archive-location.php';
    if (is_post_type_archive('guide'))         return get_template_directory() . '/templates/archive-guide.php';
    if (is_post_type_archive('recall'))        return get_template_directory() . '/templates/archive-recall.php';
    return $template;
});
```

---

## 8. CSS Architecture

CSS loads in dependency order via `wp_enqueue_style`:

```
variables.css  →  base.css  →  components.css  →  templates.css
```

### Design Tokens (variables.css)

All colors, spacing, border-radius, and typography scale are defined as CSS custom properties:

```css
--color-primary: #be1622;       /* Brand red */
--color-accent: #be1622;
--color-dark: #1a1a1a;
--color-text: #333;
--color-muted: #666;
--color-bg: #f8f8f8;
--color-white: #fff;

--space-1 through --space-20    /* 4px base scale */
--radius-sm / --radius-md / --radius-lg
--font-sans / --font-heading
--shadow-sm / --shadow-md / --shadow-lg
```

### Fonts

- Headings: Inter (Google Fonts, loaded in `header.php`)
- Body: System font stack

### Editor Styles

`assets/css/editor.css` mirrors key design tokens so the block editor matches the front end.

---

## 9. JavaScript

`assets/js/main.js` is vanilla JS — no jQuery, no frameworks.

### Localized Data

PHP passes data to JS via `wp_localize_script`:

```javascript
arAjax = {
    url:   '/wp-admin/admin-ajax.php',
    nonce: '...',
    phone: '(555) 123-4567'
}
```

### Features

- **Appointment form** — AJAX submit to `ar_appointment` action, inline success/error messages
- **FAQ accordion** — click-to-expand, ARIA attributes updated
- **Sticky phone CTA** — appears on scroll, hidden when form is visible
- **Smooth scroll** — anchor links within error code archive sections
- **Mobile nav toggle** — hamburger menu for small screens
- **Error code filter** — live search/filter on archive page directory table

### AJAX Handler

```php
// functions.php
add_action('wp_ajax_ar_appointment',        'ar_handle_form');
add_action('wp_ajax_nopriv_ar_appointment', 'ar_handle_form');
```

---

## 10. Helper Functions

All defined in `functions.php`:

| Function | Signature | Returns |
|----------|-----------|---------|
| `ar_get_phone` | `ar_get_phone(): string` | Business phone number |
| `ar_get_business_name` | `ar_get_business_name(): string` | Business name |
| `ar_get_address` | `ar_get_address(): string` | Business address |
| `ar_get_email` | `ar_get_email(): string` | Contact email |
| `ar_disclaimer` | `ar_disclaimer(string $brand=''): void` | Echoes disclaimer aside |
| `ar_trust_bar` | `ar_trust_bar(): void` | Renders trust-bar.php part |
| `ar_appointment_form` | `ar_appointment_form(string $context, string $heading): void` | Renders appointment-form.php |
| `ar_faq_section` | `ar_faq_section(array $faqs, string $heading): void` | Renders faq-accordion.php |
| `ar_output_schema` | `ar_output_schema(array $schema): void` | Echoes JSON-LD script block |
| `ar_output_seo_meta` | `ar_output_seo_meta(): void` | Echoes meta tags (only if no SEO plugin) |

### ar_disclaimer() Detail

The disclaimer rotates between 4 text variations. The variation is chosen deterministically using `crc32(post_id . brand) % 4` so each page always shows the same variant across requests (important for SEO consistency). All variations satisfy the independent-service legal disclosure requirement.

---

## 11. Content Data & Import

### Data Files

| File | Function | Coverage |
|------|----------|----------|
| `inc/all-brands-error-codes-data.php` | `ar_error_codes_{brand}()` | Error code content for all 8 brands |
| `inc/all-brands-content-data.php` | `ar_service_content_{brand}()` | Service page content for all 8 brands |

Each function returns an array of post arrays ready for `wp_insert_post()` + `update_post_meta()`.

### Importing with WP-CLI

Run on the server (or via Local's WP-CLI):

```bash
# Import error codes
wp eval-file import-error-codes.php --path=/path/to/wordpress

# Import service pages
wp eval-file import-services.php --path=/path/to/wordpress
```

### Content Requirements (Error Code Pages)

Every error code page must meet:
- **400-word minimum** (combined from `_ar_code_meaning` + causes + DIY steps + FAQs)
- US-market model numbers in `_ar_us_models`
- 3–5 causes with 50–60 word descriptions each
- 3–4 DIY troubleshooting steps
- 4–5 FAQs
- Cost range in `_ar_cost_range` (USD)

### SEO Keywords (per error code page)

Must include naturally: brand name, appliance type, error code, "error code", "repair", city/region keywords, "OEM parts", "certified technicians", "12-month warranty".

---

## 12. SEO & Schema

### Meta Tags

`ar_output_seo_meta()` fires only when neither Yoast SEO (`WPSEO_VERSION`) nor RankMath (`RANK_MATH_VERSION`) is active. When a SEO plugin is active, it handles all meta tags.

### Schema JSON-LD

Schema is always output independently of SEO plugins via `ar_output_schema()`:

| Template | Schema Types |
|----------|-------------|
| `template-service.php` | `Service`, `FAQPage`, `BreadcrumbList`, `LocalBusiness` |
| `template-error-code.php` | `HowTo`, `FAQPage`, `BreadcrumbList` |
| `template-location.php` | `LocalBusiness`, `FAQPage`, `BreadcrumbList` |
| `template-guide.php` | `HowTo`, `FAQPage`, `BreadcrumbList` |
| `template-recall.php` | `NewsArticle`, `BreadcrumbList` |
| `front-page.php` | `LocalBusiness`, `FAQPage` |

### Brand-Specific US Market Notes

- **Bosch**: Exited US washer/dryer market in 2013 — no Bosch Washer Repair or Bosch Dryer Repair service pages
- All error codes reference US model numbers (e.g., SHPM88Z75N, KFWE505ESS)
- Cost ranges are in USD, calibrated for US labor rates

---

## 13. Reusable Template Parts

### Trust Bar

```php
ar_trust_bar();
// Renders: parts/trust-bar.php
// Shows: star rating, review count, years in business, warranty badge, BBB accreditation
```

### Appointment Form

```php
ar_appointment_form('service', 'Book Your Repair Today');
ar_appointment_form('error-code', 'Get This Error Code Fixed');
// Renders: parts/appointment-form.php
// Fields: name, phone, email, appliance type, brand, message
// Submits via AJAX to ar_appointment action
```

### FAQ Accordion

```php
ar_faq_section($faqs_array, 'Frequently Asked Questions');
// Renders: parts/faq-accordion.php
// $faqs_array: [ ['question' => '...', 'answer' => '...'], ... ]
// Includes FAQPage schema JSON-LD
```

### Disclaimer

```php
ar_disclaimer('Bosch');
ar_disclaimer(); // generic version
// Echoes: <aside class="disclaimer disclaimer--prominent" ...>
// Required on every template
```

---

## 14. Theme Settings

Settings stored in `wp_options` with `ar_` prefix. Managed via **Appearance → Theme Settings**.

| Option Key | Description | Example |
|------------|-------------|---------|
| `ar_phone` | Business phone | `(555) 123-4567` |
| `ar_business_name` | Business name | `Viking Appliance Repair` |
| `ar_address` | Full address | `123 Main St, Chicago, IL 60601` |
| `ar_email` | Contact email | `info@appliancerepairpro.com` |
| `ar_license` | License/certification number | `IL-APR-12345` |

---

## 15. Development Notes

### After Changing CSS or JS

Bump `AR_VERSION` in `functions.php`:
```php
define('AR_VERSION', '1.3.0');  // increment minor or patch version
```

### After Adding a New CPT or Rewrite Rule

Go to **Settings → Permalinks → Save Changes** to flush rewrite rules. On theme activation this happens automatically.

### After Adding ACF Fields

If ACF field groups don't appear in the editor, go to **Custom Fields → Tools → Sync** and sync all groups from `acf-json/`.

### Adding a New Brand

1. Add brand term to `brand` taxonomy (Dashboard → Brands → Add New)
2. Add content data function `ar_service_content_{brand}()` in `inc/all-brands-content-data.php`
3. Add error code data function `ar_error_codes_{brand}()` in `inc/all-brands-error-codes-data.php`
4. Run import scripts via WP-CLI
5. Check US market constraints (e.g., brand may not make certain appliances in the US)

### Adding a New City

1. Add city term to `city` taxonomy
2. Create a `location_page` post and assign the city term
3. Fill ACF fields: `_ar_city`, `_ar_state`, `_ar_zip_codes`, `_ar_neighborhoods`, `_ar_intro`, `_ar_faqs`

### Local Development (Local by Flywheel)

- MySQL port: `10005`, host: `127.0.0.1`, user: `root`, password: `root`
- mysqldump path: `C:\Users\Administrator\AppData\Roaming\Local\lightning-services\mysql-8.0.35+4\bin\win64\bin\mysqldump.exe`
- WP-CLI: `C:\Users\Administrator\Desktop\wp-cli.phar`
- Custom php.ini: `C:\Users\Administrator\AppData\Roaming\Local\run\lightning\php\php.ini`

---

## 16. Deploying to Hostinger

### Step 1 — Prepare fresh files locally

**A) Export the database**

Open PowerShell and run:

```powershell
& "C:\Users\Administrator\AppData\Roaming\Local\lightning-services\mysql-8.0.35+4\bin\win64\bin\mysqldump.exe" --host=127.0.0.1 --port=10005 --user=root --password=root local --result-file=C:\Users\Administrator\Desktop\appliancerepair_db_export.sql
```

**B) Zip the theme**

```powershell
Compress-Archive -Path "C:\Users\Administrator\Local Sites\appliancerepair\app\public\wp-content\themes\wp-appliancerepair-theme" -DestinationPath "C:\Users\Administrator\Desktop\appliancerepair_theme.zip" -Force
```

**C) Zip the plugins**

```powershell
Compress-Archive -Path "C:\Users\Administrator\Local Sites\appliancerepair\app\public\wp-content\plugins\advanced-custom-fields","C:\Users\Administrator\Local Sites\appliancerepair\app\public\wp-content\plugins\wordpress-seo" -DestinationPath "C:\Users\Administrator\Desktop\appliancerepair_plugins.zip" -Force
```

---

### Step 2 — Set up WordPress on Hostinger

1. Log in to **hPanel** → **Website** → **Auto Installer** → **WordPress**
2. Fill in site title, admin username, password, email
3. **Note down** the database name, database user, and database password it creates

---

### Step 3 — Import the database

1. In hPanel → **Databases** → **phpMyAdmin**
2. Select your WordPress database from the left panel
3. Click **Import** → choose `appliancerepair_db_export.sql` → click **Go**
4. After import, go to the **SQL** tab and run this to update the site URL (replace `yourdomain.com`):

```sql
UPDATE wp_options SET option_value = 'https://yourdomain.com' WHERE option_name IN ('siteurl', 'home');
```

---

### Step 4 — Upload the theme

1. In hPanel → **File Manager** → navigate to `public_html/wp-content/themes/`
2. Upload `appliancerepair_theme.zip` → right-click → **Extract**
3. You should now see the folder `wp-appliancerepair-theme/` there

---

### Step 5 — Upload the plugins

1. Navigate to `public_html/wp-content/plugins/`
2. Upload `appliancerepair_plugins.zip` → **Extract**

---

### Step 6 — Update wp-config.php

1. In File Manager open `public_html/wp-config.php`
2. Update these 4 lines with your Hostinger database credentials:

```php
define( 'DB_NAME',     'your_db_name' );
define( 'DB_USER',     'your_db_user' );
define( 'DB_PASSWORD', 'your_db_password' );
define( 'DB_HOST',     'localhost' );
```

3. Replace the secret keys block — generate fresh ones at:
   `https://api.wordpress.org/secret-key/1.1/salt/`

---

### Step 7 — WordPress admin setup

Log in to `https://yourdomain.com/wp-admin` with your credentials, then:

| Task | Where |
|------|-------|
| Activate theme | Appearance → Themes → Activate **Viking Appliance Repair** |
| Activate plugins | Plugins → Activate **ACF** and **Yoast SEO** |
| Sync ACF fields | Custom Fields → Tools → Sync all |
| Flush permalinks | Settings → Permalinks → Save Changes |
| Enter business info | Appearance → Theme Settings → fill phone, name, address, email |

---

### Step 8 — Test

- [ ] `yourdomain.com` loads homepage
- [ ] `yourdomain.com/services/` shows service pages
- [ ] `yourdomain.com/error-codes/` shows error code archive
- [ ] `yourdomain.com/schedule/` shows the appointment page
- [ ] FAQ accordion opens/closes
- [ ] Appointment form submits successfully

> **Note:** On Hostinger's shared hosting, `DB_HOST` is almost always `localhost`. If you get a database connection error, check hPanel → Databases for the exact hostname.

---

### Troubleshooting: Pages show `?page_id=123` instead of pretty URLs

**Cause:** WordPress pretty permalinks require `.htaccess` rewrite rules. After a database import, Hostinger's `.htaccess` may not have them yet.

**Fix 1 — Flush permalinks (try this first):**
Go to **Settings → Permalinks → Save Changes** in the WordPress admin. WordPress will regenerate `.htaccess` automatically.

**Fix 2 — Manually create/edit `.htaccess`:**
In hPanel → File Manager, open or create `public_html/.htaccess` with this content:

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
```

---

## 17. Post-Deployment Checklist

### Core Setup
- [ ] WordPress installed and accessible at your domain
- [ ] Theme activated (Appearance → Themes)
- [ ] ACF and Yoast SEO plugins activated
- [ ] ACF field groups synced (Custom Fields → Tools → Sync)
- [ ] Permalinks flushed (Settings → Permalinks → Save Changes)
- [ ] Theme Settings filled in (Appearance → Theme Settings)
- [ ] wp-config.php has correct DB credentials and fresh security keys

### Content Verification
- [ ] Service pages visible at `/services/`
- [ ] Error codes visible at `/error-codes/`
- [ ] Error code archive groups correctly by appliance type
- [ ] Location pages visible at `/locations/`
- [ ] Guides visible at `/guides/`
- [ ] Homepage loads correctly at domain root
- [ ] Appointment form submits successfully (check email delivery)

### SEO
- [ ] Yoast SEO configured with business info (SEO → General)
- [ ] XML sitemap generated and accessible at `/sitemap_index.xml`
- [ ] Google Search Console: add property and submit sitemap
- [ ] Google Analytics or similar tracking installed
- [ ] Schema markup verified with Google's Rich Results Test

### Performance
- [ ] Caching plugin installed and active (e.g., WP Super Cache, LiteSpeed Cache)
- [ ] Images optimized before upload (use WebP where possible)
- [ ] Hostinger's LiteSpeed cache enabled in hPanel if available

### Legal / Compliance
- [ ] Disclaimer appears on all service and error code pages
- [ ] Privacy Policy page created and linked in footer
- [ ] Terms of Service page created and linked in footer
- [ ] Google Business Profile updated with correct address and phone

---

## License

This theme is proprietary software for Viking Appliance Repair. All brand names, trademarks, and model numbers referenced throughout this theme are the property of their respective manufacturers and are used solely for identification purposes. This business is an independent service provider and is not affiliated with, authorized by, or endorsed by any appliance manufacturer.

