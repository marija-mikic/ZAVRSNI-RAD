<?php

class App 
{
    public static function start()
    {
        $ruta=Request::getRuta();

        $djelovi=explode('/',$ruta);

        $klasa='';
        if(isset($djelovi[1])|| $djelovi[1]===''){
            $klasa='Index';
        }else{
            $klasa=ucfirst($djelovi[1]);
        }
        $klasa .= 'Controller';
    
    $metoda ='';
    if(!isser($djelovi[2])|| $djelovi[2]===''){
        $metoda='Index';
    }else{
        $metoda=$djelovi[2];
    }

    if (class_exists($klasa) && method_exists($klasa,$metoda)){
        $instanca=new $klasa();
        $instanca->$metoda ();
    }else {
        $view = new View();
        $view->render ('eror404',[
            'onoceganema' =>$klasa . '->' . $metoda
        ]);
    }
} 

public static function config($kljuc)
{
    $config= include BP_APP . 'konfiguracija.php';
    return $config[$kljuc];
}
}