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
                'ean13' => '1234567890123',
                'price' => 15.99,
                'quantity' => 150
            ],
            [
                'product_name' => 'Air Filter Element',
                'category_id' => 1,
                'product_type' => 'filter',
                'ean13' => '1234567890124',
                'price' => 22.50,
                'quantity' => 120
            ],
            [
                'product_name' => 'Spark Plug Set',
                'category_id' => 1,
                'product_type' => 'ignition',
                'ean13' => '1234567890125',
                'price' => 89.99,
                'quantity' => 75
            ],
            [
                'product_name' => 'Engine Gasket Kit',
                'category_id' => 1,
                'product_type' => 'gasket',
                'ean13' => '1234567890126',
                'price' => 125.00,
                'quantity' => 45
            ],
            [
                'product_name' => 'Timing Belt',
                'category_id' => 1,
                'product_type' => 'belt',
                'ean13' => '1234567890127',
                'price' => 68.75,
                'quantity' => 85
            ],

            // Brake System (Category 2)
            [
                'product_name' => 'Ceramic Brake Pads Front',
                'category_id' => 2,
                'product_type' => 'pads',
                'ean13' => '1234567890128',
                'price' => 55.99,
                'quantity' => 100
            ],
            [
                'product_name' => 'Brake Rotors Rear',
                'category_id' => 2,
                'product_type' => 'rotors',
                'ean13' => '1234567890129',
                'price' => 89.50,
                'quantity' => 60
            ],
            [
                'product_name' => 'Brake Caliper',
                'category_id' => 2,
                'product_type' => 'caliper',
                'ean13' => '1234567890130',
                'price' => 145.00,
                'quantity' => 35
            ],
            [
                'product_name' => 'DOT 3 Brake Fluid',
                'category_id' => 2,
                'product_type' => 'fluid',
                'ean13' => '1234567890131',
                'price' => 12.99,
                'quantity' => 200
            ],

            // Suspension (Category 3)
            [
                'product_name' => 'Front Strut Assembly',
                'category_id' => 3,
                'product_type' => 'strut',
                'ean13' => '1234567890132',
                'price' => 165.00,
                'quantity' => 40
            ],
            [
                'product_name' => 'Rear Shock Absorber',
                'category_id' => 3,
                'product_type' => 'shock',
                'ean13' => '1234567890133',
                'price' => 78.99,
                'quantity' => 70
            ],
            [
                'product_name' => 'Sway Bar Link',
                'category_id' => 3,
                'product_type' => 'link',
                'ean13' => '1234567890134',
                'price' => 25.50,
                'quantity' => 120
            ],
            [
                'product_name' => 'Coil Spring Set',
                'category_id' => 3,
                'product_type' => 'spring',
                'ean13' => '1234567890135',
                'price' => 195.00,
                'quantity' => 25
            ],

            // Transmission (Category 4)
            [
                'product_name' => 'Transmission Filter',
                'category_id' => 4,
                'product_type' => 'filter',
                'ean13' => '1234567890136',
                'price' => 32.99,
                'quantity' => 90
            ],
            [
                'product_name' => 'ATF Transmission Fluid',
                'category_id' => 4,
                'product_type' => 'fluid',
                'ean13' => '1234567890137',
                'price' => 18.75,
                'quantity' => 180
            ],
            [
                'product_name' => 'Clutch Kit',
                'category_id' => 4,
                'product_type' => 'clutch',
                'ean13' => '1234567890138',
                'price' => 285.00,
                'quantity' => 20
            ],

            // Electrical (Category 5)
            [
                'product_name' => 'Car Battery 12V',
                'category_id' => 5,
                'product_type' => 'battery',
                'ean13' => '1234567890139',
                'price' => 125.99,
                'quantity' => 50
            ],
            [
                'product_name' => 'Alternator',
                'category_id' => 5,
                'product_type' => 'alternator',
                'ean13' => '1234567890140',
                'price' => 220.00,
                'quantity' => 30
            ],
            [
                'product_name' => 'Starter Motor',
                'category_id' => 5,
                'product_type' => 'starter',
                'ean13' => '1234567890141',
                'price' => 185.50,
                'quantity' => 35
            ],
            [
                'product_name' => 'Ignition Coil',
                'category_id' => 5,
                'product_type' => 'coil',
                'ean13' => '1234567890142',
                'price' => 95.00,
                'quantity' => 65
            ],

            // Body Parts (Category 6)
            [
                'product_name' => 'Side Mirror Assembly',
                'category_id' => 6,
                'product_type' => 'mirror',
                'ean13' => '1234567890143',
                'price' => 85.99,
                'quantity' => 45
            ],
            [
                'product_name' => 'Door Handle',
                'category_id' => 6,
                'product_type' => 'handle',
                'ean13' => '1234567890144',
                'price' => 35.50,
                'quantity' => 80
            ],
            [
                'product_name' => 'Bumper Cover',
                'category_id' => 6,
                'product_type' => 'cover',
                'ean13' => '1234567890145',
                'price' => 165.00,
                'quantity' => 25
            ],

            // Cooling System (Category 7)
            [
                'product_name' => 'Radiator',
                'category_id' => 7,
                'product_type' => 'radiator',
                'ean13' => '1234567890146',
                'price' => 195.00,
                'quantity' => 30
            ],
            [
                'product_name' => 'Water Pump',
                'category_id' => 7,
                'product_type' => 'pump',
                'ean13' => '1234567890147',
                'price' => 89.99,
                'quantity' => 55
            ],
            [
                'product_name' => 'Thermostat',
                'category_id' => 7,
                'product_type' => 'thermostat',
                'ean13' => '1234567890148',
                'price' => 22.50,
                'quantity' => 100
            ],
            [
                'product_name' => 'Cooling Fan',
                'category_id' => 7,
                'product_type' => 'fan',
                'ean13' => '1234567890149',
                'price' => 125.00,
                'quantity' => 40
            ],

            // Exhaust System (Category 8)
            [
                'product_name' => 'Catalytic Converter',
                'category_id' => 8,
                'product_type' => 'converter',
                'ean13' => '1234567890150',
                'price' => 285.00,
                'quantity' => 20
            ],
            [
                'product_name' => 'Muffler',
                'category_id' => 8,
                'product_type' => 'muffler',
                'ean13' => '1234567890151',
                'price' => 65.99,
                'quantity' => 50
            ],
            [
                'product_name' => 'Exhaust Pipe',
                'category_id' => 8,
                'product_type' => 'pipe',
                'ean13' => '1234567890152',
                'price' => 45.50,
                'quantity' => 70
            ],

            // Fuel System (Category 9)
            [
                'product_name' => 'Fuel Pump',
                'category_id' => 9,
                'product_type' => 'pump',
                'ean13' => '1234567890153',
                'price' => 155.00,
                'quantity' => 35
            ],
            [
                'product_name' => 'Fuel Filter',
                'category_id' => 9,
                'product_type' => 'filter',
                'ean13' => '1234567890154',
                'price' => 28.99,
                'quantity' => 90
            ],
            [
                'product_name' => 'Fuel Injector',
                'category_id' => 9,
                'product_type' => 'injector',
                'ean13' => '1234567890155',
                'price' => 75.00,
                'quantity' => 60
            ],

            // Lighting (Category 10)
            [
                'product_name' => 'LED Headlight Bulb',
                'category_id' => 10,
                'product_type' => 'bulb',
                'ean13' => '1234567890156',
                'price' => 45.99,
                'quantity' => 80
            ],
            [
                'product_name' => 'Tail Light Assembly',
                'category_id' => 10,
                'product_type' => 'assembly',
                'ean13' => '1234567890157',
                'price' => 95.00,
                'quantity' => 40
            ],
            [
                'product_name' => 'Turn Signal Bulb',
                'category_id' => 10,
                'product_type' => 'bulb',
                'ean13' => '1234567890158',
                'price' => 8.99,
                'quantity' => 150
            ],

            // Tires & Wheels (Category 11)
            [
                'product_name' => 'All-Season Tire',
                'category_id' => 11,
                'product_type' => 'tire',
                'ean13' => '1234567890159',
                'price' => 135.00,
                'quantity' => 60
            ],
            [
                'product_name' => 'Alloy Wheel',
                'category_id' => 11,
                'product_type' => 'wheel',
                'ean13' => '1234567890160',
                'price' => 185.00,
                'quantity' => 32
            ],
            [
                'product_name' => 'Wheel Hub Assembly',
                'category_id' => 11,
                'product_type' => 'hub',
                'ean13' => '1234567890161',
                'price' => 125.00,
                'quantity' => 45
            ],

            // Air System (Category 12)
            [
                'product_name' => 'Cabin Air Filter',
                'category_id' => 12,
                'product_type' => 'filter',
                'ean13' => '1234567890162',
                'price' => 18.99,
                'quantity' => 110
            ],
            [
                'product_name' => 'Air Intake Hose',
                'category_id' => 12,
                'product_type' => 'hose',
                'ean13' => '1234567890163',
                'price' => 35.50,
                'quantity' => 85
            ],
            [
                'product_name' => 'Mass Air Flow Sensor',
                'category_id' => 12,
                'product_type' => 'sensor',
                'ean13' => '1234567890164',
                'price' => 165.00,
                'quantity' => 30
            ]
        ];

        // Simple insert
        $this->db->table('products')->insertBatch($data);
    }
}
