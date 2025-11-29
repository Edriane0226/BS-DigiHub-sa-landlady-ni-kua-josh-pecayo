<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\CarModel as CarModelModel;
use App\Models\StockInModel;
use App\Models\StockOutModel;
use App\Libraries\StockAlertService;

class Reports extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $carModel;
    protected $stockInModel;
    protected $stockOutModel;
    protected $stockAlertService;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->carModel = new CarModelModel();
        $this->stockInModel = new StockInModel();
        $this->stockOutModel = new StockOutModel();
        $this->stockAlertService = new StockAlertService();
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
        $products = $this->productModel->select('products.*, categories.category_name')
                                      ->join('categories', 'categories.id = products.category_id', 'left')
                                      ->findAll();

        // Get stock out data with reasons
        $stockOuts = $this->stockOutModel->select('reason, SUM(quantity) as total_quantity, COUNT(*) as transaction_count')
                                          ->groupBy('reason')
                                          ->findAll();

        // Calculate total sales and damage
        $totalSales = $this->stockOutModel->selectSum('quantity', 'total_quantity')
                                          ->where('reason !=', 'damage')
                                          ->first()['total_quantity'] ?? 0;
        
        $totalDamage = $this->stockOutModel->selectSum('quantity', 'total_quantity')
                                           ->where('reason', 'damage')
                                           ->first()['total_quantity'] ?? 0;
        
        $totalStockIn = $this->stockInModel->selectSum('quantity', 'total_quantity')
                                           ->first()['total_quantity'] ?? 0;

        // Calculate inventory statistics
        $stats = [
            'total_products' => count($products),
            'total_value' => array_sum(array_map(fn($p) => $p['price'] * $p['quantity'], $products)),
            'total_quantity' => array_sum(array_column($products, 'quantity')),
            'out_of_stock' => count(array_filter($products, fn($p) => $p['quantity'] == 0)),
            'low_stock' => count(array_filter($products, fn($p) => $p['quantity'] > 0 && $p['quantity'] <= 5)),
            'in_stock' => count(array_filter($products, fn($p) => $p['quantity'] > 5)),
            'total_sales' => $totalSales,
            'total_damage' => $totalDamage,
            'total_stock_in' => $totalStockIn
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
            'products' => $products,
            'stockOuts' => $stockOuts
        ];
        
        return view('reports/inventory', $data);
    }

    public function export($type = 'inventory')
    {
        helper('download');
        
        switch ($type) {
            case 'inventory':
                return $this->exportInventory();
            default:
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Export type not found');
        }
    }

    private function exportInventory()
    {
        $products = $this->productModel->select('products.*, categories.category_name')
                                      ->join('categories', 'categories.id = products.category_id', 'left')
                                      ->findAll();

        // Calculate overall statistics
        $totalValue = array_sum(array_map(fn($p) => $p['price'] * $p['quantity'], $products));
        $totalQuantity = array_sum(array_column($products, 'quantity'));
        
        $totalSales = $this->stockOutModel->selectSum('quantity', 'total_quantity')
                                          ->where('reason !=', 'damage')
                                          ->first()['total_quantity'] ?? 0;
        
        $totalDamage = $this->stockOutModel->selectSum('quantity', 'total_quantity')
                                           ->where('reason', 'damage')
                                           ->first()['total_quantity'] ?? 0;
        
        $totalStockIn = $this->stockInModel->selectSum('quantity', 'total_quantity')
                                           ->first()['total_quantity'] ?? 0;

        // Start CSV with overall summary
        $csv = "BS DIGIHUB - INVENTORY REPORT\n";
        $csv .= "Generated: " . date('Y-m-d H:i:s') . "\n\n";
        
        $csv .= "OVERALL SUMMARY\n";
        $csv .= "Total Products," . count($products) . "\n";
        $csv .= "Total Inventory Value,₱" . number_format($totalValue, 2) . "\n";
        $csv .= "Total Current Stock," . $totalQuantity . "\n";
        $csv .= "Total Stock In," . $totalStockIn . "\n";
        $csv .= "Total Sales (Stock Out)," . $totalSales . "\n";
        $csv .= "Total Damage/Loss," . $totalDamage . "\n\n";
        
        $csv .= "DETAILED PRODUCT INVENTORY\n";
        $csv .= "Product Name,EAN-13,Category,Type,Price,Current Stock,Total Value,Status\n";
        
        foreach ($products as $product) {
            $status = 'In Stock';
            if ($product['quantity'] == 0) {
                $status = 'Out of Stock';
            } elseif ($product['quantity'] <= 5) {
                $status = 'Low Stock';
            }
            
            $csv .= sprintf(
                '"%s","%s","%s","%s",₱%s,%s,₱%s,"%s"' . "\n",
                $product['product_name'],
                $product['ean13'],
                $product['category_name'] ?? 'Uncategorized',
                ucfirst($product['product_type']),
                number_format($product['price'], 2),
                $product['quantity'],
                number_format($product['price'] * $product['quantity'], 2),
                $status
            );
        }

        return $this->response->download('inventory_report_' . date('Y-m-d') . '.csv', $csv);
    }
    
    public function sendStockAlerts()
    {
        try {
            $result = $this->stockAlertService->checkAndSendAlerts();
            
            if (!empty($result['alerts_sent'])) {
                $message = 'Stock alerts sent successfully! ';
                $message .= 'Out of stock: ' . $result['out_of_stock_count'] . ', ';
                $message .= 'Low stock: ' . $result['low_stock_count'];
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => $message,
                    'data' => $result
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'No alerts needed or alerts already sent today',
                    'data' => $result
                ]);
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Manual stock alert failed: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to send stock alerts: ' . $e->getMessage()
            ]);
        }
    }
    
    public function getStockStats()
    {
        try {
            $stats = $this->stockAlertService->getStockStatistics();
            return $this->response->setJSON([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to get stock statistics'
            ]);
        }
    }
}