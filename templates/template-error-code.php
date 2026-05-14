<?php
/**
 * Template: Error Code — Single Page
 * Design: matches vikingappliancerepairservice.com/error-codes/ single code pages
 *
 * ACF Fields:
 *   _ar_brand, _ar_appliance_type, _ar_error_code, _ar_code_meaning,
 *   _ar_causes[], _ar_diy_steps[], _ar_when_to_call,
 *   _ar_cost_range, _ar_faqs[]
 */
defined('ABSPATH') || exit;

$pid       = get_the_ID();
$brand     = get_post_meta($pid, '_ar_brand',         true) ?: 'Your Brand';
$appliance = get_post_meta($pid, '_ar_appliance_type',true) ?: 'Appliance';
$code      = get_post_meta($pid, '_ar_error_code',    true) ?: '';
$meaning   = get_post_meta($pid, '_ar_code_meaning',  true) ?: '';
$causes    = get_post_meta($pid, '_ar_causes',         true) ?: [];
$steps     = get_post_meta($pid, '_ar_diy_steps',      true) ?: [];
$when_call = get_post_meta($pid, '_ar_when_to_call',   true) ?: '';
$cost      = get_post_meta($pid, '_ar_cost_range',     true) ?: '$80 – $250';
$faqs      = get_post_meta($pid, '_ar_faqs',           true) ?: [];
$phone     = ar_get_phone();
$phone_raw = get_option('ar_phone_raw', '+18000000000');
$biz       = ar_get_business_name();
$service_url = home_url('/services/' . strtolower($brand) . '-' . strtolower($appliance) . '-repair/');

/* Severity — read stored meta first, fall back to cost-derived */
$severity_stored = get_post_meta($pid, '_ar_severity', true);
switch ($severity_stored) {
    case 'Critical':
        $sev = ['label' => 'Critical', 'cls' => 'ec-sev--critical', 'tip' => 'Stop using immediately. Safety risk — call a technician now.'];
        break;
    case 'High':
        $sev = ['label' => 'High', 'cls' => 'ec-sev--high', 'tip' => 'Stop using the appliance and call a technician.'];
        break;
    case 'Medium':
        $sev = ['label' => 'Medium', 'cls' => 'ec-sev--med', 'tip' => 'Professional repair recommended.'];
        break;
    case 'Low':
        $sev = ['label' => 'Low', 'cls' => 'ec-sev--low', 'tip' => 'Often resolved with basic troubleshooting.'];
        break;
    default:
        /* Legacy fallback: derive from cost range */
        preg_match('/\$(\d+)/', $cost, $m);
        $cost_start = (int)($m[1] ?? 0);
        if ($cost_start >= 200) {
            $sev = ['label' => 'High', 'cls' => 'ec-sev--high', 'tip' => 'Stop using the appliance and call a technician.'];
        } elseif ($cost_start >= 90) {
            $sev = ['label' => 'Medium', 'cls' => 'ec-sev--med', 'tip' => 'Professional repair recommended.'];
        } else {
            $sev = ['label' => 'Low', 'cls' => 'ec-sev--low', 'tip' => 'Often resolved with basic troubleshooting.'];
        }
}

/* Fallbacks */
if (empty($causes)) {
    $causes = [
        ['title' => 'Component failure',          'description' => "An internal component specific to the {$code} fault has failed and requires replacement with factory-certified {$brand} parts."],
        ['title' => 'Blocked or restricted system','description' => "A blockage or restriction in the relevant system is preventing normal operation."],
        ['title' => 'Sensor or control fault',    'description' => "A malfunctioning sensor or control board is incorrectly reporting a fault condition."],
        ['title' => 'Wear over time',              'description' => "Normal wear after years of service has caused this component to fail."],
    ];
}
if (empty($steps)) {
    $steps = [
        ['title' => 'Power off and disconnect',    'description' => "Switch off and unplug the {$appliance} — or turn off its dedicated circuit breaker. Wait 5 minutes before proceeding."],
        ['title' => 'Perform a basic inspection',  'description' => "Check for blockages, standing water, disconnected hoses, or visible damage. Address anything you can safely resolve."],
        ['title' => 'Reset the appliance',         'description' => "Reconnect power and run a short test cycle. Monitor closely to see if the {$code} error clears."],
        ['title' => 'Check for recurrence',        'description' => "If the error returns promptly, the underlying fault is not self-correcting — proceed to professional diagnosis."],
    ];
}
if (empty($faqs)) {
    $faqs = [
        ['question' => "Is the {$brand} {$code} error code dangerous?",         'answer' => "The {$code} code is a safety or fault indicator. While the code itself is not dangerous, the underlying cause — if left unaddressed — can lead to further damage or, in some cases, safety risks. We recommend addressing it promptly."],
        ['question' => "Can I reset the {$code} error by unplugging?",          'answer' => "A power reset may temporarily clear the code. However, if the underlying fault is not resolved, {$code} will reappear as soon as the appliance runs again. A power reset is a diagnostic step, not a repair."],
        ['question' => "How long does a {$brand} {$code} repair take?",         'answer' => "Most repairs are completed in 1–2 hours on a single visit using factory-certified {$brand} parts."],
        ['question' => "What does the {$brand} {$code} repair cost?",           'answer' => "Repair costs depend on the specific component causing the fault. Typical range: {$cost}. We provide an exact upfront quote after diagnosis."],
        ['question' => "Should I keep using my {$appliance} with the {$code} error?", 'answer' => "We recommend stopping use until the fault is diagnosed. Continued operation with an unresolved fault can cause additional damage to other components."],
    ];
}

/* Related error codes */
$related = ar_get_related_error_codes($brand, $appliance, 4, $pid);

get_header();
?>

<style>
/* ── Error Code Single — Scoped Styles ──────────────────── */
:root {
  --ec-red:    #1B3A6B;
  --ec-dark:   #1a1a1a;
  --ec-warm:   #f8f6f3;
  --ec-alt:    #f2f0ed;
  --ec-white:  #ffffff;
  --ec-border: #e5e0da;
  --ec-text:   #2c2c2c;
  --ec-muted:  #6b6560;
  --ec-radius: 10px;
  --ec-shadow: 0 2px 12px rgba(0,0,0,.07);
}

/* ── Progress bar ─────────────────────────────────────── */
#ec-progress {
  position: fixed;
  top: 0; left: 0;
  height: 3px;
  width: 0%;
  background: var(--ec-red);
  z-index: 9999;
  transition: width .1s linear;
}

/* ── Breadcrumbs ─────────────────────────────────────── */
.ec-bread {
  background: var(--ec-warm);
  border-bottom: 1px solid var(--ec-border);
  padding: 12px 0;
}
.ec-bread__list {
  display: flex;
  align-items: center;
  gap: 6px;
  list-style: none;
  margin: 0; padding: 0;
  font-size: .8rem;
  flex-wrap: wrap;
}
.ec-bread__list a { color: var(--ec-muted); text-decoration: none; }
.ec-bread__list a:hover { color: var(--ec-red); }
.ec-bread__sep { color: #ccc; }
.ec-bread__current { color: var(--ec-text); font-weight: 600; }

/* ── Hero ─────────────────────────────────────────────── */
.ec-hero {
  background: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg'); ?>') no-repeat center center;
  background-size: cover;
  border-bottom: 1px solid var(--clr-border);
  /* Optional: fallback color if image fails to load */
  background-color:  var(--ec-dark);
  padding: 72px 0 56px;
  position: relative;
  overflow: hidden;
}
.ec-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  /* background: radial-gradient(ellipse 80% 60% at 60% 40%, rgba(27,58,107,0.55) 0%, rgba(27,58,107,0.3) 100%); */
  background: rgba(0,0,0,0.35); 

  pointer-events: none;
  z-index: 0;
}
.ec-hero__inner {
  max-width: 780px;
  position: relative;
  z-index: 1;
  padding: 24px;
  /* background: rgba(0,0,0,0.35);  */
  border-radius: 10px;
}
.ec-hero__meta {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 18px;
}
.ec-hero__code-pill {
  background: var(--ec-red);
  color: #fff;
  font-size: .8rem;
  font-weight: 800;
  font-family: 'Courier New', monospace;
  letter-spacing: .06em;
  padding: 5px 14px;
  border-radius: 6px;
}
.ec-sev {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: .72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 5px 12px;
  border-radius: 20px;
}
.ec-sev::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
.ec-sev--low      { background: rgba(21,128,61,.15);  color: #86efac; border: 1px solid rgba(21,128,61,.3); }
.ec-sev--low::before      { background: #86efac; }
.ec-sev--med      { background: rgba(180,83,9,.15);  color: #fcd34d; border: 1px solid rgba(180,83,9,.3); }
.ec-sev--med::before      { background: #fcd34d; }
.ec-sev--high     { background: rgba(27,58,107,.2);  color: #fca5a5; border: 1px solid rgba(27,58,107,.3); }
.ec-sev--high::before     { background: #fca5a5; }
.ec-sev--critical { background: rgba(153,27,27,.25); color: #fca5a5; border: 1px solid rgba(220,38,38,.5); animation: ec-pulse 2s ease-in-out infinite; }
.ec-sev--critical::before { background: #ef4444; }
@keyframes ec-pulse { 0%,100% { opacity:1; } 50% { opacity:.65; } }
.ec-hero__brand-chip {
  font-size: .78rem;
  color: #fff;
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.12);
  padding: 4px 12px;
  border-radius: 20px;
}
.ec-hero__h1 {
  font-size: clamp(1.6rem, 3.5vw, 2.4rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.2;
  margin: 0 0 14px;
}
.ec-hero__sub {
  font-size: .9875rem;
  color: #fff;
  line-height: 1.6;
  margin: 0 0 28px;
  max-width: 640px;
}
.ec-hero__btns {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}
.ec-btn--red {
  background: var(--ec-red);
  color: #fff;
  padding: 12px 26px;
  border-radius: 50px;
  font-size: .875rem;
  font-weight: 700;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: background .2s;
}
.ec-btn--red:hover { background: #9E7428; }
.ec-btn--outline {
  color: rgba(255,255,255,.8);
  padding: 12px 26px;
  border-radius: 50px;
  font-size: .875rem;
  font-weight: 600;
  text-decoration: none;
  display: inline-block;
  border: 1.5px solid rgba(255,255,255,.2);
  transition: background .2s, border-color .2s;
}
.ec-btn--outline:hover { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.4); }

/* ── Trust bar ────────────────────────────────────────── */
.ec-trust {
  background: #fff;
  border-bottom: 1px solid var(--ec-border);
  padding: 14px 0;
}
.ec-trust__inner {
  display: flex;
  align-items: center;
  gap: 32px;
  flex-wrap: wrap;
  font-size: .82rem;
  color: var(--ec-muted);
}
.ec-trust__item {
  display: flex;
  align-items: center;
  gap: 6px;
}
.ec-trust__item strong { color: var(--ec-text); }

/* ── Layout ───────────────────────────────────────────── */
.ec-layout {
  padding: 56px 0 80px;
  background: var(--ec-warm);
}
.ec-layout__inner {
  display: block;
  grid-template-columns: 1fr 300px;
  gap: 32px;
  align-items: start;
}
.ec-article {
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.ec-sidebar {
  display: flex;
  flex-direction: column;
  gap: 20px;
  position: sticky;
  top: 100px;
}

/* ── Article blocks ───────────────────────────────────── */
.ec-block {
  background: var(--ec-white);
  border: 1px solid var(--ec-border);
  border-radius: var(--ec-radius);
  padding: 32px;
}
.ec-block__eyebrow {
  font-size: .8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .1em;
  color: var(--ec-red);
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.ec-block__eyebrow::before {
  content: '';
  width: 16px; height: 2px;
  background: var(--ec-red);
}
.ec-block__h2 {
  font-size: 1.5rem;
  font-weight: 800;
  color: var(--ec-dark);
  margin: 0 0 20px;
  padding-bottom: 14px;
  border-bottom: 1px solid var(--ec-border);
}
.ec-block__body {
  font-size: 1.0625rem;
  line-height: 1.75;
  color: var(--ec-text);
}
.ec-block__body p { margin: 0 0 1em; }
.ec-block__body p:last-child { margin-bottom: 0; }

/* Causes list */
.ec-causes {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin: 0;
  padding: 0;
  list-style: none;
}
.ec-cause {
  display: flex;
  gap: 14px;
  align-items: flex-start;
  padding: 16px;
  background: var(--ec-warm);
  border-radius: 8px;
  border: 1px solid var(--ec-border);
  transition: border-color .2s;
}
.ec-cause:hover { border-color: rgba(27,58,107,.2); }
.ec-cause__num {
  flex-shrink: 0;
  width: 28px; height: 28px;
  background: rgba(27,58,107,.1);
  color: var(--ec-red);
  border-radius: 50%;
  font-size: .75rem;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 2px;
}
.ec-cause__title {
  font-weight: 700;
  color: var(--ec-dark);
  font-size: 1.125rem;
  margin-bottom: 4px;
}
.ec-cause__desc {
  font-size: 1.0625rem;
  color: var(--ec-muted);
  line-height: 1.6;
}

/* Steps */
.ec-steps {
  margin: 0; padding: 0;
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 0;
  counter-reset: ec-step;
}
.ec-step {
  display: flex;
  gap: 20px;
  align-items: flex-start;
  padding: 20px 0;
  border-bottom: 1px solid var(--ec-border);
  position: relative;
}
.ec-step:last-child { border-bottom: none; padding-bottom: 0; }
.ec-step:first-child { padding-top: 0; }
.ec-step__num-wrap {
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0;
}
.ec-step__num {
  width: 36px; height: 36px;
  background: var(--ec-dark);
  color: #fff;
  border-radius: 50%;
  font-size: .875rem;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  counter-increment: ec-step;
  z-index: 1;
}
.ec-step__connector {
  width: 2px;
  flex: 1;
  min-height: 20px;
  background: linear-gradient(to bottom, var(--ec-dark), transparent);
  opacity: .15;
  margin: 4px 0;
}
.ec-step:last-child .ec-step__connector { display: none; }
.ec-step__body { flex: 1; }
.ec-step__title {
  font-weight: 700;
  font-size: 1.0625rem;
  color: var(--ec-dark);
  margin-bottom: 6px;
}
.ec-step__desc {
  font-size: 1rem;
  color: var(--ec-muted);
  line-height: 1.65;
}

/* Safety warning box */
.ec-warning {
  display: flex;
  gap: 12px;
  align-items: flex-start;
  background: #fffbeb;
  border: 1px solid #fde68a;
  border-radius: 8px;
  padding: 14px 16px;
  margin-bottom: 20px;
}
.ec-warning__icon { font-size: 1.1rem; flex-shrink: 0; margin-top: 1px; }
.ec-warning__text { font-size: .95rem; color: #92400e; line-height: 1.5; }
.ec-warning__text strong { color: #78350f; }

/* When to call — highlight box */
.ec-when-box {
  background: #fff1f2;
  border: 1px solid rgba(27,58,107,.2);
  border-radius: 8px;
  padding: 20px;
  margin-top: 4px;
}
.ec-when-box__title {
  font-size: .95rem;
  font-weight: 700;
  color: var(--ec-red);
  text-transform: uppercase;
  letter-spacing: .06em;
  margin-bottom: 8px;
}
.ec-when-box p {
  font-size: 1rem;
  color: #3b1114;
  line-height: 1.65;
  margin: 0;
}

/* Cost estimate */
.ec-cost-block {
  background: var(--ec-warm);
  border: 1px solid var(--ec-border);
  border-radius: 8px;
  padding: 18px;
  margin-top: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}
.ec-cost-block__label { font-size: .78rem; color: var(--ec-muted); text-transform: uppercase; letter-spacing: .07em; }
.ec-cost-block__range { font-size: 1.5rem; font-weight: 800; color: var(--ec-dark); }
.ec-cost-block__note  { font-size: .75rem; color: var(--ec-muted); margin-top: 2px; }

/* FAQ accordion */
.ec-faq-list {
  list-style: none;
  padding: 0; margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.ec-faq-item {}
.ec-faq-btn {
  width: 100%;
  text-align: left;
  background: var(--ec-warm);
  border: 1px solid var(--ec-border);
  border-radius: 8px;
  padding: 16px 18px;
  font-size: 1rem;
  font-weight: 600;
  color: var(--ec-dark);
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  font-family: inherit;
  transition: background .15s, border-color .15s;
}
.ec-faq-btn:hover { background: #ede9e3; border-color: #c5bfb8; }
.ec-faq-btn[aria-expanded="true"] {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  border-color: rgba(27,58,107,.3);
  background: #fff;
}
.ec-faq-btn svg { flex-shrink: 0; transition: transform .2s; }
.ec-faq-btn[aria-expanded="true"] svg { transform: rotate(180deg); }
.ec-faq-panel {
  background: #fff;
  border: 1px solid rgba(27,58,107,.2);
  border-top: none;
  border-radius: 0 0 8px 8px;
  padding: 16px 18px;
  font-size: 1rem;
  color: var(--ec-muted);
  line-height: 1.7;
  display: none;
}
.ec-faq-panel.is-open { display: block; }

/* Sidebar cards */
.ec-sb-cta {
  background: var(--ec-dark);
  border-radius: var(--ec-radius);
  padding: 28px 24px;
  position: relative;
  overflow: hidden;
}
.ec-sb-cta::before {
  content: '';
  position: absolute; inset: 0;
  background: radial-gradient(ellipse 80% 80% at 50% 10%, rgba(27,58,107,.2) 0%, transparent 65%);
  pointer-events: none;
}
.ec-sb-cta__badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: .7rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--ec-red);
  margin-bottom: 12px;
}
.ec-sb-cta__title {
  font-size: 1.1rem;
  font-weight: 800;
  color: #fff;
  margin: 0 0 8px;
  line-height: 1.3;
}
.ec-sb-cta__sub {
  font-size: .82rem;
  color: rgba(255,255,255,.6);
  line-height: 1.5;
  margin: 0 0 20px;
}
.ec-sb-cta__phone {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--ec-red);
  color: #fff;
  padding: 13px 18px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 700;
  font-size: .875rem;
  margin-bottom: 10px;
  transition: background .2s;
}
.ec-sb-cta__phone:hover { background: #9E7428; }
.ec-sb-cta__book {
  display: block;
  text-align: center;
  color: rgba(255,255,255,.6);
  font-size: .8rem;
  text-decoration: underline;
  padding: 6px 0;
}
.ec-sb-cta__stats {
  display: flex;
  gap: 12px;
  margin-top: 16px;
  padding-top: 16px;
  border-top: 1px solid rgba(255,255,255,.1);
}
.ec-sb-stat { flex: 1; text-align: center; }
.ec-sb-stat__num { font-size: 1.1rem; font-weight: 800; color: #fff; }
.ec-sb-stat__label { font-size: .65rem; color: rgba(255,255,255,.45); text-transform: uppercase; letter-spacing: .06em; margin-top: 2px; }

.ec-sb-card {
  background: var(--ec-white);
  border: 1px solid var(--ec-border);
  border-radius: var(--ec-radius);
  padding: 22px;
}
.ec-sb-card__title {
  font-size: .78rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--ec-muted);
  margin-bottom: 14px;
}
.ec-sb-severity-display {
  text-align: center;
  padding: 16px 0;
}
.ec-sb-severity-display .ec-sev {
  font-size: .85rem;
  padding: 8px 20px;
}
.ec-sb-severity-display .ec-sev--low      { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
.ec-sb-severity-display .ec-sev--low::before      { background: #15803d; }
.ec-sb-severity-display .ec-sev--med      { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
.ec-sb-severity-display .ec-sev--med::before      { background: #b45309; }
.ec-sb-severity-display .ec-sev--high     { background: #fff1f2; color: #1B3A6B; border: 1px solid #fecdd3; }
.ec-sb-severity-display .ec-sev--high::before     { background: #1B3A6B; }
.ec-sb-severity-display .ec-sev--critical { background: #fef2f2; color: #991b1b; border: 1px solid #fca5a5; }
.ec-sb-severity-display .ec-sev--critical::before { background: #dc2626; }
.ec-sb-sev-tip {
  font-size: .8rem;
  color: var(--ec-muted);
  margin-top: 8px;
  text-align: center;
  line-height: 1.4;
}

.ec-related-list {
  list-style: none;
  padding: 0; margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.ec-related-list a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding: 10px 12px;
  background: var(--ec-warm);
  border: 1px solid var(--ec-border);
  border-radius: 7px;
  text-decoration: none;
  font-size: .84rem;
  color: var(--ec-text);
  transition: background .15s, border-color .15s;
}
.ec-related-list a:hover { background: var(--ec-alt); border-color: rgba(27,58,107,.2); }
.ec-related-code {
  font-family: 'Courier New', monospace;
  font-size: .75rem;
  font-weight: 800;
  color: var(--ec-red);
  background: rgba(27,58,107,.08);
  padding: 2px 7px;
  border-radius: 4px;
}
.ec-related-arrow { color: var(--ec-red); font-size: .75rem; flex-shrink: 0; }

/* Related codes grid (below article) */
.ec-related-section {
  padding: 56px 0;
  background: var(--ec-warm);
  border-top: 1px solid var(--ec-border);
}
.ec-related-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 16px;
  margin-top: 28px;
}
.ec-related-card {
  background: var(--ec-white);
  border: 1px solid var(--ec-border);
  border-radius: var(--ec-radius);
  padding: 20px;
  text-decoration: none;
  transition: transform .2s, box-shadow .2s;
  display: block;
}
.ec-related-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 20px rgba(0,0,0,.08);
}
.ec-related-card__code {
  font-family: 'Courier New', monospace;
  font-size: .8rem;
  font-weight: 800;
  color: var(--ec-red);
  background: rgba(27,58,107,.08);
  padding: 3px 9px;
  border-radius: 5px;
  display: inline-block;
  margin-bottom: 8px;
}
.ec-related-card__title {
  font-size: 1rem;
  font-weight: 700;
  color: var(--ec-dark);
  line-height: 1.3;
  margin-bottom: 4px;
}
.ec-related-card__ap {
  font-size: .78rem;
  color: var(--ec-muted);
}

/* ── Schema / SEO link at bottom ──────────────────────── */
.ec-service-link {
  padding: 32px 0;
  background: var(--ec-white);
  border-top: 1px solid var(--ec-border);
  text-align: center;
}

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 900px) {
  .ec-layout__inner {
    grid-template-columns: 1fr;
  }
  .ec-sidebar {
    position: static;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
  .ec-sb-cta { grid-column: 1 / -1; }
}
@media (max-width: 600px) {
  .ec-hero { padding: 80px 0 36px; }
  .ec-layout { padding: 36px 0 56px; }
  .ec-block { padding: 22px 18px; }
  .ec-sidebar { grid-template-columns: 1fr; }
  .ec-related-grid { grid-template-columns: 1fr 1fr; }
}
</style>

<!-- Reading Progress Bar -->
<div id="ec-progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

<!-- ── BREADCRUMBS ────────────────────────────────────────── -->
<nav class="ec-bread" aria-label="Breadcrumb">
  <div class="container">
    <ol class="ec-bread__list">
      <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
      <li class="ec-bread__sep" aria-hidden="true">/</li>
      <li><a href="<?php echo esc_url(home_url('/error-codes/')); ?>">Error Codes</a></li>
      <li class="ec-bread__sep" aria-hidden="true">/</li>
      <li><a href="<?php echo esc_url(add_query_arg('appliance', sanitize_title($appliance), home_url('/error-codes/'))); ?>"><?php echo esc_html($appliance); ?></a></li>
      <li class="ec-bread__sep" aria-hidden="true">/</li>
      <li class="ec-bread__current"><?php echo esc_html("{$brand} {$code}"); ?></li>
    </ol>
  </div>
</nav>

<!-- ── HERO ──────────────────────────────────────────────── -->
<section class="ec-hero" aria-labelledby="ec-h1">
  <div class="container">
    <div class="ec-hero__inner">
      <div class="ec-hero__meta">
        <span class="ec-hero__code-pill">&#x26A0; <?php echo esc_html($code); ?></span>
        <span class="ec-sev <?php echo esc_attr($sev['cls']); ?>"><?php echo esc_html($sev['label']); ?> Severity</span>
        <span class="ec-hero__brand-chip"><?php echo esc_html("{$brand} {$appliance}"); ?></span>
      </div>

      <h1 class="ec-hero__h1" id="ec-h1">
        <?php echo esc_html("{$brand} {$appliance} {$code}"); ?> Error Code: What It Means &amp; How to Fix It
      </h1>

      <p class="ec-hero__sub">
        Authoritative diagnosis guide — causes, step-by-step troubleshooting, and when to call a certified <?php echo esc_html($brand); ?> technician.
      </p>

      <div class="ec-hero__btns">
        <a href="#ec-steps" class="ec-btn--red">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          Try These Steps First
        </a>
        <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="ec-btn--outline">&#x1F4DE; Call a Technician</a>
      </div>
    </div>
  </div>
</section>

<!-- ── TRUST BAR ─────────────────────────────────────────── -->
<div class="ec-trust">
  <div class="container">
    <div class="ec-trust__inner">
      <div class="ec-trust__item">&#x2713; <strong>Certified <?php echo esc_html($brand); ?> Technicians</strong></div>
      <div class="ec-trust__item">&#x2713; <strong>Same-Day</strong> Appointments</div>
      <div class="ec-trust__item">&#x2713; <strong>OEM Parts</strong> Only</div>
      <div class="ec-trust__item">&#x2713; <strong>30-Day</strong> Parts &amp; Labor Warranty</div>
    </div>
  </div>
</div>

<!-- ── MAIN LAYOUT ───────────────────────────────────────── -->
<div class="ec-layout" id="ec-content">
  <div class="container">
    <div class="ec-layout__inner">

      <!-- ARTICLE -->
      <article class="ec-article">

        <!-- What It Means -->
        <div class="ec-block" id="ec-meaning">
          <p class="ec-block__eyebrow">Error Code Explained</p>
          <h2 class="ec-block__h2">What Does the <?php echo esc_html("{$brand} {$code}"); ?> Error Code Mean?</h2>
          <div class="ec-block__body">
            <?php if ($meaning): echo wp_kses_post(wpautop($meaning));
            else: ?>
            <p>The <strong><?php echo esc_html($code); ?></strong> error code on a <?php echo esc_html("{$brand} {$appliance}"); ?> indicates a specific fault that is preventing the appliance from operating normally. This is a diagnostic code built into your <?php echo esc_html($brand); ?> <?php echo esc_html(strtolower($appliance)); ?>'s onboard system — designed to protect the appliance and alert you to an issue requiring attention.</p>
            <p>When the <?php echo esc_html($code); ?> code appears, the appliance will typically halt its current cycle and refuse to continue until the underlying issue is resolved.</p>
            <?php endif; ?>
            <?php ar_disclaimer($brand); ?>
          </div>
        </div>

        <!-- Common Causes -->
        <?php if (!empty($causes)): ?>
        <div class="ec-block" id="ec-causes">
          <p class="ec-block__eyebrow">Root Causes</p>
          <h2 class="ec-block__h2">Common Causes of the <?php echo esc_html("{$brand} {$code}"); ?> Error Code</h2>
          <ul class="ec-causes">
            <?php foreach ($causes as $i => $cause): ?>
            <li class="ec-cause">
              <div class="ec-cause__num"><?php echo $i + 1; ?></div>
              <div>
                <div class="ec-cause__title"><?php echo esc_html($cause['title']); ?></div>
                <div class="ec-cause__desc"><?php echo esc_html($cause['description']); ?></div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <!-- DIY Steps -->
        <?php if (!empty($steps)): ?>
        <div class="ec-block" id="ec-steps">
          <p class="ec-block__eyebrow">Step-by-Step Guide</p>
          <h2 class="ec-block__h2">How to Troubleshoot the <?php echo esc_html($code); ?> Error Code</h2>

          <div class="ec-warning">
            <span class="ec-warning__icon">&#x26A0;️</span>
            <p class="ec-warning__text"><strong>Safety First:</strong> Always disconnect the <?php echo esc_html($appliance); ?> from power before inspecting any internal components. Do not attempt electrical repairs. If in doubt, call a certified technician.</p>
          </div>

          <ol class="ec-steps" itemscope itemtype="https://schema.org/HowTo">
            <meta itemprop="name" content="How to fix <?php echo esc_attr("{$brand} {$code}"); ?> error code">
            <?php foreach ($steps as $i => $step): ?>
            <li class="ec-step" itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
              <meta itemprop="position" content="<?php echo $i + 1; ?>">
              <div class="ec-step__num-wrap">
                <div class="ec-step__num"><?php echo $i + 1; ?></div>
                <div class="ec-step__connector"></div>
              </div>
              <div class="ec-step__body">
                <div class="ec-step__title" itemprop="name"><?php echo esc_html($step['title']); ?></div>
                <div class="ec-step__desc" itemprop="text"><?php echo esc_html($step['description']); ?></div>
              </div>
            </li>
            <?php endforeach; ?>
          </ol>
        </div>
        <?php endif; ?>

        <!-- When to Call -->
        <div class="ec-block" id="ec-when">
          <p class="ec-block__eyebrow">Professional Service</p>
          <h2 class="ec-block__h2">When to Call a <?php echo esc_html($brand); ?> Technician</h2>
          <div class="ec-when-box">
            <div class="ec-when-box__title">&#x26A0; Stop DIY if any of these apply</div>
            <?php if ($when_call): ?>
              <p><?php echo esc_html($when_call); ?></p>
            <?php else: ?>
              <p>If the <?php echo esc_html($code); ?> error returns after completing the troubleshooting steps above, or if you identify damaged internal components during your inspection, professional repair is the correct next step. Continued operation with an unresolved fault risks further damage and may void any existing coverage.</p>
            <?php endif; ?>
          </div>

          <div class="ec-cost-block">
            <div>
              <div class="ec-cost-block__label">Estimated Repair Cost</div>
              <div class="ec-cost-block__range"><?php echo esc_html($cost); ?></div>
              <div class="ec-cost-block__note">Exact quote before any work begins. No surprises.</div>
            </div>
            <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="ec-btn--red">&#x1F4DE; <?php echo esc_html($phone); ?></a>
          </div>
        </div>

        <!-- FAQ -->
        <?php if (!empty($faqs)): ?>
        <div class="ec-block" id="ec-faq">
          <p class="ec-block__eyebrow">FAQ</p>
          <h2 class="ec-block__h2">Frequently Asked Questions — <?php echo esc_html("{$brand} {$code}"); ?></h2>
          <ul class="ec-faq-list" itemscope itemtype="https://schema.org/FAQPage">
            <?php foreach ($faqs as $i => $faq): ?>
            <li class="ec-faq-item" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
              <button class="ec-faq-btn" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="ec-faq-panel-<?php echo $i; ?>" itemprop="name">
                <?php echo esc_html($faq['question']); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div id="ec-faq-panel-<?php echo $i; ?>" class="ec-faq-panel<?php echo $i === 0 ? ' is-open' : ''; ?>" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
                <span itemprop="text"><?php echo esc_html($faq['answer']); ?></span>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <!-- Appointment Form -->
        <div class="ec-block" id="book">
          <?php ar_appointment_form('error-code', "Book a {$brand} {$appliance} Repair Appointment"); ?>
        </div>

      </article>
    
    </div>
  </div>
</div>

<!-- ── RELATED CODES SECTION ─────────────────────────────── -->
<?php if (!empty($related)): ?>
<section class="ec-related-section">
  <div class="container">
    <div style="margin-bottom:4px;">
      <p style="font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ec-red);margin-bottom:6px;">More Codes</p>
      <h2 style="font-size:1.5rem;font-weight:800;color:var(--ec-dark);margin:0;">Related <?php echo esc_html("{$brand} {$appliance}"); ?> Error Codes</h2>
    </div>
    <div class="ec-related-grid">
      <?php foreach ($related as $rel):
        $rc = get_post_meta($rel->ID, '_ar_error_code', true);
        $ra = get_post_meta($rel->ID, '_ar_appliance_type', true);
      ?>
      <a href="<?php echo esc_url(get_permalink($rel->ID)); ?>" class="ec-related-card">
        <?php if ($rc): ?><span class="ec-related-card__code"><?php echo esc_html($rc); ?></span><?php endif; ?>
        <div class="ec-related-card__title"><?php echo esc_html(get_the_title($rel->ID)); ?></div>
        <?php if ($ra): ?><div class="ec-related-card__ap"><?php echo esc_html($ra); ?></div><?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Service link -->
<div class="ec-service-link">
  <div class="container">
    <p style="font-size:.875rem;color:var(--ec-muted);margin:0;">
      Looking for full repair information? Visit our
      <a href="<?php echo esc_url($service_url); ?>" style="color:var(--ec-red);font-weight:600;"><?php echo esc_html("{$brand} {$appliance} Repair"); ?> service page →</a>
    </p>
  </div>
</div>

<?php
/* Schema JSON-LD */
$schema = [
    '@context'        => 'https://schema.org',
    '@type'           => 'TechArticle',
    'headline'        => get_the_title(),
    'description'     => "How to diagnose and fix the {$brand} {$appliance} {$code} error code — causes, troubleshooting steps, and when to call a technician.",
    'about'           => ['@type' => 'Thing', 'name' => "{$brand} {$appliance} {$code} Error Code"],
    'articleSection'  => 'Appliance Repair',
    'author'          => ['@type' => 'Organization', 'name' => $biz],
    'publisher'       => ['@type' => 'Organization', 'name' => $biz],
    'dateModified'    => get_the_modified_date('c'),
    'datePublished'   => get_the_date('c'),
];
ar_output_schema($schema);
?>

<script>
(function(){
  /* Reading progress bar */
  const bar = document.getElementById('ec-progress');
  if (bar) {
    function updateProgress() {
      const h = document.documentElement;
      const prog = (h.scrollTop || document.body.scrollTop) / ((h.scrollHeight || document.body.scrollHeight) - h.clientHeight) * 100;
      bar.style.width = Math.min(prog, 100) + '%';
    }
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
  }

  /* FAQ accordion */
  document.querySelectorAll('.ec-faq-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const panel = document.getElementById(btn.getAttribute('aria-controls'));
      const open  = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', !open);
      panel.classList.toggle('is-open', !open);
    });
  });
})();
</script>

<?php get_footer(); ?>


