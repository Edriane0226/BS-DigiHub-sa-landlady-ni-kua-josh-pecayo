<?php

namespace App\Controllers;

use App\Models\CarModel as CarModelModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Welcome to BS DIGIHUB',
            'description' => 'Your trusted partner for automotive parts and accessories'
        ];
        
        return view('welcome_message', $data);
    }
    
    public function dashboard(): string
    {
        // Load models
        $carModelModel = new CarModelModel();
        $productModel = model('ProductModel', false);
        $supplierModel = model('SupplierModel', false);

        // Get statistics
        $stats = [
            'total_car_models' => $carModelModel->countAll(),
            'total_products' => $productModel ? $productModel->countAll() : 0,
            'total_suppliers' => $supplierModel ? $supplierModel->countAll() : 0,
            'low_stock_items' => $productModel ? $productModel->where('quantity <=', 5)->where('quantity >', 0)->countAllResults() : 0
        ];
        
        // Get recent data
        $recent_car_models = $carModelModel->orderBy('id', 'DESC')->findAll(5);
        $recent_products = $productModel ? $productModel->orderBy('id', 'DESC')->findAll(5) : [];
        
        $data = [
            'title' => 'Dashboard',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Dashboard' => null
            ],
            'stats' => $stats,
            'recent_car_models' => $recent_car_models,
            'recent_products' => $recent_products
        ];
        
        return view('dashboard', $data);
    }
}
