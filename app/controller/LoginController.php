<?php

class LoginController extends Controller
{
    public function index()
    {
        $this->loginView('Popunite email i lozinku','');
    }

    public function autoriziraj()
    {
        if(!isset($_POST['email']) || !isset($_POST['lozinka'])){
            $this->index();
            return; //short curcuiting
        }

        if(strlen(trim($_POST['email'])) === 0){
           $this->loginView('Email obavezno','');
           return;
        }

        if(strlen(trim($_POST['lozinka'])) === 0){
            $this->loginView('Lozinka obavezno', $_POST['email']);
            return;
         }

         $korisnik = Korisnik::autoriziraj($_POST['email'], $_POST['lozinka']);

        if($korisnik != null){
            $_SESSION['autoriziran'] = $korisnik;
            header('location: ' . App::config('url'));
        }
        else{
            $this->loginView('Neispravna kombinacija email i lozinka', $_POST['email']);
        }
    }

    public function odjava()
    {
        unset($_SESSION['autoriziran']);
        session_destroy();
        $this->loginView('Uspješno ste odjavljeni','');
    }

    private function loginView($poruka, $email)
    {
        $this->view->render('login', [
            'poruka' => $poruka,
            'email' => $email
        ]);
    }
}