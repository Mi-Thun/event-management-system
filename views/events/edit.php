<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Event</h2>
        <?php if (isset($event) && $event !== false): ?>
        <form action="/event-management-system/events/edit?id=<?= $event['id'] ?>" method="POST">
            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($event['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($event['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Event</button>
            <a href="/event-management-system/" class="btn btn-secondary">Cancel</a>
        </form>
        <?php else: ?>
        <p>Error: Event not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>