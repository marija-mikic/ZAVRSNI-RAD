<?php

class PlataController extends Controller

{

    private $viewDir=
        'privatno' . DIRECTORY_SEPARATOR . 
            'plate'. DIRECTORY_SEPARATOR ;

            public function __construct()
            {
                parent::__construct();
                $this->plata = new stdClass();
                $this->plata->sifra='';
                $this->plata->naziv='';
                $this->plata->slika='';
                $this->plata->sastav='';
                $this->plata->cijena='';
                
            }
        
            public function index()
            {
                $plate = Plata::read();
                
                $this->view->render($this->viewDir . 'index',[
                'plate' => $plate,
                'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/piceindex.css">'
               ]);
            }

            
} 