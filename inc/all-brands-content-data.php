<?php
/**
 * Viking Appliance Repair Service — Service Page Content Data
 *
 * Brand:      Viking only (USA market)
 * Appliances: Range, Refrigerator, Dishwasher, Cooktop,
 *             Wall Oven, Wine Cooler  (6 products)
 *
 * Each entry powers template-service.php via ACF meta fields:
 *   _ar_brand, _ar_appliance_type, _ar_hero_subtitle,
 *   _ar_body_intro, _ar_common_issues[], _ar_services[], _ar_faqs[]
 *
 * _ar_services[] keyed array:
 *   [ 'name' => string, 'description' => string, 'price_range' => string ]
 *   price_range follows the "$X – $Y" US dollar convention.
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_content_data(): array {
    return ar_brand_viking();
}

function ar_brand_viking(): array {
    return [

        // ─────────────────────────────────────────────────────────────────────
        // 1. RANGE REPAIR
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Viking Range Repair',
            'slug'       => 'viking-range-repair',
            'meta_title' => 'Viking Range Repair | F1–F9 Fault Codes | Ignition & Oven | OEM Parts',
            'meta_desc'  => 'Expert Viking range repair for F1–F9 fault codes, burner ignition failures, and oven heating issues. Professional 5 Series and Tuscany specialists. Certified technicians, OEM parts, 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_hero_subtitle'  => 'Certified Viking range repair for Professional Series, Tuscany, and all Viking gas and dual-fuel models. Fault codes resolved using genuine Viking OEM parts with a 30-day warranty.',
                '_ar_body_intro'     => "Viking ranges are built to professional kitchen standards and are among the most durable and powerful residential ranges available in the United States. Viking's Professional Series features pro sealed burners with outputs ranging from 9,200 to 23,000 BTU, SureSpark continuous ignition, and precision oven temperature control. When a Viking range develops a fault — whether a burner ignition failure, an oven that won't reach temperature, or a control board displaying an F-code — the root cause is almost always a specific component that our trained technicians can identify and replace on the first visit.\n\nThe most frequently reported Viking range faults include burner ignition issues (clicking continuously or failing to light), oven not reaching the set temperature, F2/F3 temperature sensor faults, F9 self-clean door lock failures, and control board errors. Viking gas and dual-fuel ranges use the same oven control architecture, so fault codes and diagnostic procedures are consistent across the Professional Series, Tuscany, and Virtuoso lines.\n\nAll Viking range repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'F2 Fault — Oven Temperature Sensor Short',       'description' => 'The F2 fault on a Viking range indicates the oven temperature sensor is reading a short circuit. We test sensor resistance with a multimeter and replace the sensor probe with a genuine Viking OEM part.' ],
                    [ 'title' => 'F3 Fault — Oven Temperature Sensor Open',        'description' => 'F3 means the oven temperature sensor circuit is open (disconnected or broken). We inspect the sensor connector and wiring harness before replacing the probe if the element itself has failed.' ],
                    [ 'title' => 'F4 — Oven Temperature Runaway',                  'description' => 'The F4 fault triggers when the oven temperature exceeds the set temperature by more than 50°F. This indicates a failed oven relay on the control board or a stuck-open oven element. We diagnose the root cause and replace the specific failed component.' ],
                    [ 'title' => 'F1 — Control Board Fault',                        'description' => 'F1 indicates a main control board failure. We confirm this after ruling out sensor and wiring faults before recommending board replacement, ensuring the correct diagnostic is made before parts are ordered.' ],
                    [ 'title' => 'Burner Ignition Failure',                         'description' => 'Viking gas range burners that click continuously or fail to light are typically caused by clogged burner cap ports, a failed spark electrode, or moisture in the ignition module. We clean and test burner components, replacing the electrode or ignition module if needed.' ],
                    [ 'title' => 'F9 — Self-Clean Door Lock Failure',               'description' => 'F9 indicates the self-clean door lock mechanism has not engaged or disengaged correctly. We repair or replace the door lock motor assembly to restore safe self-clean operation.' ],
                    [ 'title' => 'Oven Not Heating',                                'description' => 'In Viking gas ranges, an oven that fails to heat is usually caused by a weak or failed hot surface igniter that cannot draw sufficient current to open the gas safety valve. In dual-fuel models, a failed bake element is the most common cause. We test and replace the specific component.' ],
                    [ 'title' => 'F7 — Key Stuck on Control Panel',                'description' => 'F7 indicates a keypad button is registering as permanently pressed. This typically results from moisture damage to the membrane keypad or physical damage to a switch. We replace the keypad or control panel assembly.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Fault Code Inspection',
                        'description' => 'A certified technician retrieves stored fault codes, performs a full electrical and mechanical inspection, and provides a written repair estimate before any work begins. Diagnostic fee applied toward repair cost.',
                        'price_range' => '$85 – $130',
                    ],
                    [
                        'name'        => 'Oven Temperature Sensor Replacement',
                        'description' => 'Replacement of the oven temperature sensor probe (RTD probe) with a genuine Viking OEM component. Resolves F2 and F3 fault codes and temperature inaccuracies.',
                        'price_range' => '$130 – $220',
                    ],
                    [
                        'name'        => 'Gas Oven Igniter Replacement',
                        'description' => 'Replacement of the hot surface igniter on Viking gas oven and range models. Resolves an oven that clicks or glows but will not light, or that lights slowly due to a weakened igniter.',
                        'price_range' => '$160 – $280',
                    ],
                    [
                        'name'        => 'Burner Electrode & Ignition Module Service',
                        'description' => 'Inspection, cleaning, and replacement of spark electrode components and ignition module for Viking gas cooktop and range burners. Resolves continuous clicking, failure to ignite, or uneven ignition.',
                        'price_range' => '$120 – $250',
                    ],
                    [
                        'name'        => 'Self-Clean Door Lock Repair',
                        'description' => 'Repair or replacement of the self-clean door lock motor and latch assembly. Resolves F9 fault codes and doors that remain locked after a self-clean cycle.',
                        'price_range' => '$150 – $260',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the main oven control board (ERC). Resolves F1 fault codes, blank or erratic displays, and unresponsive controls after component-level faults have been ruled out.',
                        'price_range' => '$250 – $480',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'What does the F2 fault code mean on a Viking range?', 'answer' => 'The F2 fault on a Viking range indicates the oven temperature sensor is reading a short circuit — the sensor\'s resistance is below the acceptable range for the current temperature. In many cases the sensor probe itself has failed, which is a straightforward replacement. We verify the wiring harness before replacing the sensor to ensure the correct fault is addressed.' ],
                    [ 'question' => 'Why are my Viking range burners clicking continuously?', 'answer' => 'Continuous clicking on a Viking gas range after the burner is lit — or without attempting to light — is almost always caused by moisture around the burner cap or spark electrode. Liquid spilled during cooking can enter the ignition module area. Dry the burner cap area thoroughly and allow the range to sit powered off for an hour. If clicking persists, the spark electrode or ignition module requires service.' ],
                    [ 'question' => 'My Viking oven is not reaching the set temperature — what causes this?', 'answer' => 'A Viking oven that runs but cannot reach or maintain the set temperature typically has a faulty oven temperature sensor (F2/F3 fault) or a weakening gas igniter that allows the oven burner to operate but at reduced output. A calibration offset that has drifted is also possible. Our technician will measure the sensor resistance and igniter current to identify the cause.' ],
                    [ 'question' => 'Is it worth repairing a Viking range?', 'answer' => 'Viking ranges are engineered for a service life of 20+ years and are built with commercial-grade components. For most repairs — including sensor replacement, igniter replacement, and control board issues — the repair cost is a fraction of replacement cost. We provide an honest written estimate before any work begins.' ],
                    [ 'question' => 'Do you repair both Viking gas and dual-fuel ranges?', 'answer' => 'Yes. Our technicians are trained on the full Viking range lineup including gas, dual-fuel, and electric models across all series. We carry genuine Viking OEM parts and are equipped to complete the majority of repairs on the first visit.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 2. REFRIGERATOR REPAIR
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Viking Refrigerator Repair',
            'slug'       => 'viking-refrigerator-repair',
            'meta_title' => 'Viking Refrigerator Repair | Cooling, Ice Maker, Compressor | OEM Parts',
            'meta_desc'  => 'Professional Viking refrigerator repair for cooling failures, ice maker faults, and compressor issues. Built-in and French door specialists. Genuine OEM parts. 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_hero_subtitle'  => 'Expert Viking refrigerator repair for built-in, side-by-side, and French door models. Cooling failures, ice maker issues, and compressor faults resolved with genuine Viking OEM parts and a 30-day warranty.',
                '_ar_body_intro'     => "Viking built-in refrigerators are among the most sophisticated residential refrigeration products available in the United States. Viking's built-in models feature flush-to-cabinet installation, dual evaporator systems to maintain separate humidity levels in the refrigerator and freezer, and precision temperature management for optimal food preservation. Viking also offers freestanding French door and side-by-side models across their product lines.\n\nWhen a Viking refrigerator develops a fault — whether a cooling failure, an ice maker that stops producing, or an unusual noise — our technicians arrive with the diagnostic equipment and genuine Viking OEM parts needed to resolve the issue on the first visit. Common Viking refrigerator faults include cooling system failures from defrost component issues, ice maker malfunctions, condenser fan motor failures, and compressor problems.\n\nAll Viking refrigerator repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'Not Cooling — Refrigerator Compartment Warm',  'description' => 'When a Viking refrigerator\'s fridge compartment warms while the freezer remains cold, the most common cause is a blocked evaporator from a failed defrost heater, defrost thermostat, or defrost control. We defrost the evaporator, diagnose the defrost circuit failure, and replace the specific failed component.' ],
                    [ 'title' => 'Ice Maker Not Producing Ice',                   'description' => 'Viking ice maker failures are typically caused by a failed ice maker assembly, a frozen water line, a failed inlet valve, or an ice maker thermostat fault. We diagnose the specific cause and replace only the failed component.' ],
                    [ 'title' => 'Excessive Noise — Buzzing or Rattling',         'description' => 'Unusual noise from a Viking refrigerator most commonly originates from a failing evaporator fan motor (buzzing or grinding from the freezer area), a failing condenser fan motor, or a compressor beginning to fail. We identify the noise source and replace the relevant motor or component.' ],
                    [ 'title' => 'Water Leaking Inside or Below Unit',            'description' => 'Water pooling beneath a Viking refrigerator typically indicates a blocked or frozen defrost drain tube. Water inside the fresh food compartment is usually caused by a door seal leak or condensation from a defrost drain issue. We clear the drain and address the root cause.' ],
                    [ 'title' => 'Compressor Not Running',                        'description' => 'A Viking refrigerator where the compressor is completely silent indicates a compressor failure, a failed start relay, or a control board fault. We perform a full sealed-system assessment to diagnose compressor and refrigerant circuit issues before recommending a course of action.' ],
                    [ 'title' => 'Temperature Inconsistency',                     'description' => 'Viking refrigerators that fluctuate in temperature or cannot hold the set temperature accurately may have a failing thermistor, a partially blocked condenser coil, or a door seal that is no longer creating an adequate seal. We diagnose and address the specific cause.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic Inspection',
                        'description' => 'Full diagnostic including temperature logging, defrost system check, fan motor test, and compressor evaluation. Written estimate provided before any repair work begins.',
                        'price_range' => '$85 – $130',
                    ],
                    [
                        'name'        => 'Defrost System Repair',
                        'description' => 'Diagnosis and replacement of failed defrost heater, defrost thermostat, or defrost timer/control. Includes manual defrost of the evaporator coil to restore airflow and proper cooling.',
                        'price_range' => '$180 – $320',
                    ],
                    [
                        'name'        => 'Ice Maker Repair / Replacement',
                        'description' => 'Diagnosis and repair or full replacement of the Viking ice maker assembly. Includes water inlet valve testing and water line inspection.',
                        'price_range' => '$200 – $380',
                    ],
                    [
                        'name'        => 'Evaporator / Condenser Fan Motor Replacement',
                        'description' => 'Replacement of a failed evaporator fan motor or condenser fan motor with a genuine Viking OEM component. Resolves unusual noises and cooling inefficiency caused by motor failure.',
                        'price_range' => '$160 – $290',
                    ],
                    [
                        'name'        => 'Door Gasket Replacement',
                        'description' => 'Replacement of a worn or damaged door gasket on Viking refrigerator or freezer section. Restores the airtight seal, reducing energy consumption and preventing internal condensation.',
                        'price_range' => '$140 – $250',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the main control board or temperature control module. Resolves temperature regulation faults and erratic refrigerator behavior.',
                        'price_range' => '$240 – $450',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why is my Viking refrigerator warm but the freezer is cold?', 'answer' => 'When the freezer stays cold but the fresh food compartment warms up, the defrost system has almost certainly failed. The evaporator coil ices over and blocks the airflow that cools the refrigerator section. The defrost heater, defrost thermostat, or the defrost control board component needs to be replaced. Our technician will manually defrost the evaporator to restore cooling immediately and then repair the underlying defrost circuit fault.' ],
                    [ 'question' => 'Why is my Viking ice maker not working?', 'answer' => 'Viking ice maker failures have several possible causes: a frozen water supply line in the door or back panel, a failed water inlet valve that is not opening, a failed ice maker thermostat or ejector motor, or an ice maker assembly that has simply worn out. We diagnose the specific cause during the visit and replace only the failed component.' ],
                    [ 'question' => 'Why is my Viking refrigerator making a buzzing noise?', 'answer' => 'A buzzing sound from the freezer compartment of a Viking refrigerator usually indicates the evaporator fan motor is struggling — either from bearing wear or from ice buildup around the fan blades. A buzzing from the bottom rear of the unit typically indicates the condenser fan motor. Both are straightforward motor replacements.' ],
                    [ 'question' => 'Is a Viking built-in refrigerator worth repairing?', 'answer' => 'Viking built-in refrigerators are designed for a service life of 20+ years and represent a significant investment. In virtually all cases except compressor replacement on older units, repair is far more economical than replacement. We carry genuine Viking OEM parts and provide a written estimate before work begins.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 3. DISHWASHER REPAIR
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Viking Dishwasher Repair',
            'slug'       => 'viking-dishwasher-repair',
            'meta_title' => 'Viking Dishwasher Repair | Not Cleaning, Draining, Starting | OEM Parts',
            'meta_desc'  => 'Professional Viking dishwasher repair for cleaning failures, drain faults, and cycle errors. Certified Viking specialists with genuine OEM parts and a 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_hero_subtitle'  => 'Expert Viking dishwasher repair for cleaning failures, drain issues, and fault codes. Genuine Viking OEM parts. 30-day warranty on every repair.',
                '_ar_body_intro'     => "Viking dishwashers deliver the quiet, thorough cleaning performance expected from a premium kitchen appliance. Viking's Professional dishwashers use a multi-level wash system with powerful spray arms, a stainless steel interior, and a quiet operation rating that keeps the kitchen peaceful during a cycle.\n\nWhen a Viking dishwasher fails to clean properly, won't start a cycle, or leaves standing water in the tub, the cause is almost always a specific mechanical or electrical fault that our certified technicians can diagnose and resolve on the first visit. Common Viking dishwasher faults include drain pump failures, wash motor issues, door latch failures, and heating element problems.\n\nAll Viking dishwasher repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'Not Cleaning Dishes Properly',   'description' => 'Poor wash performance in a Viking dishwasher is most commonly caused by a clogged filter assembly at the bottom of the tub, a blocked or damaged spray arm, or a failing wash pump that is losing pressure. We clean and inspect all wash components and replace any failed parts.' ],
                    [ 'title' => 'Not Draining — Water in Tub',    'description' => 'A Viking dishwasher that leaves water in the tub at the end of the cycle has a drain pump failure, a clogged drain hose, or a blocked air gap at the sink. We diagnose the drain circuit and replace the pump with a genuine Viking OEM component if required.' ],
                    [ 'title' => 'Will Not Start',                 'description' => 'A Viking dishwasher that will not start despite power being present typically has a failed door latch that is not signaling the control board, a failed door switch, or a control board fault. We systematically diagnose the start circuit to identify the root cause.' ],
                    [ 'title' => 'Cycle Not Completing',           'description' => 'A dishwasher that stops mid-cycle most commonly has a failing water heating element (water not reaching temperature), a failed cycle thermostat, or a control board fault that interrupts the program.' ],
                    [ 'title' => 'Water Leaking',                  'description' => 'Leaks from a Viking dishwasher originate most frequently from a worn door gasket that no longer seals, the door latch not closing fully, or a cracked spray arm causing water to spray outside the tub area.' ],
                    [ 'title' => 'Dishes Not Drying',              'description' => 'Viking dishwashers rely on a heated drying cycle and condensation drying. If dishes are not drying, the heating element may have failed, the rinse aid dispenser may be empty or faulty, or the cycle settings may need adjustment.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic Inspection',
                        'description' => 'Full dishwasher diagnostic including wash system pressure test, drain circuit check, door latch test, and control board evaluation. Written estimate before work begins.',
                        'price_range' => '$85 – $130',
                    ],
                    [
                        'name'        => 'Drain Pump Replacement',
                        'description' => 'Replacement of the drain pump motor assembly with a genuine Viking OEM part. Resolves standing water in the tub and failed drain cycles.',
                        'price_range' => '$170 – $290',
                    ],
                    [
                        'name'        => 'Wash Pump / Circulation Pump Replacement',
                        'description' => 'Replacement of the main circulation pump that drives water through the spray arms. Resolves poor cleaning performance and low wash pressure.',
                        'price_range' => '$220 – $380',
                    ],
                    [
                        'name'        => 'Door Gasket Replacement',
                        'description' => 'Replacement of the dishwasher door seal/gasket with a genuine Viking OEM component. Eliminates door leaks and restores the watertight seal.',
                        'price_range' => '$130 – $220',
                    ],
                    [
                        'name'        => 'Door Latch Assembly Replacement',
                        'description' => 'Replacement of the door latch and switch assembly. Resolves dishwashers that will not start because the control board cannot confirm a secured door.',
                        'price_range' => '$110 – $200',
                    ],
                    [
                        'name'        => 'Heating Element Replacement',
                        'description' => 'Replacement of the wash and/or dry heating element. Resolves dishes not drying, water that remains cold during cycles, and cycle interruptions from failed thermal cutoffs.',
                        'price_range' => '$150 – $270',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why is my Viking dishwasher not cleaning properly?', 'answer' => 'The most common cause of poor cleaning in a Viking dishwasher is a clogged filter assembly at the bottom of the tub. Viking dishwasher filters should be cleaned monthly — a heavily clogged filter restricts water circulation and dramatically reduces wash performance. If the filter is clean and cleaning is still poor, the wash pump or spray arm may require service.' ],
                    [ 'question' => 'Why is there water left in my Viking dishwasher at the end of the cycle?', 'answer' => 'Standing water in the tub after a cycle indicates a drain failure — most commonly a failed drain pump motor, a kinked or blocked drain hose, or a blocked household drain air gap at the sink. If you hear the drain pump attempting to run but water remains, the pump has likely failed and requires replacement.' ],
                    [ 'question' => 'How often should I clean my Viking dishwasher filter?', 'answer' => 'Viking recommends cleaning the filter assembly monthly under normal use. In households with hard water or very frequent use, every two to three weeks is advisable. A clean filter is the single most important maintenance task for maintaining Viking dishwasher cleaning performance.' ],
                    [ 'question' => 'Is it worth repairing a Viking dishwasher?', 'answer' => 'Viking dishwashers are built for long-term performance and are significantly more durable than standard residential dishwashers. For units less than 10 years old where the repair cost is below 50% of comparable replacement cost, repair is almost always the better financial choice. We use genuine Viking OEM parts on every repair.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 4. COOKTOP REPAIR
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Viking Cooktop Repair',
            'slug'       => 'viking-cooktop-repair',
            'meta_title' => 'Viking Cooktop Repair | Gas, Electric & Induction | Ignition | OEM Parts',
            'meta_desc'  => 'Professional Viking cooktop repair for burner ignition failures, surface element faults, and induction issues. Gas, electric, and induction specialists. OEM parts. 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Cooktop' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Cooktop',
                '_ar_hero_subtitle'  => 'Expert Viking cooktop repair for gas, electric, and induction models. Burner ignition, surface element, and induction zone faults resolved with genuine Viking OEM parts and a 30-day warranty.',
                '_ar_body_intro'     => "Viking cooktops are designed for professional-grade cooking performance in residential kitchens. Viking's gas cooktops feature pro sealed burners with multiple BTU levels for precise heat control, while Viking electric and induction cooktops deliver rapid, efficient heating across their respective surfaces.\n\nWhen a Viking cooktop develops a fault — a burner that won't ignite, a surface element that won't heat, or an induction zone that stops responding — our certified technicians can diagnose and resolve the issue on the first visit with genuine Viking OEM parts.\n\nAll Viking cooktop repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'Gas Burner Ignition Failure',        'description' => 'A Viking gas cooktop burner that clicks continuously or fails to light is typically caused by clogged burner cap ports, a food residue-contaminated spark electrode, or a failing ignition module. We clean burner components and replace the electrode or module if required.' ],
                    [ 'title' => 'Burner Will Not Maintain Flame',      'description' => 'A burner that ignites but immediately extinguishes has a faulty thermocouple or flame safety sensor that is not detecting the burner flame. We replace the relevant safety component with a genuine Viking OEM part.' ],
                    [ 'title' => 'Weak or Uneven Flame',                'description' => 'Reduced or uneven flame output on a Viking gas cooktop is caused by a partially clogged burner orifice, a bent or misaligned burner cap, or low gas supply pressure. We clean the orifice and inspect the gas supply connection.' ],
                    [ 'title' => 'Electric Surface Element Not Heating', 'description' => 'A failed surface element or a burned connection terminal on a Viking electric cooktop prevents the zone from heating. We test element resistance and replace the element or wiring as required.' ],
                    [ 'title' => 'Induction Zone Not Responding',       'description' => 'An induction cooktop zone that fails to activate may have a failed induction coil, a failed power board component, or an incorrect pan being used (induction requires magnetic cookware). We diagnose the cooktop electronics to identify the fault.' ],
                    [ 'title' => 'Control Panel Unresponsive',          'description' => 'An unresponsive touch control panel on a Viking cooktop typically indicates a failed control panel membrane, a failed ribbon connector, or a control board fault. We diagnose and replace the specific failed component.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic Inspection',
                        'description' => 'Full cooktop diagnostic covering all burners or surface zones, ignition system, control panel, and gas supply connections. Written estimate before work begins.',
                        'price_range' => '$85 – $130',
                    ],
                    [
                        'name'        => 'Spark Electrode Replacement',
                        'description' => 'Replacement of a failed spark electrode for one or more burner positions. Resolves continuous clicking or failure to ignite on specific burners.',
                        'price_range' => '$100 – $200',
                    ],
                    [
                        'name'        => 'Ignition Switch / Module Replacement',
                        'description' => 'Replacement of the ignition switch or ignitor module. Resolves cooktops where the spark system does not activate at all when a knob is turned to ignite.',
                        'price_range' => '$130 – $240',
                    ],
                    [
                        'name'        => 'Surface Element Replacement (Electric)',
                        'description' => 'Replacement of a failed surface heating element on Viking electric cooktops. Resolves zones that do not heat or heat only partially.',
                        'price_range' => '$150 – $270',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the cooktop main control board. Resolves unresponsive controls, erratic zone behavior, and persistent error displays.',
                        'price_range' => '$220 – $420',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why does my Viking gas cooktop keep clicking after the burner is lit?', 'answer' => 'Continuous clicking after a burner is lit is almost always caused by moisture around the burner cap or spark electrode — typically from liquid that boiled over during cooking. Turn the burner off, dry the burner cap area with a cloth, and allow the cooktop to air-dry for 30–60 minutes. If clicking persists when the area is completely dry, the spark electrode or ignition module requires service.' ],
                    [ 'question' => 'Can I use any cookware on a Viking induction cooktop?', 'answer' => 'Viking induction cooktops require magnetic cookware to function. Cast iron and most stainless steel pans are compatible. Aluminum, copper, and glass cookware will not work on induction unless they have a magnetic base layer. If a zone is not responding but activates on the same zone with different cookware, the issue is the pan rather than the cooktop.' ],
                    [ 'question' => 'My Viking cooktop burner lights but the flame goes out immediately — what is wrong?', 'answer' => 'A burner that lights and immediately extinguishes has a faulty flame safety system. Viking gas cooktops use thermocouples on the burner bodies to detect the flame. A worn thermocouple generates insufficient voltage to keep the gas valve open, causing immediate flame cutoff. Thermocouple replacement resolves this fault.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 5. WALL OVEN REPAIR
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Viking Wall Oven Repair',
            'slug'       => 'viking-wall-oven-repair',
            'meta_title' => 'Viking Wall Oven Repair | F1–F9 Fault Codes | Not Heating | OEM Parts',
            'meta_desc'  => 'Professional Viking wall oven repair for F1–F9 fault codes, temperature failures, and door lock issues. Single and double oven specialists. Genuine OEM parts. 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_hero_subtitle'  => 'Expert Viking wall oven repair for single and double models. F-code faults, temperature failures, and door lock issues resolved with genuine Viking OEM parts and a 30-day warranty.',
                '_ar_body_intro'     => "Viking single and double wall ovens bring professional-grade baking and roasting performance to residential kitchens. Viking's wall ovens feature precise temperature management, TruConvec convection systems with a dedicated convection element and third-element fan, and a self-cleaning mode on most models.\n\nWhen a Viking wall oven displays a fault code, fails to heat to the set temperature, or develops a door lock issue after self-cleaning, our certified technicians can diagnose and resolve the problem on the first visit. Viking wall ovens use the same F-code fault architecture as Viking ranges, making diagnosis straightforward for our brand-trained technicians.\n\nAll Viking wall oven repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'F2 / F3 Fault — Temperature Sensor Fault',     'description' => 'F2 indicates the oven temperature sensor is reading a short, and F3 indicates an open circuit. Both codes cause the oven to shut down as a safety measure. We test sensor resistance and replace the probe with a genuine Viking OEM component.' ],
                    [ 'title' => 'F4 Fault — Temperature Runaway',                'description' => 'F4 triggers when the oven temperature exceeds the set point by more than 50°F, indicating a failed oven relay or stuck heating element. We diagnose the specific control or element fault causing the runaway condition.' ],
                    [ 'title' => 'F9 Fault — Door Lock Failure',                  'description' => 'F9 means the self-clean door lock has not engaged or disengaged as expected. We repair or replace the door lock motor assembly to restore safe oven operation and self-clean capability.' ],
                    [ 'title' => 'Oven Not Heating',                              'description' => 'In Viking electric wall ovens, a failed bake element or broil element is the most common cause of a no-heat fault. We test each element for continuity and replace the failed component with a genuine Viking OEM part.' ],
                    [ 'title' => 'Temperature Inaccuracy',                        'description' => 'A Viking wall oven that heats but cannot maintain accurate temperature typically has a drifting temperature sensor or a control board that has lost calibration. We test the sensor and recalibrate or replace as required.' ],
                    [ 'title' => 'Door Locked After Self-Clean',                  'description' => 'A Viking wall oven door that remains locked after a self-clean cycle has a failed door lock motor or a thermal fuse that tripped during the cleaning cycle. We diagnose the door lock circuit and replace the failed component.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Fault Code Inspection',
                        'description' => 'Full diagnostic including fault code retrieval, element continuity testing, and temperature sensor measurement. Written estimate before work begins.',
                        'price_range' => '$85 – $130',
                    ],
                    [
                        'name'        => 'Bake / Broil Element Replacement',
                        'description' => 'Replacement of a failed bake or broil element with a genuine Viking OEM component. Resolves an oven that will not heat or heats only partially.',
                        'price_range' => '$150 – $270',
                    ],
                    [
                        'name'        => 'Oven Temperature Sensor Replacement',
                        'description' => 'Replacement of the oven RTD temperature sensor probe. Resolves F2 and F3 fault codes and temperature inaccuracy.',
                        'price_range' => '$130 – $220',
                    ],
                    [
                        'name'        => 'Self-Clean Door Lock Repair',
                        'description' => 'Repair or replacement of the self-clean door lock motor and latch assembly. Resolves F9 fault codes and doors locked after self-clean.',
                        'price_range' => '$160 – $280',
                    ],
                    [
                        'name'        => 'Convection Fan Motor Replacement',
                        'description' => 'Replacement of the convection fan motor. Resolves uneven baking results and noisy oven operation caused by a failing fan motor bearing.',
                        'price_range' => '$170 – $290',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the main oven control board. Resolves F1 fault codes, unresponsive controls, and erratic temperature behavior.',
                        'price_range' => '$260 – $490',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'What does the F9 fault code mean on a Viking wall oven?', 'answer' => 'The F9 fault code on a Viking wall oven indicates the self-clean door lock mechanism has not engaged or disengaged correctly. The oven shuts down as a safety measure to prevent the self-clean cycle from running with an improperly locked door. The door lock motor assembly or the wiring to the motor most commonly needs to be repaired or replaced.' ],
                    [ 'question' => 'My Viking oven shows an F2 code — can I continue cooking?', 'answer' => 'No. The F2 fault code indicates the temperature sensor circuit is shorted, which means the oven control board is receiving an incorrect temperature reading. Continuing to use the oven risks temperature runaway or complete loss of temperature control. Turn the oven off and schedule a repair. F2 repairs are typically completed in a single visit.' ],
                    [ 'question' => 'How accurate is the Viking wall oven temperature?', 'answer' => 'Viking wall ovens are engineered for precise temperature control. New ovens may have a calibration offset of ±10–25°F, which is normal and adjustable via the control panel. If the temperature has drifted significantly and recalibration does not resolve it, the temperature sensor may need to be replaced.' ],
                    [ 'question' => 'Do you repair Viking double wall ovens?', 'answer' => 'Yes. We repair all Viking wall oven configurations including single wall ovens, double wall ovens, and combination microwave-wall oven units. Our technicians carry genuine Viking OEM parts for the full wall oven lineup.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 6. WINE COOLER REPAIR
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Viking Wine Cooler Repair',
            'slug'       => 'viking-wine-cooler-repair',
            'meta_title' => 'Viking Wine Cooler Repair | Not Cooling, Fault Codes | OEM Parts',
            'meta_desc'  => 'Professional Viking wine cooler repair for cooling failures, compressor issues, and temperature faults. Single and dual-zone specialists. Genuine OEM parts. 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Wine Cooler' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Wine Cooler',
                '_ar_hero_subtitle'  => 'Expert Viking wine cooler repair for single and dual-zone models. Cooling failures, compressor issues, and temperature faults resolved with genuine Viking OEM parts and a 30-day warranty.',
                '_ar_body_intro'     => "Viking wine cellars and wine coolers are designed to maintain the precise temperature and humidity conditions required for proper wine storage. Viking's single and dual-zone wine coolers feature a quiet compressor cooling system, UV-resistant tinted glass, vibration-dampening shelving, and precise digital temperature control.\n\nWhen a Viking wine cooler fails to maintain the set temperature, makes unusual noise, or displays a fault code, our certified technicians can diagnose and resolve the issue on the first visit. Common Viking wine cooler faults include compressor failures, condenser fan motor issues, temperature sensor faults, and cooling system deficiencies.\n\nAll Viking wine cooler repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'Not Cooling — Temperature Too Warm',    'description' => 'A Viking wine cooler that cannot reach or maintain the set temperature typically has a failing compressor, a condenser coil that needs cleaning, or a failed condenser fan motor preventing heat dissipation. We diagnose the cooling system to identify the specific fault.' ],
                    [ 'title' => 'Compressor Running Continuously',        'description' => 'A compressor that runs constantly without reaching temperature indicates a refrigerant leak, a failed compressor, or a condenser that is heavily clogged with dust. We perform a sealed system assessment to diagnose the issue.' ],
                    [ 'title' => 'Excessive Noise',                        'description' => 'Unusual noise from a Viking wine cooler — buzzing, rattling, or vibrating — most commonly originates from a failing compressor, a loose condenser fan blade, or vibrating internal shelving. We identify the noise source and repair accordingly.' ],
                    [ 'title' => 'Temperature Fluctuating Between Zones', 'description' => 'In dual-zone Viking wine coolers, temperature inconsistency between zones typically indicates a failed zone damper, a faulty thermistor in one zone, or a control board issue affecting zone management.' ],
                    [ 'title' => 'Fault Code on Display',                  'description' => 'Viking wine coolers display fault codes when a sensor or system component is out of range. We read and interpret the specific code displayed and replace the component identified by the diagnostic.' ],
                    [ 'title' => 'Interior Light Not Working',             'description' => 'A non-functioning interior light on a Viking wine cooler typically has a failed LED module or a failing door switch that activates the light. We replace the failed lighting component.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic Inspection',
                        'description' => 'Full wine cooler diagnostic including temperature logging over a test cycle, compressor evaluation, fan motor test, and control board assessment. Written estimate before work begins.',
                        'price_range' => '$85 – $130',
                    ],
                    [
                        'name'        => 'Condenser Fan Motor Replacement',
                        'description' => 'Replacement of the condenser fan motor with a genuine Viking OEM component. Resolves overheating, temperature failures caused by inadequate condenser cooling, and buzzing noise from the rear of the unit.',
                        'price_range' => '$160 – $270',
                    ],
                    [
                        'name'        => 'Temperature Sensor Replacement',
                        'description' => 'Replacement of a failed thermistor or temperature sensor. Resolves inaccurate temperature readings and fault code displays related to temperature sensing.',
                        'price_range' => '$110 – $200',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the main control board. Resolves unresponsive temperature controls, persistent fault codes, and erratic cooling behavior.',
                        'price_range' => '$220 – $400',
                    ],
                    [
                        'name'        => 'Condenser Coil Cleaning Service',
                        'description' => 'Professional cleaning of the condenser coil to restore heat dissipation efficiency. Recommended annually to maintain cooling performance and prevent compressor overload.',
                        'price_range' => '$95 – $150',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why is my Viking wine cooler not cooling?', 'answer' => 'The most common causes of a Viking wine cooler not cooling are: a condenser coil that is clogged with dust and cannot dissipate heat, a failing condenser fan motor, a refrigerant leak, or a failing compressor. We recommend an annual condenser cleaning as preventative maintenance. If the cooler suddenly stops cooling and the condenser is clean, the compressor or refrigerant circuit likely requires service.' ],
                    [ 'question' => 'What is the ideal temperature setting for a Viking wine cooler?', 'answer' => 'Red wines are best stored at 55–65°F (13–18°C) depending on the varietal. White wines and sparkling wines prefer 45–55°F (7–13°C). Viking dual-zone coolers allow different zones to be set independently. For long-term storage of all wine types, 55°F is a widely accepted all-purpose temperature.' ],
                    [ 'question' => 'How often should I clean the condenser on my Viking wine cooler?', 'answer' => 'We recommend cleaning the condenser coil at least once a year, or every six months in households with pets whose hair can accelerate dust buildup. A clogged condenser forces the compressor to work harder, reduces cooling efficiency, and significantly shortens compressor life.' ],
                    [ 'question' => 'Is it worth repairing a Viking wine cooler?', 'answer' => 'Viking wine coolers are premium products with a long expected service life. For all but the most severe compressor failures, repair is almost always more cost-effective than replacement. We provide an honest written assessment of repair vs. replacement value before any work is authorized.' ],
                ],
            ],
        ],

    ]; // end return
}
