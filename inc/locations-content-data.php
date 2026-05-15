<?php
/**
 * Location Page Content Data
 * Returns an array of location_page post definitions for the 6 main service cities.
 * Used by inc/all-content-import.php for WP-CLI bulk import.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function ar_get_locations_content_data() {
    return array_merge(
        ar_location_chicago(),
        ar_location_new_york(),
        ar_location_los_angeles(),
        ar_location_houston(),
        ar_location_miami(),
        ar_location_san_francisco()
    );
}

/* =========================================================
   CHICAGO, IL
   ========================================================= */
function ar_location_chicago() {
    return [[
        'post_type' => 'location_page',
        'title'     => 'Viking Appliance Repair Chicago',
        'slug'      => 'chicago',
        'meta_title'  => 'Appliance Repair Chicago, IL | Same-Day Service',
        'meta_desc'   => 'Viking appliance repair in Chicago, IL. Certified technicians, genuine Viking parts, and a 30-day warranty. Same-day appointments available.',
        'taxonomies'  => [
            'city' => 'Chicago',
        ],
        'meta_fields' => [
            '_ar_city'        => 'Chicago',
            '_ar_state'       => 'IL',
            '_ar_state_full'  => 'Illinois',
            '_ar_zip_codes'   => '60601,60602,60603,60604,60605,60606,60607,60608,60609,60610,60611,60612,60613,60614,60615,60616,60617,60618,60619,60620,60621,60622,60623,60624,60625,60626,60628,60629,60630,60631,60632,60634,60636,60637,60638,60639,60640,60641,60642,60643,60644,60645,60646,60647,60649,60651,60652,60653,60654,60655,60656,60657,60659,60660,60661,60706,60707,60712,60714,60803,60804,60827',
            '_ar_hero_subtitle' => 'Fast, reliable appliance repair throughout Chicago and the surrounding suburbs — from Lincoln Park to the South Side.',
            '_ar_body_intro'  => "Chicago homeowners trust us for fast, professional Viking appliance repair that gets done right the first time. Whether you're in Lincoln Park, Wicker Park, Hyde Park, or the South Loop, our Viking-certified technicians arrive equipped with genuine Viking parts and tools needed to fix your appliance on the spot.\n\nChicago's weather puts a real strain on appliances — cold winters can affect refrigerant efficiency, and high humidity in summer accelerates maintenance issues in Viking dishwashers and refrigerators. Our technicians understand these local conditions and will advise you on preventive maintenance to extend the life of your Viking appliances after every repair.\n\nWe offer same-day and next-day appointments across all 77 Chicago neighborhoods and the greater metro area. Every repair comes with genuine Viking parts and a 30-day parts-and-labor warranty. Our flat-rate pricing means no surprise fees — you'll know the total cost before we begin any work.",
            '_ar_neighborhoods' => 'Lincoln Park,Wicker Park,Logan Square,Bucktown,Hyde Park,South Loop,River North,Gold Coast,Andersonville,Lakeview,Pilsen,Bridgeport,Bronzeville,Englewood,Chatham,Beverly,Morgan Park,Rogers Park,Edgewater,Ravenswood,Irving Park,Avondale,Humboldt Park,Austin,Oak Park (border),Evanston (border)',
            '_ar_suburbs'     => 'Evanston,Skokie,Oak Park,Cicero,Berwyn,Calumet City,Elmwood Park,Norridge,Harwood Heights,Niles,Morton Grove,Lincolnwood,Rosemont,Melrose Park,Broadview,Maywood,Forest Park,Oak Brook,Downers Grove,Naperville,Bolingbrook,Aurora,Joliet,Orland Park,Tinley Park,Matteson,Harvey,Dolton,Lansing,Hammond (IN)',
            '_ar_faqs'        => [
                [
                    'question' => 'Do you offer same-day appliance repair in Chicago?',
                    'answer'   => 'Yes. We offer same-day appointments throughout Chicago and most suburbs for refrigerator, range, dishwasher, cooktop, and wall oven repairs. Call before noon and we can usually have a technician at your door the same day.',
                ],
                [
                    'question' => 'Which Chicago neighborhoods do you serve?',
                    'answer'   => 'We service all 77 Chicago neighborhoods, including Lincoln Park, Wicker Park, Logan Square, Hyde Park, Pilsen, Bronzeville, Rogers Park, Edgewater, Lakeview, Bucktown, River North, Gold Coast, the South Loop, and beyond. We also cover surrounding suburbs.',
                ],
                [
                    'question' => 'How much does appliance repair cost in Chicago?',
                    'answer'   => 'Repair costs vary by appliance type and the complexity of the repair. We provide a firm, upfront quote after diagnosing the problem — there are no hidden fees. Common repairs such as a refrigerator not cooling or a range not heating typically range from $150 to $350, including parts and labor.',
                ],
                [
                    'question' => 'Do you repair appliances in Chicago apartments and condos?',
                    'answer'   => 'Absolutely. We regularly service high-rise condos, townhomes, two-flats, and apartments throughout Chicago. Our technicians carry compact toolkits suited for tight elevator access and parking-restricted streets.',
                ],
                [
                    'question' => 'What Viking appliances do you repair in Chicago?',
                    'answer'   => 'We specialize exclusively in Viking appliances: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models and series covered.',
                ],
                [
                    'question' => 'Is there a warranty on repairs in Chicago?',
                    'answer'   => 'Yes. Every repair comes with a 30-day warranty on parts and labor. If the same issue recurs within a month, we return and fix it at no additional charge.',
                ],
            ],
        ],
    ]];
}

/* =========================================================
   NEW YORK, NY
   ========================================================= */
function ar_location_new_york() {
    return [[
        'post_type' => 'location_page',
        'title'     => 'Viking Appliance Repair New York',
        'slug'      => 'new-york',
        'meta_title'  => 'Appliance Repair New York, NY | Same-Day Service in NYC',
        'meta_desc'   => 'Viking appliance repair in New York City. Viking-certified technicians, same-day service in Manhattan, Brooklyn, Queens, the Bronx, and Staten Island. 30-day warranty.',
        'taxonomies'  => [
            'city' => 'New York',
        ],
        'meta_fields' => [
            '_ar_city'        => 'New York',
            '_ar_state'       => 'NY',
            '_ar_state_full'  => 'New York',
            '_ar_zip_codes'   => '10001,10002,10003,10004,10005,10006,10007,10009,10010,10011,10012,10013,10014,10016,10017,10018,10019,10020,10021,10022,10023,10024,10025,10026,10027,10028,10029,10030,10031,10032,10033,10034,10035,10036,10037,10038,10039,10040,10044,10065,10075,10128,10280,10301,10302,10303,10304,10305,10306,10307,10308,10309,10310,10311,10312,10314,10451,10452,10453,10454,10455,10456,10457,10458,10459,10460,10461,10462,10463,10464,10465,10466,10467,10468,10469,10470,10471,10472,10473,10474,10475,11001,11004,11005,11040,11101,11102,11103,11104,11105,11106,11201,11203,11204,11205,11206,11207,11208,11209,11210,11211,11212,11213,11214,11215,11216,11217,11218,11219,11220,11221,11222,11223,11224,11225,11226,11228,11229,11230,11231,11232,11233,11234,11235,11236,11237,11238,11239,11354,11355,11356,11357,11358,11360,11361,11362,11363,11364,11365,11366,11367,11368,11369,11370,11371,11372,11373,11374,11375,11377,11378,11379,11385,11411,11412,11413,11414,11415,11416,11417,11418,11419,11420,11421,11422,11423,11426,11427,11428,11429,11430,11432,11433,11434,11435,11436',
            '_ar_hero_subtitle' => 'NYC-wide appliance repair in Manhattan, Brooklyn, Queens, the Bronx, and Staten Island — on your schedule.',
            '_ar_body_intro'  => "New Yorkers don't have time to wait days for a Viking appliance repair. That's why we offer same-day and next-day service across all five boroughs — Manhattan, Brooklyn, Queens, the Bronx, and Staten Island. Our Viking-certified technicians navigate the city efficiently to arrive within your scheduled window, ready to diagnose and repair on the first visit.\n\nFrom Upper West Side pre-war apartments to Brooklyn brownstones and Queens high-rises, we understand the unique challenges of NYC appliance repair. Tight spaces, elevator-only access, and building management requirements are all handled professionally. We carry a full inventory of genuine Viking OEM parts so most repairs are completed in a single visit.\n\nWe repair Viking ranges, refrigerators, dishwashers, cooktops, wall ovens, wine coolers, freezers, and vent hoods. Every repair includes genuine Viking OEM parts, Viking-certified technicians, and a 30-day parts-and-labor warranty. Flat-rate, transparent pricing — you approve the quote before we touch anything.",
            '_ar_neighborhoods' => 'Midtown Manhattan,Upper West Side,Upper East Side,Harlem,Washington Heights,Chelsea,Greenwich Village,SoHo,Tribeca,Lower East Side,East Village,Hell\'s Kitchen,Astoria,Long Island City,Flushing,Jamaica,Forest Hills,Park Slope,Williamsburg,DUMBO,Bushwick,Flatbush,Crown Heights,Bay Ridge,Bensonhurst,Sunset Park,Riverdale,Fordham,Pelham Bay,Mott Haven,Tottenville,St. George,New Dorp',
            '_ar_suburbs'     => 'Yonkers,Mount Vernon,New Rochelle,White Plains,Hempstead,Valley Stream,Elmont,Freeport,Long Beach,Garden City,Mineola,Hicksville,Levittown,Brentwood,Bay Shore,Islip,Jersey City (NJ),Newark (NJ),Hoboken (NJ),Bayonne (NJ),Union City (NJ)',
            '_ar_faqs'        => [
                [
                    'question' => 'Do you offer same-day appliance repair in New York City?',
                    'answer'   => 'Yes. We provide same-day appliance repair throughout Manhattan, Brooklyn, Queens, the Bronx, and Staten Island. Call by noon for the best chance of a same-day slot. Next-day appointments are available city-wide.',
                ],
                [
                    'question' => 'Can you repair appliances in NYC apartments and high-rises?',
                    'answer'   => 'Yes, this is our specialty. Our technicians are experienced with elevator buildings, doorman requirements, limited parking, and building management sign-in procedures. We bring all equipment in compact cases suitable for tight NYC spaces.',
                ],
                [
                    'question' => 'How quickly can a technician arrive in Manhattan?',
                    'answer'   => 'We offer 2-hour arrival windows throughout Manhattan. For urgent repairs like a refrigerator not cooling, we prioritize same-day dispatch. Traffic and building access can occasionally affect timing, but we always confirm when the technician is en route.',
                ],
                [
                    'question' => 'What Viking appliances do you service in NYC?',
                    'answer'   => 'We specialize exclusively in Viking appliances: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models and series covered. We carry genuine Viking OEM parts for all models.',
                ],
                [
                    'question' => 'Is appliance repair in New York worth it, or should I replace?',
                    'answer'   => 'With NYC appliance prices elevated due to delivery and installation fees, repair is almost always cost-effective if the appliance is under 10 years old and the repair cost is less than 50% of replacement value. We will give you an honest recommendation after diagnosis.',
                ],
                [
                    'question' => 'Do you service Long Island and Westchester?',
                    'answer'   => 'Yes. We service the broader New York metro area including Nassau and Suffolk counties on Long Island, and Westchester County including Yonkers, Mount Vernon, White Plains, and New Rochelle.',
                ],
            ],
        ],
    ]];
}

/* =========================================================
   LOS ANGELES, CA
   ========================================================= */
function ar_location_los_angeles() {
    return [[
        'post_type' => 'location_page',
        'title'     => 'Viking Appliance Repair Los Angeles',
        'slug'      => 'los-angeles',
        'meta_title'  => 'Appliance Repair Los Angeles, CA | Same-Day Service',
        'meta_desc'   => 'Viking appliance repair in Los Angeles, CA. Same-day service across the entire LA metro. Genuine Viking OEM parts, certified technicians, 30-day warranty.',
        'taxonomies'  => [
            'city' => 'Los Angeles',
        ],
        'meta_fields' => [
            '_ar_city'        => 'Los Angeles',
            '_ar_state'       => 'CA',
            '_ar_state_full'  => 'California',
            '_ar_zip_codes'   => '90001,90002,90003,90004,90005,90006,90007,90008,90010,90011,90012,90013,90014,90015,90016,90017,90018,90019,90020,90021,90022,90023,90024,90025,90026,90027,90028,90029,90031,90032,90033,90034,90035,90036,90037,90038,90039,90041,90042,90043,90044,90045,90046,90047,90048,90049,90056,90057,90058,90059,90061,90062,90063,90064,90065,90066,90067,90068,90069,90071,90073,90077,90089,90094,90095,90210,90211,90212,90230,90232,90245,90247,90248,90249,90254,90260,90261,90263,90265,90266,90272,90274,90275,90277,90278,90290,90291,90292,90293,90301,90302,90303,90304,90305,90401,90402,90403,90404,90405,91001,91006,91007,91010,91011,91016,91024,91030,91040,91042,91101,91103,91104,91105,91106,91107,91201,91202,91203,91204,91205,91206,91207,91208,91214,91301,91302,91303,91304,91306,91307,91316,91324,91325,91326,91331,91335,91340,91342,91343,91344,91345,91350,91351,91352,91354,91355,91356,91364,91367,91381,91382,91383,91384,91385,91387,91390,91401,91402,91403,91405,91406,91411,91423,91436,91501,91502,91505,91506,91601,91602,91604,91605,91606',
            '_ar_hero_subtitle' => 'Appliance repair across Los Angeles — from Santa Monica to Pasadena, the Valley to the South Bay.',
            '_ar_body_intro'  => "Los Angeles homeowners and renters rely on us for fast, dependable Viking appliance repair across the entire LA metro — from the Westside and Hollywood Hills to the San Fernando Valley, Pasadena, the South Bay, and Long Beach. Our Viking-certified technicians know the most common issues affecting Viking appliances in Southern California, including the impact of hard water on dishwashers and refrigerators and the continuous demand placed on refrigeration in hot summers.\n\nWith traffic being what it is in LA, we provide precise 2-hour arrival windows so you're not sitting at home all day. We service single-family homes, condos, apartment complexes, and gated communities throughout Los Angeles County and into Orange County and Ventura County. Our fleet carries a full stock of genuine Viking OEM parts, meaning most repairs wrap up in a single visit.\n\nWhether your Viking refrigerator stopped cooling, your range won't heat, or your dishwasher is leaving dishes dirty, we diagnose and repair on the first visit whenever possible. All repairs use genuine Viking OEM parts and come with a 30-day parts-and-labor warranty. Upfront pricing — you'll see the full cost before we start.",
            '_ar_neighborhoods' => 'Hollywood,West Hollywood,Silver Lake,Echo Park,Los Feliz,Eagle Rock,Highland Park,Koreatown,Mid-Wilshire,Brentwood,Bel Air,Pacific Palisades,Venice,Mar Vista,Culver City,Inglewood,Hawthorne,Torrance,Carson,Compton,Watts,Boyle Heights,El Sereno,Mount Washington,Tarzana,Encino,Sherman Oaks,Van Nuys,North Hollywood,Burbank,Glendale,Pasadena,Alhambra,Monterey Park',
            '_ar_suburbs'     => 'Santa Monica,Beverly Hills,West Hollywood,Culver City,El Segundo,Manhattan Beach,Hermosa Beach,Redondo Beach,Torrance,Long Beach,Compton,Inglewood,Hawthorne,Gardena,Carson,Lynwood,South Gate,Downey,Norwalk,Cerritos,Lakewood,Bellflower,Whittier,La Mirada,Burbank,Glendale,Pasadena,Arcadia,Monrovia,Azusa,Covina,West Covina,La Puente,Pomona,Ontario,Rancho Cucamonga,Thousand Oaks,Simi Valley,Chatsworth,Reseda,Canoga Park,Woodland Hills,Agoura Hills',
            '_ar_faqs'        => [
                [
                    'question' => 'Do you offer same-day appliance repair in Los Angeles?',
                    'answer'   => 'Yes. We offer same-day appliance repair throughout Los Angeles and the surrounding metro area. Call before noon and we can typically dispatch a technician the same day. We work around LA traffic with precise scheduling windows.',
                ],
                [
                    'question' => 'Do you service the San Fernando Valley?',
                    'answer'   => 'Yes. We service all Valley cities including Van Nuys, Sherman Oaks, Encino, Tarzana, Reseda, Canoga Park, Woodland Hills, North Hollywood, Burbank, and Glendale.',
                ],
                [
                    'question' => 'Does hard water in LA affect my appliances?',
                    'answer'   => 'Absolutely. Southern California\'s hard water causes mineral buildup in Viking dishwashers, refrigerator water lines, and ice makers. We clean and descale affected components during repairs and recommend maintenance routines to slow future buildup.',
                ],
                [
                    'question' => 'How much does appliance repair cost in Los Angeles?',
                    'answer'   => 'We provide a firm upfront quote after diagnosis with no hidden fees. Most common Viking repairs — a refrigerator not cooling, range not heating, or dishwasher not draining — range from $150 to $450 including parts and labor. We will always tell you if replacement makes more financial sense.',
                ],
                [
                    'question' => 'What Viking appliances do you repair in Los Angeles?',
                    'answer'   => 'We repair all Viking appliances: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models and series covered.',
                ],
                [
                    'question' => 'What is your service area in Los Angeles County?',
                    'answer'   => 'We cover all of Los Angeles County plus parts of Orange County (Anaheim, Fullerton, Irvine), Ventura County (Thousand Oaks, Simi Valley, Oxnard), and the Inland Empire (Ontario, Rancho Cucamonga, Pomona).',
                ],
            ],
        ],
    ]];
}

/* =========================================================
   HOUSTON, TX
   ========================================================= */
function ar_location_houston() {
    return [[
        'post_type' => 'location_page',
        'title'     => 'Viking Appliance Repair Houston',
        'slug'      => 'houston',
        'meta_title'  => 'Appliance Repair Houston, TX | Same-Day Service',
        'meta_desc'   => 'Viking appliance repair in Houston, TX. Same-day service across Greater Houston. Genuine Viking OEM parts, certified technicians, 30-day warranty.',
        'taxonomies'  => [
            'city' => 'Houston',
        ],
        'meta_fields' => [
            '_ar_city'        => 'Houston',
            '_ar_state'       => 'TX',
            '_ar_state_full'  => 'Texas',
            '_ar_zip_codes'   => '77001,77002,77003,77004,77005,77006,77007,77008,77009,77010,77011,77012,77013,77014,77015,77016,77017,77018,77019,77020,77021,77022,77023,77024,77025,77026,77027,77028,77029,77030,77031,77032,77033,77034,77035,77036,77037,77038,77039,77040,77041,77042,77043,77044,77045,77046,77047,77048,77049,77050,77051,77053,77054,77055,77056,77057,77058,77059,77060,77061,77062,77063,77064,77065,77066,77067,77068,77069,77070,77071,77072,77073,77074,77075,77076,77077,77078,77079,77080,77081,77082,77083,77084,77085,77086,77087,77088,77089,77090,77091,77092,77093,77094,77095,77096,77097,77098,77099,77201,77336,77338,77339,77345,77346,77357,77365,77373,77375,77377,77379,77380,77381,77382,77384,77385,77386,77388,77389,77396,77401,77406,77407,77429,77433,77447,77449,77450,77477,77478,77479,77489,77494,77498,77502,77503,77504,77505,77506,77507,77520,77521,77530,77532,77536,77546,77547,77562,77571,77572,77573,77578,77581,77584,77586,77587,77598',
            '_ar_hero_subtitle' => "Houston's most trusted appliance repair — fast, professional service across the Greater Houston metro.",
            '_ar_body_intro'  => "Houston homeowners face a unique set of appliance challenges. The extreme heat and high humidity of a Texas summer push Viking refrigerators and air conditioners to their limits, while hard water and flooding events can shorten the life of Viking dishwashers and refrigerators. Our Viking-certified technicians understand these regional factors and address root causes, not just surface symptoms.\n\nWe serve all Houston neighborhoods and Harris County suburbs with same-day and next-day appointments. From the Heights and Montrose to The Woodlands, Sugar Land, and Pearland, our technicians arrive on time and stocked with genuine Viking OEM parts. Houston's sprawling geography means we've built an efficient routing system — you'll receive a precise arrival window so you can plan your day.\n\nEvery Houston Viking repair includes genuine parts, highly trained technicians, and a 30-day parts-and-labor warranty. Transparent, flat-rate pricing — no trip fees buried in the final bill. We will give you a full quote after diagnosis and let you decide before we begin any repair.",
            '_ar_neighborhoods' => 'Montrose,The Heights,Midtown,Museum District,Greenway Plaza,River Oaks,Upper Kirby,West University,Bellaire,Galleria,Memorial,Energy Corridor,Spring Branch,Oak Forest,Garden Oaks,Northside,Eastwood,East End,Gulfton,Meyerland,Braeswood,Friendswood,Pearland,Stafford,Missouri City',
            '_ar_suburbs'     => 'Sugar Land,Katy,Pearland,League City,Friendswood,Missouri City,Stafford,Richmond,Rosenberg,Cypress,Tomball,Spring,The Woodlands,Conroe,Humble,Baytown,Pasadena,La Porte,Deer Park,Seabrook,Webster,Clear Lake,Alvin,Manvel,Angleton',
            '_ar_faqs'        => [
                [
                    'question' => 'Do you offer same-day appliance repair in Houston?',
                    'answer'   => 'Yes. We offer same-day appliance repair throughout Houston and Harris County. We also service Fort Bend County (Sugar Land, Katy), Brazoria County (Pearland, Alvin), and Montgomery County (The Woodlands, Conroe). Call before noon for same-day availability.',
                ],
                [
                    'question' => "How does Houston's heat affect my refrigerator?",
                    'answer'   => 'High ambient temperatures in Houston summers force refrigerators to run longer and harder, which can burn out compressors, condenser fans, and door seals prematurely. If your fridge is running constantly or not holding temperature, call us before the compressor fails — early intervention saves significant repair costs.',
                ],
                [
                    'question' => 'Can flooding damage my appliances in Houston?',
                    'answer'   => 'Yes. Flood water can corrode electrical components, damage control boards, and contaminate Viking refrigerator and dishwasher seals. We recommend having flood-affected Viking appliances professionally inspected before use — some damage is not immediately obvious but can become hazardous.',
                ],
                [
                    'question' => 'What areas of Houston do you serve?',
                    'answer'   => 'We cover all of Houston and Harris County, plus Sugar Land, Katy, Pearland, Missouri City, League City, Friendswood, The Woodlands, Conroe, Humble, Baytown, Pasadena, and more.',
                ],
                [
                    'question' => 'How much does appliance repair cost in Houston?',
                    'answer'   => 'Repair costs depend on the appliance and issue. After diagnosis, we provide a flat-rate quote with no hidden fees. Typical repairs range from $130 to $380 including parts and labor. We will always advise you honestly if replacement is the better financial decision.',
                ],
                [
                    'question' => 'Do you repair commercial appliances in Houston?',
                    'answer'   => 'Our core service covers residential appliances. For light commercial appliances (small restaurant dishwashers, under-counter refrigerators), contact us and we will assess whether we can help.',
                ],
            ],
        ],
    ]];
}

/* =========================================================
   MIAMI, FL
   ========================================================= */
function ar_location_miami() {
    return [[
        'post_type' => 'location_page',
        'title'     => 'Viking Appliance Repair Miami',
        'slug'      => 'miami',
        'meta_title'  => 'Appliance Repair Miami, FL | Same-Day Service',
        'meta_desc'   => 'Viking appliance repair in Miami, FL. Same-day service across Miami-Dade and Broward counties. Genuine Viking OEM parts, certified technicians, 30-day warranty.',
        'taxonomies'  => [
            'city' => 'Miami',
        ],
        'meta_fields' => [
            '_ar_city'        => 'Miami',
            '_ar_state'       => 'FL',
            '_ar_state_full'  => 'Florida',
            '_ar_zip_codes'   => '33101,33109,33111,33112,33114,33116,33119,33121,33122,33124,33125,33126,33127,33128,33129,33130,33131,33132,33133,33134,33135,33136,33137,33138,33139,33140,33141,33142,33143,33144,33145,33146,33147,33149,33150,33151,33152,33153,33154,33155,33156,33157,33158,33160,33161,33162,33163,33165,33166,33167,33168,33169,33170,33172,33173,33174,33175,33176,33177,33178,33179,33180,33181,33182,33183,33184,33185,33186,33187,33189,33190,33193,33194,33196,33197,33199,33301,33304,33305,33306,33308,33309,33310,33311,33312,33313,33314,33315,33316,33317,33319,33321,33322,33323,33324,33325,33326,33327,33328,33329,33330,33331,33332,33334,33388,33394,33401,33406,33407,33408,33409,33410,33411,33412,33413,33414,33415,33417,33418,33426,33428,33431,33432,33433,33434,33436,33437,33438,33440,33441,33442,33444,33445,33446,33448,33449,33458,33460,33461,33462,33463,33467,33469,33470,33472,33473,33477,33478,33480,33483,33484,33486,33487,33496,33498',
            '_ar_hero_subtitle' => "Appliance repair across Miami-Dade and Broward — fast, reliable service in South Florida's heat and humidity.",
            '_ar_body_intro'  => "Miami's tropical climate is one of the most demanding environments for Viking appliances in the United States. Persistent heat and humidity stress Viking refrigerator compressors year-round, accelerate mold buildup in Viking dishwasher seals and interior surfaces, and corrode electrical contacts in Viking range and cooktop control systems faster than in drier climates. Our Viking-certified technicians are trained to address these South Florida-specific failure modes, not just standard repairs.\n\nWe serve the entire Miami metro area including Miami-Dade County, Broward County, and northern Palm Beach County. From Brickell, Coconut Grove, and Coral Gables to Aventura, Doral, Hialeah, Fort Lauderdale, and Boca Raton — our technicians cover the region with same-day and next-day appointments and 2-hour arrival windows.\n\nAll Miami Viking repairs use genuine OEM parts and come with our 30-day parts-and-labor warranty. Our highly trained Viking technicians carry full part inventories for all Viking appliance models and series. Transparent flat-rate pricing — no surprises on the final invoice.",
            '_ar_neighborhoods' => 'Brickell,Downtown Miami,Wynwood,Design District,Edgewater,Little Havana,Little Haiti,Overtown,Liberty City,Allapattah,Coconut Grove,Coral Gables,South Miami,Pinecrest,Palmetto Bay,Cutler Bay,Homestead,Kendall,Doral,Hialeah,Miami Lakes,Opa-locka,North Miami,North Miami Beach,Aventura,Bal Harbour,Surfside,Miami Beach,South Beach,Mid-Beach,North Beach',
            '_ar_suburbs'     => 'Coral Gables,Coconut Grove,Pinecrest,South Miami,Kendall,Doral,Hialeah,Miami Lakes,Homestead,Florida City,Cutler Bay,Palmetto Bay,Miami Gardens,Opa-locka,North Miami,North Miami Beach,Aventura,Hallandale Beach,Hollywood,Pembroke Pines,Miramar,Davie,Fort Lauderdale,Plantation,Sunrise,Tamarac,Lauderhill,Lauderdale Lakes,Margate,Coconut Creek,Pompano Beach,Deerfield Beach,Boca Raton,Delray Beach,Boynton Beach,West Palm Beach,Lake Worth',
            '_ar_faqs'        => [
                [
                    'question' => 'Do you offer same-day appliance repair in Miami?',
                    'answer'   => 'Yes. We offer same-day service throughout Miami-Dade and Broward counties. We understand that in Miami\'s heat, a broken refrigerator or AC-connected appliance is urgent — we prioritize these calls for fastest dispatch.',
                ],
                [
                    'question' => 'Why do appliances fail faster in Miami?',
                    'answer'   => 'Miami\'s year-round heat and humidity are harder on appliances than most US cities. Viking refrigerator compressors work continuously to maintain temperature in the heat. Dishwasher door seals develop mold more quickly in the humidity. Electrical contacts in control boards corrode faster near the coast. Our technicians factor all of this in during diagnostics.',
                ],
                [
                    'question' => 'Do you service condos on Miami Beach and Brickell?',
                    'answer'   => 'Yes, Miami high-rise and condo service is our specialty. We handle doorman buildings, valet parking, freight elevator requirements, and HOA service protocols throughout Miami Beach, Brickell, Edgewater, and Coconut Grove.',
                ],
                [
                    'question' => 'Do you repair appliances in Fort Lauderdale and Boca Raton?',
                    'answer'   => 'Yes. Our service area covers all of Broward County (Fort Lauderdale, Hollywood, Pembroke Pines, Plantation, Sunrise, Coral Springs) and northern Palm Beach County (Boca Raton, Delray Beach, Boynton Beach).',
                ],
                [
                    'question' => 'My Viking dishwasher smells bad — is that a repair issue in Miami?',
                    'answer'   => 'Very common in Miami. High humidity and warm temperatures make dishwasher door seals and interior surfaces prone to mold and mildew buildup. We clean and treat affected areas and replace seals when needed. We also recommend monthly cleaning cycles with a dishwasher cleaner tablet to prevent recurrence.',
                ],
                [
                    'question' => 'What Viking appliances do you repair in Miami?',
                    'answer'   => 'We specialize in Viking appliances: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models and series covered. Genuine Viking parts, same-day service available.',
                ],
            ],
        ],
    ]];
}

/* =========================================================
   SAN FRANCISCO, CA
   ========================================================= */
function ar_location_san_francisco() {
    return [[
        'post_type' => 'location_page',
        'title'     => 'Viking Appliance Repair San Francisco',
        'slug'      => 'san-francisco',
        'meta_title'  => 'Appliance Repair San Francisco, CA | Same-Day Service',
        'meta_desc'   => 'Viking appliance repair in San Francisco and the Bay Area. Same-day service, genuine Viking OEM parts, and a 30-day warranty. Serving SF, Oakland, San Jose, and beyond.',
        'taxonomies'  => [
            'city' => 'San Francisco',
        ],
        'meta_fields' => [
            '_ar_city'        => 'San Francisco',
            '_ar_state'       => 'CA',
            '_ar_state_full'  => 'California',
            '_ar_zip_codes'   => '94102,94103,94104,94105,94107,94108,94109,94110,94111,94112,94114,94115,94116,94117,94118,94119,94120,94121,94122,94123,94124,94127,94129,94130,94131,94132,94133,94134,94158,94401,94402,94403,94404,94501,94502,94503,94505,94506,94507,94509,94510,94511,94513,94514,94516,94517,94518,94519,94520,94521,94522,94523,94526,94527,94528,94531,94536,94537,94538,94539,94541,94542,94544,94545,94546,94547,94549,94550,94551,94552,94555,94556,94560,94563,94564,94565,94566,94568,94569,94572,94574,94577,94578,94579,94580,94582,94583,94586,94587,94588,94595,94596,94597,94598,94601,94602,94603,94605,94606,94607,94608,94609,94610,94611,94612,94618,94619,94621,94702,94703,94704,94705,94706,94707,94708,94709,94710,94720,94801,94803,94804,94805,94806,94901,94903,94904,94920,94925,94930,94939,94941,94945,94947,94949,94952,94954,94960,94965,94970,94973,95002,95008,95014,95032,95035,95051,95112,95116,95122,95124,95125,95126,95128,95129,95130,95131,95132,95133,95134,95135,95136,95139,95148',
            '_ar_hero_subtitle' => 'Bay Area appliance repair — San Francisco, Oakland, San Jose, and the entire Bay Area served.',
            '_ar_body_intro'  => "San Francisco homeowners face specific Viking appliance challenges: salt air corrosion near the coast, temperature swings between microclimates, and the high cost of appliances in the Bay Area making expert repair a wise investment. Our Viking-certified technicians serve the entire SF Bay Area — from the City itself to the East Bay, Peninsula, South Bay, and Marin County.\n\nWe work efficiently in San Francisco's Victorian flats, Edwardian apartments, and modern condos, as well as Oakland bungalows, Palo Alto tech-campus housing, and San Jose single-family homes. Our technicians navigate city parking and building access requirements professionally, carrying full genuine Viking OEM part inventories so most repairs are completed in one visit.\n\nWith the Bay Area's high cost of living, repairing a quality Viking appliance is almost always more economical than replacing it. We give you an honest diagnosis and upfront flat-rate pricing before starting any work. Every repair is backed by genuine Viking parts, highly trained technicians, and a 30-day parts-and-labor warranty.",
            '_ar_neighborhoods' => 'Mission District,Castro,Noe Valley,Bernal Heights,Potrero Hill,SoMa,Tenderloin,Civic Center,Hayes Valley,Haight-Ashbury,Inner Sunset,Outer Sunset,Richmond,Inner Richmond,Outer Richmond,Marina,Pacific Heights,Cow Hollow,Presidio Heights,Nob Hill,Russian Hill,North Beach,Financial District,Chinatown,Excelsior,Visitacion Valley,Bayview,Hunters Point,Glen Park,West Portal,Forest Hill',
            '_ar_suburbs'     => 'Oakland,Berkeley,Emeryville,Alameda,San Leandro,Hayward,Fremont,Union City,Newark,Milpitas,San Jose,Santa Clara,Sunnyvale,Mountain View,Palo Alto,Menlo Park,Redwood City,San Mateo,Burlingame,San Bruno,South San Francisco,Daly City,Colma,San Rafael,Novato,Mill Valley,Sausalito,Tiburon,Corte Madera,Larkspur,San Anselmo,Fairfax,Walnut Creek,Concord,Pleasant Hill,Lafayette,Orinda,Moraga,Danville,San Ramon,Dublin,Pleasanton,Livermore',
            '_ar_faqs'        => [
                [
                    'question' => 'Do you offer same-day appliance repair in San Francisco?',
                    'answer'   => 'Yes. We offer same-day and next-day appliance repair throughout San Francisco and the broader Bay Area. Call before noon and we can typically dispatch a technician the same day. We service the City, East Bay, Peninsula, South Bay, and Marin.',
                ],
                [
                    'question' => 'Do you repair appliances in SF apartments and Victorian flats?',
                    'answer'   => 'Yes. We are experienced with the unique access challenges of San Francisco housing, including long staircases in Victorians, tight kitchens in Edwardian flats, and building permit requirements for certain appliance installations. Our technicians are used to working in compact SF spaces.',
                ],
                [
                    'question' => 'Does salt air from the Bay affect my appliances?',
                    'answer'   => 'Yes, especially for homes in the Richmond, Sunset, Marina, and coastal areas. Salt air accelerates corrosion on exposed metal parts — particularly Viking dishwasher racks, refrigerator door hinges, and range burner components. We use genuine Viking OEM parts and can advise on protective maintenance routines for coastal environments.',
                ],
                [
                    'question' => 'Do you service the East Bay — Oakland, Berkeley, Fremont?',
                    'answer'   => 'Yes. We cover all of Alameda County including Oakland, Berkeley, Emeryville, Alameda, San Leandro, Hayward, Fremont, Union City, and Newark. We also service Contra Costa County cities like Walnut Creek, Concord, and Danville.',
                ],
                [
                    'question' => 'Is appliance repair cost-effective in the Bay Area?',
                    'answer'   => 'Absolutely. With Bay Area appliance prices, delivery fees, and installation costs, replacing an appliance can easily run $1,500–$4,000+. If your appliance is under 10 years old and the repair is under half the replacement cost, repair almost always makes financial sense. We will give you an honest recommendation.',
                ],
                [
                    'question' => 'What Viking appliances do you repair in San Francisco?',
                    'answer'   => 'We repair all Viking appliances: ranges, cooktops, refrigerators, dishwashers, wall ovens, wine coolers, freezers, and vent hoods. All Viking models and series covered. We carry genuine Viking OEM parts and offer same-day service across San Francisco, Oakland, Berkeley, and surrounding areas.',
                ],
            ],
        ],
    ]];
}


