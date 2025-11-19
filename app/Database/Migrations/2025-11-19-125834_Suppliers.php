<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suppliers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'auto_increment' => true],
            'supplier_name'  => ['type' => 'VARCHAR', 'constraint' => '150', 'null' => false],
            'contact_person' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'phone'          => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'email'          => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'address'        => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('suppliers');
    }

    public function down()
    {
        $this->forge->dropTable('suppliers');
    }
}
