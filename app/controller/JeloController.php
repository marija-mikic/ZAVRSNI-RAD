<?php


class JeloController extends AutorizacijaController
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'jela' . DIRECTORY_SEPARATOR;
    private $nf;
    private $poruka;
    private $jelo;

    public function __construct()
    {
        parent::__construct();
        $this->nf = new \NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        $this->nf->setPattern('#,##0.00 kn');
        $this->jelo = new stdClass();
        $this->jelo->naziv='';
        $this->jelo->sastav='';
        $this->jelo->cijena='';
        
    }

    public function index()
    {
        $jela = Jelo::read();
        
        $this->view->render($this->viewDir . 'index',[
        'jela' => $jela,
        'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/jeloindex.css">'
       ]);
    }
    }   