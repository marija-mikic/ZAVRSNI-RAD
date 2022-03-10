<?php

class JeloController extends AutorizacijaController

{

    private $viewDir=
        'privatno' . DIRECTORY_SEPARATOR . 
            'jela'. DIRECTORY_SEPARATOR ;

    public function index()

    {
       
       print_r(Jelo::read());
       $this->view->render($this->viewDir . 'index',[
        
       ]);
             
    }   
} 