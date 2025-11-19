<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'supplier_name' => 'AutoParts Plus Inc.',
                'contact_person' => 'John Martinez',
                'phone' => '+1-555-0101',
                'email' => 'john@autopartsplus.com',
                'address' => '1234 Industrial Blvd, Detroit, MI 48201'
            ],
            [
                'supplier_name' => 'Premium Motor Supply',
                'contact_person' => 'Sarah Johnson',
                'phone' => '+1-555-0102',
                'email' => 'sarah@premiummotor.com',
                'address' => '5678 Commerce Way, Los Angeles, CA 90210'
            ],
            [
                'supplier_name' => 'Global Auto Components',
                'contact_person' => 'Michael Chen',
                'phone' => '+1-555-0103',
                'email' => 'michael@globalauto.com',
                'address' => '9012 Manufacturing St, Chicago, IL 60601'
            ],
            [
                'supplier_name' => 'Elite Parts Distributor',
                'contact_person' => 'Emily Rodriguez',
                'phone' => '+1-555-0104',
                'email' => 'emily@eliteparts.com',
                'address' => '3456 Distribution Center Dr, Houston, TX 77001'
            ],
            [
                'supplier_name' => 'Quality Auto Solutions',
                'contact_person' => 'David Thompson',
                'phone' => '+1-555-0105',
                'email' => 'david@qualityauto.com',
                'address' => '7890 Warehouse Ln, Phoenix, AZ 85001'
            ],
            [
                'supplier_name' => 'Precision Automotive',
                'contact_person' => 'Lisa Wong',
                'phone' => '+1-555-0106',
                'email' => 'lisa@precisionauto.com',
                'address' => '2468 Assembly Ave, Atlanta, GA 30301'
            ],
            [
                'supplier_name' => 'Reliable Parts Network',
                'contact_person' => 'James Wilson',
                'phone' => '+1-555-0107',
                'email' => 'james@reliableparts.com',
                'address' => '1357 Logistics Blvd, Miami, FL 33101'
            ],
            [
                'supplier_name' => 'Advanced Auto Tech',
                'contact_person' => 'Angela Davis',
                'phone' => '+1-555-0108',
                'email' => 'angela@advancedauto.com',
                'address' => '8024 Technology Dr, Seattle, WA 98101'
            ],
            [
                'supplier_name' => 'Metro Parts Supply',
                'contact_person' => 'Robert Kim',
                'phone' => '+1-555-0109',
                'email' => 'robert@metroparts.com',
                'address' => '4680 Metro Center, Denver, CO 80201'
            ],
            [
                'supplier_name' => 'Supreme Auto Parts',
                'contact_person' => 'Michelle Garcia',
                'phone' => '+1-555-0110',
                'email' => 'michelle@supremeauto.com',
                'address' => '9753 Supreme Way, Las Vegas, NV 89101'
            ],
            [
                'supplier_name' => 'National Auto Distributors',
                'contact_person' => 'Christopher Lee',
                'phone' => '+1-555-0111',
                'email' => 'chris@nationalauto.com',
                'address' => '1122 National Blvd, Boston, MA 02101'
            ],
            [
                'supplier_name' => 'ProParts International',
                'contact_person' => 'Jennifer Brown',
                'phone' => '+1-555-0112',
                'email' => 'jennifer@proparts.com',
                'address' => '5544 International Way, Portland, OR 97201'
            ]
        ];

        // Simple insert
        $this->db->table('suppliers')->insertBatch($data);
    }
}