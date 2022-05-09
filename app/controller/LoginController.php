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

        if(strlen(trim($_POST['email']))===0){
           $this->loginView('Email obavezno','');
           return;
        }

        if(strlen(trim($_POST['lozinka']))===0){
            $this->loginView('Lozinka obavezno',$_POST['email']);
            return;
         }

         // 100% sam siguran da je korisnik unio email i lozinku
         $operater = Operater::autoriziraj($_POST['email'],$_POST['lozinka']);
         $kupac = Kupac::autoriziraj($_POST['email'],$_POST['lozinka']);
     
        // else{
        //    $this->loginView('Neispravna kombinacija email i lozinka',$_POST['email']);
            //return;
        // }
        
        //print_r($operater);
        print_r($kupac);

        if($operater != null){
            $_SESSION['autoriziran']=$operater;
        }
        else if($kupac != null){
            $_SESSION['autoriziran']=$kupac;
        }
        else{
            $this->loginView('Neispravna kombinacija email i lozinka',$_POST['email']);
            return;
        }

         
         $np = new NadzornaplocaController();
         $np->index();

          
        // if(isset($_SESSION['autoriziran']->uloga) && ($_SESSION['autoriziran']->uloga == 'admin')){
        //     include_once 'app/view/privatno/Nadzornaploca.phtml';
        // }else{
        //     include_once 'app/view/privatno/Kosarica.phtml';
         //}
        

         
    }

    public function odjava()
    {
        unset($_SESSION['autoriziran']);
        session_destroy();
        $this->loginView('Uspješno ste odjavljeni','');
    }

    private function loginView($poruka,$email)
    {
        $this->view->render('login',[
            'poruka'=>$poruka,
            'email'=>$email
        ]);
    }
}