<?php 

class Kupac
{
    public static function autoriziraj($email,$lozinka)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select * from kupac where email=:email;
        
        ');
        $izraz->execute(['email'=>$email]);
        $kupac = $izraz->fetch();
        if($kupac==null){
            return null;
        }
        if(!password_verify($lozinka,$kupac->lozinka)){
            return null;
        }
        unset($kupac->lozinka);
        return $kupac;
    }




    public static function readOne($id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                select *
                from kupac
                where id=:id
        
        ');
        $izraz->execute(['id' => $sifra]);
        return  $izraz->fetchAll();
    }

    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                select *
                from kupac
        
        ');
        $izraz->execute();
        return  $izraz->fetch();
    }

    public static function insert($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                insert into kupac (ime, prezime, adresa, telefon, email, lozinka)
                values (:ime, :prezime, :adresa, :telefon, :email, :lozinka)
        
        ');
        $izraz->execute([
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'adresa'=>$parametri['adresa'],
            'telefon'=>$parametri['telefon'],
            'email'=>$parametri['email'],
            'lozinka'=>$parametri['lozinka'],
            ]);
    } 
    
    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                
        update kupac set 
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
    
        $this->veza->izraz('SELECT * FROM kupac WHERE email = :email');

     
        $this->veza->getInstanca(':email', $email);

        //PROVJERA DALI SE EMAIL VEĆ KORISTI
        if($this->veza->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}