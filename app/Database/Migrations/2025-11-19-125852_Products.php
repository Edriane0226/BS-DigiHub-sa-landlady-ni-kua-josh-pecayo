<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'product_name'=> ['type' => 'VARCHAR', 'constraint' => '200'],
            'category_id' => ['type' => 'INT', 'null' => true],
            'product_type'=> ['type' => 'ENUM("digital","physical")', 'null' => false],
            'sku'         => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'price'       => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'quantity'    => ['type' => 'INT', 'default' => 0],
            'description' => ['type' => 'TEXT', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'SET NULL');

        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
