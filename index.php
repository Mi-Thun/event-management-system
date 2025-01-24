<?php
require_once 'config/config.php';
require_once 'Router.php';

$router = new Router();

$router->add('/event-management-system/', function() {
    require_once 'controllers/EventController.php';
    $db = (new DatabaseConnection())->connect();
    $controller = new EventController($db);
    $controller->index();
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

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $_GET);
// print_r($url);
$router->dispatch($url);
?>