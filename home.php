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
   BLOG HOME — Scoped Styles
================================================ */

/* ── Hero ── */
.bl-hero {
    background: var(--color-primary-dark);
    padding: 3.5rem 0 0;
    position: relative;
    overflow: hidden;
}
.bl-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 50% 60% at 80% -10%, rgba(27,58,107,.2) 0%, transparent 65%),
        radial-gradient(ellipse 30% 40% at 5% 100%, rgba(27,58,107,.08) 0%, transparent 60%);
    pointer-events: none;
}
.bl-hero__inner {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
    padding-bottom: 2.5rem;
}
.bl-hero__kicker {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: #fca5a5;
    background: rgba(27,58,107,.2);
    border: 1px solid rgba(27,58,107,.35);
    padding: .3125rem .875rem;
    border-radius: var(--radius-full);
    margin-bottom: 1.25rem;
}
.bl-hero__title {
    font-family: var(--font-display);
    font-size: clamp(2.25rem, 4.5vw, 3.25rem);
    color: #fff;
    line-height: 1.1;
    margin: 0 0 1rem;
}
.bl-hero__sub {
    font-size: 1.0625rem;
    color: rgba(255,255,255,.55);
    line-height: 1.65;
    margin: 0 0 1.75rem;
    max-width: 440px;
}
.bl-hero__stats {
    display: flex;
    gap: 1.75rem;
    flex-wrap: wrap;
}
.bl-hero__stat { text-align: center; }
.bl-hero__stat-num {
    font-family: var(--font-display);
    font-size: 1.75rem;
    color: #fff;
    display: block;
    line-height: 1;
}
.bl-hero__stat-label {
    font-size: .75rem;
    color: rgba(255,255,255,.45);
    text-transform: uppercase;
    letter-spacing: .06em;
    display: block;
    margin-top: .25rem;
}

/* Featured card in hero */
.bl-hero__featured {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: var(--radius-xl);
    overflow: hidden;
    position: relative;
    text-decoration: none;
    display: block;
    transition: border-color var(--transition-base), transform var(--transition-base);
}
.bl-hero__featured:hover {
    border-color: rgba(27,58,107,.5);
    transform: translateY(-2px);
    text-decoration: none;
}
.bl-hero__feat-img {
    aspect-ratio: 16/9;
    background: linear-gradient(135deg, #162843 0%, #0d1b2e 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.bl-hero__feat-img img { width: 100%; height: 100%; object-fit: cover; }
.bl-hero__feat-img-placeholder {
    width: 56px; height: 56px;
    background: rgba(27,58,107,.2);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
}
.bl-hero__feat-body { padding: 1.5rem; }
.bl-hero__feat-cat {
    display: inline-block;
    background: var(--color-accent);
    color: #fff;
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .25rem .625rem;
    border-radius: var(--radius-full);
    margin-bottom: .875rem;
}
.bl-hero__feat-title {
    font-family: var(--font-display);
    font-size: 1.1875rem;
    color: #fff;
    line-height: 1.3;
    margin: 0 0 .625rem;
}
.bl-hero__feat-meta {
    display: flex;
    gap: 1rem;
    font-size: .75rem;
    color: rgba(255,255,255,.4);
}
.bl-hero__feat-badge {
    position: absolute;
    top: 1rem; left: 1rem;
    background: rgba(27,58,107,.9);
    color: #fff;
    font-size: .6875rem;
    font-weight: 700;
    padding: .25rem .625rem;
    border-radius: var(--radius-full);
    backdrop-filter: blur(4px);
}

/* ── Category tabs ── */
.bl-cats {
    background: rgba(255,255,255,.04);
    border-top: 1px solid rgba(255,255,255,.08);
    position: relative;
}
.bl-cats__inner {
    display: flex;
    gap: 0;
    overflow-x: auto;
    scrollbar-width: none;
    padding: 0 2rem;
    max-width: var(--container-max);
    margin: 0 auto;
}
.bl-cats__inner::-webkit-scrollbar { display: none; }
.bl-cat-tab {
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
.bl-cat-tab:hover { color: rgba(255,255,255,.8); border-bottom-color: rgba(255,255,255,.2); }
.bl-cat-tab.active { color: #fff; border-bottom-color: var(--color-accent); }
.bl-cat-tab__count {
    background: rgba(255,255,255,.1);
    font-size: .625rem;
    font-weight: 700;
    padding: .125rem .4rem;
    border-radius: var(--radius-full);
}
.bl-cat-tab.active .bl-cat-tab__count { background: var(--color-accent); }

/* ── Main layout ── */
.bl-main {
    background: var(--color-bg-light);
    padding: 3rem 0 5rem;
}
.bl-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2.5rem;
    align-items: start;
}

/* ── Section title ── */
.bl-section-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #0d1b2e 0%, #162843 100%);
    border-radius: var(--radius-lg);
    padding: .875rem 1.25rem;
    border-left: 4px solid var(--color-accent);
    box-shadow: 0 2px 8px rgba(0,0,0,.18), inset 0 1px 0 rgba(255,255,255,.06);
}
.bl-section-title__heading {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: #fff;
    display: flex;
    align-items: center;
    gap: .625rem;
}
.bl-section-title__heading::before { display: none; }
.bl-section-title__more {
    font-size: .8125rem;
    color: var(--color-accent);
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: .25rem;
    transition: opacity .15s;
}
.bl-section-title__more:hover { opacity: .75; text-decoration: none; }

/* ── Post cards grid ── */
.bl-posts-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}

/* Post card */
.bl-card {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow var(--transition-base), border-color var(--transition-base), transform var(--transition-base);
    text-decoration: none;
}
.bl-card:hover {
    box-shadow: var(--shadow-lg);
    border-color: rgba(27,58,107,.2);
    transform: translateY(-2px);
    text-decoration: none;
}
.bl-card__img {
    aspect-ratio: 16/9;
    width: 100%;
    background: var(--color-bg-section);
    flex-shrink: 0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bl-card__img img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: center;
}

.bl-card__img-icon {
    width: 44px; height: 44px;
    background: rgba(27,58,107,.1);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
}
.bl-card__body {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.bl-card__cat {
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
.bl-card__title {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-text-body);
    line-height: 1.4;
    margin: 0 0 .625rem;
}
.bl-card:hover .bl-card__title { color: var(--color-accent); }
.bl-card__excerpt {
    font-size: .875rem;
    color: var(--color-text-muted);
    line-height: 1.6;
    margin: 0 0 1rem;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.bl-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: .875rem;
    border-top: 1px solid var(--color-border);
    margin-top: auto;
}
.bl-card__meta {
    display: flex;
    align-items: center;
    gap: .875rem;
    font-size: .75rem;
    color: var(--color-text-light);
}
.bl-card__meta-item {
    display: flex;
    align-items: center;
    gap: .3rem;
}
.bl-card__read {
    font-size: .75rem;
    font-weight: 600;
    color: var(--color-accent);
    display: flex;
    align-items: center;
    gap: .25rem;
}

/* ── Pagination ── */
.bl-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    margin-top: 2.5rem;
    flex-wrap: wrap;
}
.bl-pagination .page-numbers {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px; height: 40px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    font-size: .875rem;
    font-weight: 600;
    color: var(--color-text-muted);
    text-decoration: none;
    transition: all var(--transition-fast);
    background: #fff;
}
.bl-pagination .page-numbers:hover,
.bl-pagination .page-numbers.current {
    background: var(--color-accent);
    border-color: var(--color-accent);
    color: #fff;
}
.bl-pagination .page-numbers.dots { border: none; background: none; cursor: default; }

/* Empty state */
.bl-empty {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: 3rem;
    text-align: center;
}
.bl-empty__icon {
    width: 64px; height: 64px;
    background: var(--color-bg-section);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
}
.bl-empty__title {
    font-family: var(--font-heading);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--color-text-body);
    margin: 0 0 .5rem;
}
.bl-empty__text {
    font-size: .9375rem;
    color: var(--color-text-muted);
    margin: 0;
}

/* ── Sidebar ── */
.bl-sidebar {
    position: sticky;
    top: 90px;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

/* CTA card */
.bl-cta-card {
    background: var(--color-primary-dark);
    border-radius: var(--radius-xl);
    padding: 1.75rem 1.5rem;
}
.bl-cta-card__title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    color: #fff;
    margin: 0 0 .5rem;
    line-height: 1.25;
}
.bl-cta-card__text {
    font-size: .8125rem;
    color: rgba(255,255,255,.55);
    line-height: 1.6;
    margin: 0 0 1.25rem;
}
.bl-cta-card__phone {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    background: var(--color-accent);
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    padding: .8125rem;
    border-radius: var(--radius-lg);
    text-decoration: none;
    margin-bottom: .75rem;
    transition: background var(--transition-fast);
}
.bl-cta-card__phone:hover { background: var(--color-accent-dark); color: #fff; }
.bl-cta-card__schedule {
    display: block;
    text-align: center;
    background: rgba(255,255,255,.08);
    color: rgba(255,255,255,.8);
    font-size: .8125rem;
    font-weight: 600;
    padding: .6875rem;
    border-radius: var(--radius-lg);
    text-decoration: none;
    transition: background var(--transition-fast);
}
.bl-cta-card__schedule:hover { background: rgba(255,255,255,.15); color: #fff; }

/* Sidebar card */
.bl-sb-card {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
}
.bl-sb-card__head {
    padding: 1rem 1.25rem .875rem;
    border-bottom: 1px solid var(--color-border);
}
.bl-sb-card__title {
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin: 0;
}
.bl-sb-card__body { padding: .75rem 1.25rem 1.25rem; }

/* Category list */
.bl-cat-list {
    display: flex;
    flex-direction: column;
    gap: .125rem;
}
.bl-cat-list__link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .5625rem .625rem;
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: background var(--transition-fast);
}
.bl-cat-list__link:hover { background: var(--color-bg-light); text-decoration: none; }
.bl-cat-list__link.current { background: rgba(27,58,107,.06); }
.bl-cat-list__name {
    font-size: .875rem;
    color: var(--color-text-body);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.bl-cat-list__link.current .bl-cat-list__name { color: var(--color-accent); }
.bl-cat-list__bullet {
    width: 6px; height: 6px;
    background: var(--color-border-dark);
    border-radius: 50%;
    flex-shrink: 0;
}
.bl-cat-list__link.current .bl-cat-list__bullet { background: var(--color-accent); }
.bl-cat-list__count {
    font-size: .75rem;
    font-weight: 600;
    color: var(--color-text-light);
    background: var(--color-bg-section);
    padding: .125rem .5rem;
    border-radius: var(--radius-full);
}

/* Recent post mini list */
.bl-recent-list { display: flex; flex-direction: column; gap: .875rem; }
.bl-recent-item { display: flex; gap: .875rem; align-items: flex-start; text-decoration: none; }
.bl-recent-item:hover .bl-recent-title { color: var(--color-accent); }
.bl-recent-thumb {
    width: 56px; height: 56px;
    border-radius: var(--radius-md);
    background: var(--color-bg-section);
    flex-shrink: 0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bl-recent-thumb img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
.bl-recent-title {
    font-size: .8125rem;
    font-weight: 600;
    color: var(--color-text-body);
    line-height: 1.4;
    margin: 0 0 .25rem;
    transition: color var(--transition-fast);
}
.bl-recent-date { font-size: .75rem; color: var(--color-text-light); }

/* ── Bottom CTA ── */
.bl-bottom-cta {
    background: var(--color-primary-dark);
    padding: 3.5rem 0;
}
.bl-bottom-cta__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    flex-wrap: wrap;
}
.bl-bottom-cta__title {
    font-family: var(--font-display);
    font-size: clamp(1.5rem, 3vw, 2rem);
    color: #fff;
    margin: 0 0 .375rem;
}
.bl-bottom-cta__sub { font-size: .9375rem; color: rgba(255,255,255,.5); margin: 0; }
.bl-bottom-cta__btns { display: flex; gap: .875rem; flex-wrap: wrap; }
.bl-bottom-cta__btn-primary {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--color-accent);
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    padding: .875rem 1.75rem;
    border-radius: var(--radius-lg);
    text-decoration: none;
    transition: background var(--transition-fast);
}
.bl-bottom-cta__btn-primary:hover { background: var(--color-accent-dark); color: #fff; }
.bl-bottom-cta__btn-sec {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: rgba(255,255,255,.1);
    color: rgba(255,255,255,.9);
    font-weight: 600;
    font-size: .9375rem;
    padding: .875rem 1.75rem;
    border-radius: var(--radius-lg);
    text-decoration: none;
    transition: background var(--transition-fast);
}
.bl-bottom-cta__btn-sec:hover { background: rgba(255,255,255,.18); color: #fff; }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .bl-hero__inner { grid-template-columns: 1fr; }
    .bl-hero__featured { display: none; }
}
@media (max-width: 900px) {
    .bl-grid { grid-template-columns: 1fr; }
    .bl-sidebar { position: static; display: grid; grid-template-columns: 1fr 1fr; }
    .bl-posts-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    .bl-hero { padding: 2.5rem 0 0; }
    .bl-sidebar { grid-template-columns: 1fr; }
    .bl-posts-grid { grid-template-columns: 1fr; }
    .bl-bottom-cta__inner { flex-direction: column; align-items: flex-start; }
    .bl-bottom-cta__btns { width: 100%; }
    .bl-bottom-cta__btn-primary,
    .bl-bottom-cta__btn-sec { flex: 1; justify-content: center; }
    .bl-cats__inner { padding: 0 1rem; }
}
</style>


<!-- ================================================
     MAIN CONTENT
================================================ -->
<div class="bl-main">
    <div class="container">
        <div class="bl-grid">

            <!-- ── Posts sectioned by appliance type ── -->
            <div>
                <?php
                if ( ! is_wp_error( $blog_cats ) && $blog_cats ):
                    $first = true;
                    foreach ( $blog_cats as $section_cat ):
                        $section_posts = get_posts([
                            'numberposts' => 4,
                            'post_status' => 'publish',
                            'tax_query'   => [[
                                'taxonomy' => 'blog_category',
                                'field'    => 'term_id',
                                'terms'    => $section_cat->term_id,
                            ]],
                        ]);
                        if ( ! $section_posts ) continue;
                ?>
                <div class="bl-section-title" <?php echo $first ? 'style="margin-top:2rem;"' : 'style="margin-top:2.5rem;"'; ?>>
                    <span class="bl-section-title__heading"><?php echo esc_html( $section_cat->name ); ?></span>
                    <a href="<?php echo esc_url( get_term_link( $section_cat ) ); ?>" class="bl-section-title__more">
                        View all
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M13 6L19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </a>
                </div>
                <div class="bl-posts-grid">
                    <?php foreach ( $section_posts as $sp ):
                        $wc       = str_word_count( strip_tags( get_post_field( 'post_content', $sp->ID ) ) );
                        $rt       = max( 1, ceil( $wc / 200 ) );
                        $card_img = get_post_meta( $sp->ID, '_post_image_url', true );
                        $card_alt = get_post_meta( $sp->ID, '_post_image_alt', true ) ?: get_the_title( $sp->ID );
                        $excerpt  = get_post_field( 'post_excerpt', $sp->ID ) ?: get_post_field( 'post_content', $sp->ID );
                    ?>
                    <a href="<?php echo esc_url( get_permalink( $sp->ID ) ); ?>" class="bl-card">
                        <div class="bl-card__img">
                            <?php if ( $card_img ): ?>
                                <img src="<?php echo esc_url( $card_img ); ?>"
                                     alt="<?php echo esc_attr( $card_alt ); ?>"
                                     loading="lazy">
                            <?php elseif ( has_post_thumbnail( $sp->ID ) ): ?>
                                <?php echo get_the_post_thumbnail( $sp->ID, 'card', [ 'alt' => esc_attr( $card_alt ) ] ); ?>
                            <?php else: ?>
                                <div class="bl-card__img-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round"/></svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="bl-card__body">
                            <span class="bl-card__cat"><?php echo esc_html( $section_cat->name ); ?></span>
                            <h2 class="bl-card__title"><?php echo esc_html( get_the_title( $sp->ID ) ); ?></h2>
                            <p class="bl-card__excerpt"><?php echo wp_trim_words( $excerpt, 22 ); ?></p>
                            <div class="bl-card__footer">
                                <div class="bl-card__meta">
                                    <span class="bl-card__meta-item">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                        <?php echo get_the_date( 'M j, Y', $sp->ID ); ?>
                                    </span>
                                    <span class="bl-card__meta-item">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 6V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                        <?php echo $rt; ?> min
                                    </span>
                                </div>
                                <span class="bl-card__read">
                                    Read
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M13 6L19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php
                        $first = false;
                    endforeach;
                else:
                ?>
                <div class="bl-empty">
                    <div class="bl-empty__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round"/></svg>
                    </div>
                    <h2 class="bl-empty__title">No articles yet</h2>
                    <p class="bl-empty__text">We're working on great content. Check back soon!</p>
                </div>
                <?php endif; ?>

            </div>

            <!-- ── Sidebar ── -->
            <aside class="bl-sidebar" aria-label="Blog sidebar">

                <!-- CTA -->
                <div class="bl-cta-card">
                    <h3 class="bl-cta-card__title">Need a Repair?</h3>
                    <p class="bl-cta-card__text">Same-day service. 30-day warranty. Viking specialists.</p>
                    <a href="<?php echo esc_url($phone_link); ?>" class="bl-cta-card__phone">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031 -0.024 5.24039 0.04 1.70001C0.04 1.14594 0.249 0.612295 0.627 0.234492C1.005 -0.143311 1.539 -0.352821 2.093 -0.352821H5.093C6.107 -0.362986 6.966 0.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="/schedule/" class="bl-cta-card__schedule">Schedule Online</a>
                </div>

                <!-- Categories -->
                <?php if (!is_wp_error($blog_cats) && $blog_cats): ?>
                <div class="bl-sb-card">
                    <div class="bl-sb-card__head">
                        <p class="bl-sb-card__title">Browse by Topic</p>
                    </div>
                    <div class="bl-sb-card__body">
                        <nav class="bl-cat-list" aria-label="Blog categories">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"
                               class="bl-cat-list__link current">
                                <span class="bl-cat-list__name"><span class="bl-cat-list__bullet"></span>All Articles</span>
                                <span class="bl-cat-list__count"><?php echo $published; ?></span>
                            </a>
                            <?php foreach ($blog_cats as $cat): ?>
                            <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                               class="bl-cat-list__link">
                                <span class="bl-cat-list__name"><span class="bl-cat-list__bullet"></span><?php echo esc_html($cat->name); ?></span>
                                <span class="bl-cat-list__count"><?php echo $cat->count; ?></span>
                            </a>
                            <?php endforeach; ?>
                        </nav>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Recent posts -->
                <?php
                $recent = get_posts(['numberposts' => 4, 'post_status' => 'publish']);
                if ($recent):
                ?>
                <div class="bl-sb-card">
                    <div class="bl-sb-card__head">
                        <p class="bl-sb-card__title">Recent Articles</p>
                    </div>
                    <div class="bl-sb-card__body">
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
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 20H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v4M15 17h6m-3-3v6" stroke="var(--color-border-dark)" stroke-width="2" stroke-linecap="round"/></svg>
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
                <h2 class="bl-bottom-cta__title">Need a Repair Right Now?</h2>
                <p class="bl-bottom-cta__sub">Certified technicians available today. 30-day warranty on all repairs.</p>
            </div>
            <div class="bl-bottom-cta__btns">
                <a href="<?php echo esc_url($phone_link); ?>" class="bl-bottom-cta__btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22.001 20.4785 21.793 21.0169 21.415 21.4217C21.037 21.8265 20.516 22.0672 19.96 22.1C16.423 21.7011 13.027 20.4773 10.05 18.53C7.275 16.7506 4.939 14.415 3.16 11.64C1.2 8.65031 -0.024 5.24039 0.04 1.70001C0.04 1.14594 0.249 0.612295 0.627 0.234492C1.005 -0.143311 1.539 -0.352821 2.093 -0.352821H5.093C6.107 -0.362986 6.966 0.342782 7.133 1.35001C7.273 2.20001 7.507 3.03001 7.833 3.82001C8.103 4.50029 7.934 5.27001 7.403 5.80001L6.103 7.10001C7.743 9.97385 10.199 12.43 13.073 14.07L14.373 12.77C14.903 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.84 13.2095 20.552 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                    <?php echo esc_html($phone); ?>
                </a>
                <a href="/schedule/" class="bl-bottom-cta__btn-sec">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Schedule Online
                </a>
            </div>
        </div>
    </div>
</section>

<?php ar_appointment_form('blog', 'Book Your Repair Appointment'); ?>

<?php get_footer(); ?>