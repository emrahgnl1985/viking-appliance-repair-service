<?php
/**
 * Archive: Location Pages
 * URL: /locations/
 */
defined('ABSPATH') || exit;
get_header();
$locations = new WP_Query(['post_type' => 'location_page', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC']);
?>

<section class="hero hero--info" aria-labelledby="loc-arch-h1">
    <div class="container">
        <h1 id="loc-arch-h1" style="color:#fff;margin-bottom:.75rem;">Samsung Appliance Repair Service Areas</h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.125rem;margin-bottom:0;">Same-day service in <?php echo $locations->found_posts; ?> cities and surrounding areas across the US.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid-3">
            <?php while ($locations->have_posts()): $locations->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="service-card" style="text-decoration:none;">
                <div class="service-card__icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3>Samsung <?php the_title(); ?></h3>
                <p><?php echo wp_trim_words(get_the_excerpt() ?: 'Same-day appliance repair. All major brands. 30-day warranty.', 15); ?></p>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<?php ar_appointment_form('location-archive', 'Book Repair in Your Area'); ?>
<?php get_footer(); ?>
