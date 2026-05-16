<?php
/**
 * Template: Service Page — OBSIDIAN Design System
 * Editorial precision service page for Viking appliance repair
 *
 * ACF Fields:
 *   _ar_brand, _ar_appliance_type, _ar_hero_subtitle,
 *   _ar_body_intro, _ar_common_issues, _ar_features,
 *   _ar_process_steps, _ar_faqs, _ar_services
 */
if ( ! defined('ABSPATH') ) exit;

$post_id   = get_the_ID();
$brand     = get_post_meta($post_id, '_ar_brand',          true) ?: 'Viking';
$appliance = get_post_meta($post_id, '_ar_appliance_type', true) ?: 'Appliance';
$biz       = ar_get_business_name();
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$subtitle  = get_post_meta($post_id, '_ar_hero_subtitle',  true) ?: "Expert {$brand} {$appliance} repair using genuine Viking OEM parts — same-day service and a 30-day written warranty.";
$intro     = get_post_meta($post_id, '_ar_body_intro',     true);
$issues    = get_post_meta($post_id, '_ar_common_issues',  true);
$features  = get_post_meta($post_id, '_ar_features',       true);
$steps     = get_post_meta($post_id, '_ar_process_steps',  true);
$faqs      = get_post_meta($post_id, '_ar_faqs',           true);
$services  = get_post_meta($post_id, '_ar_services',       true);

// Fallback data
if ( empty($issues) ) $issues = [
    ['title' => 'Not Draining or Spinning',   'description' => "Clogged pump filter, faulty drain pump, or blocked drain hose. Our {$brand} technicians diagnose and resolve the issue on the first visit."],
    ['title' => 'Displaying Error Codes',     'description' => "{$brand} appliances display specific error codes that identify the underlying fault. We decode, diagnose, and fix them with genuine Viking OEM parts."],
    ['title' => 'Excessive Vibration or Noise','description' => 'Worn drum bearings, damaged shock absorbers, or an unbalanced sensor. We replace only what\'s needed using factory-specification parts.'],
    ['title' => 'Not Starting or Powering On','description' => 'Control board faults, door latch issues, or wiring problems can prevent startup. We trace the fault to its source and repair it correctly.'],
    ['title' => 'Water Leaking',              'description' => "Door seals, hose connections, and pump components are carefully inspected and replaced with genuine {$brand} OEM parts as needed."],
    ['title' => 'Not Heating Correctly',      'description' => "Heating elements and temperature sensors are tested to ensure your {$brand} appliance reaches the correct operating temperature every cycle."],
];

if ( empty($features) ) $features = [
    ['icon' => '&#x2713;', 'title' => 'Genuine Viking OEM Parts',    'description' => "We stock only genuine {$brand} OEM replacement components — restoring your appliance to factory performance and protecting any remaining warranty."],
    ['icon' => '&#x2713;', 'title' => 'Viking-Certified Technicians', 'description' => "Factory-trained on {$brand} appliances, fully certified, background-checked, and insured — arriving with professional diagnostic tools and a complete parts inventory."],
    ['icon' => '&#x2713;', 'title' => '30-Day Written Warranty',      'description' => "If the same fault recurs within 30 days of your repair, we return and resolve it at no additional charge. Our warranty documentation is provided on the day of service."],
];

if ( empty($steps) ) $steps = [
    ['title' => 'Book Your Appointment', 'description' => "Call or use the online form. Same-day and next-day slots available Mon–Sat in most service areas."],
    ['title' => 'Technician Arrives',    'description' => "Your {$brand}-trained technician arrives in the confirmed time window, fully equipped with diagnostic tools and a comprehensive OEM parts inventory."],
    ['title' => 'Accurate Diagnosis',    'description' => "We identify the root cause — not just the symptom — and provide a clear upfront repair quote before any work begins."],
    ['title' => 'Professional Repair',   'description' => "Using genuine Viking OEM parts, we complete the repair efficiently and leave your home clean and tidy."],
    ['title' => 'Warranty Confirmed',    'description' => "Your 30-day parts and labor warranty begins from the date of repair. We leave you with full written documentation."],
];

if ( empty($faqs) ) $faqs = [
    ['question' => "How long does a {$brand} {$appliance} repair take?",                     'answer' => "Most {$brand} {$appliance} repairs are completed in a single visit lasting 1 to 2 hours. We stock an extensive inventory of genuine OEM parts, so same-day completion is the norm. If a part must be ordered, we provide a clear timeline upfront."],
    ['question' => "Is it worth repairing my {$brand} {$appliance}?",                        'answer' => "{$brand} appliances are engineered for longevity. If your {$appliance} is under 10 years old and the repair cost is less than 50% of replacement cost, repair is almost always the more economical choice. Our technicians provide a transparent assessment."],
    ['question' => "Do you offer same-day {$brand} {$appliance} repair?",                    'answer' => "Yes. We offer same-day service appointments in most of our service areas, subject to technician availability. We recommend calling early in the day for the best chance of same-day scheduling."],
    ['question' => "What warranty do you provide on repairs?",                                'answer' => "Every repair is covered by our 30-day parts and labor warranty. If the same fault recurs within 30 days of your service date, we return and resolve it at no additional cost."],
    ['question' => "Do you service all {$brand} {$appliance} models?",                       'answer' => "Yes. Our technicians are trained and equipped to service the full {$brand} product range, from the Professional Series to the ICONIC Series. Contact us to confirm parts availability for rare models."],
    ['question' => "What areas do you serve?",                                                'answer' => "We service Los Angeles, Chicago, New York, San Francisco, Houston, Miami, and their surrounding areas. View our full list of service locations for specific neighborhoods and suburbs."],
];

// Image map
$slug = get_post_field('post_name', get_the_ID());
$image_map = [
    'viking-range-repair'        => '/assets/images/viking-3series-feature.jpg',
    'viking-refrigerator-repair' => '/assets/images/viking-refrigerator-3series.jpg',
    'viking-dishwasher-repair'   => '/assets/images/viking-dishwasher-7series.jpg',
    'viking-cooktop-repair'      => '/assets/images/48InductionHomepageSlide2025-2.png',
    'viking-wall-oven-repair'    => '/assets/images/viking-wall-oven-7series.jpg',
    'viking-wine-cooler-repair'  => '/assets/images/viking-wine-cellar.jpg',
    'viking-freezer-repair'      => '/assets/images/viking-refrigerator-integrated.jpg',
    'viking-vent-hood-repair'    => '/assets/images/viking-5series-kitchen.jpg',
];
$image_path = $image_map[$slug] ?? '/assets/images/viking-kitchen-7series-hero.jpg';

// Schema
$meta_desc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true) ?: get_the_excerpt() ?: "Expert {$brand} {$appliance} repair using genuine Viking OEM parts. 30-day warranty. Same-day service available.";
$faq_schema = [];
foreach ($faqs as $faq) {
    $faq_schema[] = ['@type' => 'Question', 'name' => $faq['question'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']]];
}

get_header();
ar_output_schema([
    '@context' => 'https://schema.org',
    '@graph'   => array_filter([
        ['@type' => 'Service', '@id' => get_permalink() . '#service', 'name' => "{$brand} {$appliance} Repair", 'serviceType' => 'Appliance Repair', 'description' => $meta_desc, 'url' => get_permalink(), 'provider' => ['@type' => 'LocalBusiness', 'name' => $biz, 'telephone' => $phone], 'areaServed' => [['@type' => 'City', 'name' => 'Los Angeles'], ['@type' => 'City', 'name' => 'Chicago'], ['@type' => 'City', 'name' => 'New York'], ['@type' => 'City', 'name' => 'Houston'], ['@type' => 'City', 'name' => 'Miami'], ['@type' => 'City', 'name' => 'San Francisco']]],
        !empty($faq_schema) ? ['@type' => 'FAQPage', 'mainEntity' => $faq_schema] : null,
        ['@type' => 'BreadcrumbList', 'itemListElement' => [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')], ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url('/services/')], ['@type' => 'ListItem', 'position' => 3, 'name' => get_the_title()]]],
    ]),
]);
?>

<!-- ── HERO ──────────────────────────────────────── -->
<section class="s-hero" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . $image_path); ?>');" aria-labelledby="svc-h1">
  <div class="container">
    <div class="s-hero__content">
      <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:var(--space-6);">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="breadcrumbs__sep" aria-hidden="true">/</span>
        <a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a>
        <span class="breadcrumbs__sep" aria-hidden="true">/</span>
        <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html(get_the_title()); ?></span>
      </nav>

      <h1 class="s-hero__title" id="svc-h1">
        <?php echo esc_html("Professional {$brand} {$appliance} Repair"); ?>
      </h1>

      <p class="s-hero__sub"><?php echo esc_html($subtitle); ?></p>

      <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:center;">
        <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--crimson btn--lg">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
          <?php echo esc_html($phone); ?>
        </a>
        <a href="/schedule/" class="btn btn--outline-white btn--lg">Schedule Online</a>
      </div>

      <div class="hero__trust" style="margin-top:var(--space-8);">
        <div class="hero__trust-item"><span aria-hidden="true">&#10003;</span> Genuine Viking OEM Parts</div>
        <div class="hero__trust-item"><span aria-hidden="true">&#10003;</span> Same-Day Service</div>
        <div class="hero__trust-item"><span aria-hidden="true">&#10003;</span> 30-Day Warranty</div>
      </div>
    </div>
  </div>
</section>

<!-- ── BODY INTRO ──────────────────────────────── -->
<section class="section" style="padding-bottom:0;">
  <div class="container container--narrow">
    <span class="section-header__eyebrow">Expert <?php echo esc_html($brand); ?> Repair</span>
    <h2 style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;letter-spacing:-0.02em;line-height:1.12;color:#0D0D0D;margin:12px 0 20px;">
      Trusted <?php echo esc_html("{$brand} {$appliance}"); ?> Repair You Can Depend On
    </h2>
    <?php if ($intro): ?>
      <div class="entry-content"><?php echo wp_kses_post(wpautop($intro)); ?></div>
    <?php else: ?>
      <p><?php echo esc_html($brand); ?> <?php echo strtolower(esc_html($appliance)); ?>s are engineered for precision performance — but even the most reliable appliances occasionally need professional attention. Whether yours is displaying an error code, refusing to drain, or not operating as it should, our factory-trained technicians have the skills and the genuine Viking OEM parts to restore it to full working order.</p>
      <p>We stock an extensive inventory of genuine <?php echo esc_html($brand); ?> OEM components, which means we can complete most repairs in a single visit. Every repair we perform comes with a 30-day parts and labor warranty. If the same problem returns within a month, we fix it at no additional cost.</p>
    <?php endif; ?>
    <?php ar_disclaimer($brand); ?>
  </div>
</section>

<!-- ── COMMON ISSUES ──────────────────────────── -->
<?php if (!empty($issues)): ?>
<section class="section" style="background:var(--color-bg-light);border-top:1px solid var(--color-rule);border-bottom:1px solid var(--color-rule);" aria-labelledby="issues-h2">
  <div class="container">
    <div class="section-header section-header--center" style="max-width:580px;margin-left:auto;margin-right:auto;margin-bottom:var(--space-10);">
      <span class="section-header__eyebrow">What We Fix</span>
      <h2 id="issues-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.75rem,3vw,2.625rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 0;line-height:1.1;">
        Common <?php echo esc_html("{$brand} {$appliance}"); ?> Problems We Repair
      </h2>
    </div>
    <div class="grid grid-3" style="gap:var(--space-4);">
      <?php foreach ($issues as $issue): ?>
      <div class="issue-card">
        <div class="issue-card__title"><?php echo esc_html($issue['title']); ?></div>
        <p class="issue-card__desc"><?php echo esc_html($issue['description']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── SERVICES & PRICING ─────────────────────── -->
<?php if (!empty($services)): ?>
<section class="svc-pricing" aria-labelledby="svc-pricing-h2">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-header__eyebrow">Services &amp; Pricing</span>
      <h2 id="svc-pricing-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.75rem,3vw,2.625rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 8px;line-height:1.1;">
        <?php echo esc_html("{$brand} {$appliance}"); ?> Repair Services &amp; Typical Costs
      </h2>
      <p class="section-header__subtitle">All prices are estimates. Your technician provides a firm written quote before any work begins.</p>
    </div>
    <div class="svc-pricing-grid">
      <?php foreach ($services as $svc): ?>
      <div class="svc-pricing-card">
        <div class="svc-pricing-card__header">
          <h3 class="svc-pricing-card__name"><?php echo esc_html($svc['name']); ?></h3>
          <?php if (!empty($svc['price_range'])): ?>
          <span class="svc-pricing-card__price"><?php echo esc_html($svc['price_range']); ?></span>
          <?php endif; ?>
        </div>
        <p class="svc-pricing-card__desc"><?php echo esc_html($svc['description']); ?></p>
        <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="svc-pricing-card__cta">Book this repair &rarr;</a>
      </div>
      <?php endforeach; ?>
    </div>
    <p class="svc-pricing-note">* Price ranges are estimates for parts and labor. Final cost depends on the specific model and fault. All repairs include a 30-day warranty.</p>
  </div>
</section>
<?php endif; ?>

<!-- ── WHY CHOOSE US ──────────────────────────── -->
<?php if (!empty($features)): ?>
<section class="section" aria-labelledby="why-svc-h2">
  <div class="container">
    <div class="section-header section-header--center">
      <span class="section-header__eyebrow">Why Choose Us</span>
      <h2 id="why-svc-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.75rem,3vw,2.625rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 0;line-height:1.1;">
        Why Homeowners Choose Us for <?php echo esc_html($brand); ?> Repair
      </h2>
    </div>
    <div class="grid grid-3" style="gap:var(--space-8);">
      <?php foreach ($features as $i => $f): ?>
      <div>
        <div style="font-family:'Cormorant',Georgia,serif;font-size:3.5rem;font-weight:300;color:#D9D8D3;line-height:1;letter-spacing:-0.04em;margin-bottom:16px;" aria-hidden="true">
          <?php echo str_pad($i+1, 2, '0', STR_PAD_LEFT); ?>
        </div>
        <h3 style="font-family:'Cormorant',Georgia,serif;font-size:1.25rem;font-weight:500;color:#0D0D0D;letter-spacing:-0.01em;line-height:1.2;margin-bottom:10px;">
          <?php echo esc_html($f['title']); ?>
        </h3>
        <p style="font-size:14px;color:#717170;line-height:1.75;margin:0;">
          <?php echo esc_html($f['description']); ?>
        </p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── HOW IT WORKS ───────────────────────────── -->
<?php if (!empty($steps)): ?>
<section class="svc-hiw-section" id="how-it-works" aria-labelledby="svc-hiw-h2">
  <div class="container">
    <div class="svc-hiw-layout">

      <div class="svc-hiw-sidebar">
        <div class="section-header__eyebrow" style="margin-bottom:12px;">Our Process</div>
        <h2 id="svc-hiw-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.875rem,3vw,2.625rem);font-weight:400;color:#0D0D0D;line-height:1.1;letter-spacing:-0.025em;margin:0 0 16px;">
          How Your <?php echo esc_html("{$brand} {$appliance}"); ?> Repair Works
        </h2>
        <p style="font-size:14px;color:#717170;line-height:1.75;margin:0 0 var(--space-6);">
          From booking to final warranty confirmation — transparent and straightforward every step of the way.
        </p>

        <div class="svc-hiw-media">
          <img
            src="<?php echo get_template_directory_uri() . $image_path; ?>"
            alt="<?php echo esc_attr("{$brand} {$appliance}"); ?> repair"
            loading="lazy"
          >
          <a href="/schedule/" class="btn btn--primary btn--lg svc-hiw-btn" style="margin-top:16px;">
            Schedule a Repair &rarr;
          </a>
        </div>

        <div class="svc-hiw-stats" style="margin-top:var(--space-5);" role="list">
          <div class="svc-hiw-stat" role="listitem"><span class="svc-hiw-stat-val">98%</span><span class="svc-hiw-stat-lbl">First-visit fix</span></div>
          <div class="svc-hiw-stat" role="listitem"><span class="svc-hiw-stat-val">1–2 hr</span><span class="svc-hiw-stat-lbl">Avg. repair</span></div>
          <div class="svc-hiw-stat" role="listitem"><span class="svc-hiw-stat-val">30 Day</span><span class="svc-hiw-stat-lbl">Warranty</span></div>
        </div>
      </div>

      <ol class="svc-hiw-track" aria-label="Repair process steps">
        <?php foreach ($steps as $i => $step):
          $num = str_pad($i+1, 2, '0', STR_PAD_LEFT);
        ?>
        <li class="svc-hiw-step">
          <div class="svc-hiw-spine" aria-hidden="true">
            <div class="svc-hiw-node"><span class="svc-hiw-node-num"><?php echo esc_html($num); ?></span></div>
            <div class="svc-hiw-line"></div>
          </div>
          <div class="svc-hiw-content">
            <div class="svc-hiw-micro" aria-hidden="true">Step <?php echo esc_html($num); ?></div>
            <h3 class="svc-hiw-step-title"><?php echo esc_html($step['title']); ?></h3>
            <p class="svc-hiw-step-text"><?php echo esc_html($step['description']); ?></p>
          </div>
        </li>
        <?php endforeach; ?>
      </ol>

    </div>
  </div>
</section>
<script>
(function(){
  var steps = document.querySelectorAll('.svc-hiw-step');
  if (window.matchMedia('(prefers-reduced-motion:reduce)').matches || !('IntersectionObserver' in window)) {
    steps.forEach(function(s){ s.classList.add('svc-hiw-vis'); }); return;
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

<!-- ── SERVICE AREAS CTA ───────────────────────── -->
<section style="background:var(--color-primary-dark);padding:var(--section-sm) 0;" aria-labelledby="loc-cta-h2">
  <div class="container" style="text-align:center;">
    <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:rgba(255,255,255,0.35);display:block;margin-bottom:16px;">Service Areas</span>
    <h2 id="loc-cta-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;color:#fff;letter-spacing:-0.02em;line-height:1.1;margin:0 0 14px;">We Service Your Area</h2>
    <p style="font-family:'Manrope',sans-serif;font-size:15px;color:rgba(255,255,255,0.5);max-width:520px;margin:0 auto var(--space-8);line-height:1.7;">
      Serving Chicago, San Francisco, Houston, Miami, Los Angeles, New York, and their surrounding neighborhoods.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:var(--space-3);justify-content:center;margin-bottom:var(--space-8);">
      <?php
      $cities = ['Chicago'=>'chicago','San Francisco'=>'san-francisco','Houston'=>'houston','Miami'=>'miami','Los Angeles'=>'los-angeles','New York'=>'new-york'];
      foreach ($cities as $name => $cslug): ?>
      <a href="<?php echo esc_url(home_url("/locations/{$cslug}/")); ?>"
         style="display:inline-flex;align-items:center;padding:7px 16px;border:1px solid rgba(255,255,255,0.15);font-family:'Manrope',sans-serif;font-size:12px;font-weight:600;letter-spacing:0.06em;color:rgba(255,255,255,0.65);text-decoration:none;border-radius:2px;transition:border-color 0.12s ease,color 0.12s ease;">
        <?php echo esc_html($name); ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FAQ ────────────────────────────────────── -->
<?php ar_faq_section($faqs, "Frequently Asked Questions About {$brand} {$appliance} Repair"); ?>

<!-- ── RELATED SERVICES ────────────────────────── -->
<?php
$related = ar_get_related_services($brand, 6, $post_id);
if (!empty($related)) ar_related_links($related, "Other {$brand} Appliance Repair Services");
?>

<!-- ── APPOINTMENT FORM ────────────────────────── -->
<?php ar_appointment_form('service-page', "Book Your {$brand} {$appliance} Repair Today"); ?>

<?php get_footer(); ?>
