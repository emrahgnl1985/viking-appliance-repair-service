<?php
/**
 * Template: Error Code — OBSIDIAN Design System
 *
 * ACF Fields:
 *   _ar_brand, _ar_appliance_type, _ar_error_code, _ar_code_meaning,
 *   _ar_causes[], _ar_diy_steps[], _ar_when_to_call,
 *   _ar_cost_range, _ar_severity, _ar_faqs[]
 */
defined('ABSPATH') || exit;

$pid       = get_the_ID();
$brand     = get_post_meta($pid, '_ar_brand',          true) ?: 'Viking';
$appliance = get_post_meta($pid, '_ar_appliance_type', true) ?: 'Appliance';
$code      = get_post_meta($pid, '_ar_error_code',     true) ?: '';
$meaning   = get_post_meta($pid, '_ar_code_meaning',   true) ?: '';
$causes    = get_post_meta($pid, '_ar_causes',          true) ?: [];
$steps     = get_post_meta($pid, '_ar_diy_steps',       true) ?: [];
$when_call = get_post_meta($pid, '_ar_when_to_call',    true) ?: '';
$cost      = get_post_meta($pid, '_ar_cost_range',      true) ?: '$80 – $250';
$faqs      = get_post_meta($pid, '_ar_faqs',            true) ?: [];
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();
$service_url = home_url('/services/' . strtolower($brand) . '-' . strtolower($appliance) . '-repair/');

// Severity
$severity_stored = get_post_meta($pid, '_ar_severity', true);
switch ($severity_stored) {
    case 'Critical': $sev = ['label'=>'Critical','cls'=>'critical','tip'=>'Stop using immediately. Safety risk — call a technician now.']; break;
    case 'High':     $sev = ['label'=>'High',    'cls'=>'high',    'tip'=>'Stop using the appliance and call a technician.']; break;
    case 'Medium':   $sev = ['label'=>'Medium',  'cls'=>'medium',  'tip'=>'Professional repair recommended.']; break;
    case 'Low':      $sev = ['label'=>'Low',     'cls'=>'low',     'tip'=>'Often resolved with basic troubleshooting.']; break;
    default:
        preg_match('/\$(\d+)/', $cost, $m); $cost_start = (int)($m[1] ?? 0);
        if      ($cost_start >= 200) $sev = ['label'=>'High',  'cls'=>'high',  'tip'=>'Stop using the appliance and call a technician.'];
        elseif  ($cost_start >= 90)  $sev = ['label'=>'Medium','cls'=>'medium','tip'=>'Professional repair recommended.'];
        else                         $sev = ['label'=>'Low',   'cls'=>'low',   'tip'=>'Often resolved with basic troubleshooting.'];
}

$sev_style_map = [
    'critical' => 'background:#FBE8EA;color:#C01C28;border-color:rgba(192,28,40,0.25);',
    'high'     => 'background:#FEF9EC;color:#92400E;border-color:rgba(146,64,14,0.2);',
    'medium'   => 'background:#FEF3E2;color:#C45C00;border-color:rgba(196,92,0,0.2);',
    'low'      => 'background:#E6F5EE;color:#1A7A4A;border-color:rgba(26,122,74,0.2);',
];
$sev_style = $sev_style_map[$sev['cls']] ?? '';

// Fallbacks
if (empty($causes)) $causes = [
    ['title'=>'Component failure',           'description'=>"An internal component specific to the {$code} fault has failed and requires replacement with genuine Viking OEM parts."],
    ['title'=>'Blocked or restricted system','description'=>"A blockage or restriction in the relevant system is preventing normal operation."],
    ['title'=>'Sensor or control fault',     'description'=>"A malfunctioning sensor or control board is incorrectly reporting a fault condition."],
    ['title'=>'Normal wear over time',       'description'=>"Long-term wear has caused this component to fail — a common occurrence in high-use appliances."],
];
if (empty($steps)) $steps = [
    ['title'=>'Power off and disconnect',   'description'=>"Switch off and unplug the {$appliance} — or turn off its dedicated circuit breaker. Wait 5 minutes."],
    ['title'=>'Perform a basic inspection', 'description'=>"Check for blockages, standing water, disconnected hoses, or visible damage."],
    ['title'=>'Reset the appliance',        'description'=>"Reconnect power and run a short test cycle. Monitor closely to see if the {$code} error clears."],
    ['title'=>'Check for recurrence',       'description'=>"If the error returns, the underlying fault is not self-correcting — proceed to professional diagnosis."],
];
if (empty($faqs)) $faqs = [
    ['question'=>"Is the {$brand} {$code} error dangerous?",              'answer'=>"The {$code} code is a safety indicator. The underlying cause, if left unaddressed, can lead to further damage or safety risks. Address it promptly."],
    ['question'=>"Can I reset the {$code} error by unplugging?",          'answer'=>"A power reset may temporarily clear the code. However, if the underlying fault remains, {$code} will reappear. A reset is a diagnostic step, not a repair."],
    ['question'=>"How long does a {$brand} {$code} repair take?",         'answer'=>"Most repairs are completed in 1–2 hours on a single visit using genuine Viking OEM parts."],
    ['question'=>"What does the {$brand} {$code} repair cost?",           'answer'=>"Repair costs depend on the component causing the fault. Typical range: {$cost}. We provide an exact upfront quote after diagnosis."],
    ['question'=>"Should I keep using my {$appliance} with {$code} error?",'answer'=>"We recommend stopping use until the fault is diagnosed. Continued operation can cause additional damage to other components."],
];

$related = ar_get_related_error_codes($brand, $appliance, 4, $pid);

get_header();

// Schema
ar_output_schema([
    '@context' => 'https://schema.org',
    '@graph'   => array_filter([
        ['@type'=>'TechArticle','headline'=>get_the_title(),'description'=>"{$brand} {$appliance} error code {$code}: {$meaning}. Causes, DIY steps, and when to call a technician.",'url'=>get_permalink(),'publisher'=>['@type'=>'LocalBusiness','name'=>$biz],'about'=>['@type'=>'Product','name'=>"{$brand} {$appliance}","manufacturer"=>['@type'=>'Organization','name'=>$brand]]],
        !empty($faqs) ? ['@type'=>'FAQPage','mainEntity'=>array_map(fn($f)=>['@type'=>'Question','name'=>$f['question'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['answer']]],$faqs)] : null,
        ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>home_url('/')],['@type'=>'ListItem','position'=>2,'name'=>'Fault Codes','item'=>home_url('/error-codes/')],['@type'=>'ListItem','position'=>3,'name'=>get_the_title()]]],
    ]),
]);
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
</style>

<!-- ── HERO ──────────────────────────────────── -->
<section class="ec-hero" aria-labelledby="ec-h1">
  <div class="container">
    <div class="ph-split">
      <div class="ph-split__text">
        <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:var(--space-6);">
          <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <a href="<?php echo esc_url(home_url('/error-codes/')); ?>">Fault Codes</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html($brand); ?> <?php echo esc_html($code); ?></span>
        </nav>

        <?php if ($code): ?>
        <div class="ec-hero__code" aria-label="Error code: <?php echo esc_attr($code); ?>"><?php echo esc_html($code); ?></div>
        <?php endif; ?>

        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;flex-wrap:wrap;">
          <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;border:1px solid;padding:5px 12px;border-radius:2px;<?php echo $sev_style; ?>">
            <?php echo esc_html($sev['label']); ?> Severity
          </span>
          <span style="font-family:'Manrope',sans-serif;font-size:12px;color:var(--color-text-muted);">
            <?php echo esc_html($sev['tip']); ?>
          </span>
        </div>

        <h1 class="ec-hero__title" id="ec-h1">
          <?php echo esc_html(get_the_title()); ?>
        </h1>

        <?php if ($meaning): ?>
        <p class="ec-hero__sub"><?php echo esc_html($meaning); ?></p>
        <?php endif; ?>

        <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:center;">
          <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--primary btn--lg">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            Book Repair — <?php echo esc_html($phone); ?>
          </a>
          <a href="<?php echo esc_url($service_url); ?>" class="btn btn--outline btn--lg"><?php echo esc_html("{$brand} {$appliance} Repair"); ?> &rarr;</a>
        </div>
      </div>
      <div class="ph-split__img">
        <?php
        $hero_img_map = [
            'range'        => 'viking-kitchen-miramar.jpg',
            'refrigerator' => 'viking-refrigerator-3series.jpg',
            'dishwasher'   => 'viking-dishwasher-7series.jpg',
            'cooktop'      => 'viking-cooktop-rangetop.jpg',
            'wall oven'    => 'viking-wall-oven-7series.jpg',
            'wall-oven'    => 'viking-wall-oven-7series.jpg',
            'wine cooler'  => 'viking-wine-cellar.jpg',
            'wine-cooler'  => 'viking-wine-cellar.jpg',
            'freezer'      => 'viking-refrigerator-integrated.jpg',
            'vent hood'    => 'viking-5series-kitchen.jpg',
            'vent-hood'    => 'viking-5series-kitchen.jpg',
        ];
        $hero_img = $hero_img_map[strtolower($appliance)] ?? 'viking-3series-feature.jpg';
        ?>
        <img src="<?php echo esc_url(AR_URI . '/assets/images/' . $hero_img); ?>"
             alt="<?php echo esc_attr("{$brand} {$appliance} — {$code} fault code repair"); ?>"
             loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ── CAUSES ─────────────────────────────────── -->
<?php if (!empty($causes)): ?>
<section class="section" style="border-bottom:1px solid var(--color-rule);" aria-labelledby="causes-h2">
  <div class="container">
    <div class="section-header">
      <span class="section-header__eyebrow">Root Causes</span>
      <h2 id="causes-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 0;line-height:1.1;">
        What Causes the <?php echo esc_html($code); ?> Error?
      </h2>
    </div>
    <div class="grid grid-2" style="gap:var(--space-4);">
      <?php foreach ($causes as $i => $cause): ?>
      <div class="issue-card">
        <div style="font-family:'Cormorant',Georgia,serif;font-size:2rem;font-weight:300;color:var(--color-rule);line-height:1;letter-spacing:-0.04em;margin-bottom:12px;" aria-hidden="true"><?php echo str_pad($i+1,2,'0',STR_PAD_LEFT); ?></div>
        <div class="issue-card__title"><?php echo esc_html($cause['title']); ?></div>
        <p class="issue-card__desc"><?php echo esc_html($cause['description']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── DIY STEPS ──────────────────────────────── -->
<?php if (!empty($steps)): ?>
<section class="section" style="background:var(--color-bg-light);border-bottom:1px solid var(--color-rule);" aria-labelledby="steps-h2">
  <div class="container container--narrow">
    <div class="section-header">
      <span class="section-header__eyebrow">Troubleshooting Steps</span>
      <h2 id="steps-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 0;line-height:1.1;">
        Basic Steps Before Calling a Technician
      </h2>
    </div>
    <div class="warning-box" style="margin-bottom:var(--space-8);">
      <div class="warning-box__icon" aria-hidden="true">&#x26A0;</div>
      <div class="warning-box__text"><strong>Safety first:</strong> Always disconnect power before inspecting your <?php echo esc_html($appliance); ?>. Do not attempt repairs beyond your skill level.</div>
    </div>
    <ol class="howto-steps">
      <?php foreach ($steps as $i => $step): ?>
      <li class="howto-step">
        <div class="howto-step__num" aria-label="Step <?php echo $i+1; ?>"><?php echo str_pad($i+1,2,'0',STR_PAD_LEFT); ?></div>
        <div>
          <div class="howto-step__title"><?php echo esc_html($step['title']); ?></div>
          <p class="howto-step__desc"><?php echo esc_html($step['description']); ?></p>
        </div>
      </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
<?php endif; ?>

<!-- ── WHEN TO CALL / COST ─────────────────────── -->
<section class="section" style="border-bottom:1px solid var(--color-rule);" aria-labelledby="when-h2">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:start;">
      <div>
        <span class="section-header__eyebrow">Professional Repair</span>
        <h2 id="when-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.5rem,2.5vw,2rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 16px;line-height:1.1;">
          When to Call a Technician
        </h2>
        <?php if ($when_call): ?>
        <p style="font-size:15px;color:var(--color-text-muted);line-height:1.75;"><?php echo wp_kses_post(wpautop($when_call)); ?></p>
        <?php else: ?>
        <p style="font-size:15px;color:var(--color-text-muted);line-height:1.75;">If the <?php echo esc_html($code); ?> error persists after basic troubleshooting, a component has failed and requires professional diagnosis and genuine Viking OEM part replacement. Continued operation can cause additional damage.</p>
        <?php endif; ?>
        <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--primary btn--lg" style="margin-top:var(--space-6);">
          Book a Technician &rarr;
        </a>
      </div>
      <div>
        <span class="section-header__eyebrow">Estimated Repair Cost</span>
        <div style="font-family:'Cormorant',Georgia,serif;font-size:clamp(3rem,5vw,5rem);font-weight:300;color:#0D0D0D;line-height:1;letter-spacing:-0.04em;margin:10px 0 12px;"><?php echo esc_html($cost); ?></div>
        <p style="font-size:13px;color:var(--color-text-muted);line-height:1.65;margin-bottom:var(--space-4);">Estimated range for parts and labor. Your technician provides an exact upfront quote before any work begins. Diagnostic fee is applied toward the repair cost.</p>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px;">
          <?php foreach (['Genuine Viking OEM parts only','30-day parts & labor warranty','Upfront pricing — no hidden fees','Same-day service available'] as $p): ?>
          <li style="display:flex;align-items:center;gap:10px;font-family:'Manrope',sans-serif;font-size:13px;color:var(--color-text-muted);">
            <span style="display:block;width:20px;height:1.5px;background:#C01C28;flex-shrink:0;"></span>
            <?php echo esc_html($p); ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ── RELATED CODES ──────────────────────────── -->
<?php if (!empty($related)): ?>
<style>
.ec-related { background: var(--color-bg-light); border-top: 1px solid var(--color-rule); border-bottom: 1px solid var(--color-rule); padding: var(--section-sm) 0; }
.ec-related__grid { display: grid; grid-template-columns: 1fr 380px; gap: 4rem; align-items: start; }
.ec-related__list { display: flex; flex-direction: column; }
.ec-related__item {
  display: flex; align-items: center; justify-content: space-between;
  gap: 16px; padding: 18px 0; border-bottom: 1px solid var(--color-rule);
  text-decoration: none; color: #0D0D0D;
  position: relative; transition: color 0.12s ease;
}
.ec-related__item:first-child { border-top: 1px solid var(--color-rule); }
.ec-related__item::before {
  content: ''; position: absolute; top: 0; bottom: 0; left: -1px;
  width: 0; background: #C01C28; transition: width 0.14s ease;
}
.ec-related__item:hover { color: #C01C28; }
.ec-related__item:hover::before { width: 2px; }
.ec-related__item:hover .ec-related__arrow { color: #C01C28; }
.ec-related__title {
  font-family: 'Cormorant', Georgia, serif;
  font-size: 1.125rem; font-weight: 500;
  letter-spacing: -0.01em; line-height: 1.25;
  flex: 1; min-width: 0;
}
.ec-related__arrow { color: #D9D8D3; flex-shrink: 0; transition: color 0.12s ease, transform 0.14s ease; }
.ec-related__item:hover .ec-related__arrow { transform: translateX(4px); }
.ec-related__cta { margin-top: 20px; }
/* Image panel */
.ec-related__img { position: relative; overflow: hidden; border-radius: 2px; aspect-ratio: 4/5; }
.ec-related__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
.ec-related__img-badge {
  position: absolute; bottom: 0; left: 0; right: 0;
  background: linear-gradient(to top, rgba(13,13,13,0.85) 0%, transparent 100%);
  padding: 28px 20px 20px;
}
.ec-related__img-badge-text {
  font-family: 'Manrope', sans-serif; font-size: 11px; font-weight: 700;
  letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.6);
  margin-bottom: 4px; display: block;
}
.ec-related__img-badge-title {
  font-family: 'Cormorant', Georgia, serif; font-size: 1.25rem; font-weight: 400;
  color: #fff; line-height: 1.2; letter-spacing: -0.01em;
}
@media (max-width: 900px) {
  .ec-related__grid { grid-template-columns: 1fr; gap: 2rem; }
  .ec-related__img { aspect-ratio: 16/7; }
}
@media (max-width: 480px) {
  .ec-related__item { padding: 14px 0; }
  .ec-related__title { font-size: 1rem; }
}
</style>

<section class="ec-related" aria-labelledby="related-h2">
  <div class="container">
    <div class="ec-related__grid">

      <!-- List -->
      <div>
        <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#C01C28;display:block;margin-bottom:12px;">Related Error Codes</span>
        <h2 id="related-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.625rem,2.5vw,2.25rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:0 0 var(--space-6);line-height:1.1;">
          Other <?php echo esc_html($brand); ?> <?php echo esc_html($appliance); ?> Fault Codes
        </h2>

        <div class="ec-related__list" role="list">
          <?php foreach ($related as $rel): ?>
          <a href="<?php echo esc_url(get_permalink($rel->ID)); ?>" class="ec-related__item" role="listitem">
            <span class="ec-related__title"><?php echo esc_html($rel->post_title); ?></span>
            <svg class="ec-related__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <?php endforeach; ?>
        </div>

        <div class="ec-related__cta">
          <a href="<?php echo esc_url(home_url('/error-codes/')); ?>" class="btn btn--outline btn--lg">
            All <?php echo esc_html($brand); ?> Fault Codes &rarr;
          </a>
        </div>
      </div>

      <!-- Image panel -->
      <div class="ec-related__img">
        <?php
        $ec_img_map = [
            'range'        => 'viking-kitchen-miramar.jpg',
            'refrigerator' => 'viking-refrigerator-3series.jpg',
            'dishwasher'   => 'viking-dishwasher-7series.jpg',
            'cooktop'      => 'viking-cooktop-rangetop.jpg',
            'wall-oven'    => 'viking-wall-oven-7series.jpg',
            'wall oven'    => 'viking-wall-oven-7series.jpg',
            'wine-cooler'  => 'viking-wine-cellar.jpg',
            'wine cooler'  => 'viking-wine-cellar.jpg',
            'freezer'      => 'viking-refrigerator-integrated.jpg',
            'vent-hood'    => 'viking-5series-kitchen.jpg',
            'vent hood'    => 'viking-5series-kitchen.jpg',
        ];
        $ec_img_key = strtolower($appliance);
        $ec_img     = $ec_img_map[$ec_img_key] ?? 'viking-3series-feature.jpg';
        ?>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $ec_img); ?>"
             alt="<?php echo esc_attr("Viking {$appliance} — related fault codes"); ?>"
             loading="lazy">
        <div class="ec-related__img-badge">
          <span class="ec-related__img-badge-text">Viking <?php echo esc_html($appliance); ?></span>
          <span class="ec-related__img-badge-title">Genuine OEM Parts &amp; Expert Diagnosis</span>
        </div>
      </div>

    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── FAQ ────────────────────────────────────── -->
<?php ar_faq_section($faqs, "Viking {$code} Error Code — Frequently Asked Questions"); ?>

<!-- ── APPOINTMENT ────────────────────────────── -->
<?php ar_appointment_form('error-code-page', "Fix Your Viking {$code} Error Code Today"); ?>

<?php get_footer(); ?>
