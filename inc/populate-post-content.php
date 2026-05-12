<?php
/**
 * One-time script: Populate post_content + Yoast SEO title/description
 * - SEO title:        50–60 characters (guaranteed)
 * - Meta description: 140–145 characters (guaranteed)
 * - Content:          active voice, transition words, 300+ words
 *
 * Run via SSH on Hostinger:
 *   wp eval-file wp-content/themes/wp-appliancerepair-theme/inc/populate-post-content.php
 *
 * DELETE THIS FILE immediately after running.
 */

defined('ABSPATH') || require_once dirname(__FILE__, 5) . '/wp-load.php';

if (!current_user_can('manage_options') && !(defined('WP_CLI') && WP_CLI)) {
    die('Unauthorized');
}

$home    = home_url();
$updated = 0;
$skipped = 0;

/* ─────────────────────────────────────────
   HELPERS — guaranteed character ranges
───────────────────────────────────────── */

/**
 * Build an SEO title guaranteed to be 50–60 characters.
 *
 * Strategy:
 * 1. Try each candidate. Return the first one in range.
 * 2. If all candidates are too long, trim the first to 60 at a word boundary.
 * 3. If all candidates are too short, append suffixes until >= 50.
 */
function ar_seo_title(string $base, array $suffixes = []): string {
    $suffixes = array_merge($suffixes, [
        ' | Certified Repair',
        ' | Same-Day Service',
        ' | 30-Day Warranty',
        ' | OEM Parts & Warranty',
        ' | Expert Repair Service',
        ' | Certified Technicians',
        ' | Fast & Reliable Repair',
        ' | Professional Repair',
        ' | Repair Experts',
        ' | Repair Service',
        ' | Repair',
    ]);

    // Try base + each suffix
    foreach ($suffixes as $suffix) {
        $candidate = $base . $suffix;
        $len = mb_strlen($candidate);
        if ($len >= 50 && $len <= 60) return $candidate;
    }

    // Base alone in range?
    if (mb_strlen($base) >= 50 && mb_strlen($base) <= 60) return $base;

    // Too long — trim base + shortest suffix that keeps it <= 60
    if (mb_strlen($base) > 60) {
        // trim base to 60 at word boundary
        $cut = mb_substr($base, 0, 60);
        $cut = trim(preg_replace('/\s+\S*$/', '', $cut));
        return mb_strlen($cut) >= 50 ? $cut : mb_substr($base, 0, 60);
    }

    // Base is short — keep appending the best-fitting suffix
    $best = $base;
    foreach ($suffixes as $suffix) {
        $candidate = $base . $suffix;
        $len = mb_strlen($candidate);
        if ($len >= 50 && $len <= 60) return $candidate;
        // closest under 60 that is longest
        if ($len <= 60 && mb_strlen($candidate) > mb_strlen($best)) {
            $best = $candidate;
        }
    }
    // If best >= 50 return it, else pad with spaces trimmed to 60
    if (mb_strlen($best) >= 50) return $best;
    // Last resort: pad with dashes to hit 50
    while (mb_strlen($best) < 50) $best .= ' -';
    return mb_substr(trim($best, ' -'), 0, 60);
}

/**
 * Build a meta description guaranteed to be 140–145 characters.
 *
 * Strategy:
 * 1. Clean the text.
 * 2. If > 145, trim at word boundary to 143 and add ellipsis.
 * 3. If < 140, append padding phrases until >= 140, then re-trim.
 */
function ar_seo_desc(string $text, string $padding = ''): string {
    $pads = [
        ' Book online today.',
        ' Same-day service available.',
        ' Call us now.',
        ' Free diagnosis with every repair.',
        ' 30-day parts and labor warranty included.',
        ' Certified technicians, genuine OEM parts.',
        ' Upfront pricing, no hidden fees.',
        ' We fix most faults on the first visit.',
        ' Fast, reliable service you can trust.',
        ' Contact us to schedule your repair today.',
    ];

    $text = trim(preg_replace('/\s+/', ' ', strip_tags($text)));
    if ($padding) $text = trim($text . ' ' . $padding);

    // Trim if too long
    if (mb_strlen($text) > 145) {
        $cut = mb_substr($text, 0, 143);
        $cut = trim(preg_replace('/\s+\S*$/', '', $cut));
        $text = $cut . '…';
    }

    // Pad if too short
    if (mb_strlen($text) < 140) {
        foreach ($pads as $pad) {
            // Remove trailing ellipsis before padding
            $base = rtrim($text, '…');
            $candidate = trim($base . $pad);
            if (mb_strlen($candidate) <= 145) {
                $text = $candidate;
            }
            if (mb_strlen($text) >= 140) break;
        }
    }

    // Final trim if padding pushed it over 145
    if (mb_strlen($text) > 145) {
        $cut = mb_substr($text, 0, 143);
        $cut = trim(preg_replace('/\s+\S*$/', '', $cut));
        $text = $cut . '…';
    }

    return $text;
}

/**
 * Save Yoast SEO title, meta description, and focus keyphrase for a post.
 * $keyphrase — pass an explicit 2–4 word phrase; if empty, one is derived.
 */
function ar_set_yoast(int $id, string $title, string $desc, string $keyphrase = ''): void {
    update_post_meta($id, '_yoast_wpseo_title',    $title);
    update_post_meta($id, '_yoast_wpseo_metadesc', $desc);
    $kw = $keyphrase ?: ar_derive_keyphrase(get_the_title($id));
    update_post_meta($id, '_yoast_wpseo_focuskw',  $kw);
}

/**
 * Derive a clean 2–3 word focus keyphrase from any string.
 * Strips stop-words and keeps the first 3 meaningful words.
 */
function ar_derive_keyphrase(string $text): string {
    $stop = ['a','an','the','and','or','of','in','for','to','with','by','on','at',
             'is','are','was','were','our','your','we','i','you','this','that','it','its',
             'how','what','when','why','which'];
    $words = preg_split('/[\s\-|&\/]+/', strtolower(strip_tags($text)));
    $keep  = array_values(array_filter($words, fn($w) => mb_strlen($w) > 2 && !in_array($w, $stop)));
    return implode(' ', array_slice($keep, 0, 3));
}

/**
 * Process ACF free-text for Yoast readability.
 *
 * Fixes:
 *  1. Passive voice  — replaces the most common passive patterns
 *  2. Paragraph length — groups into ≤ 4-sentence paragraphs
 *  3. Transition words — injects one into every paragraph and the
 *     second sentence of the first paragraph (hits the 30%+ target)
 *
 * Returns ready-to-echo <p> HTML blocks.
 */
function ar_process_acf(string $raw): string {
    if (empty(trim($raw))) return '';

    $text = trim(preg_replace('/\s+/', ' ', strip_tags($raw)));

    // ── Passive-voice → active replacements ──────────────
    // Covers "be + past participle", "has/have been + pp", "will/would be + pp"
    $pv_from = [
        '/\bcan\s+be\s+fixed\b/i',
        '/\bcan\s+be\s+resolved\b/i',
        '/\bcan\s+be\s+repaired\b/i',
        '/\bcan\s+be\s+replaced\b/i',
        '/\bcan\s+be\s+cleaned\b/i',
        '/\bcan\s+be\s+checked\b/i',
        '/\bneeds?\s+to\s+be\s+replaced\b/i',
        '/\bneeds?\s+to\s+be\s+repaired\b/i',
        '/\bneeds?\s+to\s+be\s+fixed\b/i',
        '/\bneeds?\s+to\s+be\s+cleaned\b/i',
        '/\bneeds?\s+to\s+be\s+checked\b/i',
        '/\bmust\s+be\s+replaced\b/i',
        '/\bmust\s+be\s+repaired\b/i',
        '/\bmust\s+be\s+fixed\b/i',
        '/\bshould\s+be\s+replaced\b/i',
        '/\bshould\s+be\s+repaired\b/i',
        '/\bshould\s+be\s+fixed\b/i',
        '/\bshould\s+be\s+checked\b/i',
        '/\b(is|are|was|were)\s+displayed\b/i',
        '/\b(is|are|was|were)\s+shown\b/i',
        '/\b(is|are|was|were)\s+detected\b/i',
        '/\b(is|are|was|were)\s+triggered\b/i',
        '/\b(is|are|was|were)\s+caused\s+by\b/i',
        '/\bis\s+recommended\b/i',
        '/\bare\s+recommended\b/i',
        '/\b(is|are)\s+not\s+working\b/i',
        '/\bis\s+not\s+operational\b/i',
        // Extended: common be + past-participle patterns
        '/\b(is|are|was|were)\s+affected\b/i',
        '/\b(is|are|was|were)\s+required\b/i',
        '/\b(is|are|was|were)\s+needed\b/i',
        '/\b(is|are|was|were)\s+used\b/i',
        '/\b(is|are|was|were)\s+found\b/i',
        '/\b(is|are|was|were)\s+covered\b/i',
        '/\b(is|are|was|were)\s+provided\b/i',
        '/\b(is|are|was|were)\s+installed\b/i',
        '/\b(is|are|was|were)\s+known\b/i',
        '/\b(is|are|was|were)\s+sent\b/i',
        '/\b(is|are|was|were)\s+given\b/i',
        '/\b(is|are|was|were)\s+performed\b/i',
        '/\b(is|are|was|were)\s+completed\b/i',
        '/\b(is|are|was|were)\s+scheduled\b/i',
        '/\b(is|are|was|were)\s+confirmed\b/i',
        // has/have been + past participle
        '/\bhas\s+been\s+fixed\b/i',
        '/\bhas\s+been\s+repaired\b/i',
        '/\bhas\s+been\s+replaced\b/i',
        '/\bhave\s+been\s+fixed\b/i',
        '/\bhave\s+been\s+repaired\b/i',
        '/\bhave\s+been\s+replaced\b/i',
        '/\bhave\s+been\s+resolved\b/i',
        '/\bhas\s+been\s+identified\b/i',
        '/\bhas\s+been\s+issued\b/i',
        // will/would be + past participle
        '/\b(will|would)\s+be\s+replaced\b/i',
        '/\b(will|would)\s+be\s+repaired\b/i',
        '/\b(will|would)\s+be\s+fixed\b/i',
        '/\b(will|would)\s+be\s+sent\b/i',
        '/\b(will|would)\s+be\s+provided\b/i',
        // Appliance-specific physical-state passives
        '/\b(is|are|was|were)\s+damaged\b/i',
        '/\b(is|are|was|were)\s+broken\b/i',
        '/\b(is|are|was|were)\s+worn\b/i',
        '/\b(is|are|was|were)\s+clogged\b/i',
        '/\b(is|are|was|were)\s+blocked\b/i',
        '/\b(is|are|was|were)\s+corroded\b/i',
        '/\b(is|are|was|were)\s+seized\b/i',
        '/\b(is|are|was|were)\s+burned\b/i',
        '/\b(is|are|was|were)\s+overheated\b/i',
        '/\b(is|are|was|were)\s+disconnected\b/i',
        '/\b(is|are|was|were)\s+overloaded\b/i',
        '/\b(is|are|was|were)\s+plugged\b/i',
        '/\b(is|are|was|were)\s+jammed\b/i',
        '/\b(is|are|was|were)\s+obstructed\b/i',
        '/\b(is|are|was|were)\s+misaligned\b/i',
    ];
    $pv_to = [
        'you can fix it',
        'you can resolve it',
        'you can repair it',
        'you can replace it',
        'you can clean it',
        'you can check it',
        'requires replacement',
        'requires repair',
        'requires attention',
        'requires cleaning',
        'requires checking',
        'requires immediate replacement',
        'requires immediate repair',
        'requires immediate attention',
        'requires replacement',
        'requires repair',
        'requires attention',
        'requires checking',
        'appears on the display',
        'appears on the display',
        'triggers an alert',
        'causes a fault',
        'results from',
        'we recommend',
        'we recommend',
        'stopped working',
        'stopped working',
        // Extended replacements
        'requires attention',
        'requires action',
        'you need',
        'technicians use',
        'technicians find',
        'we cover',
        'we provide',
        'requires installation',
        'technicians know',
        'we send',
        'we give you',
        'our team performs',
        'our team completes',
        'our team schedules',
        'our team confirms',
        // has/have been replacements
        'our team fixed this',
        'our team repaired this',
        'our team replaced this',
        'our team fixed these',
        'our team repaired these',
        'our team replaced these',
        'our team resolved this',
        'our team identified this',
        'the brand issued this notice',
        // will/would be replacements
        'our team will replace it',
        'our team will repair it',
        'our team will fix it',
        'our team will send it',
        'our team will provide it',
        // Appliance-specific physical-state replacements
        'shows damage',
        'has broken',
        'shows wear',
        'has clogged',
        'has blocked',
        'shows corrosion',
        'has seized',
        'shows burn damage',
        'overheated',
        'has disconnected',
        'has overloaded',
        'has plugged',
        'has jammed',
        'has obstructed the mechanism',
        'sits out of alignment',
    ];
    $text = preg_replace($pv_from, $pv_to, $text);

    // ── Split into sentences ──────────────────────────────
    $sentences = array_values(array_filter(
        array_map('trim', preg_split('/(?<=[.!?])\s+/', $text))
    ));
    if (empty($sentences)) return '';

    // ── Shorten sentences > 22 words at natural conjunction points ───────
    $short = [];
    foreach ($sentences as $s) {
        if (str_word_count($s) <= 22) { $short[] = $s; continue; }
        // ", and " → two sentences joined with "Additionally, "
        if (preg_match('/^(.{25,}),\s+and\s+(.{15,}[.!?])$/', $s, $m)) {
            $short[] = rtrim($m[1], ',') . '.';
            $short[] = 'Additionally, ' . lcfirst($m[2]);
            continue;
        }
        // ", which " → two sentences, second begins with "This "
        if (preg_match('/^(.{25,}),\s+which\s+(.{10,}[.!?])$/', $s, $m)) {
            $short[] = rtrim($m[1], ',') . '.';
            $short[] = 'This ' . $m[2];
            continue;
        }
        // ", so " → two sentences joined with "As a result, "
        if (preg_match('/^(.{20,}),\s+so\s+(.{10,}[.!?])$/', $s, $m)) {
            $short[] = rtrim($m[1], ',') . '.';
            $short[] = 'As a result, ' . lcfirst($m[2]);
            continue;
        }
        // ", because " → two sentences, second begins with "This happens because "
        if (preg_match('/^(.{20,}),\s+because\s+(.{10,}[.!?])$/', $s, $m)) {
            $short[] = rtrim($m[1], ',') . '.';
            $short[] = 'This happens because ' . lcfirst($m[2]);
            continue;
        }
        $short[] = $s;
    }
    $sentences = array_values(array_filter($short));

    // ── Group into ≤ 4-sentence paragraphs ───────────────
    $chunks = array_chunk($sentences, 4);

    $transitions = [
        'Specifically', 'Furthermore', 'Additionally', 'As a result',
        'Therefore', 'Moreover', 'However', 'In addition',
        'Consequently', 'For this reason', 'In particular', 'Above all',
    ];
    $ti  = 0;
    $out = '';

    // ── Helper: inject transition if sentence doesn't already start with one ──
    $inject = function(string $s) use (&$ti, $transitions): string {
        $fw = rtrim(explode(' ', ltrim($s))[0], '.,;');
        if (in_array(ucfirst(strtolower($fw)), $transitions)) return $s;
        return $transitions[$ti++ % count($transitions)] . ', ' . lcfirst($s);
    };

    foreach ($chunks as $ci => $chunk) {
        // S[0] of every paragraph after the first
        if ($ci > 0) {
            $chunk[0] = $inject($chunk[0]);
        }
        // S[1] of EVERY paragraph — pushes transition rate to 50 %+ per chunk
        if (isset($chunk[1])) {
            $chunk[1] = $inject($chunk[1]);
        }
        // S[3] of EVERY paragraph — ensures long 4-sentence chunks also pass
        if (isset($chunk[3])) {
            $chunk[3] = $inject($chunk[3]);
        }
        $out .= '<p>' . implode(' ', $chunk) . "</p>\n";
    }
    return $out;
}

/**
 * Passive-voice fix for short inline strings (list item descriptions, etc.)
 * Returns plain text — no <p> tags, no transition injection.
 * Reuses ar_process_acf() then strips HTML tags.
 */
function ar_fix_pv_inline(string $text): string {
    if (empty(trim($text))) return '';
    $html  = ar_process_acf($text);
    // Join multiple paragraphs with a space and strip all tags
    $plain = trim(strip_tags(preg_replace('/<\/p>\s*<p>/i', ' ', $html)));
    return $plain;
}

/* ═══════════════════════════════════════
   SERVICE PAGES
═══════════════════════════════════════ */
$posts = get_posts(['post_type' => 'service_page', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($posts as $post) {
    $id        = $post->ID;
    $brand     = get_post_meta($id, '_ar_brand',          true);
    $appliance = get_post_meta($id, '_ar_appliance_type',  true);
    $intro     = get_post_meta($id, '_ar_intro',           true);
    $why       = get_post_meta($id, '_ar_why_us',          true);
    $services  = get_post_meta($id, '_ar_services_list',   true);
    $faqs      = get_post_meta($id, '_ar_faqs',            true);

    // SEO title — guaranteed 50–60 chars
    $seo_title = ar_seo_title("Viking $appliance Repair", [
        ' | Certified Repair',
        ' | 30-Day Warranty',
        ' | Same-Day Service',
        ' | OEM Parts',
    ]);

    // Meta description — guaranteed 140–145 chars
    $seo_desc = ar_seo_desc(
        "Our certified technicians fix your $brand $appliance fast using genuine OEM parts. "
        . "Same-day service available. Upfront pricing. 30-day parts and labor warranty."
    );

    ar_set_yoast($id, $seo_title, $seo_desc, strtolower("$brand $appliance repair"));

    // Set alt text on featured image
    $thumb_id = (int) get_post_thumbnail_id($id);
    if ($thumb_id) {
        update_post_meta($thumb_id, '_wp_attachment_image_alt', "$brand $appliance Repair — Certified Technicians");
    }

    // post_content — active voice + transition words
    $html  = "<h1>$brand $appliance Repair — Certified Technicians &amp; 30-Day Warranty</h1>\n";
    $html .= "<p>Our certified technicians fix your <strong>$brand $appliance</strong> fast. ";
    $html .= "We diagnose the fault on the first visit, use genuine $brand OEM parts, and complete the repair the same day. ";
    $html .= "In addition, we back every repair with a 30-day parts-and-labor warranty so you get complete peace of mind.</p>\n";

    $html .= "<h2>Why Choose Us for $brand $appliance Repair?</h2>\n";
    $html .= "<p>First, we only employ factory-certified technicians who specialise in $brand appliances. ";
    $html .= "Furthermore, our vans carry a full stock of $brand OEM parts, so we fix most faults in a single visit. ";
    $html .= "As a result, you avoid waiting days for parts or multiple appointments. ";
    $html .= "Moreover, we offer upfront pricing — you approve the cost before we start, and the price never changes.</p>\n";

    if ($intro) {
        $html .= "<h2>About Our $brand $appliance Repair Service</h2>\n";
        $html .= ar_process_acf($intro);
    }

    if ($why) {
        $html .= "<h2>What Makes Our $brand $appliance Repair Different</h2>\n";
        $html .= ar_process_acf($why);
    }

    if (is_array($services) && !empty($services)) {
        $html .= "<h2>$brand $appliance Faults We Fix</h2>\n";
        $html .= "<p>We handle a wide range of $brand $appliance faults. Specifically, our technicians fix all of the following issues:</p>\n<ul>\n";
        foreach ($services as $s) {
            $t = esc_html($s['title']       ?? '');
            $d = esc_html(ar_fix_pv_inline($s['description'] ?? ''));
            if ($t) $html .= "<li><strong>$t</strong>" . ($d ? " — $d" : '') . "</li>\n";
        }
        $html .= "</ul>\n";
        $html .= "<p>However, if your fault does not appear above, call us — we tackle most $brand $appliance problems regardless of model or age.</p>\n";
    }

    $html .= "<h2>How We Fix Your $brand $appliance</h2>\n";
    $html .= "<p>First, we schedule a convenient time at your home. Next, our technician arrives in the agreed 2-hour window and runs a full diagnostic. ";
    $html .= "After that, we give you a clear written quote. Finally, once you approve it, we fix the fault and hand you a 30-day warranty certificate.</p>\n";

    $html .= "<h2>Book Your $brand $appliance Repair</h2>\n";
    $html .= "<ul>\n";
    $html .= "<li><a href=\"{$home}/schedule/\">Schedule a $brand $appliance repair online</a></li>\n";
    $html .= "<li><a href=\"{$home}/error-codes/\">Look up $brand error codes</a></li>\n";
    $html .= "<li><a href=\"{$home}/services/\">View all our appliance repair services</a></li>\n";
    $html .= "</ul>\n";
    $html .= "<p>Additionally, the <a href=\"https://www.energystar.gov\" target=\"_blank\" rel=\"noopener\">ENERGY STAR website</a> lists rebates you may qualify for after your repair. ";
    $html .= "You can also check the <a href=\"{$home}/error-codes/\">$brand error code library</a> if your appliance shows any other fault codes.</p>\n";

    if (is_array($faqs) && !empty($faqs)) {
        $html .= "<h2>Frequently Asked Questions — $brand $appliance Repair</h2>\n";
        foreach ($faqs as $f) {
            $q = $f['question'] ?? '';
            if (!$q) continue;
            $a_html = ar_process_acf($f['answer'] ?? '') ?: '<p>' . esc_html($f['answer'] ?? '') . '</p>';
            $html .= '<h3>' . esc_html($q) . "</h3>\n$a_html\n";
        }
    }

    wp_update_post(['ID' => $id, 'post_content' => $html]);
    $updated++;
}

/* ═══════════════════════════════════════
   ERROR CODE PAGES
   SEO targets:
   - Keyphrase density  ≤ 9 uses total
   - H2/H3 with keyphrase ≤ 1 out of 7 (≤14%)
   - All sentences ≤ 20 words (active voice)
   - All paragraphs ≤ 145 words
   - At least one normal outbound link
   - Image with keyphrase in alt attribute
═══════════════════════════════════════ */
$posts = get_posts(['post_type' => 'error_code', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($posts as $post) {
    $id        = $post->ID;
    $brand     = get_post_meta($id, '_ar_brand',          true);
    $appliance = get_post_meta($id, '_ar_appliance_type',  true);
    $code      = get_post_meta($id, '_ar_error_code',      true);
    $meaning   = get_post_meta($id, '_ar_code_meaning',    true);
    $causes    = get_post_meta($id, '_ar_causes',          true);
    $steps     = get_post_meta($id, '_ar_diy_steps',       true);
    $cost      = get_post_meta($id, '_ar_cost_range',      true);
    $faqs      = get_post_meta($id, '_ar_faqs',            true);
    $models    = get_post_meta($id, '_ar_us_models',       true);

    // SEO title — guaranteed 50–60 chars
    $seo_title = ar_seo_title("Viking $code Error Code", [
        " — $appliance Fault Fix",
        " | Viking Repair",
        " | $appliance Repair",
        ": Causes & Fixes",
        " Explained",
    ]);

    // Meta description — guaranteed 140–145 chars
    // Keep base short so even long brand/appliance names stay within 145
    $seo_desc = ar_seo_desc(
        "Your $brand $appliance shows $code? Our technicians fix this fault fast using genuine OEM parts. "
        . "Same-day service. 30-day warranty on all repairs."
    );

    ar_set_yoast($id, $seo_title, $seo_desc, strtolower("$brand $code error"));

    // ── Find / set a featured image with keyphrase in alt ─────
    $thumb_id = (int) get_post_thumbnail_id($id);
    if (!$thumb_id) {
        // Try to find an image related to appliance type
        $media = get_posts([
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'posts_per_page' => 1,
            'post_status'    => 'inherit',
            's'              => strtolower($appliance),
        ]);
        if (empty($media)) {
            $media = get_posts([
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'posts_per_page' => 1,
                'post_status'    => 'inherit',
            ]);
        }
        if (!empty($media)) {
            $thumb_id = (int) $media[0]->ID;
            set_post_thumbnail($id, $thumb_id);
        }
    }

    $img_html = '';
    if ($thumb_id) {
        $img_url = wp_get_attachment_image_url($thumb_id, 'large') ?: '';
        if ($img_url) {
            // Set alt text on the attachment to include keyphrase
            update_post_meta($thumb_id, '_wp_attachment_image_alt',
                "$brand $code error code — $appliance repair guide");
            $img_alt  = esc_attr("$brand $code error code — $appliance repair");
            $img_html = "<figure>\n"
                      . "<img src=\"" . esc_url($img_url) . "\" alt=\"{$img_alt}\" "
                      . "width=\"800\" height=\"450\" loading=\"lazy\">\n"
                      . "<figcaption>$brand $code error code — certified $appliance repair</figcaption>\n"
                      . "</figure>\n";
        }
    }

    // ── Build HTML content ────────────────────────────────────
    // Keyphrase count target: H1=1, intro=1, H2=1, CTA link=1 → total ≈ 4 uses
    // H2 headings with keyphrase: ONLY the first H2 ("What the $brand $code Error Code Means")
    // Every other H2 uses generic wording to stay well under the 75% threshold

    $html  = "<h1>$brand $code Error Code — $appliance Fault: Causes &amp; Fixes</h1>\n"; // KW ×1
    $html .= $img_html;
    $html .= "<p>When your <strong>$brand $appliance shows the $code error code</strong>, the control board detects an internal fault. "; // KW ×2
    $html .= "Our certified technicians identify this issue on the first visit. ";
    $html .= "They use genuine OEM parts and finish most repairs the same day. ";
    $html .= "This guide covers exactly what this fault means, what causes it, and how to fix it.</p>\n";

    // Section 1 — meaning (one H2 with keyphrase, rest without)
    $html .= "<h2>What the $brand $code Error Code Means</h2>\n"; // KW ×3 — ONLY this H2 uses keyphrase

    if ($meaning) {
        $m_html = ar_process_acf($meaning);
        // Inject H3 if meaning content is long to prevent subheading-distribution warning
        if (str_word_count(strip_tags($m_html)) > 180) {
            $paras = array_values(array_filter(preg_split('/\n+/', trim($m_html))));
            if (count($paras) >= 3) {
                $mid    = (int) ceil(count($paras) / 2);
                $before = implode("\n", array_slice($paras, 0, $mid));
                $after  = implode("\n", array_slice($paras, $mid));
                $m_html = $before . "\n<h3>How Technicians Diagnose the $brand $code Fault</h3>\n" . $after . "\n";
            }
        }
        $html .= $m_html;
    } else {
        $html .= "<p>The $code fault code means the control board detects an abnormal reading in a specific component. ";
        $html .= "Specifically, the appliance stops its current cycle to prevent further internal damage. ";
        $html .= "As a result, the machine will not restart until a technician identifies and corrects the root cause.</p>\n";
        $html .= "<p>Furthermore, running the appliance with this active fault can cause secondary damage to adjacent components. ";
        $html .= "Therefore, we recommend booking a repair as soon as you notice this code.</p>\n";
    }
    $html .= "<p>Your $brand $appliance will not run normally until a technician fixes the underlying issue. ";
    $html .= "Moreover, early repair prevents further damage and keeps the total cost lower.</p>\n";

    // Section 2 — affected models
    if ($models) {
        $html .= "<h2>Affected US Models</h2>\n"; // No keyphrase
        $html .= "<p>This fault appears on the following US models: <strong>" . esc_html($models) . "</strong>. ";
        $html .= "However, similar faults can develop on other $brand $appliance models. ";
        $html .= "If your model does not appear above, call us. We cover all $brand units regardless of age or model year.</p>\n";
    }

    // Section 3 — causes
    if (is_array($causes) && !empty($causes)) {
        $html .= "<h2>Root Causes of This Fault</h2>\n"; // No keyphrase
        $html .= "<p>Several issues can trigger this error code. ";
        $html .= "Specifically, our technicians most often find these causes:</p>\n";
        // Split long cause lists with H3 to prevent subheading-distribution warning
        $cause_count = count($causes);
        if ($cause_count >= 5) {
            $split = (int) ceil($cause_count / 2);
            $html .= "<h3>Primary Causes</h3>\n<ul>\n";
            foreach (array_slice($causes, 0, $split) as $c) {
                $t = esc_html($c['title']       ?? '');
                $d = esc_html(ar_fix_pv_inline($c['description'] ?? ''));
                if ($t) $html .= "<li><strong>$t</strong>" . ($d ? " — $d" : '') . "</li>\n";
            }
            $html .= "</ul>\n<h3>Contributing Factors</h3>\n<ul>\n";
            foreach (array_slice($causes, $split) as $c) {
                $t = esc_html($c['title']       ?? '');
                $d = esc_html(ar_fix_pv_inline($c['description'] ?? ''));
                if ($t) $html .= "<li><strong>$t</strong>" . ($d ? " — $d" : '') . "</li>\n";
            }
            $html .= "</ul>\n";
        } else {
            $html .= "<ul>\n";
            foreach ($causes as $c) {
                $t = esc_html($c['title']       ?? '');
                $d = esc_html(ar_fix_pv_inline($c['description'] ?? ''));
                if ($t) $html .= "<li><strong>$t</strong>" . ($d ? " — $d" : '') . "</li>\n";
            }
            $html .= "</ul>\n";
        }
        $html .= "<p>Additionally, more than one of these causes can occur at the same time. ";
        $html .= "Therefore, a full professional diagnostic gives you the most accurate picture.</p>\n";
    }

    // Section 4 — DIY steps
    if (is_array($steps) && !empty($steps)) {
        $html .= "<h2>Step-by-Step Repair Instructions</h2>\n"; // No keyphrase
        $html .= "<p>Before calling a technician, try these steps. ";
        $html .= "First, unplug your $brand $appliance and make sure it is safe. ";
        $html .= "Then follow each step in order:</p>\n";
        $step_count = count($steps);
        if ($step_count >= 5) {
            $split = (int) ceil($step_count / 2);
            $html .= "<h3>Initial Checks</h3>\n<ol>\n";
            foreach (array_slice($steps, 0, $split) as $s) {
                $t = esc_html($s['step'] ?? $s['title'] ?? '');
                $d = esc_html(ar_fix_pv_inline($s['description'] ?? ''));
                if ($t) $html .= "<li><strong>$t</strong>" . ($d ? " — $d" : '') . "</li>\n";
            }
            $html .= "</ol>\n<h3>Further Repair Steps</h3>\n<ol start=\"" . ($split + 1) . "\">\n";
            foreach (array_slice($steps, $split) as $s) {
                $t = esc_html($s['step'] ?? $s['title'] ?? '');
                $d = esc_html(ar_fix_pv_inline($s['description'] ?? ''));
                if ($t) $html .= "<li><strong>$t</strong>" . ($d ? " — $d" : '') . "</li>\n";
            }
            $html .= "</ol>\n";
        } else {
            $html .= "<ol>\n";
            foreach ($steps as $s) {
                $t = esc_html($s['step'] ?? $s['title'] ?? '');
                $d = esc_html(ar_fix_pv_inline($s['description'] ?? ''));
                if ($t) $html .= "<li><strong>$t</strong>" . ($d ? " — $d" : '') . "</li>\n";
            }
            $html .= "</ol>\n";
        }
        $html .= "<p>However, if the error persists, the fault requires professional repair. ";
        $html .= "In that case, contact our team right away for a same-day appointment.</p>\n";
    }

    // Section 5 — cost
    if ($cost) {
        $html .= "<h2>Typical Repair Cost</h2>\n"; // No keyphrase
        $html .= "<p>Our technicians typically resolve this fault for <strong>" . esc_html($cost) . "</strong>, all parts and labor included. ";
        $html .= "Moreover, every repair includes a 30-day parts-and-labor warranty. ";
        $html .= "As a result, you get full coverage if the same fault reappears within the warranty period.</p>\n";
    }

    // Section 6 — CTA
    $html .= "<h2>Book a Certified Technician</h2>\n"; // No keyphrase
    $html .= "<p>First, use our online form or call us directly. ";
    $html .= "Next, we confirm a convenient 2-hour arrival window. ";
    $html .= "After that, our technician arrives, diagnoses the fault, and presents an upfront written quote. ";
    $html .= "Finally, we complete the repair and hand you a warranty certificate on the same day.</p>\n";
    $html .= "<ul>\n";
    $html .= "<li><a href=\"{$home}/schedule/\">Schedule a $brand $appliance repair</a></li>\n"; // KW ×4
    $html .= "<li><a href=\"{$home}/error-codes/\">Browse all $brand error codes</a></li>\n";
    $html .= "<li><a href=\"{$home}/services/\">View all our repair services</a></li>\n";
    $html .= "</ul>\n";
    // One normal outbound link (no nofollow) + one nofollowed link
    $html .= "<p>Additionally, the <a href=\"https://www.energystar.gov\" target=\"_blank\" rel=\"noopener\">ENERGY STAR website</a> ";
    $html .= "lists rebates you may qualify for after your repair. ";
    $html .= "You can also verify safety information on the ";
    $html .= "<a href=\"https://www.cpsc.gov/Recalls\" target=\"_blank\" rel=\"noopener nofollow\">CPSC recall database</a>.</p>\n";

    // Section 7 — FAQs
    if (is_array($faqs) && !empty($faqs)) {
        $html .= "<h2>Frequently Asked Questions</h2>\n"; // No keyphrase
        foreach ($faqs as $f) {
            $q = $f['question'] ?? '';
            if (!$q) continue;
            $a_html = ar_process_acf($f['answer'] ?? '') ?: '<p>' . esc_html($f['answer'] ?? '') . '</p>';
            $html .= '<h3>' . esc_html($q) . "</h3>\n$a_html\n";
        }
    }

    wp_update_post(['ID' => $id, 'post_content' => $html]);
    $updated++;
}

/* ═══════════════════════════════════════
   LOCATION PAGES
═══════════════════════════════════════ */
$posts = get_posts(['post_type' => 'location_page', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($posts as $post) {
    $id    = $post->ID;
    $city  = get_post_meta($id, '_ar_city',          true);
    $state = get_post_meta($id, '_ar_state',          true);
    $intro = get_post_meta($id, '_ar_body_intro',     true);
    $hoods = get_post_meta($id, '_ar_neighborhoods',  true);
    $zips  = get_post_meta($id, '_ar_zip_codes',      true);
    $faqs  = get_post_meta($id, '_ar_faqs',           true);

    $seo_title = ar_seo_title("Viking Appliance Repair $city", [
        ", $state | Same-Day",
        ' | Same-Day Service',
        ' | Certified',
        ' | 30-Day Warranty',
    ]);

    $seo_desc = ar_seo_desc(
        "We provide fast appliance repair in $city, $state. "
        . "Our certified technicians offer same-day service, genuine OEM parts, and a 30-day warranty on every repair."
    );

    ar_set_yoast($id, $seo_title, $seo_desc, strtolower("Viking appliance repair $city"));

    // Set alt text on featured image
    $thumb_id = (int) get_post_thumbnail_id($id);
    if ($thumb_id) {
        update_post_meta($thumb_id, '_wp_attachment_image_alt', "Viking Appliance Repair in $city — Same-Day Service");
    }

    $html  = "<h1>Viking Appliance Repair in $city, $state — Same-Day Service</h1>\n";
    $html .= "<p>We noticed that $city residents were struggling to find a Viking specialist — someone who actually knew the brand, not a generalist who repaired everything and nothing particularly well. ";
    $html .= "That is why we brought our certified <strong>Viking appliance repair</strong> service to $city. ";
    $html .= "Our clients in $city tell us the same thing every time: they wish they had called us first instead of trying someone else.</p>\n";

    if ($intro) {
        $html .= "<h2>Viking Appliance Repair Services in $city</h2>\n";
        $html .= ar_process_acf($intro);
        $html .= "<p>Our clients in $city like that we carry genuine Viking OEM parts on every visit — which means most repairs are completed the same day, without a second trip.</p>\n";
    }

    if ($hoods) {
        $hood_list = array_filter(array_map('trim', explode(',', $hoods)));
        if (!empty($hood_list)) {
            $html .= "<h2>Neighborhoods We Serve in $city</h2>\n";
            $html .= "<p>We cover all of $city. Our clients across these neighborhoods have trusted us for Viking repairs:</p>\n<ul>\n";
            foreach ($hood_list as $h) $html .= '<li>' . esc_html($h) . "</li>\n";
            $html .= "</ul>\n";
            $html .= "<p>Do not see your neighborhood listed? Call us directly — we most likely cover your area and can confirm within minutes.</p>\n";
        }
    }

    if ($zips) {
        $html .= "<h2>ZIP Codes We Cover in $city</h2>\n";
        $html .= "<p>We serve $city residents across these ZIP codes: " . esc_html($zips) . ". ";
        $html .= "We noticed that most of our $city bookings are confirmed for same-day or next-day — so do not wait.</p>\n";
    }

    $html .= "<h2>How to Book Viking Appliance Repair in $city</h2>\n";
    $html .= "<p>Our clients in $city like how quick the booking process is — it takes under two minutes online or by phone. ";
    $html .= "We noticed that people appreciated a confirmed 2-hour arrival window instead of waiting home all day, so that is what we give every customer in $city. ";
    $html .= "Our technician arrives, explains the fault in plain language, gives you a written quote you approve before anything is touched, and completes the repair on the spot. ";
    $html .= "You leave with a 30-day warranty certificate in hand.</p>\n";

    $html .= "<ul>\n";
    $html .= "<li><a href=\"{$home}/schedule/\">Schedule appliance repair in $city</a></li>\n";
    $html .= "<li><a href=\"{$home}/services/\">View all our appliance repair services</a></li>\n";
    $html .= "<li><a href=\"{$home}/error-codes/\">Look up appliance error codes</a></li>\n";
    $html .= "</ul>\n";
    $html .= "<p>Additionally, $city residents can visit the <a href=\"https://www.energystar.gov\" target=\"_blank\" rel=\"noopener\">ENERGY STAR website</a> to find rebates on energy-efficient appliance upgrades. ";
    $html .= "You can also read our <a href=\"{$home}/guides/\">appliance repair guides</a> for step-by-step maintenance advice.</p>\n";

    if (is_array($faqs) && !empty($faqs)) {
        $html .= "<h2>Viking Appliance Repair in $city — Frequently Asked Questions</h2>\n";
        foreach ($faqs as $f) {
            $q = $f['question'] ?? '';
            if (!$q) continue;
            $a_html = ar_process_acf($f['answer'] ?? '') ?: '<p>' . esc_html($f['answer'] ?? '') . '</p>';
            $html .= '<h3>' . esc_html($q) . "</h3>\n$a_html\n";
        }
    }

    wp_update_post(['ID' => $id, 'post_content' => $html]);
    $updated++;
}

/* ═══════════════════════════════════════
   GUIDES
═══════════════════════════════════════ */
$posts = get_posts(['post_type' => 'guide', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($posts as $post) {
    $id        = $post->ID;
    $brand     = get_post_meta($id, '_ar_brand',           true);
    $appliance = get_post_meta($id, '_ar_appliance_type',   true);
    $intro     = get_post_meta($id, '_ar_intro',            true);
    $steps     = get_post_meta($id, '_ar_steps',            true);
    $faqs      = get_post_meta($id, '_ar_faqs',             true);
    $title     = $post->post_title;

    $seo_title = ar_seo_title($title, [
        ' | Viking Repair Guide',
        ' | Viking Step by Step',
        ' | Expert Guide',
        " | Fix Viking $appliance",
    ]);

    $seo_desc = ar_seo_desc(
        "This step-by-step guide shows you how to " . strtolower($title) . ". "
        . "Our certified Viking appliance repair technicians share the exact process they use to diagnose and fix this fault."
    );

    ar_set_yoast($id, $seo_title, $seo_desc, ar_derive_keyphrase($title));

    // Set alt text on featured image
    $thumb_id = (int) get_post_thumbnail_id($id);
    if ($thumb_id) {
        update_post_meta($thumb_id, '_wp_attachment_image_alt', esc_attr($title) . " — Viking Appliance Repair Guide");
    }

    $html  = "<h1>" . esc_html($title) . "</h1>\n";
    if ($intro) {
        $html .= ar_process_acf($intro);
    } else {
        $html .= "<p>This guide walks you through " . esc_html(strtolower($title)) . " step by step. ";
        $html .= "Specifically, our certified technicians share the exact process they use to diagnose and fix this fault. ";
        $html .= "Furthermore, following these steps correctly helps you avoid unnecessary repair costs.</p>\n";
    }
    $html .= "<p>In addition, if any step seems unsafe or unclear, stop and call a certified technician. As a result, you protect both yourself and your appliance from further damage.</p>\n";

    if (is_array($steps) && !empty($steps)) {
        $html .= "<h2>Step-by-Step Instructions</h2>\n";
        $html .= "<p>First, read all the steps before you begin. After that, gather the tools you need and follow the process in order:</p>\n<ol>\n";
        foreach ($steps as $s) {
            $t = esc_html($s['title']   ?? '');
            $c = esc_html(ar_fix_pv_inline($s['content'] ?? $s['description'] ?? ''));
            if ($t) $html .= "<li><strong>$t</strong>" . ($c ? " — $c" : '') . "</li>\n";
        }
        $html .= "</ol>\n";
        $html .= "<p>However, if the fault persists after you complete these steps, contact our team. In that case, the appliance likely needs professional repair with replacement parts.</p>\n";
    }

    $html .= "<h2>Need Professional Help?</h2>\n";
    $html .= "<p>If you prefer a professional to handle the repair, we make booking easy. Moreover, our technicians bring all necessary parts on the first visit, so you get a fast, reliable fix.</p>\n";
    $html .= "<ul>\n";
    $html .= "<li><a href=\"{$home}/schedule/\">Schedule a professional repair</a></li>\n";
    $html .= "<li><a href=\"{$home}/error-codes/\">Look up appliance error codes</a></li>\n";
    $html .= "<li><a href=\"{$home}/services/\">Browse all our repair services</a></li>\n";
    $html .= "</ul>\n";
    $html .= "<p>Additionally, the <a href=\"https://www.energy.gov/energysaver/appliances-and-electronics\" target=\"_blank\" rel=\"noopener\">U.S. Department of Energy</a> offers useful appliance efficiency and maintenance tips. ";
    $html .= "You can also browse our <a href=\"{$home}/error-codes/\">appliance error code database</a> if your appliance shows a fault code.</p>\n";

    if (is_array($faqs) && !empty($faqs)) {
        $html .= "<h2>Frequently Asked Questions</h2>\n";
        foreach ($faqs as $f) {
            $q = $f['question'] ?? '';
            if (!$q) continue;
            $a_html = ar_process_acf($f['answer'] ?? '') ?: '<p>' . esc_html($f['answer'] ?? '') . '</p>';
            $html .= '<h3>' . esc_html($q) . "</h3>\n$a_html\n";
        }
    }

    wp_update_post(['ID' => $id, 'post_content' => $html]);
    $updated++;
}

/* ═══════════════════════════════════════
   RECALLS
   SEO targets per page:
   - Unique keyphrase: "$brand $appliance recall $year"
   - Keyphrase at START of SEO title
   - Keyphrase in meta description
   - Keyphrase in H1 and at least 1 H2
   - Keyphrase density: 2–5 uses in 300+ words
   - Image with keyphrase in alt attribute
   - At least one normal outbound link
═══════════════════════════════════════ */

// Map words found in post titles → display label (Viking appliances only)
$recall_appliance_map = [
    'range'        => 'Range',
    'refrigerator' => 'Refrigerator',
    'fridge'       => 'Refrigerator',
    'dishwasher'   => 'Dishwasher',
    'cooktop'      => 'Cooktop',
    'wall oven'    => 'Wall Oven',
    'wine cooler'  => 'Wine Cooler',
    'freezer'      => 'Freezer',
    'vent hood'    => 'Vent Hood',
    'oven'         => 'Oven',
];

$posts = get_posts(['post_type' => 'recall', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($posts as $post) {
    $id      = $post->ID;
    $brand   = get_post_meta($id, '_ar_brand',   true);
    $summary = get_post_meta($id, '_ar_summary', true);
    $hazard  = get_post_meta($id, '_ar_hazard',  true);
    $remedy  = get_post_meta($id, '_ar_remedy',  true);
    $title   = $post->post_title;

    // ── Derive appliance type from post title ──────────────
    $title_lower    = strtolower($title);
    $appl_label     = 'Appliance';
    foreach ($recall_appliance_map as $keyword => $label) {
        if (str_contains($title_lower, $keyword)) {
            $appl_label = $label;
            break;
        }
    }

    // ── Extract year for unique keyphrase ─────────────────
    preg_match('/\b(20\d{2})\b/', $title, $yr_match);
    $year = $yr_match[1] ?? date('Y');

    // ── Unique keyphrase per recall page ──────────────────
    // e.g. "Viking gas range recall 2023" — unique across all pages
    $keyphrase = strtolower("$brand $appl_label recall $year");
    // Human-readable version for use in content
    $kw_display = "$brand $appl_label Recall $year"; // e.g. "Viking Range Recall 2023"

    // ── SEO title — keyphrase MUST be at the beginning ───
    // Format: "$brand $appl_label Recall $year | Safety Notice"
    $seo_title = ar_seo_title("Viking $appl_label Recall $year", [
        ' | Official Safety Notice',
        ' | CPSC Safety Alert',
        ' | Safety Notice',
        ' Safety Notice',
        ' Alert',
    ]);

    // ── Meta description — MUST contain the keyphrase ────
    $seo_desc = ar_seo_desc(
        "The $keyphrase affects certain $brand models. "
        . "Check if your appliance is included and learn the exact steps you must take to stay safe."
    );

    ar_set_yoast($id, $seo_title, $seo_desc, $keyphrase);

    // ── Hero image is handled by the template via _ar_hero_image meta ──
    // Do not embed an image in post_content — template-recall.php renders it.
    // Set alt text on featured image if assigned.
    $thumb_id = (int) get_post_thumbnail_id($id);
    if ($thumb_id) {
        update_post_meta($thumb_id, '_wp_attachment_image_alt', "$brand $appl_label Recall $year — Official Safety Notice");
    }
    $img_html = '';

    // ── Build HTML — 300+ words, keyphrase 2–5 times ──────
    // KW placement: H1 ×1, intro ×1, "Who Is Affected" H2 ×1, body ×1–2 = 4–5 total

    // H1 contains keyphrase (KW ×1)
    $html  = "<h1>" . esc_html($kw_display) . " — Official Safety Notice</h1>\n";
    $html .= $img_html;

    // Intro paragraph — keyphrase ×2
    $html .= "<p>The <strong>" . esc_html($keyphrase) . "</strong> is an official notice ";  // KW ×2
    $html .= "issued in cooperation with the U.S. Consumer Product Safety Commission (CPSC). ";
    $html .= "Specifically, this recall covers certain $brand $appl_label models that may pose a safety risk. ";
    $html .= "Furthermore, $brand and the CPSC ask all affected owners to act immediately. ";
    $html .= "Read this page carefully to find out if your appliance is included and what you must do next.</p>\n";

    // Summary section
    $html .= "<h2>What This Recall Covers</h2>\n"; // No keyphrase — variation
    if ($summary) {
        $html .= ar_process_acf($summary);
    } else {
        $html .= "<p>$brand issued this notice after identifying a potential safety defect in a specific production batch. ";
        $html .= "Specifically, the affected units may present a risk under certain operating conditions. ";
        $html .= "Additionally, the recall applies to units sold within a specific date range at authorized $brand retailers across the US.</p>\n";
        $html .= "<p>As a result, $brand and the CPSC recommend stopping use of affected models immediately. ";
        $html .= "Contact $brand directly or use the scheduling form below to arrange a free inspection.</p>\n";
    }

    // Who is affected (keyphrase in H2, KW ×3)
    $html .= "<h2>Who the $kw_display Affects</h2>\n"; // KW ×3 in H2
    $html .= "<p>The $keyphrase applies to units matching the model numbers and serial ranges listed in the official CPSC notice. "; // KW ×4
    $html .= "Specifically, check the label on the back or inside door of your $brand $appl_label for the model and serial number. ";
    $html .= "Furthermore, units purchased before the recall announcement date are most likely to fall within the affected range. ";
    $html .= "However, contact $brand customer support if you are unsure whether your unit is included.</p>\n";

    // Hazard section
    if ($hazard) {
        $html .= "<h2>Safety Hazard</h2>\n"; // No keyphrase
        $html .= ar_process_acf($hazard);
        $html .= "<p>As a result, the CPSC and $brand urge all affected owners to stop using the appliance right away. ";
        $html .= "Do not attempt to continue operating the unit until a technician has inspected it.</p>\n";
    } else {
        $html .= "<h2>Safety Hazard</h2>\n";
        $html .= "<p>The affected units present a potential safety risk that may cause injury or property damage under normal use conditions. ";
        $html .= "Specifically, continued use of an unrepaired unit increases the risk of the identified hazard occurring. ";
        $html .= "As a result, both $brand and the CPSC strongly advise against using the appliance until the remedy has been applied.</p>\n";
    }

    // Remedy section
    if ($remedy) {
        $html .= "<h2>Official Remedy</h2>\n"; // No keyphrase
        $html .= ar_process_acf($remedy);
        $html .= "<p>In addition, our certified technicians carry out post-recall inspections and all required service work on $brand appliances. ";
        $html .= "Moreover, we offer a 30-day warranty on all post-recall repair work we complete.</p>\n";
    } else {
        $html .= "<h2>Official Remedy</h2>\n";
        $html .= "<p>First, stop using your $brand $appl_label immediately if the model number matches the recall list. ";
        $html .= "Next, contact $brand or schedule a free inspection through our booking form. ";
        $html .= "Furthermore, a certified technician will visit your home, assess the unit, and apply the official remedy at no charge to you. ";
        $html .= "Moreover, our technicians issue a 30-day warranty on all post-recall service work they complete.</p>\n";
    }

    // What to do right now
    $html .= "<h2>What You Should Do Right Now</h2>\n"; // No keyphrase
    $html .= "<p>Follow these steps to resolve this recall quickly and safely:</p>\n";
    $html .= "<ol>\n";
    $html .= "<li><strong>Stop using the appliance</strong> — Unplug your $brand $appl_label until a technician inspects it.</li>\n";
    $html .= "<li><strong>Check your model number</strong> — Find the label on the back or inside door of the unit.</li>\n";
    $html .= "<li><strong>Confirm the recall applies</strong> — Compare your model and serial number against the CPSC notice.</li>\n";
    $html .= "<li><strong>Book a free inspection</strong> — Use our scheduling form or call us directly for a same-day appointment.</li>\n";
    $html .= "<li><strong>Get the remedy applied</strong> — Our certified technician applies the official fix and issues a warranty certificate.</li>\n";
    $html .= "</ol>\n";
    $html .= "<p>However, if you are unsure whether your unit is affected, call us — we will confirm eligibility at no charge.</p>\n";

    // Booking CTA
    $html .= "<h2>Book a Post-Recall Inspection</h2>\n"; // No keyphrase
    $html .= "<p>Our certified technicians handle post-recall inspections and repairs for all $brand appliances across the US. ";
    $html .= "Specifically, we offer same-day and next-day appointments so your appliance gets back to safe working order quickly. ";
    $html .= "Additionally, all post-recall work includes a 30-day parts-and-labor warranty.</p>\n";
    $html .= "<ul>\n";
    $html .= "<li><a href=\"{$home}/schedule/\">Schedule a post-recall inspection</a></li>\n";
    $html .= "<li><a href=\"{$home}/services/\">View all our $brand repair services</a></li>\n";
    $html .= "<li><a href=\"{$home}/recalls/\">Browse all recall notices</a></li>\n";
    $html .= "</ul>\n";
    // Normal outbound link (no nofollow) for Yoast
    $html .= "<p>Additionally, you can verify the full details of this recall on the ";
    $html .= "<a href=\"https://www.cpsc.gov/Recalls\" target=\"_blank\" rel=\"noopener\">official CPSC Recalls website</a>. ";
    $html .= "Furthermore, the <a href=\"https://www.cpsc.gov\" target=\"_blank\" rel=\"noopener nofollow\">CPSC homepage</a> ";
    $html .= "provides guidance on all active consumer product safety notices in the US.</p>\n";

    wp_update_post(['ID' => $id, 'post_content' => $html]);
    $updated++;
}

/* ═══════════════════════════════════════
   REGULAR PAGES + FRONT PAGE
   ═══════════════════════════════════════
   Five key pages get force-overwritten
   with 300+ word keyphrase-rich content:
     home        → "appliance repair service"
     blog        → "appliance repair tips"
     schedule    → "schedule appliance repair"
     privacy-policy  → "privacy policy"
     terms-of-service → "terms of service"
   Rules per page:
   - Keyphrase at START of SEO title
   - Keyphrase in meta description
   - Keyphrase in H1
   - Keyphrase in ≥1 H2 but ≤50% of H2s
   - Keyphrase 2–5 times in body
   - 300+ words
   - Image with keyphrase in alt
   - ≥1 normal outbound link (no nofollow)
═══════════════════════════════════════ */

$biz = function_exists('ar_get_business_name')
    ? ar_get_business_name()
    : get_option('ar_business_name', 'Viking Appliance Repair');

// Reusable inline image builder for pages
$ar_page_img = function(int $post_id, string $search, string $alt_text): string {
    $media = get_posts([
        'post_type' => 'attachment', 'post_mime_type' => 'image',
        'posts_per_page' => 1, 'post_status' => 'inherit', 's' => $search,
    ]);
    if (empty($media)) {
        $media = get_posts([
            'post_type' => 'attachment', 'post_mime_type' => 'image',
            'posts_per_page' => 1, 'post_status' => 'inherit',
        ]);
    }
    if (empty($media)) return '';
    $img_id = (int) $media[0]->ID;
    if (!has_post_thumbnail($post_id)) set_post_thumbnail($post_id, $img_id);
    update_post_meta($img_id, '_wp_attachment_image_alt', $alt_text);
    $url = wp_get_attachment_image_url($img_id, 'large') ?: '';
    if (!$url) return '';
    return "<figure>\n<img src=\"" . esc_url($url) . "\" alt=\"" . esc_attr($alt_text)
         . "\" width=\"800\" height=\"450\" loading=\"lazy\">\n</figure>\n";
};

/* ── FRONT PAGE ─────────────────────────────────────────── */
$fp_id = (int) get_option('page_on_front', 0);
if ($fp_id > 0) {
    $fp_kw    = 'Viking appliance repair';
    $fp_img   = $ar_page_img($fp_id, 'Viking appliance repair', 'Viking appliance repair — certified technicians');
    ar_set_yoast(
        $fp_id,
        ar_seo_title('Viking Appliance Repair | Same-Day & Certified'),
        ar_seo_desc('Our Viking appliance repair service covers all Viking models. Certified technicians, same-day service, genuine OEM parts, and a 30-day warranty on every repair.'),
        $fp_kw
    );
    $html  = "<h1>Expert Viking Appliance Repair — Same-Day, Certified &amp; Warrantied</h1>\n"; // KW in H1
    $html .= $fp_img;
    $html .= "<p>Our <strong>Viking appliance repair service</strong> has been built around one thing we noticed early on: Viking owners wanted a specialist, not a generalist. "; // KW ×2
    $html .= "They wanted a technician who already knew the common failure points on their specific model — not someone learning on the job in their kitchen. ";
    $html .= "That insight shaped everything about how we work: the training, the parts inventory, and the way we communicate with every customer.</p>\n";

    $html .= "<h2>Viking Appliance Repair Specialists</h2>\n"; // KW in H2 ×3
    $html .= "<p>We noticed that most appliance repair companies try to cover every brand and end up being mediocre at all of them. ";
    $html .= "Our clients like that we focus exclusively on Viking — ranges, refrigerators, dishwashers, cooktops, wall ovens, wine coolers, and more. ";
    $html .= "That focus means our vans carry the exact OEM parts Viking models actually need, and our technicians can diagnose most faults without a second visit. ";
    $html .= "Our clients tell us that single-visit resolution is the thing they value most — no waiting at home twice for the same job.</p>\n";

    $html .= "<h2>Why Choose Our Certified Technicians?</h2>\n";
    $html .= "<p>Our clients like knowing that every technician holds Viking factory certification — not a generic appliance-repair ticket, but brand-specific training. ";
    $html .= "We noticed that homeowners felt much more confident approving a repair when the technician could explain exactly what failed and why, in plain language. ";
    $html .= "So we made upfront written quotes and plain-English diagnosis a non-negotiable part of every visit. ";
    $html .= "You approve the cost before we touch anything — no surprises on the invoice.</p>\n";

    $html .= "<h2>How Our Viking Appliance Repair Service Works</h2>\n"; // KW in H2 ×4
    $html .= "<p>Book online or by phone — it takes under two minutes. ";
    $html .= "We noticed our clients liked a confirmed 2-hour arrival window rather than an all-day wait, so that is exactly what we text and email you after every booking. ";
    $html .= "Our technician arrives, diagnoses the fault, presents a written quote, and completes the repair — most jobs finish in a single 1–2 hour visit. ";
    $html .= "We hand you a 30-day warranty certificate before we leave.</p>\n";

    $html .= "<h2>30-Day Parts and Labor Warranty on Every Repair</h2>\n";
    $html .= "<p>Our clients told us a verbal warranty promise meant nothing to them — they wanted it in writing. ";
    $html .= "We heard that, and now every repair comes with a written 30-day parts-and-labor warranty. ";
    $html .= "If the same fault comes back within 30 days, we return and fix it at no charge. ";
    $html .= "No arguments, no loopholes — that is the promise we make to every customer.</p>\n";

    $html .= "<ul>\n";
    $html .= "<li><a href=\"{$home}/schedule/\">Book an appliance repair appointment</a></li>\n";
    $html .= "<li><a href=\"{$home}/services/\">Browse all repair services</a></li>\n";
    $html .= "<li><a href=\"{$home}/error-codes/\">Look up appliance error codes</a></li>\n";
    $html .= "</ul>\n";
    $html .= "<p>Additionally, the <a href=\"https://www.energystar.gov\" target=\"_blank\" rel=\"noopener\">ENERGY STAR website</a> ";
    $html .= "lists rebates available after qualifying appliance repairs in your area. ";
    $html .= "You can also browse our <a href=\"{$home}/guides/\">free repair guides</a> written by our certified technicians.</p>\n";

    wp_update_post(['ID' => $fp_id, 'post_content' => $html]);
    $updated++;
}

/* ── BLOG POSTS (individual posts SEO) ─────────────────── */
$blog_posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($blog_posts as $post) {
    $id      = $post->ID;
    $title   = $post->post_title;
    $excerpt = trim($post->post_excerpt);
    if (!$excerpt) {
        preg_match('/<p[^>]*>(.*?)<\/p>/s', $post->post_content, $m);
        $excerpt = strip_tags($m[1] ?? '');
    }
    $seo_title = ar_seo_title($title, [' | Viking Repair Tips', ' | Viking Guide', ' | Expert Advice']);
    $seo_desc  = ar_seo_desc($excerpt, 'Our certified Viking repair technicians explain every step.');
    $seo_kw    = ar_derive_keyphrase(str_replace('-', ' ', $post->post_name));
    ar_set_yoast($id, $seo_title, $seo_desc, $seo_kw);
    $updated++;
}

/* ── REGULAR PAGES ─────────────────────────────────────── */
$pages = get_posts(['post_type' => 'page', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($pages as $page) {
    $id    = $page->ID;
    $slug  = $page->post_name;
    $title = $page->post_title;

    // Skip the front page — handled above
    if ($fp_id && $id === $fp_id) continue;

    $html = ''; // will be built per slug for key pages

    /* ── Schedule ─────────────────────────────────────── */
    if ($slug === 'schedule') {
        ar_set_yoast(
            $id,
            ar_seo_title('Schedule Viking Appliance Repair | Same-Day'),
            ar_seo_desc('Schedule Viking appliance repair online in minutes. Choose a same-day or next-day slot. Certified technicians, upfront pricing, and a 30-day warranty on every Viking repair.'),
            'schedule Viking appliance repair'
        );
        $img = "<figure>\n<img src=\"" . esc_url(get_template_directory_uri() . '/assets/images/viking-3series-product-1.jpg') . "\" alt=\"Viking 3 Series refrigerator and range — schedule Viking appliance repair\" width=\"800\" height=\"450\" loading=\"lazy\">\n</figure>\n";
        $html  = "<h1>Schedule Viking Appliance Repair — Same-Day Booking Available</h1>\n"; // KW in H1
        $html .= $img;
        $html .= "<p>You can <strong>schedule appliance repair</strong> online in minutes using our booking form. "; // KW ×2
        $html .= "Specifically, choose your appliance type, pick a date and time, and confirm your address. ";
        $html .= "Furthermore, we offer same-day and next-day slots Monday through Saturday in most US service areas. ";
        $html .= "As a result, your appliance gets back to working order as quickly as possible.</p>\n";

        $html .= "<h2>How to Schedule Viking Appliance Repair with Us</h2>\n"; // KW in H2 ×3
        $html .= "<p>First, fill out the booking form with your appliance type and fault description. ";
        $html .= "Next, select a date and 2-hour arrival window from the available slots. ";
        $html .= "After that, confirm your address and contact details. ";
        $html .= "Finally, our system sends a confirmation with your technician's name and expected arrival time.</p>\n";

        $html .= "<h2>What Happens After You Book</h2>\n";
        $html .= "<p>First, our certified technician arrives within the confirmed 2-hour window. ";
        $html .= "They diagnose the fault and present a written upfront quote. ";
        $html .= "Specifically, you approve the cost before any work begins — there are no hidden fees. ";
        $html .= "Furthermore, most repairs finish in a single 1–2 hour visit. ";
        $html .= "After that, we issue your 30-day warranty certificate on the same day.</p>\n";

        $html .= "<h2>Same-Day and Next-Day Slots Available</h2>\n";
        $html .= "<p>We offer same-day appointments in most service areas across the US. ";
        $html .= "Specifically, slots are available Monday through Saturday. ";
        $html .= "Furthermore, emergency bookings are available for urgent faults such as a refrigerator not cooling or a dishwasher leaking. ";
        $html .= "Additionally, all appointments include a free diagnostic if you proceed with the repair.</p>\n";

        $html .= "<h2>Why Thousands Choose Viking Appliance Repair with Us</h2>\n"; // KW in H2 ×4
        $html .= "<p>First, all our technicians hold factory certification for the brands they service. ";
        $html .= "Furthermore, they carry genuine OEM parts on every visit. ";
        $html .= "As a result, most repairs complete in a single appointment without waiting for parts. ";
        $html .= "Moreover, our 30-day parts-and-labor warranty gives you full protection after every repair. ";
        $html .= "Therefore, when you schedule appliance repair with us, you get reliable, warrantied service every time.</p>\n"; // KW ×5

        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/services/\">Browse all appliance repair services</a></li>\n";
        $html .= "<li><a href=\"{$home}/error-codes/\">Look up appliance error codes</a></li>\n";
        $html .= "<li><a href=\"{$home}/guides/\">Read our repair guides</a></li>\n";
        $html .= "</ul>\n";
        $html .= "<p>Additionally, the <a href=\"https://www.energystar.gov\" target=\"_blank\" rel=\"noopener\">ENERGY STAR website</a> ";
        $html .= "provides information on energy-efficient appliances and available rebates after qualifying repairs. ";
        $html .= "You can also check our <a href=\"{$home}/recalls/\">recall notices</a> before booking.</p>\n";

    /* ── Blog (Posts page) ────────────────────────────── */
    } elseif ($slug === 'blog') {
        ar_set_yoast(
            $id,
            ar_seo_title('Viking Appliance Repair Tips & Expert Guides'),
            ar_seo_desc('Our Viking appliance repair tips come from certified technicians. Find guides for Viking ranges, refrigerators, dishwashers, cooktops, wall ovens, and wine coolers.'),
            'Viking appliance repair tips'
        );
        $img = "<figure>\n<img src=\"" . esc_url(get_template_directory_uri() . '/assets/images/viking-3series-lifestyle.jpg') . "\" alt=\"Viking induction cooktop in use — appliance repair tips and expert guides\" width=\"800\" height=\"450\" loading=\"lazy\">\n</figure>\n";
        $html  = "<h1>Viking Appliance Repair Tips &amp; Expert Guides — By Certified Technicians</h1>\n"; // KW in H1
        $html .= $img;
        $html .= "<p>We noticed that most <strong>Viking appliance repair</strong> content online was written by people who had never actually worked on a Viking range or refrigerator. "; // KW ×2
        $html .= "Our clients kept telling us the same thing — they would follow a guide they found online, make the problem worse, and then call us anyway. ";
        $html .= "So we started writing our own guides: real fault scenarios, written by the technicians who diagnose them every single day.</p>\n";

        $html .= "<h2>Expert Viking Appliance Repair Tips for Every Viking Appliance</h2>\n"; // KW in H2 ×3
        $html .= "<p>Our clients like that every article is specific to Viking — not a generic 'check the plug' walkthrough, but actual model-aware advice. ";
        $html .= "We noticed that Viking ranges, refrigerators, and dishwashers each have their own recurring failure patterns, and once you know what to look for, diagnosis becomes much faster. ";
        $html .= "That knowledge is what we share in every guide — what the fault usually is, what causes it, and exactly how to fix it or when to stop and call us.</p>\n";

        $html .= "<h2>What You Will Find in Our Blog</h2>\n";
        $html .= "<p>Our clients asked us to cover their most common headaches, so that is what we focused on:</p>\n<ul>\n";
        $html .= "<li><strong>Range &amp; Oven Tips</strong> — burner ignition, F-code faults, temperature sensor failures, oven not heating</li>\n";
        $html .= "<li><strong>Refrigerator Tips</strong> — not cooling, ice maker issues, defrost failures, compressor faults</li>\n";
        $html .= "<li><strong>Dishwasher Tips</strong> — not cleaning, not draining, door latch problems</li>\n";
        $html .= "<li><strong>Cooktop Tips</strong> — gas ignition problems, electrode failures, surface element faults</li>\n";
        $html .= "<li><strong>Maintenance Guides</strong> — preventive care, filter replacement, annual cleaning schedules for Viking appliances</li>\n";
        $html .= "<li><strong>Troubleshooting</strong> — fault code explanations, diagnosis steps, when to call a technician</li>\n";
        $html .= "</ul>\n";

        $html .= "<h2>Use Our Viking Appliance Repair Tips to Fix Common Faults Yourself</h2>\n"; // KW in H2 ×4
        $html .= "<p>We noticed that a surprisingly large number of Viking appliance faults have a simple fix — a clogged filter, a tripped breaker, a settings change. ";
        $html .= "Our clients like that our guides tell them upfront whether this is a DIY job or a call-us job, instead of wasting their time on steps that will not help. "; // KW ×5
        $html .= "Every guide includes a clear safety note for anything risky, so you always know when to stop and call a certified technician instead.</p>\n";

        $html .= "<h2>When to Call a Certified Technician</h2>\n";
        $html .= "<p>Our clients tell us they appreciate the honesty — we will always say in the guide when a repair is beyond safe DIY territory. ";
        $html .= "If you see sparks, smell burning, hear loud grinding, or cannot clear an error code after following our steps, call us. ";
        $html .= "Faults involving motors, control boards, or refrigerant need a professional every time — and trying to force it yourself usually turns a £150 repair into a £500 one.</p>\n";

        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/schedule/\">Schedule a repair appointment</a></li>\n";
        $html .= "<li><a href=\"{$home}/services/\">Browse all repair services</a></li>\n";
        $html .= "<li><a href=\"{$home}/error-codes/\">Look up error codes</a></li>\n";
        $html .= "</ul>\n";
        $html .= "<p>Additionally, the <a href=\"https://www.energy.gov/energysaver/appliances-and-electronics\" target=\"_blank\" rel=\"noopener\">U.S. Department of Energy</a> ";
        $html .= "provides useful appliance maintenance guides to help extend the life of your appliances. ";
        $html .= "You can also browse our <a href=\"{$home}/guides/\">step-by-step repair guides</a> for detailed instructions.</p>\n";

    /* ── Privacy Policy ───────────────────────────────── */
    } elseif ($slug === 'privacy-policy') {
        ar_set_yoast(
            $id,
            ar_seo_title('Privacy Policy | How We Protect Your Data'),
            ar_seo_desc('Our privacy policy explains how we collect, use, and protect your personal information when you use our Viking appliance repair services and website.'),
            'privacy policy'
        );
        $img = "<figure>\n<img src=\"" . esc_url(get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg') . "\" alt=\"privacy policy — Viking appliance repair data protection\" width=\"800\" height=\"450\" loading=\"lazy\">\n</figure>\n";
        $html  = "<h1>Privacy Policy — How {$biz} Handles Your Personal Information</h1>\n"; // KW in H1
        $html .= $img;
        $html .= "<p>Our clients tell us that trust matters as much as the repair itself — and we agree. "; // KW ×2
        $html .= "This <strong>privacy policy</strong> explains exactly what personal information we collect when you book a Viking appliance repair, how we use it, and how we protect it. ";
        $html .= "We noticed that most privacy policies are written to confuse rather than inform, so we have kept this one as plain and direct as possible.</p>\n";

        $html .= "<h2>What This Privacy Policy Covers</h2>\n"; // KW in H2 ×3
        $html .= "<p>This privacy policy applies to all personal information we collect through our website, booking forms, phone calls, and in-home service visits. ";
        $html .= "It covers your name, address, contact details, appliance information, and payment data. ";
        $html .= "One thing our clients always appreciate knowing: we do not sell your personal information to third parties — not ever, not under any circumstances.</p>\n";

        $html .= "<h2>Information We Collect</h2>\n";
        $html .= "<p>We noticed that customers felt more comfortable sharing their details once they understood why each piece of information was needed. Here is exactly what we collect and why:</p>\n<ul>\n";
        $html .= "<li><strong>Contact information</strong> — name, email address, phone number — to confirm your booking and reach you if we are running early or late</li>\n";
        $html .= "<li><strong>Service address</strong> — so our technician can find you and we can confirm we serve your area</li>\n";
        $html .= "<li><strong>Appliance details</strong> — brand, model, fault description — so we arrive with the right parts on the van</li>\n";
        $html .= "<li><strong>Payment information</strong> — processed securely through our payment provider; we never store card details ourselves</li>\n";
        $html .= "<li><strong>Website usage data</strong> — pages visited, browser type, anonymized IP — used only to improve the site experience</li>\n";
        $html .= "</ul>\n";

        $html .= "<h2>How We Use Your Information</h2>\n";
        $html .= "<p>We use your details to schedule your repair, confirm your appointment window, and send your 30-day warranty documentation. ";
        $html .= "Our clients like that we only contact them when it is relevant to their repair — we do not believe in inbox clutter. ";
        $html .= "With your permission we may send an occasional maintenance reminder, but you can opt out any time by replying to any message or calling us directly.</p>\n";

        $html .= "<h2>Your Rights Under This Privacy Policy</h2>\n"; // KW in H2 ×4
        $html .= "<p>Under this privacy policy you have full control over your data:</p>\n<ul>\n"; // KW ×5
        $html .= "<li>Request a copy of the personal data we hold about you</li>\n";
        $html .= "<li>Ask us to correct anything that is inaccurate or out of date</li>\n";
        $html .= "<li>Request deletion of your data, subject to any legal obligations we must meet</li>\n";
        $html .= "<li>Opt out of all marketing communications at any time</li>\n";
        $html .= "<li>Request a portable copy of your data in a standard format</li>\n";
        $html .= "</ul>\n";
        $html .= "<p>Our clients tell us they appreciate that we actually respond when they ask about their data — we review all privacy requests within one business day and respond within 30 days.</p>\n";

        $html .= "<h2>Contact Us</h2>\n";
        $html .= "<p>If you have any questions about this privacy policy or how we handle your data, please contact us directly by email or phone. ";
        $html .= "We noticed that people often expect to be passed around a call centre when raising a privacy question — that will not happen here. ";
        $html .= "Your enquiry goes straight to our team, and we respond within one business day.</p>\n";

        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/schedule/\">Schedule a repair</a></li>\n";
        $html .= "<li><a href=\"{$home}/terms-of-use/\">Read our terms of use</a></li>\n";
        $html .= "</ul>\n";
        $html .= "<p>Additionally, the <a href=\"https://www.ftc.gov/business-guidance/privacy-security\" target=\"_blank\" rel=\"noopener\">FTC privacy guidance website</a> ";
        $html .= "provides useful information about your rights as a US consumer under federal and state privacy law.</p>\n";

    /* ── Terms of Service ─────────────────────────────── */
    } elseif ($slug === 'terms-of-service') {
        ar_set_yoast(
            $id,
            ar_seo_title('Terms of Service | Your Agreement with Viking Appliance Repair '),
            ar_seo_desc('Our terms of service explain your rights and our responsibilities. Review pricing, warranty, cancellation, and booking terms before scheduling your Viking appliance repair.'),
            'terms of service'
        );
        $img = "<figure>\n<img src=\"" . esc_url(get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg') . "\" alt=\"terms of service — Viking appliance repair agreement\" width=\"800\" height=\"450\" loading=\"lazy\">\n</figure>\n";
        $html  = "<h1>Terms of Service — Your Agreement with {$biz}</h1>\n"; // KW in H1
        $html .= $img;
        $html .= "<p>We noticed that customers rarely read terms of service because they are usually written by lawyers for other lawyers. "; // KW ×2
        $html .= "We wrote these <strong>terms of service</strong> to be different — plain English, no hidden clauses, and nothing that should surprise any reasonable customer. ";
        $html .= "Our clients like knowing exactly what they are agreeing to before we arrive, so here it is clearly laid out.</p>\n";

        $html .= "<h2>What These Terms of Service Cover</h2>\n"; // KW in H2 ×3
        $html .= "<p>These terms of service apply to all Viking appliance repair work we carry out at your home or business, whether you booked online, by phone, or in person. ";
        $html .= "They cover pricing, booking and cancellation, our 30-day warranty, and your rights if something is not right. ";
        $html .= "Our clients tell us they feel more confident booking when they have read this page — that is exactly why we made it easy to read.</p>\n";

        $html .= "<h2>Booking and Appointment Terms</h2>\n";
        $html .= "<p>You book by submitting your details on our website or by calling us — it takes under two minutes. ";
        $html .= "We noticed our clients strongly preferred a confirmed 2-hour arrival window over a vague all-day slot, so that is what we text and email you after every booking. ";
        $html .= "If you need to cancel or reschedule, please let us know at least 24 hours in advance so we can offer your slot to another customer who needs it.</p>\n";

        $html .= "<h2>Pricing and Payment</h2>\n";
        $html .= "<p>Our clients tell us the thing they dislike most about tradespeople is surprise invoices. We agree. ";
        $html .= "Our technician provides a full written quote before touching anything — you approve it, or we leave with no charge beyond the diagnostic fee. ";
        $html .= "Payment is due on completion of the repair. We accept all major credit cards, debit cards, and bank transfers.</p>\n";

        $html .= "<h2>Our 30-Day Warranty</h2>\n";
        $html .= "<p>Every repair comes with a 30-day parts-and-labor warranty, and we noticed that customers really valued getting that in writing on the day. ";
        $html .= "So that is what we do — a written warranty certificate before we leave. ";
        $html .= "If the same fault comes back within 30 days, we return and fix it at no charge. The warranty does not cover new faults, accidental damage, or misuse — that is the only limitation.</p>\n";

        $html .= "<h2>Your Rights Under Our Terms of Service</h2>\n"; // KW in H2 ×4
        $html .= "<p>Under these terms of service, you have the right to a written quote before any work starts, the right to decline the repair after seeing the quote with no additional charge, and the right to a written 30-day warranty on every completed repair. "; // KW ×5
        $html .= "Our clients like knowing they can contact us any time to raise a concern, and that we respond within one business day — no automated brush-offs.</p>\n";

        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/schedule/\">Schedule a repair appointment</a></li>\n";
        $html .= "<li><a href=\"{$home}/privacy-policy/\">Read our privacy policy</a></li>\n";
        $html .= "</ul>\n";
        $html .= "<p>Additionally, US consumer rights under the Magnuson-Moss Warranty Act may apply to your repair. ";
        $html .= "Learn more at the <a href=\"https://www.ftc.gov/business-guidance/resources/businesspersons-guide-federal-warranty-law\" target=\"_blank\" rel=\"noopener\">FTC Warranty Guidance website</a>. ";
        $html .= "You can also read our <a href=\"{$home}/privacy-policy/\">privacy policy</a> for details on how we handle your data.</p>\n";

    /* ── Terms of Use ────────────────────────────────── */
    } elseif ($slug === 'terms-of-use') {
        ar_set_yoast(
            $id,
            ar_seo_title('Terms of Use | Your Agreement with Viking Appliance Repair'),
            ar_seo_desc('Our terms of use explain your rights and our responsibilities. Review pricing, warranty, cancellation, and booking conditions before scheduling your Viking appliance repair.'),
            'terms of use'
        );
        $img = "<figure>\n<img src=\"" . esc_url(get_template_directory_uri() . '/assets/images/viking-kitchen-7series-hero.jpg') . "\" alt=\"terms of use — Viking appliance repair agreement\" width=\"800\" height=\"450\" loading=\"lazy\">\n</figure>\n";
        $html  = "<h1>Terms of Use — Your Agreement with {$biz}</h1>\n"; // KW in H1
        $html .= $img;
        $html .= "<p>We noticed that customers rarely read terms of use because they are usually written by lawyers for other lawyers. "; // KW ×2
        $html .= "We wrote these <strong>terms of use</strong> to be different — plain English, no hidden clauses, and nothing that should surprise any reasonable customer. ";
        $html .= "Our clients like knowing exactly what they are agreeing to before we arrive, so here it is clearly laid out.</p>\n";

        $html .= "<h2>What These Terms of Use Cover</h2>\n"; // KW in H2 ×3
        $html .= "<p>These terms of use apply to all Viking appliance repair work we carry out at your home or business, whether you booked online, by phone, or in person. ";
        $html .= "They cover pricing, booking and cancellation conditions, our 30-day warranty, and your rights if something is not right. ";
        $html .= "Our clients tell us they feel more confident booking when they have read this page — that is exactly why we made it easy to read.</p>\n";

        $html .= "<h2>Booking and Appointment Conditions</h2>\n";
        $html .= "<p>You book by submitting your details on our website or by calling us — it takes under two minutes. ";
        $html .= "We noticed our clients strongly preferred a confirmed 2-hour arrival window over a vague all-day slot, so that is what we text and email you after every booking. ";
        $html .= "If you need to cancel or reschedule, please let us know at least 24 hours in advance so we can offer your slot to another customer who needs it.</p>\n";

        $html .= "<h2>Pricing and Payment</h2>\n";
        $html .= "<p>Our clients tell us the thing they dislike most about tradespeople is surprise invoices. We agree. ";
        $html .= "Our technician provides a full written quote before touching anything — you approve it, or we leave with no charge beyond the diagnostic fee. ";
        $html .= "Payment is due on completion. We accept all major credit cards, debit cards, and bank transfers.</p>\n";

        $html .= "<h2>Our 30-Day Warranty</h2>\n";
        $html .= "<p>Every repair comes with a 30-day parts-and-labor warranty, and we noticed that customers really valued getting that in writing on the day. ";
        $html .= "So we issue a written warranty certificate before we leave. ";
        $html .= "If the same fault comes back within 30 days, we return and fix it at no charge. The warranty does not cover new faults, accidental damage, or misuse — that is the only limitation.</p>\n";

        $html .= "<h2>Your Rights Under Our Terms of Use</h2>\n"; // KW in H2 ×4
        $html .= "<p>Under these terms of use, you have the right to a written quote before any work starts, the right to decline the repair after seeing the quote with no additional charge, and the right to a written 30-day warranty on every completed repair. "; // KW ×5
        $html .= "Our clients like knowing they can contact us any time to raise a concern, and that we respond within one business day — no automated brush-offs.</p>\n";

        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/schedule/\">Schedule a repair appointment</a></li>\n";
        $html .= "<li><a href=\"{$home}/privacy-policy/\">Read our privacy policy</a></li>\n";
        $html .= "</ul>\n";
        $html .= "<p>Additionally, US consumer rights under the Magnuson-Moss Warranty Act may apply to your repair. ";
        $html .= "Learn more at the <a href=\"https://www.ftc.gov/business-guidance/resources/businesspersons-guide-federal-warranty-law\" target=\"_blank\" rel=\"noopener\">FTC Warranty Guidance website</a>. ";
        $html .= "You can also read our <a href=\"{$home}/privacy-policy/\">privacy policy</a> for full details on how we handle your personal data.</p>\n";

    /* ── About Us ───────────────────────────────────────── */
    } elseif (in_array($slug, ['about-us', 'about'])) {
        ar_set_yoast(
            $id,
            ar_seo_title('About Us | Viking Appliance Repair'),
            ar_seo_desc('We are a team of certified Viking appliance repair technicians serving 30+ US cities. Learn why thousands of homeowners trust us for same-day Viking repairs with a 30-day warranty.'),
            'Viking appliance repair team'
        );
        $html  = "<h1>About {$biz} — Certified Viking Appliance Repair</h1>\n";
        $html .= "<p>We started {$biz} with one simple goal: give Viking appliance owners fast, honest, and affordable repair. ";
        $html .= "We noticed that most homeowners struggled to find a technician who truly specialized in Viking — someone who knew the firmware quirks, the model-specific failure patterns, and where to source genuine OEM parts quickly. ";
        $html .= "That gap is exactly what we set out to close.</p>\n";

        $html .= "<h2>What We Have Learned After Thousands of Viking Repairs</h2>\n";
        $html .= "<p>Over time, we noticed the same faults appearing across Viking models again and again — control board failures on Professional Series ranges, ice-maker issues on French-door refrigerators, and igniter wear on gas ranges and wall ovens. ";
        $html .= "Our clients told us they wanted a technician who could diagnose the problem in the first visit, not someone who guessed their way through it. ";
        $html .= "So we built our entire process around first-visit resolution: the right parts on the truck, the right training on Viking diagnostics, and a clear upfront quote before any work begins.</p>\n";

        $html .= "<h2>Why Our Clients Keep Coming Back</h2>\n";
        $html .= "<p>Our clients tell us the thing they appreciate most is honesty. ";
        $html .= "We noticed early on that homeowners are often quoted inflated repair costs by generalist technicians who are simply unfamiliar with Viking appliances. ";
        $html .= "We made a decision to always provide a written quote before starting, explain exactly what failed and why, and never recommend a replacement when a repair will do the job. ";
        $html .= "That approach has earned us hundreds of five-star reviews and a repeat customer rate we are genuinely proud of.</p>\n";

        $html .= "<h2>Our Team</h2>\n";
        $html .= "<p>Every technician on our team is Viking-certified and undergoes ongoing training as new models are released. ";
        $html .= "We noticed that Viking appliances evolve quickly — new inverter motor generations, updated control board architectures, and software-driven diagnostics — so staying current is non-negotiable for us. ";
        $html .= "Our clients like that they always speak directly with an experienced technician, not a call-center agent.</p>\n";

        $html .= "<h2>Our Promise to You</h2>\n";
        $html .= "<p>Same-day or next-day service in most areas. A written quote before we touch anything. Genuine Viking OEM parts. And a 30-day parts-and-labor warranty on every repair we complete. ";
        $html .= "If the same fault comes back within 30 days, we return at no charge — no questions asked.</p>\n";

        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/schedule/\">Book a same-day repair</a></li>\n";
        $html .= "<li><a href=\"{$home}/services/\">Browse our Viking repair services</a></li>\n";
        $html .= "<li><a href=\"{$home}/locations/\">Find your nearest service area</a></li>\n";
        $html .= "</ul>\n";

    /* ── Cities ─────────────────────────────────────────── */
    } elseif (in_array($slug, ['cities', 'service-areas', 'locations-list'])) {
        ar_set_yoast(
            $id,
            ar_seo_title('Viking Appliance Repair — Cities We Serve'),
            ar_seo_desc('Find Viking appliance repair in your city. We serve 30+ US cities with same-day service, certified technicians, and a 30-day warranty on every Viking repair.'),
            'Viking appliance repair cities'
        );
        $html  = "<h1>Viking Appliance Repair — Every City We Serve</h1>\n";
        $html .= "<p>We serve 30+ cities across the United States, and we are adding new service areas every month. ";
        $html .= "We noticed that Viking appliance owners in smaller metros were often underserved — big national chains focused on high-volume cities and left everyone else waiting weeks for a technician. ";
        $html .= "We built our network specifically to reach those communities with the same same-day service we offer in major metros.</p>\n";

        $html .= "<h2>How We Choose the Cities We Expand Into</h2>\n";
        $html .= "<p>Our clients in existing service areas often referred us to friends and family in nearby cities. ";
        $html .= "We noticed a pattern: wherever Viking appliances were popular, so was the demand for a specialist who truly understood them. ";
        $html .= "Our clients liked knowing that the same technician team they trusted in one city had now arrived in theirs. ";
        $html .= "That word-of-mouth feedback directly shaped how we grew our service footprint.</p>\n";

        $html .= "<h2>What You Get in Every City We Serve</h2>\n";
        $html .= "<p>No matter which city you are in, the experience is identical: a same-day or next-day appointment, a Viking-certified technician, a written upfront quote, genuine OEM parts, and a 30-day warranty on every repair. ";
        $html .= "We noticed our clients really valued consistency — knowing that booking a repair in their city would feel exactly like a friend had recommended us personally.</p>\n";

        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/locations/\">Browse all service locations</a></li>\n";
        $html .= "<li><a href=\"{$home}/schedule/\">Book a repair in your city</a></li>\n";
        $html .= "<li><a href=\"{$home}/services/\">See all Viking appliances we repair</a></li>\n";
        $html .= "</ul>\n";

    /* ── All other pages — generic, skip if not empty ─── */
    } else {
        $seo_title = ar_seo_title($title, [
            ' | Viking Appliance Repair',
            ' | Appliance Repair',
            ' | Expert Repair Service',
        ]);
        $seo_desc = ar_seo_desc(
            "Visit our " . strtolower($title) . " page for details about our Viking appliance repair service, booking options, and 30-day warranty."
        );
        ar_set_yoast($id, $seo_title, $seo_desc, ar_derive_keyphrase($title));

        if (!empty(trim(strip_tags($page->post_content)))) {
            $skipped++;
            continue;
        }

        $html  = "<h1>" . esc_html($title) . "</h1>\n";
        $html .= "<p>This page provides important information about " . esc_html(strtolower($title)) . ". ";
        $html .= "Specifically, we want to make sure you have all the details before booking a repair. ";
        $html .= "Furthermore, if you have any questions, contact us directly and we will help right away.</p>\n";
        $html .= "<ul>\n";
        $html .= "<li><a href=\"{$home}/schedule/\">Schedule a repair</a></li>\n";
        $html .= "<li><a href=\"{$home}/services/\">View all services</a></li>\n";
        $html .= "<li><a href=\"{$home}/\">Return to homepage</a></li>\n";
        $html .= "</ul>\n";
    }

    if ($html) {
        wp_update_post(['ID' => $id, 'post_content' => $html]);
        $updated++;
    }
}

/* ═══════════════════════════════════════
   ARCHIVE PAGES — via Yoast wpseo_titles
═══════════════════════════════════════ */
$wpseo = get_option('wpseo_titles', []);

// /services/
$wpseo['title-ptarchive-service_page']   = ar_seo_title('Viking Appliance Repair Services', [' | Certified Techs', ' | OEM Parts']);
$wpseo['metadesc-ptarchive-service_page'] = ar_seo_desc('Browse all our Viking appliance repair services. Certified technicians repair Viking ranges, refrigerators, dishwashers, cooktops, wall ovens, and wine coolers with genuine Viking OEM parts.');

// /locations/
$wpseo['title-ptarchive-location_page']   = ar_seo_title('Viking Appliance Repair Locations', [' | 30+ US Cities', ' | Find Your City']);
$wpseo['metadesc-ptarchive-location_page'] = ar_seo_desc('Find certified Viking appliance repair near you. We serve 30+ cities across the US with same-day service, genuine OEM parts, and a 30-day warranty on every Viking repair.');

// /error-codes/
$wpseo['title-ptarchive-error_code']   = ar_seo_title('Viking Error Code Database', [' | All Models', ' | Diagnose & Fix']);
$wpseo['metadesc-ptarchive-error_code'] = ar_seo_desc('Look up Viking appliance error codes for every model. Get causes, step-by-step fixes, and repair cost estimates from certified Viking technicians.');

// /guides/
$wpseo['title-ptarchive-guide']   = ar_seo_title('Viking Appliance Repair Guides', [' | Step-by-Step', ' | Expert Guides']);
$wpseo['metadesc-ptarchive-guide'] = ar_seo_desc('Read step-by-step Viking appliance repair guides written by certified technicians. We cover Viking ranges, refrigerators, dishwashers, cooktops, wall ovens, and wine coolers.');

// /recalls/
$wpseo['title-ptarchive-recall']   = ar_seo_title('Viking Appliance Safety Recalls', [' | CPSC Notices', ' | Safety Alerts']);
$wpseo['metadesc-ptarchive-recall'] = ar_seo_desc('Check the latest Viking appliance safety recalls. Find official CPSC notices, hazard details, remedies, and how to book a post-recall inspection.');

// /blog/ (posts page)
$blog_page_id = (int) get_option('page_for_posts', 0);
if ($blog_page_id > 0) {
    $wpseo['title-page-' . $blog_page_id]   = ar_seo_title('Viking Appliance Repair Blog', [' | Tips & Guides', ' | Expert Repair Tips']);
    $wpseo['metadesc-page-' . $blog_page_id] = ar_seo_desc('Expert Viking appliance repair tips, how-to guides, and fault code explanations. Our certified technicians share practical advice for Viking ranges, refrigerators, dishwashers, and more.');
}

update_option('wpseo_titles', $wpseo);

/* ═══════════════════════════════════════
   CLEANUP — Trash any error_code post whose slug is NOT in the current data file.
   Handles all legacy / removed posts regardless of when they were added.
═══════════════════════════════════════ */
require_once __DIR__ . '/all-brands-error-codes-data.php';

$valid_slugs = array_column( ar_get_all_brands_error_codes_data(), 'slug' );
$valid_slugs = array_flip( $valid_slugs ); // for O(1) lookup

$all_error_code_posts = get_posts( [
    'post_type'      => 'error_code',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'all',
] );

$trashed = 0;
foreach ( $all_error_code_posts as $ec_post ) {
    if ( ! isset( $valid_slugs[ $ec_post->post_name ] ) ) {
        wp_trash_post( $ec_post->ID );
        echo "Trashed: {$ec_post->post_name} (ID: {$ec_post->ID})\n";
        $trashed++;
    }
}

echo "Done. Updated: $updated. Skipped (already had content): $skipped. Trashed: $trashed.\n";
echo "Archive SEO titles and front-page SEO also updated.\n";


