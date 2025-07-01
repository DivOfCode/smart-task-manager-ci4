<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller
{
    protected $helpers = ['url', 'form'];

    public function __construct()
    {
        helper(['form', 'url']);
    }

    protected function loadView($view, $data = [])
    {
        echo view('layouts/header', $data);
        echo view($view, $data);
        echo view('layouts/footer');
    }
}

