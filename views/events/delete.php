<?php
session_start();
require_once 'config/config.php';
require_once 'models/Event.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $eventId = intval($_GET['id']);
    $event = new Event();

    if ($event->deleteEvent($eventId)) {
        $_SESSION['message'] = 'Event deleted successfully.';
    } else {
        $_SESSION['message'] = 'Failed to delete event.';
    }
    header('Location: index.php');
    exit();
} else {
    $_SESSION['message'] = 'Invalid event ID.';
    header('Location: index.php');
    exit();
}
?>