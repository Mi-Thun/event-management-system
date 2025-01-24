<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Management System - Events</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Event List</h2>
        <a href="create.php" class="btn btn-primary mb-3">Create Event</a>
        <a href="../../logout.php" class="btn btn-secondary mb-3">Logout</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['name']) ?></td>
                        <td><?= htmlspecialchars($event['description']) ?></td>
                        <td><?= htmlspecialchars($event['date']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $event['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_event.php?id=<?= $event['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>