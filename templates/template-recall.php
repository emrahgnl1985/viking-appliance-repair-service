<?php
/**
 * Template: Recall — OBSIDIAN Design System
 * CPT: recall | URL: /recalls/{slug}/
 */
defined('ABSPATH') || exit;

global $post;
$pid       = $post->ID;
$brand     = ar_meta($pid, '_ar_brand', '');
$hero_img  = ar_meta($pid, '_ar_hero_image', '');
$phone     = ar_get_phone();
$phone_raw = ar_phone_link();
$biz       = ar_get_business_name();
$title     = get_the_title();
$pub_date  = get_the_date('F j, Y');
$mod_date  = get_the_modified_date('F j, Y');

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
<section style="background:var(--color-bg-light);padding:calc(64px + 4rem) 0 3rem;border-bottom:1px solid var(--color-rule);" aria-labelledby="rc-h1">
  <div class="container">
    <div class="ph-split">
      <div class="ph-split__text">
        <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:var(--space-5);">
          <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <a href="<?php echo esc_url(home_url('/recalls/')); ?>">Safety Recalls</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html(wp_trim_words($title, 6, '…')); ?></span>
        </nav>

        <!-- Alert badge -->
        <div style="display:inline-flex;align-items:center;gap:8px;background:#FBE8EA;border:1px solid rgba(192,28,40,0.25);padding:6px 14px;border-radius:2px;font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C01C28;margin-bottom:20px;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          Official Safety Recall Notice
        </div>

        <h1 id="rc-h1" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(2rem,4vw,3.5rem);font-weight:400;letter-spacing:-0.025em;line-height:1.08;color:#0D0D0D;margin-bottom:16px;">
          <?php the_title(); ?>
        </h1>

        <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:var(--space-6);">
          <?php if ($brand): ?>
          <span style="font-family:'Manrope',sans-serif;font-size:12px;font-weight:600;color:var(--color-text-muted);">Brand: <strong style="color:#0D0D0D;"><?php echo esc_html($brand); ?></strong></span>
          <?php endif; ?>
          <span style="color:var(--color-rule);" aria-hidden="true">|</span>
          <span style="font-family:'Manrope',sans-serif;font-size:12px;color:var(--color-text-muted);">Published: <?php echo esc_html($pub_date); ?></span>
          <?php if ($pub_date !== $mod_date): ?>
          <span style="color:var(--color-rule);" aria-hidden="true">|</span>
          <span style="font-family:'Manrope',sans-serif;font-size:12px;color:var(--color-text-muted);">Updated: <?php echo esc_html($mod_date); ?></span>
          <?php endif; ?>
        </div>

        <div style="display:flex;flex-wrap:wrap;gap:12px;">
          <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--primary btn--lg">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            Call <?php echo esc_html($phone); ?>
          </a>
          <a href="/schedule/" class="btn btn--outline btn--lg">Schedule Inspection</a>
        </div>
      </div>
      <div class="ph-split__img">
        <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-tuscany-product-1.jpg'); ?>"
             alt="<?php echo esc_attr($brand ?: 'Viking'); ?> appliance safety recall"
             loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ── CONTENT ───────────────────────────────── -->
<section style="padding:var(--section-md) 0;border-bottom:1px solid var(--color-rule);">
  <div class="container" style="max-width:var(--container-narrow);margin:0 auto;">

    <?php if ($hero_img): ?>
    <img src="<?php echo esc_url($hero_img); ?>"
         alt="<?php echo esc_attr($title); ?>"
         style="width:100%;max-height:400px;object-fit:cover;border-radius:var(--radius-md);margin-bottom:var(--space-8);display:block;"
         loading="lazy">
    <?php endif; ?>

    <!-- Safety alert box -->
    <div style="background:#FBE8EA;border:1px solid rgba(192,28,40,0.2);border-left:3px solid #C01C28;padding:var(--space-5) var(--space-6);margin-bottom:var(--space-8);border-radius:0 var(--radius-md) var(--radius-md) 0;">
      <div style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C01C28;margin-bottom:8px;">Important Safety Notice</div>
      <p style="font-family:'Manrope',sans-serif;font-size:14px;color:#3A0A0A;line-height:1.7;margin:0;">
        If your <?php echo esc_html($brand ?: 'Viking'); ?> appliance is affected by this recall, stop using it immediately and contact us or the manufacturer for a free inspection or repair. Do not attempt to use the appliance until it has been inspected by a qualified technician.
      </p>
    </div>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

    <?php ar_disclaimer($brand); ?>
  </div>
</section>

<!-- ── NEXT STEPS CTA ─────────────────────────── -->
<section style="background:var(--color-primary-dark);padding:var(--section-sm) 0;border-bottom:1px solid rgba(255,255,255,0.07);">
  <div class="container" style="text-align:center;">
    <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:rgba(255,255,255,0.35);display:block;margin-bottom:14px;">Your Next Step</span>
    <h2 style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.875rem,3vw,2.75rem);font-weight:300;color:#fff;letter-spacing:-0.025em;line-height:1.1;margin:0 0 16px;">
      Have Your <?php echo esc_html($brand ?: 'Viking'); ?> Appliance Inspected
    </h2>
    <p style="font-family:'Manrope',sans-serif;font-size:15px;color:rgba(255,255,255,0.5);max-width:480px;margin:0 auto var(--space-8);line-height:1.75;">
      Our certified technicians can inspect your appliance for safety recall issues and perform any required repairs using genuine Viking OEM parts.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;">
      <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--crimson btn--lg"><?php echo esc_html($phone); ?></a>
      <a href="/schedule/" class="btn btn--outline-white btn--lg">Schedule Inspection</a>
    </div>
  </div>
</section>

<!-- ── MORE RECALLS ───────────────────────────── -->
<?php
$other_recalls = get_posts(['post_type' => 'recall', 'numberposts' => 3, 'post__not_in' => [$pid], 'orderby' => 'date', 'order' => 'DESC']);
if (!empty($other_recalls)):
?>
<section style="padding:var(--section-sm) 0;" aria-labelledby="more-recalls-h2">
  <div class="container">
    <span class="section-header__eyebrow">Safety Recalls</span>
    <h2 id="more-recalls-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.5rem,2.5vw,2rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 var(--space-6);line-height:1.1;">
      More Viking Appliance Safety Recalls
    </h2>
    <div style="display:flex;flex-direction:column;gap:0;">
      <?php foreach ($other_recalls as $rc): ?>
      <a href="<?php echo esc_url(get_permalink($rc->ID)); ?>"
         style="display:flex;align-items:center;justify-content:space-between;gap:24px;padding:20px 0;border-top:1px solid var(--color-rule);text-decoration:none;color:#0D0D0D;transition:color 0.12s ease;">
        <div>
          <div style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-primary);margin-bottom:4px;">Safety Recall</div>
          <div style="font-family:'Cormorant',Georgia,serif;font-size:1.1875rem;font-weight:500;letter-spacing:-0.01em;line-height:1.2;">
            <?php echo esc_html($rc->post_title); ?>
          </div>
        </div>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;color:var(--color-text-light);" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <?php endforeach; ?>
      <div style="border-top:1px solid var(--color-rule);padding-top:20px;">
        <a href="<?php echo esc_url(home_url('/recalls/')); ?>" class="btn btn--outline">View All Recalls &rarr;</a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
