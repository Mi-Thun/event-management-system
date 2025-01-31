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

            if (empty($username) || empty($password) || empty($email)) {
                $errorMessage = "All fields are required.";
                require __DIR__ . '/../views/auth/register.php';
                exit();
            }

            if ($this->userModel->register($username, $password, $email)) {
                header('Location: /event-management-system/login');
                exit();
            } else {
                $errorMessage = "Registration failed. Please try again.";
                require __DIR__ . '/../views/auth/register.php';
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
            
            if (empty($email) || empty($password)) {
                $errorMessage = "Email and password cannot be empty.";
                require __DIR__ . '/../views/auth/login.php';
                exit();
            }
            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $user['username'];

                header('Location: /event-management-system/');
                exit();
            } else {
                $errorMessage = "Invalid email or password.";
                require __DIR__ . '/../views/auth/login.php';
                exit();
            }
        } else {
            require __DIR__ . '/../views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /event-management-system/login');
        exit();
    }
}
?>