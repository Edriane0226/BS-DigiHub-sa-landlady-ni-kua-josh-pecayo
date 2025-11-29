<?php
namespace App\Models;

use CodeIgniter\Model;

class StockInModel extends Model
{
    protected $table = 'stock_in';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'quantity', 'date_received'];
    
    public function getStockInWithProduct($limit = null)
    {
        $builder = $this->select('stock_in.*, products.product_name, products.ean13')
                        ->join('products', 'products.id = stock_in.product_id')
                        ->orderBy('stock_in.date_received', 'DESC');
        
        if ($limit) {
            $builder->limit($limit);
        }
        
        return $builder->findAll();
    }
}