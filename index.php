<?php
require_once 'config/config.php';
require_once 'Router.php';

$router = new Router();

$router->add('/event-management-system/attendee', function() {
    require_once 'controllers/EventController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new EventController($db);
    $controller->registerAttendee();
});

$router->add('/event-management-system/events/create', function() {
    require_once 'controllers/EventController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new EventController($db);
    $controller->create();
});

$router->add('/event-management-system/events/edit', function() {
    require_once 'controllers/EventController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new EventController($db);
    $controller->edit($_GET['id']);
});

$router->add('/event-management-system/events/delete', function() {
    require_once 'controllers/EventController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new EventController($db);
    $controller->delete($_GET['id']);
});

$router->add('/event-management-system/login', function() {
    require_once 'controllers/AuthController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new AuthController($db);
    $controller->login();
});

$router->add('/event-management-system/register', function() {
    require_once 'controllers/AuthController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new AuthController($db);
    $controller->register();
});

$router->add('/event-management-system/logout', function() {
    require_once 'controllers/AuthController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new AuthController($db);
    $controller->logout();
});

$router->add('/event-management-system/', function() {
    require_once 'controllers/EventController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new EventController($db);
    $controller->index();
});

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $_GET);
print_r($url);
$router->dispatch($url);
?>