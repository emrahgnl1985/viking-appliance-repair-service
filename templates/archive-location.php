<?php
/**
 * Archive: Location Pages
 * URL: /locations/
 * Design: OBSIDIAN — off-white hero, Cormorant headings, horizontal location rows with index numbers
 */
defined('ABSPATH') || exit;
get_header();
$locations = new WP_Query(['post_type' => 'location_page', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC']);
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();
?>

<style>
/* ── Archive Location — OBSIDIAN Design ────────────────── */

/* ph-split hero panel */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) { .ph-split { display: block; } .ph-split__img { height: 280px; position: relative; } .ph-split__img img { position: absolute; } .ph-split__img::before { display: none; } }

.loc-hero {
    background: var(--color-bg-light, #F7F6F3);
    padding-bottom: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.loc-hero__inner { max-width: 800px; }
.loc-hero__eyebrow {
    display: inline-block;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: 1.25rem;
}
.loc-hero__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.1;
    letter-spacing: -.02em;
    margin: 0 0 1.25rem;
}
.loc-hero__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: 1.0625rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.7;
    margin: 0;
}

/* Location list section */
.loc-list-section {
    background: #ffffff;
    padding: 4rem 0 5rem;
}
.loc-section-head {
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}
.loc-section-title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0;
    letter-spacing: -.01em;
}
.loc-section-count {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    font-weight: 500;
}

/* Location rows */
.loc-rows { display: flex; flex-direction: column; }
.loc-row {
    display: grid;
    grid-template-columns: 4rem 1fr auto;
    align-items: center;
    gap: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    text-decoration: none;
    transition: background .15s;
    padding: 0;
}
.loc-row:first-child { border-top: 1px solid var(--color-rule, #D9D8D3); }
.loc-row:hover { background: var(--color-bg-light, #F7F6F3); }

.loc-row__num {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 3rem;
    font-weight: 300;
    color: var(--color-rule, #D9D8D3);
    line-height: 1;
    padding: 1.5rem 1.25rem 1.5rem 0;
    align-self: center;
    text-align: right;
    transition: color .2s;
    user-select: none;
}
.loc-row:hover .loc-row__num { color: var(--color-primary, #C01C28); }

.loc-row__body {
    padding: 1.5rem 2rem 1.5rem 1.5rem;
    border-left: 1px solid var(--color-rule, #D9D8D3);
    min-width: 0;
}
.loc-row__city {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 1.625rem;
    font-weight: 400;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0 0 .25rem;
    line-height: 1.15;
    letter-spacing: -.01em;
}
.loc-row__desc {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.6;
    margin: 0;
}
.loc-row__label {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: .375rem;
    display: block;
}
.loc-row__arrow {
    padding: 0 1.75rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    font-weight: 600;
    color: var(--color-primary, #C01C28);
    white-space: nowrap;
    flex-shrink: 0;
    transition: transform .2s;
}
.loc-row:hover .loc-row__arrow { transform: translateX(4px); }

/* Coverage section */
.loc-coverage {
    background: var(--color-bg-light, #F7F6F3);
    border-top: 1px solid var(--color-rule, #D9D8D3);
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    padding: 3.5rem 0;
}
.loc-coverage__inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}
.loc-coverage__eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: .875rem;
}
.loc-coverage__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0 0 1rem;
    letter-spacing: -.01em;
}
.loc-coverage__text {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.75;
    margin: 0;
}
.loc-coverage__stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    border: 1px solid var(--color-rule, #D9D8D3);
    background: #ffffff;
}
.loc-stat {
    padding: 2rem 1.5rem;
    text-align: center;
    border-right: 1px solid var(--color-rule, #D9D8D3);
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.loc-stat:nth-child(2n) { border-right: none; }
.loc-stat:nth-last-child(-n+2) { border-bottom: none; }
.loc-stat__num {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 3.5rem;
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1;
    display: block;
    margin-bottom: .375rem;
}
.loc-stat__lbl {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    color: var(--color-text-muted, #717170);
    text-transform: uppercase;
    letter-spacing: .08em;
}

/* CTA band */
.loc-cta {
    background: var(--color-primary-dark, #0D0D0D);
    padding: 5rem 0;
    text-align: center;
}
.loc-cta__eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: rgba(255,255,255,.4);
    margin-bottom: .875rem;
}
.loc-cta__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 300;
    color: #ffffff;
    margin: 0 0 1rem;
    letter-spacing: -.01em;
}
.loc-cta__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: rgba(255,255,255,.6);
    max-width: 480px;
    margin: 0 auto 2.25rem;
    line-height: 1.7;
}
.loc-cta__btns { display:flex; gap:.875rem; justify-content:center; flex-wrap:wrap; }
.loc-btn--crimson {
    background: var(--color-primary, #C01C28);
    color: #fff;
    padding: .875rem 1.875rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    border-radius: 2px;
    transition: opacity .2s;
}
.loc-btn--crimson:hover { opacity: .88; }
.loc-btn--ghost {
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
.loc-btn--ghost:hover { border-color: rgba(255,255,255,.6); color:#fff; }

@media (max-width: 820px) {
    .loc-coverage__inner { grid-template-columns: 1fr; gap: 2.5rem; }
}
@media (max-width: 600px) {
    .loc-row { grid-template-columns: 3rem 1fr; }
    .loc-row__arrow { display: none; }
    .loc-row__num { font-size: 2rem; padding: 1.25rem .75rem 1.25rem 0; }
}
</style>

<!-- HERO -->
<section class="loc-hero" aria-labelledby="loc-arch-h1">
    <div class="ph-split">
        <div class="ph-split__text" style="padding-top: calc(64px + 5rem);">
            <div class="container">
                <div class="loc-hero__inner">
                    <span class="loc-hero__eyebrow">Service Areas</span>
                    <h1 id="loc-arch-h1" class="loc-hero__title">Viking Appliance Repair Service Areas</h1>
                    <p class="loc-hero__sub">Same-day service available in <?php echo $locations->found_posts; ?> cities and surrounding areas. Certified Viking technicians in your neighborhood.</p>
                </div>
            </div>
        </div>
        <div class="ph-split__img">
            <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-tuscany-kitchen-2.jpg'); ?>" alt="Viking appliance repair service areas" loading="lazy">
        </div>
    </div>
</section>

<!-- LOCATION LIST -->
<section class="loc-list-section" aria-labelledby="loc-list-h2">
    <div class="container">

        <header class="loc-section-head">
            <h2 id="loc-list-h2" class="loc-section-title">All Service Locations</h2>
            <span class="loc-section-count"><?php echo $locations->found_posts; ?> cities served</span>
        </header>

        <nav class="loc-rows" aria-label="Service area locations">
            <?php
            $loc_idx = 0;
            while ($locations->have_posts()): $locations->the_post();
                $loc_idx++;
                $excerpt = wp_trim_words(get_the_excerpt() ?: 'Same-day Viking appliance repair. Certified specialists. 30-day warranty.', 16);
            ?>
            <a href="<?php the_permalink(); ?>" class="loc-row">
                <span class="loc-row__num" aria-hidden="true"><?php echo str_pad($loc_idx, 2, '0', STR_PAD_LEFT); ?></span>
                <div class="loc-row__body">
                    <span class="loc-row__label">Service Area</span>
                    <h3 class="loc-row__city">Viking <?php the_title(); ?></h3>
                    <p class="loc-row__desc"><?php echo esc_html($excerpt); ?></p>
                </div>
                <span class="loc-row__arrow" aria-label="View <?php echo esc_attr(get_the_title()); ?> service area">&rarr;</span>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </nav>

    </div>
</section>

<!-- COVERAGE HIGHLIGHTS -->
<section class="loc-coverage" aria-labelledby="loc-cov-h2">
    <div class="container">
        <div class="loc-coverage__inner">
            <div>
                <p class="loc-coverage__eyebrow">Why Choose Us</p>
                <h2 id="loc-cov-h2" class="loc-coverage__title">Local Experts, Premium Service</h2>
                <p class="loc-coverage__text">Every service area is covered by factory-trained technicians who carry genuine Viking OEM parts. We arrive equipped to diagnose and repair your appliance in a single visit — with a 30-day parts and labor warranty on every job.</p>
            </div>
            <div class="loc-coverage__stats" role="list" aria-label="Service statistics">
                <div class="loc-stat" role="listitem">
                    <span class="loc-stat__num"><?php echo $locations->found_posts; ?></span>
                    <span class="loc-stat__lbl">Cities Served</span>
                </div>
                <div class="loc-stat" role="listitem">
                    <span class="loc-stat__num">30</span>
                    <span class="loc-stat__lbl">Day Warranty</span>
                </div>
                <div class="loc-stat" role="listitem">
                    <span class="loc-stat__num">OEM</span>
                    <span class="loc-stat__lbl">Viking Parts</span>
                </div>
                <div class="loc-stat" role="listitem">
                    <span class="loc-stat__num">1<sup style="font-size:1.25rem">st</sup></span>
                    <span class="loc-stat__lbl">Visit Fix Rate</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="loc-cta" aria-labelledby="loc-cta-h2">
    <div class="container">
        <p class="loc-cta__eyebrow">Ready to Book?</p>
        <h2 id="loc-cta-h2" class="loc-cta__title">Same-Day Service in Your Area</h2>
        <p class="loc-cta__sub">Our technicians are available today. Call to confirm availability or book your appointment online in under two minutes.</p>
        <div class="loc-cta__btns">
            <a href="<?php echo esc_url($phone_raw); ?>" class="loc-btn--crimson"><?php echo esc_html($phone); ?></a>
            <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="loc-btn--ghost">Schedule Online &rarr;</a>
        </div>
    </div>
</section>

<?php ar_appointment_form('location-archive', 'Book Your Viking Repair Today'); ?>

<?php ar_disclaimer(); ?>
<?php get_footer(); ?>
