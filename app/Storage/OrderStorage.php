<?php

namespace Storage;

use Core\Database;

class OrderStorage
{
    public static function findAll()
    {
        $db = Database::getInstance();
        $statement = $db->prepare('

        select a.sifra,a.datum,a.ukupno,a.user,a.naruceno,a.adresa,CONCAT_WS("",b.cijena, c.cijena) as cijena, CONCAT_WS("",b.kolicina, c.kolicina) as kolicina,
        CONCAT_WS("",e.sifra, d.sifra) as sifra, CONCAT_WS("",e.naziv, d.naziv) as naziv, CONCAT_WS(" ",f.ime,f.prezime) as user
        from order a
        left join narudzba_jelo b on a.sifra = b.order
        left join narudzba_pice c on a.sifra = c.order
        left join jelo d on b.jelo = d.sifra
        left join pice e on c.pice = e.sifra
        left join user f on a.user = f.sifra
        where a.naruceno = 1;

        ');
        $statement->execute();
        return $statement->fetchAll();
    }
}