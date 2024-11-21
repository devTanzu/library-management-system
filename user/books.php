<?php
include "connection.php"; // Ensure this establishes a connection as $db
include "navbar.php"; // Navigation bar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .srch {
            padding-left: 900px;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>

<div class="srch">
    <form class="navbar-form" method="post" name="form1">
        <input class="form-control" type="text" name="search" placeholder="Search books..." required>
        <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </form>
</div>

<h2>List of Books</h2>

<?php
if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($db, $_POST['search']);
    $q = mysqli_query($db, "SELECT * FROM books WHERE b_name LIKE '%$search%'");

    if (!$q || mysqli_num_rows($q) == 0) {
        echo "<p>Sorry! No books found. Try searching again.</p>";
    } else {
        displayBooksTable($q);
    }
} else {
    $query = "SELECT * FROM books ORDER BY b_name";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        displayBooksTable($result);
    } else {
        echo "<p>No books found in the database.</p>";
    }
}

// Function to display the books table
function displayBooksTable($result) {
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr style='background-color: #6db6b9e6;'>";
    echo "<th>Book ID (bid)</th>";
    echo "<th>Book Name (b_name)</th>";
    echo "<th>Status</th>";
    echo "<th>Type</th>";
    echo "<th>Price</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['bid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['b_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

// Close the database connection
mysqli_close($db);
?>

</body>
</html>