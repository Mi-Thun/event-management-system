<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Event</h2>
        <form action="/event-management-system/attendee" method="POST">
            <div class="form-group">
                <label for="event_id">Select Event</label>
                <select class="form-control" id="event_id" name="event_id" required>
                    <?php if (!empty($events_drop)): ?>
                        <?php foreach ($events_drop as $event): ?>
                            <option value="<?= $event['id'] ?>"><?= htmlspecialchars($event['name']) ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No events available</option>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="/event-management-system/" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>