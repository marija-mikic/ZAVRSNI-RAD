<?php
class Pizza
{

    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select b.naziv,b.sastav,b.cijena,b.slika
        from vrsta a
        inner join jelo b on a.sifra = b.vrsta 
        where b.vrsta =4;
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }
}