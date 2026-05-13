<?php
/**
 * Site Header
 * Viking Appliance Repair Service Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1A2B42">

    <?php
    /* Favicon — prefer WordPress site icon, fall back to theme logo.png */
    $favicon_32  = get_site_icon_url(32)  ?: get_template_directory_uri() . '/assets/images/logo.png';
    $favicon_180 = get_site_icon_url(180) ?: get_template_directory_uri() . '/assets/images/logo.png';
    $favicon_192 = get_site_icon_url(192) ?: get_template_directory_uri() . '/assets/images/logo.png';
    ?>
    <link rel="icon"             href="<?php echo esc_url($favicon_32); ?>"  sizes="32x32"     type="image/png">
    <link rel="icon"             href="<?php echo esc_url($favicon_192); ?>" sizes="192x192"   type="image/png">
    <link rel="apple-touch-icon" href="<?php echo esc_url($favicon_180); ?>" sizes="180x180">
    <meta name="msapplication-TileImage" content="<?php echo esc_url($favicon_192); ?>">
    <meta name="msapplication-TileColor" content="#1A2B42">

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
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                     alt="<?php bloginfo('name'); ?>"
                     class="site-logo__img"
                     width="160"
                     height="52"
                     loading="eager">
            </a>

            <!-- ================= PRIMARY NAV ================= -->
            <nav class="primary-nav" aria-label="Primary navigation" role="navigation">

                <!-- ERROR CODES -->
                <div class="primary-nav__item">
                    <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="primary-nav__link">Fault Codes</a>
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
                            'Range &amp; Oven Tips' => 'range-oven',
                            'Refrigerator Tips'     => 'refrigerator',
                            'Dishwasher Tips'       => 'dishwasher',
                            'Cooktop Tips'          => 'cooktop',
                            'Maintenance Guides'    => 'maintenance',
                            'Troubleshooting'       => 'troubleshooting',
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
                            'Range'          => 'viking-range-repair',
                            'Refrigerator'   => 'viking-refrigerator-repair',
                            'Dishwasher'     => 'viking-dishwasher-repair',
                            'Cooktop'        => 'viking-cooktop-repair',
                            'Wall Oven'      => 'viking-wall-oven-repair',
                            'Wine Cooler'    => 'viking-wine-cooler-repair',
                            'Freezer'        => 'viking-freezer-repair',
                            'Vent Hood'      => 'viking-vent-hood-repair',
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
                            'Los Angeles'   => 'los-angeles',
                            'Chicago'       => 'chicago',
                            'New York'      => 'new-york',
                            'San Francisco' => 'san-francisco',
                            'Houston'       => 'houston',
                            'Miami'         => 'miami',
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

    <a href="<?php echo esc_url(home_url('/')); ?>"          class="mobile-nav__link">Home</a>
    <a href="<?php echo esc_url(home_url('/services/')); ?>"  class="mobile-nav__link">Services</a>
    <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="mobile-nav__link">Fault Codes</a>
    <a href="<?php echo esc_url(home_url('/recalls/')); ?>"   class="mobile-nav__link">Recalls</a>
    <a href="<?php echo esc_url(home_url('/blog/')); ?>"      class="mobile-nav__link">Blog</a>
    <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="mobile-nav__link">Locations</a>

    <a href="<?php echo esc_url(ar_phone_link()); ?>" class="mobile-nav__phone">
        <?php echo esc_html(ar_get_phone()); ?>
    </a>

    <div class="mobile-menu__cta">
        <a href="/schedule/" class="btn btn--accent btn--full">Schedule Appointment</a>
    </div>

</nav>

<main id="main-content" tabindex="-1">
