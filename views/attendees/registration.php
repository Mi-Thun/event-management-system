<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
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
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .btn-link {
            padding-left: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register for Event</h2>
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
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <a href="/event-management-system/" class="btn btn-secondary btn-block">Cancel</a>
        </form>
    </div>
</body>
</html>