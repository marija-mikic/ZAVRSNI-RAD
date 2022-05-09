<?php

class NarudzbaController extends AutorizacijaController
{
    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'narudzbe' . DIRECTORY_SEPARATOR ;
                     

    public function index()
    {
        $narudzbe=Narudzba::read();
        
        $this->view->render($this->viewDir . 'index',[
        'narudzbe' => $narudzbe,
        'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/pizzeindex.css">'
        ]);
    }

    public function __construct()
    {
        parent::__construct();
        $this->narudzba = new stdClass();
        $this->narudzba->sifra='';
        $this->narudzba->adresa='';
        $this->narudzba->datum='';
        $this->narudzba->ukupno='';
        
    }
}