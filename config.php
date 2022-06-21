<?php

if ($_SERVER['SERVER_ADDR'] === '127.0.0.1') {
    $url = '//edunovaapp.xyz/';
    $dev = true;
    $database = [
        'server' => 'localhost',
        'database' => 'edunovapp24',
        'user' => 'root',
        'password' => ''
    ];
} else {
    $url = 'https://mamik-dj.shop/';
    $dev = false;
    $database = [
        'server' => 'localhost',
        'database' => 'zavrsni',
        'user' => 'marija',
        'password' => 'xC5VCU&Kt=:3}8Af
        '
    ];
}

return [
    'dev' => $dev,
    'url' => $url,
    'appTitle' => 'Pizzeria',
    'database' => $database
];
