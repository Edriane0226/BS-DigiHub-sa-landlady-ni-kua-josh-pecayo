<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SupplierModel;
use App\Models\ProductModel;

class Suppliers extends BaseController
{
    protected $supplierModel;
    protected $productModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $suppliers = $this->supplierModel->findAll();
        
        // Get product counts for each supplier
        foreach ($suppliers as &$supplier) {
            $supplier['product_count'] = $this->productModel->where('supplier_id', $supplier['id'])->countAllResults();
        }
        
        $data = [
            'title' => 'Suppliers',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Suppliers' => null
            ],
            'suppliers' => $suppliers
        ];
        
        return view('suppliers/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Supplier',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Suppliers' => base_url('suppliers'),
                'Add Supplier' => null
            ]
        ];
        
        return view('suppliers/form', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'supplier_name' => 'required|min_length[3]|max_length[100]',
            'contact_person' => 'required|min_length[3]|max_length[100]',
            'phone' => 'required|min_length[10]|max_length[20]',
            'email' => 'required|valid_email|max_length[100]',
            'address' => 'required|min_length[10]|max_length[255]'
        ]);

        $post = $this->request->getPost();
        
        if (!$validation->run($post)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->supplierModel->insert([
            'supplier_name' => $post['supplier_name'],
            'contact_person' => $post['contact_person'],
            'phone' => $post['phone'],
            'email' => $post['email'],
            'address' => $post['address']
        ]);

        return redirect()->to('/suppliers')->with('success', 'Supplier added successfully');
    }

    public function edit($id)
    {
        $supplier = $this->supplierModel->find($id);
        if (!$supplier) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Supplier not found');
        }

        // Get products from this supplier
        $products = $this->productModel->where('supplier_id', $id)->findAll();
        
        $data = [
            'title' => 'Edit Supplier',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Suppliers' => base_url('suppliers'),
                'Edit Supplier' => null
            ],
            'supplier' => $supplier,
            'products' => $products
        ];
        
        return view('suppliers/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'supplier_name' => 'required|min_length[3]|max_length[100]',
            'contact_person' => 'required|min_length[3]|max_length[100]',
            'phone' => 'required|min_length[10]|max_length[20]',
            'email' => 'required|valid_email|max_length[100]',
            'address' => 'required|min_length[10]|max_length[255]'
        ]);

        $post = $this->request->getPost();
        
        if (!$validation->run($post)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->supplierModel->update($id, [
            'supplier_name' => $post['supplier_name'],
            'contact_person' => $post['contact_person'],
            'phone' => $post['phone'],
            'email' => $post['email'],
            'address' => $post['address']
        ]);

        return redirect()->to('/suppliers')->with('success', 'Supplier updated successfully');
    }

    public function delete($id)
    {
        $supplier = $this->supplierModel->find($id);
        if (!$supplier) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Supplier not found');
        }

        // Check if supplier has products
        $productCount = $this->productModel->where('supplier_id', $id)->countAllResults();
        if ($productCount > 0) {
            return redirect()->to('/suppliers')->with('error', 'Cannot delete supplier with existing products. Please reassign or remove products first.');
        }

        $this->supplierModel->delete($id);
        return redirect()->to('/suppliers')->with('success', 'Supplier deleted successfully');
    }

    public function view($id)
    {
        $supplier = $this->supplierModel->find($id);
        if (!$supplier) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Supplier not found');
        }

        // Get products from this supplier with categories
        $products = $this->productModel->select('products.*, categories.category_name')
                                      ->join('categories', 'categories.id = products.category_id', 'left')
                                      ->where('products.supplier_id', $id)
                                      ->findAll();
        
        $data = [
            'title' => 'Supplier Details',
            'breadcrumbs' => [
                'Home' => base_url(),
                'Suppliers' => base_url('suppliers'),
                'Supplier Details' => null
            ],
            'supplier' => $supplier,
            'products' => $products
        ];
        
        return view('suppliers/view', $data);
    }
}