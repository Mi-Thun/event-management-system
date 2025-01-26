<?php
require_once 'config/config.php';
require_once 'Router.php';

$router = new Router();

function handleRequest($controllerName, $methodName, $id = null) {
    require_once "controllers/{$controllerName}.php";
    $db = (new DatabaseConnection())->connect();
    $controller = new $controllerName($db);
    if ($id !== null) {
        $controller->$methodName($id);
    } else {
        $controller->$methodName();
    }
}

$router->add('/event-management-system/attendee', function() {
    handleRequest('EventController', 'registerAttendee');
});

$router->add('/event-management-system/events/create', function() {
    handleRequest('EventController', 'create');
});

$router->add('/event-management-system/events/edit', function() {
    handleRequest('EventController', 'edit', $_GET['id']);
});

$router->add('/event-management-system/events/delete', function() {
    handleRequest('EventController', 'delete', $_GET['id']);
});

$router->add('/event-management-system/login', function() {
    handleRequest('AuthController', 'login');
});

$router->add('/event-management-system/register', function() {
    handleRequest('AuthController', 'register');
});

$router->add('/event-management-system/logout', function() {
    handleRequest('AuthController', 'logout');
});

$router->add('/event-management-system/', function() {
    handleRequest('EventController', 'index');
});

$router->add('/event-management-system/download_report', function() {
    handleRequest('EventController', 'downloadReport', $_GET['id']);
});

// Redirect to the desired route when index.php is accessed
// if (basename($_SERVER['PHP_SELF']) == 'index.php') {
//     handleRequest('EventController', 'index');
// }

if ($_SERVER['REQUEST_URI'] == '/event-management-system/index.php') {
    header('Location: /event-management-system/');
    exit();
}

$router->add('/event-management-system/events/view', function() {
    handleRequest('EventController', 'viewEvent', $_GET['id']);
});

$router->add('/event-management-system/search', function() {
    handleRequest('EventController', 'search');
});

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $_GET);
$router->dispatch($url);
?>
