<?php


class JeloController extends Controller
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
        $this->jelo = new stdClass();
        $this->nf = new \NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        $this->nf->setPattern('#,##0.00 kn');
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

    public function novi()
    {
        $this->view->render($this->viewDir . 'novi',[
            'poruka'=>'',
            'jelo'=>$this->jelo
        ]);
    }



    public function dodajNovi()
    {

        if($this->kontrolaNaziv()
         && $this->kontrolaCijena()){
            Jelo::create((array)$this->jelo);
            //$this->index();
            header('location:' . App::config('url').'jelo/index');
        }else{
            $this->view->render($this->viewDir.'novi',[
                'poruka'=>$this->poruka,
                'jelo'=>$this->jelo
            ]);
        }
       
    }

    private function kontrolaNaziv()
    {
        if(strlen($this->jelo->naziv)===0){
            $this->poruka='Naziv obavezno';
            return false;
        }
        if(strlen($this->jelo->naziv)>50){
            $this->poruka='Naziv ne smije biti duži od 50 znakova';
            return false;
        }

        return true;
    }

    private function kontrolaCijena()
    {
        if(strlen(trim($this->jelo->cijena))>0){

           // 1.200.99 kn
           // if(strpos($this->smjer->cijena,'kn')>=0){
           //     $this->smjer->cijena = trim(str_replace('kn','',$this->smjer->cijena));
           // }
            // 1.200,99
            $this->jelo->cijena = str_replace('.','',$this->jelo->cijena);
            //echo '1: ' . $this->smjer->cijena;
            //1200,99
            $this->jelo->cijena = (float)str_replace(',','.',$this->jelo->cijena);
            //echo '<br />2: ' . $this->smjer->cijena;
            //1200.99
            if($this->jelo->cijena<=0){
                $this->poruka='Ako unosite cijenu, mora biti decimalni broj veći od 0, unijeli ste: ' 
            . $this->jelo->cijena;
            $this->jelo->cijena='';
            return false;
            }
        }

        return true;
    }


    public function promjena($id)
    {
        $this->jelo = Jelo::readOne($id);

        if($this->jelo->cijena==0){
            $this->jelo->cijena='';
        }else{
            $this->jelo->cijena=$this->nf->format($this->jelo->cijena);
        }

        $this->view->render($this->viewDir . 'promjena',[
            'poruka'=>'Promjenite podatke',
            'jelo'=>$this->jelo
        ]);
    }

    public function promjeni()
    {
        if($this->kontrolaNaziv()
        && $this->kontrolaCijena()){
            Jelo::update((array)$this->jelo);
            //$this->index();
            header('location:' . App::config('url').'jelo/index');
        }else{
            $this->view->render($this->viewDir.'promjena',[
                'poruka'=>$this->poruka,
                'jelo'=>$this->jelo
            ]);
        }
    }

    public function brisanje($sifra)
    {
        Jelo::delete($sifra);
        //$this->index();
        header('location:' . App::config('url').'jelo/index');
    }
}   