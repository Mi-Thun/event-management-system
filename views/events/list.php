

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Management System - Events</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Event List</h2>
        <a href="/event-management-system/events/create" class="btn btn-primary mb-3">Create Event</a>
        <a href="/event-management-system/logout" class="btn btn-secondary mb-3">Logout</a>

        <input type="text" id="searchQuery" class="form-control mb-6 mt-3 pt-3" placeholder="Search events or attendees">

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Max Capacity</th>
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
                            <td>
                                <a href="/event-management-system/events/view?id=<?= $event['id'] ?>" class="btn btn-sm btn-primary">View</a>
                                <a href="/event-management-system/events/edit?id=<?= $event['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="/event-management-system/events/delete?id=<?= $event['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="/event-management-system/download_report?id=<?= $event['id'] ?>" class="btn btn-sm btn-info">Report</a>
                                <a href="/event-management-system/attendee?id=<?= $event['id'] ?>" class="btn btn-sm btn-info">Registration</a>
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
    </div>

    <script>
        $(document).ready(function() {
            $('#searchQuery').on('input', function() {
                var query = $(this).val();
                $.ajax({
                    url: '/event-management-system/search',
                    type: 'GET',
                    data: { query: query },
                    success: function(response) {
                        $('#eventList').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>