<?php
/**
 * Template: Legal Pages
 * Used for: Privacy Policy, Terms of Use, Mobile Terms of Use
 * URL: /privacy-policy/ | /terms-of-use/ | /mobile-terms-of-use/
 */
defined('ABSPATH') || exit;

global $post;
$slug       = $post->post_name;
$title      = get_the_title();
$modified   = get_the_modified_date('F j, Y');
$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();
$content    = apply_filters('the_content', $post->post_content);

// Word count / read time
$word_count = str_word_count(strip_tags($content));
$read_time  = max(1, (int) ceil($word_count / 200));

// Which legal page are we on — for sibling nav
$legal_siblings = [
    'privacy-policy'      => ['label' => 'Privacy Policy',      'icon' => 'shield'],
    'terms-of-use'        => ['label' => 'Terms of Use',         'icon' => 'doc'],
    'mobile-terms-of-use' => ['label' => 'Mobile Terms of Use',  'icon' => 'phone'],
];

// Icon config for current page
$icons = [
    'privacy-policy'      => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 2L3 6V11C3 15.418 6.582 19.478 11 21C11.333 21.13 11.667 21.25 12 21.333C12.333 21.25 12.667 21.13 13 21C17.418 19.478 21 15.418 21 11V6L12 2Z" stroke="white" stroke-width="2" stroke-linejoin="round"/><path d="M9 12L11 14L15 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'terms-of-use'        => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M9 12H15M9 8H15M9 16H12M5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20Z" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>',
    'mobile-terms-of-use' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="5" y="2" width="14" height="20" rx="2" stroke="white" stroke-width="2"/><path d="M12 18H12.01" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>',
];
$current_icon = $icons[$slug] ?? $icons['privacy-policy'];

// Build TOC from h2/h3 in content
$toc = [];
preg_match_all('/<h([23])[^>]*>(.*?)<\/h\1>/i', $content, $headings, PREG_SET_ORDER);
foreach ($headings as $i => $h) {
    $level = (int) $h[1];
    $text  = strip_tags($h[2]);
    $anchor = 'section-' . ($i + 1) . '-' . sanitize_title($text);
    $toc[] = ['level' => $level, 'text' => $text, 'anchor' => $anchor];
    // Inject anchor into content
    $content = str_replace(
        $h[0],
        '<h' . $level . ' id="' . esc_attr($anchor) . '">' . $h[2] . '</h' . $level . '>',
        $content
    );
}

// Schema — stored for output after get_header()
$_schema_data = [
    '@context'       => 'https://schema.org',
    '@type'          => 'WebPage',
    'name'           => $title . ' — ' . $biz,
    'url'            => get_permalink(),
    'dateModified'   => get_the_modified_date('c'),
    'publisher'      => [
        '@type' => 'LocalBusiness',
        'name'  => $biz,
        'url'   => home_url('/'),
    ],
];

get_header();
ar_output_schema($_schema_data);
?>

<style>
/* ================================================
   LEGAL PAGE — Scoped Styles
================================================ */

/* Progress bar */
#lp-progress {
    position: fixed;
    top: 0; left: 0;
    width: 0%;
    height: 3px;
    background: var(--color-accent);
    z-index: 9999;
    transition: width 0.1s linear;
}

/* ── Hero ── */
.lp-hero {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    padding: 5rem 0 2.5rem;
    position: relative;
    overflow: hidden;
}
.lp-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 50% at 100% 0%, rgba(27,58,107,.18) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 0% 100%, rgba(27,58,107,.08) 0%, transparent 60%);
    pointer-events: none;
}

.lp-breadcrumbs {
    display: flex;
    align-items: center;
    gap: .375rem;
    flex-wrap: wrap;
    margin-bottom: 1.75rem;
    font-size: .8125rem;
    color: rgba(255,255,255,.45);
    position: relative;
}
.lp-breadcrumbs a {
    color: rgba(255,255,255,.55);
    text-decoration: none;
    transition: color var(--transition-fast);
}
.lp-breadcrumbs a:hover { color: #fff; }
.lp-breadcrumbs .sep { color: rgba(255,255,255,.25); }
.lp-breadcrumbs .current { color: rgba(255,255,255,.8); }

.lp-hero__badge {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: rgba(27,58,107,.25);
    border: 1px solid rgba(27,58,107,.4);
    color: #fca5a5;
    font-size: .75rem;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .375rem .875rem;
    border-radius: var(--radius-full);
    margin-bottom: 1.25rem;
}
.lp-hero__badge-dot {
    width: 6px; height: 6px;
    background: #fca5a5;
    border-radius: 50%;
    animation: lp-pulse 2s infinite;
}
@keyframes lp-pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: .5; transform: scale(.8); }
}

.lp-hero__title {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4vw, 2.75rem);
    color: #fff;
    line-height: 1.15;
    margin: 0 0 1.25rem;
    position: relative;
}

.lp-hero__meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.25rem;
    color: rgba(255,255,255,.5);
    font-size: .8125rem;
    position: relative;
}
.lp-hero__meta-item {
    display: flex;
    align-items: center;
    gap: .375rem;
}
.lp-hero__meta-item svg { opacity: .6; }

/* ── Policy selector tabs ── */
.lp-policy-tabs {
    background: rgba(255,255,255,.04);
    border-top: 1px solid rgba(255,255,255,.08);
    position: relative;
}
.lp-policy-tabs__inner {
    display: flex;
    gap: 0;
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 2rem;
    overflow-x: auto;
    scrollbar-width: none;
}
.lp-policy-tabs__inner::-webkit-scrollbar { display: none; }
.lp-policy-tab {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .9rem 1.25rem;
    color: rgba(255,255,255,.45);
    text-decoration: none;
    font-size: .875rem;
    font-weight: 500;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
    transition: color var(--transition-fast), border-color var(--transition-fast);
    flex-shrink: 0;
}
.lp-policy-tab:hover {
    color: rgba(255,255,255,.8);
    border-bottom-color: rgba(255,255,255,.2);
}
.lp-policy-tab.active {
    color: #fff;
    border-bottom-color: var(--color-accent);
}
.lp-policy-tab svg { flex-shrink: 0; }

/* ── Main layout ── */
.lp-layout {
    background: var(--color-bg-light);
    padding: 3rem 0 5rem;
}
.lp-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2.5rem;
    align-items: start;
}

/* ── Article card ── */
.lp-article {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
}
.lp-article__header {
    padding: 2rem 2.5rem 1.5rem;
    border-bottom: 1px solid var(--color-border);
}
.lp-article__updated {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--color-bg-light);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-full);
    padding: .3125rem .875rem;
    font-size: .75rem;
    color: var(--color-text-muted);
    font-weight: 500;
}
.lp-article__updated svg { color: var(--color-accent); }

.lp-article__body {
    padding: 2.5rem;
}

/* ── Legal content typography ── */
.lp-content h2 {
    font-family: var(--font-heading);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--color-text-body);
    margin: 2.5rem 0 .875rem;
    padding-top: 2.5rem;
    border-top: 1px solid var(--color-border);
    scroll-margin-top: 100px;
    display: flex;
    align-items: center;
    gap: .625rem;
}
.lp-content h2:first-child {
    margin-top: 0;
    padding-top: 0;
    border-top: none;
}
.lp-content h2::before {
    content: '';
    display: inline-block;
    width: 4px;
    height: 1.2em;
    background: var(--color-accent);
    border-radius: 2px;
    flex-shrink: 0;
}
.lp-content h3 {
    font-family: var(--font-heading);
    font-size: 1.0625rem;
    font-weight: 600;
    color: var(--color-text-body);
    margin: 1.75rem 0 .625rem;
    scroll-margin-top: 100px;
}
.lp-content p {
    font-size: .9375rem;
    line-height: 1.75;
    color: #374151;
    margin: 0 0 1rem;
}
.lp-content ul, .lp-content ol {
    margin: 0 0 1.25rem 0;
    padding-left: 0;
    list-style: none;
}
.lp-content ul li,
.lp-content ol li {
    position: relative;
    padding: .4375rem 0 .4375rem 1.5rem;
    font-size: .9375rem;
    line-height: 1.65;
    color: #374151;
    border-bottom: 1px solid rgba(0,0,0,.04);
}
.lp-content ul li:last-child,
.lp-content ol li:last-child { border-bottom: none; }
.lp-content ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: .75rem;
    width: 6px;
    height: 6px;
    background: var(--color-accent);
    border-radius: 50%;
}
.lp-content ol { counter-reset: lp-counter; }
.lp-content ol li {
    counter-increment: lp-counter;
    padding-left: 2rem;
}
.lp-content ol li::before {
    content: counter(lp-counter);
    position: absolute;
    left: 0;
    top: .375rem;
    width: 1.375rem;
    height: 1.375rem;
    background: var(--color-accent);
    color: #fff;
    font-size: .6875rem;
    font-weight: 700;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
}
.lp-content strong {
    font-weight: 600;
    color: var(--color-text-body);
}
.lp-content a {
    color: var(--color-accent);
    text-decoration: underline;
    text-decoration-color: rgba(27,58,107,.3);
    text-underline-offset: 2px;
    transition: text-decoration-color var(--transition-fast);
}
.lp-content a:hover { text-decoration-color: var(--color-accent); }

/* ── Table of contents (in article header) ── */
.lp-toc {
    background: var(--color-bg-light);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 1.25rem 1.5rem;
    margin-bottom: 2rem;
}
.lp-toc__title {
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin: 0 0 .875rem;
}
.lp-toc__list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: .125rem;
}
.lp-toc__item { margin: 0; border: none; padding: 0; }
.lp-toc__item::before { display: none; }
.lp-toc__link {
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
.lp-toc__link:hover {
    background: rgba(27,58,107,.06);
    color: var(--color-accent);
    text-decoration: none;
}
.lp-toc__link--h3 { padding-left: 1.5rem; }
.lp-toc__num {
    font-size: .6875rem;
    font-weight: 700;
    color: var(--color-accent);
    opacity: .7;
    min-width: 1.125rem;
    text-align: right;
}

/* ── Sticky Sidebar ── */
.lp-sidebar {
    position: sticky;
    top: 90px;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

/* Sidebar cards */
.lp-sidebar-card {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
}
.lp-sidebar-card__header {
    padding: 1.25rem 1.5rem 1rem;
    border-bottom: 1px solid var(--color-border);
}
.lp-sidebar-card__title {
    font-size: .6875rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--color-text-muted);
    margin: 0;
}
.lp-sidebar-card__body {
    padding: 1rem 1.5rem 1.5rem;
}

/* CTA card */
.lp-cta-card {
    background: var(--color-primary-dark);
    border: none;
    border-radius: var(--radius-xl);
    padding: 1.75rem 1.5rem;
}
.lp-cta-card__icon {
    width: 44px; height: 44px;
    background: rgba(27,58,107,.25);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}
.lp-cta-card__title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    color: #fff;
    margin: 0 0 .5rem;
    line-height: 1.25;
}
.lp-cta-card__text {
    font-size: .8125rem;
    color: rgba(255,255,255,.55);
    line-height: 1.6;
    margin: 0 0 1.25rem;
}
.lp-cta-card__phone {
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
.lp-cta-card__phone:hover { background: var(--color-accent-dark); color: #fff; }
.lp-cta-card__btn {
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
.lp-cta-card__btn:hover { background: rgba(255,255,255,.14); color: #fff; }

/* Other policies nav */
.lp-policy-nav {
    display: flex;
    flex-direction: column;
    gap: 0;
}
.lp-policy-nav__link {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .875rem 1rem;
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: background var(--transition-fast);
    border: 1px solid transparent;
}
.lp-policy-nav__link:hover {
    background: var(--color-bg-light);
    border-color: var(--color-border);
    text-decoration: none;
}
.lp-policy-nav__link.active {
    background: rgba(27,58,107,.05);
    border-color: rgba(27,58,107,.2);
}
.lp-policy-nav__icon {
    width: 36px; height: 36px;
    background: var(--color-bg-section);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.lp-policy-nav__link.active .lp-policy-nav__icon {
    background: var(--color-accent);
}
.lp-policy-nav__label {
    font-size: .875rem;
    font-weight: 600;
    color: var(--color-text-body);
    line-height: 1.3;
}
.lp-policy-nav__sub {
    font-size: .75rem;
    color: var(--color-text-muted);
    margin-top: .125rem;
}
.lp-policy-nav__arrow {
    margin-left: auto;
    color: var(--color-border-dark);
    flex-shrink: 0;
}
.lp-policy-nav__link.active .lp-policy-nav__arrow { color: var(--color-accent); }
.lp-policy-nav__link.active .lp-policy-nav__label { color: var(--color-accent); }

/* Trust badges */
.lp-trust-badges {
    display: flex;
    flex-direction: column;
    gap: .625rem;
}
.lp-trust-badge {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    padding: .75rem;
    background: var(--color-bg-light);
    border-radius: var(--radius-md);
}
.lp-trust-badge__icon {
    width: 32px; height: 32px;
    background: rgba(27,58,107,.1);
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.lp-trust-badge__text { font-size: .75rem; color: var(--color-text-muted); line-height: 1.5; }
.lp-trust-badge__text strong { color: var(--color-text-body); font-weight: 600; display: block; }

/* ── Bottom CTA band ── */
.lp-bottom-cta {
    background: var(--color-primary-dark);
    padding: 3.5rem 0;
}
.lp-bottom-cta__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    flex-wrap: wrap;
}
.lp-bottom-cta__title {
    font-family: var(--font-display);
    font-size: clamp(1.5rem, 3vw, 2rem);
    color: #fff;
    margin: 0 0 .5rem;
}
.lp-bottom-cta__sub {
    font-size: .9375rem;
    color: rgba(255,255,255,.55);
    margin: 0;
}
.lp-bottom-cta__actions {
    display: flex;
    gap: .875rem;
    flex-shrink: 0;
    flex-wrap: wrap;
}
.lp-bottom-cta__phone-btn {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--color-accent);
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    padding: .875rem 1.75rem;
    border-radius: var(--radius-lg);
    text-decoration: none;
    transition: background var(--transition-fast);
}
.lp-bottom-cta__phone-btn:hover { background: var(--color-accent-dark); color: #fff; }
.lp-bottom-cta__schedule-btn {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: rgba(255,255,255,.1);
    color: rgba(255,255,255,.9);
    font-size: .9375rem;
    font-weight: 600;
    padding: .875rem 1.75rem;
    border-radius: var(--radius-lg);
    text-decoration: none;
    transition: background var(--transition-fast);
}
.lp-bottom-cta__schedule-btn:hover { background: rgba(255,255,255,.18); color: #fff; }

/* ── Responsive ── */
@media (max-width: 900px) {
    .lp-grid {
        grid-template-columns: 1fr;
    }
    .lp-sidebar {
        position: static;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
}
@media (max-width: 640px) {
    .lp-hero { padding: 5rem 0 2rem; }
    .lp-hero__title { font-size: 1.75rem; }
    .lp-article__header,
    .lp-article__body { padding: 1.25rem; }
    .lp-sidebar { grid-template-columns: 1fr; }
    .lp-bottom-cta__inner { flex-direction: column; align-items: flex-start; }
    .lp-bottom-cta__actions { width: 100%; }
    .lp-bottom-cta__phone-btn,
    .lp-bottom-cta__schedule-btn { flex: 1; justify-content: center; }
    .lp-policy-tabs__inner { padding: 0 1rem; }
}
</style>

<!-- Progress bar -->
<div id="lp-progress" role="progressbar" aria-hidden="true"></div>

<!-- ================================================
     HERO
================================================ -->
<section class="lp-hero">
    <div class="container">

        <!-- Breadcrumbs -->
        <nav class="lp-breadcrumbs" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span class="sep">›</span>
            <span class="current"><?php echo esc_html($title); ?></span>
        </nav>

        <!-- Badge -->
        <div class="lp-hero__badge">
            <span class="lp-hero__badge-dot"></span>
            Legal Document
        </div>

        <!-- Title -->
        <h1 class="lp-hero__title"><?php echo esc_html($title); ?></h1>

        <!-- Meta -->
        <div class="lp-hero__meta">
            <span class="lp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                Updated <?php echo esc_html($modified); ?>
            </span>
            <span class="lp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 6V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <?php echo $read_time; ?> min read
            </span>
            <span class="lp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2L3 6V11C3 15.418 6.582 19.478 11 21C11.333 21.13 11.667 21.25 12 21.333C12.333 21.25 12.667 21.13 13 21C17.418 19.478 21 15.418 21 11V6L12 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                <?php echo esc_html($biz); ?>
            </span>
        </div>

    </div>
</section>

<!-- Policy selector tabs -->
<div class="lp-policy-tabs">
    <div class="lp-policy-tabs__inner">
        <?php
        $tab_icons = [
            'privacy-policy' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2L3 6V11C3 15.418 6.582 19.478 11 21C11.333 21.13 11.667 21.25 12 21.333C12.333 21.25 12.667 21.13 13 21C17.418 19.478 21 15.418 21 11V6L12 2Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/></svg>',
            'terms-of-use' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M9 12H15M9 8H15M9 16H12M5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20Z" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>',
            'mobile-terms-of-use' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="5" y="2" width="14" height="20" rx="2" stroke="currentColor" stroke-width="1.75"/><path d="M12 18H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
        ];
        foreach ($legal_siblings as $tab_slug => $tab):
            $tab_url = home_url('/' . $tab_slug . '/');
            $is_active = ($tab_slug === $slug);
        ?>
        <a href="<?php echo esc_url($tab_url); ?>"
           class="lp-policy-tab <?php echo $is_active ? 'active' : ''; ?>"
           <?php echo $is_active ? 'aria-current="page"' : ''; ?>>
            <?php echo $tab_icons[$tab_slug]; ?>
            <?php echo esc_html($tab['label']); ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- ================================================
     MAIN LAYOUT
================================================ -->
<div class="lp-layout">
    <div class="container">
        <div class="lp-grid">

            <!-- ── ARTICLE ── -->
            <article class="lp-article" id="lp-article">

                <!-- Article header: last updated + TOC -->
                <div class="lp-article__header">
                    <div class="lp-article__updated">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        Last updated: <?php echo esc_html($modified); ?>
                    </div>
                </div>

                <!-- Article body -->
                <div class="lp-article__body">

                    <?php if (!empty($toc)): ?>
                    <!-- Table of Contents -->
                    <nav class="lp-toc" aria-label="Table of contents" id="lp-toc">
                        <p class="lp-toc__title">Table of Contents</p>
                        <ol class="lp-toc__list">
                            <?php
                            $h2_count = 0;
                            foreach ($toc as $item):
                                if ($item['level'] === 2) $h2_count++;
                            ?>
                            <li class="lp-toc__item">
                                <a href="#<?php echo esc_attr($item['anchor']); ?>"
                                   class="lp-toc__link <?php echo $item['level'] === 3 ? 'lp-toc__link--h3' : ''; ?>">
                                    <?php if ($item['level'] === 2): ?>
                                    <span class="lp-toc__num"><?php echo $h2_count; ?>.</span>
                                    <?php endif; ?>
                                    <?php echo esc_html($item['text']); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                    <?php endif; ?>

                    <!-- Legal content -->
                    <div class="lp-content">
                        <?php echo $content; ?>
                    </div>

                </div><!-- /.lp-article__body -->
            </article>

            <!-- ── SIDEBAR ── -->
            <aside class="lp-sidebar" aria-label="Legal documents sidebar">

                <!-- Dark CTA card -->
                <div class="lp-cta-card">
                    <div class="lp-cta-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22 20.4704 21.7893 20.9996 21.4142 21.3747C21.0391 21.7498 20.5099 21.9605 19.96 21.96C16.4227 21.5611 13.0265 20.3373 10.05 18.39C7.27497 16.6106 4.9394 14.275 3.16 11.5C1.20003 8.50962 -0.024054 5.09613 0.0400001 1.54C0.0400001 0.990225 0.249768 0.461336 0.624844 0.0862588C1.00 -0.288818 1.5291 -0.499511 2.08 -0.5H5.08C6.09447 -0.510192 6.95261 0.195576 7.12 1.2C7.26001 2.05 7.49428 2.88 7.82 3.67C8.08985 4.35 7.92074 5.11972 7.39 5.64L6.09 6.94C7.73016 9.81384 10.1862 12.2699 13.06 13.91L14.36 12.61C14.8903 12.0793 15.66 11.9102 16.34 12.18C17.13 12.5057 17.96 12.74 18.81 12.88C19.8274 13.0495 20.5393 13.9265 20.52 14.95L22 16.92Z" fill="#1B3A6B"/></svg>
                    </div>
                    <h3 class="lp-cta-card__title">Need Appliance Repair?</h3>
                    <p class="lp-cta-card__text">Certified technicians. Same-day service. 30-day warranty on every repair.</p>
                    <a href="<?php echo esc_url($phone_link); ?>" class="lp-cta-card__phone">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22.0011 20.4785 21.7928 21.0169 21.4148 21.4217C21.0368 21.8265 20.5163 22.0672 19.96 22.1C16.4227 21.7011 13.0265 20.4773 10.05 18.53C7.27497 16.7506 4.9394 14.415 3.16 11.64C1.19998 8.65031 -0.02396 5.24039 0.0399895 1.70001C0.0399895 1.14594 0.249499 0.612295 0.627302 0.234492C1.0051 -0.143311 1.53878 -0.352821 2.09296 -0.352821H5.09296C6.1074 -0.362986 6.96554 0.342782 7.13296 1.35001C7.27297 2.20001 7.50724 3.03001 7.83296 3.82001C8.10281 4.50029 7.93370 5.27001 7.40296 5.80001L6.10296 7.10001C7.74312 9.97385 10.1991 12.43 13.073 14.07L14.373 12.77C14.9033 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.8404 13.2095 20.5523 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="/schedule/" class="lp-cta-card__btn">Schedule Appointment</a>
                </div>

                <!-- Other policies -->
                <div class="lp-sidebar-card">
                    <div class="lp-sidebar-card__header">
                        <p class="lp-sidebar-card__title">Legal Documents</p>
                    </div>
                    <div class="lp-sidebar-card__body" style="padding: .75rem;">
                        <nav class="lp-policy-nav" aria-label="Legal pages">
                            <?php
                            $nav_icons_svg = [
                                'privacy-policy' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 2L3 6V11C3 15.418 6.582 19.478 11 21C11.333 21.13 11.667 21.25 12 21.333C12.333 21.25 12.667 21.13 13 21C17.418 19.478 21 15.418 21 11V6L12 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>',
                                'terms-of-use' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 12H15M9 8H15M9 16H12M5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
                                'mobile-terms-of-use' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect x="5" y="2" width="14" height="20" rx="2" stroke="currentColor" stroke-width="2"/><path d="M12 18H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
                            ];
                            $nav_subs = [
                                'privacy-policy'      => 'Data collection & your rights',
                                'terms-of-use'        => 'Service terms & conditions',
                                'mobile-terms-of-use' => 'SMS & text message program',
                            ];
                            foreach ($legal_siblings as $nav_slug => $nav):
                                $is_current = ($nav_slug === $slug);
                            ?>
                            <a href="<?php echo esc_url(home_url('/' . $nav_slug . '/')); ?>"
                               class="lp-policy-nav__link <?php echo $is_current ? 'active' : ''; ?>"
                               <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
                                <span class="lp-policy-nav__icon"
                                    style="<?php echo $is_current ? 'background:var(--color-accent);color:#fff' : 'color:var(--color-text-muted)'; ?>">
                                    <?php echo $nav_icons_svg[$nav_slug]; ?>
                                </span>
                                <span>
                                    <span class="lp-policy-nav__label"><?php echo esc_html($nav['label']); ?></span>
                                    <span class="lp-policy-nav__sub"><?php echo esc_html($nav_subs[$nav_slug]); ?></span>
                                </span>
                                <svg class="lp-policy-nav__arrow" width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </a>
                            <?php endforeach; ?>
                        </nav>
                    </div>
                </div>

                <!-- Trust badges -->
                <div class="lp-sidebar-card">
                    <div class="lp-sidebar-card__header">
                        <p class="lp-sidebar-card__title">Why Trust Us</p>
                    </div>
                    <div class="lp-sidebar-card__body" style="padding: .875rem 1.25rem 1.25rem;">
                        <div class="lp-trust-badges">
                            <div class="lp-trust-badge">
                                <div class="lp-trust-badge__icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 2L3 6V11C3 15.418 6.582 19.478 11 21C11.333 21.13 11.667 21.25 12 21.333C12.333 21.25 12.667 21.13 13 21C17.418 19.478 21 15.418 21 11V6L12 2Z" stroke="#1B3A6B" stroke-width="2" stroke-linejoin="round"/><path d="M9 12L11 14L15 10" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <div class="lp-trust-badge__text">
                                    <strong>Your Data Is Safe</strong>
                                    We never sell personal information to third parties.
                                </div>
                            </div>
                            <div class="lp-trust-badge">
                                <div class="lp-trust-badge__icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#1B3A6B" stroke-width="2"/><path d="M12 6V12L15 15" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round"/></svg>
                                </div>
                                <div class="lp-trust-badge__text">
                                    <strong>Opt Out Anytime</strong>
                                    Cancel SMS messages by replying STOP at any time.
                                </div>
                            </div>
                            <div class="lp-trust-badge">
                                <div class="lp-trust-badge__icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round"/></svg>
                                </div>
                                <div class="lp-trust-badge__text">
                                    <strong>30-Day Warranty</strong>
                                    Every repair backed by our parts & labor guarantee.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </aside>

        </div><!-- /.lp-grid -->
    </div><!-- /.container -->
</div><!-- /.lp-layout -->

<!-- ================================================
     BOTTOM CTA BAND
================================================ -->
<section class="lp-bottom-cta">
    <div class="container">
        <div class="lp-bottom-cta__inner">
            <div>
                <h2 class="lp-bottom-cta__title">Ready to Schedule a Repair?</h2>
                <p class="lp-bottom-cta__sub">Same-day service available. 30-day warranty on every repair.</p>
            </div>
            <div class="lp-bottom-cta__actions">
                <a href="<?php echo esc_url($phone_link); ?>" class="lp-bottom-cta__phone-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M22 16.92V19.92C22.0011 20.4785 21.7928 21.0169 21.4148 21.4217C21.0368 21.8265 20.5163 22.0672 19.96 22.1C16.4227 21.7011 13.0265 20.4773 10.05 18.53C7.27497 16.7506 4.9394 14.415 3.16 11.64C1.19998 8.65031 -0.02396 5.24039 0.0399895 1.70001C0.0399895 1.14594 0.249499 0.612295 0.627302 0.234492C1.0051 -0.143311 1.53878 -0.352821 2.09296 -0.352821H5.09296C6.1074 -0.362986 6.96554 0.342782 7.13296 1.35001C7.27297 2.20001 7.50724 3.03001 7.83296 3.82001C8.10281 4.50029 7.93370 5.27001 7.40296 5.80001L6.10296 7.10001C7.74312 9.97385 10.1991 12.43 13.073 14.07L14.373 12.77C14.9033 12.2393 15.673 12.0702 16.353 12.34C17.143 12.6657 17.973 12.9 18.823 13.04C19.8404 13.2095 20.5523 14.0865 20.533 15.11L22 16.92Z" fill="white"/></svg>
                    <?php echo esc_html($phone); ?>
                </a>
                <a href="/schedule/" class="lp-bottom-cta__schedule-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    Schedule Online
                </a>
            </div>
        </div>
    </div>
</section>

<?php ar_appointment_form('legal', 'Book Your Repair Appointment'); ?>

<script>
(function() {
    // Reading progress bar
    var bar = document.getElementById('lp-progress');
    var article = document.getElementById('lp-article');
    if (!bar || !article) return;
    function updateProgress() {
        var rect = article.getBoundingClientRect();
        var articleHeight = article.offsetHeight;
        var scrolled = -rect.top;
        var pct = Math.min(100, Math.max(0, (scrolled / (articleHeight - window.innerHeight)) * 100));
        bar.style.width = pct + '%';
    }
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();

    // Smooth scroll for TOC links
    document.querySelectorAll('.lp-toc__link, .lp-policy-tabs .lp-policy-tab[href^="#"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                var target = document.getElementById(href.slice(1));
                if (target) {
                    var offset = 90;
                    var top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                    history.pushState(null, '', href);
                }
            }
        });
    });

    // Highlight active TOC item on scroll
    var tocLinks = document.querySelectorAll('.lp-toc__link');
    if (tocLinks.length) {
        var headings = Array.from(document.querySelectorAll('.lp-content h2[id], .lp-content h3[id]'));
        function highlightToc() {
            var scrollY = window.scrollY + 120;
            var active = headings[0];
            headings.forEach(function(h) {
                if (h.offsetTop <= scrollY) active = h;
            });
            tocLinks.forEach(function(link) {
                link.style.color = '';
                link.style.background = '';
                link.style.fontWeight = '';
            });
            if (active) {
                var activeLink = document.querySelector('.lp-toc__link[href="#' + active.id + '"]');
                if (activeLink) {
                    activeLink.style.color = 'var(--color-accent)';
                    activeLink.style.background = 'rgba(27,58,107,.06)';
                    activeLink.style.fontWeight = '600';
                }
            }
        }
        window.addEventListener('scroll', highlightToc, { passive: true });
        highlightToc();
    }
})();
</script>

<?php get_footer(); ?>
