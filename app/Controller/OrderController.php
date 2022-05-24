<?php

namespace Controller;

use Storage\OrderStorage;

class OrderController extends BaseController
{
    private $viewDir = 'order' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $orders = OrderStorage::findAll();

        echo $this->view->render('base', [
            'content' => $this->view->render($this->viewDir . 'index', [
                'orders' => $orders
            ])
        ]);
    }
}