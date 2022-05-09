<?php
class Narudzba
{

    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select a.sifra,a.datum,a.ukupno,a.kupac,a.naruceno,a.adresa,CONCAT_WS("",b.cijena, c.cijena) as cijena, CONCAT_WS("",b.kolicina, c.kolicina) as kolicina,
        CONCAT_WS("",e.sifra, d.sifra) as sifra, CONCAT_WS("",e.naziv, d.naziv) as naziv, CONCAT_WS(" ",f.ime,f.prezime) as kupac
        from narudzba a
        left join narudzba_jelo b on a.sifra = b.narudzba
        left join narudzba_pice c on a.sifra = c.narudzba
        left join jelo d on b.jelo = d.sifra
        left join pice e on c.pice = e.sifra
        left join kupac f on a.kupac = f.sifra
        where a.naruceno = 1;
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }
}