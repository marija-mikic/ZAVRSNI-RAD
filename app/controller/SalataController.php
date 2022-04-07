<?php

class SalataController extends Controller

{

    private $viewDir=
        'privatno' . DIRECTORY_SEPARATOR . 
            'salate'. DIRECTORY_SEPARATOR ;

            public function __construct()
            {
                parent::__construct();
                $this->salata = new stdClass();
                $this->salata->naziv='';
                $this->salata->sastav='';
                $this->salata->cijena='';
                
            }
        
            public function index()
            {
                $salate = Salata::read();
                
                $this->view->render($this->viewDir . 'index',[
                'salate' => $salate,
                'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/piceindex.css">'
               ]);
            }
        }
