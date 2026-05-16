<?php
/**
 * Archive: Error Codes
 * URL: /error-codes/
 * Design: OBSIDIAN — off-white hero, Cormorant headings, accordion sections, flat table rows
 */
defined('ABSPATH') || exit;

/* ── Data ──────────────────────────────────────────────── */
$all_codes = new WP_Query([
    'post_type'      => 'error_code',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    'no_found_rows'  => false,
    'tax_query'      => [[
        'taxonomy' => 'brand',
        'field'    => 'slug',
        'terms'    => 'viking',
    ]],
]);

$brands     = get_terms(['taxonomy' => 'brand',         'hide_empty' => true, 'orderby' => 'name', 'slug' => 'viking']);
$appliances = get_terms(['taxonomy' => 'appliance_type','hide_empty' => true, 'orderby' => 'name']);
$total      = $all_codes->found_posts;
$phone      = ar_get_phone();
$phone_raw  = ar_phone_link();
$biz        = ar_get_business_name();

/* Severity helper — reads _ar_severity meta first, falls back to cost-range derivation */
function ec_severity(string $cost, string $meta_sev = ''): array {
    $meta = strtolower(trim($meta_sev));
    if ($meta === 'critical') return ['label' => 'Critical', 'cls' => 'ec-sev--critical'];
    if ($meta === 'high')     return ['label' => 'High',     'cls' => 'ec-sev--high'];
    if ($meta === 'medium')   return ['label' => 'Medium',   'cls' => 'ec-sev--med'];
    if ($meta === 'low')      return ['label' => 'Low',      'cls' => 'ec-sev--low'];
    // Fallback: derive from repair cost range
    preg_match('/\$(\d+)/', $cost, $m);
    $start = (int)($m[1] ?? 0);
    if ($start >= 200) return ['label' => 'High',   'cls' => 'ec-sev--high'];
    if ($start >= 90)  return ['label' => 'Medium', 'cls' => 'ec-sev--med'];
    return ['label' => 'Low', 'cls' => 'ec-sev--low'];
}

/* Appliance icons */
$ap_icons = [
    'range'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="5" width="20" height="17" rx="2"/><rect x="6" y="9" width="12" height="9" rx="1"/><circle cx="7" cy="3" r="1"/><circle cx="12" cy="3" r="1"/><circle cx="17" cy="3" r="1"/></svg>',
    'refrigerator' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="4" y1="10" x2="20" y2="10"/><line x1="9" y1="6" x2="9" y2="9"/><line x1="9" y1="13" x2="9" y2="18"/></svg>',
    'dishwasher'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="2" width="18" height="20" rx="2"/><line x1="3" y1="8" x2="21" y2="8"/><circle cx="12" cy="15" r="4"/><path d="M9 15 Q12 12 15 15"/></svg>',
    'cooktop'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="5" width="20" height="14" rx="2"/><circle cx="8" cy="12" r="2.5"/><circle cx="16" cy="12" r="2.5"/></svg>',
    'wall-oven'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="2" width="18" height="20" rx="2"/><rect x="6" y="6" width="12" height="7" rx="1"/><rect x="6" y="16" width="12" height="4" rx="1"/><line x1="9" y1="4" x2="9" y2="5"/><line x1="15" y1="4" x2="15" y2="5"/></svg>',
    'wine-cooler'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="4" y1="10" x2="20" y2="10"/></svg>',
    'default'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
];

function ec_icon(string $slug, array $icons): string {
    foreach ($icons as $key => $svg) {
        if (str_contains($slug, $key)) return $svg;
    }
    return $icons['default'];
}

get_header();
?>

<style>
/* ── Error Code Archive — OBSIDIAN Design ──────────────── */

/* ph-split hero panel */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) { .ph-split { display: block; } .ph-split__img { height: 280px; position: relative; } .ph-split__img img { position: absolute; } .ph-split__img::before { display: none; } }

/* Hero */
.ec-hero {
    background: var(--color-bg-light, #F7F6F3);
    padding-bottom: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.ec-hero__inner { max-width: 860px; }
.ec-hero__eyebrow {
    display: inline-block;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: 1.25rem;
}
.ec-hero__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.1;
    letter-spacing: -.02em;
    margin: 0 0 1.25rem;
}
.ec-hero__title em { font-style: italic; }
.ec-hero__subtitle {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: 1.0625rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.7;
    margin: 0 0 2.5rem;
    max-width: 640px;
}

/* Hero search */
.ec-hero__search {
    display: flex;
    align-items: center;
    max-width: 540px;
    border: 1px solid var(--color-rule, #D9D8D3);
    background: #ffffff;
    padding: 0;
    gap: 0;
}
.ec-hero__search svg {
    margin: 0 .875rem;
    color: var(--color-text-muted, #717170);
    flex-shrink: 0;
}
.ec-hero__search input {
    flex: 1;
    border: none;
    outline: none;
    color: var(--color-primary-dark, #0D0D0D);
    font-size: .9375rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    padding: .875rem 0;
    background: transparent;
}
.ec-hero__search input::placeholder { color: var(--color-text-muted, #717170); }
.ec-hero__search button {
    background: var(--color-primary-dark, #0D0D0D);
    color: #fff;
    border: none;
    padding: .875rem 1.5rem;
    font-size: .8125rem;
    font-weight: 700;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    letter-spacing: .06em;
    text-transform: uppercase;
    cursor: pointer;
    white-space: nowrap;
    transition: background .2s;
    flex-shrink: 0;
}
.ec-hero__search button:hover { background: var(--color-primary, #C01C28); }

/* Hero stats */
.ec-hero__stats {
    display: flex;
    gap: 3rem;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--color-rule, #D9D8D3);
    flex-wrap: wrap;
}
.ec-stat__num {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 3rem;
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1;
    display: block;
}
.ec-stat__label {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    color: var(--color-text-muted, #717170);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-top: .375rem;
}

/* Appliance sections */
.ec-sections {
    padding: 4rem 0 5rem;
    background: var(--color-bg-light, #F7F6F3);
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.ec-sections__head {
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.ec-sections__eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: .875rem;
}
.ec-sections__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0 0 .5rem;
    letter-spacing: -.01em;
}
.ec-sections__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: var(--color-text-muted, #717170);
    max-width: 560px;
    margin: 0;
    line-height: 1.65;
}

/* Accordion panels */
.ec-ap-section {
    background: #ffffff;
    border: 1px solid var(--color-rule, #D9D8D3);
    margin-bottom: .5rem;
    scroll-margin-top: 80px;
}
.ec-ap-section.is-open { border-color: var(--color-primary-dark, #0D0D0D); }
.ec-ap-section__header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.375rem 1.5rem;
    cursor: pointer;
    user-select: none;
    transition: background .15s;
}
.ec-ap-section__header:hover { background: var(--color-bg-light, #F7F6F3); }
.ec-ap-section__icon {
    width: 40px;
    height: 40px;
    border: 1px solid var(--color-rule, #D9D8D3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-muted, #717170);
    flex-shrink: 0;
}
.ec-ap-section.is-open .ec-ap-section__icon {
    border-color: var(--color-primary, #C01C28);
    color: var(--color-primary, #C01C28);
}
.ec-ap-section__icon svg { width: 20px; height: 20px; }
.ec-ap-section__meta { flex: 1; }
.ec-ap-section__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 1.375rem;
    font-weight: 400;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0;
    letter-spacing: -.01em;
}
.ec-ap-section__count {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    color: var(--color-text-muted, #717170);
    margin: .125rem 0 0;
}
.ec-ap-section__toggle {
    display: flex;
    align-items: center;
    gap: .5rem;
    color: var(--color-text-muted, #717170);
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
}
.ec-toggle-icon { width: 16px; height: 16px; transition: transform .25s; }
.ec-ap-section.is-open .ec-toggle-icon { transform: rotate(180deg); }
.ec-ap-section__desc {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.7;
    padding: 0 1.5rem 1.25rem;
    margin: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    display: none;
}
.ec-ap-section.is-open .ec-ap-section__desc { display: block; }
.ec-ap-section__body { display: none; overflow-x: auto; }
.ec-ap-section.is-open .ec-ap-section__body { display: block; }

/* Directory section */
.ec-dir {
    padding: 4rem 0 5rem;
    background: #ffffff;
}
.ec-dir__head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.75rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.ec-dir__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0;
    letter-spacing: -.01em;
}
.ec-dir__count {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
}

/* Filter bar */
.ec-filters {
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    margin-bottom: 1.5rem;
    align-items: center;
}
.ec-filter-input {
    flex: 1;
    min-width: 200px;
    padding: .6875rem 1rem;
    border: 1px solid var(--color-rule, #D9D8D3);
    border-radius: 0;
    font-size: .875rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    color: var(--color-primary-dark, #0D0D0D);
    background: var(--color-bg-light, #F7F6F3);
    outline: none;
    transition: border-color .2s;
}
.ec-filter-input:focus { border-color: var(--color-primary-dark, #0D0D0D); background: #fff; }
.ec-filter-select {
    padding: .6875rem 2.25rem .6875rem .875rem;
    border: 1px solid var(--color-rule, #D9D8D3);
    border-radius: 0;
    font-size: .875rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    color: var(--color-primary-dark, #0D0D0D);
    background: var(--color-bg-light, #F7F6F3) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%23717170' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 10px center;
    -webkit-appearance: none;
    cursor: pointer;
    outline: none;
    transition: border-color .2s;
}
.ec-filter-select:focus { border-color: var(--color-primary-dark, #0D0D0D); background-color: #fff; }
.ec-filter-clear {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    color: var(--color-text-muted, #717170);
    background: none;
    border: none;
    cursor: pointer;
    padding: .25rem .5rem;
    text-decoration: underline;
    transition: color .15s;
}
.ec-filter-clear:hover { color: var(--color-primary, #C01C28); }

/* Table */
.ec-table-wrap {
    overflow-x: auto;
    border: 1px solid var(--color-rule, #D9D8D3);
}
.ec-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .875rem;
}
.ec-table thead th {
    background: var(--color-bg-light, #F7F6F3);
    color: var(--color-text-muted, #717170);
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    padding: .875rem 1rem;
    text-align: left;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    white-space: nowrap;
}
.ec-table tbody tr {
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    transition: background .12s;
}
.ec-table tbody tr:last-child { border-bottom: none; }
.ec-table tbody tr:hover { background: var(--color-bg-light, #F7F6F3); }
.ec-table td {
    padding: .9375rem 1rem;
    color: var(--color-primary-dark, #0D0D0D);
    vertical-align: middle;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
}

/* Code badge */
.ec-code-badge {
    display: inline-block;
    background: var(--color-bg-light, #F7F6F3);
    color: var(--color-primary-dark, #0D0D0D);
    font-size: .8125rem;
    font-weight: 700;
    font-family: 'Courier New', monospace;
    letter-spacing: .04em;
    padding: .25rem .625rem;
    border: 1px solid var(--color-rule, #D9D8D3);
    white-space: nowrap;
    text-decoration: none;
    transition: background .15s, border-color .15s;
}
.ec-code-badge:hover { background: var(--color-primary-dark, #0D0D0D); color: #fff; border-color: var(--color-primary-dark, #0D0D0D); }

.ec-ap-chip {
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
}
.ec-fault-text { line-height: 1.4; }
.ec-fault-title {
    font-weight: 600;
    display: block;
    margin-bottom: .125rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    color: var(--color-primary-dark, #0D0D0D);
    font-size: .875rem;
}
.ec-fault-hint {
    font-size: .75rem;
    color: var(--color-text-muted, #717170);
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
}

/* Severity */
.ec-sev {
    display: inline-flex;
    align-items: center;
    gap: .3125rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .25rem .625rem;
    white-space: nowrap;
    border: 1px solid transparent;
}
.ec-sev::before { content: ''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
.ec-sev--low      { color: #15803d; border-color: #bbf7d0; background: #f0fdf4; }
.ec-sev--low::before      { background: #15803d; }
.ec-sev--med      { color: #b45309; border-color: #fde68a; background: #fffbeb; }
.ec-sev--med::before      { background: #b45309; }
.ec-sev--high     { color: #92400e; border-color: #fcd34d; background: #fffbeb; }
.ec-sev--high::before     { background: #f59e0b; }
.ec-sev--critical { color: #991b1b; border-color: #fca5a5; background: #fef2f2; animation: ec-pulse 2s ease-in-out infinite; }
.ec-sev--critical::before { background: #ef4444; }
@keyframes ec-pulse { 0%, 100% { opacity: 1; } 50% { opacity: .65; } }

.ec-view-link {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    color: var(--color-primary, #C01C28);
    font-size: .75rem;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    letter-spacing: .04em;
    text-transform: uppercase;
    transition: color .15s;
}
.ec-view-link:hover { color: var(--color-primary-dark, #0D0D0D); }

/* Hidden rows */
.ec-table-row--hidden { display: none; }
.ec-no-results {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    padding: 3rem 1.5rem;
    text-align: center;
    color: var(--color-text-muted, #717170);
    font-size: .9375rem;
    display: none;
    border-top: 1px solid var(--color-rule, #D9D8D3);
}
.ec-no-results.is-visible { display: block; }

/* Show more */
.ec-showmore-wrap { text-align: center; margin-top: 1.75rem; }
.ec-showmore-btn {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    background: #ffffff;
    border: 1px solid var(--color-rule, #D9D8D3);
    color: var(--color-primary-dark, #0D0D0D);
    font-size: .8125rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .875rem 2rem;
    cursor: pointer;
    transition: background .2s, border-color .2s;
    border-radius: 0;
}
.ec-showmore-btn:hover { background: var(--color-bg-light, #F7F6F3); border-color: var(--color-primary-dark, #0D0D0D); }

/* CTA */
.ec-cta {
    background: var(--color-primary-dark, #0D0D0D);
    padding: 5rem 0;
    text-align: center;
}
.ec-cta__eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: rgba(255,255,255,.4);
    margin-bottom: .875rem;
}
.ec-cta__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 300;
    color: #ffffff;
    margin: 0 0 1rem;
    letter-spacing: -.01em;
}
.ec-cta__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: rgba(255,255,255,.6);
    max-width: 480px;
    margin: 0 auto 2.25rem;
    line-height: 1.7;
}
.ec-cta__btns { display:flex; gap:.875rem; justify-content:center; flex-wrap:wrap; }
.ec-btn--crimson {
    background: var(--color-primary, #C01C28);
    color: #fff;
    padding: .875rem 1.875rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    border-radius: 2px;
    transition: opacity .2s;
}
.ec-btn--crimson:hover { opacity: .88; }
.ec-btn--ghost {
    color: rgba(255,255,255,.8);
    padding: .875rem 1.875rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 2px;
    transition: border-color .2s, color .2s;
}
.ec-btn--ghost:hover { border-color: rgba(255,255,255,.6); color: #fff; }

@media (max-width: 768px) {
    .ec-hero { padding-bottom: 3.5rem; }
    .ec-hero__stats { gap: 2rem; }
    .ec-table:not(.ec-ap-table) td:nth-child(3),
    .ec-table:not(.ec-ap-table) th:nth-child(3) { display: none; }
    .ec-ap-table td:nth-child(2), .ec-ap-table th:nth-child(2) { display: none; }
    .ec-dir__head { flex-direction: column; align-items: flex-start; }
}
@media (max-width: 480px) {
    .ec-table:not(.ec-ap-table) td:nth-child(2),
    .ec-table:not(.ec-ap-table) th:nth-child(2) { display: none; }
    .ec-hero__search { flex-direction: column; }
    .ec-hero__search button { width: 100%; text-align: center; padding: .875rem; }
}
</style>

<!-- HERO -->
<section class="ec-hero" aria-labelledby="ec-h1">
    <div class="ph-split">
        <div class="ph-split__text" style="padding-top: calc(64px + 5rem);">
            <div class="container">
                <div class="ec-hero__inner">
                    <span class="ec-hero__eyebrow">Diagnostic Library</span>
                    <h1 id="ec-h1" class="ec-hero__title">Viking <em>Fault Code</em> Library</h1>
                    <p class="ec-hero__subtitle">Find what your Viking appliance's fault code means, how serious it is, and exactly what to do next &mdash; covering ranges, wall ovens, refrigerators, dishwashers, cooktops, wine coolers, freezers, and vent hoods.</p>

                    <div class="ec-hero__search" id="ec-hero-search" role="search">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                        <input type="text" id="ec-search-input" placeholder="Search fault code or appliance type&hellip;" autocomplete="off" aria-label="Search Viking fault codes">
                        <button type="button" onclick="document.getElementById('ec-search-input').focus()">Search</button>
                    </div>

                    <div class="ec-hero__stats" role="list" aria-label="Library statistics">
                        <div role="listitem">
                            <span class="ec-stat__num"><?php echo $total ?: '100+'; ?></span>
                            <span class="ec-stat__label">Error Codes</span>
                        </div>
                        <div role="listitem">
                            <span class="ec-stat__num"><?php echo count($appliances) ?: '8'; ?></span>
                            <span class="ec-stat__label">Appliance Types</span>
                        </div>
                        <div role="listitem">
                            <span class="ec-stat__num">30</span>
                            <span class="ec-stat__label">Day Warranty</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ph-split__img">
            <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-range-desert-modern.jpg'); ?>" alt="Viking fault code diagnostic library" loading="lazy">
        </div>
    </div>
</section>

<!-- ERROR CODES BY APPLIANCE TYPE -->
<?php if ( ! empty($appliances) ):
    $ap_descriptions = [
        'range'        => 'Viking range fault codes (F1–F9) indicate specific failures in the oven temperature control system, control board, or door lock mechanism. These codes are documented in Viking service literature and allow precise diagnosis. F2 and F3 codes relate to temperature sensor faults; F4 indicates temperature runaway; F9 signals a self-clean door lock failure.',
        'refrigerator' => 'Viking refrigerator fault codes signal problems with the defrost system, evaporator fan, ice maker assembly, or temperature sensing. Early diagnosis prevents food spoilage and prevents more costly compressor or sealed system failures.',
        'dishwasher'   => 'Viking dishwasher fault codes point to water fill, drain, heating element, door latch, or circulation pump failures. Most codes prevent the appliance from completing a cycle to protect the kitchen from water damage.',
        'cooktop'      => 'Viking cooktop fault indicators relate to ignition module failures, spark electrode faults, surface element failures on electric models, or induction coil issues. Most cooktop faults are diagnosed by observing which zone or burner is affected.',
        'wall-oven'    => 'Viking wall oven fault codes use the same F-series architecture as Viking ranges. F2 and F3 indicate temperature sensor faults; F4 signals temperature runaway; F9 is a self-clean door lock failure. F1 indicates a main control board fault.',
        'wine-cooler'  => 'Viking wine cooler fault displays indicate temperature sensing failures, compressor issues, or fan motor faults. Temperature inconsistency in a wine cooler risks wine quality — schedule service promptly when a fault code appears.',
        'freezer'      => 'Viking freezer faults include defrost system failures, evaporator and condenser fan failures, temperature sensor faults, and door gasket deterioration. A freezer fault left unresolved risks complete food loss — schedule service at the first sign of temperature inconsistency.',
        'vent-hood'    => 'Viking Professional Series vent hood faults include blower motor failures, fan speed control issues, damper problems, and thermal cutout trips from clogged grease filters. Prompt service prevents motor burnout and maintains kitchen ventilation safety.',
    ];
?>
<section class="ec-sections" id="ec-appliance-sections" aria-labelledby="ec-sections-h2">
    <div class="container">
        <header class="ec-sections__head">
            <p class="ec-sections__eyebrow">Grouped by Appliance</p>
            <h2 id="ec-sections-h2" class="ec-sections__title">Error Codes by Appliance Type</h2>
            <p class="ec-sections__sub">Browse error codes specific to your appliance. Click any row to see causes, DIY checks, and repair costs.</p>
        </header>

        <?php foreach ($appliances as $ap):
            $ap_slug  = $ap->slug;
            $ap_name  = $ap->name;
            if ($ap->count === 0) continue;

            $ap_codes = new WP_Query([
                'post_type'      => 'error_code',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'tax_query'      => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => 'appliance_type',
                        'field'    => 'slug',
                        'terms'    => $ap_slug,
                    ],
                    [
                        'taxonomy' => 'brand',
                        'field'    => 'slug',
                        'terms'    => 'viking',
                    ],
                ],
                'no_found_rows'  => true,
            ]);

            $ap_count = $ap_codes->post_count;
            if ($ap_count === 0) continue;

            $ap_desc = '';
            foreach ($ap_descriptions as $key => $desc) {
                if (str_contains($ap_slug, $key)) { $ap_desc = $desc; break; }
            }

            $ap_brands = [];
            if ($ap_codes->have_posts()) {
                while ($ap_codes->have_posts()) {
                    $ap_codes->the_post();
                    $b = get_post_meta(get_the_ID(), '_ar_brand', true);
                    if ($b) $ap_brands[$b] = 1;
                }
                wp_reset_postdata();
                $ap_codes->rewind_posts();
            }
            $icon_html = ec_icon($ap_slug, $ap_icons);
        ?>
        <div class="ec-ap-section" id="section-<?php echo esc_attr($ap_slug); ?>">
            <div class="ec-ap-section__header" onclick="ecToggleSection(this)" role="button" aria-expanded="false" aria-controls="body-<?php echo esc_attr($ap_slug); ?>">
                <div class="ec-ap-section__icon" aria-hidden="true"><?php echo $icon_html; ?></div>
                <div class="ec-ap-section__meta">
                    <h3 class="ec-ap-section__title"><?php echo esc_html($ap_name); ?> Error Codes</h3>
                    <p class="ec-ap-section__count"><?php echo $ap_count; ?> error code<?php echo $ap_count !== 1 ? 's' : ''; ?> &mdash; Viking</p>
                </div>
                <div class="ec-ap-section__toggle" aria-hidden="true">
                    <span class="ec-ap-section__toggle-label">Expand</span>
                    <svg class="ec-toggle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                </div>
            </div>
            <?php if ($ap_desc): ?>
            <p class="ec-ap-section__desc"><?php echo esc_html($ap_desc); ?></p>
            <?php endif; ?>
            <div class="ec-ap-section__body" id="body-<?php echo esc_attr($ap_slug); ?>">
                <div class="ec-table-wrap" style="border:none;border-top:1px solid var(--color-rule,#D9D8D3);border-radius:0;">
                    <table class="ec-table ec-ap-table">
                        <thead>
                            <tr>
                                <th>Error Code</th>
                                <th>Fault Description</th>
                                <th>Severity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($ap_codes->have_posts()):
                            while ($ap_codes->have_posts()): $ap_codes->the_post();
                                $pid        = get_the_ID();
                                $code       = get_post_meta($pid, '_ar_error_code',    true) ?: '';
                                $meaning    = get_post_meta($pid, '_ar_code_meaning',  true) ?: get_the_excerpt();
                                $cost       = get_post_meta($pid, '_ar_cost_range',    true) ?: '';
                                $meta_sev   = get_post_meta($pid, '_ar_severity',      true) ?: '';
                                $sev        = ec_severity($cost, $meta_sev);
                                $title      = get_the_title();
                                $url        = get_permalink();
                                $fault_desc = wp_strip_all_tags($meaning);
                                $fault_short = mb_strimwidth($fault_desc, 0, 85, '…');
                        ?>
                        <tr>
                            <td><a href="<?php echo esc_url($url); ?>" class="ec-code-badge"><?php echo esc_html($code ?: $title); ?></a></td>
                            <td>
                                <div class="ec-fault-text">
                                    <span class="ec-fault-title"><?php echo esc_html($title); ?></span>
                                    <?php if ($fault_short): ?><span class="ec-fault-hint"><?php echo esc_html($fault_short); ?></span><?php endif; ?>
                                </div>
                            </td>
                            <td><span class="ec-sev <?php echo esc_attr($sev['cls']); ?>"><?php echo esc_html($sev['label']); ?></span></td>
                            <td><a href="<?php echo esc_url($url); ?>" class="ec-view-link">View &rarr;</a></td>
                        </tr>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>
<?php endif; ?>

<!-- COMPLETE DIRECTORY -->
<section class="ec-dir" id="ec-directory" aria-labelledby="ec-dir-h2">
    <div class="container">
        <header class="ec-dir__head">
            <div>
                <h2 id="ec-dir-h2" class="ec-dir__title">Complete Error Code Directory</h2>
                <p class="ec-dir__count">
                    <span id="ec-visible-count"><?php echo $total; ?></span> codes &mdash; click any row to view full diagnosis
                </p>
            </div>
            <div id="ec-active-filters" style="display:flex;gap:.5rem;flex-wrap:wrap;"></div>
        </header>

        <!-- Filters -->
        <div class="ec-filters" role="search" aria-label="Filter error codes">
            <input type="text" class="ec-filter-input" id="ec-dir-search" placeholder="Search by fault code or appliance&hellip;" aria-label="Search fault codes">
            <select class="ec-filter-select" id="ec-ap-filter" aria-label="Filter by appliance">
                <option value="">All Appliances</option>
                <?php foreach ($appliances as $ap): ?>
                <option value="<?php echo esc_attr($ap->slug); ?>"><?php echo esc_html($ap->name); ?></option>
                <?php endforeach; ?>
            </select>
            <select class="ec-filter-select" id="ec-sev-filter" aria-label="Filter by severity">
                <option value="">All Severity</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
                <option value="critical">Critical</option>
            </select>
            <button class="ec-filter-clear" id="ec-clear-filters" style="display:none;">&times; Clear filters</button>
        </div>

        <!-- Table -->
        <div class="ec-table-wrap">
            <table class="ec-table" id="ec-main-table">
                <thead>
                    <tr>
                        <th>Error Code</th>
                        <th>Appliance</th>
                        <th>Fault Description</th>
                        <th>Severity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="ec-tbody">
                    <?php if ($all_codes->have_posts()):
                        $row_idx = 0;
                        while ($all_codes->have_posts()): $all_codes->the_post();
                            $pid       = get_the_ID();
                            $appliance = get_post_meta($pid, '_ar_appliance_type', true) ?: '';
                            $code      = get_post_meta($pid, '_ar_error_code',     true) ?: '';
                            $meaning   = get_post_meta($pid, '_ar_code_meaning',   true) ?: get_the_excerpt();
                            $cost      = get_post_meta($pid, '_ar_cost_range',     true) ?: '';
                            $meta_sev  = get_post_meta($pid, '_ar_severity',       true) ?: '';
                            $sev       = ec_severity($cost, $meta_sev);
                            $title     = get_the_title();
                            $url       = get_permalink();
                            $fault_desc  = wp_strip_all_tags($meaning);
                            $fault_short = mb_strimwidth($fault_desc, 0, 90, '…');
                            $brand       = get_post_meta($pid, '_ar_brand', true) ?: '';
                            $da_brand    = strtolower($brand);
                            $da_ap       = sanitize_title($appliance);
                            $da_sev      = strtolower($sev['label']);
                            $da_search   = strtolower("$brand $code $appliance $title");
                            $hidden      = $row_idx >= 20 ? ' ec-table-row--hidden ec-extra-row' : '';
                            $row_idx++;
                    ?>
                    <tr class="ec-table-row<?php echo $hidden; ?>"
                        data-brand="<?php echo esc_attr($da_brand); ?>"
                        data-appliance="<?php echo esc_attr($da_ap); ?>"
                        data-severity="<?php echo esc_attr($da_sev); ?>"
                        data-search="<?php echo esc_attr($da_search); ?>">
                        <td><a href="<?php echo esc_url($url); ?>" class="ec-code-badge"><?php echo esc_html($code ?: '—'); ?></a></td>
                        <td><span class="ec-ap-chip"><?php echo esc_html($appliance); ?></span></td>
                        <td>
                            <div class="ec-fault-text">
                                <span class="ec-fault-title"><?php echo esc_html($title); ?></span>
                                <?php if ($fault_short): ?>
                                <span class="ec-fault-hint"><?php echo esc_html($fault_short); ?></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td><span class="ec-sev <?php echo esc_attr($sev['cls']); ?>"><?php echo esc_html($sev['label']); ?></span></td>
                        <td><a href="<?php echo esc_url($url); ?>" class="ec-view-link">View &rarr;</a></td>
                    </tr>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </tbody>
            </table>
            <p class="ec-no-results" id="ec-no-results">No error codes match your search. <a href="<?php echo esc_url($phone_raw); ?>" style="color:var(--color-primary,#C01C28);">Call us directly &rarr;</a></p>
        </div>

        <?php if ($total > 20): ?>
        <div class="ec-showmore-wrap">
            <button class="ec-showmore-btn" id="ec-showmore">
                Show all <?php echo $total; ?> error codes &darr;
            </button>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA -->
<section class="ec-cta" aria-labelledby="ec-cta-h2">
    <div class="container">
        <p class="ec-cta__eyebrow">Can't Find Your Code?</p>
        <h2 id="ec-cta-h2" class="ec-cta__title">Speak Directly With a Technician</h2>
        <p class="ec-cta__sub">Our certified technicians can diagnose any error code over the phone or in person &mdash; same-day appointments available.</p>
        <div class="ec-cta__btns">
            <a href="<?php echo esc_url($phone_raw); ?>" class="ec-btn--crimson"><?php echo esc_html($phone); ?></a>
            <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="ec-btn--ghost">Schedule Online &rarr;</a>
        </div>
    </div>
</section>

<div id="book" style="scroll-margin-top:80px;">
    <?php ar_appointment_form('archive-page', 'Book Your Viking Repair Today'); ?>
</div>

<?php ar_disclaimer(); ?>

<script>
/* Accordion toggle */
function ecToggleSection(headerEl) {
    var section = headerEl.closest('.ec-ap-section');
    if (!section) return;
    var isOpen = section.classList.contains('is-open');
    if (isOpen) {
        section.classList.remove('is-open');
        headerEl.setAttribute('aria-expanded', 'false');
        var lbl = headerEl.querySelector('.ec-ap-section__toggle-label');
        if (lbl) lbl.textContent = 'Expand';
    } else {
        section.classList.add('is-open');
        headerEl.setAttribute('aria-expanded', 'true');
        var lbl = headerEl.querySelector('.ec-ap-section__toggle-label');
        if (lbl) lbl.textContent = 'Collapse';
        setTimeout(function() {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 50);
    }
}

/* Auto-open from hash */
document.addEventListener('DOMContentLoaded', function() {
    var hash = window.location.hash;
    if (hash && hash.startsWith('#section-')) {
        var target = document.querySelector(hash);
        if (target) {
            var hdr = target.querySelector('.ec-ap-section__header');
            if (hdr) ecToggleSection(hdr);
        }
    }
});

(function(){
    const searchInput  = document.getElementById('ec-search-input');
    const dirSearch    = document.getElementById('ec-dir-search');
    const apFilter     = document.getElementById('ec-ap-filter');
    const sevFilter    = document.getElementById('ec-sev-filter');
    const clearBtn     = document.getElementById('ec-clear-filters');
    const countEl      = document.getElementById('ec-visible-count');
    const noResults    = document.getElementById('ec-no-results');
    const showMoreBtn  = document.getElementById('ec-showmore');
    const tbody        = document.getElementById('ec-tbody');
    const extraRows    = tbody ? tbody.querySelectorAll('.ec-extra-row') : [];

    let allShown = false;

    function showAllRows() {
        extraRows.forEach(r => r.classList.remove('ec-table-row--hidden'));
        allShown = true;
        if (showMoreBtn) showMoreBtn.style.display = 'none';
    }

    function filterTable() {
        const q   = (dirSearch?.value || searchInput?.value || '').toLowerCase().trim();
        const ap  = apFilter?.value || '';
        const sev = sevFilter?.value || '';
        const hasFilter = q || ap || sev;
        if (hasFilter && !allShown) showAllRows();
        if (clearBtn) clearBtn.style.display = hasFilter ? 'inline-block' : 'none';
        const rows = tbody ? tbody.querySelectorAll('.ec-table-row') : [];
        let visible = 0;
        rows.forEach(row => {
            const rSearch = row.dataset.search || '';
            const rAp     = row.dataset.appliance || '';
            const rSev    = row.dataset.severity  || '';
            const matchQ = !q   || rSearch.includes(q);
            const matchA = !ap  || rAp === ap;
            const matchS = !sev || rSev === sev;
            const show   = matchQ && matchA && matchS;
            row.classList.toggle('ec-table-row--hidden', !show);
            if (show) visible++;
        });
        if (countEl) countEl.textContent = visible;
        if (noResults) noResults.classList.toggle('is-visible', visible === 0);
    }

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            if (dirSearch) dirSearch.value = searchInput.value;
            filterTable();
            if (searchInput.value) {
                document.getElementById('ec-directory')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }
    if (dirSearch) dirSearch.addEventListener('input',  filterTable);
    if (apFilter)  apFilter.addEventListener('change',  filterTable);
    if (sevFilter) sevFilter.addEventListener('change', filterTable);
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            if (dirSearch)   dirSearch.value   = '';
            if (searchInput) searchInput.value = '';
            if (apFilter)    apFilter.value    = '';
            if (sevFilter)   sevFilter.value   = '';
            filterTable();
        });
    }
    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', () => {
            showAllRows();
            filterTable();
        });
    }
    const params = new URLSearchParams(window.location.search);
    const pAp    = params.get('appliance');
    if (pAp && apFilter) { apFilter.value = pAp; }
    if (pAp) filterTable();
})();
</script>

<?php get_footer(); ?>
