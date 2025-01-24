<?php
session_start();
require_once 'config/config.php';
require_once 'models/Event.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$eventController = new EventController();
$event = null;

if (isset($_GET['id'])) {
    $event = $eventController->getEventById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventData = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'date' => $_POST['date']
    ];
    
    $eventController->updateEvent($eventData);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Event</h2>
        <form action="../../edit_event.php?id=<?= $event['id'] ?>" method="POST">
            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($event['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($event['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Event</button>
            <a href="../../views/events/index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>