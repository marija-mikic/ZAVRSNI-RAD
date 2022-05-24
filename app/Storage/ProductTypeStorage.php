<?php

namespace Storage;

use Core\Database;
use PDO;

class ProductTypeStorage
{
    public static function findAll()
    {
        $db = Database::getInstance();

        $statement = $db->prepare('

            SELECT * FROM product_type

        ');

        $statement->execute();
        return $statement->fetchAll();
    }
}