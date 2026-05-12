<?php
/**
 * Assigns _post_image_url and _post_image_alt to every published blog post.
 * Images are matched by topic to genuine Viking brand assets in assets/images/.
 *
 * Run via WP-CLI:
 *   wp eval-file wp-content/themes/viking-appliance-repair-service/inc/set-blog-images.php
 */
defined( 'ABSPATH' ) || die( 'Run via WP-CLI only.' );

$base_url = get_template_directory_uri() . '/assets/images/';

/*
 * Map: post slug → [ image filename, alt text ]
 * Images chosen to match each article topic using real Viking brand photography.
 */
$image_map = [

    /* Range heating diagnosis → Viking 7 Series range in luxury kitchen */
    'viking-range-not-heating-diagnosis-guide' => [
        'img' => 'viking-kitchen-7series-hero.jpg',
        'alt' => 'Viking Professional 7 Series gas range in luxury kitchen',
    ],

    /* F-codes / oven error codes → Viking wall oven 7 Series */
    'viking-oven-f-codes-explained' => [
        'img' => 'viking-wall-oven-7series.jpg',
        'alt' => 'Viking 7 Series built-in wall oven control panel displaying F-code',
    ],

    /* Refrigerator not cooling → Viking 3 Series French door refrigerator */
    'viking-refrigerator-not-cooling-diagnosis' => [
        'img' => 'viking-refrigerator-3series.jpg',
        'alt' => 'Viking 3 Series French door refrigerator',
    ],

    /* Dishwasher not cleaning → Viking 7 Series dishwasher */
    'viking-dishwasher-not-cleaning-causes-fixes' => [
        'img' => 'viking-dishwasher-7series.jpg',
        'alt' => 'Viking 7 Series dishwasher control panel',
    ],

    /* Annual maintenance checklist → Viking full 5 Series kitchen lifestyle */
    'viking-appliance-annual-maintenance-checklist' => [
        'img' => 'viking-5series-kitchen.jpg',
        'alt' => 'Viking 5 Series kitchen appliances including range, refrigerator and dishwasher',
    ],

    /* Professional vs Tuscany comparison → Tuscany range kitchen scene */
    'viking-professional-vs-tuscany-range-comparison' => [
        'img' => 'viking-tuscany-kitchen-1.jpg',
        'alt' => 'Viking Tuscany Series range in professional kitchen setting',
    ],

    /* Gas cooktop burner ignition → Viking rangetop cooktop */
    'viking-cooktop-burner-wont-ignite-troubleshooting' => [
        'img' => 'viking-cooktop-rangetop.jpg',
        'alt' => 'Viking professional gas rangetop cooktop burners',
    ],
];

$updated    = 0;
$not_found  = 0;

foreach ( $image_map as $slug => $data ) {
    $post = get_page_by_path( $slug, OBJECT, 'post' );
    if ( ! $post ) {
        WP_CLI::warning( "Post not found by slug: $slug" );
        $not_found++;
        continue;
    }

    $img_url = $base_url . $data['img'];

    update_post_meta( $post->ID, '_post_image_url', $img_url );
    update_post_meta( $post->ID, '_post_image_alt', $data['alt'] );

    WP_CLI::line( "Set image on [{$post->ID}]: {$post->post_title}" );
    $updated++;
}

WP_CLI::line( '' );
WP_CLI::success( sprintf( 'Images set on %d posts. Not found: %d.', $updated, $not_found ) );
