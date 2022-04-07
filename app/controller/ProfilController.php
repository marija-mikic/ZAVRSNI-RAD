<?php

class ProfilController extends AutorizacijaController
{
    private $viewDir = 
    'kupci' . DIRECTORY_SEPARATOR . 
        'profili' . DIRECTORY_SEPARATOR;

    public function __construct()
    {
        parent::__construct();
        $this->profil = new stdClass();         
        $this->profil->ime ='';
        $this->profil->prezime ='';
        $this->profil->adresa ='';
        
    }

    public function index()
    {
        $profili = Kupac::read();
        
        $this->view->render($this->viewDir . 'index',[
        'profili' => $profili,
        'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/jeloindex.css">'
       ]);
    }
}