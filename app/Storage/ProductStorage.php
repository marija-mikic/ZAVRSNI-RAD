<?php

namespace Storage;

use Core\Database;

class ProductStorage
{
    public static function findAll()
    {
        $db = Database::getInstance();

        $statement = $db->prepare('

            SELECT * FROM product

        ');
        $statement->execute();
        return $statement->fetchAll();
    }
//
//
//    public static function findOneById($id)
//    {
//        $db = Database::getInstanca();
//        $statement = $db->prepare('
//
//            SELECT * FROM product WHERE id = :id;
//
//        ');
//
//        $statement->execute(
//            ['id' => $id]
//        );
//        return $statement->fetchObject();
//    }

//    public static function create($parametri)
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//            insert into product (naziv, sastav, cijena)
//            values (:naziv,:sastav,:cijena);
//
//        ');
//        $izraz->execute($parametri);
//
//    }
//
//    public static function update($parametri)
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//            update jelo set
//                naziv=:naziv,
//                sastav=:sastav,
//                cijena=:cijena,
//                where sifra=:sifra;
//
//        ');
//        $izraz->execute($parametri);
//
//    }
//
//    public static function delete($sifra)
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//            delete from jelo where sifra=:sifra;
//
//        ');
//        $izraz->execute(['sifra' => $sifra]);
//
//    }
}