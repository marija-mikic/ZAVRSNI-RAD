<?php


class PiceController extends Controller
{

    private $viewDir = 
                'privatno' . DIRECTORY_SEPARATOR . 
                    'pica' . DIRECTORY_SEPARATOR;
    private $nf;
    private $poruka;
    private $pice;

    public function __construct()
    {
        parent::__construct();
        $this->pice = new stdClass();
        $this->nf = new \NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        $this->nf->setPattern('#,##0.00 kn');
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



    public function dodajNovi()
    {
            Pice::create((array)$this->pice);
             header('location:' . App::config('url').'pice/index');
        
    }

    


    public function promjena($id)
    {
        $this->pice = Pice::readOne($id);

        if($this->pice->cijena==0){
            $this->pice->cijena='';
        }else{
            $this->pice->cijena=$this->nf->format($this->pice->cijena);
        }

        $this->view->render($this->viewDir . 'promjena',[
            'poruka'=>'Promjenite podatke',
            'pice'=>$this->pice
        ]);
    }

    public function promjeni()
    {
        if($this->kontrolaNaziv()
        && $this->kontrolaCijena()){
            pice::update((array)$this->pice);
            //$this->index();
            header('location:' . App::config('url').'pice/index');
        }else{
            $this->view->render($this->viewDir.'promjena',[
                'poruka'=>$this->poruka,
                'pice'=>$this->pice
            ]);
        }
    }
    private function kontrolaNaziv()
    {
        if(strlen($this->pice->naziv)===0){
            $this->poruka='Naziv obavezno';
            return false;
        }
        if(strlen($this->pice->naziv)>50){
            $this->poruka='Naziv ne smije biti duži od 50 znakova';
            return false;
        }

        return true;
    }

    private function kontrolaCijena()
    {
        if(strlen(trim($this->pice->cijena))>0){

            
            $this->pice->cijena = str_replace('.','',$this->pice->cijena);
             
            $this->pice->cijena = (float)str_replace(',','.',$this->pice->cijena);
            //echo '<br />2: ' . $this->pice->cijena;
            //1200.99
            if($this->pice->cijena<=0){
                $this->poruka='Ako unosite cijenu, mora biti decimalni broj veći od 0, unijeli ste: ' 
            . $this->pice->cijena;
            $this->pice->cijena='';
            return false;
            }
        }

        return true;
    }

    public function brisanje($sifra)
    {
        Pice::delete($sifra);
   
        header('location:' . App::config('url').'pice/index');
    }
}   