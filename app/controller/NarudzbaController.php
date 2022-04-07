<?php

class NarudzbaController extends AutorizacijaController
{
    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'narudzbe' . DIRECTORY_SEPARATOR ;
                     

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }

    public function __construct()
    {
        parent::__construct();
        $this->narudzba = new stdClass();
        $this->narudzba->sifra='';
        $this->narudzba->proizvodi='';
        $this->narudzba->adresa='';
        $this->narudzba->datum='';
        $this->narudzba->ukupno='';
        
    }

    


    
}