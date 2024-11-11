<?php
session_start();
require_once 'db_connection.php';

// Basic authentication check (you should implement proper authentication)
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Fetch dashboard statistics
$stats = [
    'total_reservations' => $pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn(),
    'today_reservations' => $pdo->query("SELECT COUNT(*) FROM reservations WHERE DATE(booking_date) = CURDATE()")->fetchColumn(),
    'week_reservations' => $pdo->query("SELECT COUNT(*) FROM reservations WHERE booking_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)")->fetchColumn(),
    'pending_reservations' => $pdo->query("SELECT COUNT(*) FROM reservations WHERE status = 'pending'")->fetchColumn()
];

// Fetch all reservations
$reservations = $pdo->query("SELECT * FROM reservations ORDER BY booking_date DESC")->fetchAll(PDO::FETCH_ASSOC);

// Display messages if they exist
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';

// Clear the messages after displaying them
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Acme&display=swap" rel="stylesheet">
    <style>
        :root {
            --beige: #F5F5DC;
            --dark-brown: #352416;
            --light-brown: #8B6C52;
        }

        body {
            background-color: var(--beige);
            font-family: 'Acme', sans-serif;
        }

        .dashboard-header {
            background-color: var(--dark-brown);
            color: var(--beige);
            padding: 20px;
        }

        .stats-card {
            background-color: white;
            border-left: 4px solid var(--light-brown);
            padding: 20px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stats-number {
            font-size: 2em;
            color: var(--dark-brown);
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            overflow-x: auto;
        }

        .table thead {
            background-color: var(--light-brown);
            color: white;
        }

        .status-pending {
            background-color: #ffeeba;
            padding: 5px 10px;
            border-radius: 15px;
        }

        .status-confirmed {
            background-color: #c3e6cb;
            padding: 5px 10px;
            border-radius: 15px;
        }

        .status-cancelled {
            background-color: #f5c6cb;
            padding: 5px 10px;
            border-radius: 15px;
        }

        @media screen and (max-width: 768px) {
            .table-responsive-stack tr {
                display: flex;
                flex-direction: column;
                border-bottom: 3px solid var(--light-brown);
                margin-bottom: 1rem;
            }
            
            .table-responsive-stack td,
            .table-responsive-stack th {
                display: block;
                text-align: left;
                border: none;
                padding: 0.5rem;
            }

            .table-responsive-stack th {
                display: none;
            }

            .table-responsive-stack td {
                position: relative;
                padding-left: 40%;
            }

            .table-responsive-stack td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 35%;
                padding-left: 0.5rem;
                font-weight: bold;
                color: var(--dark-brown);
            }

            .action-buttons {
                display: flex;
                gap: 0.5rem;
                padding-left: 0 !important;
            }

            .stats-card {
                margin-bottom: 1rem;
            }
        }

        .reservation-status {
            display: inline-block;
            min-width: 100px;
            text-align: center;
        }

        .action-buttons form {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <div class="container">
            <h1 class="display-4">Restaurant Dashboard</h1>
            <p>Welcome to your admin panel</p>
        </div>
    </div>

    <?php if ($success_message): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($success_message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error_message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <div class="container mt-4">
        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Total Reservations</h5>
                    <div class="stats-number"><?php echo $stats['total_reservations']; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Today's Reservations</h5>
                    <div class="stats-number"><?php echo $stats['today_reservations']; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Next 7 Days</h5>
                    <div class="stats-number"><?php echo $stats['week_reservations']; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Pending Reservations</h5>
                    <div class="stats-number"><?php echo $stats['pending_reservations']; ?></div>
                </div>
            </div>
        </div>

        <!-- Reservations Table -->
        <div class="table-container">
            <h3>Recent Reservations</h3>
            <table class="table table-responsive-stack">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Guests</th>
                        <th>Special Requests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td data-label="ID"><?php echo $reservation['id']; ?></td>
                        <td data-label="Name"><?php echo htmlspecialchars($reservation['full_name']); ?></td>
                        <td data-label="Email"><?php echo htmlspecialchars($reservation['email']); ?></td>
                        <td data-label="Phone"><?php echo htmlspecialchars($reservation['phone']); ?></td>
                        <td data-label="Date"><?php echo date('M d, Y', strtotime($reservation['booking_date'])); ?></td>
                        <td data-label="Time"><?php echo date('h:i A', strtotime($reservation['booking_time'])); ?></td>
                        <td data-label="Guests"><?php echo $reservation['num_guests']; ?></td>
                        <td data-label="Special Requests"><?php echo $reservation['special_request']; ?>
                        <td data-label="Status">
                            <span class="status-<?php echo $reservation['status']; ?> reservation-status">
                                <?php echo ucfirst($reservation['status']); ?>
                            </span>
                        </td>
                        <td class="action-buttons" data-label="Actions">
                            <a href="edit.php?id=<?php echo $reservation['id']; ?>" 
                               class="btn btn-sm btn-primary">Edit</a>
                            <form method="POST" action="delete_reservation.php" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                <input type="hidden" name="id" value="<?php echo $reservation['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Handle table responsiveness
        function checkWidth() {
            if (window.innerWidth <= 768) {
                // Add mobile-specific behaviors here if needed
            } else {
                // Add desktop-specific behaviors here if needed
            }
        }

        // Initial check
        checkWidth();

        // Check on resize
        window.addEventListener('resize', checkWidth);
    });
    </script>
</body>
</html>
