<?php
session_start();
require_once 'config/config.php';
require_once 'controllers/ReportController.php';

$reportController = new ReportController();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$attendeeList = $reportController->getAttendeeList();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Attendee Reports</h2>
        <a href="logout.php" class="btn btn-secondary mb-3">Logout</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Attendee Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendeeList as $attendee): ?>
                    <tr>
                        <td><?= htmlspecialchars($attendee['event_name']) ?></td>
                        <td><?= htmlspecialchars($attendee['name']) ?></td>
                        <td><?= htmlspecialchars($attendee['email']) ?></td>
                        <td><?= htmlspecialchars($attendee['registration_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="download_report.php" class="btn btn-primary">Download CSV</a>
    </div>
</body>
</html>