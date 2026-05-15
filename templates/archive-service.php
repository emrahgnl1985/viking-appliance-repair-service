<?php
/**
 * Archive: Service Pages
 * URL: /services/ and /services/?appliance=wall-oven etc.
 */
defined('ABSPATH') || exit;

$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();

// Appliance definitions â€” 'term' must match the exact taxonomy term name in the DB
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

// Hero content — appliance-specific if filtered
$hero_title    = $active_data
    ? 'Viking ' . $active_data['label'] . ' Repair Service'
    : 'Viking Appliance Repair Services';
$hero_subtitle = $active_data
    ? 'Certified Viking ' . $active_data['label'] . ' repair — genuine Viking OEM parts, 30-day warranty, same-day service available.'
    : 'Genuine Viking OEM parts — certified technicians — 30-day warranty on every repair.';
$hero_image    = $active_data
    ? get_template_directory_uri() . $active_data['image']
    : get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg';

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
/* â”€â”€ Archive Service â€” Scoped â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
:root {
  --as-blue:   #C4943A;
  --as-red:    #C4943A;
  --as-bg:     #f7f8fa;
  --as-white:  #ffffff;
  --as-border: #e4e8ed;
  --as-text:   #1a1f2e;
  --as-muted:  #5a6478;
  --as-radius: 12px;
}

/* â”€â”€ Hero â”€â”€ */
.s-hero {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-color: #1A2B42;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid rgba(0,0,0,.1);
    padding: 80px 0 64px;
    min-height: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.s-hero--filtered {
    padding: 56px 0 44px;
    min-height: 260px;
}
.s-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(26,43,66,.70) 0%, rgba(26,43,66,.50) 55%, rgba(26,43,66,.75) 100%);
    z-index: 0;
}
.s-hero .container {
    color: #fff;
    max-width: 860px;
    margin: 0 auto;
    padding: 0 24px;
    text-align: center;
}
.s-hero__title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(28px, 4.5vw, 52px);
    font-weight: 700;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -.02em;
    margin: 0 0 14px;
}
.s-hero__sub {
    font-size: clamp(15px, 1.8vw, 18px);
    color: rgba(255,255,255,.80);
    line-height: 1.65;
    margin: 0;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
}

/* Filter tabs */
.as-filters {
    background: var(--as-white);
    border-bottom: 1px solid var(--as-border);
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 100;
}
.as-filters__inner {
    display: flex;
    gap: 0;
    overflow-x: auto;
    scrollbar-width: none;
}
.as-filters__inner::-webkit-scrollbar { display: none; }
.as-filter-tab {
    padding: 16px 22px;
    font-size: .875rem;
    font-weight: 600;
    color: var(--as-muted);
    text-decoration: none;
    white-space: nowrap;
    border-bottom: 3px solid transparent;
    transition: color .15s, border-color .15s;
    flex-shrink: 0;
}
.as-filter-tab:hover { color: var(--as-blue); }
.as-filter-tab.is-active {
    color: var(--as-blue);
    border-bottom-color: var(--as-blue);
}

/* Issues strip (shown when appliance is filtered) */
/* ── Common Issues strip — redesigned ── */
.as-issues {
    background: #fff;
    border-top: 1px solid #E8E2D8;
    border-bottom: 1px solid #E8E2D8;
    padding: 36px 0;
}
.as-issues__header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}
.as-issues__header-icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    background: rgba(196,148,58,.12);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.as-issues__heading {
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .14em;
    color: #C4943A;
    margin: 0;
}
.as-issues__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
.as-issues__item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #FAF7F2;
    border: 1.5px solid #E8E2D8;
    border-left: 3px solid #C4943A;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: .875rem;
    font-weight: 600;
    color: #1A2B42;
    line-height: 1.3;
    transition: border-color .18s, background .18s, box-shadow .18s;
}
.as-issues__item:hover {
    border-color: #C4943A;
    background: #FDF9F2;
    box-shadow: 0 2px 12px rgba(196,148,58,.14);
}
.as-issues__item-icon {
    color: #C4943A;
    flex-shrink: 0;
    font-size: 15px;
    font-weight: 700;
    line-height: 1;
}
@media (max-width: 900px) {
    .as-issues__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 540px) {
    .as-issues { padding: 24px 0; }
    .as-issues__grid { grid-template-columns: 1fr; gap: 8px; }
    .as-issues__item { padding: 11px 14px; font-size: .8125rem; }
}

/* Main content */
.as-main {
    background: var(--as-bg);
    padding: 56px 0 80px;
}
.as-section-header {
    margin-bottom: 32px;
}
.as-eyebrow {
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #C4943A;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
}
.as-eyebrow::before { content:''; width:20px; height:2px; background: #C4943A; }
.as-section-title {
    font-size: clamp(1.4rem, 2.5vw, 2rem);
    font-weight: 800;
    color: #0d1b2a;
    margin: 0 0 8px;
    letter-spacing: -.02em;
}
.as-section-sub {
    font-size: .9375rem;
    color: var(--as-muted);
    line-height: 1.6;
    max-width: 600px;
}
.as-section-intro {
    font-size: 1rem;
    color: #3d4654;
    line-height: 1.75;
    max-width: 780px;
    margin-top: 12px;
    border-left: 3px solid var(--as-blue);
    padding-left: 18px;
}

/* Service cards grid */
.as-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.as-card {
    background: var(--as-white);
    border: 1.5px solid var(--as-border);
    border-radius: var(--as-radius);
    overflow: hidden;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
}
.as-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 36px rgba(0,0,0,.12);
    border-color: var(--as-blue);
}
.as-card__img {
    width: 100%;
    aspect-ratio: 4/3;
    overflow: hidden;
    background: #1A2B42;
    flex-shrink: 0;
    position: relative;
}
.as-card__img::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 50%, rgba(26,43,66,.55) 100%);
    pointer-events: none;
}
.as-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform .45s ease;
}
.as-card:hover .as-card__img img { transform: scale(1.05); }
.as-card__body {
    padding: 22px 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.as-card__label {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: .7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: var(--as-blue);
    background: rgba(196,148,58,.10);
    border: 1px solid rgba(196,148,58,.22);
    padding: 3px 10px;
    border-radius: 20px;
    margin-bottom: 12px;
}
.as-card__title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--as-text);
    margin: 0 0 10px;
    line-height: 1.25;
    letter-spacing: -.01em;
}
.as-card:hover .as-card__title { color: var(--as-blue); }
.as-card__desc {
    font-size: .875rem;
    color: var(--as-muted);
    line-height: 1.65;
    margin: 0 0 18px;
    flex: 1;
}
.as-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--as-border);
}
.as-card__cta {
    font-size: .82rem;
    font-weight: 700;
    color: var(--as-blue);
    letter-spacing: .01em;
}
.as-card__badge {
    font-size: .7rem;
    font-weight: 600;
    color: #15803d;
    background: #dcfce7;
    padding: 3px 10px;
    border-radius: 20px;
    border: 1px solid #bbf7d0;
}

/* Why us strip */
.as-trust {
    background: var(--as-white);
    border-top: 1px solid var(--as-border);
    border-bottom: 1px solid var(--as-border);
    padding: 40px 0;
    margin-top: 56px;
}
.as-trust__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
}
.as-trust__item {
    text-align: center;
    padding: 0 24px;
    border-right: 1px solid var(--as-border);
}
.as-trust__item:last-child { border-right: none; }
.as-trust__icon {
    font-size: 1.6rem;
    margin-bottom: 10px;
    display: block;
}
.as-trust__val {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--as-blue);
    display: block;
    line-height: 1;
    margin-bottom: 4px;
}
.as-trust__lbl {
    font-size: .8rem;
    color: var(--as-muted);
    font-weight: 600;
}

/* CTA band */
.as-cta {
    background: var(--as-blue);
    padding: 64px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.as-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 80% at 50% 50%, rgba(196,148,58,.15) 0%, transparent 65%);
    pointer-events: none;
}
.as-cta__inner { position: relative; z-index: 1; }
.as-cta__eyebrow { font-size:.7rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:rgba(255,255,255,.5); margin-bottom:10px; }
.as-cta__title { font-size:clamp(1.6rem,3vw,2.4rem); font-weight:800; color:#fff; margin:0 0 12px; }
.as-cta__sub { color:rgba(255,255,255,.7); font-size:.9375rem; max-width:520px; margin:0 auto 32px; line-height:1.65; }
.as-cta__btns { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; }
.as-btn--red {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #fff;
    color: #C4943A;
    border: 2px solid #fff;
    padding: 14px 28px;
    border-radius: 50px;
    font-size: .9375rem;
    font-weight: 700;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.as-btn--red:hover { background: rgba(255,255,255,.88); }
.as-btn--outline {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255,255,255,.5);
    padding: 14px 28px;
    border-radius: 50px;
    font-size: .9375rem;
    font-weight: 700;
    text-decoration: none;
    transition: border-color .2s, background .2s;
}
.as-btn--outline:hover { border-color: #fff; background: rgba(255,255,255,.08); }

@media(max-width:960px){
    .as-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
}
@media(max-width:900px){
    .as-trust__grid { grid-template-columns: repeat(2, 1fr); }
    .as-trust__item:nth-child(2) { border-right: none; }
    .as-trust__item:nth-child(3) { border-top: 1px solid var(--as-border); border-right: 1px solid var(--as-border); }
    .as-trust__item:nth-child(4) { border-top: 1px solid var(--as-border); border-right: none; }
    .as-trust__item { padding: 20px; }
}
@media(max-width:640px){
    .s-hero { padding: 80px 0 40px; min-height: 0; }
    .as-grid { grid-template-columns: 1fr; gap: 16px; }
    .as-trust__grid { grid-template-columns: repeat(2, 1fr); }
    .as-filter-tab { padding: 12px 14px; font-size: .78rem; }
    .as-card__img { aspect-ratio: 16/9; }
    .as-issues { padding: 24px 0; }
    .as-issues__grid { grid-template-columns: 1fr; }
    .as-main { padding: 36px 0 56px; }
}
</style>

<!-- â”€â”€ HERO (original) â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ -->
<?php $hero_class = $active_data ? 's-hero s-hero--filtered' : 's-hero'; ?>
<section class="<?php echo esc_attr($hero_class); ?>" aria-labelledby="svc-arch-h1"
     style="background-image:url('<?php echo esc_url($hero_image); ?>');">
    <div class="s-hero__overlay"></div>
    <div class="container" style="position:relative;z-index:1;">
        <h1 id="svc-arch-h1" class="s-hero__title"><?php echo esc_html($hero_title); ?></h1>
        <p class="s-hero__sub"><?php echo esc_html($hero_subtitle); ?></p>
    </div>
</section>

<!-- â”€â”€ FILTER TABS â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ -->
<nav class="as-filters" aria-label="Filter by appliance type">
    <div class="container">
        <div class="as-filters__inner">
            <a href="<?php echo esc_url(get_post_type_archive_link('service_page')); ?>"
               class="as-filter-tab <?php echo !$filter_appliance ? 'is-active' : ''; ?>">All Services</a>
            <?php foreach ($appliance_data as $key => $ap): ?>
            <a href="<?php echo esc_url(add_query_arg('appliance', $key, get_post_type_archive_link('service_page'))); ?>"
               class="as-filter-tab <?php echo $filter_appliance === $key ? 'is-active' : ''; ?>">
                <?php echo esc_html($ap['label']); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<!-- ── COMMON ISSUES SECTION (filtered only) ──────────────── -->
<?php if ($active_data): ?>
<section class=”as-issues” aria-label=”Common <?php echo esc_attr($active_data['label']); ?> issues we repair”>
    <div class=”container”>

        <div class=”as-issues__header”>
            <div class=”as-issues__header-icon” aria-hidden=”true”>&#x1F527;</div>
            <p class=”as-issues__heading”>Common Viking <?php echo esc_html($active_data['label']); ?> Issues We Fix</p>
        </div>

        <div class=”as-issues__grid”>
            <?php foreach ($active_data['issues'] as $issue): ?>
            <div class=”as-issues__item”>
                <span class=”as-issues__item-icon” aria-hidden=”true”>&#x2713;</span>
                <?php echo esc_html($issue); ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php endif; ?>

<!-- â”€â”€ MAIN CONTENT â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ -->
<section class="as-main">
    <div class="container">

        <div class=”as-section-header”>
            <?php if ($active_data): ?>
            <p class=”as-eyebrow”>Viking <?php echo esc_html($active_data['label']); ?> Repair</p>
            <h2 class=”as-section-title”>Viking <?php echo esc_html($active_data['label']); ?> Repair &mdash; What We Cover</h2>
            <p class=”as-section-intro”><?php echo esc_html($active_data['intro']); ?></p>
            <?php else: ?>
            <p class=”as-eyebrow”>All Repair Services</p>
            <h2 class=”as-section-title”>Viking Appliance Repair &mdash; All Services</h2>
            <p class=”as-section-sub”>Select an appliance above to view specific services and detailed repair information, or browse our full Viking repair service range below.</p>
            <?php endif; ?>
        </div>

        <?php if ($services_query->have_posts()): ?>
        <div class="as-grid">
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
                $pid        = get_the_ID();
                $appliance  = get_post_meta($pid, '_ar_appliance_type', true) ?: 'Appliance';
                $post_slug  = get_post_field('post_name', $pid);
                $card_img   = isset($image_map[$post_slug])
                              ? get_template_directory_uri() . $image_map[$post_slug]
                              : get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg';
                $excerpt    = get_the_excerpt() ?: wp_trim_words(get_the_content(), 22);
            ?>
            <a href="<?php the_permalink(); ?>" class="as-card">
                <div class="as-card__img">
                    <img src="<?php echo esc_url($card_img); ?>"
                         alt="Viking <?php echo esc_attr($appliance); ?> Repair — <?php echo esc_attr(get_the_title()); ?>">
                </div>
                <div class="as-card__body">
                    <p class="as-card__label">Viking <?php echo esc_html($appliance); ?></p>
                    <h3 class="as-card__title"><?php the_title(); ?></h3>
                    <p class="as-card__desc"><?php echo esc_html(wp_trim_words($excerpt, 18)); ?></p>
                    <div class="as-card__footer">
                        <span class="as-card__cta">View Service &rarr;</span>
                        <span class="as-card__badge">Same-Day</span>
                    </div>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else: ?>
        <!-- Fallback cards if no DB posts yet -->
        <div class="as-grid">
            <?php foreach ($appliance_data as $key => $ap):
                $card_img = get_template_directory_uri() . $ap['image'];
            ?>
            <a href="<?php echo esc_url(home_url('/services/' . $ap['slug'] . '/')); ?>" class="as-card">
                <div class="as-card__img">
                    <img src="<?php echo esc_url($card_img); ?>"
                         alt="Viking <?php echo esc_attr($ap['label']); ?> Repair Service">
                </div>
                <div class="as-card__body">
                    <p class="as-card__label">Viking <?php echo esc_html($ap['label']); ?></p>
                    <h3 class="as-card__title">Viking <?php echo esc_html($ap['label']); ?> Repair</h3>
                    <p class="as-card__desc"><?php echo esc_html($ap['intro']); ?></p>
                    <div class="as-card__footer">
                        <span class="as-card__cta">View Service &rarr;</span>
                        <span class="as-card__badge">Same-Day</span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Trust bar -->
        <div class="as-trust">
            <div class="as-trust__grid">
                <div class="as-trust__item">
                    <span class="as-trust__icon">&#x1F527;</span>
                    <span class="as-trust__val">OEM</span>
                    <span class="as-trust__lbl">Genuine Viking Parts</span>
                </div>
                <div class="as-trust__item">
                    <span class="as-trust__icon">&#x1F6E1;</span>
                    <span class="as-trust__val">30 Day</span>
                    <span class="as-trust__lbl">Parts & Labor Warranty</span>
                </div>
                <div class="as-trust__item">
                    <span class="as-trust__icon">&#x23F0;</span>
                    <span class="as-trust__val">Same-Day</span>
                    <span class="as-trust__lbl">Service Available</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- â”€â”€ CTA â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ -->
<section class="as-cta">
    <div class="container">
        <div class="as-cta__inner">
            <p class="as-cta__eyebrow">Ready to Book?</p>
            <?php if ($active_data): ?>
            <h2 class="as-cta__title">Get Your Viking <?php echo esc_html($active_data['label']); ?> Repaired Today</h2>
            <?php else: ?>
            <h2 class="as-cta__title">Get Your Viking Appliance Repaired Today</h2>
            <?php endif; ?>
            <p class="as-cta__sub">Same-day and next-day appointments available. Our technician arrives fully equipped to diagnose and fix your appliance in a single visit.</p>
            <div class="as-cta__btns">
                <a href=”<?php echo esc_url($phone_raw); ?>” class=”as-btn--red”>&#x1F4DE; <?php echo esc_html($phone); ?></a>
                <a href=”<?php echo esc_url(home_url(‘/schedule/’)); ?>” class=”as-btn--outline”>Schedule Online &rarr;</a>
            </div>
        </div>
    </div>
</section>

<?php ar_disclaimer(); ?>

<?php get_footer(); ?>




