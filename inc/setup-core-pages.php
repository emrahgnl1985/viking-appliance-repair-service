<?php
/**
 * Core Pages Setup Script
 * Creates Home and Schedule pages, sets Reading options.
 *
 * USAGE (from WordPress root):
 *   wp eval-file wp-content/themes/wp-appliancerepair-theme/inc/setup-core-pages.php
 */

defined('ABSPATH') || die('Run via WP-CLI only.');

WP_CLI::line('');
WP_CLI::line('╔══════════════════════════════════════════════╗');
WP_CLI::line('║     ApplianceRepair — Core Pages Setup       ║');
WP_CLI::line('╚══════════════════════════════════════════════╝');

$pages = [
    ['title' => 'Home',     'slug' => 'home',     'front' => true],
    ['title' => 'Schedule', 'slug' => 'schedule'],
];

$front_id = 0;

foreach ($pages as $p) {
    $existing = get_page_by_path($p['slug'], OBJECT, 'page');
    if ($existing) {
        $id = $existing->ID;
        WP_CLI::line("  Exists: {$p['title']} (ID: {$id})");
    } else {
        $id = wp_insert_post([
            'post_type'   => 'page',
            'post_title'  => $p['title'],
            'post_name'   => $p['slug'],
            'post_status' => 'publish',
            'post_content'=> '',
        ], true);
        if (is_wp_error($id)) {
            WP_CLI::warning("Failed: {$p['title']} — " . $id->get_error_message());
            continue;
        }
        WP_CLI::success("Created: {$p['title']} (ID: {$id})");
    }
    if (!empty($p['front'])) $front_id = $id;
}

if ($front_id) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_id);
    WP_CLI::success("Front page set to Home (ID: {$front_id})");
}

flush_rewrite_rules();
WP_CLI::success('Done.');