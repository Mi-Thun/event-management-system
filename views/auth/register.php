<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        .container {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin-top: 8px;
        }
        .btn-link {
            padding-left: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="regestrationForm" action="/event-management-system/register" method="POST">
            <div class="form-group">
                <label for="username">Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <p class="mt-3">Already have an account? <a href="/event-management-system/login" class="btn btn-link">Login here</a>.</p>
        </form>
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= isset($errorMessage) ? htmlspecialchars($errorMessage) : '' ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if (isset($errorMessage)): ?>
                $('#errorModal').modal('show');
            <?php endif; ?>

            $('#regestrationForm').on('submit', function(event) {
                var email = $('#email').val().trim();
                var password = $('#password').val().trim();
                var confirm_password = $('#confirm_password').val().trim();
                if (email === '' || password === '') {
                    event.preventDefault();
                    $('.modal-body').text('Email and password cannot be empty.');
                    $('#errorModal').modal('show');
                }
                if (password !== confirm_password) {
                    event.preventDefault();
                    $('.modal-body').text('Passwords do not match.');
                    $('#errorModal').modal('show');
                }
            });
        });
    </script>
</body>
</html>