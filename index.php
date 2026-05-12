<?php
/**
 * The main template file — fallback for all uncaught requests.
 */
defined('ABSPATH') || exit;
get_header();
?>

<section class="section">
    <div class="container--narrow">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <article <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="content-body"><?php the_content(); ?></div>
                </article>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else: ?>
            <h1>Page Not Found</h1>
            <p>Sorry, the page you're looking for doesn't exist. <a href="<?php echo esc_url(home_url('/')); ?>">Return to homepage →</a></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
