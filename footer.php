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

                    <!-- Social Media -->
                    <div style="display:flex;align-items:center;gap:10px;margin-top:20px;">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/VikingServiceSupport"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Viking Appliance Repair on Facebook"
                           style="display:flex;align-items:center;justify-content:center;width:36px;height:36px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:2px;color:rgba(255,255,255,0.6);text-decoration:none;transition:background 0.15s,border-color 0.15s,color 0.15s;"
                           onmouseover="this.style.background='#1877F2';this.style.borderColor='#1877F2';this.style.color='#fff';"
                           onmouseout="this.style.background='rgba(255,255,255,0.07)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='rgba(255,255,255,0.6)';">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.791-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.887v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/>
                            </svg>
                        </a>
                        <!-- Tumblr -->
                        <a href="https://www.tumblr.com/blog/vikingappliancerepair"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Viking Appliance Repair on Tumblr"
                           style="display:flex;align-items:center;justify-content:center;width:36px;height:36px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:2px;color:rgba(255,255,255,0.6);text-decoration:none;transition:background 0.15s,border-color 0.15s,color 0.15s;"
                           onmouseover="this.style.background='#35465C';this.style.borderColor='#35465C';this.style.color='#fff';"
                           onmouseout="this.style.background='rgba(255,255,255,0.07)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='rgba(255,255,255,0.6)';">
                            <svg width="14" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M14.563 24c-5.093 0-7.031-3.756-7.031-6.411V9.747H5.116V6.648c3.63-1.313 4.512-4.596 4.71-6.469C9.84.051 9.941 0 9.999 0h3.517v6.114h4.801v3.633h-4.82v7.47c.016 1.001.375 2.371 2.207 2.371h.09c.631-.02 1.486-.314 1.929-.543l1.170 3.219c-.51.432-1.955 1.136-4.33 1.136z"/>
                            </svg>
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
