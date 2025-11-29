<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'customer_id' => ['type' => 'INT', 'null' => true],
            'product_id'  => ['type' => 'INT', 'null' => false],
            'quantity'    => ['type' => 'INT', 'null' => false],
            'total_amount'=> ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'date_sold'   => ['type' => 'DATETIME'],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'SET NULL');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE');

        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales');
    }
}
