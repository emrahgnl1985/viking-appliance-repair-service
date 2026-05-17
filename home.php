<?php
/**
 * home.php — Blog index (Posts page)
 * URL: /blog/
 * WordPress uses this template when Settings → Reading → "Posts page" is set.
 */
defined('ABSPATH') || exit;

$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();

// Blog category terms for sidebar and sections
$blog_cats = get_terms([
    'taxonomy'   => 'blog_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

// Total published post count
$published = (int) wp_count_posts()->publish;

get_header();
?>

<style>
/* ================================================
   BLOG HOME — OBSIDIAN Scoped Styles
================================================ */

/* ph-split hero panel */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) { .ph-split { display: block; } .ph-split__img { height: 280px; position: relative; } .ph-split__img img { position: absolute; } .ph-split__img::before { display: none; } }

/* ── Hero ── */
.bl-hero {
    background: var(--color-bg-light);
    padding-top: 0;
    padding-bottom: 0;
    border-bottom: 1px solid var(--color-rule);
}
.bl-hero__breadcrumb {
    display: flex;
    align-items: center;
    gap: .375rem;
    font-family: var(--font-body);
    font-size: .75rem;
    color: var(--color-text-muted);
    margin-bottom: 2rem;
    letter-spacing: .01em;
}
.bl-hero__breadcrumb a {
    color: var(--color-text-muted);
    text-decoration: none;
    transition: color .15s;
}
.bl-hero__breadcrumb a:hover { color: var(--color-primary-dark); }
.bl-hero__breadcrumb .sep { color: var(--color-rule); }

.bl-hero__eyebrow {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary);
    display: block;
    margin-bottom: 1rem;
}
.bl-hero__title {
    font-family: var(--font-display);
    font-size: clamp(2.75rem, 6vw, 4.5rem);
    font-weight: 300;
    letter-spacing: -0.025em;
    color: var(--color-primary-dark);
    line-height: 1.05;
    margin: 0 0 1.25rem;
    max-width: 700px;
}
.bl-hero__sub {
    font-family: var(--font-body);
    font-size: 1.0625rem;
    color: var(--color-text-muted);
    line-height: 1.7;
    margin: 0;
    max-width: 520px;
}

/* ── Featured post — horizontal split ── */
.bl-featured {
    background: #FFFFFF;
    border-top: 1px solid var(--color-rule);
    border-bottom: 1px solid var(--color-rule);
    padding: 4rem 0;
}
.bl-featured__inner {
    display: grid;
    grid-template-columns: 45fr 55fr;
    gap: 0;
    align-items: stretch;
    min-height: 360px;
}
.bl-featured__img-wrap {
    overflow: hidden;
    background: var(--color-bg-light);
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bl-featured__img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}
.bl-featured__img-placeholder {
    width: 100%;
    height: 100%;
    min-height: 360px;
    background: var(--color-bg-light);
    display: flex;
    align-items: center;
    justify-content: center;
}
.bl-featured__body {
    padding: 3rem 3rem 3rem 4rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-left: 1px solid var(--color-rule);
}
.bl-featured__eyebrow {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary);
    display: block;
    margin-bottom: 1.25rem;
}
.bl-featured__title {
    font-family: var(--font-display);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    letter-spacing: -0.02em;
    color: var(--color-primary-dark);
    line-height: 1.1;
    margin: 0 0 1rem;
    text-decoration: none;
    display: block;
    transition: color .15s;
}
.bl-featured__title:hover { color: var(--color-primary); text-decoration: none; }
.bl-featured__excerpt {
    font-family: var(--font-body);
    font-size: .9375rem;
    color: var(--color-text-muted);
    line-height: 1.7;
    margin: 0 0 1.75rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.bl-featured__meta {
    font-family: var(--font-body);
    font-size: .75rem;
    color: var(--color-text-muted);
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.bl-featured__link {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    font-family: var(--font-body);
    font-size: .8125rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--color-primary-dark);
    text-decoration: none;
    border-bottom: 1px solid var(--color-primary-dark);
    padding-bottom: .125rem;
    transition: color .15s, border-color .15s;
}
.bl-featured__link:hover {
    color: var(--color-primary);
    border-bottom-color: var(--color-primary);
    text-decoration: none;
}

/* ── Category pills ── */
.bl-cats-bar {
    background: #FFFFFF;
    border-bottom: 1px solid var(--color-rule);
    padding: 1.25rem 0;
}
.bl-cats-bar__inner {
    display: flex;
    align-items: center;
    gap: .5rem;
    flex-wrap: wrap;
}
.bl-cats-bar__label {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin-right: .5rem;
    white-space: nowrap;
}
.bl-cat-pill {
    display: inline-flex;
    align-items: center;
    gap: .375rem;
    font-family: var(--font-body);
    font-size: .75rem;
    font-weight: 500;
    color: var(--color-primary-dark);
    text-decoration: none;
    border: 1px solid var(--color-rule);
    border-radius: 2px;
    padding: .3125rem .75rem;
    transition: border-color .15s, color .15s, background .15s;
    white-space: nowrap;
}
.bl-cat-pill:hover {
    border-color: var(--color-primary-dark);
    background: var(--color-primary-dark);
    color: #FFFFFF;
    text-decoration: none;
}
.bl-cat-pill.active {
    border-color: var(--color-primary);
    background: var(--color-primary);
    color: #FFFFFF;
}
.bl-cat-pill__count {
    font-size: .6875rem;
    font-weight: 700;
    opacity: .65;
}

/* ── Main layout ── */
.bl-main {
    background: var(--color-bg-light);
    padding: 4rem 0 6rem;
}
.bl-grid {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 4rem;
    align-items: start;
}

/* ── Section heading ── */
.bl-section-head {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--color-rule);
    margin-bottom: 2rem;
    margin-top: 3rem;
}
.bl-section-head:first-child { margin-top: 0; }
.bl-section-head__title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 400;
    letter-spacing: -0.015em;
    color: var(--color-primary-dark);
    margin: 0;
}
.bl-section-head__more {
    font-family: var(--font-body);
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: .3rem;
    transition: color .15s;
}
.bl-section-head__more:hover { color: var(--color-primary); text-decoration: none; }

/* ── Editorial list (replaces card grid) ── */
.bl-editorial-list { display: flex; flex-direction: column; gap: 0; }
.bl-editorial-item {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 0;
    border-top: 1px solid #D9D8D3;
    text-decoration: none;
    color: #0D0D0D;
    min-height: 180px;
    transition: background 0.12s;
}
.bl-editorial-item:last-child { border-bottom: 1px solid #D9D8D3; }
.bl-editorial-item:hover { background: #F7F6F3; }
.bl-editorial-img {
    overflow: hidden;
    background: #EEEDE8;
    position: relative;
    border-right: 1px solid #D9D8D3;
}
.bl-editorial-img img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.35s ease;
}
.bl-editorial-item:hover .bl-editorial-img img { transform: scale(1.04); }
.bl-editorial-body {
    padding: 1.75rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: .5rem;
}
.bl-editorial-cat {
    font-family: 'Manrope', system-ui, sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: #C01C28;
}
.bl-editorial-title {
    font-family: 'Cormorant', Georgia, serif;
    font-size: clamp(1.25rem, 2vw, 1.625rem);
    font-weight: 500;
    color: #0D0D0D;
    line-height: 1.2;
    letter-spacing: -.01em;
    margin: 0;
    transition: color 0.12s;
}
.bl-editorial-item:hover .bl-editorial-title { color: #C01C28; }
.bl-editorial-excerpt {
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
.bl-editorial-meta {
    font-family: 'Manrope', system-ui, sans-serif;
    font-size: 12px;
    color: #A8A8A5;
    margin-top: .25rem;
}
.bl-editorial-arrow {
    color: #D9D8D3;
    margin-left: auto;
    flex-shrink: 0;
    align-self: center;
    padding-right: 1.5rem;
    transition: color 0.12s, transform 0.15s;
}
.bl-editorial-item:hover .bl-editorial-arrow { color: #C01C28; transform: translateX(4px); }

/* ── Empty state ── */
.bl-empty {
    background: #FFFFFF;
    border: 1px solid var(--color-rule);
    padding: 3.5rem 2rem;
    text-align: center;
    border-radius: 2px;
}
.bl-empty__title {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 300;
    color: var(--color-primary-dark);
    margin: 0 0 .5rem;
}
.bl-empty__text {
    font-family: var(--font-body);
    font-size: .9375rem;
    color: var(--color-text-muted);
    margin: 0;
}

/* ── Sidebar ── */
.bl-sidebar {
    position: sticky;
    top: calc(64px + 2rem);
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* Sidebar section */
.bl-sb-section {
    border-top: 1px solid var(--color-rule);
    padding: 1.5rem 0;
}
.bl-sb-section:first-child { border-top: none; padding-top: 0; }
.bl-sb-section__title {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin: 0 0 1rem;
}

/* CTA block */
.bl-sb-cta {
    background: #0A0A0A;
    padding: 1.75rem;
    border-radius: 2px;
    margin-bottom: 2rem;
}
.bl-sb-cta__title {
    font-family: var(--font-display);
    font-size: 1.375rem;
    font-weight: 300;
    letter-spacing: -0.02em;
    color: #FFFFFF;
    margin: 0 0 .5rem;
    line-height: 1.2;
}
.bl-sb-cta__text {
    font-family: var(--font-body);
    font-size: .8125rem;
    color: rgba(255,255,255,.5);
    line-height: 1.6;
    margin: 0 0 1.25rem;
}
.bl-sb-cta__phone {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    background: var(--color-primary);
    color: #FFFFFF;
    font-family: var(--font-body);
    font-size: .875rem;
    font-weight: 700;
    letter-spacing: .02em;
    padding: .8125rem 1rem;
    border-radius: 2px;
    text-decoration: none;
    margin-bottom: .625rem;
    transition: background .15s;
}
.bl-sb-cta__phone:hover { background: #a01525; color: #FFFFFF; text-decoration: none; }
.bl-sb-cta__schedule {
    display: block;
    text-align: center;
    background: rgba(255,255,255,.07);
    color: rgba(255,255,255,.7);
    font-family: var(--font-body);
    font-size: .8125rem;
    font-weight: 600;
    padding: .6875rem;
    border-radius: 2px;
    text-decoration: none;
    transition: background .15s;
}
.bl-sb-cta__schedule:hover { background: rgba(255,255,255,.13); color: #FFFFFF; text-decoration: none; }

/* Category list */
.bl-cat-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}
.bl-cat-list__link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .625rem 0;
    border-bottom: 1px solid var(--color-rule);
    text-decoration: none;
    transition: color .15s;
}
.bl-cat-list__link:last-child { border-bottom: none; }
.bl-cat-list__name {
    font-family: var(--font-body);
    font-size: .875rem;
    color: var(--color-primary-dark);
    font-weight: 400;
    transition: color .15s;
}
.bl-cat-list__link:hover .bl-cat-list__name { color: var(--color-primary); }
.bl-cat-list__link.current .bl-cat-list__name { color: var(--color-primary); font-weight: 600; }
.bl-cat-list__count {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 600;
    color: var(--color-text-muted);
}

/* Recent post mini list */
.bl-recent-list { display: flex; flex-direction: column; gap: 0; }
.bl-recent-item {
    display: flex;
    gap: .875rem;
    align-items: flex-start;
    text-decoration: none;
    padding: .875rem 0;
    border-bottom: 1px solid var(--color-rule);
}
.bl-recent-item:last-child { border-bottom: none; }
.bl-recent-item:hover .bl-recent-title { color: var(--color-primary); }
.bl-recent-thumb {
    width: 52px;
    height: 52px;
    background: var(--color-bg-light);
    flex-shrink: 0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 2px;
}
.bl-recent-thumb img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
.bl-recent-title {
    font-family: var(--font-body);
    font-size: .8125rem;
    font-weight: 500;
    color: var(--color-primary-dark);
    line-height: 1.45;
    margin: 0 0 .25rem;
    transition: color .15s;
}
.bl-recent-date {
    font-family: var(--font-body);
    font-size: .6875rem;
    color: var(--color-text-muted);
}

/* ── Bottom CTA ── */
.bl-bottom-cta {
    background: #0A0A0A;
    padding: 5rem 0;
}
.bl-bottom-cta__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    flex-wrap: wrap;
}
.bl-bottom-cta__eyebrow {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary);
    display: block;
    margin-bottom: .75rem;
}
.bl-bottom-cta__title {
    font-family: var(--font-display);
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    font-weight: 300;
    letter-spacing: -0.025em;
    color: #FFFFFF;
    margin: 0 0 .375rem;
    line-height: 1.1;
}
.bl-bottom-cta__sub {
    font-family: var(--font-body);
    font-size: .9375rem;
    color: rgba(255,255,255,.45);
    margin: 0;
}
.bl-bottom-cta__btns { display: flex; gap: .875rem; flex-wrap: wrap; }
.bl-bottom-cta__btn-phone {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--color-primary);
    color: #FFFFFF;
    font-family: var(--font-body);
    font-weight: 700;
    font-size: .875rem;
    letter-spacing: .02em;
    padding: .9375rem 1.875rem;
    border-radius: 2px;
    text-decoration: none;
    transition: background .15s;
}
.bl-bottom-cta__btn-phone:hover { background: #a01525; color: #FFFFFF; text-decoration: none; }
.bl-bottom-cta__btn-schedule {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: transparent;
    color: rgba(255,255,255,.75);
    font-family: var(--font-body);
    font-weight: 600;
    font-size: .875rem;
    padding: .9375rem 1.875rem;
    border-radius: 2px;
    border: 1px solid rgba(255,255,255,.2);
    text-decoration: none;
    transition: border-color .15s, color .15s;
}
.bl-bottom-cta__btn-schedule:hover {
    border-color: rgba(255,255,255,.5);
    color: #FFFFFF;
    text-decoration: none;
}

/* ── Responsive ── */
@media (max-width: 1024px) {
    .bl-grid { grid-template-columns: 1fr 260px; gap: 3rem; }
}
@media (max-width: 900px) {
    .bl-grid { grid-template-columns: 1fr; }
    .bl-sidebar { position: static; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .bl-sb-cta { margin-bottom: 0; }
}
@media (max-width: 768px) {
    .bl-featured__inner { grid-template-columns: 1fr; min-height: auto; }
    .bl-featured__img-wrap { aspect-ratio: 16/9; }
    .bl-featured__body { padding: 2rem; border-left: none; border-top: 1px solid var(--color-rule); }
}
@media (max-width: 640px) {
    .bl-hero { padding-top: calc(64px + 3rem); padding-bottom: 3rem; }
    .bl-sidebar { grid-template-columns: 1fr; }
    .bl-bottom-cta__inner { flex-direction: column; align-items: flex-start; }
    .bl-bottom-cta__btns { width: 100%; }
    .bl-bottom-cta__btn-phone,
    .bl-bottom-cta__btn-schedule { flex: 1; justify-content: center; }
    .bl-editorial-item { grid-template-columns: 1fr; min-height: auto; }
    .bl-editorial-img { height: 200px; border-right: none; border-bottom: 1px solid #D9D8D3; position: relative; }
    .bl-editorial-img img { position: absolute; }
    .bl-editorial-body { padding: 1.25rem; }
    .bl-editorial-arrow { padding-right: 1.25rem; }
}
</style>

<!-- ================================================
     HERO
================================================ -->
<section class="bl-hero">
    <div class="ph-split">
        <div class="ph-split__text" style="padding-top: calc(64px + 5rem);">
            <div class="container">
                <nav class="bl-hero__breadcrumb" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span class="sep">/</span>
                    <span>Blog</span>
                </nav>
                <span class="bl-hero__eyebrow">The <?php echo esc_html($biz); ?> Blog</span>
                <h1 class="bl-hero__title">Appliance Repair Guides &amp; Expert Tips</h1>
                <p class="bl-hero__sub">Practical advice from certified Viking appliance technicians — troubleshooting, maintenance, and repair guides for every major appliance.</p>
            </div>
        </div>
        <div class="ph-split__img">
            <img src="<?php echo esc_url(AR_URI . '/assets/images/5_Series_Kitchen_HQ-new.jpg'); ?>" alt="Viking appliance repair guides and expert tips" loading="lazy">
        </div>
    </div>
</section>

<?php
// Featured post — most recent
$featured_post = get_posts(['numberposts' => 1, 'post_status' => 'publish']);
if ($featured_post):
    $fp         = $featured_post[0];
    $fp_img     = get_post_meta($fp->ID, '_post_image_url', true);
    $fp_alt     = get_post_meta($fp->ID, '_post_image_alt', true) ?: get_the_title($fp->ID);
    $fp_cats    = get_the_terms($fp->ID, 'blog_category');
    $fp_cat     = ($fp_cats && !is_wp_error($fp_cats)) ? $fp_cats[0] : null;
    $fp_excerpt = get_post_field('post_excerpt', $fp->ID) ?: get_post_field('post_content', $fp->ID);

    // Fallback image map by category slug
    $blog_img_fallbacks = [
        'range-oven'      => 'viking-kitchen-miramar.jpg',
        'refrigerator'    => 'viking-refrigerator-3series.jpg',
        'dishwasher'      => 'viking-dishwasher-7series.jpg',
        'cooktop'         => 'viking-cooktop-rangetop.jpg',
        'maintenance'     => '5_Series_Kitchen_HQ-new.jpg',
        'troubleshooting' => 'viking-wall-oven-7series.jpg',
        'buying-guides'   => 'viking-tuscany-kitchen-1.jpg',
    ];
    $fp_cat_slug    = $fp_cat ? $fp_cat->slug : '';
    $fp_fallback    = get_template_directory_uri() . '/assets/images/' . ($blog_img_fallbacks[$fp_cat_slug] ?? '5_Series_Kitchen_HQ-new.jpg');
    // Validate: if stored image is external/broken, use fallback
    if ($fp_img && !file_exists(str_replace(get_template_directory_uri(), get_template_directory(), $fp_img))) {
        $fp_img = $fp_fallback;
    }
    if (!$fp_img && !has_post_thumbnail($fp->ID)) {
        $fp_img = $fp_fallback;
    }
    $fp_wc      = str_word_count(strip_tags(get_post_field('post_content', $fp->ID)));
    $fp_rt      = max(1, ceil($fp_wc / 200));
?>
<!-- ================================================
     FEATURED POST
================================================ -->
<section class="bl-featured">
    <div class="container">
        <a href="<?php echo esc_url(get_permalink($fp->ID)); ?>" class="bl-featured__inner">
            <div class="bl-featured__img-wrap">
                <?php if ($fp_img): ?>
                    <img src="<?php echo esc_url($fp_img); ?>"
                         alt="<?php echo esc_attr($fp_alt); ?>"
                         loading="eager">
                <?php elseif (has_post_thumbnail($fp->ID)): ?>
                    <?php echo get_the_post_thumbnail($fp->ID, 'large', ['alt' => esc_attr($fp_alt)]); ?>
                <?php else: ?>
                    <img src="<?php echo esc_url($fp_fallback); ?>"
                         alt="<?php echo esc_attr($fp_alt); ?>"
                         loading="eager">
                <?php endif; ?>
            </div>
            <div class="bl-featured__body">
                <span class="bl-featured__eyebrow">
                    <?php echo $fp_cat ? esc_html($fp_cat->name) : 'Featured Article'; ?>
                </span>
                <span class="bl-featured__title"><?php echo esc_html(get_the_title($fp->ID)); ?></span>
                <p class="bl-featured__excerpt"><?php echo wp_trim_words($fp_excerpt, 30); ?></p>
                <div class="bl-featured__meta">
                    <span><?php echo get_the_date('F j, Y', $fp->ID); ?></span>
                    <span>&middot;</span>
                    <span><?php echo $fp_rt; ?> min read</span>
                </div>
                <span class="bl-featured__link">
                    Read Article
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12H19M13 6L19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </span>
            </div>
        </a>
    </div>
</section>
<?php endif; ?>

<!-- ================================================
     CATEGORY PILLS
================================================ -->
<?php if (!is_wp_error($blog_cats) && $blog_cats): ?>
<div class="bl-cats-bar">
    <div class="container">
        <div class="bl-cats-bar__inner">
            <span class="bl-cats-bar__label">Browse</span>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="bl-cat-pill active">
                All <span class="bl-cat-pill__count">(<?php echo $published; ?>)</span>
            </a>
            <?php foreach ($blog_cats as $cat): ?>
            <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="bl-cat-pill">
                <?php echo esc_html($cat->name); ?>
                <span class="bl-cat-pill__count">(<?php echo $cat->count; ?>)</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ================================================
     MAIN CONTENT
================================================ -->
<div class="bl-main">
    <div class="container">
        <div class="bl-grid">

            <!-- ── Posts sectioned by category ── -->
            <div>
                <?php
                if (!is_wp_error($blog_cats) && $blog_cats):
                    $first = true;
                    foreach ($blog_cats as $section_cat):
                        $section_posts = get_posts([
                            'numberposts' => 6,
                            'post_status' => 'publish',
                            'tax_query'   => [[
                                'taxonomy' => 'blog_category',
                                'field'    => 'term_id',
                                'terms'    => $section_cat->term_id,
                            ]],
                        ]);
                        if (!$section_posts) continue;
                ?>
                <div class="bl-section-head" <?php echo $first ? '' : ''; ?>>
                    <h2 class="bl-section-head__title"><?php echo esc_html($section_cat->name); ?></h2>
                    <a href="<?php echo esc_url(get_term_link($section_cat)); ?>" class="bl-section-head__more">
                        View all
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12H19M13 6L19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </a>
                </div>
                <div class="bl-editorial-list">
                    <?php foreach ($section_posts as $sp):
                        $wc         = str_word_count(strip_tags(get_post_field('post_content', $sp->ID)));
                        $rt         = max(1, ceil($wc / 200));
                        $card_img   = get_post_meta($sp->ID, '_post_image_url', true);
                        $card_alt   = get_post_meta($sp->ID, '_post_image_alt', true) ?: get_the_title($sp->ID);
                        $excerpt    = get_post_field('post_excerpt', $sp->ID) ?: get_post_field('post_content', $sp->ID);
                        $card_fb    = get_template_directory_uri() . '/assets/images/' . ($blog_img_fallbacks[$section_cat->slug] ?? '5_Series_Kitchen_HQ-new.jpg');
                        if ($card_img && !file_exists(str_replace(get_template_directory_uri(), get_template_directory(), $card_img))) $card_img = $card_fb;
                        if (!$card_img && !has_post_thumbnail($sp->ID)) $card_img = $card_fb;
                    ?>
                    <a href="<?php echo esc_url(get_permalink($sp->ID)); ?>" class="bl-editorial-item">
                        <div class="bl-editorial-img">
                            <?php if ($card_img): ?>
                                <img src="<?php echo esc_url($card_img); ?>"
                                     alt="<?php echo esc_attr($card_alt); ?>"
                                     loading="lazy">
                            <?php elseif (has_post_thumbnail($sp->ID)): ?>
                                <?php echo get_the_post_thumbnail($sp->ID, 'medium', ['alt' => esc_attr($card_alt)]); ?>
                            <?php endif; ?>
                        </div>
                        <div class="bl-editorial-body">
                            <span class="bl-editorial-cat"><?php echo esc_html($section_cat->name); ?></span>
                            <h3 class="bl-editorial-title"><?php echo esc_html(get_the_title($sp->ID)); ?></h3>
                            <p class="bl-editorial-excerpt"><?php echo esc_html(wp_trim_words($excerpt, 20)); ?></p>
                            <span class="bl-editorial-meta"><?php echo get_the_date('M j, Y', $sp->ID); ?> &middot; <?php echo $rt; ?> min read</span>
                        </div>
                        <svg class="bl-editorial-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php
                        $first = false;
                    endforeach;
                else:
                ?>
                <div class="bl-empty">
                    <h2 class="bl-empty__title">No articles yet</h2>
                    <p class="bl-empty__text">We're working on great content. Check back soon.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- ── Sidebar ── -->
            <aside class="bl-sidebar" aria-label="Blog sidebar">

                <!-- CTA -->
                <div class="bl-sb-cta">
                    <h3 class="bl-sb-cta__title">Need a Repair?</h3>
                    <p class="bl-sb-cta__text">Same-day service. 30-day warranty. Viking specialists.</p>
                    <a href="<?php echo esc_url($phone_link); ?>" class="bl-sb-cta__phone">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031-.024 5.24039.04 1.70001C.04 1.14594.249.612295.627.234492C1.005-.143311 1.539-.352821 2.093-.352821H5.093C6.107-.362986 6.966.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="/schedule/" class="bl-sb-cta__schedule">Schedule Online</a>
                </div>

                <!-- Categories -->
                <?php if (!is_wp_error($blog_cats) && $blog_cats): ?>
                <div class="bl-sb-section">
                    <p class="bl-sb-section__title">Browse by Topic</p>
                    <nav class="bl-cat-list" aria-label="Blog categories">
                        <a href="<?php echo esc_url(home_url('/blog/')); ?>"
                           class="bl-cat-list__link current">
                            <span class="bl-cat-list__name">All Articles</span>
                            <span class="bl-cat-list__count"><?php echo $published; ?></span>
                        </a>
                        <?php foreach ($blog_cats as $cat): ?>
                        <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                           class="bl-cat-list__link">
                            <span class="bl-cat-list__name"><?php echo esc_html($cat->name); ?></span>
                            <span class="bl-cat-list__count"><?php echo $cat->count; ?></span>
                        </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
                <?php endif; ?>

                <!-- Recent posts -->
                <?php
                $recent = get_posts(['numberposts' => 4, 'post_status' => 'publish']);
                if ($recent):
                ?>
                <div class="bl-sb-section">
                    <p class="bl-sb-section__title">Recent Articles</p>
                    <div class="bl-recent-list">
                        <?php foreach ($recent as $rp):
                            $rp_img = get_post_meta($rp->ID, '_post_image_url', true);
                            $rp_alt = get_post_meta($rp->ID, '_post_image_alt', true) ?: get_the_title($rp->ID);
                        ?>
                        <a href="<?php echo esc_url(get_permalink($rp->ID)); ?>" class="bl-recent-item">
                            <div class="bl-recent-thumb">
                                <?php if ($rp_img): ?>
                                    <img src="<?php echo esc_url($rp_img); ?>"
                                         alt="<?php echo esc_attr($rp_alt); ?>"
                                         loading="lazy">
                                <?php elseif (has_post_thumbnail($rp->ID)): ?>
                                    <?php echo get_the_post_thumbnail($rp->ID, 'thumbnail'); ?>
                                <?php else: ?>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="#D9D8D3" stroke-width="1.5" stroke-linecap="round"/></svg>
                                <?php endif; ?>
                            </div>
                            <div>
                                <p class="bl-recent-title"><?php echo esc_html(get_the_title($rp->ID)); ?></p>
                                <span class="bl-recent-date"><?php echo get_the_date('M j, Y', $rp->ID); ?></span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

            </aside>

        </div>
    </div>
</div>

<!-- ================================================
     BOTTOM CTA
================================================ -->
<section class="bl-bottom-cta">
    <div class="container">
        <div class="bl-bottom-cta__inner">
            <div>
                <span class="bl-bottom-cta__eyebrow">Same-Day Service Available</span>
                <h2 class="bl-bottom-cta__title">Need a Repair Right Now?</h2>
                <p class="bl-bottom-cta__sub">Certified Viking technicians — 30-day warranty on all repairs.</p>
            </div>
            <div class="bl-bottom-cta__btns">
                <a href="<?php echo esc_url($phone_link); ?>" class="bl-bottom-cta__btn-phone">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031-.024 5.24039.04 1.70001C.04 1.14594.249.612295.627.234492C1.005-.143311 1.539-.352821 2.093-.352821H5.093C6.107-.362986 6.966.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                    <?php echo esc_html($phone); ?>
                </a>
                <a href="/schedule/" class="bl-bottom-cta__btn-schedule">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Schedule Online
                </a>
            </div>
        </div>
    </div>
</section>

<?php ar_appointment_form('blog', 'Book Your Repair Appointment'); ?>

<?php get_footer(); ?>
