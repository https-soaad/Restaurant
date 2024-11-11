<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Replace with proper authentication
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: admin_dashboard.php');
        exit();
    }
    $error = 'Invalid credentials';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F5F5DC;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #352416;
            color: white;
        }
        .btn-custom:hover {
            background-color: #8B6C52;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2 class="text-center mb-4">Admin Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
        </form>
    </div>
</body>
</html>
