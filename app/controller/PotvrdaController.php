<?php

class PotvrdaController extends AutorizacijaController
{
    private $viewDir = 
    'privatno' . DIRECTORY_SEPARATOR . 
        'potvrda' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }
}
