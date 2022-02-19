<?php
class DB extends PASSWORD_DEFAULT{
    private static $instanca=null;
    public static function getInstanca()
    {
        if (self::$instanca==null){
            self ::$instanca =new self();
        }
        return self::$instanca;
    }
}