<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Event Details</title>
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
?>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
        <span class="back-icon" onclick="history.back()">&larr; Back</span>
            <h2>Attendee Details</h2>
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
                <p><strong>Remain Seat: </strong> <?= htmlspecialchars($remainingSeats) ?></p>
                <p><strong>Registered Seats: </strong> <?= htmlspecialchars($totalRegisteredSeats) ?></p>
            </div>
        </div>
        <hr>
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
                            <td><?= htmlspecialchars($attendee['seats']) ?></td>
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
            <ul class="pagination" id="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="#" data-page="<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadAttendees(query, page) {
                var eventId = <?= $event['id'] ?>;
                $.ajax({
                    url: '/event-management-system/searchAttendees',
                    type: 'GET',
                    data: { query: query, eventId: eventId, page: page },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var attendees = data.attendees;
                        var totalPages = data.totalPages;
                        var currentPage = data.currentPage;
                        var attendeeList = $('#attendeeList');
                        var pagination = $('#pagination');
                        attendeeList.empty();
                        pagination.empty();
                        if (attendees.length > 0) {
                            attendees.forEach(function(attendee) {
                                var attendeeRow = `
                                    <tr>
                                        <td>${attendee.username}</td>
                                        <td>${attendee.email}</td>
                                        <td>${attendee.seats}</td>
                                        <td>${attendee.registered_at}</td>
                                    </tr>`;
                                attendeeList.append(attendeeRow);
                            });
                        } else {
                            attendeeList.append('<tr><td colspan="4">No attendees found.</td></tr>');
                        }
                        for (var i = 1; i <= totalPages; i++) {
                            var pageItem = `<li class="page-item ${i == currentPage ? 'active' : ''}">
                                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                                            </li>`;
                            pagination.append(pageItem);
                        }
                    }
                });
            }

            $('#searchQuery').on('input', function() {
                var query = $(this).val();
                loadAttendees(query, 1);
            });

            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var query = $('#searchQuery').val();
                loadAttendees(query, page);
            });

            loadAttendees('', 1);
        });
    </script>
</body>
</html>