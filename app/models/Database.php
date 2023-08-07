<?php 
// app/models/Database.php

class Database{
    private static $instance = null;

    private $connect;
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'root';
    private $dbname = 'crm_for_telegram';

    private function __construct() {
        // $this->connect - объект подключения к базе данных
        $this->connect = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if($this->connect->connect_error) {
            die("Connect failed: " . $this->connect->connect_error);
        }
    }

    // Возвращает объект класса Database
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Возвращает объект подключения к БД
    public function getConnection() {
        return $this->connect;
    }
}

?>