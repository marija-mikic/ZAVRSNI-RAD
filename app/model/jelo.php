<?php

class Jelo
{

    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from jelo where sifra=:parametar;
        
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
        
            select * from jelo
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            insert into jelo (naziv,sastav,cijena )
            values (:naziv,:sastav,:cijena);
        
        '); 
        $izraz->execute($parametri);
        
    }

    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            update jelo set 
                naziv=:naziv,
                sastav=:sastav,
                cijena=:cijena,
                where sifra=:sifra;
        
        '); 
        $izraz->execute($parametri);
        
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            delete from jelo where sifra=:sifra;
        
        '); 
        $izraz->execute(['sifra'=>$sifra]);

    }
}