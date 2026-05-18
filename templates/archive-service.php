<?php
/**
 * Archive: Service Pages
 * URL: /services/ and /services/?appliance=wall-oven etc.
 * Design: OBSIDIAN — off-white hero, Cormorant headings, thin rules, horizontal rows
 */
defined('ABSPATH') || exit;

$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();

// Appliance definitions
$appliance_data = [
    'range' => [
        'label'  => 'Range',
        'term'   => 'Range',
        'slug'   => 'viking-range-repair',
        'image'  => '/assets/images/viking-kitchen-miramar.jpg',
        'intro'  => 'Viking gas and dual-fuel ranges are built to professional kitchen standards, featuring pro sealed burners with up to 23,000 BTU output and precision oven temperature control. When your Viking range displays a fault code, a burner fails to ignite, or the oven won\'t heat, our certified technicians diagnose the root cause and repair it with genuine Viking OEM parts on the first visit. We service the full Viking range lineup including Professional Series, Tuscany, and Virtuoso models.',
        'issues' => ['F2 / F3 Temperature Sensor Fault', 'F9 Door Lock Failure', 'Burner Not Igniting', 'Oven Not Heating', 'F1 Control Board Fault', 'F4 Temperature Runaway'],
    ],
    'refrigerator' => [
        'label'  => 'Refrigerator',
        'term'   => 'Refrigerator',
        'slug'   => 'viking-refrigerator-repair',
        'image'  => '/assets/images/viking-refrigerator-3series.jpg',
        'intro'  => 'Viking built-in and freestanding refrigerators deliver precision temperature management for optimal food preservation. Common faults include defrost system failures that cause the refrigerator compartment to warm, ice maker malfunctions, condenser fan motor failures, and compressor issues. Our technicians carry genuine Viking OEM refrigerator components and can complete most repairs on the first visit.',
        'issues' => ['Not Cooling', 'Ice Maker Not Working', 'Excessive Noise', 'Water Leaking', 'Temperature Fluctuation', 'Compressor Not Running'],
    ],
    'dishwasher' => [
        'label'  => 'Dishwasher',
        'term'   => 'Dishwasher',
        'slug'   => 'viking-dishwasher-repair',
        'image'  => '/assets/images/viking-dishwasher-7series.jpg',
        'intro'  => 'Viking Professional dishwashers deliver quiet, thorough cleaning with a multi-level spray system and stainless steel interior. When your Viking dishwasher fails to clean properly, won\'t drain, or leaves water in the tub, our certified technicians identify the specific component fault and replace it with a genuine Viking OEM part. Most Viking dishwasher repairs are completed in a single visit.',
        'issues' => ['Not Cleaning Properly', 'Not Draining', 'Water in Tub After Cycle', 'Door Latch Failure', 'Water Leaking', 'Not Starting'],
    ],
    'cooktop' => [
        'label'  => 'Cooktop',
        'term'   => 'Cooktop',
        'slug'   => 'viking-cooktop-repair',
        'image'  => '/assets/images/48InductionHomepageSlide2025-2.png',
        'intro'  => 'Viking gas, electric, and induction cooktops are engineered for high-performance cooking in residential kitchens. When a Viking cooktop burner won\'t ignite, a surface element fails to heat, or an induction zone stops responding, our technicians diagnose and repair the fault with genuine Viking OEM parts. Most Viking cooktop repairs are completed in a single visit.',
        'issues' => ['Gas Burner Not Igniting', 'Continuous Clicking', 'Burner Flame Extinguishes', 'Surface Element Not Heating', 'Induction Zone Not Responding', 'Control Panel Unresponsive'],
    ],
    'wall-oven' => [
        'label'  => 'Wall Oven',
        'term'   => 'Wall Oven',
        'slug'   => 'viking-wall-oven-repair',
        'image'  => '/assets/images/viking-wall-oven-7series.jpg',
        'intro'  => 'Viking single and double wall ovens feature TruConvec convection systems for precise, even baking and roasting. When a Viking wall oven fails to heat, displays an F-code fault, or the self-clean door won\'t unlock, our certified technicians identify and repair the root cause using genuine Viking OEM components.',
        'issues' => ['Not Heating', 'F2 / F3 Sensor Fault', 'F9 Door Lock Failure', 'Temperature Inaccuracy', 'F4 Temperature Runaway', 'F1 Control Board Fault'],
    ],
    'wine-cooler' => [
        'label'  => 'Wine Cooler',
        'term'   => 'Wine Cooler',
        'slug'   => 'viking-wine-cooler-repair',
        'image'  => '/assets/images/viking-wine-cellar.jpg',
        'intro'  => 'Viking wine cellars and wine coolers are designed for precise temperature and humidity management for proper wine storage. When a Viking wine cooler fails to maintain temperature, makes unusual noise, or displays a fault code, our certified technicians diagnose and repair the issue with genuine Viking OEM parts.',
        'issues' => ['Not Cooling', 'Compressor Running Continuously', 'Excessive Noise', 'Temperature Fluctuating', 'Fault Code on Display', 'Interior Light Failure'],
    ],
    'freezer' => [
        'label'  => 'Freezer',
        'term'   => 'Freezer',
        'slug'   => 'viking-freezer-repair',
        'image'  => '/assets/images/viking-refrigerator-integrated.jpg',
        'intro'  => 'Viking built-in column freezers and upright freezers are engineered to maintain consistent sub-zero temperatures for long-term food preservation. When a Viking freezer develops a defrost fault, excessive frost buildup, or fails to maintain temperature, our certified technicians diagnose and resolve the issue using genuine Viking OEM parts.',
        'issues' => ['Not Reaching Temperature', 'Excessive Frost Buildup', 'Defrost System Fault', 'Temperature Alarm', 'Unusual Noise', 'Door Seal Failure'],
    ],
    'vent-hood' => [
        'label'  => 'Vent Hood',
        'term'   => 'Vent Hood',
        'slug'   => 'viking-vent-hood-repair',
        'image'  => '/assets/images/viking-5series-kitchen.jpg',
        'intro'  => 'Viking Professional vent hoods and range hoods are designed to efficiently remove smoke, steam, grease, and odors from above Viking ranges and cooktops. When a Viking vent hood develops a blower motor fault, lighting failure, or control panel issue, our certified technicians repair it using genuine Viking OEM components.',
        'issues' => ['Weak or No Suction', 'Blower Motor Not Running', 'Unusual Noise During Operation', 'Lights Not Working', 'Control Panel Unresponsive', 'Grease Filter Warning'],
    ],
];

$filter_appliance = sanitize_text_field($_GET['appliance'] ?? '');
$active_data      = $filter_appliance && isset($appliance_data[$filter_appliance])
                    ? $appliance_data[$filter_appliance]
                    : null;

// WP_Query
$tax_query = [['taxonomy' => 'brand', 'field' => 'slug', 'terms' => 'viking']];
if ($active_data) {
    $tax_query[] = ['taxonomy' => 'appliance_type', 'field' => 'name', 'terms' => $active_data['term']];
}
$services_query = new WP_Query([
    'post_type'      => 'service_page',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    'tax_query'      => $tax_query,
]);

get_header();
?>
<style>
/* ── Archive Service — OBSIDIAN Design ─────────────────── */

/* ph-split hero panel */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) { .ph-split { display: block; } .ph-split__img { height: 280px; position: relative; } .ph-split__img img { position: absolute; } .ph-split__img::before { display: none; } }

/* Hero */
.svc-hero {
    background: var(--color-bg-light, #F7F6F3);
    padding-bottom: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.svc-hero__inner {
    max-width: 860px;
}
.svc-hero__eyebrow {
    display: inline-block;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: 1.25rem;
}
.svc-hero__title {
    font-family: var(--font-display, 'Libre Baskerville', Georgia, serif);
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.1;
    letter-spacing: -.02em;
    margin: 0 0 1.25rem;
}
.svc-hero__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: 1.0625rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.7;
    margin: 0;
    max-width: 620px;
}

/* Filter nav */
.svc-filters {
    background: #ffffff;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    position: sticky;
    top: 64px;
    z-index: 90;
    overflow-x: auto;
    scrollbar-width: none;
}
.svc-filters::-webkit-scrollbar { display: none; }
.svc-filters__inner {
    display: flex;
    gap: 0;
    min-width: max-content;
}
.svc-filter-tab {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    font-weight: 600;
    color: var(--color-text-muted, #717170);
    text-decoration: none;
    padding: 1rem 1.375rem;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
    transition: color .15s, border-color .15s;
    letter-spacing: .02em;
}
.svc-filter-tab:hover { color: var(--color-primary-dark, #0D0D0D); }
.svc-filter-tab.is-active {
    color: var(--color-primary, #C01C28);
    border-bottom-color: var(--color-primary, #C01C28);
}

/* Common issues strip */
.svc-issues {
    background: #ffffff;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    padding: 2.5rem 0;
}
.svc-issues__label {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: 1.25rem;
}
.svc-issues__list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1px solid var(--color-rule, #D9D8D3);
}
.svc-issues__item {
    display: flex;
    align-items: center;
    gap: .625rem;
    padding: .875rem 1.125rem;
    border-right: 1px solid var(--color-rule, #D9D8D3);
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    font-weight: 500;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.35;
}
.svc-issues__item:nth-child(3n) { border-right: none; }
.svc-issues__check {
    color: var(--color-primary, #C01C28);
    font-size: .75rem;
    flex-shrink: 0;
    line-height: 1;
}

/* Intro description */
.svc-intro-strip {
    background: var(--color-bg-light, #F7F6F3);
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    padding: 2.5rem 0;
}
.svc-intro-text {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.8;
    max-width: 760px;
    border-left: 2px solid var(--color-rule, #D9D8D3);
    padding-left: 1.25rem;
}

/* Main grid section */
.svc-main {
    background: #ffffff;
    padding: 4rem 0 5rem;
}
.svc-section-head {
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.svc-section-eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: .75rem;
}
.svc-section-title {
    font-family: var(--font-display, 'Libre Baskerville', Georgia, serif);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0;
    letter-spacing: -.01em;
}
.svc-section-sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: var(--color-text-muted, #717170);
    margin: .625rem 0 0;
    max-width: 560px;
    line-height: 1.65;
}

/* Service rows — horizontal list */
.svc-rows {
    display: flex;
    flex-direction: column;
    gap: 0;
}
.svc-row {
    display: grid;
    grid-template-columns: 200px 1fr auto;
    gap: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    text-decoration: none;
    transition: background .15s;
    align-items: center;
}
.svc-row:first-child { border-top: 1px solid var(--color-rule, #D9D8D3); }
.svc-row:hover { background: var(--color-bg-light, #F7F6F3); }
.svc-row__img {
    height: 120px;
    overflow: hidden;
    background: var(--color-bg-section, #EEEDE8);
    flex-shrink: 0;
}
.svc-row__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform .35s ease;
}
.svc-row:hover .svc-row__img img { transform: scale(1.04); }
.svc-row__body {
    padding: 1.375rem 2rem;
    min-width: 0;
}
.svc-row__label {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: .375rem;
}
.svc-row__title {
    font-family: var(--font-display, 'Libre Baskerville', Georgia, serif);
    font-size: 1.375rem;
    font-weight: 400;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0 0 .375rem;
    line-height: 1.2;
}
.svc-row__desc {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.6;
    margin: 0;
}
.svc-row__arrow {
    padding: 0 1.75rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    font-weight: 600;
    color: var(--color-primary, #C01C28);
    white-space: nowrap;
    flex-shrink: 0;
}

/* Trust metrics */
.svc-trust {
    background: var(--color-bg-light, #F7F6F3);
    border-top: 1px solid var(--color-rule, #D9D8D3);
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    padding: 3rem 0;
    margin-top: 4rem;
}
.svc-trust__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
}
.svc-trust__item {
    text-align: center;
    padding: 0 2rem;
    border-right: 1px solid var(--color-rule, #D9D8D3);
}
.svc-trust__item:last-child { border-right: none; }
.svc-trust__num {
    font-family: var(--font-display, 'Libre Baskerville', Georgia, serif);
    font-size: 3.5rem;
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1;
    display: block;
    margin-bottom: .375rem;
}
.svc-trust__lbl {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    font-weight: 600;
    color: var(--color-text-muted, #717170);
    text-transform: uppercase;
    letter-spacing: .08em;
}

/* CTA band */
.svc-cta {
    background: var(--color-primary-dark, #0D0D0D);
    padding: 5rem 0;
    text-align: center;
}
.svc-cta__eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: rgba(255,255,255,.4);
    margin-bottom: .875rem;
}
.svc-cta__title {
    font-family: var(--font-display, 'Libre Baskerville', Georgia, serif);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 300;
    color: #ffffff;
    margin: 0 0 1rem;
    letter-spacing: -.01em;
}
.svc-cta__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: rgba(255,255,255,.6);
    max-width: 480px;
    margin: 0 auto 2.25rem;
    line-height: 1.7;
}
.svc-cta__btns {
    display: flex;
    gap: .875rem;
    justify-content: center;
    flex-wrap: wrap;
}
.svc-btn--crimson {
    background: var(--color-primary, #C01C28);
    color: #fff;
    padding: .875rem 1.875rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    border-radius: 2px;
    letter-spacing: .02em;
    transition: opacity .2s;
}
.svc-btn--crimson:hover { opacity: .88; }
.svc-btn--ghost-wht {
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
.svc-btn--ghost-wht:hover { border-color: rgba(255,255,255,.6); color: #fff; }

@media (max-width: 900px) {
    .svc-issues__list { grid-template-columns: repeat(2, 1fr); }
    .svc-issues__item:nth-child(3n) { border-right: 1px solid var(--color-rule, #D9D8D3); }
    .svc-issues__item:nth-child(2n) { border-right: none; }
    .svc-trust__grid { grid-template-columns: repeat(2, 1fr); }
    .svc-trust__item:nth-child(2) { border-right: none; }
    .svc-trust__item:last-child { border-top: 1px solid var(--color-rule, #D9D8D3); grid-column: 1/-1; padding-top: 2rem; border-right: none; }
}
@media (max-width: 700px) {
    .svc-row { grid-template-columns: 1fr; }
    .svc-row__img { height: 160px; width: 100%; }
    .svc-row__arrow { padding: 0 1.375rem 1.125rem; }
    .svc-issues__list { grid-template-columns: 1fr; }
    .svc-issues__item { border-right: none !important; }
    .svc-trust__grid { grid-template-columns: 1fr; }
    .svc-trust__item { border-right: none !important; border-top: 1px solid var(--color-rule, #D9D8D3); padding: 1.5rem 0; }
    .svc-trust__item:first-child { border-top: none; }
}
</style>

<!-- HERO -->
<?php
if ($active_data) {
    $svc_h1  = 'Viking ' . $active_data['label'] . ' Repair Service';
    $svc_sub = 'Certified Viking ' . $active_data['label'] . ' repair in your area. Genuine OEM parts, 30-day warranty, same-day service available.';
    $svc_eye = 'Viking ' . $active_data['label'] . ' Repair';
} else {
    $svc_h1  = 'Viking Appliance Repair Services';
    $svc_sub = 'Genuine Viking OEM parts. Certified technicians. 30-day parts and labor warranty on every repair.';
    $svc_eye = 'All Services';
}
?>
<section class="svc-hero" aria-labelledby="svc-arch-h1">
    <div class="ph-split">
        <div class="ph-split__text" style="padding-top: calc(64px + 5rem);">
            <div class="container">
                <div class="svc-hero__inner">
                    <span class="svc-hero__eyebrow"><?php echo esc_html($svc_eye); ?></span>
                    <h1 id="svc-arch-h1" class="svc-hero__title"><?php echo esc_html($svc_h1); ?></h1>
                    <p class="svc-hero__sub"><?php echo esc_html($svc_sub); ?></p>
                </div>
            </div>
        </div>
        <div class="ph-split__img">
            <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-5series-kitchen.jpg'); ?>" alt="Viking appliance repair service" loading="lazy">
        </div>
    </div>
</section>

<!-- FILTER TABS -->
<nav class="svc-filters" aria-label="Filter by appliance type">
    <div class="container">
        <div class="svc-filters__inner">
            <a href="<?php echo esc_url(get_post_type_archive_link('service_page')); ?>"
               class="svc-filter-tab <?php echo !$filter_appliance ? 'is-active' : ''; ?>">All Services</a>
            <?php foreach ($appliance_data as $key => $ap): ?>
            <a href="<?php echo esc_url(add_query_arg('appliance', $key, get_post_type_archive_link('service_page'))); ?>"
               class="svc-filter-tab <?php echo $filter_appliance === $key ? 'is-active' : ''; ?>">
                <?php echo esc_html($ap['label']); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<!-- COMMON ISSUES (filtered only) -->
<?php if ($active_data): ?>
<section class="svc-issues" aria-labelledby="svc-issues-h2">
    <div class="container">
        <p class="svc-issues__label" id="svc-issues-h2">Common Viking <?php echo esc_html($active_data['label']); ?> Issues We Fix</p>
        <div class="svc-issues__list" role="list">
            <?php foreach ($active_data['issues'] as $issue): ?>
            <div class="svc-issues__item" role="listitem">
                <span class="svc-issues__check" aria-hidden="true">&#x2014;</span>
                <?php echo esc_html($issue); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- INTRO TEXT (filtered only) -->
<?php if ($active_data): ?>
<div class="svc-intro-strip">
    <div class="container">
        <p class="svc-intro-text"><?php echo esc_html($active_data['intro']); ?></p>
    </div>
</div>
<?php endif; ?>

<!-- MAIN CONTENT -->
<section class="svc-main" aria-labelledby="svc-main-h2">
    <div class="container">

        <header class="svc-section-head">
            <?php if ($active_data): ?>
            <p class="svc-section-eyebrow">Viking <?php echo esc_html($active_data['label']); ?> Repair</p>
            <h2 id="svc-main-h2" class="svc-section-title">Viking <?php echo esc_html($active_data['label']); ?> &mdash; All Services</h2>
            <?php else: ?>
            <p class="svc-section-eyebrow">All Repair Services</p>
            <h2 id="svc-main-h2" class="svc-section-title">Viking Appliance Repair &mdash; Full Service Range</h2>
            <p class="svc-section-sub">Select an appliance above to view specific services, or browse our complete Viking repair range below.</p>
            <?php endif; ?>
        </header>

        <?php if ($services_query->have_posts()): ?>
        <div class="svc-rows" role="list">
            <?php
            $image_map = [
                'viking-range-repair'        => '/assets/images/viking-kitchen-miramar.jpg',
                'viking-refrigerator-repair' => '/assets/images/viking-refrigerator-3series.jpg',
                'viking-dishwasher-repair'   => '/assets/images/viking-dishwasher-7series.jpg',
                'viking-cooktop-repair'      => '/assets/images/48InductionHomepageSlide2025-2.png',
                'viking-wall-oven-repair'    => '/assets/images/viking-wall-oven-7series.jpg',
                'viking-wine-cooler-repair'  => '/assets/images/viking-wine-cellar.jpg',
                'viking-freezer-repair'      => '/assets/images/viking-refrigerator-integrated.jpg',
                'viking-vent-hood-repair'    => '/assets/images/viking-5series-kitchen.jpg',
            ];
            while ($services_query->have_posts()): $services_query->the_post();
                $pid       = get_the_ID();
                $appliance = get_post_meta($pid, '_ar_appliance_type', true) ?: 'Appliance';
                $post_slug = get_post_field('post_name', $pid);
                $card_img  = isset($image_map[$post_slug])
                             ? get_template_directory_uri() . $image_map[$post_slug]
                             : get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg';
                $excerpt   = get_the_excerpt() ?: wp_trim_words(get_the_content(), 20);
            ?>
            <a href="<?php the_permalink(); ?>" class="svc-row" role="listitem">
                <div class="svc-row__img">
                    <img src="<?php echo esc_url($card_img); ?>" alt="Viking <?php echo esc_attr($appliance); ?> Repair" loading="lazy">
                </div>
                <div class="svc-row__body">
                    <p class="svc-row__label">Viking <?php echo esc_html($appliance); ?></p>
                    <h3 class="svc-row__title"><?php the_title(); ?></h3>
                    <p class="svc-row__desc"><?php echo esc_html(wp_trim_words($excerpt, 18)); ?></p>
                </div>
                <span class="svc-row__arrow" aria-hidden="true">View &rarr;</span>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else: ?>
        <div class="svc-rows" role="list">
            <?php foreach ($appliance_data as $key => $ap):
                $card_img = get_template_directory_uri() . $ap['image'];
            ?>
            <a href="<?php echo esc_url(home_url('/services/' . $ap['slug'] . '/')); ?>" class="svc-row" role="listitem">
                <div class="svc-row__img">
                    <img src="<?php echo esc_url($card_img); ?>" alt="Viking <?php echo esc_attr($ap['label']); ?> Repair" loading="lazy">
                </div>
                <div class="svc-row__body">
                    <p class="svc-row__label">Viking <?php echo esc_html($ap['label']); ?></p>
                    <h3 class="svc-row__title">Viking <?php echo esc_html($ap['label']); ?> Repair</h3>
                    <p class="svc-row__desc"><?php echo esc_html(wp_trim_words($ap['intro'], 20)); ?></p>
                </div>
                <span class="svc-row__arrow" aria-hidden="true">View &rarr;</span>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Trust metrics -->
        <div class="svc-trust" role="list" aria-label="Service guarantees">
            <div class="svc-trust__grid">
                <div class="svc-trust__item" role="listitem">
                    <span class="svc-trust__num">OEM</span>
                    <span class="svc-trust__lbl">Genuine Viking Parts</span>
                </div>
                <div class="svc-trust__item" role="listitem">
                    <span class="svc-trust__num">30</span>
                    <span class="svc-trust__lbl">Day Parts &amp; Labor Warranty</span>
                </div>
                <div class="svc-trust__item" role="listitem">
                    <span class="svc-trust__num">1<small style="font-size:1.5rem">st</small></span>
                    <span class="svc-trust__lbl">Visit Fix Rate</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="svc-cta" aria-labelledby="svc-cta-h2">
    <div class="container">
        <p class="svc-cta__eyebrow">Ready to Book?</p>
        <?php if ($active_data): ?>
        <h2 id="svc-cta-h2" class="svc-cta__title">Get Your Viking <?php echo esc_html($active_data['label']); ?> Repaired Today</h2>
        <?php else: ?>
        <h2 id="svc-cta-h2" class="svc-cta__title">Get Your Viking Appliance Repaired Today</h2>
        <?php endif; ?>
        <p class="svc-cta__sub">Same-day and next-day appointments available. Our technician arrives fully equipped to diagnose and fix your appliance in a single visit.</p>
        <div class="svc-cta__btns">
            <a href="<?php echo esc_url($phone_raw); ?>" class="svc-btn--crimson"><?php echo esc_html($phone); ?></a>
            <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="svc-btn--ghost-wht">Schedule Online &rarr;</a>
        </div>
    </div>
</section>

<?php ar_appointment_form('archive-page', 'Book Your Viking Repair Today'); ?>

<?php ar_disclaimer(); ?>

<?php get_footer(); ?>
