<?php
class Kosarica {

	public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from jelo
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }

	public static function viewNarudzba($id) // provjera dali kupac ima već kreiranu započetu narudzbu   
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('

		select sifra, kupac 
		from narudzba 
		where naruceno = 0;
            
        ');
        $izraz->execute([
            'kupacId' => $id
        ]);

        return $izraz->fetch();
    }

	public static function kreiraj($id) // u koliko nema, kreira se nova narudzba
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
            insert into narudzba (kupac,naruceno) values
            (:kupacId,false)
            
        ');
        $izraz->execute([
            'kupacId' => $id
        ]);

    }

	public static function dodaj($proizvod, $narudzbaId, $kolicina)
    {
        $veza = DB::getInstanca();

        $izraz = $veza->prepare('

            select a.kolicina 
			from narudzba_jelo a
			inner join narudzba b on a.narudzba = b.sifra 
			where a.jelo=:jelo and b.sifra=:narudzbaId;
            
        ');
        $izraz->execute([
            'proizvod' => $proizvod,
            'narudzbaId' => $narudzbaId
        ]);

    
        $akopostoji = $izraz->fetchColumn();

        if($akopostoji == 0){
            $izraz = $veza->prepare('

            insert into narudzba (narudzba, proizvod, cijena, kolicina, datum) values
            (:narudzbaId, :proizvod, (select cijena from proizvod where id = :proizvod), 1, now())
            
            ');
            return $izraz->execute([
                'proizvod' => $proizvod,
                'narudzbaId' => $narudzbaId
            ]);
        }else{
            $izraz = $veza->prepare('

            update narudzba a
            inner join narudzba as b on a.narudzba=b.id
            set a.quantity = a.quantity+1
            where proizvod= :proizvod and b.id= :narudzbaId
            
            ');
            return $izraz->execute([
                'proizvod' => $proizvod,
                'narudzbaId' => $narudzbaId
            ]);
        }
   
    }

	public static function dohvatiNarudzbu($id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('

		select a.sifra ,b.cijena,b.kolicina,a.proizvodi,a.ukupno  
		from narudzba a
		inner join narudzba_jelo b on a.sifra = b.narudzba 
		inner join jelo c on b.jelo = c.sifra 
		where a.naruceno = false;
            
        ');
        $izraz->execute([
            'kupacId' => $id
        ]);

        return $izraz->fetchAll();
    }

	public static function ukloniizKosarice($proizvod, $narudzbaId)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
            delete from narudzba_jelo 
            where proizvod = :proizvod and narudzba = :narudzbaId
            
        ');
        return $izraz->execute([
            'proizvod' => $proizvod,
            'narudzbaId' => $narudzbaId
        ]);

       
    }

	public static function brojProizvoda($id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('

            select count(*) as number
            from narudzba a
            inner join narudzba_jelo b on a.id=b.narudzba 
            where a.naruceno = false  and a.kupac = :kupacId
            
        ');
        $izraz->execute([
            'kupacId' => $id
        ]);

        return $izraz->fetchColumn();
	}

	public static function ukupno($id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('


            select sum(b.cijena*b.kolicina) as number
            from narudzba a
            inner join narudzba_jelo b on a.id=b.narudzba
            where a.naruceno = false and a.kupac = :kupacId
            
        ');
        $izraz->execute([
            'kupacId' => $id
        ]);

        return $izraz->fetchColumn();
    }
}




