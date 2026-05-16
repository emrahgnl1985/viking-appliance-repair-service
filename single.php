<?php
/**
 * single.php — Single blog post
 * URL: /YYYY/MM/DD/{slug}/ or /{slug}/ depending on permalink settings
 */
defined('ABSPATH') || exit;

global $post;
the_post();

$id         = $post->ID;
$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();

// Read time
$content    = apply_filters('the_content', $post->post_content);
$word_count = str_word_count(strip_tags($content));
$read_time  = max(1, (int) ceil($word_count / 200));

// Category
$post_cats  = get_the_terms($id, 'blog_category');
$post_cat   = ($post_cats && !is_wp_error($post_cats)) ? $post_cats[0] : null;

// Tags
$post_tags  = get_the_tags();

// Related posts (same blog_category)
$related_args = [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => [$id],
    'orderby'        => 'rand',
];
if ($post_cat) {
    $related_args['tax_query'] = [[
        'taxonomy' => 'blog_category',
        'field'    => 'term_id',
        'terms'    => $post_cat->term_id,
    ]];
}
$related_posts = get_posts($related_args);

// Build TOC from h2/h3
$toc = [];
preg_match_all('/<h([23])[^>]*>(.*?)<\/h\1>/i', $content, $headings, PREG_SET_ORDER);
foreach ($headings as $i => $h) {
    $level  = (int) $h[1];
    $text   = strip_tags($h[2]);
    $anchor = 'sp-' . ($i + 1) . '-' . sanitize_title($text);
    $toc[]  = ['level' => $level, 'text' => $text, 'anchor' => $anchor];
    $content = str_replace(
        $h[0],
        '<h' . $level . ' id="' . esc_attr($anchor) . '">' . $h[2] . '</h' . $level . '>',
        $content
    );
}

get_header();

// Schema
ar_output_schema([
    '@context'         => 'https://schema.org',
    '@type'            => 'BlogPosting',
    'headline'         => get_the_title(),
    'url'              => get_permalink(),
    'datePublished'    => get_the_date('c'),
    'dateModified'     => get_the_modified_date('c'),
    'author'           => ['@type' => 'Person', 'name' => get_the_author()],
    'publisher'        => ['@type' => 'Organization', 'name' => $biz, 'url' => home_url('/')],
    'description'      => wp_trim_words(get_the_excerpt() ?: strip_tags($post->post_content), 30),
    'wordCount'        => $word_count,
    'timeRequired'     => 'PT' . $read_time . 'M',
    'image'            => get_post_meta($id, '_post_image_url', true)
                            ?: (has_post_thumbnail($id) ? get_the_post_thumbnail_url($id, 'large') : ''),
]);
?>

<style>
/* ================================================
   SINGLE POST — Scoped Styles
================================================ */

#sp-progress {
    position: fixed;
    top: 0; left: 0;
    width: 0%;
    height: 2px;
    background: #C01C28;
    z-index: 9999;
    transition: width .1s linear;
}

/* ── Hero ── */
.sp-hero {
    background: var(--color-bg-light);
    padding: calc(64px + 3rem) 0 2.75rem;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid var(--color-rule);
}
.sp-hero::before {
    content: none;
}

.sp-breadcrumbs {
    display: flex;
    align-items: center;
    gap: .375rem;
    flex-wrap: wrap;
    margin-bottom: 1.75rem;
    font-size: .8125rem;
    color: rgba(255,255,255,.4);
    position: relative;
}
.sp-breadcrumbs a { color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast); }
.sp-breadcrumbs a:hover { color: var(--color-primary); }
.sp-breadcrumbs .sep { color: var(--color-text-light); }

.sp-hero__cat {
    display: inline-flex;
    align-items: center;
    gap: .375rem;
    background: transparent;
    border: none;
    color: var(--color-primary);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 0;
    margin-bottom: 1rem;
    text-decoration: none;
}

.sp-hero__title {
    font-family: 'Cormorant', Georgia, serif;
    font-size: clamp(2rem, 4vw, 3.5rem);
    font-weight: 400;
    color: #0D0D0D;
    line-height: 1.08;
    letter-spacing: -0.025em;
    margin: 0 0 1.25rem;
    position: relative;
    max-width: 800px;
}

.sp-hero__meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
    color: var(--color-text-muted);
    font-size: .8125rem;
    position: relative;
}
.sp-hero__meta-item { display: flex; align-items: center; gap: .375rem; }
.sp-hero__meta-divider { color: var(--color-text-light); }

/* ── Layout ── */
.sp-layout {
    background: var(--color-bg-light);
    padding: 3rem 0 5rem;
}
.sp-grid {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 3rem;
    align-items: start;
}

/* ── Article card ── */
.sp-article {
    background: #fff;
    border: 1px solid var(--color-rule);
    border-radius: var(--radius-md);
    overflow: hidden;
}

/* Featured image */
.sp-feat-img {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--color-bg-section);
}
.sp-feat-img img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
.sp-feat-img-placeholder {
    width: 64px; height: 64px;
    background: rgba(192,28,40,.1);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Article body */
.sp-article__body { padding: 2.5rem; }

/* TOC */
.sp-toc {
    background: var(--color-bg-light);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 1.25rem 1.5rem;
    margin-bottom: 2.5rem;
}
.sp-toc__title {
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin: 0 0 .875rem;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.sp-toc__list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: .125rem; }
.sp-toc__item { margin: 0; padding: 0; }
.sp-toc__link {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .375rem .5rem;
    border-radius: var(--radius-sm);
    font-size: .8125rem;
    color: var(--color-text-muted);
    text-decoration: none;
    line-height: 1.4;
    transition: background var(--transition-fast), color var(--transition-fast);
}
.sp-toc__link:hover { background: var(--color-bg-section); color: var(--color-primary); text-decoration: none; }
.sp-toc__link--h3 { padding-left: 1.5rem; font-size: .75rem; }
.sp-toc__num { font-size: .6875rem; font-weight: 700; color: var(--color-accent); opacity: .6; min-width: 1rem; }

/* ── Post content typography ── */
.sp-content {
    font-size: 1rem;
    line-height: 1.75;
    color: var(--color-text-body);
}
.sp-content h2 {
    font-family: 'Cormorant', Georgia, serif;
    font-size: clamp(1.5rem, 2.5vw, 2rem);
    font-weight: 400;
    color: #0D0D0D;
    margin: 2.5rem 0 .875rem;
    padding-top: 2.5rem;
    border-top: 1px solid var(--color-rule);
    scroll-margin-top: 90px;
    letter-spacing: -0.02em;
    line-height: 1.15;
}
.sp-content h2:first-child { margin-top: 0; padding-top: 0; border-top: none; }
.sp-content h3 {
    font-family: 'Cormorant', Georgia, serif;
    font-size: clamp(1.25rem, 2vw, 1.625rem);
    font-weight: 500;
    color: #0D0D0D;
    margin: 1.75rem 0 .625rem;
    scroll-margin-top: 90px;
    letter-spacing: -0.01em;
}
.sp-content h4 { font-size: 1rem; font-weight: 600; margin: 1.25rem 0 .5rem; color: #0D0D0D; }
.sp-content p { margin: 0 0 1.125rem; }
.sp-content ul, .sp-content ol { margin: 0 0 1.25rem; padding-left: 1.5rem; }
.sp-content li { margin-bottom: .4rem; line-height: 1.7; }
.sp-content strong { font-weight: 600; color: #0D0D0D; }
.sp-content a { color: var(--color-primary); text-decoration: underline; text-underline-offset: 2px; text-decoration-color: rgba(192,28,40,.3); }
.sp-content a:hover { text-decoration-color: var(--color-primary); }
.sp-content blockquote {
    border-left: 3px solid var(--color-primary);
    background: var(--color-bg-light);
    padding: 1.25rem 1.5rem;
    margin: 1.75rem 0;
    font-family: 'Cormorant', Georgia, serif;
    font-style: italic;
    font-size: 1.25rem;
    color: var(--color-text-body);
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
}
.sp-content blockquote p { margin: 0; }
.sp-content pre, .sp-content code {
    background: #0D0D0D;
    color: #E5E7EB;
    font-family: var(--font-mono);
    font-size: .875rem;
    border-radius: var(--radius-md);
}
.sp-content pre { padding: 1.25rem 1.5rem; overflow-x: auto; margin: 1.25rem 0; }
.sp-content code { padding: .125rem .375rem; }
.sp-content img { max-width: 100%; border-radius: var(--radius-sm); margin: 1.25rem 0; }
.sp-content table { width: 100%; border-collapse: collapse; margin: 1.25rem 0; font-size: .875rem; }
.sp-content th, .sp-content td { padding: .75rem 1rem; border: 1px solid var(--color-rule); text-align: left; }
.sp-content th { background: var(--color-bg-section); font-weight: 600; }

/* ── Post footer: tags + share ── */
.sp-post-footer {
    margin-top: 2.5rem;
    padding-top: 2rem;
    border-top: 1px solid var(--color-border);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
}
.sp-tags { display: flex; align-items: center; gap: .5rem; flex-wrap: wrap; }
.sp-tags__label { font-size: .8125rem; color: var(--color-text-muted); font-weight: 600; white-space: nowrap; }
.sp-tag {
    display: inline-block;
    background: var(--color-bg-section);
    border: 1px solid var(--color-border);
    color: var(--color-text-muted);
    font-size: .75rem;
    font-weight: 500;
    padding: .25rem .625rem;
    border-radius: var(--radius-full);
    text-decoration: none;
    transition: all var(--transition-fast);
}
.sp-tag:hover { background: var(--color-bg-section); border-color: rgba(192,28,40,.2); color: var(--color-primary); }

/* ── Related posts ── */
.sp-related { margin-top: 3rem; }
.sp-related__heading {
    font-family: var(--font-body);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--color-primary);
    margin: 0 0 1.25rem;
    display: flex;
    align-items: center;
    gap: .75rem;
}
.sp-related__heading::before {
    content: '';
    display: block;
    width: 24px;
    height: 1.5px;
    background: var(--color-primary);
}
.sp-related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
.sp-related-card {
    background: #fff;
    border: 1px solid var(--color-rule);
    border-top: 2px solid transparent;
    border-radius: var(--radius-md);
    overflow: hidden;
    text-decoration: none;
    transition: box-shadow var(--transition-base), border-color var(--transition-base);
    display: block;
}
.sp-related-card:hover { box-shadow: var(--shadow-md); border-top-color: var(--color-primary); text-decoration: none; }
.sp-related-card__img {
    aspect-ratio: 16/9;
    background: var(--color-bg-section);
    overflow: hidden;
}
.sp-related-card__img img { width: 100%; height: 100%; display: block; object-fit: cover; object-position: center; }
.sp-related-card__body { padding: 1rem; }
.sp-related-card__cat {
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--color-primary);
    margin-bottom: .375rem;
}
.sp-related-card__title {
    font-family: 'Cormorant', Georgia, serif;
    font-size: 1.0625rem;
    font-weight: 500;
    color: #0D0D0D;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.01em;
}
.sp-related-card:hover .sp-related-card__title { color: var(--color-primary); }

/* ── Sidebar ── */
.sp-sidebar {
    position: sticky;
    top: 88px;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.sp-cta-card {
    background: var(--color-primary-dark);
    border-radius: var(--radius-md);
    padding: 1.75rem 1.5rem;
}
.sp-cta-card__title {
    font-family: 'Cormorant', Georgia, serif;
    font-size: 1.375rem;
    font-weight: 400;
    color: #fff;
    margin: 0 0 .5rem;
    line-height: 1.2;
    letter-spacing: -0.02em;
}
.sp-cta-card__text { font-size: .8125rem; color: rgba(255,255,255,.45); line-height: 1.65; margin: 0 0 1.25rem; font-family: var(--font-body); }
.sp-cta-card__phone {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    background: #C01C28;
    color: #fff;
    font-size: .875rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: .8125rem;
    border-radius: var(--radius-sm);
    text-decoration: none;
    margin-bottom: .625rem;
    transition: background var(--transition-fast);
    font-family: var(--font-body);
}
.sp-cta-card__phone:hover { background: #9A1520; color: #fff; }
.sp-cta-card__btn {
    display: block;
    text-align: center;
    background: rgba(255,255,255,.06);
    color: rgba(255,255,255,.7);
    font-size: .8125rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    padding: .6875rem;
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: background var(--transition-fast);
    font-family: var(--font-body);
}
.sp-cta-card__btn:hover { background: rgba(255,255,255,.12); color: #fff; }

.sp-sb-card {
    background: #fff;
    border: 1px solid var(--color-rule);
    border-radius: var(--radius-md);
    overflow: hidden;
}
.sp-sb-card__head { padding: .875rem 1.25rem; border-bottom: 1px solid var(--color-rule); }
.sp-sb-card__title {
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin: 0;
}
.sp-sb-card__body { padding: .75rem 1.25rem 1.25rem; }

/* Sidebar cat links */
.sp-sb-cats { display: flex; flex-direction: column; gap: 0; }
.sp-sb-cat {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .5rem 0;
    border-bottom: 1px solid var(--color-rule);
    text-decoration: none;
    transition: color var(--transition-fast);
}
.sp-sb-cat:last-child { border-bottom: none; }
.sp-sb-cat:hover { text-decoration: none; }
.sp-sb-cat.current {}
.sp-sb-cat__name { font-size: .875rem; color: var(--color-text-body); font-weight: 400; display: flex; align-items: center; gap: .5rem; }
.sp-sb-cat:hover .sp-sb-cat__name { color: var(--color-primary); }
.sp-sb-cat.current .sp-sb-cat__name { color: var(--color-primary); font-weight: 500; }
.sp-sb-cat__dot { width: 5px; height: 5px; background: var(--color-rule); border-radius: 50%; }
.sp-sb-cat.current .sp-sb-cat__dot { background: var(--color-primary); }
.sp-sb-cat__count { font-size: .75rem; color: var(--color-text-light); background: var(--color-bg-section); padding: .125rem .4rem; border-radius: var(--radius-full); font-weight: 600; }

/* ── Bottom CTA ── */
.sp-bottom-cta { background: #0A0A0A; padding: 3.5rem 0; border-top: 1px solid rgba(255,255,255,0.07); }
.sp-bottom-cta__inner { display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap; }
.sp-bottom-cta__title { font-family: 'Cormorant', Georgia, serif; font-size: clamp(1.75rem,3vw,2.5rem); font-weight: 300; letter-spacing: -0.025em; color: #fff; margin: 0 0 .375rem; line-height: 1.1; }
.sp-bottom-cta__sub { font-size: .9375rem; color: rgba(255,255,255,.4); margin: 0; font-family: var(--font-body); }
.sp-bottom-cta__btns { display: flex; gap: .875rem; flex-wrap: wrap; }
.sp-bottom-cta__btn-primary {
    display: inline-flex; align-items: center; gap: .5rem;
    background: #C01C28; color: #fff;
    font-weight: 700; font-size: .8125rem; letter-spacing: 0.08em; text-transform: uppercase;
    padding: 13px 28px; border-radius: 2px;
    text-decoration: none; transition: background var(--transition-fast);
    font-family: var(--font-body);
}
.sp-bottom-cta__btn-primary:hover { background: #9A1520; color: #fff; }
.sp-bottom-cta__btn-sec {
    display: inline-flex; align-items: center; gap: .5rem;
    background: transparent; color: rgba(255,255,255,.75);
    font-weight: 600; font-size: .8125rem; letter-spacing: 0.06em; text-transform: uppercase;
    border: 1.5px solid rgba(255,255,255,.2);
    padding: 12px 28px; border-radius: 2px;
    text-decoration: none; transition: border-color var(--transition-fast), color var(--transition-fast);
    font-family: var(--font-body);
}
.sp-bottom-cta__btn-sec:hover { border-color: rgba(255,255,255,.5); color: #fff; }

/* ── Hero split (text + image) ── */
.sp-hero-split { display: grid; grid-template-columns: 1fr 42%; min-height: 440px; }
.sp-hero-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3rem; padding-right: 3rem; }
.sp-hero-split__img { position: relative; overflow: hidden; }
.sp-hero-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.sp-hero-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) {
    .sp-hero-split { display: block; }
    .sp-hero-split__text { padding-right: 0; padding-bottom: 2rem; }
    .sp-hero-split__img { height: 260px; position: relative; }
    .sp-hero-split__img img { position: absolute; }
    .sp-hero-split__img::before { display: none; }
}

/* ── Responsive ── */
@media (max-width: 900px) {
    .sp-grid { grid-template-columns: 1fr; }
    .sp-sidebar { position: static; }
    .sp-related-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 640px) {
    .sp-hero { padding: calc(64px + 2.5rem) 0 2rem; }
    .sp-article__body { padding: 1.25rem; }
    .sp-related-grid { grid-template-columns: 1fr; }
    .sp-bottom-cta__inner { flex-direction: column; align-items: flex-start; }
    .sp-bottom-cta__btns { width: 100%; }
    .sp-bottom-cta__btn-primary,
    .sp-bottom-cta__btn-sec { flex: 1; justify-content: center; }
}
</style>

<!-- Progress bar -->
<div id="sp-progress" role="progressbar" aria-hidden="true"></div>

<!-- ================================================
     HERO
================================================ -->
<section class="sp-hero" style="padding-bottom:0;">
    <div class="sp-hero-split">
    <div class="sp-hero-split__text" style="padding-top:calc(64px + 3.5rem);">
    <div class="container" style="max-width:none;padding-right:0;">

        <!-- Breadcrumbs -->
        <nav class="sp-breadcrumbs" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span class="sep">›</span>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
            <?php if ($post_cat): ?>
            <span class="sep">›</span>
            <a href="<?php echo esc_url(get_term_link($post_cat)); ?>"><?php echo esc_html($post_cat->name); ?></a>
            <?php endif; ?>
            <span class="sep">›</span>
            <span><?php echo esc_html(wp_trim_words(get_the_title(), 6)); ?></span>
        </nav>

        <!-- Category -->
        <?php if ($post_cat): ?>
        <a href="<?php echo esc_url(get_term_link($post_cat)); ?>" class="sp-hero__cat">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="7" height="7" rx="1" fill="currentColor"/><rect x="14" y="3" width="7" height="7" rx="1" fill="currentColor"/><rect x="3" y="14" width="7" height="7" rx="1" fill="currentColor"/><rect x="14" y="14" width="7" height="7" rx="1" fill="currentColor"/></svg>
            <?php echo esc_html($post_cat->name); ?>
        </a>
        <?php endif; ?>

        <!-- Title -->
        <h1 class="sp-hero__title"><?php the_title(); ?></h1>

        <!-- Meta -->
        <div class="sp-hero__meta">
            <span class="sp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
            </span>
            <span class="sp-hero__meta-divider">·</span>
            <span class="sp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 6V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <?php echo $read_time; ?> min read
            </span>
            <span class="sp-hero__meta-divider">·</span>
            <span class="sp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 3a4 4 0 100 8 4 4 0 000-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <?php echo get_the_author(); ?>
            </span>
        </div>

    </div><!-- /.sp-hero-split__text /.container -->
    </div><!-- /.sp-hero-split__text -->

    <!-- Right: featured image or fallback kitchen photo -->
    <div class="sp-hero-split__img">
        <?php
        $feat_img = get_post_meta($id, '_post_image_url', true);
        if (!$feat_img && has_post_thumbnail($id)) $feat_img = get_the_post_thumbnail_url($id, 'large');
        if (!$feat_img) $feat_img = get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg';
        ?>
        <img src="<?php echo esc_url($feat_img); ?>"
             alt="<?php echo esc_attr(get_the_title()); ?>"
             loading="eager">
    </div><!-- /.sp-hero-split__img -->

    </div><!-- /.sp-hero-split -->
</section>

<!-- ================================================
     MAIN LAYOUT
================================================ -->
<div class="sp-layout">
    <div class="container">
        <div class="sp-grid">

            <!-- ── ARTICLE ── -->
            <article class="sp-article" id="sp-article" itemscope itemtype="https://schema.org/BlogPosting">
                <meta itemprop="headline" content="<?php echo esc_attr(get_the_title()); ?>">
                <meta itemprop="datePublished" content="<?php echo get_the_date('c'); ?>">

                <!-- Featured image -->
                <div class="sp-feat-img">
                    <?php
                    $feat_img_url = get_post_meta($id, '_post_image_url', true);
                    $feat_img_alt = get_post_meta($id, '_post_image_alt', true) ?: get_the_title();
                    ?>
                    <?php if ($feat_img_url): ?>
                        <img src="<?php echo esc_url($feat_img_url); ?>"
                             alt="<?php echo esc_attr($feat_img_alt); ?>"
                             itemprop="image"
                             loading="eager">
                    <?php elseif (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('large', ['alt' => esc_attr($feat_img_alt), 'itemprop' => 'image']); ?>
                    <?php else: ?>
                        <div class="sp-feat-img-placeholder">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="#0D0D0D" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Article body -->
                <div class="sp-article__body">

                    <!-- TOC -->
                    <?php if (count($toc) > 2): ?>
                    <nav class="sp-toc" aria-label="Table of contents" id="sp-toc">
                        <p class="sp-toc__title">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M8 6H21M8 12H21M8 18H21M3 6H3.01M3 12H3.01M3 18H3.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            In This Article
                        </p>
                        <ol class="sp-toc__list">
                            <?php
                            $h2n = 0;
                            foreach ($toc as $item):
                                if ($item['level'] === 2) $h2n++;
                            ?>
                            <li class="sp-toc__item">
                                <a href="#<?php echo esc_attr($item['anchor']); ?>"
                                   class="sp-toc__link <?php echo $item['level'] === 3 ? 'sp-toc__link--h3' : ''; ?>">
                                    <?php if ($item['level'] === 2): ?><span class="sp-toc__num"><?php echo $h2n; ?>.</span><?php endif; ?>
                                    <?php echo esc_html($item['text']); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                    <?php endif; ?>

                    <!-- Content -->
                    <div class="sp-content" itemprop="articleBody">
                        <?php echo $content; ?>
                    </div>

                    <!-- Post footer: tags -->
                    <?php if ($post_tags): ?>
                    <div class="sp-post-footer">
                        <div class="sp-tags">
                            <span class="sp-tags__label">Tagged:</span>
                            <?php foreach ($post_tags as $tag): ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="sp-tag"><?php echo esc_html($tag->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Related posts -->
                    <?php if ($related_posts): ?>
                    <div class="sp-related">
                        <h2 class="sp-related__heading">Related Articles</h2>
                        <div class="sp-related-grid">
                            <?php foreach ($related_posts as $rp):
                                $rp_cats  = get_the_terms($rp->ID, 'blog_category');
                                $rp_cat   = ($rp_cats && !is_wp_error($rp_cats)) ? $rp_cats[0]->name : '';
                                $rp_img   = get_post_meta($rp->ID, '_post_image_url', true);
                                $rp_alt   = get_post_meta($rp->ID, '_post_image_alt', true) ?: get_the_title($rp->ID);
                            ?>
                            <a href="<?php echo esc_url(get_permalink($rp->ID)); ?>" class="sp-related-card">
                                <div class="sp-related-card__img">
                                    <?php if ($rp_img): ?>
                                        <img src="<?php echo esc_url($rp_img); ?>"
                                             alt="<?php echo esc_attr($rp_alt); ?>"
                                             loading="lazy">
                                    <?php elseif (has_post_thumbnail($rp->ID)): ?>
                                        <?php echo get_the_post_thumbnail($rp->ID, 'card', ['alt' => esc_attr($rp_alt)]); ?>
                                    <?php else: ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="var(--color-border-dark)" stroke-width="2" stroke-linecap="round"/></svg>
                                    <?php endif; ?>
                                </div>
                                <div class="sp-related-card__body">
                                    <?php if ($rp_cat): ?><p class="sp-related-card__cat"><?php echo esc_html($rp_cat); ?></p><?php endif; ?>
                                    <h3 class="sp-related-card__title"><?php echo esc_html(get_the_title($rp->ID)); ?></h3>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div><!-- /.sp-article__body -->
            </article>

            <!-- ── SIDEBAR ── -->
            <aside class="sp-sidebar" aria-label="Post sidebar">

                <!-- CTA -->
                <div class="sp-cta-card">
                    <h3 class="sp-cta-card__title">Need a Repair?</h3>
                    <p class="sp-cta-card__text">Same-day service available. 30-day warranty on every repair.</p>
                    <a href="<?php echo esc_url($phone_link); ?>" class="sp-cta-card__phone">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031 -0.024 5.24039 0.04 1.70001C0.04 1.14594 0.249 0.612295 0.627 0.234492C1.005 -0.143311 1.539 -0.352821 2.093 -0.352821H5.093C6.107 -0.362986 6.966 0.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="/schedule/" class="sp-cta-card__btn">Schedule Online</a>
                </div>

                <!-- Categories -->
                <?php
                $all_cats = get_terms(['taxonomy' => 'blog_category', 'hide_empty' => true]);
                if ($all_cats && !is_wp_error($all_cats)):
                ?>
                <div class="sp-sb-card">
                    <div class="sp-sb-card__head">
                        <p class="sp-sb-card__title">Browse Topics</p>
                    </div>
                    <div class="sp-sb-card__body">
                        <nav class="sp-sb-cats">
                            <?php foreach ($all_cats as $c):
                                $is_cur = $post_cat && ($c->term_id === $post_cat->term_id);
                            ?>
                            <a href="<?php echo esc_url(get_term_link($c)); ?>"
                               class="sp-sb-cat <?php echo $is_cur ? 'current' : ''; ?>">
                                <span class="sp-sb-cat__name"><span class="sp-sb-cat__dot"></span><?php echo esc_html($c->name); ?></span>
                                <span class="sp-sb-cat__count"><?php echo $c->count; ?></span>
                            </a>
                            <?php endforeach; ?>
                        </nav>
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
<section class="sp-bottom-cta">
    <div class="container">
        <div class="sp-bottom-cta__inner">
            <div>
                <h2 class="sp-bottom-cta__title">Ready to Book a Repair?</h2>
                <p class="sp-bottom-cta__sub">Certified technicians. Same-day service. 30-day warranty.</p>
            </div>
            <div class="sp-bottom-cta__btns">
                <a href="<?php echo esc_url($phone_link); ?>" class="sp-bottom-cta__btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031 -0.024 5.24039 0.04 1.70001C0.04 1.14594 0.249 0.612295 0.627 0.234492C1.005 -0.143311 1.539 -0.352821 2.093 -0.352821H5.093C6.107 -0.362986 6.966 0.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                    <?php echo esc_html($phone); ?>
                </a>
                <a href="/schedule/" class="sp-bottom-cta__btn-sec">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Schedule Online
                </a>
            </div>
        </div>
    </div>
</section>

<?php ar_appointment_form('blog-post', 'Book Your Repair Appointment'); ?>

<script>
(function() {
    // Reading progress bar
    var bar = document.getElementById('sp-progress');
    var art = document.getElementById('sp-article');
    if (!bar || !art) return;
    function updateProg() {
        var rect = art.getBoundingClientRect();
        var pct  = Math.min(100, Math.max(0, (-rect.top / (art.offsetHeight - window.innerHeight)) * 100));
        bar.style.width = pct + '%';
    }
    window.addEventListener('scroll', updateProg, { passive: true });
    updateProg();

    // TOC smooth scroll
    document.querySelectorAll('.sp-toc__link').forEach(function(l) {
        l.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                var el = document.getElementById(href.slice(1));
                if (el) {
                    window.scrollTo({ top: el.getBoundingClientRect().top + window.pageYOffset - 90, behavior: 'smooth' });
                    history.pushState(null, '', href);
                }
            }
        });
    });

    // TOC active highlight
    var tocLinks = document.querySelectorAll('.sp-toc__link');
    if (tocLinks.length) {
        var hds = Array.from(document.querySelectorAll('.sp-content h2[id], .sp-content h3[id]'));
        function hlToc() {
            var sy = window.scrollY + 110;
            var active = hds[0];
            hds.forEach(function(h) { if (h.offsetTop <= sy) active = h; });
            tocLinks.forEach(function(l) { l.style.color = ''; l.style.background = ''; l.style.fontWeight = ''; });
            if (active) {
                var al = document.querySelector('.sp-toc__link[href="#' + active.id + '"]');
                if (al) { al.style.color = 'var(--color-primary)'; al.style.background = 'var(--color-bg-section)'; al.style.fontWeight = '600'; }
            }
        }
        window.addEventListener('scroll', hlToc, { passive: true });
        hlToc();
    }
})();
</script>

<?php get_footer(); ?>