<?php
/**
 * Samsung Appliances — Service Page Content Data
 *
 * Brand:      Samsung only
 * Appliances: Washer, Dryer, Refrigerator, Dishwasher,
 *             Oven / Range, Microwave, Wall Oven  (7 products)
 *
 * Each entry powers template-service.php via ACF meta fields:
 *   _ar_brand, _ar_appliance_type, _ar_hero_subtitle,
 *   _ar_body_intro, _ar_common_issues[], _ar_services[], _ar_faqs[]
 *
 * _ar_services[] is a US-standard keyed array added in this revision:
 *   [ 'name' => string, 'description' => string, 'price_range' => string ]
 *   price_range follows the "$X – $Y" US dollar convention.
 *
 * Features and process steps fall back to template defaults (see template-service.php).
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_content_data(): array {
    return ar_brand_samsung();
}

function ar_brand_samsung(): array {
    return [

        // ─────────────────────────────────────────────────────────────────────
        // 1. WASHER
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Samsung Washer Repair',
            'slug'       => 'samsung-washer-repair',
            'meta_title' => 'Samsung Washer Repair | 4C, 5E, UB Error Codes | OEM Parts',
            'meta_desc'  => 'Expert Samsung washer repair for 4C, 5E, UB, DC, and all error codes. VRT Plus and EcoBubble specialists. Certified technicians, OEM parts, 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_hero_subtitle'  => 'Certified Samsung washer repair for VRT Plus, EcoBubble, and all Samsung models. Error codes fixed using genuine OEM parts with a 30-day warranty.',
                '_ar_body_intro'     => "Samsung washing machines incorporate VRT Plus vibration reduction technology, EcoBubble washing at lower temperatures, and SmartThings connectivity in their latest models. When a Samsung washer displays an error code or develops a mechanical fault, the cause is typically a specific component failure that our brand-trained technicians can identify and resolve on the first visit.\n\nThe most common Samsung washer faults include 4C/4E water supply errors, 5E/5C drain failures, UB unbalance detection, and DC door lock issues. In front-load Samsung washers, door seal deterioration and drum bearing wear are also frequently reported faults. We stock a comprehensive inventory of genuine Samsung OEM parts for rapid completion.\n\nAll Samsung washer repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => '4C / 4E Error — Water Supply Fault',    'description' => 'Samsung washer 4C/4E errors indicate insufficient water entering the drum. We check the water supply valve, inlet hose kinks, and inlet valve solenoid, replacing the valve with a genuine Samsung OEM part if failed.' ],
                    [ 'title' => '5E / 5C Error — Drain Failure',          'description' => 'The 5E error means the Samsung washer cannot drain. We inspect the pump filter, drain pump, and drain hose. The pump is replaced with a genuine Samsung OEM component if required.' ],
                    [ 'title' => 'UB Error — Unbalance Detection',         'description' => 'Persistent UB errors after redistributing the load indicate worn suspension rods, damaged shock absorbers, or a faulty balance sensor. We inspect and replace the relevant suspension components.' ],
                    [ 'title' => 'DC Error — Door Lock Fault',             'description' => 'The Samsung DC error means the door lock is not confirming a locked state. We replace the door latch assembly and test through multiple cycles to confirm resolution.' ],
                    [ 'title' => 'HE Error — Heater Fault',                'description' => 'Samsung HE errors indicate a problem with the wash heater or temperature sensor. We test resistance values and replace the failed component with a genuine Samsung OEM part.' ],
                    [ 'title' => 'Leaking Water',                          'description' => 'Samsung front-load washer leaks most commonly originate from the door boot gasket, the dispenser drawer seal, or the drain pump housing. We identify the source and replace the relevant component.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Error Code Inspection',
                        'description' => 'A certified technician reads stored error codes, performs a full electrical and mechanical inspection, and provides a written repair estimate before any work begins. Diagnostic fee applied toward repair cost.',
                        'price_range' => '$75 – $120',
                    ],
                    [
                        'name'        => 'Drain Pump Replacement',
                        'description' => 'Replacement of a failed drain pump with a genuine Samsung OEM component. Resolves 5E/5C error codes and standing water in the drum. Includes filter cleaning and drain hose inspection.',
                        'price_range' => '$150 – $250',
                    ],
                    [
                        'name'        => 'Water Inlet Valve Replacement',
                        'description' => 'Replacement of the water inlet valve solenoid assembly that controls hot and cold water fill. Resolves 4C/4E error codes and slow or no-fill conditions.',
                        'price_range' => '$120 – $200',
                    ],
                    [
                        'name'        => 'Door Boot Seal (Gasket) Replacement',
                        'description' => 'Replacement of the front-load washer door boot gasket. Eliminates leaks at the door opening and resolves mold or odor issues caused by a torn or deteriorated seal.',
                        'price_range' => '$150 – $280',
                    ],
                    [
                        'name'        => 'Drum Bearing & Shaft Repair',
                        'description' => 'Replacement of worn drum bearings and shaft seal. Eliminates grinding or rumbling noise during the spin cycle and prevents drum wobble from progressing to a seized drum.',
                        'price_range' => '$220 – $380',
                    ],
                    [
                        'name'        => 'Suspension Rod Set Replacement',
                        'description' => 'Replacement of all four suspension rods and shock absorbers. Resolves persistent UB unbalance errors and violent shaking during the spin cycle that cannot be resolved by redistributing the load.',
                        'price_range' => '$160 – $260',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of a failed main control board (PCB). Resolves unresponsive controls, erratic cycle behavior, and error codes that persist after component-level repairs.',
                        'price_range' => '$200 – $380',
                    ],
                    [
                        'name'        => 'Door Latch Assembly Replacement',
                        'description' => 'Replacement of the door lock and latch assembly. Resolves DC door lock errors and washers that will not start because the control cannot confirm a secured door.',
                        'price_range' => '$100 – $180',
                    ],
                    [
                        'name'        => 'Thermal Fuse & Heating Element Service',
                        'description' => 'Testing and replacement of the wash heater, thermistor, and thermal safety components. Resolves HE heater errors and wash cycles that run cold.',
                        'price_range' => '$130 – $230',
                    ],
                    [
                        'name'        => 'Detergent Dispenser Drawer Repair',
                        'description' => 'Cleaning, repair, or full replacement of the detergent and fabric softener dispenser drawer assembly. Resolves detergent remaining in the drawer after the cycle and mold buildup in the dispenser housing.',
                        'price_range' => '$80 – $160',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why is my Samsung washer leaking?',           'answer' => 'Samsung front-load washer leaks most commonly come from the door boot seal (which can tear or develop mold and deformation over time), the detergent dispenser drawer seal, or the drain pump. Rear leaks are usually from hose connections. We identify the exact source during the visit and replace only the failed component.' ],
                    [ 'question' => 'What does the Samsung 5E error code mean?',   'answer' => 'The Samsung 5E (or 5C) error means the washer cannot drain the wash water within the allowed time. Start by checking and cleaning the pump filter (located behind a small access panel at the front bottom of the machine) — this resolves many 5E errors. If the error persists after filter cleaning, the drain pump itself has likely failed.' ],
                    [ 'question' => 'Why is my Samsung washer shaking violently?', 'answer' => 'Violent shaking in a Samsung washer during the spin cycle is caused by an unbalanced load (redistribute items and retry), worn suspension rods that no longer dampen drum movement, or a leveling issue if the machine is not sitting on all four feet evenly. VRT Plus technology reduces but does not eliminate vibration from mechanical wear.' ],
                    [ 'question' => 'How do I reset my Samsung washer?',            'answer' => 'To reset a Samsung washer, turn the machine off and unplug it from the wall outlet for 60 seconds, then plug it back in and restart. For a control panel reset on most models, press and hold the Start/Pause button for 5 seconds. If an error code returns immediately after reset, the underlying fault has not been resolved.' ],
                    [ 'question' => 'Is it worth repairing a Samsung washer?',     'answer' => 'Samsung washers have a designed service life of approximately 10 to 14 years. If your machine is under 8 years old and the repair cost is below 50% of a comparable replacement, repair typically delivers better value. Our technician will give you an honest assessment before any work begins.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 2. DRYER
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Samsung Dryer Repair',
            'slug'       => 'samsung-dryer-repair',
            'meta_title' => 'Samsung Dryer Repair | HE, HC Error Codes | No Heat | OEM Parts',
            'meta_desc'  => 'Professional Samsung dryer repair for HE, HC error codes and no-heat faults. Gas and electric models. Certified technicians, genuine OEM parts, 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_hero_subtitle'  => 'Expert Samsung dryer repair for gas and electric models. HE/HC error codes, no heat, drum issues resolved using genuine OEM parts with a 30-day warranty.',
                '_ar_body_intro'     => "Samsung dryers feature Sensor Dry technology that monitors moisture levels in the drum to prevent over-drying, along with multi-steam capabilities in select models. When a Samsung dryer stops producing heat, displays an HE or HC error, or develops mechanical issues such as a broken belt or seized bearing, our technicians are equipped to resolve the problem efficiently.\n\nThe most common Samsung dryer failures include blown thermal fuses from restricted exhaust venting, heating element failures in electric models, gas valve coil failures in gas models, and drum belt breakage. We stock genuine Samsung OEM dryer parts for the full model range.\n\nAll repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'HE / HC Error — Heater Circuit Fault',   'description' => 'Samsung HE/HC errors indicate a heating circuit fault — typically a failed thermistor, blown thermal fuse, or failed heating element. We test each component and replace the failed part with a genuine Samsung OEM component.' ],
                    [ 'title' => 'No Heat',                                 'description' => 'A Samsung dryer running cold is most often caused by a blown thermal fuse (the most common Samsung dryer fault), a failed heating element in electric models, or failed gas valve coils in gas models. We diagnose and replace the specific failed component.' ],
                    [ 'title' => 'Drum Not Turning',                        'description' => 'A Samsung dryer drum that will not rotate indicates a broken drive belt or failed drum motor. We carry the most common Samsung belt sizes and complete this repair in a single visit.' ],
                    [ 'title' => 'Overheating',                             'description' => 'A Samsung dryer that gets too hot is usually caused by a blocked exhaust vent, a failed cycling thermostat that no longer regulates temperature, or a defective high-limit thermostat.' ],
                    [ 'title' => 'Not Starting',                            'description' => 'A door switch failure, blown thermal fuse, or control board fault can prevent the Samsung dryer from starting. We systematically diagnose the starting circuit to identify the root cause.' ],
                    [ 'title' => 'Clothes Still Damp After Full Cycle',     'description' => 'If a Samsung dryer runs but leaves clothes damp, the moisture sensor bar may be coated with fabric softener residue (clean with rubbing alcohol), the exhaust vent may be partially blocked, or the heating element may be partially failed.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Error Code Inspection',
                        'description' => 'Full electrical and mechanical inspection with error code retrieval. Written estimate provided before repair begins. Diagnostic fee applied toward repair.',
                        'price_range' => '$75 – $120',
                    ],
                    [
                        'name'        => 'Thermal Fuse Replacement',
                        'description' => 'Replacement of the blown thermal fuse — the single most common Samsung dryer repair. Includes exhaust vent inspection and clearance check to address the root cause of fuse failure.',
                        'price_range' => '$100 – $180',
                    ],
                    [
                        'name'        => 'Heating Element Replacement (Electric)',
                        'description' => 'Replacement of the electric heating element with a genuine Samsung OEM part. Restores full heat output. Includes thermal fuse and thermostat testing.',
                        'price_range' => '$140 – $240',
                    ],
                    [
                        'name'        => 'Gas Valve Coil Replacement',
                        'description' => 'Replacement of the gas valve coil set on Samsung gas dryers. Resolves ignition issues where the burner ignites briefly then shuts off, or fails to ignite at all.',
                        'price_range' => '$130 – $220',
                    ],
                    [
                        'name'        => 'Drive Belt & Idler Pulley Replacement',
                        'description' => 'Replacement of the drum drive belt and idler pulley assembly. Resolves a drum that will not rotate and eliminates squealing or thumping noises caused by a worn belt.',
                        'price_range' => '$120 – $200',
                    ],
                    [
                        'name'        => 'Drum Roller & Bearing Replacement',
                        'description' => 'Replacement of worn drum support rollers and axles. Eliminates loud thumping, squeaking, or grinding during the drum cycle caused by failed roller bearings.',
                        'price_range' => '$140 – $240',
                    ],
                    [
                        'name'        => 'Cycling Thermostat & High-Limit Thermostat Replacement',
                        'description' => 'Testing and replacement of thermostat components that regulate drum temperature. Resolves overheating and extended drying times caused by a thermostat that has drifted out of specification.',
                        'price_range' => '$110 – $190',
                    ],
                    [
                        'name'        => 'Moisture Sensor Bar Cleaning & Replacement',
                        'description' => 'Cleaning or replacement of the Sensor Dry moisture sensor bar. Resolves premature cycle shutoff and under-drying caused by residue-coated sensor strips.',
                        'price_range' => '$80 – $150',
                    ],
                    [
                        'name'        => 'Door Switch Replacement',
                        'description' => 'Replacement of a failed door switch that prevents the dryer from starting. Includes door seal and latch inspection.',
                        'price_range' => '$90 – $160',
                    ],
                    [
                        'name'        => 'Vent System Cleaning & Flow Test',
                        'description' => 'Professional dryer exhaust vent cleaning from the dryer connection to the exterior cap, plus airflow measurement. Prevents thermal fuse failure, overheating, and fire hazard from lint accumulation.',
                        'price_range' => '$80 – $140',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why is my Samsung dryer not heating?',             'answer' => 'The most common cause of a Samsung dryer not heating is a blown thermal fuse — a one-time safety device that cuts power to the heating circuit permanently when the dryer overheats, usually from a restricted exhaust vent. After thermal fuse replacement, we always check and clear the exhaust vent to prevent recurrence.' ],
                    [ 'question' => 'How long does a Samsung dryer repair take?',       'answer' => 'Most Samsung dryer repairs — including thermal fuse replacement, heating element repair, and drum belt replacement — are completed in a single visit of 1 to 2 hours. We arrive with the most commonly required parts in the vehicle.' ],
                    [ 'question' => 'Why does my Samsung dryer make noise?',            'answer' => 'Loud thumping during the drum cycle usually indicates a worn drum bearing or drum roller. A squealing sound is typical of a worn idler pulley. A rattling sound often means a foreign object (button, coin) inside the drum. We identify the source of the noise and replace the relevant worn component.' ],
                    [ 'question' => 'Why is my Samsung dryer taking too long to dry?', 'answer' => 'Extended drying times on a Samsung dryer are almost always caused by restricted exhaust airflow — a clogged lint screen, a kinked or blocked vent hose, or a blocked exterior vent cap. A clogged lint screen alone can increase drying time by 30–40%. If the vent is clear and drying is still slow, the Sensor Dry moisture sensor bar may be coated with fabric softener residue — clean it with rubbing alcohol.' ],
                    [ 'question' => 'Is it worth repairing a Samsung dryer?',          'answer' => 'Samsung dryers are designed for a 10 to 13-year service life. For dryers under 8 years old where the repair cost is below 50% of a comparable replacement, professional repair is almost always the better investment. Most common Samsung dryer faults — thermal fuse, heating element, drum belt — are straightforward, cost-effective repairs. We provide a transparent quote before any work begins.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 3. REFRIGERATOR
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Samsung Refrigerator Repair',
            'slug'       => 'samsung-refrigerator-repair',
            'meta_title' => 'Samsung Refrigerator Repair | Cooling, Ice Maker, Error Codes',
            'meta_desc'  => 'Professional Samsung refrigerator repair for cooling failures, ice maker faults, and error codes. French door and side-by-side specialists. OEM parts. 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_hero_subtitle'  => 'Expert Samsung refrigerator repair for cooling failures, ice maker issues, and all error codes. French door, side-by-side, and 4-door Flex specialists. OEM parts. 30-day warranty.',
                '_ar_body_intro'     => "Samsung refrigerators — including the Family Hub, 4-Door Flex, French door, and side-by-side ranges — incorporate Digital Inverter Compressor technology and a range of SmartThings-connected features. Samsung refrigerators have experienced known issues with certain model generations, particularly relating to ice maker performance and defrost system function, and our technicians are specifically trained on these failure patterns.\n\nThe most common Samsung refrigerator faults we repair include ice maker failures from the fan motor freezing (a well-documented Samsung issue), defrost system failures causing evaporator icing, compressor faults, and sealed system problems. We carry genuine Samsung OEM parts for rapid first-visit resolution.\n\nAll repairs use genuine Samsung OEM components and are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'Ice Maker Not Making Ice / Fan Freezing',  'description' => 'A well-documented Samsung issue: the ice maker evaporator fan freezes over, stopping ice production and causing a humming or buzzing sound. We perform the appropriate repair — which may include installing a modified ice maker kit or applying a Samsung-specified fix.' ],
                    [ 'title' => 'Not Cooling — Defrost Failure',            'description' => 'Samsung refrigerators are susceptible to defrost heater and defrost thermostat failures that cause the evaporator to ice over and block airflow. The fridge section warms while the freezer may remain cold. We replace the defrost components and manually defrost the evaporator.' ],
                    [ 'title' => 'PC ER / 8E / 14E Error Codes',            'description' => 'These Samsung error codes indicate sensor, ice maker motor, or defrost system faults. We read the error code memory using diagnostic equipment and identify the specific failed component.' ],
                    [ 'title' => 'Water Leaking Inside or Under Fridge',    'description' => 'Water pooling beneath a Samsung refrigerator is typically caused by a blocked defrost drain tube. Water pooling inside is usually a door seal issue or an overfilled ice maker. We clear and repair the specific cause.' ],
                    [ 'title' => 'Compressor Problems',                     'description' => 'Samsung Digital Inverter Compressor failures manifest as the fridge not cooling at all with no compressor sound, or cycling on and off abnormally. We perform a full sealed system assessment to diagnose compressor and refrigerant issues.' ],
                    [ 'title' => 'Water Dispenser Not Working',             'description' => 'Samsung water dispenser faults typically involve a frozen water line in the door, a failed inlet valve, or a broken actuator switch in the dispenser paddle. We diagnose and repair the specific cause.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Error Code Inspection',
                        'description' => 'Full system diagnostic including stored error code retrieval, temperature measurement across all compartments, and sealed system assessment. Written estimate before any repair begins.',
                        'price_range' => '$75 – $120',
                    ],
                    [
                        'name'        => 'Ice Maker Repair & Updated Kit Installation',
                        'description' => 'Diagnosis and repair of Samsung ice maker failures including fan freeze-over. Includes defrosting the ice maker compartment and installing an updated Samsung ice maker kit where applicable.',
                        'price_range' => '$180 – $320',
                    ],
                    [
                        'name'        => 'Defrost System Repair',
                        'description' => 'Replacement of failed defrost heater, defrost thermostat, and defrost timer/control components. Includes manual evaporator defrost. Resolves a warm refrigerator compartment caused by evaporator ice blockage.',
                        'price_range' => '$160 – $280',
                    ],
                    [
                        'name'        => 'Evaporator Fan Motor Replacement',
                        'description' => 'Replacement of the evaporator fan motor that circulates cold air from the freezer into the refrigerator compartment. Resolves inadequate cooling in the fridge section when the freezer remains at normal temperature.',
                        'price_range' => '$140 – $250',
                    ],
                    [
                        'name'        => 'Water Inlet Valve Replacement',
                        'description' => 'Replacement of the dual water inlet valve that supplies water to the dispenser and ice maker. Resolves no-water-dispenser and no-ice faults caused by a failed solenoid.',
                        'price_range' => '$120 – $220',
                    ],
                    [
                        'name'        => 'Door Gasket (Seal) Replacement',
                        'description' => 'Replacement of a warped, torn, or deteriorated door gasket on refrigerator or freezer doors. Eliminates warm air infiltration that causes excessive compressor run time and frost buildup.',
                        'price_range' => '$100 – $200',
                    ],
                    [
                        'name'        => 'Condenser Fan Motor Replacement',
                        'description' => 'Replacement of the condenser fan motor that cools the compressor and condenser coils. Resolves overheating, excessive compressor run time, and inadequate overall cooling.',
                        'price_range' => '$130 – $230',
                    ],
                    [
                        'name'        => 'Temperature Sensor (Thermistor) Replacement',
                        'description' => 'Testing and replacement of fresh food, freezer, and defrost thermistors. Resolves error codes and erratic temperature fluctuations caused by a sensor that has drifted out of specification.',
                        'price_range' => '$100 – $190',
                    ],
                    [
                        'name'        => 'Drain Tube Clearing & Repair',
                        'description' => 'Clearing of a blocked defrost drain tube and installation of a drain heater where applicable. Resolves water pooling under the crisper drawers or on the floor beneath the refrigerator.',
                        'price_range' => '$120 – $200',
                    ],
                    [
                        'name'        => 'Compressor & Sealed System Assessment',
                        'description' => 'Comprehensive evaluation of the Digital Inverter Compressor, refrigerant charge, and sealed system integrity. Determines whether compressor replacement or refrigerant service is required.',
                        'price_range' => '$150 – $300',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'Why is my Samsung refrigerator not cooling?',          'answer' => 'The most common cause of a Samsung refrigerator not cooling adequately is a defrost system failure — the evaporator coil ices over, blocking the airflow that cools the refrigerator compartment. Signs include the freezer staying cold while the fridge section warms, or a buzzing sound from the ice maker area. Compressor failures are less common but also possible.' ],
                    [ 'question' => 'Why is my Samsung ice maker not working?',             'answer' => 'Samsung ice makers are prone to a specific failure mode where the ice maker evaporator fan motor freezes over, stopping ice production. This may be accompanied by a buzzing or humming sound from the freezer compartment. The fix involves defrosting the ice maker area and often installing an updated ice maker kit. Our technicians are experienced with this specific Samsung repair.' ],
                    [ 'question' => 'How do I reset my Samsung refrigerator?',              'answer' => 'To reset a Samsung refrigerator, press and hold the Power Cool and Power Freeze buttons simultaneously for 8 seconds, or unplug the refrigerator for 5 minutes and reconnect. For ice maker reset specifically, press and hold the Test button on the ice maker module for 10 seconds. If error codes return after reset, the underlying issue requires a professional repair.' ],
                    [ 'question' => 'Is Samsung refrigerator ice maker noise normal?',     'answer' => 'A Samsung refrigerator making buzzing or humming sounds from the freezer section is NOT normal — it typically indicates the ice maker evaporator fan is trying to spin against ice buildup. This is a known Samsung issue that requires professional attention. Ignoring it can lead to the ice maker stopping completely and the freezer section developing cooling issues.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 4. DISHWASHER
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Samsung Dishwasher Repair',
            'slug'       => 'samsung-dishwasher-repair',
            'meta_title' => 'Samsung Dishwasher Repair | 5C, 4C, LC Error Codes | OEM Parts',
            'meta_desc'  => 'Professional Samsung dishwasher repair for 5C, 4C, LC, and OC error codes. WaterWall and StormWash specialists. Certified technicians, OEM parts, 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_hero_subtitle'  => 'Expert Samsung dishwasher repair for 5C, 4C, LC, and all error codes. WaterWall and StormWash model specialists. Genuine OEM parts. 30-day warranty.',
                '_ar_body_intro'     => "Samsung dishwashers feature WaterWall technology — a moving spray bar that sweeps across the lower rack — and StormWash jets in premium models. When a Samsung dishwasher displays an error code or stops cleaning effectively, our trained technicians have the expertise and genuine OEM parts to resolve the issue on the first visit.\n\nCommon Samsung dishwasher faults include 5C/5E drain errors, 4C water supply errors, LC/LE anti-leak activation, and OC overflow detection. We carry replacement drain pumps, water inlet valves, and control board components for the full Samsung dishwasher range.\n\nAll repairs are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => '5C / 5E Error — Drain Failure',        'description' => 'The Samsung 5C error means the dishwasher cannot drain within the required time. We inspect the drain pump, hose, and household drain connection. The pump is replaced with a genuine Samsung OEM part if failed.' ],
                    [ 'title' => '4C Error — Water Supply Fault',         'description' => 'Samsung 4C indicates insufficient water supply. We check the water supply valve, inlet hose, and inlet valve solenoid, replacing the valve if it is not opening correctly.' ],
                    [ 'title' => 'LC / LE Error — Leak Detected',         'description' => 'The LC or LE error means the Samsung dishwasher\'s leak sensor has detected water in the base. We identify the source of the internal leak and repair it before drying the base to clear the sensor.' ],
                    [ 'title' => 'OC Error — Overflow Detection',         'description' => 'OC indicates the Samsung dishwasher has detected too much water in the tub — usually from a faulty inlet valve that continues to supply water when it should close. We replace the water inlet valve.' ],
                    [ 'title' => 'Not Cleaning Effectively',              'description' => 'Blocked WaterWall spray bar or clogged filter reduces wash performance significantly. We clean the system and replace any damaged components.' ],
                    [ 'title' => 'Door Latch Failure',                    'description' => 'A failed Samsung dishwasher door latch prevents the machine from starting. We replace the latch assembly with a genuine Samsung OEM component.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Error Code Inspection',
                        'description' => 'Full electrical, plumbing, and mechanical inspection with error code retrieval. Written repair estimate before work begins.',
                        'price_range' => '$75 – $120',
                    ],
                    [
                        'name'        => 'Drain Pump Replacement',
                        'description' => 'Replacement of the drain pump motor assembly with a genuine Samsung OEM part. Resolves 5C/5E error codes and water remaining in the tub at the end of the cycle.',
                        'price_range' => '$140 – $240',
                    ],
                    [
                        'name'        => 'Water Inlet Valve Replacement',
                        'description' => 'Replacement of the water inlet valve solenoid. Resolves 4C no-fill errors and OC overflow errors caused by a valve that will not close properly.',
                        'price_range' => '$110 – $200',
                    ],
                    [
                        'name'        => 'Leak Detection & Base Repair (LC / LE)',
                        'description' => 'Full internal leak inspection to identify the source activating the LC/LE flood sensor. Repair of the leak source (pump seal, hose, door gasket) and drying of the base pan.',
                        'price_range' => '$140 – $280',
                    ],
                    [
                        'name'        => 'WaterWall Spray Arm Cleaning & Replacement',
                        'description' => 'Deep cleaning or replacement of the WaterWall moving spray bar and rail track assembly. Restores full wash coverage across the lower rack.',
                        'price_range' => '$90 – $180',
                    ],
                    [
                        'name'        => 'Wash Pump Motor Replacement',
                        'description' => 'Replacement of the circulation pump motor that pressurizes the wash water. Resolves poor cleaning performance and no-spray conditions not resolved by filter or spray arm cleaning.',
                        'price_range' => '$180 – $320',
                    ],
                    [
                        'name'        => 'Door Latch & Strike Replacement',
                        'description' => 'Replacement of the door latch and strike assembly. Resolves a dishwasher that will not start because the control cannot detect a closed and secured door.',
                        'price_range' => '$90 – $170',
                    ],
                    [
                        'name'        => 'Door Gasket (Tub Seal) Replacement',
                        'description' => 'Replacement of the door tub gasket that prevents water from escaping around the door perimeter. Resolves visible door-edge leaks and LC error codes triggered by minor door seal failures.',
                        'price_range' => '$100 – $190',
                    ],
                    [
                        'name'        => 'Heating Element & Thermostat Replacement',
                        'description' => 'Testing and replacement of the wash and dry heating element and high-limit thermostat. Resolves cold wash water, dishes not drying, and HE-related error codes.',
                        'price_range' => '$130 – $230',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the main control board. Resolves unresponsive touchpad, mid-cycle shutoff, and persistent error codes that cannot be cleared by component-level repair.',
                        'price_range' => '$200 – $360',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'What does the Samsung dishwasher LC error mean?',             'answer' => 'The Samsung LC or LE error means the dishwasher\'s flood protection sensor has detected water in the base tray. The machine locks out operation until the base is dry and the source of the leak is repaired. Simply drying the base without repairing the leak will result in the error returning on the next cycle.' ],
                    [ 'question' => 'Why is my Samsung dishwasher not draining?',                 'answer' => 'Start by cleaning the filter assembly at the bottom of the dishwasher tub — a clogged filter is the most common cause of Samsung dishwasher drain issues. If drain problems persist after filter cleaning, the drain pump has likely failed and needs professional replacement.' ],
                    [ 'question' => 'How do I reset my Samsung dishwasher?',                      'answer' => 'Hold the Start button for 3–5 seconds to cancel the current cycle and initiate a drain. For a full reset, press and hold Power for 3–5 seconds, or unplug the dishwasher for 60 seconds. If error codes return after reset, the underlying fault requires a professional repair.' ],
                    [ 'question' => 'Why is my Samsung dishwasher not cleaning dishes properly?', 'answer' => 'Poor cleaning in a Samsung dishwasher is most commonly caused by a blocked WaterWall spray bar (check for debris along the rail track), a clogged filter at the bottom of the tub, or insufficient water temperature. Ensure your home water heater is set to at least 120°F. If the WaterWall bar is moving freely and the filter is clean, the wash pump may be losing efficiency.' ],
                    [ 'question' => 'Is a Samsung dishwasher worth repairing?',                  'answer' => 'Samsung dishwashers are built for a 10 to 12-year service life. For models under 8 years old where the repair cost is below 50% of a comparable replacement, repair is almost always the better financial choice. We use only genuine Samsung OEM parts and back every repair with a 30-day warranty.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 5. OVEN / RANGE
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Samsung Oven / Range Repair',
            'slug'       => 'samsung-oven-repair',
            'meta_title' => 'Samsung Oven / Range Repair | SE, F-23 Error Codes | OEM Parts',
            'meta_desc'  => 'Professional Samsung oven and range repair for SE, F-23, and all error codes. Gas and electric models. Certified technicians, genuine OEM parts, 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_hero_subtitle'  => 'Expert Samsung oven / range repair for SE, F-23, and all error codes. Gas, electric, and dual fuel models. Genuine OEM parts. 30-day warranty.',
                '_ar_body_intro'     => "Samsung ovens and ranges feature Dual Cook Flex technology in select models that allows the oven cavity to be divided, Air Fry capability, and smart connectivity via SmartThings. Our technicians are trained on the full Samsung cooking appliance range and carry genuine OEM parts for efficient first-visit repair.\n\nCommon Samsung oven faults include SE touchpad errors, F-23 temperature sensor failures, heating element failures in electric models, gas igniter failures, and door lock motor issues after self-clean cycles. We carry diagnostic equipment capable of reading Samsung oven fault memory.\n\nAll repairs use genuine Samsung OEM parts and are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'SE Error — Touchpad Fault',                    'description' => 'The Samsung SE error indicates a shorted key or touchpad membrane fault. This is one of the most common Samsung range issues. We replace the control panel membrane or control board as required.' ],
                    [ 'title' => 'F-23 / F-22 Error — Temperature Sensor Fault', 'description' => 'These codes indicate the oven temperature sensor is reading outside acceptable limits. We test sensor resistance and replace with a genuine Samsung OEM sensor.' ],
                    [ 'title' => 'Oven Not Heating',                              'description' => 'In electric Samsung ranges, a failed bake or broil element is most common. In gas models, a failing igniter that cannot open the gas valve. We test and replace the specific failed component.' ],
                    [ 'title' => 'Surface Burners Not Igniting',                  'description' => 'Samsung gas range burners that click but won\'t light are usually caused by clogged burner cap ports (clean thoroughly), moisture in the ignition system, or a failed spark electrode. We diagnose and repair the specific cause.' ],
                    [ 'title' => 'Door Locked After Self-Clean',                  'description' => 'A Samsung oven door that won\'t unlock after self-clean has a failed door lock motor or latch mechanism. We repair the lock assembly safely.' ],
                    [ 'title' => 'Control Board Failure',                         'description' => 'Samsung oven control board failures manifest as blank display, unresponsive controls, or persistent error codes. We diagnose to confirm board failure before recommending replacement.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Error Code Inspection',
                        'description' => 'Full electrical and mechanical diagnostic with Samsung fault code retrieval. Written estimate before work begins. Diagnostic fee applied toward the repair.',
                        'price_range' => '$75 – $120',
                    ],
                    [
                        'name'        => 'Bake Element Replacement (Electric)',
                        'description' => 'Replacement of the lower bake heating element with a genuine Samsung OEM part. Resolves an oven that will not heat or heats only partially.',
                        'price_range' => '$120 – $220',
                    ],
                    [
                        'name'        => 'Broil Element Replacement (Electric)',
                        'description' => 'Replacement of the upper broil heating element. Restores broil function and resolves uneven baking caused by a failed broil assist element.',
                        'price_range' => '$120 – $220',
                    ],
                    [
                        'name'        => 'Gas Igniter Replacement',
                        'description' => 'Replacement of the oven burner igniter on Samsung gas ranges. Resolves an oven that clicks but will not light or lights slowly due to a weak igniter that cannot open the gas safety valve.',
                        'price_range' => '$130 – $230',
                    ],
                    [
                        'name'        => 'Surface Burner Spark Electrode Replacement',
                        'description' => 'Replacement of failed spark electrodes and igniter switch modules on gas cooktop burners. Resolves individual burners that will not ignite.',
                        'price_range' => '$100 – $180',
                    ],
                    [
                        'name'        => 'Oven Temperature Sensor Replacement',
                        'description' => 'Testing and replacement of the oven temperature probe. Resolves F-22/F-23 error codes and an oven that cannot reach or hold the correct baking temperature.',
                        'price_range' => '$100 – $180',
                    ],
                    [
                        'name'        => 'Control Panel / Touchpad Replacement',
                        'description' => 'Replacement of the touchpad membrane or full control panel assembly. Resolves the Samsung SE error and unresponsive or erratic keypad behavior.',
                        'price_range' => '$150 – $280',
                    ],
                    [
                        'name'        => 'Oven Door Lock Motor Repair',
                        'description' => 'Replacement of the self-clean door lock motor and latch assembly. Safely restores door operation on a Samsung oven that remains locked after a self-clean cycle.',
                        'price_range' => '$130 – $240',
                    ],
                    [
                        'name'        => 'Convection Fan Motor Replacement',
                        'description' => 'Replacement of the convection fan motor and blade. Restores even heat distribution and proper Air Fry performance on Samsung convection range models.',
                        'price_range' => '$140 – $250',
                    ],
                    [
                        'name'        => 'Oven Door Hinge & Gasket Repair',
                        'description' => 'Replacement of worn door hinges and oven door gasket. Eliminates heat escaping around the door, reduces preheat time, and prevents uneven baking.',
                        'price_range' => '$110 – $200',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'What does the Samsung SE error mean on an oven?',              'answer' => 'The Samsung SE (or 5E) error on an oven or range indicates a shorted key on the control panel touchpad. It can occur after moisture exposure, physical damage to the keypad membrane, or normal wear. In some cases a reset clears it temporarily; however, if it recurs, the control panel membrane or board needs replacement.' ],
                    [ 'question' => 'Why is my Samsung oven not heating to the right temperature?', 'answer' => 'A Samsung oven that heats but cannot reach or maintain the correct temperature typically has a faulty oven temperature sensor probe. The sensor is inexpensive and relatively easy to replace, and this repair restores accurate temperature control.' ],
                    [ 'question' => 'How do I reset my Samsung oven?',                              'answer' => 'To reset a Samsung oven, press and hold the Set Clock or Off button for 3–5 seconds, or switch off the oven\'s circuit breaker for 60 seconds. If an error code returns immediately after reset, professional diagnosis is required.' ],
                    [ 'question' => 'Why is my Samsung gas oven not lighting?',                    'answer' => 'A Samsung gas oven that clicks at the cooktop burners but won\'t light at the oven burner typically has a weak or failed hot surface igniter. The igniter glows orange but cannot draw sufficient current to open the gas safety valve. Replacing the igniter with a genuine Samsung OEM part resolves this in most cases.' ],
                    [ 'question' => 'Do you repair Samsung gas and electric ranges?',               'answer' => 'Yes. Our technicians are fully qualified to repair both Samsung gas and electric cooking appliances including freestanding ranges, slide-in ranges, and wall ovens. We carry genuine Samsung OEM parts for the full cooking appliance range.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 6. MICROWAVE
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Samsung Microwave Repair',
            'slug'       => 'samsung-microwave-repair',
            'meta_title' => 'Samsung Microwave Repair | SE, -SE-, No Heat | OEM Parts',
            'meta_desc'  => 'Professional Samsung microwave repair for SE error codes, no heat, turntable faults, and all Samsung over-the-range and countertop models. Genuine OEM parts. 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_hero_subtitle'  => 'Expert Samsung microwave repair for over-the-range and countertop models. SE error, no heat, magnetron and control board faults. Genuine OEM parts. 30-day warranty.',
                '_ar_body_intro'     => "Samsung microwaves — including over-the-range models with ventilation fans and sensor cooking, and countertop units with Ceramic Enamel interiors and SmartThings connectivity — are precision appliances that require brand-specific expertise when they develop faults. Samsung microwave repair involves high-voltage components that carry lethal charge even when unplugged; all work must be performed by a trained technician.\n\nThe most commonly reported Samsung microwave faults include the SE (or -SE-) touchpad error — one of Samsung's most widespread microwave issues — magnetron failures causing no heating, turntable motor failures, and control board faults. We carry diagnostic tools and genuine Samsung OEM parts to resolve these faults efficiently.\n\nAll Samsung microwave repairs use genuine OEM components and are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'SE Error — Touchpad Fault',         'description' => 'The Samsung SE error on a microwave indicates a shorted or failed keypad. This is one of Samsung\'s most frequently reported microwave issues and commonly occurs after steam or moisture exposure. We replace the touchpad membrane or control board assembly.' ],
                    [ 'title' => 'No Heat — Magnetron Failure',        'description' => 'A Samsung microwave that runs (light on, turntable spinning) but does not heat has a failed magnetron or associated high-voltage component (diode, capacitor). We safely discharge the high-voltage capacitor before diagnosis and replace the specific failed component.' ],
                    [ 'title' => 'Turntable Not Rotating',             'description' => 'A Samsung microwave turntable that won\'t spin typically indicates a failed turntable motor or a damaged coupler. We replace the motor with a genuine Samsung OEM component and test through a full cycle.' ],
                    [ 'title' => 'Sparking Inside the Cavity',         'description' => 'Sparking inside a Samsung microwave is usually caused by a damaged waveguide cover, burnt cavity paint, or a metallic item left in the unit. We inspect and replace the waveguide cover and assess any cavity damage.' ],
                    [ 'title' => 'Fan Not Working',                    'description' => 'Samsung over-the-range microwave fan failures prevent adequate ventilation when cooking. We test the fan motor and replace with a genuine Samsung OEM part.' ],
                    [ 'title' => 'Control Board / Display Failure',    'description' => 'A blank display, unresponsive controls, or erratic behavior on a Samsung microwave indicates a control board fault. We diagnose to confirm board failure before recommending replacement.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic Inspection (High-Voltage Safe)',
                        'description' => 'Full diagnostic by a trained technician including safe high-voltage capacitor discharge, fault identification, and written estimate. Required before any internal microwave work.',
                        'price_range' => '$75 – $120',
                    ],
                    [
                        'name'        => 'Touchpad / Control Panel Replacement',
                        'description' => 'Replacement of the SE-error touchpad membrane or full control panel assembly. Resolves the Samsung SE/-SE- error and unresponsive keypad on over-the-range and countertop models.',
                        'price_range' => '$130 – $250',
                    ],
                    [
                        'name'        => 'Magnetron Replacement',
                        'description' => 'Replacement of the magnetron — the core heating component. Restores full cooking power on a Samsung microwave that runs but produces no heat. High-voltage safety procedure required.',
                        'price_range' => '$200 – $380',
                    ],
                    [
                        'name'        => 'High-Voltage Diode & Capacitor Replacement',
                        'description' => 'Replacement of the high-voltage diode and/or capacitor that supply power to the magnetron. A shorted diode or failed capacitor produces the same no-heat symptom as a magnetron failure at a fraction of the cost.',
                        'price_range' => '$110 – $210',
                    ],
                    [
                        'name'        => 'Turntable Motor Replacement',
                        'description' => 'Replacement of the turntable drive motor and coupling. Restores even cooking rotation and resolves uneven heating caused by a stationary turntable.',
                        'price_range' => '$90 – $170',
                    ],
                    [
                        'name'        => 'Waveguide Cover Replacement & Cavity Repair',
                        'description' => 'Replacement of a burnt or damaged waveguide cover that protects the magnetron opening. Eliminates arcing, sparking, and burning smells from inside the cavity.',
                        'price_range' => '$80 – $150',
                    ],
                    [
                        'name'        => 'Exhaust / Ventilation Fan Motor Replacement',
                        'description' => 'Replacement of the over-the-range exhaust fan motor. Restores proper kitchen ventilation and eliminates loud or grinding fan noise.',
                        'price_range' => '$120 – $220',
                    ],
                    [
                        'name'        => 'Door Switch Replacement',
                        'description' => 'Replacement of one or more of the interlock door switches that prevent the microwave from operating with the door open. Resolves a microwave that will not start or trips the circuit breaker when the door closes.',
                        'price_range' => '$100 – $190',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the main control board. Resolves a blank display, erratic operation, and error codes that cannot be resolved by component-level repair.',
                        'price_range' => '$180 – $320',
                    ],
                    [
                        'name'        => 'Interior Light Bulb / LED Replacement',
                        'description' => 'Replacement of the interior cavity light or LED module. Restores full visibility inside the cooking cavity.',
                        'price_range' => '$60 – $110',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'What does the Samsung microwave SE error mean?',       'answer' => 'The SE error (or -SE-) on a Samsung microwave indicates a shorted key on the control panel touchpad. It is commonly triggered by steam or moisture from cooking. A reset (unplug for 60 seconds) may clear it temporarily, but if SE returns, the touchpad membrane or control board needs replacement.' ],
                    [ 'question' => 'Is it safe to repair a microwave myself?',             'answer' => 'No. Microwave ovens contain a high-voltage capacitor that stores a lethal charge even when the unit is unplugged. All internal microwave repairs must be performed by a trained technician who can safely discharge the capacitor before working on the unit.' ],
                    [ 'question' => 'Why is my Samsung microwave running but not heating?', 'answer' => 'A Samsung microwave that powers on, shows the display, and spins the turntable but produces no heat most commonly has a failed magnetron — the component that generates microwave energy. High-voltage diode or capacitor failure can produce the same symptom. All of these require a technician to diagnose safely.' ],
                    [ 'question' => 'Is a Samsung microwave worth repairing?',             'answer' => 'For over-the-range Samsung microwaves (typically $400–$900 to replace), repair is almost always more economical for faults like SE errors, turntable motors, and fan failures. For magnetron failures on older units, our technician will give you an honest cost-vs-replacement assessment before any work begins.' ],
                    [ 'question' => 'Do you repair Samsung over-the-range microwaves?',    'answer' => 'Yes. We service all Samsung microwave configurations including over-the-range models with ventilation, combination microwave-convection units, and countertop models across the full Samsung range.' ],
                ],
            ],
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 7. WALL OVEN
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'service_page',
            'title'      => 'Samsung Wall Oven Repair',
            'slug'       => 'samsung-wall-oven-repair',
            'meta_title' => 'Samsung Wall Oven Repair | SE, F-23 Error Codes | OEM Parts',
            'meta_desc'  => 'Professional Samsung wall oven repair for SE, F-23, and all error codes. Single and double wall oven specialists. Certified technicians, genuine OEM parts, 30-day warranty.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_hero_subtitle'  => 'Expert Samsung wall oven repair for single and double models. SE error, temperature sensor faults, heating element and door lock issues. Genuine OEM parts. 30-day warranty.',
                '_ar_body_intro'     => "Samsung wall ovens — including single and double electric wall ovens, and combination microwave-wall oven units — feature Dual Cook Flex technology, Air Fry capability, and Wi-Fi connectivity via SmartThings in premium models. Built-in wall ovens require brand-trained technicians for safe, accurate repair, particularly for door lock mechanisms, high-temperature wiring, and multi-cavity units.\n\nThe most common Samsung wall oven faults include SE touchpad errors, F-23 temperature sensor failures, bake and broil element failures, self-clean door lock motor faults, and control board issues. We carry diagnostic equipment capable of reading Samsung wall oven fault codes, enabling accurate diagnosis before any components are replaced.\n\nSafety is paramount when working on built-in high-voltage cooking appliances. All Samsung wall oven repairs use genuine OEM components and are backed by our 30-day parts and labor warranty.",
                '_ar_common_issues'  => [
                    [ 'title' => 'SE Error — Touchpad / Control Fault',          'description' => 'The Samsung SE error on a wall oven indicates a shorted key or failed touchpad membrane — the same well-known Samsung control panel fault that affects ranges and microwaves. We replace the control panel membrane or associated control board.' ],
                    [ 'title' => 'F-23 / F-22 Error — Temperature Sensor Fault', 'description' => 'These codes indicate the oven temperature sensor (probe) is reading outside acceptable limits. We test the sensor resistance against Samsung specifications and replace with a genuine Samsung OEM probe.' ],
                    [ 'title' => 'Oven Not Heating — Bake or Broil Element',     'description' => 'A failed bake or broil element in a Samsung wall oven prevents the cavity from reaching temperature. Visible burn marks or breaks in the element confirm failure. We replace with a genuine Samsung OEM element.' ],
                    [ 'title' => 'Door Locked After Self-Clean Cycle',           'description' => 'A Samsung wall oven door that remains locked after a self-clean cycle has a failed door lock motor or latch assembly. We safely repair the lock mechanism and test through a complete door cycle.' ],
                    [ 'title' => 'Convection Fan Fault',                         'description' => 'A failed convection fan motor in a Samsung wall oven causes uneven baking and extended preheat times. We replace the fan motor and blade with genuine Samsung OEM parts.' ],
                    [ 'title' => 'Control Board Failure',                        'description' => 'Samsung wall oven control board faults manifest as blank displays, persistent error codes, or unresponsive controls. We diagnose to confirm board failure before any replacement is recommended.' ],
                ],
                '_ar_services' => [
                    [
                        'name'        => 'Diagnostic & Error Code Inspection',
                        'description' => 'Full electrical and mechanical diagnostic with Samsung fault code retrieval. Written repair estimate before any work begins. Diagnostic fee applied toward repair.',
                        'price_range' => '$75 – $120',
                    ],
                    [
                        'name'        => 'Bake Element Replacement',
                        'description' => 'Replacement of the lower bake heating element with a genuine Samsung OEM part. Restores full baking temperature in single or double wall oven configurations.',
                        'price_range' => '$130 – $240',
                    ],
                    [
                        'name'        => 'Broil Element Replacement',
                        'description' => 'Replacement of the upper broil heating element. Restores broil function and eliminates uneven baking in convection-assist modes.',
                        'price_range' => '$130 – $240',
                    ],
                    [
                        'name'        => 'Oven Temperature Sensor Replacement',
                        'description' => 'Testing and replacement of the oven temperature probe. Resolves F-22/F-23 error codes and temperature accuracy issues that cause underbaking or overbaking.',
                        'price_range' => '$110 – $200',
                    ],
                    [
                        'name'        => 'Control Panel / Touchpad Replacement',
                        'description' => 'Replacement of the touchpad membrane or full control panel assembly. Resolves the Samsung SE error and unresponsive or locked-up keypad behavior on built-in wall ovens.',
                        'price_range' => '$160 – $300',
                    ],
                    [
                        'name'        => 'Door Lock Motor & Latch Repair',
                        'description' => 'Replacement of the self-clean door lock motor and latch assembly. Safely restores access to the oven cavity after a self-clean cycle locks the door permanently.',
                        'price_range' => '$140 – $260',
                    ],
                    [
                        'name'        => 'Convection Fan Motor Replacement',
                        'description' => 'Replacement of the convection fan motor and blade assembly. Restores even heat distribution and proper Air Fry performance. Eliminates grinding or no-airflow symptoms.',
                        'price_range' => '$150 – $270',
                    ],
                    [
                        'name'        => 'Control Board Replacement',
                        'description' => 'Diagnosis and replacement of the main control board. Resolves persistent error codes, blank display, and unresponsive controls on single and double Samsung wall ovens.',
                        'price_range' => '$220 – $400',
                    ],
                    [
                        'name'        => 'Door Hinge, Gasket & Glass Repair',
                        'description' => 'Replacement of worn door hinges, oven door gasket, or inner door glass. Eliminates heat loss around the door and prevents oven cavity glass from cracking under thermal stress.',
                        'price_range' => '$120 – $240',
                    ],
                    [
                        'name'        => 'Thermal Cut-Out & Thermostat Replacement',
                        'description' => 'Testing and replacement of thermal cut-out fuses and high-limit thermostats in the oven cavity. Resolves a wall oven that shuts off mid-cycle or will not reach operating temperature.',
                        'price_range' => '$110 – $200',
                    ],
                ],
                '_ar_faqs' => [
                    [ 'question' => 'What does the Samsung wall oven SE error mean?',             'answer' => 'The SE error on a Samsung wall oven indicates a shorted key on the control panel touchpad. It can be caused by steam exposure, physical wear of the membrane, or control board failure. A temporary reset may clear it, but if SE returns, the touchpad or board needs to be replaced.' ],
                    [ 'question' => 'Why is my Samsung wall oven not reaching temperature?',     'answer' => 'A Samsung wall oven that heats but cannot reach or hold the set temperature most commonly has a faulty oven temperature sensor probe. The probe is inexpensive to replace and restores accurate temperature control. If the element has partially failed, heat output is also reduced.' ],
                    [ 'question' => 'Do you repair Samsung double wall ovens?',                  'answer' => 'Yes. We service all Samsung wall oven configurations including single, double, and combination microwave-wall oven units across the full Samsung product range.' ],
                    [ 'question' => 'Is it safe to use my Samsung wall oven with an error code?','answer' => 'We recommend against using the oven until it has been inspected. Temperature sensor faults can cause overheating or underheating, and some fault conditions disable the oven as a built-in safety measure.' ],
                    [ 'question' => 'What warranty do you provide on Samsung wall oven repairs?', 'answer' => 'All Samsung wall oven repairs are backed by our 30-day parts and labor warranty. If the repaired fault returns within the year, we return at no additional cost.' ],
                ],
            ],
        ],

    ]; // end ar_brand_samsung()
}