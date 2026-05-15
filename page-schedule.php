<?php
/**
 * Schedule / Appointment Page
 * Auto-loaded by WordPress for any page with slug "schedule"
 */
defined('ABSPATH') || exit;

$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();
$email     = get_option('ar_email', '');

get_header();
?>
<main id="main-content">

<style>
/* ═══════════════════════════════════════════════════════
   SCHEDULE PAGE
═══════════════════════════════════════════════════════ */

/* ── Hero ── */
.sch-hero {
    background:
        linear-gradient(135deg, rgba(196,148,58,.18) 0%, transparent 50%),
        linear-gradient(180deg, #1A2B42 0%, #2A3F5C 100%);
    padding: 128px 0 48px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.sch-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 80% at 50% 0%, rgba(196,148,58,.12) 0%, transparent 70%);
    pointer-events: none;
}
.sch-hero__eyebrow {
    display: inline-block;
    background: var(--color-accent, #C4943A);
    color: #fff;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 4px;
    margin-bottom: 18px;
}
.sch-hero__title {
    font-size: clamp(1.875rem, 4.5vw, 3rem);
    font-weight: 800;
    line-height: 1.12;
    margin: 0 0 14px;
    color: #fff;
}
.sch-hero__sub {
    font-size: 1.0625rem;
    color: rgba(255,255,255,.7);
    margin: 0 auto 32px;
    max-width: 560px;
    line-height: 1.65;
}
.sch-hero__badges {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 24px;
    flex-wrap: wrap;
}
.sch-hero__badge-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: .9rem;
    color: rgba(255,255,255,.85);
    font-weight: 500;
}
.sch-hero__badge-item svg { color: #4ade80; flex-shrink: 0; }

/* ── Two-column layout ── */
.sch-body {
    padding: 56px 0 72px;
    background: #f5f5f5;
}
.sch-body__inner {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 32px;
    align-items: start;
}

/* ── Form card ── */
.sch-form-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,.08);
    overflow: hidden;
}
.sch-form-card__header {
    background: var(--color-accent, #C4943A);
    padding: 24px 32px;
    color: #fff;
}
.sch-form-card__header h2 {
    font-size: 1.375rem;
    font-weight: 800;
    margin: 0 0 4px;
    color: #fff;
}
.sch-form-card__header p {
    font-size: .9rem;
    color: rgba(255,255,255,.85);
    margin: 0;
}
.sch-form-card__body {
    padding: 32px;
}

/* Override appointment-form section wrapper when inside card */
.sch-form-card__body .section { padding: 0 !important; background: transparent !important; }
.sch-form-card__body .container { padding: 0 !important; max-width: none !important; width: 100% !important; }
.sch-form-card__body .appt-form { max-width: none !important; margin: 0 !important; }
.sch-form-card__body .appt-form__header { display: none !important; }
.sch-form-card__body .appt-form__body { padding: 0 !important; }

/* ── Sidebar ── */
.sch-sidebar { display: flex; flex-direction: column; gap: 20px; }

.sch-sidebar-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,.07);
    padding: 24px;
}
.sch-sidebar-card__title {
    font-size: 1rem;
    font-weight: 800;
    color: var(--color-dark, #1a1a1a);
    margin: 0 0 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--color-accent, #C4943A);
}

/* Phone card */
.sch-phone-link {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--color-accent, #C4943A);
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    padding: 14px 18px;
    font-size: 1.125rem;
    font-weight: 700;
    transition: opacity .15s;
    margin-bottom: 12px;
}
.sch-phone-link:hover { opacity: .88; color: #fff; }
.sch-phone-link svg { flex-shrink: 0; }
.sch-email-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--color-accent, #C4943A);
    text-decoration: none;
    font-size: .9375rem;
    font-weight: 600;
    padding: 10px 4px;
}
.sch-email-link:hover { text-decoration: underline; }
.sch-contact-note {
    font-size: .8125rem;
    color: #888;
    margin: 10px 0 0;
    line-height: 1.5;
}

/* Steps card */
.sch-steps { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 16px; }
.sch-step { display: flex; gap: 14px; align-items: flex-start; }
.sch-step__num {
    width: 30px;
    height: 30px;
    min-width: 30px;
    background: var(--color-accent, #C4943A);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8125rem;
    font-weight: 800;
}
.sch-step__title {
    font-size: .9375rem;
    font-weight: 700;
    color: var(--color-dark, #1a1a1a);
    margin: 0 0 2px;
}
.sch-step__desc {
    font-size: .8375rem;
    color: #666;
    line-height: 1.5;
    margin: 0;
}

/* Prep card */
.sch-prep-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 10px; }
.sch-prep-list li {
    display: flex;
    gap: 9px;
    align-items: flex-start;
    font-size: .875rem;
    color: #444;
    line-height: 1.5;
}
.sch-prep-list li svg { color: var(--color-accent, #C4943A); flex-shrink: 0; margin-top: 2px; }

/* Service areas card */
.sch-cities {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin: 0;
    padding: 0;
    list-style: none;
}
.sch-cities li {
    background: #f5f5f5;
    border-radius: 4px;
    font-size: .8rem;
    color: #444;
    padding: 4px 10px;
    font-weight: 500;
}

/* ── What to Expect (below form) ── */
.sch-expect {
    padding: 64px 0 72px;
    background: #fff;
}
.sch-expect__head {
    text-align: center;
    margin-bottom: 48px;
}
.sch-expect__head h2 {
    font-size: clamp(1.375rem, 3vw, 2rem);
    font-weight: 800;
    margin: 0 0 10px;
    color: var(--color-dark, #1a1a1a);
}
.sch-expect__head p {
    font-size: 1rem;
    color: #666;
    margin: 0;
}
.sch-expect__steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
    position: relative;
}
.sch-expect__steps::before {
    content: '';
    position: absolute;
    top: 28px;
    left: calc(12.5%);
    right: calc(12.5%);
    height: 2px;
    background: #e5e7eb;
    z-index: 0;
}
.sch-expect__step {
    text-align: center;
    padding: 0 16px;
    position: relative;
    z-index: 1;
}
.sch-expect__step-num {
    width: 56px;
    height: 56px;
    background: var(--color-accent, #C4943A);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    font-weight: 800;
    margin: 0 auto 16px;
    border: 4px solid #fff;
    box-shadow: 0 0 0 2px var(--color-accent, #C4943A);
}
.sch-expect__step h3 {
    font-size: .9375rem;
    font-weight: 700;
    margin: 0 0 6px;
    color: var(--color-dark, #1a1a1a);
}
.sch-expect__step p {
    font-size: .8375rem;
    color: #666;
    margin: 0;
    line-height: 1.55;
}

/* ── Responsive ── */
@media (max-width: 900px) {
    .sch-body__inner { grid-template-columns: 1fr; }
    .sch-sidebar { order: -1; }
    .sch-expect__steps { grid-template-columns: repeat(2, 1fr); gap: 32px; }
    .sch-expect__steps::before { display: none; }
}
@media (max-width: 540px) {
    .sch-hero { padding: 104px 0 36px; }
    .sch-form-card__body { padding: 20px; }
    .sch-expect__steps { grid-template-columns: 1fr; }
    .sch-body { padding: 36px 0 48px; }
}
</style>

<!-- ════════════════════════════════════════════
     HERO
════════════════════════════════════════════ -->
<section class="sch-hero">
    <div class="container">
        <span class="sch-hero__eyebrow">Book Online 24/7</span>
        <h1 class="sch-hero__title">Schedule Appliance Repair</h1>
        <p class="sch-hero__sub">Fill out the form and a certified technician will call within 60&nbsp;minutes to confirm your appointment.</p>
        <div class="sch-hero__badges">
            <span class="sch-hero__badge-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                Same-Day Service
            </span>
            <span class="sch-hero__badge-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                Certified Technicians
            </span>
            <span class="sch-hero__badge-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                30-Day Warranty
            </span>
            <span class="sch-hero__badge-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                Upfront Pricing
            </span>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════
     BODY: FORM + SIDEBAR
════════════════════════════════════════════ -->
<div class="sch-body">
    <div class="container">
        <div class="sch-body__inner">

            <!-- FORM CARD -->
            <div class="sch-form-card">
                <div class="sch-form-card__header">
                    <h2>Book Your Repair Appointment</h2>
                    <p>Complete the form below — we will call you within 60 minutes to confirm.</p>
                </div>
                <div class="sch-form-card__body">
                    <?php ar_appointment_form('schedule', ''); ?>
                </div>
            </div>

            <!-- SIDEBAR -->
            <aside class="sch-sidebar">

                <!-- Contact card -->
                <div class="sch-sidebar-card">
                    <p class="sch-sidebar-card__title">Need Help Booking?</p>
                    <a href="<?php echo esc_url($phone_raw); ?>" class="sch-phone-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <?php if ($email): ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="sch-email-link">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <?php echo esc_html($email); ?>
                    </a>
                    <?php endif; ?>
                    <p class="sch-contact-note">We respond to messages within 24 hours. For urgent repairs, please call.</p>
                </div>

                <!-- What to expect (mini steps) -->
                <div class="sch-sidebar-card">
                    <p class="sch-sidebar-card__title">What to Expect</p>
                    <ol class="sch-steps">
                        <li class="sch-step">
                            <span class="sch-step__num">1</span>
                            <div>
                                <p class="sch-step__title">Submit This Form</p>
                                <p class="sch-step__desc">Fill in your details and describe the appliance issue.</p>
                            </div>
                        </li>
                        <li class="sch-step">
                            <span class="sch-step__num">2</span>
                            <div>
                                <p class="sch-step__title">We Call to Confirm</p>
                                <p class="sch-step__desc">A team member calls within 60 minutes to confirm the time slot.</p>
                            </div>
                        </li>
                        <li class="sch-step">
                            <span class="sch-step__num">3</span>
                            <div>
                                <p class="sch-step__title">Technician Visits</p>
                                <p class="sch-step__desc">Your certified technician arrives within the agreed 2-hour window.</p>
                            </div>
                        </li>
                        <li class="sch-step">
                            <span class="sch-step__num">4</span>
                            <div>
                                <p class="sch-step__title">Repair Complete</p>
                                <p class="sch-step__desc">Appliance fixed, 30-day warranty issued, you're back in business.</p>
                            </div>
                        </li>
                    </ol>
                </div>

                <!-- Before your appointment -->
                <div class="sch-sidebar-card">
                    <p class="sch-sidebar-card__title">Before Your Appointment</p>
                    <ul class="sch-prep-list">
                        <li>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            Note any error codes displayed on the appliance
                        </li>
                        <li>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            Locate your model and serial number (usually inside door or on back panel)
                        </li>
                        <li>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            Clear the area around the appliance for easy access
                        </li>
                        <li>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            Have a payment method ready (card or check accepted)
                        </li>
                        <li>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            Ensure an adult (18+) is present during the visit
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════
     WHAT TO EXPECT — FULL STEPS
════════════════════════════════════════════ -->
<section class="sch-expect">
    <div class="container">
        <div class="sch-expect__head">
            <h2>What to Expect</h2>
            <p>A simple, transparent process from booking to a working appliance.</p>
        </div>
        <div class="sch-expect__steps">
            <div class="sch-expect__step">
                <div class="sch-expect__step-num">1</div>
                <h3>Book Online</h3>
                <p>Fill in the form above with your contact details, appliance brand, and issue description.</p>
            </div>
            <div class="sch-expect__step">
                <div class="sch-expect__step-num">2</div>
                <h3>Confirmation Call</h3>
                <p>We call within 60 minutes to confirm your 2-hour arrival window and answer any questions.</p>
            </div>
            <div class="sch-expect__step">
                <div class="sch-expect__step-num">3</div>
                <h3>Technician Visit</h3>
                <p>Your certified technician arrives, diagnoses the fault, and provides an upfront written quote.</p>
            </div>
            <div class="sch-expect__step">
                <div class="sch-expect__step-num">4</div>
                <h3>Repair Complete</h3>
                <p>We fix the appliance using OEM parts and issue a 30-day parts-and-labor warranty.</p>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════
     FAQ
════════════════════════════════════════════ -->
<?php
$faqs = [
    ['question' => 'How quickly can a technician arrive?',
     'answer'   => 'In most service areas we offer same-day appointments for requests received before noon, and next-day appointments for all other requests. We provide a 2-hour arrival window so you are not waiting all day.'],
    ['question' => 'What Viking appliances do you service?',
     'answer'   => 'We specialize exclusively in Viking appliances: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods — all Viking models and series covered.'],
    ['question' => 'Do you use genuine Viking OEM parts?',
     'answer'   => 'Yes — we use only genuine Viking OEM replacement parts on every repair. We do not use aftermarket or generic substitutes. Genuine OEM parts ensure factory performance, compatibility, and compliance with any remaining manufacturer warranty terms.'],
    ['question' => 'How much does a repair cost?',
     'answer'   => 'Most common repairs range from $150 to $400 including parts and labor. You receive a firm written quote after diagnosis — the price you approve is the price you pay.'],
    ['question' => 'Is there a diagnostic fee?',
     'answer'   => 'We charge a flat diagnostic fee to assess the appliance. If you proceed with the repair, the diagnostic fee is fully waived — you only pay the repair cost.'],
    ['question' => 'What does the 30-day warranty cover?',
     'answer'   => 'The warranty covers parts and labor for the specific repair performed. If the same fault recurs within 30 days, we return and fix it at no additional charge.'],
];
ar_faq_section($faqs, 'Frequently Asked Questions');
?>

</main>
<?php get_footer(); ?>
