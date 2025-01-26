<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Event Details</h2>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($event['description']) ?></p>
                <p class="card-text"><strong>Date:</strong> <?= htmlspecialchars($event['date']) ?></p>
                <p class="card-text"><strong>Max Capacity:</strong> <?= htmlspecialchars($event['max_capacity']) ?></p>
            </div>
        </div>

        <h3>Attendees</h3>
        <table class="table">
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