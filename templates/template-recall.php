<?php
/**
 * Template: Recall — Single Page
 * Design: matches mielerepairguide.com/safety/recalls/ single pages
 */
defined('ABSPATH') || exit;

global $post;
$pid       = $post->ID;
$brand     = ar_meta($pid, '_ar_brand', '');
$hero_img  = ar_meta($pid, '_ar_hero_image', '');
$phone     = ar_get_phone();
$phone_raw = get_option('ar_phone_raw', '+18000000000');
$biz       = ar_get_business_name();
$title     = get_the_title();
$pub_date  = get_the_date('F j, Y');
$mod_date  = get_the_modified_date('F j, Y');

/* Schema — stored for output after get_header() */
$_schema_data = [
    '@context'      => 'https://schema.org',
    '@type'         => 'Article',
    'headline'      => $title,
    'url'           => get_permalink(),
    'datePublished' => get_the_date('c'),
    'dateModified'  => get_the_modified_date('c'),
    'author'        => ['@type' => 'Organization', 'name' => $biz],
    'publisher'     => ['@type' => 'Organization', 'name' => $biz],
    'about'         => ['@type' => 'Thing', 'name' => $brand . ' Appliance Recall'],
];

get_header();
ar_output_schema($_schema_data);
?>
<style>
/* ── Recall Single — Scoped Styles ─────────────────────── */
:root{
  --rc-red:    #1B3A6B;
  --rc-dark:   #1a1a1a;
  --rc-warm:   #f8f6f3;
  --rc-alt:    #f2f0ed;
  --rc-white:  #ffffff;
  --rc-border: #e5e0da;
  --rc-text:   #2c2c2c;
  --rc-muted:  #6b6560;
  --rc-radius: 10px;

}

/* Progress bar */
#rc-progress {
  position: fixed; top:0; left:0;
  height: 3px; width: 0%;
  background: var(--rc-red);
  z-index: 9999;
  transition: width .1s linear;
}

/* Breadcrumbs */
.rc-bread {
  background: var(--rc-warm);
  border-bottom: 1px solid var(--rc-border);
  padding: 12px 0;
}
.rc-bread__list {
  display: flex; align-items: center; gap: 6px;
  list-style: none; margin: 0; padding: 0;
  font-size: .8rem; flex-wrap: wrap;
}
.rc-bread__list a { color: var(--rc-muted); text-decoration: none; }
.rc-bread__list a:hover { color: var(--rc-red); }
.rc-bread__sep { color: #ccc; }
.rc-bread__current { color: var(--rc-text); font-weight: 600; }

/* Hero */
.rc-hero {
  /* background: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg'); ?>') no-repeat center center; */
  background-size: cover;
  border-bottom: 1px solid var(--clr-border);
  /* Optional: fallback color if image fails to load */
  background:  linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);;
  padding: 72px 0 56px;
  position: relative;
  overflow: hidden;
}

.rc-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  pointer-events: none;
  z-index: 0;
  background: rgba(0,0,0,0.35); /* semi-transparent dark */
  /* background: radial-gradient(ellipse 70% 60% at 65% 40%, rgba(27,58,107,.15) 0%, transparent 65%); */
}
.rc-hero__inner {
   max-width: 780px;
   position: relative;
   z-index: 1;
   padding: 24px;
  border-radius: 10px;
}
.rc-hero__alert-pill {
  display: inline-flex; align-items: center; gap: 7px;
  background: rgba(27,58,107,.2);
  border: 1px solid rgba(27,58,107,.35);
  color: #fca5a5;
  font-size: .72rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .1em;
  padding: 5px 14px; border-radius: 20px;
  margin-bottom: 16px;
}
.rc-hero__h1 {
  font-size: clamp(1.6rem, 3.5vw, 2.4rem);
  font-weight: 800; color: #fff;
  line-height: 1.2; margin: 0 0 14px;
}
.rc-hero__sub {
  font-size: .9375rem; color: rgba(255,255,255,.65);
  line-height: 1.65; margin: 0 0 28px; max-width: 640px;
}
.rc-hero__meta-row {
  display: flex; align-items: center; gap: 16px; flex-wrap: wrap;
  padding-top: 24px; border-top: 1px solid rgba(255,255,255,.1);
}
.rc-hero__meta-item { font-size: .78rem; color: rgba(255,255,255,.5); }
.rc-hero__meta-item strong { color: rgba(255,255,255,.8); }
.rc-hero__btns { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px; }
.rc-btn--red   { background:var(--rc-red); color:#fff; padding:12px 26px; border-radius:50px; font-size:.875rem; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:background .2s; }
.rc-btn--red:hover { background:#a01320; }
.rc-btn--outline { color:rgba(255,255,255,.8); padding:12px 26px; border-radius:50px; font-size:.875rem; font-weight:600; text-decoration:none; display:inline-block; border:1.5px solid rgba(255,255,255,.2); transition:background .2s; }
.rc-btn--outline:hover { background:rgba(255,255,255,.08); }

/* Safety notice bar */
.rc-notice {
  background: #fff8f0; border-bottom: 1px solid #fde68a; padding: 11px 0;
}
.rc-notice__inner {
  display: flex; align-items: flex-start; gap: 10px;
  font-size: .84rem; color: #92400e; line-height: 1.5;
}
.rc-notice__inner a { color: #b45309; font-weight: 600; }

/* Layout */
.rc-layout {
  padding: 52px 0 80px; background: var(--rc-warm);
}
.rc-layout__inner {
  display: grid;
  grid-template-columns: 1fr 280px;
  gap: 28px; align-items: start;
}
.rc-article { min-width: 0; display: flex; flex-direction: column; gap: 20px; }
.rc-sidebar  { display: flex; flex-direction: column; gap: 18px; position: sticky; top: 90px; }

/* Article blocks */
.rc-block {
  background: var(--rc-white);
  border: 1px solid var(--rc-border);
  border-radius: var(--rc-radius);
  padding: 28px 32px;
}
.rc-block__eyebrow {
  font-size: .7rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .1em; color: var(--rc-red);
  display: flex; align-items: center; gap: 6px; margin-bottom: 8px;
}
.rc-block__eyebrow::before { content:''; width:16px; height:2px; background:var(--rc-red); }
.rc-block__h2 {
  font-size: 1.2rem; font-weight: 800; color: var(--rc-dark);
  margin: 0 0 18px; padding-bottom: 14px; border-bottom: 1px solid var(--rc-border);
}
.rc-block__body { font-size: .9375rem; line-height: 1.75; color: var(--rc-text); }
.rc-block__body p { margin: 0 0 1em; }
.rc-block__body p:last-child { margin-bottom: 0; }

/* Urgency / action steps */
.rc-urgency {
  background: #fff1f2;
  border: 1.5px solid rgba(27,58,107,.25);
  border-radius: var(--rc-radius);
  padding: 24px 28px;
}
.rc-urgency__label {
  font-size: .72rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .1em; color: var(--rc-red); margin-bottom: 14px;
  display: flex; align-items: center; gap: 6px;
}
.rc-urgency__steps {
  list-style: none; margin: 0; padding: 0;
  display: flex; flex-direction: column; gap: 12px;
  counter-reset: urg;
}
.rc-urgency__step {
  display: flex; gap: 12px; align-items: flex-start;
}
.rc-urgency__step-num {
  flex-shrink: 0;
  width: 26px; height: 26px;
  background: var(--rc-red); color: #fff;
  border-radius: 50%;
  font-size: .75rem; font-weight: 800;
  display: flex; align-items: center; justify-content: center;
  counter-increment: urg;
}
.rc-urgency__step-text { font-size: .875rem; color: #3b1114; line-height: 1.5; padding-top: 3px; }
.rc-urgency__step-text strong { color: #1a0608; }

/* Content body */
.rc-content-body { font-size: .9375rem; line-height: 1.8; color: var(--rc-text); }
.rc-content-body h2 { font-size:1.15rem; font-weight:800; color:var(--rc-dark); margin:1.5em 0 .6em; }
.rc-content-body h3 { font-size:1rem; font-weight:700; color:var(--rc-dark); margin:1.25em 0 .5em; }
.rc-content-body p  { margin:0 0 1em; }
.rc-content-body ul, .rc-content-body ol { padding-left:1.4em; margin:0 0 1em; }
.rc-content-body li { margin-bottom:.4em; line-height:1.6; }
.rc-content-body a  { color:var(--rc-red); }

/* CPSC disclaimer */
.rc-cpsc-box {
  display: flex; gap: 14px; align-items: flex-start;
  background: var(--rc-warm);
  border: 1px solid var(--rc-border);
  border-radius: 8px; padding: 16px 18px;
}
.rc-cpsc-box__icon { font-size: 1.2rem; flex-shrink: 0; }
.rc-cpsc-box__text { font-size: .83rem; color: var(--rc-muted); line-height: 1.55; }
.rc-cpsc-box__text a { color: var(--rc-red); font-weight: 600; }

/* Sidebar cards */
.rc-sb-cta {
  background: var(--rc-dark);
  border-radius: var(--rc-radius); padding: 24px 20px;
  position: relative; overflow: hidden;
}
.rc-sb-cta::before {
  content:''; position:absolute; inset:0;
  background: radial-gradient(ellipse 80% 80% at 50% 10%, rgba(27,58,107,.2) 0%, transparent 65%);
  pointer-events:none;
}
.rc-sb-cta__badge { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--rc-red); margin-bottom:10px; }
.rc-sb-cta__title { font-size:1rem; font-weight:800; color:#fff; margin:0 0 7px; line-height:1.3; }
.rc-sb-cta__sub   { font-size:.8rem; color:rgba(255,255,255,.6); line-height:1.5; margin:0 0 16px; }
.rc-sb-cta__phone { display:flex; align-items:center; gap:7px; background:var(--rc-red); color:#fff; padding:12px 16px; border-radius:8px; text-decoration:none; font-weight:700; font-size:.875rem; margin-bottom:8px; transition:background .2s; }
.rc-sb-cta__phone:hover { background:#a01320; }
.rc-sb-cta__book  { display:block; text-align:center; color:rgba(255,255,255,.55); font-size:.75rem; text-decoration:underline; padding:4px 0; }

.rc-sb-card {
  background: var(--rc-white);
  border: 1px solid var(--rc-border);
  border-radius: var(--rc-radius); padding: 20px 18px;
}
.rc-sb-card__title { font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--rc-muted); margin-bottom:12px; }

.rc-sb-link {
  display: flex; align-items: center; justify-content: space-between; gap: 8px;
  padding: 10px 12px;
  background: var(--rc-warm); border: 1px solid var(--rc-border); border-radius: 7px;
  text-decoration: none; font-size: .84rem; color: var(--rc-text); font-weight:600;
  transition: background .15s, border-color .15s; margin-bottom: 8px;
}
.rc-sb-link:last-child { margin-bottom: 0; }
.rc-sb-link:hover { background: var(--rc-alt); border-color: rgba(27,58,107,.2); }
.rc-sb-link span { color: var(--rc-red); }

/* Responsive */
@media(max-width:860px){
  .rc-layout__inner { grid-template-columns:1fr; }
  .rc-sidebar { position:static; display:grid; grid-template-columns:1fr 1fr; gap:16px; }
  .rc-sb-cta  { grid-column:1/-1; }
}
@media(max-width:520px){
  .rc-block { padding:20px 16px; }
  .rc-sidebar { grid-template-columns:1fr; }
}
</style>

<div id="rc-progress"></div>

<!-- Breadcrumbs -->
<nav class="rc-bread" aria-label="Breadcrumb">
  <div class="container">
    <ol class="rc-bread__list">
      <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
      <li class="rc-bread__sep" aria-hidden="true">/</li>
      <li><a href="<?php echo esc_url(home_url('/recalls/')); ?>">Recalls</a></li>
      <li class="rc-bread__sep" aria-hidden="true">/</li>
      <li class="rc-bread__current"><?php echo esc_html(wp_trim_words($title, 8)); ?></li>
    </ol>
  </div>
</nav>

<!-- Hero -->
<section class="rc-hero" aria-labelledby="rc-h1">
  <div class="container">
    <div class="rc-hero__inner">
      <div class="rc-hero__alert-pill">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        Safety Recall Notice
      </div>
      <h1 class="rc-hero__h1" id="rc-h1"><?php echo esc_html($title); ?></h1>
      <p class="rc-hero__sub">Important safety information. Check if your appliance is affected and follow the recommended steps immediately.</p>
      <div class="rc-hero__btns">
        <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="rc-btn--red">📞 <?php echo esc_html($phone); ?></a>
        <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="rc-btn--outline">CPSC Database ↗</a>
      </div>
      <div class="rc-hero__meta-row">
        <div class="rc-hero__meta-item">Published: <strong><?php echo esc_html($pub_date); ?></strong></div>
        <?php if ($mod_date !== $pub_date): ?>
        <div class="rc-hero__meta-item">Updated: <strong><?php echo esc_html($mod_date); ?></strong></div>
        <?php endif; ?>
        <?php if ($brand): ?>
        <div class="rc-hero__meta-item">Brand: <strong><?php echo esc_html($brand); ?></strong></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Safety notice -->
<div class="rc-notice">
  <div class="container">
    <div class="rc-notice__inner">
      <span>⚠️</span>
      <span>Always verify this recall directly with the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">U.S. Consumer Product Safety Commission (CPSC)</a> or the manufacturer. Manufacturers are required to provide a free remedy — repair, replacement, or refund.</span>
    </div>
  </div>
</div>

<!-- Main Layout -->
<div class="rc-layout" id="rc-content">
  <div class="container">
    <div class="rc-layout__inner">

      <!-- Article -->
      <article class="rc-article">

        <!-- What to Do — always first, most important -->
        <div class="rc-urgency">
          <div class="rc-urgency__label">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Immediate Action Required
          </div>
          <ol class="rc-urgency__steps">
            <li class="rc-urgency__step">
              <span class="rc-urgency__step-num">1</span>
              <div class="rc-urgency__step-text"><strong>Stop using the appliance immediately</strong> — unplug it or turn off the circuit breaker until the recall remedy has been completed.</div>
            </li>
            <li class="rc-urgency__step">
              <span class="rc-urgency__step-num">2</span>
              <div class="rc-urgency__step-text"><strong>Locate your model and serial number</strong> — typically found on a label inside the door, on the back panel, or in your owner's manual.</div>
            </li>
            <li class="rc-urgency__step">
              <span class="rc-urgency__step-num">3</span>
              <div class="rc-urgency__step-text"><strong>Contact <?php echo esc_html($brand ?: 'the manufacturer'); ?> directly</strong> — the manufacturer is required by law to provide a free repair, replacement, or refund. Contact details are in the CPSC recall notice.</div>
            </li>
            <li class="rc-urgency__step">
              <span class="rc-urgency__step-num">4</span>
              <div class="rc-urgency__step-text"><strong>Do not attempt to repair it yourself</strong> — recalls involve safety-critical components. Only manufacturer-authorised technicians should perform recall remediation work.</div>
            </li>
          </ol>
        </div>

        <!-- Recall Details -->
        <div class="rc-block">
          <p class="rc-block__eyebrow">Recall Details</p>
          <h2 class="rc-block__h2">About This Recall</h2>
          <?php if ($hero_img): ?>
          <div style="margin:0 0 24px;background:#f4f6f8;border-radius:8px;overflow:hidden;aspect-ratio:16/7;display:flex;align-items:center;justify-content:center;">
            <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" style="max-width:100%;max-height:100%;width:auto;height:auto;display:block;object-fit:contain;" loading="lazy">
          </div>
          <?php endif; ?>
          <div class="rc-content-body">
            <?php if (have_posts()): the_post(); the_content(); endif; ?>
            <?php if (!get_the_content()): ?>
            <p>Full recall details, affected model numbers, hazard description, and remedy information are available on the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a>. Contact <?php echo esc_html($brand ?: 'the manufacturer'); ?> directly to confirm whether your specific model is affected and to arrange the free remedy.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- CPSC disclaimer box -->
        <div class="rc-cpsc-box">
          <span class="rc-cpsc-box__icon">ℹ️</span>
          <div class="rc-cpsc-box__text">
            <strong>Official recall information</strong> is maintained by the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">U.S. Consumer Product Safety Commission (CPSC)</a>. This page is provided for informational purposes only. Always confirm recall status and remedy directly with the manufacturer or CPSC. <?php ar_disclaimer($brand); ?>
          </div>
        </div>

        <!-- Need Service? -->
        <div class="rc-block">
          <p class="rc-block__eyebrow">Service After a Recall</p>
          <h2 class="rc-block__h2">Has Your Recall Remedy Been Completed?</h2>
          <div class="rc-block__body">
            <p>Once the manufacturer has performed the recall remedy on your <?php echo esc_html($brand ?: 'appliance'); ?>, you may still need independent appliance service for unrelated issues — or you may want a certified technician to verify the repair was correctly completed.</p>
            <p>Our technicians can inspect your appliance, document the condition, and perform any additional service required. We carry OEM parts for all major brands and back every repair with a 30-day parts and labor warranty.</p>
          </div>
          <div style="margin-top:20px;">
            <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="rc-btn--red">📞 <?php echo esc_html($phone); ?></a>
          </div>
        </div>

      </article>

      <!-- Sidebar -->
      <aside class="rc-sidebar">

        <div class="rc-sb-cta">
          <div class="rc-sb-cta__badge">⚠ Safety Recall</div>
          <div class="rc-sb-cta__title">Need Help With Your <?php echo esc_html($brand ?: 'Appliance'); ?>?</div>
          <div class="rc-sb-cta__sub">Our certified technicians can inspect your appliance and perform post-recall service. Same-day available.</div>
          <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="rc-sb-cta__phone">📞 <?php echo esc_html($phone); ?></a>
          <a href="/schedule/" class="rc-sb-cta__book">Schedule online →</a>
        </div>

        <div class="rc-sb-card">
          <div class="rc-sb-card__title">Official Resources</div>
          <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="rc-sb-link">
            CPSC Recall Database <span>↗</span>
          </a>
          <?php if ($brand): ?>
          <a href="<?php echo esc_url(home_url('/error-codes/?brand=' . urlencode(strtolower($brand)))); ?>" class="rc-sb-link">
            <?php echo esc_html($brand); ?> Error Codes <span>→</span>
          </a>
          <a href="<?php echo esc_url(home_url('/services/?brand=' . urlencode(strtolower($brand)))); ?>" class="rc-sb-link">
            <?php echo esc_html($brand); ?> Repair Services <span>→</span>
          </a>
          <?php endif; ?>
          <a href="<?php echo esc_url(home_url('/recalls/')); ?>" class="rc-sb-link">
            ← All Recalls <span></span>
          </a>
        </div>

      </aside>
    </div>
  </div>
</div>

<div id="book" style="scroll-margin-top:80px;">
  <?php ar_appointment_form('recall', 'Book a Post-Recall Service Inspection'); ?>
</div>

<script>
(function(){
  const bar = document.getElementById('rc-progress');
  if (!bar) return;
  function upd(){
    const h = document.documentElement;
    const p = (h.scrollTop||document.body.scrollTop)/((h.scrollHeight||document.body.scrollHeight)-h.clientHeight)*100;
    bar.style.width = Math.min(p,100)+'%';
  }
  window.addEventListener('scroll', upd, {passive:true});
  upd();
})();
</script>

<?php get_footer(); ?>

