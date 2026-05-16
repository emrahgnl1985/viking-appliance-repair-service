<?php
/**
 * Schedule / Appointment Page — OBSIDIAN Design System
 * Auto-loaded by WordPress for any page with slug "schedule"
 */
defined('ABSPATH') || exit;

$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();
$email     = get_option('ar_email', '');

get_header();

$faqs = [
    ['question' => 'How quickly can a technician arrive?',
     'answer'   => 'In most service areas we offer same-day appointments for requests received before noon, and next-day appointments for all other requests. We provide a 2-hour arrival window so you are not waiting all day.'],
    ['question' => 'What Viking appliances do you service?',
     'answer'   => 'We specialize exclusively in Viking appliances: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods — all Viking models and series covered.'],
    ['question' => 'Do you use genuine Viking OEM parts?',
     'answer'   => 'Yes — we use only genuine Viking OEM replacement parts on every repair. We do not use aftermarket or generic substitutes.'],
    ['question' => 'How much does a repair cost?',
     'answer'   => 'Most common repairs range from $150 to $400 including parts and labor. You receive a firm written quote after diagnosis — the price you approve is the price you pay.'],
    ['question' => 'Is there a diagnostic fee?',
     'answer'   => 'We charge a flat diagnostic fee to assess the appliance. If you proceed with the repair, the diagnostic fee is fully waived.'],
    ['question' => 'What does the 30-day warranty cover?',
     'answer'   => 'The warranty covers parts and labor for the specific repair performed. If the same fault recurs within 30 days, we return and fix it at no additional charge.'],
];
?>

<style>
/* ── Split hero ── */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { padding-right: 3rem; }
.ph-split__img { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 960px) {
  .ph-split { display: block; }
  .ph-split__text { padding-right: 0; }
  .ph-split__img { height: 320px; position: relative; }
  .ph-split__img img { position: absolute; }
  .ph-split__img::before { display: none; }
}

/* ── Schedule Page — OBSIDIAN ── */
.sch-hero {
  background: var(--color-bg-light);
  padding: calc(64px + 5rem) 0 4rem;
  border-bottom: 1px solid var(--color-rule);
}
.sch-hero__label {
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--color-primary);
  display: block;
  margin-bottom: 16px;
}
.sch-hero__title {
  font-family: var(--font-display);
  font-size: clamp(2.5rem, 5vw, 4.5rem);
  font-weight: 300;
  line-height: 1.06;
  letter-spacing: -0.03em;
  color: var(--color-primary-dark);
  margin: 0 0 18px;
}
.sch-hero__sub {
  font-family: var(--font-body);
  font-size: 1.0625rem;
  color: var(--color-text-muted);
  max-width: 540px;
  line-height: 1.75;
  margin: 0 0 32px;
}
.sch-hero__badges {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}
.sch-hero__badge {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: var(--font-body);
  font-size: 13px;
  font-weight: 600;
  color: var(--color-text-muted);
}
.sch-hero__badge::before {
  content: '';
  display: block;
  width: 16px; height: 1.5px;
  background: var(--color-primary);
  flex-shrink: 0;
}

/* ── Body layout ── */
.sch-body {
  padding: 5rem 0;
  background: #fff;
  border-bottom: 1px solid var(--color-rule);
}
.sch-body__grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 4rem;
  align-items: start;
}

/* ── Form panel ── */
.sch-form-panel {
  background: var(--color-bg-light);
  border: 1px solid var(--color-rule);
  border-radius: var(--radius-md);
  overflow: hidden;
}
.sch-form-panel__header {
  padding: 28px 32px 24px;
  border-bottom: 1px solid var(--color-rule);
}
.sch-form-panel__title {
  font-family: var(--font-display);
  font-size: 1.625rem;
  font-weight: 500;
  color: var(--color-primary-dark);
  letter-spacing: -0.02em;
  line-height: 1.2;
  margin: 0 0 6px;
}
.sch-form-panel__sub {
  font-family: var(--font-body);
  font-size: 13.5px;
  color: var(--color-text-muted);
  margin: 0;
  line-height: 1.6;
}
.sch-form-panel__body {
  padding: 28px 32px 32px;
}
/* Override appointment-form section wrapper inside the panel */
.sch-form-panel__body .appt-section { padding: 0 !important; background: transparent !important; border: none !important; }
.sch-form-panel__body .container    { padding: 0 !important; max-width: none !important; }
.sch-form-panel__body .appt-layout  { display: block !important; }
.sch-form-panel__body .appt-intro   { display: none !important; }
.sch-form-panel__body .appt-form    { background: transparent !important; border: none !important; border-radius: 0 !important; padding: 0 !important; }
.sch-form-panel__body .appt-form__title,
.sch-form-panel__body .appt-form__subtitle { display: none !important; }

/* ── Sidebar ── */
.sch-sidebar { display: flex; flex-direction: column; gap: 0; }

.sch-sb-block {
  padding: 28px 0;
  border-bottom: 1px solid var(--color-rule);
}
.sch-sb-block:first-child { padding-top: 0; }
.sch-sb-block:last-child  { border-bottom: none; }

.sch-sb-block__title {
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--color-text-muted);
  margin: 0 0 16px;
}

.sch-phone-link {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: var(--font-body);
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  text-decoration: none;
  letter-spacing: -0.01em;
  margin-bottom: 10px;
  transition: color var(--transition-fast);
}
.sch-phone-link:hover { color: var(--color-primary); }

.sch-email-link {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: var(--font-body);
  font-size: 13.5px;
  color: var(--color-text-muted);
  text-decoration: none;
  transition: color var(--transition-fast);
}
.sch-email-link:hover { color: var(--color-primary); }

.sch-hours {
  font-family: var(--font-body);
  font-size: 13px;
  color: var(--color-text-muted);
  margin-top: 10px;
  line-height: 1.6;
}

/* Steps */
.sch-steps { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0; }
.sch-step {
  display: grid;
  grid-template-columns: 44px 1fr;
  gap: 0 14px;
  padding: 16px 0;
  border-bottom: 1px solid var(--color-rule);
}
.sch-step:last-child { border-bottom: none; padding-bottom: 0; }
.sch-step:first-child { padding-top: 0; }
.sch-step__num {
  font-family: var(--font-display);
  font-size: 2.5rem;
  font-weight: 300;
  color: var(--color-rule);
  line-height: 1;
  letter-spacing: -0.04em;
  padding-top: 2px;
}
.sch-step__title {
  font-family: var(--font-display);
  font-size: 1rem;
  font-weight: 500;
  color: var(--color-primary-dark);
  margin: 0 0 4px;
  letter-spacing: -0.01em;
  line-height: 1.2;
}
.sch-step__desc {
  font-family: var(--font-body);
  font-size: 13px;
  color: var(--color-text-muted);
  line-height: 1.6;
  margin: 0;
}

/* Prep list */
.sch-prep { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
.sch-prep li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-family: var(--font-body);
  font-size: 13px;
  color: var(--color-text-muted);
  line-height: 1.55;
  margin: 0;
}
.sch-prep li::before {
  content: '';
  display: block;
  width: 16px; height: 1.5px;
  background: var(--color-primary);
  flex-shrink: 0;
  margin-top: 8px;
}

/* Service areas */
.sch-cities {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  list-style: none;
  padding: 0; margin: 0;
}
.sch-cities li {
  font-family: var(--font-body);
  font-size: 12px;
  color: var(--color-text-muted);
  font-weight: 500;
  padding: 4px 12px;
  border: 1px solid var(--color-rule);
  border-radius: 2px;
}

/* ── What to Expect ── */
.sch-expect {
  padding: 5rem 0;
  background: var(--color-bg-light);
  border-bottom: 1px solid var(--color-rule);
}
.sch-expect__title {
  font-family: var(--font-display);
  font-size: clamp(1.875rem, 3vw, 3rem);
  font-weight: 300;
  color: var(--color-primary-dark);
  letter-spacing: -0.025em;
  line-height: 1.1;
  margin: 12px 0 0;
}
.sch-expect__steps {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  border-left: 1px solid var(--color-rule);
  margin-top: 3rem;
}
.sch-expect__step {
  border-right: 1px solid var(--color-rule);
  padding: 32px 28px;
}
.sch-expect__step-num {
  font-family: var(--font-display);
  font-size: 4rem;
  font-weight: 300;
  color: var(--color-rule);
  line-height: 1;
  letter-spacing: -0.04em;
  margin-bottom: 16px;
}
.sch-expect__step h3 {
  font-family: var(--font-display);
  font-size: 1.125rem;
  font-weight: 500;
  color: var(--color-primary-dark);
  letter-spacing: -0.01em;
  line-height: 1.2;
  margin: 0 0 10px;
}
.sch-expect__step p {
  font-family: var(--font-body);
  font-size: 13.5px;
  color: var(--color-text-muted);
  line-height: 1.7;
  margin: 0;
}

/* Responsive */
@media (max-width: 960px) {
  .sch-body__grid { grid-template-columns: 1fr; gap: 3rem; }
  .sch-sidebar { order: -1; }
  .sch-expect__steps { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .sch-expect__steps { grid-template-columns: 1fr; border-left: none; }
  .sch-expect__step  { border-right: none; border-bottom: 1px solid var(--color-rule); padding: 24px 0; }
  .sch-expect__step:last-child { border-bottom: none; }
  .sch-form-panel__body { padding: 20px; }
  .sch-form-panel__header { padding: 20px; }
}
</style>

<!-- ── HERO ──────────────────────────────────── -->
<section class="sch-hero" aria-labelledby="sch-h1">
  <div class="container">
    <div class="ph-split">
      <div class="ph-split__text">
        <span class="sch-hero__label">Schedule a Repair</span>
        <h1 class="sch-hero__title" id="sch-h1">
          Book Your Viking<br>
          <em style="font-style:italic;font-weight:300;">Appliance Repair</em>
        </h1>
        <p class="sch-hero__sub">
          Fill out the form and a certified Viking technician will call within 60 minutes to confirm your appointment.
        </p>
        <div class="sch-hero__badges" role="list">
          <?php foreach (['Same-Day Service Available', 'Certified Technicians', '30-Day Warranty', 'Upfront Pricing'] as $b): ?>
          <span class="sch-hero__badge" role="listitem"><?php echo esc_html($b); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="ph-split__img">
        <img src="<?php echo esc_url(AR_URI . '/assets/images/ICONICbackground-desktop.jpg'); ?>"
             alt="Viking appliance repair service"
             loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ── BODY: FORM + SIDEBAR ───────────────────── -->
<div class="sch-body">
  <div class="container">
    <div class="sch-body__grid">

      <!-- Form panel -->
      <div class="sch-form-panel">
        <div class="sch-form-panel__header">
          <h2 class="sch-form-panel__title">Book Your Repair Appointment</h2>
          <p class="sch-form-panel__sub">Complete the form below — we will call you within 60 minutes to confirm.</p>
        </div>
        <div class="sch-form-panel__body">
          <?php ar_appointment_form('schedule', ''); ?>
        </div>
      </div>

      <!-- Sidebar -->
      <aside class="sch-sidebar" aria-label="Contact and booking information">

        <!-- Contact -->
        <div class="sch-sb-block">
          <p class="sch-sb-block__title">Call or Email</p>
          <a href="<?php echo esc_url($phone_raw); ?>" class="sch-phone-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            <?php echo esc_html($phone); ?>
          </a>
          <?php if ($email): ?>
          <a href="mailto:<?php echo esc_attr($email); ?>" class="sch-email-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <?php echo esc_html($email); ?>
          </a>
          <?php endif; ?>
          <p class="sch-hours">Mon – Sat &nbsp;·&nbsp; 08:00 – 18:00</p>
        </div>

        <!-- Steps -->
        <div class="sch-sb-block">
          <p class="sch-sb-block__title">What Happens Next</p>
          <ol class="sch-steps">
            <?php
            $steps = [
                ['01','Submit the Form',     'Fill in your contact info and describe the appliance issue.'],
                ['02','We Call to Confirm',  'A team member calls within 60 minutes to confirm your slot.'],
                ['03','Technician Arrives',  'Your certified tech arrives in the agreed 2-hour window.'],
                ['04','Repair &amp; Warranty','Appliance fixed with OEM parts. 30-day warranty issued.'],
            ];
            foreach ($steps as [$n, $t, $d]): ?>
            <li class="sch-step">
              <div class="sch-step__num" aria-hidden="true"><?php echo $n; ?></div>
              <div>
                <p class="sch-step__title"><?php echo $t; ?></p>
                <p class="sch-step__desc"><?php echo $d; ?></p>
              </div>
            </li>
            <?php endforeach; ?>
          </ol>
        </div>

        <!-- Prep -->
        <div class="sch-sb-block">
          <p class="sch-sb-block__title">Before Your Appointment</p>
          <ul class="sch-prep">
            <?php foreach ([
                'Note any error codes displayed on the appliance',
                'Locate the model and serial number (inside door or back panel)',
                'Clear the area around the appliance for easy access',
                'Have a payment method ready — card or check accepted',
                'Ensure an adult (18+) is present during the visit',
            ] as $item): ?>
            <li><?php echo esc_html($item); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Service areas -->
        <div class="sch-sb-block">
          <p class="sch-sb-block__title">Service Areas</p>
          <ul class="sch-cities">
            <?php foreach (['Los Angeles','Chicago','New York','San Francisco','Houston','Miami'] as $city): ?>
            <li><?php echo esc_html($city); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>

      </aside>
    </div>
  </div>
</div>

<!-- ── WHAT TO EXPECT ─────────────────────────── -->
<section class="sch-expect" aria-labelledby="expect-h2">
  <div class="container">
    <span class="section-header__eyebrow">Our Process</span>
    <h2 class="sch-expect__title" id="expect-h2">Simple, Transparent,<br><em style="font-style:italic;">Start to Finish</em></h2>

    <div class="sch-expect__steps" role="list">
      <?php
      $expect = [
          ['01','Book Online',         'Fill in the form with your contact details, appliance brand, and issue description.'],
          ['02','Confirmation Call',   'We call within 60 minutes to confirm your 2-hour arrival window.'],
          ['03','Technician Visit',    'Your certified technician diagnoses the fault and provides an upfront written quote.'],
          ['04','Repair Complete',     'We fix the appliance with genuine Viking OEM parts and issue a 30-day warranty.'],
      ];
      foreach ($expect as [$n, $t, $d]): ?>
      <div class="sch-expect__step" role="listitem">
        <div class="sch-expect__step-num" aria-hidden="true"><?php echo $n; ?></div>
        <h3><?php echo esc_html($t); ?></h3>
        <p><?php echo esc_html($d); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FAQ ────────────────────────────────────── -->
<?php ar_faq_section($faqs, 'Frequently Asked Questions About Viking Appliance Repair'); ?>

<?php get_footer(); ?>
