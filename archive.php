<?php
/**
 * archive.php — Blog category / tag / date archives
 * URL: /blog/category/{slug}/ | /tag/{slug}/ | /YYYY/MM/
 */
defined('ABSPATH') || exit;

$phone      = ar_get_phone();
$phone_link = ar_phone_link();

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
   BLOG ARCHIVE — Scoped Styles (reuses bl-* where possible)
================================================ */

.ba-hero {
    background: #1B3A6B;
    padding: 3.5rem 0 0;
    position: relative;
    overflow: hidden;
}
.ba-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 55% 60% at 90% 0%, rgba(27,58,107,.18) 0%, transparent 65%);
    pointer-events: none;
}

.ba-breadcrumbs {
    display: flex;
    align-items: center;
    gap: .375rem;
    flex-wrap: wrap;
    margin-bottom: 1.75rem;
    font-size: .8125rem;
    color: rgba(255,255,255,.4);
    position: relative;
}
.ba-breadcrumbs a { color: rgba(255,255,255,.55); text-decoration: none; transition: color var(--transition-fast); }
.ba-breadcrumbs a:hover { color: #fff; }
.ba-breadcrumbs .sep { color: rgba(255,255,255,.2); }

.ba-hero__content { position: relative; padding-bottom: 2.5rem; }

.ba-hero__label {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: rgba(27,58,107,.2);
    border: 1px solid rgba(27,58,107,.35);
    color: #fca5a5;
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: .3rem .8rem;
    border-radius: var(--radius-full);
    margin-bottom: 1rem;
}
.ba-hero__title {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4vw, 2.75rem);
    color: #fff;
    line-height: 1.15;
    margin: 0 0 .875rem;
}
.ba-hero__sub {
    font-size: 1rem;
    color: rgba(255,255,255,.5);
    margin: 0 0 1.5rem;
    max-width: 540px;
    line-height: 1.65;
}
.ba-hero__meta {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    font-size: .8125rem;
    color: rgba(255,255,255,.45);
}
.ba-hero__meta-item { display: flex; align-items: center; gap: .375rem; }

/* Category tabs */
.ba-cats {
    background: rgba(255,255,255,.04);
    border-top: 1px solid rgba(255,255,255,.08);
    position: relative;
}
.ba-cats__inner {
    display: flex;
    overflow-x: auto;
    scrollbar-width: none;
    padding: 0 2rem;
    max-width: var(--container-max);
    margin: 0 auto;
}
.ba-cats__inner::-webkit-scrollbar { display: none; }
.ba-cat-tab {
    display: flex;
    align-items: center;
    gap: .4rem;
    padding: .875rem 1.125rem;
    color: rgba(255,255,255,.45);
    text-decoration: none;
    font-size: .8125rem;
    font-weight: 500;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
    flex-shrink: 0;
    transition: color var(--transition-fast), border-color var(--transition-fast);
}
.ba-cat-tab:hover { color: rgba(255,255,255,.8); border-bottom-color: rgba(255,255,255,.2); }
.ba-cat-tab.active { color: #fff; border-bottom-color: var(--color-accent); }
.ba-cat-tab__count {
    background: rgba(255,255,255,.1);
    font-size: .625rem;
    font-weight: 700;
    padding: .125rem .4rem;
    border-radius: var(--radius-full);
}
.ba-cat-tab.active .ba-cat-tab__count { background: var(--color-accent); }

/* ── Layout ── */
.ba-main { background: var(--color-bg-light); padding: 3rem 0 5rem; }
.ba-grid { display: grid; grid-template-columns: 1fr 300px; gap: 2.5rem; align-items: start; }

/* Section title */
.ba-section-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}
.ba-section-title__text {
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    display: flex;
    align-items: center;
    gap: .5rem;
}
.ba-section-title__text::before {
    content: '';
    display: block;
    width: 3px;
    height: 1em;
    background: var(--color-accent);
    border-radius: 2px;
}
.ba-count { font-size: .875rem; color: var(--color-text-muted); }

/* Post grid */
.ba-posts-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }

/* Post card */
.ba-card {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    transition: box-shadow var(--transition-base), border-color var(--transition-base), transform var(--transition-base);
}
.ba-card:hover { box-shadow: var(--shadow-lg); border-color: rgba(27,58,107,.2); transform: translateY(-2px); text-decoration: none; }
.ba-card__img {
    aspect-ratio: 16/9;
    width: 100%;
    background: var(--color-bg-section);
    flex-shrink: 0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ba-card__img img { max-width: 100%; max-height: 100%; width: auto; height: auto; display: block; object-fit: contain; }
.ba-card__body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
.ba-card__cat {
    display: inline-block;
    background: var(--color-accent-light);
    color: var(--color-accent);
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    padding: .25rem .625rem;
    border-radius: var(--radius-full);
    margin-bottom: .75rem;
    align-self: flex-start;
}
.ba-card__title { font-size: 1rem; font-weight: 700; color: var(--color-text-body); line-height: 1.4; margin: 0 0 .625rem; }
.ba-card:hover .ba-card__title { color: var(--color-accent); }
.ba-card__excerpt { font-size: .875rem; color: var(--color-text-muted); line-height: 1.6; margin: 0 0 1rem; flex: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.ba-card__footer { display: flex; align-items: center; justify-content: space-between; padding-top: .875rem; border-top: 1px solid var(--color-border); margin-top: auto; }
.ba-card__meta { display: flex; align-items: center; gap: .875rem; font-size: .75rem; color: var(--color-text-light); }
.ba-card__meta-item { display: flex; align-items: center; gap: .3rem; }
.ba-card__read { font-size: .75rem; font-weight: 600; color: var(--color-accent); display: flex; align-items: center; gap: .25rem; }

/* Empty */
.ba-empty { background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius-xl); padding: 3rem; text-align: center; }
.ba-empty__icon { width: 64px; height: 64px; background: var(--color-bg-section); border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; }
.ba-empty__title { font-size: 1.25rem; font-weight: 700; color: var(--color-text-body); margin: 0 0 .5rem; }
.ba-empty__text { font-size: .9375rem; color: var(--color-text-muted); margin: 0; }

/* Pagination */
.ba-pagination { display: flex; align-items: center; justify-content: center; gap: .5rem; margin-top: 2.5rem; flex-wrap: wrap; }
.ba-pagination .page-numbers { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: .875rem; font-weight: 600; color: var(--color-text-muted); text-decoration: none; transition: all var(--transition-fast); background: #fff; }
.ba-pagination .page-numbers:hover, .ba-pagination .page-numbers.current { background: var(--color-accent); border-color: var(--color-accent); color: #fff; }
.ba-pagination .page-numbers.dots { border: none; background: none; cursor: default; }

/* Sidebar */
.ba-sidebar { position: sticky; top: 90px; display: flex; flex-direction: column; gap: 1.25rem; }

.ba-cta-card { background: var(--color-primary-dark); border-radius: var(--radius-xl); padding: 1.75rem 1.5rem; }
.ba-cta-card__title { font-family: var(--font-display); font-size: 1.25rem; color: #fff; margin: 0 0 .5rem; line-height: 1.25; }
.ba-cta-card__text { font-size: .8125rem; color: rgba(255,255,255,.55); line-height: 1.6; margin: 0 0 1.25rem; }
.ba-cta-card__phone { display: flex; align-items: center; justify-content: center; gap: .5rem; background: var(--color-accent); color: #fff; font-size: 1rem; font-weight: 700; padding: .8125rem; border-radius: var(--radius-lg); text-decoration: none; margin-bottom: .75rem; transition: background var(--transition-fast); }
.ba-cta-card__phone:hover { background: var(--color-accent-dark); color: #fff; }
.ba-cta-card__schedule { display: block; text-align: center; background: rgba(255,255,255,.08); color: rgba(255,255,255,.8); font-size: .8125rem; font-weight: 600; padding: .6875rem; border-radius: var(--radius-lg); text-decoration: none; transition: background var(--transition-fast); }
.ba-cta-card__schedule:hover { background: rgba(255,255,255,.15); color: #fff; }

.ba-sb-card { background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius-xl); overflow: hidden; }
.ba-sb-card__head { padding: 1rem 1.25rem .875rem; border-bottom: 1px solid var(--color-border); }
.ba-sb-card__title { font-size: .6875rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--color-text-muted); margin: 0; }
.ba-sb-card__body { padding: .75rem 1.25rem 1.25rem; }

.ba-cat-list { display: flex; flex-direction: column; gap: .125rem; }
.ba-cat-list__link { display: flex; align-items: center; justify-content: space-between; padding: .5625rem .625rem; border-radius: var(--radius-md); text-decoration: none; transition: background var(--transition-fast); }
.ba-cat-list__link:hover { background: var(--color-bg-light); text-decoration: none; }
.ba-cat-list__link.current { background: rgba(27,58,107,.05); }
.ba-cat-list__name { font-size: .875rem; color: var(--color-text-body); font-weight: 500; display: flex; align-items: center; gap: .5rem; }
.ba-cat-list__link.current .ba-cat-list__name { color: var(--color-accent); }
.ba-cat-list__dot { width: 6px; height: 6px; background: var(--color-border-dark); border-radius: 50%; }
.ba-cat-list__link.current .ba-cat-list__dot { background: var(--color-accent); }
.ba-cat-list__count { font-size: .75rem; font-weight: 600; color: var(--color-text-light); background: var(--color-bg-section); padding: .125rem .5rem; border-radius: var(--radius-full); }

/* ── Responsive ── */
@media (max-width: 900px) { .ba-grid { grid-template-columns: 1fr; } .ba-sidebar { position: static; display: grid; grid-template-columns: 1fr 1fr; } .ba-posts-grid { grid-template-columns: 1fr; } }
@media (max-width: 640px) { .ba-hero { padding: 2.5rem 0 0; } .ba-sidebar { grid-template-columns: 1fr; } .ba-cats__inner { padding: 0 1rem; } }
</style>

<!-- ================================================
     HERO
================================================ -->
<section class="ba-hero">
    <div class="container">

        <!-- Breadcrumbs -->
        <nav class="ba-breadcrumbs" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span class="sep">›</span>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
            <?php if (!is_home()): ?>
            <span class="sep">›</span>
            <span><?php echo wp_strip_all_tags($arch_title); ?></span>
            <?php endif; ?>
        </nav>

        <div class="ba-hero__content">
            <div class="ba-hero__label">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M4 6H20M4 12H20M4 18H12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
                <?php echo esc_html($arch_label); ?>
            </div>
            <h1 class="ba-hero__title"><?php echo $arch_title; ?></h1>
            <p class="ba-hero__sub"><?php echo esc_html($arch_sub); ?></p>
            <div class="ba-hero__meta">
                <span class="ba-hero__meta-item">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    <?php echo $total_found; ?> article<?php echo $total_found !== 1 ? 's' : ''; ?>
                </span>
                <span>·</span>
                <a href="<?php echo esc_url($back_url); ?>" style="color:rgba(255,255,255,.45);text-decoration:none;display:flex;align-items:center;gap:.3rem;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    All Articles
                </a>
            </div>
        </div>

    </div>

    <!-- Category tabs -->
    <div class="ba-cats">
        <div class="ba-cats__inner">
            <a href="<?php echo esc_url(home_url('/blog/')); ?>"
               class="ba-cat-tab <?php echo !$current_slug ? 'active' : ''; ?>">
                All Posts
            </a>
            <?php if (!is_wp_error($blog_cats) && $blog_cats): foreach ($blog_cats as $cat): ?>
            <a href="<?php echo esc_url(get_term_link($cat)); ?>"
               class="ba-cat-tab <?php echo ($current_slug === $cat->slug) ? 'active' : ''; ?>">
                <?php echo esc_html($cat->name); ?>
                <span class="ba-cat-tab__count"><?php echo $cat->count; ?></span>
            </a>
            <?php endforeach; endif; ?>
        </div>
    </div>

</section>

<!-- ================================================
     MAIN
================================================ -->
<div class="ba-main">
    <div class="container">
        <div class="ba-grid">

            <!-- ── Posts ── -->
            <div>
                <div class="ba-section-title">
                    <span class="ba-section-title__text"><?php echo wp_strip_all_tags($arch_title); ?></span>
                    <span class="ba-count"><?php echo $total_found; ?> article<?php echo $total_found !== 1 ? 's' : ''; ?></span>
                </div>

                <?php if (have_posts()): ?>

                <div class="ba-posts-grid">
                    <?php while (have_posts()): the_post();
                        $p_cats = get_the_terms(get_the_ID(), 'blog_category');
                        $p_cat  = ($p_cats && !is_wp_error($p_cats)) ? $p_cats[0] : null;
                        $rt     = max(1, ceil(str_word_count(strip_tags(get_the_content())) / 200));
                    ?>
                    <a href="<?php the_permalink(); ?>" class="ba-card">
                        <div class="ba-card__img">
                            <?php
                            $post_id   = get_the_ID();
                            $meta_url  = get_post_meta($post_id, '_post_image_url', true);
                            $meta_alt  = get_post_meta($post_id, '_post_image_alt', true) ?: get_the_title();
                            if ($meta_url): ?>
                                <img src="<?php echo esc_url($meta_url); ?>" alt="<?php echo esc_attr($meta_alt); ?>" width="800" height="450" loading="lazy">
                            <?php elseif (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('card', ['alt' => get_the_title()]); ?>
                            <?php else: ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="var(--color-border-dark)" stroke-width="2" stroke-linecap="round"/></svg>
                            <?php endif; ?>
                        </div>
                        <div class="ba-card__body">
                            <?php if ($p_cat): ?>
                            <span class="ba-card__cat"><?php echo esc_html($p_cat->name); ?></span>
                            <?php endif; ?>
                            <h2 class="ba-card__title"><?php the_title(); ?></h2>
                            <p class="ba-card__excerpt"><?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 22); ?></p>
                            <div class="ba-card__footer">
                                <div class="ba-card__meta">
                                    <span class="ba-card__meta-item">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                        <?php echo get_the_date('M j, Y'); ?>
                                    </span>
                                    <span class="ba-card__meta-item">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 6V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                        <?php echo $rt; ?> min
                                    </span>
                                </div>
                                <span class="ba-card__read">Read <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M13 6L19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                            </div>
                        </div>
                    </a>
                    <?php endwhile; ?>
                </div>

                <div class="ba-pagination">
                    <?php echo paginate_links(['prev_text' => '←', 'next_text' => '→', 'type' => 'list']); ?>
                </div>

                <?php else: ?>
                <div class="ba-empty">
                    <div class="ba-empty__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round"/></svg>
                    </div>
                    <h2 class="ba-empty__title">No articles yet</h2>
                    <p class="ba-empty__text">Check back soon, or <a href="<?php echo esc_url(home_url('/blog/')); ?>">browse all articles</a>.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- ── Sidebar ── -->
            <aside class="ba-sidebar" aria-label="Blog sidebar">

                <div class="ba-cta-card">
                    <h3 class="ba-cta-card__title">Need a Repair?</h3>
                    <p class="ba-cta-card__text">Same-day service. 30-day warranty. Viking specialists.</p>
                    <a href="<?php echo esc_url($phone_link); ?>" class="ba-cta-card__phone">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031 -0.024 5.24039 0.04 1.70001C0.04 1.14594 0.249 0.612295 0.627 0.234492C1.005 -0.143311 1.539 -0.352821 2.093 -0.352821H5.093C6.107 -0.362986 6.966 0.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="/schedule/" class="ba-cta-card__schedule">Schedule Online</a>
                </div>

                <?php if (!is_wp_error($blog_cats) && $blog_cats): ?>
                <div class="ba-sb-card">
                    <div class="ba-sb-card__head"><p class="ba-sb-card__title">Browse Topics</p></div>
                    <div class="ba-sb-card__body">
                        <nav class="ba-cat-list">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"
                               class="ba-cat-list__link <?php echo !$current_slug ? 'current' : ''; ?>">
                                <span class="ba-cat-list__name"><span class="ba-cat-list__dot"></span>All Articles</span>
                                <span class="ba-cat-list__count"><?php echo wp_count_posts('post')->publish; ?></span>
                            </a>
                            <?php foreach ($blog_cats as $cat): ?>
                            <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                               class="ba-cat-list__link <?php echo ($current_slug === $cat->slug) ? 'current' : ''; ?>">
                                <span class="ba-cat-list__name"><span class="ba-cat-list__dot"></span><?php echo esc_html($cat->name); ?></span>
                                <span class="ba-cat-list__count"><?php echo $cat->count; ?></span>
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

<?php ar_appointment_form('blog-archive', 'Need Appliance Repair?'); ?>

<?php get_footer(); ?>
