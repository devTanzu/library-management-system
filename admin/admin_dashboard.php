<?php
include "connection.php"; // Database connection
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['login_admin'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Fetch the logged-in admin's username
$admin_username = $_SESSION['login_admin'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #2c3e50;
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #ecf0f1;
        }

        .logout-btn {
            float: right;
            margin-top: -40px;
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .dashboard-card {
            background-color: #34495e;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, Admin <?php echo $admin_username; ?>!</h1>
        <a href="logout.php" class="logout-btn">Logout</a>

        <div class="dashboard-card">
            <h2>Manage Users</h2>
            <p>View, add, or remove users from the system.</p>
            <a href="manage_users.php" class="btn btn-primary">Go to User Management</a>
        </div>

        <div class="dashboard-card">
            <h2>Manage Books</h2>
            <p>View, add, edit, or delete books in the library database.</p>
            <a href="manage_books.php" class="btn btn-primary">Go to Book Management</a>
        </div>

        <div class="dashboard-card">
            <h2>View Logs</h2>
            <p>View activity logs or recent actions taken in the system.</p>
            <a href="view_logs.php" class="btn btn-primary">View Logs</a>
        </div>
    </div>
</body>

</html>
