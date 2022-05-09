<?php
class Plata
{

    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select b.sifra, b.naziv,b.sastav,b.cijena,b.slika
        from vrsta a
        inner join jelo b on a.sifra = b.vrsta 
        where b.vrsta = 3
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }
}