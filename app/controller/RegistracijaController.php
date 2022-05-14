 
<?php

class RegistracijaController extends Controller
{
    private $korisnik;
    private $poruka;

    public function __construct()
    {
        parent::__construct();
        
        $this->korisnik = new stdClass();
        $this->korisnik->sifra = null;
        $this->korisnik->ime = '';
        $this->korisnik->prezime = '';
        $this->korisnik->adresa = '';
        $this->korisnik->telefon = '';
        $this->korisnik->email = '';
        $this->korisnik->lozinka = '';
        $this->korisnik->potvrdi_lozinku = '';
        

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
            'korisnik' => $this->korisnik,
            'poruka' => $this->poruka
        ]);
    }

    public function noviKorisnik()
    {
        $this->korisnik = (object) $_POST;

        if (
            $this->provjeriIme() &&
            $this->provjeriPrezime() &&
            $this->provjeriAdresa() &&
            $this->provjeriTelefon() &&
            $this->provjeriEmail() &&
            $this->provjeriLozinka() &&
            $this->osigurajLozinku()
        ) {
            Korisnik::insert((array)$this->korisnik);
            $korisnik = $this->readOne($this->korisnik->email);
            $_SESSION['autoriziraj'] = $korisnik;

            header('location: ' . App::config('url'));
        }else{
            $this->index();
        }
    }

    public function detalji($id)
    {
        $this->korisnik = Registracija::readOne($id);
        $this->view->render('privatno/narudba/index', [
            'korisnik'=>$this->korisnik,
            'poruka'=>$this->poruka
        ]);
    }

    public function update()
    {
        $this->korisnik = (object) $_POST;
        Korisnik::update((array)$this->korisnik);
        header('location:' . App::config('url').'narudzba/index');

    }

    //PROVJERA METODA ZA UNOS NOVIH PODATAKA
    private function provjeriIme()
    {
        if(strlen(trim($this->korisnik->ime)) === 0){
            $this->poruka->ime = 'Ime je obavezno.';
            return false;
        }
        if(strlen(trim($this->korisnik->ime)) > 50){
            $this->poruka->ime = 'Ime ne smije imati vise od 50 znakova.';
            return false;
        }
        return true;
    }

    private function provjeriPrezime()
    {
        if(strlen(trim($this->korisnik->prezime)) === 0){
            $this->poruka->prezime = 'Prezime je obavezno.';
            return false;
        }
        if(strlen(trim($this->korisnik->prezime)) > 50){
            $this->poruka->prezime = 'Prezime ne smije imati vise od 50 znakova.';
            return false;
        }
        return true;
    }

    private function provjeriEmail()
    {
        if(filter_var($this->korisnik->email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }else{
            $this->poruka->email = 'Email nije validan.';
            return false;
        };
            //Check if email exists.
            if($this->korisnik->email->rowCount() < 0) {
                return true;
            } else {
                $this->poruka->email = 'email već postoji.';
                return false;
            
        };
        
    }

    private function provjeriLozinka()
    {
        if(strlen(trim($this->korisnik->lozinka)) < 6){
            $this->poruka->lozinka = 'Lozinka mora imati najmanje 6 znaka';
            return false;
        }
        if($this->korisnik->lozinka !== $this->korisnik->potvrdi_lozinku){
            $this->korisnik->potvrdi_lozinku = '';
            $this->poruka->potvrdi_lozinku = 'Lozinke se ne podudaraju. Unesite ponovno.';
            return false;
        }
        return true;
    }

    private function provjeriTelefon()
    {
        if(strlen(trim($this->korisnik->telefon)) > 15){
            $this->poruka->telefon = 'Telefonski broj ne moze imati vise od 15 znakova.';
            return false;
        }
        return true;
    }

    

    private function provjeriAdresa()
    {
        if(strlen(trim($this->korisnik->adresa)) > 50){
            $this->poruka->adresa = 'Adresa ne moze imati vise od 50 znakova.';
            return false;
        }
        return true;
    }

    
    // HASHIRANJE LOZINKE
    private function osigurajLozinku()
    {
        $this->korisnik->lozinka = password_hash($this->korisnik->lozinka, PASSWORD_BCRYPT);    
        return true;
    }

    private function readOne($email)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                select * from korisnik where email=:email
        
        ');
        $izraz->execute([
            'email'=>$email
        ]);

        $kupac = $izraz->fetch();
        unset($kupac->lozinka);
        return $kupac;
    }
}
