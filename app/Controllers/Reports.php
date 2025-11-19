<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\SupplierModel;
use App\Models\CategoryModel;
use App\Models\CarModel as CarModelModel;

class Reports extends BaseController
{
    protected $productModel;
    protected $supplierModel;
    protected $categoryModel;
    protected $carModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->supplierModel = new SupplierModel();
        $this->categoryModel = new CategoryModel();
        $this->carModel = new CarModelModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Reports & Analytics',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Reports' => null
            ]
        ];
        
        return view('reports/index', $data);
    }

    public function inventory()
    {
        // Get inventory data
        $products = $this->productModel->select('products.*, categories.category_name, suppliers.supplier_name')
                                      ->join('categories', 'categories.id = products.category_id', 'left')
                                      ->join('suppliers', 'suppliers.id = products.supplier_id', 'left')
                                      ->findAll();

        // Calculate inventory statistics
        $stats = [
            'total_products' => count($products),
            'total_value' => array_sum(array_map(fn($p) => $p['price'] * $p['quantity'], $products)),
            'total_quantity' => array_sum(array_column($products, 'quantity')),
            'out_of_stock' => count(array_filter($products, fn($p) => $p['quantity'] == 0)),
            'low_stock' => count(array_filter($products, fn($p) => $p['quantity'] > 0 && $p['quantity'] <= 5)),
            'in_stock' => count(array_filter($products, fn($p) => $p['quantity'] > 5))
        ];

        // Category breakdown
        $categoryStats = [];
        foreach ($products as $product) {
            $category = $product['category_name'] ?? 'Uncategorized';
            if (!isset($categoryStats[$category])) {
                $categoryStats[$category] = [
                    'count' => 0,
                    'value' => 0,
                    'quantity' => 0
                ];
            }
            $categoryStats[$category]['count']++;
            $categoryStats[$category]['value'] += $product['price'] * $product['quantity'];
            $categoryStats[$category]['quantity'] += $product['quantity'];
        }

        // Top products by value
        usort($products, fn($a, $b) => ($b['price'] * $b['quantity']) <=> ($a['price'] * $a['quantity']));
        $topProducts = array_slice($products, 0, 10);

        $data = [
            'title' => 'Inventory Report',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Reports' => base_url('reports'),
                'Inventory Report' => null
            ],
            'stats' => $stats,
            'categoryStats' => $categoryStats,
            'topProducts' => $topProducts,
            'products' => $products
        ];
        
        return view('reports/inventory', $data);
    }

    public function suppliers()
    {
        // Get supplier data with product counts
        $suppliers = $this->supplierModel->findAll();
        
        foreach ($suppliers as &$supplier) {
            $supplierProducts = $this->productModel->where('supplier_id', $supplier['id'])->findAll();
            $supplier['product_count'] = count($supplierProducts);
            $supplier['total_value'] = array_sum(array_map(fn($p) => $p['price'] * $p['quantity'], $supplierProducts));
            $supplier['total_quantity'] = array_sum(array_column($supplierProducts, 'quantity'));
        }

        // Sort by total value
        usort($suppliers, fn($a, $b) => $b['total_value'] <=> $a['total_value']);

        $stats = [
            'total_suppliers' => count($suppliers),
            'active_suppliers' => count(array_filter($suppliers, fn($s) => $s['product_count'] > 0)),
            'inactive_suppliers' => count(array_filter($suppliers, fn($s) => $s['product_count'] == 0)),
            'total_supplier_value' => array_sum(array_column($suppliers, 'total_value'))
        ];

        $data = [
            'title' => 'Suppliers Report',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Reports' => base_url('reports'),
                'Suppliers Report' => null
            ],
            'stats' => $stats,
            'suppliers' => $suppliers
        ];
        
        return view('reports/suppliers', $data);
    }

    public function compatibility()
    {
        // Get car models with product counts
        $carModels = $this->carModel->findAll();
        $compatModel = model('ProductCompatibilityModel');
        
        foreach ($carModels as &$model) {
            $compatibilities = $compatModel->where('car_model_id', $model['id'])->findAll();
            $model['product_count'] = count($compatibilities);
        }

        // Sort by product count
        usort($carModels, fn($a, $b) => $b['product_count'] <=> $a['product_count']);

        $stats = [
            'total_car_models' => count($carModels),
            'models_with_products' => count(array_filter($carModels, fn($m) => $m['product_count'] > 0)),
            'models_without_products' => count(array_filter($carModels, fn($m) => $m['product_count'] == 0)),
            'total_compatibilities' => array_sum(array_column($carModels, 'product_count'))
        ];

        $data = [
            'title' => 'Compatibility Report',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Reports' => base_url('reports'),
                'Compatibility Report' => null
            ],
            'stats' => $stats,
            'carModels' => $carModels
        ];
        
        return view('reports/compatibility', $data);
    }

    public function export($type = 'inventory')
    {
        helper('download');
        
        switch ($type) {
            case 'inventory':
                return $this->exportInventory();
            case 'suppliers':
                return $this->exportSuppliers();
            case 'compatibility':
                return $this->exportCompatibility();
            default:
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Export type not found');
        }
    }

    private function exportInventory()
    {
        $products = $this->productModel->select('products.*, categories.category_name, suppliers.supplier_name')
                                      ->join('categories', 'categories.id = products.category_id', 'left')
                                      ->join('suppliers', 'suppliers.id = products.supplier_id', 'left')
                                      ->findAll();

        $csv = "Product Name,SKU,Category,Supplier,Type,Price,Quantity,Total Value\n";
        
        foreach ($products as $product) {
            $csv .= sprintf(
                '"%s","%s","%s","%s","%s",%s,%s,%s' . "\n",
                $product['product_name'],
                $product['sku'],
                $product['category_name'] ?? 'N/A',
                $product['supplier_name'] ?? 'N/A',
                $product['product_type'],
                $product['price'],
                $product['quantity'],
                $product['price'] * $product['quantity']
            );
        }

        return $this->response->download('inventory_report_' . date('Y-m-d') . '.csv', $csv);
    }

    private function exportSuppliers()
    {
        $suppliers = $this->supplierModel->findAll();
        
        $csv = "Supplier Name,Contact Person,Phone,Email,Address,Product Count\n";
        
        foreach ($suppliers as $supplier) {
            $productCount = $this->productModel->where('supplier_id', $supplier['id'])->countAllResults();
            $csv .= sprintf(
                '"%s","%s","%s","%s","%s",%s' . "\n",
                $supplier['supplier_name'],
                $supplier['contact_person'],
                $supplier['phone'],
                $supplier['email'],
                str_replace(["\r", "\n"], ' ', $supplier['address']),
                $productCount
            );
        }

        return $this->response->download('suppliers_report_' . date('Y-m-d') . '.csv', $csv);
    }

    private function exportCompatibility()
    {
        $carModels = $this->carModel->findAll();
        $compatModel = model('ProductCompatibilityModel');
        
        $csv = "Car Brand,Car Model,Year Range,Compatible Products\n";
        
        foreach ($carModels as $model) {
            $productCount = $compatModel->where('car_model_id', $model['id'])->countAllResults();
            $csv .= sprintf(
                '"%s","%s","%s-%s",%s' . "\n",
                $model['brand'],
                $model['model'],
                $model['year_start'],
                $model['year_end'] ?: 'Present',
                $productCount
            );
        }

        return $this->response->download('compatibility_report_' . date('Y-m-d') . '.csv', $csv);
    }
}