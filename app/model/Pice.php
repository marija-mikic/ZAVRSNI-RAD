<?php

class Pice
{

    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from pice where sifra=:parametar;
        
        '); 
        $izraz->execute(['parametar'=>$kljuc]);
        return $izraz->fetch();
    }
    // CRUD



    //R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from pice
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            insert into pice (naziv,cijena )
            values (:naziv,:cijena);
        
        '); 
        $izraz->execute($parametri);
        
    }

    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            update pice set 
                naziv=:naziv,
                cijena=:cijena,
                where sifra=:sifra;
        
        '); 
        $izraz->execute($parametri);
        
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            delete from pice where sifra=:sifra;
        
        '); 
        $izraz->execute(['sifra'=>$sifra]);

    }
}