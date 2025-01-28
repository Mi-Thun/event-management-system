<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Event Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin-top: 8px;
        }
        .table {
            margin-top: 1px;
        }
        .btn {
            margin-right: 5px;
            margin-bottom: 1px;
        }
        .pagination {
            margin-top: 2px;
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
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Event Details</h2>
            <div class="text-right">
                <a href="/event-management-system/logout" class="btn btn-secondary">Logout</a>
            </div>
        </div>
        <div class="event-details">
            <h4><?= htmlspecialchars($event['name']) ?></h4>
            <p><?= htmlspecialchars($event['description']) ?></p>
            <div style="display: flex; justify-content: space-between;">
                <p><strong>Date: </strong> <?= htmlspecialchars($event['date']) ?></p>
                <p><strong>Max Capacity: </strong> <?= htmlspecialchars($event['max_capacity']) ?></p>
                <p><strong>Remain Seat: </strong>20</p>
                <p><strong>Registered Seat: </strong>20</p>
                <p><strong>Location: </strong>Dhaka</p>
            </div>
        </div>
        <h3>Attendees</h3>
        <input type="text" id="searchQuery" class="form-control" placeholder="Search attendees" style="margin-top: 20px; margin-bottom: 20px;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Seat Book</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody id="attendeeList">
                <?php if (!empty($attendees)): ?>
                    <?php foreach ($attendees as $attendee): ?>
                        <tr>
                            <td><?= htmlspecialchars($attendee['username']) ?></td>
                            <td><?= htmlspecialchars($attendee['email']) ?></td>
                            <td>20</td>
                            <td><?= htmlspecialchars($attendee['registered_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No attendees found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation" class="text-right">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?id=<?= $event['id'] ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

        <a href="/event-management-system/" class="btn btn-secondary">Back to Events</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchQuery').on('input', function() {
                var query = $(this).val();
                var eventId = <?= $event['id'] ?>;
                $.ajax({
                    url: '/event-management-system/searchAttendees',
                    type: 'GET',
                    data: { query: query, eventId: eventId },
                    success: function(response) {
                        var attendees = JSON.parse(response);
                        var attendeeList = $('#attendeeList');
                        attendeeList.empty();
                        if (attendees.length > 0) {
                            attendees.forEach(function(attendee) {
                                var attendeeRow = `
                                    <tr>
                                        <td>${attendee.username}</td>
                                        <td>${attendee.email}</td>
                                        <td>20</td>
                                        <td>${attendee.registered_at}</td>
                                    </tr>`;
                                attendeeList.append(attendeeRow);
                            });
                        } else {
                            attendeeList.append('<tr><td colspan="4">No attendees found.</td></tr>');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>