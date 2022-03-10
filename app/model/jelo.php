<?php

class Jelo
{
    // CRUD

    //R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from jelo;
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }
}