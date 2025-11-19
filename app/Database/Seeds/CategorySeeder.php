<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'category_name' => 'Engine Parts',
                'description' => 'Engine components including pistons, valves, gaskets, and filters'
            ],
            [
                'category_name' => 'Brake System',
                'description' => 'Brake pads, rotors, calipers, and brake fluid components'
            ],
            [
                'category_name' => 'Suspension',
                'description' => 'Shocks, struts, springs, and suspension components'
            ],
            [
                'category_name' => 'Transmission',
                'description' => 'Transmission parts, clutch components, and drivetrain parts'
            ],
            [
                'category_name' => 'Electrical',
                'description' => 'Batteries, alternators, starters, and electrical components'
            ],
            [
                'category_name' => 'Body Parts',
                'description' => 'Exterior and interior body parts, trim, and accessories'
            ],
            [
                'category_name' => 'Cooling System',
                'description' => 'Radiators, thermostats, water pumps, and cooling components'
            ],
            [
                'category_name' => 'Exhaust System',
                'description' => 'Mufflers, catalytic converters, and exhaust pipes'
            ],
            [
                'category_name' => 'Fuel System',
                'description' => 'Fuel pumps, injectors, filters, and fuel delivery components'
            ],
            [
                'category_name' => 'Lighting',
                'description' => 'Headlights, taillights, bulbs, and lighting accessories'
            ],
            [
                'category_name' => 'Tires & Wheels',
                'description' => 'Tires, wheels, rims, and tire accessories'
            ],
            [
                'category_name' => 'Air System',
                'description' => 'Air filters, intake components, and ventilation parts'
            ]
        ];

        // Simple insert
        $this->db->table('categories')->insertBatch($data);
    }
}