<?php

class ProfilController extends AutorizacijaController
{
    private $viewDir = 'korisnik'.DIRECTORY_SEPARATOR;

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
        $profil = Korisnik::read($_SESSION['autoriziran']->sifra);

        $this->view->render($this->viewDir . 'profil', [
            'profil' => $profil
       ]);
    }
}