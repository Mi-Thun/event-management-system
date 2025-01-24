<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.csss">
</head>
<body>
    <div class="container mt-5">
        <h2>Event Reports</h2>
        <a href="generate_report.php" class="btn btn-primary mb-3">Generate Attendee Report</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Attendees</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?= htmlspecialchars($report['event_name']) ?></td>
                        <td><?= htmlspecialchars($report['date']) ?></td>
                        <td><?= htmlspecialchars($report['attendee_count']) ?></td>
                        <td>
                            <a href="download_report.php?id=<?= $report['event_id'] ?>" class="btn btn-sm btn-success">Download</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>