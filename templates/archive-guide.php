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

/* ── Guide editorial list (replaces card grid) ── */
.gd-editorial-list { display: flex; flex-direction: column; gap: 0; }
.gd-editorial-item {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 0;
    border-top: 1px solid #D9D8D3;
    text-decoration: none;
    color: #0D0D0D;
    min-height: 180px;
    transition: background 0.12s;
}
.gd-editorial-item:last-child { border-bottom: 1px solid #D9D8D3; }
.gd-editorial-item:hover { background: #F7F6F3; }
.gd-editorial-img {
    overflow: hidden;
    background: #EEEDE8;
    position: relative;
    border-right: 1px solid #D9D8D3;
}
.gd-editorial-img img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.35s ease;
}
.gd-editorial-item:hover .gd-editorial-img img { transform: scale(1.04); }
.gd-editorial-img-placeholder {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #A8A8A5;
}
.gd-editorial-body {
    padding: 1.75rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: .5rem;
}
.gd-editorial-cat {
    font-family: 'Manrope', system-ui, sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: #C01C28;
}
.gd-editorial-title {
    font-family: 'Cormorant', Georgia, serif;
    font-size: clamp(1.25rem, 2vw, 1.625rem);
    font-weight: 500;
    color: #0D0D0D;
    line-height: 1.2;
    letter-spacing: -.01em;
    margin: 0;
    transition: color 0.12s;
}
.gd-editorial-item:hover .gd-editorial-title { color: #C01C28; }
.gd-editorial-excerpt {
    font-family: 'Manrope', system-ui, sans-serif;
    font-size: 13.5px;
    color: #717170;
    line-height: 1.65;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.gd-editorial-meta {
    font-family: 'Manrope', system-ui, sans-serif;
    font-size: 12px;
    color: #A8A8A5;
    margin-top: .25rem;
}
.gd-editorial-arrow {
    color: #D9D8D3;
    margin-left: auto;
    flex-shrink: 0;
    align-self: center;
    padding-right: 1.5rem;
    transition: color 0.12s, transform 0.15s;
}
.gd-editorial-item:hover .gd-editorial-arrow { color: #C01C28; transform: translateX(4px); }

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
    .gd-topic-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 640px) {
    .gd-topic-grid { grid-template-columns: repeat(2, 1fr); }
    .gd-hero__stats { gap: 2rem; }
    .gd-grid-head { flex-direction: column; align-items: flex-start; }
    .gd-editorial-item { grid-template-columns: 1fr; min-height: auto; }
    .gd-editorial-img { height: 200px; border-right: none; border-bottom: 1px solid #D9D8D3; position: relative; }
    .gd-editorial-img img { position: absolute; }
    .gd-editorial-body { padding: 1.25rem; }
    .gd-editorial-arrow { padding-right: 1.25rem; }
}
@media (prefers-reduced-motion: reduce) {
    .gd-editorial-item, .gd-editorial-img img, .gd-editorial-arrow { transition: none; }
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

        <div class="gd-editorial-list" id="gd-guides-grid">
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
                    $cat_label = $brand_terms[0]->name . ($cat_label ? ' · ' . $cat_label : '');
                }
                if (!$cat_label) $cat_label = 'Guide';

                $ar_img_url = get_post_meta(get_the_ID(), '_ar_image', true);
            ?>
            <a href="<?php the_permalink(); ?>" class="gd-editorial-item">
                <div class="gd-editorial-img">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('medium', ['alt' => esc_attr(get_the_title()) . ' — Viking Appliance Repair Guide', 'loading' => 'lazy']); ?>
                    <?php elseif ($ar_img_url): ?>
                        <img src="<?php echo esc_url($ar_img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> — Viking Appliance Repair Guide" loading="lazy">
                    <?php else: ?>
                        <div class="gd-editorial-img-placeholder" aria-hidden="true">&#x1F527;</div>
                    <?php endif; ?>
                </div>
                <div class="gd-editorial-body">
                    <span class="gd-editorial-cat"><?php echo esc_html($cat_label); ?></span>
                    <h2 class="gd-editorial-title"><?php the_title(); ?></h2>
                    <p class="gd-editorial-excerpt">
                        <?php echo esc_html(wp_trim_words(get_the_excerpt() ?: strip_tags(get_the_content()), 20, '...')); ?>
                    </p>
                    <span class="gd-editorial-meta"><?php echo get_the_date('M j, Y'); ?> &middot; <?php echo esc_html($read_time); ?> min read</span>
                </div>
                <svg class="gd-editorial-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
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

<?php ar_appointment_form('archive-page', 'Book Your Viking Repair Today'); ?>
<?php ar_disclaimer(); ?>
<?php get_footer(); ?>
