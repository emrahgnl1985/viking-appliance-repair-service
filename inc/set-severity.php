<?php
/**
 * Severity Assignment — sets _ar_severity meta on all 120 Viking error code posts.
 *
 * Severity levels: Critical | High | Medium | Low
 *   Critical — safety hazard; stop use immediately (gas leak risk, temperature runaway, fire hazard)
 *   High     — appliance non-functional or major component failure requiring prompt professional repair
 *   Medium   — reduced function or performance degradation; professional repair recommended
 *   Low      — minor fault; often resolvable with basic DIY steps
 *
 * Run via WP-CLI:
 *   wp eval-file wp-content/themes/viking-appliance-repair-service/inc/set-severity.php
 */
defined( 'ABSPATH' ) || die( 'Run via WP-CLI only.' );

$severity_map = [

    // ── Range ──────────────────────────────────────────────────────────────
    'viking-range-f1-fault-code'                 => 'High',
    'viking-range-f2-fault-code'                 => 'Medium',
    'viking-range-f3-fault-code'                 => 'Medium',
    'viking-range-f4-fault-code'                 => 'Critical',
    'viking-range-f5-fault-code'                 => 'High',
    'viking-range-f6-fault-code'                 => 'Medium',
    'viking-range-f7-fault-code'                 => 'Medium',
    'viking-range-f8-fault-code'                 => 'Critical',
    'viking-range-f9-fault-code'                 => 'High',
    'viking-range-igniter-failure'               => 'High',
    'viking-range-burner-not-igniting'           => 'High',
    'viking-range-bake-element-failure'          => 'High',
    'viking-range-broil-element-failure'         => 'High',
    'viking-range-convection-fan-failure'        => 'Medium',
    'viking-range-gas-valve-failure'             => 'High',

    // ── Wall Oven ──────────────────────────────────────────────────────────
    'viking-wall-oven-f1-fault-code'             => 'High',
    'viking-wall-oven-f2-fault-code'             => 'Medium',
    'viking-wall-oven-f3-fault-code'             => 'Medium',
    'viking-wall-oven-f4-fault-code'             => 'Critical',
    'viking-wall-oven-f5-fault-code'             => 'High',
    'viking-wall-oven-f6-fault-code'             => 'Medium',
    'viking-wall-oven-f7-fault-code'             => 'Medium',
    'viking-wall-oven-f8-fault-code'             => 'Critical',
    'viking-wall-oven-f9-fault-code'             => 'High',
    'viking-wall-oven-bake-element-failure'      => 'High',
    'viking-wall-oven-broil-element-failure'     => 'High',
    'viking-wall-oven-convection-fan-failure'    => 'Medium',
    'viking-wall-oven-door-seal-failure'         => 'Medium',
    'viking-wall-oven-self-clean-not-starting'   => 'Medium',
    'viking-wall-oven-light-circuit-fault'       => 'Low',

    // ── Refrigerator ───────────────────────────────────────────────────────
    'viking-refrigerator-defrost-fault'          => 'High',
    'viking-refrigerator-ice-maker-no-ice'       => 'Medium',
    'viking-refrigerator-compressor-fault'       => 'Critical',
    'viking-refrigerator-evaporator-fan-failure' => 'High',
    'viking-refrigerator-condenser-fan-failure'  => 'High',
    'viking-refrigerator-water-dispenser-fault'  => 'Low',
    'viking-refrigerator-ice-dispenser-fault'    => 'Low',
    'viking-refrigerator-door-gasket-failure'    => 'Medium',
    'viking-refrigerator-water-leak-inside'      => 'High',
    'viking-refrigerator-overcooling'            => 'Medium',
    'viking-refrigerator-excessive-noise'        => 'Medium',
    'viking-refrigerator-thermistor-fault'       => 'Medium',
    'viking-refrigerator-main-control-board-fault' => 'High',
    'viking-refrigerator-door-alarm-sensor-fault'  => 'Low',
    'viking-refrigerator-water-inlet-valve-fault'  => 'Medium',

    // ── Dishwasher ─────────────────────────────────────────────────────────
    'viking-dishwasher-drain-fault'              => 'High',
    'viking-dishwasher-door-latch-fault'         => 'Medium',
    'viking-dishwasher-wash-motor-fault'         => 'High',
    'viking-dishwasher-heating-element-failure'  => 'Medium',
    'viking-dishwasher-water-inlet-fault'        => 'High',
    'viking-dishwasher-control-panel-fault'      => 'High',
    'viking-dishwasher-float-switch-fault'       => 'High',
    'viking-dishwasher-spray-arm-obstruction'    => 'Low',
    'viking-dishwasher-detergent-dispenser-failure' => 'Low',
    'viking-dishwasher-door-gasket-leak'         => 'Medium',
    'viking-dishwasher-cycle-not-completing'     => 'High',
    'viking-dishwasher-temperature-sensor-fault' => 'Medium',
    'viking-dishwasher-turbidity-sensor-fault'   => 'Low',
    'viking-dishwasher-control-board-fault'      => 'High',
    'viking-dishwasher-overflow-protection-fault'=> 'High',

    // ── Cooktop ────────────────────────────────────────────────────────────
    'viking-cooktop-burner-not-igniting'         => 'High',
    'viking-cooktop-induction-zone-fault'        => 'High',
    'viking-cooktop-flame-not-holding'           => 'Critical',
    'viking-cooktop-cap-misalignment'            => 'Low',
    'viking-cooktop-spark-electrode-failure'     => 'Medium',
    'viking-cooktop-ignition-module-failure'     => 'High',
    'viking-cooktop-surface-element-failure'     => 'High',
    'viking-cooktop-gas-pressure-fault'          => 'Critical',
    'viking-cooktop-knob-valve-fault'            => 'High',
    'viking-cooktop-yellow-flame'                => 'High',
    'viking-cooktop-control-panel-fault'         => 'High',
    'viking-cooktop-thermocouple-fault'          => 'High',
    'viking-cooktop-induction-power-board-fault' => 'High',
    'viking-cooktop-pan-detection-failure'       => 'Medium',
    'viking-cooktop-gas-regulator-fault'         => 'High',

    // ── Wine Cooler ────────────────────────────────────────────────────────
    'viking-wine-cooler-temperature-fault'       => 'High',
    'viking-wine-cooler-compressor-fault'        => 'Critical',
    'viking-wine-cooler-fan-failure'             => 'High',
    'viking-wine-cooler-temperature-sensor-fault'=> 'Medium',
    'viking-wine-cooler-door-seal-failure'       => 'Medium',
    'viking-wine-cooler-control-panel-fault'     => 'High',
    'viking-wine-cooler-dual-zone-fault'         => 'Medium',
    'viking-wine-cooler-lighting-failure'        => 'Low',
    'viking-wine-cooler-condenser-coil-clogged'  => 'Medium',
    'viking-wine-cooler-condensation-fault'          => 'Low',
    'viking-wine-cooler-vibration-issue'             => 'Low',
    'viking-wine-cooler-thermistor-primary-fault'    => 'Medium',
    'viking-wine-cooler-overtemperature-protection'  => 'High',
    'viking-wine-cooler-refrigerant-system-fault'    => 'Critical',
    'viking-wine-cooler-door-alarm-fault'            => 'Low',

    // ── Freezer ────────────────────────────────────────────────────────────
    'viking-freezer-defrost-fault'               => 'High',
    'viking-freezer-temperature-alarm'           => 'High',
    'viking-freezer-evaporator-fan-failure'      => 'High',
    'viking-freezer-door-gasket-failure'         => 'Medium',
    'viking-freezer-start-relay-failure'         => 'High',
    'viking-freezer-defrost-drain-blocked'       => 'Medium',
    'viking-freezer-temperature-sensor-fault'    => 'Medium',
    'viking-freezer-overcooling'                 => 'Medium',
    'viking-freezer-condenser-fan-failure'       => 'High',
    'viking-freezer-power-interruption-alarm'    => 'Low',
    'viking-freezer-door-frame-ice'              => 'Medium',
    'viking-freezer-thermistor-fault'            => 'Medium',
    'viking-freezer-compressor-overload-fault'   => 'High',
    'viking-freezer-main-control-board-fault'    => 'High',
    'viking-freezer-ice-maker-module-fault'      => 'Medium',

    // ── Vent Hood ──────────────────────────────────────────────────────────
    'viking-vent-hood-blower-motor-not-running'  => 'High',
    'viking-vent-hood-fan-speed-not-working'     => 'Medium',
    'viking-vent-hood-lights-not-working'        => 'Low',
    'viking-vent-hood-damper-not-opening'        => 'High',
    'viking-vent-hood-grease-filter-clogged'     => 'Medium',
    'viking-vent-hood-excessive-noise'           => 'Medium',
    'viking-vent-hood-control-panel-unresponsive'=> 'High',
    'viking-vent-hood-not-venting-exterior'      => 'High',
    'viking-vent-hood-thermal-cutout-tripped'    => 'High',
    'viking-vent-hood-no-power'                  => 'High',
    'viking-vent-hood-grease-dripping'           => 'Critical',
    'viking-vent-hood-delay-off-not-working'     => 'Low',
    'viking-vent-hood-reduced-airflow-fault'     => 'Medium',
    'viking-vent-hood-blower-overtemperature-fault' => 'Medium',
    'viking-vent-hood-main-control-board-fault'  => 'High',
];

$updated = 0;
$not_found = 0;

foreach ( $severity_map as $slug => $severity ) {
    $post = get_page_by_path( $slug, OBJECT, 'error_code' );
    if ( ! $post ) {
        WP_CLI::warning( "Not found: $slug" );
        $not_found++;
        continue;
    }
    update_post_meta( $post->ID, '_ar_severity', $severity );
    $updated++;
}

WP_CLI::line( '' );
WP_CLI::success( sprintf( 'Severity set on %d posts. Not found: %d.', $updated, $not_found ) );
