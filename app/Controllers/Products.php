<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductCompatibilityModel;
use App\Models\CarModel as CarModelModel;

class Products extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $compatModel;
    protected $carModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->compatModel = new ProductCompatibilityModel();
        $this->carModel = new CarModelModel();
    }

    public function index()
    {
        $query = $this->productModel->withCategory();
        
        // Handle filters
        $filters = [
            'search' => $this->request->getGet('search'),
            'category' => $this->request->getGet('category'),
            'type' => $this->request->getGet('type'),
            'stock' => $this->request->getGet('stock')
        ];
        
        // Apply search filter
        if (!empty($filters['search'])) {
            $query->groupStart()
                  ->like('products.product_name', $filters['search'])
                  ->orLike('products.sku', $filters['search'])
                  ->orLike('products.ean13', $filters['search'])
                  ->groupEnd();
        }
        
        // Apply category filter
        if (!empty($filters['category'])) {
            $query->where('products.category_id', $filters['category']);
        }
        
        // Apply type filter
        if (!empty($filters['type'])) {
            $query->where('products.product_type', $filters['type']);
        }
        
        // Apply stock status filter
        if (!empty($filters['stock'])) {
            switch ($filters['stock']) {
                case 'in-stock':
                    $query->where('products.quantity >', 5);
                    break;
                case 'low-stock':
                    $query->where('products.quantity <=', 5)
                          ->where('products.quantity >', 0);
                    break;
                case 'out-of-stock':
                    $query->where('products.quantity', 0);
                    break;
            }
        }
        
        $products = $query->paginate(10);
        $pager = $query->pager;
        
        // Calculate statistics using fresh model instances
        $statsModel = new \App\Models\ProductModel();
        $stats = [
            'total' => $statsModel->countAllResults(false),
            'in_stock' => (new \App\Models\ProductModel())->where('quantity >', 5)->countAllResults(false),
            'low_stock' => (new \App\Models\ProductModel())->where('quantity <=', 5)->where('quantity >', 0)->countAllResults(false),
            'out_of_stock' => (new \App\Models\ProductModel())->where('quantity', 0)->countAllResults(false)
        ];
        
        $data = [
            'title' => 'Products',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Products' => null
            ],
            'products' => $products,
            'pager' => $pager,
            'categories' => $this->categoryModel->findAll(),
            'filters' => $filters,
            'stats' => $stats
        ];
        
        return view('products/index', $data);
    }

    public function stockIn()
    {
        $data = [
            'title' => 'Stock In',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Products' => base_url('products'),
                'Stock In' => null
            ],
            'categories' => $this->categoryModel->findAll(),
            'car_models' => $this->carModel->findAll()
        ];
        
        return view('products/stock_in', $data);
    }

    public function stockOut()
    {
        $data = [
            'title' => 'Stock Out',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Products' => base_url('products'),
                'Stock Out' => null
            ]
        ];
        
        return view('products/stock_out', $data);
    }

    public function processStockIn()
    {
        $post = $this->request->getPost();
        $barcode = $post['barcode'] ?? null;
        
        if (!$barcode) {
            return redirect()->back()->with('error', 'Barcode is required');
        }
        
        // Handle new category creation if selected
        $categoryId = null;
        if (!empty($post['category_option'])) {
            if ($post['category_option'] === 'new') {
                // Validate new category fields
                if (empty($post['new_category_name'])) {
                    return redirect()->back()->withInput()->with('error', 'Category name is required for new category');
                }
                
                // Create new category
                $newCategoryData = [
                    'category_name' => $post['new_category_name']
                ];
                
                $categoryId = $this->categoryModel->insert($newCategoryData);
                if (!$categoryId) {
                    return redirect()->back()->withInput()->with('error', 'Failed to create new category');
                }
            } elseif ($post['category_option'] === 'existing') {
                // Use existing selected category
                $categoryId = $post['category_id'] ?? null;
            }
            // If 'none' option is selected, categoryId remains null
        }
        
        // Handle new car model creation if selected
        $carModelIds = [];
        if (!empty($post['compatibility_option']) && $post['compatibility_option'] === 'new') {
            // Validate new car model fields
            if (empty($post['new_car_brand']) || empty($post['new_car_model']) || empty($post['new_car_year_start'])) {
                return redirect()->back()->withInput()->with('error', 'Brand, model, and start year are required for new car model');
            }
            
            // Create new car model
            $newCarData = [
                'brand' => $post['new_car_brand'],
                'model' => $post['new_car_model'], 
                'year_start' => (int)$post['new_car_year_start'],
                'year_end' => !empty($post['new_car_year_end']) ? (int)$post['new_car_year_end'] : null
            ];
            
            $newCarId = $this->carModel->insert($newCarData);
            if ($newCarId) {
                $carModelIds[] = $newCarId;
            }
        } else {
            // Use existing selected car models
            $carModelIds = (array)($post['car_model_id'] ?? []);
        }
        
        // Check if product exists by SKU/barcode
        $product = $this->productModel->where('sku', $barcode)
                                      ->orWhere('ean13', $barcode)
                                      ->first();
        
        if ($product) {
            // Existing product - update quantity and category if provided
            $updateData = ['quantity' => $product['quantity'] + (int)$post['quantity']];
            
            // Update category if a new category option was selected
            if ($categoryId !== null || (!empty($post['category_option']) && $post['category_option'] === 'none')) {
                $updateData['category_id'] = $categoryId; // null for 'none' option
            }
            
            $this->productModel->update($product['id'], $updateData);
            
            // Handle car compatibility for existing product
            if (!empty($carModelIds)) {
                foreach ($carModelIds as $carModelId) {
                    // Avoid duplicates
                    $exists = $this->compatModel->where(['product_id' => $product['id'], 'car_model_id' => $carModelId])->first();
                    if (!$exists) {
                        $this->compatModel->insert(['product_id' => $product['id'], 'car_model_id' => $carModelId]);
                    }
                }
            }
            
            // Log stock in
            $stockInModel = model('App\\Models\\StockInModel');
            $stockInModel->insert([
                'product_id' => $product['id'],
                'quantity' => (int)$post['quantity'],
                'date_received' => date('Y-m-d H:i:s')
            ]);
            
            // Build success message
            $message = 'Stock updated for ' . $product['product_name'];
            if (!empty($post['category_option']) && $post['category_option'] === 'new') {
                $message .= '. New category "' . $post['new_category_name'] . '" created and assigned.';
            }
            
            return redirect()->to('/products/stock-in')->with('success', $message);
        } else {
            // New product - create it
            $rules = [
                'product_name' => 'required|min_length[3]',
                'price' => 'required|decimal',
                'product_type' => 'required',
                'quantity' => 'required|integer|greater_than[0]'
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            
            $productId = $this->productModel->insert([
                'product_name' => $post['product_name'],
                'category_id' => $categoryId,
                'product_type' => $post['product_type'],
                'sku' => $barcode,
                'price' => $post['price'],
                'quantity' => $post['quantity'],
            ]);
            
            // Handle car compatibility for new product
            if (!empty($carModelIds)) {
                foreach ($carModelIds as $carModelId) {
                    $this->compatModel->insert(['product_id' => $productId, 'car_model_id' => $carModelId]);
                }
            }
            
            // Log stock in
            $stockInModel = model('App\\Models\\StockInModel');
            $stockInModel->insert([
                'product_id' => $productId,
                'quantity' => (int)$post['quantity'],
                'date_received' => date('Y-m-d H:i:s')
            ]);
            
            // Build success message for new product
            $message = 'New product created and stock added';
            if (!empty($post['category_option']) && $post['category_option'] === 'new') {
                $message .= '. New category "' . $post['new_category_name'] . '" created and assigned.';
            }
            
            return redirect()->to('/products/stock-in')->with('success', $message);
        }
    }

    public function processStockOut()
    {
        $post = $this->request->getPost();
        $barcode = $post['barcode'] ?? null;
        $quantity = (int)($post['quantity'] ?? 0);
        
        if (!$barcode) {
            return redirect()->back()->with('error', 'Barcode is required');
        }
        
        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Quantity must be greater than 0');
        }
        
        $product = $this->productModel->where('sku', $barcode)
                                      ->orWhere('ean13', $barcode)
                                      ->first();
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found with this barcode');
        }
        
        if ($product['quantity'] < $quantity) {
            return redirect()->back()->with('error', 'Insufficient stock. Available: ' . $product['quantity']);
        }
        
        // Update product quantity
        $newQuantity = $product['quantity'] - $quantity;
        $this->productModel->update($product['id'], ['quantity' => $newQuantity]);
        
        // Log stock out
        $stockOutModel = model('App\\Models\\StockOutModel');
        $stockOutModel->insert([
            'product_id' => $product['id'],
            'quantity' => $quantity,
            'date_out' => date('Y-m-d H:i:s'),
            'reason' => $post['reason'] ?? 'Stock out via barcode scan'
        ]);
        
        return redirect()->to('/products/stock-out')->with('success', 'Stock removed for ' . $product['product_name'] . '. Remaining: ' . $newQuantity);
    }

    public function getProductByBarcode()
    {
        // Add CORS headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-Type: application/json');
        
        $barcode = $this->request->getGet('barcode');
        
        // Debug logging
        log_message('debug', 'getProductByBarcode called with barcode: ' . $barcode);
        
        if (!$barcode) {
            log_message('debug', 'No barcode provided');
            return $this->response->setJSON(['success' => false, 'message' => 'Barcode is required']);
        }
        
        try {
            $product = $this->productModel->select('products.*, categories.category_name')
                                           ->join('categories', 'categories.id = products.category_id', 'left')
                                           ->groupStart()
                                           ->where('products.sku', $barcode)
                                           ->orWhere('products.ean13', $barcode)
                                           ->groupEnd()
                                           ->first();
            
            log_message('debug', 'Product lookup result: ' . json_encode($product));
            
            if ($product) {
                // Get car compatibility for this product
                $compatibilities = $this->compatModel->select('car_models.*')
                                                    ->join('car_models', 'car_models.id = product_compatibility.car_model_id')
                                                    ->where('product_compatibility.product_id', $product['id'])
                                                    ->findAll();
                
                $product['compatibilities'] = $compatibilities;
                
                return $this->response->setJSON(['success' => true, 'product' => $product]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Product not found']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in getProductByBarcode: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Database error']);
        }
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
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
            'product_type' => $post['product_type'],
            'sku' => $post['sku'] ?? null,
            'price' => $post['price'],
            'quantity' => $post['quantity'] ?? 0,
        ]);

        // handle compatibility additions
        if (!empty($post['car_model_id'])) {
            foreach ((array)$post['car_model_id'] as $carModelId) {
                // avoid duplicates: use findBy combination
                $exists = $this->compatModel->where(['product_id' => $id, 'car_model_id' => $carModelId])->first();
                if (!$exists) {
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
