<?php
namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\CarModel as CarModelModel;


class CarModels extends BaseController
{
protected $carModel;


public function __construct()
{
$this->carModel = new CarModelModel();
}


public function index()
{
    $models = $this->carModel->findAll();
    
    $data = [
        'title' => 'Car Models',
        'breadcrumbs' => [
            'Home' => base_url(),
            'Car Models' => null
        ],
        'models' => $models
    ];
    
    return view('car_models/index', $data);
}


public function create()
{
    $data = [
        'title' => 'Add Car Model',
        'breadcrumbs' => [
            'Home' => base_url(),
            'Car Models' => base_url('car-models'),
            'Add Model' => null
        ]
    ];
    
    return view('car_models/form', $data);
}


public function store()
{
$post = $this->request->getPost();
$this->carModel->insert([
'brand' => $post['brand'],
'model' => $post['model'],
'year_start' => $post['year_start'],
'year_end' => $post['year_end'] ?: null,
]);
return redirect()->to('/car-models')->with('success','Car model added');
}


public function delete($id)
{
$this->carModel->delete($id);
return redirect()->to('/car-models')->with('success','Deleted');
}

}