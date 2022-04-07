<?php

   class PovijestController extends AutorizacijaController
{
    private $viewDir = 
                'kupci' . DIRECTORY_SEPARATOR . 
                     'povijest' . DIRECTORY_SEPARATOR ;
                         


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

    public function index()
    {
        $narudzbe = Povijest::read();
        
        $this->view->render($this->viewDir . 'index',[
        'narudzbe' => $narudzbe,
        'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/jeloindex.css">'
       ]);
    }
    }
