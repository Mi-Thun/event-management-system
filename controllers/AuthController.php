<?php

class AuthController {
    private $userModel;

    public function __construct() {
        require_once '../models/User.php';
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);

            if ($this->userModel->register($username, $password, $email)) {
                header('Location: login.php?success=1');
            } else {
                header('Location: register.php?error=1');
            }
        } else {
            require '../views/auth/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if ($this->userModel->login($username, $password)) {
                session_start();
                $_SESSION['user'] = $username;
                header('Location: dashboard.php');
            } else {
                header('Location: login.php?error=1');
            }
        } else {
            require '../views/auth/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
    }
}