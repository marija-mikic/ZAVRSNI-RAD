<?php

class PizzaController extends JeloController
{

    private $viewDir=
        'privatno' . DIRECTORY_SEPARATOR . 
            'pizze'. DIRECTORY_SEPARATOR ;

            private $poruka;
            private $pizza;

            public function __construct()
            {
                parent::__construct();
                $this->pizza = new stdClass();
                $this->pizza->naziv='';
                $this->pizza->sastav='';
                $this->pizza->cijena='';
                
            }

    public function index()
            {
                $pizze = Pizza::read();
                
                $this->view->render($this->viewDir . 'index',[
                'pizze' => $pizze,
               ]);
            }
    
}