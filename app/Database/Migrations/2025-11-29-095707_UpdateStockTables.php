<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateStockTables extends Migration
{
    public function up()
    {
        // Update stock_out table - fix column names to match our StockOutModel
        try {
            // Check if old columns exist and rename them
            $this->db->query('ALTER TABLE stock_out CHANGE date_issued date_out DATETIME');
            $this->db->query('ALTER TABLE stock_out CHANGE issued_to reason VARCHAR(100)');
            $this->db->query('ALTER TABLE stock_out DROP COLUMN IF EXISTS purpose');
        } catch (\Exception $e) {
            // Columns might already be updated, ignore error
        }
        
        // Remove remarks column from stock_in table
        try {
            $this->db->query('ALTER TABLE stock_in DROP COLUMN IF EXISTS remarks');
        } catch (\Exception $e) {
            // Column might already be removed, ignore error
        }
    }

    public function down()
    {
        // Add back remarks column to stock_in
        $this->forge->addColumn('stock_in', [
            'remarks' => ['type' => 'TEXT', 'null' => true]
        ]);
        
        // Revert stock_out column names
        $this->db->query('ALTER TABLE stock_out CHANGE date_out date_issued DATETIME');
        $this->db->query('ALTER TABLE stock_out CHANGE reason issued_to VARCHAR(120)');
        $this->forge->addColumn('stock_out', [
            'purpose' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true]
        ]);
    }
}
