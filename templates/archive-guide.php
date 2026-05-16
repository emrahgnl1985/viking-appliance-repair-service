<?php
/**
 * Archive: Guides
 * URL: /guides/
 * Design: OBSIDIAN — off-white hero, Cormorant headings, editorial card grid, scroll reveal
 */
defined('ABSPATH') || exit;
get_header();

$guides = new WP_Query([
    'post_type'      => 'guide',
    'posts_per_page' => 24,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$total_guides = $guides->found_posts ?: 0;

// Category browse topics — used even when no posts exist
$categories = [
    [ 'icon' => '&#x1F504;', 'title' => 'Repair vs Replace',       'desc' => 'Is it worth fixing or time to buy new? We break down the numbers.',          'slug' => '#repair-vs-replace' ],
    [ 'icon' => '&#x1F4B0;', 'title' => 'Cost Expectations',        'desc' => 'What Viking appliance repairs actually cost — by appliance type and repair complexity.',      'slug' => '#cost-expectations' ],
    [ 'icon' => '&#x2699;',  'title' => 'Common Problems',          'desc' => 'The most frequent appliance faults explained in plain language.',              'slug' => '#common-problems'   ],
    [ 'icon' => '&#x1F6E1;', 'title' => 'Safety &amp; Risks',       'desc' => 'When an appliance fault is a safety hazard and what to do about it.',          'slug' => '#safety-risks'      ],
    [ 'icon' => '&#x1F527;', 'title' => 'Maintenance &amp; Prevention', 'desc' => 'Simple routines that extend appliance life and prevent costly repairs.', 'slug' => '#maintenance'       ],
    [ 'icon' => '&#x1F4CB;', 'title' => 'Error Codes Explained',    'desc' => 'What the numbers on your display actually mean and how serious they are.',     'slug' => home_url('/error-codes/') ],
];
?>

<style>
/* ── Archive Guides — OBSIDIAN Design ──────────────────── */

/* ph-split hero panel */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) { .ph-split { display: block; } .ph-split__img { height: 280px; position: relative; } .ph-split__img img { position: absolute; } .ph-split__img::before { display: none; } }

/* Hero */
.gd-hero {
    background: var(--color-bg-light, #F7F6F3);
    padding-bottom: 0;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.gd-hero__inner { max-width: 800px; }
.gd-hero__eyebrow {
    display: inline-block;
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
    margin-bottom: 1.25rem;
}
.gd-hero__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.1;
    letter-spacing: -.02em;
    margin: 0 0 1.25rem;
}
.gd-hero__title em { font-style: italic; }
.gd-hero__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: 1.0625rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.7;
    margin: 0 0 2.5rem;
    max-width: 580px;
}
.gd-hero__stats {
    display: flex;
    gap: 3rem;
    flex-wrap: wrap;
    padding-top: 2rem;
    border-top: 1px solid var(--color-rule, #D9D8D3);
}
.gd-stat__val {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 3rem;
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1;
    display: block;
}
.gd-stat__lbl {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    color: var(--color-text-muted, #717170);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-top: .375rem;
}

/* Topic browse */
.gd-topics {
    background: #ffffff;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    padding: 3.5rem 0;
}
.gd-topics__head {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2rem;
}
.gd-topics__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(1.5rem, 2.5vw, 2rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0;
    letter-spacing: -.01em;
}
.gd-topics__link {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    font-weight: 600;
    color: var(--color-primary, #C01C28);
    text-decoration: none;
    letter-spacing: .04em;
}
.gd-topics__link:hover { text-decoration: underline; }

.gd-topic-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 0;
    border: 1px solid var(--color-rule, #D9D8D3);
}
.gd-topic-card {
    padding: 1.5rem;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    gap: .625rem;
    border-right: 1px solid var(--color-rule, #D9D8D3);
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
    transition: background .15s;
    position: relative;
}
.gd-topic-card:hover { background: var(--color-bg-light, #F7F6F3); }
.gd-topic-card:hover::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--color-primary, #C01C28);
}
.gd-topic-icon {
    font-size: 1.25rem;
    line-height: 1;
    display: block;
}
.gd-topic-title {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    font-weight: 700;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0;
}
.gd-topic-desc {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.55;
    margin: 0;
    flex: 1;
}
.gd-topic-arrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    font-weight: 700;
    color: var(--color-primary, #C01C28);
    letter-spacing: .04em;
    margin-top: .25rem;
}

/* Guides grid */
.gd-grid-section {
    background: var(--color-bg-light, #F7F6F3);
    padding: 4rem 0 5rem;
}
.gd-grid-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--color-rule, #D9D8D3);
}
.gd-grid-title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0 0 .375rem;
    letter-spacing: -.01em;
}
.gd-grid-sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    color: var(--color-text-muted, #717170);
    margin: 0;
    line-height: 1.6;
}
.gd-ec-link {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--color-primary-dark, #0D0D0D);
    text-decoration: none;
    padding: .75rem 1.375rem;
    border: 1px solid var(--color-primary-dark, #0D0D0D);
    display: inline-block;
    transition: background .2s, color .2s;
    white-space: nowrap;
}
.gd-ec-link:hover { background: var(--color-primary-dark, #0D0D0D); color: #fff; }

/* Guide cards */
.gd-guides-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1px solid var(--color-rule, #D9D8D3);
    background: var(--color-rule, #D9D8D3);
}
.gd-guide-card {
    background: #ffffff;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    opacity: 0;
    transform: translateY(12px);
    transition: opacity .4s ease, transform .4s ease;
}
.gd-guide-card.gd-vis { opacity: 1; transform: translateY(0); }
.gd-guide-card:hover { background: var(--color-bg-light, #F7F6F3); }

.gd-guide-card__img {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--color-bg-section, #EEEDE8);
    flex-shrink: 0;
    position: relative;
}
.gd-guide-card__img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    transition: transform .4s ease;
}
.gd-guide-card:hover .gd-guide-card__img img { transform: scale(1.04); }
.gd-guide-card__img-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--color-text-muted, #717170);
}

.gd-guide-card__body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: .625rem;
    flex: 1;
    border-top: 1px solid var(--color-rule, #D9D8D3);
}
.gd-guide-card__meta {
    display: flex;
    align-items: center;
    gap: .625rem;
    flex-wrap: wrap;
}
.gd-guide-card__cat {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--color-primary, #C01C28);
}
.gd-guide-card__date {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    color: var(--color-text-muted, #717170);
}
.gd-guide-card__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 1.375rem;
    font-weight: 400;
    color: var(--color-primary-dark, #0D0D0D);
    line-height: 1.25;
    margin: 0;
    letter-spacing: -.01em;
}
.gd-guide-card:hover .gd-guide-card__title { color: var(--color-primary, #C01C28); }
.gd-guide-card__excerpt {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .8125rem;
    color: var(--color-text-muted, #717170);
    line-height: 1.65;
    margin: 0;
    flex: 1;
}
.gd-guide-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--color-rule, #D9D8D3);
    margin-top: auto;
}
.gd-guide-card__read {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    color: var(--color-text-muted, #717170);
    display: flex;
    align-items: center;
    gap: .3125rem;
}
.gd-guide-card__read-link {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .75rem;
    font-weight: 700;
    color: var(--color-primary, #C01C28);
    text-decoration: none;
    letter-spacing: .04em;
    text-transform: uppercase;
    display: inline-flex;
    align-items: center;
    gap: .25rem;
}

/* Empty state */
.gd-empty {
    text-align: center;
    padding: 5rem 1.5rem;
    border: 1px solid var(--color-rule, #D9D8D3);
    background: #ffffff;
}
.gd-empty__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: 2rem;
    font-weight: 300;
    color: var(--color-primary-dark, #0D0D0D);
    margin: 0 0 .75rem;
}
.gd-empty__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: var(--color-text-muted, #717170);
    margin: 0 0 2rem;
    line-height: 1.65;
}
.gd-empty__link {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .875rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: #fff;
    background: var(--color-primary-dark, #0D0D0D);
    text-decoration: none;
    padding: .875rem 1.875rem;
    display: inline-block;
    transition: background .2s;
}
.gd-empty__link:hover { background: var(--color-primary, #C01C28); }

/* CTA band */
.gd-cta {
    background: var(--color-primary-dark, #0D0D0D);
    padding: 5rem 0;
    text-align: center;
}
.gd-cta__inner { max-width: 600px; margin: 0 auto; }
.gd-cta__eyebrow {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: rgba(255,255,255,.4);
    margin-bottom: .875rem;
    display: block;
}
.gd-cta__title {
    font-family: var(--font-display, 'Cormorant', Georgia, serif);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 300;
    color: #ffffff;
    letter-spacing: -.02em;
    line-height: 1.15;
    margin: 0 0 1rem;
}
.gd-cta__sub {
    font-family: var(--font-body, 'Manrope', system-ui, sans-serif);
    font-size: .9375rem;
    color: rgba(255,255,255,.6);
    margin: 0 0 2.25rem;
    line-height: 1.7;
}
.gd-cta__btns { display:flex; gap:.875rem; justify-content:center; flex-wrap:wrap; }
.gd-btn--crimson {
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
.gd-btn--crimson:hover { opacity: .88; }
.gd-btn--ghost {
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
.gd-btn--ghost:hover { border-color: rgba(255,255,255,.6); color: #fff; }

@media (max-width: 960px) {
    .gd-guides-grid { grid-template-columns: repeat(2, 1fr); }
    .gd-topic-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 640px) {
    .gd-guides-grid { grid-template-columns: 1fr; }
    .gd-topic-grid { grid-template-columns: repeat(2, 1fr); }
    .gd-hero__stats { gap: 2rem; }
    .gd-grid-head { flex-direction: column; align-items: flex-start; }
}
@media (prefers-reduced-motion: reduce) {
    .gd-guide-card { opacity: 1; transform: none; transition: none; }
}
</style>

<!-- HERO -->
<section class="gd-hero" aria-labelledby="gd-h1">
    <div class="ph-split">
        <div class="ph-split__text" style="padding-top: calc(64px + 5rem);">
            <div class="container">
                <div class="gd-hero__inner">
                    <span class="gd-hero__eyebrow">Expert Resources</span>
                    <h1 id="gd-h1" class="gd-hero__title">Viking Appliance Repair <em>Guides</em></h1>
                    <p class="gd-hero__sub">Make informed decisions about your appliances. Expert advice from certified repair technicians — maintenance tips, troubleshooting walkthroughs, and repair-vs-replace guidance.</p>

                    <div class="gd-hero__stats" role="list" aria-label="Guide statistics">
                        <div role="listitem">
                            <span class="gd-stat__val"><?php echo $total_guides > 0 ? $total_guides . '+' : '20+'; ?></span>
                            <span class="gd-stat__lbl">Expert Guides</span>
                        </div>
                        <div role="listitem">
                            <span class="gd-stat__val">6</span>
                            <span class="gd-stat__lbl">Topics</span>
                        </div>
                        <div role="listitem">
                            <span class="gd-stat__val">5</span>
                            <span class="gd-stat__lbl">Min Avg Read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ph-split__img">
            <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-3series-lifestyle.jpg'); ?>" alt="Viking appliance repair guides" loading="lazy">
        </div>
    </div>
</section>

<!-- BROWSE BY TOPIC -->
<section class="gd-topics" aria-labelledby="gd-topics-h2">
    <div class="container">
        <div class="gd-topics__head">
            <h2 id="gd-topics-h2" class="gd-topics__title">Browse by Topic</h2>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="gd-topics__link">All topics &rarr;</a>
        </div>
        <div class="gd-topic-grid" role="list">
            <?php foreach ($categories as $cat): ?>
            <a href="<?php echo esc_url($cat['slug']); ?>" class="gd-topic-card" role="listitem">
                <span class="gd-topic-icon" aria-hidden="true"><?php echo $cat['icon']; ?></span>
                <h3 class="gd-topic-title"><?php echo esc_html($cat['title']); ?></h3>
                <p class="gd-topic-desc"><?php echo esc_html($cat['desc']); ?></p>
                <span class="gd-topic-arrow" aria-hidden="true">&rarr;</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- GUIDES GRID -->
<section class="gd-grid-section" aria-labelledby="gd-grid-h2">
    <div class="container">

        <header class="gd-grid-head">
            <div>
                <h2 id="gd-grid-h2" class="gd-grid-title">All Repair Guides</h2>
                <p class="gd-grid-sub">Practical, expert-written guides to help you understand your Viking appliances.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="gd-ec-link">
                Search Error Codes &rarr;
            </a>
        </header>

        <?php if ($guides->have_posts()): ?>

        <div class="gd-guides-grid" id="gd-guides-grid">
            <?php while ($guides->have_posts()): $guides->the_post();

                // Read time estimate (~200 words/min)
                $word_count = str_word_count(strip_tags(get_the_content()));
                $read_time  = max(2, (int) ceil($word_count / 200));

                // Category label
                $cat_label = '';
                $terms = get_the_terms(get_the_ID(), 'appliance_type');
                if ($terms && !is_wp_error($terms)) {
                    $cat_label = $terms[0]->name;
                }
                $brand_terms = get_the_terms(get_the_ID(), 'brand');
                if ($brand_terms && !is_wp_error($brand_terms)) {
                    $cat_label = $brand_terms[0]->name . ($cat_label ? ' &middot; ' . $cat_label : '');
                }
                if (!$cat_label) $cat_label = 'Guide';

                $ar_img_url = get_post_meta(get_the_ID(), '_ar_image', true);
            ?>
            <article class="gd-guide-card">
                <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                    <div class="gd-guide-card__img">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', ['alt' => esc_attr(get_the_title()) . ' — Viking Appliance Repair Guide', 'loading' => 'lazy']); ?>
                        <?php elseif ($ar_img_url): ?>
                            <img src="<?php echo esc_url($ar_img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> — Viking Appliance Repair Guide" loading="lazy">
                        <?php else: ?>
                            <div class="gd-guide-card__img-placeholder" aria-hidden="true">&#x1F527;</div>
                        <?php endif; ?>
                    </div>
                </a>
                <div class="gd-guide-card__body">
                    <div class="gd-guide-card__meta">
                        <span class="gd-guide-card__cat"><?php echo $cat_label; ?></span>
                        <span class="gd-guide-card__date"><?php echo get_the_date('M j, Y'); ?></span>
                    </div>
                    <h2 class="gd-guide-card__title">
                        <a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;"><?php the_title(); ?></a>
                    </h2>
                    <p class="gd-guide-card__excerpt">
                        <?php echo wp_trim_words(get_the_excerpt() ?: strip_tags(get_the_content()), 22, '&hellip;'); ?>
                    </p>
                    <div class="gd-guide-card__footer">
                        <span class="gd-guide-card__read">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <?php echo esc_html($read_time); ?> min read
                        </span>
                        <a href="<?php the_permalink(); ?>" class="gd-guide-card__read-link" aria-label="Read: <?php echo esc_attr(get_the_title()); ?>">
                            Read &rarr;
                        </a>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else: ?>

        <div class="gd-empty">
            <h2 class="gd-empty__title">Guides Coming Soon</h2>
            <p class="gd-empty__sub">Our technicians are writing in-depth repair guides. Check back soon — or explore our error code database in the meantime.</p>
            <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="gd-empty__link">Browse Error Codes &rarr;</a>
        </div>

        <?php endif; ?>

    </div>
</section>

<!-- CTA BAND -->
<section class="gd-cta" aria-labelledby="gd-cta-h2">
    <div class="gd-cta__inner">
        <span class="gd-cta__eyebrow">Need a technician?</span>
        <h2 id="gd-cta-h2" class="gd-cta__title">Still not sure what's wrong with your appliance?</h2>
        <p class="gd-cta__sub">Our Viking-certified technicians diagnose and repair all Viking appliances. Same-day service available with a 30-day warranty on every repair.</p>
        <div class="gd-cta__btns">
            <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="gd-btn--crimson">Book a Repair &rarr;</a>
            <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="gd-btn--ghost">Search Error Codes</a>
        </div>
    </div>
</section>

<!-- Scroll-reveal for guide cards -->
<script>
(function(){
    'use strict';
    var cards = document.querySelectorAll('.gd-guide-card');
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced || !('IntersectionObserver' in window)) {
        cards.forEach(function(c){ c.classList.add('gd-vis'); });
        return;
    }
    var io = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if (!e.isIntersecting) return;
            var idx = Array.prototype.indexOf.call(cards, e.target);
            setTimeout(function(){ e.target.classList.add('gd-vis'); }, (idx % 3) * 80);
            io.unobserve(e.target);
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
    cards.forEach(function(c){ io.observe(c); });
}());
</script>

<?php ar_appointment_form('archive-page', 'Book Your Viking Repair Today'); ?>
<?php ar_disclaimer(); ?>
<?php get_footer(); ?>
