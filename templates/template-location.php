<?php
/**
 * Template: Location / City Page — OBSIDIAN Design System
 *
 * ACF Fields:
 *   _ar_city, _ar_state, _ar_state_full, _ar_zip_codes,
 *   _ar_neighborhoods, _ar_suburbs, _ar_hero_subtitle,
 *   _ar_body_intro, _ar_faqs
 */
if ( ! defined('ABSPATH') ) exit;

$post_id    = get_the_ID();
$city       = get_post_meta($post_id, '_ar_city',         true) ?: get_the_title();
$state      = get_post_meta($post_id, '_ar_state',        true) ?: 'US';
$state_full = get_post_meta($post_id, '_ar_state_full',   true) ?: $state;
$zip_raw    = get_post_meta($post_id, '_ar_zip_codes',    true) ?: '';
$zips       = array_filter(array_map('trim', explode(',', $zip_raw)));
$subtitle   = get_post_meta($post_id, '_ar_hero_subtitle',true) ?: "Serving {$city} and the surrounding area — Viking-certified technicians, genuine OEM parts, 30-day warranty on every repair.";
$intro      = get_post_meta($post_id, '_ar_body_intro',   true);
$faqs       = get_post_meta($post_id, '_ar_faqs',         true);
$phone      = ar_get_phone();
$phone_raw  = ar_phone_link();
$biz        = ar_get_business_name();

$city_data = [
    'Chicago'       => ['neighborhoods'=>['Lincoln Park (60614)','Wicker Park (60622)','Logan Square (60647)','Hyde Park (60615)','Lakeview (60613)','Pilsen (60608)','River North (60654)','Gold Coast (60610)','Bucktown (60647)'],'suburbs'=>['Naperville (60540)','Evanston (60201)','Oak Park (60301)','Wheaton (60187)','Downers Grove (60515)','Wilmette (60091)','Elmhurst (60126)','Tinley Park (60477)']],
    'San Francisco' => ['neighborhoods'=>['Mission District (94110)','Castro (94114)','Pacific Heights (94115)','SoMa (94103)','Nob Hill (94108)','Richmond (94118)','Sunset (94122)','Marina (94123)'],'suburbs'=>['Palo Alto (94301)','Oakland (94601)','Berkeley (94710)','San Jose (95101)','Fremont (94536)','Daly City (94014)']],
    'Houston'       => ['neighborhoods'=>['Midtown (77006)','Montrose (77006)','Heights (77008)','River Oaks (77019)','Museum District (77004)','Galleria (77056)'],'suburbs'=>['Sugar Land (77478)','The Woodlands (77380)','Pearland (77581)','League City (77573)','Friendswood (77546)']],
    'Miami'         => ['neighborhoods'=>['Brickell (33131)','Wynwood (33127)','Coconut Grove (33133)','Little Havana (33135)','Midtown (33137)','Downtown (33132)'],'suburbs'=>['Coral Gables (33146)','Hialeah (33010)','Doral (33166)','Aventura (33180)','Hollywood (33020)','Homestead (33030)']],
    'Los Angeles'   => ['neighborhoods'=>['Silver Lake (90026)','Echo Park (90026)','Koreatown (90005)','Mid-Wilshire (90036)','Venice (90291)','West Hollywood (90046)','Culver City (90232)'],'suburbs'=>['Santa Monica (90401)','Glendale (91201)','Burbank (91501)','Pasadena (91101)','Long Beach (90801)','Torrance (90501)']],
    'New York'      => ['neighborhoods'=>['Upper West Side (10023)','Upper East Side (10021)','Chelsea (10011)','Astoria Queens (11102)','Park Slope Brooklyn (11215)','Williamsburg (11211)','Harlem (10030)'],'suburbs'=>['Brooklyn (11201)','Queens (11101)','Bronx (10451)','Staten Island (10301)','Hoboken NJ (07030)','Jersey City NJ (07302)']],
];
$local = $city_data[$city] ?? ['neighborhoods' => $zips, 'suburbs' => []];

if (empty($faqs)) $faqs = [
    ['question' => "How quickly can you reach {$city} neighborhoods?",       'answer' => "We maintain technicians across the {$city} metro area. For most city neighborhoods, same-day appointments are available. Suburban areas typically receive next-day service."],
    ['question' => "What Viking appliances do you repair in {$city}?",       'answer' => "We specialize exclusively in Viking appliances in {$city}: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models covered."],
    ['question' => "Do you service apartments and condos in {$city}?",       'answer' => "Yes. We service all property types — apartments, condos, single-family homes, and multi-unit buildings throughout {$city} and surrounding areas."],
    ['question' => "What is your pricing model for {$city} appliance repair?", 'answer' => "We charge a flat diagnostic fee (credited toward the repair if you proceed) and provide a clear upfront quote before any work begins. No hidden fees."],
    ['question' => "Are your {$city} technicians licensed and insured?",      'answer' => "Yes. All technicians are fully licensed, bonded, and insured. We carry full liability insurance on every service call throughout {$city}."],
];

$loc_meta_desc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true)
    ?: "Professional Viking appliance repair in {$city}, {$state}. Certified technicians, genuine OEM parts, 30-day warranty. Same-day service available.";

$faq_schema_loc = [];
foreach ($faqs as $faq) {
    $faq_schema_loc[] = ['@type' => 'Question', 'name' => $faq['question'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']]];
}

$_schema_data = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'LocalBusiness', '@id' => get_permalink() . '#localbusiness', 'name' => "{$biz} — {$city} Appliance Repair", 'description' => $loc_meta_desc, 'url' => get_permalink(), 'telephone' => $phone, 'areaServed' => ['@type' => 'City', 'name' => $city, 'containedInPlace' => ['@type' => 'State', 'name' => $state_full]], 'address' => ['@type' => 'PostalAddress', 'addressLocality' => $city, 'addressRegion' => $state, 'addressCountry' => 'US'], 'priceRange' => '$$', 'openingHours' => 'Mo-Sa 08:00-18:00'],
        ['@type' => 'FAQPage', '@id' => get_permalink() . '#faq', 'mainEntity' => $faq_schema_loc],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')], ['@type' => 'ListItem', 'position' => 2, 'name' => 'Locations', 'item' => home_url('/locations/')], ['@type' => 'ListItem', 'position' => 3, 'name' => "Viking Appliance Repair in {$city}"]]],
    ],
];

get_header();
ar_output_schema($_schema_data);
?>

<style>
/* ── Split hero ── */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { padding-right: 3rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 960px) {
  .ph-split { display: block; }
  .ph-split__text { padding-right: 0; }
  .ph-split__img { height: 320px; position: relative; }
  .ph-split__img img { position: absolute; }
  .ph-split__img::before { display: none; }
}
</style>

<!-- ── HERO ──────────────────────────────────── -->
<section class="loc-hero" aria-labelledby="loc-h1">
  <div class="container">
    <div class="ph-split">
      <div class="ph-split__text">
        <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:var(--space-6);">
          <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <a href="<?php echo esc_url(home_url('/locations/')); ?>">Locations</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html($city); ?></span>
        </nav>

        <span class="loc-hero__label">Service Area — <?php echo esc_html("{$city}, {$state}"); ?></span>

        <h1 class="loc-hero__title" id="loc-h1">
          Viking Appliance Repair<br>
          <em style="font-style:italic;font-weight:300;"><?php echo esc_html("{$city}, {$state_full}"); ?></em>
        </h1>

        <p class="loc-hero__sub"><?php echo esc_html($subtitle); ?></p>

        <div style="display:flex;flex-wrap:wrap;gap:12px;">
          <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--primary btn--lg">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            <?php echo esc_html($phone); ?>
          </a>
          <a href="/schedule/" class="btn btn--outline btn--lg">Schedule Online</a>
        </div>
      </div>
      <div class="ph-split__img">
        <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-tuscany-kitchen-1.jpg'); ?>"
             alt="Viking appliance repair in <?php echo esc_attr($city); ?>"
             loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ── INTRO ─────────────────────────────────── -->
<section class="section" style="border-bottom:1px solid var(--color-rule);">
  <div class="container container--narrow">
    <span class="section-header__eyebrow">Viking Repair in <?php echo esc_html($city); ?></span>
    <h2 style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;letter-spacing:-0.02em;line-height:1.12;color:#0D0D0D;margin:12px 0 20px;">
      Expert Viking Service Throughout <?php echo esc_html($city); ?>
    </h2>
    <?php if ($intro): ?>
      <div class="entry-content"><?php echo wp_kses_post(wpautop($intro)); ?></div>
    <?php else: ?>
      <p>Our certified Viking appliance repair technicians serve all neighborhoods and suburbs throughout <?php echo esc_html("{$city}, {$state_full}"); ?>. Whether your Viking range, refrigerator, dishwasher, or cooktop is malfunctioning, we offer fast, reliable repair using genuine Viking OEM parts — with a 30-day parts and labor warranty on every job.</p>
      <p>We understand that a broken Viking appliance is a major disruption to your home. That's why we offer same-day and next-day service across most of the <?php echo esc_html($city); ?> metro area, with upfront, transparent pricing and no hidden fees.</p>
    <?php endif; ?>
    <?php ar_disclaimer(); ?>
  </div>
</section>

<!-- ── SERVICES IN CITY ───────────────────────── -->
<style>
.loc-svc-wrap {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 4rem;
  align-items: start;
}
.loc-svc-row {
  display: grid;
  grid-template-columns: 44px 1fr auto;
  align-items: center;
  gap: 16px;
  padding: 16px 0;
  border-top: 1px solid #D9D8D3;
  text-decoration: none;
  color: #0D0D0D;
  position: relative;
  overflow: hidden;
  transition: background 0.12s;
}
.loc-svc-row::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0; left: -4px;
  width: 0;
  background: #C01C28;
  transition: width 0.14s;
}
.loc-svc-row:hover::before { width: 3px; left: 0; }
.loc-svc-row:hover .loc-svc-num { color: #C01C28; }
.loc-svc-row:hover .loc-svc-arrow { stroke: #C01C28; }
.loc-svc-num {
  font-family: 'Libre Baskerville', Georgia, serif;
  font-size: 1.5rem;
  font-weight: 300;
  color: #D9D8D3;
  letter-spacing: -0.04em;
  line-height: 1;
  transition: color 0.12s;
}
.loc-svc-name {
  font-family: 'Libre Baskerville', Georgia, serif;
  font-size: 1.125rem;
  font-weight: 500;
  color: #0D0D0D;
  letter-spacing: -0.01em;
  line-height: 1.2;
}
.loc-svc-arrow {
  stroke: #D9D8D3;
  transition: stroke 0.12s;
  flex-shrink: 0;
}
.loc-svc-closer { border-top: 1px solid #D9D8D3; }
.loc-svc-img {
  position: sticky;
  top: 88px;
  border-radius: 2px;
  overflow: hidden;
  aspect-ratio: 3/4;
}
.loc-svc-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
@media (max-width: 900px) {
  .loc-svc-wrap { grid-template-columns: 1fr; gap: 2.5rem; }
  .loc-svc-img { position: static; aspect-ratio: 16/9; order: 2; }
}
</style>
<section class="section" style="background:var(--color-bg-light);border-bottom:1px solid var(--color-rule);" aria-labelledby="svc-city-h2">
  <div class="container">
    <div class="loc-svc-wrap">

      <!-- Left: editorial service list -->
      <div>
        <span class="section-header__eyebrow" style="margin-bottom:12px;display:block;">Viking Repair Services in <?php echo esc_html($city); ?></span>
        <h2 id="svc-city-h2" style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;color:#0D0D0D;letter-spacing:-0.025em;line-height:1.1;margin:0 0 var(--space-6);">
          Every Viking Appliance We Service
        </h2>
        <?php
        $svcs = [
            ['name'=>'Viking Range Repair',        'slug'=>'viking-range-repair'],
            ['name'=>'Viking Refrigerator Repair',  'slug'=>'viking-refrigerator-repair'],
            ['name'=>'Viking Dishwasher Repair',    'slug'=>'viking-dishwasher-repair'],
            ['name'=>'Viking Cooktop Repair',       'slug'=>'viking-cooktop-repair'],
            ['name'=>'Viking Wall Oven Repair',     'slug'=>'viking-wall-oven-repair'],
            ['name'=>'Viking Wine Cooler Repair',   'slug'=>'viking-wine-cooler-repair'],
            ['name'=>'Viking Freezer Repair',       'slug'=>'viking-freezer-repair'],
            ['name'=>'Viking Vent Hood Repair',     'slug'=>'viking-vent-hood-repair'],
        ];
        ?>
        <div style="display:flex;flex-direction:column;">
          <?php foreach ($svcs as $i => $svc): ?>
          <a href="<?php echo esc_url(home_url('/services/' . $svc['slug'] . '/')); ?>" class="loc-svc-row">
            <span class="loc-svc-num" aria-hidden="true"><?php echo str_pad($i+1,2,'0',STR_PAD_LEFT); ?></span>
            <span class="loc-svc-name"><?php echo esc_html($svc['name']); ?></span>
            <svg class="loc-svc-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <?php endforeach; ?>
          <div class="loc-svc-closer"></div>
        </div>
      </div>

      <!-- Right: Viking kitchen image -->
      <div class="loc-svc-img">
        <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-5series-kitchen.jpg'); ?>"
             alt="Viking appliances in <?php echo esc_attr($city); ?>"
             loading="lazy">
      </div>

    </div>
  </div>
</section>

<!-- ── SERVICE AREA ───────────────────────────── -->
<?php if (!empty($local['neighborhoods']) || !empty($local['suburbs'])): ?>
<section class="section" style="border-bottom:1px solid var(--color-rule);" aria-labelledby="coverage-h2">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:start;">

      <?php if (!empty($local['neighborhoods'])): ?>
      <div>
        <span class="section-header__eyebrow">City Neighborhoods</span>
        <h2 id="coverage-h2" style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.5rem,2.5vw,2rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 20px;line-height:1.1;">
          <?php echo esc_html($city); ?> Neighborhoods We Serve
        </h2>
        <div class="zip-grid">
          <?php foreach ($local['neighborhoods'] as $n): ?>
          <span class="zip-badge"><?php echo esc_html($n); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if (!empty($local['suburbs'])): ?>
      <div>
        <span class="section-header__eyebrow">Surrounding Suburbs</span>
        <h3 style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.5rem,2.5vw,2rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 20px;line-height:1.1;">
          Suburban Service Areas
        </h3>
        <div class="zip-grid">
          <?php foreach ($local['suburbs'] as $s): ?>
          <span class="zip-badge"><?php echo esc_html($s); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── WHY US (city-specific) ─────────────────── -->
<section class="section" style="background:var(--color-primary-dark);border-bottom:1px solid rgba(255,255,255,0.07);" aria-labelledby="why-city-h2">
  <div class="container">
    <div style="text-align:center;margin-bottom:var(--space-10);">
      <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:rgba(255,255,255,0.35);display:block;margin-bottom:14px;">Why <?php echo esc_html($city); ?> Homeowners Trust Us</span>
      <h2 id="why-city-h2" style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.875rem,3.5vw,3rem);font-weight:300;color:#fff;letter-spacing:-0.025em;line-height:1.1;margin:0;">
        Premium Viking Service in <?php echo esc_html($city); ?>
      </h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);border-left:1px solid rgba(255,255,255,0.08);">
      <?php
      $whys = [
          ['n'=>'01','t'=>'Local Technicians','b'=>"Our team is based throughout the {$city} metro area — no long waits for technicians traveling from out of town."],
          ['n'=>'02','t'=>'Genuine Viking OEM Parts','b'=>"We carry only genuine Viking OEM parts. No aftermarket alternatives — your appliance performs exactly as Viking designed it."],
          ['n'=>'03','t'=>'30-Day Written Warranty','b'=>"Every repair in {$city} is backed by our 30-day parts and labor warranty. Written documentation provided on the day of service."],
      ];
      foreach ($whys as $w): ?>
      <div style="border-right:1px solid rgba(255,255,255,0.08);padding:36px 32px;display:flex;flex-direction:column;gap:14px;">
        <div style="font-family:'Libre Baskerville',Georgia,serif;font-size:4rem;font-weight:300;color:rgba(255,255,255,0.12);line-height:1;letter-spacing:-0.04em;" aria-hidden="true"><?php echo esc_html($w['n']); ?></div>
        <h3 style="font-family:'Libre Baskerville',Georgia,serif;font-size:1.25rem;font-weight:500;color:#fff;letter-spacing:-0.01em;line-height:1.2;"><?php echo esc_html($w['t']); ?></h3>
        <p style="font-family:'Manrope',sans-serif;font-size:13.5px;color:rgba(255,255,255,0.5);line-height:1.75;margin:0;"><?php echo esc_html($w['b']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FAQ ────────────────────────────────────── -->
<?php ar_faq_section($faqs, "Viking Appliance Repair in {$city} — FAQ"); ?>

<!-- ── APPOINTMENT ────────────────────────────── -->
<?php ar_appointment_form('location-page', "Book Viking Appliance Repair in {$city}"); ?>

<?php get_footer(); ?>
