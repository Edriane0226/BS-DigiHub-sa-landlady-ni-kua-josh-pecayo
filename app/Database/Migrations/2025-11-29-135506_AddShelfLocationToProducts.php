<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShelfLocationToProducts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('products', [
            'shelf_location_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'category_id',
            ],
        ]);

        // Add foreign key constraint
        $this->forge->addForeignKey('shelf_location_id', 'shelf_locations', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('products', 'products_shelf_location_id_foreign');
        // Drop column
        $this->forge->dropColumn('products', 'shelf_location_id');
    }
}
