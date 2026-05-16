<?php
/**
 * Template: Guide / Article — OBSIDIAN Design System
 * CPT: guide | URL: /guides/{slug}/
 */
defined('ABSPATH') || exit;

global $post;
$id         = $post->ID;
$brand      = get_post_meta($id, '_ar_brand',          true) ?: '';
$appliance  = get_post_meta($id, '_ar_appliance_type', true) ?: '';
$phone      = ar_get_phone();
$phone_link = ar_phone_link();
$biz        = ar_get_business_name();

$hero_img_url = '';
if (has_post_thumbnail($id))            $hero_img_url = get_the_post_thumbnail_url($id, 'large');
elseif ($ar_img = get_post_meta($id, '_ar_image', true)) $hero_img_url = $ar_img;

$content    = get_the_content();
$word_count = str_word_count(strip_tags(apply_filters('the_content', $content)));
$read_time  = max(2, (int) ceil($word_count / 200));

$cat_label  = '';
$brand_terms = get_the_terms($id, 'brand');
$app_terms   = get_the_terms($id, 'appliance_type');
if ($brand_terms && !is_wp_error($brand_terms)) $cat_label = $brand_terms[0]->name;
if ($app_terms   && !is_wp_error($app_terms))   $cat_label .= ($cat_label ? ' · ' : '') . $app_terms[0]->name;
if (!$cat_label) $cat_label = 'Repair Guide';

$related_svcs = [];
$related_svc_ids = get_post_meta($id, '_ar_related_services', true);
if (!empty($related_svc_ids) && is_array($related_svc_ids)) {
    $related_svcs = get_posts(['post__in' => $related_svc_ids, 'post_type' => 'service_page', 'numberposts' => 5]);
} elseif ($brand_terms && !is_wp_error($brand_terms)) {
    $related_svcs = get_posts(['post_type' => 'service_page', 'numberposts' => 5, 'tax_query' => [['taxonomy' => 'brand', 'terms' => wp_list_pluck($brand_terms, 'term_id')]]]);
}

$related_guides = get_posts(['post_type' => 'guide', 'numberposts' => 3, 'post__not_in' => [$id], 'orderby' => 'rand']);
$faqs           = get_post_meta($id, '_ar_faqs', true);

$_schema_data = ['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => get_the_title(), 'url' => get_permalink(), 'datePublished' => get_the_date('c'), 'dateModified' => get_the_modified_date('c'), 'description' => get_the_excerpt(), 'wordCount' => $word_count, 'author' => ['@type' => 'Person', 'name' => get_the_author()], 'publisher' => ['@type' => 'Organization', 'name' => $biz, 'logo' => ['@type' => 'ImageObject', 'url' => AR_URI . '/assets/images/logo.png']], 'image' => $hero_img_url ?: null, 'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => get_permalink()]];

$processed_content = preg_replace_callback(
    '/<h2([^>]*)>(.*?)<\/h2>/is',
    function($m) {
        $text = strip_tags($m[2]); $anchor = sanitize_title($text);
        if (strpos($m[1], 'id=') !== false) return $m[0];
        return '<h2' . $m[1] . ' id="' . esc_attr($anchor) . '">' . $m[2] . '</h2>';
    },
    apply_filters('the_content', $content)
);

preg_match_all('/<h2[^>]*id="([^"]+)"[^>]*>(.*?)<\/h2>/is', $processed_content, $toc_matches);
$toc_items = [];
if (!empty($toc_matches[1])) {
    foreach ($toc_matches[1] as $i => $anchor) {
        $toc_items[] = ['anchor' => $anchor, 'label' => strip_tags($toc_matches[2][$i])];
    }
}

get_header();
ar_output_schema($_schema_data);
?>

<style>
.gd-layout {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 4rem;
  align-items: start;
}
.gd-sidebar {
  position: sticky;
  top: 88px;
}
.gd-toc {
  background: var(--color-bg-light);
  border: 1px solid var(--color-rule);
  border-radius: var(--radius-md);
  padding: var(--space-5) var(--space-5);
  margin-bottom: var(--space-5);
}
.gd-toc__title {
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--color-text-muted);
  margin-bottom: var(--space-4);
}
.gd-toc__list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px; }
.gd-toc__link {
  display: block;
  padding: 5px 0;
  font-family: var(--font-body);
  font-size: 13px;
  color: var(--color-text-muted);
  text-decoration: none;
  border-bottom: 1px solid var(--color-rule);
  transition: color var(--transition-fast);
  line-height: 1.4;
}
.gd-toc__link:last-child { border-bottom: none; }
.gd-toc__link:hover { color: var(--color-primary); }

.gd-body { min-width: 0; }

@media (max-width: 900px) {
  .gd-layout { grid-template-columns: 1fr; gap: 2.5rem; }
  .gd-sidebar { position: static; }
}
</style>

<!-- ── HERO ──────────────────────────────────── -->
<div style="background:var(--color-white);border-bottom:1px solid var(--color-rule);padding:calc(64px + 4rem) 0 3rem;">
  <div class="container">
    <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:var(--space-5);">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <span class="breadcrumbs__sep" aria-hidden="true">/</span>
      <a href="<?php echo esc_url(home_url('/guides/')); ?>">Repair Guides</a>
      <span class="breadcrumbs__sep" aria-hidden="true">/</span>
      <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html(wp_trim_words(get_the_title(), 6, '…')); ?></span>
    </nav>

    <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;flex-wrap:wrap;">
      <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--color-primary);"><?php echo esc_html($cat_label); ?></span>
      <span style="color:var(--color-rule);" aria-hidden="true">·</span>
      <span style="font-family:'Manrope',sans-serif;font-size:12px;color:var(--color-text-muted);"><?php echo esc_html($read_time); ?> min read</span>
      <span style="color:var(--color-rule);" aria-hidden="true">·</span>
      <time style="font-family:'Manrope',sans-serif;font-size:12px;color:var(--color-text-muted);" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo get_the_date('F j, Y'); ?></time>
    </div>

    <h1 style="font-family:'Cormorant',Georgia,serif;font-size:clamp(2rem,4vw,3.5rem);font-weight:400;letter-spacing:-0.025em;line-height:1.08;color:#0D0D0D;margin-bottom:16px;">
      <?php the_title(); ?>
    </h1>

    <?php if (get_the_excerpt()): ?>
    <p style="font-family:'Manrope',sans-serif;font-size:16px;color:var(--color-text-muted);line-height:1.75;max-width:620px;">
      <?php echo esc_html(get_the_excerpt()); ?>
    </p>
    <?php endif; ?>
  </div>
</div>

<?php if ($hero_img_url): ?>
<div style="background:var(--color-bg-section);">
  <div class="container" style="padding-top:0;padding-bottom:0;">
    <img src="<?php echo esc_url($hero_img_url); ?>"
         alt="<?php echo esc_attr(get_the_title()); ?>"
         style="width:100%;max-height:480px;object-fit:cover;display:block;"
         loading="lazy">
  </div>
</div>
<?php endif; ?>

<!-- ── ARTICLE BODY ───────────────────────────── -->
<section style="padding:var(--section-md) 0;border-bottom:1px solid var(--color-rule);">
  <div class="container">
    <div class="gd-layout">

      <!-- Sidebar: TOC + CTA -->
      <?php if (!empty($toc_items)): ?>
      <aside class="gd-sidebar" aria-label="Article navigation">
        <div class="gd-toc">
          <div class="gd-toc__title">In This Guide</div>
          <ul class="gd-toc__list">
            <?php foreach ($toc_items as $toc): ?>
            <li>
              <a href="#<?php echo esc_attr($toc['anchor']); ?>" class="gd-toc__link">
                <?php echo esc_html($toc['label']); ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div style="background:var(--color-primary-dark);padding:var(--space-5);border-radius:var(--radius-md);">
          <div style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.35);margin-bottom:12px;">Need a Technician?</div>
          <p style="font-family:'Manrope',sans-serif;font-size:13px;color:rgba(255,255,255,0.55);line-height:1.7;margin-bottom:16px;">
            If your <?php echo esc_html($appliance ?: 'Viking appliance'); ?> needs professional attention, our certified technicians are available same-day.
          </p>
          <a href="<?php echo esc_url($phone_link); ?>" class="btn btn--crimson btn--full" style="font-size:12px;padding:11px 16px;">
            <?php echo esc_html($phone); ?>
          </a>
        </div>
      </aside>
      <?php endif; ?>

      <!-- Article content -->
      <article class="gd-body entry-content" id="article-body">
        <?php echo $processed_content; ?>
        <?php ar_disclaimer($brand); ?>
      </article>

    </div>
  </div>
</section>

<!-- ── RELATED SERVICES ────────────────────────── -->
<?php if (!empty($related_svcs)): ?>
<section style="padding:var(--section-sm) 0;background:var(--color-bg-light);border-bottom:1px solid var(--color-rule);" aria-labelledby="rel-svc-h2">
  <div class="container">
    <span class="section-header__eyebrow">Book a Repair</span>
    <h2 id="rel-svc-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.5rem,2.5vw,2rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 var(--space-6);line-height:1.1;">
      Related Viking Repair Services
    </h2>
    <?php ar_related_links($related_svcs, ''); ?>
  </div>
</section>
<?php endif; ?>

<!-- ── RELATED GUIDES ──────────────────────────── -->
<?php if (!empty($related_guides)): ?>
<section style="padding:var(--section-sm) 0;border-bottom:1px solid var(--color-rule);" aria-labelledby="rel-gd-h2">
  <div class="container">
    <span class="section-header__eyebrow">More Guides</span>
    <h2 id="rel-gd-h2" style="font-family:'Cormorant',Georgia,serif;font-size:clamp(1.5rem,2.5vw,2rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 var(--space-6);line-height:1.1;">
      Other Repair Guides
    </h2>
    <div class="grid grid-3" style="gap:var(--space-4);">
      <?php foreach ($related_guides as $g): ?>
      <a href="<?php echo esc_url(get_permalink($g->ID)); ?>" class="post-card" style="text-decoration:none;">
        <?php if ($thumb = get_the_post_thumbnail_url($g->ID, 'card')): ?>
        <img class="post-card__thumb" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($g->post_title); ?>" loading="lazy">
        <?php endif; ?>
        <div class="post-card__label">Repair Guide</div>
        <h3 class="post-card__title"><?php echo esc_html($g->post_title); ?></h3>
        <?php if ($exc = get_the_excerpt($g->ID)): ?>
        <p class="post-card__excerpt"><?php echo esc_html(wp_trim_words($exc, 20, '…')); ?></p>
        <?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── FAQ ────────────────────────────────────── -->
<?php if (!empty($faqs)) ar_faq_section($faqs, 'Frequently Asked Questions'); ?>

<!-- ── APPOINTMENT ────────────────────────────── -->
<?php ar_appointment_form('guide-page', 'Need a Viking Appliance Technician?'); ?>

<?php get_footer(); ?>
