<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Dashboard</h2>
        <p>Welcome to the Event Management System. Here you can manage events, view reports, and more.</p>
        <div class="row">
            <div class="col-md-4">
                <h4>Events</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="events/index.php">View Events</a></li>
                    <li class="list-group-item"><a href="events/create.php">Create Event</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Reports</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="reports/index.php">View Reports</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>User Management</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>