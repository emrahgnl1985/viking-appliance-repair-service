<?php
/**
 * Viking Appliance Repair Service — Fault Code Page Content Data
 *
 * Brand: Viking only (USA market)
 * Covers documented Viking fault codes and diagnostic indicators for all
 * Viking appliance types available in the USA.
 *
 * IMPORTANT: Only verified, documented Viking fault codes are included.
 * Source: Viking Range LLC service documentation and authorized service data.
 * Wall oven F-codes use the same ERC (Electronic Range Control) architecture
 * as Viking ranges. Other appliances use documented diagnostic fault categories.
 *
 * Each entry powers template-error-code.php via ACF meta fields:
 *   _ar_brand, _ar_appliance_type, _ar_error_code, _ar_code_meaning,
 *   _ar_causes[], _ar_diy_steps[], _ar_when_to_call, _ar_cost_range, _ar_faqs[]
 *
 * URL structure: /error-codes/{appliance}/{slug}/
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_error_codes_data(): array {
    return ar_error_codes_viking();
}

function ar_error_codes_viking(): array {
    return array_merge(
        ar_error_codes_viking_range_oven(),
        ar_error_codes_viking_wall_oven(),
        ar_error_codes_viking_refrigerator(),
        ar_error_codes_viking_dishwasher(),
        ar_error_codes_viking_cooktop(),
        ar_error_codes_viking_wine_cooler(),
        ar_error_codes_viking_freezer(),
        ar_error_codes_viking_vent_hood()
    );
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING RANGE & OVEN FAULT CODES (F-Series)
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_range_oven(): array {
    return [

        // ── F1 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Range F1 Fault Code',
            'slug'       => 'viking-range-f1-fault-code',
            'meta_title' => 'Viking Range F1 Fault Code — Control Board Failure',
            'meta_desc'  => 'The Viking range F1 fault code indicates a control board failure. Learn what causes it and when professional service is required.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_error_code'     => 'F1',
                '_ar_code_meaning'   => "The F1 fault code on a Viking range or wall oven indicates a failure of the main electronic control board (ERC — Electronic Range Control). The control board has detected an internal fault that prevents normal oven operation.\n\nF1 is typically triggered after the control board has been subject to a power surge, a voltage spike, or internal component failure from heat or age. The oven will not operate while F1 is active. In some cases, clearing the code by cycling the circuit breaker will restore temporary operation, but if F1 returns, the control board requires professional diagnosis and likely replacement.",
                '_ar_causes'         => [
                    [ 'title' => 'Control Board Internal Failure', 'description' => 'The main electronic control board (ERC) has developed an internal fault — typically from a failed relay, failed capacitor, or damaged microprocessor component caused by heat cycling, age, or voltage irregularity.' ],
                    [ 'title' => 'Power Surge or Voltage Spike',   'description' => 'A power surge during a thunderstorm or grid event can damage sensitive control board components. The board may work intermittently before fully failing with a persistent F1 code.' ],
                    [ 'title' => 'Faulty Wiring Connection',       'description' => 'In some cases, a loose or corroded wiring harness connector to the control board produces an F1 fault. Our technician checks wiring continuity before recommending board replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Reset the oven',                 'description' => 'Switch off the circuit breaker that powers the range or wall oven for 60 seconds, then switch it back on. If F1 does not return immediately, the board may have experienced a transient fault. Monitor for recurrence.' ],
                    [ 'title' => 'Check for recurrence',           'description' => 'If F1 returns within a short period after reset — or returns as soon as the oven is used — the control board has failed and requires professional replacement. Do not continue attempting to use the oven.' ],
                ],
                '_ar_when_to_call'   => "F1 codes that return after circuit breaker reset require professional diagnosis. Our technician will verify the wiring harness before confirming control board failure and recommending replacement. A control board replacement restores full oven function and is completed in a single visit.",
                '_ar_cost_range'     => '$250 – $480',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I reset a Viking F1 code myself?', 'answer' => 'Yes — switch off the circuit breaker for the range for 60 seconds and restore power. If F1 does not return during normal use, the code may have been a transient event. However, if F1 returns after reset, the control board has failed and the oven should not be used until professionally repaired.' ],
                    [ 'question' => 'Is a Viking range control board expensive to replace?', 'answer' => 'Viking control board replacements are a meaningful repair cost, but significantly less than oven replacement. Viking ranges are designed for a 20+ year service life, making control board replacement almost always the better economic choice on a unit less than 15 years old.' ],
                    [ 'question' => 'Can a power surge cause a Viking F1 fault?', 'answer' => 'Yes. Power surges are a common cause of control board failure in Viking ranges and ovens. If F1 appeared immediately after a thunderstorm or power outage, a surge likely damaged the board. We recommend installing a surge protector on the appliance circuit to prevent recurrence.' ],
                ],
            ],
        ],

        // ── F2 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Range F2 Fault Code',
            'slug'       => 'viking-range-f2-fault-code',
            'meta_title' => 'Viking Range F2 Fault Code — Oven Temperature Sensor Shorted',
            'meta_desc'  => 'The Viking F2 fault code means the oven temperature sensor is reading a short circuit. Learn what causes F2 and how it is repaired.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_error_code'     => 'F2',
                '_ar_code_meaning'   => "The F2 fault code on a Viking range or wall oven indicates that the oven temperature sensor (RTD probe) is reading a short circuit condition — the sensor resistance is lower than the acceptable minimum for the current temperature. The oven control board interprets this as an implausibly high temperature reading and shuts down oven operation as a safety precaution.\n\nF2 is one of the most common Viking oven fault codes and in the majority of cases is caused by a failed temperature sensor probe rather than a wiring or board issue. The temperature sensor probe is a straightforward part to replace and most F2 repairs are completed in a single visit.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Oven Temperature Sensor',   'description' => 'The oven RTD (Resistance Temperature Detector) probe has failed internally, causing its resistance to drop below the valid range. This is the most common cause of F2 and requires sensor probe replacement.' ],
                    [ 'title' => 'Short in Sensor Wiring',           'description' => 'The wiring from the temperature sensor to the control board has developed a short circuit — usually from a wire chafing against the oven cavity wall, or from a wire connector becoming damaged. We inspect the wiring harness before replacing the sensor.' ],
                    [ 'title' => 'Control Board Sensor Input Fault', 'description' => 'Less commonly, the sensor input circuit on the control board itself has failed. This is diagnosed after confirming the sensor probe and wiring are within specification.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Reset the oven',                   'description' => 'Turn off the circuit breaker for 60 seconds and restore power. If F2 returns immediately or during oven use, the sensor has failed and requires replacement.' ],
                    [ 'title' => 'Inspect the sensor probe',         'description' => 'The temperature sensor probe is typically located inside the oven cavity on the upper back wall, held by one or two screws. Inspect the probe for visible damage, corrosion, or contact with the oven cavity. A burned or corroded sensor probe should be replaced.' ],
                ],
                '_ar_when_to_call'   => "If F2 returns after reset, professional service is required to test the sensor resistance with a multimeter and confirm whether the sensor probe, wiring, or control board is at fault. In the majority of F2 cases, sensor replacement resolves the code completely. Our technicians carry the correct Viking OEM sensor probes and can complete this repair on the first visit.",
                '_ar_cost_range'     => '$130 – $230',
                '_ar_faqs'           => [
                    [ 'question' => 'What does F2 mean on my Viking oven?', 'answer' => 'F2 on a Viking oven means the temperature sensor (RTD probe inside the oven cavity) is reading a short circuit — the sensor\'s resistance is lower than it should be. The oven cannot safely regulate temperature with a faulty sensor, so it shuts down. In most cases, sensor replacement resolves the F2 code completely.' ],
                    [ 'question' => 'Can I use my Viking oven with an F2 code?', 'answer' => 'No. When F2 is active, the oven\'s temperature control system is not functioning correctly. Operating the oven with a shorted sensor risks temperature runaway — the oven could overheat significantly beyond the set temperature. Do not use the oven until the F2 fault is repaired.' ],
                    [ 'question' => 'How long does F2 sensor replacement take?', 'answer' => 'Viking oven temperature sensor replacement is typically completed in 45–75 minutes. Our technicians carry Viking OEM sensor probes and can complete the repair on the first visit in most cases.' ],
                ],
            ],
        ],

        // ── F3 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Range F3 Fault Code',
            'slug'       => 'viking-range-f3-fault-code',
            'meta_title' => 'Viking Range F3 Fault Code — Oven Temperature Sensor Open Circuit',
            'meta_desc'  => 'The Viking F3 fault code means the oven temperature sensor has an open circuit. Learn the causes and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_error_code'     => 'F3',
                '_ar_code_meaning'   => "The F3 fault code on a Viking range or wall oven indicates an open circuit in the oven temperature sensor system — the sensor's resistance is higher than the acceptable maximum, or the circuit has broken completely. The oven control board receives no valid temperature signal and shuts down oven operation.\n\nLike F2, the F3 code is most commonly caused by the temperature sensor probe itself — in this case from a broken internal element rather than a short. A disconnected sensor connector or a broken wire in the sensor harness will also produce F3.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Oven Temperature Sensor',   'description' => 'The RTD probe element has broken internally, causing an open circuit. This is the most common cause of F3. The probe is a discrete replaceable component.' ],
                    [ 'title' => 'Disconnected or Broken Wiring',    'description' => 'The connector that joins the sensor probe wiring to the main harness has become disconnected, or the wire has broken. This typically occurs if the wire has been pinched during previous service or has fatigued from heat cycling over many years.' ],
                    [ 'title' => 'Control Board Sensor Input Fault', 'description' => 'The sensor input circuit on the control board has failed, causing it to read infinite resistance even with a good sensor. This is confirmed after testing the sensor and wiring separately.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check the sensor connector',       'description' => 'The temperature sensor probe connects to the main wiring harness via a two-pin connector behind the oven back panel. If you are comfortable with basic appliance access, verify the connector is fully seated. A disconnected connector will produce F3 and is a simple fix.' ],
                    [ 'title' => 'Reset the oven',                   'description' => 'Cycle the circuit breaker off for 60 seconds. If F3 returns immediately, the sensor or wiring has failed and requires professional service.' ],
                ],
                '_ar_when_to_call'   => "F3 requires professional diagnosis to confirm whether the sensor probe, wiring harness, or control board is the root cause. Our technicians test sensor resistance with calibrated instruments and inspect the harness before recommending a specific repair. Most F3 repairs are sensor replacements completed in a single visit.",
                '_ar_cost_range'     => '$130 – $230',
                '_ar_faqs'           => [
                    [ 'question' => 'What is the difference between Viking F2 and F3?', 'answer' => 'F2 indicates the temperature sensor is reading a short circuit (resistance too low), while F3 indicates an open circuit (resistance too high or broken connection). Both codes shut down the oven. The diagnostic process and repair are similar — we test the sensor resistance to determine whether F2 or F3 is caused by the probe itself or by the wiring.' ],
                    [ 'question' => 'My Viking oven shows F3 — can I reset it?', 'answer' => 'You can attempt a reset by switching the circuit breaker off for 60 seconds. If F3 returns, the temperature sensor probe or its wiring has failed and must be replaced. The oven should not be used with an active F3 code as temperature regulation is disabled.' ],
                ],
            ],
        ],

        // ── F4 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Range F4 Fault Code',
            'slug'       => 'viking-range-f4-fault-code',
            'meta_title' => 'Viking Range F4 Fault Code — Oven Temperature Runaway',
            'meta_desc'  => 'The Viking F4 fault code signals an oven temperature runaway — the oven exceeded the set temperature. Learn what causes F4 and the required repair.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_error_code'     => 'F4',
                '_ar_code_meaning'   => "The F4 fault code on a Viking range or wall oven indicates a temperature runaway condition — the oven temperature has exceeded the set temperature by a significant margin without the control board being able to correct it. The oven shuts down immediately when F4 triggers.\n\nF4 is a safety-critical fault. It means the heating element or gas burner continued heating beyond the set point, which in an uncorrected failure could result in a fire hazard. F4 is most commonly caused by a failed oven relay on the control board that has stuck in the 'on' position, continuously supplying power to the heating element regardless of temperature feedback.",
                '_ar_causes'         => [
                    [ 'title' => 'Stuck Oven Relay on Control Board', 'description' => 'The oven relay on the control board — the electronic switch that cycles the heating element on and off based on temperature feedback — has failed stuck-closed. This causes the element to run continuously, driving the oven temperature far above the set point.' ],
                    [ 'title' => 'Failed Oven Heating Element (Stuck)',  'description' => 'In rare cases, the heating element itself fails in a way that bypasses the relay control and maintains a current path. This requires element replacement and often control board inspection.' ],
                    [ 'title' => 'Faulty Temperature Sensor',          'description' => 'If the temperature sensor is providing an inaccurately low reading to the control board, the board believes the oven is cooler than it actually is and continues heating. However, a shorted sensor typically triggers F2 before F4 can occur.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Do not continue using the oven',     'description' => 'F4 is a safety-critical fault indicating the heating system ran out of control. Switch off the circuit breaker for the oven and leave it off until the oven has been professionally inspected. Do not attempt a reset and immediate reuse.' ],
                ],
                '_ar_when_to_call'   => "F4 requires immediate professional service. This code indicates an active safety fault in the heating control system. Our technician will diagnose whether the control board relay or the heating element is the cause, and complete the repair with genuine Viking OEM parts. Do not operate the oven with F4 active.",
                '_ar_cost_range'     => '$200 – $460',
                '_ar_faqs'           => [
                    [ 'question' => 'Is F4 on a Viking oven dangerous?', 'answer' => 'F4 indicates the oven heating system operated without the normal temperature control limits being enforced. While the oven shuts itself down when F4 triggers, the fault that caused it — typically a stuck relay — could allow the oven to overheat significantly if used again before repair. We recommend treating F4 as a safety fault and not using the oven until it has been professionally repaired.' ],
                    [ 'question' => 'What parts are typically replaced for an F4 fault?', 'answer' => 'F4 most commonly requires control board replacement to replace the failed oven relay. In some cases the heating element is also replaced if it shows evidence of damage from the runaway event. Our technician confirms the specific failed component before ordering parts.' ],
                ],
            ],
        ],

        // ── F7 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Range F7 Fault Code',
            'slug'       => 'viking-range-f7-fault-code',
            'meta_title' => 'Viking Range F7 Fault Code — Key Stuck / Keypad Failure',
            'meta_desc'  => 'The Viking F7 fault code means a key on the control panel keypad is stuck or shorted. Learn what causes F7 and how to fix it.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_error_code'     => 'F7',
                '_ar_code_meaning'   => "The F7 fault code on a Viking range or wall oven indicates that a key on the control panel keypad is registering as continuously pressed — a 'stuck key' fault. The control board detects this as an invalid input state and displays F7 to alert the user.\n\nF7 most commonly occurs after moisture — from steam, spills, or condensation — enters the keypad membrane and causes one or more key contacts to remain electrically closed. Physical damage to the control panel face from impact can also produce F7.",
                '_ar_causes'         => [
                    [ 'title' => 'Moisture in the Keypad Membrane',   'description' => 'Steam from boiling pots on the cooktop, condensation, or liquid spilled on the control panel can seep into the keypad membrane and cause one or more key contacts to short, registering a continuously pressed key.' ],
                    [ 'title' => 'Damaged Keypad Membrane',            'description' => 'Physical pressure or impact on the control panel face can damage the membrane contacts beneath, causing a key to register as permanently pressed.' ],
                    [ 'title' => 'Failed Control Board Key Input',     'description' => 'Less commonly, the key input circuit on the control board itself has failed and reports a stuck key. This is confirmed after the keypad membrane has been inspected and tested.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Allow the panel to dry',             'description' => 'If F7 appeared after cooking with steam or after a spill near the control panel, turn the oven off and allow the control panel area to dry completely for several hours. Remove the power at the circuit breaker to fully de-energize the panel. Restore power after drying and check if F7 clears.' ],
                    [ 'title' => 'Reset the oven',                     'description' => 'Switch off the circuit breaker for 60 seconds and restore power. If F7 returns quickly — especially without any moisture exposure — the keypad membrane has failed and requires replacement.' ],
                ],
                '_ar_when_to_call'   => "If F7 returns after the panel has been thoroughly dried and reset, the keypad membrane needs professional replacement. Our technicians replace the Viking keypad membrane with a genuine Viking OEM component and test all key inputs after installation. This repair is typically completed in a single visit.",
                '_ar_cost_range'     => '$160 – $310',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Viking oven show F7 after I cooked on the stovetop?', 'answer' => 'Heavy steam from boiling can condense on and around the control panel, seeping into the keypad membrane. This is the most common trigger for F7. Allow the area to dry completely with the oven off and the circuit breaker switched off for several hours. If F7 clears and does not return, the moisture has dried out. If F7 returns, the membrane has been permanently damaged by the moisture and requires replacement.' ],
                    [ 'question' => 'Can I use my Viking range with an F7 code?', 'answer' => 'An F7 code disables normal control panel operation. The oven should not be used with F7 active, as the control board cannot receive reliable keypad input. The burners may still operate via the mechanical knobs on some models, but oven and timer functions will be unavailable.' ],
                ],
            ],
        ],

        // ── F9 ───────────────────────────────────────────────────────────────
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Range F9 Fault Code',
            'slug'       => 'viking-range-f9-fault-code',
            'meta_title' => 'Viking Range F9 Fault Code — Self-Clean Door Lock Failure',
            'meta_desc'  => 'The Viking F9 fault code means the self-clean door lock has not operated correctly. Learn what causes F9 and what the repair involves.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Range' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Range',
                '_ar_error_code'     => 'F9',
                '_ar_code_meaning'   => "The F9 fault code on a Viking range or wall oven indicates a door lock failure during or before the self-clean cycle. The oven requires the door lock mechanism to engage before the self-clean cycle can begin — if the lock does not engage within the allotted time, F9 is triggered and the self-clean cycle is cancelled as a safety measure.\n\nF9 can also appear if the door lock mechanism does not disengage after a self-clean cycle completes, leaving the oven door locked. In either scenario, the door lock motor assembly or its associated components require service.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Lock Motor',             'description' => 'The motor that drives the door lock mechanism has failed and cannot complete its travel to the locked or unlocked position. This is the most common cause of F9 and requires door lock motor assembly replacement.' ],
                    [ 'title' => 'Failed Door Lock Switch',            'description' => 'The switch that reports the door lock position to the control board has failed, even though the lock mechanism itself may have moved correctly. The board receives no confirmation of lock engagement and triggers F9.' ],
                    [ 'title' => 'Obstruction in Door Lock Path',     'description' => 'Food debris or physical obstruction in the door lock track prevents the lock from completing its travel. Cleaning the door frame and lock track may resolve this before a motor replacement is needed.' ],
                    [ 'title' => 'Door Alignment Issue',               'description' => 'If the oven door has become misaligned — from hinge wear or a hard impact — the door lock mechanism may not align correctly with the door catch, preventing engagement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Inspect the door lock area',         'description' => 'With the oven off and cool, inspect the door frame area around the latch for food debris or obstructions. Clean the area around the door lock mechanism with a damp cloth. Attempt the self-clean cycle again after cleaning.' ],
                    [ 'title' => 'Reset the oven',                     'description' => 'If the door is locked after a self-clean cycle with F9 displayed, switch off the circuit breaker for 5 minutes, then restore power. In some cases the lock motor will complete its return travel on power-up. If the door remains locked, do not force it — professional service is required.' ],
                ],
                '_ar_when_to_call'   => "If F9 returns after cleaning around the lock mechanism and resetting the oven, the door lock motor assembly requires professional replacement. Our technicians replace the Viking door lock assembly with a genuine OEM component and test the self-clean cycle to confirm resolution. Do not attempt to force the door open if it is locked — this can damage the latch mechanism further.",
                '_ar_cost_range'     => '$150 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'My Viking oven door is locked and shows F9 — how do I open it?', 'answer' => 'First, switch off the circuit breaker for the oven for 5 minutes, then restore power. In many cases the door lock motor will reset and release the door on power-up. If the door remains locked after this, professional service is required to disassemble the lock mechanism from the inside without forcing the door latch. Never force the door open — this can break the latch permanently.' ],
                    [ 'question' => 'Is the F9 fault related to the self-clean cycle only?', 'answer' => 'F9 appears specifically during or after the self-clean cycle because the door lock mechanism is only activated for self-cleaning. The code indicates the lock did not engage before the cycle started, or did not disengage after the cycle ended. The oven\'s regular cooking functions do not require the door lock.' ],
                    [ 'question' => 'How long does F9 door lock repair take?', 'answer' => 'Viking door lock motor assembly replacement is typically completed in 60–90 minutes. Our technicians carry the correct Viking OEM door lock assemblies and can complete this repair on the first visit in most cases.' ],
                ],
            ],
        ],

    ]; // end array_merge inner array
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING WALL OVEN FAULT CODES (F-Series — same ERC as Range)
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_wall_oven(): array {
    return [
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Wall Oven F2 Fault Code',
            'slug'       => 'viking-wall-oven-f2-fault-code',
            'meta_title' => 'Viking Wall Oven F2 Fault Code — Oven Temperature Sensor Shorted',
            'meta_desc'  => 'The Viking wall oven F2 fault code indicates the oven temperature sensor is reading a short circuit. Learn what causes F2 and how it is repaired.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'F2',
                '_ar_code_meaning'   => "The F2 fault code on a Viking wall oven indicates the oven temperature sensor (RTD probe) is reading a short circuit — the sensor resistance is lower than the acceptable minimum for the current temperature. Viking wall ovens use the same Electronic Range Control (ERC) architecture as Viking ranges, so F-codes are identical across both product types.\n\nF2 is one of the most common Viking wall oven fault codes and in the majority of cases is caused by a failed temperature sensor probe rather than a wiring or board issue.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Oven Temperature Sensor Probe', 'description' => 'The RTD temperature sensor probe has developed an internal short. The probe is a separate, replaceable component mounted inside the oven cavity. Replacement with a genuine Viking OEM probe restores accurate temperature sensing.' ],
                    [ 'title' => 'Short in Sensor Wiring',              'description' => 'The wiring between the sensor and the control board has developed a short — typically from a wire chafing against the oven cavity or a corroded connector. Our technician inspects the harness before recommending probe replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Reset the wall oven',    'description' => 'Switch off the circuit breaker powering the wall oven for 60 seconds, then restore power. If F2 does not return immediately, monitor the oven for recurrence before scheduling service.' ],
                    [ 'title' => 'Do not use the oven',   'description' => 'If F2 returns after reset, the oven cannot regulate temperature safely. Do not attempt to bake or broil until the sensor has been professionally replaced.' ],
                ],
                '_ar_when_to_call'   => 'F2 codes that return after reset require professional sensor replacement. Our technician tests sensor resistance, confirms the short, and replaces the probe using a genuine Viking OEM part. This repair is typically completed in a single visit.',
                '_ar_cost_range'     => '$130 – $220',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I use my Viking wall oven with an F2 code?', 'answer' => 'No. F2 means the oven\'s temperature sensor is reporting a short circuit, so the oven cannot accurately measure or control temperature. Using the oven with F2 active risks overheating and should be avoided until the sensor is replaced.' ],
                    [ 'question' => 'Is the Viking wall oven F2 code the same as the range F2 code?', 'answer' => 'Yes. Viking wall ovens use the same Electronic Range Control (ERC) architecture as Viking ranges. The F2 fault code has the same meaning and is diagnosed and repaired the same way in both product types.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Wall Oven F9 Fault Code',
            'slug'       => 'viking-wall-oven-f9-fault-code',
            'meta_title' => 'Viking Wall Oven F9 Fault Code — Self-Clean Door Lock Failure',
            'meta_desc'  => 'The Viking wall oven F9 fault code means the self-clean door lock has not engaged or disengaged correctly. Learn what causes F9 and how it is repaired.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'F9',
                '_ar_code_meaning'   => "The F9 fault code on a Viking wall oven indicates the self-clean door lock mechanism has not engaged or disengaged correctly. Viking wall ovens require the door lock to engage fully before the self-clean cycle can start. If the lock does not confirm engagement within the required time, F9 is triggered and the self-clean cycle is cancelled as a safety measure.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Lock Motor Assembly', 'description' => 'The motor that drives the door lock bolt has failed and cannot complete its travel to the locked or unlocked position. Door lock motor replacement restores self-clean capability.' ],
                    [ 'title' => 'Door Lock Switch Failure',        'description' => 'The switch that reports door lock position to the control board has failed, even though the lock mechanism may have moved correctly.' ],
                    [ 'title' => 'Obstruction in Lock Track',       'description' => 'Food debris or a physical obstruction in the door lock track prevents the bolt from completing its travel. Cleaning the area around the latch may resolve this without a parts replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Inspect the door lock area', 'description' => 'With the oven off and cool, inspect the door frame area around the latch bolt for food debris or obstruction. Clean thoroughly. Attempt the self-clean cycle again after cleaning.' ],
                    [ 'title' => 'Reset the oven',             'description' => 'If the door is locked with F9 displayed, switch off the circuit breaker for 5 minutes, then restore power. In many cases the lock motor will reset and release the door.' ],
                ],
                '_ar_when_to_call'   => 'F9 codes that return after cleaning and reset require professional door lock motor replacement. Never force a locked oven door — this can damage the latch mechanism permanently.',
                '_ar_cost_range'     => '$150 – $270',
                '_ar_faqs'           => [
                    [ 'question' => 'My Viking wall oven door is locked with F9 showing — how do I open it?', 'answer' => 'Switch off the circuit breaker for the wall oven for 5 minutes, then restore power. The lock motor should reset and release the door. If the door remains locked, professional service is required to disassemble the lock mechanism safely.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Wall Oven F1 Fault Code',
            'slug'       => 'viking-wall-oven-f1-fault-code',
            'meta_title' => 'Viking Wall Oven F1 Fault Code — Control Board Failure',
            'meta_desc'  => 'The Viking wall oven F1 fault code indicates a control board failure. Learn what causes it and when professional service is required.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Wall Oven' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Wall Oven',
                '_ar_error_code'     => 'F1',
                '_ar_code_meaning'   => "The F1 fault code on a Viking wall oven indicates a failure of the main electronic control board (ERC — Electronic Range Control). The control board has detected an internal fault that prevents normal oven operation. Viking wall ovens use the same ERC architecture as Viking ranges, so F1 diagnosis and repair are identical in both products.",
                '_ar_causes'         => [
                    [ 'title' => 'Control Board Internal Failure', 'description' => 'The ERC has developed an internal fault from a failed relay, capacitor, or microprocessor component caused by age, heat cycling, or voltage irregularity.' ],
                    [ 'title' => 'Power Surge or Voltage Spike',   'description' => 'A power surge during a grid event can damage control board components. F1 appearing immediately after a power outage or thunderstorm suggests surge damage.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Reset the wall oven', 'description' => 'Switch off the circuit breaker for 60 seconds, then restore power. If F1 does not return, the board experienced a transient fault. Monitor for recurrence.' ],
                ],
                '_ar_when_to_call'   => 'F1 codes that return after reset require professional control board diagnosis and replacement. Our technician verifies wiring integrity before recommending board replacement.',
                '_ar_cost_range'     => '$250 – $480',
                '_ar_faqs'           => [
                    [ 'question' => 'Is the Viking wall oven F1 code the same as the range F1 code?', 'answer' => 'Yes. Viking wall ovens and ranges use the same Electronic Range Control (ERC). F1 indicates main control board failure in both products and is diagnosed and repaired identically.' ],
                ],
            ],
        ],
    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING REFRIGERATOR DIAGNOSTIC FAULT INDICATORS
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_refrigerator(): array {
    return [
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Refrigerator Defrost System Fault',
            'slug'       => 'viking-refrigerator-defrost-fault',
            'meta_title' => 'Viking Refrigerator Defrost System Fault — Not Cooling, Frost Buildup',
            'meta_desc'  => 'A Viking refrigerator defrost system fault causes the fresh food compartment to warm while the freezer stays cold. Learn the causes and repair steps.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => 'Defrost Fault',
                '_ar_code_meaning'   => "A defrost system fault in a Viking refrigerator occurs when the automatic defrost cycle fails, allowing ice to accumulate on the evaporator coil. As the coil ices over, it blocks airflow from the freezer to the fresh food compartment — the freezer stays cold while the refrigerator section gradually warms.\n\nSymptoms include a refrigerator compartment that is warmer than set, visible frost or ice on the freezer back wall, and a buzzing or louder-than-normal sound from the evaporator fan area as it struggles against ice buildup. Defrost system faults are one of the most common Viking refrigerator faults.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Defrost Heater',      'description' => 'The defrost heater element that melts accumulated frost from the evaporator coil has burned out. Without the heater running during the defrost cycle, frost builds up continuously until airflow is blocked.' ],
                    [ 'title' => 'Failed Defrost Thermostat',  'description' => 'The defrost thermostat monitors evaporator temperature and cuts power to the defrost heater when the coil reaches the defrost termination temperature. A failed thermostat prevents the heater from receiving power even when the defrost cycle runs.' ],
                    [ 'title' => 'Defrost Control Board Fault','description' => 'The defrost timer or control board component that initiates defrost cycles has failed, so defrost cycles do not occur at all. The evaporator continuously frosts over without any periodic melting.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Manual defrost test',         'description' => 'Remove all food from both compartments and unplug the refrigerator for 24–48 hours with the doors open. If cooling returns after the ice melts and the unit is plugged back in, the defrost system has failed and requires professional repair.' ],
                    [ 'title' => 'Check freezer back panel',    'description' => 'Remove the freezer back panel (held by screws) to inspect the evaporator coil. If the coil is encased in thick ice, the defrost system has failed. Manual defrost is a temporary fix only — the underlying component must be replaced.' ],
                ],
                '_ar_when_to_call'   => 'Defrost system failures require professional diagnosis to identify the specific failed component (heater, thermostat, or control board) before parts are ordered. Our technician identifies the fault and replaces only the failed component, completing the repair in a single visit.',
                '_ar_cost_range'     => '$160 – $320',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Viking refrigerator warm but the freezer is cold?', 'answer' => 'This is the classic symptom of a defrost system failure. The evaporator coil that cools both compartments is located in the freezer section. When the coil ices over due to a failed defrost component, cold air can no longer flow to the refrigerator compartment, while the freezer — in direct contact with the coil — remains cold.' ],
                    [ 'question' => 'How quickly will food spoil with a defrost failure?', 'answer' => 'Refrigerator compartment temperature will typically rise above 40°F (the food safety limit) within 4–8 hours of the cooling failure becoming complete. Once the refrigerator warms above 40°F, perishables should be moved to a cooler with ice or another refrigerator immediately.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Refrigerator Ice Maker Fault',
            'slug'       => 'viking-refrigerator-ice-maker-fault',
            'meta_title' => 'Viking Refrigerator Ice Maker Not Working — Diagnosis & Repair',
            'meta_desc'  => 'Viking refrigerator ice maker not producing ice? Learn the most common causes and repair steps for Viking built-in and French door refrigerator ice makers.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => 'Ice Maker Fault',
                '_ar_code_meaning'   => "A Viking refrigerator ice maker fault occurs when the ice maker assembly stops producing ice, produces ice in irregular quantities, or produces ice that is malformed (hollow, thin, or smaller than normal).\n\nViking refrigerators use an automatic ice maker assembly connected to a water inlet valve and a dedicated ice maker thermostat. When ice production stops completely, the cause is almost always a failed water inlet valve, a frozen water line, a failed ice maker thermostat, or a failed ice maker module itself.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Water Inlet Valve',     'description' => 'The solenoid water inlet valve that controls water flow to the ice maker has failed in the closed position. No water reaches the ice maker tray, so no ice is produced. Replacement with a genuine Viking OEM valve restores ice production.' ],
                    [ 'title' => 'Frozen Water Supply Line',     'description' => 'The small water supply tube running from the inlet valve to the ice maker has frozen solid inside the freezer door or back panel. Defrosting the line restores water flow temporarily, but the root cause (freezer temperature too low, damaged insulation) should be addressed.' ],
                    [ 'title' => 'Failed Ice Maker Thermostat',  'description' => 'The ice maker thermostat monitors the ice tray temperature to initiate the harvest cycle. A failed thermostat prevents ice from being released from the tray even after freezing.' ],
                    [ 'title' => 'Failed Ice Maker Module',      'description' => 'The ice maker control module that sequences the fill, freeze, and harvest cycle has failed. The entire ice maker assembly typically requires replacement in this case.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check the ice maker arm or switch', 'description' => 'Verify the ice maker on/off arm (wire arm) is in the down position and the ice maker switch (if equipped) is set to ON. An arm bumped to the up position stops ice production.' ],
                    [ 'title' => 'Check water supply',               'description' => 'Verify the refrigerator water supply valve (under the sink or behind the unit) is fully open and the water line is not kinked.' ],
                ],
                '_ar_when_to_call'   => 'Persistent ice maker failure after confirming the supply valve is open and the arm is down requires professional diagnosis to identify whether the inlet valve, water line, thermostat, or ice maker module has failed.',
                '_ar_cost_range'     => '$150 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I reset the ice maker on a Viking refrigerator?', 'answer' => 'Locate the test button or reset switch on the ice maker module (usually on the side or underside of the assembly). Press and hold for 3–5 seconds until the ice maker starts a test cycle. If the test cycle runs but produces no ice within 24 hours, the ice maker or inlet valve requires service.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Refrigerator Compressor Fault',
            'slug'       => 'viking-refrigerator-compressor-fault',
            'meta_title' => 'Viking Refrigerator Compressor Not Running — Diagnosis',
            'meta_desc'  => 'Viking refrigerator not cooling at all with a silent compressor? Learn the causes of compressor faults and what repair options are available.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Refrigerator' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Refrigerator',
                '_ar_error_code'     => 'Compressor Fault',
                '_ar_code_meaning'   => "A Viking refrigerator compressor fault occurs when the compressor — the pump that circulates refrigerant through the sealed cooling system — is not running. A completely silent refrigerator (no compressor hum) that is warm in both compartments indicates a compressor, start relay, or sealed system fault.\n\nA compressor fault is distinct from a defrost failure: in a defrost failure, the freezer stays cold. In a compressor fault, both compartments are warm and no compressor sound is audible from the back or bottom of the unit.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Start Relay',      'description' => 'The compressor start relay (a small component plugged directly into the compressor) provides the initial current boost needed to start the compressor motor. A failed start relay is one of the most common causes of a silent compressor and is an inexpensive, straightforward repair.' ],
                    [ 'title' => 'Failed Compressor',       'description' => 'The compressor motor itself has seized or failed internally. Compressor replacement is a major sealed-system repair requiring EPA certification and specialized equipment.' ],
                    [ 'title' => 'Refrigerant Leak',        'description' => 'A refrigerant leak in the sealed system allows the refrigerant charge to escape. With insufficient refrigerant, the compressor runs but the system cannot cool. Refrigerant service requires an EPA-certified technician.' ],
                    [ 'title' => 'Control Board Fault',     'description' => 'The refrigerator control board component that activates the compressor relay has failed, preventing the compressor from receiving power even though it is mechanically functional.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Listen for the start relay',  'description' => 'Unplug the refrigerator and shake the start relay (remove it from the compressor terminal — it unplugs). If you hear a rattle inside the relay, the relay has failed and requires replacement. This is an inexpensive DIY repair for those comfortable with basic appliance work.' ],
                ],
                '_ar_when_to_call'   => 'A failed start relay can be a DIY repair, but compressor failure, refrigerant leaks, and control board faults require professional service. Our technician performs a full sealed-system assessment before recommending the most economical course of action.',
                '_ar_cost_range'     => '$95 – $650',
                '_ar_faqs'           => [
                    [ 'question' => 'Is it worth repairing a Viking refrigerator compressor?', 'answer' => 'Viking built-in refrigerators represent a significant investment and are engineered for 15–20+ year service life. For units under 12 years old, compressor repair or replacement is almost always more economical than replacement. Our technician will give you a transparent assessment before any work begins.' ],
                ],
            ],
        ],
    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING DISHWASHER DIAGNOSTIC FAULT INDICATORS
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_dishwasher(): array {
    return [
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Dishwasher Drain Fault',
            'slug'       => 'viking-dishwasher-drain-fault',
            'meta_title' => 'Viking Dishwasher Not Draining — Water in Tub Fault',
            'meta_desc'  => 'Viking dishwasher leaving water in the tub after a cycle? Learn what causes drain faults in Viking Professional dishwashers and how they are repaired.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'Drain Fault',
                '_ar_code_meaning'   => "A drain fault in a Viking dishwasher occurs when the dishwasher cannot drain wash water from the tub within the required time, leaving standing water at the end of the cycle. Some Viking dishwasher models indicate this condition with a visible indicator on the display, while others simply leave water in the tub without a specific code.\n\nDrain faults are among the most common Viking dishwasher complaints. The most frequent cause is a clogged filter assembly, which homeowners can often clear themselves. If the filter is clean and water remains, the drain pump motor has likely failed.",
                '_ar_causes'         => [
                    [ 'title' => 'Clogged Filter Assembly',   'description' => 'Viking dishwashers use a manual-clean filter system at the bottom of the tub. Food particles and grease accumulate in the filter basket and restrict drain pump suction. A clogged filter is the most common cause of drain faults and takes about five minutes to clean.' ],
                    [ 'title' => 'Failed Drain Pump Motor',   'description' => 'The drain pump motor that expels water from the tub has failed mechanically or electrically. A failed pump typically produces a humming sound with no water movement, or complete silence during the drain phase.' ],
                    [ 'title' => 'Blocked Drain Hose',        'description' => 'The drain hose connecting the dishwasher to the household drain or garbage disposal has kinked, collapsed, or become blocked with food debris.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the filter assembly',  'description' => 'Remove the lower rack and pull out the cylindrical filter from the bottom of the tub (twist counter-clockwise to release). Rinse under running water, scrubbing away debris with a soft brush. Reinstall and run a drain cycle.' ],
                    [ 'title' => 'Check the drain hose',       'description' => 'Pull the dishwasher out from the cabinet and inspect the drain hose (behind the unit) for kinks or blockages. The hose should have a high loop or air gap to prevent backflow.' ],
                ],
                '_ar_when_to_call'   => 'If the filter is clean and the hose is unobstructed but water remains in the tub, the drain pump motor requires professional replacement. Our technician carries Viking OEM drain pump assemblies and completes this repair in a single visit.',
                '_ar_cost_range'     => '$160 – $280',
                '_ar_faqs'           => [
                    [ 'question' => 'How often should I clean the Viking dishwasher filter?', 'answer' => 'Viking recommends monthly cleaning under normal household use. In households where the dishwasher runs daily or where dishes are heavily soiled, every two weeks is advisable. A clogged filter is the single most preventable cause of drain faults and poor wash performance.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Dishwasher Door Latch Fault',
            'slug'       => 'viking-dishwasher-door-latch-fault',
            'meta_title' => 'Viking Dishwasher Door Latch Fault — Will Not Start',
            'meta_desc'  => 'Viking dishwasher not starting despite power being present? A door latch fault prevents the control board from confirming a secured door. Learn the causes and repair.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'Door Latch Fault',
                '_ar_code_meaning'   => "A Viking dishwasher door latch fault occurs when the door latch assembly fails to signal the control board that the door is fully closed and secured. As a safety feature, Viking dishwashers will not start a wash cycle unless the control board receives confirmation of a latched door.\n\nA door latch fault typically presents as a dishwasher that will not respond to the Start button — the control panel may light up and accept program selections, but pressing Start produces no result. Some Viking dishwasher models may display an indicator or make a brief sound indicating the door is not confirmed as closed.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Door Latch Switch',      'description' => 'The micro-switch inside the latch assembly that signals door closure to the control board has failed. The door closes mechanically but the switch does not activate, so the board never receives the "door closed" signal.' ],
                    [ 'title' => 'Worn or Broken Latch Mechanism', 'description' => 'The mechanical latch hook that engages the door strike has broken or worn to the point where it no longer generates enough closure force to activate the door switch reliably.' ],
                    [ 'title' => 'Misaligned Door',               'description' => 'The dishwasher door has shifted out of alignment with the door strike, preventing the latch from engaging fully. This can occur after the dishwasher has been repositioned or after hinge wear.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Confirm door is closing fully', 'description' => 'Press the door closed firmly — a click or resistance should be felt as the latch engages. If the door does not click into place, inspect the latch mechanism for visible damage.' ],
                    [ 'title' => 'Clean the latch area',         'description' => 'Food residue or debris around the door latch or strike plate can prevent full engagement. Clean both the latch and the strike plate thoroughly with a damp cloth.' ],
                ],
                '_ar_when_to_call'   => 'A failed door latch switch or broken latch mechanism requires professional replacement. The door latch assembly is a single replaceable component in Viking dishwashers, and this repair is completed in a single visit.',
                '_ar_cost_range'     => '$110 – $200',
                '_ar_faqs'           => [
                    [ 'question' => 'My Viking dishwasher panel lights up but won\'t start — is it the door latch?', 'answer' => 'A control panel that accepts selections but ignores the Start button is the classic symptom of a door latch switch failure. The board is receiving power but not the door-closed signal. A door latch switch replacement typically resolves this.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Dishwasher Wash Motor Fault',
            'slug'       => 'viking-dishwasher-wash-motor-fault',
            'meta_title' => 'Viking Dishwasher Wash Motor Fault — Not Cleaning, Cycle Interruption',
            'meta_desc'  => 'Viking dishwasher not cleaning dishes properly or stopping mid-cycle? A wash motor fault reduces spray pressure and prevents proper cycle completion.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Dishwasher' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Dishwasher',
                '_ar_error_code'     => 'Wash Motor Fault',
                '_ar_code_meaning'   => "A Viking dishwasher wash motor (circulation pump) fault occurs when the motor that circulates water through the spray arms loses efficiency or fails entirely. A failing wash motor typically presents first as reduced wash performance — dishes come out with food residue — before progressing to cycle interruptions or complete failure to circulate water.",
                '_ar_causes'         => [
                    [ 'title' => 'Worn Wash Motor Bearings',  'description' => 'Over time, the circulation pump motor bearings wear, reducing pump efficiency and eventually causing motor failure. A worn motor often produces a humming or grinding sound during the wash phase.' ],
                    [ 'title' => 'Foreign Object in Pump',    'description' => 'A small hard object (bone, glass fragment, fruit pit) that passed through the filter has lodged in the circulation pump impeller, restricting rotation and damaging the motor over time.' ],
                    [ 'title' => 'Motor Winding Failure',     'description' => 'The motor windings have failed electrically, causing the motor to draw excessive current, overheat, and trigger the thermal overload protection — which interrupts the wash cycle.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check and clean the filter first', 'description' => 'A heavily clogged filter can mimic wash motor failure by starving the pump of water. Clean the filter and run a test cycle before concluding the motor has failed.' ],
                ],
                '_ar_when_to_call'   => 'A failing or failed circulation pump motor requires professional diagnosis and replacement. Our technician can distinguish between a pump fault and a filter issue during the diagnostic visit.',
                '_ar_cost_range'     => '$200 – $360',
                '_ar_faqs'           => [
                    [ 'question' => 'Can a Viking dishwasher wash motor be repaired?', 'answer' => 'Circulation pump motors are typically replaced rather than repaired. The replacement pump assembly includes the motor and impeller housing as a unit, and installation is completed in a single visit using a genuine Viking OEM component.' ],
                ],
            ],
        ],
    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING COOKTOP DIAGNOSTIC FAULT INDICATORS
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_cooktop(): array {
    return [
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Cooktop Gas Ignition Fault',
            'slug'       => 'viking-cooktop-ignition-fault',
            'meta_title' => 'Viking Cooktop Gas Burner Not Igniting — Diagnosis & Repair',
            'meta_desc'  => 'Viking gas cooktop burner not igniting or clicking continuously? Learn what causes ignition faults in Viking Professional cooktops and how they are repaired.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Cooktop' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Cooktop',
                '_ar_error_code'     => 'Ignition Fault',
                '_ar_code_meaning'   => "A gas ignition fault on a Viking cooktop occurs when one or more burners fail to ignite when the knob is turned to the ignite position, or when a burner continues to click after being lit (or when not in use). Viking Professional gas cooktops use a spark ignition system with individual spark electrodes at each burner position.\n\nIgnition faults are one of the most common Viking cooktop service calls. In the majority of cases, the cause is clogged burner ports or moisture around the electrode — both of which can often be resolved by the homeowner without a service call.",
                '_ar_causes'         => [
                    [ 'title' => 'Clogged Burner Cap Ports',      'description' => 'Food spills and grease clog the small flame ports around the burner cap, restricting gas flow and preventing the burner from igniting or burning evenly. Cleaning the burner cap and ports with a small brush resolves most ignition issues.' ],
                    [ 'title' => 'Moisture Around the Electrode',  'description' => 'Liquid spillover onto the spark electrode or ignition module causes continuous clicking or ignition failure. Allow the cooktop to dry completely — never operate it immediately after cleaning with water.' ],
                    [ 'title' => 'Failed Spark Electrode',         'description' => 'The ceramic spark electrode at the burner position has cracked or the spark tip has eroded, preventing a spark from jumping to the burner. Electrode replacement restores ignition.' ],
                    [ 'title' => 'Failed Ignition Module',         'description' => 'The ignition control module that generates spark voltage has failed, affecting one or all burner positions. A failed module requires professional replacement.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean burner caps and ports',   'description' => 'Remove the burner caps and use a soft brush or toothpick to clear all flame ports of food residue. Rinse caps in warm soapy water, dry completely, and reinstall.' ],
                    [ 'title' => 'Allow the cooktop to dry fully', 'description' => 'If the cooktop was recently cleaned or had a spill, continuous clicking is usually caused by moisture. Leave the cooktop unused for several hours with good ventilation to allow complete drying.' ],
                    [ 'title' => 'Inspect the electrode',         'description' => 'With the burner cap removed, inspect the spark electrode tip. It should be porcelain-white and free of cracks. A yellowed, cracked, or eroded electrode tip requires replacement.' ],
                ],
                '_ar_when_to_call'   => 'If cleaning and drying do not resolve the ignition issue, or if the electrode is visibly damaged, professional service is required. Our technician replaces electrodes and ignition modules using genuine Viking OEM components.',
                '_ar_cost_range'     => '$110 – $240',
                '_ar_faqs'           => [
                    [ 'question' => 'Why does my Viking cooktop click continuously when not in use?', 'answer' => 'Continuous clicking when no burner is on is almost always caused by moisture or food residue around the spark electrode. The electrode is detecting a conductive path to ground from liquid contamination. Allow the cooktop to dry completely — this usually resolves within a few hours.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Induction Cooktop Zone Fault',
            'slug'       => 'viking-cooktop-induction-zone-fault',
            'meta_title' => 'Viking Induction Cooktop Zone Not Working — Diagnosis',
            'meta_desc'  => 'A Viking induction cooktop zone that won\'t heat may have an induction coil fault, control board issue, or incompatible cookware. Learn the causes and repair.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Cooktop' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Cooktop',
                '_ar_error_code'     => 'Induction Zone Fault',
                '_ar_code_meaning'   => "An induction zone fault on a Viking induction cooktop occurs when a cooking zone fails to heat despite the control panel appearing to function normally. Viking induction cooktops use electromagnetic induction coils beneath each zone — if the coil, its driver board, or the power electronics fail, the affected zone will not produce heat.\n\nViking induction cooktops may display error indicators when a zone fault is detected. Before concluding a fault exists, verify that the cookware being used is induction-compatible (magnetic base required).",
                '_ar_causes'         => [
                    [ 'title' => 'Non-Compatible Cookware',      'description' => 'Induction cooktops only heat magnetic cookware. Aluminum, copper, glass, and non-magnetic stainless steel pots will not heat on an induction zone regardless of settings. Test with a magnet — if it sticks to the pot base, the cookware is compatible.' ],
                    [ 'title' => 'Failed Induction Coil',        'description' => 'The induction coil beneath the affected zone has failed. Individual coil replacement is a professional repair requiring board-level diagnosis to confirm coil failure.' ],
                    [ 'title' => 'Control Board Zone Driver Fault','description' => 'The zone-specific driver circuit on the power control board has failed, preventing that zone from activating. Board diagnosis is required to confirm this cause.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Verify cookware compatibility', 'description' => 'Test cookware with a refrigerator magnet. If the magnet does not stick firmly to the bottom of the pot, the cookware is not induction-compatible and will not heat on any induction zone.' ],
                    [ 'title' => 'Test another zone',             'description' => 'If one zone does not heat but others do with the same cookware, the fault is zone-specific. If no zones heat with confirmed induction cookware, the fault may be in the main power board.' ],
                ],
                '_ar_when_to_call'   => 'A zone fault that persists with confirmed induction-compatible cookware requires professional diagnosis. Our technician uses specialized test equipment to identify whether the coil, driver circuit, or main board requires replacement.',
                '_ar_cost_range'     => '$180 – $420',
                '_ar_faqs'           => [
                    [ 'question' => 'How do I know if my cookware works on a Viking induction cooktop?', 'answer' => 'Test with a refrigerator magnet. Hold the magnet against the bottom of the pot — if it sticks firmly, the pot is induction-compatible. Pots specifically marketed as "induction-ready" will also work. Most cast iron and many stainless steel pots are induction-compatible, while aluminum, copper, and non-magnetic stainless are not.' ],
                ],
            ],
        ],
    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING WINE COOLER DIAGNOSTIC FAULT INDICATORS
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_wine_cooler(): array {
    return [
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Wine Cooler Temperature Fault',
            'slug'       => 'viking-wine-cooler-temperature-fault',
            'meta_title' => 'Viking Wine Cooler Not Cooling — Temperature Fault Diagnosis',
            'meta_desc'  => 'Viking wine cooler not maintaining the set temperature? Learn the causes of Viking wine cooler temperature faults and how they are diagnosed and repaired.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Wine Cooler' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Wine Cooler',
                '_ar_error_code'     => 'Temperature Fault',
                '_ar_code_meaning'   => "A temperature fault in a Viking wine cooler occurs when the unit cannot maintain the set storage temperature. Some Viking wine cooler models display a temperature warning indicator or alarm when the internal temperature rises significantly above or below the set point.\n\nTemperature faults can result from a failing compressor, a clogged condenser coil, a failed condenser fan, or a temperature sensor fault. Identifying the specific cause requires measuring actual temperatures and assessing the compressor and fan operation.",
                '_ar_causes'         => [
                    [ 'title' => 'Clogged Condenser Coil',       'description' => 'Dust and debris accumulating on the condenser coil at the back or bottom of the unit prevent heat dissipation. The compressor overheats and reduces output, causing the internal temperature to rise. Annual condenser cleaning prevents this fault.' ],
                    [ 'title' => 'Failed Condenser Fan Motor',    'description' => 'The fan that pulls air through the condenser coil has failed, so heat from the cooling cycle cannot be expelled effectively. The compressor may run but the unit cannot cool.' ],
                    [ 'title' => 'Failed Temperature Sensor',     'description' => 'The thermistor that measures internal temperature has failed and is reporting incorrect temperatures to the control board, causing the board to mismanage the compressor cycle.' ],
                    [ 'title' => 'Failing or Failed Compressor',  'description' => 'The compressor is the most expensive component in the cooling system. A failing compressor progressively loses its ability to maintain temperature before failing completely.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean the condenser coil',   'description' => 'Unplug the wine cooler and vacuum the condenser coil (accessible from the rear or bottom grille) with a soft brush attachment. Dust buildup is the most common and most preventable cause of cooling degradation.' ],
                    [ 'title' => 'Check door seals',           'description' => 'Inspect the door gasket for tears or gaps. Warm air infiltration through a damaged seal causes the compressor to run continuously and the temperature to fluctuate. Test by closing the door on a sheet of paper — it should hold the paper firmly.' ],
                ],
                '_ar_when_to_call'   => 'If cleaning the condenser does not restore proper cooling, professional diagnosis is required to identify the specific failed component. Our technician measures temperatures, tests the compressor, and inspects the fan motor to identify the root cause.',
                '_ar_cost_range'     => '$150 – $480',
                '_ar_faqs'           => [
                    [ 'question' => 'How often should I clean the Viking wine cooler condenser?', 'answer' => 'Viking recommends annual condenser cleaning as routine maintenance. In homes with pets or in dusty environments, every six months is advisable. A clogged condenser is the most common and most preventable cause of Viking wine cooler temperature faults and compressor wear.' ],
                    [ 'question' => 'What temperature should my Viking wine cooler be set to?', 'answer' => 'For long-term storage of red wines, 55°F (13°C) is widely considered optimal. White wines and sparkling wines benefit from slightly cooler storage at 45–50°F (7–10°C). Viking dual-zone wine coolers allow independent temperature settings for each zone.' ],
                ],
            ],
        ],
    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING FREEZER DIAGNOSTIC FAULT INDICATORS
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_freezer(): array {
    return [
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Freezer Defrost System Fault',
            'slug'       => 'viking-freezer-defrost-fault',
            'meta_title' => 'Viking Freezer Frost Buildup — Defrost System Fault',
            'meta_desc'  => 'Excessive frost or ice buildup in a Viking No Frost freezer indicates a failed defrost heater, thermostat, or control. Learn the causes and repair.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Freezer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Freezer',
                '_ar_error_code'     => 'Defrost Fault',
                '_ar_code_meaning'   => "A defrost system fault in a Viking No Frost freezer occurs when the automatic defrost cycle fails to melt accumulated frost from the evaporator coil. Without periodic defrost, frost builds up on the coil until it blocks airflow entirely — the freezer temperature rises and eventually the unit can no longer maintain safe sub-zero temperatures.\n\nSome Viking freezer models display a temperature alarm when the internal temperature rises above a set threshold. The defrost system failure is the root cause — not a compressor or refrigerant problem.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed Defrost Heater',      'description' => 'The electric heating element that melts frost from the evaporator coil during defrost cycles has burned out. Replacement with a genuine Viking OEM heater element restores automatic defrost operation.' ],
                    [ 'title' => 'Failed Defrost Thermostat',  'description' => 'The bimetallic defrost thermostat that protects against overheating during the defrost cycle has failed open — preventing the heater from receiving power even when the defrost cycle is initiated.' ],
                    [ 'title' => 'Defrost Timer or Board Fault','description' => 'The component that initiates defrost cycles (defrost timer or adaptive defrost control board) has failed, so defrost cycles do not occur at all.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Perform a manual defrost',   'description' => 'Remove all food, unplug the freezer, and leave the door open for 24–48 hours to melt all accumulated ice. If cooling resumes when the unit is plugged in, a defrost system component has failed and requires professional replacement.' ],
                ],
                '_ar_when_to_call'   => 'After confirming the defrost system has failed (frost buildup with a warm freezer compartment), professional diagnosis is required to identify the specific failed component. Our technician tests the heater, thermostat, and defrost control to identify the cause.',
                '_ar_cost_range'     => '$160 – $290',
                '_ar_faqs'           => [
                    [ 'question' => 'My Viking freezer has thick ice on the back wall — is this normal?', 'answer' => 'No. Viking freezers use a No Frost evaporator system — visible frost or ice on the back wall of the freezer compartment indicates the automatic defrost cycle has stopped running. This is a defrost system fault that requires service.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Freezer Temperature Alarm',
            'slug'       => 'viking-freezer-temperature-alarm',
            'meta_title' => 'Viking Freezer Temperature Alarm — Not Reaching Temperature',
            'meta_desc'  => 'Viking freezer not reaching sub-zero temperature or showing a temperature alarm? Learn the most common causes and when to call for service.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Freezer' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Freezer',
                '_ar_error_code'     => 'Temperature Alarm',
                '_ar_code_meaning'   => "A temperature alarm on a Viking freezer indicates the internal temperature has risen above the safe storage threshold. Viking built-in column freezers and upright freezers are designed to maintain 0°F (-18°C) or below for long-term food preservation. When the internal temperature rises significantly above this setpoint, a temperature warning is indicated.\n\nThe temperature alarm itself is not a fault — it is a symptom of an underlying issue. The root cause must be identified: defrost system failure, door seal leak, evaporator fan failure, or compressor issue.",
                '_ar_causes'         => [
                    [ 'title' => 'Defrost System Failure',      'description' => 'See Viking Freezer Defrost System Fault. A failed defrost component is the most common cause of rising freezer temperature in No Frost units.' ],
                    [ 'title' => 'Failed Evaporator Fan Motor', 'description' => 'The fan that circulates cold air from the evaporator coil through the freezer compartment has failed. Without airflow, the freezer temperature rises even though the compressor and coil are cold.' ],
                    [ 'title' => 'Damaged Door Gasket',         'description' => 'A torn or failing door gasket allows warm room air to infiltrate the freezer continuously. The compressor runs almost constantly trying to overcome the heat load and eventually cannot maintain sub-zero temperature.' ],
                    [ 'title' => 'Door Left Open',              'description' => 'A door that was left ajar — even partially — will allow significant warm air infiltration, causing a temperature rise and alarm. Check that the door is fully closed before calling for service.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Verify the door is fully closed', 'description' => 'Inspect the freezer door to confirm it is fully latched with no gap. Check that no food items are blocking the door from closing completely.' ],
                    [ 'title' => 'Inspect the door gasket',         'description' => 'Run your hand around the entire door perimeter with the freezer at operating temperature. Any warmth felt indicates a gasket gap or tear allowing warm air infiltration.' ],
                ],
                '_ar_when_to_call'   => 'If the door is confirmed closed with an intact gasket but the temperature alarm persists, the defrost system, evaporator fan, or compressor requires professional diagnosis.',
                '_ar_cost_range'     => '$130 – $380',
                '_ar_faqs'           => [
                    [ 'question' => 'How long does food stay safe in a Viking freezer that is not cooling?', 'answer' => 'If the freezer temperature rises above 32°F (0°C), previously frozen food will begin to thaw. Food can typically be safely refrozen if it still contains ice crystals. Once food has fully thawed and risen above 40°F, perishables should be discarded. Keep the freezer door closed as much as possible to slow the temperature rise.' ],
                ],
            ],
        ],
    ];
}

// ─────────────────────────────────────────────────────────────────────────────
// VIKING VENT HOOD DIAGNOSTIC FAULT INDICATORS
// ─────────────────────────────────────────────────────────────────────────────

function ar_error_codes_viking_vent_hood(): array {
    return [
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Vent Hood Blower Motor Fault',
            'slug'       => 'viking-vent-hood-blower-fault',
            'meta_title' => 'Viking Vent Hood Not Venting — Blower Motor Fault',
            'meta_desc'  => 'Viking vent hood running but not removing smoke or odors effectively? A failing blower motor is the most common cause. Learn the diagnosis and repair.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Vent Hood' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Vent Hood',
                '_ar_error_code'     => 'Blower Fault',
                '_ar_code_meaning'   => "A blower motor fault in a Viking vent hood occurs when the centrifugal blower that creates suction in the exhaust duct fails to operate at full power or stops entirely. Viking Professional vent hoods use high-output blower motors designed for continuous operation over professional-grade cooking appliances.\n\nA failing blower motor typically presents first as reduced suction performance — smoke and odors are not removed effectively — before progressing to a complete failure to turn on. Unusual noise (humming, grinding, or rattling) during operation often accompanies a failing motor.",
                '_ar_causes'         => [
                    [ 'title' => 'Worn Blower Motor Bearings',  'description' => 'The blower motor bearings wear over time, reducing motor efficiency and eventually causing the motor to seize or fail completely. Bearing wear typically presents as increased operational noise before failure.' ],
                    [ 'title' => 'Grease-Contaminated Blower', 'description' => 'Grease accumulation on the blower wheel (from cooking residue that passes through the filters) creates imbalance and adds load to the motor, accelerating bearing wear and eventual failure. Regular grease filter cleaning helps prevent this.' ],
                    [ 'title' => 'Failed Motor Windings',       'description' => 'The motor windings have burned out, typically from extended operation under high load or from grease contamination reaching the motor. A burned-out motor produces no operation sound at all when the speed is selected.' ],
                    [ 'title' => 'Failed Capacitor',            'description' => 'The start/run capacitor that provides the motor with its initial starting torque has failed. A failed capacitor typically results in a motor that hums but does not spin.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Clean grease filters',        'description' => 'Viking recommends monthly grease filter cleaning. Remove the stainless mesh filters and wash them in hot soapy water or the dishwasher. Clogged filters restrict airflow and add load to the blower motor.' ],
                    [ 'title' => 'Test each speed setting',     'description' => 'Operate the vent hood on each speed setting. If lower speeds work but higher speeds do not (or vice versa), the issue may be with the speed control rather than the motor itself.' ],
                ],
                '_ar_when_to_call'   => 'A blower motor that hums without spinning, produces grinding noise, or fails to start on any speed setting requires professional replacement. Our technician carries Viking OEM blower motor assemblies and completes this repair in a single visit.',
                '_ar_cost_range'     => '$200 – $360',
                '_ar_faqs'           => [
                    [ 'question' => 'Why is my Viking vent hood making more noise than usual?', 'answer' => 'Increased operational noise from a Viking vent hood is most commonly caused by grease buildup on the blower wheel creating imbalance (rattling or vibrating noise) or by worn blower motor bearings (grinding or humming noise). Clean the grease filters first, and if the noise persists, schedule service to inspect the blower assembly.' ],
                ],
            ],
        ],
        [
            'post_type'  => 'error_code',
            'title'      => 'Viking Vent Hood Lighting Fault',
            'slug'       => 'viking-vent-hood-lighting-fault',
            'meta_title' => 'Viking Vent Hood Lights Not Working — LED Module Fault',
            'meta_desc'  => 'Viking vent hood lights not turning on? LED module failures and control board faults are the most common causes. Learn the diagnosis and repair.',
            'taxonomies' => [ 'brand' => 'Viking', 'appliance_type' => 'Vent Hood' ],
            'meta_fields' => [
                '_ar_brand'          => 'Viking',
                '_ar_appliance_type' => 'Vent Hood',
                '_ar_error_code'     => 'Lighting Fault',
                '_ar_code_meaning'   => "A lighting fault in a Viking vent hood occurs when the LED lighting modules that illuminate the cooking surface fail to operate. Viking Professional vent hoods use integrated LED modules designed for long service life, but LED modules, lighting control circuits, and dimmer components can fail.\n\nLighting failures do not affect exhaust ventilation performance but do eliminate the task lighting that is important for safe and comfortable cooking over a Viking professional range.",
                '_ar_causes'         => [
                    [ 'title' => 'Failed LED Module',           'description' => 'The LED module assembly has reached end-of-life or failed prematurely due to voltage spikes or heat exposure. Individual LED module replacement restores full-brightness task lighting.' ],
                    [ 'title' => 'Failed Lighting Control Board','description' => 'The circuit board component that controls LED power and dimming has failed. The LEDs themselves may be functional, but the board no longer sends power to them.' ],
                    [ 'title' => 'Failed Dimmer Component',     'description' => 'Viking vent hoods with adjustable lighting use a dimmer circuit. A failed dimmer may prevent lights from operating at any brightness level.' ],
                ],
                '_ar_diy_steps'      => [
                    [ 'title' => 'Check the circuit breaker',  'description' => 'Verify the circuit breaker for the vent hood has not tripped. A tripped breaker cuts all power to the hood, including lighting and ventilation.' ],
                    [ 'title' => 'Test lighting controls',     'description' => 'If the vent hood has adjustable lighting, test all brightness settings. If lights work on some settings but not others, the issue may be in the dimmer circuit rather than the LED modules.' ],
                ],
                '_ar_when_to_call'   => 'Failed LED modules, lighting control boards, and dimmer components require professional replacement. Our technician identifies the specific failed lighting component and installs a genuine Viking OEM replacement.',
                '_ar_cost_range'     => '$120 – $250',
                '_ar_faqs'           => [
                    [ 'question' => 'Can I replace the bulbs in a Viking vent hood myself?', 'answer' => 'Viking Professional vent hoods use integrated LED modules rather than individual replaceable bulbs. LED module replacement requires access to the hood interior and is best performed by a technician familiar with Viking vent hood construction to avoid damage to the surrounding finish and wiring.' ],
                ],
            ],
        ],
    ];
}
