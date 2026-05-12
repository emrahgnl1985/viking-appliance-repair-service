<?php
/**
 * Homepage Template (front-page.php)
 * REDESIGNED: Dark cinematic hero, appliance photo service cards,
 * visual rhythm with alternating image breaks, industrial-refined aesthetic.
 * Fonts: Outfit (display) + DM Sans (body)
 */
defined('ABSPATH') || exit;
get_header();

$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();

$appliances = [
    ['icon' => 'washer',     'label' => 'Washer Repair',       'service_slug' => 'samsung-washer-repair',       'img' => 'washer.jpg',              'desc' => 'Samsung top-load, front-load & FlexWash models. Error codes, leaks, spin failures, and drum issues fixed fast.'],
    ['icon' => 'dryer',      'label' => 'Dryer Repair',        'service_slug' => 'samsung-dryer-repair',        'img' => 'dryer.jpg',               'desc' => "Samsung gas and electric dryers. No heat, won't start, DV error codes — diagnosed and resolved same day."],
    ['icon' => 'fridge',     'label' => 'Refrigerator Repair', 'service_slug' => 'samsung-refrigerator-repair', 'img' => 'product-refrigerator.jpg', 'desc' => 'Samsung Family Hub, French Door & Side-by-Side. Ice maker, cooling, compressor problems — all covered.'],
    ['icon' => 'dishwasher', 'label' => 'Dishwasher Repair',   'service_slug' => 'samsung-dishwasher-repair',   'img' => 'product-dishwasher.jpg',   'desc' => 'Not cleaning, draining, or starting. 5C, LC, and other error codes resolved quickly.'],
    ['icon' => 'oven',       'label' => 'Oven & Range Repair', 'service_slug' => 'samsung-oven-repair',         'img' => 'gas-range.jpg',            'desc' => 'Samsung gas and electric ranges, slide-in and freestanding. Burner, ignition, temperature failures fixed.'],
    ['icon' => 'microwave',  'label' => 'Microwave Repair',    'service_slug' => 'samsung-microwave-repair',    'img' => 'microwave.jpg',            'desc' => 'Over-range and countertop microwaves. Not heating, door switch issues, and SE error codes resolved.'],
    ['icon' => 'oven',       'label' => 'Wall Oven Repair',    'service_slug' => 'samsung-wall-oven-repair',    'img' => 'wall-oven.jpg',            'desc' => 'Samsung single and double wall ovens. Temperature inaccuracies, door lock faults, control board issues.'],
];

$hiw_steps = [
    ['eyebrow' => 'First step',    'title' => 'Book Your Appointment', 'text' => 'Call or use our online form. Same-day and next-day slots available Monday through Saturday in most service areas.', 'badge' => 'Available Mon – Sat'],
    ['eyebrow' => 'On-site',       'title' => 'Technician Arrives',    'text' => 'Our Samsung-trained tech arrives in the confirmed window — fully equipped with Samsung diagnostic tools and parts to fix it on the first visit.', 'badge' => 'On-time, every time'],
    ['eyebrow' => 'Transparency',  'title' => 'Honest Diagnosis',      'text' => 'We read your Samsung error codes, identify the root cause, and give you a clear upfront quote before any work begins. No hidden fees, ever.', 'badge' => 'Upfront pricing, no surprises'],
    ['eyebrow' => 'The fix',       'title' => 'Expert Repair',         'text' => 'Using genuine Samsung parts, we complete the repair professionally and efficiently. Most Samsung repairs are finished in a single 1–2 hour visit.', 'badge' => 'Genuine Samsung parts'],
    ['eyebrow' => 'Peace of mind', 'title' => '30-Day Warranty',     'text' => 'Your warranty begins the day of repair. We leave written documentation so you have everything on record.', 'badge' => 'Written docs same day'],
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
    'description'     => 'Certified Samsung appliance repair service. Expert technicians, genuine Samsung parts, 30-day warranty on every repair.',
]);
?>

<!-- ═══════════════════════════════════════════════════════════
     DESIGN TOKENS & GLOBAL STYLES
     ═══════════════════════════════════════════════════════════ -->
<style>
/* ── Design Tokens ── */
:root {
    /* Brand */
    --red:           #C41C29;
    --red-dark:      #9E1520;
    --red-dim:       rgba(196,28,41,.15);
    --red-glow:      rgba(196,28,41,.35);

    /* Neutrals */
    --ink:           #0d1b2e;
    --ink-80:        rgba(13,27,46,.8);
    --ink-50:        rgba(13,27,46,.5);
    --paper:         #F7F5F2;
    --paper-alt:     #EFEDE9;
    --white:         #ffffff;
    --surface:       #ffffff;
    --surface-raise: #FAFAF8;

    /* Text */
    --text-1:        #141416;
    --text-2:        #3B3F4D;
    --text-3:        #6B7280;
    --text-inv:      rgba(255,255,255,.9);
    --text-inv-dim:  rgba(255,255,255,.55);

    /* Borders */
    --border:        rgba(0,0,0,.08);
    --border-strong: rgba(0,0,0,.14);

    /* Green */
    --green:         #0D9168;
    --green-bg:      #E6F5F0;

    /* Typography */
    --font-display: 'Outfit', sans-serif;
    --font-body:    'DM Sans', sans-serif;

    /* Radii */
    --r-sm:  6px;
    --r-md:  10px;
    --r-lg:  16px;
    --r-xl:  24px;
    --r-2xl: 32px;

    /* Shadows */
    --shadow-sm:   0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md:   0 4px 16px rgba(0,0,0,.08), 0 1px 4px rgba(0,0,0,.04);
    --shadow-lg:   0 12px 40px rgba(0,0,0,.12), 0 4px 12px rgba(0,0,0,.06);
    --shadow-red:  0 8px 24px rgba(196,28,41,.30);

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
.section {
    padding: 100px 0;
}
.section--sm { padding: 72px 0; }
.section--paper { background: var(--paper); }
.section--paper-alt { background: var(--paper-alt); }
.section--white { background: var(--white); }
.section--ink { background: var(--ink); }

/* ── Section header ── */
.sh {
    text-align: center;
    max-width: 620px;
    margin: 0 auto 64px;
}
.sh--left { text-align: left; margin-left: 0; }

.eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 16px;
}
.eyebrow::before,
.eyebrow::after {
    content: '';
    display: block;
    width: 20px;
    height: 1.5px;
    background: var(--red);
    flex-shrink: 0;
}
.eyebrow--left::before { display: none; }

.h2 {
    font-family: var(--font-display);
    font-size: clamp(30px, 3.8vw, 52px);
    font-weight: 800;
    color: var(--text-1);
    line-height: 1.08;
    letter-spacing: -.03em;
    margin-bottom: 18px;
}
.h2 em { font-style: normal; color: var(--red); }
.h2--inv { color: var(--white); }

.lead {
    font-size: 17px;
    color: var(--text-3);
    line-height: 1.75;
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
    letter-spacing: -.01em;
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
    background: #f8f8f8;
    box-shadow: var(--shadow-lg);
}

.btn--lg  { padding: 15px 32px; font-size: 16px; }
.btn--xl  { padding: 18px 38px; font-size: 17px; }
.btn--full { width: 100%; }

/* ── Section CTA ── */
.section-cta { text-align: center; margin-top: 56px; }

</style>

<!-- ═══════════════════════════════════════════════════════════
     HERO — Dark cinematic, subdued overlay, no blinding brightness
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

/* Background image */
.hero__bg {
    position: absolute;
    inset: 0;
    background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/front-background.avif'); ?>');
    background-size: cover;
    background-position: center 30%;
    transform: scale(1.04);
    transition: transform 8s ease;
    will-change: transform;
}
.hero--loaded .hero__bg { transform: scale(1); }

/* Light overlay — image shows through clearly, text still readable */
.hero__overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(105deg, rgba(10,11,14,.42) 0%, rgba(10,11,14,.20) 55%, rgba(10,11,14,.06) 100%),
        linear-gradient(to bottom, rgba(10,11,14,.04) 0%, transparent 50%, rgba(10,11,14,.18) 100%);
}

/* Red atmospheric accent */
.hero__accent {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 600px 400px at 68% 55%, rgba(196,28,41,.18) 0%, transparent 65%);
    pointer-events: none;
}

/* Grain texture overlay */
.hero__grain {
    position: absolute;
    inset: 0;
    opacity: .035;
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
    border: 1px solid rgba(196,28,41,.4);
    background: rgba(196,28,41,.12);
    font-size: 13.5px;
    font-weight: 700;
    color: #F07070;
    letter-spacing: .06em;
    text-transform: uppercase;
    margin-bottom: 28px;
    backdrop-filter: blur(8px);
}
.hero__badge-dot {
    width: 6px; height: 6px;
    background: var(--red);
    border-radius: 50%;
    box-shadow: 0 0 8px rgba(196,28,41,.8);
    animation: pulse-dot 2s ease infinite;
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: .6; transform: scale(.85); }
}

.hero__h1 {
    font-family: var(--font-display);
    font-size: clamp(44px, 5.5vw, 72px);
    font-weight: 900;
    color: #fff;
    line-height: 1.03;
    letter-spacing: -.035em;
    margin-bottom: 26px;
}
.hero__h1 em {
    font-style: normal;
    color: var(--red);
    display: block;
}
.hero__h1 em::after {
    content: '';
    display: block;
    width: 80px;
    height: 3px;
    background: var(--red);
    margin-top: 10px;
    border-radius: 2px;
}

.hero__sub {
    font-size: 17px;
    color: rgba(255,255,255,.72);
    line-height: 1.8;
    margin-bottom: 40px;
    max-width: 500px;
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
    color: rgba(255,255,255,.65);
}
.hero__trust-item svg {
    color: var(--red);
    flex-shrink: 0;
}
.hero__trust-item strong { color: #fff; }

/* Right card */
.hero__card {
    background: rgba(255,255,255,.97);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,.3);
    border-radius: var(--r-2xl);
    padding: 36px;
    box-shadow: 0 24px 64px rgba(0,0,0,.40), 0 4px 16px rgba(0,0,0,.16);
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
    font-weight: 800;
    color: var(--text-1);
    letter-spacing: -.02em;
    line-height: 1.2;
}
.hero__card > p {
    font-size: 16.5px;
    color: var(--text-3);
    line-height: 1.6;
    margin-bottom: 24px;
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
    font-size: 16.5px;
    color: var(--text-2);
    font-weight: 500;
}
.hero__card-check li svg { color: var(--green); flex-shrink: 0; }

.hero__card-phone {
    margin-top: 14px;
    text-align: center;
    font-size: 13.5px;
    color: var(--text-3);
}
.hero__card-phone a {
    color: var(--red);
    font-weight: 700;
    text-decoration: none;
}
.hero__card-phone a:hover { text-decoration: underline; }

/* Scroll indicator */
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
    opacity: .5;
    animation: bounce 2.2s ease infinite;
}
.hero__scroll span {
    font-size: 14px;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: #fff;
}
@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    55% { transform: translateX(-50%) translateY(6px); }
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
    .hero__h1 { font-size: 40px; }
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
                    <div class="hero__badge" aria-label="Status: Certified Samsung Repair, Same-Day Service Available">
                        <span class="hero__badge-dot" aria-hidden="true"></span>
                        Certified Samsung Repair &mdash; Same-Day Available
                    </div>

                    <h1 class="hero__h1" id="home-h1">
                        Samsung Appliance<br>
                        Repair &amp;
                        <em>Expert Diagnostics</em>
                    </h1>

                    <p class="hero__sub">
                        Genuine Samsung parts, same-day and next-day service, and a full 30-day warranty on every repair. Fast, honest, and done right the first time.
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
                            <span><strong>Genuine</strong> Samsung Parts</span>
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
                    <!-- <p>Same-day and next-day slots available. Takes less than a minute.</p> -->

                    <a href="/schedule/" class="btn btn--red btn--full btn--lg">
                        Book Samsung Repair Now &rarr;
                    </a>

                    <ul class="hero__card-check">
                        <?php foreach([
                            'Same-day &amp; next-day availability',
                            'Upfront pricing — no hidden fees',
                            'Factory-certified parts only',
                            '30-day parts &amp; labor warranty',
                        ] as $item): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            <?php echo $item; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <p class="hero__card-phone">
                        Or call us directly: <a href="<?php echo esc_url($phone_link); ?>"><?php echo esc_html($phone); ?></a>
                    </p>
                </div>

            </div><!-- .hero__layout -->
        </div><!-- .wrap -->
    </div><!-- .hero__inner -->

    <!-- Scroll cue -->
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
     TRUST BAR — Premium social proof strip
     ═══════════════════════════════════════════════════════════ -->
<style>
/* ── Wrapper ── */
.tbar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    box-shadow: 0 2px 12px rgba(0,0,0,.055);
    position: relative;
    z-index: 10;
}
 
/* ── 5-column CSS grid — never wraps on desktop ── */
.tbar__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}
 
/* ── Each cell ── */
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
.tbar__cell:hover { background: #FAFAF8; }
 
/* Animated red top accent */
.tbar__cell::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--red);
    transform: scaleX(0);
    transform-origin: left center;
    transition: transform .3s cubic-bezier(.4,0,.2,1);
    border-radius: 0 0 2px 2px;
}
.tbar__cell:hover::after { transform: scaleX(1); }
 
/* ── Icon ── */
.tbar__icon {
    width: 46px;
    height: 46px;
    border-radius: var(--r-md);
    background: #FEF2F2;
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
 
/* ── Text block ── */
.tbar__text { min-width: 0; }
 
.tbar__strong {
    display: block;
    font-family: var(--font-display);
    font-size: 15.5px;
    font-weight: 700;
    color: var(--text-1);
    line-height: 1.25;
    letter-spacing: -.01em;
}
.tbar__sub {
    display: block;
    font-size: 14px;
    color: var(--text-3);
    line-height: 1.4;
    margin-top: 3px;
}
 
/* ══════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════ */
 
/* Large tablet ≤1100px: tighten padding, same 4-col grid */
@media (max-width: 1100px) {
    .tbar__cell  { padding: 20px 16px; gap: 12px; }
    .tbar__icon  { width: 40px; height: 40px; }
    .tbar__strong { font-size: 14.5px; }
    .tbar__sub   { font-size: 12.5px; }
}
 
/* Tablet ≤860px: still 5 cols, hide subtitle to keep one row */
@media (max-width: 860px) {
    .tbar__cell  { padding: 18px 12px; gap: 10px; }
    .tbar__icon  { width: 36px; height: 36px; }
    .tbar__icon svg { width: 17px; height: 17px; }
    .tbar__strong { font-size: 13.5px; }
    .tbar__sub   { display: none; }
}
 
/* Small tablet ≤640px: 2-column grid */
@media (max-width: 640px) {
    .tbar__grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .tbar__cell {
        padding: 20px 18px;
        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        gap: 14px;
    }
    /* No right border on even items */
    .tbar__cell:nth-child(2n) { border-right: none; }
    /* No bottom border on last two items (3rd & 4th) */
    .tbar__cell:nth-child(3),
    .tbar__cell:nth-child(4) { border-bottom: none; }
    .tbar__sub    { display: block; font-size: 13px; }
    .tbar__icon   { width: 42px; height: 42px; }
    .tbar__strong { font-size: 15px; }
}
 
/* Mobile ≤400px: icon + text stacked */
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
                    'strong' => 'OEM-Certified Parts',
                    'sub'    => 'No generic substitutes, ever',
                ],
                [
                    'icon'   => '<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
                    'strong' => '30-Day Warranty',
                    'sub'    => 'Parts &amp; labor, in writing',
                ],
                [
                    'icon'   => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
                    'strong' => 'Same-Day Service',
                    'sub'    => 'Mon – Sat in most areas',
                ],
                [
                    'icon'   => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
                    'strong' => 'Certified Technicians',
                    'sub'    => 'Background-checked &amp; insured',
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
     SERVICES — Photo cards with real appliance images
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
    border-color: rgba(196,28,41,.2);
}

/* Appliance photo */
.svc-card__photo {
    position: relative;
    height: 180px;
    overflow: hidden;
    background: var(--paper-alt);
}
.svc-card__photo img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* <-- show full image */
    object-position: center;
    transition: transform .55s ease;
}
.svc-card:hover .svc-card__photo img {
    transform: scale(1.06);
}
.svc-card__photo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(10,11,14,.55) 100%);
}
.svc-card__photo-tag {
    position: absolute;
    bottom: 12px;
    left: 14px;
    background: var(--red);
    color: #fff;
    font-size: 13.5px;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 99px;
}

/* Card body */
.svc-card__body {
    padding: 22px 24px 26px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.svc-card__title {
    font-family: var(--font-display);
    font-size: 19px;
    font-weight: 800;
    color: var(--text-1);
    letter-spacing: -.02em;
    margin-bottom: 10px;
    line-height: 1.2;
}
.svc-card__desc {
    font-size: 16.5px;
    color: var(--text-3);
    line-height: 1.7;
    flex: 1;
    margin-bottom: 18px;
}
.svc-card__cta {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
    font-weight: 700;
    color: var(--red);
    letter-spacing: -.01em;
}
.svc-card__cta svg {
    transition: transform var(--ease);
}
.svc-card:hover .svc-card__cta svg {
    transform: translateX(5px);
}

@media (max-width: 960px) {
    .svc-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 580px) {
    .svc-grid { grid-template-columns: 1fr; }
    .svc-card__photo { height: 220px; }
}
</style>

<section class="section section--paper" id="our-services" aria-labelledby="services-h2">
    <div class="wrap">
        <div class="sh">
            <div class="eyebrow">What We Fix</div>
            <h2 class="h2" id="services-h2">Samsung Appliance<br>Repair Services</h2>
            <p class="lead">We specialize exclusively in Samsung appliances — every model, every series. Same-day service available in most areas.</p>
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
     IMAGE BREAK — Full-bleed technician photo
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
    opacity: .6;
}
.img-break__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(10,11,14,.92) 0%,
        rgba(10,11,14,.7) 45%,
        rgba(10,11,14,.15) 100%
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
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #F07070;
    margin-bottom: 18px;
}
.img-break__eyebrow::before {
    content: '';
    display: block;
    width: 18px;
    height: 1.5px;
    background: var(--red);
}
.img-break__h2 {
    font-family: var(--font-display);
    font-size: clamp(28px, 3.5vw, 46px);
    font-weight: 900;
    color: #fff;
    line-height: 1.08;
    letter-spacing: -.03em;
    margin-bottom: 20px;
}
.img-break__p {
    font-size: 16px;
    color: rgba(255,255,255,.65);
    line-height: 1.75;
    margin-bottom: 32px;
    max-width: 460px;
}
.img-break__stats {
    display: flex;
    gap: 32px;
    flex-wrap: wrap;
}
.img-break__stat {}
.img-break__stat-val {
    font-family: var(--font-display);
    font-size: 36px;
    font-weight: 900;
    color: #fff;
    letter-spacing: -.04em;
    line-height: 1;
}
.img-break__stat-val sup {
    font-size: 18px;
    vertical-align: super;
}
.img-break__stat-lbl {
    font-size: 15px;
    color: rgba(255,255,255,.5);
    margin-top: 4px;
    font-weight: 500;
    letter-spacing: .03em;
}

@media (max-width: 640px) {
    .img-break { height: auto; padding: 60px 0; }
    .img-break__photo { opacity: .35; }
    .img-break__overlay { background: rgba(10,11,14,.7); }
}
</style>

<div class="img-break" role="img" aria-label="Certified Samsung technician working on an appliance">
    <img
        class="img-break__photo"
        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/service-maintenance-worker-repairing.jpg'); ?>"
        alt=""
        loading="lazy"
        aria-hidden="true"
    >
    <div class="img-break__overlay" aria-hidden="true"></div>
    <div class="wrap">
        <div class="img-break__content">
            <span class="img-break__eyebrow">Our Technicians</span>
            <h2 class="img-break__h2">Samsung-Trained.<br>Background-Checked.<br>Fully Insured.</h2>
            <p class="img-break__p">Every technician carries professional Samsung diagnostic tools, factory parts, and the expertise to resolve any Samsung appliance fault — on the first visit.</p>
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
     WHY CHOOSE US — Split layout with image
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
.why-visual img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
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
    font-size: 32px;
    font-weight: 900;
    line-height: 1;
    letter-spacing: -.03em;
}
.why-visual__badge span {
    font-size: 12px;
    font-weight: 600;
    opacity: .85;
    letter-spacing: .02em;
}

.why-content {}
.why-features {
    display: flex;
    flex-direction: column;
    gap: 32px;
    margin-top: 48px;
}
.why-feature {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}
.why-feature__icon {
    width: 48px;
    height: 48px;
    border-radius: var(--r-md);
    background: #FEF2F2;
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
    font-weight: 800;
    color: var(--text-1);
    letter-spacing: -.02em;
    margin-bottom: 8px;
    line-height: 1.25;
}
.why-feature__text p {
    font-size: 16px;
    color: var(--text-3);
    line-height: 1.75;
}

@media (max-width: 900px) {
    .why-layout { grid-template-columns: 1fr; gap: 48px; }
    .why-visual { aspect-ratio: 16 / 9; max-height: 380px; }
}
</style>

<section class="section section--white" id="why-us" aria-labelledby="why-h2">
    <div class="wrap">
        <div class="why-layout">

            <!-- Photo side -->
            <div class="why-visual">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/front-recalls.avif'); ?>"
                    alt="Samsung-certified repair technician at work"
                    loading="lazy"
                >
            </div>

            <!-- Content side -->
            <div class="why-content">
                <div class="eyebrow eyebrow--left">Our Promise</div>
                <h2 class="h2" id="why-h2">Why Choose Us for Samsung Repair?</h2>
                <p class="lead">Samsung specialist technicians, genuine parts, and a no-excuses warranty — every repair done right the first time.</p>

                <div class="why-features">
                    <?php
                    $features = [
                        [
                            'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
                            'title' => 'Genuine Samsung Parts — Always',
                            'text'  => 'We stock only genuine Samsung replacement parts. No generic alternatives, no quality compromises. Your appliance is restored to factory spec every time.',
                        ],
                        [
                            'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
                            'title' => 'Samsung-Certified Technicians',
                            'text'  => 'Every technician is rigorously trained on Samsung appliances, fully certified, background-checked, and insured — carrying diagnostic tools and a full parts inventory.',
                        ],
                        [
                            'icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><polyline points="9 10 12 13 22 4"/>',
                            'title' => '30-Day Parts &amp; Labor Warranty',
                            'text'  => 'If the same problem recurs within 30 days, we return and fix it at no additional charge — in writing, on the day of repair.',
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
     SAMSUNG APPLIANCES — Visually rich chips with icons
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
    transition: background var(--ease), border-color var(--ease), color var(--ease), box-shadow var(--ease), transform var(--ease-spring);
}
.model-chip svg { color: var(--text-3); flex-shrink: 0; transition: color var(--ease); }
.model-chip:hover {
    background: var(--red);
    border-color: var(--red);
    color: #fff;
    box-shadow: 0 4px 18px rgba(196,28,41,.28);
    transform: translateY(-2px);
}
.model-chip:hover svg { color: rgba(255,255,255,.8); }
</style>

<section class="section section--paper-alt" id="samsung-appliances" aria-labelledby="models-h2">
    <div class="wrap">
        <div class="sh">
            <div class="eyebrow">All Samsung Appliances</div>
            <h2 class="h2" id="models-h2">Every Samsung Appliance We Service</h2>
            <p class="lead">From washers and dryers to refrigerators and microwaves — we fix every Samsung appliance with genuine parts.</p>
        </div>
        <div class="models-grid">
            <?php
            $model_types = [
                ['label' => 'Washer',        'slug' => 'washer',        'icon' => '<rect x="2" y="2" width="20" height="20" rx="3"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="2"/>'],
                ['label' => 'Dryer',         'slug' => 'dryer',         'icon' => '<rect x="2" y="2" width="20" height="20" rx="3"/><circle cx="12" cy="13" r="4"/><circle cx="7" cy="7" r="1.5" fill="currentColor"/>'],
                ['label' => 'Refrigerator',  'slug' => 'refrigerator',  'icon' => '<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M4 10h16"/><path d="M8 6v4"/><path d="M8 14v4"/>'],
                ['label' => 'Dishwasher',    'slug' => 'dishwasher',    'icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 3v18M3 9h6M3 15h6"/><circle cx="16" cy="12" r="2"/>'],
                ['label' => 'Oven / Range',  'slug' => 'oven',          'icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><circle cx="7.5" cy="6" r="1"/><circle cx="12" cy="6" r="1"/><circle cx="16.5" cy="6" r="1"/>'],
                ['label' => 'Microwave',     'slug' => 'microwave',     'icon' => '<rect x="2" y="5" width="20" height="14" rx="2"/><rect x="16" y="9" width="4" height="6" rx="1"/><path d="M6 9h8v6H6z"/>'],
                ['label' => 'Wall Oven',     'slug' => 'wall-oven',     'icon' => '<rect x="3" y="2" width="18" height="20" rx="2"/><rect x="7" y="7" width="10" height="8" rx="1"/><path d="M7 19h10"/>'],
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
     HOW IT WORKS — Timeline with side image
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
.hiw__sticky {
    position: sticky;
    top: 40px;
}
.hiw__photo {
    border-radius: var(--r-xl);
    overflow: hidden;
    aspect-ratio: 4 / 3;
    margin-bottom: 28px;
    box-shadow: var(--shadow-md);
}
.hiw__photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
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
    font-size: 28px;
    font-weight: 900;
    color: var(--text-1);
    letter-spacing: -.04em;
    line-height: 1;
    display: block;
    margin-bottom: 4px;
}
.hiw__stat-lbl {
    font-size: 11px;
    color: var(--text-3);
    font-weight: 500;
    letter-spacing: .02em;
}

/* Step list */
.hiw__steps {
    list-style: none;
    padding: 0;
}
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

.hiw__spine {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.hiw__node {
    width: 40px; height: 40px;
    border-radius: 50%;
    border: 2px solid var(--red);
    background: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-family: var(--font-display);
    font-size: 13px;
    font-weight: 800;
    color: var(--red);
    transition: background var(--ease), color var(--ease);
}
.hiw__step:hover .hiw__node {
    background: var(--red);
    color: #fff;
}
.hiw__line {
    flex: 1;
    width: 1.5px;
    background: linear-gradient(to bottom, rgba(196,28,41,.3), rgba(196,28,41,.04));
    margin: 6px 0;
}
.hiw__step:last-child .hiw__line { display: none; }

.hiw__content { padding-top: 6px; }
.hiw__micro {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--red);
    opacity: .7;
    margin-bottom: 5px;
}
.hiw__title {
    font-family: var(--font-display);
    font-size: 18px;
    font-weight: 800;
    color: var(--text-1);
    letter-spacing: -.02em;
    margin-bottom: 8px;
    line-height: 1.2;
}
.hiw__text {
    font-size: 15px;
    color: var(--text-3);
    line-height: 1.75;
    margin-bottom: 12px;
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
}
.hiw__badge-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--green);
}

@media (max-width: 960px) {
    .hiw__layout { grid-template-columns: 1fr; gap: 48px; }
    .hiw__sticky { position: static; }
    .hiw__photo { aspect-ratio: 16 / 9; max-height: 340px; }
}
@media (max-width: 480px) {
    .hiw { padding: 64px 0; }
    .hiw__step { grid-template-columns: 36px 1fr; gap: 0 14px; padding-bottom: 32px; }
    .hiw__stats { grid-template-columns: 1fr; }
    .hiw__stat { border-right: none; border-bottom: 1px solid var(--border); }
    .hiw__stat:last-child { border-bottom: none; }
}
@media (prefers-reduced-motion: reduce) {
    .hiw__step { opacity: 1; transform: none; transition: none; }
}
</style>

<section class="hiw" id="how-it-works" aria-labelledby="hiw-h2">
    <div class="wrap">
        <div class="hiw__layout">

            <!-- Sticky sidebar -->
            <div class="hiw__sticky">
                <div class="eyebrow eyebrow--left">Our Process</div>
                <h2 class="h2" id="hiw-h2">How It Works</h2>
                <p class="lead" style="margin-bottom: 32px;">Straightforward and transparent from first call to final warranty confirmation.</p>

                <div class="hiw__photo">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/kitchen-set-2.webp'); ?>"
                        alt="Technician repairing Samsung appliance"
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

            <!-- Steps -->
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
    var steps = document.querySelectorAll('.hiw__step');
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
     LOCATIONS — Cards with hover
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
    border-color: rgba(196,28,41,.25);
    box-shadow: var(--shadow-lg);
    transform: translateY(-4px);
}
.loc-card__icon {
    width: 44px; height: 44px;
    background: #FEF2F2;
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
    font-weight: 800;
    color: var(--text-1);
    letter-spacing: -.02em;
    margin-bottom: 6px;
    line-height: 1.2;
}
.loc-card p {
    font-size: 14px;
    color: var(--text-3);
    line-height: 1.65;
}

@media (max-width: 900px) { .loc-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .loc-grid { grid-template-columns: 1fr; } }
</style>

<section class="section section--paper" id="service-areas" aria-labelledby="locations-h2">
    <div class="wrap">
        <div class="sh">
            <div class="eyebrow">Coverage</div>
            <h2 class="h2" id="locations-h2">We Come to You</h2>
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
     IMAGE BREAK 2 — Kitchen scene before error codes CTA
     ═══════════════════════════════════════════════════════════ -->
<style>
.split-cta {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 440px;
}
.split-cta__photo {
    position: relative;
    overflow: hidden;
}
.split-cta__photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.split-cta__photo::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, transparent 60%, rgba(10,11,14,.6) 100%);
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
    background: radial-gradient(ellipse 500px 400px at 100% 50%, rgba(196,28,41,.22) 0%, transparent 70%);
}
.split-cta__content > * { position: relative; z-index: 1; }
.split-cta__eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #F07070;
    margin-bottom: 16px;
}
.split-cta__h2 {
    font-family: var(--font-display);
    font-size: clamp(26px, 3vw, 40px);
    font-weight: 900;
    color: #fff;
    letter-spacing: -.03em;
    line-height: 1.1;
    margin-bottom: 18px;
}
.split-cta__p {
    font-size: 15.5px;
    color: rgba(255,255,255,.6);
    line-height: 1.75;
    margin-bottom: 32px;
}

@media (max-width: 760px) {
    .split-cta { grid-template-columns: 1fr; min-height: auto; }
    .split-cta__photo { height: 260px; }
    .split-cta__content { padding: 48px 28px; }
}
</style>

<div class="split-cta" id="error-codes-cta">
    <div class="split-cta__photo">
        <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/kitchen_1.jpg'); ?>"
            alt="Modern kitchen with Samsung appliances"
            loading="lazy"
        >
    </div>
    <div class="split-cta__content">
        <div class="split-cta__eyebrow">Samsung Error Codes</div>
        <h2 class="split-cta__h2">Seeing a Samsung Error Code?</h2>
        <p class="split-cta__p">Our Samsung error code database explains every fault code — what it means, what causes it, and step-by-step troubleshooting for every Samsung appliance model.</p>
        <a href="<?php echo esc_url(get_post_type_archive_link('error_code')); ?>" class="btn btn--red btn--lg">
            Browse Samsung Error Codes &rarr;
        </a>
    </div>
</div>


<!-- ═══════════════════════════════════════════════════════════
     APPOINTMENT FORM
     ═══════════════════════════════════════════════════════════ -->
<?php ar_appointment_form('homepage', 'Book Your Appliance Repair Today'); ?>

<?php get_footer(); ?>