<?php

if($_SERVER['SERVER_ADDR']==='127.0.0.1'){
    $url='http://edunovaapp.xyz/';
    $dev=true;
    $baza=[
        'server'=>'localhost',
        'baza'=>'edunovapp24',
        'korisnik'=>'edunova',
        'lozinka'=>'edunova'
    ];
}else{
    $url='https://mamik-dj.shop/';
    $dev=false;
    $baza=[
        'server'=>'localhost',
        'baza'=>'zavrsni',
        'korisnik'=>'marija',
        'lozinka'=>'xC5VCU&Kt=:3}8Af'
    ];
}

return [
    'dev'=>$dev,
    'url'=>$url,
    'naslovApp'=>'PIZZERIJA',
    'baza'=>$baza
];