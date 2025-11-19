<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CarModels extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'auto_increment' => true],
            'brand'     => ['type' => 'VARCHAR', 'constraint' => '100'],
            'model'     => ['type' => 'VARCHAR', 'constraint' => '100'],
            'year_start'=> ['type' => 'INT'],
            'year_end'  => ['type' => 'INT', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['brand', 'model', 'year_start', 'year_end']);

        $this->forge->createTable('car_models');
    }

    public function down()
    {
        $this->forge->dropTable('car_models');
    }
}
