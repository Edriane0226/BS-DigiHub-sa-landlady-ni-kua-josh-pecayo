<?php
namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SupplierModel;
use App\Models\ProductCompatibilityModel;
use App\Models\CarModel as CarModelModel;


class Products extends BaseController
{
protected $productModel;
protected $categoryModel;
protected $supplierModel;
protected $compatModel;
protected $carModel;


public function __construct()
{
$this->productModel = new ProductModel();
$this->categoryModel = new CategoryModel();
$this->supplierModel = new SupplierModel();
$this->compatModel = new ProductCompatibilityModel();
$this->carModel = new CarModelModel();
}


public function index()
{
    $products = $this->productModel->withCategory()->findAll();
    
    $data = [
        'title' => 'Products',
        'breadcrumbs' => [
            'Home' => base_url(),
            'Products' => null
        ],
        'products' => $products
    ];
    
    return view('products/index', $data);
}


public function create()
{
    $data = [
        'title' => 'Add Product',
        'breadcrumbs' => [
            'Home' => base_url(),
            'Products' => base_url('products'),
            'Add Product' => null
        ],
        'categories' => $this->categoryModel->findAll(),
        'suppliers' => $this->supplierModel->findAll()
    ];
    
    return view('products/form', $data);
}


public function store()
{
$post = $this->request->getPost();


$rules = [
'product_name' => 'required|min_length[3]',
'price' => 'required|decimal',
'product_type' => 'required'
];


if (! $this->validate($rules)) {
return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
}


$this->productModel->insert([
'product_name' => $post['product_name'],
'category_id' => $post['category_id'] ?? null,
'supplier_id' => $post['supplier_id'] ?? null,
'product_type' => $post['product_type'],
'sku' => $post['sku'] ?? null,
'price' => $post['price'],
'quantity' => $post['quantity'] ?? 0,
'description' => $post['description'] ?? null,
]);


return redirect()->to('/products')->with('success', 'Product created');
}


public function edit($id)
{
    $product = $this->productModel->find($id);
    if (! $product) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
    }
    
    $data = [
        'title' => 'Edit Product',
        'breadcrumbs' => [
            'Home' => base_url(),
            'Products' => base_url('products'),
            'Edit Product' => null
        ],
        'product' => $product,
        'categories' => $this->categoryModel->findAll(),
        'suppliers' => $this->supplierModel->findAll(),
        'compatibilities' => $this->compatModel->getCompatibilityForProduct($id),
        'car_models' => $this->carModel->findAll()
    ];
    
    return view('products/edit', $data);
}


public function update($id)
{
$post = $this->request->getPost();
$this->productModel->update($id, [
'product_name' => $post['product_name'],
'category_id' => $post['category_id'] ?? null,
'supplier_id' => $post['supplier_id'] ?? null,
'product_type' => $post['product_type'],
'sku' => $post['sku'] ?? null,
'price' => $post['price'],
'quantity' => $post['quantity'] ?? 0,
'description' => $post['description'] ?? null,
]);


// handle compatibility additions
if (! empty($post['car_model_id'])) {
foreach ((array)$post['car_model_id'] as $carModelId) {
// avoid duplicates: use findBy combination
$exists = $this->compatModel->where(['product_id' => $id, 'car_model_id' => $carModelId])->first();
if (! $exists) {
$this->compatModel->insert(['product_id' => $id, 'car_model_id' => $carModelId]);
}
}
}


return redirect()->to('/products')->with('success', 'Product updated');
}


public function delete($id)
{
$this->productModel->delete($id);
return redirect()->to('/products')->with('success', 'Product deleted');
}
}
