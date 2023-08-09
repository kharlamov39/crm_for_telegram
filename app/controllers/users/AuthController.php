<?php
require_once "app/models/AuthUser.php";

class AuthController {
    public function register() {
        include "app/views/users/register.php";
    }

    public function store() {
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            if($password !== $confirm_password) {
                echo 'Пароли не совпадают';
                return;
            } 

            $authUserModel = new AuthUser();
            
            $authUserModel->register($_POST['username'], $_POST['email'], $_POST['password']);
        }
        header('Location: index.php?page=login');
    }

    
    public function login() {
        include "app/views/users/login.php";
    }

    
    public function authentificate() {
        $authUserModel = new AuthUser();

        if(isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $authUserModel->findByEmail($email);

            if($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php');
            } else {
                echo "Invalid email or password";
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
    
}