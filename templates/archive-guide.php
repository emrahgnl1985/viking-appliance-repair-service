<?php
/**
 * Archive: Guides
 * URL: /guides/
 * Design: matches vikingappliancerepairservice.com/guides/ — editorial warm-white, DM Serif Display headings,
 *         category browse cards, guide grid with read-time, scroll animations.
 */
defined('ABSPATH') || exit;
get_header();

$guides = new WP_Query([
    'post_type'      => 'guide',
    'posts_per_page' => 24,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$total_guides = $guides->found_posts ?: 0;

// Category browse topics — used even when no posts exist
$categories = [
    [ 'icon' => '&#x1F504;', 'title' => 'Repair vs Replace',       'desc' => 'Is it worth fixing or time to buy new? We break down the numbers.',          'slug' => '#repair-vs-replace' ],
    [ 'icon' => '&#x1F4B0;', 'title' => 'Cost Expectations',        'desc' => 'What Viking appliance repairs actually cost — by appliance type and repair complexity.',      'slug' => '#cost-expectations' ],
    [ 'icon' => '&#x2699;️', 'title' => 'Common Problems',          'desc' => 'The most frequent appliance faults explained in plain language.',              'slug' => '#common-problems'   ],
    [ 'icon' => '&#x1F6E1;', 'title' => 'Safety & Risks',           'desc' => 'When an appliance fault is a safety hazard and what to do about it.',          'slug' => '#safety-risks'      ],
    [ 'icon' => '&#x1F527;', 'title' => 'Maintenance & Prevention', 'desc' => 'Simple routines that extend appliance life and prevent costly repairs.',       'slug' => '#maintenance'       ],
    [ 'icon' => '&#x1F6AB;', 'title' => 'When NOT to Repair',       'desc' => 'Signs that repair is no longer the right call — and how to tell.',             'slug' => '#when-not-to-repair'],
    [ 'icon' => '&#x1F4CB;', 'title' => 'Error Codes Explained',    'desc' => 'What the numbers on your display actually mean and how serious they are.',     'slug' => home_url('/error-codes/') ],
];
?>

<style>
:root {
    --g-page:       #FAF7F2;
    --g-surface:    #ffffff;
    --g-alt:        #F2ECE3;
    --g-border:     #e4e2dd;
    --g-ink:        #1a1a1a;
    --g-ink-mid:    #374151;
    --g-ink-muted:  #6B7280;
    --g-navy:       #1A2B42;
    --g-navy-dark:  #0D1A29;
    --g-accent:     #C4943A;
    --g-accent-dark:#9E7428;
    --g-gold-dim:   rgba(196,148,58,.14);
    --g-radius:     12px;
    --g-wrap:       1200px;
    --g-trans:      .2s ease;
}

/* ── Page base ── */
.g-page { background: var(--g-page); min-height: 100vh; }

/* ── Hero ── */
.g-hero {
    background-color: var(--g-navy);
    border-bottom: 3px solid var(--g-accent);
    padding: 72px 0 64px;
    overflow: hidden;
}
.g-hero__inner {
    max-width: var(--g-wrap);
    margin: 0 auto;
    padding: 0 24px;
}
.g-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 20px;
}
.g-eyebrow::before,
.g-eyebrow::after {
    content: '';
    display: block;
    width: 28px;
    height: 1px;
    background: rgba(255, 255, 255, 0.35);
}
.g-hero__title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(36px, 5vw, 58px);
    font-weight: 400;
    color: #ffffff;
    line-height: 1.08;
    letter-spacing: -.03em;
    margin: 0 0 18px;
}
.g-hero__title em { font-style: italic; color: #D4B46A; }
.g-hero__sub {
    font-size: 20px;
    color: rgba(255, 255, 255, 0.78);
    line-height: 1.7;
    max-width: 560px;
    margin: 0 0 36px;
}
.g-hero__stats {
    display: flex;
    gap: 36px;
    flex-wrap: wrap;
}
.g-hero__stat-val {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 30px;
    font-weight: 500;
    color: #D4B46A;
    line-height: 1;
    display: block;
    margin-bottom: 4px;
}
.g-hero__stat-lbl {
    font-size: 15px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.65);
    letter-spacing: .02em;
}
.g-hero__stat + .g-hero__stat {
    padding-left: 36px;
    border-left: 1px solid rgba(255, 255, 255, 0.15);
}

/* ── Section wrapper ── */
.g-section {
    max-width: var(--g-wrap);
    margin: 0 auto;
    padding: 72px 24px;
}
.g-section--alt { background: var(--g-alt); }
.g-section-head { margin-bottom: 40px; }
.g-section-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(24px, 3vw, 36px);
    font-weight: 400;
    color: var(--g-ink);
    letter-spacing: -.02em;
    margin: 0 0 10px;
    line-height: 1.15;
}
.g-section-sub {
    font-size: 15px;
    color: var(--g-ink-muted);
    margin: 0;
    line-height: 1.6;
}

/* ── Category cards ── */
.g-cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 16px;
}
.g-cat-card {
    background: var(--g-surface);
    border: 1px solid var(--g-border);
    border-radius: var(--g-radius);
    padding: 24px 22px;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: border-color var(--g-trans), box-shadow var(--g-trans), transform var(--g-trans);
    position: relative;
    overflow: hidden;
}
.g-cat-card::after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 3px;
    height: 100%;
    background: var(--g-accent);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform var(--g-trans);
}
.g-cat-card:hover {
    border-color: rgba(196,148,58,.28);
    box-shadow: 0 4px 20px rgba(0,0,0,.07);
    transform: translateY(-2px);
}
.g-cat-card:hover::after { transform: scaleY(1); }
.g-cat-icon {
    font-size: 24px;
    line-height: 1;
    display: block;
}
.g-cat-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--g-ink);
    line-height: 1.3;
    margin: 0;
}
.g-cat-desc {
    font-size: 15px;
    color: var(--g-ink-muted);
    line-height: 1.55;
    margin: 0;
    flex: 1;
}
.g-cat-link {
    font-size: 12px;
    font-weight: 600;
    color: var(--g-accent);
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
}

/* ── Guide cards ── */
.g-guides-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.g-guide-card {
    background: var(--g-surface);
    border: 1px solid var(--g-border);
    border-radius: var(--g-radius);
    overflow: hidden;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    transition: border-color var(--g-trans), box-shadow var(--g-trans), transform var(--g-trans);
    opacity: 0;
    transform: translateY(16px);
    transition: opacity .4s ease, transform .4s ease, border-color var(--g-trans), box-shadow var(--g-trans);
}
.g-guide-card.g-vis {
    opacity: 1;
    transform: translateY(0);
}
.g-guide-card:hover {
    border-color: rgba(196,148,58,.22);
    box-shadow: 0 6px 24px rgba(0,0,0,.08);
    transform: translateY(-3px);
}
.g-guide-card__img {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--g-alt);
    position: relative;
    flex-shrink: 0;
}
.g-guide-card__img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform .4s ease;
}
.g-guide-card:hover .g-guide-card__img img {
    transform: scale(1.04);
}
.g-guide-card__img-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    background: linear-gradient(135deg, var(--g-alt) 0%, #e8e5e0 100%);
}
.g-guide-card__body {
    padding: 22px 22px 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 1;
}
.g-guide-card__meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.g-guide-card__cat {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--g-accent);
    background: rgba(196,148,58,.10);
    padding: 3px 8px;
    border-radius: 99px;
    line-height: 1.5;
}
.g-guide-card__date {
    font-size: 12px;
    color: var(--g-ink-muted);
}
.g-guide-card__title {
    font-size: 20px;
    font-weight: 700;
    color: var(--g-ink);
    line-height: 1.35;
    margin: 0;
    letter-spacing: -.01em;
}
.g-guide-card:hover .g-guide-card__title { color: var(--g-accent); }
.g-guide-card__excerpt {
    font-size: 17px;
    color: var(--g-ink-muted);
    line-height: 1.65;
    margin: 0;
    flex: 1;
}
.g-guide-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-top: 4px;
    padding-top: 14px;
    border-top: 1px solid var(--g-border);
}
.g-guide-card__read {
    font-size: 12px;
    color: var(--g-ink-muted);
    display: flex;
    align-items: center;
    gap: 5px;
}
.g-guide-card__arrow {
    font-size: 15px;
    font-weight: 600;
    color: var(--g-accent);
    display: inline-flex;
    align-items: center;
    gap: 3px;
    transition: gap var(--g-trans);
}
.g-guide-card:hover .g-guide-card__arrow { gap: 6px; }

/* ── Empty state ── */
.g-empty {
    text-align: center;
    padding: 80px 24px;
}
.g-empty__icon { font-size: 48px; margin-bottom: 16px; }
.g-empty__title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 24px;
    font-weight: 400;
    color: var(--g-ink);
    margin: 0 0 10px;
}
.g-empty__sub { font-size: 15px; color: var(--g-ink-muted); margin: 0 0 28px; }

/* ── CTA banner ── */
.g-cta-band {
    background: var(--g-ink);
    padding: 64px 24px;
    text-align: center;
}
.g-cta-band__inner { max-width: 640px; margin: 0 auto; }
.g-cta-band__eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: rgba(255,255,255,.45);
    margin-bottom: 14px;
    display: block;
}
.g-cta-band__title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(24px, 3vw, 36px);
    font-weight: 400;
    color: #fff;
    letter-spacing: -.02em;
    line-height: 1.15;
    margin: 0 0 14px;
}
.g-cta-band__sub {
    font-size: 15px;
    color: rgba(255,255,255,.65);
    margin: 0 0 30px;
    line-height: 1.6;
}
.g-cta-band__btns {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}
.g-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 13px 26px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: background var(--g-trans), color var(--g-trans), transform var(--g-trans);
    cursor: pointer;
}

.g-btn--accent { background: var(--g-accent); color: #fff; }
.g-btn--accent:hover { background: var(--g-accent-dark); transform: translateY(-1px); }
.g-btn--ghost { background: rgba(255,255,255,.1); color: #fff; border: 1px solid rgba(255,255,255,.2); }
.g-btn--ghost:hover { background: rgba(255,255,255,.18); transform: translateY(-1px); }

/* ── Responsive ── */
@media (max-width: 960px) {
    .g-guides-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .g-hero { padding: 80px 0 44px; }
    .g-guides-grid { grid-template-columns: 1fr; }
    .g-cat-grid { grid-template-columns: repeat(2, 1fr); }
    .g-hero__stats { gap: 20px; }
    .g-hero__stat + .g-hero__stat { padding-left: 20px; }
}
@media (prefers-reduced-motion: reduce) {
    .g-guide-card { opacity: 1; transform: none; transition: none; }
}
</style>

<div class="g-page">

<!-- ── HERO ──────────────────────────────────────────────── -->
<section class="g-hero" aria-labelledby="g-hero-h1">
    <div class="g-hero__inner">

        <div class="g-eyebrow" aria-hidden="true">Expert Resources</div>

        <h1 class="g-hero__title" id="g-hero-h1">
            Viking Appliance Repair <em>Guides</em>
        </h1>

        <p class="g-hero__sub">
            Make informed decisions about your appliances. Expert advice from certified repair technicians — maintenance tips, troubleshooting walkthroughs, and repair-vs-replace guidance.
        </p>

        <div class="g-hero__stats" role="list" aria-label="Guide statistics">
            <div class="g-hero__stat" role="listitem">
                <span class="g-hero__stat-val"><?php echo $total_guides > 0 ? $total_guides . '+' : '20+'; ?></span>
                <span class="g-hero__stat-lbl">Expert Guides</span>
            </div>
            <div class="g-hero__stat" role="listitem">
                <span class="g-hero__stat-val">7</span>
                <span class="g-hero__stat-lbl">Categories</span>
            </div>
            <div class="g-hero__stat" role="listitem">
                <span class="g-hero__stat-val">5 min</span>
                <span class="g-hero__stat-lbl">Avg. Read Time</span>
            </div>
        </div>

    </div>
</section>

<!-- ── BROWSE BY TOPIC ───────────────────────────────────── -->
<div style="background: var(--g-surface); border-bottom: 1px solid var(--g-border);">
  <div class="g-section" style="padding-top: 56px; padding-bottom: 56px;">
    <div class="g-section-head">
      <h2 class="g-section-title">Browse by Topic</h2>
      <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" 
         style="display: inline; text-decoration: none; color: inherit; transition: color 0.3s;">
        Explore all topics and guides in one place. Go to Blog →
      </a>
    </div>
  </div>
</div>

<style>
.g-section-head a:hover { color: var(--g-accent) !important; }
</style>

<!-- ── GUIDES GRID ───────────────────────────────────────── -->
<div style="background: var(--g-page);">
<div class="g-section">

    <div class="g-section-head" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
        <div>
            <h2 class="g-section-title">All Repair Guides</h2>
            <p class="g-section-sub">Practical, expert-written guides to help you understand your appliances.</p>
        </div>
        <a href="<?php echo esc_url( home_url('/error-codes/') ); ?>"
           class="g-btn g-btn--accent" style="white-space:nowrap;">
            Search Error Codes →
        </a>
    </div>

    <?php if ( $guides->have_posts() ) : ?>

    <div class="g-guides-grid" id="g-guides-grid">
        <?php while ( $guides->have_posts() ) : $guides->the_post();

            // Read time estimate (~200 words/min)
            $word_count  = str_word_count( strip_tags( get_the_content() ) );
            $read_time   = max( 2, (int) ceil( $word_count / 200 ) );

            // Category — use ACF brand/appliance if available, else taxonomy
            $cat_label = '';
            $terms = get_the_terms( get_the_ID(), 'appliance_type' );
            if ( $terms && ! is_wp_error( $terms ) ) {
                $cat_label = $terms[0]->name;
            }
            $brand_terms = get_the_terms( get_the_ID(), 'brand' );
            if ( $brand_terms && ! is_wp_error( $brand_terms ) ) {
                $cat_label = $brand_terms[0]->name . ( $cat_label ? ' · ' . $cat_label : '' );
            }
            if ( ! $cat_label ) $cat_label = 'Guide';
        ?>
        <?php
            // Resolve image: prefer WP featured image, fall back to _ar_image meta URL
            $ar_img_url = get_post_meta( get_the_ID(), '_ar_image', true );
        ?>
        <article class="g-guide-card">
            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                <div class="g-guide-card__img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'medium', [ 'alt' => esc_attr( get_the_title() ) . ' — Viking Appliance Repair Guide', 'loading' => 'lazy' ] ); ?>
                    <?php elseif ( $ar_img_url ) : ?>
                        <img src="<?php echo esc_url( $ar_img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?> — Viking Appliance Repair Guide" loading="lazy">
                    <?php else : ?>
                        <div class="g-guide-card__img-placeholder" aria-hidden="true">&#x1F527;</div>
                    <?php endif; ?>
                </div>
            </a>
            <div class="g-guide-card__body">
                <div class="g-guide-card__meta">
                    <span class="g-guide-card__cat"><?php echo esc_html( $cat_label ); ?></span>
                    <span class="g-guide-card__date"><?php echo get_the_date( 'M j, Y' ); ?></span>
                </div>
                <h2 class="g-guide-card__title">
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <p class="g-guide-card__excerpt">
                    <?php echo wp_trim_words( get_the_excerpt() ?: strip_tags( get_the_content() ), 22, '…' ); ?>
                </p>
                <div class="g-guide-card__footer">
                    <span class="g-guide-card__read">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <?php echo esc_html( $read_time ); ?> min read
                    </span>
                    <a href="<?php the_permalink(); ?>" class="g-guide-card__arrow" aria-label="Read: <?php echo esc_attr( get_the_title() ); ?>">
                        Read guide <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php else : ?>

    <div class="g-empty">
        <div class="g-empty__icon" aria-hidden="true">📖</div>
        <h2 class="g-empty__title">Guides Coming Soon</h2>
        <p class="g-empty__sub">Our technicians are writing in-depth repair guides. Check back soon — or explore our error code database in the meantime.</p>
        <a href="<?php echo esc_url( home_url('/error-codes/') ); ?>" class="g-btn g-btn--accent">Browse Error Codes →</a>
    </div>

    <?php endif; ?>

</div>
</div>

<!-- ── CTA BAND ──────────────────────────────────────────── -->
<div class="g-cta-band">
    <div class="g-cta-band__inner">
        <span class="g-cta-band__eyebrow">Need a technician?</span>
        <h2 class="g-cta-band__title">Still not sure what's wrong with your appliance?</h2>
        <p class="g-cta-band__sub">Our Viking-certified technicians diagnose and repair all Viking appliances. Same-day service available in most areas with a 30-day warranty on every repair.</p>
        <div class="g-cta-band__btns">
            <a href="/schedule/" class="g-btn g-btn--accent">Book a Repair →</a>
            <a href="<?php echo esc_url( home_url('/error-codes/') ); ?>" class="g-btn g-btn--ghost">Search Error Codes</a>
        </div>
    </div>
</div>

</div><!-- /.g-page -->

<!-- Scroll-reveal for guide cards -->
<script>
(function(){
    'use strict';
    var cards = document.querySelectorAll('.g-guide-card');
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced || !('IntersectionObserver' in window)) {
        cards.forEach(function(c){ c.classList.add('g-vis'); });
        return;
    }
    var io = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if (!e.isIntersecting) return;
            var idx = Array.prototype.indexOf.call(cards, e.target);
            setTimeout(function(){ e.target.classList.add('g-vis'); }, (idx % 3) * 80);
            io.unobserve(e.target);
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
    cards.forEach(function(c){ io.observe(c); });
}());
</script>

<?php ar_appointment_form('guides', 'Need a Pro? Book Your Repair Today'); ?>
<?php get_footer(); ?>
