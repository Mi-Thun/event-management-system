<?php
session_start();
class AuthController {
    private $userModel;

    public function __construct($db) {
        require_once __DIR__ . '/../models/User.php';
        $this->userModel = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);

            if ($this->userModel->register($username, $password, $email)) {
                header('Location: /event-management-system/login');
                exit();
            } else {
                header('Location: /event-management-system/');
                exit();
            }
        } else {
            require __DIR__ . '/../views/auth/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if ($this->userModel->login($email, $password)) {
                $_SESSION['user'] = $email;
                header('Location: /event-management-system/');
                exit();
            } else {
                header('Location: /event-management-system/?action=login&error=1');
                exit();
            }
        } else {
            require __DIR__ . '/../views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        require __DIR__ . '/../views/auth/login.php';
        exit();
    }
}
?>