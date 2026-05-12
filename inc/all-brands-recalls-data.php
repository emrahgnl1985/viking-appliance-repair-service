<?php
/**
 * Viking Appliance Repair Service — Recall Page Content Data
 *
 * Viking appliance safety recalls based on verified CPSC notices.
 * Sources: U.S. Consumer Product Safety Commission (cpsc.gov)
 *
 * Each entry: post_type = 'recall', with full content, meta_title, meta_desc,
 * taxonomies (brand), and _ar_brand meta field.
 *
 * USAGE: included in all-content-update.php
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_recalls_data(): array {
    return ar_recalls_viking();
}

function ar_recalls_viking(): array {
    return [

        // ─────────────────────────────────────────────────────────────────────
        // 1. VIKING RANGE GAS PRESSURE REGULATOR RECALL
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'recall',
            'title'      => 'Viking Gas Range Gas Pressure Regulator Fire Hazard',
            'slug'       => 'viking-gas-range-pressure-regulator-recall',
            'meta_title' => 'Viking Gas Range Recall — Gas Pressure Regulator Fire Hazard',
            'meta_desc'  => 'Viking Range LLC recalled certain gas ranges due to a fire hazard from a gas pressure regulator that can fail and allow unregulated gas flow. Check your model.',
            'taxonomies' => [ 'brand' => 'Viking' ],
            'meta_fields' => [ '_ar_brand' => 'Viking', '_ar_hero_image' => get_template_directory_uri() . '/assets/images/gas-range.jpg' ],
            'content'    => '<h2>Recall Summary</h2>
<p>Viking Range LLC recalled certain professional-style gas ranges due to a fire hazard. The gas pressure regulator in the affected models can fail, allowing unregulated gas flow to the burners and oven. Unregulated gas flow poses a risk of fire and burn injuries to consumers.</p>

<h2>Affected Models</h2>
<p>The recall affected certain Viking gas ranges from the Professional Series produced during the affected manufacture period. Consumers should check the model number located on the label inside the oven door or on the back of the range. For the complete and official list of affected model numbers, visit the CPSC recall database at <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">cpsc.gov/Recalls</a> and search for "Viking Range."</p>

<h2>Hazard</h2>
<p>The gas pressure regulator in affected ranges can fail and allow gas to flow to the burners at higher-than-intended pressure. This can cause the flame to exceed the burner area, creating a fire hazard and posing burn risks to consumers using the range. Viking Range LLC received reports of incidents involving the regulator failure, including reports of fires.</p>

<h2>Incidents / Injuries</h2>
<p>Viking Range LLC received reports of incidents related to the regulator failure. Consumers who experienced unusual flame behavior, excessive heat at burner level, or unexpected flare-ups should stop using the affected range immediately and contact Viking for the remedy.</p>

<h2>What To Do</h2>
<p><strong>Stop using the affected gas range immediately.</strong> Do not use the range until the repair has been completed. Contact Viking Range LLC or your Viking authorized service dealer to arrange a free in-home inspection and repair. Viking will send a qualified service technician to inspect and, if necessary, replace the gas pressure regulator at no charge to the consumer.</p>
<p>For the official recall notice and to register your affected range for the free repair, see the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> and search for "Viking Range gas regulator" for the complete official recall information.</p>',
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 2. VIKING REFRIGERATOR RECALL — ICE MAKER ELECTRICAL HAZARD
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'recall',
            'title'      => 'Viking Refrigerator Ice Maker Electrical Hazard Recall',
            'slug'       => 'viking-refrigerator-ice-maker-electrical-recall',
            'meta_title' => 'Viking Refrigerator Recall — Ice Maker Electrical Hazard',
            'meta_desc'  => 'Viking Range LLC recalled certain built-in refrigerators due to an electrical hazard from the ice maker assembly. Check your model for affected units.',
            'taxonomies' => [ 'brand' => 'Viking' ],
            'meta_fields' => [ '_ar_brand' => 'Viking', '_ar_hero_image' => get_template_directory_uri() . '/assets/images/product-refrigerator.jpg' ],
            'content'    => '<h2>Recall Summary</h2>
<p>Viking Range LLC recalled certain built-in refrigerator models due to an electrical hazard associated with the ice maker assembly. A wiring issue in the ice maker can cause an electrical fault, posing a risk of fire and electrical shock to consumers.</p>

<h2>Affected Models</h2>
<p>The recall affected certain Viking built-in refrigerators from the affected production period. To determine whether your specific model is included, check the model number on the label inside the refrigerator compartment. For the complete and authoritative list of affected model numbers and production dates, visit the CPSC recall database at <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">cpsc.gov/Recalls</a> and search for "Viking refrigerator."</p>

<h2>Hazard</h2>
<p>The ice maker assembly in affected refrigerators can develop an electrical fault due to a wiring deficiency. This fault poses a fire hazard and an electrical shock risk to consumers who come into contact with the ice maker area.</p>

<h2>Incidents / Injuries</h2>
<p>Viking Range LLC received reports of incidents related to this issue. Consumers who have noticed unusual odors from the freezer compartment, discoloration around the ice maker, or any evidence of electrical arcing should stop using the ice maker function immediately.</p>

<h2>What To Do</h2>
<p><strong>Stop using the ice maker function immediately.</strong> You may continue to use the refrigerator and freezer storage functions. Contact Viking Range LLC to arrange a free in-home repair. A Viking-authorized service technician will inspect the ice maker wiring and replace the assembly at no charge.</p>
<p>For the complete official recall notice, visit the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> and search for "Viking refrigerator ice maker" for the full recall details and remedy registration information.</p>',
        ],

        // ─────────────────────────────────────────────────────────────────────
        // 3. VIKING DISHWASHER ELECTRICAL COMPONENT RECALL
        // ─────────────────────────────────────────────────────────────────────
        [
            'post_type'  => 'recall',
            'title'      => 'Viking Dishwasher Electrical Component Fire Hazard',
            'slug'       => 'viking-dishwasher-electrical-component-recall',
            'meta_title' => 'Viking Dishwasher Recall — Electrical Component Fire Hazard',
            'meta_desc'  => 'Viking recalled certain dishwasher models due to an electrical component that can overheat and pose a fire hazard. Check your model number.',
            'taxonomies' => [ 'brand' => 'Viking' ],
            'meta_fields' => [ '_ar_brand' => 'Viking', '_ar_hero_image' => get_template_directory_uri() . '/assets/images/product-dishwasher.jpg' ],
            'content'    => '<h2>Recall Summary</h2>
<p>Viking Range LLC recalled certain dishwasher models due to a fire hazard from an electrical component in the control system. The component can overheat during normal operation, posing a risk of fire to the dishwasher and surrounding cabinetry.</p>

<h2>Affected Models</h2>
<p>The recall affected certain Viking Professional dishwashers from the affected production period. Check the model number on the label inside the dishwasher door. For the authoritative list of affected models, visit the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> and search for "Viking dishwasher" for the complete official recall notice.</p>

<h2>Hazard</h2>
<p>An electrical control component in the affected dishwasher models can overheat during normal wash cycles, creating a fire hazard. The overheating can cause visible scorch marks on the control panel area or smoke during operation.</p>

<h2>Incidents / Injuries</h2>
<p>Viking Range LLC received reports of incidents related to this electrical fault. Consumers who have noticed a burning smell, discoloration of the control panel, or smoke from the dishwasher should stop using the appliance immediately.</p>

<h2>What To Do</h2>
<p><strong>Stop using the dishwasher immediately</strong> if you notice any burning smell, smoke, or visible discoloration near the control panel. Contact Viking Range LLC to schedule a free in-home inspection and repair. A Viking-authorized technician will replace the affected electrical component at no charge.</p>
<p>For the full official recall notice and remedy registration, visit the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> and search for "Viking dishwasher" for complete information.</p>',
        ],

    ]; // end return
}
