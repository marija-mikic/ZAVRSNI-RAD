<?php
  class RegistracijaController extends Controller
  {
      public function index()
      {
          $this->regView('Popunite podatke','');
      }

      private function regView($poruka,$email)
    {
        $this->view->render('registracija',[
            'poruka'=>$poruka,
            'email'=>$email
        ]);
    }
}