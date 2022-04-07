<?php

class Povijest
{
    public static function readOne($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
                select *
                from narudzba
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
                from narudzba
        
        ');
        $izraz->execute();
        return  $izraz->fetchAll();
    }

    
}