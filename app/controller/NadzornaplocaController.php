<?php

class NadzornaplocaController extends AutorizacijaController
{
    private $viewDir = 'admin_panel' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }
}