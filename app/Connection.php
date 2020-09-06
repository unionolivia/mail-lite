<?php

declare(strict_types = 1);

namespace App;

use \PDO;

class Connection{
    // Holds the class instance
    private static $instance = null;
    private static $dsn = 'mysql:host=localhost;dbname=subs';
    private static $username = 'root';
    private static $password = '12345678';

    private function __construct(){
        try{
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
        }
        catch(PDOException $e){
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance(){
        if(!self::$instance){
            new Connection;
        }
        return self::$instance;
    }
}