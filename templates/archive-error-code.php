<?php
/**
 * Archive: Error Codes
 * URL: /error-codes/
 * Design: matches vikingappliancerepairservice.com/error-codes/
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
$phone_raw  = get_option('ar_phone_raw', '+18000000000');
$biz        = ar_get_business_name();

/* Severity helper based on cost range */
function ec_severity(string $cost): array {
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
/* ── Error Code Archive — Scoped Styles ─────────────────── */
:root {
  --ec-red:    #C4943A;
  --ec-dark:   #1a1a1a;
  --ec-warm:   #f8f6f3;
  --ec-alt:    #f2f0ed;
  --ec-white:  #ffffff;
  --ec-border: #e5e0da;
  --ec-text:   #2c2c2c;
  --ec-muted:  #6b6560;
  --ec-radius: 10px;
  --ec-shadow: 0 2px 12px rgba(0,0,0,.07);
  --ec-shadow-md: 0 4px 20px rgba(0,0,0,.10);
}

/* ── Hero ─────────────────────────────────────────────── */
.ec-hero {
  background:
    url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg'); ?>') no-repeat center center / cover;
  background-color: #0D1B2A;
  padding: 72px 0 56px;
  position: relative;
  overflow: hidden;
}
.ec-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, rgba(13,27,42,.55) 0%, rgba(13,27,42,.25) 60%, rgba(13,27,42,.05) 100%);
  pointer-events: none;
  z-index: 0;
}
.ec-hero::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.12), transparent);
}
.ec-hero__inner {
  max-width: 780px;
  position: relative;
  z-index: 1;
}
.ec-hero__eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: .75rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: #C4943A;
  margin-bottom: 16px;
  background: rgba(255,255,255,.92);
  padding: 5px 14px 5px 10px;
  border-radius: 4px;
  text-shadow: none;
}
.ec-hero__eyebrow::before {
  content: '';
  display: block;
  width: 16px;
  height: 2px;
  background: #C4943A;
}
.ec-hero__title {
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.15;
  margin: 0 0 16px;
  text-shadow: 0 2px 16px rgba(0,0,0,.8), 0 1px 4px rgba(0,0,0,.7);
}
.ec-hero__title em {
  font-style: normal;
  color: #C4943A;
}
.ec-hero__subtitle {
  font-size: 1.0625rem;
  color: #fff;
  line-height: 1.65;
  margin: 0 0 32px;
  max-width: 640px;
  text-shadow: 0 1px 10px rgba(0,0,0,.75), 0 1px 3px rgba(0,0,0,.6);
  font-weight: 500;
}
.ec-hero__search {
  display: flex;
  align-items: center;
  max-width: 560px;
  background: rgba(255,255,255,.08);
  border: 1.5px solid rgba(255,255,255,.2);
  border-radius: 50px;
  padding: 6px 6px 6px 20px;
  gap: 8px;
  transition: border-color .2s, background .2s;
  backdrop-filter: blur(8px);
}
.ec-hero__search:focus-within {
  background: rgba(255,255,255,.12);
  border-color: rgba(255,255,255,.4);
}
.ec-hero__search svg { color: rgba(255,255,255,.5); flex-shrink: 0; }
.ec-hero__search input {
  flex: 1;
  background: none;
  border: none;
  outline: none;
  color: #fff;
  font-size: .9375rem;
  font-family: inherit;
}
.ec-hero__search input::placeholder { color: rgba(255,255,255,.4); }
.ec-hero__search button {
  background: #C4943A;
  color: #fff;
  border: none;
  border-radius: 50px;
  padding: 10px 22px;
  font-size: .875rem;
  font-weight: 700;
  cursor: pointer;
  white-space: nowrap;
  transition: background .2s, box-shadow .2s;
}
.ec-hero__search button:hover { background: #9E7428; box-shadow: 0 4px 16px rgba(196,148,58,.4); }
.ec-hero__stats {
  display: flex;
  gap: 32px;
  margin-top: 40px;
  padding-top: 32px;
  border-top: 1px solid rgba(255,255,255,.1);
}
.ec-stat__num {
  font-size: 1.75rem;
  font-weight: 800;
  color: #fff;
  line-height: 1;
}
.ec-stat__label {
  font-size: .78rem;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: .07em;
  margin-top: 4px;
}

/* ── Browse by Appliance ──────────────────────────────── */
.ec-browse {
  padding: 72px 0 56px;
  background: var(--ec-warm);
}
.ec-browse__head {
  margin-bottom: 40px;
}
.ec-browse__eyebrow {
  font-size: .72rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--ec-red);
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 10px;
}
.ec-browse__eyebrow::before {
  content: '';
  width: 20px;
  height: 2px;
  background: var(--ec-red);
}
.ec-browse__title {
  font-size: 1.875rem;
  font-weight: 800;
  color: var(--ec-dark);
  margin: 0 0 8px;
}
.ec-browse__sub {
  font-size: .9375rem;
  color: var(--ec-muted);
}
.ec-ap-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 16px;
}
.ec-ap-card {
  background: var(--ec-white);
  border: 1px solid var(--ec-border);
  border-radius: var(--ec-radius);
  padding: 24px 20px 20px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  gap: 10px;
  transition: transform .2s, box-shadow .2s, border-color .2s;
  position: relative;
  overflow: hidden;
}
.ec-ap-card::before {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 3px;
  background: var(--ec-red);
  transform: scaleY(0);
  transform-origin: bottom;
  transition: transform .25s;
}
.ec-ap-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--ec-shadow-md);
  border-color: rgba(27,58,107,.2);
}
.ec-ap-card:hover::before { transform: scaleY(1); }
.ec-ap-card__icon {
  width: 40px;
  height: 40px;
  background: rgba(27,58,107,.08);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--ec-red);
}
.ec-ap-card__icon svg { width: 22px; height: 22px; }
.ec-ap-card__name {
  font-size: 1rem;
  font-weight: 700;
  color: var(--ec-dark);
}
.ec-ap-card__count {
  font-size: .8rem;
  color: var(--ec-muted);
}
.ec-ap-card__arrow {
  font-size: .8rem;
  color: var(--ec-red);
  font-weight: 600;
  margin-top: auto;
}

/* ── Directory ────────────────────────────────────────── */
.ec-dir {
  padding: 72px 0 80px;
  background: var(--ec-white);
}
.ec-dir__head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px;
  margin-bottom: 32px;
}
.ec-dir__title {
  font-size: 1.75rem;
  font-weight: 800;
  color: var(--ec-dark);
  margin: 0;
}
.ec-dir__count {
  font-size: .875rem;
  color: var(--ec-muted);
}

/* Filter bar */
.ec-filters {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 24px;
  align-items: center;
}
.ec-filter-input {
  flex: 1;
  min-width: 200px;
  padding: 10px 16px;
  border: 1.5px solid var(--ec-border);
  border-radius: 50px;
  font-size: .875rem;
  font-family: inherit;
  color: var(--ec-text);
  background: var(--ec-warm);
  outline: none;
  transition: border-color .2s;
}
.ec-filter-input:focus { border-color: var(--ec-red); background: #fff; }
.ec-filter-select {
  padding: 10px 36px 10px 14px;
  border: 1.5px solid var(--ec-border);
  border-radius: 50px;
  font-size: .875rem;
  font-family: inherit;
  color: var(--ec-text);
  background: var(--ec-warm) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b6560' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 12px center;
  -webkit-appearance: none;
  cursor: pointer;
  outline: none;
  transition: border-color .2s;
}
.ec-filter-select:focus { border-color: var(--ec-red); background-color: #fff; }
.ec-filter-clear {
  font-size: .8125rem;
  color: var(--ec-muted);
  background: none;
  border: none;
  cursor: pointer;
  padding: 4px 8px;
  text-decoration: underline;
  transition: color .15s;
}
.ec-filter-clear:hover { color: var(--ec-red); }

/* Table */
.ec-table-wrap {
  overflow-x: auto;
  border: 1px solid var(--ec-border);
  border-radius: var(--ec-radius);
}
.ec-table {
  width: 100%;
  border-collapse: collapse;
  font-size: .9rem;
}
.ec-table thead th {
  background: var(--ec-warm);
  color: var(--ec-muted);
  font-size: .72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .07em;
  padding: 12px 16px;
  text-align: left;
  border-bottom: 1px solid var(--ec-border);
  white-space: nowrap;
}
.ec-table tbody tr {
  border-bottom: 1px solid var(--ec-border);
  transition: background .15s;
}
.ec-table tbody tr:last-child { border-bottom: none; }
.ec-table tbody tr:hover { background: #faf9f7; }
.ec-table td {
  padding: 14px 16px;
  color: var(--ec-text);
  vertical-align: middle;
}
.ec-code-badge {
  display: inline-flex;
  align-items: center;
  background: rgba(27,58,107,.08);
  color: var(--ec-red);
  font-size: .8rem;
  font-weight: 800;
  font-family: 'Courier New', monospace;
  letter-spacing: .03em;
  padding: 4px 10px;
  border-radius: 6px;
  border: 1px solid rgba(27,58,107,.15);
  white-space: nowrap;
}
.ec-brand-chip {
  display: inline-block;
  font-size: .78rem;
  font-weight: 600;
  color: var(--ec-muted);
  background: var(--ec-alt);
  padding: 3px 9px;
  border-radius: 20px;
}
.ec-ap-chip {
  font-size: .85rem;
  color: var(--ec-text);
}
.ec-fault-text {
  color: var(--ec-text);
  font-size: .875rem;
  line-height: 1.4;
}
.ec-fault-title {
  font-weight: 600;
  display: block;
  margin-bottom: 2px;
}
.ec-fault-hint {
  font-size: .78rem;
  color: var(--ec-muted);
}

/* Severity badges */
.ec-sev {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: .72rem;
  font-weight: 700;
  letter-spacing: .04em;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 20px;
  white-space: nowrap;
}
.ec-sev::before {
  content: '';
  width: 6px; height: 6px;
  border-radius: 50%;
}
.ec-sev--low    { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
.ec-sev--low::before    { background: #15803d; }
.ec-sev--med    { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
.ec-sev--med::before    { background: #b45309; }
.ec-sev--high   { background: #fff1f2; color: #1B3A6B; border: 1px solid #fecdd3; }
.ec-sev--high::before   { background: #1B3A6B; }

.ec-view-link {
  color: var(--ec-red);
  font-size: .8125rem;
  font-weight: 600;
  text-decoration: none;
  white-space: nowrap;
  transition: color .15s;
}
.ec-view-link:hover { color: #9E7428; text-decoration: underline; }

/* No results / hidden rows */
.ec-table-row--hidden { display: none; }
.ec-no-results {
  padding: 48px 24px;
  text-align: center;
  color: var(--ec-muted);
  font-size: .9375rem;
  display: none;
}
.ec-no-results.is-visible { display: block; }

/* Show more */
.ec-showmore-wrap {
  text-align: center;
  margin-top: 28px;
}
.ec-showmore-btn {
  background: var(--ec-warm);
  border: 1.5px solid var(--ec-border);
  color: var(--ec-text);
  font-size: .875rem;
  font-weight: 600;
  font-family: inherit;
  padding: 12px 28px;
  border-radius: 50px;
  cursor: pointer;
  transition: background .2s, border-color .2s;
}
.ec-showmore-btn:hover { background: var(--ec-alt); border-color: #c5bfb8; }

/* ── CTA Band ─────────────────────────────────────────── */
.ec-cta {
  background: var(--ec-dark);
  padding: 72px 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.ec-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 60% 80% at 50% 50%, rgba(27,58,107,.12) 0%, transparent 70%);
  pointer-events: none;
}
.ec-cta__eyebrow {
  font-size: .72rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--ec-red);
  margin-bottom: 12px;
}
.ec-cta__title {
  font-size: clamp(1.5rem, 3vw, 2.25rem);
  font-weight: 800;
  color: #fff;
  margin: 0 0 12px;
}
.ec-cta__sub {
  color: rgba(255,255,255,.65);
  font-size: 1rem;
  max-width: 520px;
  margin: 0 auto 36px;
}
.ec-cta__btns {
  display: flex;
  gap: 14px;
  justify-content: center;
  flex-wrap: wrap;
}
.ec-btn--red {
  background: var(--ec-red);
  color: #fff;
  padding: 14px 32px;
  border-radius: 50px;
  font-size: .9375rem;
  font-weight: 700;
  text-decoration: none;
  display: inline-block;
  transition: background .2s, transform .15s;
}
.ec-btn--red:hover { background: #9E7428; transform: translateY(-1px); }
.ec-btn--ghost {
  color: rgba(255,255,255,.8);
  padding: 14px 32px;
  border-radius: 50px;
  font-size: .9375rem;
  font-weight: 600;
  text-decoration: none;
  display: inline-block;
  border: 1.5px solid rgba(255,255,255,.2);
  transition: background .2s, border-color .2s;
}
.ec-btn--ghost:hover { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.4); }

/* ── Grouped Sections (by appliance) ─────────────────── */
.ec-sections {
  padding: 72px 0 80px;
  background: var(--ec-warm);
}
.ec-sections__head {
  margin-bottom: 48px;
}
.ec-sections__eyebrow {
  font-size: .72rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--ec-red);
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 10px;
}
.ec-sections__eyebrow::before {
  content: '';
  width: 20px;
  height: 2px;
  background: var(--ec-red);
}
.ec-sections__title {
  font-size: 1.875rem;
  font-weight: 800;
  color: var(--ec-dark);
  margin: 0 0 8px;
}
.ec-sections__sub {
  font-size: .9375rem;
  color: var(--ec-muted);
  max-width: 600px;
}
.ec-ap-section {
  background: var(--ec-white);
  border: 1px solid var(--ec-border);
  border-radius: var(--ec-radius);
  margin-bottom: 16px;
  overflow: hidden;
  scroll-margin-top: 100px;
}
.ec-ap-section__header {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 20px 24px;
  cursor: pointer;
  user-select: none;
  transition: background .15s;
}
.ec-ap-section__header:hover { background: #faf9f7; }
.ec-ap-section__icon {
  width: 48px;
  height: 48px;
  background: rgba(27,58,107,.08);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--ec-red);
  flex-shrink: 0;
}
.ec-ap-section__icon svg { width: 24px; height: 24px; }
.ec-ap-section__meta { flex: 1; }
.ec-ap-section__title {
  font-size: 1.125rem;
  font-weight: 700;
  color: var(--ec-dark);
  margin: 0 0 2px;
}
.ec-ap-section__count {
  font-size: .8125rem;
  color: var(--ec-muted);
  margin: 0;
}
.ec-ap-section__toggle {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--ec-muted);
  font-size: .8125rem;
  font-weight: 600;
}
.ec-toggle-icon {
  width: 20px; height: 20px;
  transition: transform .25s;
}
.ec-ap-section.is-open .ec-toggle-icon { transform: rotate(180deg); }
.ec-ap-section.is-open .ec-ap-section__toggle-label { display: none; }
.ec-ap-section.is-open::before {
  content: '';
  display: block;
  height: 3px;
  background: var(--ec-red);
  margin: 0;
}
.ec-ap-section__desc {
  font-size: .9rem;
  color: var(--ec-muted);
  line-height: 1.6;
  padding: 0 24px 16px;
  margin: 0;
  border-bottom: 1px solid var(--ec-border);
  display: none;
}
.ec-ap-section.is-open .ec-ap-section__desc { display: block; }
.ec-ap-section__body {
  display: none;
  overflow-x: auto;
}
.ec-ap-section.is-open .ec-ap-section__body { display: block; }
.ec-ap-table { border-top: 1px solid var(--ec-border); }
.ec-ap-table thead th { background: var(--ec-alt); }

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 768px) {
  .ec-hero { padding: 80px 0 40px; }
  .ec-hero__stats { gap: 20px; flex-wrap: wrap; }
  .ec-browse, .ec-dir, .ec-cta { padding: 48px 0; }
  .ec-ap-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
  .ec-table td:nth-child(2),
  .ec-table th:nth-child(2) { display: none; } /* Hide brand col on mobile */
  .ec-dir__head { flex-direction: column; align-items: flex-start; }
}
@media (max-width: 480px) {
  .ec-ap-grid { grid-template-columns: 1fr 1fr; }
  .ec-table td:nth-child(3),
  .ec-table th:nth-child(3) { display: none; } /* Hide appliance col on very small screens */
  .ec-hero__search { flex-direction: column; border-radius: 14px; padding: 12px; }
  .ec-hero__search button { width: 100%; text-align: center; border-radius: 8px; padding: 12px; }
}
</style>

<!-- ── HERO ──────────────────────────────────────────────── -->
<section class="ec-hero">
  <div class="container">
    <div class="ec-hero__inner">
      <p class="ec-hero__eyebrow">Diagnostic Library</p>
      <h1 class="ec-hero__title">Viking <em>Fault Code</em> Library</h1>
      <p class="ec-hero__subtitle">Find what your Viking appliance's fault code means, how serious it is, and exactly what to do next &mdash; covering ranges, wall ovens, refrigerators, dishwashers, cooktops, wine coolers, freezers, and vent hoods.</p>

      <div class="ec-hero__search" id="ec-hero-search">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input type="text" id="ec-search-input" placeholder="Search by fault code or appliance type…" autocomplete="off" aria-label="Search Viking fault codes">
        <button type="button" onclick="document.getElementById('ec-search-input').focus()">Search</button>
      </div>

      <div class="ec-hero__stats">
        <div>
          <div class="ec-stat__num"><?php echo $total ?: '40+'; ?></div>
          <div class="ec-stat__label">Error Codes</div>
        </div>
        <div>
          <div class="ec-stat__num"><?php echo count($appliances) ?: '8'; ?></div>
          <div class="ec-stat__label">Appliance Types</div>
        </div>
        <div>
          <div class="ec-stat__num">Viking</div>
          <div class="ec-stat__label">Brand</div>
        </div>
        <div>
          <div class="ec-stat__num">30-Day</div>
          <div class="ec-stat__label">Repair Warranty</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── ERROR CODES BY APPLIANCE TYPE ──────────────────────── -->
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
<section class="ec-sections" id="ec-appliance-sections">
  <div class="container">
    <div class="ec-sections__head">
      <p class="ec-sections__eyebrow">Grouped by Appliance</p>
      <h2 class="ec-sections__title">Error Codes by Appliance Type</h2>
      <p class="ec-sections__sub">Browse error codes specific to your appliance. Click any row to see causes, DIY checks, and repair costs.</p>
    </div>

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

      /* Description */
      $ap_desc = '';
      foreach ($ap_descriptions as $key => $desc) {
        if (str_contains($ap_slug, $key)) { $ap_desc = $desc; break; }
      }

      /* Count unique brands */
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
      <div class="ec-ap-section__header" onclick="ecToggleSection(this)">
        <div class="ec-ap-section__icon"><?php echo $icon_html; ?></div>
        <div class="ec-ap-section__meta">
          <h3 class="ec-ap-section__title"><?php echo esc_html($ap_name); ?> Error Codes</h3>
          <p class="ec-ap-section__count"><?php echo $ap_count; ?> error code<?php echo $ap_count !== 1 ? 's' : ''; ?> &mdash; <?php echo count($ap_brands); ?> brand<?php echo count($ap_brands) !== 1 ? 's' : ''; ?></p>
        </div>
        <div class="ec-ap-section__toggle">
          <span class="ec-ap-section__toggle-label">Expand</span>
          <svg class="ec-toggle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
        </div>
      </div>
      <?php if ($ap_desc): ?>
      <p class="ec-ap-section__desc"><?php echo esc_html($ap_desc); ?></p>
      <?php endif; ?>
      <div class="ec-ap-section__body">
        <div class="ec-table-wrap" style="border:none;border-radius:0;">
          <table class="ec-table ec-ap-table">
            <thead>
              <tr>
                <th>Error Code</th>
                <th>Brand</th>
                <th>Fault Description</th>
                <th>Severity</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php if ($ap_codes->have_posts()):
              while ($ap_codes->have_posts()): $ap_codes->the_post();
                $pid        = get_the_ID();
                $brand      = get_post_meta($pid, '_ar_brand',         true) ?: '';
                $code       = get_post_meta($pid, '_ar_error_code',    true) ?: '';
                $meaning    = get_post_meta($pid, '_ar_code_meaning',  true) ?: get_the_excerpt();
                $cost       = get_post_meta($pid, '_ar_cost_range',    true) ?: '';
                $sev        = ec_severity($cost);
                $title      = get_the_title();
                $url        = get_permalink();
                $fault_desc = wp_strip_all_tags($meaning);
                $fault_short = mb_strimwidth($fault_desc, 0, 85, '…');
            ?>
            <tr>
              <td><a href="<?php echo esc_url($url); ?>" class="ec-code-badge"><?php echo esc_html($code ?: $title); ?></a></td>
              <td><span class="ec-brand-chip"><?php echo esc_html($brand); ?></span></td>
              <td>
                <div class="ec-fault-text">
                  <span class="ec-fault-title"><?php echo esc_html($title); ?></span>
                  <?php if ($fault_short): ?><span class="ec-fault-hint"><?php echo esc_html($fault_short); ?></span><?php endif; ?>
                </div>
              </td>
              <td><span class="ec-sev <?php echo esc_attr($sev['cls']); ?>"><?php echo esc_html($sev['label']); ?></span></td>
              <td><a href="<?php echo esc_url($url); ?>" class="ec-view-link">View →</a></td>
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

<!-- ── ERROR CODE DIRECTORY ───────────────────────────────── -->
<section class="ec-dir" id="ec-directory">
  <div class="container">
    <div class="ec-dir__head">
      <div>
        <h2 class="ec-dir__title">Complete Error Code Directory</h2>
        <p style="color:var(--ec-muted);font-size:.9rem;margin:4px 0 0;">
          <span id="ec-visible-count"><?php echo $total; ?></span> codes — click any row to view full diagnosis
        </p>
      </div>
      <div id="ec-active-filters" style="display:flex;gap:8px;flex-wrap:wrap;"></div>
    </div>

    <!-- Filters -->
    <div class="ec-filters">
      <input type="text" class="ec-filter-input" id="ec-dir-search" placeholder="&#x1F50D;  Search by code or brand…" aria-label="Filter codes">
      <select class="ec-filter-select" id="ec-brand-filter" aria-label="Filter by brand">
        <option value="">All Brands</option>
        <?php foreach ($brands as $b): ?>
        <option value="<?php echo esc_attr(strtolower($b->name)); ?>"><?php echo esc_html($b->name); ?></option>
        <?php endforeach; ?>
      </select>
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
      </select>
      <button class="ec-filter-clear" id="ec-clear-filters" style="display:none;">&#x2715; Clear filters</button>
    </div>

    <!-- Table -->
    <div class="ec-table-wrap">
      <table class="ec-table" id="ec-main-table">
        <thead>
          <tr>
            <th>Error Code</th>
            <th>Brand</th>
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
              $pid      = get_the_ID();
              $brand    = get_post_meta($pid, '_ar_brand',         true) ?: '';
              $appliance= get_post_meta($pid, '_ar_appliance_type',true) ?: '';
              $code     = get_post_meta($pid, '_ar_error_code',    true) ?: '';
              $meaning  = get_post_meta($pid, '_ar_code_meaning',  true) ?: get_the_excerpt();
              $cost     = get_post_meta($pid, '_ar_cost_range',    true) ?: '';
              $sev      = ec_severity($cost);
              $title    = get_the_title();
              $url      = get_permalink();
              // Short fault description from meaning
              $fault_desc = wp_strip_all_tags($meaning);
              $fault_short= mb_strimwidth($fault_desc, 0, 90, '…');
              // Data attrs for JS filtering
              $da_brand = strtolower($brand);
              $da_ap    = sanitize_title($appliance);
              $da_sev   = strtolower($sev['label']);
              $da_search= strtolower("$brand $code $appliance $title");
              $hidden   = $row_idx >= 20 ? ' ec-table-row--hidden ec-extra-row' : '';
              $row_idx++;
          ?>
          <tr class="ec-table-row<?php echo $hidden; ?>"
              data-brand="<?php echo esc_attr($da_brand); ?>"
              data-appliance="<?php echo esc_attr($da_ap); ?>"
              data-severity="<?php echo esc_attr($da_sev); ?>"
              data-search="<?php echo esc_attr($da_search); ?>">
            <td>
              <a href="<?php echo esc_url($url); ?>" class="ec-code-badge"><?php echo esc_html($code ?: '—'); ?></a>
            </td>
            <td><span class="ec-brand-chip"><?php echo esc_html($brand); ?></span></td>
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
            <td><a href="<?php echo esc_url($url); ?>" class="ec-view-link">View →</a></td>
          </tr>
          <?php endwhile; wp_reset_postdata(); endif; ?>
        </tbody>
      </table>
      <p class="ec-no-results" id="ec-no-results">No error codes match your search. <a href="tel:<?php echo esc_attr($phone_raw); ?>" style="color:var(--ec-red);">Call us directly →</a></p>
    </div>

    <?php if ($total > 20): ?>
    <div class="ec-showmore-wrap">
      <button class="ec-showmore-btn" id="ec-showmore">
        Show all <?php echo $total; ?> error codes ↓
      </button>
    </div>
    <?php endif; ?>

  </div>
</section>

<!-- ── CTA BAND ──────────────────────────────────────────── -->
<section class="ec-cta">
  <div class="container" style="position:relative;z-index:1;">
    <p class="ec-cta__eyebrow">Can't Find Your Code?</p>
    <h2 class="ec-cta__title">Speak Directly With a Technician</h2>
    <p class="ec-cta__sub">Our certified technicians can diagnose any error code over the phone or in person — same-day appointments available.</p>
    <div class="ec-cta__btns">
      <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="ec-btn--red">&#x1F4DE; <?php echo esc_html($phone); ?></a>
      <a href="/schedule/" class="ec-btn--ghost">Schedule Online →</a>
    </div>
  </div>
</section>

<!-- ── APPOINTMENT FORM ───────────────────────────────────── -->
<div id="book" style="scroll-margin-top:80px;">
  <?php ar_appointment_form('error-code-archive', "Book a Diagnostic Appointment"); ?>
</div>

<?php ar_disclaimer(); ?>

<script>
/* Accordion toggle for appliance sections */
function ecToggleSection(headerEl) {
  var section = headerEl.closest('.ec-ap-section');
  if (!section) return;
  var isOpen = section.classList.contains('is-open');
  if (isOpen) {
    section.classList.remove('is-open');
    var lbl = headerEl.querySelector('.ec-ap-section__toggle-label');
    if (lbl) lbl.textContent = 'Expand';
  } else {
    section.classList.add('is-open');
    var lbl = headerEl.querySelector('.ec-ap-section__toggle-label');
    if (lbl) lbl.textContent = 'Collapse';
    /* Smooth scroll to section */
    setTimeout(function() {
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 50);
  }
}

/* Auto-open section if URL hash matches */
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
  const brandFilter  = document.getElementById('ec-brand-filter');
  const apFilter     = document.getElementById('ec-ap-filter');
  const sevFilter    = document.getElementById('ec-sev-filter');
  const clearBtn     = document.getElementById('ec-clear-filters');
  const countEl      = document.getElementById('ec-visible-count');
  const noResults    = document.getElementById('ec-no-results');
  const showMoreBtn  = document.getElementById('ec-showmore');
  const tbody        = document.getElementById('ec-tbody');
  const extraRows    = tbody ? tbody.querySelectorAll('.ec-extra-row') : [];

  let allShown = false;

  /* Show all extra rows when filters are active */
  function showAllRows() {
    extraRows.forEach(r => r.classList.remove('ec-table-row--hidden'));
    allShown = true;
    if (showMoreBtn) showMoreBtn.style.display = 'none';
  }

  function filterTable() {
    const q    = (dirSearch?.value || searchInput?.value || '').toLowerCase().trim();
    const brand= brandFilter?.value.toLowerCase() || '';
    const ap   = apFilter?.value || '';
    const sev  = sevFilter?.value || '';

    const hasFilter = q || brand || ap || sev;
    if (hasFilter && !allShown) showAllRows();

    if (clearBtn) clearBtn.style.display = hasFilter ? 'inline-block' : 'none';

    const rows = tbody ? tbody.querySelectorAll('.ec-table-row') : [];
    let visible = 0;

    rows.forEach(row => {
      const rSearch = row.dataset.search || '';
      const rBrand  = row.dataset.brand  || '';
      const rAp     = row.dataset.appliance || '';
      const rSev    = row.dataset.severity  || '';

      const matchQ   = !q     || rSearch.includes(q);
      const matchB   = !brand || rBrand.includes(brand);
      const matchA   = !ap    || rAp === ap;
      const matchS   = !sev   || rSev === sev;
      const show     = matchQ && matchB && matchA && matchS;

      row.classList.toggle('ec-table-row--hidden', !show);
      if (show) visible++;
    });

    if (countEl) countEl.textContent = visible;
    if (noResults) noResults.classList.toggle('is-visible', visible === 0);
  }

  /* Sync hero search to dir search */
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      if (dirSearch) dirSearch.value = searchInput.value;
      filterTable();
      if (searchInput.value) {
        document.getElementById('ec-directory')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }

  if (dirSearch)   dirSearch.addEventListener('input',  filterTable);
  if (brandFilter) brandFilter.addEventListener('change', filterTable);
  if (apFilter)    apFilter.addEventListener('change',  filterTable);
  if (sevFilter)   sevFilter.addEventListener('change', filterTable);

  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      if (dirSearch)   dirSearch.value   = '';
      if (searchInput) searchInput.value = '';
      if (brandFilter) brandFilter.value = '';
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

  /* Handle URL params (brand/appliance from appliance cards) */
  const params = new URLSearchParams(window.location.search);
  const pBrand = params.get('brand');
  const pAp    = params.get('appliance');
  if (pBrand && brandFilter) { brandFilter.value = pBrand.toLowerCase(); }
  if (pAp    && apFilter)    { apFilter.value    = pAp; }
  if (pBrand || pAp) filterTable();
})();
</script>

<?php get_footer(); ?>



