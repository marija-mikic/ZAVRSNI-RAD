<?php

namespace Storage;

class CartStorage
{
//    public static function read()
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//            select * from jelo
//
//        ');
//        $izraz->execute();
//        return $izraz->fetchAll();
//    }
//
//    public static function viewNarudzba($id) // provjera dali user ima već kreiranu započetu narudzbu
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//		select sifra
//		from order
//		where user = :kupacId;
//
//        ');
//        $izraz->execute([
//            'kupacId' => $id
//        ]);
//
//        return $izraz->rowCount();
//    }
//
//    public static function kreiraj($id) // u koliko nema, kreira se nova order
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//            insert into order (user,naruceno) values
//            (:kupacId,false)
//
//        ');
//        $izraz->execute([
//            'kupacId' => $id
//        ]);
//
//    }
//
//    public static function dodaj($proizvod, $narudzbaId, $kolicina)
//    {
//        $veza = Database::getInstanca();
//
//        $izraz = $veza->prepare('
//
//            select a.kolicina
//			from narudzba_jelo a
//			inner join order b on a.order = b.sifra
//			where a.jelo=:jelo and b.sifra=:narudzbaId;
//
//        ');
//        $izraz->execute([
//            'product' => $proizvod,
//            'narudzbaId' => $narudzbaId
//        ]);
//
//
//        $akopostoji = $izraz->fetchColumn();
//
//        if($akopostoji == 0){
//            $izraz = $veza->prepare('
//
//            insert into order (order, product, cijena, kolicina, datum) values
//            (:narudzbaId, :product, (select cijena from product where id = :product), 1, now())
//
//            ');
//            return $izraz->execute([
//                'product' => $proizvod,
//                'narudzbaId' => $narudzbaId
//            ]);
//        }else{
//            $izraz = $veza->prepare('
//
//            update order a
//            inner join order as b on a.order=b.id
//            set a.quantity = a.quantity+1
//            where product= :product and b.id= :narudzbaId
//
//            ');
//            return $izraz->execute([
//                'product' => $proizvod,
//                'narudzbaId' => $narudzbaId
//            ]);
//        }
//
//    }
//
//    public static function dohvatiNarudzbu($id)
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//		select a.sifra ,b.cijena,b.kolicina,a.proizvodi,a.ukupno
//		from order a
//		inner join narudzba_jelo b on a.sifra = b.order
//		inner join jelo c on b.jelo = c.sifra
//		where a.naruceno = false;
//
//        ');
//        $izraz->execute([
//            'kupacId' => $id
//        ]);
//
//        return $izraz->fetchAll();
//    }
//
//    public static function ukloniizKosarice($proizvod, $narudzbaId)
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//            delete from narudzba_jelo
//            where product = :product and order = :narudzbaId
//
//        ');
//        return $izraz->execute([
//            'product' => $proizvod,
//            'narudzbaId' => $narudzbaId
//        ]);
//
//
//    }
//
//    public static function brojProizvoda($id)
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//            select count(*) as number
//            from order a
//            inner join narudzba_jelo b on a.id=b.order
//            where a.naruceno = false  and a.user = :kupacId
//
//        ');
//        $izraz->execute([
//            'kupacId' => $id
//        ]);
//
//        return $izraz->fetchColumn();
//    }
//
//    public static function ukupno($id)
//    {
//        $veza = Database::getInstanca();
//        $izraz = $veza->prepare('
//
//
//            select sum(b.cijena*b.kolicina) as number
//            from order a
//            inner join narudzba_jelo b on a.id=b.order
//            where a.naruceno = false and a.user = :kupacId
//
//        ');
//        $izraz->execute([
//            'kupacId' => $id
//        ]);
//
//        return $izraz->fetchColumn();
//    }
}