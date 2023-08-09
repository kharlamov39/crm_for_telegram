<?php
require_once "app/models/User.php"; 

class UsersController {
    public function index() {
        $userModel = new User();
        $users = $userModel->readAll();

        include "app/views/users/index.php";
    }

    public function create() {
        include "app/views/users/create.php";
    }

    public function store() {
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            if($password !== $confirm_password) {
                echo 'Пароли не совпадают';
                return;
            } 

            $userModel = new User();
            $data = [
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'email' => $_POST['email'],
                'role' => 1
            ];
            $userModel->create($data);
        }
        header('Location: index.php?page=users');
    }

    public function delete() {
        $usermodel = new User();
        $usermodel->delete($_GET['id']);

        header('Location: index.php?page=users');
    }

    public function edit() {
        $usermodel = new User();
        $user = $usermodel->read($_GET['id']);

        include "app/views/users/edit.php";
    }

    public function update() {
        $usermodel = new User();
        $usermodel->update($_GET['id'], $_POST);
        
        header('Location: index.php?page=users');
    }
}