<?php
class LoginController extends Controller
{
    public function index()
        {
            $this-loginView ('popunite email i lozinku', '');
        }
    public function autoriziraj()
    {
        if (!isset($_POST['email']) || !isset($_POST['lozinka']) ){
            $this->index();
            return;
        }
        if (strlen(trim($_POST['email']))===0){
            $this->loginWiew('email obavezno','');
            return;
        }
        if(strlen(trim($_POST ['lozinka']))===0){
            $this->loginView('lozinka obavezno',$_POST['email']);
            return;
        }
    }
    private function loginView($poruka,$email)
    {
        $this->view->render ('login',[
            'poruka'=>$poruka,
            'email'=>$email
        ]);
    }
    
}