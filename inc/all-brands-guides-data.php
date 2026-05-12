<?php
/**
 * Viking Appliance Repair Service — Guides Content Data
 *
 * Brand:      Viking only (USA market)
 * Appliances: Range, Refrigerator, Dishwasher, Cooktop, Wall Oven, Wine Cooler
 *
 * Each guide powers template-guide.php via ACF meta fields:
 *   _ar_brand, _ar_appliance_type, _ar_intro, _ar_steps[], _ar_faqs[]
 *
 * Only verified, accurate Viking appliance data is included.
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_guides_data(): array {
    $guides = array_merge(
        ar_guides_viking_range(),
        ar_guides_viking_refrigerator(),
        ar_guides_viking_dishwasher(),
        ar_guides_viking_cooktop()
    );

    foreach ( $guides as &$guide ) {
        if ( ! empty( $guide['image'] ) ) {
            $guide['meta_fields']['_ar_image'] = $guide['image'];
        }
    }
    unset( $guide );

    return $guides;
}

// ─────────────────────────────────────────────────────────────────────────────
// RANGE GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_viking_range(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Viking Range Not Heating — F-Code Diagnosis & Repair Guide',
            'slug'       => 'viking-range-not-heating',
            'image'      => get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png',
            'meta_title' => 'Viking Range Not Heating — F2, F3, F4 Diagnosis Guide',
            'meta_desc'  => 'Viking range not heating? This guide covers every cause — F2/F3 sensor faults, gas igniter failure, bake element failure — with diagnosis steps.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_intro'          => "A Viking range or wall oven that will not heat the oven cavity is one of the most common service calls for Viking appliances. The oven compartment in Viking gas and dual-fuel ranges is controlled by a combination of the electronic oven control, a temperature sensor, a gas igniter (on gas models), and a heating element (on electric/dual-fuel models). When any of these components fails, the oven stops heating. The good news: Viking ranges use a documented F-code fault system that pinpoints the problem.\n\nThis guide walks through every cause of a Viking oven not heating — from fault code interpretation to component-level diagnosis.",
                '_ar_steps'          => [
                    [ 'title' => 'Step 1: Check for an F-code fault display', 'content' => "Before anything else, check whether the control panel is displaying an F-code. Viking ranges and ovens document the following codes:\n\n• F2 — Temperature sensor shorted. The oven shuts down.\n• F3 — Temperature sensor open circuit. The oven shuts down.\n• F4 — Temperature runaway. The oven exceeded the set temperature.\n• F1 — Control board fault.\n• F9 — Self-clean door lock failure.\n\nIf your Viking oven shows one of these codes, the diagnostic work is largely complete — the code identifies the specific failed component. Schedule a professional repair." ],
                    [ 'title' => 'Step 2: Test for gas oven igniter failure (gas and dual-fuel models)', 'content' => "On Viking gas ranges, the oven does not use a standing pilot — it uses a hot surface igniter. When you set the oven to bake, you should see the igniter begin to glow orange within 30–45 seconds.\n\nIf the igniter glows but the oven does not light within 90 seconds, or if it glows dimly and briefly extinguishes: the igniter has weakened. A functioning igniter draws 3–3.5 amps to open the gas safety valve. A worn igniter draws less than this threshold and cannot open the valve, even though it still glows.\n\nIf the igniter does not glow at all: the igniter has failed completely or the circuit to it is broken.\n\nIgniter replacement is one of the most common Viking oven repairs and is completed in a single visit." ],
                    [ 'title' => 'Step 3: Check the bake element (dual-fuel / electric models)', 'content' => "In Viking dual-fuel ranges (gas cooktop, electric oven), the bake element at the bottom of the oven cavity provides the primary heat for baking. Inspect the element visually:\n\n• Look for visible breaks, blistering, or holes in the coil surface.\n• A burned or broken spot on the element indicates failure.\n\nA multimeter test (continuity test across the element terminals) confirms failure — a failed element reads open circuit.\n\nBake element replacement is a direct repair completed in a single visit." ],
                    [ 'title' => 'Step 4: Reset and monitor', 'content' => "If no fault code is displayed and no obvious component failure is visible, reset the oven by switching off the circuit breaker for 60 seconds, then restoring power. Attempt a bake cycle and monitor for:\n\n• A fault code appearing within the first few minutes.\n• The oven beginning to heat but then shutting off prematurely.\n• The oven showing a set temperature but never climbing.\n\nAny of these patterns during a test cycle indicates a specific component fault. Document the behavior for your technician to accelerate the diagnosis." ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'What is the most common reason a Viking oven stops heating?', 'answer' => 'For gas Viking ranges, a weakened or failed hot surface igniter is the most common cause of oven no-heat. The igniter wears gradually and eventually cannot draw sufficient current to open the gas safety valve. For dual-fuel Viking ranges, a failed bake element is most common. Both are identified with F-codes or simple visual inspection and are repaired in a single visit.' ],
                    [ 'question' => 'Can I use my Viking cooktop burners if the oven won\'t heat?', 'answer' => 'Yes — on most Viking ranges the cooktop burners and the oven operate on independent circuits. A failed oven igniter, bake element, or temperature sensor does not typically affect the gas cooktop burners. However, if the oven displays an F1 control board fault, the control panel may be completely unresponsive, which can affect burner ignition controls.' ],
                    [ 'question' => 'How long does a Viking oven repair typically take?', 'answer' => 'Most Viking oven no-heat repairs — including igniter replacement, bake element replacement, and temperature sensor replacement — are completed in 60–90 minutes in a single visit. Our technicians carry Viking OEM parts for the most common failure components.' ],
                ],
            ],
            'content' => '<p>A Viking range oven that will not heat can be caused by several specific component failures. Use the steps above to identify whether a fault code is displayed, whether the igniter is functioning on gas models, or whether the bake element has failed on electric/dual-fuel models. If you cannot identify a clear failure after these checks, schedule a professional diagnostic — our technicians carry the instruments and parts to resolve Viking oven no-heat faults on the first visit.</p>
<p><a href="/services/viking-range-repair/">View our Viking range repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>',
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Viking Range Burner Not Igniting — 5 Causes and How to Fix Each',
            'slug'       => 'viking-range-burner-not-igniting',
            'image'      => get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png',
            'meta_title' => 'Viking Range Burner Not Igniting — Diagnosis Guide for Gas Cooktops',
            'meta_desc'  => 'Viking gas range burner won\'t ignite? This guide covers the 5 most likely causes — from moisture to failed electrodes — with step-by-step fixes.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_intro'          => "Viking gas range burner ignition problems are among the most frequently reported faults on Viking appliances in the US. In the majority of cases, the cause is straightforward — moisture, a clogged burner port, or a misaligned burner cap — and can often be resolved at home before a technician is needed. This guide walks through all five causes in order of likelihood.",
                '_ar_steps'          => [
                    [ 'title' => 'Cause 1: Moisture around the burner (most common)', 'content' => "Moisture is the most frequent cause of Viking cooktop ignition failure. When liquid boils over or condenses around a burner, it enters the spark electrode area and either causes continuous clicking without ignition or prevents any spark at all.\n\nFix: Turn the burner off. Remove the burner cap and dry the area with a cloth. Allow the area to air dry for at least 30 minutes without the burner cap. Reinstall and test. This resolves moisture-related ignition problems in the majority of cases." ],
                    [ 'title' => 'Cause 2: Clogged burner flame ports', 'content' => "The flame ports around the circumference of the burner can clog with food residue, particularly from starchy or sticky liquids. Clogged ports produce a weak or uneven flame — or prevent ignition entirely.\n\nFix: Remove the burner cap. Use a straightened paper clip or small brush to clear each port opening. Dry cleaning only — do not soak or wet the burner base. For stubborn deposits on the cap itself, soak in mild dish soap solution and clean with a brush before rinsing and drying fully." ],
                    [ 'title' => 'Cause 3: Misaligned burner cap', 'content' => "Viking pro sealed burners require the burner cap to sit flat and centered on the burner base. A tilted or off-center cap — common after cleaning — causes the spark from the electrode to miss the gas ports.\n\nFix: Remove the cap, check the burner base for debris, and reseat the cap firmly and flush. It should sit completely level with no rocking." ],
                    [ 'title' => 'Cause 4: Failed spark electrode', 'content' => "The ceramic-tipped spark electrode produces the ignition spark. A cracked electrode tip, heavy carbon coating, or broken electrode produces no spark regardless of how clean and dry the burner area is.\n\nCheck: Inspect the electrode tip — it should be off-white, intact, and positioned approximately 1/8\" from the burner base. A cracked or heavily discolored tip requires professional electrode replacement." ],
                    [ 'title' => 'Cause 5: Failed ignition module', 'content' => "If a specific burner consistently fails to spark after addressing all of the above and the electrode is visually intact, the ignition module that generates the high-voltage spark pulse has failed. A faulty module produces no spark at all or an intermittent spark on one or more burners.\n\nIgnition module replacement requires professional service. Our technicians carry Viking-compatible modules and complete this repair in a single visit." ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why does my Viking cooktop click continuously after the burner is lit?', 'answer' => 'Continuous clicking after lighting is almost always moisture around the burner cap or electrode. The moisture causes the igniter to cycle without stopping. Dry the burner area thoroughly, replace the cap, and the clicking will stop. If clicking persists on a completely dry burner, the ignition module requires service.' ],
                    [ 'question' => 'One Viking burner doesn\'t ignite but the others do — what does that mean?', 'answer' => 'A single burner not igniting while others work normally points to a localized issue — a clogged port on that specific burner, a misaligned cap, or a failed electrode for that burner position. Start with cleaning and reseating the cap. If the burner still won\'t light with a clean, dry, properly seated cap, the spark electrode for that position needs replacement.' ],
                ],
            ],
            'content' => '<p>Viking gas range burner ignition problems are almost always caused by one of five issues — moisture, clogged ports, misaligned cap, failed electrode, or failed module. Work through the causes above in order. If the problem persists after addressing moisture, cleaning ports, and reseating the cap, professional electrode or module service is required. <a href="/services/viking-cooktop-repair/">View our Viking cooktop repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>',
        ],

        [
            'post_type'  => 'guide',
            'title'      => 'Viking Range Annual Maintenance Guide',
            'slug'       => 'viking-range-maintenance',
            'image'      => get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png',
            'meta_title' => 'Viking Range Maintenance Guide — Annual Cleaning & Inspection Routines',
            'meta_desc'  => 'Expert Viking range maintenance routines to prevent ignition failures, temperature drift, and self-clean issues. Gas and dual-fuel models covered.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_intro'          => "Viking ranges are designed for a service life of 20+ years with proper care. The maintenance routines below target the specific failure modes most commonly seen in Viking gas and dual-fuel ranges in the United States — burner ignition problems, oven temperature drift, and self-clean door lock issues.",
                '_ar_steps'          => [
                    [ 'title' => 'Monthly: Clean burner caps and flame ports', 'content' => "Remove each burner cap and clean the flame ports with a small brush or straightened paper clip. Food residue and grease accumulation in the ports is the leading cause of Viking cooktop ignition problems and weak or uneven flame output.\n\nDo not use water inside the burner base — dry cleaning only for the ports. The caps themselves can be soaked in soapy water and rinsed, but must be fully dry before reinstalling." ],
                    [ 'title' => 'Every 3 months: Verify oven temperature accuracy', 'content' => "Use a standalone oven thermometer to verify that your Viking oven is heating to within 25°F of the set temperature at 350°F. Allow the oven to fully preheat (10–15 minutes) before reading the thermometer.\n\nViking wall ovens and ranges allow a calibration offset adjustment via the control panel — consult your owner's manual for the specific adjustment procedure. A consistent deviation greater than 50°F that does not resolve with calibration adjustment indicates a temperature sensor fault (F2/F3)." ],
                    [ 'title' => 'Every 6 months: Inspect the oven door gasket', 'content' => "The oven door gasket creates the seal that keeps heat inside the oven. Inspect the full perimeter of the gasket for:\n• Tears or holes in the rubber\n• Sections that have hardened or lost flexibility\n• Areas where the gasket has separated from the door channel\n\nA damaged gasket reduces cooking efficiency and increases energy use. Replace if any of the above conditions are present." ],
                    [ 'title' => 'Annually: Run the self-clean cycle', 'content' => "Run the self-clean cycle once a year to reduce heavy grease buildup in the oven cavity. Before running:\n• Remove the oven racks (the high self-clean temperatures can discolor rack finishes).\n• Wipe out any large food deposits to reduce smoke during the cycle.\n• Ensure good kitchen ventilation.\n\nDo not interrupt the self-clean cycle once started — interrupting can trigger the F9 door lock fault code. Allow the cycle to complete fully and the oven to cool before opening the door." ],
                    [ 'title' => 'Annually: Inspect igniter function', 'content' => "With the oven set to Bake at 350°F, observe the igniter through the oven window. A healthy igniter glows bright orange and the oven burner ignites within 60–90 seconds. A dim glow, a glow that persists longer than 90 seconds without ignition, or no glow at all indicates an igniter that is weakening or has failed.\n\nWeak igniters should be replaced proactively — they commonly fail completely during a critical cooking occasion." ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'How do I clean Viking range burner grates?', 'answer' => 'Viking cast iron grates can be washed in a sink with hot soapy water and a stiff brush. For heavy buildup, place grates in a plastic bag with a small amount of ammonia overnight (outdoors or in a well-ventilated area) — the fumes loosen grease without scrubbing. Rinse thoroughly and dry completely before replacing on the range.' ],
                    [ 'question' => 'How often should I run the Viking oven self-clean cycle?', 'answer' => 'Viking recommends running the self-clean cycle no more than once per month and only when there is significant grease buildup. Annual self-cleaning is sufficient for most households. Running self-clean excessively can accelerate oven component wear due to the extremely high temperatures (800–900°F) reached during the cycle.' ],
                ],
            ],
            'content' => '<p>Consistent maintenance is the most effective way to maximize the service life of your Viking range. The monthly port cleaning alone prevents the majority of burner ignition problems — by far the most common Viking cooktop issue. When a repair is needed despite good maintenance, <a href="/services/viking-range-repair/">view our Viking range repair service</a> or <a href="/schedule/">schedule an appointment online</a>.</p>',
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// REFRIGERATOR GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_viking_refrigerator(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Viking Refrigerator Not Cooling — Causes, Diagnosis & Expert Advice',
            'slug'       => 'viking-refrigerator-not-cooling',
            'image'      => get_template_directory_uri() . '/assets/images/pexels-pixabay-373548.jpg',
            'meta_title' => 'Viking Refrigerator Not Cooling — Complete Diagnosis Guide',
            'meta_desc'  => 'Viking fridge not cooling? This guide covers every cause — dirty coils to defrost failure to compressor issues — with step-by-step troubleshooting.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_intro'          => "A Viking refrigerator that stops cooling is a genuine emergency — perishable food is at risk within hours of the temperature rising. Before calling a technician, work through these checks. In a meaningful percentage of cases, the cause is something accessible without tools.",
                '_ar_steps'          => [
                    [ 'title' => 'Step 1: Check the condenser coils', 'content' => "Viking built-in refrigerators have condenser coils located in the condenser compartment, typically accessed via the grille at the bottom or behind the unit. If these coils are coated with dust, the condenser cannot release heat and the refrigerator loses cooling capacity.\n\nFix: Vacuum the condenser coils with a brush attachment. This should be done at least annually. A thorough cleaning often restores full cooling performance if condenser restriction was the limiting factor." ],
                    [ 'title' => 'Step 2: Diagnose the defrost system (if freezer is cold but fridge is warm)', 'content' => "The most common pattern for a Viking refrigerator not cooling is: the freezer remains cold, but the fresh food compartment gradually warms over days or weeks. This specific pattern indicates a defrost system failure — the evaporator coil has iced over and blocked airflow to the refrigerator section.\n\nConfirmation: Open the freezer and remove the back panel to expose the evaporator. If you see a solid block of ice covering the evaporator coils, the defrost system has failed.\n\nProfessional repair required: A technician will manually defrost the evaporator, replace the failed defrost component (heater, thermostat, or defrost control), and verify the defrost cycle is functioning before leaving." ],
                    [ 'title' => 'Step 3: Check the condenser fan', 'content' => "The condenser fan removes heat from the condenser coils. With the refrigerator running, listen for the fan at the bottom rear of the unit. The fan should run whenever the compressor is running.\n\nNo fan sound during compressor operation: the condenser fan motor has failed. This allows heat to build up in the condenser compartment, reducing cooling efficiency significantly." ],
                    [ 'title' => 'Step 4: Check the door gaskets', 'content' => "A damaged door gasket allows warm room air to infiltrate continuously. Test: close the refrigerator door on a dollar bill. The bill should resist being pulled out. If it slides out freely, the gasket has lost its seal on that section of the door." ],
                    [ 'title' => 'Step 5: Assess the compressor', 'content' => "If the compressor is completely silent — no hum or vibration from the bottom rear of the unit — the issue may be a failed start relay, a failed compressor, or a control board fault. These require professional sealed-system assessment.\n\nNote: Viking built-in refrigerators represent a significant investment. In most cases, compressor-related repairs are still more economical than replacement, particularly on units under 15 years old." ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why is my Viking refrigerator warm but the freezer is cold?', 'answer' => 'This specific pattern — warm fridge, cold freezer — almost always indicates a defrost system failure. The evaporator coil has iced over completely, blocking the airflow that cools the fresh food compartment. The freezer stays cold because it is in direct contact with the frozen evaporator. A technician will manually defrost the evaporator and replace the specific defrost component that failed.' ],
                    [ 'question' => 'How long does food stay safe in a Viking refrigerator that stopped cooling?', 'answer' => 'USDA guidelines state that refrigerator food remains safe for approximately 4 hours with the door kept closed. Freezer contents remain safe for 24–48 hours depending on how full the freezer is. Keep doors closed as much as possible while awaiting repair.' ],
                    [ 'question' => 'Is it worth repairing a Viking built-in refrigerator?', 'answer' => 'Viking built-in refrigerators are engineered for a 20+ year service life and represent a substantial investment. For virtually all repairs except major sealed-system work on very old units, repair is significantly more economical than replacement. Our technicians will give you an honest written estimate before any work begins.' ],
                ],
            ],
            'content' => '<p>A Viking refrigerator not cooling is almost always caused by one of the conditions above. Work through the checks in order. If you identify a solid block of ice on the evaporator, clogged condenser coils, or a silent condenser fan, schedule a professional repair. <a href="/services/viking-refrigerator-repair/">View our Viking refrigerator repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>',
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// DISHWASHER GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_viking_dishwasher(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Viking Dishwasher Not Draining — Causes & Step-by-Step Fix',
            'slug'       => 'viking-dishwasher-not-draining',
            'image'      => get_template_directory_uri() . '/assets/images/5_Series_Kitchen_HQ-new.jpg',
            'meta_title' => 'Viking Dishwasher Not Draining — Water in Tub Fix Guide',
            'meta_desc'  => 'Viking dishwasher leaving standing water in the tub? This guide covers every drain fault cause — from clogged filter to failed pump — with step-by-step fixes.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_intro'          => "A Viking dishwasher that leaves standing water in the tub at the end of a cycle is one of the most common dishwasher faults. The majority of drain failures are caused by a clogged filter — a task that takes about five minutes to resolve yourself.",
                '_ar_steps'          => [
                    [ 'title' => 'Step 1: Clean the filter assembly', 'content' => "Viking dishwashers use a manual-clean filter at the bottom of the tub that must be cleaned regularly. A clogged filter is the most common cause of Viking dishwasher drain failures.\n\nHow to clean:\n1. Remove the lower rack.\n2. Locate the cylindrical filter at the center of the tub floor.\n3. Twist counter-clockwise and lift out.\n4. Rinse under running water, scrubbing gently with a brush to clear food particles and grease.\n5. Check inside the filter housing for any glass shards or bone fragments.\n6. Reinstall by twisting clockwise until locked.\n\nIf the filter is clean and the dishwasher still won't drain, continue to the next steps." ],
                    [ 'title' => 'Step 2: Run a drain-only cycle', 'content' => "Initiate a drain-only sequence: on most Viking dishwashers, press and hold the Start/Cancel or Cancel button for 3 seconds. Listen carefully during the drain phase:\n\n• Steady, forceful pumping sound = pump is running.\n• Silence during the drain phase = pump motor has failed.\n• Buzzing with no water movement = pump impeller is jammed (often by a glass shard or bone fragment lodged in the pump body).\n\nDocument what you hear for your technician." ],
                    [ 'title' => 'Step 3: Check the drain hose', 'content' => "If the pump is running but water remains, check the drain hose:\n• Inspect the hose behind the dishwasher for kinks.\n• Verify the hose connection at the sink drain or garbage disposal is not blocked.\n• If connected to a garbage disposal, confirm the disposal knockout plug has been removed (common if the disposal was recently installed).\n• Ensure the drain hose has a high-loop configuration to prevent siphoning." ],
                    [ 'title' => 'Step 4: Professional pump replacement if needed', 'content' => "If the filter is clean, the drain hose is clear, and the pump is silent or produces only buzzing during a drain cycle, the drain pump motor requires professional replacement. Our technicians carry genuine Viking OEM drain pump assemblies and complete this repair in a single visit." ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'How often should I clean the Viking dishwasher filter?', 'answer' => 'Viking recommends cleaning the filter monthly under normal use. In households with heavy use (daily cycles) or hard water, clean every two to three weeks. A clogged filter causes drain failures, reduces cleaning performance, and can allow water to sit in the bottom of the tub between cycles, creating odors.' ],
                    [ 'question' => 'Why is there water in the bottom of my Viking dishwasher when I open it?', 'answer' => 'A small amount of water at the very bottom of the tub (less than an inch) is normal on many dishwasher models — it keeps the door gasket moist and the sump seal from drying out. However, if water covers the bottom of the tub (more than an inch), this indicates a drain failure and the filter should be cleaned immediately.' ],
                ],
            ],
            'content' => '<p>Most Viking dishwasher drain failures are resolved by cleaning the filter. If the filter is clean and the dishwasher still won\'t drain, schedule a professional repair. <a href="/services/viking-dishwasher-repair/">View our Viking dishwasher repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>',
        ],

    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// COOKTOP GUIDES
// ─────────────────────────────────────────────────────────────────────────────

function ar_guides_viking_cooktop(): array {
    return [

        [
            'post_type'  => 'guide',
            'title'      => 'Viking Cooktop Maintenance Guide — Keep It Running Reliably',
            'slug'       => 'viking-cooktop-maintenance',
            'image'      => get_template_directory_uri() . '/assets/images/48InductionHomepageSlide2025-2-1536x691.png',
            'meta_title' => 'Viking Cooktop Maintenance Guide — Prevent Ignition & Burner Failures',
            'meta_desc'  => 'Expert Viking gas and induction cooktop maintenance routines. Prevent continuous clicking, ignition failures, and surface element wear with these routines.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Cooktop' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Cooktop',
                '_ar_intro'          => "Viking cooktops are engineered for professional-grade performance and durability. Consistent maintenance prevents the ignition failures, weak flames, and surface element issues that account for the majority of Viking cooktop service calls.",
                '_ar_steps'          => [
                    [ 'title' => 'Monthly (Gas): Clean burner caps and grates', 'content' => "Remove each burner cap and clean the flame ports with a small brush or straightened paper clip. This is the single most important maintenance task for a Viking gas cooktop — clogged ports are the primary cause of ignition problems and uneven flame.\n\nFor stubborn deposits on the caps: soak in hot soapy water, scrub with a stiff brush, rinse, and dry completely before reinstalling. Wet burner caps cause continuous clicking after cooking." ],
                    [ 'title' => 'Monthly (Gas): Clean around spark electrodes', 'content' => "Use a dry cloth or cotton swab to clean around the base of each spark electrode. Food residue and grease that accumulates on the electrode ceramic body can cause continuous clicking even when no burner is in use. Do not use water directly on the electrode — moisture in the electrode area causes ignition problems." ],
                    [ 'title' => 'Every 3 months (Induction): Inspect the cooktop surface', 'content' => "On Viking induction cooktops, inspect the ceramic glass surface for:\n• Cracks or chips (even small cracks in the glass should be professionally assessed before further use)\n• Residue buildup on zone indicators\n• Scratches from abrasive cleaners or pots being dragged across the surface\n\nClean the surface with a dedicated ceramic cooktop cleaner and a non-abrasive pad. Never use steel wool, scouring pads, or abrasive cleaners on induction glass surfaces." ],
                    [ 'title' => 'Annually: Test all burner ignition and flame quality', 'content' => "Light each burner and observe:\n• Ignition speed: each burner should ignite within 1–3 clicks.\n• Flame character: a healthy Viking burner flame is blue with orange tips, evenly distributed around the burner cap perimeter.\n• Flame continuity: the flame should remain stable and not flicker excessively at medium and low settings.\n\nBurners that ignite slowly, produce a weak or yellow flame, or extinguish at low settings may have clogged ports, misaligned caps, or weakening electrodes — address these before they become full failures." ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'How do I stop my Viking cooktop from clicking when it\'s off?', 'answer' => 'Continuous clicking when no burner is in use is almost always caused by moisture or food residue on or around the spark electrode. Remove the burner cap(s) and dry the electrode area thoroughly. Clean around the electrode with a dry cotton swab. Allow the area to air out for 30–60 minutes. If clicking persists on a completely dry, clean cooktop, the ignition switch for that burner position is faulty and requires service.' ],
                    [ 'question' => 'How do I clean Viking stainless steel cooktop surfaces?', 'answer' => 'Clean Viking stainless steel surfaces with a mild dish soap and warm water solution, using a soft cloth. Wipe in the direction of the grain. For stubborn stains, a dedicated stainless steel cleaner or a small amount of baking soda paste works well. Never use chlorine bleach, steel wool, or abrasive pads on stainless surfaces — they scratch the surface and can cause corrosion.' ],
                ],
            ],
            'content' => '<p>Monthly burner port cleaning is the single most effective maintenance task for Viking gas cooktops. Combined with the other routines above, these steps prevent the vast majority of Viking cooktop service calls. When a repair is needed, <a href="/services/viking-cooktop-repair/">view our Viking cooktop repair service</a> or <a href="/schedule/">book an appointment online</a>.</p>',
        ],

    ];
}


