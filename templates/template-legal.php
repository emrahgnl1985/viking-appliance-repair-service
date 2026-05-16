<?php
/**
 * Template: Legal Pages — OBSIDIAN Design System
 * Used for: Privacy Policy, Terms of Use, Mobile Terms of Use
 */
defined('ABSPATH') || exit;

global $post;
$slug     = $post->post_name;
$title    = get_the_title();
$modified = get_the_modified_date('F j, Y');
$phone    = ar_get_phone();
$phone_link = ar_phone_link();
$biz      = ar_get_business_name();
$content  = apply_filters('the_content', $post->post_content);

$word_count = str_word_count(strip_tags($content));
$read_time  = max(1, (int) ceil($word_count / 200));

$legal_siblings = [
    'privacy-policy'      => 'Privacy Policy',
    'terms-of-use'        => 'Terms of Use',
    'mobile-terms-of-use' => 'Mobile Terms of Use',
];

// Build TOC from h2/h3
$toc = [];
preg_match_all('/<h([23])[^>]*>(.*?)<\/h\1>/i', $content, $headings, PREG_SET_ORDER);
foreach ($headings as $i => $h) {
    $level  = (int) $h[1];
    $text   = strip_tags($h[2]);
    $anchor = 'section-' . ($i + 1) . '-' . sanitize_title($text);
    $toc[]  = ['level' => $level, 'text' => $text, 'anchor' => $anchor];
    $content = str_replace(
        $h[0],
        '<h' . $level . ' id="' . esc_attr($anchor) . '">' . $h[2] . '</h' . $level . '>',
        $content
    );
}

$_schema_data = [
    '@context'     => 'https://schema.org',
    '@type'        => 'WebPage',
    'name'         => $title . ' — ' . $biz,
    'url'          => get_permalink(),
    'dateModified' => get_the_modified_date('c'),
    'publisher'    => ['@type' => 'LocalBusiness', 'name' => $biz, 'url' => home_url('/')],
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

/* ── Legal Page — OBSIDIAN ── */
#lp-progress {
  position: fixed;
  top: 0; left: 0;
  width: 0%;
  height: 2px;
  background: var(--color-primary);
  z-index: 9999;
  transition: width 0.1s linear;
}

.lp-hero {
  background: var(--color-bg-light);
  padding: calc(64px + 4rem) 0 3rem;
  border-bottom: 1px solid var(--color-rule);
}
.lp-hero__label {
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--color-primary);
  display: block;
  margin-bottom: 14px;
}
.lp-hero__title {
  font-family: var(--font-display);
  font-size: clamp(2rem, 4vw, 3.5rem);
  font-weight: 300;
  color: var(--color-primary-dark);
  line-height: 1.08;
  letter-spacing: -0.025em;
  margin: 0 0 14px;
}
.lp-hero__meta {
  display: flex;
  flex-wrap: wrap;
  gap: 16px 28px;
  font-family: var(--font-body);
  font-size: 13px;
  color: var(--color-text-muted);
}
.lp-hero__meta span { display: flex; align-items: center; gap: 6px; }

/* Legal sibling nav */
.lp-sibling-nav {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 24px;
}
.lp-sibling-link {
  display: inline-flex;
  align-items: center;
  padding: 7px 16px;
  border: 1px solid var(--color-rule);
  font-family: var(--font-body);
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.04em;
  color: var(--color-text-muted);
  text-decoration: none;
  border-radius: 2px;
  transition: border-color var(--transition-fast), color var(--transition-fast);
}
.lp-sibling-link:hover,
.lp-sibling-link.current {
  border-color: var(--color-primary-dark);
  color: var(--color-primary-dark);
}
.lp-sibling-link.current { font-weight: 700; }

/* ── Body layout ── */
.lp-layout {
  display: grid;
  grid-template-columns: 240px 1fr;
  gap: 4rem;
  align-items: start;
  padding: 4rem 0 5rem;
}

/* Sidebar TOC */
.lp-toc {
  position: sticky;
  top: 88px;
  background: var(--color-bg-light);
  border: 1px solid var(--color-rule);
  border-radius: var(--radius-md);
  padding: 20px;
}
.lp-toc__title {
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--color-text-muted);
  margin: 0 0 12px;
}
.lp-toc__list { list-style: none; padding: 0; margin: 0; }
.lp-toc__link {
  display: block;
  padding: 6px 0;
  border-bottom: 1px solid var(--color-rule);
  font-family: var(--font-body);
  font-size: 12.5px;
  color: var(--color-text-muted);
  text-decoration: none;
  line-height: 1.4;
  transition: color var(--transition-fast);
}
.lp-toc__link:last-child { border-bottom: none; }
.lp-toc__link:hover { color: var(--color-primary); }
.lp-toc__link--h3 { padding-left: 12px; font-size: 12px; }

/* Article content */
.lp-article .entry-content h2 {
  font-family: var(--font-display);
  font-size: clamp(1.375rem, 2.5vw, 1.875rem);
  font-weight: 500;
  color: var(--color-primary-dark);
  letter-spacing: -0.02em;
  margin: 3rem 0 1rem;
  padding-top: 2.5rem;
  border-top: 1px solid var(--color-rule);
  line-height: 1.15;
  scroll-margin-top: 90px;
}
.lp-article .entry-content h2:first-child { margin-top: 0; padding-top: 0; border-top: none; }
.lp-article .entry-content h3 {
  font-family: var(--font-display);
  font-size: clamp(1.125rem, 2vw, 1.375rem);
  font-weight: 500;
  color: var(--color-primary-dark);
  letter-spacing: -0.01em;
  margin: 2rem 0 0.75rem;
  line-height: 1.2;
  scroll-margin-top: 90px;
}
.lp-article .entry-content p {
  font-size: 15.5px;
  line-height: 1.8;
  color: var(--color-text-body);
  margin-bottom: 1.125rem;
}
.lp-article .entry-content ul,
.lp-article .entry-content ol {
  padding-left: 1.5rem;
  margin-bottom: 1.25rem;
}
.lp-article .entry-content li {
  font-size: 15px;
  line-height: 1.75;
  color: var(--color-text-body);
  margin-bottom: 0.4rem;
}
.lp-article .entry-content strong { font-weight: 600; color: var(--color-primary-dark); }
.lp-article .entry-content a { color: var(--color-primary); text-decoration: underline; text-underline-offset: 2px; }

/* No content fallback */
.lp-no-content {
  font-family: var(--font-body);
  font-size: 15px;
  color: var(--color-text-muted);
  font-style: italic;
}

@media (max-width: 860px) {
  .lp-layout { grid-template-columns: 1fr; }
  .lp-toc { position: static; }
}
@media (max-width: 540px) {
  .lp-layout { padding: 2.5rem 0 3.5rem; gap: 2rem; }
}
</style>

<!-- Progress bar -->
<div id="lp-progress" role="progressbar" aria-hidden="true"></div>

<!-- ── HERO ──────────────────────────────────── -->
<section class="lp-hero" aria-labelledby="lp-h1">
  <div class="container">
    <div class="ph-split">
      <div class="ph-split__text">
        <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:var(--space-5);">
          <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html($title); ?></span>
        </nav>

        <span class="lp-hero__label">Legal</span>
        <h1 class="lp-hero__title" id="lp-h1"><?php echo esc_html($title); ?></h1>

        <div class="lp-hero__meta">
          <span>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18"/></svg>
            Last updated: <?php echo esc_html($modified); ?>
          </span>
          <span>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <?php echo esc_html($read_time); ?> min read
          </span>
        </div>

        <nav class="lp-sibling-nav" aria-label="Legal pages">
          <?php foreach ($legal_siblings as $sibling_slug => $sibling_label):
            $sibling_page = get_page_by_path($sibling_slug);
            if (!$sibling_page) continue;
            $is_current = ($sibling_slug === $slug);
          ?>
          <a href="<?php echo esc_url(get_permalink($sibling_page->ID)); ?>"
             class="lp-sibling-link <?php echo $is_current ? 'current' : ''; ?>"
             <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
            <?php echo esc_html($sibling_label); ?>
          </a>
          <?php endforeach; ?>
        </nav>
      </div>
      <div class="ph-split__img">
        <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-3series-kitchen.jpg'); ?>"
             alt="Viking appliance repair legal information"
             loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ── BODY ──────────────────────────────────── -->
<div class="container">
  <div class="lp-layout">

    <!-- TOC sidebar -->
    <?php if (!empty($toc)): ?>
    <aside aria-label="Table of contents">
      <nav class="lp-toc">
        <p class="lp-toc__title">Contents</p>
        <ul class="lp-toc__list">
          <?php foreach ($toc as $item): ?>
          <li>
            <a href="#<?php echo esc_attr($item['anchor']); ?>"
               class="lp-toc__link <?php echo $item['level'] === 3 ? 'lp-toc__link--h3' : ''; ?>">
              <?php echo esc_html($item['text']); ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </aside>
    <?php endif; ?>

    <!-- Article body -->
    <article class="lp-article" id="lp-article">
      <?php if ($content): ?>
        <div class="entry-content"><?php echo $content; ?></div>
      <?php else: ?>
        <p class="lp-no-content">The content for this page has not been added yet. Please check back shortly.</p>
      <?php endif; ?>

      <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid var(--color-rule);">
        <p style="font-family:var(--font-body);font-size:14px;color:var(--color-text-muted);line-height:1.7;margin:0 0 16px;">
          For questions about this <?php echo esc_html($title); ?>, contact <?php echo esc_html($biz); ?>:
        </p>
        <a href="<?php echo esc_url($phone_link); ?>"
           style="font-family:var(--font-body);font-size:1.125rem;font-weight:700;color:var(--color-primary-dark);text-decoration:none;letter-spacing:-0.01em;">
          <?php echo esc_html($phone); ?>
        </a>
      </div>
    </article>

  </div>
</div>

<script>
(function () {
  var bar = document.getElementById('lp-progress');
  var art = document.getElementById('lp-article');
  if (!bar || !art) return;
  function update() {
    var rect = art.getBoundingClientRect();
    var pct  = Math.min(100, Math.max(0, (-rect.top / (art.offsetHeight - window.innerHeight)) * 100));
    bar.style.width = pct + '%';
  }
  window.addEventListener('scroll', update, { passive: true });
  update();
})();
</script>

<?php get_footer(); ?>
