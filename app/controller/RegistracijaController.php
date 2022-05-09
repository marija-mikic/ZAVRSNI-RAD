 
<?php

class RegistracijaController extends Controller
{
    private $kupac;
    private $poruka;


    public function __construct()
    {
        parent::__construct();
        
        $this->kupac = new stdClass();
        $this->kupac->sifra = null;
        $this->kupac->ime = '';
        $this->kupac->prezime = '';
        $this->kupac->adresa = '';
        $this->kupac->telefon = '';
        $this->kupac->email = '';
        $this->kupac->lozinka = '';
        $this->kupac->potvrdi_lozinku = '';
        

        $this->poruka = new stdClass();
        $this->poruka->sifra = null;
        $this->poruka->ime = '';
        $this->poruka->prezime = '';
        $this->poruka->adresa = '';
        $this->poruka->telefon = '';
        $this->poruka->email = '';
        $this->poruka->lozinka = '';
        $this->poruka->potvrdi_lozinku = '';
    }

    public function index()
    {
        $this->view->render('registracija', [
            'kupac'=>$this->kupac,
            'poruka'=>$this->poruka
        ]);
    }

    public function noviKupac()
    {
        var_dump($_POST['ime']);
        $this->kupac = (object) $_POST;

            if($this->provjeriIme() &&  // provjera ispravnosti unosa 
            $this->provjeriPrezime() &&
            $this->provjeriAdresa() &&
            $this->provjeriTelefon() &&
            $this->provjeriEmail() &&          
            $this->provjeriLozinka() &&     
            $this->osigurajLozinku()
            ){
        
            Kupac::insert((array)$this->kupac); // ako su parametri ispravni unesi novog kupca 

             $kupac = Registracija::readOne($this->kupac->email);
            $_SESSION['autoriziraj'] = $kupac;

            
            header('location: ' . App::config('url')); // te ga prosljedi na glavnu stranicu
                
        }else{
            $this->index();
            return;
        }
    }

    public function detalji($id)
    {
        $this->kupac = Registracija::readOne($id);
        $this->view->render('privatno/narudba/index', [
            'kupac'=>$this->kupac,
            'poruka'=>$this->poruka
        ]);
    }

    public function update()
    {
        $this->kupac = (object) $_POST;
        // print_r($this->customer);
        // Validators
        Kupac::update((array)$this->kupac);
        header('location:' . App::config('url').'narudzba/index');

    }

    //PROVJERA METODA ZA UNOS NOVIH PODATAKA
    private function provjeriIme()
    {
        if(strlen(trim($this->kupac->ime)) === 0){
            $this->poruka->ime = 'Ime je obavezno.';
            return false;
        }
        if(strlen(trim($this->kupac->ime)) > 50){
            $this->poruka->ime = 'Ime ne smije imati vise od 50 znakova.';
            return false;
        }
        return true;
    }

    private function provjeriPrezime()
    {
        if(strlen(trim($this->kupac->prezime)) === 0){
            $this->poruka->prezime = 'Prezime je obavezno.';
            return false;
        }
        if(strlen(trim($this->kupac->prezime)) > 50){
            $this->poruka->prezime = 'Prezime ne smije imati vise od 50 znakova.';
            return false;
        }
        return true;
    }

    private function provjeriEmail()
    {
        if(filter_var($this->kupac->email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }else{
            $this->poruka->email = 'Email nije validan.';
            return false;
        };
            //Check if email exists.
            if($this->kupac->email->rowCount() < 0) {
                return true;
            } else {
                $this->poruka->email = 'email već postoji.';
                return false;
            
        };
        
    }

    private function provjeriLozinka()
    {
        if(strlen(trim($this->kupac->lozinka)) < 6){
            $this->poruka->lozinka = 'Lozinka mora imati najmanje 6 znaka';
            return false;
        }
        if($this->kupac->lozinka !== $this->kupac->potvrdi_lozinku){
            $this->kupac->potvrdi_lozinku = '';
            $this->poruka->potvrdi_lozinku = 'Lozinke se ne podudaraju. Unesite ponovno.';
            return false;
        }
        return true;
    }

    private function provjeriTelefon()
    {
        if(strlen(trim($this->kupac->telefon)) > 15){
            $this->poruka->telefon = 'Telefonski broj ne moze imati vise od 15 znakova.';
            return false;
        }
        return true;
    }

    

    private function provjeriAdresa()
    {
        if(strlen(trim($this->kupac->adresa)) > 50){
            $this->poruka->adresa = 'Adresa ne moze imati vise od 50 znakova.';
            return false;
        }
        return true;
    }

    
    // HASHIRANJE LOZINKE
    private function osigurajLozinku()
    {
        $this->kupac->lozinka = password_hash($this->kupac->lozinka, PASSWORD_BCRYPT);    
        return true;

    }
}
