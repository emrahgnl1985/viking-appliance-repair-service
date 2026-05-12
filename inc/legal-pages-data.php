<?php
/**
 * Legal Pages Import Script
 * Creates Privacy Policy, Terms of Use, and Mobile Terms of Use pages.
 *
 * USAGE (from WordPress root):
 *   wp eval-file wp-content/themes/wp-appliancerepair-theme/inc/legal-pages-data.php
 */

defined( 'ABSPATH' ) || die( 'Run via WP-CLI only.' );

$site_name = get_bloginfo( 'name' );
$year      = date( 'Y' );

$legal_pages = [

    /* ====================================================
       PRIVACY POLICY
    ==================================================== */
    [
        'title' => 'Privacy Policy',
        'slug'  => 'privacy-policy',
        'content' => <<<HTML
<h2>Privacy Policy</h2>
<p><strong>Last Updated: January 1, {$year}</strong></p>
<p>{$site_name} ("we," "us," or "our") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>

<h3>1. Information We Collect</h3>
<p>We may collect the following types of personal information:</p>
<ul>
<li><strong>Contact Information:</strong> Name, email address, phone number, and service address when you schedule a repair or submit a contact form.</li>
<li><strong>Service Information:</strong> Appliance type, model, serial number, and description of the problem you provide when requesting service.</li>
<li><strong>Payment Information:</strong> Billing address and payment details processed securely through our payment processor. We do not store credit card numbers.</li>
<li><strong>Usage Data:</strong> IP address, browser type, pages visited, time spent on pages, and referring URLs collected automatically via cookies and analytics tools.</li>
<li><strong>Communications:</strong> Records of emails, phone calls, and text messages between you and our team.</li>
</ul>

<h3>2. How We Use Your Information</h3>
<p>We use the information we collect to:</p>
<ul>
<li>Schedule and perform appliance repair services at your location</li>
<li>Process payments and send invoices or receipts</li>
<li>Send appointment confirmations, reminders, and follow-up communications</li>
<li>Respond to your questions, comments, or requests</li>
<li>Send promotional offers, newsletters, and service updates (you may opt out at any time)</li>
<li>Improve our website, services, and customer experience</li>
<li>Comply with applicable laws and regulations</li>
<li>Protect against fraud, abuse, and security threats</li>
</ul>

<h3>3. Sharing Your Information</h3>
<p>We do not sell, trade, or rent your personal information to third parties. We may share your information with:</p>
<ul>
<li><strong>Service Providers:</strong> Third-party vendors who assist us in operating our website, processing payments, sending communications, or providing services on our behalf. These vendors are contractually obligated to keep your information confidential.</li>
<li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred as part of that transaction.</li>
<li><strong>Legal Requirements:</strong> When required by law, court order, or governmental authority.</li>
<li><strong>Safety:</strong> When necessary to protect the rights, property, or safety of {$site_name}, our customers, or others.</li>
</ul>

<h3>4. Cookies and Tracking Technologies</h3>
<p>We use cookies, web beacons, and similar tracking technologies to enhance your experience on our website. Cookies are small data files stored on your device. You can control cookies through your browser settings, but disabling cookies may affect website functionality. We use:</p>
<ul>
<li><strong>Essential Cookies:</strong> Required for the website to function properly.</li>
<li><strong>Analytics Cookies:</strong> Help us understand how visitors use our site (e.g., Google Analytics).</li>
<li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements.</li>
</ul>

<h3>5. Data Security</h3>
<p>We implement industry-standard security measures to protect your personal information, including SSL encryption for data transmission and secure storage practices. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>

<h3>6. Data Retention</h3>
<p>We retain your personal information for as long as necessary to provide services, comply with legal obligations, resolve disputes, and enforce agreements. Service records are typically retained for 7 years.</p>

<h3>7. Your Rights</h3>
<p>Depending on your location, you may have the following rights regarding your personal information:</p>
<ul>
<li><strong>Access:</strong> Request a copy of the personal information we hold about you.</li>
<li><strong>Correction:</strong> Request correction of inaccurate or incomplete information.</li>
<li><strong>Deletion:</strong> Request deletion of your personal information, subject to certain exceptions.</li>
<li><strong>Opt-Out:</strong> Opt out of marketing communications at any time by clicking "unsubscribe" in any email or contacting us directly.</li>
<li><strong>California Residents:</strong> Under the California Consumer Privacy Act (CCPA), you have additional rights including the right to know what personal information is collected, the right to delete, and the right to opt out of the sale of personal information. We do not sell personal information.</li>
</ul>

<h3>8. Children's Privacy</h3>
<p>Our website and services are not directed to children under the age of 13. We do not knowingly collect personal information from children. If you believe we have inadvertently collected information from a child, please contact us immediately.</p>

<h3>9. Third-Party Links</h3>
<p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of those sites and encourage you to review their privacy policies.</p>

<h3>10. Changes to This Policy</h3>
<p>We may update this Privacy Policy from time to time. We will notify you of material changes by posting the new policy on this page with an updated "Last Updated" date. Your continued use of our services after changes are posted constitutes acceptance of the revised policy.</p>

<h3>11. Contact Us</h3>
<p>If you have questions or concerns about this Privacy Policy or our data practices, please contact us:</p>
<ul>
<li><strong>Phone:</strong> Available on our website</li>
<li><strong>Email:</strong> privacy@{$site_name}</li>
<li><strong>Mail:</strong> Privacy Officer, {$site_name}, United States</li>
</ul>
<p>Our team reviews all privacy enquiries within 2 business days. If you believe we have not handled your data correctly, you may contact us through the options below:</p>
<ul>
<li><a href="/schedule/">Schedule a repair</a></li>
<li><a href="/terms-of-use/">Read our terms of use</a></li>
</ul>
HTML,
    ],

    /* ====================================================
       TERMS OF USE
    ==================================================== */
    [
        'title' => 'Terms of Use',
        'slug'  => 'terms-of-use',
        'content' => <<<HTML
<h2>Terms of Use</h2>
<p><strong>Last Updated: January 1, {$year}</strong></p>
<p>These <strong>terms of use</strong> govern your use of {$site_name}'s appliance repair services and website. Specifically, by booking a repair or using our website, you agree to these terms. Furthermore, we update these terms from time to time, so we recommend reviewing this page before every booking. As a result, you will always have current information about your rights and our responsibilities.</p>

<h3>1. Services</h3>
<p>{$site_name} provides in-home appliance repair services for residential customers. Our technicians are trained and certified to repair major household appliances including washers, dryers, refrigerators, dishwashers, ovens, and cooktops. We service all major brands.</p>

<h3>2. Appointments and Scheduling</h3>
<ul>
<li>Appointments are subject to technician availability in your area.</li>
<li>We will confirm your appointment via phone or email. Please ensure your contact information is accurate when scheduling.</li>
<li>An adult (18 years or older) must be present during the service appointment.</li>
<li>If you need to cancel or reschedule, please notify us at least 24 hours in advance. Late cancellations or no-shows may be subject to a cancellation fee.</li>
<li>We reserve the right to reschedule appointments due to unforeseen circumstances, emergencies, or weather conditions.</li>
</ul>

<h3>3. Diagnostic Fee</h3>
<p>A diagnostic (service call) fee may apply to your appointment. This fee covers the technician's visit, diagnosis of the problem, and labor estimate. The diagnostic fee may be applied toward the cost of repair if you proceed with the service. The exact fee will be disclosed before your appointment is confirmed.</p>

<h3>4. Repairs and Parts</h3>
<ul>
<li>All repairs use OEM (original equipment manufacturer) or manufacturer-approved equivalent parts.</li>
<li>Parts and labor are warranted for 30 days from the date of service, unless otherwise stated.</li>
<li>The warranty covers the specific repair performed and does not cover unrelated failures, misuse, accidental damage, or normal wear and tear.</li>
<li>We are not responsible for pre-existing conditions or problems unrelated to the repair performed.</li>
<li>Some repairs may not be economically feasible. Our technician will advise you if repair is not recommended based on the appliance's age, condition, or cost of parts.</li>
</ul>

<h3>5. Payment</h3>
<ul>
<li>Payment is due upon completion of service. We accept major credit cards, debit cards, and other payment methods as displayed at the time of service.</li>
<li>If additional repairs are required beyond the original estimate, we will obtain your approval before proceeding.</li>
<li>Returned checks or declined payments may incur additional fees.</li>
</ul>

<h3>6. Limitation of Liability</h3>
<p>To the fullest extent permitted by law, {$site_name} shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to loss of data, lost profits, damage to property not being serviced, or business interruption. Our total liability for any claim arising from our services shall not exceed the amount paid for the specific service giving rise to the claim.</p>

<h3>7. Indemnification</h3>
<p>You agree to indemnify and hold {$site_name}, its officers, employees, and agents harmless from any claims, damages, or expenses (including reasonable attorney's fees) arising from your use of our services, your violation of these Terms, or your violation of any rights of a third party.</p>

<h3>8. Website Use</h3>
<ul>
<li>The content on our website, including text, graphics, logos, and images, is owned by {$site_name} and protected by applicable copyright and trademark laws.</li>
<li>You may not reproduce, distribute, or create derivative works from our content without our express written permission.</li>
<li>You agree not to use our website for any unlawful purpose or in any way that could damage, disable, or impair our website or servers.</li>
<li>We reserve the right to modify or discontinue the website at any time without notice.</li>
</ul>

<h3>9. Brand Disclaimer</h3>
<p>{$site_name} is an independent appliance repair company. We are not affiliated with, endorsed by, or sponsored by any appliance manufacturer. Brand names, trademarks, and model names are used for identification purposes only and remain the property of their respective owners.</p>

<h3>10. Governing Law</h3>
<p>These Terms are governed by the laws of the United States and the state in which service is performed, without regard to conflict of law principles. Any disputes shall be resolved in the courts of competent jurisdiction in the applicable state.</p>

<h3>11. Changes to Terms</h3>
<p>We reserve the right to modify these Terms at any time. Changes will be posted on this page with an updated "Last Updated" date. Your continued use of our services after changes are posted constitutes acceptance of the revised Terms.</p>

<h3>12. Contact Us</h3>
<p>Questions about these Terms of Use? Contact us via phone or through the contact form on our website.</p>
HTML,
    ],

    /* ====================================================
       MOBILE TERMS OF USE
    ==================================================== */
    [
        'title' => 'Mobile Terms of Use',
        'slug'  => 'mobile-terms-of-use',
        'content' => <<<HTML
<h2>Mobile Terms of Use</h2>
<p><strong>Last Updated: January 1, {$year}</strong></p>
<p>These Mobile Terms of Use govern your use of SMS/MMS text messaging services provided by {$site_name} ("we," "us," or "our"). By opting in to receive text messages from us, you agree to these terms.</p>

<h3>1. SMS/Text Messaging Program</h3>
<p>{$site_name} offers a text messaging program to provide you with:</p>
<ul>
<li>Appointment confirmations and reminders</li>
<li>Technician arrival notifications and status updates</li>
<li>Service completion notifications and satisfaction follow-ups</li>
<li>Promotional offers, coupons, and service discounts (if you opt in to marketing messages)</li>
<li>Recall alerts related to appliances we service</li>
</ul>

<h3>2. How to Opt In</h3>
<p>You may opt in to receive text messages from us by:</p>
<ul>
<li>Providing your mobile phone number when scheduling a service appointment and checking the SMS consent box</li>
<li>Texting a keyword to our short code or long code as advertised on our website or in our marketing materials</li>
<li>Verbally consenting when speaking with a customer service representative</li>
</ul>

<h3>3. Message Frequency</h3>
<p>Message frequency varies based on your service activity. For transactional messages (appointment-related), you may receive up to 5 messages per appointment cycle. For promotional messages, frequency will not exceed 4 messages per month. We will not send unsolicited commercial messages.</p>

<h3>4. Message and Data Rates</h3>
<p><strong>Message and data rates may apply.</strong> Standard carrier message and data rates apply to all messages sent and received. {$site_name} does not charge for text messages, but your mobile carrier may charge fees for sending and receiving SMS/MMS messages. Contact your carrier for details about your plan.</p>

<h3>5. How to Opt Out</h3>
<p>You may opt out of receiving text messages from us at any time:</p>
<ul>
<li><strong>Reply STOP</strong> to any text message we send you to unsubscribe from all messages.</li>
<li><strong>Reply STOP PROMO</strong> to unsubscribe from promotional messages only while continuing to receive appointment-related messages.</li>
<li>Contact us by phone or email to request removal from our messaging list.</li>
</ul>
<p>After opting out, you will receive one final confirmation message. You may re-subscribe at any time by opting in again through any of the methods described above.</p>

<h3>6. How to Get Help</h3>
<p>For help with our text messaging program:</p>
<ul>
<li><strong>Reply HELP</strong> to any text message to receive help information.</li>
<li>Call us at the phone number listed on our website.</li>
<li>Email us at the address listed on our website.</li>
</ul>

<h3>7. Supported Carriers</h3>
<p>Our messaging program is supported by most major U.S. wireless carriers, including AT&amp;T, Verizon, T-Mobile, Sprint, US Cellular, and others. Carrier support is not guaranteed for all carriers. We are not responsible for delays or delivery failures caused by your mobile carrier.</p>

<h3>8. Privacy</h3>
<p>Your mobile phone number and message history are subject to our <a href="/privacy-policy/">Privacy Policy</a>. We will not share your mobile phone number with third parties for their marketing purposes. Your phone number may be shared with our service providers solely to facilitate message delivery.</p>

<h3>9. Prohibited Uses</h3>
<p>You agree not to use our text messaging service to:</p>
<ul>
<li>Send or forward harassing, abusive, threatening, or unlawful content</li>
<li>Impersonate any person or entity</li>
<li>Violate any applicable laws or regulations</li>
<li>Attempt to gain unauthorized access to our systems</li>
</ul>

<h3>10. Limitation of Liability</h3>
<p>To the fullest extent permitted by law, {$site_name} is not liable for any damages arising from your use of or inability to use our text messaging service, including delays or failures in message delivery caused by your carrier or technical issues outside our control.</p>

<h3>11. Changes to Mobile Terms</h3>
<p>We may update these Mobile Terms at any time. Continued use of our text messaging service after changes are posted constitutes acceptance of the revised terms. If you do not agree to the revised terms, please opt out of the messaging program.</p>

<h3>12. Contact Us</h3>
<p>For questions about our mobile messaging program, contact us by phone or through the contact form on our website.</p>
HTML,
    ],

];

// ──────────────────────────────────────────────
// Import
// ──────────────────────────────────────────────
WP_CLI::line( '' );
WP_CLI::line( '╔══════════════════════════════════════════════╗' );
WP_CLI::line( '║      ApplianceRepair — Legal Pages Import    ║' );
WP_CLI::line( '╚══════════════════════════════════════════════╝' );

foreach ( $legal_pages as $page ) {
    $existing = get_page_by_path( $page['slug'], OBJECT, 'page' );

    $args = [
        'post_type'    => 'page',
        'post_title'   => $page['title'],
        'post_name'    => $page['slug'],
        'post_content' => $page['content'],
        'post_status'  => 'publish',
    ];

    if ( $existing ) {
        $args['ID'] = $existing->ID;
        $id = wp_update_post( $args );
        WP_CLI::success( sprintf( 'Updated: %s (ID: %d)', $page['title'], $id ) );
    } else {
        $id = wp_insert_post( $args, true );
        if ( is_wp_error( $id ) ) {
            WP_CLI::error( sprintf( 'Failed: %s — %s', $page['title'], $id->get_error_message() ), false );
        } else {
            WP_CLI::success( sprintf( 'Created: %s (ID: %d)', $page['title'], $id ) );
        }
    }
}

WP_CLI::line( '' );
WP_CLI::success( 'Legal pages import complete.' );
