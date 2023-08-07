<?php 

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function readAll() {
        $result = $this->db->query("SELECT * FROM users");

        $users = [];

        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function create($data) {
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $is_admin = isset($data['is_admin']) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');

        $stmt = $this->db->prepare("INSERT INTO users (login, password, is_admin, created_at) VALUES(?, ?, ?, ?)");
        $stmt->bind_param('ssis', $login, $password, $is_admin, $created_at);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}