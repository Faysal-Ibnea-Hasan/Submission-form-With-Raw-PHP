<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Submission Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    <div class="container">
        <h2>Data Submission Form</h2>
        <form action="database.php" method="POST">
            <div class="form-group">
                <label for="amount">Amount *</label>
                <input type="number" id="amount" name="amount" required>
            </div>

            <div class="form-group">
                <label for="buyer">Buyer *</label>
                <input type="text" id="buyer" name="buyer" required>
            </div>

            <div class="form-group">
                <label for="receipt_id">Receipt ID *</label>
                <input type="text" id="receipt_id" name="receipt_id" required>
            </div>

            <div class="form-group">
                <label for="items">Items *</label>
                <input type="text" id="items" name="items" required>
            </div>

            <div class="form-group">
                <label for="buyer_email">Buyer Email *</label>
                <input type="email" id="buyer_email" name="buyer_email" required>
            </div>

            <div class="form-group">
                <label for="note">Note *</label>
                <textarea id="note" name="note" required></textarea>
            </div>

            <div class="form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone *</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="entry_by">Entry By *</label>
                <input type="number" id="entry_by" name="entry_by" required>
            </div>

            <input type="submit" value="Submit">
        </form>
    </div>

</body>

</html>