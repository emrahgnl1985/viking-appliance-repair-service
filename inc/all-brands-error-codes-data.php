<?php
/**
 * Samsung — Error Code Page Content Data
 *
 * Brand: Samsung only
 * Covers Samsung washer, dryer, refrigerator, dishwasher, oven / range,
 * microwave, and wall oven error codes.
 *
 * Each entry powers template-error-code.php via ACF meta fields:
 *   _ar_brand, _ar_appliance_type, _ar_error_code, _ar_code_meaning,
 *   _ar_causes[], _ar_diy_steps[], _ar_when_to_call, _ar_cost_range, _ar_faqs[]
 *
 * URL structure: /error-codes/{appliance}/{slug}/
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_error_codes_data(): array {
    return ar_error_codes_samsung();
}

function ar_error_codes_samsung(): array {
    return array_merge(
        ar_error_codes_samsung_washer(),
        ar_error_codes_samsung_dryer(),
        ar_error_codes_samsung_refrigerator(),
        ar_error_codes_samsung_dishwasher(),
        ar_error_codes_samsung_oven_range(),
        ar_error_codes_samsung_microwave(),
        ar_error_codes_samsung_wall_oven()
    );
}

// ─────────────────────────────────────────────────────────────────────────────
// WASHER ERROR CODES
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_samsung_washer(): array {
    return [

        // ── 4E / 4C ──────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer 4E Error Code',
            'slug'       => 'samsung-washer-4e-error-code',
            'meta_title' => 'Samsung Washer 4E / 4C Error Code — Water Supply Fault',
            'meta_desc'  => 'Samsung washer 4E or 4C means the machine is not getting enough water. Learn what causes it and how to fix it yourself in most cases.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => '4E',
                '_ar_code_meaning'   => "The 4E error code on a Samsung washer (displayed as 4C on newer models — same fault, updated display format) means the machine cannot fill with water within the required time. Samsung washers monitor fill time via a pressure sensor — if the water level does not reach the programmed minimum within approximately 4 minutes, 4E is triggered.\n\n4E is one of the most common Samsung washer errors in the US and in the majority of cases has a simple cause — a closed water supply valve or a kinked inlet hose. However, a clogged inlet screen filter or a failed water inlet solenoid valve are also frequent causes.",
                '_ar_causes'         => [
                    [ 'title' => 'Water Supply Valve Turned Off',  'description' => 'The hot and/or cold water supply valves behind the washer have been partially or fully closed — commonly after maintenance or moving. Check both valves are fully open (turned counter-clockwise as far as possible).' ],
                    [ 'title' => 'Kinked Inlet Hose',              'description' => 'One or both inlet hoses (hot/cold) have become kinked where they connect to the back of the machine or at the wall. Even partial kinking reduces flow below the required threshold.' ],
                    [ 'title' => 'Clogged Inlet Screen Filters',   'description' => 'Where the hoses connect to the back of the washer, small mesh screens prevent debris from entering the inlet valve. These screens can clog with mineral sediment, rust, or debris, severely restricting flow.' ],
                    [ 'title' => 'Low Water Pressure',             'description' => 'Samsung washers require a minimum of 14.5 PSI water pressure. In homes with low municipal pressure, or during high-demand periods, pressure may drop below this threshold and trigger 4E.' ],
                    [ 'title' => 'Failed Water Inlet Valve',       'description' => 'The solenoid inlet valve (typically dual-solenoid for hot and cold) can fail with a burned solenoid coil, preventing it from opening. This requires valve replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check the supply valves',        'description' => 'Turn both the hot and cold water supply valves (behind the washer) fully counter-clockwise. Many 4E errors are resolved by simply opening a valve that was closed during a previous service call or move.' ],
                    [ 'title' => 'Straighten the inlet hoses',     'description' => 'Pull the washer away from the wall slightly and inspect both inlet hoses. Straighten any kinks. The hoses should have a smooth arc from the wall to the machine without tight bends.' ],
                    [ 'title' => 'Clean the inlet screen filters', 'description' => 'Turn off the water supply and disconnect one hose at the back of the machine. Look inside the connection port — you will see a small mesh screen. Use needle-nose pliers to carefully pull the screen out. Rinse under running water and reinstall. Repeat for the other port.' ],
                    [ 'title' => 'Check water pressure',           'description' => 'Turn on a nearby cold water tap fully. If the flow seems low, your household pressure may be the issue. Try running the washer when the pressure is highest (early morning, before peak usage hours).' ],
                ],
                '_ar_when_to_call'   => "If all the above checks are completed and 4E persists, the water inlet valve solenoid has failed. Valve replacement requires disconnecting the inlet hoses and the electrical connector on the valve body — a 45-minute repair requiring the correct Samsung-specific valve part.",
                '_ar_cost_range'     => '$80 – $190',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung 4E and 4C?', 'answer' => '4E and 4C are the same fault. Samsung updated their display format in newer models — 4E appears on older machines, 4C on recent ones. The diagnosis and repair are identical.' ],
                    [ 'question' => 'My Samsung washer shows 4E only on hot water cycles — what does that mean?', 'answer' => 'If 4E only appears on hot wash cycles, only the hot water supply is restricted. Check that the hot water valve is open and that the hot water inlet screen is not clogged.' ],
                    [ 'question' => 'Can cold weather cause Samsung washer 4E?', 'answer' => 'Yes — in very cold weather, water supply pipes can freeze, cutting water supply to the washer. If 4E appears suddenly in winter, check whether other water fixtures in the house are also flowing normally.' ],
                ],
            ],
        ],

        // ── 5E / 5C ──────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer 5E Error Code',
            'slug'       => 'samsung-washer-5e-error-code',
            'meta_title' => 'Samsung Washer 5E / 5C Error Code — Drain Fault Causes & Fixes',
            'meta_desc'  => 'Samsung washer 5E or 5C means it failed to drain. Learn the most common causes and how to fix it — usually a clogged pump filter.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => '5E',
                '_ar_code_meaning'   => "The 5E error code on a Samsung washer (5C on newer display models) indicates a drain fault — the machine attempted to drain but the water level did not reach zero within the required time window (approximately 5 minutes).\n\nSamsung 5E is functionally equivalent to LG's OE error. The vast majority of 5E codes are caused by a clogged pump debris filter on front-load models, or a kinked or blocked drain hose. A failed drain pump motor is the cause in a smaller percentage of cases.",
                '_ar_causes'         => [
                    [ 'title' => 'Clogged Pump Debris Filter',     'description' => 'Front-load Samsung washers have a coin trap/filter at the front lower panel. Lint, coins, and debris pack this filter solid over time, completely blocking the drain pump. This is the most common cause of 5E.' ],
                    [ 'title' => 'Kinked or Blocked Drain Hose',   'description' => 'The drain hose can kink if the washer is pushed too close to the wall. The hose must also maintain a high loop (30 inches minimum) to prevent siphoning. Check the full hose length.' ],
                    [ 'title' => 'Blocked Standpipe or House Drain', 'description' => 'A slow or blocked household drain connection prevents the pump from expelling water fast enough, triggering 5E even with a healthy pump.' ],
                    [ 'title' => 'Failed Drain Pump',              'description' => 'The drain pump motor has burned out or the impeller is broken. You may hear the pump attempting to run (buzzing) but no water movement occurs.' ],
                    [ 'title' => 'Pressure Hose Blockage',         'description' => 'The small rubber tube connecting the tub pressure switch to the control board can become blocked with soapy residue, causing the board to incorrectly report undrained water even after successful draining.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the pump filter',          'description' => 'Open the small access panel at the front bottom of the washer. Pull out the drain emergency tube and drain into a shallow pan. Unscrew the pump filter counter-clockwise and remove. Rinse thoroughly and clean off all lint and debris. Reinstall and lock.' ],
                    [ 'title' => 'Check the drain hose',           'description' => 'Inspect the drain hose for kinks, and verify the high loop is maintained. The hose should be inserted no more than 6 inches into the standpipe and must not be sealed with tape — it must have an air gap.' ],
                    [ 'title' => 'Run a spin/drain cycle',         'description' => 'Press and hold the Spin button for 3 seconds (on most Samsung models) to initiate a drain-only test. Listen for the pump running. A healthy pump is loud and steady. No sound = dead pump motor. Loud grinding = jammed impeller.' ],
                ],
                '_ar_when_to_call'   => "If the filter is clean and the hose is correctly routed but 5E persists, call a technician to diagnose the drain pump. Samsung drain pump replacement is typically a 45-60 minute repair on front-load models.",
                '_ar_cost_range'     => '$85 – $210',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I manually drain a Samsung washer with 5E?', 'answer' => 'Use the emergency drain tube (small rubber tube) next to the pump filter at the front bottom panel. Remove its cap over a shallow tray to gravity-drain the machine. This is safe to do before cleaning the filter.' ],
                    [ 'question' => 'How often should I clean the Samsung washer pump filter?', 'answer' => 'Samsung recommends monthly cleaning. With heavy use or pet hair in laundry, clean it every two weeks.' ],
                    [ 'question' => 'Can 5E damage my Samsung washer?', 'answer' => 'Running the pump continuously against a blocked filter overheats the motor and shortens its life. Persistent 5E errors caused by a clogged filter are a common reason for premature drain pump failure.' ],
                ],
            ],
        ],

        // ── UB ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer UB Error Code',
            'slug'       => 'samsung-washer-ub-error-code',
            'meta_title' => 'Samsung Washer UB Error Code — Unbalance Fault Causes & Fixes',
            'meta_desc'  => 'Samsung washer UB means the drum is out of balance and the spin cycle stopped. Learn how to fix it — from redistributing loads to replacing suspension rods.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'UB',
                '_ar_code_meaning'   => "The UB error code on a Samsung washer (also displayed as UE or E4 on some models) indicates an out-of-balance condition. Samsung washers measure drum vibration and lateral movement during the spin ramp-up phase. If the drum cannot reach balanced rotation within a set number of attempts, the machine halts the spin cycle and displays UB.\n\nUB is extremely common with Samsung VRT Plus models. In most cases it is triggered by a genuinely unbalanced load — a single heavy item such as a comforter, jeans, or towels clumped together. Persistent UB on normally distributed loads indicates worn mechanical components.",
                '_ar_causes'         => [
                    [ 'title' => 'Unbalanced Load',                'description' => 'A single heavy item or a tightly packed load has settled to one side of the drum. This is the most common cause and is corrected by redistributing the laundry by hand.' ],
                    [ 'title' => 'Oversized Single Item',          'description' => 'Washing one large item (a comforter, sleeping bag, or heavy rug) alone can cause the drum to swing dramatically. Wash large single items with a second item of similar weight to balance the load.' ],
                    [ 'title' => 'Worn Suspension Rods',           'description' => 'Front-load Samsung washers use four suspension rods to dampen drum movement. As the damping pads wear, the drum travels further during spin ramp-up and cannot stabilize, triggering persistent UB.' ],
                    [ 'title' => 'Failed Shock Absorbers (Top-Load)', 'description' => 'Top-load Samsung washers use shock absorbers attached to the outer tub. Worn shocks allow the tub to move excessively during spin, triggering UB.' ],
                    [ 'title' => 'Washer Not Level',               'description' => 'A washer that is not sitting level on all four feet rocks during spin, amplifying any minor load imbalance into a UB condition. Check the leveling feet with a spirit level.' ],
                    [ 'title' => 'Faulty Balance Sensor or Hall Sensor', 'description' => 'Rarely, the electronic sensor that monitors drum rotation speed or position gives false readings that trigger UB even with a correctly balanced load.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Redistribute the load',          'description' => 'Open the door and physically redistribute the laundry items around the drum. Separate any tangled items. Restart the spin cycle.' ],
                    [ 'title' => 'Level the washer',               'description' => 'Place a spirit level on top of the machine (front-to-back and side-to-side). Adjust the leveling feet by turning them clockwise to lower or counter-clockwise to raise each corner. Lock the jam nuts after adjustment.' ],
                    [ 'title' => 'Check the suspension rods',      'description' => 'On front-load models, gently push down on the drum from above (with the door open). It should spring back with firm, even resistance. If the drum thuds or drops loosely, one or more suspension rods have failed.' ],
                ],
                '_ar_when_to_call'   => "If UB persists after load redistribution and leveling, the suspension rods (front-load) or shock absorbers (top-load) need replacement. All four suspension rods should be replaced as a set — they wear at similar rates. This is a moderate DIY repair but requires some disassembly.",
                '_ar_cost_range'     => '$120 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Samsung washer show UB only with certain items?', 'answer' => 'Heavy single items — especially comforters, jeans, and towels — are the most frequent triggers because they bundle together during the wash cycle, placing nearly all of the drum weight on one side. Always wash large heavy items with a second similar-weight item, or use the dedicated Bedding cycle.' ],
                    [ 'question' => 'How do I know if my Samsung washer suspension rods are worn?', 'answer' => 'With the door open, press down on the front of the drum and release quickly. A washer with healthy rods springs back smoothly. If the drum drops and bounces multiple times, or if one corner feels softer than the others, the suspension rods have worn out.' ],
                    [ 'question' => 'Does UB cause any damage to a Samsung washer?', 'answer' => 'Repeated UB events with severely worn suspension rods allow the drum to strike the cabinet interior. Over time this can damage the outer tub, the door glass, or the door gasket. Replacing worn rods promptly prevents secondary damage.' ],
                ],
            ],
        ],

        // ── DC ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer DC Error Code',
            'slug'       => 'samsung-washer-dc-error-code',
            'meta_title' => 'Samsung Washer DC Error Code — Door Lock Fault Causes & Fixes',
            'meta_desc'  => 'Samsung washer DC means the door lock cannot confirm a closed and locked state. Learn why it happens and how to fix the door latch yourself.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'DC',
                '_ar_code_meaning'   => "The DC error code on a Samsung washer indicates a door lock fault. The control board requires confirmation from the door lock switch that the door is fully closed and locked before allowing a cycle to begin or continue. If this confirmation signal is absent or incorrect, DC is displayed and the machine halts.\n\nDC is among the most frequently reported Samsung front-load washer errors. It is most commonly caused by a failed door latch assembly — the plastic hook and switch unit mounted on the door itself. Less frequently, the door strike in the tub frame or the control board's latch circuit is at fault.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Latch / Lock Assembly', 'description' => 'The door latch assembly (mounted on the door) includes the plastic hook that engages the door strike and the microswitch that signals a locked state. The hook wears or breaks, or the microswitch contact fails, preventing the locked signal from reaching the control board.' ],
                    [ 'title' => 'Worn or Damaged Door Strike',    'description' => 'The door strike in the tub opening that the latch hook engages can wear or crack. If the hook does not seat properly in the strike, the lock switch does not activate.' ],
                    [ 'title' => 'Door Gasket Obstruction',        'description' => 'A bulging or stiff door boot gasket on front-load models can prevent the door from closing fully, stopping the latch from engaging the strike completely.' ],
                    [ 'title' => 'Wiring Harness Fault',           'description' => 'The wiring harness between the door latch switch and the control board can develop an open circuit from repeated door opening/closing cycles over years of use.' ],
                    [ 'title' => 'Control Board Door Lock Circuit', 'description' => 'Rarely, the door lock sensing circuit on the main control board fails, causing DC even with a mechanically sound latch.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the door seal and check for obstructions', 'description' => 'Inspect the door boot gasket for any debris, small clothing items, or deformation that could prevent the door from closing flat. Clean the gasket and tub rim and retry.' ],
                    [ 'title' => 'Inspect the door latch hook',    'description' => 'Open the door and examine the plastic latch hook on the door. Look for cracks, chips, or wear that would prevent it from seating fully in the door strike. If damaged, the latch assembly requires replacement.' ],
                    [ 'title' => 'Perform a power reset',          'description' => 'Unplug the washer for 60 seconds. This clears any transient DC codes caused by a momentary switch bounce. If DC returns as soon as the cycle begins, the latch has mechanically failed.' ],
                ],
                '_ar_when_to_call'   => "If the latch hook is intact and the door closes firmly but DC persists after a reset, a technician should test the latch switch with a multimeter and inspect the wiring harness. Door latch replacement is a moderate DIY repair on most Samsung front-load models.",
                '_ar_cost_range'     => '$90 – $200',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I force-start my Samsung washer past a DC error?', 'answer' => 'No. DC means the washer cannot confirm the door is safely locked. Running the machine in this state risks the door opening during a high-spin cycle. Do not bypass the lock — repair or replace the latch assembly.' ],
                    [ 'question' => 'My Samsung washer shows DC but the door feels locked — why?', 'answer' => 'The door may physically feel engaged, but if the microswitch inside the latch assembly has failed, no electrical signal reaches the control board. The board cannot confirm a locked state by feel alone — it relies on the switch signal. The latch assembly needs replacement.' ],
                    [ 'question' => 'How long does a Samsung washer door latch last?', 'answer' => 'Samsung front-load washer door latches typically last 5 to 8 years under normal use. High-frequency users (4+ loads per day) may see latch wear sooner. The plastic hook is the component most likely to fail first.' ],
                ],
            ],
        ],

        // ── HE (Washer) ───────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer HE Error Code',
            'slug'       => 'samsung-washer-he-error-code',
            'meta_title' => 'Samsung Washer HE Error Code — Heater Fault Causes & Fixes',
            'meta_desc'  => 'Samsung washer HE means the wash heater or temperature sensor has a fault. Learn what causes it, how to test the heater, and typical repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'HE',
                '_ar_code_meaning'   => "The HE error code on a Samsung washer indicates a heating system fault. Samsung front-load washers with internal wash heaters monitor water temperature via a thermistor. If the water temperature does not rise at the expected rate within the heater's programmed window, or if the thermistor reads an out-of-range resistance value, HE is triggered.\n\nHE on a Samsung washer most commonly means the wash heater element has failed or the NTC thermistor has drifted out of specification. This affects wash cycles that require heated water — specifically warm and hot temperature settings.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Wash Heater Element',     'description' => 'The electric heating element inside the tub heats water to the selected wash temperature. Element failure (open circuit) results in no heat rising, triggering HE.' ],
                    [ 'title' => 'Failed NTC Thermistor',          'description' => 'The NTC temperature sensor monitors water temperature and reports it to the control board. If the thermistor resistance drifts outside the expected range, the board cannot confirm correct temperature rise and triggers HE.' ],
                    [ 'title' => 'Wiring Fault to Heater Assembly', 'description' => 'The wire harness connecting the control board to the heater and thermistor can develop an open circuit or burned connector, cutting the heater circuit.' ],
                    [ 'title' => 'Control Board Fault',            'description' => 'Rarely, the heater output circuit on the control board fails. Confirmed only after heater element and thermistor test normal.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check if cold water wash cycles run without error', 'description' => 'Run a cold-water-only cycle. If it completes without HE, the error is specific to the heating circuit, confirming a heater or thermistor fault rather than a general control problem.' ],
                    [ 'title' => 'Test the thermistor resistance', 'description' => 'With the washer unplugged and the heater wiring disconnected, test the thermistor with a multimeter set to ohms. At room temperature (70°F), a healthy Samsung thermistor reads approximately 10,000–12,000 ohms. Readings far outside this range indicate thermistor failure.' ],
                    [ 'title' => 'Test the heater element continuity', 'description' => 'With the heater wiring disconnected, test for continuity across the heater terminals. No continuity confirms an open heating element that must be replaced.' ],
                ],
                '_ar_when_to_call'   => "Heater element and thermistor testing requires accessing the rear of the machine and locating the heater assembly at the bottom of the outer tub. Replacement of the heater assembly is a moderate disassembly task. Call a technician if you are not comfortable working inside the washer cabinet.",
                '_ar_cost_range'     => '$120 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'Will my Samsung washer still clean clothes with a HE error?', 'answer' => 'The washer will still run cycles, but all washes will be cold regardless of the temperature selected. For most laundry this is acceptable short-term, but heavily soiled items and sanitize cycles require heated water. Arrange repair to restore full temperature function.' ],
                    [ 'question' => 'Is the Samsung washer HE code the same as the dryer HE code?', 'answer' => 'No — they are different faults. On the dryer, HE refers to the drying heat circuit (thermal fuse, heating element, gas valve). On the washer, HE refers specifically to the internal wash water heater and its temperature sensor.' ],
                    [ 'question' => 'Can HE on a Samsung washer be caused by cold water supply?', 'answer' => 'In rare cases with extremely cold incoming water in winter, the heater must work much harder to reach the target temperature. If HE appears only in winter and only on hot cycles, ensure the water supply pipes are not partially frozen and check the inlet valve screens for ice obstruction.' ],
                ],
            ],
        ],

        // ── OE / OC ──────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer OE Error Code',
            'slug'       => 'samsung-washer-oe-error-code',
            'meta_title' => 'Samsung Washer OE / OC Error Code — Overflow Fault',
            'meta_desc'  => 'Samsung washer OE or OC means the machine has detected too much water. Learn what causes an overflow condition and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'OE',
                '_ar_code_meaning'   => "The OE error code on a Samsung washer (also OC or 0C on some models) indicates an overflow condition. The tub water level sensor (pressure switch) has detected that the water level has risen above the maximum permitted level. The machine immediately halts the cycle and attempts to drain.\n\nOE is less common than 4E or 5E but is more urgent because excess water risks leaking. The most common cause is a failed water inlet valve that does not fully close when signaled, allowing water to continue filling after the target level is reached.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Water Inlet Valve (Will Not Close)', 'description' => 'The water inlet valve solenoid fails in the open position, allowing water to continue entering the tub even after the target level is reached. This is the most common cause of OE on Samsung washers.' ],
                    [ 'title' => 'Faulty Pressure Switch (Water Level Sensor)', 'description' => 'The pressure switch that monitors tub water level fails or gives inaccurate readings, reporting a low level when the tub is full and allowing the inlet valve to continue filling.' ],
                    [ 'title' => 'Blocked Pressure Switch Hose',   'description' => 'The small rubber tube connecting the pressure switch to the tub air port can clog with detergent residue, preventing the switch from sensing water level accurately.' ],
                    [ 'title' => 'Excessive Suds',                 'description' => 'Using non-HE detergent or excessive detergent in a Samsung HE washer creates foam that the pressure switch interprets as high water level but can also cause the machine to add more water trying to compensate — triggering OE.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Run a tub clean cycle',          'description' => 'Excess suds from incorrect detergent use are a common OE trigger. Run the Samsung Self Clean cycle with no detergent and no laundry to clear residual soap buildup.' ],
                    [ 'title' => 'Check the pressure switch hose', 'description' => 'Unplug the washer and locate the small rubber hose connecting the pressure switch at the top of the machine to the port on the outer tub. Disconnect and blow through it — it should be completely clear. If blocked, clean or replace it.' ],
                    [ 'title' => 'Listen at the end of the fill phase', 'description' => 'Start a cycle and listen carefully as the tub fills. A healthy inlet valve closes abruptly when the water level is reached, and filling stops. If you hear water continuing to run after the cycle starts, the inlet valve is not closing and needs replacement.' ],
                ],
                '_ar_when_to_call'   => "A Samsung water inlet valve that fails open requires professional replacement. The valve is mounted at the rear of the machine and requires disconnecting the inlet hoses and electrical connector. Do not continue operating the washer with a failed-open valve — continued overflow will damage the flooring and cabinetry around the machine.",
                '_ar_cost_range'     => '$120 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Is OE on a Samsung washer dangerous?', 'answer' => 'Yes — OE indicates the machine is taking on more water than it should. If the drain cannot keep up or if the cycle halts with the valve stuck open, water will overflow onto the floor. Address OE promptly.' ],
                    [ 'question' => 'Can too much detergent cause Samsung washer OE?', 'answer' => 'Yes. HE washers use very little water. Excess suds — from non-HE detergent or too much HE detergent — confuse the pressure switch. Use only Samsung-recommended HE detergent and measure the amount as instructed on the packaging.' ],
                    [ 'question' => 'My Samsung washer drains right after filling — is that OE?', 'answer' => 'Yes — when OE is triggered the machine immediately halts and attempts an emergency drain. If your washer fills and immediately begins draining without starting the wash, OE has been triggered and the cause should be diagnosed before running another cycle.' ],
                ],
            ],
        ],

        // ── LE (Washer) ───────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer LE Error Code',
            'slug'       => 'samsung-washer-le-error-code',
            'meta_title' => 'Samsung Washer LE Error Code — Motor Overload / Low Water Level Fault',
            'meta_desc'  => 'Samsung washer LE indicates a motor or water level fault depending on the model. Learn how to identify which LE code your Samsung washer is showing and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'LE',
                '_ar_code_meaning'   => "The LE error code on a Samsung washer has two distinct meanings depending on the model generation. On most current Samsung front-load washers, LE indicates a motor lock error — the drum motor has detected an overload or stall condition. On some older Samsung models, LE may indicate a water level (low water) error, functioning similarly to 4E.\n\nMotor-related LE on Samsung front-load washers is most commonly caused by a physical obstruction in the drum or a failed motor hall sensor. Check the specific error code in your model's service manual or confirm by the context in which LE appears (during spin vs. during fill).",
                '_ar_causes'         => [
                    [ 'title' => 'Drum Overloaded',                'description' => 'Packing the drum beyond its rated capacity strains the motor to the point of triggering an overload protection shutdown.' ],
                    [ 'title' => 'Foreign Object Lodged in Drum or Pump', 'description' => 'A bra underwire, coin, or small item lodged between the drum and tub wall can jam the drum and stall the motor.' ],
                    [ 'title' => 'Failed Motor Hall Sensor',       'description' => 'The hall sensor monitors rotor position and speed. A failed hall sensor causes the control board to lose feedback about motor rotation, triggering LE.' ],
                    [ 'title' => 'Seized Motor Bearings',          'description' => 'In older machines, motor bearing failure causes the motor to overload when trying to spin under load.' ],
                    [ 'title' => 'Drive Motor Failure',            'description' => 'The BLDC (brushless DC) drive motor on Samsung direct-drive models can fail internally, preventing rotation and triggering LE.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Reduce the load size',           'description' => 'Remove several items and retry. Samsung front-load washers should be filled loosely to 80% of drum capacity — items should be able to fall freely when the drum turns.' ],
                    [ 'title' => 'Check for foreign objects',      'description' => 'Reach into the drum and feel around the rubber door seal crevice — this is where underwires and small metal items typically lodge. Also check behind the drum baffles.' ],
                    [ 'title' => 'Spin the drum by hand',          'description' => 'With the machine unplugged, open the door and try to rotate the drum by hand in both directions. It should turn with moderate, even resistance. If the drum is seized or grinds, a foreign object or bearing failure is present.' ],
                ],
                '_ar_when_to_call'   => "If the drum spins freely by hand but LE persists, the motor hall sensor or motor itself has failed. Hall sensor replacement is a moderate DIY repair. Full motor replacement requires significant disassembly and a certified technician is recommended.",
                '_ar_cost_range'     => '$150 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I know if my Samsung washer LE is a motor fault or water fault?', 'answer' => 'Check when LE appears. If it shows during or after the spin phase, it is the motor overload version. If it shows during the early fill phase before the cycle starts, your model is displaying the older water-level version of LE (equivalent to 4E). Confirm in your model\'s manual.' ],
                    [ 'question' => 'Can I continue using my Samsung washer with LE?', 'answer' => 'Motor overload errors can damage the motor controller if ignored. Address the cause before continuing to use the machine.' ],
                    [ 'question' => 'My Samsung washer shows LE after washing a rug — what happened?', 'answer' => 'Heavy rugs absorb water and can triple in weight during a wash cycle, far exceeding the drum\'s rated capacity. This overloads the motor and triggers LE. Always verify that rugs are listed as machine-washable and do not exceed your washer\'s capacity rating.' ],
                ],
            ],
        ],

        // ── Sud / Sd ─────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer Sud Error Code',
            'slug'       => 'samsung-washer-sud-error-code',
            'meta_title' => 'Samsung Washer Sud / Sd Error Code — Excess Suds Detected',
            'meta_desc'  => 'Samsung washer Sud or Sd means too much detergent foam has been detected. Learn how to fix it and prevent it from happening again.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'Sud',
                '_ar_code_meaning'   => "The Sud (or Sd) error on a Samsung washer means the machine has detected excessive foam in the drum. Samsung HE washers use very little water compared to traditional top-loaders, and the low water volume is quickly overwhelmed by suds from non-HE detergent or from using too much HE detergent.\n\nWhen Sud is triggered, the washer pauses the cycle and attempts to reduce suds by adding water and waiting for foam to dissipate before resuming. The cycle will complete without intervention in most cases, though it may take longer than usual. Persistent Sud indicates a systemic detergent issue.",
                '_ar_causes'         => [
                    [ 'title' => 'Using Non-HE Detergent',         'description' => 'Standard (non-HE) laundry detergent produces far too much foam for high-efficiency washers. Samsung washers require HE-designated detergent only.' ],
                    [ 'title' => 'Too Much HE Detergent',          'description' => 'Even HE detergent produces excessive suds if over-measured. Most HE detergents require only 1–2 tablespoons per load. Always use the fill lines on the dispenser, not the full cap.' ],
                    [ 'title' => 'Detergent Buildup in Dispenser', 'description' => 'Undissolved detergent residue in the drawer and housing accumulates over time. Each cycle washes fresh detergent over this residue, releasing excess soap into the drum.' ],
                    [ 'title' => 'Washing Heavily Pre-Soaped Items', 'description' => 'Items pre-treated with large amounts of dish soap or hand soap generate excessive suds during the machine wash cycle.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Allow the cycle to complete',    'description' => 'If Sud appears mid-cycle, do not open the door or cancel. The washer will automatically pause, add rinse water, and reduce the suds before resuming. The cycle will complete, though it may take 30–60 minutes longer than normal.' ],
                    [ 'title' => 'Switch to HE detergent',         'description' => 'If you have been using non-HE detergent, switch to a Samsung-recommended HE detergent immediately. Use only the amount specified on the packaging for your load size.' ],
                    [ 'title' => 'Clean the detergent drawer and housing', 'description' => 'Remove the drawer completely and soak in warm water to dissolve residue. Clean inside the drawer housing with a small brush. Run a Self Clean cycle with no detergent to flush the system.' ],
                ],
                '_ar_when_to_call'   => "Sud is not a mechanical failure — it does not require a technician call in most cases. If Sud appears consistently even after switching to a small amount of HE detergent, the pressure switch or its hose may be partially blocked, causing the machine to incorrectly detect a high-suds condition.",
                '_ar_cost_range'     => '$0 – $120',
                '_ar_faqs'           => [
                    [ 'question' => 'Does Samsung washer Sud damage the machine?', 'answer' => 'No — Sud itself does not damage the washer. The machine is designed to handle suds events and will compensate automatically. However, chronic suds buildup over time can gum up the pressure switch hose and dispenser, leading to secondary errors.' ],
                    [ 'question' => 'How much detergent should I use in a Samsung HE washer?', 'answer' => 'For a standard load, use the amount indicated by the fill lines on the detergent dispenser drawer — typically 1–2 tablespoons of concentrated HE liquid detergent. Using the full measuring cap supplied with liquid detergent is almost always too much for a Samsung HE washer.' ],
                    [ 'question' => 'Can fabric softener cause Samsung washer Sud?', 'answer' => 'Standard liquid fabric softener used in the correct dispenser compartment does not typically cause Sud. Pouring fabric softener directly into the drum, however, can create foam. Always use the designated softener compartment of the drawer.' ],
                ],
            ],
        ],

        // ── 3E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer 3E Error Code',
            'slug'       => 'samsung-washer-3e-error-code',
            'meta_title' => 'Samsung Washer 3E Error Code — Motor Drive Fault',
            'meta_desc'  => 'Samsung washer 3E means the motor driver board cannot communicate with the wash motor. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => '3E',
                '_ar_code_meaning'   => "The 3E error code on a Samsung washer indicates a motor drive fault — the motor control circuit (motor driver or inverter board) has detected an abnormal condition with the wash motor. This can mean the motor is drawing too much current, the rotor sensor (Hall sensor) is sending incorrect signals, or the motor has stalled.\n\n3E is most common on Samsung direct-drive washers. On these models the drive motor mounts directly to the drum and has a Hall sensor that monitors rotor position. If the sensor signal is absent or erratic, the inverter board logs 3E and stops the drum.",
                '_ar_causes'         => [
                    [ 'title' => 'Faulty Hall Sensor',               'description' => 'The Hall sensor (rotor position sensor) is mounted on the stator and monitors drum rotation. A failing Hall sensor sends incorrect or absent signals, triggering 3E even when the motor itself is healthy.' ],
                    [ 'title' => 'Loose or Corroded Hall Sensor Connector', 'description' => 'The small connector linking the Hall sensor to the main PCB or motor driver can corrode or vibrate loose, interrupting the signal and causing intermittent 3E.' ],
                    [ 'title' => 'Overloaded Drum',                  'description' => 'An overloaded drum forces the motor to draw excessive current. The motor driver detects the overcurrent condition and shuts down, displaying 3E. Removing items and restarting often clears this.' ],
                    [ 'title' => 'Failed Motor Driver Board',        'description' => 'The inverter/motor driver board itself may have failed — commonly from a blown IGBT component or capacitor failure — and can no longer control motor speed.' ],
                    [ 'title' => 'Worn Wash Motor',                  'description' => 'On older machines the motor windings can degrade, increasing resistance and causing the driver to trigger 3E on startup.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Reduce load size and restart',     'description' => 'Remove approximately half the load and restart the cycle. If 3E clears, overloading was the cause. Ensure future loads stay within the rated capacity.' ],
                    [ 'title' => 'Check the Hall sensor connector',  'description' => 'Unplug the washer. Access the back panel (or bottom panel on front-loaders) to reach the motor area. Locate the Hall sensor connector — a small 3- or 5-pin connector. Disconnect, inspect for corrosion, and firmly reseat.' ],
                    [ 'title' => 'Perform a power reset',            'description' => 'Unplug the washer for 5 minutes, then reconnect. A one-time motor overcurrent event caused by an unusual load may have set 3E without actual component failure.' ],
                ],
                '_ar_when_to_call'   => "If 3E persists after reducing the load and reseating the Hall sensor connector, the Hall sensor or motor driver board requires replacement. Testing the Hall sensor requires a multimeter and reading the service manual resistance values. Motor driver replacement is a moderate repair requiring circuit board handling.",
                '_ar_cost_range'     => '$90 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung washer 3E, 3E1, 3E2, and 3E3?', 'answer' => '3E is a general motor fault. 3E1, 3E2, and 3E3 are sub-codes used on newer models to indicate specific motor driver conditions — 3E1 is often a Hall sensor fault, 3E2 a motor overcurrent, and 3E3 a motor control board failure. The sub-code helps narrow the diagnosis.' ],
                    [ 'question' => 'Can 3E appear when the washer is empty?', 'answer' => 'Yes. If 3E appears on an empty drum, overloading is not the cause. Focus on the Hall sensor connector and motor driver board.' ],
                    [ 'question' => 'Is Samsung washer 3E dangerous?', 'answer' => 'No — the washer shuts down safely when 3E is triggered. There is no fire or safety risk. Do not force the cycle to continue; resolve the fault before resuming use.' ],
                ],
            ],
        ],

        // ── 8E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer 8E Error Code',
            'slug'       => 'samsung-washer-8e-error-code',
            'meta_title' => 'Samsung Washer 8E Error Code — MEMS Sensor Vibration Fault',
            'meta_desc'  => 'Samsung washer 8E signals a vibration sensor (MEMS) fault. Learn what causes it, whether you can fix it yourself, and when to call a tech.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => '8E',
                '_ar_code_meaning'   => "The 8E error code on a Samsung washer indicates a fault with the MEMS (Micro Electro Mechanical System) vibration sensor, also called the VRT (Vibration Reduction Technology) sensor. Samsung VRT+ washers use this sensor to detect drum vibration in real time and adjust motor speed to minimize noise during the spin cycle.\n\nWhen 8E appears, the washer cannot read vibration data and defaults to a fault state rather than risk spinning at high speed uncontrolled. 8E is less common than 4E or 5E but tends to require professional diagnosis as the sensor is embedded in the control system.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed MEMS Vibration Sensor',     'description' => 'The sensor module itself has failed, providing incorrect or absent vibration feedback to the main PCB.' ],
                    [ 'title' => 'Damaged Sensor Harness',           'description' => 'The wiring harness connecting the MEMS sensor to the main board has been damaged, kinked, or has a loose connector causing signal interruption.' ],
                    [ 'title' => 'Main PCB Fault',                   'description' => 'On some models the MEMS sensor circuit is integrated into the main PCB; a board fault can display 8E even with a healthy sensor.' ],
                    [ 'title' => 'Excessive Vibration Event',        'description' => 'A severe out-of-balance load can mechanically damage the MEMS sensor module, which is sensitive to shock.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                      'description' => 'Unplug the washer for 5 minutes. An intermittent sensor read error may clear on reset. If 8E reappears immediately on restart, the sensor or harness requires inspection.' ],
                    [ 'title' => 'Check harness connection',         'description' => 'Access the control board area and locate the MEMS sensor connector. Unplug and firmly reseat. Inspect for bent pins or corrosion.' ],
                ],
                '_ar_when_to_call'   => "8E almost always requires a technician. The MEMS sensor location varies by model and is not accessible without significant disassembly. A technician will test the sensor output with diagnostic mode and replace the sensor module or main PCB as indicated.",
                '_ar_cost_range'     => '$120 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Is 8E the same as 8C on Samsung washers?', 'answer' => 'Yes — 8E and 8C represent the same MEMS vibration sensor fault. Samsung updated error code notation on newer models from E-suffix to C-suffix. Diagnosis and repair are identical.' ],
                    [ 'question' => 'Will 8E go away on its own?', 'answer' => 'Rarely. If 8E clears after a power reset and does not return for several cycles, it may have been caused by a transient event. If it recurs, the sensor module requires replacement.' ],
                    [ 'question' => 'Does Samsung washer 8E affect the wash cycle or just spin?', 'answer' => 'Typically just the spin cycle — the VRT sensor is only active during spin. Wash and rinse phases may complete normally before 8E halts the spin.' ],
                ],
            ],
        ],

        // ── CE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer CE Error Code',
            'slug'       => 'samsung-washer-ce-error-code',
            'meta_title' => 'Samsung Washer CE Error Code — Motor Over-Current Fault',
            'meta_desc'  => 'Samsung washer CE indicates a motor over-current condition. Learn the causes — overloaded drum, worn motor — and when to call a technician.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'CE',
                '_ar_code_meaning'   => "The CE error code on a Samsung washer indicates a motor over-current condition. The main PCB monitors drive motor current continuously. When current exceeds the safe threshold — typically caused by a mechanical load that stalls the motor — CE is triggered and the cycle halts to protect the motor windings from heat damage.",
                '_ar_causes'         => [
                    [ 'title' => 'Overloaded Drum',                  'description' => 'An excessively heavy load creates too much resistance for the motor, causing it to draw abnormally high current.' ],
                    [ 'title' => 'Worn or Failed Motor',             'description' => 'Motor windings are breaking down, causing high current draw even under normal loads.' ],
                    [ 'title' => 'Seized Drum Bearing',              'description' => 'A worn drum bearing creates friction that stalls the motor, triggering over-current protection.' ],
                    [ 'title' => 'Motor Control Board Fault',        'description' => 'The inverter or motor control module has failed, supplying incorrect current to the motor.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Reduce load size',                 'description' => 'Remove half the laundry and restart. CE is most commonly triggered by overloading.' ],
                    [ 'title' => 'Power reset',                      'description' => 'Unplug for 5 minutes, then restart with a smaller load.' ],
                ],
                '_ar_when_to_call'   => "If CE appears consistently on normal loads, the motor, drum bearings, or motor control board requires professional diagnosis.",
                '_ar_cost_range'     => '$130 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'Is CE the same as 3E on Samsung washers?', 'answer' => 'Both relate to motor faults but 3E is specifically a motor hall sensor error while CE is a direct over-current detection. A CE that persists may involve the motor itself rather than just the sensor.' ],
                    [ 'question' => 'Can overfilling detergent cause Samsung washer CE?', 'answer' => 'Not directly — CE is a motor current fault, not a suds fault (which displays Sud). However, heavy foam from excess detergent can create hydraulic resistance in the drum that increases motor load. Use the recommended detergent amount and type.' ],
                ],
            ],
        ],

        // ── nE1 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer nE1 Error Code',
            'slug'       => 'samsung-washer-ne1-error-code',
            'meta_title' => 'Samsung Washer nE1 Error Code — Vibration Sensor Fault',
            'meta_desc'  => 'Samsung washer nE1 means the vibration reduction sensor has failed. Learn how it affects the spin cycle and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'nE1',
                '_ar_code_meaning'   => "The nE1 error code on a Samsung washer indicates a fault with the vibration reduction sensor. Samsung VRT (Vibration Reduction Technology) and VRT Plus front-load washers use an accelerometer-based vibration sensor to monitor drum movement during spin and actively adjust the motor speed to minimize vibration and noise. When the sensor circuit fails or reports an out-of-range signal, nE1 is displayed.\n\nnE1 is most commonly reported on Samsung VRT Plus front-load models (WF45R6100AW and similar). The washer may still operate when nE1 is present but the VRT noise-reduction function is disabled, and the spin cycle may become noticeably louder.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Vibration Sensor',            'description' => 'The accelerometer/vibration sensor mounted on the outer tub has failed electrically. This is the most common cause of nE1.' ],
                    [ 'title' => 'Damaged Sensor Wiring',              'description' => 'The wire harness from the vibration sensor to the control board has developed a break or loose connector — a common failure due to the sensor\'s location on the vibrating outer tub.' ],
                    [ 'title' => 'Control Board Sensor Input Fault',   'description' => 'The vibration sensor input circuit on the main control board has failed. Confirmed only after sensor and wiring tests normal.' ],
                    [ 'title' => 'Sensor Mounting Failure',            'description' => 'The sensor has detached or shifted from its mounting position on the outer tub, causing erratic or absent readings.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Unplug the washer for 5 minutes and reconnect. A transient sensor fault may clear. Run a spin-only cycle to test.' ],
                    [ 'title' => 'Check if spin completes with noise', 'description' => 'If the washer still spins but is louder than usual, the VRT sensor has failed but the washer is mechanically functional. The unit is usable until repaired but should not be operated on hardwood or tile floors due to increased vibration.' ],
                ],
                '_ar_when_to_call'   => "nE1 requires a technician to access the vibration sensor and wiring harness, which is located behind the drum tub. The sensor is a model-specific component — confirm availability before scheduling service on older units.",
                '_ar_cost_range'     => '$100 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still do laundry with Samsung washer nE1?', 'answer' => 'Usually yes — the washer often continues to wash and spin with nE1 active, but without vibration reduction the spin cycle will be significantly louder and more disruptive. Avoid extended use on raised platforms or finished flooring where vibration could cause damage.' ],
                    [ 'question' => 'Is nE1 only on Samsung VRT washers?', 'answer' => 'Yes — nE1 applies specifically to Samsung front-load washers equipped with VRT (Vibration Reduction Technology) or VRT Plus. Only these models have the accelerometer-based vibration monitoring circuit that generates the nE1 fault.' ],
                    [ 'question' => 'What is the difference between Samsung washer nE1 and UB?', 'answer' => 'UB means the drum load is unbalanced and the machine stops the spin to redistribute. nE1 means the vibration sensor hardware has failed — the machine cannot monitor vibration at all. UB is a condition; nE1 is a component failure.' ],
                ],
            ],
        ],


        // ── 1E / IE ───────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer 1E Error Code',
            'slug'       => 'samsung-washer-1e-error-code',
            'meta_title' => 'Samsung Washer 1E / IE Error Code — Water Level Sensor Fault',
            'meta_desc'  => 'Samsung washer 1E or IE means the water level sensor has a fault. Learn the causes, what it prevents, and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => '1E',
                '_ar_code_meaning'   => "The 1E error code on a Samsung washer (also displayed as IE on some models) indicates a fault with the water level sensor (pressure switch). The control board uses the water level sensor to monitor how much water is in the drum at any point in the cycle. When the sensor signal is absent, unstable, or out of the expected range, 1E is displayed and the cycle is halted.\n\nThe water level sensor is a pressure-based device connected to the tub via a small rubber hose. It translates water pressure into an electrical signal the control board interprets as fill level. 1E is most often caused by a blocked or disconnected pressure hose rather than a failed sensor.",
                '_ar_causes'         => [
                    [ 'title' => 'Blocked or Kinked Pressure Hose',  'description' => 'The small rubber hose connecting the tub to the pressure sensor is clogged with detergent residue or kinked, preventing accurate pressure readings.' ],
                    [ 'title' => 'Disconnected Pressure Hose',       'description' => 'The hose has come off one of its two connection points — either at the tub fitting or at the sensor.' ],
                    [ 'title' => 'Failed Water Level Sensor',        'description' => 'The pressure sensor itself has failed and is no longer producing a valid electrical signal.' ],
                    [ 'title' => 'Wiring Fault to Sensor',           'description' => 'The wiring harness from the sensor to the control board has a break or loose connector.' ],
                    [ 'title' => 'Excess Suds Filling the Hose',     'description' => 'Heavy suds buildup can enter the pressure hose and block the air column that the sensor relies on.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                      'description' => 'Unplug the washer for 5 minutes and restart. A transient sensor glitch may clear.' ],
                    [ 'title' => 'Inspect and clear the pressure hose', 'description' => 'Remove the top panel of the washer. Locate the small rubber hose running from the side of the outer tub up to the pressure sensor (a small cylindrical component on the control panel frame). Disconnect both ends and blow through it to confirm it is clear. Rinse with warm water if restricted.' ],
                    [ 'title' => 'Check hose connections',           'description' => 'Confirm both ends of the pressure hose are fully seated on their fittings. A loose fit at either end will cause 1E.' ],
                ],
                '_ar_when_to_call'   => "If the hose is clear and correctly connected but 1E persists, the pressure sensor requires testing and likely replacement. If the sensor tests correctly, the control board is suspect.",
                '_ar_cost_range'     => '$80 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung washer 1E the same as IE?', 'answer' => 'Yes — 1E and IE represent the same water level sensor fault on different Samsung display types. The diagnosis and repair are identical.' ],
                    [ 'question' => 'Can I still use my Samsung washer with 1E?', 'answer' => 'No — the washer cannot safely fill or drain without a working water level sensor. It cannot determine when the tub is full and may overfill or fail to fill at all. Do not use the washer until 1E is resolved.' ],
                    [ 'question' => 'What causes 1E to appear suddenly after years of normal use?', 'answer' => 'The pressure hose gradually accumulates detergent deposits, particularly with high-efficiency washers used with too much detergent. A hose that slowly narrows will eventually restrict enough to trigger 1E. Cleaning or replacing the hose resolves most sudden-onset 1E faults on older machines.' ],
                ],
            ],
        ],

        // ── 9E / 9E1 / 9E2 ───────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer 9E Error Code',
            'slug'       => 'samsung-washer-9e-error-code',
            'meta_title' => 'Samsung Washer 9E / 9E1 / 9E2 Error Code — Supply Voltage Fault',
            'meta_desc'  => 'Samsung washer 9E means the supply voltage is out of range. Learn what causes it, whether it is a washer fault, and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => '9E',
                '_ar_code_meaning'   => "The 9E error code on a Samsung washer (also displayed as 9E1 or 9E2 on some models) indicates that the incoming supply voltage is outside the washer's acceptable operating range. Samsung washers monitor the AC supply voltage continuously. If voltage drops too low or rises too high, 9E is displayed and the cycle is paused to protect the motor and electronics.\n\n9E1 typically indicates undervoltage (too low), while 9E2 indicates overvoltage (too high). In most cases, 9E is not a washer fault — it is a supply or wiring issue.",
                '_ar_causes'         => [
                    [ 'title' => 'Low Supply Voltage (9E1)',         'description' => 'The dedicated circuit is undersized, overloaded with other appliances, or the home supply voltage is low. A voltage drop under load causes 9E1.' ],
                    [ 'title' => 'High Supply Voltage (9E2)',        'description' => 'Overvoltage from the utility supply or a wiring fault. Less common than undervoltage.' ],
                    [ 'title' => 'Undersized Extension Cord or Long Run', 'description' => 'Using an extension cord or an undersized outlet wire causes a voltage drop under motor load, triggering 9E1.' ],
                    [ 'title' => 'Loose Outlet or Wall Connection',  'description' => 'A loose neutral or hot connection at the outlet or in the wall box creates a high-resistance joint that drops voltage under load.' ],
                    [ 'title' => 'Failed Voltage Sensing Circuit',   'description' => 'Rarely, the voltage sensing circuit on the control board itself fails and incorrectly reports 9E.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Plug washer directly into a dedicated outlet', 'description' => 'Remove any extension cord or power strip. Samsung washers must be plugged directly into a properly rated wall outlet.' ],
                    [ 'title' => 'Check the outlet voltage under load', 'description' => 'Use a multimeter to measure the outlet voltage while the washer is running. Voltage should remain within 10% of nominal (108–132V for 120V models). A significant drop under load indicates a wiring or circuit issue.' ],
                    [ 'title' => 'Check the outlet for loose connections', 'description' => 'Turn off the circuit breaker. Remove the outlet cover and check that all terminal screws are tight and wires are fully seated.' ],
                ],
                '_ar_when_to_call'   => "If the outlet voltage is within range and connections are tight but 9E persists, call a technician to test the control board voltage sensing circuit. An electrician may be needed if the supply wiring has a fault.",
                '_ar_cost_range'     => '$0 – $180',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung washer 9E the same as Uc?', 'answer' => 'They are related but distinct. Uc is an undervoltage protection pause that typically clears when voltage recovers. 9E is a harder fault that requires a reset. Both indicate the same root cause — supply voltage outside the acceptable range.' ],
                    [ 'question' => 'Can a shared circuit cause 9E?', 'answer' => 'Yes — if the washer shares a circuit with other high-draw appliances (electric dryer on same circuit, HVAC, dishwasher), the combined current draw can drop voltage low enough to trigger 9E1 during the motor-heavy spin cycle.' ],
                    [ 'question' => 'Is 9E dangerous to ignore?', 'answer' => 'Yes — running a washer with chronically low or high voltage will damage the motor and control board over time. Resolve the supply voltage issue before continuing normal use.' ],
                ],
            ],
        ],

        // ── PE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer PE Error Code',
            'slug'       => 'samsung-washer-pe-error-code',
            'meta_title' => 'Samsung Washer PE Error Code — Water Level Sensor Pressure Fault',
            'meta_desc'  => 'Samsung washer PE means the pressure sensor reading is outside the expected range. Learn what causes it and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'PE',
                '_ar_code_meaning'   => "The PE error code on a Samsung washer indicates a pressure sensor (water level sensor) fault — specifically that the sensor reading has gone outside the valid pressure range or that the sensor cannot be calibrated at the start of the cycle. PE is closely related to the 1E error but is more specifically associated with the sensor's pressure reading being out of specification rather than a complete communication failure.\n\nPE halts the cycle to prevent overfilling or incorrect wash levels that could result from an inaccurate pressure reading.",
                '_ar_causes'         => [
                    [ 'title' => 'Blocked Pressure Hose',            'description' => 'The small rubber hose between the tub and the pressure sensor is blocked with detergent residue, preventing accurate pressure transmission to the sensor.' ],
                    [ 'title' => 'Failed Pressure Sensor',           'description' => 'The pressure sensor has drifted out of calibration or failed, producing readings outside the board\'s expected range.' ],
                    [ 'title' => 'Water in the Pressure Hose',       'description' => 'Water has entered the pressure hose (which should carry only air), disrupting the pressure transmission to the sensor.' ],
                    [ 'title' => 'Wiring Fault to Pressure Sensor',  'description' => 'A loose or damaged connector on the pressure sensor wiring harness is causing an incorrect signal.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                      'description' => 'Unplug the washer for 5 minutes. The washer re-calibrates the pressure sensor on startup — a reset may resolve a transient calibration fault.' ],
                    [ 'title' => 'Inspect and clear the pressure hose', 'description' => 'Remove the top panel. Locate the rubber pressure hose connecting the tub to the sensor. Disconnect both ends and blow through it to confirm it is clear and dry. Reconnect firmly.' ],
                    [ 'title' => 'Drain any water from the hose',    'description' => 'If water has entered the hose, hold the hose vertically and allow it to drain completely before reconnecting.' ],
                ],
                '_ar_when_to_call'   => "If the pressure hose is clear and correctly seated but PE persists, the pressure sensor requires replacement. This is an internal repair requiring panel removal.",
                '_ar_cost_range'     => '$80 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Is PE the same as 1E on a Samsung washer?', 'answer' => 'They are related — both involve the pressure/water level sensor. 1E indicates a sensor communication fault, while PE specifically indicates the sensor reading is outside the valid pressure range. The diagnostic steps and repairs are the same.' ],
                    [ 'question' => 'Can PE appear if the washer has not been leveled properly?', 'answer' => 'Not directly — leveling affects balance errors (UB/UE), not the pressure sensor. However, if the washer is severely tilted, water distribution in the tub can create unusual pressure readings. Ensure the washer is level before diagnosing PE.' ],
                ],
            ],
        ],

        // ── tE / tE1 / tE2 / tE3 ─────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer tE Error Code',
            'slug'       => 'samsung-washer-te-error-code',
            'meta_title' => 'Samsung Washer tE / tE1 / tE2 / tE3 Error Code — Water Temperature Sensor Fault',
            'meta_desc'  => 'Samsung washer tE means the water temperature sensor (thermistor) has failed. Learn the causes and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'tE',
                '_ar_code_meaning'   => "The tE error code on a Samsung washer (also displayed as tE1, tE2, or tE3 depending on which sensor or heater circuit is affected) indicates a water temperature sensor fault. Samsung front-load washers are equipped with a water temperature sensor (thermistor) that monitors wash water temperature. The control board uses this reading to regulate water heating for wash cycles that use warm or hot water.\n\ntE1 indicates the temperature sensor is reading out of range or has failed. tE2 and tE3 indicate faults with the heating element circuit or a secondary thermal sensor. All tE variants halt cycles that require temperature control.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Temperature Sensor (tE1)',  'description' => 'The NTC thermistor inside the tub has failed — either open circuit (infinite resistance) or short circuit (near-zero resistance). This is the most common tE cause.' ],
                    [ 'title' => 'Wiring Fault to Sensor',           'description' => 'The wiring harness between the temperature sensor and the control board has a break or corroded connector.' ],
                    [ 'title' => 'Failed Heating Element (tE2/tE3)', 'description' => 'The in-tub water heater element has failed. Samsung front-load washers have an internal heater for sanitize and high-temperature cycles.' ],
                    [ 'title' => 'Control Board Temperature Circuit Fault', 'description' => 'The temperature input circuit on the main control board has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                      'description' => 'Unplug the washer for 5 minutes and restart. If tE was caused by a transient temperature spike, a reset may clear it.' ],
                    [ 'title' => 'Test the temperature sensor resistance', 'description' => 'The NTC thermistor is located on the rear or bottom of the outer tub. At room temperature (~70°F), a healthy Samsung washer thermistor typically reads approximately 10,000–12,000 ohms (check the model\'s service specs for exact values). Readings near zero or infinite confirm sensor failure.' ],
                    [ 'title' => 'Inspect the sensor wiring connector', 'description' => 'Locate the sensor connector and check for corrosion, pushed-back terminals, or a loose fit. A corroded connector is a common tE cause in older machines.' ],
                ],
                '_ar_when_to_call'   => "If the sensor tests out of specification, thermistor replacement is required — an accessible repair on most Samsung front-loaders. If tE2 or tE3 is displayed, the heating element requires testing, which involves access to the rear of the tub and is best handled by a technician.",
                '_ar_cost_range'     => '$85 – $240',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still wash clothes with a Samsung washer showing tE?', 'answer' => 'Cold water cycles may still complete since they do not require temperature monitoring. However, warm and hot cycles, sanitize, and steam functions will be disabled or will abort. Arrange a repair before using temperature-sensitive cycles.' ],
                    [ 'question' => 'What is the difference between tE1, tE2, and tE3?', 'answer' => 'tE1 indicates the temperature sensor (thermistor) has failed or is reading out of range. tE2 indicates a fault detected while the heating element was active — usually the element itself. tE3 indicates a secondary thermal overload sensor has tripped or failed. All three point to the wash water heating system.' ],
                    [ 'question' => 'Is tE on a washer dangerous?', 'answer' => 'A failed thermistor itself is not dangerous, but a failed heating element that tE2/tE3 warns of can represent an electrical fault. Do not use sanitize or high-temperature cycles until tE is resolved.' ],
                ],
            ],
        ],


        // ── bE / bE1 / bE2 ───────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Washer bE Error Code',
            'slug'       => 'samsung-washer-be-error-code',
            'meta_title' => 'Samsung Washer bE / bE1 / bE2 Error Code — Button or Key Fault',
            'meta_desc'  => 'Samsung washer bE means a button or key on the control panel is stuck or shorted. Learn what causes it and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Washer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Washer',
                '_ar_error_code'     => 'bE',
                '_ar_code_meaning'   => "The bE error code on a Samsung washer (also displayed as bE1 or bE2 on some models) indicates a button or key fault on the control panel. The control board continuously scans the touchpad or push-button panel for valid inputs. When it detects a key that is permanently active — either stuck mechanically or shorted electrically — bE is displayed and the washer halts to prevent unintended commands.\n\nbE1 typically indicates a single stuck or shorted key. bE2 indicates a more general button matrix fault. Both codes usually point to the control panel button assembly rather than the main control board.",
                '_ar_causes'         => [
                    [ 'title' => 'Stuck Button or Key',                'description' => 'A push-button on the panel has mechanically stuck in the pressed position due to wear, detergent buildup, or physical damage.' ],
                    [ 'title' => 'Moisture Under the Control Panel',   'description' => 'Water or detergent has seeped into the control panel and is causing a key contact to bridge, simulating a permanent keypress.' ],
                    [ 'title' => 'Failed Button Switch',               'description' => 'The button switch itself has failed internally and is reporting as permanently pressed.' ],
                    [ 'title' => 'Control Board Key-Scan Fault',       'description' => 'The key-scanning circuit on the main control board has failed, misreading key states.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Identify the stuck key',             'description' => 'After a power reset, press each button one at a time. If pressing a specific button immediately triggers bE, that button\'s switch has failed.' ],
                    [ 'title' => 'Clean the control panel',            'description' => 'Wipe down the control panel area with a damp cloth to remove any detergent residue that may be causing buttons to stick. Allow to dry completely before powering on.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Unplug for 5 minutes. A transient bE caused by a momentary moisture event may clear after the panel dries.' ],
                ],
                '_ar_when_to_call'   => "If bE persists or returns repeatedly, the control panel button assembly requires replacement. On most Samsung front-loaders, the button PCB is a separate component from the main control board and can be replaced independently.",
                '_ar_cost_range'     => '$90 – $240',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung washer bE the same as SE on other Samsung appliances?', 'answer' => 'They describe the same type of fault — a stuck or shorted key. Samsung uses SE on ranges and microwaves, and bE on washers for the same underlying issue. The repair (button assembly replacement) is the same in both cases.' ],
                    [ 'question' => 'Can bE appear if I accidentally held a button too long?', 'answer' => 'Briefly, yes — some Samsung washers will display bE if a button is held down for an extended period. Release all buttons and power cycle. If bE clears and does not return, no hardware fault is present.' ],
                ],
            ],
        ],

    ]; // end ar_error_codes_samsung_washer()
}

// ─────────────────────────────────────────────────────────────────────────────
// DRYER ERROR CODES
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_samsung_dryer(): array {
    return [

        // ── HE (Dryer) ────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer HE Error Code',
            'slug'       => 'samsung-dryer-he-error-code',
            'meta_title' => 'Samsung Dryer HE Error Code — No Heat Causes & Fixes',
            'meta_desc'  => 'Samsung dryer HE means the dryer has no heat or overheated. Learn the most common causes — thermal fuse, heating element — and repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'HE',
                '_ar_code_meaning'   => "The HE error code on a Samsung dryer indicates a heating system fault. The dryer's control board monitors the exhaust temperature via a thermistor. If the temperature does not rise to the expected level within a set time (indicating no heat), or rises too fast and beyond the safety threshold (indicating an overheating condition), HE is displayed and the cycle is stopped.\n\nHE on Samsung dryers most commonly indicates that the heating element has failed (electric dryers) or the gas igniter/gas valve has failed (gas dryers). A blown thermal fuse — caused by a blocked vent — is also a very common cause. Unlike a reset-able thermal cut-off, a blown thermal fuse requires replacement.",
                '_ar_causes'         => [
                    [ 'title' => 'Blown Thermal Fuse',             'description' => 'The thermal fuse is a one-time safety device that blows if the dryer overheats (typically due to a blocked vent). Once blown, the dryer produces no heat. The fuse cannot be reset — it must be replaced. The root cause (vent blockage) must also be addressed or the new fuse will blow again.' ],
                    [ 'title' => 'Failed Heating Element (Electric)', 'description' => 'The electric heating element coil has broken, producing no heat. Element failure is common after 8-10 years of service or in dryers where vent blockages have caused repeated overheating cycles.' ],
                    [ 'title' => 'Failed Gas Igniter (Gas Models)', 'description' => 'On gas Samsung dryers, the igniter glows red to ignite the gas burner. A failed igniter (open circuit) means the burner never lights and the dryer tumbles with no heat.' ],
                    [ 'title' => 'Gas Valve Solenoid Failure',     'description' => 'Gas dryers use solenoid coils to open the gas valve. Failed solenoid coils prevent gas from reaching the burner. Typically 2-3 coils fail together.' ],
                    [ 'title' => 'Faulty High-Limit Thermostat',   'description' => 'The high-limit thermostat is a safety device that opens at extreme temperatures. If it fails in the open position, it permanently cuts power to the heating circuit even at normal temperatures.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check and clean the vent system', 'description' => 'A blocked vent is the leading cause of blown thermal fuses. Before any repair, clean the vent duct thoroughly — otherwise the new fuse will blow again.' ],
                    [ 'title' => 'Test the thermal fuse',          'description' => 'The thermal fuse is a small component on the exhaust duct inside the dryer (accessible from the back panel). With a multimeter set to continuity, test across the two fuse terminals. No continuity = blown fuse. Replacement costs under $20.' ],
                    [ 'title' => 'Verify the circuit breaker (electric)', 'description' => 'Electric dryers run on a double-pole 240V circuit. If one leg of the circuit has tripped, the dryer will run (tumble) but produce no heat. Check both breakers in the pair serving the dryer.' ],
                ],
                '_ar_when_to_call'   => "Thermal fuse replacement is a straightforward DIY repair. Heating element replacement requires more disassembly. For gas dryer repairs (igniter, valve solenoids), a certified technician is strongly recommended to ensure safe gas connections.",
                '_ar_cost_range'     => '$85 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'My Samsung dryer runs but produces no heat — is this HE?', 'answer' => 'Yes — this is the classic symptom of HE. The most common cause is a blown thermal fuse. Check the circuit breaker first (for electric dryers), then test the thermal fuse.' ],
                    [ 'question' => 'Can I bypass the Samsung dryer thermal fuse?', 'answer' => 'You can physically bypass it with a wire for testing purposes only. Never operate the dryer with the fuse bypassed — the fuse exists to prevent a dryer fire. If the fuse is blown, replace it and fix the vent restriction that caused it to blow.' ],
                    [ 'question' => 'How long do Samsung dryer heating elements last?', 'answer' => 'Typically 8-12 years under normal use. Service life is dramatically shortened by consistently running the dryer with a blocked vent, which causes the element to cycle at maximum temperature continuously.' ],
                ],
            ],
        ],

        // ── HC (Dryer) ────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer HC Error Code',
            'slug'       => 'samsung-dryer-hc-error-code',
            'meta_title' => 'Samsung Dryer HC Error Code — Overheating Fault',
            'meta_desc'  => 'Samsung dryer HC means the dryer detected an overheating condition. Learn the most common cause — a blocked exhaust vent — and how to fix it safely.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'HC',
                '_ar_code_meaning'   => "The HC error code on a Samsung dryer indicates that the dryer's exhaust temperature has exceeded the safe maximum threshold. The thermistor at the exhaust duct detected a temperature above the programmed limit, causing the control board to shut off the heating circuit as a safety measure.\n\nHC is distinct from HE in that HC means the dryer is too hot (overheating), while HE means the dryer is not hot enough (no heat or insufficient heat). HC almost always points to a blocked exhaust vent that is preventing hot, moist air from exiting the dryer. A failed cycling thermostat that no longer cycles the heating element off is the second most common cause.",
                '_ar_causes'         => [
                    [ 'title' => 'Blocked Exhaust Vent',           'description' => 'Lint accumulation in the vent duct, a crushed flex duct, or a clogged exterior vent cap traps hot air in the drum. The temperature rises rapidly to overheating levels, triggering HC.' ],
                    [ 'title' => 'Clogged Lint Screen',            'description' => 'A completely blocked lint screen (lint trap) significantly restricts airflow from the drum. Always clean the lint screen before every load. A heavily clogged screen causes HC within minutes of starting a cycle.' ],
                    [ 'title' => 'Failed Cycling Thermostat',      'description' => 'The cycling thermostat cycles the heating element on and off to maintain drum temperature within the target range. A failed thermostat (stuck closed) allows the heating element to run continuously, quickly reaching HC temperatures.' ],
                    [ 'title' => 'Crushed or Kinked Duct Behind Dryer', 'description' => 'Flexible foil duct is easily crushed when the dryer is pushed against the wall. A crushed duct has no airflow, causing instant overheating when the heat is on.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the lint screen and vent', 'description' => 'Remove and clean the lint screen. Disconnect the dryer duct from the back of the machine and clean the full duct length to the exterior cap using a dryer vent cleaning brush kit. Clear any obstruction at the exterior cap.' ],
                    [ 'title' => 'Inspect the duct behind the dryer', 'description' => 'Pull the dryer away from the wall and inspect the duct connection and the transition duct. Replace any crushed, kinked, or overly long flexible duct section with rigid or semi-rigid aluminum duct.' ],
                    [ 'title' => 'Run a test cycle with the vent disconnected', 'description' => 'Temporarily disconnect the vent duct from the back of the dryer and run a short timed dry cycle. If HC does not appear with the vent disconnected but returns when reconnected, the vent is the confirmed cause.' ],
                ],
                '_ar_when_to_call'   => "If HC persists after a confirmed clear vent, the cycling thermostat has failed and needs replacement. Cycling thermostat replacement is accessible from the back panel of most Samsung dryers and is a straightforward component swap.",
                '_ar_cost_range'     => '$80 – $190',
                '_ar_faqs'           => [
                    [ 'question' => 'Is a Samsung dryer HC error dangerous?', 'answer' => 'Yes — HC indicates the dryer has reached a temperature above safe operating limits. Continuing to use the dryer with a blocked vent is a fire hazard. Lint is highly combustible. Address the vent blockage before using the dryer again.' ],
                    [ 'question' => 'Why does my Samsung dryer show HC only on certain cycles?', 'answer' => 'High-heat cycles (like Regular or Heavy Duty) generate more heat and are more likely to trigger HC from a partially blocked vent than low-heat cycles (Delicate, Air Fluff). If HC appears only on high-heat settings, the vent is partially blocked but not completely — clear it fully.' ],
                    [ 'question' => 'How do I reset Samsung dryer HC?', 'answer' => 'HC resets when the dryer cools to a safe temperature — typically after 10–20 minutes with the door open. However, simply resetting HC without clearing the vent blockage means HC will return within minutes of the next cycle. Always address the root cause before resetting.' ],
                ],
            ],
        ],

        // ── dS ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer dS Error Code',
            'slug'       => 'samsung-dryer-ds-error-code',
            'meta_title' => 'Samsung Dryer dS Error Code — Door Switch Fault',
            'meta_desc'  => 'Samsung dryer dS means the door switch is not sending a closed-door signal. Learn how to diagnose and replace the door switch yourself.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'dS',
                '_ar_code_meaning'   => "The dS error code on a Samsung dryer indicates a door switch fault. The dryer's control board requires a closed-door signal from the door switch before allowing the motor and heat to activate. When dS is displayed, the board is not receiving this signal.\n\ndS is one of the simplest Samsung dryer error codes to diagnose and repair. The door switch (also called a door interlock switch) is a small spring-loaded button-style switch that is pressed by a striker tab on the door when it closes. These switches fail after years of mechanical cycling.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Switch',             'description' => 'The door switch mechanism itself has worn out — the switch spring has broken or the internal contact has failed. This is the most common cause of dS.' ],
                    [ 'title' => 'Broken Door Striker/Tab',        'description' => 'The plastic tab on the door that depresses the door switch when the door closes has broken off. The switch physically cannot be activated.' ],
                    [ 'title' => 'Wiring Harness Fault',           'description' => 'The wire harness from the door switch to the control board has developed an open circuit, preventing the closed-door signal from reaching the board.' ],
                    [ 'title' => 'Door Not Fully Closing',         'description' => 'The dryer door is not latching fully due to a worn latch or strike, preventing the striker from fully engaging the switch button.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Test the door switch manually',  'description' => 'Open the dryer door. Locate the door switch (a small button inside the door opening — typically top-right corner). Press it with your finger and hold it while trying to start the dryer. If the dryer starts, the switch is not being depressed by the door striker and the striker or switch position needs adjustment or replacement.' ],
                    [ 'title' => 'Inspect the door striker tab',   'description' => 'Close the door slowly and watch for the plastic striker tab on the door to contact the switch. If the tab is broken or missing, the door assembly needs replacement.' ],
                    [ 'title' => 'Test switch continuity',         'description' => 'With the dryer unplugged and the switch wiring disconnected, test the switch with a multimeter. With the button depressed (door closed position), the switch should show continuity. No continuity when pressed = failed switch, replace it.' ],
                ],
                '_ar_when_to_call'   => "Door switch replacement is one of the easiest Samsung dryer repairs — the switch is typically accessible without removing the back panel, by removing the front panel or top panel depending on the model. Parts cost under $25. Call a technician only if the switch tests fine but dS persists, pointing to a wiring or control board issue.",
                '_ar_cost_range'     => '$75 – $160',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I start my Samsung dryer with a dS error by pressing the door switch by hand?', 'answer' => 'You can start it by manually holding the switch button down to confirm the diagnosis, but you should not operate the dryer this way — it is a temporary test only. Replace the switch or striker before regular use.' ],
                    [ 'question' => 'How do I know if it is the door switch or the latch causing Samsung dryer dS?', 'answer' => 'If the door feels loose or does not click into position when closed, the latch is the issue. If the door closes firmly and clicks but dS still appears, the switch itself has failed.' ],
                    [ 'question' => 'How long does a Samsung dryer door switch last?', 'answer' => 'Door switches typically last 8–12 years. Frequency of door opening is the main wear factor — households doing 8+ loads per week may see door switch failure in 5–7 years.' ],
                ],
            ],
        ],

        // ── d80 / d90 / d95 ──────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer d80 Error Code',
            'slug'       => 'samsung-dryer-d80-error-code',
            'meta_title' => 'Samsung Dryer d80 / d90 / d95 Error Code — Blocked Vent Warning',
            'meta_desc'  => 'Samsung dryer d80, d90, or d95 means your exhaust vent is 80, 90, or 95% blocked. Learn how to clean it and prevent a dryer fire.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'd80',
                '_ar_code_meaning'   => "The d80, d90, and d95 error codes on a Samsung dryer are vent restriction warnings — a safety feature unique to Samsung dryers. The dryer measures the exhaust airflow rate and displays a warning when the vent is 80% (d80), 90% (d90), or 95% (d95) blocked.\n\nThese codes do not stop the dryer from operating (the dryer continues to run), but they are a serious warning that must be addressed immediately. A dryer vent blocked 80% or more is a fire hazard — lint inside hot ducts is highly combustible. d95 means the vent is nearly fully blocked and the dryer is at imminent risk of overheating.",
                '_ar_causes'         => [
                    [ 'title' => 'Lint Accumulation in the Vent Duct', 'description' => 'The primary cause of all d-series vent warnings. Lint that passes through the lint screen accumulates inside the duct over months of use. A dryer used for 4+ loads per week should have its vent professionally cleaned annually.' ],
                    [ 'title' => 'Bird or Pest Nest at Exterior Vent Cap', 'description' => 'Birds and rodents frequently nest in exterior vent caps during spring, completely blocking airflow. Check the exterior vent cap seasonally.' ],
                    [ 'title' => 'Kinked or Crushed Flex Duct',    'description' => 'Flexible foil duct is easily crushed behind the dryer. A crushed section restricts airflow dramatically — even a 50% crush is enough to trigger d80.' ],
                    [ 'title' => 'Excessively Long Vent Run',      'description' => 'Vent runs exceeding 25 feet (accounting for elbows) inherently restrict airflow. Each 90° elbow adds approximately 5 feet of equivalent length. Duct runs that were originally marginal become d80/d90 triggers as minor lint builds up.' ],
                    [ 'title' => 'Incorrect Vent Cap Design',       'description' => 'Louvered vent caps or pest screens installed at the exterior restrict airflow by 20–30% even when clean. Samsung recommends a flap-style (single-flap) cap only.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the lint screen',          'description' => 'Remove the lint screen and clean it thoroughly. If it has fabric softener residue coating the mesh (causing reduced airflow even when clean), wash it with warm soapy water, rinse, and allow it to dry completely before reinstalling.' ],
                    [ 'title' => 'Clean the full vent duct',        'description' => 'Disconnect the dryer duct from the back of the machine and from the exterior cap. Use a dryer vent cleaning brush kit (available at hardware stores) to brush lint from the full duct length. Also reach into the dryer\'s exhaust outlet port with the brush.' ],
                    [ 'title' => 'Inspect the exterior vent cap',  'description' => 'Go outside and check the vent cap. Remove any bird nests, lint accumulation, or pest screens. Verify the flap opens freely when you blow into the duct from inside.' ],
                    [ 'title' => 'Inspect the duct behind the dryer', 'description' => 'Pull the dryer out and examine the transition duct. Replace any flexible foil duct that is kinked, crushed, or accordion-folded. Rigid or semi-rigid aluminum duct is strongly preferred for the run behind the dryer.' ],
                ],
                '_ar_when_to_call'   => "Professional vent cleaning is recommended when the duct run is long, has multiple elbows, or passes through walls and ceilings where it cannot be inspected. A dryer vent cleaning service uses a rotary brush and high-powered vacuum to clean from the exterior cap to the dryer — typically a 1-hour service.",
                '_ar_cost_range'     => '$80 – $160',
                '_ar_faqs'           => [
                    [ 'question' => 'Does d80 mean my Samsung dryer will catch fire?', 'answer' => 'd80 means your vent is seriously restricted and overheating is occurring — dryer fires are a real risk at this level. The dryer is displaying this warning precisely because conditions are dangerous. Clean the vent before running another cycle.' ],
                    [ 'question' => 'My Samsung dryer shows d80 but the lint screen is clean — why?', 'answer' => 'The lint screen only captures about 75% of lint. The remaining lint accumulates inside the duct over time. A clean lint screen does not mean the duct is clear. The duct run beyond the machine is where d80-level blockages occur.' ],
                    [ 'question' => 'How often should I clean my Samsung dryer vent?', 'answer' => 'Samsung recommends annual professional vent cleaning for typical household use. High-use households (6+ loads per week), or households with pets that shed, should clean the vent every 6 months.' ],
                ],
            ],
        ],

        // ── tS / t5 ──────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer tS Error Code',
            'slug'       => 'samsung-dryer-ts-error-code',
            'meta_title' => 'Samsung Dryer tS / t5 Error Code — Thermistor Fault',
            'meta_desc'  => 'Samsung dryer tS or t5 means the exhaust thermistor (temperature sensor) has failed. Learn how to test and replace it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'tS',
                '_ar_code_meaning'   => "The tS error code (also displayed as t5 on some Samsung models) indicates that the exhaust thermistor — the temperature sensor that monitors the air leaving the drum — is reading a resistance value outside the expected operating range. The control board cannot regulate drum temperature without accurate sensor feedback, and shuts down the heating circuit.\n\ntS is a relatively uncommon Samsung dryer error. It most often indicates thermistor failure rather than a wiring issue, and is a straightforward component replacement.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Exhaust Thermistor',      'description' => 'The thermistor\'s resistance has drifted out of specification due to component aging or heat damage. The control board detects an out-of-range reading and triggers tS.' ],
                    [ 'title' => 'Damaged Thermistor Wiring',      'description' => 'The wire harness to the thermistor has developed an open circuit from vibration fatigue or heat damage.' ],
                    [ 'title' => 'Control Board Thermistor Input Fault', 'description' => 'Rarely, the thermistor input circuit on the control board fails. Confirmed only after thermistor and wiring replacement do not resolve tS.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Locate the exhaust thermistor',  'description' => 'The exhaust thermistor on Samsung dryers is typically mounted on the exhaust duct near the blower housing, accessible from the back panel. It is a small two-wire sensor with a cylindrical probe.' ],
                    [ 'title' => 'Test thermistor resistance',     'description' => 'With the dryer unplugged and the thermistor wiring disconnected, measure the thermistor resistance with a multimeter. At room temperature (70°F), Samsung dryer thermistors typically read 10,000–14,000 ohms. A reading of infinity (open) or near zero (shorted) confirms sensor failure.' ],
                    [ 'title' => 'Replace the thermistor',         'description' => 'The exhaust thermistor is typically held by a single screw and a two-terminal connector. Replacement takes under 20 minutes. Ensure the replacement thermistor matches the Samsung part number for your specific model.' ],
                ],
                '_ar_when_to_call'   => "Thermistor replacement is a simple DIY repair for those comfortable accessing the back panel of the dryer. If tS persists after thermistor replacement, a technician should test the wiring harness continuity to the control board.",
                '_ar_cost_range'     => '$80 – $170',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung dryer tS and HE?', 'answer' => 'tS means the thermistor is giving an out-of-range reading (sensor fault). HE means the heating circuit is not heating correctly (heater or thermal fuse fault). They involve different components — the thermistor is the sensor, the heating element is the heat source.' ],
                    [ 'question' => 'Can a tS error cause my Samsung dryer not to heat?', 'answer' => 'Yes — when the control board detects a tS thermistor fault, it may disable the heating circuit as a safety measure, resulting in a dryer that tumbles without heat — similar to the symptom of HE.' ],
                    [ 'question' => 'Is Samsung dryer tS the same as t1, t2, or t3?', 'answer' => 'On some Samsung models, multiple thermistor error codes are used (t1, t2, t3, tS, t5) to distinguish between different temperature sensor locations (inlet, exhaust, etc.). The tS and t5 codes specifically refer to the exhaust thermistor on most models. Confirm in your model\'s service manual.' ],
                ],
            ],
        ],

        // ── AC6 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer AC6 Error Code',
            'slug'       => 'samsung-dryer-ac6-error-code',
            'meta_title' => 'Samsung Dryer AC6 Error Code — Control Board Communication Fault',
            'meta_desc'  => 'Samsung dryer AC6 means the main control board lost communication with the sub-board or display board. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'AC6',
                '_ar_code_meaning'   => "The AC6 error code on a Samsung dryer indicates a communication fault between the main control board and the sub-board (user interface or display board). Samsung dryers use two or more PCBs that communicate over a serial data bus. The main control board manages the motor, heat, and sensors while the sub-board handles the user controls and display. When this communication link fails, AC6 is displayed and the dryer becomes non-functional.\n\nAC6 is one of the most commonly reported Samsung dryer error codes in USA service calls. It can appear after a power surge, after the dryer has been moved (connector disturbed), or as a result of a failing sub-board or main board.",
                '_ar_causes'         => [
                    [ 'title' => 'Loose or Damaged Wire Harness',       'description' => 'The wiring harness that connects the main board to the sub-board has a loose connector, bent pin, or broken wire — the most common cause of AC6 and frequently triggered when a dryer is moved or serviced.' ],
                    [ 'title' => 'Failed Sub-Board (Display/UI Board)', 'description' => 'The user interface board has failed and is no longer responding on the communication bus. AC6 is often the result of a failed sub-board on Samsung front-load dryers.' ],
                    [ 'title' => 'Failed Main Control Board',           'description' => 'The main board\'s communication output has failed. Confirmed after sub-board replacement does not resolve AC6.' ],
                    [ 'title' => 'Power Surge Damage',                  'description' => 'A voltage surge has damaged the communication circuitry on one or both boards simultaneously.' ],
                    [ 'title' => 'Moisture on Board Connectors',        'description' => 'Laundry room humidity can cause corrosion on the inter-board connectors, increasing resistance and breaking communication.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                         'description' => 'Unplug the dryer for 10 minutes and restore power. A transient communication fault from a power fluctuation may clear with a full board reset.' ],
                    [ 'title' => 'Check the dryer was not recently moved', 'description' => 'If AC6 appeared after the dryer was moved or serviced, a harness connector was likely disturbed. A technician can reseat and inspect the inter-board harness before replacing any boards.' ],
                ],
                '_ar_when_to_call'   => "AC6 requires a technician to access the internal wiring harness and PCBs. The repair is typically straightforward — most AC6 faults are resolved by reseating the inter-board harness connector or replacing the sub-board, which is less expensive than the main board.",
                '_ar_cost_range'     => '$120 – $350',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I reset Samsung dryer AC6 myself?', 'answer' => 'A power reset (unplug for 10 minutes) clears AC6 in a small percentage of cases where a transient communication fault was triggered by a power event. If AC6 returns on the next cycle, the fault is hardware — a connector, sub-board, or main board requires attention.' ],
                    [ 'question' => 'Is Samsung dryer AC6 always a board replacement?', 'answer' => 'Not always — AC6 is frequently caused by a loose or corroded inter-board harness connector rather than a failed PCB. A technician will check the harness first. Harness reseating or replacement is far less expensive than a board swap.' ],
                    [ 'question' => 'Why did AC6 appear after I moved my Samsung dryer?', 'answer' => 'Moving a dryer can stress or partially dislodge the harness connector between the main board and sub-board. This is the most common trigger for post-move AC6. A technician can open the dryer and reseat the connector — a quick and inexpensive fix.' ],
                ],
            ],
        ],

        // ── bE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer bE Error Code',
            'slug'       => 'samsung-dryer-be-error-code',
            'meta_title' => 'Samsung Dryer bE Error Code — Button Stuck / Shorted Key',
            'meta_desc'  => 'Samsung dryer bE means a control panel button is stuck or shorted. Learn how to diagnose and fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'bE',
                '_ar_code_meaning'   => "The bE error code on a Samsung dryer indicates a control panel button fault — a button on the user interface panel is stuck in the pressed position, has shorted internally, or the control board is reading a continuous key-press signal. bE prevents normal operation because the control system cannot accept valid input commands while a key appears permanently active.",
                '_ar_causes'         => [
                    [ 'title' => 'Physically Stuck Button',          'description' => 'Lint, detergent residue, or debris has worked into the button gap, physically holding it in the pressed position.' ],
                    [ 'title' => 'Moisture Under the Membrane',      'description' => 'Steam or humidity has penetrated under the control panel membrane, causing a short that mimics a pressed button.' ],
                    [ 'title' => 'Damaged Membrane Switch',          'description' => 'The flexible membrane switch behind the control panel has developed a crack or delamination, creating a permanent contact at one key position.' ],
                    [ 'title' => 'Faulty Main Control Board',        'description' => 'The key-scan circuit on the main PCB has failed, incorrectly detecting a stuck key.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check for physically stuck buttons', 'description' => 'Press each button on the panel firmly and release. Sometimes a button is stuck from debris. Clean around each button with a dry cloth or compressed air.' ],
                    [ 'title' => 'Power reset',                      'description' => 'Unplug the dryer for 10 minutes. A moisture-induced short may clear as the panel dries. Reconnect and test.' ],
                ],
                '_ar_when_to_call'   => "If bE persists after cleaning and a power reset, the control panel membrane switch or main PCB requires replacement. Membrane switch replacement is a straightforward repair; board replacement is more involved.",
                '_ar_cost_range'     => '$80 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung dryer bE the same as bE2, bE3?', 'answer' => 'Yes — bE, bE2, and bE3 are sub-variants of the same button fault. The sub-number sometimes indicates which button row has the fault, helping narrow the location on larger control panels.' ],
                    [ 'question' => 'Can humidity cause Samsung dryer bE?', 'answer' => 'Yes — high laundry room humidity can cause condensation under the control panel membrane. Running the dryer in a ventilated area and ensuring the exhaust vent is clear reduces humidity exposure.' ],
                ],
            ],
        ],

        // ── Hr ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer Hr Error Code',
            'slug'       => 'samsung-dryer-hr-error-code',
            'meta_title' => 'Samsung Dryer Hr Error Code — High Temperature Limit Fault',
            'meta_desc'  => 'Samsung dryer Hr means the drum temperature has exceeded the safe limit. Learn the causes — usually a blocked vent — and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'Hr',
                '_ar_code_meaning'   => "The Hr error code on a Samsung dryer signals that the drum temperature has exceeded the maximum safe operating limit. Samsung dryers monitor drum temperature via a thermistor and a thermal limiter. When the temperature exceeds the high-limit threshold, the control board displays Hr and shuts off the heating circuit to prevent damage or fire.\n\nHr is closely related to Fd (airflow restriction) — a blocked exhaust vent is the most common trigger. With restricted airflow, heat builds up in the drum instead of being carried out through the duct.",
                '_ar_causes'         => [
                    [ 'title' => 'Blocked Exhaust Duct',             'description' => 'Lint in the exhaust duct traps heat inside the drum, causing temperature to spike past the high-limit threshold.' ],
                    [ 'title' => 'Blown Thermal Fuse',               'description' => 'If the temperature spike was severe enough, the thermal fuse on the heating assembly may have blown. A blown thermal fuse disables heating permanently until replaced.' ],
                    [ 'title' => 'Failed High-Limit Thermostat',     'description' => 'The high-limit thermostat that cuts power to the heater at the temperature threshold has failed open, allowing continuous heating past safe limits.' ],
                    [ 'title' => 'Cycling Thermostat Failure',       'description' => 'The cycling thermostat failed closed, preventing the heater from cycling off between temperature peaks and allowing the drum to overheat.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the exhaust duct immediately', 'description' => 'Disconnect the dryer and clean the full duct run. A completely blocked duct is the root cause in most Hr events. Do not run the dryer again until the duct is clear.' ],
                    [ 'title' => 'Test the thermal fuse',            'description' => 'After an overtemperature event, test the thermal fuse for continuity with a multimeter. The fuse is a one-shot device — if it shows no continuity, it must be replaced even if the dryer appears to run.' ],
                ],
                '_ar_when_to_call'   => "If the duct is clean and Hr still appears, or if the dryer runs but produces no heat after clearing Hr, the thermal fuse, cycling thermostat, or high-limit thermostat requires replacement. These are moderate repairs requiring access to the heating assembly.",
                '_ar_cost_range'     => '$80 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Does Samsung dryer Hr mean the thermal fuse has blown?', 'answer' => 'Not necessarily — Hr is triggered when the temperature threshold is first exceeded, which blows the thermal fuse as a safety backup. If the fuse blows, the dryer will subsequently run without heat. Always test the fuse after an Hr event.' ],
                    [ 'question' => 'Can I reset Samsung dryer Hr by unplugging it?', 'answer' => 'A power reset may clear the Hr code from the display, but if the underlying cause (blocked duct or failed thermostat) is not resolved, Hr will return — and the thermal fuse may blow permanently.' ],
                ],
            ],
        ],

        // ── 9C ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer 9C Error Code',
            'slug'       => 'samsung-dryer-9c-error-code',
            'meta_title' => 'Samsung Dryer 9C Error Code — Supply Voltage Out of Range',
            'meta_desc'  => 'Samsung dryer 9C means the supply voltage is outside the acceptable operating range. Learn the causes and how to resolve it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => '9C',
                '_ar_code_meaning'   => "The 9C error code on a Samsung dryer indicates the supply voltage is outside the acceptable operating range. Samsung dryers monitor input voltage continuously and display 9C when voltage is too high or too low to operate safely. The dryer halts to protect the motor, heating element, and control board from voltage-related damage.",
                '_ar_causes'         => [
                    [ 'title' => 'Under-Voltage Condition',          'description' => 'Supply voltage has dropped below the minimum threshold, often during peak grid demand or from a shared circuit.' ],
                    [ 'title' => 'Over-Voltage Condition',           'description' => 'Supply voltage exceeds the maximum threshold, possible after grid switching events or line surges.' ],
                    [ 'title' => 'Loose Outlet Connection',          'description' => 'A loose wire at the outlet creates voltage fluctuation under load.' ],
                    [ 'title' => 'Undersized Branch Wiring',         'description' => 'The circuit wiring is too small for the dryer load, causing voltage drop during operation.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Measure outlet voltage under load', 'description' => 'Use a multimeter to measure at the dryer outlet. A 240V dryer should read 220–240V. Below 210V or above 250V indicates a supply problem requiring an electrician.' ],
                    [ 'title' => 'Reset and retry',                  'description' => 'Unplug for 5 minutes and reconnect. If 9C clears and does not return, the event was transient.' ],
                ],
                '_ar_when_to_call'   => "If 9C appears repeatedly, have an electrician test the circuit. Persistent voltage issues can damage appliance electronics over time.",
                '_ar_cost_range'     => 'Electrician: $80 – $200',
                '_ar_faqs'           => [
                    [ 'question' => 'Is 9C the same as Cb on Samsung dryers?', 'answer' => 'Related but different — Cb specifically means one leg of 240V is missing (open circuit on one phase), while 9C is a general voltage out-of-range warning covering both low and high voltage conditions.' ],
                ],
            ],
        ],

        // ── dC ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer dC Error Code',
            'slug'       => 'samsung-dryer-dc-error-code',
            'meta_title' => 'Samsung Dryer dC Error Code — Door Open or Latch Fault',
            'meta_desc'  => 'Samsung dryer dC means the door is open or the door switch has failed. Learn how to diagnose a latch fault and what replacement costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'dC',
                '_ar_code_meaning'   => "The dC error code on a Samsung dryer indicates the dryer door is open or the door switch is not reading correctly. Samsung dryers require a confirmed door-closed signal before starting or continuing a cycle. When the signal is absent or intermittent, dC is displayed and the cycle halts.\n\ndC may appear even when the door is physically closed if the door switch, door latch, or wiring harness has failed.",
                '_ar_causes'         => [
                    [ 'title' => 'Door Not Fully Latched',           'description' => 'The door was not closed firmly enough for the latch to engage the strike.' ],
                    [ 'title' => 'Worn Door Latch or Strike',        'description' => 'The plastic latch tab or door strike has worn or broken, preventing consistent contact with the switch.' ],
                    [ 'title' => 'Failed Door Switch',               'description' => 'The microswitch behind the door frame has failed open, sending a constant "door open" signal to the PCB.' ],
                    [ 'title' => 'Loose Wiring to Door Switch',      'description' => 'The harness connector to the door switch has loosened.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Close door firmly',                'description' => 'Press the door firmly until you feel the latch click fully engaged. Restart the cycle.' ],
                    [ 'title' => 'Inspect door latch',               'description' => 'Examine the latch tab on the door and the strike on the frame. Replace if worn or cracked — plastic latch strikes are inexpensive and commonly the cause of dC on dryers over 5 years old.' ],
                ],
                '_ar_when_to_call'   => "If the door latches securely but dC persists, the door switch requires replacement — a straightforward repair on most Samsung dryer models.",
                '_ar_cost_range'     => '$60 – $160',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I bypass the Samsung dryer door switch?', 'answer' => 'No — the door switch is a safety interlock. Running the dryer with the door open or unlatched is a fire and injury hazard. Replace the switch rather than bypassing it.' ],
                    [ 'question' => 'Why does Samsung dryer dC appear mid-cycle?', 'answer' => 'A worn latch may hold the door closed during loading but lose contact as the drum vibration increases. The door appears closed but the switch intermittently loses contact, triggering dC mid-cycle. Replace the door latch and strike.' ],
                ],
            ],
        ],

        // ── tE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer tE Error Code',
            'slug'       => 'samsung-dryer-te-error-code',
            'meta_title' => 'Samsung Dryer tE Error Code — Exhaust Temperature Sensor Fault',
            'meta_desc'  => 'Samsung dryer tE means the exhaust thermistor is reading outside its expected range. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'tE',
                '_ar_code_meaning'   => "The tE error code on a Samsung dryer indicates the exhaust temperature sensor (thermistor) is reading a resistance value outside the acceptable range. The thermistor monitors exhaust air temperature so the control board can regulate heating and prevent overheating. When the sensor reads an impossibly high or low value — indicating an open or shorted circuit — the board disables the heating circuit and displays tE.\n\ntE differs from HC (high-heat cut-off) in that it reflects a sensor failure, not an actual overheating event. In most cases, the thermistor itself has failed rather than the wiring or control board.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Exhaust Thermistor',           'description' => 'The thermistor has failed open or shorted, returning an out-of-range resistance value.' ],
                    [ 'title' => 'Broken or Loose Thermistor Wiring',   'description' => 'A wire in the thermistor harness has broken or the connector has pulled loose.' ],
                    [ 'title' => 'Control Board Sensor Input Fault',    'description' => 'Rarely, the temperature sensor input circuit on the main PCB has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Test the thermistor with a multimeter', 'description' => 'Unplug the dryer. Locate the exhaust thermistor (clipped to the exhaust duct near the heating assembly). Disconnect and measure resistance at room temperature — most Samsung dryer thermistors read approximately 10,000–50,000 ohms at room temperature. An infinite or zero reading confirms failure.' ],
                    [ 'title' => 'Inspect the wiring harness',           'description' => 'Check the thermistor connector and harness for visible damage, corrosion, or loose pins. Reconnect firmly and retest.' ],
                ],
                '_ar_when_to_call'   => "Thermistor replacement is an accessible DIY repair on most Samsung dryers — the part is inexpensive and located near the heating assembly at the rear of the unit. If tE persists after a confirmed good thermistor, a technician should test the main board sensor circuit.",
                '_ar_cost_range'     => '$40 – $130',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung dryer tE and tS?', 'answer' => 'tS indicates the exhaust thermistor is reading an abnormal resistance value (open or short), while tE indicates the sensor reading is outside the expected temperature range. Both fault codes relate to the same thermistor component — the repair is typically thermistor replacement either way.' ],
                    [ 'question' => 'Can Samsung dryer tE clear itself?', 'answer' => 'A one-time tE from a loose connector may clear after a power reset and reconnecting the harness. A persistently failing thermistor will not clear — it requires component replacement.' ],
                ],
            ],
        ],

        // ── dE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer dE Error Code',
            'slug'       => 'samsung-dryer-de-error-code',
            'meta_title' => 'Samsung Dryer dE Error Code — Door Open or Door Switch Fault',
            'meta_desc'  => 'Samsung dryer dE means the door is open or the door switch has failed. Learn how to diagnose latch and switch faults.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'dE',
                '_ar_code_meaning'   => "The dE error code on a Samsung dryer indicates the door is open or the dryer cannot confirm the door is closed. Samsung dryers require a door-closed signal from the door switch before starting or continuing a cycle. dE appears when this signal is absent. Sub-variants dE1 and dE2 indicate the door was opened mid-cycle (dE1) or the door switch signal was lost during a cycle (dE2).",
                '_ar_causes'         => [
                    [ 'title' => 'Door Not Fully Latched',              'description' => 'The door was not pushed firmly enough to engage the latch fully.' ],
                    [ 'title' => 'Worn Door Latch or Strike',            'description' => 'The plastic door latch or strike plate has worn, preventing a solid latch engagement.' ],
                    [ 'title' => 'Failed Door Switch',                   'description' => 'The microswitch activated by the door latch has failed open, reporting the door as open even when latched.' ],
                    [ 'title' => 'Loose Door Switch Wiring',             'description' => 'The connector to the door switch has loosened, creating an intermittent open-circuit signal.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Push door firmly closed',              'description' => 'Press the door firmly until the latch clicks. Try starting the cycle again.' ],
                    [ 'title' => 'Inspect the latch and strike',         'description' => 'Examine the latch tab on the door and the strike plate in the frame opening. Look for cracking, wear, or misalignment. A worn latch is the most common cause of dE on dryers over 5 years old.' ],
                    [ 'title' => 'Test the door switch',                 'description' => 'With the dryer unplugged, use a multimeter to test the door switch for continuity — it should be closed (continuity) when the latch is pressed, open when released.' ],
                ],
                '_ar_when_to_call'   => "If the door latch and switch both test good but dE persists, a technician should check the harness and main board door sense circuit.",
                '_ar_cost_range'     => '$50 – $150',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung dryer dE and dE1?', 'answer' => 'dE typically means the door was not detected as closed at cycle start. dE1 means the door opened (or the switch lost signal) during a running cycle. Both point to the door latch or switch, but dE1 is often caused by a worn latch that loses contact from drum vibration.' ],
                    [ 'question' => 'Is Samsung dryer dE the same as dC?', 'answer' => 'They represent the same fault — door open or switch failure. dE is the code used on newer Samsung dryer firmware, dC on older models. The diagnosis and repair are identical.' ],
                ],
            ],
        ],

        // ── CE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer CE Error Code',
            'slug'       => 'samsung-dryer-ce-error-code',
            'meta_title' => 'Samsung Dryer CE Error Code — Communication Error',
            'meta_desc'  => 'Samsung dryer CE means the main control board has lost communication with a sub-board or motor module. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'CE',
                '_ar_code_meaning'   => "The CE error code on a Samsung dryer indicates a communication fault between the main control board and a secondary board or module. Modern Samsung dryers use a multi-board architecture where the main PCB communicates with the motor control module, display board, or wifi module. When this communication is interrupted, CE is displayed and the dryer stops operating.",
                '_ar_causes'         => [
                    [ 'title' => 'Loose Inter-Board Wiring Harness',    'description' => 'The connector linking the main board to a sub-board has come loose or a wire in the harness has broken.' ],
                    [ 'title' => 'Failed Sub-Board or Motor Module',    'description' => 'A secondary control board has failed and stopped responding to the main PCB.' ],
                    [ 'title' => 'Main Control Board Communication Fault', 'description' => 'The communication circuit on the main PCB itself has failed.' ],
                    [ 'title' => 'Power Surge Damage',                  'description' => 'A voltage spike has damaged the communication circuitry on one or both boards.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                         'description' => 'Unplug the dryer for 5 minutes, then reconnect. A transient communication fault may clear.' ],
                    [ 'title' => 'Check accessible harness connectors', 'description' => 'If comfortable accessing the back panel, check the inter-board harness connectors for looseness or corrosion.' ],
                ],
                '_ar_when_to_call'   => "Persistent CE after a power reset requires a technician to identify which board has failed. Diagnosis typically involves reading service mode fault logs and testing board-to-board communication.",
                '_ar_cost_range'     => '$120 – $350',
                '_ar_faqs'           => [
                    [ 'question' => 'Can a power surge cause Samsung dryer CE?', 'answer' => 'Yes — CE is a common post-surge fault code. If CE appeared after a power outage or storm, the main board or motor control module communication circuit may have been damaged by the surge.' ],
                    [ 'question' => 'Does CE mean I need a new dryer?', 'answer' => 'Not necessarily — CE is often a harness or single-board fault, not a full dryer failure. A technician can identify the specific failed component, which is frequently a sub-board rather than the more expensive main PCB.' ],
                ],
            ],
        ],

        // ── tC ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer tC Error Code',
            'slug'       => 'samsung-dryer-tc-error-code',
            'meta_title' => 'Samsung Dryer tC Error Code — Thermal Cutout / High-Limit Fault',
            'meta_desc'  => 'Samsung dryer tC means the thermal cutout or high-limit thermostat has tripped due to overheating. Learn the causes and repair steps.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'tC',
                '_ar_code_meaning'   => "The tC error code on a Samsung dryer indicates that the thermal cutout or high-limit thermostat has tripped as a result of an overheating condition. Samsung dryers are equipped with multiple temperature safety devices — a thermal fuse (one-time, non-resettable), a cycling thermostat, and a thermal cutout (high-limit thermostat). The tC code specifically identifies the thermal cutout as the device that has opened.\n\ntC is triggered when the exhaust or drum temperature exceeds the thermal cutout's threshold — typically caused by a blocked vent. Unlike the HC code (which is detected while the dryer is still running), tC means the cutout physically opened and the heating circuit is now permanently broken until the component is replaced.",
                '_ar_causes'         => [
                    [ 'title' => 'Blocked Exhaust Vent',                'description' => 'The primary cause of tC. Lint accumulated in the vent duct, a crushed duct behind the dryer, or a blocked exterior vent cap causes heat to back up until the thermal cutout trips. The vent blockage must be cleared before replacing the component or it will trip again immediately.' ],
                    [ 'title' => 'Heavily Clogged Lint Screen',         'description' => 'A completely blocked lint screen restricts airflow from the drum, causing rapid overheating within minutes of starting a cycle.' ],
                    [ 'title' => 'Failed Cycling Thermostat',           'description' => 'A cycling thermostat stuck in the closed position keeps the heating element running continuously, rapidly driving the temperature to the thermal cutout\'s trip point.' ],
                    [ 'title' => 'Excessive Duct Length or Elbows',     'description' => 'A vent run that is too long or has too many bends inherently restricts airflow and raises exhaust temperatures, causing chronic thermal cutout trips.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the vent system completely',    'description' => 'Before any component replacement, thoroughly clean the full exhaust vent duct from the dryer to the exterior cap. Use a rotary brush kit. This is essential — if the vent is not cleared, any replacement component will trip again.' ],
                    [ 'title' => 'Clean the lint screen',               'description' => 'Remove and clean the lint screen. If residue from dryer sheets coats the mesh, wash it with warm soapy water and let it dry completely before reinstalling.' ],
                    [ 'title' => 'Do not attempt to bypass or reset tC', 'description' => 'The thermal cutout is a safety device. It cannot be reset — it must be replaced. Do not bypass it with a wire as this removes fire protection.' ],
                ],
                '_ar_when_to_call'   => "Thermal cutout replacement requires accessing the dryer internals — typically the back panel or front panel depending on the model. A technician will test the component for continuity, confirm the vent is clear, and replace the failed cutout with the correct Samsung part.",
                '_ar_cost_range'     => '$80 – $200',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung dryer tC and HE?', 'answer' => 'HE means the dryer has no heat — the heating element, thermal fuse, or gas system has failed. tC specifically means the thermal cutout (high-limit thermostat) has tripped due to overheating. Both may result in a dryer that runs without heat, but tC points specifically to the high-limit safety device.' ],
                    [ 'question' => 'Can I reset the thermal cutout on a Samsung dryer?', 'answer' => 'No. Unlike the HC code (which clears after the dryer cools), a tripped thermal cutout has physically opened and cannot restore itself. It must be replaced. Attempting to reset it or run the dryer with the cutout bypassed removes a critical fire safety device.' ],
                    [ 'question' => 'Will tC happen again after I replace the thermal cutout?', 'answer' => 'Yes — if you replace the thermal cutout without clearing the root cause (blocked vent, clogged lint screen, failed cycling thermostat), the new cutout will trip again within one or two drying cycles. Always address the cause before or during the repair.' ],
                ],
            ],
        ],

        // ── 3E ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer 3E Error Code',
            'slug'       => 'samsung-dryer-3e-error-code',
            'meta_title' => 'Samsung Dryer 3E Error Code — Motor Error',
            'meta_desc'  => 'Samsung dryer 3E means the drum motor has failed or is not running correctly. Learn the causes, DIY steps, and repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => '3E',
                '_ar_code_meaning'   => "The 3E error code on a Samsung dryer indicates a motor fault. The drum motor drives the drum rotation. The control board monitors motor operation via a tachometer or Hall sensor. When the motor fails to start, stalls, or its speed feedback signal is lost, 3E is displayed and the dryer halts.\n\nSub-variants include 3E1 (motor start fault), 3E2 (motor overcurrent), 3E3 (Hall sensor fault), and 3E4 (motor speed abnormal). All involve the drum motor circuit.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Drum Motor',                   'description' => 'The motor windings have burned out or the motor brushes (on brush-type motors) are worn, preventing the motor from starting or maintaining speed.' ],
                    [ 'title' => 'Motor Overloaded by Belt or Drum',    'description' => 'A seized drum bearing or a broken belt that has wrapped around the shaft can overload the motor, triggering overcurrent protection.' ],
                    [ 'title' => 'Failed Hall Sensor / Tachometer',    'description' => 'The speed feedback sensor has failed, causing the board to lose motor speed data even when the motor is running.' ],
                    [ 'title' => 'Motor Control Board Fault',           'description' => 'The motor driver circuit on the main PCB has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check for drum rotation obstruction', 'description' => 'Open the dryer door and manually rotate the drum by hand. It should spin freely with light resistance from the belt. If it is stiff or jammed, inspect the drum support rollers, drum bearing, and belt for damage.' ],
                    [ 'title' => 'Power reset',                         'description' => 'Unplug for 5 minutes. A motor thermal protection trip (from a single overload) may reset after cooling.' ],
                ],
                '_ar_when_to_call'   => "Motor replacement is a moderate repair requiring dryer disassembly. A technician can confirm whether the fault is the motor itself, the Hall sensor, or the drive board before ordering parts.",
                '_ar_cost_range'     => '$150 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung dryer 3E, 3E1, 3E2, 3E3, 3E4?', 'answer' => '3E is the generic motor fault. 3E1 indicates the motor failed to start; 3E2 indicates the motor drew excessive current (overcurrent); 3E3 indicates the Hall sensor (speed sensor) is not responding; 3E4 indicates the motor speed is outside the normal range. All sub-variants involve the drum motor or its feedback circuit.' ],
                    [ 'question' => 'Can a blocked dryer vent cause 3E?', 'answer' => 'Indirectly — severe vent blockage causes overheating, which can trip the motor\'s built-in thermal protection and produce a 3E. Clear the vent and allow the dryer to cool fully before restarting to rule out a thermally-tripped motor before replacing components.' ],
                ],
            ],
        ],

        // ── 9E ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer 9E Error Code',
            'slug'       => 'samsung-dryer-9e-error-code',
            'meta_title' => 'Samsung Dryer 9E Error Code — Supply Voltage Error',
            'meta_desc'  => 'Samsung dryer 9E means the supply voltage is outside the acceptable operating range. Learn the causes and how to resolve it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => '9E',
                '_ar_code_meaning'   => "The 9E error code on a Samsung dryer indicates the supply voltage is outside the acceptable operating range. Samsung dryers continuously monitor input voltage and halt operation when voltage is too high or too low to operate safely. Operating on out-of-range voltage risks damage to the motor, heating element, and control board.\n\nSub-variants 9E1 and 9E2 indicate under-voltage and over-voltage conditions respectively on some Samsung models.",
                '_ar_causes'         => [
                    [ 'title' => 'Under-Voltage Condition',             'description' => 'Supply voltage has dropped below the minimum threshold, often during peak grid demand or from a shared circuit with other high-draw appliances.' ],
                    [ 'title' => 'Over-Voltage Condition',              'description' => 'Supply voltage exceeds the maximum threshold, possible after grid switching events or line surges.' ],
                    [ 'title' => 'Half-Tripped Circuit Breaker',        'description' => 'One pole of the double-pole breaker has partially tripped, delivering only one leg of the 240V supply — effectively halving the voltage.' ],
                    [ 'title' => 'Faulty Voltage Sensing Circuit',      'description' => 'The voltage monitoring circuit on the main control board has failed, incorrectly reporting an out-of-range voltage.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check the circuit breaker',           'description' => 'Turn the double-pole breaker fully OFF, then back ON. A half-tripped pole can cause under-voltage faults and may not be obvious visually.' ],
                    [ 'title' => 'Power reset',                         'description' => 'Unplug for 5 minutes. A one-time transient voltage event may have triggered 9E without an underlying electrical problem.' ],
                    [ 'title' => 'Test outlet voltage',                 'description' => 'Use a multimeter to measure voltage at the dryer outlet. An electric dryer should read 240V (±10%) across the two hot terminals.' ],
                ],
                '_ar_when_to_call'   => "If the outlet voltage reads correctly and 9E persists, the board voltage sensing circuit has failed and the main control board requires replacement. If the outlet voltage is abnormal, contact a licensed electrician.",
                '_ar_cost_range'     => '$0 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung dryer 9E and 9C?', 'answer' => '9E and 9C represent the same fault — supply voltage out of range — displayed under different Samsung firmware versions. 9E is more common on newer models; 9C appears on older ones. The diagnosis and repair are identical.' ],
                    [ 'question' => 'Can 9E damage my Samsung dryer?', 'answer' => 'The 9E code is specifically designed to prevent damage — the dryer halts before out-of-range voltage can harm components. Address the voltage issue promptly, but the dryer itself is unlikely to have been damaged if the fault appeared quickly.' ],
                ],
            ],
        ],

        // ── FE (Dryer) ───────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer FE Error Code',
            'slug'       => 'samsung-dryer-fe-error-code',
            'meta_title' => 'Samsung Dryer FE Error Code — Power Frequency Fault',
            'meta_desc'  => 'Samsung dryer FE means the control board detected an abnormal power supply frequency. Learn what causes it and how to resolve it quickly.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'FE',
                '_ar_code_meaning'   => "The FE error code on a Samsung dryer indicates that the control board has detected a power supply frequency outside the acceptable operating range. Samsung dryers in the USA run on 60 Hz AC power. The main control board continuously monitors the incoming frequency, and if it falls below approximately 55 Hz or rises above 65 Hz, FE is triggered and the dryer halts to protect motor and control board components from damage.\n\nFE most commonly occurs during power outages and restoration events, when running on generator power, or during significant grid fluctuations. In rare cases, a failing main control board may misread a normal frequency signal and generate a false FE error.",
                '_ar_causes'         => [
                    [ 'title' => 'Power Grid Fluctuation',             'description' => 'Utility grid disturbances — such as those following a storm or during high-demand periods — can cause brief frequency deviations that trigger FE. The error typically clears after the grid stabilises.' ],
                    [ 'title' => 'Generator Power Supply',             'description' => 'Portable and standby generators often produce power at a frequency that drifts outside the 60 Hz range, especially under variable load. Running a dryer on generator power is a common cause of FE.' ],
                    [ 'title' => 'Power Restoration After Outage',     'description' => 'When utility power is restored after an outage, a brief frequency spike or surge can be misread by the control board and trigger FE. A full power cycle typically clears the fault.' ],
                    [ 'title' => 'Failing Main Control Board',         'description' => 'A deteriorating main control board may misinterpret a normal 60 Hz supply as out-of-range and generate a false FE code. This is less common but should be suspected if FE occurs repeatedly with no external power issue.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power cycle the dryer',              'description' => 'Unplug the dryer from the wall outlet, wait 60 seconds, then plug it back in. Most FE errors caused by transient grid events clear immediately after a power cycle.' ],
                    [ 'title' => 'Check the power source',             'description' => 'Confirm the dryer plugs directly into a dedicated 240V wall outlet — not into an extension cord or power strip. If running on generator power, switch to utility power before operating the dryer.' ],
                    [ 'title' => 'Test on a different outlet or circuit', 'description' => 'If FE returns after a power cycle, try the dryer on a different circuit if possible, or have an electrician verify that the outlet delivers stable 60 Hz / 240V power.' ],
                ],
                '_ar_when_to_call'   => "If FE recurs consistently on a stable utility power supply after multiple power cycles, the main control board is likely generating a false fault and will need professional diagnosis and possible replacement.",
                '_ar_cost_range'     => '$80 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Samsung dryer show FE after a power outage?', 'answer' => 'When power is restored after an outage, brief frequency spikes in the incoming supply can trigger FE. Unplug the dryer for 60 seconds, then plug it back in — the error will clear in most cases.' ],
                    [ 'question' => 'Can I run my Samsung dryer on a generator?', 'answer' => 'Samsung does not recommend running appliances on generator power. Generators often produce unstable frequency output, which triggers FE. Use utility power whenever possible.' ],
                    [ 'question' => 'Is FE the same as 9E on Samsung dryers?', 'answer' => 'No — FE is a frequency fault (Hz out of range) while 9E is a voltage fault (voltage too high or too low). Both relate to power supply quality but detect different electrical parameters.' ],
                ],
            ],
        ],

        // ── EE (Dryer) ───────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer EE Error Code',
            'slug'       => 'samsung-dryer-ee-error-code',
            'meta_title' => 'Samsung Dryer EE Error Code — EEPROM Memory Fault',
            'meta_desc'  => 'Samsung dryer EE means the control board has detected a memory (EEPROM) fault. Learn what triggers it and when a control board replacement is needed.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => 'EE',
                '_ar_code_meaning'   => "The EE error code on a Samsung dryer indicates an EEPROM (Electrically Erasable Programmable Read-Only Memory) fault on the main control board. The EEPROM chip stores the dryer's operating parameters, cycle settings, and fault history. When the control board detects that it cannot reliably read from or write to this memory chip, it generates EE and prevents operation to avoid unpredictable behaviour.\n\nEE most commonly occurs after a power surge that corrupts the EEPROM data, or as the control board ages and the EEPROM chip begins to fail. A faulty wiring harness between the control board and display board can also cause EE if communication signals are interrupted.",
                '_ar_causes'         => [
                    [ 'title' => 'Power Surge or Voltage Spike',       'description' => 'A voltage spike — such as one caused by a nearby lightning strike, power restoration, or utility switching — can corrupt the data stored on the EEPROM chip. The control board then detects data integrity errors and triggers EE.' ],
                    [ 'title' => 'Aging or Failed EEPROM Chip',        'description' => 'EEPROM chips have a finite number of read/write cycles. In older dryers, the chip degrades and begins to produce read errors, triggering EE. At this stage, control board replacement resolves the fault.' ],
                    [ 'title' => 'Faulty Control Board',               'description' => 'A broader failure of the main control board — beyond just the EEPROM chip — can trigger EE. Burnt components, cracked solder joints, or moisture damage to the board are common contributors.' ],
                    [ 'title' => 'Wiring Harness Fault',               'description' => 'Loose or damaged connector pins on the wiring harness between the main control board and the display/user interface board can disrupt communication and generate a false EE code.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power cycle the dryer',              'description' => 'Unplug the dryer for 5 full minutes to allow any residual charge on the control board to dissipate completely. Plug back in and test. A power-surge-induced EEPROM corruption sometimes clears with a full power reset.' ],
                    [ 'title' => 'Inspect the wiring harness connectors', 'description' => 'Access the main control board (typically behind the top or rear panel depending on model). Inspect all connector plugs on the board for bent pins, corrosion, or loose connections. Reseat each connector firmly.' ],
                    [ 'title' => 'Check for visible board damage',     'description' => 'With the power disconnected, visually inspect the control board for burnt components, scorch marks, or bulging capacitors. Any visible damage confirms board replacement is required.' ],
                ],
                '_ar_when_to_call'   => "EE that persists after a full power cycle and connector inspection requires control board replacement. This involves accessing the internal control board, handling circuit board components, and re-routing wiring — a job best handled by a certified technician.",
                '_ar_cost_range'     => '$150 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'Can a Samsung dryer EE error fix itself?', 'answer' => 'Occasionally — if EE was triggered by a transient power surge, a full 5-minute power cycle may clear the corrupted EEPROM data. However, if the EEPROM chip itself has degraded, the error returns and control board replacement is the only resolution.' ],
                    [ 'question' => 'How much does it cost to replace a Samsung dryer control board?', 'answer' => 'OEM Samsung dryer control boards typically cost $120–$250 for the part. With labour, total repair cost runs $150–$380. On older dryers, compare this against the cost of a new dryer before proceeding.' ],
                    [ 'question' => 'Will EE damage my dryer if I keep using it?', 'answer' => 'Samsung dryers displaying EE will not operate — the control board locks the machine to prevent unpredictable behaviour from corrupted memory data. You cannot accidentally cause further damage by attempting to start the dryer.' ],
                ],
            ],
        ],

        // ── 5E (Dryer) ───────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dryer 5E Error Code',
            'slug'       => 'samsung-dryer-5e-error-code',
            'meta_title' => 'Samsung Dryer 5E Error Code — Drain / Moisture Sensor Fault',
            'meta_desc'  => 'Samsung dryer 5E signals a drain or moisture sensor fault. Learn the common causes on condenser and heat pump models and how to resolve it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dryer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dryer',
                '_ar_error_code'     => '5E',
                '_ar_code_meaning'   => "The 5E error code on a Samsung dryer indicates a drain system fault on condenser and heat pump models, or a moisture sensor communication error on select vented models. On Samsung condenser and heat pump dryers, the machine collects condensed water in a reservoir or drains it via a drain hose. If the drain pump fails to evacuate collected water within the expected time, or the water level sensor reports an overflow condition, 5E is triggered.\n\nOn vented Samsung dryers, 5E can appear when the moisture sensor bar inside the drum has a communication fault with the control board — usually caused by a coating of dryer sheet residue on the sensor bars, which insulates them and prevents accurate moisture readings.",
                '_ar_causes'         => [
                    [ 'title' => 'Full Water Reservoir (Condenser Models)', 'description' => 'On condenser dryers, the condensate tank collects water extracted from laundry. When the tank reaches capacity, the dryer stops with 5E. Empty the tank and restart the cycle.' ],
                    [ 'title' => 'Blocked or Kinked Drain Hose',       'description' => 'If the condenser dryer connects to a drain via a hose, a kinked, blocked, or improperly routed drain hose prevents the drain pump from evacuating water. 5E triggers when the pump runs but water does not drain.' ],
                    [ 'title' => 'Failed Drain Pump',                  'description' => 'The drain pump motor removes collected condensate. A failed pump cannot clear water regardless of tank and hose condition, causing 5E on every cycle.' ],
                    [ 'title' => 'Moisture Sensor Bar Contamination',  'description' => 'On vented models, two metal sensor bars inside the drum detect residual moisture in the load. A buildup of fabric softener or dryer sheet residue coats the bars and prevents accurate readings, triggering a sensor fault.' ],
                    [ 'title' => 'Moisture Sensor Wiring Fault',       'description' => 'Damaged or disconnected wiring between the moisture sensor bars and the control board breaks the sensor circuit and triggers a 5E communication error.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Empty the condensate tank (condenser models)', 'description' => 'Pull out the water reservoir drawer (usually at the top or bottom left of the machine). Empty it completely, rinse it, and reinsert it firmly until it clicks into place. Restart the dryer.' ],
                    [ 'title' => 'Clean the moisture sensor bars',     'description' => 'Open the dryer door and locate the two metal strips inside the drum opening (near the lint filter on most models). Wipe both strips thoroughly with a cloth dampened with white vinegar or rubbing alcohol to remove residue. Dry completely before running a cycle.' ],
                    [ 'title' => 'Check and clear the drain hose',     'description' => 'On condenser models with a drain hose connection, confirm the hose has no kinks, the end sits correctly in the standpipe or utility sink (not submerged), and no blockage is present at the hose end.' ],
                ],
                '_ar_when_to_call'   => "If 5E persists after emptying the reservoir and cleaning the moisture sensor bars, the drain pump (condenser models) or moisture sensor wiring (vented models) requires professional diagnosis and replacement.",
                '_ar_cost_range'     => '$90 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'My Samsung dryer shows 5E but it is a vented model — why?', 'answer' => 'On vented Samsung dryers, 5E typically indicates a moisture sensor fault rather than a drain issue. Clean the two metal sensor bars inside the drum with vinegar — dryer sheet residue coating the bars is the most common cause on vented models.' ],
                    [ 'question' => 'How often should I empty the condensate tank on a Samsung condenser dryer?', 'answer' => 'Approximately every 1–2 loads, depending on load size and fabric type. Heavy cotton loads produce significantly more condensate than synthetics. Many users drain via the hose connection to eliminate emptying the tank manually.' ],
                    [ 'question' => 'Can I prevent 5E on my Samsung condenser dryer?', 'answer' => 'Connect a permanent drain hose to the drain port at the back of the machine and route it to a floor drain, utility sink, or standpipe. This eliminates the reservoir-full cause of 5E entirely.' ],
                ],
            ],
        ],

    ]; // end ar_error_codes_samsung_dryer()
}

// ─────────────────────────────────────────────────────────────────────────────
// REFRIGERATOR ERROR CODES
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_samsung_refrigerator(): array {
    return [

        // ── 22E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 22E Error Code',
            'slug'       => 'samsung-refrigerator-22e-error-code',
            'meta_title' => 'Samsung Refrigerator 22E Error Code — Freezer Fan Fault',
            'meta_desc'  => 'Samsung fridge 22E means the freezer fan motor has failed. Learn what it affects, how urgent the repair is, and typical repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '22E',
                '_ar_code_meaning'   => "The 22E error code on a Samsung refrigerator (also displayed as 22C on some models) indicates a fault with the freezer evaporator fan motor. The freezer evaporator fan circulates cold air from the evaporator coil throughout the freezer compartment — and in many Samsung models, also into the fresh food compartment via an air duct. When the fan motor fails or the fan blade is obstructed, 22E is displayed.\n\nWith a failed freezer fan, the freezer will begin to warm within hours, and the fresh food compartment will also lose cooling in most Samsung designs. This is an urgent repair — food safety is at risk within 4 hours of the fan stopping.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Evaporator Fan Motor',    'description' => 'The DC fan motor in the freezer evaporator compartment has burned out. Motor bearings can seize after years of service, or the motor windings can fail. This is the most common cause of 22E.' ],
                    [ 'title' => 'Ice-Locked Fan Blade',           'description' => 'Ice buildup from a defrost system failure can surround and lock the fan blade, preventing rotation. The motor\'s thermal protection trips and 22E is logged.' ],
                    [ 'title' => 'Fan Blade Obstruction',          'description' => 'A food package or debris that has worked its way into the evaporator compartment can lodge against the fan blade, physically preventing rotation.' ],
                    [ 'title' => 'Wiring Harness Fault',           'description' => 'The wire harness from the fan motor to the main board can develop an open circuit due to vibration fatigue or a connector corroding with moisture.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power off and manually defrost', 'description' => 'Unplug the refrigerator and remove all food from the freezer. Leave the freezer door open for 24-48 hours to allow all ice to melt naturally. This clears ice-locked fan scenarios.' ],
                    [ 'title' => 'Check for obstructions',         'description' => 'After defrosting, open the evaporator cover panel at the back of the freezer (usually 2-4 screws). Inspect the fan blade area for any food packaging or debris. Clear any obstruction and spin the blade by hand — it should rotate freely.' ],
                    [ 'title' => 'Power on and listen',            'description' => 'Restore power and listen for the fan motor. Use a piece of tape over the door switch to keep the fans running with the door open. You should hear a consistent airflow hum from the evaporator area.' ],
                ],
                '_ar_when_to_call'   => "If after defrosting and clearing obstructions the fan does not run, the motor has failed and must be replaced. Evaporator fan replacement requires removing the evaporator panel and disconnecting the motor from the wiring harness — a 60-90 minute repair. Transfer your food to coolers immediately to prevent loss.",
                '_ar_cost_range'     => '$110 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'How fast will my food spoil with Samsung 22E?', 'answer' => 'USDA guidelines state refrigerator food is safe for approximately 4 hours with doors kept closed. Freezer food with a full load remains safe for 24-48 hours. Keep doors closed and use a thermometer to monitor temperature while awaiting repair.' ],
                    [ 'question' => 'Can Samsung 22E be caused by a defrost problem?', 'answer' => 'Yes — if the defrost system has failed and ice has accumulated on the evaporator coil over weeks, that ice can grow to lock the fan blade, triggering 22E. In this case, both the defrost fault and the iced-over fan need to be addressed.' ],
                    [ 'question' => 'Is Samsung 22E covered under warranty?', 'answer' => 'If your refrigerator is still within Samsung\'s manufacturer warranty period, contact Samsung directly for covered repairs. For out-of-warranty units, our repair service backs every fix with a 30-day parts and labor warranty — if the same fault returns within 30 days, we come back at no charge.' ],
                ],
            ],
        ],

        // ── 8E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 8E Error Code',
            'slug'       => 'samsung-refrigerator-8e-error-code',
            'meta_title' => 'Samsung Refrigerator 8E Error Code — Ice Maker Sensor Fault',
            'meta_desc'  => 'Samsung refrigerator 8E means the ice maker sensor has failed. Learn what causes it and what to do about it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '8E',
                '_ar_code_meaning'   => "The 8E error code on a Samsung refrigerator indicates a fault with the ice maker sensor — specifically the ice maker compartment thermistor that monitors the temperature of the ice making tray. When this sensor reads an out-of-range value or fails completely, the control board cannot accurately control the ice-making cycle and logs 8E.\n\n8E is closely associated with Samsung's known ice maker issues. On many Samsung French door and 4-door models, the ice maker compartment is prone to temperature fluctuations caused by the evaporator fan freezing over — which can also cause thermistor readings to appear abnormal.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Ice Maker Thermistor',    'description' => 'The temperature sensor mounted in or near the ice maker tray has failed. Out-of-range resistance readings trigger 8E.' ],
                    [ 'title' => 'Ice Maker Evaporator Iced Over', 'description' => 'The well-known Samsung ice maker freeze-over issue causes the ice maker compartment temperature to become erratic, which can register as a sensor fault even when the thermistor itself is functioning.' ],
                    [ 'title' => 'Damaged Ice Maker Wiring',       'description' => 'The wiring harness from the ice maker module to the main control board can develop faults, causing the sensor signal to appear invalid.' ],
                    [ 'title' => 'Ice Maker Module Failure',       'description' => 'The ice maker assembly itself (including its integrated sensor) has failed as a unit.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Defrost the ice maker compartment', 'description' => 'Use a hair dryer on low heat (keeping it away from water) or a warm damp cloth to defrost the ice maker evaporator area behind the ice maker bin. Allow the compartment to warm to above freezing before restoring power.' ],
                    [ 'title' => 'Reset the ice maker',            'description' => 'Press and hold the Test button on the ice maker module (typically a recessed button on the side or underside of the ice maker assembly) for 10 seconds. This initiates a full reset of the ice maker cycle.' ],
                    [ 'title' => 'Check the Samsung Ice Master fix', 'description' => 'Samsung has released service bulletins and updated ice maker kits for specific models with chronic 8E and ice maker issues. Contact Samsung support or a certified technician to determine whether your model qualifies for the updated kit.' ],
                ],
                '_ar_when_to_call'   => "If 8E persists after defrosting and resetting the ice maker, the thermistor or ice maker assembly needs replacement. A certified technician can also determine whether your model has a Samsung service campaign that covers updated ice maker components.",
                '_ar_cost_range'     => '$150 – $310',
                '_ar_faqs'           => [
                    [ 'question' => 'Will my Samsung refrigerator still cool with an 8E error?', 'answer' => 'Yes — 8E is specific to the ice maker system. The main refrigerator and freezer compartments continue to cool normally while 8E is displayed. However, ice making will be suspended.' ],
                    [ 'question' => 'Why do Samsung refrigerators get so many ice maker errors?', 'answer' => 'Samsung has acknowledged ice maker performance issues on several French door and 4-door model generations, particularly those manufactured between 2017 and 2021. The root cause involves the ice maker evaporator fan icing over, which disrupts both ice production and temperature sensing. Samsung issued updated ice maker kits and extended warranties on some affected models.' ],
                    [ 'question' => 'Is Samsung 8E covered under warranty?', 'answer' => 'Some Samsung models with documented ice maker issues have extended or enhanced warranty coverage. Check with Samsung directly using your model and serial number to determine whether your refrigerator qualifies for enhanced ice maker warranty service.' ],
                ],
            ],
        ],

        // ── 14E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 14E Error Code',
            'slug'       => 'samsung-refrigerator-14e-error-code',
            'meta_title' => 'Samsung Refrigerator 14E Error Code — Ice Maker Fan Fault',
            'meta_desc'  => 'Samsung refrigerator 14E means the ice maker fan motor has a fault. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '14E',
                '_ar_code_meaning'   => "The 14E error code on a Samsung refrigerator indicates a fault with the ice maker fan motor — the dedicated fan that circulates cold air within the ice maker compartment on Samsung models that use a separate ice maker evaporator system. This fan is separate from the main freezer evaporator fan (22E).\n\n14E is one of Samsung's most reported refrigerator error codes, particularly on French door models with the upper ice maker. It is closely related to the widely documented Samsung ice maker freeze-over problem, where ice accumulates around the ice maker fan blade and locks it.",
                '_ar_causes'         => [
                    [ 'title' => 'Ice-Locked Ice Maker Fan Blade', 'description' => 'Ice accumulates around the ice maker fan motor and blade over time, eventually locking the blade. This is the most common cause of 14E and is linked to Samsung\'s known ice maker design issue.' ],
                    [ 'title' => 'Failed Ice Maker Fan Motor',     'description' => 'The fan motor has burned out independently of ice buildup. Less common than ice lockage but requires motor replacement.' ],
                    [ 'title' => 'Wiring Harness to Ice Maker Fan', 'description' => 'The wiring harness between the ice maker fan motor and the main board has developed an open circuit or intermittent fault.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Defrost the ice maker area',     'description' => 'Remove the ice bin and access the ice maker assembly. Use a hair dryer on low heat or warm towels to defrost the area around the fan motor and blade. Clear all visible ice before restoring power.' ],
                    [ 'title' => 'Reset the refrigerator',         'description' => 'After defrosting, unplug the refrigerator for 5 minutes, then restore power. Check whether 14E clears on the display. If it does, run for 24 hours to confirm it does not return.' ],
                    [ 'title' => 'Check Samsung service campaigns', 'description' => 'Many Samsung French door refrigerator models with chronic 14E have manufacturer service campaigns. Provide your model and serial number to Samsung support or a Samsung-authorized service center.' ],
                ],
                '_ar_when_to_call'   => "If 14E returns after defrosting, the ice maker fan motor needs replacement. This repair also typically includes installing an updated ice maker heater kit (on affected models) to prevent recurrence of ice lockage.",
                '_ar_cost_range'     => '$160 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'My Samsung fridge shows 14E and makes a humming or buzzing sound — are these related?', 'answer' => 'Yes — the buzzing sound is the ice maker fan motor trying to spin against ice buildup. The motor hums but cannot rotate. This is the most common presentation of 14E on Samsung French door refrigerators.' ],
                    [ 'question' => 'How do I stop my Samsung refrigerator 14E from coming back?', 'answer' => 'The ice maker area needs to be fully defrosted and, on affected models, a Samsung-approved ice maker heater kit installed to prevent ice accumulation around the fan. Without addressing the root cause, 14E will return every few months.' ],
                    [ 'question' => 'Does 14E affect the main freezer temperature?', 'answer' => 'On models with a separate ice maker compartment, 14E is primarily isolated to ice production. On models where the ice maker fan also contributes to freezer airflow, you may notice the freezer running slightly warmer than normal.' ],
                ],
            ],
        ],

        // ── PC ER / PC Er ─────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator PC ER Error Code',
            'slug'       => 'samsung-refrigerator-pc-er-error-code',
            'meta_title' => 'Samsung Refrigerator PC ER / PC Er Error Code — Communication Fault',
            'meta_desc'  => 'Samsung refrigerator PC ER means the main control board and the display board are not communicating. Learn what causes it and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => 'PC ER',
                '_ar_code_meaning'   => "The PC ER (or PC Er) error code on a Samsung refrigerator indicates a communication failure between the main control board and the display/user interface board. The two boards communicate via a wire harness, and PC ER is logged when this communication link fails or is interrupted.\n\nPC ER is one of the more alarming Samsung refrigerator codes because the display may show erratic behavior, freeze, or go blank. In many cases, however, PC ER resolves with a reset and is caused by a transient power fluctuation rather than a hardware failure.",
                '_ar_causes'         => [
                    [ 'title' => 'Loose or Disconnected Communication Harness', 'description' => 'The ribbon cable or wire harness connecting the display board to the main control board has worked loose from a connector. This is the most common cause of PC ER.' ],
                    [ 'title' => 'Power Surge or Fluctuation',     'description' => 'A power surge, brownout, or brief outage can corrupt communication between the two boards. A reset typically clears this.' ],
                    [ 'title' => 'Failed Display Board',           'description' => 'The user interface / display board has failed and is no longer responding to communication signals from the main board.' ],
                    [ 'title' => 'Failed Main Control Board',      'description' => 'The main control board\'s communication circuit has failed. Less common than display board failure, but possible after power surge damage.' ],
                    [ 'title' => 'Damaged Communication Harness',  'description' => 'The wire harness between the two boards has a broken conductor or damaged connector pins.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Perform a power reset',          'description' => 'Unplug the refrigerator for 5 minutes, then restore power. If PC ER was caused by a transient communication glitch or power event, it will not return after a reset.' ],
                    [ 'title' => 'Check the communication harness connections', 'description' => 'Unplug the refrigerator. Access the control board area (typically behind the rear panel inside the upper compartment or in a dedicated panel). Locate the ribbon cable or wire harness between the display board and main board. Firmly press each connector to ensure full engagement.' ],
                    [ 'title' => 'Inspect for visible damage',     'description' => 'Look for any visible signs of damage to the harness — pinched sections, burned areas, or damaged connector pins. A damaged harness requires replacement.' ],
                ],
                '_ar_when_to_call'   => "If PC ER returns after reset and all connectors are firmly seated, either the display board or main control board has failed. A technician can use Samsung diagnostic mode to determine which board is at fault before recommending replacement, avoiding the cost of replacing the wrong board.",
                '_ar_cost_range'     => '$150 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'Will my Samsung refrigerator stop cooling with PC ER?', 'answer' => 'The main cooling system (compressor, fans) may continue to operate normally during a PC ER event, but without display board communication, the control settings and temperature displays may be unreliable. Monitor actual temperatures with a thermometer if you need to keep using the refrigerator while awaiting repair.' ],
                    [ 'question' => 'Can a power outage cause Samsung PC ER?', 'answer' => 'Yes — power restoration after an outage can cause a communication timing error between the two boards, logging PC ER. A reset (unplug for 5 minutes) typically clears this if no hardware damage occurred during the outage.' ],
                    [ 'question' => 'Is PC ER expensive to repair on a Samsung refrigerator?', 'answer' => 'If a reset clears PC ER, cost is zero. If the display board or main board has failed, display board replacement is generally less expensive ($150–$250 range). Main board replacement is more costly ($250–$380 range). A technician can confirm which board is at fault before parts are ordered.' ],
                ],
            ],
        ],

        // ── 33E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 33E Error Code',
            'slug'       => 'samsung-refrigerator-33e-error-code',
            'meta_title' => 'Samsung Refrigerator 33E Error Code — Fridge Fan Motor Fault',
            'meta_desc'  => 'Samsung refrigerator 33E means the fresh food (fridge) compartment fan motor has failed. Learn how urgent the repair is and what to expect.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '33E',
                '_ar_code_meaning'   => "The 33E error code on a Samsung refrigerator indicates a fault with the fresh food compartment fan motor — the fan that circulates cold air specifically within the refrigerator section. On Samsung models that use a separate evaporator fan for the fridge compartment, this fan is critical for maintaining even temperatures across all shelves.\n\nWith 33E, the fresh food compartment loses its circulated airflow. Food near the back of the fridge (closest to the air inlet) may stay cold, while items toward the front and sides warm up. This is an urgent repair as the fresh food compartment temperature will rise above safe levels within a few hours.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Fridge Fan Motor',        'description' => 'The DC fan motor serving the fresh food compartment has burned out. Motor bearing failure or winding failure are the typical failure modes.' ],
                    [ 'title' => 'Ice Buildup on Fan',             'description' => 'A defrost system problem can allow ice to build up on or around the fridge compartment fan, locking the blade.' ],
                    [ 'title' => 'Wiring Fault',                   'description' => 'The wire harness from the fan motor to the main board has developed an open circuit.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Listen for the fan',             'description' => 'With the refrigerator door open, tape over the door switch to allow the fan to run. Listen for airflow sounds from the vent panel at the back of the fresh food compartment. Silence confirms the fan is not running.' ],
                    [ 'title' => 'Defrost the compartment if iced over', 'description' => 'If the back panel inside the fridge section is covered in ice, a defrost system failure is the root cause. Unplug and allow full defrost before assessing the fan.' ],
                ],
                '_ar_when_to_call'   => "Fridge compartment fan motor replacement requires removing the internal back panel of the fresh food compartment (typically 4-6 screws). The repair is accessible but requires care with the wiring harness and fan shroud. Transfer perishable food immediately if 33E is confirmed.",
                '_ar_cost_range'     => '$120 – $270',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung 22E and 33E?', 'answer' => '22E refers to the freezer compartment evaporator fan failure, while 33E refers to the fresh food (refrigerator) compartment fan failure. Some Samsung models share one fan for both compartments (in which case 22E covers both), but dual-evaporator models have a dedicated fan for each section.' ],
                    [ 'question' => 'Is 33E covered by Samsung warranty?', 'answer' => 'If your refrigerator is still within Samsung\'s manufacturer warranty period, the fresh food fan motor may be covered — contact Samsung support with your model and serial number to verify. For out-of-warranty repairs, our service includes a 30-day parts and labor warranty on all work performed. Sealed system components carry a separate 5-year Samsung parts warranty.' ],
                    [ 'question' => 'Can I use my Samsung refrigerator while waiting for 33E repair?', 'answer' => 'For short periods (up to a few hours), the freezer compartment may keep the overall cabinet cool enough to maintain safe refrigerator temperatures if you keep the door closed. Use a refrigerator thermometer to verify the fresh food compartment stays at or below 40°F. If it exceeds this, transfer perishables immediately.' ],
                ],
            ],
        ],

        // ── OF OF / O FF ──────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator OF OF Error Code',
            'slug'       => 'samsung-refrigerator-of-of-error-code',
            'meta_title' => 'Samsung Refrigerator OF OF / O FF Error Code — Demo Mode Active',
            'meta_desc'  => 'Samsung refrigerator OF OF or O FF means the appliance is in demo (showroom) mode and is not cooling. Learn how to exit demo mode in under 60 seconds.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => 'OF OF',
                '_ar_code_meaning'   => "The OF OF (or O FF) display on a Samsung refrigerator is not an error code — it indicates that the refrigerator is in Demo Mode (also called Showroom Mode or Shop Mode). In this mode, the compressor and cooling system are completely disabled. The lights and display work, but the refrigerator is not cooling.\n\nDemo mode is most commonly activated accidentally by pressing and holding certain button combinations on the display panel. It can also be activated by children playing with the panel controls. Despite being alarming, this is not a malfunction and does not require a service call — it simply requires the correct button combination to exit.",
                '_ar_causes'         => [
                    [ 'title' => 'Accidental Demo Mode Activation', 'description' => 'The most common cause. Certain button combinations (which vary by model) accidentally activate showroom mode during normal interaction with the panel.' ],
                    [ 'title' => 'Power Cycle During Factory Reset', 'description' => 'In some cases, a power cycle or reset can leave the refrigerator in demo mode if it was in that state before the outage.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Exit demo mode — Family Hub models', 'description' => 'On Family Hub models: open the Family Hub app, go to the Fridge Manager, select Fridge Settings, and toggle Demo Mode off. Alternatively, press and hold the top-left and top-right icons on the door panel simultaneously for 3 seconds.' ],
                    [ 'title' => 'Exit demo mode — standard display models', 'description' => 'On most non-Family Hub Samsung refrigerators: press and hold the Energy Saver button and the Freezer Temperature button simultaneously for 8 seconds. The display should beep and OF OF should clear.' ],
                    [ 'title' => 'Alternative method',               'description' => 'Some Samsung models exit demo mode by pressing and holding the Power Freeze and Power Cool buttons simultaneously for 8–10 seconds. If the first method does not work, try this combination.' ],
                ],
                '_ar_when_to_call'   => "OF OF / O FF does not require a technician call. If none of the button combinations above exit demo mode, consult your model's specific owner manual (available on Samsung's website using your model number) for the correct button sequence. If the correct sequence is entered but OF OF persists, a control board reset or board fault may be present.",
                '_ar_cost_range'     => '$0 – $80',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung refrigerator not cold but all the lights work?', 'answer' => 'This is the signature symptom of demo mode — everything works except the cooling system. Check the display for OF OF or O FF. If present, follow the demo mode exit procedure above.' ],
                    [ 'question' => 'Did OF OF damage my food?', 'answer' => 'If demo mode was active for more than 4 hours, food safety may be compromised. Check temperatures carefully — perishables (dairy, meat, leftovers) should be discarded if the internal temperature exceeded 40°F for more than 2 hours.' ],
                    [ 'question' => 'How do I prevent my Samsung refrigerator from accidentally entering demo mode?', 'answer' => 'The control lock / child lock function on Samsung refrigerators disables the panel buttons. Activate it when not adjusting settings (typically by pressing and holding the control lock button for 3 seconds). This prevents accidental mode changes.' ],
                ],
            ],
        ],

        // ── 1E / 1C ───────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 1E Error Code',
            'slug'       => 'samsung-refrigerator-1e-error-code',
            'meta_title' => 'Samsung Refrigerator 1E Error Code — Freezer Sensor Fault',
            'meta_desc'  => 'Samsung refrigerator 1E means the freezer temperature sensor has failed. Learn the causes and whether it is a DIY fix.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '1E',
                '_ar_code_meaning'   => "The 1E error code on a Samsung refrigerator indicates a fault with the freezer compartment temperature sensor (also called the freezer thermistor). The main control board monitors the sensor resistance to track freezer temperature. When the resistance is out of the expected range — indicating a broken sensor, disconnected harness, or short circuit — 1E is displayed.\n\nWithout a working freezer sensor, the control board cannot regulate compressor cycling for the freezer compartment, which may result in the freezer running too cold or not cold enough.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Freezer Thermistor',        'description' => 'The sensor element itself has broken internally, reading an open circuit or incorrect resistance value.' ],
                    [ 'title' => 'Disconnected Sensor Harness',      'description' => 'The connector linking the freezer thermistor to the main board has vibrated loose or corroded.' ],
                    [ 'title' => 'Ice or Frost Damage',              'description' => 'Ice buildup around the sensor location can crack the sensor body or damage the connector over time.' ],
                    [ 'title' => 'Main Control Board Fault',         'description' => 'The thermistor reading circuit on the main PCB has failed, displaying 1E even with a healthy sensor.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                      'description' => 'Unplug the refrigerator for 5 minutes and reconnect. A transient read error may clear on reboot.' ],
                    [ 'title' => 'Check for frost buildup',          'description' => 'If frost has accumulated heavily in the freezer, run a manual defrost by unplugging for 24–48 hours with the freezer door open. Frost accumulation around the sensor can cause false 1E readings.' ],
                ],
                '_ar_when_to_call'   => "If 1E persists, a technician will access the freezer sensor (typically behind the freezer back panel), test it with a multimeter, and replace the thermistor or harness as needed.",
                '_ar_cost_range'     => '$90 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Will Samsung refrigerator 1E cause food to spoil?', 'answer' => 'Potentially — if the board cannot regulate freezer temperature, the compressor may run continuously (over-freezing) or not enough (thawing). Monitor freezer temperature with a thermometer and relocate frozen food if the temperature rises above 0°F.' ],
                    [ 'question' => 'Is Samsung refrigerator 1E the same as 1C?', 'answer' => 'Yes — 1E and 1C are the same freezer sensor fault displayed on different model generations. Diagnosis and repair are identical.' ],
                ],
            ],
        ],

        // ── 39E / 40E ─────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 39E Error Code',
            'slug'       => 'samsung-refrigerator-39e-error-code',
            'meta_title' => 'Samsung Refrigerator 39E Error Code — Ice Maker Sensor Fault',
            'meta_desc'  => 'Samsung refrigerator 39E means the ice maker temperature sensor has failed. Learn how it affects ice production and what to do.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '39E',
                '_ar_code_meaning'   => "The 39E error code on a Samsung refrigerator indicates a fault with the ice maker temperature sensor. Samsung refrigerators monitor the ice maker tray temperature to determine when the ice is frozen solid enough to harvest. When the sensor fails, the ice maker cannot confirm freeze status and stops producing ice.\n\n39E is one of the more common Samsung ice maker error codes. It frequently appears on French Door and Family Hub models that use a dedicated in-door ice maker.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Ice Maker Thermistor',      'description' => 'The small thermistor inside the ice maker assembly has broken, reading out of range.' ],
                    [ 'title' => 'Frost Buildup Around Ice Maker',   'description' => 'Heavy frost around the ice maker assembly can damage or short the thermistor leads.' ],
                    [ 'title' => 'Ice Maker Assembly Failure',       'description' => 'On some Samsung models the thermistor is not sold separately and requires full ice maker assembly replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Force defrost the ice maker',      'description' => 'On most Samsung models, pressing Freezer + Lighting buttons simultaneously for 8 seconds enters forced defrost mode. Cycle through to the ice maker defrost option. This clears frost that may be affecting the sensor.' ],
                    [ 'title' => 'Power reset',                      'description' => 'Unplug for 5 minutes and restore power. If the ice maker had a transient sensor read error, it may clear on restart.' ],
                ],
                '_ar_when_to_call'   => "If 39E persists after a defrost cycle and power reset, the ice maker thermistor or full ice maker assembly requires replacement. Samsung ice maker replacement is a moderate repair.",
                '_ar_cost_range'     => '$100 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'Does Samsung refrigerator 39E mean the ice maker is broken?', 'answer' => 'Not necessarily — it means the ice maker sensor has failed. The ice maker mechanism itself may be fine. Replacing the thermistor (or assembly) typically restores full ice production.' ],
                    [ 'question' => 'How long does it take to make ice after fixing Samsung 39E?', 'answer' => 'After resolving 39E and resetting the ice maker, allow 24 hours for the first full ice tray production cycle.' ],
                ],
            ],
        ],

        // ── 88 ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 88 Error Code',
            'slug'       => 'samsung-refrigerator-88-error-code',
            'meta_title' => 'Samsung Refrigerator 88 Error Code — Display or Control Board Reset',
            'meta_desc'  => 'Samsung refrigerator 88 88 on the display usually indicates a control board reset or communication issue — not a serious fault. Learn what to do.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '88',
                '_ar_code_meaning'   => "The 88 88 display on a Samsung refrigerator — all segments showing — typically indicates the display board is in a reset or initialization state, or that communication between the display board and the main control board has been interrupted. It is not a traditional fault code but rather a diagnostic state that can persist after a power interruption or board reset.\n\nIn some cases 88 appears briefly during startup and clears on its own. When it persists, it signals a display board or control board communication problem.",
                '_ar_causes'         => [
                    [ 'title' => 'Power Interruption During Operation', 'description' => 'A power outage or sudden voltage drop while the refrigerator was running can cause the display board to enter an uninitialized state showing 88 88.' ],
                    [ 'title' => 'Display Board Fault',               'description' => 'The display board itself has failed, showing all segments as it cannot receive valid data from the main board.' ],
                    [ 'title' => 'Main Control Board Communication Error', 'description' => 'The main board is not sending valid display data, which the display renders as all-segments-on (88 88).' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                      'description' => 'Unplug the refrigerator for 5 minutes. This is the most effective fix for 88 caused by power interruption. After reconnecting, the display should initialize normally.' ],
                    [ 'title' => 'Check the display board connector', 'description' => 'If 88 persists, access the display board (usually behind the control panel on the fresh food door) and firmly reseat the ribbon cable or connector.' ],
                ],
                '_ar_when_to_call'   => "If 88 does not clear after a power reset, one of the boards requires replacement. A technician can determine via diagnostic mode whether the display board or main board is at fault.",
                '_ar_cost_range'     => '$80 – $300',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung refrigerator 88 serious?', 'answer' => 'Not usually — 88 most commonly appears after a power outage and clears with a power reset. If it persists, it becomes a board fault that requires service.' ],
                    [ 'question' => 'Is my food safe when 88 is showing?', 'answer' => 'If the compressor is still running (you can hear it and feel cold air inside), food is safe. The 88 display may just be a display board issue with the cooling system operating normally.' ],
                ],
            ],
        ],

        // ── 5E / 5C ───────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 5E Error Code',
            'slug'       => 'samsung-refrigerator-5e-error-code',
            'meta_title' => 'Samsung Refrigerator 5E Error Code — Defrost Sensor Fault',
            'meta_desc'  => 'Samsung refrigerator 5E means the defrost sensor has failed. Learn how it affects cooling and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '5E',
                '_ar_code_meaning'   => "The 5E error code on a Samsung refrigerator indicates a defrost sensor fault. The defrost sensor monitors evaporator temperature during the defrost cycle to ensure frost is cleared without overheating the evaporator coils. When this sensor fails, the control board cannot safely manage the defrost cycle.\n\nWithout defrost cycle control, frost builds up on the evaporator over time, eventually blocking airflow completely and causing the refrigerator or freezer to stop cooling effectively.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Defrost Sensor/Fuse',       'description' => 'The defrost temperature sensor or its associated thermal fuse has failed, sending an out-of-range resistance reading to the control board.' ],
                    [ 'title' => 'Ice Buildup on Sensor',            'description' => 'Heavy frost accumulation has encased the defrost sensor, altering its resistance and triggering 5E.' ],
                    [ 'title' => 'Wiring Harness Damage',            'description' => 'The sensor wiring behind the freezer back panel has been damaged by ice expansion or a sharp object during defrosting.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Manual defrost',                   'description' => 'Unplug the refrigerator and leave both doors open for 24–48 hours to allow complete defrost. Thick frost accumulation can interfere with sensor readings. After defrost, restore power and check if 5E clears.' ],
                    [ 'title' => 'Power reset after defrost',        'description' => 'After manual defrost, plug in the refrigerator and allow 30 minutes before checking the error display.' ],
                ],
                '_ar_when_to_call'   => "If 5E returns within a week of a manual defrost, the defrost sensor, thermal fuse, or defrost heater assembly requires replacement. Access requires removing the freezer back panel — a moderate repair.",
                '_ar_cost_range'     => '$90 – $240',
                '_ar_faqs'           => [
                    [ 'question' => 'Will Samsung refrigerator 5E cause ice to melt?', 'answer' => 'Over time, yes — if the defrost cycle stops running, frost buildup eventually blocks the evaporator fan, causing both sections to warm. Address 5E promptly to prevent food loss.' ],
                    [ 'question' => 'Is Samsung refrigerator 5E the same as 5C?', 'answer' => 'Yes — 5E (older models) and 5C (newer models) represent the same defrost sensor fault. Repair approach is identical.' ],
                ],
            ],
        ],

        // ── 40E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 40E Error Code',
            'slug'       => 'samsung-refrigerator-40e-error-code',
            'meta_title' => 'Samsung Refrigerator 40E Error Code — Ice Maker Room Sensor Fault',
            'meta_desc'  => 'Samsung refrigerator 40E means the ice maker temperature sensor has failed. Learn what it affects and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '40E',
                '_ar_code_meaning'   => "The 40E error code on a Samsung refrigerator indicates a fault with the ice maker room temperature sensor. This sensor monitors the temperature inside the ice maker compartment to control ice production timing. When 40E is active, ice production becomes unreliable or stops entirely. The code commonly appears alongside freeze-up issues in Samsung French door models.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Ice Maker Sensor',          'description' => 'The thermistor in the ice maker compartment has failed, sending an out-of-range reading to the control board.' ],
                    [ 'title' => 'Ice Encasing the Sensor',          'description' => 'Frost buildup has encased the sensor probe, altering its resistance and triggering 40E.' ],
                    [ 'title' => 'Wiring Harness Damage',            'description' => 'The sensor wiring has been damaged by ice expansion or contact with the ice maker mechanism.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Defrost the ice maker area',       'description' => 'Unplug the refrigerator and leave the ice maker compartment open for 24 hours. Ice encasing the sensor is the most common cause of 40E in Samsung French door models.' ],
                    [ 'title' => 'Power reset after defrost',        'description' => 'Restore power and allow 24 hours for ice production to resume. Check if 40E reappears.' ],
                ],
                '_ar_when_to_call'   => "If 40E returns within a week after manual defrost, the ice maker sensor requires replacement. The repair also requires addressing the root cause of ice buildup — installing an updated ice maker heater kit on affected models.",
                '_ar_cost_range'     => '$90 – $240',
                '_ar_faqs'           => [
                    [ 'question' => 'Will my Samsung refrigerator still cool with 40E?', 'answer' => 'Yes — 40E affects the ice maker sensor only, not the main fresh food or freezer compartments. Cooling should be unaffected, but ice production will stop until the fault is resolved.' ],
                    [ 'question' => 'Is Samsung refrigerator 40E related to the known ice maker defect?', 'answer' => 'Yes — 40E frequently appears on Samsung French door models with the documented ice maker freeze-up defect. Check your model and serial number with Samsung to determine if your unit qualifies for an extended warranty or service campaign.' ],
                ],
            ],
        ],

        // ── 29E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 29E Error Code',
            'slug'       => 'samsung-refrigerator-29e-error-code',
            'meta_title' => 'Samsung Refrigerator 29E Error Code — Condenser Fan Motor Fault',
            'meta_desc'  => 'Samsung refrigerator 29E means the condenser fan motor has failed. Learn how it affects cooling performance and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '29E',
                '_ar_code_meaning'   => "The 29E error code on a Samsung refrigerator indicates a fault with the condenser fan motor. The condenser fan is located at the bottom rear of the refrigerator, adjacent to the compressor and condenser coils. Its job is to draw ambient air across the condenser coils to dissipate the heat extracted from inside the refrigerator. When the condenser fan fails, the condenser temperature rises, the compressor overheats, and the refrigerator's overall cooling capacity drops significantly.\n\n29E is commonly reported on Samsung French door and side-by-side models and is one of the more urgent refrigerator fault codes — a failed condenser fan left unaddressed can cause compressor failure through chronic overheating.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Condenser Fan Motor',          'description' => 'The fan motor\'s bearings have seized or the motor windings have burned out. Motor failure is the most common cause of 29E and is accelerated by dust and lint accumulation on the motor body.' ],
                    [ 'title' => 'Fan Blade Obstruction',               'description' => 'Dust, lint, or a foreign object has jammed the fan blade, stalling the motor. This can also cause the motor to burn out if it runs against the obstruction.' ],
                    [ 'title' => 'Condenser Fan Wiring Fault',          'description' => 'The wire harness from the condenser fan to the main control board has a broken wire or loose connector.' ],
                    [ 'title' => 'Control Board Fan Output Fault',      'description' => 'The fan control circuit on the main PCB has failed, not supplying power to the fan motor. Confirmed after motor and wiring test normal.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the condenser area',            'description' => 'Pull the refrigerator away from the wall. Remove the rear access panel at the bottom. Vacuum out all dust, lint, and debris from around the condenser coils and fan motor area. Blocked condenser fans are often found to have a thick layer of lint that has stalled the blade.' ],
                    [ 'title' => 'Spin the fan blade by hand',          'description' => 'With the power off, locate the condenser fan and try to spin the blade by hand. It should spin freely with minimal resistance. A blade that is stiff, grinding, or immovable indicates the motor bearings have failed.' ],
                    [ 'title' => 'Listen for fan operation',            'description' => 'With the refrigerator running, carefully listen near the bottom rear for the condenser fan. You should hear a steady, consistent hum. No sound from this location when the compressor is running confirms the fan is not operating.' ],
                ],
                '_ar_when_to_call'   => "Condenser fan replacement is accessible from the back of the refrigerator and is one of the more straightforward refrigerator repairs. A technician can complete the replacement in under an hour. Do not delay — a refrigerator running without the condenser fan will cause compressor overheating and potential compressor failure, which is a much more expensive repair.",
                '_ar_cost_range'     => '$110 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'Will my Samsung refrigerator still cool with 29E?', 'answer' => 'Partially — the refrigerator may maintain temperature for a time after the condenser fan fails, but cooling efficiency drops significantly. As the compressor overheats, it will begin cycling off on thermal protection more frequently, reducing cooling. Food safety is at risk within hours. Repair promptly.' ],
                    [ 'question' => 'How often should I clean my Samsung refrigerator condenser?', 'answer' => 'Samsung recommends cleaning the condenser coils and fan area every 12 months. In homes with pets that shed, every 6 months is advisable. Lint and pet hair accumulation around the condenser fan are the leading cause of 29E and early compressor failure.' ],
                    [ 'question' => 'Can a dirty condenser cause 29E on a Samsung refrigerator?', 'answer' => 'Yes — heavy dust buildup can clog the gap around the fan blade, increasing the load on the fan motor to the point where it overheats and seizes. The 29E fault then appears when the blocked/seized fan is detected by the control board. Cleaning the condenser area regularly prevents this.' ],
                ],
            ],
        ],

        // ── 25E ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 25E Error Code',
            'slug'       => 'samsung-refrigerator-25e-error-code',
            'meta_title' => 'Samsung Refrigerator 25E Error Code — Ice Maker Motor Fault',
            'meta_desc'  => 'Samsung refrigerator 25E means the ice ejector motor has failed. Learn what stops ice production and what the repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '25E',
                '_ar_code_meaning'   => "The 25E error code on a Samsung refrigerator indicates a fault with the ice maker ejector motor or drive mechanism. After the ice mold is frozen, a small motor rotates ejector blades to push the cubes out. When this motor fails to complete its ejection cycle within the expected time, 25E is triggered and ice production stops.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Ice Ejector Motor',         'description' => 'The small motor that drives the ice ejector blades has burned out or seized.' ],
                    [ 'title' => 'Ice Jam in the Mold',              'description' => 'An oversized ice formation or clump is jamming the ejector blades, stalling the motor.' ],
                    [ 'title' => 'Frozen Ice Maker Mechanism',       'description' => 'Ice buildup around the ejector prevents the motor from turning.' ],
                    [ 'title' => 'Failed Ice Maker Control Board',   'description' => 'The small PCB on the ice maker module has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Defrost the ice maker',            'description' => 'Turn off the ice maker and allow the compartment to defrost. An ice jam or frozen mechanism is the most common cause of 25E.' ],
                    [ 'title' => 'Reset the ice maker',              'description' => 'After defrost, locate the Test button on the ice maker module and press for 10 seconds to run a test cycle.' ],
                ],
                '_ar_when_to_call'   => "If 25E returns after defrost and reset, the ice maker ejector motor or the ice maker module requires replacement.",
                '_ar_cost_range'     => '$90 – $230',
                '_ar_faqs'           => [
                    [ 'question' => 'Will replacing the ice maker fix Samsung 25E?', 'answer' => 'Replacing the full ice maker module (which includes the ejector motor) is the most reliable fix for persistent 25E. Samsung sells complete ice maker assembly replacements for all French door and side-by-side models.' ],
                ],
            ],
        ],


        // ── 21E ──────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 21E Error Code',
            'slug'       => 'samsung-refrigerator-21e-error-code',
            'meta_title' => 'Samsung Refrigerator 21E Error Code — Freezer Fan Motor Fault',
            'meta_desc'  => 'Samsung refrigerator 21E means the freezer evaporator fan motor has failed or is blocked by ice. Learn the causes, DIY fixes, and repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '21E',
                '_ar_code_meaning'   => "The 21E error code on a Samsung refrigerator indicates a fault with the freezer evaporator fan motor. The freezer evaporator fan circulates cold air produced by the evaporator coils throughout the freezer and fresh food compartments. When the fan motor fails, stalls, or is blocked by ice buildup, 21E is triggered and cooling throughout the refrigerator is reduced or lost.\n\n21E is one of the most frequently reported Samsung refrigerator error codes in the USA. On French door and side-by-side models, ice accumulation around the evaporator fan is the leading cause — often linked to a slow defrost system failure.",
                '_ar_causes'         => [
                    [ 'title' => 'Ice Buildup Blocking the Fan Blade', 'description' => 'Ice accumulates around the evaporator fan due to a failing defrost heater, defrost thermostat, or defrost control. The fan blade contacts the ice and stalls, triggering 21E. This is the most common cause.' ],
                    [ 'title' => 'Failed Fan Motor',                   'description' => 'The fan motor windings have burned out or the bearings have seized, preventing the blade from turning.' ],
                    [ 'title' => 'Wiring or Connector Fault',          'description' => 'The wiring harness to the fan motor has a break or the connector has corroded.' ],
                    [ 'title' => 'Control Board Fan Circuit Fault',    'description' => 'The control board is not supplying voltage to the fan motor even though the motor is functional.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Force defrost to clear ice buildup', 'description' => 'Enter forced defrost mode: press and hold the Energy Saver + Power Freeze buttons simultaneously for 8 seconds (varies by model). Select Fd (forced defrost) and allow the cycle to complete. This melts ice around the fan and often clears 21E if ice blockage was the cause.' ],
                    [ 'title' => 'Check fan blade rotation',           'description' => 'After defrosting, open the freezer and remove the rear panel to access the evaporator fan. Manually spin the blade — it should rotate freely. If stiff or seized, the motor requires replacement.' ],
                    [ 'title' => 'Listen for the fan at startup',      'description' => 'Close all doors and listen — you should hear the evaporator fan running within 1–2 minutes. Silence indicates the fan motor is not running.' ],
                ],
                '_ar_when_to_call'   => "If 21E returns after forced defrost, the evaporator fan motor requires replacement. This involves removing the freezer interior panel and is a moderate repair. If the fan is new but 21E persists, the defrost system needs to be inspected to prevent recurrent ice buildup.",
                '_ar_cost_range'     => '$120 – $290',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Samsung refrigerator warm if the 21E error is about the freezer fan?', 'answer' => 'The freezer evaporator fan circulates cold air to both the freezer and the fresh food compartment. When the fan fails, both sections lose cooling — not just the freezer.' ],
                    [ 'question' => 'Will Samsung refrigerator 21E clear after forced defrost?', 'answer' => 'If ice blockage is the cause, yes — 21E will clear once the ice melts and the fan can spin freely again. However, the underlying defrost system issue (failed heater or thermostat) must also be addressed, or ice will rebuild and 21E will return.' ],
                    [ 'question' => 'How long does it take for Samsung forced defrost to clear 21E?', 'answer' => 'Samsung forced defrost cycles typically run 20–30 minutes. After the cycle completes and the refrigerator returns to normal cooling mode, the fan should restart. Check within 10 minutes of the defrost ending.' ],
                ],
            ],
        ],

        // ── 23E ──────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 23E Error Code',
            'slug'       => 'samsung-refrigerator-23e-error-code',
            'meta_title' => 'Samsung Refrigerator 23E Error Code — Condenser Fan Motor Fault',
            'meta_desc'  => 'Samsung refrigerator 23E means the condenser fan motor has failed. Learn what this fan does, what causes it to fail, and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '23E',
                '_ar_code_meaning'   => "The 23E error code on a Samsung refrigerator indicates a fault with the condenser fan motor. The condenser fan is located in the machine compartment at the bottom rear of the refrigerator. It draws air across the condenser coils and the compressor to dissipate heat. When the condenser fan fails or stalls, heat cannot be removed from the refrigeration system — the compressor overheats and cooling efficiency drops significantly.\n\n23E differs from 21E (evaporator fan) in that 23E affects the heat-rejection side of the refrigeration cycle rather than the air circulation inside the cabinet.",
                '_ar_causes'         => [
                    [ 'title' => 'Debris Blocking the Fan Blade',      'description' => 'Dust, pet hair, or a foreign object (plastic bag, food wrapper) has been pulled into the fan and is jamming the blade. The machine compartment at the bottom rear is accessible and debris entry is common.' ],
                    [ 'title' => 'Failed Condenser Fan Motor',         'description' => 'The motor bearings have worn out or the windings have burned, preventing rotation.' ],
                    [ 'title' => 'Wiring Fault',                       'description' => 'A broken wire or corroded connector in the fan circuit.' ],
                    [ 'title' => 'Control Board Output Fault',         'description' => 'The control board is not providing voltage to the fan.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the condenser area',           'description' => 'Pull the refrigerator away from the wall. Remove the lower rear access panel. Vacuum all dust and debris from around the condenser coils and fan. Manually spin the fan blade — it should rotate freely. A jammed blade from debris can trigger 23E without the motor being faulty.' ],
                    [ 'title' => 'Power reset',                        'description' => 'After cleaning, unplug the refrigerator for 5 minutes and reconnect. If the fan was jammed by debris and is now clear, 23E should not return.' ],
                ],
                '_ar_when_to_call'   => "If the fan blade spins freely but 23E persists after a reset, the fan motor has failed and requires replacement. The condenser fan replacement is accessible from the lower rear panel — a straightforward repair.",
                '_ar_cost_range'     => '$110 – $270',
                '_ar_faqs'           => [
                    [ 'question' => 'Can a dirty condenser cause Samsung 23E?', 'answer' => 'Yes — heavily clogged condenser coils increase the heat load on the fan and can cause the motor to overheat and stall, triggering 23E. Samsung recommends cleaning condenser coils every 6–12 months, especially in homes with pets.' ],
                    [ 'question' => 'Is Samsung 23E dangerous to the compressor?', 'answer' => 'Yes — if 23E is ignored and the condenser fan remains off, the compressor loses its cooling airflow and can overheat. Prolonged compressor overheating causes permanent compressor damage, which is a much more expensive repair than a fan motor.' ],
                    [ 'question' => 'Where is the condenser fan on a Samsung French door refrigerator?', 'answer' => 'On Samsung French door and bottom-freezer models, the condenser fan is in the machine compartment accessible by removing the lower rear grille panel. It sits adjacent to the compressor and the condenser coils.' ],
                ],
            ],
        ],

        // ── 24E ──────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 24E Error Code',
            'slug'       => 'samsung-refrigerator-24e-error-code',
            'meta_title' => 'Samsung Refrigerator 24E Error Code — Fresh Food Defrost Sensor Fault',
            'meta_desc'  => 'Samsung refrigerator 24E means the fresh food compartment defrost sensor has failed. Learn the causes and what repair is needed.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '24E',
                '_ar_code_meaning'   => "The 24E error code on a Samsung refrigerator indicates a fault with the fresh food compartment defrost sensor (also called the refrigerator evaporator temperature sensor). Samsung dual-evaporator refrigerators have separate evaporator coils and defrost sensors for the freezer and fresh food sections. The defrost sensor monitors the fresh food evaporator temperature to determine when defrost is needed and when it is complete.\n\nWhen 24E is triggered, the defrost system for the fresh food section cannot operate correctly, which leads to ice accumulation on the fresh food evaporator and reduced cooling in the refrigerator compartment over time.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Defrost Sensor',              'description' => 'The NTC temperature sensor has drifted out of specification or developed an open/short circuit. Resistance at room temperature should be within the specified range for the model.' ],
                    [ 'title' => 'Wiring Harness Fault',               'description' => 'The sensor wiring has developed a break or corrosion at the connector.' ],
                    [ 'title' => 'Frost Accumulation on the Sensor',   'description' => 'Heavy frost around the sensor can cause false readings. Forced defrost may temporarily clear 24E if frost is the cause.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Run forced defrost',                 'description' => 'Enter forced defrost mode and run a complete cycle. If 24E was caused by frost accumulation affecting the sensor, it may clear after the evaporator defrosts completely.' ],
                    [ 'title' => 'Inspect and test the sensor',        'description' => 'With the power off, locate the fresh food evaporator sensor (typically mounted on or near the fresh food evaporator coils, behind the rear panel inside the refrigerator compartment). Measure resistance across the two sensor terminals. Compare to the model\'s specification — a reading of infinity (open circuit) or near-zero (short) confirms sensor failure.' ],
                ],
                '_ar_when_to_call'   => "If forced defrost does not resolve 24E, the defrost sensor requires replacement. Accessing the fresh food evaporator involves removing the rear interior panel of the refrigerator compartment.",
                '_ar_cost_range'     => '$100 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung 5E and 24E?', 'answer' => '5E relates to the freezer compartment defrost sensor. 24E relates to the fresh food (refrigerator) compartment defrost sensor. Samsung dual-evaporator models have two separate defrost systems — one for each compartment — and two separate sensor codes.' ],
                    [ 'question' => 'Will my Samsung refrigerator still cool with 24E?', 'answer' => 'Initially yes — 24E disables the fresh food defrost cycle, but cooling continues. Over days or weeks, the fresh food evaporator will accumulate ice and cooling in the refrigerator compartment will gradually decline. Resolve 24E before this occurs.' ],
                ],
            ],
        ],

        // ── 26E ──────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Refrigerator 26E Error Code',
            'slug'       => 'samsung-refrigerator-26e-error-code',
            'meta_title' => 'Samsung Refrigerator 26E Error Code — Defrost Heater Circuit Fault',
            'meta_desc'  => 'Samsung refrigerator 26E means the defrost heater circuit has a fault. Learn the causes — heater element, thermal fuse, or wiring — and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => '26E',
                '_ar_code_meaning'   => "The 26E error code on a Samsung refrigerator indicates a fault in the defrost heater circuit. The defrost heater is a resistive heating element wrapped around or mounted near the evaporator coils. It activates periodically to melt ice that accumulates on the evaporator, keeping the coils clear for efficient heat exchange.\n\nWhen 26E is triggered, the control board has detected that the defrost heater circuit is open — meaning no current is flowing through it during a defrost cycle. This allows ice to continuously build up on the evaporator coils, eventually blocking airflow and causing the refrigerator to stop cooling properly.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Defrost Heater Element',      'description' => 'The glass or ceramic heater element has burned through. This is the most common cause — testing with a multimeter across the heater terminals will show infinite resistance (open circuit) when the element has failed.' ],
                    [ 'title' => 'Blown Thermal Fuse (Defrost Limiter)', 'description' => 'A thermal fuse in series with the heater circuit has opened due to a previous overtemperature event. The fuse tests as open circuit and requires replacement.' ],
                    [ 'title' => 'Defrost Thermostat Fault',           'description' => 'The defrost thermostat (bimetal switch) that closes to allow heater current flow has failed open.' ],
                    [ 'title' => 'Wiring Harness Fault',               'description' => 'A break in the defrost heater wiring harness or a corroded connector.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Test the defrost heater resistance',  'description' => 'Unplug the refrigerator. Access the evaporator (remove freezer interior rear panel). Disconnect the heater leads and measure resistance. A working Samsung defrost heater typically reads 20–80 ohms depending on the model. Infinite resistance = failed heater.' ],
                    [ 'title' => 'Test the thermal fuse',               'description' => 'The thermal fuse is usually a small cylindrical component in line with the heater wiring. Test for continuity — it should read near 0 ohms when good. Infinite resistance = blown fuse.' ],
                    [ 'title' => 'Test the defrost thermostat',         'description' => 'Chill the thermostat with ice (it closes when cold and should show continuity when tested at refrigerator temperatures). An open reading at cold temperatures confirms failure.' ],
                ],
                '_ar_when_to_call'   => "Defrost heater and thermal fuse replacement requires removing the freezer's rear interior panel and working with the evaporator assembly. If you are not comfortable with this disassembly, have a technician complete the repair.",
                '_ar_cost_range'     => '$110 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'How quickly will ice build up on the evaporator with Samsung 26E?', 'answer' => 'Without a working defrost heater, the evaporator will accumulate significant ice within 2–4 days of normal use. Once the evaporator is heavily iced, airflow through the coils stops and the refrigerator loses cooling. Address 26E before this stage.' ],
                    [ 'question' => 'Why did the thermal fuse blow on my Samsung refrigerator?', 'answer' => 'The thermal fuse blows when the defrost heater or its surrounding components reach an unsafe temperature. This is usually caused by the defrost thermostat failing open (which allows the heater to run too long), or by a previous heater failure that caused a heat spike. Replace both the fuse and the thermostat when the fuse has blown.' ],
                    [ 'question' => 'Is Samsung 26E the same as a Samsung not cooling fault?', 'answer' => 'A 26E fault will cause not-cooling symptoms within days if not addressed — ice buildup from a dead defrost heater eventually blocks the evaporator completely. But 26E is the diagnostic code for the root cause, while "not cooling" is the eventual symptom.' ],
                ],
            ],
        ],

    ]; // end ar_error_codes_samsung_refrigerator()
}

// ─────────────────────────────────────────────────────────────────────────────
// DISHWASHER ERROR CODES
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_samsung_dishwasher(): array {
    return [

        // ── 5C / 5E ───────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher 5C Error Code',
            'slug'       => 'samsung-dishwasher-5c-error-code',
            'meta_title' => 'Samsung Dishwasher 5C / 5E Error Code — Drain Fault Causes & Fixes',
            'meta_desc'  => 'Samsung dishwasher 5C or 5E means it cannot drain. Learn the most common causes — clogged filter, drain hose, pump — and how to fix them.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => '5C',
                '_ar_code_meaning'   => "The 5C error code on a Samsung dishwasher (also displayed as 5E on some models) indicates a drain failure. The dishwasher attempted to drain at the end of a cycle or between phases, but the water level sensor did not confirm an empty tub within the required time.\n\n5C is one of the most common Samsung dishwasher error codes. In the majority of cases, the cause is a clogged filter at the bottom of the tub — food debris, grease, and mineral deposits pack the filter over time, restricting or completely blocking the drain pump.",
                '_ar_causes'         => [
                    [ 'title' => 'Clogged Tub Filter',             'description' => 'The filter assembly at the bottom of the dishwasher tub (a cylindrical mesh filter plus a flat coarse filter) is packed with food particles, grease, or grit. This is the most common cause of 5C and is a maintenance issue, not a component failure.' ],
                    [ 'title' => 'Kinked or Blocked Drain Hose',   'description' => 'The drain hose is kinked, crushed, or blocked. The hose must also maintain a high loop (or be connected to an air gap fitting) to prevent backflow from the household drain.' ],
                    [ 'title' => 'Blocked Garbage Disposal or Sink Drain', 'description' => 'If the dishwasher drains into a garbage disposal, a clogged or recently installed disposal (with the drain knockout plug not removed) prevents drainage and triggers 5C.' ],
                    [ 'title' => 'Failed Drain Pump',              'description' => 'The drain pump motor has burned out or its impeller is jammed with a foreign object (glass shard, bone fragment). The pump hums but does not move water.' ],
                    [ 'title' => 'Blocked Check Valve',            'description' => 'The check valve (one-way valve) at the pump outlet can become blocked with grease, preventing water from passing through even with a working pump.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the filter assembly',      'description' => 'Remove the lower rack. Locate the filter at the center-bottom of the tub. Twist the cylindrical filter counter-clockwise and pull it out. Remove the flat filter beneath it. Rinse both under running water, scrubbing with a soft brush to remove grease and debris. Reinstall with the cylindrical filter locked clockwise.' ],
                    [ 'title' => 'Check the drain hose',           'description' => 'Inspect the drain hose under the sink for kinks. Verify the garbage disposal knockout plug is removed if the dishwasher was recently connected to a new disposal. Confirm the drain hose high loop is above the disposal connection height.' ],
                    [ 'title' => 'Run a drain-only cycle',         'description' => 'Press Cancel/Drain on the dishwasher panel (on most Samsung models, pressing Start + Cancel together for 3 seconds initiates a drain cycle). Listen for the pump operating — a running pump confirms power to the drain circuit; silence confirms a pump failure.' ],
                ],
                '_ar_when_to_call'   => "If the filter is clean, the drain hose is clear, and the pump is silent during a drain attempt, the drain pump motor has failed and needs replacement. Samsung dishwasher drain pump replacement requires removing the lower rack and accessing the pump from inside the tub or the underside panel.",
                '_ar_cost_range'     => '$120 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'How often should I clean my Samsung dishwasher filter?', 'answer' => 'Samsung recommends cleaning the filter monthly. For households that do not pre-rinse dishes, cleaning every 2 weeks is advisable. A clogged filter is responsible for the vast majority of 5C drain errors.' ],
                    [ 'question' => 'My Samsung dishwasher shows 5C after a power outage — why?', 'answer' => 'A power interruption during a cycle can leave the dishwasher in a mid-cycle state with water in the tub. When power is restored, the machine may trigger 5C because it detects water it did not successfully drain before the outage. Run a Cancel/Drain cycle to clear the tub.' ],
                    [ 'question' => 'Can too much detergent cause Samsung dishwasher 5C?', 'answer' => 'Excessive suds from using regular dish soap or too much dishwasher detergent can overflow into the drain path and create a foam barrier that the pump cannot push through. Always use automatic dishwasher detergent only (not hand dish soap) and measure carefully.' ],
                ],
            ],
        ],

        // ── 4C ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher 4C Error Code',
            'slug'       => 'samsung-dishwasher-4c-error-code',
            'meta_title' => 'Samsung Dishwasher 4C Error Code — Water Supply Fault',
            'meta_desc'  => 'Samsung dishwasher 4C means not enough water is entering the machine. Learn the causes and how to fix a no-fill error yourself.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => '4C',
                '_ar_code_meaning'   => "The 4C error code on a Samsung dishwasher indicates a water supply fault — the machine is not receiving enough water within the required fill time. Samsung dishwashers monitor fill time via a flow sensor or pressure switch. If the minimum water level is not reached within approximately 4 minutes, 4C is triggered and the cycle halts.\n\nIn most cases, 4C is caused by a closed water supply valve, a kinked inlet hose, or a clogged inlet valve screen — all straightforward checks before calling for service.",
                '_ar_causes'         => [
                    [ 'title' => 'Water Supply Valve Closed or Partially Closed', 'description' => 'The dishwasher water supply valve (under the sink) is not fully open. Check it is turned counter-clockwise as far as possible.' ],
                    [ 'title' => 'Kinked Inlet Hose',              'description' => 'The water supply hose from the valve to the dishwasher inlet has kinked — commonly when the dishwasher is pushed back under the counter after installation.' ],
                    [ 'title' => 'Clogged Inlet Valve Screen',     'description' => 'The small mesh screen inside the inlet valve connection can collect debris from the household water supply, restricting flow.' ],
                    [ 'title' => 'Low Water Pressure',             'description' => 'The household water pressure is insufficient. Dishwashers require 20–120 PSI. Check if other fixtures in the home also have low flow.' ],
                    [ 'title' => 'Failed Water Inlet Valve',       'description' => 'The solenoid inlet valve has failed and does not open when powered. This requires valve replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check and open the water supply valve', 'description' => 'Open the cabinet beneath the kitchen sink and locate the hot water supply valve for the dishwasher. Ensure it is fully open (turned counter-clockwise as far as possible).' ],
                    [ 'title' => 'Inspect the inlet hose',         'description' => 'Pull the dishwasher out slightly (or access through the cabinet kick plate) and inspect the water inlet hose for kinks. Straighten any kinks and restore the dishwasher position without re-kinking the hose.' ],
                    [ 'title' => 'Clean the inlet screen',         'description' => 'Turn off the water supply valve. Disconnect the inlet hose from the back of the dishwasher. Look inside the inlet port for the small mesh screen. Remove, rinse clean, and reinstall.' ],
                ],
                '_ar_when_to_call'   => "If all checks above are completed and 4C persists, the inlet valve solenoid has failed and needs professional replacement. This is a 30-45 minute repair requiring the correct Samsung valve part number for your model.",
                '_ar_cost_range'     => '$100 – $210',
                '_ar_faqs'           => [
                    [ 'question' => 'My Samsung dishwasher showed 4C after we had the water shut off for plumbing work — is this related?', 'answer' => 'Yes — plumbing work often dislodges debris that then catches in the dishwasher inlet screen. After restoring household water supply, clean the inlet screen at the back of the dishwasher. Also run a test fill to confirm full flow.' ],
                    [ 'question' => 'Can hard water cause Samsung dishwasher 4C?', 'answer' => 'Over years of use, mineral scale from hard water can coat the inlet valve solenoid core and restrict its range of motion. In very hard water areas, inlet valve failure happens sooner than average. A whole-house water softener extends appliance valve life.' ],
                    [ 'question' => 'Does 4C on a Samsung dishwasher damage dishes?', 'answer' => 'No — 4C halts the cycle before the wash phase begins. Dishes remain dirty but undamaged. Simply resolve the water supply issue and restart the cycle.' ],
                ],
            ],
        ],

        // ── LC / LE ───────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher LC Error Code',
            'slug'       => 'samsung-dishwasher-lc-error-code',
            'meta_title' => 'Samsung Dishwasher LC / LE Error Code — Leak Detected',
            'meta_desc'  => 'Samsung dishwasher LC or LE means the flood sensor in the base has detected water. Learn how to find the leak source and get the dishwasher running again.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'LC',
                '_ar_code_meaning'   => "The LC error code on a Samsung dishwasher (also displayed as LE on some models) means the dishwasher's anti-flood sensor — a float switch in the base pan beneath the tub — has detected water. When water accumulates in the base, the float rises and triggers LC, locking out all dishwasher operations until the base is dry and the source of the leak is repaired.\n\nLC is not always a sign of a major leak. Even a small amount of water from a loose hose clamp, a minor door seal leak, or suds overflow can trigger LC. However, the source must always be found and repaired — drying the base without fixing the leak simply results in LC returning on the next cycle.",
                '_ar_causes'         => [
                    [ 'title' => 'Door Gasket (Tub Seal) Leak',   'description' => 'A worn, torn, or deformed door gasket allows water to seep past the door edge during the wash cycle, accumulating in the base pan. This is the most common cause of LC.' ],
                    [ 'title' => 'Loose Hose Clamp or Fitting',   'description' => 'A hose clamp inside the dishwasher (at the pump, water inlet, or spray arm connection) has loosened, allowing water to drip into the base during operation.' ],
                    [ 'title' => 'Pump Seal Leak',                'description' => 'The circulation pump shaft seal can wear over time, allowing water to pass around the shaft and drip into the base.' ],
                    [ 'title' => 'Excessive Detergent / Suds',    'description' => 'Suds overflow from using too much detergent or non-dishwasher soap can flow over the tub walls into the base pan, triggering LC without any actual component failure.' ],
                    [ 'title' => 'Cracked Tub or Hose',           'description' => 'A cracked inner tub or cracked wash arm supply hose can cause significant water leakage into the base.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Tilt the dishwasher to drain the base', 'description' => 'Turn off the water supply and unplug the dishwasher. Remove the kick plate at the bottom front. Carefully tilt the dishwasher forward approximately 45° to drain water from the base pan through the front. Set it back level. This deactivates the float switch.' ],
                    [ 'title' => 'Run a short cycle and observe',  'description' => 'After clearing the base, run a short wash cycle and observe from the front (with the kick plate removed) using a flashlight. Look for drips from the door edge, pump area, or hose connections during the wash phase.' ],
                    [ 'title' => 'Inspect the door gasket',        'description' => 'Open the door and examine the full perimeter of the door gasket. Look for tears, deformation, hardening, or gaps. A gasket that has lost its flexibility cannot form a watertight seal.' ],
                ],
                '_ar_when_to_call'   => "If the leak source is identified as a cracked component, a failed pump seal, or a damaged internal hose, professional repair is recommended. A technician can properly reseal or replace pump components and internal hoses without risk of damaging the dishwasher electronics during disassembly.",
                '_ar_cost_range'     => '$130 – $290',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Samsung dishwasher while it shows LC?', 'answer' => 'No. LC locks out all dishwasher operation as a flood protection measure. Running the dishwasher with LC active is not possible — and attempting to bypass it risks water damage to the kitchen floor and cabinets.' ],
                    [ 'question' => 'My Samsung dishwasher shows LC but I cannot see any water or leak — why?', 'answer' => 'The float switch in the base pan is very sensitive. Even a small amount of condensation or residual water from a one-time event (such as a suds overflow) can trigger LC. Tilt the unit to drain the base, then run a cycle while monitoring. If LC does not return, the trigger was a one-time event.' ],
                    [ 'question' => 'Does Samsung dishwasher LC mean my flooring is damaged?', 'answer' => 'If LC was triggered quickly (after 1-2 cycles), the amount of water in the base is likely small and flooring damage is unlikely. If LC appeared after extended unnoticed leaking (months), check underneath the dishwasher for water damage to the subfloor.' ],
                ],
            ],
        ],

        // ── OC / OE ───────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher OC Error Code',
            'slug'       => 'samsung-dishwasher-oc-error-code',
            'meta_title' => 'Samsung Dishwasher OC / OE Error Code — Overflow Detected',
            'meta_desc'  => 'Samsung dishwasher OC or OE means the dishwasher detected too much water in the tub. Learn the causes — usually a failed inlet valve — and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'OC',
                '_ar_code_meaning'   => "The OC error code on a Samsung dishwasher (also displayed as OE) indicates an overflow condition — the water level in the tub has exceeded the maximum allowed level. Samsung dishwashers immediately halt the cycle and attempt an emergency drain when OC is triggered.\n\nOC almost always points to a water inlet valve that is not fully closing when it receives the shutoff signal. Instead of shutting off, the valve continues to allow water into the tub, eventually triggering the overflow sensor.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Inlet Valve (Stuck Open)', 'description' => 'The water inlet valve solenoid fails in the open position, allowing water to continue entering the tub after the control board sends the close signal. This is the primary cause of OC.' ],
                    [ 'title' => 'Failed Water Level Sensor',       'description' => 'The pressure switch or flow sensor that monitors tub water level fails, providing incorrect readings that allow overfilling even with a correctly functioning inlet valve.' ],
                    [ 'title' => 'Blocked Pressure Sensor Port',   'description' => 'The port or tube connected to the water level pressure switch clogs with food residue, causing inaccurate level readings.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Manually drain the dishwasher',  'description' => 'Turn off the water supply valve. Start a Cancel/Drain cycle. If OC prevents normal operation, bail remaining water from the tub manually before inspection.' ],
                    [ 'title' => 'Watch the fill phase carefully', 'description' => 'After clearing the tub, restart the dishwasher and watch the fill phase. If water continues to run after the initial fill and the cycle begins, the inlet valve is not closing and must be replaced.' ],
                    [ 'title' => 'Turn off the water supply if OC recurs', 'description' => 'Do not continue running the dishwasher with a suspected stuck-open inlet valve — the tub will overflow. Turn off the water supply valve under the sink until the valve is replaced.' ],
                ],
                '_ar_when_to_call'   => "A failed-open inlet valve requires professional replacement. The valve is accessed through the front kick plate or by pulling the dishwasher out from under the counter. Do not operate the dishwasher with the water supply on until the valve is confirmed repaired.",
                '_ar_cost_range'     => '$110 – $230',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Samsung dishwasher after an OC error?', 'answer' => 'Not until the inlet valve is inspected. If the valve stuck open once due to a debris particle, it may operate normally after the incident. However, if OC recurs on the next cycle, the valve has mechanically failed and must be replaced before further use.' ],
                    [ 'question' => 'Is OC the same as LC on a Samsung dishwasher?', 'answer' => 'They are related but different. OC (overflow) means too much water is in the tub — detected by the internal water level sensor. LC (leak) means water has escaped into the base pan beneath the tub — detected by the float switch. OC can lead to LC if overflow water drains into the base.' ],
                    [ 'question' => 'Why did my Samsung dishwasher OC error appear only once and then went away?', 'answer' => 'A debris particle (mineral flake, food particle) can temporarily lodge in the inlet valve seat and prevent it from closing, then be flushed clear. If OC appears once and does not recur, monitor the next several cycles. If it recurs, the valve seat is worn and will fail permanently in the near future.' ],
                ],
            ],
        ],

        // ── HE (Dishwasher) ───────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher HE Error Code',
            'slug'       => 'samsung-dishwasher-he-error-code',
            'meta_title' => 'Samsung Dishwasher HE Error Code — Heater Fault',
            'meta_desc'  => 'Samsung dishwasher HE means the wash heater or the heater circuit has a fault. Learn what causes it and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'HE',
                '_ar_code_meaning'   => "The HE error code on a Samsung dishwasher indicates a fault with the wash water heater circuit. Samsung dishwashers use an inline flow-through heater (also called a heating element or booster heater) to raise the incoming water temperature to the target wash temperature. If the heater does not raise the temperature within the expected time window, or if the heater NTC thermistor reads out of range, HE is triggered.\n\nHE on a Samsung dishwasher typically means the heating element has failed or the thermistor has malfunctioned. Dishes that come out cold to the touch despite a completed cycle are a common symptom preceding a HE code.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Heating Element',         'description' => 'The wash heater element (often a flow-through tubular heater) has developed an open circuit and produces no heat.' ],
                    [ 'title' => 'Failed NTC Thermistor',          'description' => 'The temperature sensor in the wash circuit is reading out of specification, preventing accurate temperature control and triggering HE.' ],
                    [ 'title' => 'Tripped High-Limit Thermostat',  'description' => 'The thermal safety device in the heater circuit has tripped. This can be caused by low water level reaching the heater (allowing it to run dry) during a drain/refill transition.' ],
                    [ 'title' => 'Wiring or Control Board Fault',  'description' => 'A broken circuit in the heater wiring harness or a failed heater relay on the control board cuts power to the element.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Run a hot water cycle to verify',  'description' => 'Run a Normal or Heavy wash and check whether dishes and the dishwasher interior are warm after the cycle. Cold dishes and a cold interior confirm the heater is not functioning.' ],
                    [ 'title' => 'Ensure water supply is hot',      'description' => 'Run the hot water tap at the kitchen sink for 30 seconds before starting the dishwasher to ensure hot water reaches the inlet valve. Cold incoming water requires more heater work and can trigger HE on borderline heaters.' ],
                    [ 'title' => 'Perform a power reset',           'description' => 'Unplug the dishwasher for 60 seconds. A tripped thermal limiter may reset after cooling down. If HE clears and the dishwasher heats normally for several cycles then HE recurs, the element is intermittently failing.' ],
                ],
                '_ar_when_to_call'   => "Heating element testing and replacement requires accessing the underside or interior of the dishwasher tub and working with the control board wiring. A technician should test the element resistance and thermistor to confirm which component has failed before ordering parts.",
                '_ar_cost_range'     => '$130 – $270',
                '_ar_faqs'           => [
                    [ 'question' => 'Can my Samsung dishwasher still wash dishes with HE?', 'answer' => 'The dishwasher will still run cycles with a failed heater, but wash water will be cold, reducing cleaning performance significantly and leaving dishes dirty with grease. Repair the heater for proper cleaning and sanitization.' ],
                    [ 'question' => 'Does Samsung dishwasher HE also affect drying?', 'answer' => 'Yes — Samsung dishwashers use the residual heat from the wash element to assist drying. With the heater failed, dishes will be wet at the end of the cycle regardless of the dry cycle selected.' ],
                    [ 'question' => 'Can low water pressure cause Samsung dishwasher HE?', 'answer' => 'Indirectly. If water pressure is so low that the heater runs partially exposed (not fully submerged), the thermal safety device can trip and trigger HE. Confirm water pressure is within 20–120 PSI before suspecting the heater element itself.' ],
                ],
            ],
        ],

        // ── 3E ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher 3E Error Code',
            'slug'       => 'samsung-dishwasher-3e-error-code',
            'meta_title' => 'Samsung Dishwasher 3E Error Code — Wash Motor Fault',
            'meta_desc'  => 'Samsung dishwasher 3E means the circulation pump motor has failed or stalled. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => '3E',
                '_ar_code_meaning'   => "The 3E error code on a Samsung dishwasher indicates a wash motor (circulation pump) fault. The circulation pump circulates water through the spray arms during wash and rinse cycles. When the motor stalls, draws excessive current, or the control board receives no feedback from the motor driver, 3E is triggered and the cycle stops.",
                '_ar_causes'         => [
                    [ 'title' => 'Foreign Object in the Pump',       'description' => 'A bone fragment, glass shard, or hard debris has passed through the filter and lodged in the circulation pump impeller, stalling the motor.' ],
                    [ 'title' => 'Failed Circulation Pump Motor',    'description' => 'The motor windings have failed, preventing the pump from reaching operating speed.' ],
                    [ 'title' => 'Capacitor Failure',                'description' => 'The start capacitor for the circulation pump motor has failed, preventing the motor from starting.' ],
                    [ 'title' => 'Control Board Motor Driver Fault', 'description' => 'The motor driver circuit on the PCB cannot deliver power to the pump motor.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Inspect and clean the pump area',  'description' => 'Remove the lower rack, filter assembly, and spray arm. Look into the sump for debris. Remove any foreign objects using needle-nose pliers.' ],
                    [ 'title' => 'Power reset',                      'description' => 'Unplug for 5 minutes and try restarting. A momentary pump stall from debris may clear after the obstruction is removed.' ],
                ],
                '_ar_when_to_call'   => "If no obstruction is found and 3E persists, the circulation pump or control board requires replacement — a moderate to complex repair depending on model.",
                '_ar_cost_range'     => '$120 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Will dishes still be dirty after a 3E error?', 'answer' => 'Yes — 3E halts the wash cycle, so dishes in the tub when the error occurred will not have been cleaned. Remove and rewash by hand until the dishwasher is repaired.' ],
                    [ 'question' => 'Is Samsung dishwasher 3E dangerous?', 'answer' => 'No — the dishwasher shuts down safely. There is no flood or electrical risk from 3E itself.' ],
                ],
            ],
        ],

        // ── tE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher tE Error Code',
            'slug'       => 'samsung-dishwasher-te-error-code',
            'meta_title' => 'Samsung Dishwasher tE Error Code — Temperature Sensor Fault',
            'meta_desc'  => 'Samsung dishwasher tE means the water temperature sensor has failed. Learn what it affects and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'tE',
                '_ar_code_meaning'   => "The tE error code on a Samsung dishwasher indicates a temperature sensor (thermistor) fault. The temperature sensor monitors water temperature during wash and rinse cycles to ensure the heater brings water to the correct temperature. When the sensor reads out of range, the control board cannot manage heating safely and triggers tE.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Thermistor',                'description' => 'The temperature sensor element has failed, reading short circuit or open circuit resistance.' ],
                    [ 'title' => 'Scale Buildup on Sensor',          'description' => 'Mineral deposits have coated the sensor, insulating it from the water and causing inaccurate temperature readings.' ],
                    [ 'title' => 'Sensor Harness Fault',             'description' => 'The wiring between the sensor and the control board has a loose connection or damage.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Run a dishwasher cleaning cycle',  'description' => 'Use a dishwasher cleaner tablet or a cup of white vinegar in the bottom of the empty tub and run a Hot cycle. This removes mineral scale that may be insulating the sensor.' ],
                    [ 'title' => 'Power reset',                      'description' => 'Unplug for 5 minutes and reconnect. A transient sensor fault may clear.' ],
                ],
                '_ar_when_to_call'   => "If tE persists, the temperature sensor requires replacement. The sensor is located in the sump area and is accessible after removing the lower spray arm and filter.",
                '_ar_cost_range'     => '$80 – $190',
                '_ar_faqs'           => [
                    [ 'question' => 'Will Samsung dishwasher tE prevent the machine from cleaning dishes?', 'answer' => 'Partially — the dishwasher may complete cycles but without correct water heating. Dishes may not be sanitized and plastics may not dry properly.' ],
                    [ 'question' => 'Is tE common on Samsung dishwashers?', 'answer' => 'tE is less common than 5C or 4C but appears frequently in areas with hard water where mineral scale accumulates on sensors.' ],
                ],
            ],
        ],

        // ── bE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher bE Error Code',
            'slug'       => 'samsung-dishwasher-be-error-code',
            'meta_title' => 'Samsung Dishwasher bE Error Code — Stuck Button / Key Fault',
            'meta_desc'  => 'Samsung dishwasher bE means a control panel button is stuck or shorted. Learn how to diagnose and clear it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'bE',
                '_ar_code_meaning'   => "The bE error code on a Samsung dishwasher indicates a control panel button fault — a key is stuck in the pressed position or the membrane switch is shorted. The control board cannot accept commands when a button appears permanently active, so the dishwasher halts and displays bE.",
                '_ar_causes'         => [
                    [ 'title' => 'Debris or Moisture Under the Panel', 'description' => 'Food splatter or moisture has worked under the control panel membrane, physically holding a button or creating a short.' ],
                    [ 'title' => 'Damaged Membrane Switch',           'description' => 'The flexible membrane switch has developed a crack at a button location, creating a permanent contact.' ],
                    [ 'title' => 'Control Board Key-Scan Fault',     'description' => 'The control board\'s button scanning circuit has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the control panel',          'description' => 'Wipe the entire control panel with a slightly damp cloth, pressing each button and releasing. Dry thoroughly with a soft cloth. Clean around all button edges.' ],
                    [ 'title' => 'Power reset',                      'description' => 'Turn off the dishwasher at the circuit breaker for 10 minutes. Moisture-induced shorts may clear as the panel dries.' ],
                ],
                '_ar_when_to_call'   => "If bE persists, the control panel assembly or main PCB requires replacement.",
                '_ar_cost_range'     => '$90 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I prevent Samsung dishwasher bE?', 'answer' => 'Keep the control panel dry — avoid spraying water directly at it when cleaning the dishwasher exterior, and ensure the door seal is in good condition to prevent steam from reaching the panel.' ],
                ],
            ],
        ],

        // ── 6E ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher 6E Error Code',
            'slug'       => 'samsung-dishwasher-6e-error-code',
            'meta_title' => 'Samsung Dishwasher 6E Error Code — Diverter Motor Fault',
            'meta_desc'  => 'Samsung dishwasher 6E means the diverter motor has failed. Learn how the diverter works, what causes it to fail, and repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => '6E',
                '_ar_code_meaning'   => "The 6E error code on a Samsung dishwasher indicates a diverter motor fault. Samsung dishwashers use a diverter valve and motor to direct water flow between the lower and upper spray arms at different phases of the wash cycle. This sequential spray pattern improves wash coverage while conserving water and pump energy. When the diverter motor fails to move to the commanded position or does not complete its rotation within the expected time, 6E is displayed and the wash cycle is stopped.\n\n6E results in uneven washing — typically either the upper rack or lower rack receives no water. It is a commonly reported Samsung dishwasher fault on models that use diverter-based spray routing.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Diverter Motor',               'description' => 'The small motor that drives the diverter valve has burned out or seized. Motor failure is the most common cause of 6E.' ],
                    [ 'title' => 'Debris Jamming the Diverter Valve',   'description' => 'Glass fragments, food debris, or a broken utensil has lodged in the diverter mechanism, preventing the valve from rotating.' ],
                    [ 'title' => 'Diverter Motor Wiring Fault',         'description' => 'The wire harness from the diverter motor to the main control board has a broken wire or loose connector.' ],
                    [ 'title' => 'Control Board Diverter Output Fault', 'description' => 'The motor driver circuit on the control board has failed, not supplying power to the diverter motor.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the dishwasher sump and filter', 'description' => 'Remove the lower rack and the filter assembly at the tub base. Inspect the sump area for glass fragments, bone chips, or debris that could jam the diverter mechanism. Clean the filter and surrounding area thoroughly.' ],
                    [ 'title' => 'Power reset',                          'description' => 'Switch off the circuit breaker for 5 minutes and restore power. A one-time motor stall event from a transient obstruction may clear after a reset.' ],
                    [ 'title' => 'Check if the upper rack washes',       'description' => 'Run a normal cycle and open the dishwasher immediately after — if the upper rack dishes are still dirty but the lower rack is clean (or vice versa), this confirms the diverter is not routing water to one zone, consistent with 6E.' ],
                ],
                '_ar_when_to_call'   => "Diverter motor replacement requires accessing the pump assembly under the dishwasher tub floor — a moderate repair requiring the dishwasher to be pulled out from the cabinet. A technician can typically complete this in under an hour.",
                '_ar_cost_range'     => '$110 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still use my Samsung dishwasher with 6E?', 'answer' => 'The dishwasher will not run with 6E active — the cycle stops when the fault is detected. Do not attempt to restart it repeatedly as this can stress the diverter motor further. Schedule a repair.' ],
                    [ 'question' => 'Why does Samsung dishwasher 6E appear suddenly after years of use?', 'answer' => 'Diverter motors typically last 6–10 years. Small glass fragments from broken glassware are a common cause of premature failure — a shard that enters the sump can jam the diverter mechanism and burn out the motor. Always remove large broken glass pieces from the dishwasher manually before running a cleanup cycle.' ],
                    [ 'question' => 'Is Samsung dishwasher 6E the same on all models?', 'answer' => 'Most current Samsung dishwashers sold in the USA use diverter-based spray routing and can display 6E. Samsung models that use a different spray arm design (single-pump with manual selector) may use a different code or not have 6E at all.' ],
                ],
            ],
        ],

        // ── FE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher FE Error Code',
            'slug'       => 'samsung-dishwasher-fe-error-code',
            'meta_title' => 'Samsung Dishwasher FE Error Code — Overfill / Inlet Valve Stuck Open',
            'meta_desc'  => 'Samsung dishwasher FE means the tub has overfilled — the water inlet valve is stuck open. Learn why it is urgent and how it is repaired.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'FE',
                '_ar_code_meaning'   => "The FE error code on a Samsung dishwasher indicates an overfill condition — the water level sensor has detected that the tub has filled above the maximum allowable level. When FE is triggered, the dishwasher immediately stops the cycle and activates the drain pump to expel the excess water.\n\nFE is distinct from 4C (which means insufficient water getting in) — FE means too much water has entered the tub. The most common cause is a water inlet valve solenoid that has failed in the open position and will not close when the fill target is reached. FE is an urgent code because a valve stuck open will continue filling indefinitely if the drain pump cannot keep up, risking overflow onto the kitchen floor.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Inlet Valve (Stuck Open)',      'description' => 'The water inlet solenoid valve has failed with its plunger stuck in the open position, allowing water to flow into the tub continuously even after the target fill level is reached. This is the most common cause of FE.' ],
                    [ 'title' => 'Failed Water Level Sensor',            'description' => 'The pressure-based water level sensor has failed in a way that incorrectly reports the tub is continuously filling past the maximum, triggering FE even when the actual water level is normal.' ],
                    [ 'title' => 'Blocked Water Level Sensor Hose',      'description' => 'The small hose leading from the tub sump to the water level pressure sensor is clogged, causing an inaccurate overfill reading.' ],
                    [ 'title' => 'Control Board Inlet Valve Relay Fault', 'description' => 'The relay on the main control board that controls the inlet valve has failed in the closed position, keeping the valve energized (open) indefinitely.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Turn off the water supply immediately', 'description' => 'When FE appears, turn off the water supply valve under the kitchen sink (the dishwasher\'s supply valve). This stops water from entering the dishwasher regardless of the valve state. Do not restart the dishwasher until the valve is inspected.' ],
                    [ 'title' => 'Listen for water entering after cycle stops', 'description' => 'After FE halts the cycle, listen at the dishwasher for any sound of water running. If you hear water still entering with the cycle stopped, the inlet valve is confirmed stuck open and must be replaced before using the dishwasher again.' ],
                    [ 'title' => 'Check the water level sensor hose',    'description' => 'After draining the dishwasher, inspect the small rubber hose from the sump to the water level sensor. Clear any blockage and retest.' ],
                ],
                '_ar_when_to_call'   => "A stuck-open inlet valve requires replacement before the dishwasher is used again. Do not operate the dishwasher with a confirmed FE inlet valve fault — the risk of overflow and water damage to cabinetry and flooring is significant. Inlet valve replacement is a 30-minute repair.",
                '_ar_cost_range'     => '$100 – $230',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung dishwasher FE dangerous?', 'answer' => 'Yes — if the inlet valve is stuck open and the drain pump cannot keep up with the inflow, water will overflow onto the kitchen floor. Turn off the water supply valve under the sink immediately when FE appears and do not reopen it until the inlet valve has been inspected and repaired.' ],
                    [ 'question' => 'What is the difference between Samsung dishwasher FE and 4C?', 'answer' => '4C means insufficient water is getting into the dishwasher — the supply is too slow or the valve is failing to open. FE means too much water is getting in — the valve is not closing when it should. They are opposite faults involving the same component (the inlet valve).' ],
                    [ 'question' => 'Can I reset Samsung dishwasher FE?', 'answer' => 'FE will clear after the dishwasher drains the excess water and you perform a power reset. However, if the inlet valve is stuck open, FE will return immediately on the next fill attempt. The only permanent fix is inlet valve replacement.' ],
                ],
            ],
        ],


        // ── dE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher dE Error Code',
            'slug'       => 'samsung-dishwasher-de-error-code',
            'meta_title' => 'Samsung Dishwasher dE Error Code — Door Open / Door Latch Fault',
            'meta_desc'  => 'Samsung dishwasher dE means the door is open or the door latch has failed. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'dE',
                '_ar_code_meaning'   => "The dE error code on a Samsung dishwasher indicates a door open or door latch fault. The dishwasher requires the door to be fully closed and latched before a cycle can begin or continue. If the door latch switch does not confirm a closed and locked state, dE is displayed and the cycle is halted or prevented from starting.\n\ndE is the most commonly reported Samsung dishwasher error code in the USA. In the majority of cases, the door latch assembly itself has worn or failed — a very common failure mode on Samsung dishwashers after years of use.",
                '_ar_causes'         => [
                    [ 'title' => 'Door Not Fully Closed',              'description' => 'The door was not pushed fully closed before starting the cycle, or a utensil or rack protrusion is preventing full closure.' ],
                    [ 'title' => 'Failed Door Latch Assembly',         'description' => 'The door latch hook and switch assembly has worn or the microswitch has failed. This is the most common hardware cause of dE. The latch switch no longer confirms a locked state even when the door is physically closed.' ],
                    [ 'title' => 'Misaligned Door',                    'description' => 'The door hinge adjustment has shifted over time, causing the door to sit slightly out of alignment and not engage the latch strike correctly.' ],
                    [ 'title' => 'Broken Door Latch Hook',             'description' => 'The plastic latch hook has broken, preventing it from engaging the strike plate.' ],
                    [ 'title' => 'Wiring Fault to Latch Switch',       'description' => 'A loose or corroded connector on the latch switch wiring.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Confirm door is fully closed',        'description' => 'Open and firmly close the door until you hear a distinct click. Check that no utensil handles, spray arms, or rack components are protruding and preventing full closure.' ],
                    [ 'title' => 'Inspect the door latch hook',         'description' => 'With the dishwasher off, open the door and examine the latch hook on the door top edge. Look for any cracked or broken plastic. If broken, a latch replacement kit is required before any other diagnosis.' ],
                    [ 'title' => 'Check door alignment',               'description' => 'Look at the door gap around the perimeter when closed. Uneven gaps — wider on one side — indicate a hinge alignment issue. Samsung dishwasher door hinges have adjustment screws accessible from inside the door panel.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Switch off at the circuit breaker for 5 minutes and restart. A transient latch switch reading error may clear.' ],
                ],
                '_ar_when_to_call'   => "If the door closes firmly, the latch hook is intact, and dE persists, the door latch assembly requires replacement. This involves removing the inner door panel — a moderate disassembly task that a technician can complete quickly.",
                '_ar_cost_range'     => '$90 – $230',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Samsung dishwasher show dE mid-cycle?', 'answer' => 'If dE appears during a running cycle, the door latch switch is intermittently failing — it maintains contact under normal conditions but loses it during vibration or thermal expansion as the machine heats up. An intermittent latch switch will worsen over time. Schedule a latch replacement before it fails completely.' ],
                    [ 'question' => 'Can I use my Samsung dishwasher with a dE error?', 'answer' => 'No — dE prevents the cycle from running as a safety measure. The dishwasher must confirm a sealed door before heating water and spraying. Do not attempt to bypass the latch switch.' ],
                    [ 'question' => 'Is Samsung dishwasher dE covered by warranty?', 'answer' => 'If your dishwasher is within Samsung\'s standard warranty period, a failed door latch is typically covered. Contact Samsung support before arranging third-party repair for in-warranty units.' ],
                ],
            ],
        ],


        // ── 1E / IE ───────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher 1E Error Code',
            'slug'       => 'samsung-dishwasher-1e-error-code',
            'meta_title' => 'Samsung Dishwasher 1E / IE Error Code — Water Level Sensor Fault',
            'meta_desc'  => 'Samsung dishwasher 1E or IE means the water level sensor has failed. Learn what causes it and how it affects your wash cycle.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => '1E',
                '_ar_code_meaning'   => "The 1E error code on a Samsung dishwasher (also shown as IE on some display types) indicates a water level sensor (pressure switch) fault. The water level sensor monitors how much water fills the tub during the wash cycle. When the sensor signal is absent, out of range, or indicates an abnormal water level, 1E is displayed and the cycle halts.\n\nOn Samsung dishwashers, 1E is most commonly caused by a failed pressure sensor or a blocked pressure hose leading to it. In some cases, a failed water inlet valve that allows too little water in can also produce a 1E reading.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Water Level Sensor',         'description' => 'The pressure-based water level sensor has failed electrically and is no longer producing a valid signal.' ],
                    [ 'title' => 'Blocked Pressure Hose',             'description' => 'The small hose connecting the tub sump to the pressure sensor is clogged with grease or debris, preventing accurate pressure transmission.' ],
                    [ 'title' => 'Insufficient Water Fill',           'description' => 'The water inlet valve is restricted or failing, allowing too little water into the tub — not enough to register on the sensor.' ],
                    [ 'title' => 'Wiring Fault to Sensor',            'description' => 'A loose or corroded connector on the sensor wiring harness.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the dishwasher at the circuit breaker for 5 minutes. A transient sensor glitch may clear on restart.' ],
                    [ 'title' => 'Check water supply',                'description' => 'Confirm the supply valve under the sink is fully open and the inlet hose is not kinked. Insufficient supply pressure can prevent adequate fill and trigger 1E.' ],
                    [ 'title' => 'Inspect the pressure hose',         'description' => 'Locate the small rubber hose from the sump to the pressure sensor (typically near the base of the tub). Disconnect and blow through it to confirm it is clear.' ],
                ],
                '_ar_when_to_call'   => "If the supply is adequate and 1E persists after a reset and hose inspection, the water level sensor requires replacement.",
                '_ar_cost_range'     => '$85 – $210',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung dishwasher 1E the same as IE?', 'answer' => 'Yes — 1E and IE are the same fault on different display types. The number 1 and the letter I are visually similar and both represent the water level sensor fault.' ],
                    [ 'question' => 'Can 1E appear even if the dishwasher fills with water?', 'answer' => 'Yes — if the sensor itself has failed, it may not correctly detect water even when the tub fills normally. The dishwasher cannot verify the fill level and halts as a precaution.' ],
                ],
            ],
        ],

        // ── SE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher SE Error Code',
            'slug'       => 'samsung-dishwasher-se-error-code',
            'meta_title' => 'Samsung Dishwasher SE Error Code — Touchpad / Button Fault',
            'meta_desc'  => 'Samsung dishwasher SE means a button on the control panel is stuck or shorted. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'SE',
                '_ar_code_meaning'   => "The SE error code on a Samsung dishwasher indicates a touchpad or button fault — the control board has detected a key that is continuously active (stuck or shorted). Samsung dishwashers use a membrane touchpad or push-button panel that the control board scans continuously. When a key registers as permanently pressed, SE is displayed and the dishwasher halts to prevent unintended cycle commands.\n\nSE on a Samsung dishwasher most commonly results from moisture infiltrating the control panel membrane or from physical wear at a frequently used button (Start, Delay Start, or cycle selection keys).",
                '_ar_causes'         => [
                    [ 'title' => 'Moisture Under the Control Panel',   'description' => 'Steam from the dishwasher or water splashing near the control panel seeps under the membrane touchpad, causing a key circuit to short.' ],
                    [ 'title' => 'Worn or Cracked Touchpad Membrane',  'description' => 'The membrane at a high-use key has worn through, creating a permanent electrical contact.' ],
                    [ 'title' => 'Control Board Key-Scan Fault',       'description' => 'The key-scanning circuit on the main control board has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off at the circuit breaker for 5 minutes. If SE appeared after a wash cycle (steam exposure), allow the control panel to dry before restoring power.' ],
                    [ 'title' => 'Identify the stuck key',             'description' => 'After a reset, press each button individually. If pressing a specific button immediately re-triggers SE, that key\'s membrane circuit has failed.' ],
                ],
                '_ar_when_to_call'   => "If SE persists after drying and reset, the control panel touchpad assembly requires replacement. This involves removing the door inner panel.",
                '_ar_cost_range'     => '$95 – $240',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does Samsung dishwasher SE appear after a cycle?', 'answer' => 'Steam released when opening the dishwasher door after a hot cycle can condense inside the control panel area. If the panel seal is worn, each hot cycle drives more moisture into the membrane. SE appearing after cycles is a sign the membrane is failing.' ],
                    [ 'question' => 'Is dishwasher SE the same as SE on a Samsung range or microwave?', 'answer' => 'Yes — SE represents the same fault type across Samsung appliances: a shorted or continuously-active control panel key. The repair (touchpad/membrane replacement) is the same regardless of appliance type.' ],
                ],
            ],
        ],

        // ── PC ER ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Dishwasher PC ER Error Code',
            'slug'       => 'samsung-dishwasher-pc-er-error-code',
            'meta_title' => 'Samsung Dishwasher PC ER Error Code — Control Board Communication Fault',
            'meta_desc'  => 'Samsung dishwasher PC ER means the main control board and display board have lost communication. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'PC ER',
                '_ar_code_meaning'   => "The PC ER error code on a Samsung dishwasher indicates a communication fault between the main control board and the display/user interface board. Samsung dishwashers use two separate circuit boards — the main PCB that controls the wash motor, pump, heater, and valves, and a display board that handles the control panel and user inputs. PC ER appears when these two boards cannot communicate over the data line between them.\n\nPC ER can be caused by a loose ribbon cable, a failed display board, a failed main board, or a wiring fault. A power reset resolves PC ER if the cause was a transient communication error.",
                '_ar_causes'         => [
                    [ 'title' => 'Loose or Damaged Ribbon Cable',      'description' => 'The ribbon cable or connector between the main PCB and display board has loosened, pulled out slightly, or been damaged.' ],
                    [ 'title' => 'Failed Display Board',               'description' => 'The display/UI board has failed and is not responding to the main board\'s communication attempts.' ],
                    [ 'title' => 'Failed Main Control Board',          'description' => 'The main PCB communication circuit has failed. Less common than display board failure.' ],
                    [ 'title' => 'Moisture Damage to Connector',       'description' => 'Corrosion from steam or a minor leak has damaged the connector pins on the communication cable.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off at the circuit breaker for 5 minutes. Transient communication errors often clear on power-up re-initialization.' ],
                    [ 'title' => 'Check the door panel connections',   'description' => 'The ribbon cable between the main board and display board runs through the dishwasher door. If the dishwasher has been recently serviced or if the door inner panel has been removed, a connector may not be fully reseated.' ],
                ],
                '_ar_when_to_call'   => "If PC ER persists after a reset, a technician is needed to test the ribbon cable, display board, and main board to identify which component has failed.",
                '_ar_cost_range'     => '$120 – $340',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung dishwasher PC ER serious?', 'answer' => 'PC ER prevents the dishwasher from operating entirely — neither the control panel nor the wash cycle functions. It requires repair before the dishwasher can be used.' ],
                    [ 'question' => 'Will a new display board fix Samsung PC ER?', 'answer' => 'In most cases, yes — PC ER is more commonly caused by a failed display board than the main board. However, a technician should test both boards and the ribbon cable before ordering parts, as main board failures also cause PC ER.' ],
                ],
            ],
        ],

    ]; // end ar_error_codes_samsung_dishwasher()
}

// ─────────────────────────────────────────────────────────────────────────────
// OVEN / RANGE ERROR CODES
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_samsung_oven_range(): array {
    return [

        // ── SE (Range) ────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range SE Error Code',
            'slug'       => 'samsung-range-se-error-code',
            'meta_title' => 'Samsung Range / Oven SE Error Code — Touchpad Fault Causes & Fix',
            'meta_desc'  => 'Samsung range or oven SE means the control touchpad has a shorted key fault. Learn what causes it and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'SE',
                '_ar_code_meaning'   => "The SE error code on a Samsung range or oven (also displayed as 5E on some models) indicates that the control board has detected a shorted or continuously-active key on the touchpad membrane. The oven stops responding to commands and displays SE continuously.\n\nSE is one of Samsung's most widely reported oven and range errors. It commonly follows steam or moisture exposure (steam released during boiling or heavy cooking can condense on the control panel) or results from physical wear of the touchpad membrane over time. The control board itself can also be the source if the touchpad tests correctly.",
                '_ar_causes'         => [
                    [ 'title' => 'Touchpad Membrane Moisture / Steam Damage', 'description' => 'Condensation from heavy stovetop cooking infiltrates the membrane layer, bridging the printed circuits and causing one or more keys to register as permanently active.' ],
                    [ 'title' => 'Touchpad Membrane Physical Wear', 'description' => 'Years of button pressing causes the conductive layers in the membrane to delaminate or develop micro-cracks, triggering false key detections.' ],
                    [ 'title' => 'Grease Contamination of Control Panel', 'description' => 'Cooking grease seeping behind the control panel membrane can bridge keypad circuits, particularly on ranges where the panel is directly above the cooktop.' ],
                    [ 'title' => 'Control Board Key-Scanning Fault', 'description' => 'The key-scanning circuit on the control board itself develops a fault, triggering SE even with an intact membrane. Confirmed by replacing the membrane first — if SE persists, the board is implicated.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Perform a power reset',           'description' => 'Turn off the oven\'s dedicated circuit breaker for 60 seconds, then restore power. If SE was caused by transient moisture, it may clear and not return. If SE returns within minutes of a cycle starting, hardware failure is confirmed.' ],
                    [ 'title' => 'Inspect for moisture around the panel', 'description' => 'If SE appeared after boiling a large pot of water or heavy steaming, allow the range to cool completely with the oven door slightly open. Wipe down the control panel area with a dry cloth. Restore power and test.' ],
                    [ 'title' => 'Identify the shorted key',        'description' => 'After a reset that temporarily clears SE, press keys one at a time. If pressing a specific key immediately triggers SE, that key\'s membrane circuit has failed.' ],
                ],
                '_ar_when_to_call'   => "If SE returns after reset and drying, the touchpad membrane has failed and requires replacement. Control panel replacement on Samsung ranges involves removing the panel assembly — a moderate disassembly task recommended for a certified technician on built-in and slide-in range models.",
                '_ar_cost_range'     => '$130 – $300',
                '_ar_faqs'           => [
                    [ 'question' => 'Is it safe to use my Samsung range with an SE error?', 'answer' => 'No. SE disables the control system. The oven will not respond reliably to commands, and in some cases the control board may misinterpret the shorted key signal. Do not operate the range until SE is resolved.' ],
                    [ 'question' => 'Why does my Samsung oven SE error appear only after cooking?', 'answer' => 'Steam from stovetop cooking rises into the control panel area. Each episode causes slight additional moisture damage to the touchpad membrane. Once enough moisture damage has accumulated, SE becomes permanent. Reduce stovetop steam exposure to the panel by using lids on pots and running the exhaust fan during heavy cooking.' ],
                    [ 'question' => 'My Samsung range shows SE but some buttons still respond — should I ignore it?', 'answer' => 'No. Partial SE means one or more keys are already shorted and the others may soon follow. The membrane is degrading and will fail completely. Arrange a repair before the oven becomes fully non-functional.' ],
                ],
            ],
        ],

        // ── C-A1 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range C-A1 Error Code',
            'slug'       => 'samsung-range-ca1-error-code',
            'meta_title' => 'Samsung Range C-A1 / CA1 Error Code — Communication Fault',
            'meta_desc'  => 'Samsung range C-A1 means the main control board lost communication with a secondary module. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'C-A1',
                '_ar_code_meaning'   => "The C-A1 error code on a Samsung range (also displayed as CA1) indicates a communication fault between the main control board and a secondary module — typically the display board, cooktop control module, or smart connectivity board. Samsung slide-in and flex-duo ranges use a multi-board architecture; C-A1 appears when the main board cannot establish or maintain communication with one of these modules.",
                '_ar_causes'         => [
                    [ 'title' => 'Loose or Disconnected Harness Connector', 'description' => 'The wiring harness between the main board and the secondary module has a loose or disconnected connector.' ],
                    [ 'title' => 'Failed Display or Sub-Board',       'description' => 'The display module or cooktop control board has failed and is not responding to the main PCB.' ],
                    [ 'title' => 'Failed Main Control Board',         'description' => 'The communication circuit on the main PCB has failed.' ],
                    [ 'title' => 'Power Surge Damage',                'description' => 'A voltage spike damaged the communication circuitry on one or both boards.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the circuit breaker for 5 minutes and restore power. A transient communication fault may clear.' ],
                    [ 'title' => 'Check harness connections',         'description' => 'If accessible, inspect the inter-board harness connectors behind the control panel for looseness or visible corrosion.' ],
                ],
                '_ar_when_to_call'   => "Persistent C-A1 requires a technician to identify which board has failed. Diagnosis typically uses service mode to isolate the non-communicating module.",
                '_ar_cost_range'     => '$140 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'Is C-A1 the same as CA1 on a Samsung range?', 'answer' => 'Yes — both notations represent the same communication fault. CA1 is how it appears on some Samsung display panels that omit the hyphen in the code display.' ],
                    [ 'question' => 'Can a power surge cause Samsung range C-A1?', 'answer' => 'Yes — C-A1 is a common post-surge code. If it appeared after a power event, the main board or display board communication circuit may have been damaged.' ],
                ],
            ],
        ],

        // ── C-A2 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range C-A2 Error Code',
            'slug'       => 'samsung-range-ca2-error-code',
            'meta_title' => 'Samsung Range C-A2 / CA2 Error Code — Secondary Communication Fault',
            'meta_desc'  => 'Samsung range C-A2 means the main board lost communication with a secondary control module. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'C-A2',
                '_ar_code_meaning'   => "The C-A2 error code on a Samsung range (also displayed as CA2) is a secondary communication fault — closely related to C-A1 but typically indicating a fault between the main board and a different sub-module, such as the cooktop induction board or a secondary control processor. On some models C-A2 is a follow-on to C-A1 when multiple communication paths are affected.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Cooktop Control Module',     'description' => 'On induction ranges, the cooktop induction board has stopped communicating with the main PCB.' ],
                    [ 'title' => 'Damaged Communication Harness',     'description' => 'The harness between the main board and the secondary module is damaged or has a broken wire.' ],
                    [ 'title' => 'Main PCB Communication Circuit Failure', 'description' => 'The main board has multiple communication channels; C-A2 indicates a different channel has failed than C-A1.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the circuit breaker for 5 minutes. Restore power and test. If C-A2 clears and does not return, the fault was a transient communication error.' ],
                ],
                '_ar_when_to_call'   => "C-A2 that persists after a power reset requires a technician to isolate the non-communicating module via service diagnostics.",
                '_ar_cost_range'     => '$140 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung range C-A1 and C-A2?', 'answer' => 'Both are communication faults between the main board and secondary modules. C-A1 typically involves the display or first sub-board; C-A2 involves a different secondary module such as the cooktop control board. The repair approach is the same — isolate and replace the failed board.' ],
                ],
            ],
        ],

        // ── E-08 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-08 Error Code',
            'slug'       => 'samsung-range-e08-error-code',
            'meta_title' => 'Samsung Range E-08 Error Code — Key Input Fault',
            'meta_desc'  => 'Samsung range E-08 indicates a key input or touchpad communication fault. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-08',
                '_ar_code_meaning'   => "The E-08 error code on a Samsung range indicates a key input circuit fault — the control board has detected an error in the touchpad key detection circuit. E-08 differs from SE (which indicates a specific shorted key) in that it reflects a communication or scan fault in the input circuit rather than a single stuck button.",
                '_ar_causes'         => [
                    [ 'title' => 'Touchpad Membrane Fault',           'description' => 'The touchpad membrane has failed in a way that disrupts the key scan circuit rather than triggering a single key.' ],
                    [ 'title' => 'Display Board Key Input Circuit',   'description' => 'The key detection circuit on the display or UI board has failed.' ],
                    [ 'title' => 'Harness Connection to Touchpad',    'description' => 'The ribbon cable or connector between the touchpad and the control board has loosened.' ],
                    [ 'title' => 'Power Surge Damage',                'description' => 'A surge damaged the input detection circuit on the board.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the circuit breaker for 60 seconds. A transient circuit fault may clear.' ],
                    [ 'title' => 'Clean and inspect the control panel', 'description' => 'Clean around all touchpad buttons. Press each button and release to ensure none are physically stuck. Inspect for moisture or grease infiltration.' ],
                ],
                '_ar_when_to_call'   => "If E-08 persists, the display board or touchpad membrane requires replacement. A technician can confirm which component has failed.",
                '_ar_cost_range'     => '$120 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung range E-08 the same as SE?', 'answer' => 'They are related but distinct — SE indicates a specific key is stuck or shorted, while E-08 indicates a fault in the key input scan circuit. Both can result from the same touchpad membrane failure, but E-08 can also indicate a board-level circuit fault.' ],
                ],
            ],
        ],

        // ── E-0A ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-0A Error Code',
            'slug'       => 'samsung-range-e0a-error-code',
            'meta_title' => 'Samsung Range E-0A Error Code — Power Supply Fault',
            'meta_desc'  => 'Samsung range E-0A indicates the control board detected an abnormal power supply condition. Learn what causes it and how to respond.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-0A',
                '_ar_code_meaning'   => "The E-0A error code on a Samsung range indicates a power supply or power management fault detected by the main control board. The board monitors supply voltage and internal power rails. When a reading falls outside acceptable parameters — either from an external supply issue or an internal power circuit failure — E-0A is displayed and the range halts operation.",
                '_ar_causes'         => [
                    [ 'title' => 'Supply Voltage Abnormality',        'description' => 'The incoming AC supply voltage is too high or too low for safe operation.' ],
                    [ 'title' => 'Internal Power Board Fault',        'description' => 'The power supply board that converts AC to the DC voltages used by the control electronics has failed.' ],
                    [ 'title' => 'Main Board Power Regulation Fault', 'description' => 'A voltage regulator on the main control board has failed, causing internal power rail voltage to fall out of range.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check the circuit breaker',         'description' => 'Verify the range circuit breaker is fully on and the outlet voltage is normal. A half-tripped breaker can cause abnormal voltage conditions.' ],
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the breaker for 5 minutes and restore. If E-0A appeared from a transient power event, it may clear.' ],
                ],
                '_ar_when_to_call'   => "Persistent E-0A requires a technician to test supply voltage and internal board power rails to determine whether the fault is external (electrical supply) or internal (power board or main board).",
                '_ar_cost_range'     => '$130 – $360',
                '_ar_faqs'           => [
                    [ 'question' => 'Can a power surge cause Samsung range E-0A?', 'answer' => 'Yes — a surge can damage the power supply board or main board power circuits, causing E-0A. If the code appeared after a power event, surge damage is the most likely cause.' ],
                ],
            ],
        ],

        // ── E-11 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-11 Error Code',
            'slug'       => 'samsung-range-e11-error-code',
            'meta_title' => 'Samsung Range E-11 Error Code — Humidity Sensor Fault',
            'meta_desc'  => 'Samsung range E-11 means the humidity or steam sensor has failed. Learn what functions are affected and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-11',
                '_ar_code_meaning'   => "The E-11 error code on a Samsung range indicates a humidity or steam sensor fault. Samsung ovens with sensor cooking functions (steam cook, auto-roast) use a humidity sensor to detect moisture levels inside the cavity and adjust cooking time and temperature automatically. When this sensor fails or returns an out-of-range reading, E-11 is displayed.\n\nE-11 disables sensor-based cooking modes but typically does not prevent manual baking or broiling.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Humidity Sensor',            'description' => 'The sensor module has failed electrically, returning an out-of-range signal.' ],
                    [ 'title' => 'Sensor Contamination',              'description' => 'Grease or residue has coated the sensor, interfering with its humidity detection.' ],
                    [ 'title' => 'Sensor Wiring Fault',               'description' => 'A broken wire or loose connector in the sensor harness.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the circuit breaker for 5 minutes. A one-time sensor read error may clear.' ],
                    [ 'title' => 'Clean the oven cavity',             'description' => 'Run the self-clean cycle or thoroughly clean the oven interior. Grease buildup near the sensor can cause E-11.' ],
                ],
                '_ar_when_to_call'   => "If E-11 persists after cleaning, the humidity sensor requires replacement. A technician can access and replace the sensor and confirm the wiring harness is intact.",
                '_ar_cost_range'     => '$90 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still bake with Samsung range E-11?', 'answer' => 'In most cases yes — E-11 disables sensor-assisted cooking modes but manual bake and broil functions typically continue to work. Verify your specific model\'s behavior before use.' ],
                ],
            ],
        ],

        // ── E-12 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-12 Error Code',
            'slug'       => 'samsung-range-e12-error-code',
            'meta_title' => 'Samsung Range E-12 Error Code — Secondary Sensor or Communication Fault',
            'meta_desc'  => 'Samsung range E-12 indicates a secondary sensor or board communication fault. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-12',
                '_ar_code_meaning'   => "The E-12 error code on a Samsung range indicates a secondary sensor or inter-board communication fault. On models with multiple oven sensors (broil probe, secondary cavity sensor) or dual-oven configurations, E-12 reflects a fault detected by the control board in a secondary measurement circuit. The specific component varies by model.",
                '_ar_causes'         => [
                    [ 'title' => 'Secondary Temperature Probe Fault', 'description' => 'A secondary oven probe (broil or upper cavity sensor) has failed open or shorted.' ],
                    [ 'title' => 'Inter-Board Communication Error',   'description' => 'On dual-oven or Flex Duo models, communication between the upper and lower oven control circuits has failed.' ],
                    [ 'title' => 'Sensor Wiring Harness Fault',       'description' => 'A harness connector has loosened or a wire has broken.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the circuit breaker for 5 minutes and restore power.' ],
                    [ 'title' => 'Check accessible connectors',       'description' => 'If accessible, inspect sensor and inter-board connectors for looseness.' ],
                ],
                '_ar_when_to_call'   => "E-12 diagnosis requires a technician to identify the specific secondary sensor or communication path at fault using service documentation for the model.",
                '_ar_cost_range'     => '$100 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Is E-12 serious on a Samsung range?', 'answer' => 'It depends on the model and which secondary circuit has failed. A secondary sensor fault may only disable certain cooking modes, while a communication fault on a dual-oven model may disable an entire oven cavity. Schedule service to determine the impact.' ],
                ],
            ],
        ],

        // ── E-13 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-13 Error Code',
            'slug'       => 'samsung-range-e13-error-code',
            'meta_title' => 'Samsung Range E-13 Error Code — Door Lock Fault',
            'meta_desc'  => 'Samsung range E-13 means the door lock motor cannot complete its stroke. Learn the causes and what repair is required.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-13',
                '_ar_code_meaning'   => "The E-13 error code on a Samsung range indicates a door lock fault — the electronic door lock motor used for self-clean cycles has failed to complete its lock or unlock stroke. Samsung ovens with self-clean require the door to lock electronically before the high-temperature cycle begins. When the lock motor cannot reach its locked or unlocked position within the required time, E-13 is displayed and the self-clean cycle is prevented.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Lock Motor',            'description' => 'The motor that drives the locking bolt has burned out or seized.' ],
                    [ 'title' => 'Door Lock Mechanism Obstruction',   'description' => 'Debris, food residue, or a warped door frame is preventing the lock bolt from traveling its full stroke.' ],
                    [ 'title' => 'Door Lock Switch Fault',            'description' => 'The limit switches that confirm lock/unlock position have failed, causing the control board to time out waiting for a confirmation signal.' ],
                    [ 'title' => 'Wiring Harness to Lock Assembly',   'description' => 'A loose connector or broken wire to the door lock motor or position switches.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the door lock area',          'description' => 'Clean the door latch area and the receiver on the oven frame. Food residue can prevent the bolt from moving freely.' ],
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the circuit breaker for 5 minutes. If the lock motor was mid-stroke when power was interrupted, a reset may allow it to return to its home position.' ],
                ],
                '_ar_when_to_call'   => "If E-13 persists after cleaning and a power reset, the door lock motor or position switch assembly requires replacement. This is an internal repair requiring oven disassembly.",
                '_ar_cost_range'     => '$110 – $290',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Samsung range for baking with E-13?', 'answer' => 'In most cases normal baking and broiling are still available — E-13 specifically prevents the self-clean cycle from initiating. Verify normal functions work before relying on the range.' ],
                    [ 'question' => 'Why did E-13 appear after a power outage during self-clean?', 'answer' => 'If power was interrupted mid-cycle, the door may be locked and unable to unlock. A power reset often resolves this — the control board will attempt to return the lock to the home (unlocked) position when power is restored.' ],
                ],
            ],
        ],

        // ── dE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range dE Error Code',
            'slug'       => 'samsung-range-de-error-code',
            'meta_title' => 'Samsung Range dE / dC Error Code — Door Open or Door Switch Fault',
            'meta_desc'  => 'Samsung range dE or dC means the oven door is open or the door switch has failed. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'dE',
                '_ar_code_meaning'   => "The dE error code on a Samsung range (also shown as dC on some models) indicates the oven door is open or the control board cannot confirm the door is closed. Samsung ovens require a door-closed signal from the door switch before starting or continuing a bake or broil cycle. When this signal is absent or lost, dE is displayed and heating is disabled.",
                '_ar_causes'         => [
                    [ 'title' => 'Door Not Fully Closed',             'description' => 'The oven door was not closed firmly enough to engage the latch switch.' ],
                    [ 'title' => 'Failed Door Switch',                'description' => 'The door switch microswitch has failed open, reporting the door as open even when it is properly closed.' ],
                    [ 'title' => 'Worn Door Hinge or Misaligned Door', 'description' => 'Door hinge wear or misalignment prevents the door from seating properly against the switch.' ],
                    [ 'title' => 'Loose Door Switch Wiring',          'description' => 'The connector to the door switch has loosened.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Close door firmly',                 'description' => 'Press the oven door firmly closed until it seats fully. Open and re-close to ensure proper engagement.' ],
                    [ 'title' => 'Inspect door alignment',            'description' => 'With the door open, check that the hinges are seated properly. A slightly lifted door hinge can prevent full switch actuation.' ],
                    [ 'title' => 'Power reset',                       'description' => 'Turn off the circuit breaker for 60 seconds. A transient switch signal error may clear.' ],
                ],
                '_ar_when_to_call'   => "If dE persists with the door properly closed, the door switch requires testing and likely replacement — an internal repair on most Samsung range models.",
                '_ar_cost_range'     => '$70 – $200',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung range dE the same as dC?', 'answer' => 'Yes — dE and dC represent the same door fault on different Samsung firmware versions. The diagnosis and repair are identical.' ],
                    [ 'question' => 'Can Samsung range dE appear mid-cycle?', 'answer' => 'Yes — a worn door switch can maintain contact during normal operation but lose the signal under oven thermal expansion. If dE appears mid-cycle but not at startup, the door switch is intermittently failing.' ],
                ],
            ],
        ],


        // ── E-0B ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-0B Error Code',
            'slug'       => 'samsung-range-e0b-error-code',
            'meta_title' => 'Samsung Range E-0B Error Code — Cooling Fan Fault',
            'meta_desc'  => 'Samsung range E-0B means the oven cooling fan has a fault. Learn what causes it and why the cooling fan is critical for safe oven operation.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-0B',
                '_ar_code_meaning'   => "The E-0B error code on a Samsung range indicates a fault with the oven cooling fan. The cooling fan in a Samsung range is not the convection fan inside the oven cavity — it is a separate fan that cools the control board and electrical components above the oven cavity. It typically runs during and after oven use to protect the electronics from heat damage.\n\nWhen the control board detects that the cooling fan is not running or has stalled, E-0B is triggered. The oven may continue to operate but will shut itself down after a period to prevent electronics overheating.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Cooling Fan Motor',           'description' => 'The fan motor has burned out or the bearings have seized.' ],
                    [ 'title' => 'Fan Blade Obstruction',              'description' => 'Debris has entered the fan housing and is preventing the blade from turning.' ],
                    [ 'title' => 'Wiring Fault to Fan',                'description' => 'A break or loose connector in the fan motor wiring harness.' ],
                    [ 'title' => 'Control Board Fan Driver Fault',     'description' => 'The fan driver circuit on the control board has failed, not supplying voltage to the motor.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds. A transient fan detection fault may clear.' ],
                    [ 'title' => 'Listen for the cooling fan',         'description' => 'Start the oven and listen near the control panel area. You should hear a faint fan noise. Silence after the oven has been running for several minutes suggests the cooling fan is not operating.' ],
                ],
                '_ar_when_to_call'   => "Cooling fan replacement requires accessing the area above the oven cavity, typically through the rear panel or the control panel assembly. This is a technician repair on most Samsung range models.",
                '_ar_cost_range'     => '$110 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Samsung range with E-0B?', 'answer' => 'Short-term use may be possible as the oven has a thermal cutout that will shut it off before electronics are damaged. However, continued use without a working cooling fan will eventually damage the control board. Schedule repair promptly.' ],
                    [ 'question' => 'Is the cooling fan the same as the convection fan?', 'answer' => 'No — the convection fan circulates hot air inside the oven cavity during convection cooking. The cooling fan (E-0B) is a separate component that cools the control electronics above the oven and is not related to cooking function.' ],
                ],
            ],
        ],


        // ── bE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range bE Error Code',
            'slug'       => 'samsung-range-be-error-code',
            'meta_title' => 'Samsung Range bE Error Code — Control Panel Button Fault',
            'meta_desc'  => 'Samsung range bE means a button on the control panel is stuck or shorted. Learn what causes it and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'bE',
                '_ar_code_meaning'   => "The bE error code on a Samsung range indicates a control panel button fault — the control board has detected a key that is stuck mechanically or shorted electrically. On Samsung ranges that display bE rather than SE for this fault, the code typically identifies a specific button failure rather than a general touchpad membrane short. The range halts all functions until the fault is cleared.",
                '_ar_causes'         => [
                    [ 'title' => 'Stuck or Jammed Button',             'description' => 'A push-button has jammed in the pressed position due to food debris, grease buildup, or physical damage.' ],
                    [ 'title' => 'Grease Contamination of the Panel',  'description' => 'Cooking grease seeping behind the control panel membrane or around button housings causes a key to register as permanently pressed.' ],
                    [ 'title' => 'Worn Button Membrane or Switch',     'description' => 'The membrane at a frequently used key has worn through, creating a permanent electrical contact.' ],
                    [ 'title' => 'Control Board Key-Scan Fault',       'description' => 'The key-scanning circuit on the main control board has failed, misreading a button state.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the control panel',            'description' => 'With the range off, wipe down the control panel thoroughly. Use a thin cloth edge to clean around each button. Grease accumulation is a common cause of bE on ranges positioned near the cooktop.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds. A transient button signal fault may clear on restart.' ],
                    [ 'title' => 'Identify the stuck key',             'description' => 'After a reset, press each button one at a time. A key that immediately re-triggers bE has a failed switch or shorted membrane at that location.' ],
                ],
                '_ar_when_to_call'   => "If bE persists after cleaning and reset, the control panel button assembly requires replacement.",
                '_ar_cost_range'     => '$100 – $270',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung range bE the same as SE?', 'answer' => 'They describe the same type of fault — a stuck or shorted control panel key. Some Samsung range models display SE for this fault; others display bE. The diagnosis and repair are identical.' ],
                ],
            ],
        ],

        // ── E-0C ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-0C Error Code',
            'slug'       => 'samsung-range-e0c-error-code',
            'meta_title' => 'Samsung Range E-0C Error Code — Convection Fan Fault',
            'meta_desc'  => 'Samsung range E-0C means the convection fan motor has a fault. Learn what causes it and how convection cooking is affected.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-0C',
                '_ar_code_meaning'   => "The E-0C error code on a Samsung range indicates a fault with the convection fan motor inside the oven cavity. The convection fan circulates hot air throughout the oven during convection bake and convection roast cycles, producing faster and more even cooking. When the control board detects that the convection fan is not running at the expected speed or has stalled, E-0C is triggered.\n\nE-0C disables convection cooking modes but standard bake and broil cycles (which do not use the convection fan) may still operate depending on the model.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Convection Fan Motor',        'description' => 'The fan motor inside the oven cavity has burned out or the bearings have seized.' ],
                    [ 'title' => 'Fan Blade Obstruction',              'description' => 'A foreign object inside the oven cavity — a piece of foil or a utensil — has contacted the fan blade.' ],
                    [ 'title' => 'Wiring Fault to Fan Motor',          'description' => 'A break or loose connector in the convection fan motor wiring harness.' ],
                    [ 'title' => 'Control Board Fan Driver Fault',     'description' => 'The motor driver circuit on the control board has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Inspect the oven cavity for obstructions', 'description' => 'Open the oven and look at the convection fan cover on the rear wall. Confirm no foil, food debris, or utensil is touching the fan blade area. Remove any obstruction and test.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds. A transient motor detection fault may clear.' ],
                ],
                '_ar_when_to_call'   => "Convection fan motor replacement requires access to the rear of the oven cavity, involving removal of the fan cover and element. This is a technician repair on most Samsung range models.",
                '_ar_cost_range'     => '$120 – $300',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I bake normally with Samsung range E-0C?', 'answer' => 'Standard bake and broil modes that do not use the convection fan may still work. However, E-0C should be repaired promptly — a seized fan motor can overheat and cause additional damage.' ],
                    [ 'question' => 'How do I know if my Samsung range has a convection fan?', 'answer' => 'Most Samsung electric ranges sold in the USA have a convection fan. You can see the fan cover (a round metal disc with slots) on the rear interior wall of the oven cavity.' ],
                ],
            ],
        ],

        // ── E-14 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-14 Error Code',
            'slug'       => 'samsung-range-e14-error-code',
            'meta_title' => 'Samsung Range E-14 Error Code — Secondary Oven Temperature Sensor Fault',
            'meta_desc'  => 'Samsung range E-14 means the secondary oven temperature sensor has a fault. Learn what it monitors and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-14',
                '_ar_code_meaning'   => "The E-14 error code on a Samsung range indicates a fault with a secondary oven temperature sensor. In addition to the primary oven temperature probe (monitored by E-11), some Samsung range models use a secondary sensor to verify oven temperature or to monitor a specific zone. E-14 is triggered when this secondary sensor reads outside the acceptable resistance range.\n\nOn dual-oven models and ranges with upper and lower heating zones, E-14 identifies the secondary cavity sensor rather than the primary probe.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Secondary Temperature Sensor', 'description' => 'The sensor probe has developed an open or short circuit.' ],
                    [ 'title' => 'Wiring Fault to Secondary Sensor',   'description' => 'The wiring harness to the secondary sensor has a break or corroded connector.' ],
                    [ 'title' => 'Control Board Sensor Input Fault',   'description' => 'The secondary sensor input circuit on the control board has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds. A transient sensor reading fault may clear.' ],
                    [ 'title' => 'Test secondary sensor resistance',   'description' => 'With power off, locate and disconnect the secondary sensor. At room temperature, test resistance across the sensor terminals. A healthy Samsung temperature sensor reads approximately 1,080 ohms. Infinite or near-zero confirms sensor failure.' ],
                ],
                '_ar_when_to_call'   => "Secondary sensor replacement requires identifying the sensor's location (varies by model) and accessing it through the oven cavity or rear panel. A technician can locate and replace the correct sensor.",
                '_ar_cost_range'     => '$90 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung range E-11 and E-14?', 'answer' => 'E-11 involves the primary oven temperature sensor — the main probe used for all baking and broiling temperature control. E-14 involves a secondary sensor used for verification or zone monitoring. Both require sensor testing and possible replacement.' ],
                ],
            ],
        ],

        // ── E-15 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Range E-15 Error Code',
            'slug'       => 'samsung-range-e15-error-code',
            'meta_title' => 'Samsung Range E-15 Error Code — Oven Temperature Limit Sensor Fault',
            'meta_desc'  => 'Samsung range E-15 means the oven temperature limit or thermal cutout sensor has a fault. Learn the causes and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven / Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven / Range',
                '_ar_error_code'     => 'E-15',
                '_ar_code_meaning'   => "The E-15 error code on a Samsung range indicates a fault with the oven temperature limit sensor or thermal cutout circuit. Beyond the primary temperature probe, Samsung ranges include a thermal limit sensor that serves as a safety backup — it triggers if the oven exceeds a safe threshold independently of the main sensor. E-15 appears when the control board detects an abnormal reading from this thermal limit circuit.\n\nE-15 is a safety-related code. Do not continue using the oven until E-15 is diagnosed and resolved.",
                '_ar_causes'         => [
                    [ 'title' => 'Tripped Thermal Cutout',             'description' => 'The thermal cutout has opened after a previous overtemperature event. The cutout requires manual reset or replacement.' ],
                    [ 'title' => 'Failed Thermal Limit Sensor',        'description' => 'The sensor element has failed and is reading outside its valid range.' ],
                    [ 'title' => 'Wiring Fault in Thermal Circuit',    'description' => 'A break or loose connection in the thermal limit sensor wiring.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Allow full cooldown',                'description' => 'If E-15 appeared during or after a high-temperature cycle or self-clean, allow the oven to cool completely (2+ hours) before any further steps.' ],
                    [ 'title' => 'Power reset after cooldown',         'description' => 'Turn off the circuit breaker for 60 seconds after cooling. Some thermal cutouts reset automatically on full cooldown — E-15 may clear.' ],
                ],
                '_ar_when_to_call'   => "If E-15 persists or recurs, the thermal limit sensor or cutout requires professional testing and replacement. Do not bypass or ignore this code — it is a safety circuit.",
                '_ar_cost_range'     => '$100 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung range E-15 dangerous?', 'answer' => 'E-15 indicates a fault in the oven\'s safety temperature circuit. A tripped cutout means the oven previously reached a dangerous temperature. A failed sensor means the safety backup is not functioning. In either case, do not use the oven until E-15 is resolved.' ],
                    [ 'question' => 'Does E-15 appear after self-clean on a Samsung range?', 'answer' => 'Yes — self-clean cycles run at high temperatures and can trip the thermal cutout on ranges where the cutout is marginal. If E-15 appears only after self-clean and clears after full cooldown, the thermal cutout may be borderline and should be inspected.' ],
                ],
            ],
        ],

        // ── C-21 (Oven/Range) ────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Oven Range C-21 Error Code',
            'slug'       => 'samsung-range-c21-error-code',
            'meta_title' => 'Samsung Oven/Range C-21 Error Code — Upper Oven Sensor Fault',
            'meta_desc'  => 'Samsung range C-21 means the upper oven temperature sensor is open or shorted. Learn what causes it and how to diagnose and replace the sensor.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven/Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven/Range',
                '_ar_error_code'     => 'C-21',
                '_ar_code_meaning'   => "The C-21 error code on a Samsung oven or range indicates a fault with the upper oven cavity temperature sensor (also called the oven sensor or RTD sensor). The control board monitors the sensor's resistance to track oven temperature. C-21 triggers when the sensor circuit reads outside the expected resistance range — either an open circuit (broken sensor wire or disconnected connector) or a short circuit (sensor damaged or wiring shorted to chassis).\n\nC-21 prevents the upper oven from operating because the control board cannot regulate temperature without a functioning sensor. The oven will not heat to setpoint and may display the error immediately on preheat or during the cycle.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Upper Oven Temperature Sensor', 'description' => 'The RTD temperature sensor probe inside the upper oven cavity has failed — either an internal open circuit or a short. Sensor failure is the most common cause of C-21 and is confirmed by testing the sensor resistance with a multimeter (a good Samsung oven sensor reads approximately 1,080–1,090 ohms at room temperature).' ],
                    [ 'title' => 'Disconnected or Damaged Sensor Wiring', 'description' => 'The two-wire harness connecting the sensor probe to the control board can pull loose from the sensor connector, especially after the oven has been moved or serviced. A damaged wire with a broken conductor also triggers C-21.' ],
                    [ 'title' => 'Wiring Harness Short to Chassis',    'description' => 'If the sensor wiring contacts the oven cavity wall or a metal bracket, a ground short creates an out-of-range resistance reading and triggers C-21.' ],
                    [ 'title' => 'Faulty Main Control Board',           'description' => "In rare cases, the control board's sensor input circuit fails and misreads a good sensor as open or shorted. This is the least common cause and is only suspected after the sensor and wiring are confirmed good." ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Locate and inspect the upper oven sensor', 'description' => 'The upper oven sensor is typically a small probe mounted on the back wall inside the oven cavity, held by one or two screws. With the oven unplugged, remove the screws and gently pull the sensor forward to access its connector.' ],
                    [ 'title' => 'Test the sensor resistance',          'description' => 'Disconnect the sensor connector and test across the two sensor terminals with a multimeter set to ohms. At room temperature (70°F / 21°C), a healthy Samsung oven sensor reads approximately 1,080–1,090 ohms. A reading of 0 (shorted) or OL/infinity (open) confirms sensor failure.' ],
                    [ 'title' => 'Inspect wiring from sensor to control board', 'description' => 'Trace the sensor harness from the sensor probe to the control board connector. Check for pinched, burnt, or broken wires and ensure all connector pins seat fully. Reseat the connector at both ends.' ],
                ],
                '_ar_when_to_call'   => "If the sensor tests within spec and wiring is intact, the main control board requires professional diagnosis. Control board replacement on a range involves high-voltage components and should be performed by a certified technician.",
                '_ar_cost_range'     => '$90 – $310',
                '_ar_faqs'           => [
                    [ 'question' => 'What resistance should a Samsung oven sensor read?', 'answer' => 'A healthy Samsung oven temperature sensor reads approximately 1,080–1,090 ohms at room temperature (around 70°F / 21°C). The resistance increases as temperature rises. A reading of zero or infinite ohms confirms the sensor has failed.' ],
                    [ 'question' => 'Can I use my Samsung range with C-21 showing?', 'answer' => 'The upper oven will not operate with C-21 active. The control board disables oven heating when it cannot read a valid temperature, preventing uncontrolled heating. Surface burners on a gas or electric range are typically unaffected.' ],
                    [ 'question' => 'Is C-21 the same fault as C-A1 on Samsung ranges?', 'answer' => 'No — C-A1 indicates a short circuit in the oven sensor (resistance too low), while C-21 specifically indicates the upper oven sensor is open or out of the expected resistance window. Both involve the temperature sensor but represent different failure modes.' ],
                ],
            ],
        ],

        // ── C-22 (Oven/Range) ────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Oven Range C-22 Error Code',
            'slug'       => 'samsung-range-c22-error-code',
            'meta_title' => 'Samsung Oven/Range C-22 Error Code — Lower Oven Sensor Fault',
            'meta_desc'  => 'Samsung range C-22 means the lower oven temperature sensor is open or out of range. Learn how to test and replace the lower oven sensor.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven/Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven/Range',
                '_ar_error_code'     => 'C-22',
                '_ar_code_meaning'   => "The C-22 error code on a Samsung oven or range indicates a fault with the lower oven cavity temperature sensor on double-oven models, or the broil/lower heating zone sensor on applicable configurations. The control board reads the sensor's resistance to regulate temperature. C-22 triggers when the sensor circuit returns an open or out-of-range resistance reading, preventing the lower oven or heating zone from operating safely.\n\nC-22 is the lower-oven counterpart to C-21 (upper oven sensor fault). On single-oven ranges, C-22 may refer to a secondary sensor used for the broil or bake element zone depending on the model's sensor configuration.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Lower Oven Temperature Sensor', 'description' => 'The RTD probe in the lower oven cavity has developed an open or short circuit internally. At room temperature, the sensor should read approximately 1,080–1,090 ohms — any significant deviation confirms failure.' ],
                    [ 'title' => 'Disconnected Sensor Harness',         'description' => 'The sensor connector has pulled free from the probe or from the control board, creating an open circuit in the sensor loop. This is especially common after service work or after the range has been transported.' ],
                    [ 'title' => 'Burnt or Pinched Sensor Wiring',      'description' => 'The sensor wires run through the oven cavity area and are exposed to high heat. Over time, wire insulation can degrade, causing a short or open that the control board reads as C-22.' ],
                    [ 'title' => 'Control Board Sensor Input Failure',  'description' => 'The control board circuit that reads the lower sensor input can fail independently of the sensor. If the sensor and wiring test good, the board is the suspected cause.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Access the lower oven sensor',        'description' => 'Unplug the range. Open the lower oven door and locate the temperature sensor probe on the back wall of the lower cavity. Remove the mounting screws and slide the sensor forward to reach the wire connector behind the back wall.' ],
                    [ 'title' => 'Test sensor resistance',              'description' => 'Disconnect the two-wire connector and measure resistance across the sensor terminals with a multimeter. A good sensor reads 1,080–1,090 ohms at room temperature. Replace the sensor if the reading is 0 or OL.' ],
                    [ 'title' => 'Check wiring continuity',             'description' => 'With the sensor disconnected, use a multimeter to test continuity along each wire from the sensor connector back to the control board connector. No continuity on either wire indicates a broken wire that needs repair or harness replacement.' ],
                ],
                '_ar_when_to_call'   => "If sensor and wiring both test good and C-22 persists, the control board requires professional diagnosis. Do not operate the lower oven with C-22 active — the heating element runs without temperature regulation when the sensor circuit is open.",
                '_ar_cost_range'     => '$90 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between C-21 and C-22 on a Samsung range?', 'answer' => 'C-21 is an upper oven sensor fault and C-22 is a lower oven sensor fault. On double-oven Samsung ranges, each oven cavity has its own dedicated temperature sensor. The codes identify which sensor circuit has failed.' ],
                    [ 'question' => 'Can the upper oven still work when C-22 shows?', 'answer' => 'On double-oven models, yes — C-22 affects only the lower oven sensor circuit. The upper oven typically continues to operate normally. The lower oven will not heat until C-22 is resolved.' ],
                    [ 'question' => 'How long does a Samsung oven temperature sensor last?', 'answer' => 'Under normal use, Samsung oven sensors typically last 7–12 years. Running the self-clean cycle frequently accelerates sensor degradation because self-clean temperatures (around 900°F) stress the sensor element more than normal baking temperatures.' ],
                ],
            ],
        ],

        // ── C-23 (Oven/Range) ────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Oven Range C-23 Error Code',
            'slug'       => 'samsung-range-c23-error-code',
            'meta_title' => 'Samsung Oven/Range C-23 Error Code — Cooling Fan Sensor Fault',
            'meta_desc'  => 'Samsung range C-23 signals a cooling fan or third sensor circuit fault. Learn the causes, how to test the sensor, and when to call a technician.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Oven/Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Oven/Range',
                '_ar_error_code'     => 'C-23',
                '_ar_code_meaning'   => "The C-23 error code on a Samsung oven or range indicates a fault in a third temperature sensor circuit — typically the cooling fan area sensor or an auxiliary cavity sensor used on specific double-oven and slide-in range models. The control board monitors this sensor to track temperatures in the control electronics compartment or a secondary zone. C-23 triggers when the sensor returns an open or out-of-range resistance reading.\n\nOn models where C-23 monitors the cooling fan sensor, the error may also appear if the cooling fan itself has seized or failed — causing the electronics bay to overheat and trigger the thermal protection circuit. The oven will halt operation to prevent control board heat damage.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Auxiliary Temperature Sensor', 'description' => 'The third sensor circuit — whether monitoring the cooling area, broil zone, or secondary cavity — has developed an open or short circuit. Testing with a multimeter confirms sensor resistance out of the expected 1,080–1,090 ohm range at room temperature.' ],
                    [ 'title' => 'Seized or Failed Cooling Fan',        'description' => 'The cooling fan that circulates air over the control board electronics has seized due to a failed bearing or motor. Without airflow, the electronics bay overheats and the thermal sensor triggers C-23 as a protection measure.' ],
                    [ 'title' => 'Sensor Wiring Fault',                 'description' => 'A broken, pinched, or shorted wire in the sensor harness creates an invalid resistance reading at the control board. Wiring faults in the electronics bay area can also occur from heat exposure over time.' ],
                    [ 'title' => 'Main Control Board Fault',            'description' => "If the sensor and wiring test correctly, the control board's input circuit for this sensor channel may have failed, generating a false C-23 code." ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Identify the sensor location for your model', 'description' => 'Check your specific Samsung range model number against the service manual. C-23 sensor location varies by model — it may be in the upper rear of the oven cavity, in the electronics compartment above the oven, or along the cooling duct. The model-specific wiring diagram (inside the back access panel) identifies the exact sensor.' ],
                    [ 'title' => 'Check the cooling fan operation',     'description' => 'With the oven running, listen and feel for airflow from the cooling vents (typically at the rear top of the range). No airflow indicates the cooling fan has stopped. A failed cooling fan is a straightforward replacement — access it from the rear panel.' ],
                    [ 'title' => 'Test the sensor resistance',          'description' => 'Disconnect the suspect sensor connector and test resistance with a multimeter. The expected reading at room temperature is approximately 1,080–1,090 ohms for Samsung RTD sensors. Replace the sensor if the reading is outside this range.' ],
                ],
                '_ar_when_to_call'   => "C-23 involving the control electronics cooling circuit can lead to control board heat damage if the fan has failed and the oven continues to run. Call a certified technician promptly if the cooling fan is the suspected cause, or if C-23 persists after sensor replacement.",
                '_ar_cost_range'     => '$100 – $340',
                '_ar_faqs'           => [
                    [ 'question' => 'What does C-23 mean on a Samsung double oven range?', 'answer' => 'On double-oven Samsung ranges, C-23 typically refers to an auxiliary sensor in the lower oven zone or the shared electronics compartment between the two cavities. Identify your exact sensor location using the wiring diagram on the back panel of your specific model.' ],
                    [ 'question' => 'Can I reset C-23 on my Samsung range?', 'answer' => 'You can attempt a reset by unplugging the range for 5 minutes. If C-23 returns immediately on power-up, the sensor or cooling fan requires physical inspection and replacement — the fault is not transient.' ],
                    [ 'question' => 'Is C-23 related to C-21 and C-22 on Samsung ranges?', 'answer' => 'Yes — C-21, C-22, and C-23 are sequential sensor fault codes on Samsung ranges. C-21 = upper oven sensor, C-22 = lower oven sensor, C-23 = third sensor circuit (cooling fan area or auxiliary zone). All three use the same RTD sensor type and share the same diagnostic process.' ],
                ],
            ],
        ],

    ]; // end ar_error_codes_samsung_oven_range()
}

// ─────────────────────────────────────────────────────────────────────────────
// MICROWAVE ERROR CODES
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_samsung_microwave(): array {
    return [

        // ── SE ────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave SE Error Code',
            'slug'       => 'samsung-microwave-se-error-code',
            'meta_title' => 'Samsung Microwave SE Error Code — Touchpad Fault Causes & Fix',
            'meta_desc'  => 'Samsung microwave SE or -SE- error means the control touchpad has failed. Learn the causes, whether you can fix it yourself, and typical repair costs.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'SE',
                '_ar_code_meaning'   => "The SE error on a Samsung microwave (also displayed as -SE- on some models) indicates that the control board has detected a shorted or continuously-active key on the touchpad membrane. The microwave stops responding to commands and displays SE continuously.\n\nSE is one of Samsung's most widely reported microwave faults, affecting both over-the-range and countertop models. It most commonly occurs after steam or moisture exposure from cooking — condensation infiltrates the touchpad membrane layer, causing one or more touch zones to register as permanently pressed.",
                '_ar_causes'         => [
                    [ 'title' => 'Moisture / Steam Infiltration',    'description' => 'Condensation from cooking seeps into the touchpad membrane, bridging the printed circuits and causing one or more keys to register as permanently active. This is the most common SE trigger on Samsung over-the-range models positioned over a cooktop.' ],
                    [ 'title' => 'Touchpad Membrane Wear',           'description' => 'After years of use, the conductive layer in the membrane can delaminate or develop micro-cracks, causing false key detections. Wear typically starts at the most frequently used keys.' ],
                    [ 'title' => 'Control Board Fault',              'description' => 'Less commonly, the control board itself develops a fault on the key-scanning circuit, triggering SE even with an intact membrane. Board faults are confirmed by replacing the membrane first — if SE persists with a new membrane, the board is implicated.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Perform a power reset',            'description' => 'Unplug the microwave from the wall outlet (or switch off its dedicated circuit breaker for over-the-range models). Wait 60 seconds. Restore power. If SE clears and does not return after several uses, the fault was transient — moisture has dried out.' ],
                    [ 'title' => 'Allow the unit to dry out',        'description' => 'If SE appears after heavy cooking, unplug and leave the microwave door open in a well-ventilated area for several hours. Some SE errors caused by condensation resolve after the touchpad fully dries.' ],
                    [ 'title' => 'Test which key is shorted',        'description' => 'If SE clears after reset but returns quickly, press keys one at a time to identify if a specific key triggers it. This helps the technician confirm touchpad vs board fault.' ],
                ],
                '_ar_when_to_call'   => "If SE returns after a reset and drying period, the touchpad membrane has permanently failed and requires replacement. Note: internal microwave work must only be performed by a certified technician due to the high-voltage capacitor that retains a lethal charge even when unplugged.",
                '_ar_cost_range'     => '$90 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Samsung microwave while it shows SE?',       'answer' => 'No. The SE error means the control system is not functioning correctly — the microwave may not respond to commands, may start unexpectedly, or may not operate safely. Stop using it until the SE fault is repaired.' ],
                    [ 'question' => 'Why does my Samsung microwave show SE after cooking?',    'answer' => 'Steam from boiling water or cooking rises into the microwave cavity and can condense on the touchpad membrane. Over-the-range models directly above a cooktop are especially prone to this. If SE appears only after heavy steaming and clears after drying, the membrane is degrading and will eventually fail permanently.' ],
                    [ 'question' => 'Is the Samsung microwave SE error covered under warranty?', 'answer' => 'If your microwave is within Samsung\'s manufacturer warranty period, contact Samsung support before arranging third-party repair — the SE error may qualify for a warranty claim if there is no physical damage. For out-of-warranty repairs, all work we perform is backed by our 30-day parts and labor warranty.' ],
                ],
            ],
        ],

        // ── E-11 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-11 Error Code',
            'slug'       => 'samsung-microwave-e11-error-code',
            'meta_title' => 'Samsung Microwave E-11 Error Code — Humidity Sensor Fault',
            'meta_desc'  => 'Samsung microwave E-11 means the humidity (moisture) sensor used for Sensor Cook mode has a fault. Learn what it affects and when to call for service.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-11',
                '_ar_code_meaning'   => "The E-11 error code on a Samsung microwave indicates a fault with the humidity or moisture sensor used by the Sensor Cook / Auto Cook functions. Samsung microwaves with sensor cooking use a humidity sensor to detect steam emitted by food and automatically adjust cooking time and power level.\n\nE-11 disables sensor cook modes but does not prevent the microwave from operating in manual mode (setting time and power level directly). It is less urgent than SE but should be addressed to restore full functionality.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Humidity Sensor',          'description' => 'The cavity humidity sensor has failed or its resistance has drifted out of specification.' ],
                    [ 'title' => 'Grease or Food Residue on Sensor', 'description' => 'A thick layer of grease or food splatter on the sensor surface can interfere with humidity detection, causing E-11.' ],
                    [ 'title' => 'Wiring Fault to Sensor',          'description' => 'The sensor wiring harness has developed a fault.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the microwave cavity',      'description' => 'Wipe down the full interior cavity, paying special attention to the ceiling and side walls where the humidity sensor port is typically located (usually a small grill or vent). Use a damp cloth to remove grease buildup over the sensor area.' ],
                    [ 'title' => 'Perform a power reset',           'description' => 'Unplug for 60 seconds and restore power. If E-11 was caused by a temporary sensor reading during a high-steam cooking event, a reset may clear it.' ],
                ],
                '_ar_when_to_call'   => "If E-11 persists after cleaning and reset, the humidity sensor has failed and requires replacement. Sensor replacement requires opening the microwave cabinet — this must be performed by a certified technician due to the high-voltage capacitor inside.",
                '_ar_cost_range'     => '$100 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still use my Samsung microwave with E-11?', 'answer' => 'Yes — manual cooking modes (entering time and power level directly) continue to function with E-11. Only Sensor Cook / Auto Cook modes are disabled. If you rarely use sensor cooking, E-11 can be addressed at your convenience.' ],
                    [ 'question' => 'Does E-11 mean my Samsung microwave is not heating?', 'answer' => 'No. E-11 is specific to the humidity sensor used for auto-cooking features. The magnetron and core heating system are unaffected. The microwave heats normally in manual mode.' ],
                    [ 'question' => 'Can grease buildup cause Samsung microwave E-11?', 'answer' => 'Yes — a thick grease layer over the humidity sensor port can prevent steam from reaching the sensor, causing inaccurate readings and E-11. Regular cavity cleaning prevents this. Clean the cavity interior every 2–4 weeks depending on use.' ],
                ],
            ],
        ],

        // ── E-60 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-60 Error Code',
            'slug'       => 'samsung-microwave-e60-error-code',
            'meta_title' => 'Samsung Microwave E-60 Error Code — Magnetron or High-Voltage Fault',
            'meta_desc'  => 'Samsung microwave E-60 points to a magnetron or high-voltage circuit fault. Learn why professional repair is essential for this code.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-60',
                '_ar_code_meaning'   => "The E-60 error code on a Samsung microwave indicates a fault in the magnetron or high-voltage power circuit. This error is triggered when the microwave's protection circuitry detects an abnormal condition in the high-voltage system — which includes the magnetron, the high-voltage transformer, the capacitor, and the high-voltage diode.\n\nE-60 typically means the microwave will run (display works, door opens/closes) but produces no heat. This is one of the more serious Samsung microwave error codes and always requires professional service due to the lethal high-voltage components involved.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Magnetron',                'description' => 'The magnetron — the component that generates microwave energy — has failed. This is the most expensive component and its failure is confirmed after the high-voltage diode and capacitor test correctly.' ],
                    [ 'title' => 'Failed High-Voltage Diode',       'description' => 'The HV diode rectifies the transformer output. A shorted or open diode prevents the magnetron from receiving correct voltage, triggering E-60. Diode failure is more common than magnetron failure and less expensive to repair.' ],
                    [ 'title' => 'Failed High-Voltage Capacitor',   'description' => 'The HV capacitor stores and releases charge in the magnetron circuit. A failed capacitor disrupts the circuit and triggers E-60.' ],
                    [ 'title' => 'Failed High-Voltage Transformer', 'description' => 'The transformer that steps up household voltage to the high voltage required by the magnetron can fail, cutting the magnetron supply.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Do NOT open the microwave yourself', 'description' => 'The high-voltage capacitor inside a microwave can store a charge of 2,100 volts or more — enough to be fatal — even hours after the unit is unplugged. Do not open the cabinet for any reason. Contact a certified technician.' ],
                    [ 'title' => 'Confirm the symptom',              'description' => 'Start the microwave on full power with a cup of water. If the display counts down and the turntable spins but the water remains cold after 1 minute, E-60 is producing a no-heat condition. Do not continue testing — call for service.' ],
                ],
                '_ar_when_to_call'   => "E-60 always requires a certified technician. The HV diode is tested first (least expensive component) — if it passes, the capacitor and transformer are tested. The magnetron is replaced last (most expensive). On older or budget models, the repair cost may approach replacement cost — a technician can advise on repair vs. replace economics.",
                '_ar_cost_range'     => '$120 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'Is E-60 dangerous on a Samsung microwave?', 'answer' => 'The E-60 fault itself is not immediately dangerous during normal use (the microwave simply does not heat). However, attempting DIY repair of the high-voltage circuit is extremely dangerous. The capacitor inside retains a lethal charge even after unplugging. Always have this repaired by a trained technician.' ],
                    [ 'question' => 'How long do Samsung microwave magnetrons last?', 'answer' => 'Samsung magnetrons typically last 8–12 years under normal use. Heavy use (4+ long cooking sessions per day) or arcing events (metal in the microwave, damaged waveguide cover) can shorten magnetron life significantly.' ],
                    [ 'question' => 'Is it worth replacing a magnetron in a Samsung microwave?', 'answer' => 'For over-the-range Samsung microwaves (typically $400–$900 to replace), magnetron replacement at $250–$380 is usually worthwhile if the unit is under 10 years old and in otherwise good condition. For countertop models under $200, replacement is typically more economical.' ],
                ],
            ],
        ],

        // ── E-13 ──────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-13 Error Code',
            'slug'       => 'samsung-microwave-e13-error-code',
            'meta_title' => 'Samsung Microwave E-13 Error Code — Humidity Sensor Fault',
            'meta_desc'  => 'Samsung microwave E-13 means the humidity (moisture) sensor has failed. Learn how it affects sensor cooking and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-13',
                '_ar_code_meaning'   => "The E-13 error code on a Samsung microwave indicates a humidity sensor (also called a moisture or steam sensor) fault. Samsung microwaves with sensor cooking use a humidity sensor to detect steam released by food and automatically stop cooking when the food is done. When the sensor fails, E-13 appears and sensor-based cooking modes are disabled.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Humidity Sensor',           'description' => 'The sensor element has broken or its output signal is outside the expected range.' ],
                    [ 'title' => 'Sensor Contamination',             'description' => 'Grease or food residue has coated the sensor, blocking its ability to detect steam.' ],
                    [ 'title' => 'Sensor Wiring Fault',              'description' => 'The wire harness connecting the sensor to the control board has a loose connection.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the microwave interior',     'description' => 'Wipe down the interior cavity completely, paying attention to the top wall where the humidity sensor is typically located (a small rectangular opening). Remove any grease buildup from around it.' ],
                    [ 'title' => 'Power reset',                      'description' => 'Unplug for 5 minutes and reconnect. A transient sensor read error may clear.' ],
                ],
                '_ar_when_to_call'   => "If E-13 persists, the humidity sensor requires replacement. The sensor is inside the microwave cavity and replacement requires disassembly by a technician trained in microwave safety (capacitor discharge required).",
                '_ar_cost_range'     => '$90 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still use my Samsung microwave when E-13 is showing?', 'answer' => 'Yes — E-13 disables sensor cooking modes (Auto Cook, Sensor Cook) but manual timed cooking continues to function normally.' ],
                    [ 'question' => 'What is the Samsung microwave humidity sensor for?', 'answer' => 'It detects the steam released by food during cooking. When steam output drops (food is done), the microwave automatically stops. This prevents overcooked or exploded food in sensor cooking programs.' ],
                ],
            ],
        ],

        // ── E-14 ──────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-14 Error Code',
            'slug'       => 'samsung-microwave-e14-error-code',
            'meta_title' => 'Samsung Microwave E-14 Error Code — Temperature Sensor Fault',
            'meta_desc'  => 'Samsung microwave E-14 means the cavity temperature sensor has failed. Learn the causes and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-14',
                '_ar_code_meaning'   => "The E-14 error code on a Samsung microwave indicates a cavity temperature sensor fault. Some Samsung microwave models use a temperature sensor (thermistor) to monitor cavity temperature for certain cooking programs and for thermal protection. E-14 appears when this sensor reads out of the expected range.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Cavity Thermistor',         'description' => 'The temperature sensor has broken, reading open or short circuit resistance.' ],
                    [ 'title' => 'Overheating Event',                'description' => 'A previous overheating event (from running empty or arcing food) damaged the thermistor.' ],
                    [ 'title' => 'Wiring Harness Fault',             'description' => 'The connector between the thermistor and control board has loosened.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                      'description' => 'Unplug for 5 minutes. If the microwave was recently run for an extended time and is warm, allow it to cool fully before the reset.' ],
                ],
                '_ar_when_to_call'   => "E-14 requires a technician — microwave disassembly involves discharging the high-voltage capacitor, which stores lethal charge even when unplugged. Do not attempt internal microwave repairs without proper training.",
                '_ar_cost_range'     => '$90 – $200',
                '_ar_faqs'           => [
                    [ 'question' => 'Is it safe to use a microwave showing E-14?', 'answer' => 'For basic timed cooking, often yes — but Samsung recommends resolving error codes before continued use. If the thermal protection circuit is compromised, the microwave could overheat without shutting down.' ],
                ],
            ],
        ],

        // ── E-61 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-61 Error Code',
            'slug'       => 'samsung-microwave-e61-error-code',
            'meta_title' => 'Samsung Microwave E-61 Error Code — Fan Motor Fault',
            'meta_desc'  => 'Samsung microwave E-61 means the ventilation fan motor has failed. Learn the causes and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-61',
                '_ar_code_meaning'   => "The E-61 error code on a Samsung microwave indicates a fault with the ventilation or cavity cooling fan motor. Samsung microwaves — particularly over-the-range models — use a fan to cool the magnetron and exhaust steam. The control board monitors fan operation and displays E-61 when the fan fails to start or stalls during operation.\n\nWithout a functioning fan, the magnetron and internal components can overheat, triggering thermal cutouts or causing permanent damage.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Fan Motor',                 'description' => 'The fan motor windings have burned out or the motor has seized.' ],
                    [ 'title' => 'Fan Blade Obstruction',            'description' => 'Grease buildup in the fan housing has jammed the blade.' ],
                    [ 'title' => 'Fan Motor Capacitor Failure',      'description' => 'On some models, a start capacitor assists the fan motor — if it fails the motor cannot start.' ],
                    [ 'title' => 'Wiring Fault to Fan Motor',        'description' => 'A break or loose connector in the fan motor wiring.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Do not open the microwave cabinet', 'description' => 'Internal microwave components include a high-voltage capacitor that retains a lethal charge even when unplugged. Fan motor replacement must be performed by a certified technician.' ],
                ],
                '_ar_when_to_call'   => "E-61 always requires a technician. Stop using the microwave immediately — operating without a functioning fan risks magnetron overheating.",
                '_ar_cost_range'     => '$90 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Samsung microwave with E-61?', 'answer' => 'No — without the cooling fan, the magnetron overheats within minutes of operation. Stop using the microwave until the fan is repaired.' ],
                    [ 'question' => 'Is Samsung microwave E-61 the same as E-60?', 'answer' => 'E-60 typically indicates a fan motor circuit fault detected at startup, while E-61 indicates the fan stalled or lost speed during operation. Both involve the same fan motor — the repair is the same.' ],
                ],
            ],
        ],

        // ── E-24 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-24 Error Code',
            'slug'       => 'samsung-microwave-e24-error-code',
            'meta_title' => 'Samsung Microwave E-24 Error Code — Humidity Sensor Fault',
            'meta_desc'  => 'Samsung microwave E-24 means the humidity or steam sensor has failed. Learn how it affects cooking and what repair is needed.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-24',
                '_ar_code_meaning'   => "The E-24 error code on a Samsung microwave indicates a fault with the humidity or steam sensor. Many Samsung microwaves use a humidity sensor to automatically detect cooking completion (by measuring steam output) for auto-cook and sensor cook functions. When this sensor fails or reads out of range, E-24 is displayed and sensor-based cooking modes are disabled.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Humidity Sensor',           'description' => 'The humidity sensor module has failed electrically.' ],
                    [ 'title' => 'Steam Damage to Sensor Membrane',  'description' => 'Prolonged steam exposure from cooking has permanently degraded the sensor membrane.' ],
                    [ 'title' => 'Sensor Wiring Fault',              'description' => 'The wiring to the humidity sensor has a break or loose connection.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Test if manual cooking still works', 'description' => 'Enter a time and power level manually (without using sensor or auto-cook). If the microwave heats normally in manual mode, E-24 is a sensor fault only and the unit is usable until repaired.' ],
                ],
                '_ar_when_to_call'   => "E-24 requires a technician for humidity sensor replacement inside the microwave cabinet. If manual cooking functions work, the repair is non-urgent.",
                '_ar_cost_range'     => '$90 – $240',
                '_ar_faqs'           => [
                    [ 'question' => 'Does Samsung microwave E-24 prevent all cooking?', 'answer' => 'Not necessarily — E-24 disables sensor cook and auto-cook functions, but manual time cooking typically still works. If the microwave heats on manual mode, this is a convenience feature fault rather than a complete failure.' ],
                ],
            ],
        ],


        // ── E-12 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-12 Error Code',
            'slug'       => 'samsung-microwave-e12-error-code',
            'meta_title' => 'Samsung Microwave E-12 Error Code — Humidity Sensor Short Circuit',
            'meta_desc'  => 'Samsung microwave E-12 means the humidity sensor has a short circuit fault. Learn how it differs from E-11 and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-12',
                '_ar_code_meaning'   => "The E-12 error code on a Samsung microwave indicates the humidity sensor has a short circuit fault. E-12 is the short-circuit counterpart to E-11 (open circuit). Where E-11 means the sensor resistance is too high (open circuit), E-12 means the sensor resistance has dropped to near zero (short circuit). Both disable the sensor cook and auto-cook functions that rely on the humidity sensor.\n\nSensor cook modes use the humidity sensor to detect steam released by food to automatically determine doneness. E-12 prevents these automatic modes while manual time cooking typically remains functional.",
                '_ar_causes'         => [
                    [ 'title' => 'Shorted Humidity Sensor',            'description' => 'The humidity sensor element has internally shorted, producing near-zero resistance.' ],
                    [ 'title' => 'Moisture Damage to Sensor',          'description' => 'Heavy steam condensation on the sensor has caused a conductive path across the sensor terminals.' ],
                    [ 'title' => 'Wiring Short to Sensor',             'description' => 'The sensor wiring has chafed against a metal edge, creating a short circuit in the sensor circuit.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Test manual cooking',                'description' => 'Set a manual time and power level (do not use sensor or auto-cook). If the microwave heats normally, only the sensor cooking modes are affected and the unit remains usable until repaired.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Unplug for 5 minutes. Heavy condensation on the sensor may dry out and E-12 may clear if caused by a temporary moisture event.' ],
                ],
                '_ar_when_to_call'   => "If E-12 persists, the humidity sensor requires replacement — an internal repair requiring capacitor discharge by a trained technician.",
                '_ar_cost_range'     => '$85 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung microwave E-11 and E-12?', 'answer' => 'E-11 means the humidity sensor has an open circuit (too high resistance). E-12 means the sensor has a short circuit (near-zero resistance). Both disable sensor cooking and are resolved by testing and replacing the humidity sensor.' ],
                ],
            ],
        ],

        // ── E-31 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-31 Error Code',
            'slug'       => 'samsung-microwave-e31-error-code',
            'meta_title' => 'Samsung Microwave E-31 Error Code — Magnetron Thermal Overload Fault',
            'meta_desc'  => 'Samsung microwave E-31 means the magnetron temperature sensor has detected an overload condition. Learn the causes and why professional service is required.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-31',
                '_ar_code_meaning'   => "The E-31 error code on a Samsung microwave indicates a magnetron thermal overload fault. The magnetron — the component that generates microwave energy — has a dedicated temperature sensor separate from the cavity thermistor. When this sensor detects that the magnetron body has exceeded its safe operating temperature, E-31 is logged and the microwave shuts down to prevent permanent magnetron damage.\n\nE-31 is distinct from E-63 (cavity overtemperature) in that E-31 specifically monitors the magnetron component itself. A single E-31 event may clear after the unit cools. Repeated E-31 faults indicate a magnetron nearing end of life, a blocked cooling path, or a failing cooling fan that can no longer keep the magnetron within its thermal limits.",
                '_ar_causes'         => [
                    [ 'title' => 'Blocked Ventilation Around Magnetron', 'description' => 'The cooling airflow path over the magnetron fins is blocked by grease buildup or a failed fan, causing heat to accumulate at the magnetron body.' ],
                    [ 'title' => 'Failing Cooling Fan',                  'description' => 'A worn cooling fan running at reduced speed cannot adequately cool the magnetron during full-power cooking cycles, triggering E-31 on extended use.' ],
                    [ 'title' => 'Magnetron Nearing End of Life',        'description' => 'As a magnetron ages, its efficiency decreases and it dissipates more energy as heat. An aging magnetron runs hotter and is more prone to E-31 during long cooking cycles.' ],
                    [ 'title' => 'Operating with No Load',               'description' => 'Running the microwave empty allows all magnetron energy to reflect back into the magnetron, rapidly overheating it and triggering E-31.' ],
                    [ 'title' => 'Magnetron Temperature Sensor Failure', 'description' => 'The sensor itself has failed and is reporting an incorrect overtemperature reading even when the magnetron is at normal operating temperature.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Allow the unit to cool completely',    'description' => 'Unplug the microwave and allow it to rest with the door open in a well-ventilated area for at least 30 minutes. Restore power — if E-31 clears and does not return during normal use, the event was a one-time thermal peak.' ],
                    [ 'title' => 'Check ventilation clearances',         'description' => 'Ensure the top and sides of the microwave are clear per the installation manual clearance requirements. For over-the-range models, confirm the internal vent filter is not heavily grease-coated.' ],
                    [ 'title' => 'Never run the microwave empty',        'description' => 'Always have food or a microwave-safe cup of water in the cavity when operating. An empty microwave is the fastest way to cause magnetron overheating.' ],
                ],
                '_ar_when_to_call'   => "If E-31 recurs after cooling and ventilation is confirmed clear, the cooling fan or magnetron temperature sensor requires testing by a technician. Due to the lethal high-voltage capacitor inside all microwaves, internal access is always a professional repair.",
                '_ar_cost_range'     => '$100 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Does E-31 mean my Samsung microwave magnetron is dead?', 'answer' => 'Not necessarily — a single E-31 that clears after cooling means the magnetron reached its thermal limit but was not permanently damaged. The protective shutdown worked as intended. Repeated E-31 events indicate the magnetron or cooling system is failing and a technician should inspect the unit.' ],
                    [ 'question' => 'Can E-31 and E-63 appear on the same Samsung microwave?', 'answer' => 'Yes — E-31 monitors the magnetron component temperature and E-63 monitors the cavity/internal ambient temperature. Both are overtemperature codes but for different components. If both appear regularly, the cooling system has failed and is not adequately protecting any of the internal components.' ],
                    [ 'question' => 'How long does a Samsung microwave magnetron last?', 'answer' => 'Under normal use — cooking food (not running empty), with adequate ventilation — Samsung magnetrons typically last 8–12 years. Chronic overheating events (E-31, E-63) significantly shorten magnetron life.' ],
                ],
            ],
        ],

        // ── E-50 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-50 Error Code',
            'slug'       => 'samsung-microwave-e50-error-code',
            'meta_title' => 'Samsung Microwave E-50 Error Code — Inverter / Power Board Communication Fault',
            'meta_desc'  => 'Samsung microwave E-50 means the main board has lost communication with the inverter or power control board. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-50',
                '_ar_code_meaning'   => "The E-50 error code on a Samsung microwave indicates a communication fault between the main control board and the inverter or power control board. Samsung inverter microwaves use a dedicated inverter power board to supply variable-level power to the magnetron. The main board continuously communicates with the inverter board to confirm operating status. When this communication link fails or the inverter board does not respond within the expected time window, E-50 is displayed and the magnetron cannot be energized.\n\nE-50 is a commonly reported error on Samsung over-the-range and countertop inverter microwave models. It may appear after a power fluctuation event or as a result of a failing inverter board that has lost communication capability.",
                '_ar_causes'         => [
                    [ 'title' => 'Inverter Board Communication Failure', 'description' => 'The inverter board has failed and is no longer responding to communication signals from the main control board. This is the most common cause of E-50.' ],
                    [ 'title' => 'Loose or Damaged Harness Between Boards', 'description' => 'The ribbon cable or wire harness connecting the main board to the inverter board has a loose connector or broken wire, interrupting communication.' ],
                    [ 'title' => 'Power Surge Damage to Inverter Board', 'description' => 'A voltage surge has damaged the inverter board\'s communication circuit while leaving other functions partially operational.' ],
                    [ 'title' => 'Main Control Board Fault',             'description' => 'Rarely, the main board\'s communication output to the inverter has failed. Confirmed after inverter board replacement does not resolve E-50.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                          'description' => 'Unplug for 10 minutes and restore power. A communication fault caused by a one-time power event may clear after a full board reset.' ],
                    [ 'title' => 'Evaluate repair vs. replace',           'description' => 'On inverter microwaves under 5 years old, inverter board replacement is typically worthwhile. On older countertop models, compare the repair estimate against the cost of a replacement unit before proceeding.' ],
                ],
                '_ar_when_to_call'   => "E-50 requires a certified technician. The inverter board carries high-voltage components that retain dangerous charge even after unplugging. Do not open the microwave cabinet to inspect the harness yourself.",
                '_ar_cost_range'     => '$130 – $340',
                '_ar_faqs'           => [
                    [ 'question' => 'Is E-50 only on Samsung inverter microwaves?', 'answer' => 'E-50 is primarily associated with Samsung models equipped with inverter power boards. Standard transformer-based Samsung microwaves do not use an inverter communication bus and would not display E-50.' ],
                    [ 'question' => 'Can a power surge cause Samsung microwave E-50?', 'answer' => 'Yes — the inverter board is particularly vulnerable to power surges because it handles the conversion from household AC to high-frequency power. A surge can damage the inverter\'s communication circuitry while leaving the main board intact, resulting in E-50.' ],
                    [ 'question' => 'My Samsung microwave shows E-50 — will it heat at all?', 'answer' => 'No. With E-50 active, the main board cannot communicate with the inverter board and the magnetron will not be energized. The microwave will not heat in any mode until the communication fault is resolved.' ],
                ],
            ],
        ],

        // ── E-23 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-23 Error Code',
            'slug'       => 'samsung-microwave-e23-error-code',
            'meta_title' => 'Samsung Microwave E-23 Error Code — Cavity Thermistor Short Circuit',
            'meta_desc'  => 'Samsung microwave E-23 means the cavity temperature sensor has a short circuit fault. Learn how it differs from E-14 and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-23',
                '_ar_code_meaning'   => "The E-23 error code on a Samsung microwave indicates a short circuit fault in the cavity thermistor — the temperature sensor that monitors the interior cooking cavity. E-23 is the short-circuit counterpart to E-14 (open circuit). Where E-14 means the thermistor resistance is too high (open circuit — no signal), E-23 means the thermistor resistance has dropped near zero (short circuit — continuous signal at maximum).\n\nBoth E-23 and E-14 disable any cooking programs that rely on cavity temperature sensing. However, E-23 is more operationally disruptive because a shorted thermistor reads the cavity as perpetually overheated, which can cause the control board to block all cooking cycles rather than just sensor-based ones.",
                '_ar_causes'         => [
                    [ 'title' => 'Shorted Cavity Thermistor',            'description' => 'The thermistor element has internally shorted, causing its resistance to read near zero. The control board interprets this as an extreme temperature and may halt operation.' ],
                    [ 'title' => 'Moisture Damage to Thermistor',        'description' => 'Condensation or steam infiltration has created a conductive path across the thermistor terminals, artificially reducing its resistance reading.' ],
                    [ 'title' => 'Wiring Short Between Thermistor Leads', 'description' => 'The thermistor wire harness has chafed against a metal surface, creating a short circuit external to the thermistor component itself.' ],
                    [ 'title' => 'Overheating Event Damaging Thermistor', 'description' => 'A prior severe overheating event (from arcing, running empty, or ventilation failure) has physically damaged the thermistor, causing it to short.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset after cooling',             'description' => 'Unplug the microwave for 10 minutes and allow it to cool to room temperature. Restore power and test manual cooking. If E-23 was caused by temporary moisture contact, it may not return.' ],
                    [ 'title' => 'Test manual time cooking',              'description' => 'Enter a cooking time and power level manually. If the microwave refuses to start any cooking cycle (not just sensor modes), the shorted thermistor is feeding a false overtemperature reading that is blocking all operation — professional repair is required.' ],
                ],
                '_ar_when_to_call'   => "E-23 requires a technician to discharge the internal high-voltage capacitor, locate the cavity thermistor, and test the component and its wiring. The thermistor is a low-cost part but its replacement is an internal repair requiring proper capacitor discharge procedures.",
                '_ar_cost_range'     => '$90 – $200',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung microwave E-14 and E-23?', 'answer' => 'E-14 means the cavity thermistor has an open circuit (infinite or very high resistance — no signal reaches the board). E-23 means the thermistor has a short circuit (near-zero resistance — continuous maximum signal). Both indicate thermistor failure, but E-23 may be more disruptive because a shorted sensor can trick the board into thinking the cavity is overheated.' ],
                    [ 'question' => 'Can I use my Samsung microwave in manual mode with E-23?', 'answer' => 'It depends on the model — some Samsung microwaves will allow manual time cooking even with a thermistor fault, while others block all operation when the thermistor reads as shorted. If manual cooking works, the unit is usable until repaired. If no cooking modes function, the microwave must be repaired before use.' ],
                    [ 'question' => 'Is E-23 dangerous on a Samsung microwave?', 'answer' => 'The E-23 fault itself is not immediately dangerous — it is a sensor reporting incorrectly. However, if the thermistor was damaged by an overheating event, using the microwave before repairing it risks recurring overheating. Have the unit inspected if E-23 appeared after any burning smell or arcing incident.' ],
                ],
            ],
        ],

        // ── E-47 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-47 Error Code',
            'slug'       => 'samsung-microwave-e47-error-code',
            'meta_title' => 'Samsung Microwave E-47 Error Code — Door Switch Fault',
            'meta_desc'  => 'Samsung microwave E-47 means a door interlock switch has failed. Learn why this is a safety-critical fault and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-47',
                '_ar_code_meaning'   => "The E-47 error code on a Samsung microwave indicates a door interlock switch fault. Samsung microwaves use multiple door interlock switches to confirm the door is securely closed before the magnetron is energized. E-47 is triggered on models that monitor switch states electronically — the control board detects an unexpected switch state and halts operation immediately.\n\nDoor switch faults are safety-critical. The interlock system exists specifically to prevent microwave energy from operating with the door open. E-47 should be repaired immediately and the microwave should not be used until the fault is resolved.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Interlock Switch',       'description' => 'One or more of the door switches has failed — either stuck open (won\'t confirm door closed) or stuck closed (safety hazard).' ],
                    [ 'title' => 'Broken Door Latch Hook',             'description' => 'The plastic latch hook that actuates the switch has broken, preventing switch activation.' ],
                    [ 'title' => 'Door Misalignment',                  'description' => 'The door hinge has shifted, preventing the latch from fully engaging the switch actuators.' ],
                    [ 'title' => 'Wiring Fault to Switch',             'description' => 'A loose or broken wire to one of the interlock switches.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Inspect the door latch hooks',       'description' => 'Open the door and examine the plastic latch hooks on the door edge for breaks or cracks. A broken hook must be replaced before the switches can function correctly.' ],
                    [ 'title' => 'Do not attempt internal access',     'description' => 'The microwave capacitor retains a lethal charge even when unplugged. Do not open the cabinet to access the switches yourself.' ],
                ],
                '_ar_when_to_call'   => "E-47 always requires a technician. Door switch replacement inside the microwave cabinet is a safety-critical repair that must only be performed after the capacitor has been properly discharged.",
                '_ar_cost_range'     => '$85 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung microwave E-47 dangerous?', 'answer' => 'Yes. A door switch stuck closed means the magnetron could theoretically operate with the door open, which is a microwave radiation hazard. Stop using the microwave immediately when E-47 appears.' ],
                    [ 'question' => 'Is E-47 different from SE on a Samsung microwave?', 'answer' => 'Yes — SE indicates a stuck control panel touchpad key. E-47 indicates a door interlock switch fault. Both halt operation but involve different components and require different repairs.' ],
                ],
            ],
        ],

        // ── E-32 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-32 Error Code',
            'slug'       => 'samsung-microwave-e32-error-code',
            'meta_title' => 'Samsung Microwave E-32 Error Code — High-Voltage Diode / Capacitor Fault',
            'meta_desc'  => 'Samsung microwave E-32 indicates a fault in the high-voltage rectifier circuit — typically the HV diode or capacitor. Learn why this always needs professional repair.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-32',
                '_ar_code_meaning'   => "The E-32 error code on a Samsung microwave indicates a fault in the high-voltage rectifier circuit — specifically the high-voltage diode or high-voltage capacitor that converts transformer output into the DC voltage required by the magnetron. E-32 is a more specific high-voltage circuit fault than E-60, which encompasses the broader HV system including the magnetron and transformer.\n\nSamsung microwaves monitor the HV circuit output and log E-32 when the rectifier components produce an out-of-specification voltage — typically because the diode has shorted or opened, or the capacitor has failed. The microwave will not produce heat with E-32 active, but may otherwise appear to function normally (display works, timer counts, turntable spins).",
                '_ar_causes'         => [
                    [ 'title' => 'Failed High-Voltage Diode',            'description' => 'The HV diode rectifies the transformer\'s AC output into the pulsed DC voltage used by the magnetron. Diode failure (open or shorted) is the most common cause of E-32. A shorted diode also causes the thermal fuse to blow. A failed diode is among the least expensive HV repairs.' ],
                    [ 'title' => 'Failed High-Voltage Capacitor',        'description' => 'The HV capacitor filters and stores the rectified voltage. A capacitor that has internally shorted or lost capacitance disrupts the magnetron supply voltage, triggering E-32.' ],
                    [ 'title' => 'Arcing Event Damaging HV Components',  'description' => 'Metal in the cavity, burned food, or a damaged waveguide cover can cause arcing that sends damaging current surges back through the HV circuit, failing the diode or capacitor.' ],
                    [ 'title' => 'Age-Related Component Failure',        'description' => 'HV diodes and capacitors have finite service lives. In microwaves over 8 years old, these components can fail from normal electrical stress.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Confirm the no-heat symptom',           'description' => 'Set the microwave to full power with a cup of water inside. If the display, timer, and turntable work but the water is cold after 60 seconds, the high-voltage circuit has failed — consistent with E-32.' ],
                    [ 'title' => 'Do NOT open the microwave cabinet',     'description' => 'The HV capacitor stores a potentially fatal charge of 2,000+ volts even minutes after unplugging. Only a trained technician with a capacitor discharge procedure should access these components.' ],
                ],
                '_ar_when_to_call'   => "E-32 always requires a technician. The HV diode is the first component tested (it is the least expensive and most frequently failed). If the diode tests good, the capacitor is tested next. Component-level repair is typically far less expensive than magnetron or board replacement — diagnose before assuming the worst.",
                '_ar_cost_range'     => '$90 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung microwave E-32 and E-60?', 'answer' => 'E-60 indicates a broader high-voltage or magnetron system fault. E-32 is more specific — it points to the rectifier circuit (diode and capacitor) that sits between the transformer and the magnetron. A technician diagnosing E-32 will test the diode and capacitor first, which are less expensive to replace than a magnetron.' ],
                    [ 'question' => 'Can a power surge cause Samsung microwave E-32?', 'answer' => 'Yes — the HV diode is particularly vulnerable to voltage spikes because it is directly in the high-voltage circuit path. A surge can cause instantaneous diode failure. Using a surge protector on the microwave outlet is advisable, particularly in areas with frequent power fluctuations.' ],
                    [ 'question' => 'Is it worth repairing E-32 on an older Samsung microwave?', 'answer' => 'A failed HV diode is a $10–$20 part and a 30-minute repair — always worth fixing on any microwave. A failed capacitor costs $20–$40. If the diode and capacitor both test good and the fault lies elsewhere in the HV circuit, get a repair estimate before proceeding on units over 8 years old.' ],
                ],
            ],
        ],

        // ── E-63 ─────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Microwave E-63 Error Code',
            'slug'       => 'samsung-microwave-e63-error-code',
            'meta_title' => 'Samsung Microwave E-63 Error Code — Overtemperature / Thermal Protection Fault',
            'meta_desc'  => 'Samsung microwave E-63 means the internal temperature has exceeded the safe limit. Learn what causes it and what to do.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Microwave' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Microwave',
                '_ar_error_code'     => 'E-63',
                '_ar_code_meaning'   => "The E-63 error code on a Samsung microwave indicates an overtemperature condition — the internal temperature sensor has detected that the microwave's internal components have exceeded the safe operating temperature limit. E-63 is triggered before the physical thermal cutout blows, serving as an early warning that the microwave is overheating.\n\nUnlike a tripped thermal cutout (which requires component replacement), E-63 may clear after the microwave is allowed to cool fully and ventilation is restored. If E-63 appears repeatedly, the root cause — typically blocked ventilation or a failing cooling fan — must be addressed.",
                '_ar_causes'         => [
                    [ 'title' => 'Blocked Ventilation',                'description' => 'The vents on the microwave are blocked by cabinetry, objects placed on top, or grease buildup — preventing heat from escaping.' ],
                    [ 'title' => 'Running Microwave Empty',            'description' => 'Operating the microwave with no food or water allows magnetron energy to reflect back, generating rapid and severe internal heat.' ],
                    [ 'title' => 'Extended Operation at Full Power',   'description' => 'Very long cooking times at maximum power exceed the duty cycle limits of the magnetron and internal components.' ],
                    [ 'title' => 'Failing Cooling Fan',                'description' => 'A degrading cooling fan that still turns but at reduced speed can allow gradual heat buildup until E-63 triggers.' ],
                    [ 'title' => 'Failed Temperature Sensor',          'description' => 'The internal temperature sensor has failed and is incorrectly reading a high temperature.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Allow the microwave to cool',        'description' => 'Unplug the microwave. Allow it to cool in a well-ventilated area for at least 30 minutes with the door slightly open.' ],
                    [ 'title' => 'Check ventilation clearances',       'description' => 'Ensure the microwave has adequate clearance on all sides per the installation manual. For over-the-range models, confirm the exhaust duct is not blocked.' ],
                    [ 'title' => 'Do not run the microwave empty',     'description' => 'Always have food or a cup of water inside when operating the microwave.' ],
                ],
                '_ar_when_to_call'   => "If E-63 recurs after ventilation is confirmed clear, the cooling fan or internal temperature sensor requires testing and replacement by a technician.",
                '_ar_cost_range'     => '$85 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung microwave E-63 the same as a tripped thermal cutout?', 'answer' => 'No — E-63 is an electronic temperature sensor warning. A tripped thermal cutout is a physical component that opens (blows) permanently. E-63 can clear after cooling; a blown thermal cutout requires replacement regardless of temperature.' ],
                    [ 'question' => 'Can E-63 cause permanent damage to my Samsung microwave?', 'answer' => 'A single E-63 event that clears after cooling generally does not cause permanent damage. Repeated E-63 events from chronic overheating will degrade the magnetron and internal components over time. Address the ventilation or fan issue before continuing regular use.' ],
                ],
            ],
        ],

    ]; // end ar_error_codes_samsung_microwave()
}

// ─────────────────────────────────────────────────────────────────────────────
// WALL OVEN ERROR CODES
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_samsung_wall_oven(): array {
    return [

        // ── SE (Wall Oven) ────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven SE Error Code',
            'slug'       => 'samsung-wall-oven-se-error-code',
            'meta_title' => 'Samsung Wall Oven SE Error Code — Touchpad / Control Panel Fault',
            'meta_desc'  => 'Samsung wall oven SE means the control touchpad has a shorted key fault. Learn what causes it and how it is repaired.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'SE',
                '_ar_code_meaning'   => "The SE error code on a Samsung wall oven indicates a shorted key or failed touchpad membrane on the control panel. This is the same well-known Samsung control panel fault that affects ranges, microwaves, and dishwashers across the Samsung appliance lineup.\n\nSamsung wall ovens are mounted in cabinetry, so steam exposure from cooktop cooking is less of a factor compared to over-the-range microwaves. SE on a wall oven more commonly results from physical wear of the membrane or from condensation during self-clean cycles. The control board can also be the source if membrane replacement does not resolve SE.",
                '_ar_causes'         => [
                    [ 'title' => 'Touchpad Membrane Wear',           'description' => 'Years of key presses cause the conductive layer in the membrane to delaminate. High-frequency keys (Start, Cancel, Temperature Up/Down) fail first.' ],
                    [ 'title' => 'Steam During Self-Clean Cycle',    'description' => 'The self-clean cycle generates significant internal steam and heat. Condensation can infiltrate the membrane seal around the control panel edges.' ],
                    [ 'title' => 'Control Board Key-Scanning Fault', 'description' => 'The key-scanning circuit on the main control board develops a fault, registering false key presses. Confirmed if SE persists after membrane replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Perform a circuit breaker reset',  'description' => 'Turn off the wall oven circuit breaker for 60 seconds. Restore power. If SE was caused by a transient event (moisture during self-clean), it may not return.' ],
                    [ 'title' => 'Test key functionality after reset', 'description' => 'If SE clears, press each key individually to identify any key that triggers SE immediately when pressed. A specific key trigger confirms touchpad membrane failure at that location.' ],
                ],
                '_ar_when_to_call'   => "Touchpad replacement on a Samsung built-in wall oven requires removing the control panel assembly from the oven trim frame — a moderate disassembly task best handled by a certified technician for built-in appliances. The control board is tested only after touchpad replacement fails to resolve SE.",
                '_ar_cost_range'     => '$140 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Samsung wall oven at all with SE?',           'answer' => 'No. SE disables the control system. The oven will not respond to heating commands while SE is active. Use a conventional countertop oven or range as a substitute until the SE fault is repaired.' ],
                    [ 'question' => 'Is SE more common after self-clean on a Samsung wall oven?', 'answer' => 'Yes — the high temperatures and steam generated during self-clean can stress the control panel seal, and SE appearing after a self-clean cycle is a recognized pattern on Samsung wall ovens. If your wall oven develops SE specifically after self-clean cycles, have the panel seal and membrane inspected.' ],
                    [ 'question' => 'Does the 30-day repair warranty cover Samsung wall oven SE?', 'answer' => 'Yes — all Samsung wall oven repairs performed by our technicians are backed by a 30-day parts and labor warranty. If SE returns within the warranty period, we return at no additional cost.' ],
                ],
            ],
        ],

        // ── C-A1 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven C-A1 Error Code',
            'slug'       => 'samsung-wall-oven-ca1-error-code',
            'meta_title' => 'Samsung Wall Oven C-A1 / CA1 Error Code — Communication Fault',
            'meta_desc'  => 'Samsung wall oven C-A1 means the main control board lost communication with a secondary module. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'C-A1',
                '_ar_code_meaning'   => "The C-A1 error code on a Samsung wall oven (also displayed as CA1) indicates a communication fault between the main control board and a secondary module — typically the display board, relay board, or a second oven control board in double wall oven configurations. C-A1 appears when the main PCB cannot establish communication with the expected module.",
                '_ar_causes'         => [
                    [ 'title' => 'Loose or Damaged Harness Connector', 'description' => 'The wiring harness between the main board and the secondary module has a loose or disconnected connector.' ],
                    [ 'title' => 'Failed Display or Relay Board',      'description' => 'The secondary board has failed and is not responding to the main PCB.' ],
                    [ 'title' => 'Failed Main Control Board',          'description' => 'The communication circuit on the main PCB has failed.' ],
                    [ 'title' => 'Power Surge Damage',                 'description' => 'A voltage spike has damaged the communication circuitry on one or both boards.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 5 minutes and restore power. A transient communication fault may clear.' ],
                ],
                '_ar_when_to_call'   => "Persistent C-A1 requires a technician to identify the non-communicating module using service diagnostics and replace the appropriate board.",
                '_ar_cost_range'     => '$150 – $420',
                '_ar_faqs'           => [
                    [ 'question' => 'Can a power outage cause Samsung wall oven C-A1?', 'answer' => 'Yes — an abrupt power cut can corrupt inter-board communication state. A power reset often clears transient C-A1 from power events. If C-A1 persists after reset, a board has failed.' ],
                ],
            ],
        ],

        // ── C-A2 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven C-A2 Error Code',
            'slug'       => 'samsung-wall-oven-ca2-error-code',
            'meta_title' => 'Samsung Wall Oven C-A2 / CA2 Error Code — Secondary Communication Fault',
            'meta_desc'  => 'Samsung wall oven C-A2 means a secondary inter-board communication fault was detected. Learn the causes and how it is repaired.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'C-A2',
                '_ar_code_meaning'   => "The C-A2 error code on a Samsung wall oven (also displayed as CA2) is a secondary communication fault, closely related to C-A1. C-A2 typically indicates a fault on a different inter-board communication path — for example, between the main board and a second lower-oven control board in a double wall oven, or between the main board and a relay board.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Lower Oven Control Board',   'description' => 'On double wall ovens, the lower cavity control board has stopped communicating with the main PCB.' ],
                    [ 'title' => 'Damaged Communication Harness',     'description' => 'The wiring harness between two boards has a broken wire or disconnected connector.' ],
                    [ 'title' => 'Main Board Second Communication Channel Failure', 'description' => 'A secondary communication port on the main PCB has failed independently of the primary channel.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 5 minutes and restore power. A transient fault may clear.' ],
                ],
                '_ar_when_to_call'   => "C-A2 that persists after a power reset requires a technician to identify which secondary module has failed and replace it.",
                '_ar_cost_range'     => '$150 – $420',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Samsung wall oven C-A1 and C-A2?', 'answer' => 'Both are communication faults. C-A1 typically involves the display or primary sub-board communication path; C-A2 involves a secondary path (often the lower oven board or relay board on double ovens). Both require technician diagnosis to identify the failed module.' ],
                ],
            ],
        ],

        // ── E-0B (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-0B Error Code',
            'slug'       => 'samsung-wall-oven-e0b-error-code',
            'meta_title' => 'Samsung Wall Oven E-0B Error Code — Power Board Fault',
            'meta_desc'  => 'Samsung wall oven E-0B means a fault was detected in the power control board or relay circuit. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-0B',
                '_ar_code_meaning'   => "The E-0B error code on a Samsung wall oven indicates a fault in the power control board or relay circuit. Samsung wall ovens use a dedicated power board or relay board to switch the high-current bake and broil elements. E-0B is triggered when the main control board detects an abnormal condition in this power circuit — such as a relay that is not responding correctly or a power board that is not communicating expected status.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Relay on Power Board',        'description' => 'A relay on the power or relay board has failed — either stuck closed (creating overtemperature risk) or stuck open (preventing heating).' ],
                    [ 'title' => 'Power Board Communication Fault',    'description' => 'The power board has stopped responding to commands from the main control board.' ],
                    [ 'title' => 'Wiring Harness to Power Board',      'description' => 'A loose or damaged connector in the harness between the main board and power board.' ],
                    [ 'title' => 'Power Supply Abnormality',           'description' => 'An abnormal supply voltage condition is preventing the power board from operating correctly.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 5 minutes and restore. A transient power fault may clear E-0B.' ],
                    [ 'title' => 'Check the circuit breaker',          'description' => 'Confirm the wall oven breaker is fully on and both legs of the 240V supply are present at the outlet.' ],
                ],
                '_ar_when_to_call'   => "Persistent E-0B requires a technician to access the power board, test relay operation, and replace the board if faulty. A stuck closed relay is a fire risk — do not use the oven until inspected.",
                '_ar_cost_range'     => '$150 – $400',
                '_ar_faqs'           => [
                    [ 'question' => 'Is E-0B serious on a Samsung wall oven?', 'answer' => 'E-0B should be taken seriously — a faulty power relay can prevent heating (nuisance fault) or cause uncontrolled heating (safety risk). Have it inspected before continued use.' ],
                ],
            ],
        ],

        // ── E-0A (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-0A Error Code',
            'slug'       => 'samsung-wall-oven-e0a-error-code',
            'meta_title' => 'Samsung Wall Oven E-0A Error Code — Power Supply Fault',
            'meta_desc'  => 'Samsung wall oven E-0A means the control board detected an abnormal power supply condition. Learn what causes it and how to respond.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-0A',
                '_ar_code_meaning'   => "The E-0A error code on a Samsung wall oven indicates a power supply or power management fault. The main control board monitors supply voltage and internal DC power rails. When voltage falls outside acceptable parameters — from an external supply issue or an internal power circuit failure — E-0A is displayed and the oven halts operation.",
                '_ar_causes'         => [
                    [ 'title' => 'Supply Voltage Abnormality',         'description' => 'The incoming 240V supply is too high, too low, or has lost one phase.' ],
                    [ 'title' => 'Internal Power Board Fault',         'description' => 'The internal DC power supply board that converts AC to low-voltage DC for the control electronics has failed.' ],
                    [ 'title' => 'Main Board Power Regulation Fault',  'description' => 'A voltage regulator component on the main board has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check the circuit breaker',          'description' => 'Confirm the wall oven breaker is fully on. A half-tripped breaker can cause supply abnormalities.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the breaker for 5 minutes. If E-0A appeared from a transient power event, it may clear.' ],
                ],
                '_ar_when_to_call'   => "Persistent E-0A requires a technician to test supply voltage at the oven connection and internal board power rails.",
                '_ar_cost_range'     => '$130 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'Can a power surge cause Samsung wall oven E-0A?', 'answer' => 'Yes — a surge can damage the internal power supply board or main board power circuits, causing E-0A. If it appeared after a power event, surge damage is the most likely cause.' ],
                ],
            ],
        ],

        // ── E-11 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-11 Error Code',
            'slug'       => 'samsung-wall-oven-e11-error-code',
            'meta_title' => 'Samsung Wall Oven E-11 Error Code — Humidity Sensor Fault',
            'meta_desc'  => 'Samsung wall oven E-11 means the humidity or steam sensor has failed. Learn what cooking functions are affected and how it is repaired.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-11',
                '_ar_code_meaning'   => "The E-11 error code on a Samsung wall oven indicates a humidity sensor fault. Samsung wall ovens with sensor-assisted cooking modes (steam cook, auto-roast, sensor bake) use a humidity sensor inside the cavity to detect moisture levels and automatically adjust cooking time and temperature. When this sensor fails or returns an out-of-range value, E-11 is displayed.\n\nE-11 disables sensor-based cooking modes but typically does not prevent manual baking or broiling.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Humidity Sensor',             'description' => 'The humidity sensor module has failed electrically.' ],
                    [ 'title' => 'Sensor Contamination from Grease',   'description' => 'Cooking grease has coated the sensor element, preventing accurate humidity readings.' ],
                    [ 'title' => 'Sensor Wiring Fault',                'description' => 'A broken wire or loose connector in the sensor harness.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 5 minutes. A transient sensor error may clear.' ],
                    [ 'title' => 'Clean the oven cavity',              'description' => 'Run a self-clean cycle or thoroughly clean the oven interior. Grease near the humidity sensor can cause false readings and E-11.' ],
                ],
                '_ar_when_to_call'   => "If E-11 persists, the humidity sensor requires replacement. A technician can locate and replace the sensor and confirm wiring integrity.",
                '_ar_cost_range'     => '$95 – $270',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still bake with Samsung wall oven E-11?', 'answer' => 'In most cases yes — E-11 disables sensor-assisted cooking modes but manual bake, broil, and convection functions typically continue to work normally.' ],
                ],
            ],
        ],

        // ── E-12 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-12 Error Code',
            'slug'       => 'samsung-wall-oven-e12-error-code',
            'meta_title' => 'Samsung Wall Oven E-12 Error Code — Secondary Sensor or Communication Fault',
            'meta_desc'  => 'Samsung wall oven E-12 indicates a secondary sensor or inter-board communication fault. Learn the causes and repair.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-12',
                '_ar_code_meaning'   => "The E-12 error code on a Samsung wall oven indicates a secondary sensor or communication fault. On wall ovens with multiple sensors or dual-cavity configurations, E-12 reflects a fault in a secondary measurement or communication circuit. The specific component depends on the model.",
                '_ar_causes'         => [
                    [ 'title' => 'Secondary Probe or Sensor Fault',    'description' => 'A secondary sensor (broil probe, secondary cavity thermistor) has failed open or shorted.' ],
                    [ 'title' => 'Inter-Board Communication Error',    'description' => 'On double wall ovens, a communication fault between the upper and lower oven circuits.' ],
                    [ 'title' => 'Sensor Harness Fault',               'description' => 'A loose connector or broken wire in the secondary sensor harness.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 5 minutes and restore power.' ],
                ],
                '_ar_when_to_call'   => "E-12 diagnosis requires a technician to identify the specific sensor or communication path at fault using model-specific service documentation.",
                '_ar_cost_range'     => '$100 – $340',
                '_ar_faqs'           => [
                    [ 'question' => 'Does E-12 disable the whole Samsung wall oven?', 'answer' => 'It depends on which secondary circuit has failed. A secondary sensor fault may only disable certain cooking modes or one oven cavity on a double oven, while some E-12 variants disable the entire oven as a precaution.' ],
                ],
            ],
        ],

        // ── E-13 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-13 Error Code',
            'slug'       => 'samsung-wall-oven-e13-error-code',
            'meta_title' => 'Samsung Wall Oven E-13 Error Code — Door Lock Fault',
            'meta_desc'  => 'Samsung wall oven E-13 means the self-clean door lock motor cannot complete its stroke. Learn the causes and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-13',
                '_ar_code_meaning'   => "The E-13 error code on a Samsung wall oven indicates a door lock fault — the electronic door lock motor used for self-clean cycles cannot complete its lock or unlock stroke. Samsung wall ovens require the door to lock before the high-temperature self-clean cycle begins. When the lock motor cannot reach its intended position within the required time, E-13 is displayed and the self-clean cycle is prevented.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Lock Motor',             'description' => 'The motor that drives the lock bolt has burned out or seized.' ],
                    [ 'title' => 'Door Lock Mechanism Obstruction',    'description' => 'Debris or a food residue buildup is preventing the lock bolt from completing its full stroke.' ],
                    [ 'title' => 'Door Lock Position Switch Fault',    'description' => 'The limit switches that confirm lock/unlock position have failed, causing the control board to time out.' ],
                    [ 'title' => 'Wiring Fault to Lock Assembly',      'description' => 'A loose connector or broken wire in the door lock motor or switch harness.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the door lock area',           'description' => 'Clean around the door latch receiver on the oven frame. Food residue can prevent the lock bolt from engaging fully.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 5 minutes. The board will attempt to re-home the lock motor on restart.' ],
                ],
                '_ar_when_to_call'   => "If E-13 persists, the door lock motor or position switch assembly requires replacement — an internal repair requiring oven panel removal.",
                '_ar_cost_range'     => '$110 – $300',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still bake with Samsung wall oven E-13?', 'answer' => 'In most cases yes — E-13 prevents the self-clean cycle from initiating but does not disable normal baking and broiling. Verify normal baking functions work before using the oven.' ],
                    [ 'question' => 'Why did E-13 appear after a power outage during self-clean?', 'answer' => 'If power was interrupted mid-cycle, the door may be locked and unable to unlock. A power reset typically resolves this — the control board attempts to unlock the door when power is restored.' ],
                ],
            ],
        ],

        // ── dE (Wall Oven) ────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven dE Error Code',
            'slug'       => 'samsung-wall-oven-de-error-code',
            'meta_title' => 'Samsung Wall Oven dE / dC Error Code — Door Open or Door Switch Fault',
            'meta_desc'  => 'Samsung wall oven dE or dC means the oven door is open or the door switch has failed. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'dE',
                '_ar_code_meaning'   => "The dE error code on a Samsung wall oven (also displayed as dC on some models) indicates the oven door is open or the control board cannot confirm the door is closed. Samsung wall ovens require a door-closed signal before starting or continuing a bake, broil, or convection cycle. dE appears when this signal is absent.",
                '_ar_causes'         => [
                    [ 'title' => 'Door Not Fully Closed',              'description' => 'The oven door was not closed firmly enough to activate the door switch.' ],
                    [ 'title' => 'Failed Door Switch',                 'description' => 'The door switch microswitch has failed open, reporting the door as open even when it is properly closed.' ],
                    [ 'title' => 'Door Hinge Wear or Misalignment',    'description' => 'A worn or sagging door hinge prevents the door from seating properly against the switch actuator.' ],
                    [ 'title' => 'Loose Door Switch Wiring',           'description' => 'The connector to the door switch has loosened.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Close door firmly',                  'description' => 'Press the oven door firmly closed. Wall oven doors can develop hinge sag — push up slightly on the door while closing to ensure full seat.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds. A transient switch error may clear.' ],
                ],
                '_ar_when_to_call'   => "If dE persists with the door properly closed, the door switch requires testing and likely replacement — an internal repair on Samsung wall ovens.",
                '_ar_cost_range'     => '$80 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung wall oven dE the same as dC?', 'answer' => 'Yes — both codes represent the same door fault on different firmware versions. The diagnosis and repair are identical.' ],
                    [ 'question' => 'Why does dE appear on my Samsung wall oven mid-bake?', 'answer' => 'A worn door switch or hinge can maintain contact under normal conditions but lose it from thermal expansion as the oven heats. If dE appears mid-cycle but not at startup, the door switch is intermittently failing and should be replaced.' ],
                ],
            ],
        ],


        // ── E-08 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-08 Error Code',
            'slug'       => 'samsung-wall-oven-e08-error-code',
            'meta_title' => 'Samsung Wall Oven E-08 Error Code — Bake Element Relay Fault',
            'meta_desc'  => 'Samsung wall oven E-08 means the bake element relay on the control board has a fault. Learn the causes and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-08',
                '_ar_code_meaning'   => "The E-08 error code on a Samsung wall oven indicates a fault with the bake element relay circuit. The control board uses relays to switch power to the bake heating element. When the board detects that the bake relay is not responding correctly — either failing to close (element won't heat) or failing to open (element stays on) — E-08 is displayed and the oven halts as a safety measure.\n\nE-08 is a control board relay fault, meaning the issue is most commonly with the board itself rather than the bake element.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Bake Relay on Control Board', 'description' => 'The relay component on the main control board has failed. Relays on oven control boards are subject to high electrical stress and are a common failure point on Samsung wall ovens over 5+ years of use.' ],
                    [ 'title' => 'Failed Bake Element',                'description' => 'A completely failed (open circuit) bake element prevents current from flowing through the relay circuit, which the board may detect and report as E-08.' ],
                    [ 'title' => 'Wiring Fault in Bake Circuit',       'description' => 'A break or loose connection in the high-voltage wiring between the board and the bake element.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds and restore power. A one-time transient relay fault may clear.' ],
                    [ 'title' => 'Test the bake element',              'description' => 'With the power off, disconnect the bake element leads and measure resistance across the element terminals. A healthy Samsung bake element typically reads 15–40 ohms. Infinite resistance = failed element. If the element is good, the relay on the control board is the fault.' ],
                ],
                '_ar_when_to_call'   => "Control board relay faults require board replacement in most cases — individual relay replacement on PCBs requires soldering skill and is not typically a DIY repair. A technician can confirm whether the board or element is the root cause and replace the appropriate component.",
                '_ar_cost_range'     => '$180 – $420',
                '_ar_faqs'           => [
                    [ 'question' => 'Can my Samsung wall oven broil with E-08?', 'answer' => 'E-08 specifically involves the bake relay circuit. The broil element uses a separate relay. On many Samsung wall ovens, broil may still function while E-08 is active, though the oven should not be used until repaired.' ],
                    [ 'question' => 'Is E-08 dangerous on a Samsung wall oven?', 'answer' => 'A relay stuck closed (element stays on) is a fire risk. A relay stuck open (element won\'t heat) is not immediately dangerous. In either case, do not use the oven until E-08 is professionally diagnosed.' ],
                ],
            ],
        ],


        // ── bE (Wall Oven) ────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven bE Error Code',
            'slug'       => 'samsung-wall-oven-be-error-code',
            'meta_title' => 'Samsung Wall Oven bE Error Code — Control Panel Button Fault',
            'meta_desc'  => 'Samsung wall oven bE means a button on the control panel is stuck or shorted. Learn the causes and how to fix it.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'bE',
                '_ar_code_meaning'   => "The bE error code on a Samsung wall oven indicates a control panel button fault. The control board has detected a key that is continuously active — either stuck mechanically or shorted electrically — and halts all oven functions until the fault is resolved. On Samsung wall oven models that use bE rather than SE for this fault, the code often points to a specific button failure on the control panel assembly.",
                '_ar_causes'         => [
                    [ 'title' => 'Stuck or Jammed Button',             'description' => 'A push-button on the control panel is jammed in the pressed position.' ],
                    [ 'title' => 'Touchpad Membrane Wear',             'description' => 'The membrane at a frequently pressed key has worn through, creating a permanent contact.' ],
                    [ 'title' => 'Steam from Self-Clean Infiltration', 'description' => 'Steam generated during a self-clean cycle has infiltrated the control panel, causing a key circuit to short.' ],
                    [ 'title' => 'Control Board Key-Scan Fault',       'description' => 'The key-scanning circuit on the main control board has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds and restore power.' ],
                    [ 'title' => 'Identify the stuck key',             'description' => 'After a reset, press each button individually. A button that immediately re-triggers bE has failed.' ],
                ],
                '_ar_when_to_call'   => "Control panel button assembly replacement on a Samsung built-in wall oven requires removing the trim frame — a technician repair.",
                '_ar_cost_range'     => '$130 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Is Samsung wall oven bE the same as SE?', 'answer' => 'Yes — both codes indicate a stuck or shorted control panel key. Samsung uses SE on some models and bE on others for the same fault. The diagnosis and repair are identical.' ],
                ],
            ],
        ],

        // ── E-0C (Wall Oven) ──────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-0C Error Code',
            'slug'       => 'samsung-wall-oven-e0c-error-code',
            'meta_title' => 'Samsung Wall Oven E-0C Error Code — Convection Fan Fault',
            'meta_desc'  => 'Samsung wall oven E-0C means the convection fan motor has a fault. Learn the causes and how it affects convection cooking.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-0C',
                '_ar_code_meaning'   => "The E-0C error code on a Samsung wall oven indicates a fault with the convection fan motor. The convection fan circulates hot air throughout the oven cavity during convection bake and convection roast modes. When the control board detects the fan is not running at expected speed or has stalled, E-0C is displayed. Convection cooking modes are disabled, though standard bake and broil may remain available depending on the model.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Convection Fan Motor',        'description' => 'The motor has burned out or the bearings have seized.' ],
                    [ 'title' => 'Fan Blade Obstruction',              'description' => 'A foreign object inside the oven cavity is contacting the fan blade.' ],
                    [ 'title' => 'Wiring or Connector Fault',          'description' => 'A break or loose connector in the fan motor wiring harness.' ],
                    [ 'title' => 'Control Board Motor Driver Fault',   'description' => 'The motor driver circuit on the control board is not supplying power to the fan.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check for obstructions',             'description' => 'Open the oven and inspect the convection fan cover on the rear wall. Remove any foil or debris that may be in contact with the fan.' ],
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds.' ],
                ],
                '_ar_when_to_call'   => "Convection fan motor replacement requires removing the rear oven cavity panel and the fan element assembly — a technician repair on Samsung built-in wall ovens.",
                '_ar_cost_range'     => '$140 – $350',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I still bake with Samsung wall oven E-0C?', 'answer' => 'Standard bake and broil modes may still function. However, the oven should be serviced promptly — a seized convection motor can cause localized overheating.' ],
                ],
            ],
        ],

        // ── E-14 (Wall Oven) ──────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-14 Error Code',
            'slug'       => 'samsung-wall-oven-e14-error-code',
            'meta_title' => 'Samsung Wall Oven E-14 Error Code — Secondary Temperature Sensor Fault',
            'meta_desc'  => 'Samsung wall oven E-14 means the secondary oven temperature sensor has a fault. Learn the causes and repair options.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-14',
                '_ar_code_meaning'   => "The E-14 error code on a Samsung wall oven indicates a fault with a secondary oven temperature sensor. Some Samsung wall oven models — particularly double wall ovens — use a secondary temperature sensor in addition to the primary probe. E-14 is triggered when this secondary sensor reads outside the valid resistance range. On double wall oven models, E-14 may specifically identify the upper cavity sensor.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Secondary Sensor',            'description' => 'The sensor probe has developed an open or short circuit.' ],
                    [ 'title' => 'Wiring Fault',                       'description' => 'A break or corroded connector in the secondary sensor wiring harness.' ],
                    [ 'title' => 'Control Board Input Fault',          'description' => 'The sensor input circuit on the control board has failed.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Power reset',                        'description' => 'Turn off the circuit breaker for 60 seconds. A transient reading error may clear.' ],
                    [ 'title' => 'Test sensor resistance',             'description' => 'With power off, locate the secondary sensor and test resistance. At room temperature (~70°F), a healthy Samsung sensor reads approximately 1,080 ohms.' ],
                ],
                '_ar_when_to_call'   => "Secondary sensor replacement requires identifying the correct sensor location for your model and accessing the rear of the oven cavity. A technician can confirm which sensor is affected and complete the repair.",
                '_ar_cost_range'     => '$95 – $260',
                '_ar_faqs'           => [
                    [ 'question' => 'Does E-14 affect both cavities on a Samsung double wall oven?', 'answer' => 'Typically only the cavity associated with the secondary sensor is affected. The primary cavity (with the E-11 sensor) may continue to operate normally while E-14 is active.' ],
                ],
            ],
        ],

        // ── E-15 (Wall Oven) ──────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven E-15 Error Code',
            'slug'       => 'samsung-wall-oven-e15-error-code',
            'meta_title' => 'Samsung Wall Oven E-15 Error Code — Temperature Limit Sensor Fault',
            'meta_desc'  => 'Samsung wall oven E-15 means the thermal limit sensor has a fault. Learn why this safety code must be addressed before using the oven again.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'E-15',
                '_ar_code_meaning'   => "The E-15 error code on a Samsung wall oven indicates a fault with the thermal limit sensor or thermal cutout circuit. This is a safety sensor that backs up the primary temperature control — it triggers independently if the oven reaches a dangerous temperature. E-15 means the control board has detected an abnormal reading from this thermal limit circuit, indicating either the cutout has tripped or the sensor itself has failed.\n\nDo not use the oven until E-15 is professionally diagnosed.",
                '_ar_causes'         => [
                    [ 'title' => 'Tripped Thermal Cutout',             'description' => 'A previous overtemperature event — often a self-clean cycle — tripped the thermal cutout. It may need manual reset or replacement.' ],
                    [ 'title' => 'Failed Thermal Limit Sensor',        'description' => 'The sensor element has failed outside its valid range.' ],
                    [ 'title' => 'Wiring Fault',                       'description' => 'A break or loose connection in the thermal limit circuit wiring.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Allow full cooldown',                'description' => 'If E-15 appeared during or after a self-clean or high-temperature cycle, allow the oven to cool completely for 2+ hours before any further action.' ],
                    [ 'title' => 'Power reset after full cooldown',    'description' => 'Turn off the circuit breaker for 60 seconds. Some thermal cutouts auto-reset after full cooling — E-15 may clear.' ],
                ],
                '_ar_when_to_call'   => "If E-15 persists or recurs, a technician is required to test and replace the thermal limit sensor or cutout. Do not bypass or ignore this code.",
                '_ar_cost_range'     => '$110 – $300',
                '_ar_faqs'           => [
                    [ 'question' => 'Is E-15 common after self-clean on a Samsung wall oven?', 'answer' => 'Yes — self-clean cycles reach very high temperatures and are the most common trigger for E-15. A thermal cutout that is marginal from age may trip during self-clean. If E-15 only appears after self-clean and resolves after full cooldown, have the thermal cutout inspected.' ],
                ],
            ],
        ],

        // ── C-21 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven C-21 Error Code',
            'slug'       => 'samsung-wall-oven-c21-error-code',
            'meta_title' => 'Samsung Wall Oven C-21 Error Code — Upper Oven Sensor Fault',
            'meta_desc'  => 'Samsung wall oven C-21 means the upper oven temperature sensor is open or out of range. Learn how to test and replace the sensor quickly.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'C-21',
                '_ar_code_meaning'   => "The C-21 error code on a Samsung wall oven indicates an open or out-of-range resistance reading from the upper oven cavity temperature sensor (RTD sensor). The control board monitors this sensor's resistance to regulate oven temperature precisely. When the sensor circuit reads outside the valid window — caused by a broken sensor, disconnected harness, or shorted wire — C-21 triggers and the upper oven heating is disabled.\n\nBuilt-in wall ovens are particularly susceptible to sensor wiring fatigue over time because the wires flex slightly as the oven heats and cools through thousands of cycles. C-21 on a wall oven should be diagnosed promptly — without a functioning temperature sensor, the oven cannot regulate heat safely.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Upper Oven Temperature Sensor', 'description' => 'The RTD probe mounted on the back wall of the upper oven cavity has developed an internal open or short. A healthy Samsung wall oven sensor reads approximately 1,080–1,090 ohms at room temperature. Any significant deviation confirms sensor failure.' ],
                    [ 'title' => 'Disconnected Sensor Connector',       'description' => 'The two-pin connector joining the sensor probe to the wiring harness has worked loose — common in wall ovens after years of thermal cycling. Reseating the connector sometimes resolves C-21 without part replacement.' ],
                    [ 'title' => 'Broken Sensor Wire',                  'description' => 'The sensor wires pass through the oven cavity insulation to reach the control board. A wire broken by heat fatigue, sharp bending, or pinching during installation creates an open circuit that triggers C-21.' ],
                    [ 'title' => 'Control Board Input Failure',         'description' => 'If the sensor and its wiring test within spec, the sensor input circuit on the control board may have failed. This is the least common cause and requires board-level diagnosis.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Access the upper oven sensor',        'description' => 'Turn off the circuit breaker to the wall oven. Open the upper oven door and locate the sensor probe on the back cavity wall — typically held by one or two screws. Remove the screws and pull the sensor forward enough to access the connector behind the wall.' ],
                    [ 'title' => 'Test sensor resistance',              'description' => 'Disconnect the sensor connector and measure across both terminals with a multimeter set to ohms. Expected reading at room temperature: 1,080–1,090 ohms. A reading of 0 (short) or OL/infinity (open) confirms the sensor has failed and needs replacement.' ],
                    [ 'title' => 'Inspect and reseat wiring connectors', 'description' => 'Trace the sensor wiring from the probe back to the control board and reseat every connector. Inspect for pinched, scorched, or broken wires. Repair or replace the harness section if damage is found.' ],
                ],
                '_ar_when_to_call'   => "Wall oven sensor replacement requires working in a tight cabinet opening and routing wires through the rear cavity wall. If the sensor tests good and C-21 persists, the control board needs professional diagnosis.",
                '_ar_cost_range'     => '$95 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'What resistance should a Samsung wall oven sensor read?', 'answer' => 'Approximately 1,080–1,090 ohms at room temperature (70°F / 21°C). The resistance climbs as temperature increases. A reading of zero ohms or infinite resistance (OL on a digital multimeter) confirms the sensor has failed.' ],
                    [ 'question' => 'Can I use the lower oven while C-21 shows on my Samsung double wall oven?', 'answer' => 'Yes — on Samsung double wall ovens, C-21 disables only the upper oven. The lower oven operates independently on its own sensor circuit and is typically unaffected by C-21.' ],
                    [ 'question' => 'Is C-21 on a Samsung wall oven the same as on a range?', 'answer' => 'The fault is identical — an open or out-of-range upper oven sensor circuit. The sensor part numbers and resistance specifications are the same across Samsung wall ovens and ranges. The diagnostic steps are also the same.' ],
                ],
            ],
        ],

        // ── C-22 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven C-22 Error Code',
            'slug'       => 'samsung-wall-oven-c22-error-code',
            'meta_title' => 'Samsung Wall Oven C-22 Error Code — Lower Oven Sensor Fault',
            'meta_desc'  => 'Samsung wall oven C-22 means the lower oven temperature sensor is open or out of range. Learn how to diagnose and replace the lower sensor.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'C-22',
                '_ar_code_meaning'   => "The C-22 error code on a Samsung wall oven indicates a fault with the lower oven cavity temperature sensor. On double wall oven models, the lower oven has its own dedicated RTD sensor probe. C-22 triggers when the control board reads an open circuit, a short circuit, or a resistance value outside the valid range from the lower sensor circuit.\n\nC-22 is the lower-oven counterpart to C-21 and follows the same diagnostic process — the difference is simply which oven cavity's sensor has failed. On single wall oven models, C-22 may refer to a secondary sensor monitoring the broil or lower heating element zone depending on firmware version.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Lower Oven Temperature Sensor', 'description' => 'The RTD probe in the lower oven cavity has failed — open or shorted internally. At room temperature the sensor should measure approximately 1,080–1,090 ohms. A value significantly outside this range confirms replacement is needed.' ],
                    [ 'title' => 'Loose or Disconnected Sensor Harness', 'description' => 'The sensor wiring connector has pulled away from the probe or from the control board terminal. Thermal expansion and contraction cycles can loosen connectors in wall ovens over years of service.' ],
                    [ 'title' => 'Damaged Sensor Wiring',               'description' => 'The wires carrying the sensor signal pass through insulated channels in the oven cavity walls. Heat degradation of the wire insulation, pinching during installation, or rodent damage can break the conductor and trigger C-22.' ],
                    [ 'title' => 'Control Board Sensor Circuit Failure', 'description' => 'When the sensor and wiring test within specification, the lower sensor input on the main control board has failed. Board replacement is required in this scenario.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Turn off power at the circuit breaker', 'description' => 'Wall ovens are hardwired to a dedicated 240V circuit. Turn off the corresponding circuit breaker before accessing any internal components. Verify power is off with a non-contact voltage tester at the oven terminal block.' ],
                    [ 'title' => 'Locate and test the lower oven sensor', 'description' => 'Open the lower oven door and find the sensor probe on the back cavity wall. Remove the mounting screws, pull the sensor forward, disconnect the connector, and test resistance with a multimeter. Expected: 1,080–1,090 ohms at room temperature.' ],
                    [ 'title' => 'Trace and inspect sensor wiring',      'description' => 'Follow the sensor wires from the probe through the rear cavity wall to the control board. Check for any visible damage, burns, or disconnected terminals. Reseat all connectors fully.' ],
                ],
                '_ar_when_to_call'   => "If the lower sensor tests good and wiring is intact but C-22 persists, the main control board needs professional diagnosis. On hardwired wall ovens, all electrical work beyond sensor replacement should be performed by a certified technician.",
                '_ar_cost_range'     => '$95 – $330',
                '_ar_faqs'           => [
                    [ 'question' => 'Can the upper oven still work when C-22 shows on a Samsung double wall oven?', 'answer' => 'Yes — C-22 affects only the lower oven sensor circuit on double wall ovens. The upper oven runs on its own sensor (C-21 circuit) and operates independently when the lower oven sensor has failed.' ],
                    [ 'question' => 'How do I know if C-22 is the sensor or the control board?', 'answer' => 'Test the sensor resistance first — if it reads 1,080–1,090 ohms at room temperature, the sensor is good. Next, inspect all wiring for continuity. Only if both the sensor and wiring test good should the control board be suspected as the cause of C-22.' ],
                    [ 'question' => 'My Samsung wall oven shows C-22 after self-clean — is this normal?', 'answer' => 'Self-clean cycles reach approximately 900°F and stress every component in the oven, including temperature sensors. C-22 appearing after a self-clean cycle often indicates the lower sensor was already degraded and the extreme heat caused a final failure. Inspect and test the sensor.' ],
                ],
            ],
        ],

        // ── C-23 (Wall Oven) ─────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Samsung Wall Oven C-23 Error Code',
            'slug'       => 'samsung-wall-oven-c23-error-code',
            'meta_title' => 'Samsung Wall Oven C-23 Error Code — Cooling Fan Sensor Fault',
            'meta_desc'  => 'Samsung wall oven C-23 signals a cooling fan area or auxiliary sensor fault. Learn the causes and how to resolve this error safely.',
            'taxonomies' => [ 'brand' => 'Samsung', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Samsung',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'C-23',
                '_ar_code_meaning'   => "The C-23 error code on a Samsung wall oven indicates a fault in a third temperature sensor circuit — typically the cooling fan area sensor that monitors the electronics compartment temperature, or an auxiliary sensor in the second cavity zone on double-oven models. The control board uses this sensor to protect the control electronics from overheating.\n\nC-23 on a wall oven is especially important to address promptly. Wall ovens sit in enclosed cabinet cutouts with limited air circulation. If the cooling fan has failed or the auxiliary sensor has detected an overheat condition in the electronics bay, continued operation risks permanent control board damage. The oven halts heating as a safety precaution when C-23 triggers.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Cooling Fan Motor',            'description' => 'The cooling fan that moves air through the electronics compartment has seized or its motor has burned out. Without active cooling, the control board quickly overheats in an enclosed cabinet installation, triggering C-23.' ],
                    [ 'title' => 'Failed Auxiliary Temperature Sensor', 'description' => 'The sensor monitoring the cooling fan area or auxiliary zone has failed with an open or shorted element. The control board reads an invalid resistance and generates C-23 even if actual temperatures are normal.' ],
                    [ 'title' => 'Blocked Cabinet Ventilation',         'description' => 'Insufficient airflow around the wall oven cabinet cutout causes the electronics bay to overheat. A C-23 triggered by heat — rather than sensor failure — typically clears after the oven cools but returns when used again.' ],
                    [ 'title' => 'Sensor Wiring Fault',                 'description' => 'Damaged or disconnected wiring in the cooling area sensor circuit returns an out-of-range reading, triggering C-23. In wall ovens, wiring near the cooling fan can be damaged by fan blade contact over time.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check cabinet ventilation clearances', 'description' => 'Confirm the wall oven installation meets Samsung\'s minimum ventilation clearances — typically 1 inch on sides and rear, with the required trim kit installed. Blocked vents or missing trim pieces restrict cooling airflow and cause C-23 from overheating.' ],
                    [ 'title' => 'Listen for cooling fan operation',    'description' => 'After a baking cycle ends, the cooling fan should run for several minutes. If you hear no fan noise from the vent slots at the top of the oven, the cooling fan may have failed. Access the fan from the rear service panel.' ],
                    [ 'title' => 'Test the auxiliary sensor resistance', 'description' => 'Identify the C-23 sensor location from the wiring diagram (typically found on the back panel label or in the installation guide). Disconnect and test resistance with a multimeter — expected reading approximately 1,080–1,090 ohms at room temperature.' ],
                ],
                '_ar_when_to_call'   => "A failed cooling fan in a wall oven creates a real risk of control board heat damage — call a certified technician promptly if the fan is confirmed stopped. Accessing the cooling fan in a hardwired wall oven requires pulling the unit from the cabinet, which should be done by a professional.",
                '_ar_cost_range'     => '$110 – $360',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Samsung wall oven show C-23 only after long baking cycles?', 'answer' => 'C-23 appearing after long cycles — but not short ones — indicates an overheating condition rather than a sensor failure. The electronics bay temperature rises to the trigger threshold during extended operation. Check cabinet ventilation clearances and inspect the cooling fan.' ],
                    [ 'question' => 'Are C-21, C-22, and C-23 related on Samsung wall ovens?', 'answer' => 'Yes — all three are sensor circuit fault codes using the same RTD sensor type. C-21 = upper oven sensor, C-22 = lower oven sensor, C-23 = cooling fan area or auxiliary sensor. The diagnostic process is identical for all three: test sensor resistance, inspect wiring, then suspect the control board.' ],
                    [ 'question' => 'Can I reset C-23 on my Samsung wall oven by turning off the breaker?', 'answer' => 'You can reset the error by turning off the circuit breaker for 5 minutes. If C-23 triggered from a transient temperature spike it may not return. However, if it recurs on the next use, the cooling fan or sensor requires inspection and repair before the oven is used again.' ],
                ],
            ],
        ],

    ]; // end ar_error_codes_samsung_wall_oven()
}