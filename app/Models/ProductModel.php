<?php
namespace App\Models;


use CodeIgniter\Model;


class ProductModel extends Model
{
protected $table = 'products';
protected $primaryKey = 'id';
protected $allowedFields = ['product_name','category_id','supplier_id','product_type','sku','price','quantity','description'];


public function withCategory()
{
return $this->select('products.*, categories.category_name')->join('categories', 'categories.id = products.category_id', 'left');
}
}