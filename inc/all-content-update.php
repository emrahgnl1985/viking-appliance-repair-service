<?php
/**
 * All Content Update Script — overwrites meta fields on existing posts.
 * Use this when posts already exist but have empty/missing ACF meta data.
 *
 * USAGE (from WordPress root):
 *   wp eval-file wp-content/themes/wp-appliancerepair-theme/inc/all-content-update.php
 */

defined( 'ABSPATH' ) || die( 'Run via WP-CLI only.' );

require_once get_template_directory() . '/inc/all-brands-content-data.php';
require_once get_template_directory() . '/inc/locations-content-data.php';
require_once get_template_directory() . '/inc/all-brands-guides-data.php';
require_once get_template_directory() . '/inc/all-brands-error-codes-data.php';
require_once get_template_directory() . '/inc/all-brands-recalls-data.php';

$all_pages = array_merge(
    ar_get_all_brands_content_data(),
    ar_get_locations_content_data(),
    ar_get_all_brands_guides_data(),
    ar_get_all_brands_error_codes_data(),
    ar_get_all_brands_recalls_data()
);

$counts = [ 'updated' => 0, 'created' => 0, 'errors' => 0 ];

WP_CLI::line( '' );
WP_CLI::line( '╔══════════════════════════════════════════════╗' );
WP_CLI::line( '║   Viking Appliance Repair — Full Content Update  ║' );
WP_CLI::line( '╚══════════════════════════════════════════════╝' );
WP_CLI::line( sprintf( 'Total entries to process: %d', count( $all_pages ) ) );
WP_CLI::line( '' );

foreach ( $all_pages as $page ) {

    $post_type = $page['post_type'] ?? 'post';
    $slug      = $page['slug']      ?? '';
    $title     = $page['title']     ?? '(untitled)';

    // Find existing post by slug
    $existing = get_page_by_path( $slug, OBJECT, $post_type );

    if ( $existing ) {
        $post_id = $existing->ID;

        // Update title and excerpt
        wp_update_post( [
            'ID'           => $post_id,
            'post_title'   => $title,
            'post_status'  => 'publish',
            'post_content' => $page['content']  ?? '',
            'post_excerpt' => $page['meta_desc'] ?? '',
        ] );

    } else {
        // Create if missing
        $post_id = wp_insert_post( [
            'post_type'    => $post_type,
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_content' => $page['content']  ?? '',
            'post_excerpt' => $page['meta_desc'] ?? '',
        ], true );

        if ( is_wp_error( $post_id ) ) {
            WP_CLI::error( sprintf( 'Failed: [%s] %s — %s', $post_type, $title, $post_id->get_error_message() ), false );
            $counts['errors']++;
            continue;
        }
        $counts['created']++;
    }

    // Overwrite all ACF / custom meta fields
    if ( ! empty( $page['meta_fields'] ) ) {
        foreach ( $page['meta_fields'] as $meta_key => $meta_value ) {
            update_post_meta( $post_id, $meta_key, $meta_value );
        }
    }

    // Assign taxonomies
    if ( ! empty( $page['taxonomies'] ) ) {
        foreach ( $page['taxonomies'] as $taxonomy => $term_name ) {
            if ( ! term_exists( $term_name, $taxonomy ) ) {
                wp_insert_term( $term_name, $taxonomy );
            }
            $term = get_term_by( 'name', $term_name, $taxonomy );
            if ( $term && ! is_wp_error( $term ) ) {
                wp_set_object_terms( $post_id, $term->term_id, $taxonomy );
            }
        }
    }

    // SEO meta
    $meta_title = $page['meta_title'] ?? '';
    $meta_desc  = $page['meta_desc']  ?? '';
    update_post_meta( $post_id, '_yoast_wpseo_title',    $meta_title );
    update_post_meta( $post_id, '_yoast_wpseo_metadesc', $meta_desc  );
    update_post_meta( $post_id, 'rank_math_title',        $meta_title );
    update_post_meta( $post_id, 'rank_math_description',  $meta_desc  );

    WP_CLI::success( sprintf( 'Updated [%s]: %s (ID: %d)', $post_type, $title, $post_id ) );
    $counts['updated']++;
}

flush_rewrite_rules();

WP_CLI::line( '' );
WP_CLI::line( '╔══════════════════════════════════════════════╗' );
WP_CLI::line( '║                   SUMMARY                   ║' );
WP_CLI::line( '╠══════════════════════════════════════════════╣' );
WP_CLI::line( sprintf( '║  Updated : %-33d║', $counts['updated'] ) );
WP_CLI::line( sprintf( '║  Created : %-33d║', $counts['created'] ) );
WP_CLI::line( sprintf( '║  Errors  : %-33d║', $counts['errors']  ) );
WP_CLI::line( '╚══════════════════════════════════════════════╝' );
WP_CLI::line( '' );
WP_CLI::success( 'Update complete. Go to Settings → Permalinks → Save Changes if any pages return 404.' );

