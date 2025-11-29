<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Engine Parts (Category 1)
            [
                'product_name' => 'Premium Oil Filter',
                'category_id' => 1,
                'product_type' => 'filter',
                'sku' => 'EOF-001',
                'price' => 15.99,
                'quantity' => 150,
                'description' => 'High-quality oil filter for enhanced engine protection'
            ],
            [
                'product_name' => 'Air Filter Element',
                'category_id' => 1,
                'product_type' => 'filter',
                'sku' => 'EAF-002',
                'price' => 22.50,
                'quantity' => 120,
                'description' => 'OEM quality air filter for optimal engine performance'
            ],
            [
                'product_name' => 'Spark Plug Set',
                'category_id' => 1,
                'product_type' => 'ignition',
                'sku' => 'ESP-003',
                'price' => 89.99,
                'quantity' => 75,
                'description' => 'Platinum spark plugs for improved fuel efficiency'
            ],
            [
                'product_name' => 'Engine Gasket Kit',
                'category_id' => 1,
                'product_type' => 'gasket',
                'sku' => 'EGK-004',
                'price' => 125.00,
                'quantity' => 45,
                'description' => 'Complete engine gasket kit for engine rebuild'
            ],
            [
                'product_name' => 'Timing Belt',
                'category_id' => 1,
                'product_type' => 'belt',
                'sku' => 'ETB-005',
                'price' => 68.75,
                'quantity' => 85,
                'description' => 'Precision timing belt for valve timing'
            ],

            // Brake System (Category 2)
            [
                'product_name' => 'Ceramic Brake Pads Front',
                'category_id' => 2,
                'product_type' => 'pads',
                'sku' => 'BPF-006',
                'price' => 55.99,
                'quantity' => 100,
                'description' => 'Low-dust ceramic brake pads for front wheels'
            ],
            [
                'product_name' => 'Brake Rotors Rear',
                'category_id' => 2,
                'product_type' => 'rotors',
                'sku' => 'BRR-007',
                'price' => 89.50,
                'quantity' => 60,
                'description' => 'Vented brake rotors for rear axle'
            ],
            [
                'product_name' => 'Brake Caliper',
                'category_id' => 2,
                'product_type' => 'caliper',
                'sku' => 'BCL-008',
                'price' => 145.00,
                'quantity' => 35,
                'description' => 'Remanufactured brake caliper with warranty'
            ],
            [
                'product_name' => 'DOT 3 Brake Fluid',
                'category_id' => 2,
                'product_type' => 'fluid',
                'sku' => 'BFL-009',
                'price' => 12.99,
                'quantity' => 200,
                'description' => 'High-performance DOT 3 brake fluid'
            ],

            // Suspension (Category 3)
            [
                'product_name' => 'Front Strut Assembly',
                'category_id' => 3,
                'product_type' => 'strut',
                'sku' => 'FSA-010',
                'price' => 165.00,
                'quantity' => 40,
                'description' => 'Complete front strut assembly with spring'
            ],
            [
                'product_name' => 'Rear Shock Absorber',
                'category_id' => 3,
                'product_type' => 'shock',
                'sku' => 'RSA-011',
                'price' => 78.99,
                'quantity' => 70,
                'description' => 'Gas-filled rear shock absorber'
            ],
            [
                'product_name' => 'Sway Bar Link',
                'category_id' => 3,
                'product_type' => 'link',
                'sku' => 'SBL-012',
                'price' => 25.50,
                'quantity' => 120,
                'description' => 'Heavy-duty sway bar end link'
            ],
            [
                'product_name' => 'Coil Spring Set',
                'category_id' => 3,
                'product_type' => 'spring',
                'sku' => 'CSS-013',
                'price' => 195.00,
                'quantity' => 25,
                'description' => 'Progressive rate coil spring set'
            ],

            // Transmission (Category 4)
            [
                'product_name' => 'Transmission Filter',
                'category_id' => 4,
                'product_type' => 'filter',
                'sku' => 'TRF-014',
                'price' => 32.99,
                'quantity' => 90,
                'description' => 'Automatic transmission filter kit'
            ],
            [
                'product_name' => 'ATF Transmission Fluid',
                'category_id' => 4,
                'product_type' => 'fluid',
                'sku' => 'ATF-015',
                'price' => 18.75,
                'quantity' => 180,
                'description' => 'Multi-vehicle ATF transmission fluid'
            ],
            [
                'product_name' => 'Clutch Kit',
                'category_id' => 4,
                'product_type' => 'clutch',
                'sku' => 'CLK-016',
                'price' => 285.00,
                'quantity' => 20,
                'description' => 'Complete clutch kit with pressure plate'
            ],

            // Electrical (Category 5)
            [
                'product_name' => 'Car Battery 12V',
                'category_id' => 5,
                'product_type' => 'battery',
                'sku' => 'BAT-017',
                'price' => 125.99,
                'quantity' => 50,
                'description' => 'Maintenance-free 12V car battery'
            ],
            [
                'product_name' => 'Alternator',
                'category_id' => 5,
                'product_type' => 'alternator',
                'sku' => 'ALT-018',
                'price' => 220.00,
                'quantity' => 30,
                'description' => 'Remanufactured alternator with warranty'
            ],
            [
                'product_name' => 'Starter Motor',
                'category_id' => 5,
                'product_type' => 'starter',
                'sku' => 'STR-019',
                'price' => 185.50,
                'quantity' => 35,
                'description' => 'High-torque starter motor'
            ],
            [
                'product_name' => 'Ignition Coil',
                'category_id' => 5,
                'product_type' => 'coil',
                'sku' => 'IGC-020',
                'price' => 95.00,
                'quantity' => 65,
                'description' => 'Performance ignition coil pack'
            ],

            // Body Parts (Category 6)
            [
                'product_name' => 'Side Mirror Assembly',
                'category_id' => 6,
                'product_type' => 'mirror',
                'sku' => 'SMA-021',
                'price' => 85.99,
                'quantity' => 45,
                'description' => 'Power side mirror with turn signal'
            ],
            [
                'product_name' => 'Door Handle',
                'category_id' => 6,
                'product_type' => 'handle',
                'sku' => 'DHD-022',
                'price' => 35.50,
                'quantity' => 80,
                'description' => 'Exterior door handle with key slot'
            ],
            [
                'product_name' => 'Bumper Cover',
                'category_id' => 6,
                'product_type' => 'cover',
                'sku' => 'BMP-023',
                'price' => 165.00,
                'quantity' => 25,
                'description' => 'Front bumper cover painted'
            ],

            // Cooling System (Category 7)
            [
                'product_name' => 'Radiator',
                'category_id' => 7,
                'product_type' => 'radiator',
                'sku' => 'RAD-024',
                'price' => 195.00,
                'quantity' => 30,
                'description' => 'Aluminum core radiator assembly'
            ],
            [
                'product_name' => 'Water Pump',
                'category_id' => 7,
                'product_type' => 'pump',
                'sku' => 'WTP-025',
                'price' => 89.99,
                'quantity' => 55,
                'description' => 'Engine water pump with gasket'
            ],
            [
                'product_name' => 'Thermostat',
                'category_id' => 7,
                'product_type' => 'thermostat',
                'sku' => 'THM-026',
                'price' => 22.50,
                'quantity' => 100,
                'description' => 'Engine coolant thermostat'
            ],
            [
                'product_name' => 'Cooling Fan',
                'category_id' => 7,
                'product_type' => 'fan',
                'sku' => 'CFN-027',
                'price' => 125.00,
                'quantity' => 40,
                'description' => 'Electric cooling fan assembly'
            ],

            // Exhaust System (Category 8)
            [
                'product_name' => 'Catalytic Converter',
                'category_id' => 8,
                'product_type' => 'converter',
                'sku' => 'CAT-028',
                'price' => 285.00,
                'quantity' => 20,
                'description' => 'EPA compliant catalytic converter'
            ],
            [
                'product_name' => 'Muffler',
                'category_id' => 8,
                'product_type' => 'muffler',
                'sku' => 'MUF-029',
                'price' => 65.99,
                'quantity' => 50,
                'description' => 'Quiet-flow muffler assembly'
            ],
            [
                'product_name' => 'Exhaust Pipe',
                'category_id' => 8,
                'product_type' => 'pipe',
                'sku' => 'EXP-030',
                'price' => 45.50,
                'quantity' => 70,
                'description' => 'Aluminized exhaust pipe section'
            ],

            // Fuel System (Category 9)
            [
                'product_name' => 'Fuel Pump',
                'category_id' => 9,
                'product_type' => 'pump',
                'sku' => 'FUP-031',
                'price' => 155.00,
                'quantity' => 35,
                'description' => 'Electric in-tank fuel pump'
            ],
            [
                'product_name' => 'Fuel Filter',
                'category_id' => 9,
                'product_type' => 'filter',
                'sku' => 'FUF-032',
                'price' => 28.99,
                'quantity' => 90,
                'description' => 'Inline fuel filter with fittings'
            ],
            [
                'product_name' => 'Fuel Injector',
                'category_id' => 9,
                'product_type' => 'injector',
                'sku' => 'FUI-033',
                'price' => 75.00,
                'quantity' => 60,
                'description' => 'Multi-port fuel injector'
            ],

            // Lighting (Category 10)
            [
                'product_name' => 'LED Headlight Bulb',
                'category_id' => 10,
                'product_type' => 'bulb',
                'sku' => 'LHB-034',
                'price' => 45.99,
                'quantity' => 80,
                'description' => 'High-brightness LED headlight bulb'
            ],
            [
                'product_name' => 'Tail Light Assembly',
                'category_id' => 10,
                'product_type' => 'assembly',
                'sku' => 'TLA-035',
                'price' => 95.00,
                'quantity' => 40,
                'description' => 'Complete tail light assembly'
            ],
            [
                'product_name' => 'Turn Signal Bulb',
                'category_id' => 10,
                'product_type' => 'bulb',
                'sku' => 'TSB-036',
                'price' => 8.99,
                'quantity' => 150,
                'description' => 'Amber turn signal bulb set'
            ],

            // Tires & Wheels (Category 11)
            [
                'product_name' => 'All-Season Tire',
                'category_id' => 11,
                'product_type' => 'tire',
                'sku' => 'AST-037',
                'price' => 135.00,
                'quantity' => 60,
                'description' => 'P225/60R16 all-season tire'
            ],
            [
                'product_name' => 'Alloy Wheel',
                'category_id' => 11,
                'product_type' => 'wheel',
                'sku' => 'ALW-038',
                'price' => 185.00,
                'quantity' => 32,
                'description' => '16-inch alloy wheel rim'
            ],
            [
                'product_name' => 'Wheel Hub Assembly',
                'category_id' => 11,
                'product_type' => 'hub',
                'sku' => 'WHA-039',
                'price' => 125.00,
                'quantity' => 45,
                'description' => 'Front wheel hub with bearing'
            ],

            // Air System (Category 12)
            [
                'product_name' => 'Cabin Air Filter',
                'category_id' => 12,
                'product_type' => 'filter',
                'sku' => 'CAF-040',
                'price' => 18.99,
                'quantity' => 110,
                'description' => 'HEPA cabin air filter'
            ],
            [
                'product_name' => 'Air Intake Hose',
                'category_id' => 12,
                'product_type' => 'hose',
                'sku' => 'AIH-041',
                'price' => 35.50,
                'quantity' => 85,
                'description' => 'Flexible air intake hose'
            ],
            [
                'product_name' => 'Mass Air Flow Sensor',
                'category_id' => 12,
                'product_type' => 'sensor',
                'sku' => 'MAF-042',
                'price' => 165.00,
                'quantity' => 30,
                'description' => 'Digital mass air flow sensor'
            ]
        ];

        // Simple insert
        $this->db->table('products')->insertBatch($data);
    }
}
