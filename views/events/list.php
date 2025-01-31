<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Events</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        .container {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin-top: 8px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: /event-management-system/login');
        exit;
    }
    $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
?>
    <div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
    <a href="/event-management-system/" class="btn btn-link"><i class="fas fa-home"></i> Home</a>       
    <h2>Event List</h2>
    <input type="hidden" id="isAdmin" value="<?= $isAdmin ? 'true' : 'false' ?>">

            <div class="text-right">
                <a href="/event-management-system/logout" class="btn btn-secondary">Logout</a>
            </div>
        </div>
        <input type="text" id="searchQuery" class="form-control" placeholder="Search events or attendees" style="margin-top: 20px; margin-bottom: 20px;">
        <?php if ($isAdmin): ?>
        <div class="text-right">
            <a href="/event-management-system/events/create" class="btn btn-primary">Create Event</a>
        </div>
        <?php endif; ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Max Capacity</th>
                    <th>Total Seats Booked</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="eventList">
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= htmlspecialchars($event['name']) ?></td>
                            <td><?= htmlspecialchars($event['description']) ?></td>
                            <td><?= htmlspecialchars($event['date']) ?></td>
                            <td><?= htmlspecialchars($event['max_capacity']) ?></td>
                            <td><?= htmlspecialchars($event['total_seats_booked']) ?></td>
                            <td>
                                <a href="/event-management-system/events/view?id=<?= $event['id'] ?>" class="btn btn-primary btn-sm">View</a>
                                <?php if ($isAdmin): ?>
                                    <a href="/event-management-system/events/edit?id=<?= $event['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/event-management-system/events/delete?id=<?= $event['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                    <a href="/event-management-system/download_report?id=<?= $event['id'] ?>" class="btn btn-info btn-sm">Report</a>
                                <?php else: ?>
                                    <a href="/event-management-system/attendee?id=<?= $event['id'] ?>" class="btn btn-info btn-sm">Registration</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No events found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation" class="text-right">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#searchQuery').on('input', function() {
        var query = $(this).val();
        $.ajax({
            url: '/event-management-system/search',
            type: 'GET',
            data: { query: query },
            success: function(response) {
                var events = JSON.parse(response);
                var eventList = $('#eventList');
                var isAdmin = $('#isAdmin').val() === 'true'; // Get session value

                eventList.empty();

                if (events.length > 0) {
                    events.forEach(function(event) {
                        var eventRow = '<tr>' +
                            '<td>' + event.name + '</td>' +
                            '<td>' + event.description + '</td>' +
                            '<td>' + event.date + '</td>' +
                            '<td>' + event.max_capacity + '</td>' +
                            '<td>' + event.total_seats_booked + '</td>' +
                            '<td>';

                        // Admin actions
                        if (isAdmin) {
                            eventRow += '<a href="/event-management-system/events/view?id=' + event.id + '" class="btn btn-primary btn-sm">View</a> ' +
                                        '<a href="/event-management-system/events/edit?id=' + event.id + '" class="btn btn-warning btn-sm">Edit</a> ' +
                                        '<a href="/event-management-system/events/delete?id=' + event.id + '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a> ' +
                                        '<a href="/event-management-system/download_report?id=' + event.id + '" class="btn btn-info btn-sm">Report</a> ';
                        } else {
                            eventRow += '<a href="/event-management-system/attendee?id=' + event.id + '" class="btn btn-info btn-sm">Registration</a>';
                        }

                        eventRow += '</td></tr>';
                        eventList.append(eventRow);
                    });
                } else {
                    eventList.append('<tr><td colspan="6">No events found.</td></tr>');
                }
            }
        });
    });
});

    </script>
</body>
</html>