<?php
/**
 * Viking Appliance Repair Service — Blog Sample Data Import
 * Creates 7 sample blog posts across Viking-focused categories.
 * Also creates the Blog page and sets it as the WordPress Posts page.
 *
 * USAGE (from WordPress root):
 *   wp eval-file wp-content/themes/viking-appliance-repair-service/inc/blog-sample-data.php
 */

defined( 'ABSPATH' ) || die( 'Run via WP-CLI only.' );

WP_CLI::line( '' );
WP_CLI::line( '╔══════════════════════════════════════════════╗' );
WP_CLI::line( '║  Viking Appliance Repair — Blog Sample Data  ║' );
WP_CLI::line( '╚══════════════════════════════════════════════╝' );

/* ──────────────────────────────────────────────
   STEP 1 — Set up blog_category terms
────────────────────────────────────────────── */
$categories = [
    'range-oven'     => 'Range & Oven Tips',
    'refrigerator'   => 'Refrigerator Tips',
    'dishwasher'     => 'Dishwasher Tips',
    'cooktop'        => 'Cooktop Tips',
    'maintenance'    => 'Maintenance Guides',
    'troubleshooting'=> 'Troubleshooting',
    'buying-guides'  => 'Buying Guides',
];

$term_ids = [];
foreach ( $categories as $slug => $name ) {
    $existing = get_term_by( 'slug', $slug, 'blog_category' );
    if ( $existing ) {
        $term_ids[ $slug ] = $existing->term_id;
        WP_CLI::line( "  Category exists: {$name} (ID: {$existing->term_id})" );
    } else {
        $result = wp_insert_term( $name, 'blog_category', [ 'slug' => $slug ] );
        if ( is_wp_error( $result ) ) {
            WP_CLI::warning( "  Failed to create category: {$name}" );
        } else {
            $term_ids[ $slug ] = $result['term_id'];
            WP_CLI::success( "  Created category: {$name} (ID: {$result['term_id']})" );
        }
    }
}

/* ──────────────────────────────────────────────
   STEP 2 — Blog page + Reading settings
────────────────────────────────────────────── */
$blog_page = get_page_by_path( 'blog', OBJECT, 'page' );
if ( ! $blog_page ) {
    $blog_id = wp_insert_post([
        'post_type'    => 'page',
        'post_title'   => 'Blog',
        'post_name'    => 'blog',
        'post_status'  => 'publish',
        'post_content' => '',
    ], true );
    if ( is_wp_error( $blog_id ) ) {
        WP_CLI::warning( 'Failed to create Blog page: ' . $blog_id->get_error_message() );
        $blog_id = 0;
    } else {
        WP_CLI::success( "Created Blog page (ID: {$blog_id})" );
    }
} else {
    $blog_id = $blog_page->ID;
    WP_CLI::line( "  Blog page exists (ID: {$blog_id})" );
}

$front_page = get_page_by_path( 'home', OBJECT, 'page' );
if ( ! $front_page ) {
    $fp_id = (int) get_option( 'page_on_front' );
    if ( ! $fp_id ) {
        $fp_id = wp_insert_post([
            'post_type'    => 'page',
            'post_title'   => 'Home',
            'post_name'    => 'home',
            'post_status'  => 'publish',
            'post_content' => '',
        ]);
        if ( ! is_wp_error( $fp_id ) ) WP_CLI::success( "Created Home page (ID: {$fp_id})" );
    }
} else {
    $fp_id = $front_page->ID;
}

if ( $blog_id ) {
    update_option( 'show_on_front', 'page' );
    if ( $fp_id ) update_option( 'page_on_front', $fp_id );
    update_option( 'page_for_posts', $blog_id );
    WP_CLI::success( "Reading settings: Posts page → Blog (ID: {$blog_id})" );
}

/* ──────────────────────────────────────────────
   STEP 3 — Sample blog posts
────────────────────────────────────────────── */
$posts = [

    // ── Range & Oven Tips ──────────────────────────────────────────────────
    [
        'title'    => 'Viking Range Not Heating? Here\'s How to Diagnose the Problem',
        'slug'     => 'viking-range-not-heating-diagnosis-guide',
        'cat'      => 'range-oven',
        'focuskw'  => 'Viking range not heating',
        'image'    => get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png',
        'image_alt'=> 'Viking professional gas range with sealed burners',
        'excerpt'  => 'A Viking range that won\'t heat the oven is a frustrating problem — but it\'s almost always caused by one of a small number of well-understood faults. Here\'s how to diagnose it.',
        'content'  => <<<HTML
<p>A Viking range that fails to heat the oven is one of the most common service calls we handle. Given that Viking ranges are built to professional kitchen standards and are designed for decades of service, a no-heat fault is almost always caused by a specific component failure rather than a fundamental problem with the appliance. Here is how to diagnose it systematically.</p>

<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png' ); ?>" alt="Viking professional gas range — not heating diagnosis guide" loading="lazy"></figure>

<h2>Step 1: Check for a Fault Code</h2>
<p>Before anything else, check whether the control panel is displaying an F-code. Viking ranges and ovens use a documented series of F fault codes that pinpoint the failed component. The most common codes related to a no-heat condition are:</p>
<ul>
    <li><strong>F2</strong> — Oven temperature sensor shorted. The control board has detected an abnormally low sensor resistance and shut the oven down.</li>
    <li><strong>F3</strong> — Oven temperature sensor open circuit. The sensor is disconnected or broken.</li>
    <li><strong>F4</strong> — Temperature runaway. The oven exceeded the set point significantly — this can shut the oven down even though it was running too hot rather than too cold.</li>
    <li><strong>F1</strong> — Control board failure. The board itself has detected an internal fault.</li>
</ul>
<p>If your Viking range is displaying any of these codes, the diagnosis is effectively complete — the code identifies the failed component. Schedule a repair rather than attempting further troubleshooting with an active fault code.</p>

<h2>Step 2: Gas Oven — Test the Igniter</h2>
<p>On Viking gas ranges, the most common cause of an oven that won't heat (with no fault code) is a failing hot surface igniter. The igniter glows orange when the oven is turned on, and its heat opens the gas safety valve to allow gas to flow. A weakening igniter glows orange but cannot draw sufficient current to fully open the safety valve — the result is an oven that appears to be trying to light but never ignites.</p>
<p>Signs of a failing igniter:</p>
<ul>
    <li>The igniter glows for 90 seconds or more without the gas igniting</li>
    <li>The igniter glows but the flame only briefly appears and then extinguishes</li>
    <li>The igniter does not glow at all when the oven is turned on</li>
</ul>
<p>Igniter replacement is one of the most common Viking oven repairs and is typically completed in a single visit.</p>

<h2>Step 3: Electric Oven — Check the Bake Element</h2>
<p>In Viking dual-fuel ranges (gas cooktop, electric oven), a failed bake element is the most frequent no-heat cause. The bake element is located at the bottom of the oven cavity. Signs of element failure include visible breaks or burn marks on the element coil, or the element not glowing at all when the oven is set to Bake.</p>
<p>A multimeter test of element resistance confirms failure definitively. A failed bake element reads open circuit (infinite resistance); a functioning element reads within the resistance specification for the specific model.</p>

<h2>When to Call a Technician</h2>
<p>If your Viking range shows a fault code, has a weak or non-glowing igniter, or has a visibly damaged bake element, schedule a professional repair. Our certified technicians carry Viking OEM igniters, bake elements, and temperature sensor probes and can complete most Viking oven no-heat repairs on the first visit.</p>
<p><a href="/services/viking-range-repair/">View our Viking range repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>
HTML,
    ],

    // ── Troubleshooting ───────────────────────────────────────────────────
    [
        'title'    => 'Viking Oven F-Codes Explained: What F1 Through F9 Mean',
        'slug'     => 'viking-oven-f-codes-explained',
        'cat'      => 'troubleshooting',
        'focuskw'  => 'Viking oven fault codes',
        'image'    => get_template_directory_uri() . '/assets/images/smiley-old-woman-opening-door-oven.jpg',
        'image_alt'=> 'Viking wall oven control panel',
        'excerpt'  => 'Your Viking range or wall oven is displaying an F-code. Here\'s exactly what each code from F1 to F9 means and what needs to be repaired.',
        'content'  => <<<HTML
<p>Viking ranges and wall ovens use a series of F fault codes to communicate specific failures to the technician or homeowner. Each code corresponds to a particular component or system failure, making diagnosis straightforward once you know what the codes mean. This guide covers the documented Viking oven F-codes F1 through F9.</p>

<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smiley-old-woman-opening-door-oven.jpg' ); ?>" alt="Viking wall oven F-code fault code guide" loading="lazy"></figure>

<h2>F1 — Control Board Failure</h2>
<p>The F1 code indicates the main electronic control board (ERC) has detected an internal fault. The control board manages all oven functions including temperature regulation, timer, and self-clean. F1 is often triggered by a power surge or by component failure from heat and age. In most cases, the control board requires replacement.</p>
<p><strong>Action:</strong> Switch off the circuit breaker for 60 seconds and restore power. If F1 returns, schedule a professional repair. Do not continue using the oven with an active F1 code.</p>

<h2>F2 — Oven Temperature Sensor Shorted</h2>
<p>F2 means the oven temperature sensor (the RTD probe mounted inside the oven cavity) is reading a short circuit — its resistance is below the minimum acceptable value. The control board cannot regulate temperature accurately and shuts the oven down as a safety measure. F2 is one of the most common Viking oven fault codes, and sensor replacement resolves it in the majority of cases.</p>

<h2>F3 — Oven Temperature Sensor Open Circuit</h2>
<p>F3 means the temperature sensor circuit has an open condition — either the sensor itself has broken internally, its wiring connector is disconnected, or the wire has broken. Like F2, F3 shuts the oven down and requires sensor service to resolve.</p>

<h2>F4 — Temperature Runaway</h2>
<p>F4 triggers when the oven temperature exceeds the set point by a significant margin without the control board being able to correct it. This indicates a stuck oven relay on the control board — the relay that cycles the heating element on and off has failed in the closed position, keeping the element running continuously. F4 is a safety-critical fault and the oven should not be used until repaired.</p>

<h2>F7 — Key Stuck on Control Panel</h2>
<p>F7 indicates a key on the control panel keypad is registering as continuously pressed. This is most commonly caused by moisture (steam or spills) entering the keypad membrane. Allow the panel to dry completely with the oven off, then reset. If F7 returns after the panel is thoroughly dry, the keypad membrane requires replacement.</p>

<h2>F9 — Self-Clean Door Lock Failure</h2>
<p>F9 appears during or after the self-clean cycle and indicates the door lock mechanism has not engaged or disengaged correctly. The oven requires a confirmed locked-door state before self-clean can begin — if the lock motor doesn't complete its travel, F9 triggers and the cycle is cancelled. The door lock motor assembly typically requires replacement to resolve F9.</p>

<h2>What to Do When an F-Code Appears</h2>
<p>For any F-code that returns after a circuit-breaker reset, professional service is required. Our technicians are trained on Viking oven diagnostics and carry Viking OEM parts to resolve F-code faults on the first visit. <a href="/error-codes/">Browse our full Viking fault code reference</a> or <a href="/schedule/">book a repair appointment</a>.</p>
HTML,
    ],

    // ── Refrigerator Tips ─────────────────────────────────────────────────
    [
        'title'    => 'Viking Refrigerator Not Cooling: What to Check Before Calling a Technician',
        'slug'     => 'viking-refrigerator-not-cooling-diagnosis',
        'cat'      => 'refrigerator',
        'focuskw'  => 'Viking refrigerator not cooling',
        'image'    => get_template_directory_uri() . '/assets/images/pexels-pixabay-373548.jpg',
        'image_alt'=> 'Viking built-in refrigerator not cooling guide',
        'excerpt'  => 'A Viking refrigerator that isn\'t cooling properly is an urgent problem. Here\'s how to identify the most likely cause before the food is at risk.',
        'content'  => <<<HTML
<p>A Viking refrigerator that stops cooling is a genuine emergency — perishable food is at risk within hours of the temperature rising. Before calling a technician, work through this checklist. In a meaningful percentage of cases, the cause is something you can check yourself.</p>

<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/pexels-pixabay-373548.jpg' ); ?>" alt="Viking built-in refrigerator not cooling — diagnosis guide" loading="lazy"></figure>

<h2>1. Check the Condenser Coils</h2>
<p>Viking built-in refrigerators have condenser coils located in the condenser compartment, typically accessed via the grille at the bottom or behind the unit. If these coils are coated with dust and pet hair, the condenser cannot release heat efficiently and the refrigerator will gradually lose its ability to cool.</p>
<p><strong>Action:</strong> Vacuum the condenser coils with a brush attachment. This should be done at least once a year and more frequently in homes with pets. A thorough cleaning often restores full cooling performance if the condenser was the limiting factor.</p>

<h2>2. Check Whether the Freezer Is Cold</h2>
<p>If the freezer remains cold but the fresh food compartment has warmed up, this pattern specifically indicates a defrost system failure. The evaporator coil (the cooling coil inside the freezer) has iced over completely, blocking the airflow that normally cools the refrigerator section. The refrigerator section warms while the freezer, which is in direct contact with the evaporator, stays cold.</p>
<p>Signs of defrost system failure include a sheet of ice visible on the back wall of the freezer compartment, reduced airflow from refrigerator vents, and a gradual warming of the refrigerator section over days or weeks. Professional repair is required — a technician will manually defrost the evaporator and replace the failed defrost component (typically the defrost heater, defrost thermostat, or defrost control timer).</p>

<h2>3. Listen for the Condenser Fan</h2>
<p>The condenser fan (usually at the bottom rear of the unit) removes heat from the condenser coils. If the fan has failed, heat cannot be dissipated and the entire cooling system becomes inefficient. With the refrigerator running, listen for the fan running when the compressor is on. No fan sound despite a running compressor indicates a fan motor failure.</p>

<h2>4. Check the Door Seals</h2>
<p>A torn, cracked, or loose door gasket allows warm room air to infiltrate the refrigerator continuously. The refrigerator runs almost constantly trying to overcome this load and eventually cannot maintain temperature. Test the seal by closing the door on a dollar bill — you should feel resistance when pulling it out. If the bill slides out without resistance, the gasket has lost its seal.</p>

<h2>5. When to Call a Technician Immediately</h2>
<p>If the compressor is completely silent (no running sound or vibration from the bottom rear), if there is a clicking or buzzing sound with no cooling at all, or if the refrigerator has been warming for more than 4 hours, schedule a repair immediately. These symptoms indicate compressor or sealed system failure that requires professional diagnosis.</p>
<p><a href="/services/viking-refrigerator-repair/">View our Viking refrigerator repair service</a> or <a href="/schedule/">book an appointment online</a> for same-day availability in most areas.</p>
HTML,
    ],

    // ── Dishwasher Tips ────────────────────────────────────────────────────
    [
        'title'    => 'Viking Dishwasher Not Cleaning Dishes Properly: 6 Causes and Fixes',
        'slug'     => 'viking-dishwasher-not-cleaning-causes-fixes',
        'cat'      => 'dishwasher',
        'focuskw'  => 'Viking dishwasher not cleaning',
        'image'    => get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg',
        'image_alt'=> 'Viking professional dishwasher stainless steel interior',
        'excerpt'  => 'A Viking dishwasher that leaves dishes dirty or spotted has one of a handful of identifiable causes. Here\'s how to find and fix each one.',
        'content'  => <<<HTML
<p>When a Viking dishwasher stops cleaning properly — leaving dishes spotted, greasy, or with dried-on food — the cause is almost always one of a small number of well-understood issues. Work through this list before assuming a major component has failed.</p>

<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg' ); ?>" alt="Viking dishwasher not cleaning properly — causes and fixes" loading="lazy"></figure>

<h2>1. Clogged Filter Assembly</h2>
<p>Viking dishwashers use a manual-clean filter system at the bottom of the tub. The filter traps food particles to keep the wash water clean. When the filter becomes heavily clogged, it restricts water circulation through the wash system and wash performance drops dramatically. This is the single most common cause of a Viking dishwasher suddenly cleaning poorly.</p>
<p><strong>Fix:</strong> Remove the lower rack and locate the cylindrical filter at the bottom of the tub. Twist it counter-clockwise to remove it, then rinse under running water while scrubbing gently with a soft brush. Reinstall firmly. Viking recommends cleaning this filter monthly under normal use.</p>

<h2>2. Blocked Spray Arms</h2>
<p>The spray arms (upper and lower) have small holes that jet water onto the dishes. These holes can become blocked with mineral deposits from hard water or small pieces of food debris. A blocked spray arm delivers water with reduced force and incomplete coverage.</p>
<p><strong>Fix:</strong> Remove the spray arms (they typically unscrew or unclip) and hold each under running water while using a toothpick or cocktail stick to clear each jet hole. Rinse and reinstall.</p>

<h2>3. Insufficient Water Temperature</h2>
<p>Viking dishwashers require water at 120°F (49°C) for effective cleaning. If your home water heater is set below this temperature, or if the dishwasher is located far from the water heater and cold water fills the machine before the hot water arrives, cleaning performance suffers significantly. Grease and detergent do not dissolve effectively below 120°F.</p>
<p><strong>Fix:</strong> Run the hot water at the kitchen sink until it is fully hot before starting the dishwasher. Check that the water heater is set to at least 120°F.</p>

<h2>4. Wrong or Poor-Quality Detergent</h2>
<p>Dishwasher detergent degrades over time and loses cleaning effectiveness. Old powder or tablet detergent stored in a humid cabinet can clump and lose potency. Using too little detergent, or a detergent incompatible with your local water hardness, also reduces cleaning performance.</p>
<p><strong>Fix:</strong> Use fresh, premium detergent tablets designed for automatic dishwashers and store them in a sealed, dry container.</p>

<h2>5. Low Rinse Aid Level</h2>
<p>Rinse aid reduces water surface tension so water sheets off dishes rather than forming droplets that dry as spots. Without rinse aid, even a perfectly functioning dishwasher will leave spots and streaks. Check the rinse aid indicator on the control panel or door interior.</p>

<h2>6. Failing Wash Pump</h2>
<p>If all the above factors are in order and the dishwasher still cleans poorly, the main circulation pump may be losing efficiency. A pump that delivers reduced water pressure will not clean effectively even with clean filters and clear spray arms. You may hear a change in the operational sound — a quieter or more labored wash cycle sound.</p>
<p>Pump service requires a professional technician. <a href="/services/viking-dishwasher-repair/">View our Viking dishwasher repair service</a> or <a href="/schedule/">book an appointment</a>.</p>
HTML,
    ],

    // ── Maintenance Guides ────────────────────────────────────────────────
    [
        'title'    => 'Viking Appliance Maintenance Checklist: What to Do Each Year',
        'slug'     => 'viking-appliance-annual-maintenance-checklist',
        'cat'      => 'maintenance',
        'focuskw'  => 'Viking appliance maintenance',
        'image'    => get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg',
        'image_alt'=> 'Viking kitchen appliances annual maintenance guide',
        'excerpt'  => 'Regular maintenance is the most effective way to protect your investment in Viking appliances. This checklist covers everything you should do each year to keep them running at full performance.',
        'content'  => <<<HTML
<p>Viking appliances are built to last — but like any precision equipment, they perform best and last longest when maintained regularly. After years of servicing Viking appliances across the country, we can confirm that most appliance failures are predictable and preventable with a few maintenance tasks done annually.</p>

<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg' ); ?>" alt="Viking appliance annual maintenance — kitchen setup" loading="lazy"></figure>

<h2>Viking Range &amp; Oven</h2>
<ul>
    <li><strong>Clean the burner caps and ports.</strong> Remove each burner cap and clean the flame ports with a small brush or straightened paper clip. Clogged ports cause weak, uneven flames and continuous clicking. Do this at least once a year or any time burner performance changes.</li>
    <li><strong>Check oven temperature accuracy.</strong> Use an independent oven thermometer to verify that your Viking oven is heating to within 25°F of the set temperature. Viking allows a calibration offset adjustment via the control panel if the reading is consistently off.</li>
    <li><strong>Inspect the oven door gasket.</strong> The door gasket creates the seal that keeps oven heat where it belongs. Inspect for tears, hardening, or areas where the gasket has separated from the door frame. A damaged gasket reduces cooking efficiency and should be replaced.</li>
    <li><strong>Clean the oven interior.</strong> Run the self-clean cycle or manually clean with an appropriate oven cleaner. Accumulated grease can smoke, create odors, and in extreme cases pose a fire risk.</li>
</ul>

<h2>Viking Refrigerator</h2>
<ul>
    <li><strong>Clean the condenser coils.</strong> Once a year, vacuum the condenser coils to remove dust and pet hair accumulation. Clogged condenser coils force the compressor to work harder and can reduce cooling efficiency significantly. This is the single most impactful maintenance task for a refrigerator.</li>
    <li><strong>Inspect door gaskets.</strong> Check all refrigerator and freezer door seals for tears, gaps, or hardening. Test with the dollar-bill method: close the door on a bill and pull — resistance should be firm.</li>
    <li><strong>Clean the drain pan.</strong> The drain pan beneath the refrigerator collects defrost condensate. Clean it annually to prevent odors and mold growth.</li>
    <li><strong>Test ice maker operation.</strong> Verify that the ice maker is producing ice consistently and that ice cubes are normal in size and clarity. Cloudy or undersized ice can indicate water pressure or inlet valve issues developing.</li>
</ul>

<h2>Viking Dishwasher</h2>
<ul>
    <li><strong>Clean the filter assembly monthly.</strong> Remove the cylindrical filter at the bottom of the tub and rinse thoroughly. For households with heavy use, clean it every two to three weeks.</li>
    <li><strong>Run a cleaning cycle.</strong> Once a month, run an empty dishwasher cycle with a dishwasher cleaner to remove grease and mineral deposits from the pump, spray arms, and interior walls.</li>
    <li><strong>Inspect the door gasket.</strong> Check the door seal for tears or areas where it is no longer in contact with the tub opening.</li>
    <li><strong>Clean the spray arm jets.</strong> Quarterly, remove and clear the spray arm holes of any mineral or debris blockages.</li>
</ul>

<h2>Viking Cooktop</h2>
<ul>
    <li><strong>Deep clean burner areas.</strong> Disassemble and clean around each burner, including beneath the grates. Food debris in burner ignition areas causes continuous clicking and ignition problems.</li>
    <li><strong>Test ignition on all burners.</strong> Verify that every burner ignites promptly and cleanly. A burner that takes more than 3–4 seconds to light — or that requires multiple attempts — has a weakening electrode or clogged port.</li>
</ul>

<p>The key to Viking appliance maintenance is making these tasks habitual rather than reactive. Set a calendar reminder each year and assign 2–3 tasks to each quarter. In under two hours per year, you will prevent the most common — and most costly — Viking appliance failures.</p>
<p>When maintenance isn't enough and a repair is needed, <a href="/schedule/">book a service appointment online</a> for same-day availability.</p>
HTML,
    ],

    // ── Buying Guides ─────────────────────────────────────────────────────
    [
        'title'    => 'Viking Professional vs. Tuscany Series Range: What\'s the Difference?',
        'slug'     => 'viking-professional-vs-tuscany-range-comparison',
        'cat'      => 'buying-guides',
        'focuskw'  => 'Viking Professional vs Tuscany range',
        'image'    => get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png',
        'image_alt'=> 'Viking Professional Series and Tuscany Series range comparison',
        'excerpt'  => 'Viking\'s product lineup can be confusing at first glance. Here\'s a clear breakdown of the differences between the Professional and Tuscany series — and which one belongs in your kitchen.',
        'content'  => <<<HTML
<p>Viking offers several residential range series with meaningfully different designs, feature sets, and price points. If you are considering a Viking range purchase — or trying to understand what you already own — this guide explains the key differences between the Professional Series and Tuscany Series.</p>

<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png' ); ?>" alt="Viking Professional Series range comparison guide" loading="lazy"></figure>

<h2>Viking Professional Series</h2>
<p>The Professional Series is Viking's flagship residential range line and represents the core of their product lineup. Key characteristics:</p>
<ul>
    <li><strong>Design:</strong> Professional kitchen aesthetic with a commercial-inspired stainless steel finish. Available in multiple widths (30", 36", 48", 60").</li>
    <li><strong>Burners:</strong> Pro sealed burners with outputs designed for both high-BTU searing and precise low-heat simmering. SureSpark continuous re-ignition on select models ensures the burner relights automatically if the flame is extinguished.</li>
    <li><strong>Fuel types:</strong> Available as gas, dual-fuel (gas cooktop, electric oven), and all-gas configurations depending on the specific model in the range.</li>
    <li><strong>Oven:</strong> Vari-Speed Dual Flow convection oven system in higher-tier models. Self-clean with a motorized door lock (F9 fault relates to this mechanism).</li>
</ul>

<h2>Viking Tuscany Series</h2>
<p>The Tuscany Series is Viking's premium, heritage-design line with a distinctive aesthetic that references European professional range design. Key characteristics:</p>
<ul>
    <li><strong>Design:</strong> Bold color options, porcelain enamel finish on some models, and a heavier-duty overall appearance. Designed to be a visual centerpiece of the kitchen.</li>
    <li><strong>Burners:</strong> Viking Elevation Burners with a unique burner grate configuration that creates a natural landing zone for pots and reduces spill cleanup area.</li>
    <li><strong>Width options:</strong> Available in 30", 36", 48", and up to 60" configurations.</li>
    <li><strong>Price:</strong> Typically at a premium over the equivalent Professional Series width and configuration due to design complexity and finish options.</li>
</ul>

<h2>Which Series Is Right for You?</h2>
<p>For most kitchens, the Professional Series delivers the full Viking cooking experience at a somewhat more accessible price point. The Tuscany Series is the choice if the range is a design statement as much as a cooking tool — its aesthetic is distinctive and unmistakable in a premium kitchen.</p>
<p>From a service perspective, both series use similar oven control architecture (same F-code fault system) and compatible OEM parts. Whichever series you own, our technicians are trained on both and carry genuine Viking OEM parts for the full range lineup.</p>
<p>Already own a Viking range that needs service? <a href="/services/viking-range-repair/">View our Viking range repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>
HTML,
    ],

    // ── Cooktop Tips ──────────────────────────────────────────────────────
    [
        'title'    => 'Viking Gas Cooktop Burner Won\'t Ignite: 5 Things to Check',
        'slug'     => 'viking-cooktop-burner-wont-ignite-troubleshooting',
        'cat'      => 'cooktop',
        'focuskw'  => 'Viking cooktop burner won\'t ignite',
        'image'    => get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png',
        'image_alt'=> 'Viking gas cooktop pro sealed burners',
        'excerpt'  => 'A Viking cooktop burner that clicks but won\'t light — or won\'t click at all — has one of five likely causes. Here\'s how to work through them in order.',
        'content'  => <<<HTML
<p>Viking gas cooktop burner ignition problems are among the most common service calls we receive. The good news: in most cases the cause is straightforward and can often be resolved at home before a technician is needed. Here are the five most likely causes, in order of likelihood.</p>

<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png' ); ?>" alt="Viking gas cooktop burner ignition troubleshooting" loading="lazy"></figure>

<h2>1. Moisture Around the Burner</h2>
<p>Moisture is the most common cause of Viking cooktop ignition problems. When liquid boils over or condensation forms around a burner, it can enter the spark electrode area and cause the igniter to click continuously without lighting — or prevent it from sparking at all.</p>
<p><strong>Fix:</strong> Remove the burner cap and dry the area thoroughly with a cloth. Dry the electrode tip carefully. Leave the burner cap off and allow the area to air dry for at least 30 minutes. Reinstall and test. This resolves moisture-related ignition issues in the majority of cases.</p>

<h2>2. Clogged Burner Ports</h2>
<p>The flame ports around the circumference of the burner base can become clogged with food residue, particularly after cooking with sauces or starchy liquids. Clogged ports result in a weak, uneven flame — or in severe cases, no ignition at all because the gas cannot flow evenly around the burner.</p>
<p><strong>Fix:</strong> Remove the burner cap and clean each port hole using a straightened paper clip or small brush. Do not use water — dry cleaning only for clogged ports. For stubborn deposits, soak the burner cap in a mild dish soap solution and clean with a brush.</p>

<h2>3. Misaligned Burner Cap</h2>
<p>Viking pro sealed burners rely on the burner cap sitting flat and centered on the burner base. If the cap is slightly off-center or tilted after cleaning, the spark from the electrode will not reach the gas ports correctly, and the burner will not light reliably.</p>
<p><strong>Fix:</strong> Remove the burner cap, check the base for debris, and reseat the cap firmly and evenly. The cap should sit flush with no rocking.</p>

<h2>4. Failed Spark Electrode</h2>
<p>The spark electrode is the ceramic-tipped component that produces the ignition spark. If the electrode tip is cracked, heavily coated with carbon deposits, or the electrode itself has broken, no spark is generated regardless of how clean and dry the burner area is.</p>
<p><strong>Visual check:</strong> Inspect the electrode tip — it should be intact, off-white in color, and positioned approximately 1/8 inch from the burner base. A cracked or heavily discolored electrode requires replacement.</p>

<h2>5. Failed Ignition Module</h2>
<p>If a specific burner consistently fails to spark even after addressing all of the above, and the electrode is visually intact, the ignition module may have failed. The ignition module generates the high-voltage pulse that powers the spark. A failed module either produces no spark at all or an intermittent one.</p>
<p>Ignition module replacement is a professional repair. Our technicians carry Viking-compatible ignition modules and can complete this repair on the first visit. <a href="/services/viking-cooktop-repair/">View our Viking cooktop repair service</a> or <a href="/schedule/">book a repair appointment</a>.</p>
HTML,
    ],

]; // end $posts

/* ──────────────────────────────────────────────
   STEP 4 — Create/update posts
────────────────────────────────────────────── */
foreach ( $posts as $p ) {

    $existing = get_page_by_path( $p['slug'], OBJECT, 'post' );
    if ( $existing ) {
        WP_CLI::line( "  Post exists: {$p['title']}" );
        continue;
    }

    $post_id = wp_insert_post([
        'post_type'    => 'post',
        'post_title'   => $p['title'],
        'post_name'    => $p['slug'],
        'post_status'  => 'publish',
        'post_content' => $p['content'],
        'post_excerpt' => $p['excerpt'],
    ], true );

    if ( is_wp_error( $post_id ) ) {
        WP_CLI::warning( "  Failed to create: {$p['title']} — " . $post_id->get_error_message() );
        continue;
    }

    // Assign category
    $cat_slug = $p['cat'];
    if ( isset( $term_ids[ $cat_slug ] ) ) {
        wp_set_object_terms( $post_id, [ $term_ids[ $cat_slug ] ], 'blog_category' );
    }

    // Set Yoast focus keyword and meta if Yoast is active
    if ( defined('WPSEO_VERSION') && ! empty( $p['focuskw'] ) ) {
        update_post_meta( $post_id, '_yoast_wpseo_focuskw', $p['focuskw'] );
    }

    // Set featured image from local theme asset
    if ( ! empty( $p['image'] ) ) {
        update_post_meta( $post_id, '_ar_hero_image', $p['image'] );
    }

    WP_CLI::success( "  Created: {$p['title']} (ID: {$post_id})" );
}

WP_CLI::line( '' );
WP_CLI::success( 'Viking blog sample data import complete.' );


