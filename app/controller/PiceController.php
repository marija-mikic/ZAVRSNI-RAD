<?php

class PiceController extends AutorizacijaController

{

    private $viewDir=
        'privatno' . DIRECTORY_SEPARATOR . 
            'pica'. DIRECTORY_SEPARATOR ;

            public function __construct()
            {
                parent::__construct();
                $this->pice = new stdClass();
                $this->pice->naziv='';
                $this->pice->cijena='';
                
            }
        
            public function index()
            {
                $pica = Pice::read();
                
                $this->view->render($this->viewDir . 'index',[
                'pica' => $pica,
                'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/piceindex.css">'
               ]);
            }

            public function novi()
    {
        $this->view->render($this->viewDir . 'novi',[
            'poruka'=>'',
            'pice'=>$this->pice
        ]);
    }

    public function brisanje($sifra)
    {
        Pice::delete($sifra);
        //$this->index();
        header('location:' . App::config('url').'pice/index');
    }
} 