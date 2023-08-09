<?php 

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        try{
            $result = $this->db->query("SELECT 1 FROM users LIMIT 1");
        } catch(PDOException $err) {
            $this->createTable();
        }
    }

    public function createTable() {

        $roleTableQuery = "CREATE TABLE IF NOT EXISTS roles(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `role_name` VARCHAR(255) NOT NULL,
            `role_description` TEXT
        )";

        $userTableQuery = "CREATE TABLE IF NOT EXISTS users (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
            `password` VARCHAR(255) NOT NULL,
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
            `role` INT(11) NOT NULL DEFAULT 0,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` TIMESTAMP NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`role`) REFERENCES `roles`(`id`)
            )";

        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);
            return true;
        }catch(PDOException $err) {
            return false;
        } 
    }

    public function readAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM `users` ");
            $users = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }

            return $users;
        } catch(PDOException $err) {
            return false;
        }
    }

    public function create($data) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO `users` (username, email, password, role, created_at) VALUES(?, ?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $password, $role, $created_at]);
            return true;
        } catch(PDOException $err) {
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM `users` WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch(PDOException $err) {
            return false;    
        }
        
    }


    public function read($id) {
        $query = "SELECT * FROM `users` WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch(PDOException $err) {
            return false;    
        }
    }

    public function update($id, $data) {
        $username = $data['username'];
        $is_admin = !empty($data['is_admin']) && $data['is_admin'] !== 0 ? 1 : 0;
        
        $query = "UPDATE `users` SET username = ?, is_admin = ? WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $is_admin, $id]);
            return true;
        } catch(PDOException $err) {
            return false;    
        }
        
    }
}