<?php

namespace src;

class DataBaseConnection
{
    static private $instance = null;
    static private $connection;

    static public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DataBaseConnection();
        }

        return self::$instance;
    }

    private function __construct() {}
    private function __clone() {}
    // private function __wakeup() {}

    static public function connect($host, $dbName, $user, $pass)
    {
        self::$connection = new \PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
    }

    static public function getConnection()
    {
        return self::$connection;
    }


}