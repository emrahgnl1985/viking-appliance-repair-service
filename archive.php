<?php
/**
 * archive.php — Blog category / tag / date archives
 * URL: /blog/category/{slug}/ | /tag/{slug}/ | /YYYY/MM/
 */
defined('ABSPATH') || exit;

$phone      = ar_get_phone();
$phone_link = ar_phone_link();

// Category-matched fallback images for posts with no featured image
$blog_img_fallbacks = [
    'range-oven'      => 'viking-kitchen-miramar.jpg',
    'refrigerator'    => 'viking-refrigerator-3series.jpg',
    'dishwasher'      => 'viking-dishwasher-7series.jpg',
    'cooktop'         => 'viking-cooktop-rangetop.jpg',
    'maintenance'     => '5_Series_Kitchen_HQ-new.jpg',
    'troubleshooting' => 'viking-wall-oven-7series.jpg',
    'buying-guides'   => 'viking-tuscany-kitchen-1.jpg',
];

// Archive title & description
if (is_tax('blog_category')) {
    $term        = get_queried_object();
    $arch_title  = $term->name;
    $arch_sub    = $term->description ?: 'Expert tips, fixes, and advice about ' . strtolower($term->name) . '.';
    $arch_label  = 'Topic';
    $back_url    = home_url('/blog/');
} elseif (is_tag()) {
    $term        = get_queried_object();
    $arch_title  = 'Tagged: ' . $term->name;
    $arch_sub    = 'All articles tagged with "' . $term->name . '"';
    $arch_label  = 'Tag';
    $back_url    = home_url('/blog/');
} elseif (is_author()) {
    $arch_title  = 'By ' . get_the_author_meta('display_name', get_queried_object_id());
    $arch_sub    = 'All articles by this author.';
    $arch_label  = 'Author';
    $back_url    = home_url('/blog/');
} elseif (is_year()) {
    $arch_title  = get_the_date('Y');
    $arch_sub    = 'Articles published in ' . get_the_date('Y') . '.';
    $arch_label  = 'Year';
    $back_url    = home_url('/blog/');
} elseif (is_month()) {
    $arch_title  = get_the_date('F Y');
    $arch_sub    = 'Articles published in ' . get_the_date('F Y') . '.';
    $arch_label  = 'Month';
    $back_url    = home_url('/blog/');
} else {
    $arch_title  = 'Blog &amp; Appliance Tips';
    $arch_sub    = 'Expert repair guides, maintenance tips, and appliance advice.';
    $arch_label  = 'Blog';
    $back_url    = home_url('/blog/');
}

$total_found  = $GLOBALS['wp_query']->found_posts;
$blog_cats    = get_terms(['taxonomy' => 'blog_category', 'hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC']);
$current_slug = is_tax('blog_category') ? get_queried_object()->slug : '';

get_header();
?>

<style>
/* ================================================
   BLOG ARCHIVE — OBSIDIAN Scoped Styles
================================================ */

/* ph-split hero panel */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) { .ph-split { display: block; } .ph-split__img { height: 280px; position: relative; } .ph-split__img img { position: absolute; } .ph-split__img::before { display: none; } }

/* ── Hero ── */
.ba-hero {
    background: var(--color-bg-light);
    padding-top: 0;
    padding-bottom: 0;
    border-bottom: 1px solid var(--color-rule);
}
.ba-breadcrumbs {
    display: flex;
    align-items: center;
    gap: .375rem;
    font-family: var(--font-body);
    font-size: .75rem;
    color: var(--color-text-muted);
    margin-bottom: 2rem;
}
.ba-breadcrumbs a {
    color: var(--color-text-muted);
    text-decoration: none;
    transition: color .15s;
}
.ba-breadcrumbs a:hover { color: var(--color-primary-dark); }
.ba-breadcrumbs .sep { color: var(--color-rule); }

.ba-hero__eyebrow {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-primary);
    display: block;
    margin-bottom: .875rem;
}
.ba-hero__title {
    font-family: var(--font-display);
    font-size: clamp(2.25rem, 5vw, 3.75rem);
    font-weight: 300;
    letter-spacing: -0.025em;
    color: var(--color-primary-dark);
    line-height: 1.05;
    margin: 0 0 1rem;
    max-width: 680px;
}
.ba-hero__sub {
    font-family: var(--font-body);
    font-size: 1rem;
    color: var(--color-text-muted);
    line-height: 1.7;
    margin: 0 0 1.5rem;
    max-width: 520px;
}
.ba-hero__meta {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    font-family: var(--font-body);
    font-size: .8125rem;
    color: var(--color-text-muted);
}
.ba-hero__back {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    color: var(--color-text-muted);
    text-decoration: none;
    transition: color .15s;
}
.ba-hero__back:hover { color: var(--color-primary-dark); text-decoration: none; }

/* ── Category pills bar ── */
.ba-cats-bar {
    background: #FFFFFF;
    border-bottom: 1px solid var(--color-rule);
    padding: 1.25rem 0;
}
.ba-cats-bar__inner {
    display: flex;
    align-items: center;
    gap: .5rem;
    flex-wrap: wrap;
    overflow-x: auto;
    scrollbar-width: none;
}
.ba-cats-bar__inner::-webkit-scrollbar { display: none; }
.ba-cats-bar__label {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin-right: .5rem;
    white-space: nowrap;
    flex-shrink: 0;
}
.ba-cat-pill {
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
    white-space: nowrap;
    flex-shrink: 0;
    transition: border-color .15s, color .15s, background .15s;
}
.ba-cat-pill:hover {
    border-color: var(--color-primary-dark);
    background: var(--color-primary-dark);
    color: #FFFFFF;
    text-decoration: none;
}
.ba-cat-pill.active {
    border-color: var(--color-primary);
    background: var(--color-primary);
    color: #FFFFFF;
}
.ba-cat-pill__count {
    font-size: .6875rem;
    font-weight: 700;
    opacity: .65;
}

/* ── Main layout ── */
.ba-main {
    background: var(--color-bg-light);
    padding: 4rem 0 6rem;
}
.ba-grid {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 4rem;
    align-items: start;
}

/* Section meta row */
.ba-section-head {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--color-rule);
    margin-bottom: 2rem;
}
.ba-section-head__title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 400;
    letter-spacing: -0.015em;
    color: var(--color-primary-dark);
    margin: 0;
}
.ba-section-head__count {
    font-family: var(--font-body);
    font-size: .8125rem;
    color: var(--color-text-muted);
}

/* Post grid */
.ba-posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

/* Empty */
.ba-empty {
    background: #FFFFFF;
    border: 1px solid var(--color-rule);
    padding: 3.5rem 2rem;
    text-align: center;
    border-radius: 2px;
}
.ba-empty__title {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 300;
    color: var(--color-primary-dark);
    margin: 0 0 .5rem;
}
.ba-empty__text {
    font-family: var(--font-body);
    font-size: .9375rem;
    color: var(--color-text-muted);
    margin: 0;
}
.ba-empty__text a {
    color: var(--color-primary);
    text-decoration: none;
}
.ba-empty__text a:hover { text-decoration: underline; }

/* Pagination — minimal text-based */
.ba-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 3rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--color-rule);
    font-family: var(--font-body);
    font-size: .8125rem;
}
.ba-pagination .page-numbers {
    font-family: var(--font-body);
    font-size: .8125rem;
    font-weight: 600;
    color: var(--color-text-muted);
    text-decoration: none;
    letter-spacing: .06em;
    text-transform: uppercase;
    transition: color .15s;
    background: none;
    border: none;
    padding: 0;
}
.ba-pagination .page-numbers:hover { color: var(--color-primary-dark); }
.ba-pagination .page-numbers.current {
    color: var(--color-primary);
    font-weight: 700;
}
.ba-pagination .page-numbers.dots {
    color: var(--color-text-muted);
    pointer-events: none;
}
.ba-pagination ul {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

/* ── Sidebar ── */
.ba-sidebar {
    position: sticky;
    top: calc(64px + 2rem);
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* CTA block */
.ba-sb-cta {
    background: #0A0A0A;
    padding: 1.75rem;
    border-radius: 2px;
    margin-bottom: 2rem;
}
.ba-sb-cta__title {
    font-family: var(--font-display);
    font-size: 1.375rem;
    font-weight: 300;
    letter-spacing: -0.02em;
    color: #FFFFFF;
    margin: 0 0 .5rem;
    line-height: 1.2;
}
.ba-sb-cta__text {
    font-family: var(--font-body);
    font-size: .8125rem;
    color: rgba(255,255,255,.5);
    line-height: 1.6;
    margin: 0 0 1.25rem;
}
.ba-sb-cta__phone {
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
.ba-sb-cta__phone:hover { background: #a01525; color: #FFFFFF; text-decoration: none; }
.ba-sb-cta__schedule {
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
.ba-sb-cta__schedule:hover { background: rgba(255,255,255,.13); color: #FFFFFF; text-decoration: none; }

/* Sidebar section */
.ba-sb-section {
    border-top: 1px solid var(--color-rule);
    padding: 1.5rem 0;
}
.ba-sb-section:first-child { border-top: none; padding-top: 0; }
.ba-sb-section__title {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin: 0 0 1rem;
}

/* Category list */
.ba-cat-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}
.ba-cat-list__link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .625rem 0;
    border-bottom: 1px solid var(--color-rule);
    text-decoration: none;
}
.ba-cat-list__link:last-child { border-bottom: none; }
.ba-cat-list__name {
    font-family: var(--font-body);
    font-size: .875rem;
    color: var(--color-primary-dark);
    font-weight: 400;
    transition: color .15s;
}
.ba-cat-list__link:hover .ba-cat-list__name { color: var(--color-primary); }
.ba-cat-list__link.current .ba-cat-list__name { color: var(--color-primary); font-weight: 600; }
.ba-cat-list__count {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 600;
    color: var(--color-text-muted);
}

/* ── Responsive ── */
@media (max-width: 1024px) {
    .ba-posts-grid { grid-template-columns: repeat(2, 1fr); }
    .ba-grid { grid-template-columns: 1fr 260px; gap: 3rem; }
}
@media (max-width: 900px) {
    .ba-grid { grid-template-columns: 1fr; }
    .ba-sidebar { position: static; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .ba-sb-cta { margin-bottom: 0; }
}
@media (max-width: 768px) {
    .ba-posts-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .ba-hero { padding-top: calc(64px + 3rem); padding-bottom: 2.5rem; }
    .ba-posts-grid { grid-template-columns: 1fr; }
    .ba-sidebar { grid-template-columns: 1fr; }
}
</style>

<!-- ================================================
     HERO
================================================ -->
<section class="ba-hero">
    <div class="ph-split">
        <div class="ph-split__text" style="padding-top: calc(64px + 4.5rem);">
            <div class="container">

                <!-- Breadcrumbs -->
                <nav class="ba-breadcrumbs" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span class="sep">/</span>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
                    <?php if (!is_home()): ?>
                    <span class="sep">/</span>
                    <span><?php echo wp_strip_all_tags($arch_title); ?></span>
                    <?php endif; ?>
                </nav>

                <span class="ba-hero__eyebrow"><?php echo esc_html($arch_label); ?></span>
                <h1 class="ba-hero__title"><?php echo $arch_title; ?></h1>
                <p class="ba-hero__sub"><?php echo esc_html($arch_sub); ?></p>

                <div class="ba-hero__meta">
                    <span><?php echo $total_found; ?> article<?php echo $total_found !== 1 ? 's' : ''; ?></span>
                    <span>&middot;</span>
                    <a href="<?php echo esc_url($back_url); ?>" class="ba-hero__back">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        All Articles
                    </a>
                </div>

            </div>
        </div>
        <div class="ph-split__img">
            <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-3series-kitchen-2.jpg'); ?>" alt="Viking appliance repair blog" loading="lazy">
        </div>
    </div>
</section>

<!-- ================================================
     CATEGORY PILLS BAR
================================================ -->
<?php if (!is_wp_error($blog_cats) && $blog_cats): ?>
<div class="ba-cats-bar">
    <div class="container">
        <div class="ba-cats-bar__inner">
            <span class="ba-cats-bar__label">Topics</span>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>"
               class="ba-cat-pill <?php echo !$current_slug ? 'active' : ''; ?>">
                All Posts
            </a>
            <?php foreach ($blog_cats as $cat): ?>
            <a href="<?php echo esc_url(get_term_link($cat)); ?>"
               class="ba-cat-pill <?php echo ($current_slug === $cat->slug) ? 'active' : ''; ?>">
                <?php echo esc_html($cat->name); ?>
                <span class="ba-cat-pill__count">(<?php echo $cat->count; ?>)</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ================================================
     MAIN
================================================ -->
<div class="ba-main">
    <div class="container">
        <div class="ba-grid">

            <!-- ── Posts ── -->
            <div>
                <div class="ba-section-head">
                    <h2 class="ba-section-head__title"><?php echo wp_strip_all_tags($arch_title); ?></h2>
                    <span class="ba-section-head__count"><?php echo $total_found; ?> article<?php echo $total_found !== 1 ? 's' : ''; ?></span>
                </div>

                <?php if (have_posts()): ?>

                <div class="ba-posts-grid">
                    <?php while (have_posts()): the_post();
                        $p_cats = get_the_terms(get_the_ID(), 'blog_category');
                        $p_cat  = ($p_cats && !is_wp_error($p_cats)) ? $p_cats[0] : null;
                        $rt     = max(1, ceil(str_word_count(strip_tags(get_the_content())) / 200));
                        $post_id  = get_the_ID();
                        $meta_url  = get_post_meta($post_id, '_post_image_url', true);
                        $meta_alt  = get_post_meta($post_id, '_post_image_alt', true) ?: get_the_title();
                        $cat_slug  = $p_cat ? $p_cat->slug : '';
                        $fallback  = get_template_directory_uri() . '/assets/images/' . ($blog_img_fallbacks[$cat_slug] ?? '5_Series_Kitchen_HQ-new.jpg');
                        // Use fallback if stored URL is external/broken
                        if ($meta_url && !str_starts_with($meta_url, get_template_directory_uri())) {
                            $meta_url = $fallback;
                        }
                        $card_img = $meta_url ?: $fallback;
                    ?>
                    <a href="<?php the_permalink(); ?>" class="post-card">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', ['class' => 'post-card__thumb', 'alt' => esc_attr($meta_alt)]); ?>
                        <?php else: ?>
                            <img class="post-card__thumb"
                                 src="<?php echo esc_url($card_img); ?>"
                                 alt="<?php echo esc_attr($meta_alt); ?>"
                                 width="800" height="450"
                                 loading="lazy">
                        <?php endif; ?>
                        <?php if ($p_cat): ?>
                        <span class="post-card__label"><?php echo esc_html($p_cat->name); ?></span>
                        <?php endif; ?>
                        <h3 class="post-card__title"><?php the_title(); ?></h3>
                        <p class="post-card__excerpt"><?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 18); ?></p>
                        <span class="post-card__meta"><?php echo get_the_date('M j, Y'); ?> &middot; <?php echo $rt; ?> min read</span>
                    </a>
                    <?php endwhile; ?>
                </div>

                <div class="ba-pagination">
                    <?php echo paginate_links([
                        'prev_text' => '&#8592; Previous',
                        'next_text' => 'Next &#8594;',
                        'type'      => 'list',
                    ]); ?>
                </div>

                <?php else: ?>
                <div class="ba-empty">
                    <h2 class="ba-empty__title">No articles found</h2>
                    <p class="ba-empty__text">Check back soon, or <a href="<?php echo esc_url(home_url('/blog/')); ?>">browse all articles</a>.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- ── Sidebar ── -->
            <aside class="ba-sidebar" aria-label="Blog sidebar">

                <div class="ba-sb-cta">
                    <h3 class="ba-sb-cta__title">Need a Repair?</h3>
                    <p class="ba-sb-cta__text">Same-day service. 30-day warranty. Viking specialists.</p>
                    <a href="<?php echo esc_url($phone_link); ?>" class="ba-sb-cta__phone">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031-.024 5.24039.04 1.70001C.04 1.14594.249.612295.627.234492C1.005-.143311 1.539-.352821 2.093-.352821H5.093C6.107-.362986 6.966.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="/schedule/" class="ba-sb-cta__schedule">Schedule Online</a>
                </div>

                <?php if (!is_wp_error($blog_cats) && $blog_cats): ?>
                <div class="ba-sb-section">
                    <p class="ba-sb-section__title">Browse Topics</p>
                    <nav class="ba-cat-list" aria-label="Blog categories">
                        <a href="<?php echo esc_url(home_url('/blog/')); ?>"
                           class="ba-cat-list__link <?php echo !$current_slug ? 'current' : ''; ?>">
                            <span class="ba-cat-list__name">All Articles</span>
                            <span class="ba-cat-list__count"><?php echo (int) wp_count_posts('post')->publish; ?></span>
                        </a>
                        <?php foreach ($blog_cats as $cat): ?>
                        <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                           class="ba-cat-list__link <?php echo ($current_slug === $cat->slug) ? 'current' : ''; ?>">
                            <span class="ba-cat-list__name"><?php echo esc_html($cat->name); ?></span>
                            <span class="ba-cat-list__count"><?php echo $cat->count; ?></span>
                        </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
                <?php endif; ?>

            </aside>

        </div>
    </div>
</div>

<?php ar_appointment_form('blog-archive', 'Need Appliance Repair?'); ?>

<?php get_footer(); ?>
