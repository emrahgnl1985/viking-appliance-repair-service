<?php
/**
 * Template: Location / City Page — OBSIDIAN Design System
 *
 * ACF Fields:
 *   _ar_city, _ar_state, _ar_state_full, _ar_zip_codes,
 *   _ar_neighborhoods, _ar_suburbs, _ar_hero_subtitle,
 *   _ar_body_intro, _ar_faqs
 */
if ( ! defined('ABSPATH') ) exit;

$post_id    = get_the_ID();
$city       = get_post_meta($post_id, '_ar_city',         true) ?: get_the_title();
$state      = get_post_meta($post_id, '_ar_state',        true) ?: 'US';
$state_full = get_post_meta($post_id, '_ar_state_full',   true) ?: $state;
$zip_raw    = get_post_meta($post_id, '_ar_zip_codes',    true) ?: '';
$zips       = array_filter(array_map('trim', explode(',', $zip_raw)));
$subtitle   = get_post_meta($post_id, '_ar_hero_subtitle',true) ?: "Serving {$city} and the surrounding area — Viking-certified technicians, genuine OEM parts, 30-day warranty on every repair.";
$intro      = get_post_meta($post_id, '_ar_body_intro',   true);
$faqs       = get_post_meta($post_id, '_ar_faqs',         true);
$phone      = ar_get_phone();
$phone_raw  = ar_phone_link();
$biz        = ar_get_business_name();

$city_data = [
    'Chicago' => [
        'intro' => 'We serve all 77 Chicago neighborhoods and the greater metro area — from the North Shore suburbs to the South Side, the Near West Side to the Lakefront. Chicago\'s cold winters and humid summers place extra demands on Viking appliances, particularly refrigerators and dishwashers. Our Chicago-based technicians are available same-day and next-day throughout the city and surrounding Cook, DuPage, and Lake counties.',
        'neighborhoods' => [
            'Lincoln Park (60614)', 'Wicker Park (60622)', 'Logan Square (60647)',
            'Hyde Park (60615)',    'Lakeview (60613)',    'Pilsen (60608)',
            'River North (60654)', 'Gold Coast (60610)',   'Bucktown (60647)',
            'Andersonville (60640)','Ravenswood (60625)',  'Roscoe Village (60618)',
            'Ukrainian Village (60622)', 'Noble Square (60642)', 'Old Town (60610)',
            'Streeterville (60611)', 'South Loop (60605)',  'Bridgeport (60609)',
            'Beverly (60655)',       'Edgewater (60660)',  'Rogers Park (60626)',
            'Uptown (60640)',        'Irving Park (60618)', 'Portage Park (60634)',
            'Jefferson Park (60630)','Norwood Park (60631)','Edison Park (60631)',
        ],
        'suburbs' => [
            // North Shore
            'Evanston (60201)',    'Wilmette (60091)',   'Winnetka (60093)',
            'Glencoe (60022)',     'Highland Park (60035)', 'Lake Forest (60045)',
            // West
            'Oak Park (60301)',    'Elmhurst (60126)',   'Wheaton (60187)',
            'Naperville (60540)',  'Downers Grove (60515)', 'Lisle (60532)',
            'Glen Ellyn (60137)',  'Lombard (60148)',    'Villa Park (60181)',
            // Northwest
            'Arlington Heights (60004)', 'Schaumburg (60173)', 'Palatine (60067)',
            'Des Plaines (60016)',  'Niles (60714)',      'Skokie (60076)',
            // South
            'Tinley Park (60477)', 'Orland Park (60462)', 'Homer Glen (60491)',
            'Frankfort (60423)',   'Mokena (60448)',      'New Lenox (60451)',
        ],
    ],
    'San Francisco' => [
        'intro' => 'We serve San Francisco and the entire Bay Area — from Pacific Heights Victorians to SoMa lofts, and from the Peninsula to the East Bay and South Bay. San Francisco\'s coastal salt air accelerates corrosion on dishwasher racks, refrigerator hinges, and range burners faster than inland cities. Our Bay Area technicians understand these regional challenges and carry the right Viking OEM parts for same-day and next-day service across three counties.',
        'neighborhoods' => [
            'Mission District (94110)', 'Castro (94114)',        'Pacific Heights (94115)',
            'SoMa (94103)',            'Nob Hill (94108)',       'Richmond (94118)',
            'Sunset (94122)',          'Marina (94123)',         'Haight-Ashbury (94117)',
            'Hayes Valley (94102)',    'Potrero Hill (94107)',   'Bernal Heights (94110)',
            'Noe Valley (94114)',      'Dogpatch (94107)',       'Inner Sunset (94122)',
            'Cole Valley (94117)',     'Glen Park (94131)',      'Russian Hill (94109)',
            'North Beach (94133)',     'Chinatown (94108)',      'Financial District (94104)',
        ],
        'suburbs' => [
            // Peninsula
            'Daly City (94014)',     'San Mateo (94401)',     'Burlingame (94010)',
            'Redwood City (94061)', 'Menlo Park (94025)',    'Palo Alto (94301)',
            'Mountain View (94040)','Sunnyvale (94086)',     'Santa Clara (95050)',
            // East Bay
            'Oakland (94601)',      'Berkeley (94710)',       'Emeryville (94608)',
            'Alameda (94501)',      'Fremont (94536)',        'San Leandro (94577)',
            // South Bay
            'San Jose (95101)',     'Campbell (95008)',       'Los Gatos (95030)',
            'Saratoga (95070)',     'Cupertino (95014)',      'Milpitas (95035)',
        ],
    ],
    'Houston' => [
        'intro' => 'We serve Houston and the greater Harris County metro — covering the Inner Loop, the Energy Corridor, and all major suburban corridors. Houston\'s extreme heat and humidity place extraordinary stress on Viking refrigerators and dishwashers year-round, and flooding events can damage appliance electronics and control boards. Our Houston technicians are experienced in diagnosing both heat-related and moisture-related Viking appliance failures, with same-day service available across Harris, Fort Bend, and Montgomery counties.',
        'neighborhoods' => [
            'Midtown (77006)',          'Montrose (77006)',       'The Heights (77008)',
            'River Oaks (77019)',       'Museum District (77004)', 'Galleria/Uptown (77056)',
            'Greenway Plaza (77027)',   'Memorial (77024)',        'West University Place (77005)',
            'Bellaire (77401)',         'Meyerland (77096)',       'Tanglewood (77056)',
            'Oak Forest (77018)',       'Garden Oaks (77018)',     'Timbergrove (77008)',
            'EaDo (77003)',             'Midtown East (77002)',    'Medical Center (77030)',
            'Third Ward (77004)',       'Briargrove (77057)',      'Briarwood (77042)',
        ],
        'suburbs' => [
            // West
            'Katy (77449)',          'Cinco Ranch (77450)',    'Cypress (77433)',
            'Energy Corridor (77079)', 'Sugar Land (77478)',  'Missouri City (77459)',
            // North
            'The Woodlands (77380)', 'Spring (77373)',         'Tomball (77375)',
            'Conroe (77301)',         'Kingwood (77339)',       'Humble (77338)',
            // South
            'Pearland (77581)',       'League City (77573)',   'Friendswood (77546)',
            'Clear Lake (77058)',     'Webster (77598)',        'Manvel (77578)',
            // Southeast
            'Pasadena (77501)',       'Deer Park (77536)',      'La Porte (77571)',
        ],
    ],
    'Miami' => [
        'intro' => 'We serve Miami-Dade and Broward counties — from Brickell\'s luxury high-rises and Coconut Grove\'s historic estates to Fort Lauderdale and Boca Raton. Miami\'s year-round tropical heat and humidity stress Viking refrigerator compressors constantly, accelerate mold in dishwasher seals, and corrode electrical contacts faster than any other US market. Our South Florida technicians are specialists in humidity and heat-related Viking appliance failures, with priority same-day dispatch for urgent cooling issues.',
        'neighborhoods' => [
            'Brickell (33131)',         'Wynwood (33127)',         'Coconut Grove (33133)',
            'Little Havana (33135)',    'Midtown (33137)',          'Downtown (33132)',
            'Edgewater (33137)',        'Design District (33137)', 'Little Haiti (33127)',
            'Overtown (33136)',         'Allapattah (33142)',       'Coral Way (33145)',
            'South Beach (33139)',      'Mid-Beach (33140)',        'North Beach (33141)',
            'Bay Harbor Islands (33154)','Surfside (33154)',        'Bal Harbour (33154)',
            'Aventura (33180)',         'Hallandale Beach (33009)', 'North Miami (33161)',
        ],
        'suburbs' => [
            // Miami-Dade
            'Coral Gables (33146)',  'South Miami (33143)',    'Pinecrest (33156)',
            'Palmetto Bay (33157)',  'Homestead (33030)',      'Hialeah (33010)',
            'Doral (33166)',         'Sweetwater (33174)',     'Kendall (33183)',
            // Broward County
            'Hollywood (33020)',     'Pembroke Pines (33024)', 'Miramar (33025)',
            'Fort Lauderdale (33301)', 'Plantation (33317)',   'Sunrise (33351)',
            'Coral Springs (33065)', 'Pompano Beach (33060)',  'Boca Raton (33431)',
            'Delray Beach (33444)',  'Boynton Beach (33426)',
        ],
    ],
    'Los Angeles' => [
        'intro' => 'We serve all of Los Angeles County and surrounding areas — from Santa Monica and Malibu on the coast to Pasadena and the San Gabriel Valley, the San Fernando Valley to the South Bay. LA\'s hard water causes mineral buildup in Viking dishwashers and refrigerator water lines, and summer heat increases compressor workload. Our LA-based technicians cover all 88 cities in the county with same-day and next-day service across three counties.',
        'neighborhoods' => [
            'Silver Lake (90026)',      'Echo Park (90026)',        'Koreatown (90005)',
            'Mid-Wilshire (90036)',     'Venice (90291)',            'West Hollywood (90046)',
            'Culver City (90232)',      'Los Feliz (90027)',         'Atwater Village (90039)',
            'Highland Park (90042)',    'Eagle Rock (90041)',        'Brentwood (90049)',
            'Westwood (90024)',         'Bel-Air (90077)',           'Pacific Palisades (90272)',
            'Malibu (90265)',           'Hollywood (90028)',         'Studio City (91604)',
            'Sherman Oaks (91403)',     'Encino (91436)',            'Woodland Hills (91364)',
            'Mar Vista (90066)',        'Palms (90034)',             'Cheviot Hills (90034)',
        ],
        'suburbs' => [
            // Westside/Beach
            'Santa Monica (90401)',    'Beverly Hills (90210)',    'Hermosa Beach (90254)',
            'Manhattan Beach (90266)', 'Redondo Beach (90277)',    'El Segundo (90245)',
            // San Gabriel Valley
            'Pasadena (91101)',         'Arcadia (91006)',          'Monrovia (91016)',
            'San Marino (91108)',       'Alhambra (91801)',         'Temple City (91780)',
            // South Bay / Long Beach
            'Torrance (90501)',         'Long Beach (90801)',       'Hawthorne (90250)',
            'Gardena (90247)',          'Carson (90745)',           'Lakewood (90712)',
            // San Fernando Valley
            'Glendale (91201)',         'Burbank (91501)',          'North Hollywood (91601)',
            'Chatsworth (91311)',       'Northridge (91325)',       'Granada Hills (91344)',
        ],
    ],
    'New York' => [
        'intro' => 'We serve all five NYC boroughs and the greater tri-state metro area — from Manhattan\'s luxury pre-war buildings and new high-rises to Brooklyn brownstones, Queens co-ops, and Westchester estates. Our NYC technicians are trained in elevator-only access, doorman building protocols, and the compact kitchen layouts common in New York City apartments. Same-day service available across all five boroughs with 2-hour arrival windows in Manhattan.',
        'neighborhoods' => [
            // Manhattan
            'Upper West Side (10023)',  'Upper East Side (10021)', 'Chelsea (10011)',
            'Tribeca (10013)',          'SoHo (10012)',             'Greenwich Village (10014)',
            'West Village (10014)',     'Flatiron (10010)',         'Murray Hill (10016)',
            'Hell\'s Kitchen (10036)', 'Harlem (10030)',            'Washington Heights (10033)',
            'Financial District (10004)', 'Battery Park City (10280)', 'Hudson Yards (10001)',
            // Brooklyn
            'Park Slope (11215)',       'Williamsburg (11211)',     'DUMBO (11201)',
            'Brooklyn Heights (11201)', 'Cobble Hill (11201)',      'Carroll Gardens (11231)',
            'Boerum Hill (11217)',       'Fort Greene (11217)',      'Clinton Hill (11238)',
            // Queens
            'Astoria (11102)',           'Forest Hills (11375)',     'Flushing (11354)',
            'Jackson Heights (11372)',   'Long Island City (11101)',
        ],
        'suburbs' => [
            // Outer Boroughs
            'Bronx (10451)',            'Staten Island (10301)',
            // New Jersey
            'Hoboken NJ (07030)',       'Jersey City NJ (07302)',   'Weehawken NJ (07086)',
            'Edgewater NJ (07020)',     'Fort Lee NJ (07024)',
            // Westchester
            'Yonkers NY (10701)',        'White Plains NY (10601)', 'Scarsdale NY (10583)',
            'Bronxville NY (10708)',     'Larchmont NY (10538)',    'Mamaroneck NY (10543)',
            // Long Island
            'Great Neck NY (11021)',     'Manhasset NY (11030)',    'Garden City NY (11530)',
            'Roslyn NY (11576)',         'Mineola NY (11501)',       'Hempstead NY (11550)',
        ],
    ],
];

// Build local data — support both old array format and new structured format
$city_raw = $city_data[$city] ?? null;
if ($city_raw) {
    $local = [
        'neighborhoods' => $city_raw['neighborhoods'] ?? $zips,
        'suburbs'       => $city_raw['suburbs'] ?? [],
        'intro'         => $city_raw['intro'] ?? '',
    ];
} else {
    $local = ['neighborhoods' => $zips, 'suburbs' => [], 'intro' => ''];
}

// City-specific FAQs
$city_faqs_map = [
    'Chicago' => [
        ['question' => 'Do you serve all Chicago neighborhoods?', 'answer' => 'Yes. We cover all 77 Chicago neighborhoods. For most city neighborhoods, same-day appointments are available Monday through Saturday. Suburban areas in Cook, DuPage, and Lake counties typically receive same-day or next-day service.'],
        ['question' => 'Do Chicago winters affect Viking appliances?', 'answer' => 'Chicago\'s cold winters can affect refrigerant efficiency in refrigerators and wine coolers. Condensation from dramatic humidity changes can also impact dishwashers and range electronics. Our technicians are experienced in diagnosing Chicago climate-related Viking appliance failures.'],
        ['question' => 'Do you service Chicago high-rises and condos?', 'answer' => 'Yes. We service all property types — high-rises, condos, co-ops, townhouses, and single-family homes. We carry building insurance documentation and work within building service hour restrictions.'],
        ['question' => 'What suburbs around Chicago do you cover?', 'answer' => 'We cover the North Shore (Evanston, Wilmette, Winnetka, Highland Park), western suburbs (Oak Park, Naperville, Wheaton, Downers Grove), northwest suburbs (Arlington Heights, Schaumburg, Skokie), and south suburbs (Tinley Park, Orland Park, Frankfort, New Lenox).'],
        ['question' => 'What does a Viking repair cost in Chicago?', 'answer' => 'Most Viking repairs in Chicago range from $150–$350 for parts and labor. You receive a clear written quote after diagnosis — no work begins until you approve the price.'],
    ],
    'Los Angeles' => [
        ['question' => 'Do you serve the San Fernando Valley?', 'answer' => 'Yes. We cover the full San Fernando Valley including Studio City, Sherman Oaks, Encino, Woodland Hills, Northridge, Granada Hills, and Chatsworth, as well as all Westside, South Bay, and San Gabriel Valley cities.'],
        ['question' => 'Does LA\'s hard water affect Viking appliances?', 'answer' => 'Yes. Los Angeles hard water causes mineral buildup in Viking dishwasher spray arms, refrigerator water lines, and ice makers. We recommend annual descaling for dishwashers in the LA area. Our technicians can diagnose and resolve hard-water-related failures.'],
        ['question' => 'Do you service Orange County and Ventura County?', 'answer' => 'Yes. We service parts of Orange County (Anaheim, Fullerton, Irvine, Brea) and Ventura County (Thousand Oaks, Simi Valley, Oxnard), in addition to all 88 cities within Los Angeles County.'],
        ['question' => 'What does Viking repair cost in Los Angeles?', 'answer' => 'Most Viking repairs in Los Angeles range from $150–$450 for parts and labor depending on the appliance and fault. You receive an upfront written quote after our technician diagnoses the issue — no surprises.'],
        ['question' => 'How quickly can you reach my LA neighborhood?', 'answer' => 'With technicians positioned throughout the LA metro, we typically offer same-day appointments for calls received before noon, and next-day for all others. We provide a precise 2-hour arrival window.'],
    ],
    'New York' => [
        ['question' => 'Do you service Manhattan high-rise apartments?', 'answer' => 'Yes. Our NYC technicians are trained in elevator-only access, doorman building protocols, service elevator requirements, and HOA sign-in procedures. We handle all Manhattan high-rise and co-op buildings.'],
        ['question' => 'Do you cover all five NYC boroughs?', 'answer' => 'Yes — Manhattan, Brooklyn, Queens, the Bronx, and Staten Island. We also serve Westchester County (Yonkers, White Plains, Scarsdale), New Jersey (Hoboken, Jersey City, Fort Lee), and Long Island (Great Neck, Garden City, Mineola).'],
        ['question' => 'What is your Manhattan arrival window?', 'answer' => 'We provide a 2-hour arrival window throughout Manhattan. For same-day service, call before noon. For next-day, you can book online anytime. We account for traffic in our scheduling.'],
        ['question' => 'Do you service Brooklyn brownstones and Queens co-ops?', 'answer' => 'Yes. We service all NYC property types — brownstones, co-ops, condos, pre-war apartments, and new construction — across all five boroughs. We carry compact equipment appropriate for NYC apartment access.'],
        ['question' => 'What does Viking repair cost in New York City?', 'answer' => 'Most Viking repairs in NYC range from $150–$450 for parts and labor. A flat diagnostic fee is charged on arrival and credited toward the repair cost. You receive a written quote before any work begins.'],
    ],
    'San Francisco' => [
        ['question' => 'Does SF coastal salt air damage Viking appliances?', 'answer' => 'Yes. San Francisco\'s coastal salt air accelerates corrosion on dishwasher racks, refrigerator door hinges, and range burner components faster than inland cities. We recommend annual maintenance checks for appliances in homes within a mile of the Bay or ocean.'],
        ['question' => 'Do you service Victorian flats and Edwardian apartments?', 'answer' => 'Yes. We are experienced in San Francisco\'s unique housing stock — Victorian flats, Edwardian apartments, modern condos, and loft conversions. Our technicians navigate compact kitchen layouts and can coordinate with HOAs and building management.'],
        ['question' => 'Do you cover the East Bay and South Bay?', 'answer' => 'Yes. We serve Oakland, Berkeley, Emeryville, Alameda, and Fremont in the East Bay, and San Jose, Campbell, Los Gatos, Cupertino, and Sunnyvale in the South Bay. Same-day service across Alameda, Contra Costa, and Santa Clara counties.'],
        ['question' => 'What does Viking repair cost in the Bay Area?', 'answer' => 'Most Viking repairs in the Bay Area range from $150–$400 for parts and labor. Viking appliances are a significant investment — repair is almost always the economical choice for appliances under 10 years old. You receive an upfront quote before work begins.'],
        ['question' => 'How quickly can you reach San Francisco neighborhoods?', 'answer' => 'With technicians across the Bay Area, we offer same-day service for most SF neighborhoods when you call before noon, and next-day across the broader Bay Area. We provide a 2-hour arrival window.'],
    ],
    'Houston' => [
        ['question' => 'Does Houston heat affect Viking refrigerators?', 'answer' => 'Significantly. Houston\'s extreme summer heat forces Viking refrigerator compressors to run nearly continuously, which accelerates wear on compressor seals and motors. We recommend annual refrigerator maintenance in Houston to prevent compressor failure from heat stress.'],
        ['question' => 'Can flooding damage Viking appliance electronics?', 'answer' => 'Yes. Water intrusion from flooding can corrode Viking control boards, short electrical components, and damage sensors. If your appliance was exposed to flood water, do not attempt to use it — schedule a professional inspection before operation.'],
        ['question' => 'Do you cover The Woodlands and Katy?', 'answer' => 'Yes. We cover all major Houston suburban corridors: The Woodlands and Spring to the north, Katy and Cypress to the west, Sugar Land and Missouri City to the southwest, and Pearland and League City to the south.'],
        ['question' => 'What does Viking repair cost in Houston?', 'answer' => 'Most Viking repairs in Houston range from $130–$380 for parts and labor. Our flat diagnostic fee is credited toward the repair. You receive a written upfront quote — no surprises, no hidden fees.'],
        ['question' => 'Do you service Energy Corridor and Memorial area?', 'answer' => 'Yes. We serve Houston\'s Inner Loop neighborhoods (Midtown, Montrose, The Heights, River Oaks), the Energy Corridor, Memorial, West University Place, and Bellaire, as well as all major suburban markets.'],
    ],
    'Miami' => [
        ['question' => 'Does Miami humidity accelerate Viking appliance failures?', 'answer' => 'Yes. Miami\'s year-round tropical heat and humidity stress Viking refrigerator compressors constantly, promote mold growth in dishwasher door seals and interior surfaces, and accelerate corrosion on electrical contacts. We prioritize same-day dispatch for urgent cooling-related failures in South Florida.'],
        ['question' => 'Do you cover Fort Lauderdale and Boca Raton?', 'answer' => 'Yes. We service all of Broward County including Fort Lauderdale, Pembroke Pines, Plantation, Sunrise, and Coral Springs, as well as northern Palm Beach County including Boca Raton, Delray Beach, and Boynton Beach.'],
        ['question' => 'Do you service Miami condo and high-rise buildings?', 'answer' => 'Yes. We specialize in doorman buildings, valet parking coordination, freight elevator access, and HOA protocols throughout Brickell, Edgewater, and South Beach. Our technicians carry building insurance documentation.'],
        ['question' => 'My dishwasher has odor issues — is that a Miami problem?', 'answer' => 'Yes. Dishwasher odors are common in Miami due to humidity. Moisture trapped in sealed compartments develops mold requiring cleaning, door seal replacement, and monthly preventative maintenance. We can diagnose and resolve humidity-related dishwasher issues.'],
        ['question' => 'What does Viking repair cost in Miami?', 'answer' => 'Most Viking repairs in Miami range from $150–$400 for parts and labor. A flat diagnostic fee is charged on arrival and credited toward the repair. You receive a written quote before any work begins.'],
    ],
];

if (empty($faqs)) $faqs = $city_faqs_map[$city] ?? [
    ['question' => "How quickly can you reach {$city} neighborhoods?",       'answer' => "We maintain technicians across the {$city} metro area. For most city neighborhoods, same-day appointments are available. Suburban areas typically receive next-day service."],
    ['question' => "What Viking appliances do you repair in {$city}?",       'answer' => "We specialize exclusively in Viking appliances in {$city}: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models covered."],
    ['question' => "Do you service apartments and condos in {$city}?",       'answer' => "Yes. We service all property types — apartments, condos, single-family homes, and multi-unit buildings throughout {$city} and surrounding areas."],
    ['question' => "What is your pricing model for {$city} appliance repair?", 'answer' => "We charge a flat diagnostic fee (credited toward the repair if you proceed) and provide a clear upfront quote before any work begins. No hidden fees."],
    ['question' => "Are your {$city} technicians licensed and insured?",      'answer' => "Yes. All technicians are fully licensed, bonded, and insured. We carry full liability insurance on every service call throughout {$city}."],
];

$loc_meta_desc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true)
    ?: "Professional Viking appliance repair in {$city}, {$state}. Certified technicians, genuine OEM parts, 30-day warranty. Same-day service available.";

$faq_schema_loc = [];
foreach ($faqs as $faq) {
    $faq_schema_loc[] = ['@type' => 'Question', 'name' => $faq['question'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']]];
}

$_schema_data = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'LocalBusiness', '@id' => get_permalink() . '#localbusiness', 'name' => "{$biz} — {$city} Appliance Repair", 'description' => $loc_meta_desc, 'url' => get_permalink(), 'telephone' => $phone, 'areaServed' => ['@type' => 'City', 'name' => $city, 'containedInPlace' => ['@type' => 'State', 'name' => $state_full]], 'address' => ['@type' => 'PostalAddress', 'addressLocality' => $city, 'addressRegion' => $state, 'addressCountry' => 'US'], 'priceRange' => '$$', 'openingHours' => 'Mo-Sa 08:00-18:00'],
        ['@type' => 'FAQPage', '@id' => get_permalink() . '#faq', 'mainEntity' => $faq_schema_loc],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')], ['@type' => 'ListItem', 'position' => 2, 'name' => 'Locations', 'item' => home_url('/locations/')], ['@type' => 'ListItem', 'position' => 3, 'name' => "Viking Appliance Repair in {$city}"]]],
    ],
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
</style>

<!-- ── HERO ──────────────────────────────────── -->
<section class="loc-hero" aria-labelledby="loc-h1">
  <div class="container">
    <div class="ph-split">
      <div class="ph-split__text">
        <nav class="breadcrumbs" aria-label="Breadcrumb" style="margin-bottom:var(--space-6);">
          <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <a href="<?php echo esc_url(home_url('/locations/')); ?>">Locations</a>
          <span class="breadcrumbs__sep" aria-hidden="true">/</span>
          <span class="breadcrumbs__current" aria-current="page"><?php echo esc_html($city); ?></span>
        </nav>

        <span class="loc-hero__label">Service Area — <?php echo esc_html("{$city}, {$state}"); ?></span>

        <h1 class="loc-hero__title" id="loc-h1">
          Viking Appliance Repair<br>
          <em style="font-style:italic;font-weight:300;"><?php echo esc_html("{$city}, {$state_full}"); ?></em>
        </h1>

        <p class="loc-hero__sub"><?php echo esc_html($subtitle); ?></p>

        <div style="display:flex;flex-wrap:wrap;gap:12px;">
          <a href="<?php echo esc_url($phone_raw); ?>" class="btn btn--primary btn--lg">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            <?php echo esc_html($phone); ?>
          </a>
          <a href="/schedule/" class="btn btn--outline btn--lg">Schedule Online</a>
        </div>
      </div>
      <div class="ph-split__img">
        <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-tuscany-kitchen-1.jpg'); ?>"
             alt="Viking appliance repair in <?php echo esc_attr($city); ?>"
             loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ── INTRO ─────────────────────────────────── -->
<section class="section" style="border-bottom:1px solid var(--color-rule);">
  <div class="container container--narrow">
    <span class="section-header__eyebrow">Viking Repair in <?php echo esc_html($city); ?></span>
    <h2 style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;letter-spacing:-0.02em;line-height:1.12;color:#0D0D0D;margin:12px 0 20px;">
      Expert Viking Service Throughout <?php echo esc_html($city); ?>
    </h2>
    <?php if ($intro): ?>
      <div class="entry-content"><?php echo wp_kses_post(wpautop($intro)); ?></div>
    <?php elseif (!empty($local['intro'])): ?>
      <p style="font-size:1.0625rem;line-height:1.8;color:#3a3a3a;"><?php echo esc_html($local['intro']); ?></p>
    <?php else: ?>
      <p>Our certified Viking appliance repair technicians serve all neighborhoods and suburbs throughout <?php echo esc_html("{$city}, {$state_full}"); ?>. Whether your Viking range, refrigerator, dishwasher, or cooktop is malfunctioning, we offer fast, reliable repair using genuine Viking OEM parts — with a 30-day parts and labor warranty on every job.</p>
      <p>We understand that a broken Viking appliance is a major disruption to your home. That's why we offer same-day and next-day service across most of the <?php echo esc_html($city); ?> metro area, with upfront, transparent pricing and no hidden fees.</p>
    <?php endif; ?>
    <?php ar_disclaimer(); ?>
  </div>
</section>

<!-- ── SERVICES IN CITY ───────────────────────── -->
<style>
.loc-svc-wrap {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 4rem;
  align-items: start;
}
.loc-svc-row {
  display: grid;
  grid-template-columns: 44px 1fr auto;
  align-items: center;
  gap: 16px;
  padding: 16px 0;
  border-top: 1px solid #D9D8D3;
  text-decoration: none;
  color: #0D0D0D;
  position: relative;
  overflow: hidden;
  transition: background 0.12s;
}
.loc-svc-row::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0; left: -4px;
  width: 0;
  background: #C01C28;
  transition: width 0.14s;
}
.loc-svc-row:hover::before { width: 3px; left: 0; }
.loc-svc-row:hover .loc-svc-num { color: #C01C28; }
.loc-svc-row:hover .loc-svc-arrow { stroke: #C01C28; }
.loc-svc-num {
  font-family: 'Libre Baskerville', Georgia, serif;
  font-size: 1.5rem;
  font-weight: 300;
  color: #D9D8D3;
  letter-spacing: -0.04em;
  line-height: 1;
  transition: color 0.12s;
}
.loc-svc-name {
  font-family: 'Libre Baskerville', Georgia, serif;
  font-size: 1.125rem;
  font-weight: 500;
  color: #0D0D0D;
  letter-spacing: -0.01em;
  line-height: 1.2;
}
.loc-svc-arrow {
  stroke: #D9D8D3;
  transition: stroke 0.12s;
  flex-shrink: 0;
}
.loc-svc-closer { border-top: 1px solid #D9D8D3; }
.loc-svc-img {
  position: sticky;
  top: 88px;
  border-radius: 2px;
  overflow: hidden;
  aspect-ratio: 3/4;
}
.loc-svc-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
@media (max-width: 900px) {
  .loc-svc-wrap { grid-template-columns: 1fr; gap: 2.5rem; }
  .loc-svc-img { position: static; aspect-ratio: 16/9; order: 2; }
}
</style>
<section class="section" style="background:var(--color-bg-light);border-bottom:1px solid var(--color-rule);" aria-labelledby="svc-city-h2">
  <div class="container">
    <div class="loc-svc-wrap">

      <!-- Left: editorial service list -->
      <div>
        <span class="section-header__eyebrow" style="margin-bottom:12px;display:block;">Viking Repair Services in <?php echo esc_html($city); ?></span>
        <h2 id="svc-city-h2" style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;color:#0D0D0D;letter-spacing:-0.025em;line-height:1.1;margin:0 0 var(--space-6);">
          Every Viking Appliance We Service
        </h2>
        <?php
        $svcs = [
            ['name'=>'Viking Range Repair',        'slug'=>'viking-range-repair'],
            ['name'=>'Viking Refrigerator Repair',  'slug'=>'viking-refrigerator-repair'],
            ['name'=>'Viking Dishwasher Repair',    'slug'=>'viking-dishwasher-repair'],
            ['name'=>'Viking Cooktop Repair',       'slug'=>'viking-cooktop-repair'],
            ['name'=>'Viking Wall Oven Repair',     'slug'=>'viking-wall-oven-repair'],
            ['name'=>'Viking Wine Cooler Repair',   'slug'=>'viking-wine-cooler-repair'],
            ['name'=>'Viking Freezer Repair',       'slug'=>'viking-freezer-repair'],
            ['name'=>'Viking Vent Hood Repair',     'slug'=>'viking-vent-hood-repair'],
        ];
        ?>
        <div style="display:flex;flex-direction:column;">
          <?php foreach ($svcs as $i => $svc): ?>
          <a href="<?php echo esc_url(home_url('/services/' . $svc['slug'] . '/')); ?>" class="loc-svc-row">
            <span class="loc-svc-num" aria-hidden="true"><?php echo str_pad($i+1,2,'0',STR_PAD_LEFT); ?></span>
            <span class="loc-svc-name"><?php echo esc_html($svc['name']); ?></span>
            <svg class="loc-svc-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <?php endforeach; ?>
          <div class="loc-svc-closer"></div>
        </div>
      </div>

      <!-- Right: Viking kitchen image -->
      <div class="loc-svc-img">
        <img src="<?php echo esc_url(AR_URI . '/assets/images/viking-5series-kitchen.jpg'); ?>"
             alt="Viking appliances in <?php echo esc_attr($city); ?>"
             loading="lazy">
      </div>

    </div>
  </div>
</section>

<!-- ── SERVICE AREA ───────────────────────────── -->
<?php if (!empty($local['neighborhoods']) || !empty($local['suburbs'])): ?>
<section class="section" style="background:var(--color-bg-light);border-top:1px solid var(--color-rule);border-bottom:1px solid var(--color-rule);" aria-labelledby="coverage-h2">
  <div class="container">

    <div style="margin-bottom:var(--space-8);">
      <span class="section-header__eyebrow">Service Coverage</span>
      <h2 id="coverage-h2" style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:400;letter-spacing:-0.02em;color:#0D0D0D;margin:10px 0 0;line-height:1.1;">
        <?php echo $city === 'Chicago' ? 'All 77 Chicago Neighborhoods &amp; Suburbs' : esc_html($city) . ' Neighborhoods &amp; Suburbs'; ?>
      </h2>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem 4rem;align-items:start;">

      <?php if (!empty($local['neighborhoods'])): ?>
      <div>
        <h3 style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#C01C28;margin:0 0 16px;">
          <?php echo esc_html($city); ?> Neighborhoods
        </h3>
        <div class="zip-grid" style="gap:8px;">
          <?php foreach ($local['neighborhoods'] as $n): ?>
          <span class="zip-badge" style="font-size:12px;"><?php echo esc_html($n); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if (!empty($local['suburbs'])): ?>
      <div>
        <h3 style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#C01C28;margin:0 0 16px;">
          <?php echo $city === 'Chicago' ? 'Chicago Metro &amp; Suburbs' : 'Surrounding Suburbs'; ?>
        </h3>
        <div class="zip-grid" style="gap:8px;">
          <?php foreach ($local['suburbs'] as $s): ?>
          <span class="zip-badge" style="font-size:12px;"><?php echo esc_html($s); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── WHY US (city-specific) ─────────────────── -->
<section class="section" style="background:var(--color-primary-dark);border-bottom:1px solid rgba(255,255,255,0.07);" aria-labelledby="why-city-h2">
  <div class="container">
    <div style="text-align:center;margin-bottom:var(--space-10);">
      <span style="font-family:'Manrope',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:rgba(255,255,255,0.35);display:block;margin-bottom:14px;">Why <?php echo esc_html($city); ?> Homeowners Trust Us</span>
      <h2 id="why-city-h2" style="font-family:'Libre Baskerville',Georgia,serif;font-size:clamp(1.875rem,3.5vw,3rem);font-weight:300;color:#fff;letter-spacing:-0.025em;line-height:1.1;margin:0;">
        Premium Viking Service in <?php echo esc_html($city); ?>
      </h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);border-left:1px solid rgba(255,255,255,0.08);">
      <?php
      $whys = [
          ['n'=>'01','t'=>'Local Technicians','b'=>"Our team is based throughout the {$city} metro area — no long waits for technicians traveling from out of town."],
          ['n'=>'02','t'=>'Genuine Viking OEM Parts','b'=>"We carry only genuine Viking OEM parts. No aftermarket alternatives — your appliance performs exactly as Viking designed it."],
          ['n'=>'03','t'=>'30-Day Written Warranty','b'=>"Every repair in {$city} is backed by our 30-day parts and labor warranty. Written documentation provided on the day of service."],
      ];
      foreach ($whys as $w): ?>
      <div style="border-right:1px solid rgba(255,255,255,0.08);padding:36px 32px;display:flex;flex-direction:column;gap:14px;">
        <div style="font-family:'Libre Baskerville',Georgia,serif;font-size:4rem;font-weight:300;color:rgba(255,255,255,0.12);line-height:1;letter-spacing:-0.04em;" aria-hidden="true"><?php echo esc_html($w['n']); ?></div>
        <h3 style="font-family:'Libre Baskerville',Georgia,serif;font-size:1.25rem;font-weight:500;color:#fff;letter-spacing:-0.01em;line-height:1.2;"><?php echo esc_html($w['t']); ?></h3>
        <p style="font-family:'Manrope',sans-serif;font-size:13.5px;color:rgba(255,255,255,0.5);line-height:1.75;margin:0;"><?php echo esc_html($w['b']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FAQ ────────────────────────────────────── -->
<?php ar_faq_section($faqs, "Viking Appliance Repair in {$city} — FAQ"); ?>

<!-- ── APPOINTMENT ────────────────────────────── -->
<?php ar_appointment_form('location-page', "Book Viking Appliance Repair in {$city}"); ?>

<?php get_footer(); ?>
