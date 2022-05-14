<?php 

class Korisnik
{
    public static function autoriziraj($email, $lozinka)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('

            select * from korisnik where email=:email;
        
        ');
        $izraz->execute([
            'email' => $email
        ]);

        $korisnik = $izraz->fetch();
        if($korisnik === null){
            return null;
        }
        if(!password_verify($lozinka, $korisnik->lozinka)){
            return null;
        }
        unset($korisnik->lozinka);
        return $korisnik;
    }

    public static function readOne($id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
    
            select * from korisnik where id=:id
        
        ');
        $izraz->execute(['id' => $id]);
        return  $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                select * from korisnik where sifra = :sifra
        
        ');
        $izraz->execute([
            'sifra' => $sifra
        ]);
        return $izraz->fetch();
    }

    public static function insert($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                insert into korisnik (ime, prezime, adresa, telefon, email, lozinka, role)
                values (:ime, :prezime, :adresa, :telefon, :email, :lozinka, :role)

        ');
        $izraz->execute([
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'adresa'=>$parametri['adresa'],
            'telefon'=>$parametri['telefon'],
            'email'=>$parametri['email'],
            'lozinka'=>$parametri['lozinka'],
            'role'=>'["ROLE_KUPAC"]'
            ]);
    } 
    
    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                
        update korisnik set 
        ime=:ime,
        prezime=:prezime,
        adresa=:adresa,
        telefon=:telefon,
        email=:email,
        lozinka=:lozinka,
        where sifra=:sifra
        ');
        
        $izraz->execute([
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'adresa'=>$parametri['adresa'],
            'telefon'=>$parametri['telefon'],
            'email'=>$parametri['email'],
            'lozinka'=>$parametri['lozinka'],
            'sifra'=>$parametri['sifra'],
        ]);
    }  
    public function provjeriEmail($email) {
    
        $this->veza->izraz('SELECT * FROM korisnik WHERE email = :email');

     
        $this->veza->getInstanca(':email', $email);

        //PROVJERA DALI SE EMAIL VEĆ KORISTI
        if($this->veza->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}