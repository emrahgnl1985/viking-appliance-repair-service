<?php
/**
 * index.php — Fallback template for all uncaught requests — OBSIDIAN Design System
 */
defined('ABSPATH') || exit;
get_header();
?>

<style>
.idx-hero {
  background: var(--color-bg-light);
  border-bottom: 1px solid var(--color-rule);
  display: grid;
  grid-template-columns: 1fr 42%;
  min-height: 440px;
}
.idx-hero__text {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: calc(64px + 4rem) 3rem 3.5rem var(--space-8);
  max-width: 800px;
}
.idx-hero__img {
  position: relative;
  overflow: hidden;
}
.idx-hero__img img {
  position: absolute;
  inset: 0; width: 100%; height: 100%;
  object-fit: cover; object-position: center;
}
.idx-hero__img::before {
  content: '';
  position: absolute; top: 0; bottom: 0; left: 0;
  width: 2px; background: #C01C28; z-index: 1;
}
.idx-hero__label {
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--color-primary);
  display: block;
  margin-bottom: 14px;
}
.idx-hero__title {
  font-family: var(--font-display);
  font-size: clamp(2rem, 4vw, 3.5rem);
  font-weight: 300;
  color: var(--color-primary-dark);
  letter-spacing: -0.025em;
  line-height: 1.1;
  margin: 0;
}
@media (max-width: 900px) {
  .idx-hero { display: block; min-height: auto; }
  .idx-hero__text { padding: calc(64px + 3rem) var(--space-5) 3rem; max-width: none; }
  .idx-hero__img { height: 260px; position: relative; }
  .idx-hero__img img { position: absolute; }
  .idx-hero__img::before { display: none; }
}
</style>

<?php if (have_posts()): ?>

<section class="idx-hero" aria-labelledby="idx-h1">
  <div class="idx-hero__text">
    <div class="container" style="padding-right:3rem;max-width:none;">
      <span class="idx-hero__label">Viking Appliance Repair</span>
      <h1 class="idx-hero__title" id="idx-h1"><?php the_archive_title(); ?></h1>
    </div>
  </div>
  <div class="idx-hero__img">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/viking-range-desert-modern.jpg'); ?>"
         alt="Viking professional range in modern kitchen"
         loading="eager">
  </div>
</section>

<section style="padding:var(--section-md) 0;background:#fff;">
  <div class="container">
    <div class="grid grid-3" style="gap:var(--space-4);">
      <?php while (have_posts()): the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="post-card" style="text-decoration:none;">
        <?php if (has_post_thumbnail()): ?>
        <img class="post-card__thumb" src="<?php the_post_thumbnail_url('card'); ?>"
             alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php endif; ?>
        <div class="post-card__label">
          <?php the_category(', '); ?>
        </div>
        <h2 class="post-card__title"><?php the_title(); ?></h2>
        <?php if (get_the_excerpt()): ?>
        <p class="post-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20, '…')); ?></p>
        <?php endif; ?>
        <div class="post-card__meta"><?php echo get_the_date(); ?></div>
      </a>
      <?php endwhile; ?>
    </div>

    <div style="margin-top:var(--space-10);">
      <?php the_posts_pagination(['prev_text' => '&larr; Previous', 'next_text' => 'Next &rarr;']); ?>
    </div>
  </div>
</section>

<?php else: ?>

<section class="idx-hero" aria-labelledby="idx-h1">
  <div class="idx-hero__text">
    <div class="container" style="padding-right:3rem;max-width:none;">
      <span class="idx-hero__label">404 — Not Found</span>
      <h1 class="idx-hero__title" id="idx-h1">Page Not Found</h1>
    </div>
  </div>
  <div class="idx-hero__img">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/viking-range-desert-modern.jpg'); ?>"
         alt="Viking professional range"
         loading="eager">
  </div>
</section>

<section style="padding:var(--section-sm) 0;background:#fff;border-bottom:1px solid var(--color-rule);">
  <div class="container container--narrow">
    <p style="font-family:var(--font-body);font-size:1.0625rem;color:var(--color-text-muted);line-height:1.75;margin-bottom:var(--space-8);">
      Sorry, the page you're looking for doesn't exist or has been moved. You can return to the homepage or browse our Viking appliance repair services below.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary btn--lg">Return to Homepage</a>
      <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline btn--lg">Browse Services</a>
    </div>

    <div style="margin-top:var(--space-12);padding-top:var(--space-8);border-top:1px solid var(--color-rule);">
      <span style="font-family:var(--font-body);font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--color-primary);display:block;margin-bottom:var(--space-5);">Viking Repair Services</span>
      <div style="display:flex;flex-direction:column;gap:0;">
        <?php
        $svcs = ['Viking Range Repair'=>'viking-range-repair','Viking Refrigerator Repair'=>'viking-refrigerator-repair','Viking Dishwasher Repair'=>'viking-dishwasher-repair','Viking Cooktop Repair'=>'viking-cooktop-repair','Viking Wall Oven Repair'=>'viking-wall-oven-repair','Viking Wine Cooler Repair'=>'viking-wine-cooler-repair'];
        foreach ($svcs as $label => $slug):
        ?>
        <a href="<?php echo esc_url(home_url("/services/{$slug}/")); ?>"
           style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-top:1px solid var(--color-rule);font-family:var(--font-display);font-size:1.1875rem;font-weight:400;letter-spacing:-0.01em;color:var(--color-primary-dark);text-decoration:none;">
          <?php echo esc_html($label); ?>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;color:var(--color-text-light);" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <?php endforeach; ?>
        <div style="border-top:1px solid var(--color-rule);padding-top:16px;">
          <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline" style="font-size:12px;">All Services &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php endif; ?>

<?php get_footer(); ?>
