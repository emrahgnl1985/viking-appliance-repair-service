<?php
/**
 * Site Header — OBSIDIAN Design System
 * Ultra-minimal architectural navigation
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0D0D0D">

    <?php if ( ! has_site_icon() ) :
        $svg = esc_url( get_template_directory_uri() . '/assets/images/favicon.svg' );
        $png = esc_url( get_template_directory_uri() . '/assets/images/logo.png' );
    ?>
    <link rel="icon"             href="<?php echo $svg; ?>" type="image/svg+xml">
    <link rel="icon"             href="<?php echo $png; ?>" type="image/png" sizes="any">
    <link rel="apple-touch-icon" href="<?php echo $png; ?>">
    <meta name="msapplication-TileImage" content="<?php echo $png; ?>">
    <meta name="msapplication-TileColor" content="#0D0D0D">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main-content" class="sr-only">Skip to main content</a>

<header class="site-header" id="site-header" role="banner">
    <div class="site-header__inner">

        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>"
           class="site-logo"
           aria-label="<?php bloginfo('name'); ?> — Home">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                 alt="<?php bloginfo('name'); ?>"
                 class="site-logo__img"
                 width="148"
                 height="48"
                 loading="eager">
        </a>

        <!-- Primary Nav -->
        <nav class="primary-nav" aria-label="Primary navigation" role="navigation">

            <div class="primary-nav__item primary-nav__item--dropdown">
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="primary-nav__link">Services</a>
                <div class="dropdown-menu" role="menu">
                    <?php
                    $svc = [
                        'Range Repair'        => 'viking-range-repair',
                        'Refrigerator Repair' => 'viking-refrigerator-repair',
                        'Dishwasher Repair'   => 'viking-dishwasher-repair',
                        'Cooktop Repair'      => 'viking-cooktop-repair',
                        'Wall Oven Repair'    => 'viking-wall-oven-repair',
                        'Wine Cooler Repair'  => 'viking-wine-cooler-repair',
                        'Freezer Repair'      => 'viking-freezer-repair',
                        'Vent Hood Repair'    => 'viking-vent-hood-repair',
                    ];
                    foreach ($svc as $label => $slug): ?>
                        <a href="<?php echo esc_url(home_url("/services/{$slug}/")); ?>"
                           class="dropdown-menu__link" role="menuitem">
                            <?php echo esc_html($label); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="primary-nav__item primary-nav__item--dropdown">
                <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="primary-nav__link">Locations</a>
                <div class="dropdown-menu" role="menu">
                    <?php
                    $cities = [
                        'Los Angeles'   => 'los-angeles',
                        'Chicago'       => 'chicago',
                        'New York'      => 'new-york',
                        'San Francisco' => 'san-francisco',
                        'Houston'       => 'houston',
                        'Miami'         => 'miami',
                    ];
                    foreach ($cities as $name => $slug): ?>
                        <a href="<?php echo esc_url(home_url("/locations/{$slug}/")); ?>"
                           class="dropdown-menu__link" role="menuitem">
                            <?php echo esc_html($name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="primary-nav__item">
                <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="primary-nav__link">Fault Codes</a>
            </div>

            <div class="primary-nav__item primary-nav__item--dropdown">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="primary-nav__link">Resources</a>
                <div class="dropdown-menu" role="menu">
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>"          class="dropdown-menu__link" role="menuitem">Blog</a>
                    <a href="<?php echo esc_url(home_url('/guides/')); ?>"         class="dropdown-menu__link" role="menuitem">Repair Guides</a>
                    <a href="<?php echo esc_url(home_url('/recalls/')); ?>"        class="dropdown-menu__link" role="menuitem">Recalls</a>
                    <a href="<?php echo esc_url(home_url('/error-codes/')); ?>"    class="dropdown-menu__link" role="menuitem">Fault Codes</a>
                </div>
            </div>

        </nav>

        <!-- Header CTA -->
        <div class="header-cta">
            <a href="<?php echo esc_url(ar_phone_link()); ?>"
               class="header-phone"
               aria-label="Call us: <?php echo esc_attr(ar_get_phone()); ?>">
                <?php echo esc_html(ar_get_phone()); ?>
            </a>
            <a href="/schedule/" class="btn btn--primary btn--sm">
                Schedule Repair
            </a>
        </div>

        <!-- Mobile Toggle -->
        <button class="mobile-menu-toggle"
                aria-label="Open navigation menu"
                aria-expanded="false"
                aria-controls="mobile-menu">
            <span class="mobile-menu-toggle__bar"></span>
            <span class="mobile-menu-toggle__bar"></span>
            <span class="mobile-menu-toggle__bar"></span>
        </button>

    </div>
</header>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu__overlay" aria-hidden="true"></div>

<nav class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Mobile navigation">
    <div class="mobile-menu__header">
        <span class="mobile-menu__title"><?php bloginfo('name'); ?></span>
        <button class="mobile-menu__close" aria-label="Close menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>

    <a href="<?php echo esc_url(home_url('/')); ?>"          class="mobile-nav__link">Home</a>
    <a href="<?php echo esc_url(home_url('/services/')); ?>"  class="mobile-nav__link">Services</a>
    <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="mobile-nav__link">Locations</a>
    <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="mobile-nav__link">Fault Codes</a>
    <a href="<?php echo esc_url(home_url('/guides/')); ?>"    class="mobile-nav__link">Repair Guides</a>
    <a href="<?php echo esc_url(home_url('/recalls/')); ?>"   class="mobile-nav__link">Recalls</a>
    <a href="<?php echo esc_url(home_url('/blog/')); ?>"      class="mobile-nav__link">Blog</a>

    <a href="<?php echo esc_url(ar_phone_link()); ?>" class="mobile-nav__phone">
        <?php echo esc_html(ar_get_phone()); ?>
    </a>

    <div class="mobile-menu__cta">
        <a href="/schedule/" class="btn btn--primary btn--full">Schedule a Repair</a>
    </div>
</nav>

<main id="main-content" tabindex="-1">
