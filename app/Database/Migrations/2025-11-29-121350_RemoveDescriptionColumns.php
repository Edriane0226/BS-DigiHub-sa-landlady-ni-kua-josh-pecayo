<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveDescriptionColumns extends Migration
{
    public function up()
    {
        // Remove description column from categories table
        $this->forge->dropColumn('categories', 'description');
        
        // Remove description column from products table
        $this->forge->dropColumn('products', 'description');
    }

    public function down()
    {
        // Add back description column to categories table
        $this->forge->addColumn('categories', [
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'category_name'
            ]
        ]);
        
        // Add back description column to products table
        $this->forge->addColumn('products', [
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'quantity'
            ]
        ]);
    }
}
