<?php
namespace App\Models;


use CodeIgniter\Model;


class ProductModel extends Model
{
protected $table = 'products';
protected $primaryKey = 'id';
protected $allowedFields = ['product_name','category_id','product_type','sku','ean13','price','quantity'];


public function withCategory()
{
return $this->select('products.*, categories.category_name')->join('categories', 'categories.id = products.category_id', 'left');
}
}