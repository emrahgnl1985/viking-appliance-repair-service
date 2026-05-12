<?php
/**
 * Homepage Template (front-page.php)
 * REDESIGNED: Viking Heritage Estate — warm cream canvas, deep navy anchors,
 * antique-gold accent, Playfair Display serif headlines, editorial rhythm.
 */
defined('ABSPATH') || exit;
get_header();

$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();

$appliances = [
    ['icon' => 'range',       'label' => 'Range Repair',         'service_slug' => 'viking-range-repair',         'img' => '48InductionHomepageSlide2025-2-1536x691.png',           'desc' => 'Viking Professional and Tuscany Series gas and dual-fuel ranges. Burner ignition failures, oven calibration, and control board faults resolved same day.'],
    ['icon' => 'fridge',      'label' => 'Refrigerator Repair',  'service_slug' => 'viking-refrigerator-repair',  'img' => 'pexels-pixabay-373548.jpg', 'desc' => 'Viking built-in and French Door refrigerators. Ice maker failures, compressor issues, cooling faults, and door seal replacements — all covered.'],
    ['icon' => 'dishwasher',  'label' => 'Dishwasher Repair',    'service_slug' => 'viking-dishwasher-repair',    'img' => '5_Series_Kitchen_HQ-new.jpg',   'desc' => 'Viking dishwashers not cleaning, draining, or starting. Control board faults, door latch issues, and spray arm failures resolved quickly.'],
    ['icon' => 'cooktop',     'label' => 'Cooktop Repair',       'service_slug' => 'viking-cooktop-repair',       'img' => '48InductionHomepageSlide2025-2-1536x691.png',            'desc' => 'Viking gas, electric, and induction cooktops. Burner ignition, spark module, and surface element failures fixed with genuine OEM parts.'],
    ['icon' => 'oven',        'label' => 'Wall Oven Repair',     'service_slug' => 'viking-wall-oven-repair',     'img' => 'smiley-old-woman-opening-door-oven.jpg',            'desc' => 'Viking single and double wall ovens. Temperature inaccuracies, bake/broil element failures, door lock faults, and control panel issues.'],
    ['icon' => 'wine',        'label' => 'Wine Cooler Repair',   'service_slug' => 'viking-wine-cooler-repair',   'img' => 'pexels-pixabay-373548.jpg', 'desc' => 'Viking wine coolers not maintaining temperature or displaying fault codes. Compressor, thermostat, and cooling fan repairs done right.'],
];

$hiw_steps = [
    ['eyebrow' => 'First step',    'title' => 'Book Your Appointment', 'text' => 'Call or use our online form. Same-day and next-day slots available Monday through Saturday in most service areas.', 'badge' => 'Available Mon – Sat'],
    ['eyebrow' => 'On-site',       'title' => 'Technician Arrives',    'text' => 'Our Viking-trained technician arrives in the confirmed window — fully equipped with diagnostic tools and genuine OEM parts to fix your appliance on the first visit.', 'badge' => 'On-time, every time'],
    ['eyebrow' => 'Transparency',  'title' => 'Honest Diagnosis',      'text' => 'We inspect your Viking appliance, identify the root cause, and provide a clear upfront quote before any work begins. No hidden fees, ever.', 'badge' => 'Upfront pricing, no surprises'],
    ['eyebrow' => 'The fix',       'title' => 'Expert Repair',         'text' => 'Using genuine Viking OEM parts, we complete the repair professionally and efficiently. Most Viking repairs are resolved in a single 1–2 hour visit.', 'badge' => 'Genuine Viking OEM parts'],
    ['eyebrow' => 'Peace of mind', 'title' => '30-Day Warranty',       'text' => 'Your warranty begins the day of repair. We provide written documentation so you have everything on record.', 'badge' => 'Written warranty same day'],
];

$cities = [
    ['name' => 'Chicago, IL',       'slug' => 'chicago',       'desc' => 'All neighborhoods + Naperville, Evanston, Oak Park'],
    ['name' => 'Los Angeles, CA',   'slug' => 'los-angeles',   'desc' => 'LA County + Santa Monica, Glendale, Pasadena, Long Beach'],
    ['name' => 'New York, NY',      'slug' => 'new-york',      'desc' => 'Manhattan, Brooklyn, Queens, The Bronx, Staten Island'],
    ['name' => 'San Francisco, CA', 'slug' => 'san-francisco', 'desc' => 'Bay Area + Palo Alto, Oakland, San Jose'],
    ['name' => 'Houston, TX',       'slug' => 'houston',       'desc' => 'Harris County + Sugar Land, The Woodlands, Katy'],
    ['name' => 'Miami, FL',         'slug' => 'miami',         'desc' => 'Miami-Dade + Coral Gables, Hialeah, Kendall'],
];

ar_output_schema([
    '@context'        => 'https://schema.org',
    '@type'           => 'LocalBusiness',
    'name'            => $biz,
    'url'             => home_url('/'),
    'telephone'       => $phone,
    'description'     => 'Certified Viking appliance repair service. Expert technicians, genuine Viking OEM parts, 30-day warranty on every repair.',
]);
?>

<!-- ═══════════════════════════════════════════════════════════
     DESIGN TOKENS — Viking Heritage Estate palette
     ═══════════════════════════════════════════════════════════ -->
<style>
/* ── Design Tokens ── */
:root {
    /* Brand — antique gold replaces red */
    --red:           #C4943A;
    --red-dark:      #9E7428;
    --red-dim:       rgba(196,148,58,.14);
    --red-glow:      rgba(196,148,58,.32);

    /* Neutrals — warm, not cool */
    --ink:           #1A2B42;
    --ink-80:        rgba(26,43,66,.8);
    --ink-50:        rgba(26,43,66,.5);
    --paper:         #FAF7F2;
    --paper-alt:     #F2ECE3;
    --white:         #ffffff;
    --surface:       #ffffff;
    --surface-raise: #FDFAF6;

    /* Text */
    --text-1:        #111827;
    --text-2:        #374151;
    --text-3:        #6B7280;
    --text-inv:      rgba(255,255,255,.92);
    --text-inv-dim:  rgba(255,255,255,.58);

    /* Borders */
    --border:        rgba(0,0,0,.07);
    --border-strong: rgba(0,0,0,.12);

    /* Success */
    --green:         #15803D;
    --green-bg:      #DCFCE7;

    /* Typography — Playfair Display (serif) + Inter (body) */
    --font-display: 'Playfair Display', Georgia, 'Times New Roman', serif;
    --font-body:    'Inter', system-ui, -apple-system, sans-serif;

    /* Radii */
    --r-sm:  6px;
    --r-md:  10px;
    --r-lg:  16px;
    --r-xl:  24px;
    --r-2xl: 32px;

    /* Shadows */
    --shadow-sm:   0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md:   0 4px 16px rgba(0,0,0,.08), 0 1px 4px rgba(0,0,0,.04);
    --shadow-lg:   0 12px 40px rgba(0,0,0,.10), 0 4px 12px rgba(0,0,0,.06);
    --shadow-red:  0 8px 24px rgba(196,148,58,.30);

    /* Transitions */
    --ease: .22s cubic-bezier(.4,0,.2,1);
    --ease-spring: .35s cubic-bezier(.34,1.56,.64,1);
}

/* ── Reset ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; }
img { display: block; max-width: 100%; }

/* ── Page base ── */
.pg {
    font-family: var(--font-body);
    font-size: 18px;
    line-height: 1.65;
    color: var(--text-2);
    background: var(--paper);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* ── Layout ── */
.wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 28px;
}

/* ── Section base ── */
.section          { padding: 100px 0; }
.section--sm      { padding: 72px 0; }
.section--paper   { background: var(--paper); }
.section--paper-alt { background: var(--paper-alt); }
.section--white   { background: var(--white); }
.section--ink     { background: var(--ink); }

/* ── Section header ── */
.sh {
    text-align: center;
    max-width: 640px;
    margin: 0 auto 64px;
}
.sh--left { text-align: left; margin-left: 0; }

.eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .18em;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 16px;
    font-family: var(--font-body);
}
.eyebrow::before,
.eyebrow::after {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--red);
    flex-shrink: 0;
}
.eyebrow--left::before { display: none; }

.h2 {
    font-family: var(--font-display);
    font-size: clamp(28px, 3.5vw, 48px);
    font-weight: 700;
    color: var(--text-1);
    line-height: 1.12;
    letter-spacing: -.01em;
    margin-bottom: 18px;
}
.h2 em  { font-style: italic; color: var(--red); }
.h2--inv { color: var(--white); }

.lead {
    font-size: 17px;
    color: var(--text-3);
    line-height: 1.78;
}
.lead--inv { color: var(--text-inv-dim); }

/* ── Buttons ── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 28px;
    border-radius: var(--r-md);
    font-family: var(--font-body);
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: 2px solid transparent;
    transition: background var(--ease), color var(--ease), border-color var(--ease),
                transform var(--ease), box-shadow var(--ease);
    white-space: nowrap;
    letter-spacing: .01em;
}
.btn:active { transform: scale(.97); }

.btn--red {
    background: var(--red);
    color: #fff;
    border-color: var(--red);
}
.btn--red:hover {
    background: var(--red-dark);
    border-color: var(--red-dark);
    box-shadow: var(--shadow-red);
}

.btn--ghost {
    background: transparent;
    color: var(--text-1);
    border-color: var(--border-strong);
}
.btn--ghost:hover {
    background: var(--surface);
    border-color: var(--text-3);
}

.btn--ghost-white {
    background: transparent;
    color: #fff;
    border-color: rgba(255,255,255,.35);
}
.btn--ghost-white:hover {
    background: rgba(255,255,255,.1);
    border-color: rgba(255,255,255,.7);
}

.btn--white {
    background: #fff;
    color: var(--red);
    border-color: #fff;
}
.btn--white:hover {
    background: #f8f6f1;
    box-shadow: var(--shadow-lg);
}

.btn--lg   { padding: 15px 32px; font-size: 16px; }
.btn--xl   { padding: 18px 38px; font-size: 17px; }
.btn--full { width: 100%; }

/* ── Section CTA ── */
.section-cta { text-align: center; margin-top: 56px; }

</style>


<!-- ═══════════════════════════════════════════════════════════
     HERO — Warm architectural hero, editorial navy + gold
     ═══════════════════════════════════════════════════════════ -->
<style>
.hero {
    position: relative;
    min-height: 720px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--ink);
}

.hero__bg {
    position: absolute;
    inset: 0;
    background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/ICONICbackground-desktop.jpg'); ?>');
    background-size: cover;
    background-position: center 30%;
    transform: scale(1.04);
    transition: transform 8s ease;
    will-change: transform;
}
.hero--loaded .hero__bg { transform: scale(1); }

/* Richer, warmer overlay — navy tones instead of near-black */
.hero__overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(108deg, rgba(26,43,66,.58) 0%, rgba(26,43,66,.28) 55%, rgba(26,43,66,.08) 100%),
        linear-gradient(to bottom, rgba(26,43,66,.06) 0%, transparent 50%, rgba(26,43,66,.22) 100%);
}

/* Gold atmospheric accent — replaces red glow */
.hero__accent {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 600px 400px at 68% 55%, rgba(196,148,58,.14) 0%, transparent 65%);
    pointer-events: none;
}

.hero__grain {
    position: absolute;
    inset: 0;
    opacity: .028;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-size: 200px;
}

.hero__inner {
    position: relative;
    z-index: 2;
    width: 100%;
    padding: 100px 0 88px;
}

.hero__layout {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 64px;
    align-items: center;
}

/* Left content */
.hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px 6px 8px;
    border-radius: 99px;
    border: 1px solid rgba(196,148,58,.40);
    background: rgba(196,148,58,.12);
    font-size: 13px;
    font-weight: 600;
    color: #D4B46A;
    letter-spacing: .08em;
    text-transform: uppercase;
    margin-bottom: 28px;
    backdrop-filter: blur(8px);
    font-family: var(--font-body);
}
.hero__badge-dot {
    width: 6px; height: 6px;
    background: var(--red);
    border-radius: 50%;
    box-shadow: 0 0 8px rgba(196,148,58,.80);
    animation: pulse-dot 2.4s ease infinite;
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: .5; transform: scale(.82); }
}

.hero__h1 {
    font-family: var(--font-display);
    font-size: clamp(42px, 5.2vw, 68px);
    font-weight: 700;
    color: #fff;
    line-height: 1.06;
    letter-spacing: -.01em;
    margin-bottom: 26px;
}
.hero__h1 em {
    font-style: italic;
    color: #D4B46A;
    display: block;
}
.hero__h1 em::after {
    content: '';
    display: block;
    width: 72px;
    height: 2px;
    background: var(--red);
    margin-top: 12px;
    border-radius: 2px;
    opacity: .7;
}

.hero__sub {
    font-size: 17px;
    color: rgba(255,255,255,.70);
    line-height: 1.80;
    margin-bottom: 40px;
    max-width: 500px;
    font-family: var(--font-body);
}

.hero__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 48px;
}

.hero__trust {
    display: flex;
    flex-wrap: wrap;
    gap: 20px 32px;
}
.hero__trust-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 500;
    color: rgba(255,255,255,.62);
    font-family: var(--font-body);
}
.hero__trust-item svg    { color: #D4B46A; flex-shrink: 0; }
.hero__trust-item strong { color: #fff; }

/* Right booking card */
.hero__card {
    background: rgba(255,255,255,.97);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,.3);
    border-radius: var(--r-2xl);
    padding: 36px;
    box-shadow: 0 24px 64px rgba(0,0,0,.38), 0 4px 16px rgba(0,0,0,.14);
}

.hero__card-head {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 6px;
}
.hero__card-icon {
    width: 44px; height: 44px;
    background: var(--red);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex-shrink: 0;
}
.hero__card h2 {
    font-family: var(--font-display);
    font-size: 21px;
    font-weight: 700;
    color: var(--text-1);
    letter-spacing: -.01em;
    line-height: 1.2;
}
.hero__card > p {
    font-size: 16px;
    color: var(--text-3);
    line-height: 1.6;
    margin-bottom: 24px;
    font-family: var(--font-body);
}

.hero__card-check {
    list-style: none;
    padding: 0;
    border-top: 1px solid var(--border);
    margin-bottom: 24px;
    padding-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.hero__card-check li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    color: var(--text-2);
    font-weight: 500;
    font-family: var(--font-body);
}
.hero__card-check li svg { color: var(--green); flex-shrink: 0; }

.hero__card-phone {
    margin-top: 14px;
    text-align: center;
    font-size: 13.5px;
    color: var(--text-3);
    font-family: var(--font-body);
}
.hero__card-phone a {
    color: var(--red);
    font-weight: 700;
    text-decoration: none;
}
.hero__card-phone a:hover { text-decoration: underline; }

/* Scroll cue */
.hero__scroll {
    position: absolute;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    opacity: .4;
    animation: bounce 2.4s ease infinite;
}
.hero__scroll span {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: #fff;
    font-family: var(--font-body);
}
@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    55%       { transform: translateX(-50%) translateY(6px); }
}

/* Responsive */
@media (max-width: 1060px) {
    .hero__layout { grid-template-columns: 1fr; gap: 44px; }
    .hero__card { max-width: 560px; }
    .hero__inner { padding: 80px 0 72px; }
}
@media (max-width: 640px) {
    .hero { min-height: auto; }
    .hero__inner { padding: 64px 0 60px; }
    .hero__h1  { font-size: 38px; }
    .hero__sub { font-size: 15.5px; }
    .hero__actions .btn--xl { padding: 14px 22px; font-size: 15px; }
    .hero__card { padding: 28px 24px; border-radius: var(--r-xl); }
}
</style>

<section class="hero" id="hero" aria-labelledby="home-h1">
    <div class="hero__bg" aria-hidden="true"></div>
    <div class="hero__overlay" aria-hidden="true"></div>
    <div class="hero__accent" aria-hidden="true"></div>
    <div class="hero__grain" aria-hidden="true"></div>

    <div class="hero__inner">
        <div class="wrap">
            <div class="hero__layout">

                <!-- Left: headline + CTA -->
                <div>
                    <div class="hero__badge" aria-label="Status: Certified Viking Repair, Same-Day Service Available">
                        <span class="hero__badge-dot" aria-hidden="true"></span>
                        Certified Viking Specialists &mdash; Same-Day Available
                    </div>

                    <h1 class="hero__h1" id="home-h1">
                        Viking Appliance<br>
                        Repair &amp;
                        <em>Expert Service</em>
                    </h1>

                    <p class="hero__sub">
                        Genuine Viking OEM parts, same-day and next-day service, and a full 30-day warranty on every repair. Trusted specialists for the appliances that define your kitchen.
                    </p>

                    <div class="hero__actions">
                        <a href="<?php echo esc_url($phone_link); ?>" class="btn btn--red btn--xl">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                            Call Now &mdash; <?php echo esc_html($phone); ?>
                        </a>
                        <a href="/schedule/" class="btn btn--ghost-white btn--xl">Book Online &rarr;</a>
                    </div>

                    <div class="hero__trust" role="list" aria-label="Our guarantees">
                        <div class="hero__trust-item" role="listitem">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            <span><strong>Genuine</strong> Viking OEM Parts</span>
                        </div>
                        <div class="hero__trust-item" role="listitem">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span><strong>30-Day</strong> Warranty</span>
                        </div>
                        <div class="hero__trust-item" role="listitem">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span><strong>Same-Day</strong> Service</span>
                        </div>
                    </div>
                </div>

                <!-- Right: booking card -->
                <div class="hero__card" role="complementary" aria-label="Quick booking">
                    <div class="hero__card-head">
                        <div class="hero__card-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <h2>Schedule a Repair</h2>
                    </div>

                    <a href="/schedule/" class="btn btn--red btn--full btn--lg">
                        Book Viking Repair Now &rarr;
                    </a>

                    <ul class="hero__card-check">
                        <?php foreach([
                            'Same-day &amp; next-day availability',
                            'Upfront pricing — no hidden fees',
                            'Genuine Viking OEM parts only',
                            '30-day parts &amp; labor warranty',
                        ] as $item): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            <?php echo $item; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <p class="hero__card-phone">
                        Or call directly: <a href="<?php echo esc_url($phone_link); ?>"><?php echo esc_html($phone); ?></a>
                    </p>
                </div>

            </div><!-- .hero__layout -->
        </div><!-- .wrap -->
    </div><!-- .hero__inner -->

    <div class="hero__scroll" aria-hidden="true">
        <span>Scroll</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
    </div>
</section>

<script>
(function(){
    var h = document.querySelector('.hero');
    if (h) setTimeout(function(){ h.classList.add('hero--loaded'); }, 100);
}());
</script>


<!-- ═══════════════════════════════════════════════════════════
     TRUST BAR — Gold-accented social proof strip
     ═══════════════════════════════════════════════════════════ -->
<style>
.tbar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    box-shadow: 0 2px 12px rgba(0,0,0,.045);
    position: relative;
    z-index: 10;
}

.tbar__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}

.tbar__cell {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 24px 22px;
    border-right: 1px solid var(--border);
    position: relative;
    transition: background var(--ease);
    overflow: hidden;
}
.tbar__cell:last-child { border-right: none; }
.tbar__cell:hover      { background: #FDFAF6; }

.tbar__cell::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--red);
    transform: scaleX(0);
    transform-origin: left center;
    transition: transform .3s cubic-bezier(.4,0,.2,1);
}
.tbar__cell:hover::after { transform: scaleX(1); }

.tbar__icon {
    width: 46px; height: 46px;
    border-radius: var(--r-md);
    background: rgba(196,148,58,.10);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: var(--red);
    transition: background var(--ease), color var(--ease), transform var(--ease-spring);
}
.tbar__cell:hover .tbar__icon {
    background: var(--red);
    color: #fff;
    transform: scale(1.08);
}

.tbar__text { min-width: 0; }

.tbar__strong {
    display: block;
    font-family: var(--font-body);
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    line-height: 1.25;
    letter-spacing: -.01em;
}
.tbar__sub {
    display: block;
    font-size: 13.5px;
    color: var(--text-3);
    line-height: 1.4;
    margin-top: 3px;
}

@media (max-width: 1100px) {
    .tbar__cell   { padding: 20px 16px; gap: 12px; }
    .tbar__icon   { width: 40px; height: 40px; }
    .tbar__strong { font-size: 14px; }
    .tbar__sub    { font-size: 12px; }
}
@media (max-width: 860px) {
    .tbar__cell   { padding: 18px 12px; gap: 10px; }
    .tbar__icon   { width: 36px; height: 36px; }
    .tbar__icon svg { width: 17px; height: 17px; }
    .tbar__strong { font-size: 13px; }
    .tbar__sub    { display: none; }
}
@media (max-width: 640px) {
    .tbar__grid { grid-template-columns: repeat(2, 1fr); }
    .tbar__cell {
        padding: 20px 18px;
        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        gap: 14px;
    }
    .tbar__cell:nth-child(2n) { border-right: none; }
    .tbar__cell:nth-child(3),
    .tbar__cell:nth-child(4)  { border-bottom: none; }
    .tbar__sub    { display: block; font-size: 13px; }
    .tbar__icon   { width: 42px; height: 42px; }
    .tbar__strong { font-size: 14.5px; }
}
@media (max-width: 400px) {
    .tbar__cell { flex-direction: column; align-items: flex-start; gap: 8px; padding: 18px 16px; }
}
</style>

<div class="tbar" role="list" aria-label="Why choose us">
    <div class="container">
        <div class="tbar__grid">
            <?php
            $trust_items = [
                [
                    'icon'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
                    'strong' => 'Genuine Viking OEM Parts',
                    'sub'    => 'No aftermarket substitutes, ever',
                ],
                [
                    'icon'   => '<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
                    'strong' => '30-Day Warranty',
                    'sub'    => 'Parts &amp; labor, in writing',
                ],
                [
                    'icon'   => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
                    'strong' => 'Same-Day Service',
                    'sub'    => 'Mon – Sat in most service areas',
                ],
                [
                    'icon'   => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
                    'strong' => 'Certified Technicians',
                    'sub'    => 'Background-checked &amp; fully insured',
                ],
            ];
            foreach ($trust_items as $item): ?>
            <div class="tbar__cell" role="listitem">
                <div class="tbar__icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <?php echo $item['icon']; ?>
                    </svg>
                </div>
                <div class="tbar__text">
                    <strong class="tbar__strong"><?php echo $item['strong']; ?></strong>
                    <span class="tbar__sub"><?php echo $item['sub']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════════════════════
     SERVICES — Viking appliance photo cards
     ═══════════════════════════════════════════════════════════ -->
<style>
.svc-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.svc-card {
    display: flex;
    flex-direction: column;
    background: var(--white);
    border-radius: var(--r-xl);
    overflow: hidden;
    border: 1px solid var(--border);
    text-decoration: none;
    transition: transform var(--ease), box-shadow var(--ease), border-color var(--ease);
    box-shadow: var(--shadow-sm);
}
.svc-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(196,148,58,.22);
}

.svc-card__photo {
    position: relative;
    height: 180px;
    overflow: hidden;
    background: var(--paper-alt);
}
.svc-card__photo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
    transition: transform .55s ease;
}
.svc-card:hover .svc-card__photo img { transform: scale(1.06); }
.svc-card__photo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(26,43,66,.50) 100%);
}
.svc-card__photo-tag {
    position: absolute;
    bottom: 12px;
    left: 14px;
    background: var(--red);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 99px;
    font-family: var(--font-body);
}

.svc-card__body {
    padding: 22px 24px 26px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.svc-card__title {
    font-family: var(--font-display);
    font-size: 19px;
    font-weight: 700;
    color: var(--text-1);
    letter-spacing: -.01em;
    margin-bottom: 10px;
    line-height: 1.25;
}
.svc-card__desc {
    font-size: 15.5px;
    color: var(--text-3);
    line-height: 1.72;
    flex: 1;
    margin-bottom: 18px;
    font-family: var(--font-body);
}
.svc-card__cta {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
    font-weight: 700;
    color: var(--red);
    letter-spacing: .01em;
    font-family: var(--font-body);
}
.svc-card__cta svg { transition: transform var(--ease); }
.svc-card:hover .svc-card__cta svg { transform: translateX(5px); }

@media (max-width: 960px) { .svc-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 580px) {
    .svc-grid { grid-template-columns: 1fr; }
    .svc-card__photo { height: 220px; }
}
</style>

<section class="section section--paper" id="our-services" aria-labelledby="services-h2">
    <div class="wrap">
        <div class="sh">
            <div class="eyebrow">What We Fix</div>
            <h2 class="h2" id="services-h2">Viking Appliance<br><em>Repair Services</em></h2>
            <p class="lead">We specialize exclusively in Viking appliances — every model, every series. Same-day service available in most areas.</p>
        </div>

        <div class="svc-grid">
            <?php foreach ($appliances as $a):
                $link    = home_url('/services/' . $a['service_slug'] . '/');
                $img_url = get_template_directory_uri() . '/assets/images/' . esc_attr($a['img']);
            ?>
            <a href="<?php echo esc_url($link); ?>" class="svc-card">
                <div class="svc-card__photo">
                    <img
                        src="<?php echo esc_url($img_url); ?>"
                        alt="<?php echo esc_attr($a['label']); ?>"
                        loading="lazy"
                        width="400"
                        height="180"
                    >
                    <div class="svc-card__photo-overlay" aria-hidden="true"></div>
                    <span class="svc-card__photo-tag">Same-Day</span>
                </div>
                <div class="svc-card__body">
                    <h3 class="svc-card__title"><?php echo esc_html($a['label']); ?></h3>
                    <p class="svc-card__desc"><?php echo esc_html($a['desc']); ?></p>
                    <span class="svc-card__cta">
                        Learn more
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="section-cta">
            <a href="<?php echo esc_url(get_post_type_archive_link('service_page')); ?>" class="btn btn--ghost btn--lg">View All Services &rarr;</a>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     IMAGE BREAK — Full-bleed technician photo with navy tone
     ═══════════════════════════════════════════════════════════ -->
<style>
.img-break {
    position: relative;
    height: 420px;
    overflow: hidden;
    background: var(--ink);
}
.img-break__photo {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 25%;
    opacity: .55;
}
.img-break__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(26,43,66,.94) 0%,
        rgba(26,43,66,.72) 45%,
        rgba(26,43,66,.18) 100%
    );
}
.img-break__content {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    max-width: 580px;
}
.img-break__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .16em;
    text-transform: uppercase;
    color: #D4B46A;
    margin-bottom: 18px;
    font-family: var(--font-body);
}
.img-break__eyebrow::before {
    content: '';
    display: block;
    width: 20px;
    height: 1px;
    background: var(--red);
}
.img-break__h2 {
    font-family: var(--font-display);
    font-size: clamp(26px, 3.2vw, 44px);
    font-weight: 700;
    color: #fff;
    line-height: 1.12;
    letter-spacing: -.01em;
    margin-bottom: 20px;
}
.img-break__p {
    font-size: 16px;
    color: rgba(255,255,255,.62);
    line-height: 1.78;
    margin-bottom: 32px;
    max-width: 460px;
    font-family: var(--font-body);
}
.img-break__stats {
    display: flex;
    gap: 32px;
    flex-wrap: wrap;
}
.img-break__stat-val {
    font-family: var(--font-display);
    font-size: 36px;
    font-weight: 700;
    color: #fff;
    letter-spacing: -.02em;
    line-height: 1;
}
.img-break__stat-val sup { font-size: 18px; vertical-align: super; }
.img-break__stat-lbl {
    font-size: 14px;
    color: rgba(255,255,255,.48);
    margin-top: 4px;
    font-weight: 500;
    letter-spacing: .03em;
    font-family: var(--font-body);
}

@media (max-width: 640px) {
    .img-break { height: auto; padding: 60px 0; }
    .img-break__photo   { opacity: .3; }
    .img-break__overlay { background: rgba(26,43,66,.75); }
}
</style>

<div class="img-break" role="img" aria-label="Viking-certified technician working on a premium kitchen appliance">
    <img
        class="img-break__photo"
        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/appliance-repair-1.jpg'); ?>"
        alt=""
        loading="lazy"
        aria-hidden="true"
    >
    <div class="img-break__overlay" aria-hidden="true"></div>
    <div class="wrap">
        <div class="img-break__content">
            <span class="img-break__eyebrow">Our Technicians</span>
            <h2 class="img-break__h2">Viking-Trained.<br>Background-Checked.<br>Fully Insured.</h2>
            <p class="img-break__p">Every technician carries factory Viking diagnostic tools, genuine OEM parts, and the expertise to resolve any Viking appliance fault — on the first visit.</p>
            <div class="img-break__stats">
                <div class="img-break__stat">
                    <div class="img-break__stat-val">98%</div>
                    <div class="img-break__stat-lbl">First-visit fix rate</div>
                </div>
                <div class="img-break__stat">
                    <div class="img-break__stat-val">1–2<sup>hr</sup></div>
                    <div class="img-break__stat-lbl">Average repair time</div>
                </div>
                <div class="img-break__stat">
                    <div class="img-break__stat-val">30<sup>day</sup></div>
                    <div class="img-break__stat-lbl">Warranty on every job</div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════════════════════
     WHY CHOOSE US — Split layout with editorial serif tone
     ═══════════════════════════════════════════════════════════ -->
<style>
.why-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}
.why-visual {
    position: relative;
    border-radius: var(--r-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    aspect-ratio: 4 / 5;
}
.why-visual img { width: 100%; height: 100%; object-fit: cover; }
.why-visual__badge {
    position: absolute;
    bottom: 24px;
    right: 24px;
    background: var(--red);
    color: #fff;
    border-radius: var(--r-lg);
    padding: 16px 20px;
    text-align: center;
    box-shadow: var(--shadow-red);
}
.why-visual__badge strong {
    display: block;
    font-family: var(--font-display);
    font-size: 30px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.01em;
}
.why-visual__badge span {
    font-size: 12px;
    font-weight: 600;
    opacity: .85;
    letter-spacing: .04em;
    font-family: var(--font-body);
}

.why-features {
    display: flex;
    flex-direction: column;
    gap: 32px;
    margin-top: 48px;
}
.why-feature { display: flex; gap: 20px; align-items: flex-start; }
.why-feature__icon {
    width: 48px; height: 48px;
    border-radius: var(--r-md);
    background: rgba(196,148,58,.10);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--red);
    flex-shrink: 0;
    margin-top: 2px;
}
.why-feature__text h4 {
    font-family: var(--font-display);
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    letter-spacing: -.01em;
    margin-bottom: 8px;
    line-height: 1.3;
}
.why-feature__text p {
    font-size: 15.5px;
    color: var(--text-3);
    line-height: 1.78;
    font-family: var(--font-body);
}

@media (max-width: 900px) {
    .why-layout  { grid-template-columns: 1fr; gap: 48px; }
    .why-visual  { aspect-ratio: 16 / 9; max-height: 380px; }
}
</style>

<section class="section section--white" id="why-us" aria-labelledby="why-h2">
    <div class="wrap">
        <div class="why-layout">

            <div class="why-visual">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/appliance-repair-r85t66cagzwxgbug8lh1hz5ff8x21qz0d4lomfrmds.jpg'); ?>"
                    alt="Viking-certified repair technician at work"
                    loading="lazy"
                >
            </div>

            <div class="why-content">
                <div class="eyebrow eyebrow--left">Our Promise</div>
                <h2 class="h2" id="why-h2">Why Choose Us for <em>Viking Repair?</em></h2>
                <p class="lead">Viking specialist technicians, genuine OEM parts, and an unconditional warranty — every repair done right the first time.</p>

                <div class="why-features">
                    <?php
                    $features = [
                        [
                            'icon'  => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
                            'title' => 'Genuine Viking OEM Parts — Always',
                            'text'  => 'We stock only genuine Viking replacement parts. No aftermarket alternatives, no quality compromises. Your Viking appliance is restored to factory performance every time.',
                        ],
                        [
                            'icon'  => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
                            'title' => 'Viking-Certified Technicians',
                            'text'  => 'Every technician is factory-trained on Viking appliances, fully certified, background-checked, and insured — arriving with professional diagnostic tools and a complete parts inventory.',
                        ],
                        [
                            'icon'  => '<rect x="3" y="3" width="18" height="18" rx="2"/><polyline points="9 10 12 13 22 4"/>',
                            'title' => '30-Day Parts &amp; Labor Warranty',
                            'text'  => 'If the same issue recurs within 30 days of your repair, we return and fix it at no additional charge. Our warranty is provided in writing on the day of service.',
                        ],
                    ];
                    foreach ($features as $f): ?>
                    <div class="why-feature">
                        <div class="why-feature__icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <?php echo $f['icon']; ?>
                            </svg>
                        </div>
                        <div class="why-feature__text">
                            <h4><?php echo $f['title']; ?></h4>
                            <p><?php echo esc_html($f['text']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     VIKING APPLIANCES — Chip grid with gold hover
     ═══════════════════════════════════════════════════════════ -->
<style>
.models-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
}
.model-chip {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 11px 22px;
    border: 1px solid var(--border-strong);
    border-radius: 99px;
    background: var(--white);
    font-size: 15px;
    font-weight: 600;
    color: var(--text-2);
    text-decoration: none;
    letter-spacing: -.01em;
    font-family: var(--font-body);
    transition: background var(--ease), border-color var(--ease), color var(--ease), box-shadow var(--ease), transform var(--ease-spring);
}
.model-chip svg { color: var(--text-3); flex-shrink: 0; transition: color var(--ease); }
.model-chip:hover {
    background: var(--red);
    border-color: var(--red);
    color: #fff;
    box-shadow: 0 4px 18px rgba(196,148,58,.28);
    transform: translateY(-2px);
}
.model-chip:hover svg { color: rgba(255,255,255,.8); }
</style>

<section class="section section--paper-alt" id="viking-appliances" aria-labelledby="models-h2">
    <div class="wrap">
        <div class="sh">
            <div class="eyebrow">All Viking Appliances</div>
            <h2 class="h2" id="models-h2">Every Viking Appliance <em>We Service</em></h2>
            <p class="lead">From professional ranges and cooktops to refrigerators and wine coolers — we repair every Viking appliance with genuine factory parts.</p>
        </div>
        <div class="models-grid">
            <?php
            $model_types = [
                ['label' => 'Range',          'slug' => 'range',          'icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><circle cx="7.5" cy="6" r="1"/><circle cx="12" cy="6" r="1"/><circle cx="16.5" cy="6" r="1"/>'],
                ['label' => 'Refrigerator',   'slug' => 'refrigerator',   'icon' => '<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M4 10h16"/><path d="M8 6v4"/><path d="M8 14v4"/>'],
                ['label' => 'Dishwasher',     'slug' => 'dishwasher',     'icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 3v18M3 9h6M3 15h6"/><circle cx="16" cy="12" r="2"/>'],
                ['label' => 'Cooktop',        'slug' => 'cooktop',        'icon' => '<rect x="2" y="5" width="20" height="14" rx="2"/><circle cx="8" cy="12" r="2.5"/><circle cx="16" cy="12" r="2.5"/>'],
                ['label' => 'Wall Oven',      'slug' => 'wall-oven',      'icon' => '<rect x="3" y="2" width="18" height="20" rx="2"/><rect x="7" y="7" width="10" height="8" rx="1"/><path d="M7 19h10"/>'],
                ['label' => 'Wine Cooler',    'slug' => 'wine-cooler',    'icon' => '<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M4 10h16"/>'],
                ['label' => 'Freezer',        'slug' => 'freezer',        'icon' => '<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M4 10h16"/><path d="M12 6v8"/>'],
                ['label' => 'Vent Hood',      'slug' => 'vent-hood',      'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
            ];
            foreach ($model_types as $m):
                $link = home_url('/services/?appliance=' . esc_attr($m['slug']));
            ?>
            <a href="<?php echo esc_url($link); ?>" class="model-chip">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <?php echo $m['icon']; ?>
                </svg>
                <?php echo esc_html($m['label']); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     HOW IT WORKS — Timeline with sticky sidebar
     ═══════════════════════════════════════════════════════════ -->
<style>
.hiw {
    background: var(--white);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 100px 0;
}
.hiw__layout {
    display: grid;
    grid-template-columns: 480px 1fr;
    gap: 80px;
    align-items: start;
}
.hiw__sticky { position: sticky; top: 40px; }
.hiw__photo {
    border-radius: var(--r-xl);
    overflow: hidden;
    aspect-ratio: 4 / 3;
    margin-bottom: 28px;
    box-shadow: var(--shadow-md);
}
.hiw__photo img { width: 100%; height: 100%; object-fit: cover; }
.hiw__stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    margin-bottom: 24px;
    background: var(--paper);
}
.hiw__stat {
    padding: 20px 16px;
    text-align: center;
    border-right: 1px solid var(--border);
}
.hiw__stat:last-child { border-right: none; }
.hiw__stat-val {
    font-family: var(--font-display);
    font-size: 26px;
    font-weight: 700;
    color: var(--text-1);
    letter-spacing: -.02em;
    line-height: 1;
    display: block;
    margin-bottom: 4px;
}
.hiw__stat-lbl {
    font-size: 11px;
    color: var(--text-3);
    font-weight: 500;
    letter-spacing: .04em;
    text-transform: uppercase;
    font-family: var(--font-body);
}

.hiw__steps { list-style: none; padding: 0; }
.hiw__step {
    display: grid;
    grid-template-columns: 44px 1fr;
    gap: 0 20px;
    padding-bottom: 40px;
    opacity: 0;
    transform: translateY(18px);
    transition: opacity .4s ease, transform .4s ease;
}
.hiw__step.is-vis { opacity: 1; transform: none; }
.hiw__step:last-child { padding-bottom: 0; }

.hiw__spine { display: flex; flex-direction: column; align-items: center; }
.hiw__node {
    width: 40px; height: 40px;
    border-radius: 50%;
    border: 2px solid var(--red);
    background: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 700;
    color: var(--red);
    transition: background var(--ease), color var(--ease);
}
.hiw__step:hover .hiw__node { background: var(--red); color: #fff; }
.hiw__line {
    flex: 1;
    width: 1px;
    background: linear-gradient(to bottom, rgba(196,148,58,.35), rgba(196,148,58,.05));
    margin: 6px 0;
}
.hiw__step:last-child .hiw__line { display: none; }

.hiw__content { padding-top: 6px; }
.hiw__micro {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--red);
    opacity: .7;
    margin-bottom: 5px;
    font-family: var(--font-body);
}
.hiw__title {
    font-family: var(--font-display);
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    letter-spacing: -.01em;
    margin-bottom: 8px;
    line-height: 1.25;
}
.hiw__text {
    font-size: 15px;
    color: var(--text-3);
    line-height: 1.78;
    margin-bottom: 12px;
    font-family: var(--font-body);
}
.hiw__badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 99px;
    border: 1px solid var(--border);
    background: var(--paper);
    font-size: 12px;
    font-weight: 600;
    color: var(--text-3);
    font-family: var(--font-body);
}
.hiw__badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green); }

@media (max-width: 960px) {
    .hiw__layout { grid-template-columns: 1fr; gap: 48px; }
    .hiw__sticky  { position: static; }
    .hiw__photo   { aspect-ratio: 16 / 9; max-height: 340px; }
}
@media (max-width: 480px) {
    .hiw { padding: 64px 0; }
    .hiw__step   { grid-template-columns: 36px 1fr; gap: 0 14px; padding-bottom: 32px; }
    .hiw__stats  { grid-template-columns: 1fr; }
    .hiw__stat   { border-right: none; border-bottom: 1px solid var(--border); }
    .hiw__stat:last-child { border-bottom: none; }
}
@media (prefers-reduced-motion: reduce) {
    .hiw__step { opacity: 1; transform: none; transition: none; }
}
</style>

<section class="hiw" id="how-it-works" aria-labelledby="hiw-h2">
    <div class="wrap">
        <div class="hiw__layout">

            <div class="hiw__sticky">
                <div class="eyebrow eyebrow--left">Our Process</div>
                <h2 class="h2" id="hiw-h2">How It Works</h2>
                <p class="lead" style="margin-bottom: 32px;">Transparent and straightforward from first call to written warranty confirmation.</p>

                <div class="hiw__photo">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg'); ?>"
                        alt="Technician repairing a Viking range"
                        loading="lazy"
                    >
                </div>

                <div class="hiw__stats" role="list" aria-label="Key repair statistics">
                    <div class="hiw__stat" role="listitem">
                        <span class="hiw__stat-val">98%</span>
                        <span class="hiw__stat-lbl">First-visit fix</span>
                    </div>
                    <div class="hiw__stat" role="listitem">
                        <span class="hiw__stat-val">1–2 hr</span>
                        <span class="hiw__stat-lbl">Avg. repair</span>
                    </div>
                    <div class="hiw__stat" role="listitem">
                        <span class="hiw__stat-val">30-day</span>
                        <span class="hiw__stat-lbl">Warranty</span>
                    </div>
                </div>

                <a href="<?php echo esc_url($phone_link); ?>" class="btn btn--red btn--full btn--lg">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    Book Now — <?php echo esc_html($phone); ?>
                </a>
            </div>

            <ol class="hiw__steps" aria-label="Repair process steps">
                <?php foreach ($hiw_steps as $i => $step):
                    $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                ?>
                <li class="hiw__step">
                    <div class="hiw__spine" aria-hidden="true">
                        <div class="hiw__node"><?php echo esc_html($num); ?></div>
                        <div class="hiw__line"></div>
                    </div>
                    <div class="hiw__content">
                        <div class="hiw__micro" aria-hidden="true"><?php echo esc_html($step['eyebrow']); ?></div>
                        <h3 class="hiw__title"><?php echo esc_html($step['title']); ?></h3>
                        <p class="hiw__text"><?php echo esc_html($step['text']); ?></p>
                        <span class="hiw__badge">
                            <span class="hiw__badge-dot" aria-hidden="true"></span>
                            <?php echo esc_html($step['badge']); ?>
                        </span>
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
    var steps   = document.querySelectorAll('.hiw__step');
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced || !('IntersectionObserver' in window)) {
        steps.forEach(function(s){ s.classList.add('is-vis'); });
        return;
    }
    var io = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if (!e.isIntersecting) return;
            var idx = Array.prototype.indexOf.call(steps, e.target);
            setTimeout(function(){ e.target.classList.add('is-vis'); }, idx * 90);
            io.unobserve(e.target);
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    steps.forEach(function(s){ io.observe(s); });
}());
</script>


<!-- ═══════════════════════════════════════════════════════════
     LOCATIONS — City service cards
     ═══════════════════════════════════════════════════════════ -->
<style>
.loc-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.loc-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    padding: 28px;
    text-decoration: none;
    display: block;
    transition: border-color var(--ease), box-shadow var(--ease), transform var(--ease);
    box-shadow: var(--shadow-sm);
}
.loc-card:hover {
    border-color: rgba(196,148,58,.28);
    box-shadow: var(--shadow-lg);
    transform: translateY(-4px);
}
.loc-card__icon {
    width: 44px; height: 44px;
    background: rgba(196,148,58,.10);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--red);
    margin-bottom: 16px;
    transition: background var(--ease);
}
.loc-card:hover .loc-card__icon { background: var(--red); color: #fff; }
.loc-card h3 {
    font-family: var(--font-display);
    font-size: 17px;
    font-weight: 700;
    color: var(--text-1);
    letter-spacing: -.01em;
    margin-bottom: 6px;
    line-height: 1.25;
}
.loc-card p {
    font-size: 14px;
    color: var(--text-3);
    line-height: 1.65;
    font-family: var(--font-body);
}

@media (max-width: 900px) { .loc-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .loc-grid { grid-template-columns: 1fr; } }
</style>

<section class="section section--paper" id="service-areas" aria-labelledby="locations-h2">
    <div class="wrap">
        <div class="sh">
            <div class="eyebrow">Coverage</div>
            <h2 class="h2" id="locations-h2">We Come <em>to You</em></h2>
            <p class="lead">Same-day service available in most ZIP codes across 6 major metro areas.</p>
        </div>
        <div class="loc-grid">
            <?php foreach ($cities as $city): ?>
            <a href="<?php echo esc_url(home_url('/locations/' . esc_attr($city['slug']) . '/')); ?>" class="loc-card">
                <div class="loc-card__icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3><?php echo esc_html($city['name']); ?></h3>
                <p><?php echo esc_html($city['desc']); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="section-cta">
            <a href="<?php echo esc_url(get_post_type_archive_link('location_page')); ?>" class="btn btn--ghost btn--lg">View All Locations &rarr;</a>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     FAULT CODES CTA — Split layout
     ═══════════════════════════════════════════════════════════ -->
<style>
.split-cta {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 440px;
}
.split-cta__photo { position: relative; overflow: hidden; }
.split-cta__photo img { width: 100%; height: 100%; object-fit: cover; display: block; }
.split-cta__photo::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, transparent 60%, rgba(26,43,66,.65) 100%);
}
.split-cta__content {
    background: var(--ink);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 64px 56px;
    position: relative;
    overflow: hidden;
}
.split-cta__content::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 500px 400px at 100% 50%, rgba(196,148,58,.18) 0%, transparent 70%);
}
.split-cta__content > * { position: relative; z-index: 1; }
.split-cta__eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .16em;
    text-transform: uppercase;
    color: #D4B46A;
    margin-bottom: 16px;
    font-family: var(--font-body);
}
.split-cta__h2 {
    font-family: var(--font-display);
    font-size: clamp(24px, 2.8vw, 38px);
    font-weight: 700;
    color: #fff;
    letter-spacing: -.01em;
    line-height: 1.15;
    margin-bottom: 18px;
}
.split-cta__p {
    font-size: 15.5px;
    color: rgba(255,255,255,.58);
    line-height: 1.78;
    margin-bottom: 32px;
    font-family: var(--font-body);
}

@media (max-width: 760px) {
    .split-cta { grid-template-columns: 1fr; min-height: auto; }
    .split-cta__photo   { height: 260px; }
    .split-cta__content { padding: 48px 28px; }
}
</style>

<div class="split-cta" id="fault-codes-cta">
    <div class="split-cta__photo">
        <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg'); ?>"
            alt="Viking kitchen appliances"
            loading="lazy"
        >
    </div>
    <div class="split-cta__content">
        <div class="split-cta__eyebrow">Viking Fault Codes</div>
        <h2 class="split-cta__h2">Seeing a Viking Fault Code?</h2>
        <p class="split-cta__p">Our Viking fault code reference explains every error display — what it means, what causes it, and step-by-step guidance for every Viking appliance.</p>
        <a href="<?php echo esc_url(get_post_type_archive_link('error_code')); ?>" class="btn btn--red btn--lg">
            Browse Viking Fault Codes &rarr;
        </a>
    </div>
</div>


<!-- ═══════════════════════════════════════════════════════════
     APPOINTMENT FORM
     ═══════════════════════════════════════════════════════════ -->
<?php ar_appointment_form('homepage', 'Book Your Viking Appliance Repair Today'); ?>

<?php get_footer(); ?>


