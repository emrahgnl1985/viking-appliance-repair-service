<?php
/**
 * Homepage — OBSIDIAN Design System
 * Architectural editorial luxury platform for Viking Appliance Repair
 */
defined('ABSPATH') || exit;
get_header();

$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();

$services = [
    ['label' => 'Viking Range Repair',        'slug' => 'viking-range-repair',        'img' => 'viking-kitchen-miramar.jpg',          'desc' => 'Professional and Tuscany Series gas and dual-fuel ranges. Burner ignition failures, oven calibration, control board faults.'],
    ['label' => 'Viking Refrigerator Repair',  'slug' => 'viking-refrigerator-repair',  'img' => 'viking-refrigerator-3series.jpg',     'desc' => 'Built-in and French Door refrigerators. Ice maker failures, compressor issues, cooling faults, door seal replacements.'],
    ['label' => 'Viking Dishwasher Repair',    'slug' => 'viking-dishwasher-repair',    'img' => 'viking-dishwasher-7series.jpg',       'desc' => 'Not cleaning, draining, or starting. Control board faults, door latch issues, spray arm failures resolved.'],
    ['label' => 'Viking Cooktop Repair',       'slug' => 'viking-cooktop-repair',       'img' => '48InductionHomepageSlide2025-2.png',  'desc' => 'Gas, electric, and induction cooktops. Burner ignition, spark module, and surface element failures.'],
    ['label' => 'Viking Wall Oven Repair',     'slug' => 'viking-wall-oven-repair',     'img' => 'viking-wall-oven-7series.jpg',        'desc' => 'Single and double wall ovens. Temperature inaccuracies, element failures, door lock faults, control panel issues.'],
    ['label' => 'Viking Wine Cooler Repair',   'slug' => 'viking-wine-cooler-repair',   'img' => 'viking-wine-cellar.jpg',             'desc' => 'Wine coolers not maintaining temperature or displaying fault codes. Compressor, thermostat, and cooling fan repairs.'],
    ['label' => 'Viking Freezer Repair',       'slug' => 'viking-freezer-repair',       'img' => 'viking-refrigerator-integrated.jpg', 'desc' => 'Column and upright freezers. Defrost system faults, temperature alarms, frost buildup, evaporator fan failures.'],
    ['label' => 'Viking Vent Hood Repair',     'slug' => 'viking-vent-hood-repair',     'img' => 'viking-5series-kitchen.jpg',          'desc' => 'Professional vent hoods. Blower motor failures, lighting faults, and control panel issues.'],
];

$cities = [
    ['name' => 'Los Angeles',   'state' => 'CA', 'slug' => 'los-angeles',   'note' => 'LA County · Santa Monica · Glendale · Pasadena'],
    ['name' => 'Chicago',       'state' => 'IL', 'slug' => 'chicago',       'note' => 'All neighborhoods · Evanston · Oak Park · Naperville'],
    ['name' => 'New York',      'state' => 'NY', 'slug' => 'new-york',      'note' => 'Manhattan · Brooklyn · Queens · The Bronx'],
    ['name' => 'San Francisco', 'state' => 'CA', 'slug' => 'san-francisco', 'note' => 'Bay Area · Palo Alto · Oakland · San Jose'],
    ['name' => 'Houston',       'state' => 'TX', 'slug' => 'houston',       'note' => 'Harris County · Sugar Land · The Woodlands · Katy'],
    ['name' => 'Miami',         'state' => 'FL', 'slug' => 'miami',         'note' => 'Miami-Dade · Coral Gables · Hialeah · Kendall'],
];

ar_output_schema([
    '@context'        => 'https://schema.org',
    '@type'           => 'LocalBusiness',
    'name'            => $biz,
    'url'             => home_url('/'),
    'telephone'       => $phone,
    'description'     => 'Certified Viking appliance repair specialists. Expert technicians, genuine Viking OEM parts, 30-day warranty on every repair. Serving Los Angeles, Chicago, New York, San Francisco, Houston, and Miami.',
    'address'         => ['@type' => 'PostalAddress', 'streetAddress' => '1800 N Vine St', 'addressLocality' => 'Los Angeles', 'addressRegion' => 'CA', 'postalCode' => '90028'],
    'openingHours'    => 'Mo-Sa 08:00-18:00',
    'priceRange'      => '$$',
    'areaServed'      => ['Los Angeles', 'Chicago', 'New York', 'San Francisco', 'Houston', 'Miami'],
]);
?>

<style>
/* ═══════════════════════════════════════════════
   HOMEPAGE — OBSIDIAN Design System
   Cormorant display + Manrope body
   Crimson accent · Ink · Pure white
   ═══════════════════════════════════════════════ */

/* ── Shared tokens (local aliases) ── */
:root {
  --cr: #C01C28;  /* crimson */
  --ink: #0D0D0D; /* near-black */
  --off: #F7F6F3; /* off-white surface */
  --muted: #717170;
  --rule: #D9D8D3;
  --serif: 'Libre Baskerville', Georgia, serif;
  --sans:  'Manrope', system-ui, sans-serif;
}

/* ── Pg base ── */
.pg {
  font-family: var(--sans);
  font-size: 16px;
  line-height: 1.65;
  color: #1A1A1A;
  background: #fff;
  -webkit-font-smoothing: antialiased;
}

/* ── Container ── */
.pg .wrap  { max-width: 1280px; margin: 0 auto; padding: 0 40px; }
.pg .wn    { max-width: 760px;  margin: 0 auto; padding: 0 40px; }

/* ── Section label ── */
.pgeb {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-family: var(--sans);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--cr);
}
.pgeb::before {
  content: '';
  display: block;
  width: 24px; height: 1.5px;
  background: var(--cr);
  flex-shrink: 0;
}

/* ── Display heading (large Cormorant) ── */
.pgd {
  font-family: var(--serif);
  font-weight: 400;
  letter-spacing: -0.02em;
  color: var(--ink);
  line-height: 1.07;
}

/* ── Body text ── */
.pgp {
  font-family: var(--sans);
  font-size: 15.5px;
  color: var(--muted);
  line-height: 1.72;
}

/* ── Crimson button ── */
.pgbtn-c {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 13px 28px;
  background: var(--cr);
  color: #fff;
  border: 1.5px solid var(--cr);
  font-family: var(--sans);
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  text-decoration: none;
  cursor: pointer;
  transition: background 0.12s ease, border-color 0.12s ease;
  border-radius: 2px;
}
.pgbtn-c:hover { background: #9A1520; border-color: #9A1520; color: #fff; }

/* ── Ink button ── */
.pgbtn-i {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 28px;
  background: transparent;
  color: var(--ink);
  border: 1.5px solid #C0C0BB;
  font-family: var(--sans);
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  text-decoration: none;
  cursor: pointer;
  transition: background 0.12s ease, border-color 0.12s ease;
  border-radius: 2px;
}
.pgbtn-i:hover { background: var(--off); border-color: #888; color: var(--ink); }

/* Horizontal rule */
.pgrule { border: none; border-top: 1px solid var(--rule); margin: 0; }
</style>


<!-- ═══════════════════════════════════════════════════════
     HERO — Full-viewport split: text | image
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-hero {
  display: grid;
  grid-template-columns: 55% 45%;
  min-height: 100svh;
  padding-top: 64px; /* nav height */
}

/* Left: editorial text panel */
.hp-hero__text {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 80px 72px 80px 40px;
  max-width: 720px;
  margin-left: auto;
  background: #fff;
}

/* Accent mark above heading */
.hp-hero__mark {
  display: block;
  width: 48px;
  height: 2px;
  background: var(--cr);
  margin-bottom: 32px;
}

.hp-hero__h1 {
  font-family: var(--serif);
  font-size: clamp(3rem, 5.5vw, 5.5rem);
  font-weight: 300;
  line-height: 1.04;
  letter-spacing: -0.03em;
  color: var(--ink);
  margin-bottom: 32px;
}
.hp-hero__h1 em {
  font-style: normal;
  font-weight: 300;
}

.hp-hero__sub {
  font-family: var(--sans);
  font-size: 16px;
  color: var(--muted);
  line-height: 1.75;
  max-width: 460px;
  margin-bottom: 40px;
}

.hp-hero__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 52px;
}

/* Trust strip */
.hp-hero__proof {
  display: flex;
  flex-wrap: wrap;
  gap: 24px 40px;
  padding-top: 28px;
  border-top: 1px solid var(--rule);
}
.hp-hero__proof-item {
  font-family: var(--sans);
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.04em;
  color: var(--muted);
  display: flex;
  align-items: center;
  gap: 7px;
}
.hp-hero__proof-item::before {
  content: '';
  display: block;
  width: 16px; height: 1.5px;
  background: var(--cr);
  flex-shrink: 0;
}

/* Right: full-bleed image */
.hp-hero__img {
  position: relative;
  overflow: hidden;
}
.hp-hero__img img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center 20%;
}

/* Thin crimson line between panels */
.hp-hero__img::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0; left: 0;
  width: 2px;
  background: var(--cr);
  z-index: 1;
}

/* Small info badge on image */
.hp-hero__badge {
  position: absolute;
  bottom: 32px;
  right: 28px;
  z-index: 2;
  background: rgba(13,13,13,0.88);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  color: #fff;
  padding: 16px 20px;
  border-radius: 2px;
  border-left: 2px solid var(--cr);
}
.hp-hero__badge-val {
  font-family: var(--serif);
  font-size: 36px;
  font-weight: 300;
  line-height: 1;
  letter-spacing: -0.03em;
  display: block;
  margin-bottom: 4px;
}
.hp-hero__badge-lbl {
  font-family: var(--sans);
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.55);
}

/* Scroll indicator */
.hp-hero__scroll {
  position: absolute;
  bottom: 28px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 5px;
  opacity: 0.3;
  animation: hp-bounce 2.2s ease infinite;
  pointer-events: none;
}
@keyframes hp-bounce {
  0%, 100% { transform: translateX(-50%) translateY(0); }
  55%       { transform: translateX(-50%) translateY(6px); }
}
.hp-hero__scroll svg { color: var(--ink); }
.hp-hero__scroll span {
  font-family: var(--sans);
  font-size: 9px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--ink);
}

@media (max-width: 1100px) {
  .hp-hero { grid-template-columns: 1fr; min-height: auto; }
  .hp-hero__text { padding: 80px 40px 60px; max-width: 640px; margin: 0 auto; }
  .hp-hero__img { height: 480px; position: relative; }
  .hp-hero__img img { position: absolute; }
  .hp-hero__img::before { display: none; }
}
@media (max-width: 640px) {
  .hp-hero__text { padding: 64px 24px 48px; }
  .hp-hero__h1   { font-size: 3rem; }
  .hp-hero__img  { height: 360px; }
  .hp-hero__badge { display: none; }
}
</style>

<div class="pg" id="hero-section">
<section class="hp-hero" aria-labelledby="home-h1">

  <!-- Left: editorial text -->
  <div class="hp-hero__text">
    <span class="hp-hero__mark" aria-hidden="true"></span>

    <h1 class="hp-hero__h1" id="home-h1">
      Viking Appliance<br>
      <em>Repair Specialists</em>
    </h1>

    <p class="hp-hero__sub">
      Genuine Viking OEM parts. Certified technicians. Same-day and next-day service available across six major metro areas — with a full 30-day warranty on every repair.
    </p>

    <div class="hp-hero__actions">
      <a href="<?php echo esc_url($phone_link); ?>" class="pgbtn-c">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
        <?php echo esc_html($phone); ?>
      </a>
      <a href="/schedule/" class="pgbtn-i">Schedule Repair &rarr;</a>
    </div>

    <div class="hp-hero__proof" role="list" aria-label="Service guarantees">
      <?php foreach ([
          'Genuine Viking OEM Parts',
          '30-Day Warranty',
          'Same-Day Service',
          'Certified Technicians',
      ] as $p): ?>
      <div class="hp-hero__proof-item" role="listitem"><?php echo esc_html($p); ?></div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Right: Viking kitchen photography -->
  <div class="hp-hero__img" role="img" aria-label="Viking Professional kitchen">
    <img
      src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg'); ?>"
      alt="Viking Professional Series kitchen with range and refrigerator"
      fetchpriority="high"
      decoding="async"
    >
    <div class="hp-hero__badge" aria-label="98% first-visit fix rate">
      <span class="hp-hero__badge-val">98%</span>
      <span class="hp-hero__badge-lbl">First-visit fix rate</span>
    </div>
  </div>

  <div class="hp-hero__scroll" aria-hidden="true">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
    <span>Scroll</span>
  </div>

</section>
</div>


<!-- ═══════════════════════════════════════════════════════
     TICKER BAR — Animated crimson marquee
     ═══════════════════════════════════════════════════════ -->
<style>
@keyframes hp-ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-33.333%); } }
@media (prefers-reduced-motion: reduce) { .hp-ticker-track { animation: none !important; } }
.hp-ticker { background: #C01C28; padding: .75rem 0; overflow: hidden; border-top: 1px solid rgba(255,255,255,.15); }
.hp-ticker-track {
    display: flex;
    gap: 4rem;
    white-space: nowrap;
    animation: hp-ticker 28s linear infinite;
}
.hp-ticker-item {
    font-family: 'Manrope', system-ui, sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: rgba(255,255,255,.9);
    flex-shrink: 0;
}
.hp-ticker-item__diamond {
    color: rgba(255,255,255,.35);
    margin-right: 1rem;
}
</style>

<div class="hp-ticker" aria-hidden="true">
  <div class="hp-ticker-track">
    <?php
    $ticker_items = [
        'Genuine Viking OEM Parts Only',
        '98% First-Visit Fix Rate',
        '30-Day Written Warranty',
        'Same-Day Service Mon–Sat',
        'Certified Viking Technicians',
        'Upfront Pricing — No Hidden Fees',
        'All Viking Models Serviced',
        '6 Metro Areas Covered',
    ];
    // Repeat 3× so the loop is seamless
    for ($r = 0; $r < 3; $r++): foreach ($ticker_items as $item): ?>
    <span class="hp-ticker-item"><span class="hp-ticker-item__diamond" aria-hidden="true">&#9670;</span><?php echo esc_html($item); ?></span>
    <?php endforeach; endfor; ?>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════
     PROOF BAR — Four large stats
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-proof {
  border-bottom: 1px solid var(--rule);
  background: #fff;
}
.hp-proof__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  border-left: 1px solid var(--rule);
}
.hp-proof__cell {
  padding: 36px 32px;
  border-right: 1px solid var(--rule);
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.hp-proof__val {
  font-family: var(--serif);
  font-size: clamp(1.75rem, 2.5vw, 2.5rem);
  font-weight: 400;
  white-space: nowrap;
  color: var(--ink);
  line-height: 1;
  letter-spacing: -0.03em;
}
.hp-proof__label {
  font-family: var(--sans);
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.06em;
  color: var(--muted);
  text-transform: uppercase;
}
.hp-proof__note {
  font-family: var(--sans);
  font-size: 13px;
  color: #AAAAAA;
  line-height: 1.5;
}

@media (max-width: 900px) {
  .hp-proof__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
  .hp-proof__grid { grid-template-columns: 1fr; border-left: none; }
  .hp-proof__cell { padding: 32px 24px; border-right: none; border-bottom: 1px solid var(--rule); }
  .hp-proof__cell:last-child { border-bottom: none; }
}
</style>

<div class="pg">
<section class="hp-proof" aria-label="Service statistics">
  <div class="wrap">
    <div class="hp-proof__grid" role="list">
      <?php
      $stats = [
          ['val' => '98%',    'label' => 'First-Visit Fix Rate',    'note' => 'Most repairs completed in one visit'],
          ['val' => '30-Day', 'label' => 'Parts & Labor Warranty',  'note' => 'Written documentation same day'],
          ['val' => '1–2 hr', 'label' => 'Average Repair Time',     'note' => 'Minimal disruption to your day'],
          ['val' => 'OEM',    'label' => 'Genuine Viking Parts Only','note' => 'No aftermarket substitutes, ever'],
      ];
      foreach ($stats as $s): ?>
      <div class="hp-proof__cell" role="listitem">
        <div class="hp-proof__val"><?php echo esc_html($s['val']); ?></div>
        <div class="hp-proof__label"><?php echo esc_html($s['label']); ?></div>
        <div class="hp-proof__note"><?php echo esc_html($s['note']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>


<!-- ═══════════════════════════════════════════════════════
     SERVICES — Editorial horizontal list
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-svc {
  background: var(--off);
  padding: 100px 0;
  border-bottom: 1px solid var(--rule);
}
.hp-svc__head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 40px;
  margin-bottom: 56px;
  flex-wrap: wrap;
}
.hp-svc__head-text { max-width: 480px; }
.hp-svc__head-title {
  font-family: var(--serif);
  font-size: clamp(2rem, 3.5vw, 3.25rem);
  font-weight: 300;
  color: var(--ink);
  line-height: 1.1;
  letter-spacing: -0.025em;
  margin-top: 12px;
  margin-bottom: 0;
}

/* Service tile grid */
.hp-svc__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0;
  border-top: 1px solid var(--rule);
  border-left: 1px solid var(--rule);
}

.hp-svc__tile {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 32px 28px 28px;
  border-right: 1px solid var(--rule);
  border-bottom: 1px solid var(--rule);
  text-decoration: none;
  color: var(--ink);
  background: #fff;
  position: relative;
  overflow: hidden;
  min-height: 180px;
  transition: background 0.14s ease;
}
.hp-svc__tile::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 0;
  background: var(--cr);
  transition: height 0.16s ease;
}
.hp-svc__tile:hover { background: var(--off); }
.hp-svc__tile:hover::before { height: 3px; }

.hp-svc__tile-top { display: flex; flex-direction: column; gap: 10px; }

.hp-svc__name {
  font-family: var(--serif);
  font-size: clamp(1.125rem, 1.6vw, 1.375rem);
  font-weight: 700;
  color: var(--ink);
  line-height: 1.2;
  letter-spacing: -0.01em;
  transition: color 0.12s ease;
}
.hp-svc__tile:hover .hp-svc__name { color: var(--cr); }

.hp-svc__desc {
  font-family: var(--sans);
  font-size: 13.5px;
  font-weight: 400;
  color: var(--muted);
  line-height: 1.65;
}

.hp-svc__tile-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 20px;
  padding-top: 14px;
  border-top: 1px solid var(--rule);
}
.hp-svc__tile-cta {
  font-family: var(--sans);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--muted);
  transition: color 0.12s ease;
}
.hp-svc__tile:hover .hp-svc__tile-cta { color: var(--cr); }
.hp-svc__tile-arrow {
  color: var(--rule);
  transition: color 0.12s ease, transform 0.14s ease;
}
.hp-svc__tile:hover .hp-svc__tile-arrow { color: var(--cr); transform: translateX(3px); }

.hp-svc__cta { margin-top: 32px; }

@media (max-width: 1024px) {
  .hp-svc__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .hp-svc__grid { grid-template-columns: 1fr; border-left: none; }
  .hp-svc__tile { border-right: none; min-height: auto; padding: 24px 20px; }
  .hp-svc__head { gap: 20px; }
}
</style>

<div class="pg">
<section class="hp-svc" id="our-services" aria-labelledby="svc-h2">
  <div class="wrap">

    <div class="hp-svc__head">
      <div class="hp-svc__head-text">
        <span class="pgeb">Viking Appliance Repair</span>
        <h2 class="hp-svc__head-title" id="svc-h2">Comprehensive Service for Every Viking Appliance</h2>
      </div>
      <a href="<?php echo esc_url(get_post_type_archive_link('service_page')); ?>" class="pgbtn-i">All Services &rarr;</a>
    </div>

    <div class="hp-svc__grid" role="list" aria-label="Viking appliance repair services">
      <?php foreach ($services as $svc):
        $link = home_url('/services/' . $svc['slug'] . '/');
      ?>
      <a href="<?php echo esc_url($link); ?>" class="hp-svc__tile" role="listitem">
        <div class="hp-svc__tile-top">
          <div class="hp-svc__name"><?php echo esc_html($svc['label']); ?></div>
          <div class="hp-svc__desc"><?php echo esc_html($svc['desc']); ?></div>
        </div>
        <div class="hp-svc__tile-footer">
          <span class="hp-svc__tile-cta">Book Repair</span>
          <svg class="hp-svc__tile-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

  </div>
</section>
</div>


<!-- ═══════════════════════════════════════════════════════
     FULL-BLEED EDITORIAL — Viking craftsmanship statement
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-editorial {
  position: relative;
  height: 500px;
  overflow: hidden;
  background: var(--ink);
}
.hp-editorial__img {
  position: absolute;
  inset: 0;
  width: 100%; height: 100%;
  object-fit: cover;
  object-position: center 25%;
  opacity: 0.35;
}
.hp-editorial__content {
  position: relative;
  z-index: 1;
  height: 100%;
  display: flex;
  align-items: center;
}
.hp-editorial__inner {
  max-width: 620px;
  padding: 0 40px;
  margin-left: auto;
  margin-right: calc((100vw - 1280px) / 2 + 40px);
}
.hp-editorial__eyebrow {
  font-family: var(--sans);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.4);
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.hp-editorial__eyebrow::before {
  content: '';
  display: block;
  width: 24px; height: 1.5px;
  background: var(--cr);
  flex-shrink: 0;
}
.hp-editorial__heading {
  font-family: var(--serif);
  font-size: clamp(2rem, 4vw, 3.5rem);
  font-weight: 300;
  color: #fff;
  line-height: 1.1;
  letter-spacing: -0.025em;
  margin-bottom: 24px;
}
.hp-editorial__body {
  font-family: var(--sans);
  font-size: 15px;
  color: rgba(255,255,255,0.55);
  line-height: 1.8;
  margin-bottom: 32px;
}
.hp-editorial__stats {
  display: flex;
  gap: 40px;
  padding-top: 28px;
  border-top: 1px solid rgba(255,255,255,0.1);
  flex-wrap: wrap;
}
.hp-editorial__stat-val {
  font-family: var(--serif);
  font-size: 2.5rem;
  font-weight: 300;
  color: #fff;
  letter-spacing: -0.03em;
  line-height: 1;
  display: block;
  margin-bottom: 4px;
}
.hp-editorial__stat-lbl {
  font-family: var(--sans);
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.35);
}

@media (max-width: 900px) {
  .hp-editorial__inner { margin-right: 0; padding: 0 40px; max-width: none; }
  .hp-editorial { height: auto; padding: 80px 0; }
  .hp-editorial__img { opacity: 0.2; }
}
@media (max-width: 640px) {
  .hp-editorial__inner { padding: 0 24px; }
}
</style>

<div class="pg">
<div class="hp-editorial" role="img" aria-label="Viking Tuscany Series professional kitchen">
  <img
    class="hp-editorial__img"
    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/viking-tuscany-kitchen-1.jpg'); ?>"
    alt=""
    loading="lazy"
    aria-hidden="true"
  >
  <div class="hp-editorial__content">
    <div class="hp-editorial__inner">
      <div class="hp-editorial__eyebrow">Our Technicians</div>
      <h2 class="hp-editorial__heading">
        Viking-Trained.<br>
        Fully Insured.<br>
        <em>First-Time Accurate.</em>
      </h2>
      <p class="hp-editorial__body">
        Every technician carries factory Viking diagnostic equipment, a comprehensive OEM parts inventory, and the expertise to resolve any Viking appliance failure — correctly, on the first visit.
      </p>
      <div class="hp-editorial__stats">
        <div>
          <span class="hp-editorial__stat-val">98%</span>
          <span class="hp-editorial__stat-lbl">First-visit fix rate</span>
        </div>
        <div>
          <span class="hp-editorial__stat-val">30 Day</span>
          <span class="hp-editorial__stat-lbl">Written warranty</span>
        </div>
        <div>
          <span class="hp-editorial__stat-val">1–2 hr</span>
          <span class="hp-editorial__stat-lbl">Avg. repair time</span>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<!-- ═══════════════════════════════════════════════════════
     WHY CHOOSE US — 3-column precision features
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-why { padding: 100px 0; background: #fff; border-bottom: 1px solid var(--rule); }
.hp-why__head { margin-bottom: 64px; }
.hp-why__title {
  font-family: var(--serif);
  font-size: clamp(2rem, 3.5vw, 3.125rem);
  font-weight: 300;
  color: var(--ink);
  line-height: 1.1;
  letter-spacing: -0.025em;
  margin-top: 14px;
}
.hp-why__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  border-left: 1px solid var(--rule);
}
.hp-why__cell {
  border-right: 1px solid var(--rule);
  padding: 40px 36px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.hp-why__num {
  font-family: var(--serif);
  font-size: 5rem;
  font-weight: 300;
  color: var(--cr);
  line-height: 1;
  letter-spacing: -0.04em;
}
.hp-why__feat-title {
  font-family: var(--serif);
  font-size: 1.375rem;
  font-weight: 500;
  color: var(--ink);
  line-height: 1.2;
  letter-spacing: -0.01em;
}
.hp-why__feat-body {
  font-family: var(--sans);
  font-size: 14px;
  color: var(--muted);
  line-height: 1.75;
  margin: 0;
}

@media (max-width: 860px) {
  .hp-why__grid { grid-template-columns: 1fr; border-left: none; }
  .hp-why__cell { border-right: none; border-bottom: 1px solid var(--rule); padding: 32px 0; }
  .hp-why__cell:first-child { border-top: 1px solid var(--rule); }
  .hp-why__num { font-size: 3.5rem; }
}
</style>

<div class="pg">
<section class="hp-why" id="why-us" aria-labelledby="why-h2">
  <div class="wrap">
    <div class="hp-why__head">
      <span class="pgeb">Why Choose Us</span>
      <h2 class="hp-why__title" id="why-h2">The Standard Every<br>Viking Repair Should Meet</h2>
    </div>

    <div class="hp-why__grid" role="list">
      <?php
      $features = [
          ['num' => '01', 'title' => 'Genuine Viking OEM Parts — Always',          'body' => 'We use only genuine Viking OEM replacement components on every repair. No aftermarket alternatives, no quality compromises. Your Viking appliance is restored to factory performance standards.'],
          ['num' => '02', 'title' => 'Viking-Certified Technicians',               'body' => 'Every technician is factory-trained on Viking appliances, fully certified, background-checked, and insured. They arrive with professional diagnostic tools and a complete OEM parts inventory.'],
          ['num' => '03', 'title' => '30-Day Parts & Labor Warranty',               'body' => 'If the same issue recurs within 30 days of your repair, we return and resolve it at no additional charge. Our written warranty documentation is provided on the day of service.'],
      ];
      foreach ($features as $f): ?>
      <div class="hp-why__cell" role="listitem">
        <div class="hp-why__num" aria-hidden="true"><?php echo esc_html($f['num']); ?></div>
        <h3 class="hp-why__feat-title"><?php echo esc_html($f['title']); ?></h3>
        <p class="hp-why__feat-body"><?php echo esc_html($f['body']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
</div>


<!-- ═══════════════════════════════════════════════════════
     PROCESS — Horizontal steps on light ground
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-process { padding: 100px 0; background: var(--off); border-bottom: 1px solid var(--rule); }
.hp-process__head { margin-bottom: 60px; }
.hp-process__title {
  font-family: var(--serif);
  font-size: clamp(1.875rem, 3.5vw, 3rem);
  font-weight: 300;
  color: var(--ink);
  letter-spacing: -0.025em;
  line-height: 1.1;
  margin-top: 12px;
}
.hp-process__steps {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 0;
  border-top: 1px solid var(--rule);
}
.hp-process__step {
  padding: 32px 24px;
  border-right: 1px solid var(--rule);
  position: relative;
}
.hp-process__step:last-child { border-right: none; padding-right: 0; }
.hp-process__step-num {
  font-family: var(--serif);
  font-size: 3rem;
  font-weight: 300;
  color: var(--cr);
  line-height: 1;
  letter-spacing: -0.04em;
  margin-bottom: 16px;
}
.hp-process__step-title {
  font-family: var(--serif);
  font-size: 1.125rem;
  font-weight: 500;
  color: var(--ink);
  line-height: 1.2;
  letter-spacing: -0.01em;
  margin-bottom: 10px;
}
.hp-process__step-body {
  font-family: var(--sans);
  font-size: 13px;
  color: var(--muted);
  line-height: 1.7;
  margin: 0;
}
.hp-process__step-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-top: 14px;
  font-family: var(--sans);
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.06em;
  color: var(--muted);
}
.hp-process__step-badge::before {
  content: '';
  display: block;
  width: 5px; height: 5px;
  background: var(--cr);
  border-radius: 50%;
  flex-shrink: 0;
}

@media (max-width: 1000px) {
  .hp-process__steps { grid-template-columns: repeat(3, 1fr); }
  .hp-process__step  { padding: 28px 20px; }
  .hp-process__step:last-child { padding-right: 20px; }
}
@media (max-width: 640px) {
  .hp-process__steps { grid-template-columns: 1fr; }
  .hp-process__step  { border-right: none; border-bottom: 1px solid var(--rule); padding: 24px 0; }
  .hp-process__step:last-child { border-bottom: none; padding-right: 0; }
}
</style>

<div class="pg">
<section class="hp-process" id="how-it-works" aria-labelledby="proc-h2">
  <div class="wrap">
    <div class="hp-process__head">
      <span class="pgeb">Our Process</span>
      <h2 class="hp-process__title" id="proc-h2">From Booking to<br>Written Warranty</h2>
    </div>

    <div class="hp-process__steps" role="list">
      <?php
      $steps = [
          ['num' => '01', 'title' => 'Book Your Appointment',  'body' => 'Call or book online. Same-day and next-day slots available Mon–Sat in most service areas.',         'badge' => 'Available Mon – Sat'],
          ['num' => '02', 'title' => 'Technician Arrives',     'body' => 'Your Viking-trained technician arrives in the confirmed window with full diagnostic tools and OEM parts.', 'badge' => 'On-time, every time'],
          ['num' => '03', 'title' => 'Honest Diagnosis',       'body' => 'We identify the root cause and provide a clear, upfront quote before any work begins. No hidden fees.',    'badge' => 'Upfront pricing only'],
          ['num' => '04', 'title' => 'Expert Repair',          'body' => 'Using genuine Viking OEM parts, we complete the repair professionally — usually 1–2 hours.',              'badge' => 'Genuine OEM parts'],
          ['num' => '05', 'title' => '30-Day Warranty',        'body' => 'Your written warranty begins on the repair date. Full documentation provided before we leave.',             'badge' => 'Written warranty'],
      ];
      foreach ($steps as $step): ?>
      <div class="hp-process__step" role="listitem">
        <div class="hp-process__step-num" aria-hidden="true"><?php echo esc_html($step['num']); ?></div>
        <h3 class="hp-process__step-title"><?php echo esc_html($step['title']); ?></h3>
        <p class="hp-process__step-body"><?php echo esc_html($step['body']); ?></p>
        <div class="hp-process__step-badge"><?php echo esc_html($step['badge']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>

    <div style="margin-top: 44px; text-align: center;">
      <a href="<?php echo esc_url($phone_link); ?>" class="pgbtn-c">
        Schedule a Repair — <?php echo esc_html($phone); ?>
      </a>
    </div>
  </div>
</section>
</div>


<!-- ═══════════════════════════════════════════════════════
     LOCATIONS — Large editorial city list
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-loc { padding: 100px 0; background: #fff; border-bottom: 1px solid var(--rule); }
.hp-loc__head { display: flex; align-items: flex-end; justify-content: space-between; gap: 40px; margin-bottom: 0; flex-wrap: wrap; }
.hp-loc__head-text { max-width: 440px; }
.hp-loc__title {
  font-family: var(--serif);
  font-size: clamp(1.875rem, 3.5vw, 3rem);
  font-weight: 300;
  color: var(--ink);
  letter-spacing: -0.025em;
  line-height: 1.1;
  margin-top: 12px;
}
.hp-loc__list { list-style: none; padding: 0; margin: 40px 0 0; }
.hp-loc__item {
  display: grid;
  grid-template-columns: 1fr auto;
  align-items: center;
  gap: 24px;
  text-decoration: none;
  color: var(--ink);
  border-top: 1px solid var(--rule);
  padding: 20px 0;
  position: relative;
  overflow: hidden;
  transition: padding-left 0.16s ease;
}
.hp-loc__item:last-child { border-bottom: 1px solid var(--rule); }

.hp-loc__item::before {
  content: '';
  position: absolute;
  top: 0; left: 0; bottom: 0;
  width: 0;
  background: var(--cr);
  transition: width 0.16s ease;
}
.hp-loc__item:hover { padding-left: 14px; }
.hp-loc__item:hover::before { width: 3px; }

.hp-loc__city-name {
  font-family: var(--serif);
  font-size: clamp(1.75rem, 3.5vw, 3rem);
  font-weight: 300;
  color: var(--ink);
  letter-spacing: -0.025em;
  line-height: 1;
  transition: color 0.12s ease;
}
.hp-loc__city-name em {
  font-style: normal;
  font-size: 0.45em;
  font-family: var(--sans);
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--muted);
  vertical-align: super;
  margin-left: 8px;
}
.hp-loc__item:hover .hp-loc__city-name { color: var(--cr); }

.hp-loc__city-note {
  font-family: var(--sans);
  font-size: 12px;
  color: var(--muted);
  line-height: 1.5;
}
.hp-loc__arrow {
  color: var(--rule);
  flex-shrink: 0;
  transition: color 0.12s ease, transform 0.16s ease;
}
.hp-loc__item:hover .hp-loc__arrow { color: var(--cr); transform: translateX(4px); }

@media (max-width: 640px) {
  .hp-loc__item   { grid-template-columns: 1fr; }
  .hp-loc__arrow  { display: none; }
  .hp-loc__head   { gap: 16px; }
}
</style>

<div class="pg">
<section class="hp-loc" id="service-areas" aria-labelledby="loc-h2">
  <div class="wrap">
    <div class="hp-loc__head">
      <div class="hp-loc__head-text">
        <span class="pgeb">Service Coverage</span>
        <h2 class="hp-loc__title" id="loc-h2">Same-Day Viking Repair<br>in Your City</h2>
      </div>
      <a href="<?php echo esc_url(get_post_type_archive_link('location_page')); ?>" class="pgbtn-i">All Locations &rarr;</a>
    </div>

    <ul class="hp-loc__list" aria-label="Viking appliance repair service locations">
      <?php foreach ($cities as $city): ?>
      <li>
        <a href="<?php echo esc_url(home_url('/locations/' . $city['slug'] . '/')); ?>" class="hp-loc__item">
          <div>
            <div class="hp-loc__city-name">
              <?php echo esc_html($city['name']); ?>
              <em><?php echo esc_html($city['state']); ?></em>
            </div>
            <div class="hp-loc__city-note"><?php echo esc_html($city['note']); ?></div>
          </div>
          <svg class="hp-loc__arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
</div>


<!-- ═══════════════════════════════════════════════════════
     FAULT CODES — Dark ink split section
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-faultcta {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 440px;
}
.hp-faultcta__img { position: relative; overflow: hidden; }
.hp-faultcta__img img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
.hp-faultcta__img::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, transparent 50%, rgba(13,13,13,0.7) 100%);
}

.hp-faultcta__content {
  background: var(--ink);
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 64px 72px;
  position: relative;
  overflow: hidden;
}
/* Subtle texture */
.hp-faultcta__content::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0; left: 0;
  width: 2px;
  background: var(--cr);
  opacity: 0.6;
}

.hp-faultcta__eyebrow {
  font-family: var(--sans);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.35);
  margin-bottom: 20px;
}
.hp-faultcta__title {
  font-family: var(--serif);
  font-size: clamp(1.875rem, 3vw, 2.75rem);
  font-weight: 300;
  color: #fff;
  letter-spacing: -0.025em;
  line-height: 1.1;
  margin-bottom: 18px;
}
.hp-faultcta__body {
  font-family: var(--sans);
  font-size: 15px;
  color: rgba(255,255,255,0.5);
  line-height: 1.75;
  margin-bottom: 36px;
  max-width: 380px;
}

@media (max-width: 860px) {
  .hp-faultcta { grid-template-columns: 1fr; min-height: auto; }
  .hp-faultcta__img { height: 280px; }
  .hp-faultcta__img::after { display: none; }
  .hp-faultcta__content { padding: 48px 32px; }
  .hp-faultcta__content::before { display: none; }
}
@media (max-width: 480px) {
  .hp-faultcta__content { padding: 40px 24px; }
}
</style>

<div class="pg">
<div class="hp-faultcta" id="fault-codes">
  <div class="hp-faultcta__img">
    <img
      src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/ICONICbackground-desktop.jpg'); ?>"
      alt="Viking ICONIC Series professional range"
      loading="lazy"
    >
  </div>
  <div class="hp-faultcta__content">
    <div class="hp-faultcta__eyebrow">Viking Fault Code Reference</div>
    <h2 class="hp-faultcta__title">Seeing a Viking<br>Error Code?</h2>
    <p class="hp-faultcta__body">
      Our complete Viking fault code reference explains every error display — what it means, what causes it, and step-by-step guidance for every Viking appliance model.
    </p>
    <a href="<?php echo esc_url(get_post_type_archive_link('error_code')); ?>" class="pgbtn-c">
      Browse Viking Fault Codes &rarr;
    </a>
  </div>
</div>
</div>


<!-- ═══════════════════════════════════════════════════════
     VIKING SERIES — Appliance series showcase
     ═══════════════════════════════════════════════════════ -->
<style>
.hp-series { padding: 80px 0; background: var(--off); border-bottom: 1px solid var(--rule); }
.hp-series__head { text-align: center; margin-bottom: 48px; }
.hp-series__title {
  font-family: var(--serif);
  font-size: clamp(1.5rem, 2.5vw, 2.25rem);
  font-weight: 300;
  color: var(--ink);
  letter-spacing: -0.02em;
  line-height: 1.1;
  margin-top: 12px;
}
.hp-series__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
}
.hp-series__chip {
  display: inline-flex;
  align-items: center;
  padding: 10px 22px;
  border: 1px solid var(--rule);
  background: #fff;
  font-family: var(--sans);
  font-size: 13px;
  font-weight: 500;
  color: #3A3A3A;
  text-decoration: none;
  border-radius: 2px;
  transition: border-color 0.12s ease, color 0.12s ease, background 0.12s ease;
}
.hp-series__chip:hover {
  border-color: var(--ink);
  color: var(--ink);
  background: var(--ink);
  color: #fff;
}
</style>

<div class="pg">
<section class="hp-series" aria-labelledby="series-h2">
  <div class="wrap">
    <div class="hp-series__head">
      <span class="pgeb">Viking Series</span>
      <h2 class="hp-series__title" id="series-h2">We Service Every Viking Series &amp; Model</h2>
    </div>
    <div class="hp-series__chips" role="list">
      <?php
      $model_types = [
          ['label' => 'Range',        'slug' => 'range'],
          ['label' => 'Refrigerator', 'slug' => 'refrigerator'],
          ['label' => 'Dishwasher',   'slug' => 'dishwasher'],
          ['label' => 'Cooktop',      'slug' => 'cooktop'],
          ['label' => 'Wall Oven',    'slug' => 'wall-oven'],
          ['label' => 'Wine Cooler',  'slug' => 'wine-cooler'],
          ['label' => 'Freezer',      'slug' => 'freezer'],
          ['label' => 'Vent Hood',    'slug' => 'vent-hood'],
          ['label' => 'Professional Series', 'slug' => 'range'],
          ['label' => 'Tuscany Series',      'slug' => 'range'],
          ['label' => 'Virtuoso Series',     'slug' => 'range'],
          ['label' => '3 Series',            'slug' => 'refrigerator'],
          ['label' => '5 Series',            'slug' => 'refrigerator'],
          ['label' => '7 Series',            'slug' => 'refrigerator'],
          ['label' => 'ICONIC Series',       'slug' => 'range'],
      ];
      foreach ($model_types as $m): ?>
      <a href="<?php echo esc_url(home_url('/services/?appliance=' . esc_attr($m['slug']))); ?>" class="hp-series__chip" role="listitem">
        <?php echo esc_html($m['label']); ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</div>


<!-- ═══════════════════════════════════════════════════════
     APPOINTMENT FORM
     ═══════════════════════════════════════════════════════ -->
<?php ar_appointment_form('homepage', 'Book Your Viking Appliance Repair Today'); ?>

<?php get_footer(); ?>
