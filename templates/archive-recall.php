<?php
/**
 * Archive: Recalls
 * URL: /recalls/
 * Design: OBSIDIAN — off-white hero, Cormorant headings, horizontal recall rows, flat table
 */
defined('ABSPATH') || exit;

$recalls = new WP_Query([
    'post_type'      => 'recall',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => false,
]);

$total     = $recalls->found_posts;
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();
$brands    = get_terms(['taxonomy' => 'brand', 'hide_empty' => true, 'orderby' => 'name']);

get_header();
?>
<style>
/* ── Archive Recalls — OBSIDIAN Design ─────────────────── */

/* ph-split hero panel */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) { .ph-split { display: block; } .ph-split__img { height: 280px; position: relative; } .ph-split__img img { position: absolute; } .ph-split__img::before { display: none; } }

/* Hero */
.rc-hero {
    background: var(--color-bg-light, #F7F6F3);
    padding-bottom: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.rc-hero__inner { max-width: 800px; }
.rc-hero__eyebrow {
    display: inline-block;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: 1.25rem;
}
.rc-hero__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.1;
    letter-spacing: -.02em;
    margin: 0 0 1.25rem;
}
.rc-hero__title em { font-style: italic; }
.rc-hero__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: 1.0625rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.7;
    margin: 0 0 2.5rem;
    max-width: 600px;
}
.rc-hero__meta {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    flex-wrap: wrap;
    padding-top: 2rem;
    border-top: 1px solid var(--color-rule, #D9D8D3);
}
.rc-hero__stat-num {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 3rem;
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1;
    display: block;
}
.rc-hero__stat-label {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    color: var(--color-text-muted, #717170);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-top: .25rem;
}
.rc-hero__cpsc {
    margin-left: auto;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--color-text-muted, #717170);
    text-decoration: none;
    padding: .6875rem 1rem;
    border: 1px solid var(--color-rule, #D9D8D3);
    transition: border-color .2s, color .2s;
}
.rc-hero__cpsc:hover { border-color: var(--color-primary-dark, #0D0D0D); color: var(--color-primary-dark, #0D0D0D); }

/* Safety notice */
.rc-notice {
    background: #fffbeb;
    border-bottom: 1px solid #fde68a;
    padding: .875rem 0;
}
.rc-notice__inner {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: #92400e;
    line-height: 1.65;
    flex-wrap: wrap;
}
.rc-notice__icon { flex-shrink: 0; font-size: 1rem; }
.rc-notice__inner a { color: #b45309; font-weight: 700; }

/* Filter bar */
.rc-filters-bar {
    background: #ffffff;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    padding: 1rem 0;
    position: sticky;
    top: 64px;
    z-index: 90;
}
.rc-filters-inner {
    display: flex;
    align-items: center;
    gap: .75rem;
    flex-wrap: wrap;
}
.rc-filter-input {
    flex: 1;
    min-width: 200px;
    padding: .6875rem 1rem;
    border: 1px solid var(--color-rule, #D9D8D3);
    border-radius: 0;
    font-size: .875rem;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    color: var(--color-primary-dark, #0D0D0D);
    background: var(--color-bg-light, #F7F6F3);
    outline: none;
    transition: border-color .2s;
}
.rc-filter-input:focus { border-color: var(--color-primary-dark, #0D0D0D); background: #fff; }
.rc-filter-count {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    white-space: nowrap;
}
.rc-filter-clear {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    color: var(--color-text-muted, #717170);
    background: none;
    border: none;
    cursor: pointer;
    text-decoration: underline;
    padding: .25rem .5rem;
    display: none;
    transition: color .15s;
}
.rc-filter-clear:hover { color: var(--color-primary, #C01C28); }

/* Recall list */
.rc-main {
    padding: 3.5rem 0 5rem;
    background: var(--color-bg-light, #F7F6F3);
}

/* Recall rows */
.rc-list { display: flex; flex-direction: column; gap: 0; border: 1px solid var(--color-rule, #D9D8D3); }

.rc-card {
    background: #ffffff;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    display: grid;
    grid-template-columns: 4rem 1fr auto;
    align-items: stretch;
    text-decoration: none;
    transition: background .15s;
    position: relative;
    overflow: hidden;
}
.rc-card:last-child { border-bottom: none; }
.rc-card:hover { background: var(--color-bg-light, #F7F6F3); }
.rc-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; bottom: 0;
    width: 2px;
    background: var(--color-primary, #C01C28);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform .2s;
}
.rc-card:hover::before { transform: scaleY(1); }

.rc-card__index {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 .5rem;
    border-right: 1px solid var(--color-rule, #D9D8D3);
    flex-shrink: 0;
}
.rc-card__warn-icon {
    color: var(--color-primary, #C01C28);
    opacity: .35;
    transition: opacity .2s;
}
.rc-card:hover .rc-card__warn-icon { opacity: 1; }
.rc-card__warn-icon svg { width: 22px; height: 22px; display: block; }

/* Fallback thumb for cards with images */
.rc-card__thumb {
    flex-shrink: 0;
    width: 140px;
    overflow: hidden;
    background: var(--color-bg-section, #EEEDE8);
    border-right: 1px solid var(--color-rule, #D9D8D3);
}
.rc-card__thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .3s;
}
.rc-card:hover .rc-card__thumb img { transform: scale(1.04); }
.rc-card__thumb-icon {
    width: 100%;
    height: 100%;
    min-height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-muted, #717170);
}

.rc-card__body {
    padding: 1.375rem 1.75rem;
    min-width: 0;
    align-self: center;
}
.rc-card__meta {
    display: flex;
    align-items: center;
    gap: .625rem;
    flex-wrap: wrap;
    margin-bottom: .5rem;
}
.rc-card__brand {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: var(--color-primary, #C01C28);
}
.rc-card__date {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    color: var(--color-text-muted, #717170);
}
.rc-card__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 1.375rem;
    font-weight: 400;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.2;
    margin: 0 0 .5rem;
    letter-spacing: -.01em;
}
.rc-card:hover .rc-card__title { color: var(--color-primary, #C01C28); }
.rc-card__excerpt {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.6;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.rc-card__arrow {
    padding: 0 1.5rem;
    align-self: center;
    flex-shrink: 0;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    font-weight: 700;
    color: var(--color-primary, #C01C28);
    letter-spacing: .04em;
    text-transform: uppercase;
    white-space: nowrap;
    transition: transform .2s;
}
.rc-card:hover .rc-card__arrow { transform: translateX(4px); }

/* Empty state */
.rc-empty {
    text-align: center;
    padding: 3.5rem 1.5rem;
    color: var(--color-text-muted, #717170);
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    background: #ffffff;
    border: 1px solid var(--color-rule, #D9D8D3);
    display: none;
}
.rc-empty.is-visible { display: block; }
.rc-empty h3 {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 1.5rem;
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin-bottom: .5rem;
}

/* Static placeholder cards (no posts yet) */
.rc-static-card {
    background: #ffffff;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    padding: 1.5rem 1.75rem 1.5rem 2rem;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 1.5rem;
    align-items: center;
    position: relative;
}
.rc-static-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 2px;
    background: var(--color-primary, #C01C28);
}

/* CTA band */
.rc-cta {
    background: var(--color-primary-dark, #0D0D0D);
    padding: 5rem 0;
    text-align: center;
}
.rc-cta__eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: rgba(255,255,255,.4);
    margin-bottom: .875rem;
}
.rc-cta__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 300;
    color: #ffffff;
    margin: 0 0 1rem;
    letter-spacing: -.01em;
}
.rc-cta__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: rgba(255,255,255,.6);
    max-width: 480px;
    margin: 0 auto 2.25rem;
    line-height: 1.7;
}
.rc-cta__btns { display:flex; gap:.875rem; justify-content:center; flex-wrap:wrap; }
.rc-btn--crimson {
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
.rc-btn--crimson:hover { opacity: .88; }
.rc-btn--ghost {
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
.rc-btn--ghost:hover { border-color: rgba(255,255,255,.6); color: #fff; }

@media (max-width: 640px) {
    .rc-hero__cpsc { margin-left: 0; }
    .rc-card { grid-template-columns: 3rem 1fr; }
    .rc-card__arrow { display: none; }
    .rc-static-card { grid-template-columns: 1fr; }
}
</style>

<!-- HERO -->
<section class="rc-hero" aria-labelledby="rc-h1">
    <div class="ph-split">
        <div class="ph-split__text" style="padding-top: calc(64px + 5rem);">
            <div class="container">
                <div class="rc-hero__inner">
                    <span class="rc-hero__eyebrow">Safety Information</span>
                    <h1 id="rc-h1" class="rc-hero__title">Viking Appliance <em>Safety Recalls</em></h1>
                    <p class="rc-hero__sub">Official Viking appliance recall notices based on U.S. CPSC records. Check if your Viking appliance is affected, what the hazard is, and exactly what steps to take to protect your household.</p>
                    <div class="rc-hero__meta" role="list" aria-label="Recall statistics">
                        <div role="listitem">
                            <span class="rc-hero__stat-num"><?php echo $total ?: '10+'; ?></span>
                            <span class="rc-hero__stat-label">Active Recalls</span>
                        </div>
                        <div role="listitem">
                            <span class="rc-hero__stat-num">CPSC</span>
                            <span class="rc-hero__stat-label">Official Source</span>
                        </div>
                        <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="rc-hero__cpsc">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            CPSC Database &#x2197;
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ph-split__img">
            <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-tuscany-range-detail.jpg'); ?>" alt="Viking appliance safety recalls" loading="lazy">
        </div>
    </div>
</section>

<!-- SAFETY NOTICE -->
<div class="rc-notice" role="alert">
    <div class="container">
        <div class="rc-notice__inner">
            <span class="rc-notice__icon" aria-hidden="true">&#x26A0;</span>
            <span>Always verify recall information with the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">U.S. Consumer Product Safety Commission (CPSC)</a> or directly with the manufacturer. Manufacturers are required to provide a free remedy (repair, replacement, or refund).</span>
        </div>
    </div>
</div>

<!-- FILTER BAR -->
<div class="rc-filters-bar" role="search" aria-label="Filter recalls">
    <div class="container">
        <div class="rc-filters-inner">
            <input type="text" class="rc-filter-input" id="rc-search" placeholder="Search Viking recalls by keyword&hellip;" aria-label="Search recalls">
            <span class="rc-filter-count" id="rc-count"><?php echo $total ?: '0'; ?> recall<?php echo $total !== 1 ? 's' : ''; ?></span>
            <button class="rc-filter-clear" id="rc-clear">&times; Clear</button>
        </div>
    </div>
</div>

<!-- RECALL LIST -->
<section class="rc-main" aria-labelledby="rc-list-h2">
    <div class="container" style="max-width:900px;">

        <h2 id="rc-list-h2" class="sr-only">All Viking Safety Recalls</h2>

        <?php if ($recalls->have_posts()): ?>
        <div class="rc-list" id="rc-list" role="list">
            <?php while ($recalls->have_posts()): $recalls->the_post();
                $pid       = get_the_ID();
                $brand     = ar_meta($pid, '_ar_brand', '');
                $hero_img  = ar_meta($pid, '_ar_hero_image', '');
                $url       = get_permalink();
                $title     = get_the_title();
                $date      = get_the_date('M j, Y');
                $excpt     = get_the_excerpt() ?: wp_trim_words(get_the_content(), 25);
                $da_search = strtolower("$brand $title");
                $da_brand  = strtolower($brand);
            ?>
            <a href="<?php echo esc_url($url); ?>"
               class="rc-card"
               data-search="<?php echo esc_attr($da_search); ?>"
               data-brand="<?php echo esc_attr($da_brand); ?>"
               role="listitem">
                <?php if ($hero_img): ?>
                <div class="rc-card__thumb">
                    <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                </div>
                <?php else: ?>
                <div class="rc-card__index" aria-hidden="true">
                    <span class="rc-card__warn-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </span>
                </div>
                <?php endif; ?>
                <div class="rc-card__body">
                    <div class="rc-card__meta">
                        <?php if ($brand): ?><span class="rc-card__brand"><?php echo esc_html($brand); ?></span><?php endif; ?>
                        <span class="rc-card__date"><?php echo esc_html($date); ?></span>
                    </div>
                    <h2 class="rc-card__title"><?php echo esc_html($title); ?></h2>
                    <?php if ($excpt): ?><p class="rc-card__excerpt"><?php echo esc_html($excpt); ?></p><?php endif; ?>
                </div>
                <span class="rc-card__arrow" aria-hidden="true">View &rarr;</span>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="rc-empty" id="rc-empty">
            <h3>No recalls found</h3>
            <p>Try a different search term or browse all recalls above.</p>
        </div>

        <?php else: ?>
        <!-- No posts yet — static info cards -->
        <p style="font-family:var(--font-body,'Manrope',system-ui,sans-serif);font-size:.875rem;color:var(--color-text-muted,#717170);margin-bottom:1.5rem;">No recalls are currently listed in our database. Verify the latest information with the <a href="https://www.cpsc.gov/Recalls" style="color:var(--color-primary,#C01C28);" target="_blank" rel="noopener noreferrer">CPSC recall database</a>.</p>
        <?php
        $static_recalls = [
            ['brand' => 'Viking', 'title' => 'Viking Gas Range Pressure Regulator Fire Hazard',        'date' => 'See CPSC', 'desc' => 'Certain Viking gas range models may have a gas pressure regulator issue allowing unregulated gas flow to the burners. Stop using the range immediately if you notice unusual flame behavior. Verify affected models at cpsc.gov.'],
            ['brand' => 'Viking', 'title' => 'Viking Built-In Refrigerator Ice Maker Electrical Hazard','date' => 'See CPSC', 'desc' => 'Certain Viking built-in refrigerator models may have an ice maker wiring deficiency that poses an electrical hazard. Stop using the ice maker function and contact Viking Range LLC. Check the CPSC recall database for affected models.'],
            ['brand' => 'Viking', 'title' => 'Viking Dishwasher Electrical Component Fire Hazard',     'date' => 'See CPSC', 'desc' => 'Certain Viking dishwasher models may have an electrical control component that can overheat during operation, posing a fire hazard. Stop using the appliance and schedule a safety inspection. Verify affected models at cpsc.gov.'],
        ];
        ?>
        <div class="rc-list" role="list">
            <?php foreach ($static_recalls as $sr): ?>
            <div class="rc-static-card" role="listitem">
                <div>
                    <div class="rc-card__meta">
                        <span class="rc-card__brand"><?php echo esc_html($sr['brand']); ?></span>
                        <span class="rc-card__date"><?php echo esc_html($sr['date']); ?></span>
                    </div>
                    <h2 class="rc-card__title"><?php echo esc_html($sr['title']); ?></h2>
                    <p class="rc-card__excerpt"><?php echo esc_html($sr['desc']); ?></p>
                </div>
                <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer"
                   style="font-family:var(--font-body,'Manrope',system-ui,sans-serif);flex-shrink:0;color:var(--color-primary,#C01C28);font-size:.75rem;font-weight:700;text-decoration:none;white-space:nowrap;letter-spacing:.06em;text-transform:uppercase;">
                    CPSC &rarr;
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA -->
<section class="rc-cta" aria-labelledby="rc-cta-h2">
    <div class="container">
        <p class="rc-cta__eyebrow">Is Your Appliance Affected?</p>
        <h2 id="rc-cta-h2" class="rc-cta__title">Get a Safety Inspection Today</h2>
        <p class="rc-cta__sub">Our certified technicians can inspect your appliance, verify whether a recall applies, and perform any required remediation work &mdash; same-day appointments available.</p>
        <div class="rc-cta__btns">
            <a href="<?php echo esc_url($phone_raw); ?>" class="rc-btn--crimson"><?php echo esc_html($phone); ?></a>
            <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="rc-btn--ghost">Schedule Inspection &rarr;</a>
        </div>
    </div>
</section>

<div id="book" style="scroll-margin-top:80px;">
    <?php ar_appointment_form('archive-page', 'Book Your Viking Repair Today'); ?>
</div>

<?php ar_disclaimer(); ?>

<script>
(function(){
    const searchEl = document.getElementById('rc-search');
    const clearBtn = document.getElementById('rc-clear');
    const countEl  = document.getElementById('rc-count');
    const emptyEl  = document.getElementById('rc-empty');
    const cards    = document.querySelectorAll('#rc-list .rc-card');

    function filter(){
        const q    = (searchEl?.value || '').toLowerCase().trim();
        const hasF = !!q;
        if (clearBtn) clearBtn.style.display = hasF ? 'inline-block' : 'none';
        let visible = 0;
        cards.forEach(c => {
            const ms   = c.dataset.search || '';
            const show = !q || ms.includes(q);
            c.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        if (countEl) countEl.textContent = visible + ' recall' + (visible !== 1 ? 's' : '');
        if (emptyEl) emptyEl.classList.toggle('is-visible', visible === 0 && cards.length > 0);
    }

    if (searchEl) searchEl.addEventListener('input', filter);
    if (clearBtn) clearBtn.addEventListener('click', () => {
        if (searchEl) searchEl.value = '';
        filter();
    });
})();
</script>

<?php get_footer(); ?>
