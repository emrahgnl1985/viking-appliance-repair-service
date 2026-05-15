<?php
/**
 * Template: Location / City Page
 * Viking Appliance Repair Service Theme
 *
 * ACF Fields:
 *   _ar_city          — string
 *   _ar_state         — string (abbreviated, e.g. "IL")
 *   _ar_state_full    — string (e.g. "Illinois")
 *   _ar_zip_codes     — textarea (comma-separated)
 *   _ar_neighborhoods — repeater: [ name ]
 *   _ar_suburbs       — repeater: [ name, zip ]
 *   _ar_hero_subtitle — string
 *   _ar_body_intro    — textarea
 *   _ar_faqs          — repeater: [ question, answer ]
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$post_id    = get_the_ID();
$city       = get_post_meta( $post_id, '_ar_city', true )       ?: get_the_title();
$state      = get_post_meta( $post_id, '_ar_state', true )      ?: 'US';
$state_full = get_post_meta( $post_id, '_ar_state_full', true ) ?: $state;
$zip_raw    = get_post_meta( $post_id, '_ar_zip_codes', true )  ?: '';
$zips       = array_filter( array_map( 'trim', explode( ',', $zip_raw ) ) );
$subtitle   = get_post_meta( $post_id, '_ar_hero_subtitle', true ) ?: "Serving {$city} and the surrounding area — Viking-certified technicians, genuine OEM parts, 30-day warranty on every repair.";
$intro      = get_post_meta( $post_id, '_ar_body_intro', true );
$faqs       = get_post_meta( $post_id, '_ar_faqs', true );
$phone      = ar_get_phone();
$phone_raw  = ar_phone_link();
$biz        = ar_get_business_name();

// Neighborhood data per city (fallbacks)
$city_data = [
    'Chicago'       => [ 'neighborhoods' => ['Lincoln Park (60614)', 'Wicker Park (60622)', 'Logan Square (60647)', 'Hyde Park (60615)', 'Lakeview (60613)', 'Pilsen (60608)', 'Bridgeport (60608)', 'River North (60654)', 'Gold Coast (60610)', 'Bucktown (60647)'], 'suburbs' => ['Naperville (60540)', 'Evanston (60201)', 'Oak Park (60301)', 'Wheaton (60187)', 'Downers Grove (60515)', 'Wilmette (60091)', 'Elmhurst (60126)', 'Tinley Park (60477)'] ],
    'San Francisco' => [ 'neighborhoods' => ['Mission District (94110)', 'Castro (94114)', 'Pacific Heights (94115)', 'SoMa (94103)', 'Nob Hill (94108)', 'Richmond (94118)', 'Sunset (94122)', 'Marina (94123)'], 'suburbs' => ['Palo Alto (94301)', 'Oakland (94601)', 'Berkeley (94710)', 'San Jose (95101)', 'Fremont (94536)', 'Daly City (94014)'] ],
    'Houston'       => [ 'neighborhoods' => ['Midtown (77006)', 'Montrose (77006)', 'Heights (77008)', 'River Oaks (77019)', 'Museum District (77004)', 'Galleria (77056)', 'Katy (77449)'], 'suburbs' => ['Sugar Land (77478)', 'The Woodlands (77380)', 'Pearland (77581)', 'League City (77573)', 'Friendswood (77546)'] ],
    'Miami'         => [ 'neighborhoods' => ['Brickell (33131)', 'Wynwood (33127)', 'Coconut Grove (33133)', 'Little Havana (33135)', 'Midtown (33137)', 'Downtown (33132)'], 'suburbs' => ['Coral Gables (33146)', 'Hialeah (33010)', 'Doral (33166)', 'Aventura (33180)', 'Hollywood (33020)', 'Homestead (33030)'] ],
    'Los Angeles'   => [ 'neighborhoods' => ['Silver Lake (90026)', 'Echo Park (90026)', 'Koreatown (90005)', 'Mid-Wilshire (90036)', 'Venice (90291)', 'West Hollywood (90046)', 'Culver City (90232)'], 'suburbs' => ['Santa Monica (90401)', 'Glendale (91201)', 'Burbank (91501)', 'Pasadena (91101)', 'Long Beach (90801)', 'Torrance (90501)'] ],
    'New York'      => [ 'neighborhoods' => ['Upper West Side (10023)', 'Upper East Side (10021)', 'Chelsea (10011)', 'Astoria Queens (11102)', 'Park Slope Brooklyn (11215)', 'Williamsburg (11211)', 'Harlem (10030)'], 'suburbs' => ['Brooklyn (11201)', 'Queens (11101)', 'Bronx (10451)', 'Staten Island (10301)', 'Hoboken NJ (07030)', 'Jersey City NJ (07302)'] ],
];

$local = $city_data[ $city ] ?? [ 'neighborhoods' => $zips, 'suburbs' => [] ];

if ( empty( $faqs ) ) {
    $faqs = [
        [ 'question' => "How quickly can you reach {$city} neighborhoods?", 'answer' => "We maintain technicians positioned across the {$city} metro area. For most city neighborhoods, same-day appointments are available. Suburban areas typically receive next-day service, with same-day available when technician slots permit." ],
        [ 'question' => "What Viking appliances do you repair in {$city}?", 'answer' => "We specialize exclusively in Viking appliances in {$city}: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models and series covered." ],
        [ 'question' => "Do you service apartments and condos in {$city}?", 'answer' => "Yes. We service all property types throughout {$city} and the surrounding area — apartments, condos, single-family homes, and multi-unit buildings." ],
        [ 'question' => "What is your pricing model for {$city} appliance repair?", 'answer' => "We charge a flat diagnostic fee (credited toward the repair cost if you proceed) and provide a clear, upfront repair quote before any work begins. No hidden fees, no surprises." ],
        [ 'question' => "Are your {$city} technicians licensed and insured?", 'answer' => "Yes. All of our technicians are fully licensed, bonded, and insured. We carry full liability insurance on every service call throughout the {$city} area." ],
    ];
}

// ── Schema.org ──────────────────────────────────────────────────
$loc_meta_desc = get_post_meta( $post_id, '_yoast_wpseo_metadesc', true )
              ?: "Professional appliance repair in {$city}, {$state}. Certified technicians, genuine Viking OEM parts, 30-day warranty. Same-day service available.";

$faq_schema_loc = [];
foreach ( $faqs as $faq ) {
    $faq_schema_loc[] = [
        '@type'          => 'Question',
        'name'           => $faq['question'],
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $faq['answer'] ],
    ];
}

// Schema — stored for output after get_header()
$_schema_data = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'LocalBusiness',
            '@id'         => get_permalink() . '#localbusiness',
            'name'        => "{$biz} — {$city} Appliance Repair",
            'description' => $loc_meta_desc,
            'url'         => get_permalink(),
            'telephone'   => $phone,
            'areaServed'  => [
                '@type' => 'City',
                'name'  => $city,
                'containedInPlace' => ['@type' => 'State', 'name' => $state_full],
            ],
            'address' => [
                '@type'           => 'PostalAddress',
                'addressLocality' => $city,
                'addressRegion'   => $state,
                'addressCountry'  => 'US',
            ],
            'priceRange'       => '$$',
            'currenciesAccepted' => 'USD',
            'openingHours'     => 'Mo-Sa 08:00-18:00',
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => get_permalink() . '#faq',
            'mainEntity' => $faq_schema_loc,
        ],
        [
            '@type'     => 'BreadcrumbList',
            '@id'       => get_permalink() . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',      'item' => home_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Locations', 'item' => home_url('/locations/')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => "Viking Appliance Repair in {$city}"],
            ],
        ],
    ],
];

get_header();
ar_output_schema($_schema_data);
?>
<style>
.loc-area-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-12);
    align-items: start;
}
@media (max-width: 767px) {
    .loc-area-grid { grid-template-columns: 1fr; gap: var(--space-8); }
}
</style>

<!-- ── HERO ────────────────────────────────────────────── -->
<section class="hero hero--location" aria-labelledby="hero-h1">
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="hero__bg" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'ar-hero' ) ); ?>');" aria-hidden="true"></div>
    <?php endif; ?>

    <div class="container">
        <div class="hero__content">
            <span class="hero__eyebrow">
                <span aria-hidden="true">&#x1F4CD;</span>
                Serving <?php echo esc_html( $city ); ?>, <?php echo esc_html( $state ); ?>
            </span>

            <h1 class="hero__title" id="hero-h1">
                Viking Appliance Repair in <?php echo esc_html( $city ); ?>, <?php echo esc_html( $state_full ); ?>
            </h1>

            <p class="hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>

            <div class="hero__cta-group">
                <a href="<?php echo esc_url( $phone_raw ); ?>" class="btn btn--call btn--lg">
                    &#x1F4DE; <?php echo esc_html( $phone ); ?>
                </a>
                <a href="/schedule/" class="btn btn--outline-white btn--lg">Schedule Online</a>
            </div>

            <div class="hero__trust">
                <div class="hero__trust-item"><span class="hero__trust-icon" aria-hidden="true">&#x1F4CD;</span> Local <?php echo esc_html( $city ); ?> Technicians</div>
                <div class="hero__trust-item"><span class="hero__trust-icon" aria-hidden="true">&#x23F0;</span> Same-Day Service</div>
            </div>
        </div>
    </div>
</section>

<!-- ── BREADCRUMBS ─────────────────────────────────────── -->
<div class="container">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="breadcrumbs__sep" aria-hidden="true">/</span>
        <a href="<?php echo esc_url( home_url( '/locations/' ) ); ?>">Locations</a>
        <span class="breadcrumbs__sep" aria-hidden="true">/</span>
        <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html( $city ); ?></span>
    </nav>
</div>

<!-- ── SERVICE AREA INTRO ──────────────────────────────── -->
<section class="section">
    <div class="container container--narrow">
        <span class="section-header__eyebrow">Local Service</span>
        <h2>Appliance Repair Across the <?php echo esc_html( $city ); ?> Area</h2>

        <?php if ( $intro ) : ?>
            <div style="margin-top:var(--space-6);"><?php echo wp_kses_post( wpautop( $intro ) ); ?></div>
        <?php else : ?>
            <p style="margin-top:var(--space-6);">Our certified Viking technicians bring professional appliance repair directly to your door across <?php echo esc_html( $city ); ?> and the surrounding communities. When your Viking range won't heat, your refrigerator stops cooling, or your dishwasher leaves dishes dirty, you need a specialist who knows Viking appliances — not a generalist who services everything and nothing particularly well.</p>
            <p>We maintain same-day and next-day appointment availability in most <?php echo esc_html( $city ); ?> zip codes. Our technicians arrive in fully-stocked service vans, carry a comprehensive genuine Viking OEM parts inventory, and provide an upfront quote before any work begins.</p>
        <?php endif; ?>

        <?php ar_disclaimer(); ?>
    </div>
</section>

<!-- ── SERVICE AREA MAP (ZIP CODES) ───────────────────── -->
<section class="section section--bg-light">
    <div class="container">
        <div class="loc-area-grid">
            <div>
                <span class="section-header__eyebrow">Service Area</span>
                <h2 style="margin-bottom:var(--space-5);"><?php echo esc_html( $city ); ?> Neighborhoods We Serve</h2>
                <p style="color:var(--color-text-muted);margin-bottom:var(--space-5);">We cover all major <?php echo esc_html( $city ); ?> neighborhoods and communities:</p>
                <?php if ( ! empty( $local['neighborhoods'] ) ) : ?>
                <div class="zip-grid">
                    <?php foreach ( $local['neighborhoods'] as $n ) : ?>
                    <span class="zip-badge">&#x1F4CD; <?php echo esc_html( $n ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div>
                <span class="section-header__eyebrow">Surrounding Areas</span>
                <h2 style="margin-bottom:var(--space-5);">Suburbs &amp; Nearby Cities</h2>
                <p style="color:var(--color-text-muted);margin-bottom:var(--space-5);">We also serve these surrounding communities:</p>
                <?php if ( ! empty( $local['suburbs'] ) ) : ?>
                <div class="zip-grid">
                    <?php foreach ( $local['suburbs'] as $s ) : ?>
                    <span class="zip-badge">&#x1F4CD; <?php echo esc_html( $s ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ── SERVICES WE OFFER ───────────────────────────────── -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-header__eyebrow">What We Fix</span>
            <h2 class="section-header__title">Appliance Repair Services in <?php echo esc_html( $city ); ?></h2>
            <p class="section-header__subtitle">Viking appliance specialists — certified technicians, genuine OEM parts, fixed right the first time.</p>
        </div>
        <div class="grid grid-4">
            <?php
            $service_list = [
                [ 'icon' => '&#x1F525;', 'name' => 'Range Repair',        'url' => '/services/viking-range-repair/' ],
                [ 'icon' => '&#x2744;',  'name' => 'Refrigerator Repair', 'url' => '/services/viking-refrigerator-repair/' ],
                [ 'icon' => '&#x1F37D;', 'name' => 'Dishwasher Repair',   'url' => '/services/viking-dishwasher-repair/' ],
                [ 'icon' => '&#x1F373;', 'name' => 'Cooktop Repair',      'url' => '/services/viking-cooktop-repair/' ],
                [ 'icon' => '&#x25A1;',  'name' => 'Wall Oven Repair',    'url' => '/services/viking-wall-oven-repair/' ],
                [ 'icon' => '&#x1F377;', 'name' => 'Wine Cooler Repair',  'url' => '/services/viking-wine-cooler-repair/' ],
                [ 'icon' => '&#x2603;',  'name' => 'Freezer Repair',      'url' => '/services/viking-freezer-repair/' ],
                [ 'icon' => '&#x1F32A;', 'name' => 'Vent Hood Repair',    'url' => '/services/viking-vent-hood-repair/' ],
            ];
            foreach ( $service_list as $svc ) :
            ?>
            <a href="<?php echo esc_url( home_url( $svc['url'] ) ); ?>" class="service-card">
                <div class="service-card__icon" aria-hidden="true"><?php echo esc_html( $svc['icon'] ); ?></div>
                <h3 class="service-card__title"><?php echo esc_html( $svc['name'] ); ?></h3>
                <p class="service-card__desc">Certified Viking repair with genuine OEM parts in <?php echo esc_html( $city ); ?>.</p>
                <span class="service-card__link">View Service</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── VIKING APPLIANCES ────────────────────────────────── -->
<section class="section section--bg-light">
    <div class="container" style="text-align:center;">
        <span class="section-header__eyebrow">Viking Appliances We Service</span>
        <h2 class="section-header__title" style="margin-bottom:var(--space-8);">Viking Appliance Repair in <?php echo esc_html( $city ); ?></h2>
        <div style="display:flex;flex-wrap:wrap;gap:var(--space-3);justify-content:center;">
            <?php
            $viking_appliances = [
                'Range'        => 'viking-range-repair',
                'Refrigerator' => 'viking-refrigerator-repair',
                'Dishwasher'   => 'viking-dishwasher-repair',
                'Cooktop'      => 'viking-cooktop-repair',
                'Wall Oven'    => 'viking-wall-oven-repair',
                'Wine Cooler'  => 'viking-wine-cooler-repair',
                'Freezer'      => 'viking-freezer-repair',
                'Vent Hood'    => 'viking-vent-hood-repair',
            ];
            foreach ( $viking_appliances as $label => $slug ) :
            ?>
            <a href="<?php echo esc_url( home_url( "/services/{$slug}/" ) ); ?>"
               class="zip-badge"
               style="font-size:var(--text-base);padding:var(--space-2) var(--space-4);">
                <?php echo esc_html( $label ); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── FAQ ─────────────────────────────────────────────── -->
<?php ar_faq_section( $faqs, "Frequently Asked Questions — {$city} Appliance Repair" ); ?>

<!-- ── APPOINTMENT FORM ────────────────────────────────── -->
<section class="section">
    <div class="container container--narrow">
        <?php ar_appointment_form(
            'location-page',
            "Book Viking Appliance Repair in {$city} Today"
        ); ?>
    </div>
</section>

<?php get_footer(); ?>

