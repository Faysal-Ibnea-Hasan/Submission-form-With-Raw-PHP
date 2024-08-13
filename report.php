<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "xpeed";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$search_user_id = "";
$sql = "SELECT * FROM submissions";

// Check if the form is submitted and search by user ID
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_user_id = $_POST['entry_by'];
    if (!empty($search_user_id) && is_numeric($search_user_id)) {
        $sql .= " WHERE entry_by = " . intval($search_user_id);
    }
}

// Execute the query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissions Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .search-form {
            margin-bottom: 20px;
        }

        /* Navbar container */
        .navbar {
            overflow: hidden;
            background-color: #333;
            font-family: Arial, sans-serif;
        }

        /* Navbar links */
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        /* Change color on hover */
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="home.php">Submission Form</a>
        <a href="report.php">Report</a>
    </div>

    <h1>Submissions Report</h1>

    <form method="POST" action="report.php" class="search-form">
        <label for="search_user_id">Search by User ID:</label>
        <input type="text" id="entry_by" name="entry_by" value="<?php echo htmlspecialchars($search_user_id); ?>">
        <input type="submit" value="Search">
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Buyer</th>
            <th>Receipt ID</th>
            <th>Items</th>
            <th>Buyer Email</th>
            <th>Buyer IP</th>
            <th>Note</th>
            <th>City</th>
            <th>Phone</th>
            <th>Entry Date</th>
            <th>Entry By</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
                echo "<td>" . $row["buyer"] . "</td>";
                echo "<td>" . $row["receipt_id"] . "</td>";
                echo "<td>" . $row["items"] . "</td>";
                echo "<td>" . $row["buyer_email"] . "</td>";
                echo "<td>" . $row["buyer_ip"] . "</td>";
                echo "<td>" . $row["note"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["entry_at"] . "</td>";
                echo "<td>" . $row["entry_by"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No records found</td></tr>";
        }
        ?>

    </table>

    <?php
    // Close connection
    $conn->close();
    ?>

</body>

</html>