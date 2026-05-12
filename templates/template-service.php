<?php
/**
 * Template: Service Page
 * Viking Appliance Repair Service Theme
 *
 * ACF Fields used:
 *   _ar_brand            — string  e.g. "Viking"
 *   _ar_appliance_type   — string  e.g. "Range"
 *   _ar_hero_subtitle    — string
 *   _ar_body_intro       — textarea (paragraphs)
 *   _ar_common_issues    — repeater: [ title, description ]
 *   _ar_features         — repeater: [ icon, title, description ]
 *   _ar_process_steps    — repeater: [ title, description ]
 *   _ar_faqs             — repeater: [ question, answer ]
 *   _ar_related_services — post relationship
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$post_id   = get_the_ID();
$brand     = get_post_meta( $post_id, '_ar_brand', true )           ?: 'Brand';
$appliance = get_post_meta( $post_id, '_ar_appliance_type', true )  ?: 'Appliance';
$biz       = ar_get_business_name();
$phone     = ar_get_phone();
$subtitle  = get_post_meta( $post_id, '_ar_hero_subtitle', true )   ?: "Fast, reliable {$brand} {$appliance} repairs by certified technicians — factory-certified parts and a 30-day warranty.";
$intro     = get_post_meta( $post_id, '_ar_body_intro', true );
$issues    = get_post_meta( $post_id, '_ar_common_issues', true );
$features  = get_post_meta( $post_id, '_ar_features', true );
$steps     = get_post_meta( $post_id, '_ar_process_steps', true );
$faqs      = get_post_meta( $post_id, '_ar_faqs', true );
$services  = get_post_meta( $post_id, '_ar_services', true );
$phone_raw = ar_phone_link();

// Fallback data so the page renders without ACF populated
if ( empty( $issues ) ) {
    $issues = [
        [ 'title' => 'Not draining or spinning', 'description' => 'Often caused by a clogged pump filter, faulty drain pump, or blocked drain hose. Our technicians diagnose and resolve the issue on the first visit.' ],
        [ 'title' => 'Displaying error codes', 'description' => "{$brand} appliances display specific error codes that identify the underlying fault. We decode, diagnose, and fix them using factory-certified parts." ],
        [ 'title' => 'Excessive vibration or noise', 'description' => 'Worn drum bearings, damaged shock absorbers, or an unbalanced sensor can all cause unusual sounds. We replace only what\'s needed.' ],
        [ 'title' => 'Not starting or powering on', 'description' => 'Control board faults, door latch issues, or wiring problems can prevent startup. We trace the fault to its source and repair it correctly.' ],
        [ 'title' => 'Water leaking', 'description' => 'Door seals, hose connections, and pump components are carefully inspected and replaced with factory-certified parts as needed.' ],
        [ 'title' => 'Not heating correctly', 'description' => 'Heating elements and temperature sensors are tested to ensure your appliance reaches the correct operating temperature every cycle.' ],
    ];
}

if ( empty( $features ) ) {
    $features = [
        [ 'icon' => '🔧', 'title' => 'Factory-Certified Parts', 'description' => "We use only factory-certified {$brand} replacement components — not generic alternatives — to preserve your appliance's performance and any remaining manufacturer's warranty." ],
        [ 'icon' => '🎓', 'title' => 'Highly Trained Technicians', 'description' => "Our repair technicians receive ongoing technical training specific to {$brand} appliances, ensuring accurate diagnosis and correct repairs across all current models." ],
        [ 'icon' => '🛡', 'title' => '30-Day Warranty', 'description' => 'Every repair is backed by our 30-day parts and labor warranty. If the repaired component fails within a month, we return and fix it at no additional charge.' ],
    ];
}

if ( empty( $steps ) ) {
    $steps = [
        [ 'title' => 'Book Your Appointment', 'description' => 'Call us or use the form below. We offer same-day and next-day slots in most service areas, seven days a week.' ],
        [ 'title' => 'Technician Arrives', 'description' => 'Our technician arrives in the confirmed time window, fully equipped with diagnostic tools and a comprehensive parts inventory.' ],
        [ 'title' => 'Accurate Diagnosis', 'description' => 'We identify the root cause — not just the symptom — and provide a clear, upfront repair quote before any work begins.' ],
        [ 'title' => 'Professional Repair', 'description' => "Using factory-certified {$brand} parts, we complete the repair efficiently and leave your home clean and tidy." ],
        [ 'title' => 'Warranty Confirmed', 'description' => 'Your 30-day parts and labor warranty begins from the date of repair. We leave you with full written documentation.' ],
    ];
}

if ( empty( $faqs ) ) {
    $faqs = [
        [ 'question' => "How long does a {$brand} {$appliance} repair take?", 'answer' => "Most {$brand} {$appliance} repairs are completed in a single visit lasting 1 to 2 hours. Because we stock a broad inventory of factory-certified {$brand} parts, same-day completion is the norm. In rare cases where a specific part must be ordered, we provide a clear timeline upfront and schedule a follow-up promptly." ],
        [ 'question' => "Is it worth repairing my {$brand} {$appliance} or should I replace it?", 'answer' => "{$brand} appliances are engineered for longevity. If your {$appliance} is under 10 years old and the repair cost is less than 50% of the replacement cost, repair is almost always the more economical choice. Our technicians will give you a transparent assessment so you can make an informed decision." ],
        [ 'question' => "Do you offer same-day {$brand} {$appliance} repair?", 'answer' => "Yes. We offer same-day service appointments in most of our service areas, subject to technician availability. We recommend calling early in the day for the best chance of same-day scheduling." ],
        [ 'question' => "What warranty do you provide on repairs?", 'answer' => "Every repair is covered by our 30-day parts and labor warranty. If the same fault recurs within 30 days of your service date, we return and resolve it at no additional cost to you." ],
        [ 'question' => "Do you service all {$brand} {$appliance} models?", 'answer' => "Yes. Our technicians are trained and equipped to service the full {$brand} product range, from entry-level to premium models. If your appliance model is unusually rare, contact us and we will confirm parts availability before your appointment." ],
        [ 'question' => "What areas do you serve?", 'answer' => "We service Chicago, San Francisco, Houston, Miami, Los Angeles, New York, and their surrounding areas. View our full list of service locations for details on specific neighborhoods and suburbs we cover." ],
    ];
}

// ── Schema.org ──────────────────────────────────────────────────
$meta_desc = get_post_meta( $post_id, '_yoast_wpseo_metadesc', true )
           ?: get_the_excerpt()
           ?: "Expert {$brand} {$appliance} repair using factory-certified parts. 30-day warranty on all repairs. Book same-day service.";

$faq_schema = [];
if ( ! empty( $faqs ) ) {
    foreach ( $faqs as $faq ) {
        $faq_schema[] = [
            '@type'          => 'Question',
            'name'           => $faq['question'],
            'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $faq['answer'] ],
        ];
    }
}

// Schema output moved to after get_header() — must not output before <!DOCTYPE>
$_schema_data = [
    '@context' => 'https://schema.org',
    '@graph'   => array_filter([
        [
            '@type'            => 'Service',
            '@id'              => get_permalink() . '#service',
            'name'             => "{$brand} {$appliance} Repair",
            'serviceType'      => 'Appliance Repair',
            'description'      => $meta_desc,
            'url'              => get_permalink(),
            'provider'         => [
                '@type'  => 'LocalBusiness',
                '@id'    => home_url('/#business'),
                'name'   => $biz,
                'url'    => home_url('/'),
                'telephone' => $phone,
            ],
            'areaServed'       => [
                ['@type' => 'City', 'name' => 'Chicago'],
                ['@type' => 'City', 'name' => 'New York'],
                ['@type' => 'City', 'name' => 'Los Angeles'],
                ['@type' => 'City', 'name' => 'Houston'],
                ['@type' => 'City', 'name' => 'Miami'],
                ['@type' => 'City', 'name' => 'San Francisco'],
            ],
            'hasOfferCatalog'  => [
                '@type' => 'OfferCatalog',
                'name'  => "{$brand} {$appliance} Repair Services",
                'itemListElement' => array_map( fn($i) => [
                    '@type'       => 'Offer',
                    'itemOffered' => ['@type' => 'Service', 'name' => $i['title']],
                ], array_slice( $issues, 0, 6 ) ),
            ],
            'offers' => [
                '@type'           => 'Offer',
                'priceCurrency'   => 'USD',
                'availability'    => 'https://schema.org/InStock',
                'seller'          => ['@type' => 'LocalBusiness', 'name' => $biz],
            ],
        ],
        ! empty( $faq_schema ) ? [
            '@type'      => 'FAQPage',
            '@id'        => get_permalink() . '#faq',
            'mainEntity' => $faq_schema,
        ] : null,
        [
            '@type'     => 'BreadcrumbList',
            '@id'       => get_permalink() . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',     'item' => home_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url('/services/')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => get_the_title()],
            ],
        ],
    ]),
];

/* GET matched image url */
$current_slug = get_post_field( 'post_name', get_the_ID() );

$image_map = [
    'viking-range-repair'        => '/assets/images/viking-3series-feature.jpg',
    'viking-refrigerator-repair' => '/assets/images/viking-refrigerator-3series.jpg',
    'viking-dishwasher-repair'   => '/assets/images/viking-dishwasher-7series.jpg',
    'viking-cooktop-repair'      => '/assets/images/viking-cooktop-rangetop.jpg',
    'viking-wall-oven-repair'    => '/assets/images/viking-wall-oven-7series.jpg',
    'viking-wine-cooler-repair'  => '/assets/images/viking-wine-cellar.jpg',
    'viking-freezer-repair'      => '/assets/images/viking-refrigerator-integrated.jpg',
    'viking-vent-hood-repair'    => '/assets/images/5_Series_Kitchen_HQ-new.jpg',
];

// fallback image
$image_path = isset($image_map[$current_slug])
    ? $image_map[$current_slug]
    : '/assets/images/viking-kitchen-7series-hero.jpg';

get_header();
ar_output_schema($_schema_data);
?>

<style>
    /* ── Hero ── */
.s-hero {
    background: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg'); ?>') no-repeat center center;
    background-size: cover;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid var(--clr-border);
    /* Optional: fallback color if image fails to load */
    background-color: var(--clr-page);
    padding: 72px 0 64px;
    display: flex;
    align-items: center;     /* vertical center */
    justify-content: center; /* horizontal center */
    text-align: center;
    min-height: 500px; /* better than fixed height */
}
.s-hero .container {
    position: relative;
    z-index: 1;
    color: #fff;
    margin: 0 auto;
    padding: 0 24px;

    /* ADD THIS */
    text-align: center;
}
.s-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
}
.s-hero__inner {
    position: relative; /* make text appear above overlay */
    z-index: 1;
    color: #fff; /* ensure text is light for contrast */
    margin: 0 auto;
    padding: 0 24px;
    text-align: center;
    
}
.s-hero__title {
    font-family: 'DM Serif Display', Georgia, serif;
    font-size: clamp(36px, 5vw, 58px);
    font-weight: 400;
    color: var(--g-ink);
    line-height: 1.08;
    letter-spacing: -.03em;
    margin: 0 0 18px;
}
.s-hero__title em { font-style: italic; color: var(--g-accent); }
.s-hero__sub {
    font-size: 20px;
     text-shadow: 0 2px 6px rgba(0,0,0,0.5);
    color: #fff;
    line-height: 1.08;;
    line-height: 1.7;
    margin: 0 0 36px;
}

.s-hero__content {
    display: flex;
    flex-direction: column;
    align-items: center;   /* center all children horizontally */
    justify-content: center;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}
</style>
<!-- ── HERO ────────────────────────────────────────────── -->
<section class="s-hero" aria-labelledby="hero-h1">
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="hero__bg" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'ar-hero' ) ); ?>');" aria-hidden="true"></div>
    <?php else : ?>
    <div class="hero__bg" style="background-image: url('<?php echo esc_url( AR_URI . '/assets/icons/hero-placeholder.jpg' ); ?>');" aria-hidden="true"></div>
    <?php endif; ?>

    <div class="container">
        <div class="s-hero__content">
            <span class="hero__eyebrow" style="visibility:hidden;" aria-hidden="true">&nbsp;</span>

            <h1 class="s-hero__title" id="hero-h1">
                Professional <?php echo esc_html( $brand . ' ' . $appliance ); ?> Repair Service
            </h1>

            <p class="s-hero__sub"><?php echo esc_html( $subtitle ); ?></p>

            <div class="hero__cta-group">
                <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--call btn--lg">
                    📞 <?php echo esc_html( $phone ); ?>
                </a>
                <a href="/schedule/" class="btn btn--outline-white btn--lg">Schedule Online</a>
            </div>

            <div class="hero__trust">
                <div class="hero__trust-item"><span class="hero__trust-icon" aria-hidden="true">✓</span> Factory-Certified Parts</div>
                <div class="hero__trust-item"><span class="hero__trust-icon" aria-hidden="true">⏰</span> Same-Day Service</div>
                <div class="hero__trust-item"><span class="hero__trust-icon" aria-hidden="true">🛡</span> 30-Day Warranty</div>
            </div>
        </div>
    </div>
</section>

<!-- ── BREADCRUMBS ─────────────────────────────────────── -->
<div class="container">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="breadcrumbs__sep" aria-hidden="true">/</span>
        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a>
        <span class="breadcrumbs__sep" aria-hidden="true">/</span>
        <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html( get_the_title() ); ?></span>
    </nav>
</div>

<!-- ── BODY INTRO ──────────────────────────────────────── -->
<section class="section">
    <div class="container container--narrow">
        <span class="section-header__eyebrow">Expert <?php echo esc_html( $brand ); ?> Repair</span>
        <h2>Trusted <?php echo esc_html( $brand . ' ' . $appliance ); ?> Repair You Can Depend On</h2>

        <?php if ( $intro ) : ?>
            <div style="margin-top:var(--space-6);">
                <?php echo wp_kses_post( wpautop( $intro ) ); ?>
            </div>
        <?php else : ?>
            <p style="margin-top:var(--space-6);"><?php echo esc_html( $brand ); ?> <?php echo strtolower( esc_html( $appliance ) ); ?>s are engineered for precision performance — but even the most reliable appliances occasionally need professional attention. Whether yours is displaying an error code, refusing to drain, or not operating as it should, our highly trained technicians have the skills and the factory-certified parts to restore it to full working order.</p>
            <p>We stock an extensive inventory of factory-certified <?php echo esc_html( $brand ); ?> components, which means we can complete most repairs in a single visit. No waiting weeks for parts to arrive, no repeated service calls. Our technicians receive ongoing training on the latest <?php echo esc_html( $brand ); ?> models, ensuring an accurate diagnosis every time.</p>
            <p>Every repair we perform comes with a 30-day parts and labor warranty. We stand behind our work — if the same problem returns within a month, we fix it at no additional cost to you.</p>
        <?php endif; ?>

        <?php ar_disclaimer( $brand ); ?>
    </div>
</section>

<!-- ── COMMON ISSUES ───────────────────────────────────── -->
<?php if ( ! empty( $issues ) ) : ?>
<section class="section section--bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-header__eyebrow">What We Fix</span>
            <h2 class="section-header__title">Common <?php echo esc_html( $brand . ' ' . $appliance ); ?> Problems We Repair</h2>
        </div>
        <div class="grid grid-3">
            <?php foreach ( $issues as $issue ) : ?>
            <div class="service-card" style="text-decoration:none;">
                <div class="service-card__icon" aria-hidden="true">🔧</div>
                <h3 class="service-card__title"><?php echo esc_html( $issue['title'] ); ?></h3>
                <p class="service-card__desc"><?php echo esc_html( $issue['description'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ── SERVICES & PRICING ──────────────────────────────── -->
<?php if ( ! empty( $services ) ) : ?>
<style>
.svc-pricing {
    padding: 80px 0;
    background: #fff;
}
.svc-pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 40px;
}
.svc-pricing-card {
    border: 1.5px solid #e8edf2;
    border-radius: 12px;
    padding: 24px 26px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: border-color .2s, box-shadow .2s;
    background: #fff;
}
.svc-pricing-card:hover {
    border-color: var(--color-accent, #1B3A6B);
    box-shadow: 0 6px 24px rgba(27,58,107,.08);
}
.svc-pricing-card__header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
}
.svc-pricing-card__name {
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-text, #1a1a1a);
    line-height: 1.3;
    margin: 0;
}
.svc-pricing-card__price {
    font-size: .9rem;
    font-weight: 700;
    color: var(--color-accent, #1B3A6B);
    white-space: nowrap;
    background: rgba(27,58,107,.07);
    padding: 4px 10px;
    border-radius: 20px;
    flex-shrink: 0;
}
.svc-pricing-card__desc {
    font-size: .875rem;
    color: #5a6472;
    line-height: 1.65;
    margin: 0;
}
.svc-pricing-card__cta {
    margin-top: auto;
    padding-top: 12px;
    font-size: .8rem;
    color: var(--color-accent, #1B3A6B);
    font-weight: 600;
    text-decoration: none;
}
.svc-pricing-card__cta:hover { text-decoration: underline; }
.svc-pricing-note {
    margin-top: 28px;
    font-size: .82rem;
    color: #8a929b;
    text-align: center;
    line-height: 1.6;
}
@media(max-width:600px){
    .svc-pricing-grid { grid-template-columns: 1fr; }
}
</style>
<section class="svc-pricing" aria-labelledby="svc-pricing-h2">
    <div class="container">
        <div class="section-header">
            <span class="section-header__eyebrow">Services &amp; Pricing</span>
            <h2 class="section-header__title" id="svc-pricing-h2"><?php echo esc_html( $brand . ' ' . $appliance ); ?> Repair Services &amp; Typical Costs</h2>
            <p class="section-header__sub">All prices are estimates. Your technician provides a firm written quote before any work begins. Diagnostic fee is applied toward the repair cost.</p>
        </div>
        <div class="svc-pricing-grid">
            <?php foreach ( $services as $svc ) : ?>
            <div class="svc-pricing-card">
                <div class="svc-pricing-card__header">
                    <h3 class="svc-pricing-card__name"><?php echo esc_html( $svc['name'] ); ?></h3>
                    <?php if ( ! empty( $svc['price_range'] ) ) : ?>
                    <span class="svc-pricing-card__price"><?php echo esc_html( $svc['price_range'] ); ?></span>
                    <?php endif; ?>
                </div>
                <p class="svc-pricing-card__desc"><?php echo esc_html( $svc['description'] ); ?></p>
                <a href="<?php echo esc_url( home_url( '/schedule/' ) ); ?>" class="svc-pricing-card__cta">Book this repair →</a>
            </div>
            <?php endforeach; ?>
        </div>
        <p class="svc-pricing-note">* Price ranges are estimates for parts and labor. Final cost depends on the specific model and fault diagnosis. All repairs include a 30-day parts and labor warranty.</p>
    </div>
</section>
<?php endif; ?>

<!-- ── WHY CHOOSE US ───────────────────────────────────── -->
<?php if ( ! empty( $features ) ) : ?>
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-header__eyebrow">Why Choose Us</span>
            <h2 class="section-header__title">Why Homeowners Choose Us for <?php echo esc_html( $brand ); ?> Repair</h2>
        </div>
        <div class="grid grid-3">
            <?php foreach ( $features as $feature ) : ?>
            <div class="feature-block">
                <div class="feature-block__icon" aria-hidden="true"><?php echo esc_html( $feature['icon'] ); ?></div>
                <div class="feature-block__body">
                    <h3 class="feature-block__title"><?php echo esc_html( $feature['title'] ); ?></h3>
                    <p class="feature-block__desc"><?php echo esc_html( $feature['description'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ── HOW IT WORKS ─────────────────────────────────────── -->
<?php if ( ! empty( $steps ) ) : ?>
<style>
.svc-hiw-section {
    background: var(--color-bg-section, #f2f0ed);
    padding: 88px 0;
    border-top: 1px solid var(--color-border);
    border-bottom: 1px solid var(--color-border);
}
.svc-hiw-layout {
    display: grid;
    grid-template-columns: 400px 1fr;
    gap: 80px;
    align-items: start;
}
.svc-hiw-sidebar {
    position: sticky;
    top: 40px;
}
.svc-hiw-sidebar h2 {
    font-family: var(--font-display, Georgia, serif);
    font-size: clamp(28px, 3vw, 40px);
    font-weight: 400;
    color: var(--color-text);
    line-height: 1.1;
    margin: 0 0 14px;
    letter-spacing: -.02em;
}
.svc-hiw-sidebar p {
    font-size: 15px;
    color: var(--color-text-muted);
    line-height: 1.7;
    margin: 0 0 28px;
}
.svc-hiw-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    background: var(--color-surface, #fff);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    padding: 20px 16px;
    margin-top: 28px;
}
.svc-hiw-stat { text-align: center; }
.svc-hiw-stat:not(:last-child) { border-right: 1px solid var(--color-border); }
.svc-hiw-stat-val {
    font-family: var(--font-display, Georgia, serif);
    font-size: 26px;
    font-weight: 400;
    color: var(--color-text);
    line-height: 1;
    display: block;
    margin-bottom: 4px;
}
.svc-hiw-stat-lbl {
    font-size: 11px;
    color: var(--color-text-muted);
    font-weight: 500;
    letter-spacing: .03em;
    text-transform: uppercase;
}
/* Step track */
.svc-hiw-track { list-style: none; margin: 0; padding: 0; }
.svc-hiw-step {
    display: grid;
    grid-template-columns: 44px 1fr;
    gap: 0 20px;
    padding-bottom: 36px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity .45s ease, transform .45s ease;
}
.svc-hiw-step.svc-hiw-vis { opacity: 1; transform: translateY(0); }
.svc-hiw-step:last-child { padding-bottom: 0; }
.svc-hiw-spine { display: flex; flex-direction: column; align-items: center; }
.svc-hiw-node {
    width: 40px; height: 40px;
    border-radius: 50%;
    border: 1.5px solid var(--color-accent, #1B3A6B);
    background: var(--color-surface, #fff);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: background .2s ease;
}
.svc-hiw-step:hover .svc-hiw-node { background: var(--color-accent, #1B3A6B); }
.svc-hiw-node-num {
    font-size: 12px; font-weight: 700;
    color: var(--color-accent, #1B3A6B);
    transition: color .2s ease;
}
.svc-hiw-step:hover .svc-hiw-node-num { color: #fff; }
.svc-hiw-line {
    flex: 1; width: 1px;
    background: linear-gradient(to bottom, rgba(27,58,107,.25), rgba(27,58,107,.04));
    margin: 6px 0;
}
.svc-hiw-step:last-child .svc-hiw-line { display: none; }
.svc-hiw-content { padding-top: 8px; }
.svc-hiw-micro {
    font-size: 10px; font-weight: 700;
    letter-spacing: .1em; text-transform: uppercase;
    color: var(--color-accent, #1B3A6B);
    opacity: .75; margin-bottom: 6px;
}
.svc-hiw-step-title {
    font-size: 17px; font-weight: 700;
    color: var(--color-text);
    margin: 0 0 8px;
    letter-spacing: -.015em; line-height: 1.25;
}
.svc-hiw-step-text {
    font-size: 16px; color: var(--color-text-muted);
    line-height: 1.7; margin: 0;
}


/* IMAGE + BUTTON BLOCK */
.svc-hiw-media {
    margin-top: 20px;
    text-align: center;
}

.svc-hiw-media img {
    width: 100%;
    display: block;
    border-radius: 12px;
}

/* Optional subtle overlay */
.svc-hiw-media {
    position: relative;
}

.svc-hiw-media::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 12px;
    background: linear-gradient(to top, rgba(0,0,0,.25), transparent 60%);
    pointer-events: none;
}

/* BUTTON MATCH IMAGE WIDTH */
.svc-hiw-btn {
    display: block;
    width: 100%;
    margin-top: 16px;
    text-align: center;
}

@media (max-width: 900px) {
    .svc-hiw-layout { grid-template-columns: 1fr; gap: 48px; }
    .svc-hiw-sidebar { position: static; }
}
@media (max-width: 480px) {
    .svc-hiw-section { padding: 56px 0; }
    .svc-hiw-step { grid-template-columns: 36px 1fr; gap: 0 14px; padding-bottom: 28px; }
    .svc-hiw-node { width: 34px; height: 34px; }
    .svc-hiw-stats { grid-template-columns: 1fr; }
    .svc-hiw-stat:not(:last-child) { border-right: none; border-bottom: 1px solid var(--color-border); padding-bottom: 16px; margin-bottom: 16px; }
}
@media (prefers-reduced-motion: reduce) {
    .svc-hiw-step { opacity: 1; transform: none; transition: none; }
}
</style>

<section class="svc-hiw-section" id="how-it-works" aria-labelledby="svc-hiw-h2">
    <div class="container">
        <div class="svc-hiw-layout">

            <!-- Sidebar -->
            <div class="svc-hiw-sidebar">
                <div class="section-header__eyebrow" style="margin-bottom:14px;">Our Process</div>

                <h2 id="svc-hiw-h2">How Our Repair Process Works</h2>

                <p>
                    From booking to final warranty confirmation — we make your 
                    <?php echo esc_html( $brand . ' ' . $appliance ); ?> repair as simple and stress-free as possible.
                </p>

                <!-- IMAGE + BUTTON -->
                <div class="svc-hiw-media">
                    <img 
                        src="<?php echo get_template_directory_uri() . $image_path; ?>"
                        alt="Viking appliance repair technician working"
                        loading="lazy"
                    >

                    <a href="/schedule/" class="btn btn--accent btn--lg svc-hiw-btn">
                        Schedule a Repair →
                    </a>
                </div>

                <!-- STATS -->
                <div class="svc-hiw-stats" role="list" aria-label="Key repair statistics">
                    <div class="svc-hiw-stat" role="listitem">
                        <span class="svc-hiw-stat-val">98%</span>
                        <span class="svc-hiw-stat-lbl">First-visit fix</span>
                    </div>
                    <div class="svc-hiw-stat" role="listitem">
                        <span class="svc-hiw-stat-val">1–2 hr</span>
                        <span class="svc-hiw-stat-lbl">Avg. repair</span>
                    </div>
                    <div class="svc-hiw-stat" role="listitem">
                        <span class="svc-hiw-stat-val">30 Day</span>
                        <span class="svc-hiw-stat-lbl">Warranty</span>
                    </div>
                </div>
            </div>

            <!-- Steps -->
            <ol class="svc-hiw-track" aria-label="Repair process steps">
                <?php foreach ( $steps as $i => $step ) :
                    $num = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                ?>
                <li class="svc-hiw-step">
                    <div class="svc-hiw-spine" aria-hidden="true">
                        <div class="svc-hiw-node">
                            <span class="svc-hiw-node-num"><?php echo esc_html( $num ); ?></span>
                        </div>
                        <div class="svc-hiw-line"></div>
                    </div>
                    <div class="svc-hiw-content">
                        <div class="svc-hiw-micro" aria-hidden="true">Step <?php echo esc_html( $num ); ?></div>
                        <h3 class="svc-hiw-step-title"><?php echo esc_html( $step['title'] ); ?></h3>
                        <p class="svc-hiw-step-text"><?php echo esc_html( $step['description'] ); ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>

        </div>
    </div>
</section>
<script>
(function(){
    'use strict';
    var steps = document.querySelectorAll('.svc-hiw-step');
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced || !('IntersectionObserver' in window)) {
        steps.forEach(function(s){ s.classList.add('svc-hiw-vis'); });
        return;
    }
    var io = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if (!e.isIntersecting) return;
            var idx = Array.prototype.indexOf.call(steps, e.target);
            setTimeout(function(){ e.target.classList.add('svc-hiw-vis'); }, idx * 100);
            io.unobserve(e.target);
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    steps.forEach(function(s){ io.observe(s); });
}());
</script>
<?php endif; ?>

<!-- ── SERVICE LOCATIONS CTA ──────────────────────────── -->
<section class="section section--bg-primary">
    <div class="container" style="text-align:center;">
        <span class="section-header__eyebrow" style="color:rgba(255,255,255,.6);">Service Areas</span>
        <h2 style="color:#fff;margin-bottom:var(--space-4);">We Service Your Area</h2>
        <p style="color:rgba(255,255,255,.75);max-width:600px;margin:0 auto var(--space-8);">We serve Chicago, San Francisco, Houston, Miami, Los Angeles, New York, and their surrounding neighborhoods and suburbs.</p>
        <div style="display:flex;flex-wrap:wrap;gap:var(--space-3);justify-content:center;margin-bottom:var(--space-8);">
            <?php
            $cities = [ 'Chicago' => 'chicago', 'San Francisco' => 'san-francisco', 'Houston' => 'houston', 'Miami' => 'miami', 'Los Angeles' => 'los-angeles', 'New York' => 'new-york' ];
            foreach ( $cities as $name => $slug ) :
            ?>
            <a href="<?php echo esc_url( home_url( "/locations/{$slug}/" ) ); ?>" class="zip-badge" style="color:var(--color-white);border-color:rgba(255,255,255,.25);background:rgba(255,255,255,.08);">
                📍 <?php echo esc_html( $name ); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── FAQ ─────────────────────────────────────────────── -->
<?php ar_faq_section( $faqs, "Frequently Asked Questions About {$brand} {$appliance} Repair" ); ?>

<!-- ── RELATED SERVICES ────────────────────────────────── -->
<?php
$related = ar_get_related_services( $brand, 6, $post_id );
if ( ! empty( $related ) ) :
    ar_related_links( $related, "Other {$brand} Appliance Repair Services" );
endif;
?>

<!-- ── APPOINTMENT FORM ────────────────────────────────── -->
<section class="section">
    <div class="container container--narrow">
        <?php ar_appointment_form(
            'service-page',
            "Book Your {$brand} {$appliance} Repair Today"
        ); ?>
    </div>
</section>

<?php get_footer(); ?>




