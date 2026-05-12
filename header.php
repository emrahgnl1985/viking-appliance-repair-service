<?php
/**
 * Site Header
 * Samsung Appliance Repair Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1B3A6B">

    <?php
    $site_icon_url = get_site_icon_url(32);
    if ($site_icon_url):
    ?>
    <link rel="icon" href="<?php echo esc_url($site_icon_url); ?>" sizes="32x32">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main-content" class="sr-only">Skip to main content</a>

<!-- ================================================
     SITE HEADER
================================================ -->
<header class="site-header" id="site-header" role="banner">
    <div class="container">
        <div class="site-header__inner">

            <!-- ================= LOGO ================= -->
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="site-logo"
               aria-label="<?php bloginfo('name'); ?> — Home">

                <div class="site-logo__mark" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"
                              stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <div class="site-logo__text">
                    <span class="site-logo__name">
                        <?php bloginfo('name'); ?> 
                    </span>
                    <span class="site-logo__tagline">
                        Repair Guides &amp; Diagnostics
                    </span>
                </div>
            </a>

            <!-- ================= PRIMARY NAV ================= -->
            <nav class="primary-nav" aria-label="Primary navigation" role="navigation">

                <!-- GUIDES -->
                <!-- <div class="primary-nav__item">
                    <a href="<?php echo esc_url(home_url('/guides/')); ?>" class="primary-nav__link">Guides</a>
                </div> -->

                <!-- ERROR CODES -->
                <!-- <div class="primary-nav__item primary-nav__item--dropdown">
                    <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="primary-nav__link">
                        Error Codes
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <?php
                        $ec_appliances = [
                            'Washer'       => 'washer',
                            'Dryer'        => 'dryer',
                            'Refrigerator' => 'refrigerator',
                            'Dishwasher'   => 'dishwasher',
                            'Oven / Range' => 'oven',
                            'Microwave'    => 'microwave',
                            'Wall Oven'    => 'wall-oven',
                        ];
                        foreach ($ec_appliances as $ec_name => $ec_slug):
                            $ec_url = add_query_arg( 'appliance', $ec_slug, home_url('/error-codes/') );
                        ?>
                            <a href="<?php echo esc_url($ec_url); ?>"
                               class="dropdown-menu__link"
                               role="menuitem">
                                <?php echo esc_html($ec_name); ?> Codes
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div> -->

                <div class="primary-nav__item">
                    <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="primary-nav__link">Error Codes</a>
                </div>

                <!-- RECALLS -->
                <div class="primary-nav__item">
                    <a href="<?php echo esc_url(home_url('/recalls/')); ?>" class="primary-nav__link">Recalls</a>
                </div>

                <!-- BLOG -->
                <div class="primary-nav__item primary-nav__item--dropdown">
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="primary-nav__link">
                        Blog
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <?php
                        $blog_topics = [
                            'Washer Tips'        => 'washer',
                            'Dryer Tips'         => 'dryer',
                            'Refrigerator Tips'  => 'refrigerator',
                            'Dishwasher Tips'    => 'dishwasher',
                            'Oven &amp; Range'   => 'oven-range',
                            'Maintenance'        => 'maintenance',
                            'Buying Guides'      => 'buying-guides',
                        ];
                        foreach ($blog_topics as $topic_name => $topic_slug):
                        ?>
                            <a href="<?php echo esc_url(home_url("/blog/category/{$topic_slug}/")); ?>"
                               class="dropdown-menu__link"
                               role="menuitem">
                                <?php echo $topic_name; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- SERVICES -->
                <div class="primary-nav__item primary-nav__item--dropdown">
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="primary-nav__link">
                        Services
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <?php
                        $svc_appliances = [
                            'Washer'       => 'samsung-washer-repair',
                            'Dryer'        => 'samsung-dryer-repair',
                            'Refrigerator' => 'samsung-refrigerator-repair',
                            'Dishwasher'   => 'samsung-dishwasher-repair',
                            'Oven / Range' => 'samsung-oven-repair',
                            'Microwave'    => 'samsung-microwave-repair',
                            'Wall Oven'    => 'samsung-wall-oven-repair',
                        ];
                        foreach ($svc_appliances as $svc_name => $svc_slug):
                        ?>
                            <a href="<?php echo esc_url(home_url("/services/{$svc_slug}/")); ?>"
                               class="dropdown-menu__link"
                               role="menuitem">
                                <?php echo esc_html($svc_name); ?> Repair
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- LOCATIONS -->
                <div class="primary-nav__item primary-nav__item--dropdown">
                    <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="primary-nav__link">
                        Locations
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <?php
                        $cities = [
                            'Chicago'       => 'chicago',
                            'San Francisco' => 'san-francisco',
                            'Houston'       => 'houston',
                            'Miami'         => 'miami',
                            'Los Angeles'   => 'los-angeles',
                            'New York'      => 'new-york',
                        ];
                        foreach ($cities as $name => $slug):
                        ?>
                            <a href="<?php echo esc_url(home_url("/locations/{$slug}/")); ?>"
                               class="dropdown-menu__link"
                               role="menuitem">
                                <?php echo esc_html($name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </nav>

            <!-- ================= HEADER CTA ================= -->
            <div class="header-cta">
                <a href="<?php echo esc_url(ar_phone_link()); ?>"
                   class="header-phone__number"
                   aria-label="Call us: <?php echo esc_attr(ar_get_phone()); ?>">
                    <?php echo esc_html(ar_get_phone()); ?>
                </a>
                <a href="/schedule/" class="btn btn--accent btn--sm">
                    Schedule
                </a>
            </div>

            <!-- ================= MOBILE TOGGLE ================= -->
            <button class="mobile-menu-toggle"
                    aria-label="Open navigation menu"
                    aria-expanded="false"
                    aria-controls="mobile-menu">
                <span class="mobile-menu-toggle__bar"></span>
                <span class="mobile-menu-toggle__bar"></span>
                <span class="mobile-menu-toggle__bar"></span>
            </button>

        </div>
    </div>
</header>

<!-- ================= MOBILE MENU ================= -->
<div class="mobile-menu__overlay" aria-hidden="true"></div>

<nav class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Mobile navigation">

    <div class="mobile-menu__header">
        <span class="mobile-menu__title">
            <?php bloginfo('name'); ?>
        </span>
        <button class="mobile-menu__close" aria-label="Close menu">&times;</button>
    </div>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-nav__link">Home</a>
    <a href="<?php echo esc_url(home_url('/guides/')); ?>" class="mobile-nav__link">Guides</a>
    <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="mobile-nav__link">Error Codes</a>
    <a href="<?php echo esc_url(home_url('/recalls/')); ?>" class="mobile-nav__link">Recalls</a>
    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="mobile-nav__link">Blog</a>
    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="mobile-nav__link">Services</a>
    <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="mobile-nav__link">Locations</a>

    <a href="<?php echo esc_url(ar_phone_link()); ?>" class="mobile-nav__phone">
        <?php echo esc_html(ar_get_phone()); ?>
    </a>

    <div class="mobile-menu__cta">
        <a href="/schedule/" class="btn btn--accent btn--full">Schedule Appointment</a>
    </div>

</nav>

<main id="main-content" tabindex="-1">
