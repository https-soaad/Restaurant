<?php
session_start();
require_once 'db_connection.php';

// Check admin authentication
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Get reservation ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "UPDATE reservations SET 
                full_name = :full_name,
                email = :email,
                phone = :phone,
                booking_date = :booking_date,
                booking_time = :booking_time,
                num_guests = :num_guests,
                special_request = :special_request,
                status = :status
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'full_name' => $_POST['full_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'booking_date' => $_POST['booking_date'],
            'booking_time' => $_POST['booking_time'],
            'num_guests' => $_POST['num_guests'],
            'special_request' => $_POST['special_request'],
            'status' => $_POST['status'],
            'id' => $id
        ]);

        $_SESSION['success_message'] = "Reservation updated successfully!";
        header('Location: admin_dashboard.php');
        exit();
    } catch (PDOException $e) {
        $error = "Error updating reservation: " . $e->getMessage();
    }
}

// Fetch reservation data
try {
    $stmt = $pdo->prepare("SELECT * FROM reservations WHERE id = ?");
    $stmt->execute([$id]);
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        $_SESSION['error_message'] = "Reservation not found!";
        header('Location: admin_dashboard.php');
        exit();
    }
} catch (PDOException $e) {
    $error = "Error fetching reservation: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --beige: #F5F5DC;
            --dark-brown: #352416;
            --light-brown: #8B6C52;
        }

        body {
            background-color: var(--beige);
            padding: 20px;
        }

        .edit-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        .form-header {
            background-color: var(--dark-brown);
            color: var(--beige);
            padding: 15px;
            margin: -30px -30px 30px -30px;
            border-radius: 10px 10px 0 0;
        }

        .btn-custom {
            background-color: var(--light-brown);
            color: white;
        }

        .btn-custom:hover {
            background-color: var(--dark-brown);
            color: white;
        }

        .status-select {
            border: 2px solid var(--light-brown);
        }
    </style>
</head>
<body>
    <div class="edit-form">
        <div class="form-header">
            <h2 class="mb-0">Edit Reservation #<?php echo htmlspecialchars($reservation['id']); ?></h2>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" 
                           value="<?php echo htmlspecialchars($reservation['full_name']); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?php echo htmlspecialchars($reservation['email']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" 
                           value="<?php echo htmlspecialchars($reservation['phone']); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="num_guests" class="form-label">Number of Guests</label>
                    <input type="number" class="form-control" id="num_guests" name="num_guests" 
                           value="<?php echo htmlspecialchars($reservation['num_guests']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="booking_date" class="form-label">Booking Date</label>
                    <input type="date" class="form-control" id="booking_date" name="booking_date" 
                           value="<?php echo htmlspecialchars($reservation['booking_date']); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="booking_time" class="form-label">Booking Time</label>
                    <input type="time" class="form-control" id="booking_time" name="booking_time" 
                           value="<?php echo htmlspecialchars($reservation['booking_time']); ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select status-select" id="status" name="status" required>
                    <option value="pending" <?php echo $reservation['status'] === 'pending' ? 'selected' : ''; ?>>
                        Pending
                    </option>
                    <option value="confirmed" <?php echo $reservation['status'] === 'confirmed' ? 'selected' : ''; ?>>
                        Confirmed
                    </option>
                    <option value="cancelled" <?php echo $reservation['status'] === 'cancelled' ? 'selected' : ''; ?>>
                        Cancelled
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="special_request" class="form-label">Special Request</label>
                <textarea class="form-control" id="special_request" name="special_request" rows="3"
                ><?php echo htmlspecialchars($reservation['special_request']); ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                <button type="submit" class="btn btn-custom">Update Reservation</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
