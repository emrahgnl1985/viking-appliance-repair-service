<?php
/**
 * Template: Guide / Article
 * CPT: guide  |  URL: /guides/{slug}/
 *
 * Design: editorial — white article body, warm-off-white page, DM Serif Display headings,
 * sticky sidebar, reading progress bar, auto TOC, schema.org Article markup.
 *
 * SEO: Article schema, breadcrumbs, meta description from excerpt,
 *      H1 = post title, H2s inside content anchor-linked from TOC.
 */
defined('ABSPATH') || exit;

global $post;
$id         = $post->ID;
$brand      = get_post_meta( $id, '_ar_brand', true ) ?: '';
$appliance  = get_post_meta( $id, '_ar_appliance_type', true ) ?: '';
$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();

// Guide hero image: prefer WP featured image URL, fall back to _ar_image meta
$hero_img_url = '';
if ( has_post_thumbnail( $id ) ) {
    $hero_img_url = get_the_post_thumbnail_url( $id, 'large' );
} elseif ( $ar_image_meta = get_post_meta( $id, '_ar_image', true ) ) {
    $hero_img_url = $ar_image_meta;
}

// Read time
$content    = get_the_content();
$word_count = str_word_count( strip_tags( apply_filters( 'the_content', $content ) ) );
$read_time  = max( 2, (int) ceil( $word_count / 200 ) );

// Category label
$cat_label = '';
$brand_terms = get_the_terms( $id, 'brand' );
$app_terms   = get_the_terms( $id, 'appliance_type' );
if ( $brand_terms && ! is_wp_error( $brand_terms ) ) $cat_label = $brand_terms[0]->name;
if ( $app_terms   && ! is_wp_error( $app_terms )   ) $cat_label .= ( $cat_label ? ' · ' : '' ) . $app_terms[0]->name;
if ( ! $cat_label ) $cat_label = 'Repair Guide';

// Related services
$related_svcs = [];
$related_svc_ids = get_post_meta( $id, '_ar_related_services', true );
if ( ! empty( $related_svc_ids ) && is_array( $related_svc_ids ) ) {
    $related_svcs = get_posts([ 'post__in' => $related_svc_ids, 'post_type' => 'service_page', 'numberposts' => 5 ]);
} elseif ( $brand_terms && ! is_wp_error( $brand_terms ) ) {
    $related_svcs = get_posts([ 'post_type' => 'service_page', 'numberposts' => 5,
        'tax_query' => [[ 'taxonomy' => 'brand', 'terms' => wp_list_pluck( $brand_terms, 'term_id' ) ]]
    ]);
}

// Related guides
$related_guides = get_posts([
    'post_type'    => 'guide',
    'numberposts'  => 3,
    'post__not_in' => [ $id ],
    'orderby'      => 'rand',
]);

// FAQs
$faqs = get_post_meta( $id, '_ar_faqs', true );

// Schema — stored for output after get_header()
$_schema_data = [
    '@context'        => 'https://schema.org',
    '@type'           => 'Article',
    'headline'        => get_the_title(),
    'url'             => get_permalink(),
    'datePublished'   => get_the_date( 'c' ),
    'dateModified'    => get_the_modified_date( 'c' ),
    'description'     => get_the_excerpt(),
    'wordCount'       => $word_count,
    'author'          => [ '@type' => 'Person', 'name' => get_the_author() ],
    'publisher'       => [ '@type' => 'Organization', 'name' => $biz,
                           'logo'  => [ '@type' => 'ImageObject', 'url' => AR_URI . '/assets/images/logo.png' ] ],
    'image'           => $hero_img_url ?: null,
    'mainEntityOfPage'=> [ '@type' => 'WebPage', '@id' => get_permalink() ],
];

// Auto TOC — inject IDs into H2s in content
$processed_content = preg_replace_callback(
    '/<h2([^>]*)>(.*?)<\/h2>/is',
    function( $m ) {
        $text   = strip_tags( $m[2] );
        $anchor = sanitize_title( $text );
        // Don't double-add id
        if ( strpos( $m[1], 'id=' ) !== false ) return $m[0];
        return '<h2' . $m[1] . ' id="' . esc_attr( $anchor ) . '">' . $m[2] . '</h2>';
    },
    apply_filters( 'the_content', $content )
);

// Extract headings for TOC
preg_match_all( '/<h2[^>]*id="([^"]+)"[^>]*>(.*?)<\/h2>/is', $processed_content, $toc_matches );
$toc_items = [];
if ( ! empty( $toc_matches[1] ) ) {
    foreach ( $toc_matches[1] as $i => $anchor ) {
        $toc_items[] = [ 'anchor' => $anchor, 'label' => strip_tags( $toc_matches[2][ $i ] ) ];
    }
}

get_header();
ar_output_schema($_schema_data);
?>

<style>
/* ── Guide page tokens ── */
:root {
    --gd-page:    #f8f6f3;
    --gd-surface: #ffffff;
    --gd-alt:     #f2f0ed;
    --gd-border:  #e4e2dd;
    --gd-ink:     #1a1a1a;
    --gd-ink-mid: #3d3d3d;
    --gd-ink-muted: #6b6b6b;
    --gd-accent:  #1B3A6B;
    --gd-accent-dk: #122847;
    --gd-green:   #16a34a;
    --gd-radius:  10px;
    --gd-trans:   .2s ease;
}

/* ── Reading progress bar ── */
#gd-progress-bar {
    position: fixed;
    top: 0; left: 0;
    height: 3px;
    width: 0;
    background: var(--gd-accent);
    z-index: 9999;
    transition: width .1s linear;
}

/* ── Breadcrumbs ── */
.gd-breadcrumbs {
    background: var(--gd-surface);
    border-bottom: 1px solid var(--gd-border);
    padding: 13px 0;
    font-size: 15px;
    color: var(--gd-ink-muted);
}
.gd-breadcrumbs__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}
.gd-breadcrumbs a { color: var(--gd-ink-muted); text-decoration: none; }
.gd-breadcrumbs a:hover { color: var(--gd-accent); }
.gd-breadcrumbs__sep { color: var(--gd-border); font-size: 11px; }
.gd-breadcrumbs__current { color: var(--gd-ink-mid); font-weight: 500; }

/* ── Article hero ── */
.gd-hero {
    background-color: var(--gd-accent);
    position: relative;
    overflow: hidden;
    border-bottom: 3px solid var(--gd-accent-dk);
    padding: 52px 0 48px;
}
.gd-hero__inner {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 24px;
}
.gd-hero__cat {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .09em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.9);
    background: rgba(255, 255, 255, 0.12);
    padding: 4px 10px;
    border-radius: 99px;
    margin-bottom: 20px;
    text-decoration: none;
}
.gd-hero__h1 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 400;
    color: #ffffff;
    line-height: 1.1;
    letter-spacing: -.03em;
    margin: 0 0 18px;
}
.gd-hero__excerpt {
    font-size: 20px;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.7;
    margin: 0 0 24px;
    max-width: 680px;
}
.gd-hero__meta {
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.65);
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
}
.gd-hero__meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
}
.gd-hero__meta-item svg { opacity: .6; flex-shrink: 0; }

/* ── Article featured image ── */
.gd-article-image {
    margin: 0 0 32px;
    border-radius: var(--gd-radius);
    overflow: hidden;
    aspect-ratio: 16 / 9;
}
.gd-article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ── Page body ── */
.gd-page-body {
    background: var(--gd-page);
    padding: 48px 0 72px;
}
.gd-layout {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 48px;
    align-items: start;
}

/* ── Article ── */
.gd-article {
    background: var(--gd-surface);
    border: 1px solid var(--gd-border);
    border-radius: var(--gd-radius);
    padding: 40px 44px;
    min-width: 0;
}

/* TOC */
.gd-toc {
    background: var(--gd-alt);
    border: 1px solid var(--gd-border);
    border-left: 3px solid var(--gd-accent);
    border-radius: var(--gd-radius);
    padding: 20px 22px;
    margin-bottom: 36px;
}
.gd-toc__title {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--gd-accent);
    margin: 0 0 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.gd-toc ol {
    margin: 0;
    padding: 0 0 0 18px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.gd-toc ol li { margin: 0; }
.gd-toc a {
    font-size: 16px;
    color: var(--gd-ink-mid);
    text-decoration: none;
    line-height: 1.4;
    transition: color var(--gd-trans);
}
.gd-toc a:hover { color: var(--gd-accent); }

/* Article typography */
.gd-article-content { line-height: 1.75; color: var(--gd-ink-mid); font-size: 16px; }
.gd-article-content h2 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(20px, 2.5vw, 26px);
    font-weight: 400;
    color: var(--gd-ink);
    line-height: 1.2;
    letter-spacing: -.02em;
    margin: 44px 0 16px;
    padding-top: 44px;
    border-top: 1px solid var(--gd-border);
    scroll-margin-top: 80px;
}
.gd-article-content h2:first-child { margin-top: 0; padding-top: 0; border-top: none; }
.gd-article-content h3 {
    font-size: 17px;
    font-weight: 700;
    color: var(--gd-ink);
    margin: 28px 0 10px;
    letter-spacing: -.01em;
}
.gd-article-content p { margin: 0 0 18px; }
.gd-article-content ul, .gd-article-content ol {
    margin: 0 0 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.gd-article-content li { line-height: 1.65; }
.gd-article-content strong { color: var(--gd-ink); font-weight: 700; }
.gd-article-content a { color: var(--gd-accent); }
.gd-article-content a:hover { color: var(--gd-accent-dk); }

/* Callout boxes */
.gd-article-content .wp-block-pullquote,
.gd-callout {
    background: rgba(27,58,107,.05);
    border-left: 3px solid var(--gd-accent);
    border-radius: 0 8px 8px 0;
    padding: 16px 20px;
    margin: 24px 0;
    font-size: 15px;
    color: var(--gd-ink-mid);
}
.gd-tip {
    background: rgba(22,163,74,.06);
    border-left: 3px solid var(--gd-green);
    border-radius: 0 8px 8px 0;
    padding: 16px 20px;
    margin: 24px 0;
    font-size: 15px;
}
.gd-tip::before { content: '&#x2713; '; color: var(--gd-green); font-weight: 700; }

/* Key takeaways box */
.gd-takeaways {
    background: var(--gd-alt);
    border: 1px solid var(--gd-border);
    border-radius: var(--gd-radius);
    padding: 22px 24px;
    margin: 0 0 32px;
}
.gd-takeaways__title {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--gd-accent);
    margin: 0 0 12px;
}
.gd-takeaways ul {
    margin: 0;
    padding: 0 0 0 18px;
    display: flex;
    flex-direction: column;
    gap: 7px;
}
.gd-takeaways li { font-size: 16px; color: var(--gd-ink-mid); line-height: 1.5; }

/* ── Sidebar ── */
.gd-sidebar {
    position: sticky;
    top: 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* Sidebar card */
.gd-scard {
    background: var(--gd-surface);
    border: 1px solid var(--gd-border);
    border-radius: var(--gd-radius);
    padding: 22px 20px;
}
.gd-scard--accent {
    background: var(--gd-ink);
    border-color: var(--gd-ink);
    color: #fff;
}
.gd-scard__title {
    font-size: 16px;
    font-weight: 700;
    color: var(--gd-ink);
    margin: 0 0 8px;
    letter-spacing: -.01em;
}
.gd-scard--accent .gd-scard__title { color: #fff; }
.gd-scard__body { font-size: 15px; color: var(--gd-ink-muted); line-height: 1.55; margin: 0 0 16px; }
.gd-scard--accent .gd-scard__body { color: rgba(255,255,255,.7); }
.gd-scard__phone {
    display: flex;
    align-items: center;
    gap: 7px;
    background: var(--gd-accent);
    color: #fff;
    border-radius: 7px;
    padding: 10px 14px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    margin-bottom: 8px;
    transition: background var(--gd-trans);
}
.gd-scard__phone:hover { background: var(--gd-accent-dk); color: #fff; }
.gd-scard__book {
    display: block;
    text-align: center;
    border: 1px solid rgba(255,255,255,.25);
    color: rgba(255,255,255,.85);
    border-radius: 7px;
    padding: 9px 14px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: background var(--gd-trans);
}
.gd-scard__book:hover { background: rgba(255,255,255,.1); color: #fff; }

/* Sidebar link list */
.gd-scard__links { display: flex; flex-direction: column; gap: 0; margin: 0; padding: 0; list-style: none; }
.gd-scard__links li { border-bottom: 1px solid var(--gd-border); }
.gd-scard__links li:last-child { border-bottom: none; }
.gd-scard__links a {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 15px;
    color: var(--gd-ink-mid);
    text-decoration: none;
    padding: 9px 0;
    transition: color var(--gd-trans);
}
.gd-scard__links a:hover { color: var(--gd-accent); }
.gd-scard__links a::before { content: '→'; color: var(--gd-accent); font-size: 12px; flex-shrink: 0; }

/* Stat mini-card */
.gd-scard__stats { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 14px; }
.gd-scard__stat { text-align: center; background: var(--gd-alt); border-radius: 7px; padding: 10px 8px; }
.gd-scard__stat-val { font-family: 'Playfair Display', Georgia, serif; font-size: 22px; font-weight: 400; color: var(--gd-ink); display: block; }
.gd-scard__stat-lbl { font-size: 10px; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: var(--gd-ink-muted); }

/* ── Disclaimer ── */
.gd-disclaimer {
    margin-top: 36px;
    padding-top: 20px;
    border-top: 1px solid var(--gd-border);
    font-size: 12px;
    color: var(--gd-ink-muted);
    line-height: 1.6;
}

/* ── Related guides ── */
.gd-related { background: var(--gd-surface); border-top: 1px solid var(--gd-border); padding: 64px 0; }
.gd-related__inner { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
.gd-related__head {
    display: flex; align-items: flex-end; justify-content: space-between; gap: 16px;
    margin-bottom: 32px; flex-wrap: wrap;
}
.gd-related__title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 28px; font-weight: 400; color: var(--gd-ink);
    letter-spacing: -.02em; margin: 0;
}
.gd-related__all { font-size: 15px; font-weight: 600; color: var(--gd-accent); text-decoration: none; }
.gd-related__all:hover { color: var(--gd-accent-dk); }
.gd-related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.gd-rcard {
    background: var(--gd-surface);
    border: 1px solid var(--gd-border);
    border-radius: var(--gd-radius);
    overflow: hidden;
    text-decoration: none;
    display: flex; flex-direction: column;
    transition: border-color var(--gd-trans), box-shadow var(--gd-trans), transform var(--gd-trans);
}
.gd-rcard:hover { border-color: rgba(27,58,107,.2); box-shadow: 0 6px 20px rgba(0,0,0,.07); transform: translateY(-2px); }
.gd-rcard__img { aspect-ratio: 16/9; overflow: hidden; background: var(--gd-alt); }
.gd-rcard__img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
.gd-rcard:hover .gd-rcard__img img { transform: scale(1.04); }
.gd-rcard__placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 32px; background: linear-gradient(135deg, var(--gd-alt), #e8e5e0); }
.gd-rcard__body { padding: 18px 18px 16px; display: flex; flex-direction: column; gap: 8px; flex: 1; }
.gd-rcard__cat { font-size: 10px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--gd-accent); }
.gd-rcard__title { font-size: 16px; font-weight: 700; color: var(--gd-ink); line-height: 1.35; margin: 0; }
.gd-rcard:hover .gd-rcard__title { color: var(--gd-accent); }
.gd-rcard__meta { font-size: 12px; color: var(--gd-ink-muted); margin-top: auto; }

/* ── Responsive ── */
@media (max-width: 960px) {
    .gd-layout { grid-template-columns: 1fr; }
    .gd-sidebar { position: static; }
    .gd-related-grid { grid-template-columns: repeat(2, 1fr); }
    .gd-article { padding: 28px 24px; }
}
@media (max-width: 640px) {
    .gd-hero { padding: 36px 0 32px; }
    .gd-related-grid { grid-template-columns: 1fr; }
    .gd-article { padding: 22px 18px; }
}
</style>

<!-- Reading progress bar -->
<div id="gd-progress-bar" role="progressbar" aria-label="Reading progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

<!-- ── BREADCRUMBS ── -->
<nav class="gd-breadcrumbs" aria-label="Breadcrumb">
    <div class="gd-breadcrumbs__inner">
        <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
        <span class="gd-breadcrumbs__sep" aria-hidden="true">›</span>
        <a href="<?php echo esc_url( home_url('/guides/') ); ?>">Guides</a>
        <?php if ( $brand ) : ?>
        <span class="gd-breadcrumbs__sep" aria-hidden="true">›</span>
        <a href="<?php echo esc_url( home_url('/guides/') ); ?>"><?php echo esc_html( $brand ); ?></a>
        <?php endif; ?>
        <span class="gd-breadcrumbs__sep" aria-hidden="true">›</span>
        <span class="gd-breadcrumbs__current" aria-current="page"><?php the_title(); ?></span>
    </div>
</nav>

<!-- ── ARTICLE HERO ── -->
<header class="gd-hero" aria-labelledby="gd-h1">
    <div class="gd-hero__inner">
        <a href="<?php echo esc_url( home_url('/guides/') ); ?>" class="gd-hero__cat">
            <?php echo esc_html( $cat_label ); ?>
        </a>
        <h1 class="gd-hero__h1" id="gd-h1"><?php the_title(); ?></h1>
        <?php if ( get_the_excerpt() ) : ?>
        <p class="gd-hero__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php endif; ?>
        <div class="gd-hero__meta">
            <span class="gd-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <?php echo esc_html( $read_time ); ?> min read
            </span>
            <span class="gd-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Updated <?php echo get_the_modified_date('M j, Y'); ?>
            </span>
            <span class="gd-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                By <?php the_author(); ?>
            </span>
        </div>
    </div>
</header>

<!-- ── PAGE BODY ── -->
<div class="gd-page-body">
    <div class="gd-layout">

        <!-- ── ARTICLE ── -->
        <article class="gd-article" itemscope itemtype="https://schema.org/Article">
            <meta itemprop="headline"      content="<?php echo esc_attr( get_the_title() ); ?>">
            <meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date('c') ); ?>">
            <meta itemprop="dateModified"  content="<?php echo esc_attr( get_the_modified_date('c') ); ?>">
            <meta itemprop="author"        content="<?php echo esc_attr( get_the_author() ); ?>">

            <?php if ( $hero_img_url ) : ?>
            <figure class="gd-article-image">
                <img src="<?php echo esc_url( $hero_img_url ); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                     loading="eager">
            </figure>
            <?php endif; ?>

            <?php if ( count( $toc_items ) >= 3 ) : ?>
            <nav class="gd-toc" aria-label="Table of contents" id="gd-toc">
                <div class="gd-toc__title">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="15" y2="18"/></svg>
                    On This Page
                </div>
                <ol>
                    <?php foreach ( $toc_items as $i => $item ) : ?>
                    <li><a href="#<?php echo esc_attr( $item['anchor'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
                    <?php endforeach; ?>
                </ol>
            </nav>
            <?php endif; ?>

            <div class="gd-article-content" itemprop="articleBody">
                <?php echo $processed_content; ?>
            </div>

            <div class="gd-disclaimer" role="note">
                <strong>Independent Service Notice:</strong> <?php echo esc_html( $biz ); ?> are an independent appliance repair service and is not affiliated with, endorsed by, or sponsored by any appliance manufacturer. Brand names and model numbers are used for identification purposes only.
            </div>
        </article>

        <!-- ── SIDEBAR ── -->
        <aside class="gd-sidebar" aria-label="Additional resources">

            <!-- CTA card -->
            <div class="gd-scard gd-scard--accent">
                <p class="gd-scard__title">Need a Repair?</p>
                <p class="gd-scard__body">Factory-certified parts, highly trained technicians, and a 30-day warranty on every repair.</p>
                <a href="<?php echo esc_url( $phone_link ); ?>" class="gd-scard__phone">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    <?php echo esc_html( $phone ); ?>
                </a>
                <a href="/schedule/" class="gd-scard__book">Book Online →</a>
                <div class="gd-scard__stats">
                    <div class="gd-scard__stat">
                        <span class="gd-scard__stat-val" style="color:#000;">98%</span>
                        <span class="gd-scard__stat-lbl" style="color:rgba(15, 15, 15, 0.55);">First-visit fix</span>
                    </div>
                    <div class="gd-scard__stat">
                        <span class="gd-scard__stat-val" style="color:#000;">30 Day</span>
                        <span class="gd-scard__stat-lbl" style="color:rgba(15, 15, 15, 0.55);">Warranty</span>
                    </div>
                </div>
            </div>

            <?php if ( ! empty( $related_svcs ) ) : ?>
            <!-- Related services -->
            <div class="gd-scard">
                <p class="gd-scard__title">Related Repair Services</p>
                <ul class="gd-scard__links">
                    <?php foreach ( $related_svcs as $svc ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( $svc->ID ) ); ?>"><?php echo esc_html( get_the_title( $svc->ID ) ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Error codes CTA -->
            <div class="gd-scard" style="background: var(--gd-alt);">
                <p class="gd-scard__title">Seeing an Error Code?</p>
                <p class="gd-scard__body">Our Viking fault code database covers documented F-series and appliance codes for all Viking models.</p>
                <a href="<?php echo esc_url( home_url('/error-codes/') ); ?>" style="display:block;text-align:center;background:var(--gd-surface);border:1px solid var(--gd-border);color:var(--gd-ink);border-radius:7px;padding:9px 14px;font-size:13px;font-weight:600;text-decoration:none;">Search Error Codes →</a>
            </div>

        </aside>

    </div>
</div>

<!-- ── FAQ ── -->
<?php if ( ! empty( $faqs ) && is_array( $faqs ) ) : ?>
    <?php ar_faq_section( $faqs, 'Frequently Asked Questions' ); ?>
<?php endif; ?>

<!-- ── RELATED GUIDES ── -->
<?php if ( ! empty( $related_guides ) ) : ?>
<section class="gd-related" aria-labelledby="gd-related-h2">
    <div class="gd-related__inner">
        <div class="gd-related__head">
            <h2 class="gd-related__title" id="gd-related-h2">Keep Learning</h2>
            <a href="<?php echo esc_url( home_url('/guides/') ); ?>" class="gd-related__all">All guides →</a>
        </div>
        <div class="gd-related-grid">
            <?php foreach ( $related_guides as $g ) :
                $g_read = max( 2, (int) ceil( str_word_count( strip_tags( get_post_field('post_content', $g->ID ) ) ) / 200 ) );
                $g_brands = get_the_terms( $g->ID, 'brand' );
                $g_cat = ( $g_brands && ! is_wp_error( $g_brands ) ) ? $g_brands[0]->name : 'Guide';
            ?>
            <a href="<?php echo esc_url( get_permalink( $g->ID ) ); ?>" class="gd-rcard">
                <div class="gd-rcard__img">
                    <?php
                    $g_img_url = get_post_meta( $g->ID, '_ar_image', true );
                    if ( has_post_thumbnail( $g->ID ) ) :
                        echo get_the_post_thumbnail( $g->ID, 'medium', [ 'alt' => esc_attr( get_the_title( $g->ID ) ) . ' — Viking Appliance Repair Guide', 'loading' => 'lazy' ] );
                    elseif ( $g_img_url ) : ?>
                        <img src="<?php echo esc_url( $g_img_url ); ?>" alt="<?php echo esc_attr( get_the_title( $g->ID ) ); ?> — Viking Appliance Repair Guide" loading="lazy">
                    <?php else : ?>
                        <div class="gd-rcard__placeholder" aria-hidden="true">&#x1F527;</div>
                    <?php endif; ?>
                </div>
                <div class="gd-rcard__body">
                    <span class="gd-rcard__cat"><?php echo esc_html( $g_cat ); ?></span>
                    <h3 class="gd-rcard__title"><?php echo esc_html( get_the_title( $g->ID ) ); ?></h3>
                    <span class="gd-rcard__meta"><?php echo esc_html( $g_read ); ?> min read</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ── APPOINTMENT FORM ── -->
<?php ar_appointment_form( 'guide', 'Ready to Book Your Repair?' ); ?>

<!-- Reading progress bar script -->
<script>
(function(){
    'use strict';
    var bar     = document.getElementById('gd-progress-bar');
    var article = document.querySelector('.gd-article');
    if (!bar || !article) return;
    function updateProgress() {
        var rect   = article.getBoundingClientRect();
        var total  = article.offsetHeight - window.innerHeight;
        var scrolled = Math.max(0, -rect.top);
        var pct    = total > 0 ? Math.min(100, (scrolled / total) * 100) : 0;
        bar.style.width = pct + '%';
        bar.setAttribute('aria-valuenow', Math.round(pct));
    }
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
}());
</script>

<?php get_footer(); ?>
