<?php
/**
 * Blog Sample Data Import
 * Creates 8 sample blog posts across all categories.
 * Also creates the Blog page and sets it as the WordPress Posts page.
 *
 * USAGE (from WordPress root):
 *   wp eval-file wp-content/themes/wp-appliancerepair-theme/inc/blog-sample-data.php
 */

defined( 'ABSPATH' ) || die( 'Run via WP-CLI only.' );

WP_CLI::line( '' );
WP_CLI::line( '╔══════════════════════════════════════════════╗' );
WP_CLI::line( '║    ApplianceRepair — Blog Sample Data        ║' );
WP_CLI::line( '╚══════════════════════════════════════════════╝' );

/* ──────────────────────────────────────────────
   STEP 1 — Set up blog_category terms
────────────────────────────────────────────── */
$categories = [
    'washer'        => 'Washer Tips',
    'dryer'         => 'Dryer Tips',
    'refrigerator'  => 'Refrigerator Tips',
    'dishwasher'    => 'Dishwasher Tips',
    'oven-range'    => 'Oven / Range & Wall Oven',
    'maintenance'   => 'Maintenance',
    'buying-guides' => 'Buying Guides',
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

// Set up Reading settings
// Find or create a static front page
$front_page = get_page_by_path( 'home', OBJECT, 'page' );
if ( ! $front_page ) {
    // Look for existing front page option
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

    // ── Washer Tips
    [
        'title'    => 'Washer Won\'t Drain? 7 Causes and How to Fix Each One',
        'slug'     => 'washer-wont-drain-causes-fixes',
        'cat'      => 'washer',
        'focuskw'  => 'washer won\'t drain',
        'image'    => 'https://images.samsung.com/is/image/samsung/p6pim/us/wf53bb8700avus/gallery/us-wf8700b-wf53bb8700avus-549503516?$product-details-jpg',
        'image_alt'=> 'Samsung Front-Load Washer',
        'excerpt'  => 'Standing water in your washer is frustrating — and surprisingly common. Here are the seven most likely culprits and exactly what to do about each one.',
        'content'  => <<<HTML
<p>A Samsung washer that won't drain is one of the most common repair calls we receive — and one of the most fixable. When your washer won't drain and leaves standing water in the drum, the cause is almost always mechanical rather than electrical. The good news: most drain problems are fixable without a technician — if you know where to look.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/wf53bb8700avus/gallery/us-wf8700b-wf53bb8700avus-549503516?$product-details-jpg" alt="Samsung front-load washer won't drain troubleshooting guide" loading="lazy"></figure>

<h2>1. Clogged Drain Hose</h2>
<p>The drain hose runs from the back of your washer to the wall standpipe. Socks, lint, and small items can create a clog that completely blocks drainage.</p>
<p><strong>Fix:</strong> Disconnect the hose, flush it with water from a garden hose, and clear any blockage. Make sure the hose isn't kinked or pushed too far into the standpipe (no more than 6–8 inches).</p>

<h2>2. Blocked Pump Filter</h2>
<p>Most modern front-load washers have an accessible pump filter (usually behind a small door at the bottom front of the machine). Coins, buttons, and debris collect here and block the pump.</p>
<p><strong>Fix:</strong> Place a towel under the access door, open the filter cap slowly to drain residual water, then pull out the filter and clean it thoroughly under running water.</p>

<h2>3. Faulty Drain Pump</h2>
<p>If the filter is clear but the washer still won't drain, the pump itself may have failed. You'll often hear the motor humming without any water moving — or complete silence when the drain cycle should be running.</p>
<p><strong>Fix:</strong> This is a job for a technician. A pump replacement typically costs $150–$300 including parts and labor.</p>

<h2>4. Lid Switch Failure (Top-Load Washers)</h2>
<p>Top-load washers won't spin — and therefore won't drain properly — if the lid switch is broken. The machine thinks the lid is open even when it's closed.</p>
<p><strong>Fix:</strong> Test the switch with a multimeter. If it shows no continuity when the lid is closed, replace it. This is a straightforward DIY repair.</p>

<h2>5. Too Much Detergent (Sud Lock)</h2>
<p>Excess detergent creates so many suds that the machine's sensor detects an overflow risk and pauses the drain cycle. Many washers will display a "Sud" or "Sd" error code.</p>
<p><strong>Fix:</strong> Run an empty rinse-and-spin cycle to clear the suds. Going forward, use HE detergent in the correct quantity for your load size.</p>

<h2>6. Kinked or Incorrectly Installed Drain Hose</h2>
<p>If your drain hose has a sharp bend or is routed incorrectly, water can't escape. This is especially common after moving the machine.</p>
<p><strong>Fix:</strong> Pull the washer out, inspect the full length of the hose, and ensure smooth routing with no kinks. The end of the hose should be secured to the standpipe but not airtight.</p>

<h2>7. Error Code Points to a Control Board Issue</h2>
<p>In rare cases — especially in Samsung washers more than 10 years old — the control board stops sending the signal to the pump. You may see error codes like 5E, 5C, or SE on Samsung washers even after clearing all other issues.</p>
<p><strong>Fix:</strong> If you've ruled out all mechanical causes, call a technician. A control board replacement is complex and expensive — sometimes it makes more sense to replace the machine.</p>

<h2>When to Call a Professional for a Washer That Won't Drain</h2>
<p>If you've checked all of the above and your Samsung washer still won't drain — or if you hear grinding, burning smells, or the motor is completely silent — it's time to schedule a repair. Our certified technicians can diagnose the exact cause and have your washer draining again, often same day. <a href="/services/samsung-washer-repair/">View our Samsung washer repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>

<p>For Samsung error codes related to drain failures (5E, 5C, OE), see our <a href="/error-codes/washer/">Samsung washer error code guide</a>. For warranty and support questions, visit <a href="https://www.samsung.com/us/support/" target="_blank" rel="noopener noreferrer">Samsung's official support page</a>.</p>
HTML,
    ],

    // ── Refrigerator Tips
    [
        'title'    => 'Refrigerator Not Cooling? 8 Things to Check Before Calling a Tech',
        'slug'     => 'refrigerator-not-cooling-what-to-check',
        'cat'      => 'refrigerator',
        'focuskw'  => 'refrigerator not cooling',
        'image'    => 'https://images.samsung.com/is/image/samsung/p6pim/us/rf29bb8600qlaa/gallery/us-4-door-french-door-beverage-center-rf29bb8600qlaa-551019964?$product-details-jpg',
        'image_alt'=> 'Samsung 4-Door French Door Refrigerator',
        'excerpt'  => 'A warm fridge can mean spoiled food and hundreds in groceries lost. Before you call for service, run through these 8 diagnostic checks — several have simple DIY fixes.',
        'content'  => <<<HTML
<p>A Samsung refrigerator not cooling is a genuine emergency — perishable food is at risk within hours of the temperature rising. Before panicking about a costly refrigerator not cooling repair, work through this checklist — many causes are surprisingly simple and cost nothing to fix.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/rf29bb8600qlaa/gallery/us-4-door-french-door-beverage-center-rf29bb8600qlaa-551019964?$product-details-jpg" alt="Samsung French door refrigerator not cooling diagnosis guide" loading="lazy"></figure>

<h2>1. Check the Temperature Settings</h2>
<p>It sounds obvious, but temperature dials get bumped accidentally. Your fridge should be set to 35–38°F (1.7–3.3°C) and your freezer to 0°F (-18°C).</p>

<h2>2. Clean the Condenser Coils</h2>
<p>Dirty condenser coils are the #1 cause of poor cooling in older refrigerators. Coils clogged with dust and pet hair can't release heat efficiently, forcing the compressor to work harder until it fails.</p>
<p><strong>Location:</strong> Bottom front (behind a grille) or rear of the unit depending on model.</p>
<p><strong>Fix:</strong> Unplug the fridge, use a coil brush or vacuum with a brush attachment to remove dust. Do this every 6–30 days.</p>

<h2>3. Check Door Gaskets</h2>
<p>Worn or dirty door seals let warm air in constantly, preventing the fridge from maintaining temperature. Test by closing a piece of paper in the door — you should feel resistance pulling it out.</p>
<p><strong>Fix:</strong> Clean gaskets with warm soapy water. If the seal is cracked or no longer pliable, replace it ($30–80 for most models).</p>

<h2>4. Is the Condenser Fan Running?</h2>
<p>The condenser fan (near the compressor at the back) circulates air over the coils. If it's seized or failed, the fridge will gradually warm up.</p>
<p><strong>Fix:</strong> Open the rear panel (unplug first) and manually spin the fan blade. If it's stiff, replace the fan motor.</p>

<h2>5. Evaporator Fan Motor</h2>
<p>This fan circulates cold air from the freezer into the refrigerator compartment. If it fails, the freezer may stay cold while the fridge warms up — a classic symptom of evaporator fan failure.</p>
<p><strong>Diagnosis:</strong> Open the freezer and listen — you should hear the fan running. If there's silence or grinding, the motor likely needs replacing.</p>

<h2>6. Defrost System Failure</h2>
<p>Frost-free refrigerators run automatic defrost cycles. If the defrost heater, thermostat, or timer fails, frost builds up on the evaporator coils and blocks airflow entirely.</p>
<p><strong>Signs:</strong> Heavy frost in the freezer, fridge is warm despite freezer being cold, or you can hear the evaporator fan but feel no cold air coming through the vents.</p>

<h2>7. Compressor Issues</h2>
<p>The compressor is the heart of the refrigeration system. Signs of compressor problems include: the unit is completely silent (no humming), the compressor is unusually hot, or it starts and stops rapidly.</p>
<p><strong>Note:</strong> Compressor replacement is expensive ($400–800+). For refrigerators over 10 years old, replacement may be more cost-effective.</p>

<h2>8. Low Refrigerant</h2>
<p>While relatively rare in a properly functioning fridge, a refrigerant leak will cause gradual cooling loss. Signs include ice forming in unusual places or oily residue near the refrigerant lines.</p>
<p><strong>Fix:</strong> Refrigerant work requires an EPA-certified technician. This is not a DIY repair.</p>

<h2>Act Quickly When Your Refrigerator Is Not Cooling</h2>
<p>If your Samsung refrigerator is not cooling and you can't identify an easy fix, move perishables to a cooler immediately and schedule a repair. A refrigerator running warm and working hard will shorten compressor life significantly. <a href="/services/samsung-refrigerator-repair/">View our Samsung refrigerator repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>

<p>For error codes like 22E, 33E, or 14E that appear alongside cooling problems, see our <a href="/error-codes/refrigerator/">Samsung refrigerator error code guide</a>. The <a href="https://www.fda.gov/food/buy-store-serve-safe-food/food-safety-during-power-outage-and-after-flood" target="_blank" rel="noopener noreferrer">FDA's food safety guidelines</a> explain safe storage times when refrigeration is lost.</p>
HTML,
    ],

    // ── Dryer Tips
    [
        'title'    => 'Dryer Takes Too Long to Dry Clothes? 6 Causes (and One Hidden Fire Risk)',
        'slug'     => 'dryer-takes-too-long-to-dry',
        'cat'      => 'dryer',
        'focuskw'  => 'dryer takes too long to dry',
        'image'    => get_template_directory_uri() . '/assets/images/dryer.jpg',
        'image_alt'=> 'Samsung Electric Dryer with Steam',
        'excerpt'  => 'If your dryer is running for two or three cycles to dry a single load, something is wrong. Here\'s how to diagnose the cause — and why one of them is a genuine fire hazard.',
        'content'  => <<<HTML
<p>When your Samsung dryer takes too long to dry clothes — running 90+ minutes without finishing a load — it's costing you money and shortening the life of your machine. A dryer that takes too long to dry is also a warning sign of a condition that causes thousands of house fires every year. Here's exactly what's causing it.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/DVE53BB8700T/gallery/us-bespoke-4-door-flex-dryer-dve53bb8700t-front-silver-steel-537940558?$product-details-jpg" alt="Samsung dryer takes too long to dry — causes and fixes" loading="lazy"></figure>

<h2>1. Clogged Lint Trap</h2>
<p>This is the first thing to check. A lint trap that's even 50% blocked can significantly reduce drying efficiency. Clean it before every load — not just occasionally.</p>
<p><strong>Bonus tip:</strong> Every 6 months, wash the trap with warm soapy water to remove fabric softener buildup that creates an invisible film blocking airflow.</p>

<h2>2. Blocked Exhaust Duct — A Fire Hazard</h2>
<p>This is the most serious and most commonly overlooked cause. The exhaust duct carries hot, moist, lint-laden air from your dryer to the outside. When it's blocked or kinked, heat and moisture can't escape — and lint accumulation creates a genuine fire risk. The U.S. Fire Administration estimates dryers cause roughly 2,900 home fires per year, with failure to clean the dryer exhaust as the leading cause.</p>
<p><strong>Fix:</strong> Disconnect the duct from the back of the dryer and from the wall. Use a dryer duct cleaning brush kit (available for $20–30) to clear the entire run. While you're at it, check that the exterior vent flap opens freely when the dryer runs.</p>
<p><strong>Replace plastic or foil flex duct</strong> with rigid metal duct — it's safer and more efficient.</p>

<h2>3. Duct Is Too Long or Has Too Many Bends</h2>
<p>Every 90-degree elbow in the exhaust duct adds resistance equivalent to roughly 5 feet of straight duct. Most dryers are rated for a maximum effective duct length of 25–35 feet. If your duct run is too long or has multiple bends, airflow is restricted even when the duct is clean.</p>

<h2>4. Faulty Heating Element (Electric) or Igniter (Gas)</h2>
<p>If the dryer runs but produces no heat — or very little heat — the heating element has likely failed (electric) or the igniter/gas valve coils need replacing (gas).</p>
<p><strong>Test:</strong> A load of towels should feel noticeably warm to the touch well before the cycle ends. If the drum feels barely warm after 15 minutes, heating system diagnosis is needed.</p>

<h2>5. Cycling Thermostat Failure</h2>
<p>The cycling thermostat regulates drum temperature. When it fails in the "open" position, the heating element won't come on consistently — leading to long, ineffective cycles.</p>
<p><strong>Fix:</strong> Test with a multimeter for continuity. A replacement thermostat costs $10–25 for most models.</p>

<h2>6. Overloaded Drum</h2>
<p>Dryers need airflow to work. Overstuffing a load prevents tumbling and traps moisture. For large loads, dry in two batches — it will actually take less total time.</p>
<p><strong>Rule of thumb:</strong> The drum should be no more than 2/3 full after adding your wet laundry.</p>

<h2>Fix Your Dryer That Takes Too Long — Professional Service</h2>
<p>Even if your Samsung dryer currently seems to dry eventually, a dryer that takes too long is heading toward a complete failure — or worse, a fire. Inspect and clean the exhaust duct at least once a year. For heating element failure, thermostat issues, or persistent vent blockages, <a href="/services/samsung-dryer-repair/">our Samsung dryer repair service</a> resolves the issue same day in most cases. <a href="/schedule/">Book a repair appointment online</a>.</p>

<p>The <a href="https://www.usfa.fema.gov/prevention/home-fires/dryers/" target="_blank" rel="noopener noreferrer">U.S. Fire Administration's dryer fire prevention guide</a> outlines best practices for safe dryer operation. For Samsung dryer error codes related to heating and airflow, see our <a href="/error-codes/dryer/">Samsung dryer error code reference</a>.</p>
HTML,
    ],

    // ── Dishwasher Tips
    [
        'title'    => 'Dishwasher Not Cleaning Dishes Properly? Here\'s the Fix',
        'slug'     => 'dishwasher-not-cleaning-properly',
        'cat'      => 'dishwasher',
        'focuskw'  => 'dishwasher not cleaning',
        'image'    => 'https://images.samsung.com/is/image/samsung/p6pim/us/dw80cg5450sraa/gallery/us-dw5000c-568155-dw80cg5450sraa-549557202?$product-details-jpg',
        'image_alt'=> 'Samsung StormWash Dishwasher Stainless Steel',
        'excerpt'  => 'Still scrubbing dishes after the cycle? Before blaming the machine, check these common culprits — most are DIY fixes that take under 15 minutes.',
        'content'  => <<<HTML
<p>A Samsung dishwasher not cleaning dishes properly is one of the most common appliance complaints we see. When your dishwasher is not cleaning dishes, the cause is almost always one of a handful of simple issues — not a failed machine. The good news: most dishwasher not cleaning problems are fixable in under 15 minutes.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/dw80cg5450sraa/gallery/us-dw5000c-568155-dw80cg5450sraa-549557202?$product-details-jpg" alt="Samsung dishwasher not cleaning dishes — causes and fixes" loading="lazy"></figure>

<h2>1. Spray Arms Are Clogged</h2>
<p>The upper and lower spray arms have small holes that jet water onto your dishes. Mineral deposits, food particles, and broken glass can clog these holes and dramatically reduce cleaning performance.</p>
<p><strong>Fix:</strong> Remove the spray arms (they typically twist off). Use a toothpick or small brush to clear each hole. Soak in white vinegar for 15–30 minutes to dissolve mineral deposits, then rinse thoroughly before reinstalling.</p>

<h2>2. Wrong or Too Little Detergent</h2>
<p>Dishwasher detergent degrades over time. Old, clumped detergent doesn't dissolve or clean properly. Also, using too little in hard water areas is a common mistake.</p>
<p><strong>Fix:</strong> Use a fresh supply of high-quality detergent pods or powder. If you have hard water, add rinse aid and consider a water softener solution.</p>

<h2>3. Filter Is Dirty</h2>
<p>Most modern dishwashers have a manual filter at the bottom of the tub. A filter clogged with grease and food debris recirculates dirty water — preventing your dishes from getting clean no matter how long the cycle runs.</p>
<p><strong>Fix:</strong> Twist out the filter cylinder, remove the flat filter beneath it, and wash both under warm water with a soft brush and dish soap. Do this monthly.</p>

<h2>4. Water Temperature Is Too Low</h2>
<p>Dishwashers need water to be at least 120°F (49°C) to activate detergent and sanitize dishes. If your hot water heater is set too low, or if the dishwasher is at the end of a long pipe run, water arrives too cool.</p>
<p><strong>Fix:</strong> Run your kitchen hot water tap until it's hot before starting a cycle. Check your water heater is set to at least 120°F.</p>

<h2>5. Improper Loading</h2>
<p>This is more impactful than most people realize. Dishes blocking spray arms, nested bowls, or items covering the detergent dispenser will all cause poor results.</p>
<p><strong>Key rules:</strong></p>
<ul>
<li>Cups and bowls face down and angled for drainage</li>
<li>Nothing blocks the spray arm rotation path</li>
<li>Heavily soiled items face the center where spray intensity is highest</li>
<li>Don't nest bowls or plates directly against each other</li>
</ul>

<h2>6. Spray Arm Bearing Ring Worn</h2>
<p>If the lower spray arm wobbles or doesn't spin freely, the bearing ring may be worn. A wobbly spray arm won't distribute water evenly.</p>
<p><strong>Fix:</strong> Inspect the hub the arm attaches to. Replacement bearing rings cost $5–15 and are easy to swap.</p>

<h2>Run a Monthly Maintenance Cycle to Prevent Dishwasher Not Cleaning Issues</h2>
<p>Pour 2 cups of white vinegar into a bowl on the bottom rack and run a hot cycle without detergent. Follow with a cycle using a cup of baking soda on the bottom. This removes odors, mineral buildup, and grease from internal components that cause dishwasher not cleaning problems.</p>

<p>If your Samsung dishwasher still isn't cleaning after these fixes, <a href="/services/samsung-dishwasher-repair/">our Samsung dishwasher repair service</a> can diagnose and resolve the issue same day. For error codes like 5C, 4C, or OC, see our <a href="/error-codes/dishwasher/">Samsung dishwasher error code reference</a>. The <a href="https://www.energy.gov/energysaver/dishwashers" target="_blank" rel="noopener noreferrer">U.S. Department of Energy's dishwasher efficiency guide</a> covers best practices for water temperature and detergent usage.</p>
HTML,
    ],

    // ── Oven & Cooktop
    [
        'title'    => 'Oven Not Heating to the Right Temperature? How to Diagnose and Fix It',
        'slug'     => 'oven-not-heating-correctly-diagnosis-fix',
        'cat'      => 'oven-range',
        'focuskw'  => 'oven not heating',
        'image'    => 'https://images.samsung.com/is/image/samsung/p6pim/us/ne63a6511ss-aa/gallery/us-ne5000ane63a6511sg-568542-ne63a6511ss-aa-549604738?$product-details-jpg',
        'image_alt'=> 'Samsung Freestanding Electric Range with Air Fry',
        'excerpt'  => 'Burnt on the outside, raw in the middle — or everything takes twice as long as the recipe says. Oven temperature problems have a few well-known causes. Here\'s how to diagnose yours.',
        'content'  => <<<HTML
<p>A Samsung oven not heating to the correct temperature causes everything from undercooked meat to burned baked goods. When your oven is not heating correctly, the problem is almost always one of a handful of well-understood causes — most of which are straightforward to diagnose and repair.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/ne63a6511ss-aa/gallery/us-ne5000ane63a6511sg-568542-ne63a6511ss-aa-549604738?$product-details-jpg" alt="Samsung oven not heating to correct temperature — diagnosis guide" loading="lazy"></figure>

<h2>How to Confirm Your Oven Has a Temperature Problem</h2>
<p>Before assuming something is broken, verify the issue with an oven thermometer ($10 at any hardware store). Preheat your oven to 350°F and check the thermometer after 20 minutes. A variation of ±25°F is normal. More than that indicates a genuine problem.</p>

<h2>1. Temperature Sensor Failure</h2>
<p>Electric ovens use a temperature sensor (also called an RTD probe) to monitor internal temperature and regulate the heating element. When it fails, the oven either over- or under-heats, often wildly.</p>
<p><strong>Test:</strong> The sensor is a thin probe that mounts inside the oven cavity (usually at the back upper corner). At room temperature, it should measure approximately 1,080–1,100 ohms resistance. Consult your model's service manual for exact specs. A broken or disconnected sensor is an easy DIY replacement ($20–50 part).</p>

<h2>2. Heating Element Failure (Electric)</h2>
<p>Electric oven heating elements — both the bake element (bottom) and broil element (top) — can fail partially or completely. Signs of a failing bake element include uneven baking, visible burn marks, or the element simply not glowing red during a bake cycle.</p>
<p><strong>Fix:</strong> Replacement is straightforward — most elements simply unscrew and unplug from the back wall. Parts cost $20–60 for most models.</p>

<h2>3. Igniter Weakness (Gas Ovens)</h2>
<p>The most common cause of temperature problems in gas ovens is a weak igniter. As igniters age, they draw less current — still enough to glow and ignite the gas, but the gas valve requires a certain current threshold to fully open. A weak igniter causes the oven to take very long to preheat or run cooler than set.</p>
<p><strong>Fix:</strong> If your gas oven takes more than 5–7 minutes to preheat to 350°F, the igniter is likely the culprit. Replacement is a relatively straightforward repair ($40–80 part).</p>

<h2>4. Oven Needs Calibration</h2>
<p>Sometimes the oven isn't broken — it's just factory-calibrated slightly off. Most modern ovens allow temperature calibration adjustments of ±35°F directly from the control panel.</p>
<p><strong>How:</strong> Consult your owner's manual for the calibration procedure. It typically involves pressing and holding specific buttons to access the calibration menu.</p>

<h2>5. Control Board Failure</h2>
<p>If the oven cycles erratically, heats unpredictably, or shows unusual error codes, the control board may have failed. This is more expensive to repair — boards typically cost $150–400.</p>
<p><strong>Decision point:</strong> For an oven under 5 years old, repair makes sense. For an oven 10+ years old, compare the repair cost against a new unit before committing.</p>

<h2>One More Thing: Door Seal and Oven Not Heating Fixes</h2>
<p>A worn or damaged door gasket lets heat escape, contributing to oven not heating problems. Inspect the seal around the door — it should be firm, uncracked, and form a complete seal when the door is closed. Replacement seals cost $20–50 and install in minutes.</p>

<p>If your Samsung oven is still not heating after these checks, <a href="/services/samsung-oven-repair/">our Samsung oven and range repair service</a> covers all models same day. For SE, F-23, and tE error codes that appear alongside heating issues, see our <a href="/error-codes/oven-range/">Samsung range error code guide</a>. <a href="/schedule/">Schedule a repair online</a> or call us directly.</p>

<p>For gas oven safety information, the <a href="https://www.nfpa.org/education-and-research/home-fire-safety/cooking" target="_blank" rel="noopener noreferrer">NFPA's cooking safety guidelines</a> provide authoritative guidance on safe appliance operation.</p>
HTML,
    ],

    // ── Maintenance
    [
        'title'    => '10 Appliance Maintenance Tasks That Prevent 90% of Repairs',
        'slug'     => 'appliance-maintenance-tasks-prevent-repairs',
        'cat'      => 'maintenance',
        'focuskw'  => 'appliance maintenance',
        'image'    => 'https://images.samsung.com/is/image/samsung/p6pim/us/rs27t5200sr-aa/gallery/us-ref-sbs-rs5300-569370-rs27t5200sr-aa-549692350?$product-details-jpg',
        'image_alt'=> 'Samsung Home Appliances — Washer, Dryer, Refrigerator',
        'excerpt'  => 'Most appliance breakdowns aren\'t random — they\'re the predictable result of skipped maintenance. These 10 tasks take less than an hour a year and prevent the most common (and expensive) failures.',
        'content'  => <<<HTML
<p>Regular Samsung appliance maintenance is the single most cost-effective thing you can do to extend the life of your appliances. After years of repairing appliances, we can confirm: most breakdowns aren't random failures — they're the entirely predictable result of deferred appliance maintenance. Here are the 10 tasks that prevent the vast majority of repair calls.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/rs27t5200sr-aa/gallery/us-ref-sbs-rs5300-569370-rs27t5200sr-aa-549692350?$product-details-jpg" alt="Samsung appliance maintenance guide — prevent repairs" loading="lazy"></figure>

<h2>1. Clean Refrigerator Condenser Coils — Every 6–30 Days</h2>
<p>Dirty condenser coils are the #1 preventable cause of refrigerator compressor failure. The compressor works harder to compensate for reduced heat dissipation, running hotter and wearing out faster. A $0 cleaning brush and 15 minutes once a year can add years to your refrigerator's life.</p>

<h2>2. Clean the Dryer Exhaust Duct — Every 30 Days</h2>
<p>We've said it before: lint buildup in exhaust ducts is a fire hazard and the primary cause of long drying times. Use a dryer duct cleaning brush kit to clear the full run annually. Check the exterior vent cap while you're at it.</p>

<h2>3. Clean the Washer Pump Filter — Every 3 Months</h2>
<p>Front-load washers have a pump filter (usually behind a small access door at the bottom). Clearing it regularly prevents drain failures and the musty odors that develop when trapped debris decomposes.</p>

<h2>4. Run a Washer Cleaning Cycle — Monthly</h2>
<p>Use a washer cleaner tablet or 2 cups of white vinegar in an empty hot cycle. This prevents mold, mildew, and detergent buildup that causes odors and reduces cleaning performance.</p>

<h2>5. Clean Dishwasher Filter — Monthly</h2>
<p>Manual-clean dishwasher filters (standard on most modern machines) need monthly attention. A blocked filter recirculates dirty water across your dishes. Takes 5 minutes.</p>

<h2>6. Check and Replace Refrigerator Water Filter — Every 6 Months</h2>
<p>A clogged water filter reduces flow to the ice maker and water dispenser. More importantly, a filter past its service life stops removing contaminants. Most refrigerators have a reminder light — trust it.</p>

<h2>7. Level Your Washer and Dishwasher — Annually</h2>
<p>Appliances that vibrate excessively due to being unlevel wear bearings, shock absorbers, and suspension components far faster. Use a spirit level and adjust the feet until the machine is stable with no rocking.</p>

<h2>8. Inspect and Clean Oven Door Gasket — Every 6 Months</h2>
<p>A damaged oven door seal causes heat loss and uneven cooking — and if left unchecked, the excessive heat near the door can warp the door hinges over time. Clean the gasket with warm soapy water; replace it if it's cracked or no longer pliable.</p>

<h2>9. Clean Refrigerator Door Gaskets — Monthly</h2>
<p>Dirty or sticky door seals don't seal properly. Clean them with warm water and a mild soap. If the gasket is torn, replace it — a fridge working against a bad seal consumes 25–50% more energy.</p>

<h2>10. Check Gas Appliance Connections — Annually</h2>
<p>If you have gas appliances, apply a solution of soapy water to each connection point at the back of the appliance and at the wall shutoff. Bubbling indicates a leak requiring immediate attention. Never use a flame to check for leaks.</p>

<h2>Build a Simple Appliance Maintenance Calendar</h2>
<p>The key to effective Samsung appliance maintenance is making these tasks habitual rather than reactive. Set four recurring calendar reminders per year (one per season) and assign 2–3 tasks to each. In under two hours a year, you'll prevent the most common — and most expensive — appliance failures.</p>

<p>When appliance maintenance isn't enough and a repair is needed, our certified technicians cover all Samsung appliances: <a href="/services/samsung-washer-repair/">washer repair</a>, <a href="/services/samsung-dryer-repair/">dryer repair</a>, <a href="/services/samsung-refrigerator-repair/">refrigerator repair</a>, and more. <a href="/schedule/">Book a service appointment online</a>.</p>

<p>For manufacturer maintenance recommendations, <a href="https://www.samsung.com/us/support/" target="_blank" rel="noopener noreferrer">Samsung's support portal</a> provides model-specific maintenance schedules for all Samsung appliances.</p>
HTML,
    ],


    [
        'title'    => 'Best Samsung Washing Machines: How to Choose the Right One',
        'slug'     => 'best-samsung-washing-machines-buying-guide',
        'cat'      => 'buying-guides',
        'focuskw'  => 'Samsung washing machines',
        'image'    => get_template_directory_uri() . '/assets/images/washer.jpg',
        'image_alt'=> 'Samsung front-load washing machine buying guide',
        'excerpt'  => 'Choosing a Samsung washer can be overwhelming with so many models available. This guide breaks down the key differences between front-load and top-load models, capacity options, and features worth paying for.',
        'content'  => <<<HTML
<p>Samsung washing machines offer one of the widest lineups on the market — but that variety can make choosing the right Samsung washing machine difficult. This guide cuts through the noise and helps you find the best Samsung washing machine for your household.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/wf53bb8700avus/gallery/us-wf8700b-wf53bb8700avus-549503516?$product-details-jpg" alt="Samsung washing machines buying guide — front-load and top-load comparison" loading="lazy"></figure>

<h2>Front-Load vs. Top-Load: Which Is Better?</h2>
<p>Front-load washers use less water, are gentler on fabrics, and have higher spin speeds that reduce drying time. Top-load washers with agitators are faster per cycle and easier to load without bending. Samsung's top-load impeller models (no agitator) offer a middle ground with large capacity and gentler washing.</p>

<h2>Capacity: What Size Do You Need?</h2>
<p>A family of four typically needs at least 4.5 cu. ft. Samsung's mid-range models start at 4.5 cu. ft., while their large-capacity units reach 5.5 cu. ft. — enough for king-size comforters and bulky items without multiple loads.</p>

<h2>Features Worth Paying For</h2>
<p>Steam wash eliminates allergens and sanitizes without harsh chemicals. The AddWash door on select front-loaders lets you add forgotten items mid-cycle. Wi-Fi connectivity via SmartThings lets you start, monitor, and troubleshoot from your phone — genuinely useful, not just a gimmick.</p>

<h2>Features You Can Skip</h2>
<p>Built-in sink attachments and pedestal drawers add cost without proportional value for most households. Stick to core capacity and wash performance specs.</p>

<h2>Reliability Note</h2>
<p>Samsung front-loaders from 2019 onward have significantly improved door boot seal durability — an issue in earlier generations. If buying used, check the model year carefully.</p>

<h2>Our Recommendation for Samsung Washing Machines</h2>
<p>For most families: the Samsung WF45R6100AW (front-load, 4.5 cu. ft.) hits the sweet spot of capacity, efficiency, and price. For large households: the WF53BB8700AV (5.3 cu. ft. with steam and SmartThings) justifies the premium. Browse the <a href="https://www.samsung.com/us/home-appliances/washers/" target="_blank" rel="noopener noreferrer">full Samsung washing machine lineup on Samsung.com</a>.</p>

<p>Already own a Samsung washer that needs repair? Our <a href="/services/samsung-washer-repair/">Samsung washer repair service</a> covers all models — <a href="/schedule/">book online</a> for same-day availability.</p>
HTML,
    ],
    [
        'title'    => 'Samsung Refrigerator Buying Guide: French Door vs. Side-by-Side vs. Bottom Freezer',
        'slug'     => 'samsung-refrigerator-buying-guide',
        'cat'      => 'buying-guides',
        'focuskw'  => 'Samsung refrigerator buying guide',
        'image'    => 'https://images.samsung.com/is/image/samsung/p6pim/us/rs27t5200sr-aa/gallery/us-ref-sbs-rs5300-569370-rs27t5200sr-aa-549692350?$product-details-jpg',
        'image_alt'=> 'Samsung refrigerator models comparison — French door, side-by-side, bottom freezer',
        'excerpt'  => 'Not sure which Samsung refrigerator style is right for your kitchen? We compare French door, side-by-side, and bottom freezer configurations so you can make an informed decision.',
        'content'  => <<<HTML
<p>This Samsung refrigerator buying guide compares the three main Samsung refrigerator configurations so you can make an informed decision. The style of Samsung refrigerator you choose affects your daily routine more than almost any other appliance decision — here's how each option compares.</p>

<figure><img src="https://images.samsung.com/is/image/samsung/p6pim/us/rs27t5200sr-aa/gallery/us-ref-sbs-rs5300-569370-rs27t5200sr-aa-549692350?$product-details-jpg" alt="Samsung refrigerator buying guide — French door vs side-by-side vs bottom freezer" loading="lazy"></figure>

<h2>French Door Refrigerators</h2>
<p>French door models put the fresh food section at eye level with two narrow doors — reducing cold air loss since you only open one side at a time. The bottom freezer drawer is deep and organized. Best for: households that cook frequently and prioritize fresh food access.</p>

<h2>Side-by-Side Refrigerators</h2>
<p>Both the fridge and freezer run full height, split vertically. You get eye-level access to frozen items — ideal if you use the freezer as much as the fridge. The tradeoff: narrower shelves make storing wide items (sheet cakes, pizza boxes) difficult. Best for: households with heavy freezer use or kitchens where a large single door would obstruct a walkway.</p>

<h2>Bottom Freezer Refrigerators</h2>
<p>The simplest and most energy-efficient configuration. The full-width fridge is at eye level; the freezer pulls out as a drawer below. Samsung's bottom freezer models tend to be the most affordable in the lineup. Best for: smaller households or buyers prioritizing energy efficiency and price.</p>

<h2>Key Specs to Compare</h2>
<p>Look beyond total capacity to usable capacity — interior layout matters. Check door swing clearance for your kitchen layout. For Samsung specifically, confirm the water filter location (some models require annual filter replacements that cost $40–60).</p>

<h2>Counter-Depth vs. Standard Depth Samsung Refrigerators</h2>
<p>Counter-depth Samsung refrigerators align flush with your cabinets for a built-in look but sacrifice roughly 20% of interior volume. Samsung offers counter-depth versions of most popular models at a $200–400 premium. Browse the <a href="https://www.samsung.com/us/home-appliances/refrigerators/" target="_blank" rel="noopener noreferrer">full Samsung refrigerator lineup on Samsung.com</a>.</p>

<p>Already own a Samsung refrigerator that needs service? Our <a href="/services/samsung-refrigerator-repair/">Samsung refrigerator repair service</a> covers all models and configurations. For ice maker error codes (40E, 41E, 8E), see our <a href="/error-codes/refrigerator/">Samsung refrigerator error code guide</a>. <a href="/schedule/">Book a repair online</a>.</p>
HTML,
    ],
    [
        'title'    => 'Samsung Dishwasher Buying Guide: What the Specs Actually Mean',
        'slug'     => 'samsung-dishwasher-buying-guide',
        'cat'      => 'buying-guides',
        'focuskw'  => 'Samsung dishwasher buying guide',
        'image'    => get_template_directory_uri() . '/assets/images/product-dishwasher.jpg',
        'image_alt'=> 'Samsung dishwasher buying guide — understanding specs and features',
        'excerpt'  => 'Dishwasher specs are full of marketing terms that don\'t tell you much. This guide decodes the numbers and features that actually affect cleaning performance, noise, and long-term reliability.',
        'content'  => <<<HTML
<p>This Samsung dishwasher buying guide cuts through the marketing language on spec sheets so you can focus on the numbers and features that actually affect cleaning performance, noise, and long-term reliability.</p>

<figure>
<img src="/wp-content/themes/wp-appliancerepair-theme/assets/images/product-dishwasher.jpg" alt="Samsung dishwasher buying guide — understanding specs and features" width="800" height="533" loading="lazy">
</figure>

<h2>Place Settings: The Real Capacity Metric</h2>
<p>Capacity is measured in "place settings" — each representing a full set of dishes, glasses, and cutlery for one person. Samsung's standard-width (24") dishwashers range from 13 to 15 place settings. For families of 4+, aim for 14 or more.</p>

<h2>dBA Rating: How Quiet Is Quiet?</h2>
<p>Noise is measured in decibels (dBA). Under 45 dBA is considered quiet — you can hold a conversation nearby without raising your voice. Samsung's premium models reach 39 dBA. The difference between 44 dBA and 48 dBA is noticeable if your kitchen is open to a living area.</p>

<h2>Wash Cycles That Matter</h2>
<p>Every Samsung dishwasher includes Normal, Heavy, and Quick cycles — those are sufficient for 90% of loads. Auto-sense cycles (using soil sensors) are genuinely useful for mixed loads. Sanitize cycles reach 155°F to eliminate bacteria — worth having if you have young children or immunocompromised family members.</p>

<h2>Third Rack: More Useful Than It Sounds</h2>
<p>A third rack at the top of the tub handles utensils, small lids, and measuring cups — freeing up the basket and lower rack for more dishes. Samsung's StormWash+ models include a full-coverage third rack with dedicated spray coverage.</p>

<h2>The Spec That Doesn't Matter Much</h2>
<p>Number of spray arms beyond two adds marginal cleaning improvement. Most of the difference in cleaning performance comes from water pressure and wash algorithm, not additional spray arms.</p>

<h2>Reliability and Repair Costs</h2>
<p>The most common Samsung dishwasher failures are the door latch, control board, and drain pump — all serviceable parts. Repair costs typically run $150–350. When comparing models, factor in parts availability: Samsung's stainless tub models have better long-term parts support than the plastic-tub budget line. The <a href="https://www.energystar.gov/productfinder/product/certified-residential-dishwashers/" target="_blank" rel="noopener noreferrer">ENERGY STAR certified dishwasher database</a> is a useful reference for comparing efficiency ratings across models.</p>

<p>Already own a Samsung dishwasher that needs service? Our <a href="/services/samsung-dishwasher-repair/">Samsung dishwasher repair service</a> covers all models. For error codes like OC, CE, or nE, see our <a href="/error-codes/dishwasher/">Samsung dishwasher error code guide</a>. <a href="/schedule/">Book a repair online</a>.</p>
HTML,
    ],

];
/* ──────────────────────────────────────────────
   STEP 3 — Insert posts
────────────────────────────────────────────── */
WP_CLI::line( '' );
WP_CLI::line( 'Importing blog posts...' );

$created = 0;
$updated = 0;

foreach ( $posts as $p ) {
    // Check for existing post by slug
    $existing_posts = get_posts([
        'name'        => $p['slug'],
        'post_type'   => 'post',
        'post_status' => 'any',
        'numberposts' => 1,
    ]);

    $post_data = [
        'post_type'    => 'post',
        'post_title'   => $p['title'],
        'post_name'    => $p['slug'],
        'post_content' => $p['content'],
        'post_excerpt' => $p['excerpt'],
        'post_status'  => 'publish',
    ];

    if ( $existing_posts ) {
        $post_data['ID'] = $existing_posts[0]->ID;
        $post_id = wp_update_post( $post_data );
        $updated++;
        WP_CLI::success( "Updated: {$p['title']} (ID: {$post_id})" );
    } else {
        $post_id = wp_insert_post( $post_data, true );
        if ( is_wp_error( $post_id ) ) {
            WP_CLI::error( "Failed: {$p['title']} — " . $post_id->get_error_message(), false );
            continue;
        }
        $created++;
        WP_CLI::success( "Created: {$p['title']} (ID: {$post_id})" );
    }

    // Assign blog_category
    if ( isset( $term_ids[ $p['cat'] ] ) ) {
        wp_set_object_terms( $post_id, $term_ids[ $p['cat'] ], 'blog_category' );
    }

    // ── Featured image: sideload from URL if not already set ──────────────
    if ( ! empty( $p['image'] ) ) {
        // Always store the raw URL as meta (used as fallback in templates)
        update_post_meta( $post_id, '_post_image_url',  $p['image'] );
        update_post_meta( $post_id, '_post_image_alt',  $p['image_alt'] ?? $p['title'] );

        // Only sideload into Media Library if no thumbnail is already attached
        if ( ! has_post_thumbnail( $post_id ) ) {
            require_once ABSPATH . 'wp-admin/includes/media.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';

            $attachment_id = media_sideload_image( $p['image'], $post_id, $p['image_alt'] ?? $p['title'], 'id' );

            if ( is_wp_error( $attachment_id ) ) {
                WP_CLI::warning( "  Could not sideload image for: {$p['title']} — " . $attachment_id->get_error_message() );
                WP_CLI::line(    "  Falling back to _post_image_url meta: {$p['image']}" );
            } else {
                set_post_thumbnail( $post_id, $attachment_id );
                WP_CLI::success( "  Featured image set (attachment ID: {$attachment_id})" );
            }
        }
    }

    // SEO meta
    $meta_title = $p['title'] . ' | ' . get_bloginfo( 'name' );
    update_post_meta( $post_id, '_yoast_wpseo_title',    $meta_title );
    update_post_meta( $post_id, '_yoast_wpseo_metadesc', $p['excerpt'] );
    update_post_meta( $post_id, 'rank_math_title',        $meta_title );
    update_post_meta( $post_id, 'rank_math_description',  $p['excerpt'] );
    if ( ! empty( $p['focuskw'] ) ) {
        update_post_meta( $post_id, '_yoast_wpseo_focuskw',    $p['focuskw'] );
        update_post_meta( $post_id, 'rank_math_focus_keyword', $p['focuskw'] );
    }
}

flush_rewrite_rules();

WP_CLI::line( '' );
WP_CLI::line( '╔══════════════════════════════════════════════╗' );
WP_CLI::line( '║                   SUMMARY                   ║' );
WP_CLI::line( '╠══════════════════════════════════════════════╣' );
WP_CLI::line( sprintf( '║  Categories  : 7 terms                       ║' ) );
WP_CLI::line( sprintf( '║  Created     : %-33d║', $created ) );
WP_CLI::line( sprintf( '║  Updated     : %-33d║', $updated ) );
WP_CLI::line( '╚══════════════════════════════════════════════╝' );
WP_CLI::line( '' );
WP_CLI::success( 'Done. Visit /blog/ — go to Settings → Permalinks → Save Changes if you get a 404.' );