<?php
/**
 * Site Footer
 * Viking Appliance Repair Service Theme
 */
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
?>
</main><!-- /#main-content -->

<?php ar_sticky_call_button(); ?>

<style>
.footer-logo-link {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}

.footer-logo-link img {
    height: 52px;
    width: auto;
    max-width: 200px;
    object-fit: contain;
    display: block;
    /* Brighten logo slightly on the dark footer background */
    filter: brightness(1.1);
    transition: opacity .2s ease;
}

.footer-logo-link:hover img { opacity: 0.85; }

.footer-brand__desc {
    color: rgba(255,255,255,0.65);
    margin: 12px 0 16px;
    line-height: 1.65;
    font-size: 0.9375rem;
}

.footer-brand__item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,.85);
    font-size: 1rem;
    margin-bottom: 10px;
    text-decoration: none;
    transition: opacity .2s ease;
}

.footer-brand__item svg { flex-shrink: 0; opacity: 0.75; }
.footer-brand__item:hover { opacity: 0.75; }

.footer-brand__phone { font-weight: 600; }
.footer-brand__hours { font-size: 1rem; font-weight: 400; }

.footer-social {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 16px;
}

.footer-social__link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: rgba(255,255,255,.10);
    border-radius: 8px;
    transition: background .2s ease;
    text-decoration: none;
    flex-shrink: 0;
}
.footer-social__link:hover { background: var(--color-accent); }
</style>

<!-- ================================================
     SITE FOOTER
     ================================================ -->
<footer class="site-footer" role="contentinfo">
    <div class="container">

        <div class="footer-grid">

            <!-- Brand Column -->
            <div class="footer-brand">
                <div class="footer-brand__logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link" aria-label="<?php bloginfo('name'); ?> — Home">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                             alt="<?php bloginfo('name'); ?>"
                             width="160"
                             height="52"
                             loading="lazy">
                    </a>
                </div>

                <p class="footer-brand__desc">
                    Viking appliance repair specialists. Genuine OEM parts, certified technicians, and a 30-day warranty on every repair.
                </p>

                <!-- PHONE -->
                <a href="<?php echo esc_url($phone_raw); ?>" class="footer-brand__item footer-brand__phone">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07
                        19.5 19.5 0 01-6-6A19.79 19.79 0 012.08 4.18
                        2 2 0 014.06 2h3a2 2 0 012 1.72
                        12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91
                        a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45
                        12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span><?php echo esc_html($phone); ?></span>
                </a>

                <!-- EMAIL -->
                <a href="mailto:info@vikingappliancerepairservice.com" class="footer-brand__item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="14" rx="2" stroke="white" stroke-width="2"/>
                        <path d="M3 7l9 6 9-6" stroke="white" stroke-width="2"/>
                    </svg>
                    <span>info@vikingappliancerepairservice.com</span>
                </a>

                <!-- ADDRESS -->
                <div class="footer-brand__item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1118 0z" stroke="white" stroke-width="2"/>
                        <circle cx="12" cy="10" r="3" stroke="white" stroke-width="2"/>
                    </svg>
                    <span>1800 N Vine St, Los Angeles, CA 90028</span>
                </div>

                <!-- WORK HOURS -->
                <div class="footer-brand__item footer-brand__hours">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2"/>
                        <path d="M12 6v6l4 2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span>Mon – Sat: 08:00 – 18:00</span>
                </div>

            </div>

            <!-- Services Column -->
            <div class="footer-col">
                <h3 class="footer-col__title">Services</h3>
                <ul class="footer-nav">
                    <?php
                    $service_links = [
                        'Viking Range Repair'        => '/services/viking-range-repair/',
                        'Viking Refrigerator Repair' => '/services/viking-refrigerator-repair/',
                        'Viking Dishwasher Repair'   => '/services/viking-dishwasher-repair/',
                        'Viking Cooktop Repair'      => '/services/viking-cooktop-repair/',
                        'Viking Wall Oven Repair'    => '/services/viking-wall-oven-repair/',
                        'All Viking Services'        => '/services/',
                    ];
                    foreach ($service_links as $label => $url):
                    ?>
                    <li class="footer-nav__item">
                        <a href="<?php echo esc_url(home_url($url)); ?>" class="footer-nav__link"><?php echo esc_html($label); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Locations Column -->
            <div class="footer-col">
                <h3 class="footer-col__title">Locations</h3>
                <ul class="footer-nav">
                    <?php
                    $location_links = [
                        'Los Angeles'   => '/locations/los-angeles/',
                        'Chicago'       => '/locations/chicago/',
                        'New York'      => '/locations/new-york/',
                        'San Francisco' => '/locations/san-francisco/',
                        'Houston'       => '/locations/houston/',
                        'Miami'         => '/locations/miami/',
                    ];
                    foreach ($location_links as $label => $url):
                    ?>
                    <li class="footer-nav__item">
                        <a href="<?php echo esc_url(home_url($url)); ?>" class="footer-nav__link"><?php echo esc_html($label); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Company Column -->
            <div class="footer-col">
                <h3 class="footer-col__title">Company</h3>
                <ul class="footer-nav">
                    <?php
                    $company_links = [
                        'About Us'    => '/',
                        'Blog'        => '/blog/',
                        'Fault Codes' => '/error-codes/',
                        'Recalls'     => '/recalls/',
                        'Contact Us'  => '/contact/',
                    ];
                    foreach ($company_links as $label => $url):
                        $href = home_url($url);
                    ?>
                    <li class="footer-nav__item">
                        <a href="<?php echo esc_url($href); ?>" class="footer-nav__link"><?php echo esc_html($label); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div><!-- /.footer-grid -->

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p class="footer-bottom__copy">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                Independent appliance repair service. Not affiliated with or endorsed by Viking Range, LLC or any appliance manufacturer. Brand names used for identification purposes only.
            </p>
            <div class="footer-bottom__legal">
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"      class="footer-bottom__link">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/terms-of-use/')); ?>"         class="footer-bottom__link">Terms of Use</a>
                <a href="<?php echo esc_url(home_url('/mobile-terms-of-use/')); ?>"  class="footer-bottom__link">Mobile Terms</a>
                <a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>"           class="footer-bottom__link">Sitemap</a>
            </div>
        </div>

    </div><!-- /.container -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
