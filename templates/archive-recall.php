<?php
/**
 * Archive: Recalls — OBSIDIAN Design System
 * URL: /recalls/
 * Professional horizontal card layout, fully mobile responsive
 */
defined('ABSPATH') || exit;

$recalls = new WP_Query([
    'post_type'      => 'recall',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => false,
    'meta_query'     => [[
        'key'     => '_ar_brand',
        'value'   => 'Viking',
        'compare' => '=',
    ]],
]);

$total     = $recalls->found_posts;
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();

get_header();
?>

<style>
/* ═══════════════════════════════════════════
   RECALLS ARCHIVE — OBSIDIAN Design System
   ═══════════════════════════════════════════ */

/* ── ph-split hero ── */
.ph-split { display: grid; grid-template-columns: 1fr 42%; min-height: 460px; }
.ph-split__text { display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 3.5rem; }
.ph-split__img  { position: relative; overflow: hidden; }
.ph-split__img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; }
.ph-split__img::before { content: ''; position: absolute; top: 0; bottom: 0; left: 0; width: 2px; background: #C01C28; z-index: 1; }
@media (max-width: 900px) {
  .ph-split { display: block; }
  .ph-split__img { height: 260px; position: relative; }
  .ph-split__img img { position: absolute; }
  .ph-split__img::before { display: none; }
}

/* ── Hero section ── */
.rc-hero {
  background: var(--color-bg-light);
  border-bottom: 1px solid var(--color-rule);
  padding-bottom: 0;
}
.rc-hero__eyebrow {
  display: block;
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .14em;
  text-transform: uppercase;
  color: var(--color-primary);
  margin-bottom: 1rem;
}
.rc-hero__title {
  font-family: var(--font-display);
  font-size: clamp(2.25rem, 5vw, 4rem);
  font-weight: 300;
  color: var(--color-primary-dark);
  line-height: 1.1;
  letter-spacing: -.025em;
  margin: 0 0 1.25rem;
}
.rc-hero__sub {
  font-family: var(--font-body);
  font-size: 1.0625rem;
  color: var(--color-text-muted);
  line-height: 1.75;
  margin: 0 0 2rem;
  max-width: 560px;
}
.rc-hero__stats {
  display: flex;
  align-items: center;
  gap: 2.5rem;
  flex-wrap: wrap;
  padding-top: 1.5rem;
  border-top: 1px solid var(--color-rule);
}
.rc-hero__stat-val {
  font-family: var(--font-display);
  font-size: 2.5rem;
  font-weight: 300;
  color: var(--color-primary-dark);
  line-height: 1;
  letter-spacing: -.03em;
  display: block;
}
.rc-hero__stat-lbl {
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--color-text-muted);
  margin-top: .25rem;
}
.rc-hero__cpsc {
  margin-left: auto;
  font-family: var(--font-body);
  font-size: 12px;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
  color: var(--color-text-muted);
  text-decoration: none;
  padding: 8px 14px;
  border: 1px solid var(--color-rule);
  border-radius: 2px;
  transition: border-color .15s, color .15s;
}
.rc-hero__cpsc:hover { border-color: var(--color-primary-dark); color: var(--color-primary-dark); }

/* ── Safety notice strip ── */
.rc-notice {
  background: #fffbeb;
  border-bottom: 1px solid #fde68a;
  padding: .875rem 0;
}
.rc-notice__inner {
  display: flex;
  align-items: flex-start;
  gap: .75rem;
  font-family: var(--font-body);
  font-size: .8125rem;
  color: #92400e;
  line-height: 1.65;
}
.rc-notice__inner a { color: #b45309; font-weight: 700; }

/* ── Search bar ── */
.rc-search-bar {
  background: #fff;
  border-bottom: 1px solid var(--color-rule);
  padding: .875rem 0;
  position: sticky;
  top: 64px;
  z-index: 90;
}
.rc-search-inner {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.rc-search-input {
  flex: 1;
  padding: 10px 14px;
  border: 1px solid var(--color-rule);
  border-radius: 2px;
  font-family: var(--font-body);
  font-size: .875rem;
  color: var(--color-primary-dark);
  background: var(--color-bg-light);
  outline: none;
  transition: border-color .15s;
}
.rc-search-input:focus { border-color: var(--color-primary-dark); background: #fff; }
.rc-search-input::placeholder { color: var(--color-text-light); }
.rc-search-count {
  font-family: var(--font-body);
  font-size: .8125rem;
  color: var(--color-text-muted);
  white-space: nowrap;
}

/* ── Recall list main area ── */
.rc-main {
  padding: 3.5rem 0 5rem;
  background: var(--color-bg-light);
}

/* ── Recall card ─────────────────────────── */
/*
  Layout (desktop): [image 220px] [content flex-1] [cta 100px]
  Layout (tablet):  [image 160px] [content] [cta]
  Layout (mobile):  full width stacked
*/
.rc-list {
  display: flex;
  flex-direction: column;
  gap: 0;
}

.rc-card {
  display: grid;
  grid-template-columns: 220px 1fr 120px;
  align-items: stretch;
  background: #fff;
  border: 1px solid var(--color-rule);
  border-top: none;
  text-decoration: none;
  color: inherit;
  transition: box-shadow .15s;
  position: relative;
  overflow: hidden;
  min-height: 160px;
}
.rc-list .rc-card:first-child { border-top: 1px solid var(--color-rule); }
.rc-card:hover { box-shadow: 0 2px 16px rgba(0,0,0,.07); z-index: 1; }

/* Left accent line */
.rc-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; bottom: 0;
  width: 3px;
  background: var(--color-primary);
  opacity: 0;
  transition: opacity .15s;
}
.rc-card:hover::before { opacity: 1; }

/* Image column */
.rc-card__img {
  position: relative;
  overflow: hidden;
  background: var(--color-bg-section);
  border-right: 1px solid var(--color-rule);
  flex-shrink: 0;
}
.rc-card__img img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
  transition: transform .35s ease;
}
.rc-card:hover .rc-card__img img { transform: scale(1.04); }

/* Body column */
.rc-card__body {
  padding: 1.75rem 2rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: .625rem;
}

.rc-card__label {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--color-primary);
}
.rc-card__label svg { flex-shrink: 0; }

.rc-card__title {
  font-family: var(--font-display);
  font-size: clamp(1.125rem, 1.8vw, 1.5rem);
  font-weight: 500;
  color: var(--color-primary-dark);
  line-height: 1.2;
  letter-spacing: -.01em;
  margin: 0;
  transition: color .12s;
}
.rc-card:hover .rc-card__title { color: var(--color-primary); }

.rc-card__excerpt {
  font-family: var(--font-body);
  font-size: .875rem;
  color: var(--color-text-muted);
  line-height: 1.65;
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.rc-card__meta {
  font-family: var(--font-body);
  font-size: .75rem;
  color: var(--color-text-light);
  letter-spacing: .02em;
}

/* CTA column */
.rc-card__cta {
  display: flex;
  align-items: center;
  justify-content: center;
  border-left: 1px solid var(--color-rule);
  padding: 1rem;
  flex-direction: column;
  gap: .375rem;
}
.rc-card__cta-text {
  font-family: var(--font-body);
  font-size: .75rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--color-primary);
  transition: letter-spacing .15s;
}
.rc-card__cta-arrow {
  color: var(--color-primary);
  transition: transform .15s;
}
.rc-card:hover .rc-card__cta-arrow { transform: translateX(4px); }

/* No results state */
.rc-empty {
  text-align: center;
  padding: 4rem 2rem;
  background: #fff;
  border: 1px solid var(--color-rule);
}
.rc-empty p {
  font-family: var(--font-body);
  color: var(--color-text-muted);
  margin: 0;
}

/* ── Responsive ── */
@media (max-width: 860px) {
  .rc-card { grid-template-columns: 180px 1fr 80px; min-height: 140px; }
  .rc-card__body { padding: 1.25rem 1.5rem; }
  .rc-card__cta { padding: .75rem; }
  .rc-card__cta-text { font-size: .6875rem; }
}
@media (max-width: 640px) {
  .rc-card {
    grid-template-columns: 1fr;
    grid-template-rows: 200px auto;
    min-height: auto;
  }
  .rc-card__img {
    border-right: none;
    border-bottom: 1px solid var(--color-rule);
    height: 200px;
    position: relative;
  }
  .rc-card__body { padding: 1.25rem; gap: .5rem; }
  .rc-card__cta {
    border-left: none;
    border-top: 1px solid var(--color-rule);
    flex-direction: row;
    justify-content: flex-start;
    padding: 1rem 1.25rem;
    gap: .5rem;
  }
}
@media (max-width: 420px) {
  .rc-card__img { height: 160px; }
  .rc-card__title { font-size: 1.0625rem; }
}
</style>

<!-- ── HERO ──────────────────────────────────────────────── -->
<section class="rc-hero" aria-labelledby="rc-archive-h1">
  <div class="ph-split">

    <!-- Left: text -->
    <div class="ph-split__text" style="padding-top:calc(64px + 4rem);padding-left:max(2rem,calc((100vw - 1280px)/2 + 2rem));padding-right:3rem;">
      <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:1.5rem;">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="breadcrumbs__sep" aria-hidden="true">/</span>
        <span class="breadcrumbs__current" aria-current="page">Safety Recalls</span>
      </nav>

      <span class="rc-hero__eyebrow">Safety Recalls</span>
      <h1 class="rc-hero__title" id="rc-archive-h1">
        Viking Appliance<br><em style="font-style:italic;font-weight:300;">Safety Recalls</em>
      </h1>
      <p class="rc-hero__sub">
        Official Viking appliance safety recalls verified through the U.S. Consumer Product Safety Commission. Check your appliance model against affected units and arrange a free remedy.
      </p>

      <div class="rc-hero__stats">
        <div>
          <span class="rc-hero__stat-val"><?php echo esc_html($total); ?></span>
          <span class="rc-hero__stat-lbl">Active recalls</span>
        </div>
        <div>
          <span class="rc-hero__stat-val">Free</span>
          <span class="rc-hero__stat-lbl">Manufacturer remedy</span>
        </div>
        <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="rc-hero__cpsc">
          CPSC Database &rarr;
        </a>
      </div>
    </div>

    <!-- Right: image -->
    <div class="ph-split__img">
      <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-tuscany-range-detail.jpg'); ?>"
           alt="Viking Tuscany Series range — safety recall information"
           loading="eager">
    </div>

  </div>
</section>

<!-- ── SAFETY NOTICE ─────────────────────────────────────── -->
<div class="rc-notice" role="alert">
  <div class="container">
    <div class="rc-notice__inner">
      <span class="rc-notice__icon" aria-hidden="true">&#x26A0;&#xFE0F;</span>
      <span>Always verify recall information with the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">U.S. Consumer Product Safety Commission (CPSC)</a> or directly with the manufacturer. Manufacturers are required to provide a free remedy (repair, replacement, or refund).</span>
    </div>
  </div>
</div>

<!-- ── SEARCH BAR ────────────────────────────────────────── -->
<div class="rc-search-bar" id="rc-search-bar">
  <div class="container">
    <div class="rc-search-inner">
      <input type="search"
             id="rc-search-input"
             class="rc-search-input"
             placeholder="Search Viking recalls by keyword…"
             aria-label="Search recalls">
      <span class="rc-search-count" id="rc-count" aria-live="polite">
        <?php echo esc_html($total); ?> recall<?php echo $total !== 1 ? 's' : ''; ?>
      </span>
    </div>
  </div>
</div>

<!-- ── RECALLS LIST ──────────────────────────────────────── -->
<main class="rc-main" id="main-content" aria-labelledby="rc-archive-h1">
  <div class="container">

    <?php if ($recalls->have_posts()): ?>

    <div class="rc-list" id="rc-list" role="list">
      <?php while ($recalls->have_posts()): $recalls->the_post();
        $post_id  = get_the_ID();
        $brand    = get_post_meta($post_id, '_ar_brand', true) ?: 'Viking';
        $hero_img = get_post_meta($post_id, '_ar_hero_image', true);
        if (!$hero_img) $hero_img = AR_URI . '/assets/images/viking-tuscany-product-1.jpg';
        $excerpt  = get_the_excerpt() ?: wp_trim_words(get_the_content(), 22);
      ?>
      <a href="<?php the_permalink(); ?>" class="rc-card" role="listitem" data-title="<?php echo esc_attr(strtolower(get_the_title())); ?>">

        <!-- Image -->
        <div class="rc-card__img">
          <img src="<?php echo esc_url($hero_img); ?>"
               alt="<?php echo esc_attr(get_the_title()); ?>"
               loading="lazy">
        </div>

        <!-- Content -->
        <div class="rc-card__body">
          <span class="rc-card__label">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            <?php echo esc_html($brand); ?> Safety Recall
          </span>
          <h2 class="rc-card__title"><?php the_title(); ?></h2>
          <p class="rc-card__excerpt"><?php echo esc_html($excerpt); ?></p>
          <span class="rc-card__meta"><?php echo get_the_date('F j, Y'); ?></span>
        </div>

        <!-- CTA -->
        <div class="rc-card__cta" aria-hidden="true">
          <span class="rc-card__cta-text">View</span>
          <svg class="rc-card__cta-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>

      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php else: ?>
    <div class="rc-empty">
      <p>No active Viking recalls found at this time. Check back regularly or visit <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">cpsc.gov/Recalls</a> for the latest safety information.</p>
    </div>
    <?php endif; ?>

  </div>
</main>

<!-- ── CTA ───────────────────────────────────────────────── -->
<section style="background:#0A0A0A;padding:var(--section-sm) 0;border-top:1px solid rgba(255,255,255,.06);">
  <div class="container" style="text-align:center;">
    <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.35);display:block;margin-bottom:14px;">Affected by a Recall?</span>
    <h2 style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.875rem,3vw,2.75rem);font-weight:300;color:#fff;letter-spacing:-.025em;line-height:1.1;margin:0 0 14px;">We'll Inspect Your Viking Appliance</h2>
    <p style="font-family:'Manrope',sans-serif;font-size:15px;color:rgba(255,255,255,.5);max-width:480px;margin:0 auto var(--space-8);line-height:1.75;">
      Our certified Viking technicians can verify whether your appliance is affected and coordinate the required remedy at no cost to you.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;">
      <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--crimson btn--lg"><?php echo esc_html($phone); ?></a>
      <a href="/schedule/" class="btn btn--outline-white btn--lg">Schedule Inspection</a>
    </div>
  </div>
</section>

<!-- ── FAQ ───────────────────────────────────────────────── -->
<?php
ar_faq_section([
    ['question' => 'Are Viking recalls free to fix?', 'answer' => 'Yes. All CPSC-mandated recalls require the manufacturer to provide a free remedy — repair, replacement, or refund — at no cost to the consumer.'],
    ['question' => 'How do I know if my Viking appliance is affected?', 'answer' => 'Check the model number on your appliance (typically inside the door, on the rear panel, or in the documentation). Compare it against the specific model numbers listed in the official CPSC recall notice at cpsc.gov/Recalls.'],
    ['question' => 'Can you help if my Viking appliance is recalled?', 'answer' => 'Yes. Our certified Viking technicians can inspect your appliance, confirm whether it is affected by a recall, and coordinate the manufacturer-required remedy. Call us or book an appointment online.'],
    ['question' => 'What should I do if my appliance is on the recall list?', 'answer' => 'Stop using the appliance immediately if advised by the recall notice. Contact Viking Range LLC or schedule an inspection with our certified technicians. Do not attempt DIY repairs on a recalled appliance.'],
], 'Viking Safety Recalls — FAQ');
?>

<script>
(function () {
  var input   = document.getElementById('rc-search-input');
  var list    = document.getElementById('rc-list');
  var counter = document.getElementById('rc-count');
  if (!input || !list) return;

  var cards = Array.from(list.querySelectorAll('.rc-card'));
  var total = cards.length;

  input.addEventListener('input', function () {
    var q = this.value.trim().toLowerCase();
    var visible = 0;
    cards.forEach(function (card) {
      var title = (card.dataset.title || '') + ' ' + (card.querySelector('.rc-card__excerpt') ? card.querySelector('.rc-card__excerpt').textContent.toLowerCase() : '');
      var show = !q || title.indexOf(q) > -1;
      card.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    if (counter) counter.textContent = visible + ' recall' + (visible !== 1 ? 's' : '');
  });
})();
</script>

<?php get_footer(); ?>
