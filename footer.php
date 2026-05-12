<?php
/**
 * Site Footer
 * Samsung Appliance Repair Theme
 */
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
?>
</main><!-- /#main-content -->

<!-- Sticky Call Button -->
<?php ar_sticky_call_button(); ?>
<style>
    .footer-logo-link {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
}

.footer-logo-icon {
    width: 36px;
    height: 36px;
    background: var(--color-accent);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-logo-text {
    font-size: 1.2rem;
    font-weight: 700;
    color: #fff;
}

.footer-brand__desc {
    color: rgba(255,255,255,0.7);
    margin: 12px 0 16px;
    line-height: 1.6;
}

.footer-brand__item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    font-size: 1.05rem;
    margin-bottom: 10px;
}

.footer-brand__item svg {
    flex-shrink: 0;
    opacity: 0.9;
}

.footer-brand__phone {
    font-weight: 600;
}

.footer-brand__hours {
    font-size: 1.05rem;
    font-weight: 400;
}

.footer-brand__item:hover {
    opacity: 0.8;
}

.footer-social {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 16px;
}

.footer-social__link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: rgba(255, 255, 255, 0.12);
    border-radius: 8px;
    transition: background 0.2s ease, opacity 0.2s ease;
    text-decoration: none;
    flex-shrink: 0;
}

.footer-social__link:hover {
    background: var(--color-accent);
    opacity: 1;
}
</style>

<!-- ================================================
     SITE FOOTER
     ================================================ -->
<footer class="site-footer" role="contentinfo">
    <div class="container">

        <div class="footer-grid">

            <!-- Brand Column -->
            <div class="footer-brand">
                <!-- LOGO -->
            <div class="footer-brand__logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-link">
                    <div class="footer-logo-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="footer-logo-text"><?php bloginfo( 'name' ); ?></span>
                </a>
            </div>

            <!-- DESCRIPTION -->
            <p class="footer-brand__desc">
                Samsung appliance repair specialists. Genuine Samsung parts, certified technicians, and a 30-day warranty on every repair.
            </p>
                <!-- PHONE -->
                <a href="<?php echo esc_url( $phone_raw ); ?>" class="footer-brand__item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 
                        19.5 19.5 0 01-6-6A19.79 19.79 0 012.08 4.18 
                        2 2 0 014.06 2h3a2 2 0 012 1.72 
                        12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91 
                        a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 
                        12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span><?php echo esc_html( $phone ); ?></span>
                </a>

                <!-- EMAIL -->
                <a href="mailto:info@samsungapplianceexperts.com" class="footer-brand__item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="14" rx="2" stroke="white" stroke-width="2"/>
                        <path d="M3 7l9 6 9-6" stroke="white" stroke-width="2"/>
                    </svg>
                    <span>info@samsungapplianceexperts.com</span>
                </a>

                <!-- ADDRESS -->
                <div class="footer-brand__item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1118 0z"
                            stroke="white" stroke-width="2"/>
                        <circle cx="12" cy="10" r="3"
                            stroke="white" stroke-width="2"/>
                    </svg>
                    <span>230 Park Avenue, New York, NY 10169</span>
                </div>

                <!-- WORK HOURS -->
                <div class="footer-brand__item footer-brand__hours">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10"
                            stroke="white" stroke-width="2"/>
                        <path d="M12 6v6l4 2"
                            stroke="white" stroke-width="2"
                            stroke-linecap="round"/>
                    </svg>
                    <span>Mon – Fri: 08:00 – 18:00</span>
                </div>

                <!-- SOCIAL MEDIA -->
                <div class="footer-social">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/SamsungRepaitandSupport"
                       class="footer-social__link"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Follow us on Facebook">
                        <img src="https://cdn.simpleicons.org/facebook/ffffff" width="18" height="18" alt="Facebook" loading="lazy">
                    </a>
                    <!-- Quora -->
                    <a href="https://www.quora.com/profile/Samsung-Appliance-Experts"
                       class="footer-social__link"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Follow us on Quora">
                        <img src="https://cdn.simpleicons.org/quora/ffffff" width="18" height="18" alt="Quora" loading="lazy">
                    </a>
                </div>
            </div>

            <!-- Services Column -->
            <div class="footer-col">
                <h3 class="footer-col__title">Services</h3>
                <ul class="footer-nav">
                    <?php
                    $service_links = [
                        'Samsung Washer Repair'       => '/services/samsung-washer-repair/',
                        'Samsung Dryer Repair'        => '/services/samsung-dryer-repair/',
                        'Samsung Refrigerator Repair' => '/services/samsung-refrigerator-repair/',
                        'Samsung Dishwasher Repair'   => '/services/samsung-dishwasher-repair/',
                        'Samsung Oven Repair'         => '/services/samsung-oven-repair/',
                        'All Samsung Services'        => '/services/',
                    ];
                    foreach ( $service_links as $label => $url ) :
                    ?>
                    <li class="footer-nav__item">
                        <a href="<?php echo esc_url( home_url( $url ) ); ?>" class="footer-nav__link"><?php echo esc_html( $label ); ?></a>
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
                        'Chicago'       => '/locations/chicago/',
                        'San Francisco' => '/locations/san-francisco/',
                        'Houston'       => '/locations/houston/',
                        'Miami'         => '/locations/miami/',
                        'Los Angeles'   => '/locations/los-angeles/',
                        'New York'      => '/locations/new-york/',
                    ];
                    foreach ( $location_links as $label => $url ) :
                    ?>
                    <li class="footer-nav__item">
                        <a href="<?php echo esc_url( home_url( $url ) ); ?>" class="footer-nav__link"><?php echo esc_html( $label ); ?></a>
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
                        'Error Codes' => '/error-codes/',
                        'Recalls'     => '/recalls/',
                    ];
                    foreach ( $company_links as $label => $url ) :
                        $href = home_url( $url );
                    ?>
                    <li class="footer-nav__item">
                        <a href="<?php echo esc_url( $href ); ?>" class="footer-nav__link"><?php echo esc_html( $label ); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- /.footer-grid -->

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p class="footer-bottom__copy">
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
                Independent appliance repair service. Not affiliated with or endorsed by any appliance manufacturer. Brand names used for identification purposes only.
            </p>
            <div class="footer-bottom__legal">
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="footer-bottom__link">Privacy Policy</a>
                <a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>" class="footer-bottom__link">Terms of Use</a>
                <a href="<?php echo esc_url( home_url( '/mobile-terms-of-use/' ) ); ?>" class="footer-bottom__link">Mobile Terms</a>
                <a href="<?php echo esc_url( home_url( '/sitemap.xml' ) ); ?>" class="footer-bottom__link">Sitemap</a>
            </div>
        </div>

    </div><!-- /.container -->
</footer>

<?php wp_footer(); ?>
</body>
</html>