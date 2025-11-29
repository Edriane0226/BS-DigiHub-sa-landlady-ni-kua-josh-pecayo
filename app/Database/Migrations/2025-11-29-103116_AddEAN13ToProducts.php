<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEAN13ToProducts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('products', [
            'ean13' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
                'after' => 'sku'
            ]
        ]);
        
        // Add unique index for EAN-13
        $this->forge->addKey('ean13', false, false, 'idx_products_ean13');
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'ean13');
        $this->forge->dropKey('products', 'idx_products_ean13');
    }
}
