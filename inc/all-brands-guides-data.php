<?php
/**
 * Samsung Guides Content Data
 *
 * Brand:      Samsung only
 * Appliances: Washer, Dryer, Refrigerator, Dishwasher,
 *             Oven / Range, Microwave, Wall Oven
 *
 * Each guide covers real US repair scenarios and maps directly to:
 *   - Services defined in all-brands-content-data.php
 *   - Error codes defined in all-brands-error-codes-data.php
 *
 * Guide types per appliance:
 *   1. Troubleshooting (symptom-driven diagnosis)
 *   2. Error code deep-dive (code-specific)
 *   3. Repair vs Replace
 *   4. Maintenance
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_guides_data(): array {
    $guides = array_merge(
        ar_guides_samsung_washer(),
        ar_guides_samsung_dryer(),
        ar_guides_samsung_refrigerator(),
        ar_guides_samsung_dishwasher(),
        ar_guides_samsung_oven_range(),
        ar_guides_samsung_microwave(),
        ar_guides_samsung_wall_oven(),
        ar_guides_samsung_cross()
    );

    // Automatically hoist the top-level 'image' key into meta_fields as '_ar_image'
    // so importers and set_post_meta calls only need to iterate meta_fields.
    foreach ( $guides as &$guide ) {
        if ( ! empty( $guide['image'] ) ) {
            $guide['meta_fields']['_ar_image'] = $guide['image'];
        }
    }
    unset( $guide );

    return $guides;
}

// ─────────────────────────────────────────────────────────────────────────────
// WASHER GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_washer(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Washer Not Draining — 5E, 5C, ND Error Causes & Fixes',
            'slug'       => 'samsung-washer-not-draining',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/wf53bb8700avus/gallery/us-wf8700b-wf53bb8700avus-549503516?$product-details-jpg$',
            'meta_title' => 'Samsung Washer Not Draining — 5E / 5C / ND Error Complete Fix Guide',
            'meta_desc'  => 'Samsung washer not draining or showing 5E, 5C, or ND? This guide covers every cause — pump filter, drain hose, failed pump — with step-by-step fixes.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I manually drain a Samsung washer with standing water?', 'answer' => 'On front-load Samsung washers, use the emergency drain tube located next to the pump filter behind the small access panel at the front bottom of the machine. Remove the cap over a shallow pan or towels to gravity-drain the tub before cleaning the filter. On top-load models, a Spin Only or Drain & Spin cycle will attempt to pump out water; if the pump has completely failed, bail water manually.' ],
                    [ 'question' => 'How often should I clean the Samsung washer pump filter?', 'answer' => 'Samsung recommends monthly cleaning. Households with high laundry volume or pets should clean every two weeks. A clogged pump filter is responsible for the majority of 5E drain errors and accelerates premature pump motor failure if left unaddressed.' ],
                    [ 'question' => 'My Samsung washer shows 5E after every cycle — what is wrong?', 'answer' => 'Persistent 5E after every cycle (not just occasionally) points to a partially blocked filter that is restricting flow enough to time out the drain, or to a drain hose that is incorrectly routed (sealed into the standpipe, creating a siphon, or lacking the required high loop). If the filter is clean and the hose is correctly installed, the drain pump motor is beginning to fail.' ],
                    [ 'question' => 'Can a kinked drain hose cause Samsung 5E?', 'answer' => 'Yes. The drain hose must have a clear path from the pump to the standpipe, with a high loop at or above the height of the standpipe inlet (minimum 30 inches from the floor). A kinked or siphoning hose prevents full drainage and triggers 5E even with a healthy pump.' ],
                ],
            ],
            'content' => "<p>A Samsung washer that will not drain — displaying a 5E, 5C, or ND error code, or simply leaving standing water in the drum at the end of a cycle — is one of the most common Samsung washing machine problems reported by US households. The good news: the majority of 5E drain errors are caused by a clogged pump filter that takes five minutes to clean yourself.</p>

<h2>Step 1 — Clean the Pump Filter (Do This First)</h2>
<p>On Samsung front-load washers, the pump filter (also called the coin trap or debris filter) is located behind a small rectangular access panel at the front lower section of the machine. Before opening it, lay towels on the floor — there will be water.</p>
<p>Pull out the small rubber emergency drain tube next to the filter cap. Remove the plug and drain water into a shallow pan or bucket. Once drained, twist the filter cap counter-clockwise and pull it out. Clean all lint, debris, coins, and foreign objects from the filter and housing. Rinse under running water. Reinstall and lock clockwise. This resolves a majority of 5E errors immediately.</p>

<h2>Step 2 — Check the Drain Hose Routing</h2>
<p>Pull the washer slightly away from the wall and inspect the full length of the drain hose. It must:</p>
<ul>
    <li>Have no kinks or tight bends</li>
    <li>Form a high loop — the top of the loop must be at least 30 inches from the floor</li>
    <li>Be inserted no more than 6 inches into the standpipe, and NOT sealed with tape or a tight fitting (an air gap is required)</li>
</ul>
<p>A drain hose inserted too deeply into the standpipe creates a continuous siphon that can both prevent draining and cause the tub to partially fill during the spin phase.</p>

<h2>Step 3 — Check the Household Drain</h2>
<p>Pour a bucket of water directly into the standpipe to test the household drain speed. If the water backs up slowly, the household drain is partially clogged and is preventing the pump from draining fast enough, triggering 5E even with a fully functional pump. Address the household drain before re-running the washer.</p>

<h2>Step 4 — Listen to the Drain Pump</h2>
<p>With the filter clean and hose correctly routed, initiate a Spin/Drain-only cycle (on most Samsung front-loaders, press and hold the Spin Speed button for 3 seconds). Listen during the drain phase:</p>
<ul>
    <li><strong>Loud, steady humming and water moving:</strong> Pump is working — recheck filter and hose.</li>
    <li><strong>No sound at all:</strong> Pump motor has failed — replacement needed.</li>
    <li><strong>Loud grinding or buzzing with no water movement:</strong> A foreign object is lodged in the pump impeller — the pump assembly must be removed to clear it or replace the pump.</li>
</ul>

<h2>When to Call a Technician</h2>
<p>If the filter is clean, the hose is correctly routed, and the pump is silent or grinding during a drain cycle, the drain pump motor has failed and requires professional replacement. Samsung drain pump replacement on front-load models is a 45–60 minute repair using a genuine Samsung OEM pump. All repairs are backed by a 30-day parts and labor warranty.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Washer Error Codes Explained — 4E, 5E, UB, DC, HE & More',
            'slug'       => 'samsung-washer-error-codes',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/wa55cg7500aeus/gallery/us-wa7500c-wa55cg7500aeus-wa55cg7500aeus-549429319?$product-details-jpg$',
            'meta_title' => 'Samsung Washer Error Codes — Complete US Guide to 4E, 5E, UB, DC, HE, ND, OE, LE, Sud',
            'meta_desc'  => 'Full guide to every common Samsung washer error code used in the US. What each code means, what causes it, and how to fix it — from simple DIY checks to professional repair.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the most common Samsung washer error code?', 'answer' => '5E (drain failure) and 4E (water supply fault) are the two most common Samsung washer error codes reported in the US. Both are frequently resolved with simple DIY checks — cleaning the pump filter for 5E and checking the water supply valve and inlet hose for 4E.' ],
                    [ 'question' => 'How do I reset my Samsung washer to clear an error code?', 'answer' => 'To reset a Samsung washer: turn the machine off and unplug it from the wall outlet for 60 seconds, then plug back in and restart. For a control panel reset on most models, press and hold the Start/Pause button for 5 seconds. If an error code returns immediately after reset, the underlying mechanical or electrical fault has not been resolved and requires diagnosis.' ],
                    [ 'question' => 'Are Samsung 4E and 4C the same error?', 'answer' => 'Yes — 4E and 4C are the same water supply fault. Samsung updated their display format in newer models; 4E appears on older machines, 4C on recent ones. Diagnosis and repair are identical for both.' ],
                    [ 'question' => 'What does Sud mean on a Samsung washer?', 'answer' => 'Sud (or Sd) means the machine detected excessive foam from too much detergent or non-HE detergent. The washer will automatically pause, add water, and reduce the suds before resuming. Switch to an HE-designated detergent and reduce the amount used per load.' ],
                ],
            ],
            'content' => "<p>Samsung washers use a consistent error code system across their front-load and top-load ranges. Understanding what each code means allows you to quickly determine whether it is a simple DIY fix or a component that needs professional replacement.</p>

<h2>4E / 4C — Water Supply Fault</h2>
<p>The washer is not filling with water within the required time. Check in this order: (1) Both water supply valves behind the machine are fully open. (2) Neither inlet hose is kinked. (3) The small mesh inlet screen filters at the back of the machine are clean. (4) Your home water pressure is adequate (minimum 14.5 PSI). If all pass, the inlet valve solenoid has failed and needs replacement.</p>

<h2>5E / 5C / ND — Drain Failure</h2>
<p>The washer failed to drain within the time limit. Start with the pump filter (front lower panel access) — this is the cause in most cases. Also check the drain hose for kinks and ensure it has a proper high loop. If the filter is clean and hose is correct, the drain pump motor has failed. See our full <a href='/guides/samsung-washer-not-draining/'>Samsung Washer Not Draining guide</a> for step-by-step instructions.</p>

<h2>UB / UE / E4 — Unbalance</h2>
<p>The drum cannot reach a balanced spin. First, redistribute the load manually — this resolves the majority of UB errors. Wash large single items (comforters, rugs) with a second item of similar weight. If UB persists on normal loads, check that the machine is level on all four feet. Worn suspension rods (front-load) or shock absorbers (top-load) cause persistent UB and require replacement as a set.</p>

<h2>DC — Door Lock Fault</h2>
<p>The control board cannot confirm the door is fully locked. Inspect the door latch hook for cracks or wear. Check the door boot gasket is not bulging and preventing full door closure. If the door feels locked but DC persists, the door lock microswitch has failed. A power reset will clear transient DC errors — if DC returns at the start of every cycle, the latch assembly needs replacement.</p>

<h2>HE — Heater Fault</h2>
<p>The wash water heater is not functioning. Cold-only wash cycles will complete; warm and hot cycles trigger HE. The wash heater element and NTC thermistor are the components to test. With a multimeter, the thermistor should read approximately 10,000–12,000 ohms at room temperature; the heater element should show continuity. Both components are located at the rear lower section of the outer tub.</p>

<h2>LE — Motor Lock / Low Water (Model Dependent)</h2>
<p>On front-load models: motor overload. Reduce the drum load, check for foreign objects lodged between the drum and tub, and try spinning the drum by hand (unplugged). On older models: water level fault equivalent to 4E. Check which phase of the cycle LE appears to determine which version your model displays.</p>

<h2>OE / OC — Overflow</h2>
<p>The tub has overfilled. The water inlet valve is failing to close when it receives the shutoff signal. Do not continue running the washer — a stuck-open valve will overflow the tub. Turn off the water supply valve and call for inlet valve replacement.</p>

<h2>Sud / Sd — Excess Suds</h2>
<p>Too much foam detected. The washer will self-correct this cycle. Switch to HE-only detergent and use the amount indicated by the dispenser fill lines, not the full detergent cap. Run a Self Clean cycle after switching to clear residual detergent buildup in the machine.</p>

<h2>Quick Reference Table</h2>
<table>
    <thead><tr><th>Code</th><th>Fault</th><th>Most Common Cause</th><th>DIY Fix?</th></tr></thead>
    <tbody>
        <tr><td>4E / 4C</td><td>No water supply</td><td>Closed valve / kinked hose</td><td>Yes</td></tr>
        <tr><td>5E / 5C / ND</td><td>Won't drain</td><td>Clogged pump filter</td><td>Yes</td></tr>
        <tr><td>UB / UE</td><td>Unbalance</td><td>Uneven load / worn rods</td><td>Partially</td></tr>
        <tr><td>DC</td><td>Door lock</td><td>Failed door latch</td><td>Partially</td></tr>
        <tr><td>HE</td><td>Heater fault</td><td>Failed heater element</td><td>No</td></tr>
        <tr><td>LE</td><td>Motor / water level</td><td>Overload / inlet valve</td><td>Partially</td></tr>
        <tr><td>OE / OC</td><td>Overflow</td><td>Inlet valve stuck open</td><td>No</td></tr>
        <tr><td>Sud / Sd</td><td>Excess suds</td><td>Wrong detergent</td><td>Yes</td></tr>
    </tbody>
</table>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Washer Leaking — Causes, Where to Look & How to Fix It',
            'slug'       => 'samsung-washer-leaking',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/wf53bb8700avus/gallery/us-wf8700b-wf53bb8700avus-549503516?$product-details-jpg$',
            'meta_title' => 'Samsung Washer Leaking — Door Seal, Pump & Hose Leak Diagnosis Guide',
            'meta_desc'  => 'Samsung washer leaking water? This guide identifies every leak point — door boot seal, pump filter, dispenser, inlet hoses — with diagnosis steps and repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung front-load washer leaking from the door?', 'answer' => 'Door leaks on Samsung front-loaders almost always originate from the door boot seal (gasket). The rubber seal can develop tears, stiffness from detergent buildup, or visible mold damage that prevents a watertight seal. Check the full perimeter of the seal for tears or deformation. A damaged boot seal requires replacement — it cannot be repaired with sealant.' ],
                    [ 'question' => 'My Samsung washer is leaking from the bottom — what is it?', 'answer' => 'A leak from the bottom of a Samsung washer is most likely the drain pump housing, a loose or cracked drain hose connection at the pump, or the boot seal draining down to the floor. On front-loaders, check the pump filter cap first — if it is not tightened clockwise to lock, water leaks from the filter housing during the spin cycle.' ],
                    [ 'question' => 'Can too much detergent cause a Samsung washer to leak?', 'answer' => 'Excessive suds from over-detergenting can overflow from the dispenser drawer area and appear as a front or top leak. If your washer shows a Sud code alongside leaking, reduce detergent to the HE-recommended amount and clean the dispenser housing.' ],
                ],
            ],
            'content' => "<p>Water on the floor around your Samsung washer can originate from several distinct locations — and identifying the source correctly saves both time and money. This guide walks through each leak point from most to least common.</p>

<h2>Door Boot Seal — Most Common Front-Load Leak</h2>
<p>The large rubber bellows seal around the front-load door opening is the most frequent source of Samsung washer leaks. Inspect the seal by pulling the outer lip back and examining the full perimeter for:</p>
<ul>
    <li>Visible tears or holes</li>
    <li>Hardening or cracking from age</li>
    <li>Black mold damage that has compromised the rubber's structure</li>
    <li>Small holes caused by underwires or sharp objects escaping the drum</li>
</ul>
<p>A damaged door boot seal requires full replacement — sealant will not hold under washing machine conditions. This is a moderate repair involving removing the door and front panel to access the seal clamps.</p>

<h2>Pump Filter Housing Leak</h2>
<p>After cleaning the pump filter, confirm the filter cap is locked fully clockwise and the emergency drain tube is capped. A loose filter cap will spray water from the front lower panel during the spin cycle, mimicking a severe leak. This is the most common post-maintenance leak on Samsung front-loaders.</p>

<h2>Detergent Dispenser Drawer Area</h2>
<p>Water running down the front of the machine from the drawer area indicates: overfilling the softener compartment; a clogged dispenser housing that is backing up and overflowing; or a failed solenoid that dispenses water before the drawer is in place. Clean the drawer and housing thoroughly — remove the drawer fully and rinse all compartments and the housing interior.</p>

<h2>Inlet Hose Connections</h2>
<p>Check both hot and cold water inlet hoses at the back of the machine. Slow drips at the connection points indicate a loose fitting or worn rubber hose washer. Hand-tighten the connections and replace the rubber washers inside the hose fittings if they have flattened or cracked. Never overtighten metal hose fittings — finger tight plus a quarter turn is correct.</p>

<h2>Drain Pump Housing</h2>
<p>A crack in the pump body or a loose hose clamp at the pump outlet will leak consistently during the drain phase. This leak typically appears directly beneath the machine. The pump assembly must be replaced — cracked pump housings cannot be repaired reliably.</p>

<h2>Drum Bearing Seal</h2>
<p>On older Samsung front-loaders with worn drum bearings, the bearing shaft seal can fail and allow water to seep out at the rear drum support. This leak is usually accompanied by loud rumbling or grinding during the spin cycle. Bearing replacement is a major disassembly repair but is worth performing on machines under 8 years old.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Washer Maintenance Guide — Keep It Running for Years',
            'slug'       => 'samsung-washer-maintenance',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/wf53bb8700avus/gallery/us-wf8700b-wf53bb8700avus-549503516?$product-details-jpg$',
            'meta_title' => 'Samsung Washer Maintenance Guide — Monthly, Quarterly & Annual Routines',
            'meta_desc'  => 'Expert Samsung washer maintenance routines for front-load and top-load models. Prevent 5E drain errors, door seal mold, drum bearing wear, and HE heater faults.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I prevent my Samsung front-load washer from smelling?', 'answer' => 'Front-loader odor is caused by biofilm and mold growing on the door boot seal and inside the drum. Run the Samsung Self Clean or Eco Drum Clean cycle monthly. Wipe the door seal folds after every load. Leave the door ajar between washes. Avoid over-dosing detergent, which leaves residue that feeds mold. Use only HE-rated liquid detergent.' ],
                    [ 'question' => 'How do I clean the Samsung washer pump filter?', 'answer' => 'Access the small panel at the front lower section. Pull out the emergency drain tube and drain residual water into a shallow pan. Unscrew the filter cap counter-clockwise. Remove the filter, rinse thoroughly under running water, removing all lint and debris. Check inside the housing for coins, underwires, or grit. Reinstall and lock clockwise. Perform monthly.' ],
                    [ 'question' => 'What detergent should I use in a Samsung HE washer?', 'answer' => 'Use only HE (High Efficiency) designated detergent — look for the HE symbol on the packaging. HE detergent produces low suds appropriate for the low water volume of Samsung washers. Use the amount shown on the dispenser fill lines — approximately 1–2 tablespoons of concentrated liquid per load, not a full cap.' ],
                ],
            ],
            'content' => "<p>Samsung washing machines are designed for a service life of 10–14 years, but only with consistent maintenance. The routines below address the most common failure modes seen in Samsung washers across the US.</p>

<h2>After Every Load</h2>
<p><strong>Wipe the door boot seal:</strong> Pull the outer lip of the rubber door gasket back and wipe the inner fold with a dry cloth. Moisture trapped in the seal fold is the primary driver of front-loader mold and odor — and of boot seal deterioration over time.</p>
<p><strong>Leave the door ajar:</strong> Allow the drum interior to air out after each wash. Leave the door open at least 30 minutes after unloading. This single habit dramatically reduces mold growth in the door seal and drum.</p>
<p><strong>Remove the detergent drawer slightly:</strong> Pull the drawer out an inch to allow the dispenser housing to dry between loads.</p>

<h2>Monthly</h2>
<p><strong>Run Self Clean / Eco Drum Clean:</strong> Samsung recommends running this cycle monthly or when the Self Clean indicator activates. Run without laundry or detergent — the cycle uses hot water and high spin speed to clean the drum interior. This prevents the biofilm buildup that causes odor and accelerates rubber seal deterioration.</p>
<p><strong>Clean the pump filter (front-load models):</strong> Follow the filter cleaning steps in our <a href='/guides/samsung-washer-not-draining/'>Samsung Washer Not Draining guide</a>. Monthly cleaning prevents 5E errors and extends pump motor life.</p>
<p><strong>Clean the detergent drawer:</strong> Remove the drawer fully and soak in warm water. Clean the dispenser housing interior with a soft brush. Residual detergent and fabric softener in the housing harbors mold and can reduce water supply to the drum, contributing to wash heater HE errors.</p>

<h2>Every 3 Months</h2>
<p><strong>Inspect the door boot seal:</strong> Examine the full perimeter of the rubber gasket for small tears, thinning, or hardened sections. Early detection of a small tear prevents it from becoming a full seal failure and floor leak.</p>
<p><strong>Check inlet hose connections:</strong> Inspect both hot and cold inlet hose connections at the back of the machine. Look for moisture or mineral deposits around the fittings — these indicate a slow drip that will worsen. Hand-check that fittings are snug.</p>
<p><strong>Check leveling:</strong> Samsung VRT washers are sensitive to leveling. Place a level on top of the machine front-to-back and side-to-side. Adjust leveling feet as needed. Improper leveling contributes to persistent UB unbalance errors and accelerates suspension rod wear.</p>

<h2>Annually</h2>
<p><strong>Inspect suspension rods (front-load):</strong> With the drum empty and the door open, push gently down on the front of the drum and release. It should spring back with firm, even resistance. Soft or uneven spring-back indicates a worn suspension rod that should be replaced before it causes drum impact damage.</p>
<p><strong>Clean the water inlet screen filters:</strong> Turn off the water supply, disconnect the inlet hoses, and use needle-nose pliers to carefully remove the small mesh screens from the inlet ports at the back of the machine. Rinse under running water to remove mineral sediment. This prevents flow restriction that triggers 4E/4C errors and reduces inlet valve solenoid wear.</p>",
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// DRYER GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_dryer(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Dryer Not Heating — HE Error, Thermal Fuse & Repair Guide',
            'slug'       => 'samsung-dryer-not-heating',
            'image'      => 'https://image-us.samsung.com/SamsungUS/home/home-appliances/dryers/08022022/DVE53BB8700T_01_Silver_Steel_SCOM.jpg',
            'meta_title' => 'Samsung Dryer Not Heating — HE Error, Thermal Fuse & Element Guide',
            'meta_desc'  => 'Samsung dryer not heating or showing HE? This guide covers every cause — thermal fuse, heating element, gas igniter — with diagnosis steps and repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung dryer running but not heating?', 'answer' => 'The most common cause is a blown thermal fuse — a one-time safety device that permanently cuts the heating circuit when the dryer overheats, usually from a restricted exhaust vent. On electric dryers, also check that both legs of the 240V circuit breaker have not tripped — a half-tripped double breaker allows the motor to run but cuts heat. If the circuit and fuse are fine, the heating element itself has failed.' ],
                    [ 'question' => 'Can I bypass the Samsung dryer thermal fuse to test it?', 'answer' => 'You can bypass it with a wire for a brief diagnostic test, but never operate the dryer with the fuse bypassed. The thermal fuse is the last line of defense against a dryer fire caused by vent blockage. Always replace the fuse and clear the vent — bypassing leaves the dryer in a fire-risk state.' ],
                    [ 'question' => 'Will a new thermal fuse fix my Samsung dryer permanently?', 'answer' => 'Only if the root cause — typically a blocked exhaust vent — is also addressed. If you replace the thermal fuse without clearing the vent, the new fuse will blow within a few loads. The vent must be cleaned from the dryer connection all the way to the exterior cap.' ],
                    [ 'question' => 'How do I know if my Samsung dryer is gas or electric?', 'answer' => 'Electric dryers connect to a 240V outlet (a large round 3- or 4-prong plug). Gas dryers have a standard 120V plug plus a separate gas supply line at the rear. The repair for no heat is different between the two — electric dryers need a heating element or thermal fuse; gas dryers need an igniter or gas valve solenoid coils.' ],
                ],
            ],
            'content' => "<p>A Samsung dryer that tumbles but produces no heat is one of the most common dryer faults. Clothes come out damp regardless of the cycle time. This guide walks through every cause in order of likelihood.</p>

<h2>Check the Circuit Breaker First (Electric Dryers)</h2>
<p>Electric Samsung dryers run on a 240V double-pole circuit. The motor uses 120V (one leg) and the heating element uses the full 240V (both legs). If one leg of the circuit breaker has tripped, the motor runs normally but heat is absent. Open your electrical panel and look for the double-pole breaker serving the dryer. Even if it appears in the ON position, push it firmly to OFF then back to ON. This resets a half-trip that a visual inspection can miss.</p>

<h2>Test the Thermal Fuse</h2>
<p>The thermal fuse is the single most common cause of a Samsung dryer with no heat. It is a small component mounted on the exhaust duct inside the dryer, accessible from the back panel (or bottom panel on some models). With the dryer unplugged, disconnect the two wires from the fuse and test across the two terminals with a multimeter set to continuity. A healthy fuse shows continuity (meter beeps or reads zero ohms). No continuity confirms a blown fuse.</p>
<p><strong>Important:</strong> Before replacing the fuse, clean the exhaust vent. The fuse blew because the dryer overheated — almost always from a restricted vent.</p>

<h2>Clean the Exhaust Vent</h2>
<p>A Samsung dryer showing d80, d90, or d95 codes (vent restriction warnings) alongside no heat confirms the vent is the root cause. Use a dryer vent cleaning brush kit to clean from the dryer exhaust outlet to the exterior cap. Replace any crushed flexible foil duct behind the dryer with rigid or semi-rigid aluminum duct. Check the exterior cap flap opens freely.</p>

<h2>Test the Heating Element (Electric)</h2>
<p>The electric heating element is a coiled resistance wire inside a housing, typically at the rear of the drum. Remove the back panel. The element is visually obvious — look for a visible break or burn in the coil. Test with a multimeter for continuity across the element terminals. No continuity confirms failure. Replacement requires genuine Samsung OEM element matching your model number.</p>

<h2>Gas Dryer — Igniter and Gas Valve Coils</h2>
<p>On Samsung gas dryers, the igniter glows to light the gas burner. Watch the igniter through the burner observation port during a cycle. If it glows orange but the burner does not light, the gas valve coil set has failed (this is more common than igniter failure alone on Samsung gas dryers). If the igniter does not glow at all, the igniter element has failed. Both are accessible from the front of the machine after removing the front panel.</p>

<h2>High-Limit Thermostat</h2>
<p>The high-limit thermostat is mounted near the heating element and opens permanently if the element area reaches extreme temperatures. Test for continuity like the thermal fuse. If it has opened, replace it along with the thermal fuse (they typically fail together after the same overheating event) and address the vent.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Dryer Error Codes — HE, HC, dS, d80, d90, d95, tS Explained',
            'slug'       => 'samsung-dryer-error-codes',
            'image'      => 'https://image-us.samsung.com/SamsungUS/home/home-appliances/dryers/08022022/DVE53BB8700T_01_Silver_Steel_SCOM.jpg',
            'meta_title' => 'Samsung Dryer Error Codes — Complete Guide to HE, HC, dS, d80, d90, d95, tS',
            'meta_desc'  => 'Every Samsung dryer error code explained for US models. What HE, HC, dS, d80, d90, d95, and tS mean, what causes them, and how to fix them.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_faqs'           => [
                    [ 'question' => 'What does d80 mean on a Samsung dryer?', 'answer' => 'd80 is a vent restriction warning unique to Samsung dryers — it means the exhaust vent is approximately 80% blocked. The dryer continues to run but at significantly reduced efficiency and with high fire risk from lint accumulation in the hot duct. Clean the full vent run from the dryer to the exterior cap immediately.' ],
                    [ 'question' => 'Why does my Samsung dryer show HC but the vent is clean?', 'answer' => 'If the vent is confirmed clean but HC persists, the cycling thermostat has failed in the closed position and is allowing the heating element to run continuously without cycling off. The cycling thermostat requires replacement. This is a relatively inexpensive part accessible from the back panel.' ],
                    [ 'question' => 'How do I reset my Samsung dryer after an error code?', 'answer' => 'Most Samsung dryer error codes reset after the fault condition is cleared — open the door, fix the issue, then restart. For a full reset: press and hold the Power button for 5 seconds, or unplug the dryer for 60 seconds. If the error returns immediately, the underlying component fault has not been resolved.' ],
                ],
            ],
            'content' => "<p>Samsung dryers display a consistent set of error codes across their gas and electric ranges sold in the US. Unlike some brands, Samsung includes several proactive warning codes (d80, d90, d95) that alert you to vent problems before a component actually fails.</p>

<h2>HE — Heating System Fault (No Heat)</h2>
<p>HE means the exhaust temperature is not rising as expected — the dryer is running cold. Causes: blown thermal fuse (most common), failed heating element (electric), failed gas igniter or valve coils (gas), failed high-limit thermostat. Start with the circuit breaker check and thermal fuse test. See our full <a href='/guides/samsung-dryer-not-heating/'>Samsung Dryer Not Heating guide</a>.</p>

<h2>HC — Overheating</h2>
<p>HC means the exhaust temperature has exceeded the safe maximum. Causes: blocked vent duct (primary cause), clogged lint screen, crushed transition duct behind the dryer, failed cycling thermostat. Clean the full vent run. If HC persists with a confirmed clear vent, replace the cycling thermostat.</p>

<h2>dS — Door Switch Fault</h2>
<p>The dryer cannot confirm the door is closed. The door switch is a small button inside the door opening, pressed by a tab on the door when it closes. Test it by pressing the button manually while starting the dryer — if it starts, the door striker tab is broken or misaligned. Test with a multimeter if the door striker looks intact: the switch should show continuity when the button is depressed. Replace the switch if it fails the continuity test.</p>

<h2>d80 / d90 / d95 — Vent Restriction Warnings</h2>
<p>These codes are unique to Samsung and represent one of the brand's best safety features. The dryer measures actual exhaust airflow and warns you at 80%, 90%, and 95% restriction levels. The dryer continues to operate during d80/d90 but fire risk is very real.</p>
<p>Action: (1) Clean the lint screen — hold it to the light; if you cannot see light through it, it needs washing. (2) Disconnect and clean the full vent duct with a rotary brush kit. (3) Inspect the exterior vent cap for bird nests, lint accumulation, or pest screens. (4) Replace any flexible foil duct behind the dryer with rigid aluminum duct. Annual professional vent cleaning is recommended for households running more than 4 loads per week.</p>

<h2>tS / t5 — Thermistor Fault</h2>
<p>The exhaust temperature sensor (thermistor) is reading outside the expected resistance range. The dryer shuts off the heating circuit as a safety measure. Test the thermistor with a multimeter: at room temperature it should read approximately 10,000–14,000 ohms. Significantly higher or lower confirms sensor failure. This is a straightforward component swap accessible from the back panel.</p>

<h2>Quick Reference</h2>
<table>
    <thead><tr><th>Code</th><th>Fault</th><th>Primary Cause</th><th>DIY Fix?</th></tr></thead>
    <tbody>
        <tr><td>HE</td><td>No heat</td><td>Blown thermal fuse / element</td><td>Partially</td></tr>
        <tr><td>HC</td><td>Overheating</td><td>Blocked vent duct</td><td>Yes</td></tr>
        <tr><td>dS</td><td>Door switch</td><td>Failed door switch</td><td>Yes</td></tr>
        <tr><td>d80</td><td>Vent 80% blocked</td><td>Lint in duct</td><td>Yes</td></tr>
        <tr><td>d90</td><td>Vent 90% blocked</td><td>Lint in duct</td><td>Yes</td></tr>
        <tr><td>d95</td><td>Vent 95% blocked</td><td>Lint in duct — urgent</td><td>Yes</td></tr>
        <tr><td>tS / t5</td><td>Thermistor fault</td><td>Failed thermistor</td><td>Partially</td></tr>
    </tbody>
</table>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Dryer Maintenance Guide — Vent Cleaning, Sensor Care & More',
            'slug'       => 'samsung-dryer-maintenance',
            'image'      => 'https://image-us.samsung.com/SamsungUS/home/home-appliances/dryers/08022022/DVE53BB8700T_01_Silver_Steel_SCOM.jpg',
            'meta_title' => 'Samsung Dryer Maintenance Guide — Prevent HE Errors, Vent Fires & Worn Parts',
            'meta_desc'  => 'Complete Samsung dryer maintenance schedule for gas and electric models. Prevent thermal fuse failures, vent blockages, and d80 vent warnings with these expert routines.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_faqs'           => [
                    [ 'question' => 'How often should I clean my Samsung dryer vent?', 'answer' => 'Samsung recommends annual professional vent cleaning for typical household use. Households doing 6 or more loads per week, or those with pets that shed heavily, should clean every 6 months. The d80/d90/d95 warning codes are your in-machine signal that the vent needs attention — do not ignore them.' ],
                    [ 'question' => 'How do I clean the Samsung moisture sensor bars?', 'answer' => 'The two metallic sensor bars inside the drum (visible near the lint screen opening) collect a film of fabric softener residue that makes them read clothes as dryer than they are, causing premature cycle shutoff. Wipe both strips with a cloth dampened with rubbing alcohol (isopropyl) monthly. Do not use abrasive pads — they scratch the sensor surface.' ],
                    [ 'question' => 'My Samsung dryer takes 2 or 3 cycles to dry a load — what maintenance fixes this?', 'answer' => 'Extended drying times are almost always a vent airflow problem. In order: (1) Clean the lint screen before every load. (2) Clean the full vent duct annually. (3) Clean the moisture sensor bars with rubbing alcohol monthly. (4) Ensure the exterior vent cap is not obstructed. If all are clear and drying is still slow, the heating element may be partially failed.' ],
                ],
            ],
            'content' => "<p>A well-maintained Samsung dryer runs efficiently, prevents the thermal fuse failures that are the most common Samsung dryer repair, and extends appliance life well beyond the average 10-year mark. The routines below address the specific failure patterns most common in Samsung dryers in the US.</p>

<h2>After Every Load</h2>
<p><strong>Clean the lint screen:</strong> Remove and clean the lint screen before every single load. This is not optional — a partially clogged lint screen reduces airflow and increases drum temperature, accelerating thermal fuse failure and triggering d80/d90 warnings. Hold the screen to a light source after cleaning — if you cannot see through the mesh (fabric softener residue coats it), wash it with warm soapy water, rinse thoroughly, and allow it to dry before reinserting.</p>

<h2>Monthly</h2>
<p><strong>Clean the moisture sensor bars:</strong> Locate the two metallic strips inside the drum (positioned near the opening of the lint screen slot on most Samsung models). Wipe firmly with a cloth dampened in rubbing alcohol. This restores accurate moisture sensing for Samsung's Sensor Dry system, which otherwise cuts cycles short and leaves clothes damp.</p>
<p><strong>Inspect the transition duct:</strong> The flexible duct connecting the dryer to the wall duct should be pulled slightly away from the dryer to confirm it is not kinked or crushed. Replace any severely kinked section — a 90° bend in the flexible duct can reduce airflow by 50% on its own.</p>

<h2>Every 6 Months</h2>
<p><strong>Clean the vent duct:</strong> Use a dryer vent cleaning brush kit. Disconnect the dryer duct at the back of the machine. Run the rotary brush from the dryer end to the exterior cap. Also reach the brush inside the dryer exhaust outlet (the rectangular opening at the back of the machine). Check the exterior cap — the flap must open freely. Remove any bird nests, wasp nests, or pest screens from the cap. Replace the cap if the flap is stuck.</p>

<h2>Annually</h2>
<p><strong>Inspect drum rollers and belt:</strong> Unplug the dryer. Turn the drum by hand — it should rotate smoothly with even, light resistance. Grinding, thumping, or seizing indicates worn drum rollers or a worn idler pulley bearing. Address early before a broken belt leaves laundry trapped in a non-rotating drum.</p>
<p><strong>Inspect the door seal and latch:</strong> Check the door seal for tears or compression loss. Test the door switch — the dryer should start immediately when the door is closed with the latch fully engaged. A door that requires firm slamming to start indicates a worn striker or switch that is close to triggering dS errors.</p>
<p><strong>Professional vent inspection:</strong> Schedule a professional dryer vent service if your duct run is longer than 15 feet, has multiple elbows, or passes through walls or ceilings where sections cannot be visually inspected.</p>",
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// REFRIGERATOR GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_refrigerator(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Refrigerator Not Cooling — Causes, Fixes & Expert Advice',
            'slug'       => 'samsung-refrigerator-not-cooling',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/rf29bb8600qlaa/gallery/us-4-door-french-door-beverage-center-rf29bb8600qlaa-551019964?$product-details-jpg$',
            'meta_title' => 'Samsung Refrigerator Not Cooling — Complete Diagnosis & Fix Guide',
            'meta_desc'  => 'Samsung fridge not cooling? This guide covers every cause from dirty coils to compressor failure, with step-by-step troubleshooting and expert repair advice.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung refrigerator not cooling but the freezer works?', 'answer' => 'This is a classic defrost system failure symptom. When the freezer works but the refrigerator section is warm, the evaporator coil is frozen solid — blocking airflow to the refrigerator compartment. The defrost heater, defrost thermostat, or main board defrost circuit has failed. This requires professional defrost system repair.' ],
                    [ 'question' => 'How long does food stay safe in a Samsung fridge that stopped cooling?', 'answer' => 'USDA guidelines state refrigerator food remains safe for approximately 4 hours with the door kept closed. Freezer contents remain safe for 24–48 hours depending on how full the freezer is. Keep doors closed as much as possible while awaiting repair.' ],
                    [ 'question' => 'Does Samsung have a known cooling issue?', 'answer' => 'Yes. Samsung French door and side-by-side refrigerators from approximately 2014–2020 experienced documented defrost system failures. Samsung has issued service advisories and a class-action settlement for some affected models. Use your model number on Samsung\'s website to check whether your refrigerator is included.' ],
                ],
            ],
            'content' => "<p>A Samsung refrigerator that stops cooling is one of the most urgent home appliance failures. Food safety is at risk within hours. This guide walks through the causes in order of likelihood, from the simplest checks to the most complex failures.</p>

<h2>Check Demo Mode First</h2>
<p>Samsung refrigerators can be accidentally placed in Demo Mode (also called Showroom Mode or OF OF mode) by pressing certain button combinations. In Demo Mode, all lights and displays function but the compressor is completely disabled — the unit appears powered on but is not cooling. Check your display for <strong>OF OF</strong> or <strong>O FF</strong>. If present, see our <a href='/error-codes/refrigerator/samsung-refrigerator-of-of-error-code/'>Samsung OF OF error code guide</a> for the correct exit sequence for your model.</p>

<h2>Check Temperature Settings</h2>
<p>Confirm the refrigerator temperature setting has not been accidentally changed. Samsung recommends 37°F for the fresh food compartment and 0°F for the freezer. Settings significantly warmer than this can allow natural temperature rise that appears to be a cooling failure.</p>

<h2>Clean the Condenser Coils</h2>
<p>Dirty condenser coils are a common cause of gradual cooling degradation. On most Samsung refrigerators, coils are at the rear or beneath the front (behind a kick grille). Dust and pet hair force the compressor to run longer and hotter. Clean with a coil brush and vacuum. Allow the refrigerator several hours to recover after cleaning.</p>

<h2>Evaporator Fan Motor — Codes 22E, 33E</h2>
<p>If the freezer is cold but the fresh food compartment is warm, and you can hear the compressor running, the evaporator fan motor has likely failed. Samsung codes 22E (freezer fan) and 33E (fridge fan) confirm this. Open the freezer door and tape over the door switch to keep the fan running — you should hear steady airflow from the evaporator panel area. Silence means the fan has failed.</p>

<h2>Defrost System Failure — The Most Common Samsung Issue</h2>
<p>Samsung French door and side-by-side refrigerators are particularly prone to defrost system failure. Ice accumulates on the evaporator coil and blocks all airflow. Symptoms: freezer adequately cold, refrigerator section warm, possible dripping sounds or frost on the freezer back wall, buzzing from ice maker area (Samsung 14E or 8E codes).</p>
<p>Temporary fix: unplug the refrigerator for 24–48 hours with doors open to manually defrost. This restores temporary cooling but the defrost heater, thermostat, or control board must be repaired or the problem will recur within days to weeks.</p>

<h2>Compressor and Sealed System</h2>
<p>If the compressor is not running (no hum from the back, refrigerator completely warm), the issue may be a failed compressor start relay, a failed compressor, or a refrigerant leak. Samsung Digital Inverter Compressors carry a 10-year warranty on parts. All sealed system repairs require a licensed EPA Section 608 technician.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Ice Maker Not Working — 8E, 14E Error Codes & Freeze-Up Fix',
            'slug'       => 'samsung-ice-maker-not-working',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/rs27t5200sr-aa/gallery/us-ref-sbs-rs5300-569370-rs27t5200sr-aa-549692350?$product-details-jpg$',
            'meta_title' => 'Samsung Ice Maker Not Working — 8E, 14E Error Codes, Freeze-Up & Fix',
            'meta_desc'  => 'Samsung ice maker stopped working or showing 8E / 14E? This guide covers the well-known Samsung freeze-up issue, reset steps, and when the ice maker needs replacement.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Samsung ice maker keep freezing up?', 'answer' => 'Samsung French door refrigerators have a well-documented ice maker design issue where the ice maker evaporator fan motor freezes over due to inadequate defrost heating in the ice maker compartment. The fix involves defrosting the ice maker area and installing an updated ice maker heater kit (available for affected models). Without addressing the root cause, freeze-up recurs every few months.' ],
                    [ 'question' => 'How do I reset my Samsung ice maker?', 'answer' => 'Locate the Test button on the ice maker module (a small recessed button, typically on the side or underside of the ice maker assembly). Press and hold for 10 seconds until you hear a chime or see the ice maker begin a test cycle. The test cycle takes approximately 6 minutes. If no ice is produced within 24 hours after a successful reset, the ice maker requires further diagnosis.' ],
                    [ 'question' => 'My Samsung fridge makes a humming or buzzing sound near the ice maker — what is it?', 'answer' => 'This buzzing is the ice maker evaporator fan motor trying to spin against ice buildup. The motor hums but cannot rotate because the blade is encased in ice. This triggers Samsung error code 14E. The ice maker area must be defrosted and the root cause of freeze-up addressed.' ],
                    [ 'question' => 'Is my Samsung ice maker covered under warranty?', 'answer' => 'Some Samsung models with documented ice maker issues have extended warranty coverage or Samsung service campaigns. Provide your model and serial number to Samsung support to determine if your refrigerator qualifies. The compressor carries a 10-year Samsung parts warranty. For any repair we perform, we back it with our own 30-day parts and labor warranty.' ],
                ],
            ],
            'content' => "<p>The Samsung ice maker is the single most frequently reported problem on Samsung French door and 4-Door Flex refrigerators in the US. This guide covers both the immediate fix steps and the long-term solution.</p>

<h2>Understanding the Samsung Ice Maker Problem</h2>
<p>Many Samsung French door models (particularly those with the upper ice maker compartment) experience recurring freeze-up of the ice maker evaporator fan. The small fan that circulates cold air within the ice maker compartment becomes encased in ice, stopping ice production and triggering error codes 8E and 14E. Samsung has acknowledged this issue and released updated ice maker heater kits for affected models.</p>

<h2>Immediate Fix — Defrost the Ice Maker</h2>
<p>Remove the ice bin. Using a hair dryer on its lowest heat setting (kept well away from any water) or a warm, damp cloth, carefully defrost the area behind the ice maker assembly. You will likely see a significant block of ice around the fan motor and coil area. Allow the area to fully thaw. Dry thoroughly before restoring power.</p>
<p>After defrosting, press and hold the Test button on the ice maker module for 10 seconds. Allow 24 hours for the ice maker to resume normal production (the tray must cycle through several ice-making rounds before the bin starts to fill).</p>

<h2>Error Codes 8E and 14E</h2>
<p><strong>8E</strong> — Ice maker sensor fault. The thermistor monitoring the ice making tray temperature is reading out of range, often because freeze-up has disrupted the temperature environment around it.</p>
<p><strong>14E</strong> — Ice maker fan fault. The dedicated fan motor for the ice maker compartment is not running — almost always because its blade is locked in ice.</p>
<p>Both codes typically clear after a thorough ice maker defrost. If either code returns within a few weeks of defrosting, the updated ice maker heater kit is needed.</p>

<h2>Checking for a Samsung Service Campaign</h2>
<p>Samsung has issued service bulletins for specific French door models covering ice maker components. Contact Samsung support with your model and serial number. Some customers have received free or discounted ice maker kit installation under these campaigns, even on units slightly outside the standard warranty period.</p>

<h2>Preventing Recurrence</h2>
<p>Even without the updated heater kit, you can reduce freeze-up frequency by: keeping the ice maker compartment door (on models with a separate inner door) properly sealed; running Ice Off mode for 2–3 days every few months to allow periodic natural defrost; and ensuring the ice bin is not overfilled (an overfull bin prevents the ice maker from completing its cycle).</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Refrigerator Error Codes — 22E, 8E, 14E, PC ER, 33E, OF OF',
            'slug'       => 'samsung-refrigerator-error-codes',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/rf29bb8600qlaa/gallery/us-4-door-french-door-beverage-center-rf29bb8600qlaa-551019964?$product-details-jpg$',
            'meta_title' => 'Samsung Refrigerator Error Codes — 22E, 8E, 14E, PC ER, 33E, OF OF Explained',
            'meta_desc'  => 'Complete guide to Samsung refrigerator error codes used in the US. What 22E, 8E, 14E, PC ER, 33E, and OF OF mean and how to fix each one.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I enter Samsung refrigerator diagnostic mode to read error codes?', 'answer' => 'On most Samsung French door models, press and hold the top-left and top-right display buttons simultaneously for 8 seconds. The display enters test mode and cycles through stored error codes. The specific button combination varies by model — consult your owner\'s manual or the label inside the refrigerator compartment for the correct combination.' ],
                    [ 'question' => 'My Samsung refrigerator shows a code I cannot find in the manual — what do I do?', 'answer' => 'Samsung has multiple display format generations — some older models display error codes as number-letter combinations (22E, 8E), while newer models may use letter-letter codes (FF, PC). If you cannot identify a code in your manual, write it down exactly as displayed and contact us — our technicians can cross-reference it against Samsung\'s full code library.' ],
                    [ 'question' => 'Will my Samsung refrigerator stop cooling if it shows an error code?', 'answer' => 'It depends on the code. Fan motor codes (22E, 33E, 14E) cause cooling loss because airflow is disrupted. Communication codes (PC ER) may or may not affect cooling depending on whether the main board can still run the compressor. Demo mode (OF OF) completely disables cooling. When in doubt, check the temperature with a thermometer and transfer perishables if the fresh food compartment exceeds 40°F.' ],
                ],
            ],
            'content' => "<p>Samsung refrigerators use a two-character error code system displayed on the front panel or accessed through the diagnostic mode. Understanding each code helps you determine urgency, whether food is at risk, and what component needs repair.</p>

<h2>OF OF / O FF — Demo Mode (Not a Fault)</h2>
<p>This is the most alarming code but the easiest to fix — the refrigerator is in Showroom Mode and is deliberately not cooling. The compressor is disabled. Exit demo mode using the button combination for your model (most commonly: hold Energy Saver + Freezer, or Power Cool + Power Freeze, for 8 seconds). See our <a href='/error-codes/refrigerator/samsung-refrigerator-of-of-error-code/'>OF OF error code guide</a> for model-specific instructions.</p>

<h2>22E — Freezer Evaporator Fan Fault</h2>
<p>The freezer evaporator fan motor has failed or is ice-locked. Without this fan, both the freezer and refrigerator compartments lose cooling quickly. Transfer food to coolers immediately. Unplug and manually defrost — if the fan runs after defrost, ice accumulation from a defrost system failure was the cause. If the fan still does not run after defrost, the motor has burned out and needs replacement.</p>

<h2>33E — Fresh Food (Fridge) Fan Fault</h2>
<p>On dual-evaporator Samsung models, the fresh food compartment has its own fan. 33E means this fan has failed. The freezer may remain cold while the refrigerator section warms. Same diagnosis approach as 22E — defrost first to rule out ice lock, then replace the motor if it still does not run.</p>

<h2>8E — Ice Maker Sensor Fault</h2>
<p>The ice maker thermistor is reading out of specification. Cooling continues normally — only ice production is affected. Defrost the ice maker area fully and reset. If 8E returns, the thermistor or ice maker module requires replacement. Check for Samsung service campaigns for your model.</p>

<h2>14E — Ice Maker Fan Fault</h2>
<p>The ice maker compartment fan is not running — almost always ice-locked. This is Samsung's most reported refrigerator error code. Defrost the ice maker area completely. If 14E recurs within weeks, the updated Samsung ice maker heater kit is needed. See our <a href='/guides/samsung-ice-maker-not-working/'>Samsung Ice Maker guide</a>.</p>

<h2>PC ER — Communication Fault</h2>
<p>The main control board and the display board have lost communication. Try a full power reset (unplug 5 minutes). If PC ER clears and does not return, a power event caused a transient fault. If PC ER persists, either the display board or main board has failed. A technician can identify which board is at fault before ordering parts.</p>

<h2>Quick Reference</h2>
<table>
    <thead><tr><th>Code</th><th>Fault</th><th>Food at Risk?</th><th>DIY Fix?</th></tr></thead>
    <tbody>
        <tr><td>OF OF</td><td>Demo mode — not cooling</td><td>Yes — act quickly</td><td>Yes</td></tr>
        <tr><td>22E</td><td>Freezer fan failure</td><td>Yes — urgent</td><td>Partially</td></tr>
        <tr><td>33E</td><td>Fridge fan failure</td><td>Yes — urgent</td><td>Partially</td></tr>
        <tr><td>8E</td><td>Ice maker sensor</td><td>No — ice only</td><td>Partially</td></tr>
        <tr><td>14E</td><td>Ice maker fan</td><td>No — ice only</td><td>Partially</td></tr>
        <tr><td>PC ER</td><td>Board communication</td><td>Possibly</td><td>Reset only</td></tr>
    </tbody>
</table>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Refrigerator Maintenance Guide — Coils, Filters, Gaskets & More',
            'slug'       => 'samsung-refrigerator-maintenance',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/rf29bb8600qlaa/gallery/us-4-door-french-door-beverage-center-rf29bb8600qlaa-551019964?$product-details-jpg$',
            'meta_title' => 'Samsung Refrigerator Maintenance Guide — Prevent Cooling Failure & Ice Maker Issues',
            'meta_desc'  => 'Expert Samsung refrigerator maintenance schedule. Prevent defrost failures, ice maker freeze-up, compressor stress, and door gasket leaks with these proven routines.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I prevent the Samsung ice maker from freezing up again?', 'answer' => 'Ensure the ice maker inner door (on models equipped with it) seals properly — a leaking inner door is the primary driver of ice maker compartment freeze-up. Run Ice Off mode for 2–3 days every few months as a preventive defrost. Have a technician install the Samsung updated ice maker heater kit if your model qualifies — this is the permanent fix.' ],
                    [ 'question' => 'How often should I change the Samsung water filter?', 'answer' => 'Samsung recommends replacing the water filter every 6 months regardless of usage. A clogged filter restricts water flow to both the dispenser and ice maker, and reduced water supply to the ice maker can contribute to thin or hollow ice cube production.' ],
                    [ 'question' => 'Why do my Samsung refrigerator door gaskets wear out faster than other brands?', 'answer' => 'Samsung French door and 4-door models have more door gasket surface area than standard designs, and the in-door ice maker models have additional inner door seals. Clean the gaskets with mild soap and water monthly — grease and food residue accelerate rubber degradation. Inspect quarterly for stiffening or tears.' ],
                ],
            ],
            'content' => "<p>Samsung refrigerators represent a significant household investment. The maintenance routines below target the specific failure patterns most common in Samsung refrigerators — particularly the defrost system and ice maker issues that affect millions of US households.</p>

<h2>Monthly</h2>
<p><strong>Check and clean door gaskets:</strong> Wipe the full perimeter of each door gasket with a damp cloth and mild dish soap. Inspect for any sections that have hardened, cracked, or are not making full contact with the cabinet frame. A simple dollar-bill test confirms seal integrity — close the door on a dollar bill; it should have noticeable resistance when pulled out. Replace any section that fails this test.</p>
<p><strong>Check the ice maker compartment inner door (French door models):</strong> The small door separating the ice maker compartment from the main freezer section must seal completely. Press the perimeter of this inner door and feel for cold air leaking. A leaking inner door is the primary driver of ice maker freeze-up and 14E errors.</p>

<h2>Every 3 Months</h2>
<p><strong>Run Ice Off for 2–3 days:</strong> On Samsung French door models, activate the Ice Off setting and leave the ice maker off for 2–3 days every quarter. This allows residual ice in the ice maker compartment to melt, providing a preventive defrost that significantly reduces freeze-up frequency.</p>
<p><strong>Check the drain pan:</strong> The drain pan beneath the refrigerator (accessible from the front after removing the kick grille) collects defrost water. A cracked or full pan is the cause of mysterious water on the floor. Check and clean the pan during condenser coil cleaning.</p>

<h2>Every 6 Months</h2>
<p><strong>Clean condenser coils:</strong> Pull the refrigerator away from the wall or remove the front kick grille to access the coils. Use a refrigerator coil brush and vacuum to remove dust and pet hair. Clean coils reduce compressor run time by up to 30%, extending compressor life significantly.</p>
<p><strong>Replace the water filter:</strong> Samsung water filters should be replaced every 6 months. Use only genuine Samsung or Samsung-compatible HAF-series filters. Non-compatible filters can restrict flow and cause low ice production without triggering a filter warning.</p>
<p><strong>Inspect water supply line:</strong> Check the water line running to the refrigerator for kinks, moisture around connections, or discoloration from a slow leak. A braided stainless steel water line is far more durable than the plastic tubing often supplied and is worth the upgrade at the next service visit.</p>

<h2>Annually</h2>
<p><strong>Deep clean the ice maker and bin:</strong> Wash the ice bin with warm water and mild dish soap. Remove the ice maker unit if possible and clean around it with a damp cloth. Check the fill tube (the small tube that delivers water to the ice maker tray) for ice blockage or mineral scale buildup.</p>
<p><strong>Test the defrost system:</strong> A technician can initiate a forced defrost cycle on Samsung refrigerators using the diagnostic mode (hold two buttons for 8 seconds — varies by model) and measure whether the defrost heater is reaching the correct temperature. This annual check catches early defrost system degradation before evaporator icing causes a full cooling failure.</p>",
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// DISHWASHER GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_dishwasher(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Dishwasher Not Draining — 5C Error Causes & Fix',
            'slug'       => 'samsung-dishwasher-not-draining',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/dw80cg5450sraa/gallery/us-dw5000c-568155-dw80cg5450sraa-549557202?$product-details-jpg$',
            'meta_title' => 'Samsung Dishwasher Not Draining — 5C / 5E Error Complete Fix Guide',
            'meta_desc'  => 'Samsung dishwasher showing 5C or 5E, or standing water in the tub? This guide covers every cause and step-by-step fix — most are DIY in under 10 minutes.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I clean the Samsung dishwasher filter?', 'answer' => 'Remove the lower rack. Locate the filter assembly at the center-bottom of the tub. Twist the cylindrical mesh filter counter-clockwise and lift it out. Remove the flat coarse filter beneath it. Rinse both under running water with a soft brush to remove food particles and grease. Reinstall the flat filter first, then lock the cylindrical filter clockwise. Clean monthly to prevent 5C errors.' ],
                    [ 'question' => 'My Samsung dishwasher shows 5C after a power outage — is something broken?', 'answer' => 'No — a power interruption during a cycle can leave the dishwasher mid-cycle with water in the tub. When power returns, the machine detects the water and triggers 5C. Run a Cancel + Drain cycle (press and hold Start for 3 seconds on most models) to drain the tub. If 5C clears after draining, no repair is needed.' ],
                    [ 'question' => 'Can I use my Samsung dishwasher with standing water in the tub?', 'answer' => 'No. Standing water will sit in the tub and become contaminated with food residue. Address the 5C drain fault before running another cycle.' ],
                ],
            ],
            'content' => "<p>Standing water in the Samsung dishwasher tub after a cycle — typically accompanied by a 5C or 5E error code — is one of the most common dishwasher problems. The majority of cases are resolved by cleaning the filter, a task that takes about five minutes.</p>

<h2>Step 1 — Clean the Filter Assembly (Do This First)</h2>
<p>Samsung dishwashers have a manual filter system that requires periodic cleaning. Unlike older dishwashers with self-cleaning grinders, Samsung's fine-mesh filters trap food particles to protect the pump and spray arms — but they must be manually cleaned.</p>
<p>Remove the lower rack. At the center of the tub floor, twist the cylindrical mesh filter counter-clockwise and pull it out. Lift the flat coarse filter below it. Rinse both thoroughly under running water, using a soft brush to clear grease and grit from the mesh. Check inside the filter housing for any glass fragments, bone chips, or debris. Reinstall — flat filter first, then lock the cylindrical filter clockwise. This resolves the majority of Samsung dishwasher 5C errors.</p>

<h2>Step 2 — Check the Drain Hose and Garbage Disposal Connection</h2>
<p>If the dishwasher drains into a garbage disposal, check two things: (1) Is the disposal's drain knockout plug removed? New disposal installations often leave this plastic plug in place, completely blocking dishwasher drainage. Use a screwdriver and hammer to knock it out from inside the disposal inlet. (2) Is the disposal itself clogged? Run the disposal for 30 seconds before starting the dishwasher cycle.</p>
<p>Inspect the drain hose under the sink cabinet for kinks. Confirm the drain hose has a high loop (the highest point of the hose should be above the disposal connection height to prevent backflow).</p>

<h2>Step 3 — Test the Drain Pump</h2>
<p>Cancel the current cycle and initiate a drain-only sequence: on most Samsung dishwashers, press and hold Start/Cancel for 3 seconds. Listen for the drain pump running — a healthy pump produces a steady, forceful pumping sound. Silence indicates a pump failure; a loud buzzing with no water movement indicates a jammed pump impeller (a glass shard or bone fragment is the most common cause).</p>

<h2>Step 4 — Check the Air Gap (if installed)</h2>
<p>Some US installations use an air gap fitting mounted on the sink deck between the dishwasher and the drain. A clogged air gap cap creates a blockage that prevents drainage even with a healthy pump. Remove the cap and clear any debris. Air gap caps can be replaced inexpensively if damaged.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Dishwasher Error Codes — 5C, 4C, LC, OC, HE Explained',
            'slug'       => 'samsung-dishwasher-error-codes',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/dw80cg5450sraa/gallery/us-dw5000c-568155-dw80cg5450sraa-549557202?$product-details-jpg$',
            'meta_title' => 'Samsung Dishwasher Error Codes — Complete Guide to 5C, 4C, LC, OC, HE',
            'meta_desc'  => 'Every Samsung dishwasher error code explained. What 5C, 4C, LC, OC, and HE mean, the most common causes, and how to fix each one.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I reset a Samsung dishwasher to clear an error code?', 'answer' => 'Press and hold the Start/Cancel button for 3–5 seconds to cancel the current cycle. For a full reset, press and hold the Power button for 3–5 seconds or unplug the dishwasher for 60 seconds. If the error returns after reset, the underlying component fault has not been resolved.' ],
                    [ 'question' => 'What is the most common Samsung dishwasher error?', 'answer' => '5C (drain failure) is the most common Samsung dishwasher error code in the US. In the majority of cases it is caused by a clogged filter that can be cleaned in minutes. LC (leak detection) is the second most common and is more urgent — it requires finding and repairing the leak source.' ],
                    [ 'question' => 'My Samsung dishwasher shows LC but I cannot see any water — why?', 'answer' => 'The LC flood sensor in the base pan is very sensitive — even a small amount of water from a one-time suds overflow or loose hose clamp can trigger it. Carefully tilt the dishwasher forward 45° to drain the base pan, then run a cycle while monitoring from below (with the kick plate removed). If LC does not return, the trigger was a one-time event.' ],
                ],
            ],
            'content' => "<p>Samsung dishwashers use a comprehensive error code system that covers water supply, drainage, heating, leaks, and overflow protection. Here is what each code means and the quickest path to resolution.</p>

<h2>5C / 5E — Drain Failure</h2>
<p>The dishwasher failed to drain within the required time. Start with the filter — a clogged filter is the cause in the majority of 5C cases. If the filter is clean, check the drain hose and garbage disposal connection. A quiet pump during a drain-only cycle confirms pump failure. See our full <a href='/guides/samsung-dishwasher-not-draining/'>Samsung Dishwasher Not Draining guide</a>.</p>

<h2>4C — Water Supply Fault</h2>
<p>The dishwasher is not filling with water. Check: (1) The water supply valve under the sink is fully open. (2) The inlet hose has no kinks. (3) The mesh screen inside the inlet valve connection is clear. If all pass, the inlet valve solenoid has failed. The valve is located at the bottom rear of the dishwasher, accessible after pulling it from the cabinet.</p>

<h2>LC / LE — Leak Detected</h2>
<p>The anti-flood float switch in the base pan has activated. Tilt the dishwasher forward to drain the base. Then find the leak source — run a wash cycle while observing from below with the kick plate removed and a flashlight. Common sources: door gasket tear, loose hose clamp at the pump, worn pump shaft seal, cracked spray arm supply fitting. Repair the leak, allow the base to dry completely, then restore the machine.</p>

<h2>OC / OE — Overflow</h2>
<p>Too much water entered the tub — the inlet valve did not close. Turn off the water supply valve under the sink. Do not run the dishwasher until the valve is replaced. A stuck-open valve will overflow the tub on every cycle.</p>

<h2>HE — Heater Fault</h2>
<p>The wash water heating element or its thermistor has failed. Dishes will be cold and wet after cycles. Ensure the hot water supply is reaching temperature before starting the dishwasher (run the hot water tap for 30 seconds first). If the problem persists, the heating element needs professional testing and replacement.</p>

<h2>Quick Reference</h2>
<table>
    <thead><tr><th>Code</th><th>Fault</th><th>First Check</th><th>DIY Fix?</th></tr></thead>
    <tbody>
        <tr><td>5C / 5E</td><td>Won't drain</td><td>Clean the filter</td><td>Yes</td></tr>
        <tr><td>4C</td><td>Won't fill</td><td>Water supply valve</td><td>Partially</td></tr>
        <tr><td>LC / LE</td><td>Leak detected</td><td>Drain base, find leak</td><td>Partially</td></tr>
        <tr><td>OC / OE</td><td>Overflow</td><td>Turn off water supply</td><td>No</td></tr>
        <tr><td>HE</td><td>Heater fault</td><td>Check hot water supply</td><td>No</td></tr>
    </tbody>
</table>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Dishwasher Not Cleaning Properly — Causes & Fixes',
            'slug'       => 'samsung-dishwasher-not-cleaning',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/dw80cg5450sraa/gallery/us-dw5000c-568155-dw80cg5450sraa-549557202?$product-details-jpg$',
            'meta_title' => 'Samsung Dishwasher Not Cleaning Properly — WaterWall, Filter & Water Temp Guide',
            'meta_desc'  => 'Samsung dishwasher leaving dishes dirty or spotty? This guide covers WaterWall blockages, clogged filters, low water temperature, and wash pump issues.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung WaterWall dishwasher leaving food on dishes?', 'answer' => 'The most common cause is a blocked WaterWall rail track or spray bar. Debris on the track prevents the WaterWall bar from sweeping its full range, leaving the load unevenly washed. Remove the lower rack and check the full length of the track for broken glass, food chunks, or utensils that have fallen through the rack and lodged on the track.' ],
                    [ 'question' => 'Why are my Samsung dishwasher dishes cloudy or spotty?', 'answer' => 'White cloudy film on glassware is almost always hard water mineral deposits (calcium and magnesium scale). Use a rinse aid in the dispenser compartment — rinse aid prevents water from forming droplets that dry as spots. Run a dishwasher descaler tablet monthly to remove accumulated scale from the heating element, spray arms, and tub.' ],
                    [ 'question' => 'What temperature should my water heater be set to for a Samsung dishwasher?', 'answer' => 'Set your water heater to at least 120°F (49°C). Samsung dishwashers have an internal heater that can boost temperature, but starting with adequately hot water from the supply significantly improves wash performance and reduces the time the heater must run. Run the hot water tap for 30 seconds before starting a cycle to ensure hot water is at the inlet.' ],
                ],
            ],
            'content' => "<p>A Samsung dishwasher that leaves dishes dirty, greasy, or spotted is not necessarily faulty — most poor cleaning issues are caused by maintenance or loading factors that can be corrected without a service call.</p>

<h2>Clean the Filter First</h2>
<p>A Samsung dishwasher filter clogged with food residue and grease dramatically reduces wash water pressure and recirculates dirty water through the machine. Monthly filter cleaning is the single most impactful maintenance task for cleaning performance. See our <a href='/guides/samsung-dishwasher-not-draining/'>Samsung Dishwasher Not Draining guide</a> for filter cleaning steps.</p>

<h2>Check and Clear the WaterWall Track</h2>
<p>Samsung WaterWall dishwashers rely on the moving spray bar sweeping back and forth along its rail track. Check the full length of the track in the lower wash zone for:</p>
<ul>
    <li>Glass fragments or bone chips that have fallen through the lower rack</li>
    <li>Plastic utensils or caps that have dropped and lodged in the track</li>
    <li>Mineral scale buildup on the track surface that creates friction</li>
</ul>
<p>Clean the track with a damp cloth. Confirm the WaterWall bar moves freely along the full track length before loading dishes.</p>

<h2>Clean the Spray Arms</h2>
<p>Both the lower and upper spray arms have small nozzle holes that can clog with mineral deposits or food debris. Remove each spray arm (typically unscrew or unclip from the center) and rinse under hot water while using a toothpick to clear each individual nozzle. Soak in white vinegar for 15 minutes if scale is heavy.</p>

<h2>Check Water Temperature</h2>
<p>Run the kitchen hot water tap for 30 seconds before starting the dishwasher — this purges the cold water sitting in the supply line and ensures the dishwasher fills with hot water from the first second. Set your water heater to at least 120°F. If dishes feel cold after a cycle even with hot supply water, the dishwasher's internal heating element has failed (HE error code territory).</p>

<h2>Use the Correct Detergent Amount and Type</h2>
<p>Use only automatic dishwasher detergent (never hand dish soap — this causes catastrophic suds overflow triggering LC errors). For hard water areas, use a detergent with built-in rinse aid or add rinse aid to the dispenser separately. Oversized detergent pods in small loads can leave undissolved residue on dishes in the top rack.</p>

<h2>Loading Technique</h2>
<p>Do not block the WaterWall bar's travel path with tall items in the lower rack. Large platters and cutting boards should be placed on the sides of the lower rack, not flat across the front, where they block the spray pattern. Ensure all bowls and cups face downward so spray reaches their interiors.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Dishwasher Maintenance Guide — Filter, Spray Arms & Gaskets',
            'slug'       => 'samsung-dishwasher-maintenance',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/dw80cg5450sraa/gallery/us-dw5000c-568155-dw80cg5450sraa-549557202?$product-details-jpg$',
            'meta_title' => 'Samsung Dishwasher Maintenance Guide — Prevent 5C, LC & Cleaning Issues',
            'meta_desc'  => 'Monthly, quarterly and annual Samsung dishwasher maintenance routines. Prevent 5C drain errors, LC leak codes, poor cleaning, and heating element failures.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I prevent Samsung dishwasher LC errors?', 'answer' => 'LC errors are caused by water in the base pan. The most preventable cause is overuse of detergent (causing suds overflow into the base) and door gasket deterioration. Use the correct amount of dishwasher detergent, keep the door gasket clean and intact, and periodically check under the dishwasher for drips from the drain hose and pump area.' ],
                    [ 'question' => 'Do I need to use rinse aid in my Samsung dishwasher?', 'answer' => 'Yes — Samsung strongly recommends rinse aid for all models. Without it, water clings to dishes and dries as spots and cloudy mineral film. Rinse aid also significantly improves drying performance on plastic items. Refill the rinse aid dispenser when the indicator on the door shows low.' ],
                    [ 'question' => 'How do I clean the inside of my Samsung dishwasher?', 'answer' => 'Monthly: run an empty cycle on the hottest setting with a dishwasher cleaning tablet (or a cup of white vinegar in an upright container on the lower rack). This descales the heating element, spray arms, and tub walls. Quarterly: wipe the tub walls and door interior with a damp cloth after the cleaning cycle to remove any loosened scale residue.' ],
                ],
            ],
            'content' => "<p>Regular maintenance prevents the three most common Samsung dishwasher failure modes: drain failures (5C), leak detection triggers (LC), and declining cleaning performance. These routines apply to all Samsung WaterWall and StormWash models.</p>

<h2>Monthly</h2>
<p><strong>Clean the filter assembly:</strong> A monthly filter clean is the most important single maintenance task for Samsung dishwashers. Remove both the cylindrical mesh filter and the flat coarse filter. Rinse under running water with a soft brush. Never use abrasive pads on the mesh — they damage the fine filtration surface. A clean filter prevents 5C drain errors and maintains full pump output for cleaning.</p>
<p><strong>Clean the door gasket:</strong> Wipe the full perimeter of the door seal with a damp cloth. Food residue and detergent film trapped in the gasket channel accelerates rubber degradation and creates leak paths that trigger LC errors.</p>
<p><strong>Run a cleaning cycle:</strong> Run an empty hot cycle with a dishwasher cleaning tablet or a cup of white vinegar on the bottom rack. This descales the heating element (preventing HE faults) and cleans the spray arms and tub interior.</p>

<h2>Every 3 Months</h2>
<p><strong>Inspect and clean the WaterWall track:</strong> Wipe the rail track at the back of the lower wash zone with a damp cloth. Remove any scale, grease, or debris that creates friction and prevents the WaterWall bar from completing its full sweep.</p>
<p><strong>Clean the spray arms:</strong> Remove the lower and upper spray arms and clear each nozzle hole with a toothpick or small pin. Soak in white vinegar for 15 minutes if mineral scale is visible. Clear nozzles restore full wash coverage.</p>
<p><strong>Check and refill rinse aid:</strong> The rinse aid dispenser should be kept filled. An empty dispenser causes spotting, cloudy glassware, and wet dishes after cycles.</p>

<h2>Every 6 Months</h2>
<p><strong>Inspect all hose connections:</strong> Pull the dishwasher slightly out from the cabinet (after turning off the water supply) and inspect the water inlet hose, drain hose connections, and any visible fittings under the machine for moisture or mineral deposit rings indicating a slow drip. Tighten any loose hose clamps.</p>
<p><strong>Inspect the door gasket closely:</strong> Run your finger along the full gasket perimeter and feel for any sections that have hardened, cracked, or have small tears. A compromised gasket that is caught early is a simple gasket replacement. Left unaddressed, it becomes a floor leak and LC error.</p>",
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// OVEN / RANGE GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_oven_range(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Oven Not Heating — F-23, F-22, SE Error Codes & Element Failure',
            'slug'       => 'samsung-oven-not-heating',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/ne63a6511ss-aa/gallery/us-ne5000ane63a6511sg-568542-ne63a6511ss-aa-549604738?$product-details-jpg$',
            'meta_title' => 'Samsung Oven Not Heating — F-23, F-22, SE Error Codes & Element Failure Guide',
            'meta_desc'  => 'Samsung oven not heating? This guide covers SE, F-22, F-23, and F-21 error codes, bake element failure, gas igniter faults, and how to diagnose each one.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung oven not reaching the set temperature?', 'answer' => 'A Samsung oven that heats but cannot reach the set temperature almost always has a faulty oven temperature sensor probe. The sensor is inexpensive and simple to test with a multimeter — at room temperature it should read approximately 1,080 ohms. A reading significantly outside this range confirms sensor failure (F-22 or F-23 code). Sensor replacement resolves the temperature accuracy issue in most cases.' ],
                    [ 'question' => 'My Samsung gas oven clicks but will not ignite — what is wrong?', 'answer' => 'Clicking at the cooktop burners is the surface spark igniters. If the oven burner (inside the oven cavity) does not ignite, the hot surface igniter is the component to check — not the spark igniters. The oven igniter glows orange-red to heat the gas valve open. If it glows weakly or not at all, it has failed. Igniter replacement restores oven function in most cases.' ],
                    [ 'question' => 'Can I still use my Samsung range cooktop if the oven shows an error code?', 'answer' => 'On most Samsung freestanding and slide-in ranges, the cooktop surface burners operate on a separate circuit from the oven. F-22, F-23, and SE codes typically only disable the oven cavity. The cooktop can usually be used normally while awaiting oven repair. Confirm by checking whether the cooktop responds normally before relying on it.' ],
                ],
            ],
            'content' => "<p>A Samsung oven that fails to heat — or cannot maintain an accurate temperature — disrupts cooking and can be caused by several distinct components. This guide covers diagnosis for both gas and electric Samsung ranges and wall ovens.</p>

<h2>SE Error — Touchpad Fault (No Control)</h2>
<p>If the oven displays SE (or -SE-), the control panel touchpad has a shorted key. The oven will not respond to temperature settings. Try a circuit breaker reset (60 seconds off). If SE clears, use the oven normally — but if SE returns, the touchpad membrane has permanently failed. See our <a href='/error-codes/oven-range/samsung-range-se-error-code/'>Samsung Range SE Error Code guide</a> for full diagnosis.</p>

<h2>F-22 / F-23 — Temperature Sensor Fault</h2>
<p>These codes disable oven heating because the control board cannot read a valid temperature from the sensor probe inside the oven cavity. Test the probe with a multimeter — at room temperature (70°F), a healthy Samsung oven sensor reads approximately 1,080 ohms. F-23 = too high (open circuit). F-22 = too low (shorted). Both indicate sensor failure in most cases and are resolved by replacing the probe (1–2 screws inside the cavity, connector behind the back wall).</p>

<h2>F-21 — Overtemperature</h2>
<p>The oven exceeded its safe maximum temperature. This typically indicates a control board relay stuck in the closed position, allowing the heating element to run continuously without cycling. Do not use the oven — a stuck relay is a fire risk. Switch off the circuit breaker and call for professional diagnosis.</p>

<h2>Bake Element Failure (Electric)</h2>
<p>The bake element at the bottom of the oven cavity can fail visibly (you may see a burn mark or break in the element coil) or fail invisibly (an internal wire break). Inspect the element before calling for service. A functioning bake element glows an even cherry red within 60 seconds of setting a bake temperature. If it does not glow, or glows unevenly with a dark section, it has failed. Test with a multimeter (continuity) after switching off the circuit breaker.</p>

<h2>Gas Igniter Failure</h2>
<p>On Samsung gas ranges, the oven igniter is a flat element that glows orange-red to heat the oven gas valve open. A weak or failed igniter means the valve never opens and no burner lights. Watch the igniter through the broil element gap — it should glow visibly red within 90 seconds. If it barely glows or does not glow, the igniter has weakened below the current draw needed to open the gas valve and requires replacement.</p>

<h2>Gas Valve Solenoid Coils</h2>
<p>If the igniter glows to full brightness but the burner still does not light, the gas valve solenoid coils have failed. These coils open and close the gas valve — when they fail, even a fully functioning igniter cannot open the valve to allow gas flow. Coil replacement restores full oven function on Samsung gas ranges.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Gas Range Burner Not Lighting — Causes & Fixes',
            'slug'       => 'samsung-gas-range-burner-not-lighting',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/nx60a6511ss-aa/gallery/us-nx5000anx60a6511sg-nx60a6511ss-aa-549600720?$product-details-jpg$',
            'meta_title' => 'Samsung Gas Range Burner Not Lighting — Spark Electrode, Igniter & Port Cleaning',
            'meta_desc'  => 'Samsung gas range burner clicking but not igniting? This guide covers clogged burner ports, failed spark electrodes, and moisture-related ignition issues.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Samsung gas burner keep clicking but not lighting?', 'answer' => 'Continuous clicking with no ignition is almost always caused by moisture in the ignition system from a recent spill or heavy steam from cooking. Remove the burner cap and grate, dry the area with a clean cloth, and allow to air dry for an hour. If clicking persists without a burner selected, a burner cap is misaligned — check that all caps are seated flat and centered.' ],
                    [ 'question' => 'One burner on my Samsung range will not light but the others work — what is it?', 'answer' => 'When a single burner fails to ignite while others work fine, the most common causes are: clogged burner ports on that specific burner cap (clean with a pin), a failed spark electrode at that burner, or a cracked burner cap that allows gas to escape before it reaches the ignition zone. Inspect the burner cap for cracks and clean the ports.' ],
                    [ 'question' => 'Is it safe to light my Samsung gas burner with a lighter if the igniter is broken?', 'answer' => 'Yes — you can use a long-reach lighter or lit match to ignite a gas burner with a failed igniter. Turn the knob to the lowest setting, bring the flame to the burner, then turn up. However, do not leave a failed igniter unrepaired long-term — the ignition system should be restored to ensure safe automatic lighting.' ],
                ],
            ],
            'content' => "<p>A Samsung gas range with burners that click but will not light — or that produce a weak, lifting flame — can almost always be restored to full function with cleaning before any parts are replaced.</p>

<h2>Clean the Burner Ports First</h2>
<p>The most common cause of a gas burner that clicks but will not light is clogged burner ports. The small holes around the edge of the burner head accumulate boilover residue, grease, and food debris that blocks gas flow.</p>
<p>Remove the burner grate and lift off the burner cap. Inspect the ring of small holes around the burner cap edge. Use a straight pin or toothpick to clear each port — never use a toothpick that can break and block the port. Do not use water or liquid cleaners inside the burner body. Replace the cap and ensure it sits completely flat and centered on the burner base.</p>

<h2>Dry the Ignition System After a Spill</h2>
<p>Liquid spills that reach the spark electrode or burner ignition socket cause continuous clicking and failed ignition. Remove the burner grate and cap. Use a dry cloth to absorb all visible moisture. Use a hair dryer on low heat (holding it at least 12 inches away) to gently warm the area. Allow 30–60 minutes of air drying before attempting ignition.</p>

<h2>Check Burner Cap Alignment</h2>
<p>A burner cap that is even slightly off-center will produce continuous clicking and failed ignition. After cleaning, replace the burner cap and press it firmly down, rotating slightly until it seats flat. The cap must sit perfectly level — a tilted cap cannot position the gas ports correctly over the spark electrode.</p>

<h2>Inspect the Spark Electrode</h2>
<p>Each burner has a dedicated spark electrode — a small ceramic post with a metal tip positioned near the burner cap. Inspect the electrode for:</p>
<ul>
    <li>Cracked or broken ceramic body (the electrode must be replaced)</li>
    <li>Carbon buildup on the metal tip (clean gently with a dry cloth)</li>
    <li>Bent tip that is no longer correctly positioned relative to the burner cap</li>
</ul>
<p>A failed electrode — one that produces no spark when the knob is turned — requires replacement. Each electrode is model-specific; confirm the Samsung part number before ordering.</p>

<h2>Check the Igniter Switch</h2>
<p>If the electrode sparks visibly but a specific burner still will not light, the issue may be the igniter switch module beneath the cooktop surface. These switches can fail after liquid infiltration. Replacement requires removing the cooktop surface — a moderate repair that is best handled by a certified technician.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Oven / Range Maintenance Guide',
            'slug'       => 'samsung-oven-range-maintenance',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/ne63a6511ss-aa/gallery/us-ne5000ane63a6511sg-568542-ne63a6511ss-aa-549604738?$product-details-jpg$',
            'meta_title' => 'Samsung Oven / Range Maintenance Guide — Prevent SE, F-23 Errors & Element Failure',
            'meta_desc'  => 'Samsung oven and range maintenance routines for gas and electric models. Prevent SE touchpad errors, F-23 sensor failures, burner port clogging, and door gasket wear.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_faqs'           => [
                    [ 'question' => 'How often should I run the Samsung oven self-clean cycle?', 'answer' => 'Samsung recommends self-clean no more than every 6 months under normal use. Frequent self-clean cycles expose the door lock motor, door gasket, and control panel to extreme heat stress and increase the risk of component failure — particularly SE touchpad errors and F-28 door lock motor faults that appear after self-clean cycles. For routine cleaning, use a damp cloth on cooled surfaces.' ],
                    [ 'question' => 'How do I protect my Samsung oven control panel from steam?', 'answer' => 'Steam rising from stovetop cooking is a leading cause of Samsung SE touchpad errors. Use lids on pots during heavy boiling. Run the range hood exhaust fan when cooking at high heat. Wipe the control panel with a dry cloth after cooking sessions to remove any condensation before it infiltrates the panel membrane.' ],
                    [ 'question' => 'How do I check if my Samsung oven temperature is accurate?', 'answer' => 'Use a standalone oven thermometer (available for under $15) placed in the center of the oven rack. Set the oven to 350°F and allow it to fully preheat (15 minutes). If the thermometer reads more than 25°F above or below 350°F, the temperature sensor probe should be tested and replaced. Samsung oven sensors are an inexpensive fix that restores precise baking temperatures.' ],
                ],
            ],
            'content' => "<p>A well-maintained Samsung oven and range performs consistently, prevents the SE touchpad fault and F-23 temperature sensor errors that are most commonly reported on Samsung cooking appliances, and extends the life of the control system, elements, and gas components.</p>

<h2>After Every Use</h2>
<p><strong>Wipe up spills while the oven is warm:</strong> Spills baked onto the oven cavity floor at 400–500°F become carbonized deposits that are difficult to remove and generate smoke on subsequent use. Wipe the cavity floor with a damp cloth while still warm (not hot). For glass cooktops, use a ceramic cooktop scraper to remove residue before it bonds.</p>
<p><strong>Clean burner caps and grates (gas range):</strong> Remove burner grates and caps after they cool. Rinse grates under warm soapy water. Wipe burner caps with a damp cloth — do not submerge burner caps in water. Dry all components completely before replacing. Moisture on burner caps causes persistent clicking and failed ignition.</p>
<p><strong>Wipe the control panel:</strong> A dry cloth wipe after every cooking session removes steam condensation from the control panel area. This is the single most effective preventive step against the Samsung SE touchpad error.</p>

<h2>Monthly</h2>
<p><strong>Deep clean burner ports (gas range):</strong> Use a straight pin to clear each port hole around the burner cap edges. Clogged ports reduce gas flow and cause uneven, lifting, or yellow flames. Always dry completely after cleaning.</p>
<p><strong>Check oven temperature accuracy:</strong> Place an oven thermometer on the center rack. Set to 350°F and measure after full preheat. Deviation of more than 25°F suggests a temperature sensor approaching failure. Early sensor replacement prevents mid-recipe temperature failures.</p>

<h2>Every 3 Months</h2>
<p><strong>Inspect the door gasket:</strong> Run a finger along the full oven door gasket. It should be flexible, continuous, and in firm contact with the oven frame around the entire perimeter. A stiff, cracked, or compressed gasket allows heat to escape, reducing efficiency and increasing preheat time.</p>
<p><strong>Inspect heating elements (electric range):</strong> With the oven on bake at 350°F, visually check that the bake element (lower) glows evenly along its full length. Any dark section indicates a failing element. Similarly, inspect the broil element during a broil cycle.</p>

<h2>Every 6 Months</h2>
<p><strong>Use self-clean sparingly:</strong> If you use the self-clean cycle, schedule it only when the oven truly needs it. Run it during daytime when you can monitor the appliance. Open windows for ventilation — the high temperatures vaporize cooking residue and can trigger smoke detector alerts. After self-clean completes and the oven cools, wipe the ash residue with a damp cloth before the next use.</p>
<p><strong>Test door hinges:</strong> The oven door should open and close smoothly with even resistance at all positions. A door that drops suddenly at 45° has a worn hinge spring. Worn door hinges allow the door to sit slightly ajar, causing heat loss and uneven baking.</p>",
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// MICROWAVE GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_microwave(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Microwave Not Heating — SE Error, Magnetron & Repair Guide',
            'slug'       => 'samsung-microwave-not-heating',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/me21dg6300sraa/gallery/us-me7500d-me21dg6300srac-me21dg6300sraa-549555597?$product-details-jpg$',
            'meta_title' => 'Samsung Microwave Not Heating — SE Error, Magnetron & Repair Guide',
            'meta_desc'  => 'Samsung microwave not heating or showing SE, E-11, or E-60? This guide covers every fault — touchpad errors, magnetron failure, high-voltage faults — with safe diagnosis steps.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung microwave running but not heating?', 'answer' => 'A Samsung microwave that powers on (lights, display, turntable functioning) but produces no heat has a failure in the high-voltage circuit. The most likely causes are a failed magnetron, blown high-voltage diode, or failed high-voltage capacitor. All require a trained technician to diagnose safely — the capacitor stores a lethal charge even when unplugged.' ],
                    [ 'question' => 'What is the Samsung microwave SE error?', 'answer' => 'SE (or -SE-) indicates a shorted or stuck key on the control panel touchpad. Unplugging for 60 seconds may clear it temporarily. If SE returns, the touchpad membrane has permanently failed. Do not continue using a microwave displaying SE — the control system cannot function reliably with a shorted key.' ],
                    [ 'question' => 'Can I repair a Samsung microwave myself?', 'answer' => 'External checks — door latch inspection, turntable reseating, waveguide cover inspection, vent filter cleaning — are safe. All internal repairs must be performed by a certified technician. The high-voltage capacitor inside a microwave stores over 2,000 volts and can deliver a fatal shock even hours after unplugging.' ],
                ],
            ],
            'content' => "<p>Samsung microwave faults range from the very common SE touchpad error to the more serious E-60 high-voltage failure. This guide covers every fault, what you can safely check yourself, and what requires a certified technician.</p>

<h2>High Voltage Safety Warning</h2>
<p><strong>Do not open the microwave cabinet under any circumstances.</strong> The high-voltage capacitor inside stores over 2,000 volts and remains charged for extended periods after the unit is unplugged. All checks below are limited to the exterior and door area only.</p>

<h2>SE / -SE- — Touchpad Fault</h2>
<p>SE is Samsung's most reported microwave error. Try unplugging for 60 seconds. If SE clears and remains clear through several uses, the fault was transient moisture — the touchpad membrane partially dried out. If SE returns, particularly after cooking with heavy steam, the membrane has permanently failed.</p>
<p>For over-the-range models: steam from stovetop cooking directly below the microwave is the primary cause. Consistent use of the range hood fan during cooktop use significantly reduces SE occurrence.</p>

<h2>E-11 — Humidity Sensor Fault</h2>
<p>E-11 affects the Sensor Cook / Auto Cook modes only — the microwave continues to heat normally in manual mode. Check the cavity ceiling for grease buildup over the humidity sensor port (a small grill or vent). Clean with a damp cloth. A reset may clear E-11 if it was triggered by a high-steam cooking event. If E-11 persists, the sensor requires professional replacement.</p>

<h2>E-60 — High-Voltage / Magnetron Fault</h2>
<p>E-60 is the no-heat code for the high-voltage system. The microwave runs but produces no heat. Call a certified technician — do not attempt any internal diagnosis. The technician will test the HV diode first (least expensive fix), then the HV capacitor and transformer, and finally the magnetron (most expensive).</p>

<h2>Microwave Runs But Produces No Heat (No Code)</h2>
<p>A microwave that heats in some cycles but not others, or that produces significantly less heat than normal, may be experiencing intermittent magnetron failure before E-60 is logged. Test by placing a cup of cold water inside and running on full power for 1 minute. Water should be hot. If it is barely warm, the magnetron output is degraded.</p>

<h2>Sparking or Arcing Inside the Cavity</h2>
<p>Stop using the microwave immediately. Inspect the waveguide cover — the flat rectangular panel on the interior wall of the cavity. If it is burned, blistered, or has holes, it must be replaced before use. A damaged waveguide cover allows microwave energy to arc to the cavity wall, causing progressive damage. Replacement covers are inexpensive OEM parts.</p>

<h2>Turntable Not Spinning</h2>
<p>Confirm the glass turntable plate and drive ring are correctly seated on the roller guide. The center of the plate must engage the drive coupler beneath it. If correctly seated but the turntable still does not spin, the turntable motor has failed — a straightforward replacement accessible from beneath the turntable assembly.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Microwave Maintenance Guide — Filters, Cavity & Door Seals',
            'slug'       => 'samsung-microwave-maintenance',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/me21dg6700sraa/gallery/us-me7500d-568101-me21dg6700sraa-549551777?$product-details-jpg$',
            'meta_title' => 'Samsung Microwave Maintenance Guide — Prevent SE Errors, Sparking & Fan Failure',
            'meta_desc'  => 'Samsung microwave maintenance for over-the-range and countertop models. Prevent SE touchpad errors, E-60 magnetron damage, and exhaust fan failure.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I clean Samsung microwave grease filters?', 'answer' => 'On Samsung over-the-range microwaves, the metal mesh grease filters slide out from the underside of the unit. Slide them out, wash in hot soapy water or place in the dishwasher top rack, rinse, and allow to dry completely before reinstalling. Clean monthly. Saturated grease filters restrict exhaust fan airflow and are a fire hazard.' ],
                    [ 'question' => 'How do I prevent my Samsung microwave from sparking?', 'answer' => 'Sparking is caused by food splatter on the waveguide cover, metallic residue on the cavity walls, or a foreign metallic object. Clean the waveguide cover (the flat beige or brown panel on the interior wall) with a damp cloth after every use. Never use metal in the microwave. Replace a damaged waveguide cover immediately — do not use the microwave with a burned or blistered cover.' ],
                    [ 'question' => 'How do I remove odors from my Samsung microwave?', 'answer' => 'Place a microwave-safe bowl with 1 cup of water and 1 tablespoon of white vinegar or a sliced lemon inside. Run on full power for 3 minutes, then leave the door closed for 5 minutes. The steam loosens food residue and the vinegar or lemon neutralizes odors. Wipe the interior with a damp cloth. For persistent odors, place an open box of baking soda inside overnight.' ],
                ],
            ],
            'content' => "<p>Samsung microwave maintenance focuses on three areas: the exterior ventilation system (for over-the-range models), the interior cavity, and the door and latch system. Consistent maintenance prevents the SE touchpad error, E-60 magnetron damage, and exhaust fan failure.</p>

<h2>After Every Use</h2>
<p><strong>Wipe the cavity interior:</strong> Wipe the interior walls, ceiling, floor, and turntable with a damp cloth after every use. Food splatter that is not removed bakes onto the surfaces during subsequent cycles and eventually burns — creating acrid smoke, damaging the cavity coating, and creating conductive residue that can cause arcing near the waveguide cover.</p>
<p><strong>Clean the waveguide cover:</strong> The waveguide cover (the flat panel on the interior wall) is the most maintenance-critical component in the cavity. Wipe it after every use. If it shows any brown staining or burn marks, replace it immediately — do not wait for arcing to damage the magnetron below it.</p>

<h2>Monthly</h2>
<p><strong>Clean grease filters (over-the-range models):</strong> Slide the metal mesh filters out from the underside of the microwave. Wash with hot soapy water and a brush, or run through the dishwasher top rack. Clogged grease filters reduce exhaust fan effectiveness, allow cooking grease to accumulate inside the fan housing, and are classified as a fire hazard by fire safety authorities.</p>
<p><strong>Run a steam cleaning cycle:</strong> Place a microwave-safe bowl with 1 cup of water and a tablespoon of white vinegar or a few lemon slices inside. Run on full power for 3 minutes. Leave the door closed for 5 minutes. The steam softens baked-on food residue. Wipe clean with a damp cloth. This prevents the grease buildup around the humidity sensor port that causes E-11 errors.</p>

<h2>Every 3 Months</h2>
<p><strong>Inspect the door seal and latches:</strong> The door seal must be intact and the door must latch firmly. A door that requires slamming, does not latch consistently, or has a visibly damaged seal can prevent the microwave from starting (door switch fault) or allow microwave energy to escape. Replace any damaged door seal or latch immediately.</p>
<p><strong>Clean the charcoal filter (over-the-range, non-vented models):</strong> Recirculating over-the-range models that are not externally vented use a charcoal filter above the grease filters. Samsung recommends replacing this filter every 6 months — it cannot be washed, only replaced. A saturated charcoal filter returns cooking odors to the kitchen and reduces fan effectiveness.</p>

<h2>Annually</h2>
<p><strong>Check the turntable drive coupler:</strong> Remove the glass turntable plate and ring. Inspect the plastic drive coupler at the center of the cavity floor for cracks. A cracked coupler causes the turntable to spin intermittently or not at all, resulting in uneven cooking. This is an inexpensive part.</p>
<p><strong>Test the exhaust fan speed (over-the-range):</strong> The exhaust fan should operate at clearly different speeds across its settings. A fan that runs at only one speed or makes new grinding noises has a motor bearing beginning to fail. Address before the motor seizes and blocks cooking exhaust entirely.</p>",
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// WALL OVEN GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_wall_oven(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Wall Oven Troubleshooting — SE, F-23, F-28 Errors & No Heat',
            'slug'       => 'samsung-wall-oven-troubleshooting',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/nv51cg700ssraa/gallery/us-nv7000c-nv51cb700s12aa-nv51cg700ssraa-549633204?$product-details-jpg$',
            'meta_title' => 'Samsung Wall Oven Troubleshooting — SE, F-23, F-28, F-40 Errors & No Heat',
            'meta_desc'  => 'Samsung wall oven showing SE, F-23, F-28, or F-40? Not heating? Door locked? This guide covers every common Samsung wall oven fault with diagnosis steps and repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_faqs'           => [
                    [ 'question' => 'What does the Samsung wall oven SE error mean?', 'answer' => 'The SE error indicates a shorted key on the control touchpad. A circuit breaker reset may clear it temporarily, but if SE returns, the touchpad or control board needs professional replacement. SE on a wall oven most commonly follows a self-clean cycle (steam exposure) or physical wear of the membrane.' ],
                    [ 'question' => 'Why is my Samsung wall oven not reaching temperature?', 'answer' => 'The most common cause is a faulty oven temperature sensor probe (F-22 or F-23 code). At room temperature, a healthy Samsung oven probe reads approximately 1,080 ohms with a multimeter. A reading significantly outside this range confirms sensor failure — a straightforward and inexpensive replacement.' ],
                    [ 'question' => 'My Samsung wall oven door is locked after self-clean — what do I do?', 'answer' => 'Allow the oven to cool completely (at least 1–2 hours), then press Clear/Off. If the door remains locked, try a circuit breaker reset for 5 minutes. If still locked after this, the door lock motor has mechanically failed and requires professional repair. Never force the door — it will damage the lock mechanism and may require expensive door assembly replacement.' ],
                    [ 'question' => 'Does the F-40 error affect both cavities on a Samsung double wall oven?', 'answer' => 'Yes — F-40 is a communication fault between the main control board and the secondary board. It typically disables all heating in both oven cavities as a safety measure. A power reset may clear transient F-40; persistent F-40 requires a technician to identify which board has failed.' ],
                ],
            ],
            'content' => "<p>Samsung wall ovens — single, double, and combination microwave-wall oven units — are built-in high-voltage appliances that require accurate diagnosis when faults develop. This guide covers every common Samsung wall oven fault in order of frequency.</p>

<h2>SE Error — Touchpad Fault</h2>
<p>Switch off the wall oven circuit breaker for 60 seconds. Restore power. If SE clears: use the oven, but monitor for recurrence. If SE returns: the touchpad membrane has permanently failed and requires replacement. SE on wall ovens most commonly appears after self-clean cycles (heat and steam stress the membrane) or after years of normal use.</p>
<p>Identify the shorted key after a successful reset — press keys one at a time. If pressing a specific key immediately causes SE, that key's circuit has failed, confirming membrane replacement is needed (rather than a board issue).</p>

<h2>F-22 / F-23 — Temperature Sensor Fault</h2>
<p>F-22 or F-23 disables oven heating completely. Both indicate the oven temperature sensor probe is reading out of specification. Test with a multimeter (probe disconnected from its harness): at 70°F room temperature, healthy probe = approximately 1,080 ohms. Significantly higher (F-23) or near zero (F-22) = replace the probe. The probe is mounted on the rear wall of the oven cavity, secured by 1–2 screws, with its wiring connector accessible behind the back panel. See our detailed <a href='/error-codes/wall-oven/samsung-wall-oven-f23-error-code/'>F-23 error code guide</a>.</p>

<h2>Oven Not Heating — Element Check</h2>
<p>With the circuit breaker on, set the oven to Bake at 350°F. After 60 seconds, open the door briefly and check whether the lower bake element is beginning to glow. No glow = element has failed. A visible burn mark or break in the element coil confirms failure. Switch off the circuit breaker before inspecting elements closely. Similarly test the broil element during a broil cycle.</p>

<h2>F-28 — Door Lock Motor Fault</h2>
<p>F-28 almost always appears in connection with the self-clean cycle. The door lock motor has failed to complete a lock or unlock sequence. Steps:</p>
<ol>
    <li>Allow the oven to cool to room temperature — minimum 2 hours after self-clean.</li>
    <li>Press Clear/Off on the panel.</li>
    <li>If the door remains locked: switch the circuit breaker off for 5 minutes, then restore power. The board will re-attempt the unlock sequence.</li>
    <li>If still locked: the motor has mechanically failed. Call a technician — do not force the door.</li>
</ol>

<h2>F-40 — Control Board Communication Fault</h2>
<p>F-40 means the main board has lost communication with a secondary board (relay board or lower oven board on double ovens). Try a 5-minute circuit breaker reset first. If F-40 clears and does not return, a power event was the cause. If F-40 persists, a technician is needed to identify whether the main board or secondary board has failed before parts are ordered.</p>

<h2>Convection Fan Not Running</h2>
<p>Confirm you are running a cycle that uses convection (Convection Bake, Air Fry, or Roast — standard Bake does not use the fan). If the fan never runs during convection-specific modes, the convection fan motor has failed. This requires access to the rear cavity panel and is a moderate disassembly repair.</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Wall Oven Maintenance Guide — Gaskets, Elements & Self-Clean Tips',
            'slug'       => 'samsung-wall-oven-maintenance',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/nv51cg700ssraa/gallery/us-nv7000c-nv51cb700s12aa-nv51cg700ssraa-549633204?$product-details-jpg$',
            'meta_title' => 'Samsung Wall Oven Maintenance Guide — Prevent SE, F-23 & Door Lock Faults',
            'meta_desc'  => 'Complete Samsung wall oven maintenance guide. Prevent SE touchpad errors, F-23 sensor failures, F-28 door lock faults, and heating element failure.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_faqs'           => [
                    [ 'question' => 'How often should I run the Samsung wall oven self-clean?', 'answer' => 'No more than once every 6 months for normal use. Samsung wall oven self-clean cycles reach approximately 900°F — this extreme heat is the primary trigger for SE touchpad errors and F-28 door lock motor faults on Samsung wall ovens. For routine cleaning, use a damp cloth on cooled surfaces and reserve self-clean for heavy buildup only.' ],
                    [ 'question' => 'How do I check my Samsung wall oven bake element without a technician?', 'answer' => 'Set the oven to Bake at 350°F. After 60–90 seconds, open the door briefly and observe the lower element — it should glow an even, consistent cherry red along its full length. Any section that does not glow, glows significantly dimmer than the rest, or shows a visible dark arc indicates element failure. Switch the circuit breaker off before any close inspection.' ],
                    [ 'question' => 'Should I be concerned about my Samsung wall oven door gasket?', 'answer' => 'Yes. The door gasket on a wall oven is critical for energy efficiency and baking accuracy. A damaged gasket allows heat to escape, increasing preheat time, increasing energy use, and causing uneven baking. Inspect the full gasket perimeter every 3 months. Replace any section that has hardened, cracked, or has gaps.' ],
                ],
            ],
            'content' => "<p>Samsung wall oven maintenance is straightforward but different from range maintenance in one key respect: built-in appliances are more expensive and complex to repair when problems develop, so preventive care has a higher return on investment. These routines prevent the most commonly reported Samsung wall oven faults.</p>

<h2>After Every Use</h2>
<p><strong>Wipe up spills while the oven is warm:</strong> Spills allowed to bake on at repeated high temperatures carbonize and become difficult to remove without self-clean, which itself carries risks for Samsung wall ovens (SE and F-28 triggers). A damp cloth wipe while the oven is still warm (not hot) is highly effective.</p>
<p><strong>Check the oven interior after convection use:</strong> Convection fans circulate air and can distribute small food debris across the full cavity. Wipe the cavity walls, fan area, and floor after convection cooking sessions.</p>

<h2>Monthly</h2>
<p><strong>Test temperature accuracy:</strong> Place an oven thermometer on the center rack. Set to 350°F. After full preheat (15 minutes for a wall oven), confirm the reading is within 25°F of 350°F. Early temperature drift indicates the sensor probe is beginning to fail (leading to F-22/F-23 codes). Early replacement before full failure prevents mid-cook shutdowns.</p>
<p><strong>Inspect the bake and broil elements visually:</strong> Run a Bake cycle for 90 seconds and a brief Broil cycle to visually confirm both elements glow evenly. Catching a partially failing element early allows scheduled replacement rather than emergency repair.</p>

<h2>Every 3 Months</h2>
<p><strong>Inspect the door gasket:</strong> Run a finger along the full perimeter of the oven door gasket. It should be uniformly soft and flexible, with no gaps between the gasket and the oven frame. Use the dollar-bill test at multiple points around the door: the bill should be held firmly when the door is closed. A loose or damaged gasket requires replacement.</p>
<p><strong>Inspect the door hinges:</strong> Open the door and check that it moves smoothly at all positions without dropping suddenly or requiring excessive force to hold at a 45° angle. Weak or asymmetric hinge resistance indicates worn hinge springs — address before the door drops and stresses the door glass.</p>
<p><strong>Test the door lock manually:</strong> On double wall ovens and combination units, test that the self-clean door lock engages and disengages correctly (most models allow a lock test without initiating a full self-clean cycle — consult your manual). Annual lock tests catch a sticking mechanism before it fails fully during a self-clean (triggering F-28).</p>

<h2>Every 6 Months</h2>
<p><strong>Clean the convection fan area:</strong> Grease accumulation around the convection fan opening at the rear of the cavity reduces airflow and can cause uneven baking. With the oven cool and the circuit breaker off, wipe the fan guard and visible fan blades with a damp cloth.</p>
<p><strong>Clean the control panel area:</strong> Wipe the control panel with a barely damp cloth (no liquid cleaners) to remove grease film that accumulates around button areas. Grease infiltrating the panel membrane accelerates the SE touchpad fault on Samsung wall ovens.</p>
<p><strong>Self-clean if needed:</strong> If the oven cavity requires self-clean, run it on a day when you can monitor the appliance. Open windows for ventilation. After the cycle completes and the oven unlocks, wait for full cool-down before wiping ash residue.</p>",
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// CROSS-APPLIANCE GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_samsung_cross(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Repair vs Replace Your Samsung Appliance — A Practical Guide',
            'slug'       => 'repair-vs-replace-samsung-appliance',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/wf53bb8700avus/gallery/us-wf8700b-wf53bb8700avus-549503516?$product-details-jpg$',
            'meta_title' => 'Repair vs Replace Your Samsung Appliance — Expert Framework',
            'meta_desc'  => 'Samsung appliance broken? Use real cost data, life expectancy tables, and Samsung-specific reliability factors to decide whether to repair or replace.',
            'taxonomies' => [ 'brand' => 'Samsung' ],
            'meta_fields' => [
                '_ar_brand' => 'Samsung',
                '_ar_faqs'  => [
                    [ 'question' => 'Are Samsung appliances reliable long-term?', 'answer' => 'Samsung appliances offer strong feature sets and competitive pricing but some product lines have experienced reliability issues. French door refrigerators from 2014–2020 had documented defrost system issues. Ice maker problems on French door models are well-documented. Samsung washers and dryers are generally good candidates for repair when common components fail. Our technicians consider model-specific reliability records when advising on repair vs replace.' ],
                    [ 'question' => 'How long do Samsung appliances last?', 'answer' => 'Samsung washers and dryers: 10–13 years. Refrigerators: 10–15 years. Dishwashers: 10–12 years. Ovens and ranges: 13–15 years. Microwaves: 8–12 years. Wall ovens: 13–15 years. Appliances that receive consistent maintenance (vent cleaning, filter cleaning, coil cleaning) routinely outlast these averages.' ],
                    [ 'question' => 'What Samsung repairs are always worth doing?', 'answer' => 'Drain pump replacement on washers and dishwashers, thermal fuse replacement on dryers, door seal replacement on front-load washers, temperature sensor replacement on ovens, and door latch replacement on washers are all high-value repairs — typically under $250 total cost on appliances that would cost $700–$1,500 to replace. These repairs restore full function at a fraction of replacement cost.' ],
                ],
            ],
            'content' => "<p>When a Samsung appliance breaks down, the repair-vs-replace decision comes down to three factors: the cost of repair relative to replacement, the age of the appliance relative to its expected service life, and whether the fault is a one-off failure or indicates systemic deterioration.</p>

<h2>The 50% Rule</h2>
<p>If the total repair cost (parts and labor) is below 50% of the cost of a comparable new replacement, repair is almost always the financially better decision. For most Samsung appliances, common component failures fall well under this threshold:</p>
<table>
    <thead><tr><th>Appliance</th><th>Typical Replacement Cost</th><th>Common Repair Range</th><th>Repair Value?</th></tr></thead>
    <tbody>
        <tr><td>Washer (front-load)</td><td>$800 – $1,400</td><td>$100 – $380</td><td>Almost always yes</td></tr>
        <tr><td>Dryer</td><td>$700 – $1,200</td><td>$80 – $280</td><td>Almost always yes</td></tr>
        <tr><td>Refrigerator (French door)</td><td>$1,200 – $2,800</td><td>$140 – $450</td><td>Yes, under 10 years</td></tr>
        <tr><td>Dishwasher</td><td>$600 – $1,200</td><td>$110 – $320</td><td>Yes, under 8 years</td></tr>
        <tr><td>Range / Oven</td><td>$900 – $2,000</td><td>$95 – $300</td><td>Almost always yes</td></tr>
        <tr><td>Over-range Microwave</td><td>$400 – $900</td><td>$90 – $380</td><td>Yes for most faults</td></tr>
        <tr><td>Wall Oven</td><td>$1,500 – $3,500</td><td>$95 – $450</td><td>Almost always yes</td></tr>
    </tbody>
</table>

<h2>Age-Based Decision Framework</h2>
<p><strong>Under 5 years:</strong> Repair virtually any fault. The appliance is in its productive life and any component replacement extends its service life well beyond the repair cost.</p>
<p><strong>5–8 years:</strong> Repair all common faults (pump, element, sensor, seal, thermostat). Evaluate major sealed system repairs (compressor, refrigerant recharge) against replacement on a cost basis.</p>
<p><strong>8–12 years:</strong> Apply the 50% rule rigorously. Common component repairs are still worthwhile. Avoid investing in compressor replacement, drum bearing replacement on a heavily-used washer, or control board replacement on a machine that has had multiple prior repairs.</p>
<p><strong>Over 12 years:</strong> Consider replacement for any repair exceeding $250, or for the second major repair within 2 years. The appliance is approaching end of design life regardless of repair outcomes.</p>

<h2>Samsung-Specific Factors to Consider</h2>
<p><strong>French door refrigerator ice maker (2014–2021 models):</strong> If your Samsung French door refrigerator has experienced its second or third ice maker freeze-up issue without the updated ice maker heater kit being installed, that is a systemic design limitation rather than a random component failure. Consider the cost of the kit installation as a permanent fix before deciding to replace.</p>
<p><strong>Samsung washer drum bearings:</strong> Drum bearing replacement on a Samsung front-load washer is a major disassembly repair. On machines under 7 years old, it is still worth doing — bearings are inexpensive and the drum is the most expensive part of the machine. On machines over 10 years old with bearing failure, replacement deserves consideration.</p>
<p><strong>Samsung dryer thermal fuse recurrence:</strong> A thermal fuse that has blown multiple times indicates a chronic vent restriction problem, not a component quality issue. Address the vent permanently (rigid duct installation, professional vent cleaning) alongside the fuse replacement.</p>

<h2>When to Replace</h2>
<p>Replace if: the appliance is over 12 years old and needs a sealed system repair (compressor, evaporator, refrigerant); the repair cost exceeds 60% of replacement cost; you have made two or more major repairs to the same unit within 18 months; or the appliance has a documented manufacturer defect with no available fix (check Samsung's service advisory database with your model number).</p>",
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Samsung Appliance Maintenance Guide — All Appliances, All Routines',
            'slug'       => 'samsung-appliance-maintenance-tips',
            'image'      => 'https://images.samsung.com/is/image/samsung/p6pim/us/rf29bb8600qlaa/gallery/us-4-door-french-door-beverage-center-rf29bb8600qlaa-551019964?$product-details-jpg$',
            'meta_title' => 'Samsung Appliance Maintenance Guide — Washer, Dryer, Fridge, Dishwasher, Oven & More',
            'meta_desc'  => 'Complete Samsung appliance maintenance guide for all 7 appliance types. Expert monthly, quarterly, and annual routines to extend life and prevent costly repairs.',
            'taxonomies' => [ 'brand' => 'Samsung' ],
            'meta_fields' => [
                '_ar_brand' => 'Samsung',
                '_ar_faqs'  => [
                    [ 'question' => 'What is the most important Samsung appliance maintenance task?', 'answer' => 'For dryers: clean the lint screen before every load and clean the exhaust vent annually — this prevents the most common Samsung dryer failure (blown thermal fuse) and the most serious risk (dryer fire). For front-load washers: clean the pump filter monthly and run Self Clean monthly — this prevents 5E drain errors and door seal mold. For refrigerators: clean the condenser coils every 6 months — this is the single task most protective of compressor life.' ],
                    [ 'question' => 'How do I prevent Samsung appliance error codes through maintenance?', 'answer' => 'Most Samsung error codes are preventable: 5E/5C drain errors (washer/dishwasher) → clean filters monthly. HE dryer no-heat → clean vent annually. d80/d90/d95 vent warnings → clean vent every 6 months. Samsung ice maker 8E/14E → quarterly ice maker defrost, inner door seal check. SE touchpad errors → reduce steam exposure, wipe control panels dry.' ],
                    [ 'question' => 'How do I know when my Samsung appliance needs a professional service?', 'answer' => 'Schedule a professional service when: error codes persist after performing the recommended DIY checks in this guide; the appliance makes new sounds (grinding, buzzing, humming) it did not make before; performance has declined gradually over several months (longer dry times, poor wash results, slower ice production, uneven baking); or the appliance is 5+ years old and has never had a professional inspection.' ],
                ],
            ],
            'content' => "<p>This guide consolidates the essential maintenance routines for all Samsung appliances into a single reference. Bookmark it and schedule each routine — the time investment is measured in minutes per month, while the repairs prevented are measured in hundreds of dollars.</p>

<h2>Samsung Washer</h2>
<p><strong>After every load:</strong> Wipe door seal folds (front-load). Leave door ajar.</p>
<p><strong>Monthly:</strong> Run Self Clean / Eco Drum Clean. Clean pump filter (front-load). Clean detergent drawer.</p>
<p><strong>Every 3 months:</strong> Inspect door boot seal. Check inlet hose connections. Check leveling.</p>
<p><strong>Annually:</strong> Inspect suspension rods (front-load). Clean inlet screen filters.</p>

<h2>Samsung Dryer</h2>
<p><strong>After every load:</strong> Clean the lint screen.</p>
<p><strong>Monthly:</strong> Clean moisture sensor bars (rubbing alcohol). Inspect transition duct.</p>
<p><strong>Every 6 months:</strong> Clean full vent duct from dryer to exterior cap.</p>
<p><strong>Annually:</strong> Inspect drum rollers and belt. Inspect door seal and switch. Professional vent inspection for long duct runs.</p>

<h2>Samsung Refrigerator</h2>
<p><strong>Monthly:</strong> Clean door gaskets. Check ice maker inner door seal (French door models).</p>
<p><strong>Every 3 months:</strong> Run Ice Off mode 2–3 days. Check drain pan.</p>
<p><strong>Every 6 months:</strong> Clean condenser coils. Replace water filter. Inspect water supply line.</p>
<p><strong>Annually:</strong> Deep clean ice maker and bin. Professional defrost system test.</p>

<h2>Samsung Dishwasher</h2>
<p><strong>Monthly:</strong> Clean filter assembly. Clean door gasket. Run cleaning cycle (empty + tablet or vinegar).</p>
<p><strong>Every 3 months:</strong> Inspect WaterWall track. Clean spray arms. Refill rinse aid.</p>
<p><strong>Every 6 months:</strong> Inspect all hose connections. Inspect door gasket closely.</p>

<h2>Samsung Oven / Range</h2>
<p><strong>After every use:</strong> Wipe spills while warm. Clean burner caps and grates (gas). Wipe control panel dry.</p>
<p><strong>Monthly:</strong> Clean burner ports with a pin (gas). Check oven temperature accuracy.</p>
<p><strong>Every 3 months:</strong> Inspect door gasket. Inspect bake and broil elements.</p>
<p><strong>Every 6 months:</strong> Self-clean if needed (sparingly). Test door hinges.</p>

<h2>Samsung Microwave</h2>
<p><strong>After every use:</strong> Wipe cavity and waveguide cover. Replace damaged waveguide cover immediately.</p>
<p><strong>Monthly:</strong> Clean grease filters (over-the-range). Run steam cleaning cycle (water + vinegar).</p>
<p><strong>Every 3 months:</strong> Inspect door seal and latches. Replace charcoal filter if recirculating model.</p>
<p><strong>Annually:</strong> Check turntable drive coupler. Test exhaust fan speed.</p>

<h2>Samsung Wall Oven</h2>
<p><strong>After every use:</strong> Wipe spills while warm. Check cavity after convection use.</p>
<p><strong>Monthly:</strong> Test temperature accuracy with thermometer. Visually inspect elements during operation.</p>
<p><strong>Every 3 months:</strong> Inspect door gasket. Inspect door hinges. Test door lock (without self-clean).</p>
<p><strong>Every 6 months:</strong> Clean convection fan area. Clean control panel. Self-clean if needed (sparingly).</p>",
        ],

    ];
}