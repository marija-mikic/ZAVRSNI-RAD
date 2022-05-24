<?php

namespace Controller;

use storage\ProductStorage;
use Storage\ProductTypeStorage;

class ProductController extends BaseController
{
    private $viewDir = DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $products = ProductStorage::findAll();

        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . 'index', [
                'products' => $products
            ])
        ]);
    }

    public function pizza()
    {
        $pizza = ProductStorage::findAll();
        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . '/available/pizza', [
                'pizza' => $pizza
            ])
        ]);
    }

    public function barbecue()
    {
        $barbecue = ProductStorage::findAll();
        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . '/available/barbecue', [
                'barbecue' => $barbecue
            ])
        ]);
    }

    public function drink()
    {
        $drink = ProductStorage::findAll();
        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . '/available/drink', [
                'drink' => $drink
            ])
        ]);
    }

    public function salad()
    {
        $salad = ProductStorage::findAll();
        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . '/available/salad', [
                'salad' => $salad
            ])
        ]);
    }

    public function create()
    {
        $productTypes = ProductTypeStorage::findAll();
        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . 'create', [
                '$productTypes' => $productTypes
            ])
        ]);
    }

    public function createSubmit()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit_register'])) {

            }
        }
    }
}   