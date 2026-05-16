<?php
/**
 * Site Footer — OBSIDIAN Design System
 * Pure ink/black, clean minimal columns
 */
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
?>
</main>

<?php ar_sticky_call_button(); ?>

<footer class="site-footer" role="contentinfo">

    <!-- Footer Main -->
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand Column -->
                <div class="footer-brand">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo" aria-label="<?php bloginfo('name'); ?> — Home">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                             alt="<?php bloginfo('name'); ?>"
                             width="148" height="48" loading="lazy">
                    </a>

                    <p class="footer-brand__desc">
                        Certified Viking appliance repair specialists. Genuine OEM parts, factory-trained technicians, and a 30-day warranty on every repair.
                    </p>

                    <div class="footer-contact">
                        <a href="<?php echo esc_url($phone_raw); ?>" class="footer-contact__phone">
                            <?php echo esc_html($phone); ?>
                        </a>
                        <div class="footer-contact__detail">
                            <span>Mon – Sat&nbsp;&nbsp;08:00 – 18:00</span>
                        </div>
                        <div class="footer-contact__detail">
                            <span>1800 N Vine St, Los Angeles, CA 90028</span>
                        </div>
                        <a href="mailto:info@vikingappliancerepairservice.com" class="footer-contact__email">
                            info@vikingappliancerepairservice.com
                        </a>
                    </div>
                </div>

                <!-- Services Column -->
                <div class="footer-col">
                    <h3 class="footer-col__title">Services</h3>
                    <ul class="footer-nav">
                        <?php
                        $services = [
                            'Viking Range Repair'        => '/services/viking-range-repair/',
                            'Viking Refrigerator Repair' => '/services/viking-refrigerator-repair/',
                            'Viking Dishwasher Repair'   => '/services/viking-dishwasher-repair/',
                            'Viking Cooktop Repair'      => '/services/viking-cooktop-repair/',
                            'Viking Wall Oven Repair'    => '/services/viking-wall-oven-repair/',
                            'Viking Wine Cooler Repair'  => '/services/viking-wine-cooler-repair/',
                            'Viking Freezer Repair'      => '/services/viking-freezer-repair/',
                            'Viking Vent Hood Repair'    => '/services/viking-vent-hood-repair/',
                        ];
                        foreach ($services as $label => $url): ?>
                        <li><a href="<?php echo esc_url(home_url($url)); ?>" class="footer-nav__link"><?php echo esc_html($label); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Locations Column -->
                <div class="footer-col">
                    <h3 class="footer-col__title">Locations</h3>
                    <ul class="footer-nav">
                        <?php
                        $locs = [
                            'Los Angeles, CA'   => '/locations/los-angeles/',
                            'Chicago, IL'       => '/locations/chicago/',
                            'New York, NY'      => '/locations/new-york/',
                            'San Francisco, CA' => '/locations/san-francisco/',
                            'Houston, TX'       => '/locations/houston/',
                            'Miami, FL'         => '/locations/miami/',
                        ];
                        foreach ($locs as $label => $url): ?>
                        <li><a href="<?php echo esc_url(home_url($url)); ?>" class="footer-nav__link"><?php echo esc_html($label); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Resources Column -->
                <div class="footer-col">
                    <h3 class="footer-col__title">Resources</h3>
                    <ul class="footer-nav">
                        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>"        class="footer-nav__link">Repair Blog</a></li>
                        <li><a href="<?php echo esc_url(home_url('/error-codes/')); ?>"  class="footer-nav__link">Fault Codes</a></li>
                        <li><a href="<?php echo esc_url(home_url('/recalls/')); ?>"      class="footer-nav__link">Safety Recalls</a></li>
                        <li><a href="<?php echo esc_url(home_url('/schedule/')); ?>"     class="footer-nav__link">Book a Repair</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom__inner">
                <p class="footer-bottom__copy">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                    Independent appliance repair service — not affiliated with or endorsed by Viking Range, LLC.
                    Brand names used for identification only.
                </p>
                <div class="footer-bottom__links">
                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"     class="footer-bottom__link">Privacy</a>
                    <a href="<?php echo esc_url(home_url('/terms-of-use/')); ?>"        class="footer-bottom__link">Terms</a>
                    <a href="<?php echo esc_url(home_url('/mobile-terms-of-use/')); ?>" class="footer-bottom__link">Mobile Terms</a>
                    <a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>"          class="footer-bottom__link">Sitemap</a>
                </div>
            </div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
