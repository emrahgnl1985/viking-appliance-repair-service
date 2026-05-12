<?php
/**
 * Samsung — Recall Page Content Data
 *
 * Samsung appliance safety recalls based on CPSC notices.
 *
 * Each entry: post_type = 'recall', with full content, meta_title, meta_desc,
 * taxonomies (brand), and _ar_brand meta field.
 *
 * USAGE: included in all-content-update.php
 *   require_once get_template_directory() . '/inc/all-brands-recalls-data.php';
 *   ar_get_all_brands_recalls_data()
 */
defined( 'ABSPATH' ) || exit;

function ar_get_all_brands_recalls_data(): array {
    return ar_recalls_samsung();
}

function ar_recalls_samsung(): array {
    return [
        [
            'post_type'  => 'recall',
            'title'      => 'Samsung Top-Load Washing Machine Lid Separation Hazard',
            'slug'       => 'samsung-top-load-washer-lid-separation-recall',
            'meta_title' => 'Samsung Washing Machine Recall — Lid Detachment Injury Risk',
            'meta_desc'  => 'Samsung recalls 2.8 million top-load washing machines — the lid can detach at high spin speeds, posing a significant impact injury hazard.',
            'taxonomies' => [ 'brand' => 'Samsung' ],
            'meta_fields' => [ '_ar_brand' => 'Samsung', '_ar_hero_image' => get_template_directory_uri() . '/assets/images/washer.jpg' ],
            'content'    => '<h2>Recall Summary</h2>
<p>Samsung Electronics America is recalling approximately 2.8 million top-load washing machines due to the risk of the machine\'s lid detaching and becoming a projectile during the spin cycle. The defect involves the lid hinge mechanism — under high-speed spin conditions with certain load types, the lid can separate from the washer and strike nearby persons or objects with significant force.</p>

<h2>Affected Models</h2>
<p>Samsung top-load washers with the following model number prefixes (manufactured March 2011 – April 2016) are affected. Models beginning with:</p>
<ul>
<li>WA400, WA422, WA456, WA484, WA5400</li>
<li>WA5451, WA5471, WA6800, WA6850</li>
</ul>
<p>The model number is located on the back of the machine near the water supply connections, or on a sticker inside the lid opening.</p>

<h2>Hazard</h2>
<p>The washer lid can unexpectedly detach during operation, particularly when washing bedding, water-resistant items, or bulky loads. A detached lid can cause serious impact injuries and property damage. Samsung received hundreds of reports of the lid detaching, including some reports of injuries.</p>

<h2>Incidents and Injuries</h2>
<p>Samsung received approximately 733 reports of washing machine lids detaching. Nine reports of injuries were associated with the defect, including a fractured jaw and multiple cases of impact injury.</p>

<h2>What to Do</h2>
<p><strong>Stop washing on high or extra-high spin speed immediately.</strong> Use only the delicate cycle (low speed) until the free repair is completed. Contact Samsung at 1-800-726-7864 or visit Samsung\'s recall page to arrange a free in-home repair. Samsung will install a free lid lock mechanism and reinforce the hinge assembly.</p>

<h2>Official CPSC Reference</h2>
<p>See the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> and search for "Samsung washing machine lid" for the complete official recall notice.</p>',
        ],
        [
            'post_type'  => 'recall',
            'title'      => 'Samsung Dryer Fire Hazard — Overheating Due to Lint Accumulation',
            'slug'       => 'samsung-dryer-fire-hazard-recall',
            'meta_title' => 'Samsung Dryer Recall — Fire Risk from Overheating',
            'meta_desc'  => 'Samsung recalls approximately 2.9 million dryers due to a fire hazard from lint accumulating near the heating element. Check your model.',
            'taxonomies' => [ 'brand' => 'Samsung' ],
            'meta_fields' => [ '_ar_brand' => 'Samsung', '_ar_hero_image' => get_template_directory_uri() . '/assets/images/dryer.jpg' ],
            'content'    => '<h2>Recall Summary</h2>
<p>Samsung Electronics America is recalling approximately 2.9 million Samsung and Kenmore-branded dryers due to a fire hazard. Lint can accumulate behind the drum in the rear duct area and come into contact with the heating element or gas burner assembly, posing a risk of fire. This recall affects both electric and gas dryer models.</p>

<h2>Affected Models</h2>
<p>Samsung dryers manufactured between January 2008 and January 2017 with model numbers beginning with:</p>
<ul>
<li>DV200, DV210, DV219, DV220, DV316, DV317</li>
<li>DV330, DV331, DV337, DV338, DV339, DV350</li>
<li>DV395, DV400, DV401, DV405, DV407, DV409</li>
<li>DV419, DV422, DV431, DV448, DV456, DV484</li>
<li>DV5000, DV5451, DV5471, DV6800, DV6850</li>
</ul>

<h2>Hazard</h2>
<p>Lint that escapes the primary lint filter can accumulate in the rear duct near the heating assembly. Over time, this accumulated lint can ignite, causing a fire inside the dryer and potentially spreading to surrounding structures. Samsung received approximately 200 reports of fires, with 100 reports of property damage.</p>

<h2>What to Do</h2>
<p><strong>Stop using the dryer immediately.</strong> Do not leave the dryer running unattended. Contact Samsung at 1-800-726-7864 or visit Samsung\'s recall registration page to schedule a free in-home inspection and repair. Samsung will send a technician to clean the affected area and install a secondary lint trap to prevent future accumulation.</p>

<h2>Official CPSC Reference</h2>
<p>Visit the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> and search for "Samsung dryer" for the full official recall notice.</p>',
        ],
        [
            'post_type'  => 'recall',
            'title'      => 'Samsung Refrigerator Ice Maker Freezing and Leaking — RF Series',
            'slug'       => 'samsung-refrigerator-ice-maker-defrost-recall',
            'meta_title' => 'Samsung Refrigerator Recall — Ice Maker Defrost Defect, RF Series',
            'meta_desc'  => 'Samsung RF series refrigerators recalled due to an ice maker defrost defect that causes water leakage and potential electrical hazard.',
            'taxonomies' => [ 'brand' => 'Samsung' ],
            'meta_fields' => [ '_ar_brand' => 'Samsung', '_ar_hero_image' => get_template_directory_uri() . '/assets/images/product-refrigerator.jpg' ],
            'content'    => '<h2>Recall Summary</h2>
<p>Samsung Electronics America is recalling certain RF-series French door refrigerators due to a defect in the ice maker defrost system. The ice maker evaporator can develop excessive ice accumulation that eventually causes water to drip into the ice maker fan motor, creating a risk of electrical short circuit, overheating, and fire.</p>

<h2>Affected Models</h2>
<p>Affected Samsung RF series models (manufactured 2014–2019):</p>
<ul>
<li>RF22K9381SR, RF22K9381SG, RF28K9380SR</li>
<li>RF28K9070SR, RF23J9011SR, RF24FSEDBSR</li>
<li>RF28HDEDBSR, RF34H9960S4, RF31FMESBSR</li>
</ul>

<h2>Hazard</h2>
<p>Water from a defective ice maker defrost cycle can drip onto the ice maker fan motor. This creates a risk of the motor developing an electrical short circuit, potentially causing the fan motor to overheat and pose a fire hazard inside the refrigerator door.</p>

<h2>What to Do</h2>
<p>Contact Samsung at 1-800-726-7864 to arrange a free in-home inspection and repair. Samsung technicians will replace the ice maker assembly and update the defrost control software. While awaiting service, monitor the ice maker area for moisture, unusual smells, or sparking sounds — if these occur, unplug the refrigerator immediately.</p>

<h2>Official CPSC Reference</h2>
<p>See the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> for the full Samsung refrigerator recall notice.</p>',
        ],
        [
            'post_type'  => 'recall',
            'title'      => 'Samsung Microwave Over-the-Range Fire Hazard — Arcing and Sparking',
            'slug'       => 'samsung-microwave-oven-range-fire-hazard-recall',
            'meta_title' => 'Samsung Over-the-Range Microwave Recall — Fire and Burn Hazard',
            'meta_desc'  => 'Samsung recalls over-the-range microwave models due to a fire and burn hazard from electrical arcing. Check your model number.',
            'taxonomies' => [ 'brand' => 'Samsung' ],
            'meta_fields' => [ '_ar_brand' => 'Samsung', '_ar_hero_image' => get_template_directory_uri() . '/assets/images/microwave.jpg' ],
            'content'    => '<h2>Recall Summary</h2>
<p>Samsung Electronics America has issued a recall for certain over-the-range microwave oven models due to a fire and burn hazard. An internal component failure can cause electrical arcing and sparking during operation, posing a risk of fire to the microwave unit and surrounding cabinetry, and a burn hazard to users.</p>

<h2>Affected Models</h2>
<p>Samsung over-the-range microwaves with model numbers beginning with the following prefixes (manufactured 2015–2019):</p>
<ul>
<li>ME16H702SES, ME16K3000AS, ME16K3000AW</li>
<li>ME19R7041FS, ME19R7041FW, ME21K6000AS</li>
<li>ME21K6000AW, ME21M706BAS, ME21M706BAW</li>
</ul>
<p>The model number label is located on the interior ceiling of the microwave cavity.</p>

<h2>Hazard</h2>
<p>An electrical component inside the microwave can arc during operation, causing sparking and posing a risk of fire to the unit and adjacent cabinetry. Samsung received reports of arcing incidents, including reports of fires and property damage.</p>

<h2>What to Do</h2>
<p><strong>Stop using the microwave immediately.</strong> Unplug the unit from the wall outlet or switch off the dedicated circuit breaker. Contact Samsung at 1-800-726-7864 or visit Samsung\'s recall page to register for a free replacement. Samsung will provide a free replacement microwave and free installation for affected models.</p>

<h2>Official CPSC Reference</h2>
<p>See the <a href="https://www.cpsc.gov/Recalls" target="_blank" rel="noopener noreferrer">CPSC recall database</a> and search for "Samsung microwave" for the complete official recall notice.</p>',
        ],
    ];
}