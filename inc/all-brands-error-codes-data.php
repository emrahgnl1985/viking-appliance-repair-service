<?php
/**
 * Viking Appliance Repair Service — Fault Code Page Content Data
 *
 * Brand: Viking only (USA market)
 * Covers documented Viking range and oven fault codes (F-series).
 *
 * IMPORTANT: Only verified, documented Viking fault codes are included.
 * Source: Viking Range LLC service documentation and authorized service data.
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
        ar_error_codes_viking_range_oven()
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
