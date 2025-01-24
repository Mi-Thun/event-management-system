<?php
$host = 'localhost';
$dbname = 'event_management_system';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection setup done";
} catch (PDOException $e) {
    echo "connection setup failed";
    die("Database connection failed: " . $e->getMessage());
}

define('BASE_URL', 'http://localhost/event-management-system/');
define('EVENTS_PER_PAGE', 10);
?>