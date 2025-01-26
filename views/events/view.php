<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
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
        .event-details {
            margin-bottom: 1px;
        }
        .event-details h5 {
            font-size: 1.5rem;
            margin-bottom: 1px;
        }
        .event-details p {
            margin-bottom: 1px;
        }
        .table {
            margin-top: 1px;
        }
        .btn {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Event Details</h2>
        <div class="event-details">
            <h5><?= htmlspecialchars($event['name']) ?></h5>
            <p><?= htmlspecialchars($event['description']) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($event['date']) ?></p>
            <p><strong>Max Capacity:</strong> <?= htmlspecialchars($event['max_capacity']) ?></p>
        </div>

        <h3>Attendees</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($attendees)): ?>
                    <?php foreach ($attendees as $attendee): ?>
                        <tr>
                            <td><?= htmlspecialchars($attendee['name']) ?></td>
                            <td><?= htmlspecialchars($attendee['email']) ?></td>
                            <td><?= htmlspecialchars($attendee['registered_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No attendees found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="/event-management-system/" class="btn btn-secondary">Back to Events</a>
    </div>
</body>
</html>