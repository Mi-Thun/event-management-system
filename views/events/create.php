<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /event-management-system/login');
        exit;
    }
    ?>
    <div class="container">
        <h2>Create New Event</h2>
        <form action="/event-management-system/events/create" method="POST">
            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="max_capacity">Max Capacity</label>
                <input type="number" class="form-control" id="max_capacity" name="max_capacity" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Event</button>
            <a href="/event-management-system/" class="btn btn-secondary btn-block">Cancel</a>
        </form>
    </div>
</body>
</html>