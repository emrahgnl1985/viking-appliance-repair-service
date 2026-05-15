<?php
/**
 * Archive: Recalls
 * URL: /recalls/
 * Design: matches vikingappliancerepairservice.com/recalls/
 */
defined('ABSPATH') || exit;

$recalls = new WP_Query([
    'post_type'      => 'recall',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => false,
]);

$total     = $recalls->found_posts;
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();
$brands    = get_terms(['taxonomy' => 'brand', 'hide_empty' => true, 'orderby' => 'name']);

get_header();
?>
<style>
/* ── Recalls Archive — Scoped Styles ────────────────────── */
:root{
  --rc-red:    #C4943A;
  --rc-dark:   #1a1a1a;
  --rc-warm:   #f8f6f3;
  --rc-alt:    #f2f0ed;
  --rc-white:  #ffffff;
  --rc-border: #e5e0da;
  --rc-text:   #2c2c2c;
  --rc-muted:  #6b6560;
  --rc-radius: 10px;
  --rc-shadow: 0 2px 12px rgba(0,0,0,.07);
}

/* ── Hero ──────────────────────────────────────────────── */
.rc-hero {
  background-size: cover;
  border-bottom: 1px solid var(--color-border);
  background:  linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
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
  background: rgba(0,0,0,0.35);
  /* background: radial-gradient(ellipse 70% 60% at 65% 40%, rgba(196,148,58,.15) 0%, transparent 65%); */
}
.rc-hero__inner {
   max-width: 780px;
   position: relative;
   z-index: 1;
   padding: 24px;
  /* background: rgba(0,0,0,0.35);  */
  border-radius: 10px;
}

.rc-hero__eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: .72rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--rc-red);
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
  margin-bottom: 16px;
}
.rc-hero__eyebrow::before { content:''; width:20px; height:2px; background:var(--rc-red); }
.rc-hero__title {
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.15;
  margin: 0 0 16px;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}
.rc-hero__title em { font-style:normal; color:var(--rc-red); }
.rc-hero__sub {
  font-size: 1.0625rem;
  color: rgba(255,255,255,.7);
  line-height: 1.65;
  margin: 0 0 32px;
  max-width: 620px;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}
.rc-hero__meta {
  display: flex;
  align-items: center;
  gap: 24px;
  flex-wrap: wrap;
  padding-top: 28px;
  border-top: 1px solid rgba(255,255,255,.1);
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}
.rc-hero__stat-num  { font-size:1.6rem; font-weight:800; color:#fff; line-height:1; }
.rc-hero__stat-label{ font-size:.72rem; color:rgba(255,255,255,.45); text-transform:uppercase; letter-spacing:.08em; margin-top:3px; }
.rc-hero__cpsc {
  margin-left: auto;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.15);
  color: rgba(255,255,255,.7);
  font-size: .8rem;
  font-weight: 600;
  padding: 8px 16px;
  border-radius: 50px;
  text-decoration: none;
  transition: background .2s;
}
.rc-hero__cpsc:hover { background: rgba(255,255,255,.14); color:#fff; }

/* ── Safety notice bar ─────────────────────────────────── */
.rc-notice {
  background: #fff8f0;
  border-bottom: 1px solid #fde68a;
  padding: 12px 0;
}
.rc-notice__inner {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: .84rem;
  color: #92400e;
  flex-wrap: wrap;
}
.rc-notice__icon { font-size: 1rem; flex-shrink: 0; }
.rc-notice__inner a { color: #b45309; font-weight: 600; }

/* ── Filters ───────────────────────────────────────────── */
.rc-filters-bar {
  background: var(--rc-white);
  border-bottom: 1px solid var(--rc-border);
  padding: 16px 0;
  position: sticky;
  top: 0;
  z-index: 100;
}
.rc-filters-inner {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}
.rc-filter-input {
  flex: 1;
  min-width: 200px;
  padding: 10px 16px;
  border: 1.5px solid var(--rc-border);
  border-radius: 50px;
  font-size: .875rem;
  font-family: inherit;
  color: var(--rc-text);
  background: var(--rc-warm);
  outline: none;
  transition: border-color .2s;
}
.rc-filter-input:focus { border-color: var(--rc-red); background: #fff; }
.rc-filter-select {
  padding: 10px 34px 10px 14px;
  border: 1.5px solid var(--rc-border);
  border-radius: 50px;
  font-size: .875rem;
  font-family: inherit;
  color: var(--rc-text);
  background: var(--rc-warm) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b6560' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 12px center;
  -webkit-appearance: none;
  cursor: pointer;
  outline: none;
  transition: border-color .2s;
}
.rc-filter-select:focus { border-color: var(--rc-red); background-color: #fff; }
.rc-filter-count { font-size: .82rem; color: var(--rc-muted); white-space: nowrap; }
.rc-filter-clear {
  font-size: .8rem;
  color: var(--rc-muted);
  background: none;
  border: none;
  cursor: pointer;
  font-family: inherit;
  text-decoration: underline;
  padding: 4px 8px;
  display: none;
}
.rc-filter-clear:hover { color: var(--rc-red); }

/* ── Recall list ───────────────────────────────────────── */
.rc-main {
  padding: 48px 0 80px;
  background: var(--rc-warm);
}
.rc-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

/* Recall card */
.rc-card {
  background: var(--rc-white);
  border: 1px solid var(--rc-border);
  border-radius: var(--rc-radius);
  padding: 0;
  display: flex;
  gap: 0;
  align-items: stretch;
  text-decoration: none;
  transition: transform .2s, box-shadow .2s, border-color .2s;
  position: relative;
  overflow: hidden;
}
.rc-card__thumb {
  flex-shrink: 0;
  width: 160px;
  background: #e8edf2;
  overflow: hidden;
}
.rc-card__thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .3s;
}
.rc-card:hover .rc-card__thumb img { transform: scale(1.04); }
.rc-card__thumb-icon {
  width: 100%;
  height: 100%;
  min-height: 110px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(196,148,58,.07);
  color: var(--rc-red);
}
.rc-card__content {
  flex: 1;
  min-width: 0;
  padding: 22px 24px;
  display: flex;
  align-items: flex-start;
  gap: 16px;
}
.rc-card::before {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 4px;
  background: var(--rc-red);
  transform: scaleY(0);
  transform-origin: bottom;
  transition: transform .25s;
}
.rc-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(0,0,0,.09);
  border-color: rgba(196,148,58,.2);
}
.rc-card:hover::before { transform: scaleY(1); }
.rc-card__icon {
  flex-shrink: 0;
  width: 44px; height: 44px;
  background: rgba(196,148,58,.08);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--rc-red);
  margin-top: 2px;
}
.rc-card__icon svg { width: 22px; height: 22px; }
.rc-card__body { flex: 1; min-width: 0; }
.rc-card__meta {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 8px;
}
.rc-card__brand {
  font-size: .72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--rc-red);
  background: rgba(196,148,58,.08);
  padding: 3px 9px;
  border-radius: 20px;
}
.rc-card__date {
  font-size: .78rem;
  color: var(--rc-muted);
}
.rc-card__title {
  font-size: 1.0625rem;
  font-weight: 700;
  color: var(--rc-dark);
  line-height: 1.3;
  margin: 0 0 8px;
}
.rc-card:hover .rc-card__title { color: var(--rc-red); }
.rc-card__excerpt {
  font-size: .875rem;
  color: var(--rc-muted);
  line-height: 1.55;
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.rc-card__arrow {
  flex-shrink: 0;
  color: var(--rc-red);
  font-size: .85rem;
  font-weight: 700;
  align-self: center;
  transition: transform .2s;
}
.rc-card:hover .rc-card__arrow { transform: translateX(4px); }

/* Empty state */
.rc-empty {
  text-align: center;
  padding: 64px 24px;
  color: var(--rc-muted);
  background: var(--rc-white);
  border: 1px solid var(--rc-border);
  border-radius: var(--rc-radius);
  display: none;
}
.rc-empty.is-visible { display: block; }
.rc-empty h3 { color: var(--rc-dark); margin-bottom: 8px; }

/* No WP recalls yet — static placeholder cards */
.rc-static-card {
  background: var(--rc-white);
  border: 1px solid var(--rc-border);
  border-radius: var(--rc-radius);
  padding: 24px 28px;
  display: flex;
  gap: 20px;
  align-items: flex-start;
  position: relative;
  overflow: hidden;
}
.rc-static-card::before {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 4px;
  background: var(--rc-red);
}

/* ── CTA band ──────────────────────────────────────────── */
.rc-cta {
  background: var(--rc-dark);
  padding: 64px 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.rc-cta::before {
  content: '';
  position: absolute; inset: 0;
  background: radial-gradient(ellipse 60% 80% at 50% 50%, rgba(196,148,58,.12) 0%, transparent 70%);
  pointer-events: none;
}
.rc-cta__eyebrow { font-size:.7rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--rc-red); margin-bottom:10px; }
.rc-cta__title   { font-size:clamp(1.5rem,3vw,2.2rem); font-weight:800; color:#fff; margin:0 0 12px; }
.rc-cta__sub     { color:rgba(255,255,255,.65); font-size:.9375rem; max-width:500px; margin:0 auto 32px; }
.rc-cta__btns    { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; }
.rc-btn--red   { background:var(--rc-red); color:#fff; padding:13px 30px; border-radius:50px; font-size:.9375rem; font-weight:700; text-decoration:none; display:inline-block; transition:background .2s; }
.rc-btn--red:hover { background:#9E7428; }
.rc-btn--ghost { color:rgba(255,255,255,.8); padding:13px 30px; border-radius:50px; font-size:.9375rem; font-weight:600; text-decoration:none; display:inline-block; border:1.5px solid rgba(255,255,255,.2); transition:background .2s; }
.rc-btn--ghost:hover { background:rgba(255,255,255,.08); }

@media(max-width:640px){
  .rc-hero{ padding:80px 0 40px; }
  .rc-hero__cpsc{ margin-left:0; }
  .rc-card{ flex-direction:column; }
  .rc-card__thumb{ width:100%; height:180px; }
  .rc-card__content{ flex-direction:column; gap:10px; padding:16px; }
  .rc-card__arrow{ display:none; }
}
</style>

<!-- ── HERO ──────────────────────────────────────────────── -->
<section class="rc-hero">
  <div class="container">
    <div class="rc-hero__inner">
      <p class="rc-hero__eyebrow">Safety Information</p>
      <h1 class="rc-hero__title">Viking Appliance <em>Safety Recalls</em></h1>
      <p class="rc-hero__sub">Official Viking appliance recall notices based on U.S. CPSC records. Check if your Viking appliance is affected, what the hazard is, and exactly what steps to take to protect your household.</p>
      <div class="rc-hero__meta">
        <div>
          <div class="rc-hero__stat-num"><?php echo $total ?: '10+'; ?></div>
          <div class="rc-hero__stat-label">Active Recalls</div>
        </div>
        <div>
          <div class="rc-hero__stat-num">CPSC</div>
          <div class="rc-hero__stat-label">Official Source</div>
        </div>
        <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer" class="rc-hero__cpsc">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          CPSC Recall Database ↗
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ── SAFETY NOTICE ─────────────────────────────────────── -->
<div class="rc-notice">
  <div class="container">
    <div class="rc-notice__inner">
      <span class="rc-notice__icon">&#x26A0;️</span>
      <span>Always verify recall information with the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">U.S. Consumer Product Safety Commission (CPSC)</a> or directly with the manufacturer. Manufacturers are required to provide free remedy (repair, replacement, or refund).</span>
    </div>
  </div>
</div>

<!-- ── FILTER BAR ────────────────────────────────────────── -->
<div class="rc-filters-bar">
  <div class="container">
    <div class="rc-filters-inner">
      <input type="text" class="rc-filter-input" id="rc-search" placeholder="&#x1F50D;  Search Viking recalls by keyword…" aria-label="Search recalls">
      <span class="rc-filter-count" id="rc-count"><?php echo $total ?: '0'; ?> recall<?php echo $total !== 1 ? 's' : ''; ?></span>
      <button class="rc-filter-clear" id="rc-clear">&#x2715; Clear</button>
    </div>
  </div>
</div>

<!-- ── RECALL LIST ───────────────────────────────────────── -->
<section class="rc-main">
  <div class="container" style="max-width:900px;">

    <?php if ($recalls->have_posts()): ?>
    <div class="rc-list" id="rc-list">
      <?php while ($recalls->have_posts()): $recalls->the_post();
        $pid       = get_the_ID();
        $brand     = ar_meta($pid, '_ar_brand', '');
        $hero_img  = ar_meta($pid, '_ar_hero_image', '');
        $url       = get_permalink();
        $title     = get_the_title();
        $date      = get_the_date('M j, Y');
        $excpt     = get_the_excerpt() ?: wp_trim_words(get_the_content(), 25);
        $da_search = strtolower("$brand $title");
        $da_brand  = strtolower($brand);
      ?>
      <a href="<?php echo esc_url($url); ?>"
         class="rc-card"
         data-search="<?php echo esc_attr($da_search); ?>"
         data-brand="<?php echo esc_attr($da_brand); ?>">
        <div class="rc-card__thumb">
          <?php if ($hero_img): ?>
          <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
          <?php else: ?>
          <div class="rc-card__thumb-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
              <line x1="12" y1="9" x2="12" y2="13"/>
              <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
          </div>
          <?php endif; ?>
        </div>
        <div class="rc-card__content">
          <div class="rc-card__body">
            <div class="rc-card__meta">
              <?php if ($brand): ?><span class="rc-card__brand"><?php echo esc_html($brand); ?></span><?php endif; ?>
              <span class="rc-card__date"><?php echo esc_html($date); ?></span>
            </div>
            <h2 class="rc-card__title"><?php echo esc_html($title); ?></h2>
            <?php if ($excpt): ?><p class="rc-card__excerpt"><?php echo esc_html($excpt); ?></p><?php endif; ?>
          </div>
          <span class="rc-card__arrow" aria-hidden="true">→</span>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <div class="rc-empty" id="rc-empty">
      <h3>No recalls found</h3>
      <p>Try a different search term or browse all recalls above.</p>
    </div>

    <?php else: ?>
    <!-- No posts yet — show static info cards -->
    <p style="font-size:.9rem;color:var(--rc-muted);margin-bottom:24px;">No recalls are currently listed. Check back regularly or visit the CPSC database for the latest information.</p>
    <div class="rc-list">
      <?php
      $static_recalls = [
          ['brand'=>'Viking', 'title'=>'Viking Gas Range Pressure Regulator Fire Hazard',       'date'=>'See CPSC', 'desc'=>'Certain Viking gas range models may have a gas pressure regulator issue allowing unregulated gas flow to the burners. Stop using the range immediately if you notice unusual flame behavior. Verify affected models at cpsc.gov.'],
          ['brand'=>'Viking', 'title'=>'Viking Built-In Refrigerator Ice Maker Electrical Hazard', 'date'=>'See CPSC', 'desc'=>'Certain Viking built-in refrigerator models may have an ice maker wiring deficiency that poses an electrical hazard. Stop using the ice maker function and contact Viking Range LLC. Check the CPSC recall database for affected models.'],
          ['brand'=>'Viking', 'title'=>'Viking Dishwasher Electrical Component Fire Hazard',   'date'=>'See CPSC', 'desc'=>'Certain Viking dishwasher models may have an electrical control component that can overheat during operation, posing a fire hazard. Stop using the appliance and schedule a safety inspection. Verify affected models at cpsc.gov.'],
      ];
      foreach ($static_recalls as $sr): ?>
      <div class="rc-static-card">
        <div class="rc-card__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="rc-card__body">
          <div class="rc-card__meta">
            <span class="rc-card__brand"><?php echo esc_html($sr['brand']); ?></span>
            <span class="rc-card__date"><?php echo esc_html($sr['date']); ?></span>
          </div>
          <h2 class="rc-card__title"><?php echo esc_html($sr['title']); ?></h2>
          <p class="rc-card__excerpt"><?php echo esc_html($sr['desc']); ?></p>
        </div>
        <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer"
           style="flex-shrink:0;align-self:center;color:var(--rc-red);font-size:.8rem;font-weight:700;text-decoration:none;white-space:nowrap;">
          CPSC →
        </a>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<!-- ── CTA ───────────────────────────────────────────────── -->
<section class="rc-cta">
  <div class="container" style="position:relative;z-index:1;">
    <p class="rc-cta__eyebrow">Is Your Appliance Affected?</p>
    <h2 class="rc-cta__title">Get a Safety Inspection Today</h2>
    <p class="rc-cta__sub">Our certified technicians can inspect your appliance, verify whether a recall applies, and perform any required remediation work — same-day appointments available.</p>
    <div class="rc-cta__btns">
      <a href="<?php echo esc_url($phone_raw); ?>" class="rc-btn--red">&#x1F4DE; <?php echo esc_html($phone); ?></a>
      <a href="/schedule/" class="rc-btn--ghost">Schedule Inspection →</a>
    </div>
  </div>
</section>

<div id="book" style="scroll-margin-top:80px;">
  <?php ar_appointment_form('recalls', 'Schedule a Safety Inspection'); ?>
</div>

<?php ar_disclaimer(); ?>

<script>
(function(){
  const searchEl = document.getElementById('rc-search');
  const clearBtn = document.getElementById('rc-clear');
  const countEl  = document.getElementById('rc-count');
  const emptyEl  = document.getElementById('rc-empty');
  const cards    = document.querySelectorAll('#rc-list .rc-card');

  function filter(){
    const q    = (searchEl?.value || '').toLowerCase().trim();
    const hasF = !!q;
    if (clearBtn) clearBtn.style.display = hasF ? 'inline-block' : 'none';
    let visible = 0;
    cards.forEach(c => {
      const ms   = c.dataset.search || '';
      const show = !q || ms.includes(q);
      c.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    if (countEl) countEl.textContent = visible + ' recall' + (visible !== 1 ? 's' : '');
    if (emptyEl) emptyEl.classList.toggle('is-visible', visible === 0 && cards.length > 0);
  }

  if (searchEl) searchEl.addEventListener('input', filter);
  if (clearBtn) clearBtn.addEventListener('click', () => {
    if (searchEl) searchEl.value = '';
    filter();
  });
})();
</script>

<?php get_footer(); ?>

