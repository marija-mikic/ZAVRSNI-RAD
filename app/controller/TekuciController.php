<?php

class TekuciController extends PiceController

{

    private $viewDir=
        'privatno' . DIRECTORY_SEPARATOR . 
            'tekucine'. DIRECTORY_SEPARATOR ;

            public function __construct()
            {
                parent::__construct();
                $this->tekuci = new stdClass();
                $this->tekuci->naziv='';
                $this->tekuci->cijena='';
                
            }
        
            public function index()
            {
                $tekucine = Tekuci::read();
                
                $this->view->render($this->viewDir . 'index',[
                'tekucine' => $tekucine,
                'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/piceindex.css">'
               ]);
            }

            
} 