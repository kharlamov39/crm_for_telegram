<?php 
// app/models/Database.php

class Database{
    private static $instance = null;

    private $connect;
    

    private function __construct() {
        // $this->connect - объект подключения к базе данных
        $config = require_once "config.php";
        $db_host = $config['db_host'];
        $db_user = $config['db_user'];
        $db_password = $config['db_password'];
        $db_name = $config['db_name'];

        try {
            $dsn = "mysql:host=$db_host; dbname=$db_name";
            $this->connect = new PDO($dsn, $db_user, $db_password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $err) {
            echo "Error " . $err;
        }
    }

    // Возвращает объект класса Database
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Возвращает объект подключения к БД
    public function getConnection() {
        return $this->connect;
    }
}

?>