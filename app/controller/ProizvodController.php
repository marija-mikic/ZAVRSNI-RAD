<?php

class ProizvodController extends Controller
{
    private $viewDir = DIRECTORY_SEPARATOR . 'proizvod' . DIRECTORY_SEPARATOR;
    private $poruka;
    private $proizvod;

    public function __construct()
    {
        parent::__construct();
        $this->proizvod = new stdClass();
        $this->proizvod->naziv = '';
        $this->proizvod->sastav = '';
        $this->proizvod->cijena = '';
    }

    public function index()
    {
        $proizvodi = Proizvod::read();

        $this->view->render($this->viewDir . 'index', [
            'proizvodi' => $proizvodi
        ]);
    }

    public function pizza()
    {
        $pizze = Proizvod::read();
        $this->view->render('dostupni_proizvodi' . DIRECTORY_SEPARATOR . 'pizza', [
            'poruka' => $this->poruka,
            'pizze' => $pizze
        ]);
    }

    public function rostilj()
    {
        $rostilj = Proizvod::read();
        $this->view->render('dostupni_proizvodi' . DIRECTORY_SEPARATOR . 'rostilj', [
            'poruka' => $this->poruka,
            'rostilj' => $rostilj
        ]);
    }

    public function pice()
    {
        $pica = Proizvod::read();
        $this->view->render('dostupni_proizvodi' . DIRECTORY_SEPARATOR . 'pice', [
            'poruka' => $this->poruka,
            'pica' => $pica
        ]);
    }

    public function salata()
    {
        $salate = Proizvod::read();
        $this->view->render('dostupni_proizvodi' . DIRECTORY_SEPARATOR . 'salata', [
            'poruka' => $this->poruka,
            'salate' => $salate
        ]);
    }

    public function novi()
    {
        $this->view->render($this->viewDir . 'novi', [
            'poruka' => '',
            'proizvod' => $this->proizvod
        ]);
    }


    public function dodajNovi()
    {
        Proizvod::create((array)$this->proizvod);
        header('location:' . App::config('url') . 'proizvod/index');
    }


    public function promjena($id)
    {
        $this->jelo = Proizvod::readOne($id);

        if ($this->jelo->cijena == 0) {
            $this->jelo->cijena = '';
        } else {
            $this->jelo->cijena = $this->nf->format($this->jelo->cijena);
        }

        $this->view->render($this->viewDir . 'promjena', [
            'poruka' => 'Promjenite podatke',
            'jelo' => $this->jelo
        ]);
    }

    public function promjeni()
    {
        if ($this->kontrolaNaziv()
            && $this->kontrolaCijena()) {
            Jelo::update((array)$this->jelo);
            //$this->index();
            header('location:' . App::config('url') . 'jelo/index');
        } else {
            $this->view->render($this->viewDir . 'promjena', [
                'poruka' => $this->poruka,
                'jelo' => $this->jelo
            ]);
        }
    }

    private function kontrolaNaziv()
    {
        if (strlen($this->jelo->naziv) === 0) {
            $this->poruka = 'Naziv obavezno';
            return false;
        }
        if (strlen($this->jelo->naziv) > 50) {
            $this->poruka = 'Naziv ne smije biti duži od 50 znakova';
            return false;
        }

        return true;
    }

    private function kontrolaCijena()
    {
        if (strlen(trim($this->jelo->cijena)) > 0) {


            $this->jelo->cijena = str_replace('.', '', $this->jelo->cijena);

            $this->jelo->cijena = (float)str_replace(',', '.', $this->jelo->cijena);
            //echo '<br />2: ' . $this->jelo->cijena;
            //1200.99
            if ($this->jelo->cijena <= 0) {
                $this->poruka = 'Ako unosite cijenu, mora biti decimalni broj veći od 0, unijeli ste: '
                    . $this->jelo->cijena;
                $this->jelo->cijena = '';
                return false;
            }
        }

        return true;
    }

    public function brisanje($sifra)
    {
        Jelo::delete($sifra);

        header('location:' . App::config('url') . 'jelo/index');
    }
}   