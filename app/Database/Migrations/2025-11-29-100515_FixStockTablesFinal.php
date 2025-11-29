<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixStockTablesFinal extends Migration
{
    public function up()
    {
        // Remove remarks column from stock_in
        $this->forge->dropColumn('stock_in', ['remarks']);
        
        // Remove purpose column from stock_out
        $this->forge->dropColumn('stock_out', ['purpose']);
    }

    public function down()
    {
        // Add back the columns
        $this->forge->addColumn('stock_in', [
            'remarks' => ['type' => 'TEXT', 'null' => true]
        ]);
        
        $this->forge->addColumn('stock_out', [
            'purpose' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true]
        ]);
    }
}
