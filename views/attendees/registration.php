<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: /event-management-system/login');
    exit;
}
$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
if (!$userId) {
    echo "User ID not found in session.";
    exit;
}
$selectedEventId = isset($_GET['id']) ? $_GET['id'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin-top: 8px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span class="back-icon" onclick="history.back()">&larr; Back</span>
            <h2>Register for Event</h2>
            <div class="text-right">
                <a href="/event-management-system/logout" class="btn btn-secondary">Logout</a>
            </div>
        </div>
        <div class="event-details">
            <p><strong>Event Name: </strong><span id="eventName"></span></p>
            <p><strong>Description: </strong><span id="eventDescription"></span></p>
            <div style="display: flex; justify-content: space-between;">
                <p><strong>Date: </strong><span id="eventDate"></span></p>
                <p><strong>Max Capacity: </strong><span id="eventMaxCapacity"></span></p>
                <p><strong>Remaining Seats: </strong><span id="remainingSeats"></span></p>
                <p><strong>Registered Seats: </strong><span id="totalSeats"></span></p>
            </div>
        </div>
        <hr>
        <form id="registrationForm" action="/event-management-system/attendee" method="POST">
            <input type="hidden" name="user_id" value="<?= $userId ?>">
            <div class="form-group">
                <label for="event_id">Select Event</label>
                <select class="form-control" id="event_id" name="event_id" required>
                    <?php if (!empty($events_drop)): ?>
                        <?php foreach ($events_drop as $event): ?>
                            <option value="<?= $event['id'] ?>" data-name="<?= htmlspecialchars($event['name']) ?>"
                                data-description="<?= htmlspecialchars($event['description']) ?>"
                                data-date="<?= htmlspecialchars($event['date']) ?>"
                                data-max-capacity="<?= htmlspecialchars($event['max_capacity']) ?>"
                                <?= $selectedEventId == $event['id'] ? 'selected' : '' ?>><?= htmlspecialchars($event['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No events available</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="seats">Number of Seats</label>
                <input type="number" class="form-control" id="seats" name="seats" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <a href="/event-management-system/" class="btn btn-secondary btn-block">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Registration Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="errorModalBody">
                    <!-- Error message will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            function updateEventDetails() {
                var selectedOption = $('#event_id').find('option:selected');
                $('#eventName').text(selectedOption.data('name'));
                $('#eventDescription').text(selectedOption.data('description'));
                $('#eventDate').text(selectedOption.data('date'));
                $('#eventMaxCapacity').text(selectedOption.data('max-capacity'));

                var eventId = selectedOption.val();
                $.ajax({
                    url: '/event-management-system/getRegisteredSeats',
                    type: 'GET',
                    data: { event_id: eventId },
                    success: function (response) {
                        var data = JSON.parse(response);
                        $('#totalSeats').text(data.totalSeats);
                        $('#remainingSeats').text(data.remainingSeats);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $('#event_id').on('change', function () {
                updateEventDetails();
            });

            updateEventDetails();

            $('#registrationForm').on('submit', function (event) {
                var remainingSeats = parseInt($('#remainingSeats').text());
                var seatsToBook = parseInt($('#seats').val());
                if (seatsToBook > remainingSeats) {
                    event.preventDefault();
                    var errorMessage = remainingSeats === 0 ? 'You cannot register because there are no remaining seats.' : `You cannot register because there are only ${remainingSeats} remaining seats.`;
                    $('#errorModalBody').text(errorMessage);
                    $('#errorModal').modal('show');
                }
            });
        });
    </script>
</body>

</html>