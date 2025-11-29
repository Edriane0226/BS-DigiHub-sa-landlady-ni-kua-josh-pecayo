<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShelfLocationToProducts extends Migration
{
    public function up()
    {
        // Add shelf_location_id column to products table
        $this->forge->addColumn('products', [
            'shelf_location_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'category_id',
            ],
        ]);

        // Add foreign key constraint using raw SQL for better compatibility
        $this->db->query('ALTER TABLE products ADD CONSTRAINT products_shelf_location_id_foreign FOREIGN KEY (shelf_location_id) REFERENCES shelf_locations(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        // Drop foreign key constraint first
        $this->db->query('ALTER TABLE products DROP FOREIGN KEY products_shelf_location_id_foreign');
        // Then drop the column
        $this->forge->dropColumn('products', 'shelf_location_id');
    }
}
