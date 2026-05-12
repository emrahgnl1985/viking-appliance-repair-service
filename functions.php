<?php
/**
 * Viking Appliance Repair Service — functions.php
 * Theme setup, CPTs, taxonomies, enqueue, helpers, AJAX
 * @version 1.0.0
 */
defined('ABSPATH') || exit;

define('AR_VERSION', '1.5.7');
define('AR_DIR', get_template_directory());
define('AR_URI', get_template_directory_uri());

/* ── Theme Setup ── */
add_action('after_setup_theme', function() {
    load_theme_textdomain('appliancerepair', AR_DIR . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','script','style']);
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor.css');
    add_image_size('hero',  1600, 800, true);
    add_image_size('card',  640,  420, true);
    add_image_size('thumb', 400,  300, true);
    register_nav_menus([
        'primary'  => 'Primary Navigation',
        'footer-1' => 'Footer: Services',
        'footer-2' => 'Footer: Locations',
        'footer-3' => 'Footer: Company',
        'legal'    => 'Legal Pages',
    ]);
});

/* ── Register CPTs ── */
add_action('init', function() {
    $d = ['public'=>true,'show_in_rest'=>true,'has_archive'=>true,'supports'=>['title','editor','thumbnail','excerpt','custom-fields']];

    register_post_type('service_page', $d + ['labels'=>ar_cpt_labels('Service Page','Service Pages'),'menu_icon'=>'dashicons-admin-tools','menu_position'=>5,'rewrite'=>['slug'=>'services','with_front'=>false]]);
    register_post_type('location_page',$d + ['labels'=>ar_cpt_labels('Location','Locations'),'menu_icon'=>'dashicons-location','menu_position'=>6,'rewrite'=>['slug'=>'locations','with_front'=>false]]);
    register_post_type('error_code',   $d + ['labels'=>ar_cpt_labels('Error Code','Error Codes'),'menu_icon'=>'dashicons-warning','menu_position'=>7,'rewrite'=>['slug'=>'error-codes','with_front'=>false]]);
    register_post_type('guide',        $d + ['labels'=>ar_cpt_labels('Guide','Guides'),'menu_icon'=>'dashicons-book-alt','menu_position'=>8,'rewrite'=>['slug'=>'guides','with_front'=>false],'supports'=>['title','editor','thumbnail','excerpt','custom-fields','author']]);
    register_post_type('recall',       ['public'=>true,'show_in_rest'=>true,'has_archive'=>true,'supports'=>['title','editor','custom-fields'],'labels'=>ar_cpt_labels('Recall','Recalls'),'menu_icon'=>'dashicons-megaphone','menu_position'=>9,'rewrite'=>['slug'=>'recalls','with_front'=>false]]);
    register_post_type('appointment_lead',['labels'=>ar_cpt_labels('Appointment Lead','Appointment Leads'),'public'=>false,'show_ui'=>true,'show_in_menu'=>'ar-settings','supports'=>['title'],'menu_icon'=>'dashicons-email-alt']);
});

function ar_cpt_labels(string $s, string $p): array {
    return ['name'=>$p,'singular_name'=>$s,'add_new_item'=>"Add New $s",'edit_item'=>"Edit $s",'view_item'=>"View $s",'search_items'=>"Search $p",'not_found'=>"No $p found",'all_items'=>"All $p"];
}

/* ── Taxonomies ── */
add_action('init', function() {
    register_taxonomy('brand',['service_page','error_code','recall','guide'],['labels'=>['name'=>'Brands','singular_name'=>'Brand'],'public'=>true,'hierarchical'=>false,'show_in_rest'=>true,'show_admin_column'=>true,'rewrite'=>['slug'=>'brand']]);
    register_taxonomy('appliance_type',['service_page','error_code','guide'],['labels'=>['name'=>'Appliance Types','singular_name'=>'Appliance Type'],'public'=>true,'hierarchical'=>true,'show_in_rest'=>true,'show_admin_column'=>true,'rewrite'=>['slug'=>'appliance']]);
    register_taxonomy('city',['location_page'],['labels'=>['name'=>'Cities','singular_name'=>'City'],'public'=>true,'hierarchical'=>true,'show_in_rest'=>true,'show_admin_column'=>true,'rewrite'=>['slug'=>'city']]);
    register_taxonomy('blog_category',['post'],['labels'=>['name'=>'Blog Categories','singular_name'=>'Blog Category'],'public'=>true,'hierarchical'=>true,'show_in_rest'=>true,'rewrite'=>['slug'=>'blog/category']]);
});

/* ── Rewrite Rules ── */
add_action('init', function() {
    add_rewrite_rule('^error-codes/([^/]+)/([^/]+)/?$','index.php?post_type=error_code&name=$matches[2]','top');
    add_rewrite_rule('^locations/([^/]+)/([^/]+)/?$','index.php?post_type=location_page&name=$matches[2]','top');
});

/* ── Enqueue ── */
add_action('wp_enqueue_scripts', function() {
    // Viking Heritage Estate typography — Playfair Display (serif display) + Inter (body) — loaded globally
    wp_enqueue_style('ar-fonts','https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,600;1,700&family=Inter:wght@400;500;600;700&display=swap',[],null);
    wp_enqueue_style('ar-variables', AR_URI.'/assets/css/variables.css', [], AR_VERSION);
    wp_enqueue_style('ar-base',      AR_URI.'/assets/css/base.css',      ['ar-variables'], AR_VERSION);
    wp_enqueue_style('ar-components',AR_URI.'/assets/css/components.css',['ar-base'], AR_VERSION);
    wp_enqueue_style('ar-templates',   AR_URI.'/assets/css/templates.css',            ['ar-components'], AR_VERSION);
    wp_enqueue_style('ar-additions',   AR_URI.'/assets/css/components-additions.css', ['ar-templates'],  AR_VERSION);
    wp_enqueue_script('ar-main', AR_URI.'/assets/js/main.js', [], AR_VERSION, true);
    wp_localize_script('ar-main','arAjax',['url'=>admin_url('admin-ajax.php'),'nonce'=>wp_create_nonce('ar_form_nonce'),'phone'=>ar_get_phone()]);
});


/* ── Performance ── */
add_action('wp_head',function(){echo '<link rel="preconnect" href="https://fonts.googleapis.com">'."\n".'<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'."\n";},1);
remove_action('wp_head','wp_generator');
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','rsd_link');
remove_action('wp_head','print_emoji_detection_script',7);
remove_action('wp_print_styles','print_emoji_styles');
add_filter('xmlrpc_enabled','__return_false');

/* ── Robots.txt ── */
add_filter('robots_txt',function(string $output,bool $public):string{
    if(!$public)return $output;
    return "User-agent: *\n"
         ."Disallow: /wp-admin/\n"
         ."Disallow: /wp-includes/\n"
         ."Disallow: /?s=\n"
         ."Disallow: /?p=\n"
         ."Disallow: /feed/\n"
         ."Disallow: /trackback/\n"
         ."Disallow: /xmlrpc.php\n"
         ."Disallow: /wp-login.php\n"
         ."Allow: /wp-admin/admin-ajax.php\n\n"
         ."Sitemap: ".home_url('/sitemap_index.xml')."\n";
},10,2);

/* ── Permanent Redirects for removed/renamed pages ── */
add_action('template_redirect', function() {
    $redirects = [
        '/services/viking-oven-repair/'      => '/services/viking-range-repair/',
        '/services/viking-washer-repair/'    => '/services/viking-range-repair/',
        '/services/viking-dryer-repair/'     => '/services/viking-range-repair/',
        '/services/viking-microwave-repair/' => '/services/viking-wine-cooler-repair/',
    ];
    $path = wp_parse_url( add_query_arg([]), PHP_URL_PATH );
    if ( isset( $redirects[ $path ] ) ) {
        wp_redirect( home_url( $redirects[ $path ] ), 301 );
        exit;
    }
});

/* ── Template Loading ── */
add_filter('template_include', function($t) {
    // Archives
    $archive_map = ['service_page'=>'archive-service.php','location_page'=>'archive-location.php','error_code'=>'archive-error-code.php','guide'=>'archive-guide.php','recall'=>'archive-recall.php'];
    foreach($archive_map as $pt=>$file) {
        if(is_post_type_archive($pt)){$c=AR_DIR.'/templates/'.$file;if(file_exists($c))return $c;}
    }
    // Singles — CPTs
    $single_map = ['service_page'=>'template-service.php','location_page'=>'template-location.php','error_code'=>'template-error-code.php','guide'=>'template-guide.php','recall'=>'template-recall.php'];
    $pt = get_post_type();
    if(isset($single_map[$pt])){$c=AR_DIR.'/templates/'.$single_map[$pt];if(file_exists($c))return $c;}
    // Legal pages (standard WP pages by slug)
    $legal_slugs = ['privacy-policy','terms-of-use','mobile-terms-of-use'];
    if(is_page() && in_array(get_post_field('post_name',get_queried_object_id()),$legal_slugs,true)){
        $c=AR_DIR.'/templates/template-legal.php';if(file_exists($c))return $c;
    }
    if(is_page('schedule')){
        $c = AR_DIR . '/page-schedule.php';
        if(file_exists($c)) return $c;
    }
    return $t;
});

/* ── Disable Gutenberg for CPTs ── */
add_filter('use_block_editor_for_post_type',function($u,$pt){return in_array($pt,['service_page','location_page','error_code','recall','appointment_lead'],true)?false:$u;},10,2);

/* ── Settings Page ── */
add_action('admin_menu',function(){add_menu_page('AR Theme Settings','AR Settings','manage_options','ar-settings','ar_render_options_page','dashicons-admin-settings',60);});
function ar_render_options_page():void {
    if(!current_user_can('manage_options'))return;
    if(isset($_POST['ar_save'])&&check_admin_referer('ar_nonce')){foreach(['ar_phone_number','ar_business_name','ar_address','ar_email','ar_license_number'] as $f)update_option($f,sanitize_text_field($_POST[$f]??''));echo '<div class="notice notice-success"><p>Saved.</p></div>';}
    $p=get_option('ar_phone_number','');$n=get_option('ar_business_name','');$a=get_option('ar_address','');$e=get_option('ar_email','');$l=get_option('ar_license_number','');
    echo '<div class="wrap"><h1>Viking Appliance Repair Settings</h1><form method="post">';wp_nonce_field('ar_nonce');
    echo '<table class="form-table"><tr><th>Business Name</th><td><input name="ar_business_name" value="'.esc_attr($n).'" class="regular-text"></td></tr>';
    echo '<tr><th>Phone Number</th><td><input name="ar_phone_number" value="'.esc_attr($p).'" class="regular-text" placeholder="844-719-4467"></td></tr>';
    echo '<tr><th>Address</th><td><input name="ar_address" value="'.esc_attr($a).'" class="regular-text"></td></tr>';
    echo '<tr><th>Email</th><td><input name="ar_email" type="email" value="'.esc_attr($e).'" class="regular-text"></td></tr>';
    echo '<tr><th>License #</th><td><input name="ar_license_number" value="'.esc_attr($l).'" class="regular-text"></td></tr></table>';
    submit_button('Save Settings','primary','ar_save');echo '</form></div>';
}

/* ── AJAX Form Handler ── */
function ar_handle_form():void {
    if(!check_ajax_referer('ar_form_nonce','nonce',false))wp_send_json_error(['message'=>'Security check failed.'],403);
    foreach(['name','phone','email','zip','brand','appliance'] as $f){if(empty($_POST[$f]))wp_send_json_error(['message'=>'Please fill in all required fields.']);}
    $name=sanitize_text_field($_POST['name']);$phone=sanitize_text_field($_POST['phone']);$email=sanitize_email($_POST['email']);
    $zip=sanitize_text_field($_POST['zip']);$brand=sanitize_text_field($_POST['brand']);$appliance=sanitize_text_field($_POST['appliance']);
    $issue=sanitize_textarea_field($_POST['issue']??'');$source=sanitize_text_field($_POST['source_page']??'');
    if(!is_email($email))wp_send_json_error(['message'=>'Please enter a valid email address.']);
    $id=wp_insert_post(['post_type'=>'appointment_lead','post_title'=>"$name — $brand $appliance — ".current_time('mysql'),'post_status'=>'private','meta_input'=>['_lead_name'=>$name,'_lead_phone'=>$phone,'_lead_email'=>$email,'_lead_zip'=>$zip,'_lead_brand'=>$brand,'_lead_appliance'=>$appliance,'_lead_issue'=>$issue,'_lead_source'=>$source,'_lead_date'=>current_time('mysql')]]);
    wp_mail(get_option('ar_email',get_option('admin_email')),"New Repair Request: $name — $brand $appliance","Name: $name\nPhone: $phone\nEmail: $email\nZIP: $zip\nBrand: $brand\nAppliance: $appliance\nIssue: $issue\nSource: $source\n\nAdmin: ".admin_url("post.php?post=$id&action=edit"));
    wp_send_json_success(['message'=>'Thank you! We will call you within 60 minutes to confirm your appointment.']);
}
add_action('wp_ajax_ar_appointment','ar_handle_form');
add_action('wp_ajax_nopriv_ar_appointment','ar_handle_form');

/* ── Helpers ── */
function ar_get_phone():string{return get_option('ar_phone_number','844-719-4467');}
function ar_phone_link():string{return 'tel:'.preg_replace('/[^0-9+]/','',ar_get_phone());}
function ar_get_business_name():string{return get_option('ar_business_name','We');}
function ar_meta(int $id,string $key,string $fallback=''):string{return get_post_meta($id,$key,true)?:$fallback;}
function ar_disclaimer(string $brand=''):void{
    $brand  = $brand ?: 'the manufacturer';
    $biz    = ar_get_business_name();
    // Pick a variation based on the current post ID for consistency (not random on each load)
    $seed   = abs(crc32(get_the_ID() . $brand)) % 4;
    $variations = [
        /* 0 */ '<strong>Independent Service Notice:</strong> ' . esc_html($biz) . ' are an independent appliance repair company. We are not affiliated with, authorized by, or endorsed by ' . esc_html($brand) . '. All brand names, trademarks, and model numbers are the property of their respective manufacturers and are used solely for identification purposes.',
        /* 1 */ '<strong>Disclaimer:</strong> ' . esc_html($biz) . ' provide independent repair services and is not an authorized service agent of ' . esc_html($brand) . ' or any appliance manufacturer. Our technicians are independently trained and certified. Brand names and logos are trademarks of their respective owners.',
        /* 2 */ '<strong>Not Affiliated with ' . esc_html($brand) . ':</strong> ' . esc_html($biz) . ' are a fully independent appliance repair provider. We specialize in ' . esc_html($brand) . ' appliance repairs but have no affiliation with, sponsorship from, or endorsement by ' . esc_html($brand) . '. Use of manufacturer names is for descriptive purposes only.',
        /* 3 */ '<strong>Independent Service Provider:</strong> The repair services offered by ' . esc_html($biz) . ' are independent of any appliance manufacturer, including ' . esc_html($brand) . '. We source quality replacement parts and provide our own 30-day labor warranty. Brand names referenced on this page are trademarks of their respective owners and are used here only to identify the appliances we service.',
    ];
    echo '<aside class="disclaimer disclaimer--prominent" role="note" aria-label="Independent service disclaimer">' . $variations[$seed] . '</aside>';
}
function ar_stars(int $n=5):string{$s='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';return str_repeat($s,max(0,min(5,$n)));}
function ar_trust_bar():void{get_template_part('parts/trust-bar');}
function ar_appointment_form(string $context='',string $heading=''):void{get_template_part('parts/appointment-form',null,['context'=>$context,'heading'=>$heading]);}
function ar_faq_section(array $faqs,string $heading='Frequently Asked Questions'):void{get_template_part('parts/faq-accordion',null,['faqs'=>$faqs,'heading'=>$heading]);}
function ar_output_schema(array $schema):void{echo "\n<script type=\"application/ld+json\">\n".wp_json_encode($schema,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)."\n</script>\n";}

/* ── Yoast SEO: feed ACF meta content for analysis ── */
add_filter('wpseo_pre_analysis_post_content', function(string $content, $post): string {
    if (!empty(trim(strip_tags($content)))) return $content;
    $id = $post->ID ?? 0;
    $pt = $post->post_type ?? '';
    $parts = [];
    if ($pt === 'service_page') {
        $parts[] = get_post_meta($id, '_ar_intro',        true);
        $parts[] = get_post_meta($id, '_ar_why_us',       true);
        $causes = get_post_meta($id, '_ar_services_list', true);
        if (is_array($causes)) foreach ($causes as $c) $parts[] = ($c['title'] ?? '') . ' ' . ($c['description'] ?? '');
        $faqs = get_post_meta($id, '_ar_faqs', true);
        if (is_array($faqs)) foreach ($faqs as $f) $parts[] = ($f['question'] ?? '') . ' ' . ($f['answer'] ?? '');
    } elseif ($pt === 'error_code') {
        $parts[] = get_post_meta($id, '_ar_code_meaning', true);
        $causes = get_post_meta($id, '_ar_causes',    true);
        if (is_array($causes)) foreach ($causes as $c) $parts[] = ($c['title'] ?? '') . ' ' . ($c['description'] ?? '');
        $steps = get_post_meta($id, '_ar_diy_steps',  true);
        if (is_array($steps)) foreach ($steps as $s) $parts[] = ($s['step'] ?? '') . ' ' . ($s['description'] ?? '');
        $faqs = get_post_meta($id, '_ar_faqs', true);
        if (is_array($faqs)) foreach ($faqs as $f) $parts[] = ($f['question'] ?? '') . ' ' . ($f['answer'] ?? '');
    } elseif ($pt === 'location_page') {
        $parts[] = get_post_meta($id, '_ar_body_intro',    true);
        $parts[] = get_post_meta($id, '_ar_neighborhoods', true);
        $faqs = get_post_meta($id, '_ar_faqs', true);
        if (is_array($faqs)) foreach ($faqs as $f) $parts[] = ($f['question'] ?? '') . ' ' . ($f['answer'] ?? '');
    } elseif ($pt === 'guide') {
        $parts[] = get_post_meta($id, '_ar_intro', true);
        $steps = get_post_meta($id, '_ar_steps', true);
        if (is_array($steps)) foreach ($steps as $s) $parts[] = ($s['title'] ?? '') . ' ' . ($s['content'] ?? '');
        $faqs = get_post_meta($id, '_ar_faqs', true);
        if (is_array($faqs)) foreach ($faqs as $f) $parts[] = ($f['question'] ?? '') . ' ' . ($f['answer'] ?? '');
    } elseif ($pt === 'recall') {
        $parts[] = get_post_meta($id, '_ar_summary',   true);
        $parts[] = get_post_meta($id, '_ar_hazard',    true);
        $parts[] = get_post_meta($id, '_ar_remedy',    true);
    }
    $built = trim(implode(' ', array_filter($parts)));
    return $built ?: $content;
}, 10, 2);

/* ── Yoast SEO: archive-page titles & descriptions ── */
add_filter('wpseo_title', function(string $title): string {
    $map = [
        'service_page'  => 'Viking Appliance Repair Services | Certified Specialists',
        'location_page' => 'Viking Appliance Repair Locations | Major US Cities',
        'error_code'    => 'Viking Appliance Fault Code Database | All Models',
        'guide'         => 'Viking Appliance Repair Guides | Step-by-Step',
        'recall'        => 'Viking Appliance Safety Recalls | CPSC Notices',
    ];
    if (is_post_type_archive()) {
        $pt = get_queried_object()->name ?? '';
        if (isset($map[$pt])) return $map[$pt];
    }
    return $title;
});

add_filter('wpseo_metadesc', function(string $desc): string {
    $map = [
        'service_page'  => 'Browse all Viking appliance repair services. Certified Viking specialists repair ranges, refrigerators, dishwashers, cooktops, and wall ovens with genuine OEM parts and a 30-day warranty.',
        'location_page' => 'Find certified Viking appliance repair near you. We serve major US cities with same-day service, genuine Viking OEM parts, and a 30-day warranty on every repair.',
        'error_code'    => 'Look up Viking appliance fault codes. Get verified causes, step-by-step guidance, and expert repair estimates from our certified Viking technicians.',
        'guide'         => 'Step-by-step Viking appliance repair guides written by certified technicians. Covers Viking ranges, refrigerators, dishwashers, cooktops, and wall ovens.',
        'recall'        => 'Check the latest Viking appliance safety recalls. Find CPSC notices, hazard details, remedies, and how to book a post-recall inspection.',
    ];
    if (is_post_type_archive()) {
        $pt = get_queried_object()->name ?? '';
        if (isset($map[$pt])) return $map[$pt];
    }
    return $desc;
});

/* ── SEO Meta (fires when no SEO plugin detected) ── */
add_action('wp_head','ar_output_seo_meta',1);
function ar_output_seo_meta():void{
    if(defined('WPSEO_VERSION')||defined('RANK_MATH_VERSION'))return;
    global $post;
    if(!is_singular()&&!is_post_type_archive()&&!is_tax()&&!is_home())return;
    $id=$post->ID??0;$pt=get_post_type();$title='';$desc='';$img='';
    // Singular CPTs
    if(is_singular()){
        if($pt==='service_page'){$b=ar_meta($id,'_ar_brand','');$a=ar_meta($id,'_ar_appliance_type','');$title="$b $a Repair | Certified Technicians &amp; 30-Day Warranty";$desc="Expert $b $a repair. Factory-certified parts, 30-day warranty, same-day service.";}
        elseif($pt==='location_page'){$c=ar_meta($id,'_ar_city','');$s=ar_meta($id,'_ar_state','');$title="Viking Appliance Repair in $c, $s | Same-Day Service | Certified Specialists";$desc="Top-rated Viking appliance repair in $c. Viking-certified technicians, genuine OEM parts, 30-day warranty.";}
        elseif($pt==='error_code'){$b=ar_meta($id,'_ar_brand','');$c=ar_meta($id,'_ar_error_code','');$a=ar_meta($id,'_ar_appliance_type','');$title="$b $c Error Code — $a Fault: Causes, Fixes &amp; When to Call";$desc="$b $a showing $c error? Causes, step-by-step fixes, and when to call a technician.";}
        elseif($pt==='guide'){$title=get_the_title().' | Repair Guide';$desc=get_the_excerpt()?:'';}
        elseif($pt==='recall'){$b=ar_meta($id,'_ar_brand','');$title=get_the_title().' | '.$b.' Safety Recall';$desc=get_the_excerpt()?:'';}
        elseif($pt==='post'){$title=get_the_title().' | '.get_bloginfo('name');$desc=get_the_excerpt()?:'';}
        elseif(is_page()){$title=get_the_title().' | '.get_bloginfo('name');$desc=get_the_excerpt()?:'';}
        $img=get_post_meta($id,'_post_image_url',true)?:( has_post_thumbnail($id)?get_the_post_thumbnail_url($id,'large'):'' );
    }
    if(!$title)return;
    $site=get_bloginfo('name');
    // Title
    printf('<title>%s</title>'."\n",esc_html($title));
    // Meta description
    if($desc)printf('<meta name="description" content="%s">'."\n",esc_attr(wp_trim_words($desc,30)));
    // Canonical
    printf('<link rel="canonical" href="%s">'."\n",esc_url(get_permalink()));
    // Open Graph
    printf('<meta property="og:type" content="%s">'."\n", $pt==='post'?'article':'website');
    printf('<meta property="og:title" content="%s">'."\n",esc_attr($title));
    if($desc)printf('<meta property="og:description" content="%s">'."\n",esc_attr(wp_trim_words($desc,30)));
    printf('<meta property="og:url" content="%s">'."\n",esc_url(get_permalink()));
    printf('<meta property="og:site_name" content="%s">'."\n",esc_attr($site));
    if($img)printf('<meta property="og:image" content="%s">'."\n",esc_url($img));
    // Twitter Card
    printf('<meta name="twitter:card" content="%s">'."\n",$img?'summary_large_image':'summary');
    printf('<meta name="twitter:title" content="%s">'."\n",esc_attr($title));
    if($desc)printf('<meta name="twitter:description" content="%s">'."\n",esc_attr(wp_trim_words($desc,30)));
    if($img)printf('<meta name="twitter:image" content="%s">'."\n",esc_url($img));
}

/* ── Sticky Call Button ── */
function ar_sticky_call_button(): void {
    $phone     = ar_get_phone();
    $phone_link = ar_phone_link();
    echo '<a href="' . esc_url($phone_link) . '" class="sticky-call" aria-label="Call us: ' . esc_attr($phone) . '">';
    echo '<span class="sticky-call__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg></span>';
    echo '<span class="sticky-call__text">' . esc_html($phone) . '</span>';
    echo '</a>';
}

/* ── Related Services Query ── */
function ar_get_related_services(string $brand, int $limit = 6, int $exclude_id = 0): array {
    $brand_term = get_term_by('name', $brand, 'brand');
    if (!$brand_term) return [];
    $args = [
        'post_type'      => 'service_page',
        'posts_per_page' => $limit,
        'post__not_in'   => $exclude_id ? [$exclude_id] : [],
        'tax_query'      => [['taxonomy' => 'brand', 'terms' => $brand_term->term_id]],
    ];
    return get_posts($args);
}

/* ── Related Error Codes Query ── */
function ar_get_related_error_codes(string $brand, string $appliance, int $limit = 6, int $exclude_id = 0): array {
    $tax_query = [];
    $brand_term = get_term_by('name', $brand, 'brand');
    if ($brand_term) $tax_query[] = ['taxonomy' => 'brand', 'terms' => $brand_term->term_id];
    $appliance_term = get_term_by('name', $appliance, 'appliance_type');
    if ($appliance_term) $tax_query[] = ['taxonomy' => 'appliance_type', 'terms' => $appliance_term->term_id];
    if (empty($tax_query)) return [];
    return get_posts([
        'post_type'      => 'error_code',
        'posts_per_page' => $limit,
        'post__not_in'   => $exclude_id ? [$exclude_id] : [],
        'tax_query'      => $tax_query,
    ]);
}

/* ── Related Links Output ── */
function ar_related_links(array $posts, string $heading = 'Related Pages'): void {
    if (empty($posts)) return;
    echo '<section class="section section--bg-light">';
    echo '<div class="container">';
    echo '<h2 style="margin-bottom:var(--space-6);font-size:var(--text-2xl);">' . esc_html($heading) . '</h2>';
    echo '<div class="related-links__grid">';
    foreach ($posts as $p):
        $pid = is_object($p) ? $p->ID : $p;
    ?>
    <a href="<?php echo esc_url(get_permalink($pid)); ?>" class="related-link">
        <span class="related-link__icon" aria-hidden="true">→</span>
        <?php echo esc_html(get_the_title($pid)); ?>
    </a>
    <?php endforeach;
    echo '</div></div></section>';
}

/* ── Misc ── */
add_filter('excerpt_length',fn()=>25);
add_filter('excerpt_more',fn()=>'…');
add_action('after_switch_theme',fn()=>flush_rewrite_rules());
add_filter('login_errors',fn()=>'Invalid credentials.');
