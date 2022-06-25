<?php

namespace Core;

class Request
{
    public static function getRoute()
    {
        $route = '/';

        if (isset($_SERVER['REDIRECT_PATH_INFO'])) {   //sadržaj puta -rute u url
            $route = $_SERVER['REDIRECT_PATH_INFO'];

        } else if (isset($_SERVER['REQUEST_URI'])) {
            $route = $_SERVER ['REQUEST_URI'];
        }
        return $route;
    }
}