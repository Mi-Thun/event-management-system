<?php
session_start();
class AuthController {
    private $userModel;

    public function __construct($db) {
        require_once '../models/User.php';
        $this->userModel = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);

            if ($this->userModel->register($username, $password, $email)) {
                header('Location: ../views/auth/login.php?success=1');
            } else {
                header('Location: ../views/auth/register.php?error=1');
            }
        } else {
            require '../views/auth/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if ($this->userModel->login($email, $password)) {
                $_SESSION['user'] = $email;
                header('Location: ../views/dashboard.php');
            } else {
                header('Location: ../views/auth/login.php?error=1');
            }
        } else {
            require '../views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../views/auth/login.php');
    }
}
require_once '../config/config.php'; 
$db = (new DatabaseConnection())->connect(); 
$controller = new AuthController($db);

// Handle the action parameter to call the appropriate method
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $controller = new AuthController(($db));

    switch ($action) {
        case 'register':
            $controller->register();
            break;
        case 'login':
            $controller->login();
            break;
        case 'logout':
            $controller->logout();
            break;
        default:
            // Handle unknown action
            header('Location: ../views/auth/login.php');
            break;
    }
}