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

// Get the buyer's IP address
function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP from shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP passed from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // IP address from remote address
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// Define validation functions
function validate_amount($amount)
{
    return is_numeric($amount);
}

function validate_buyer($buyer)
{
    return preg_match('/^[a-zA-Z0-9\s]{1,20}$/u', $buyer);
}

function validate_receipt_id($receipt_id)
{
    return preg_match('/^[a-zA-Z0-9]+$/', $receipt_id);
}

function validate_items($items)
{
    return preg_match('/^[a-zA-Z\s]+$/', $items);
}

function validate_buyer_email($buyer_email)
{
    return filter_var($buyer_email, FILTER_VALIDATE_EMAIL);
}

function validate_note($note)
{
    return preg_match('/^.{1,300}$/u', $note) && str_word_count($note) <= 30;
}

function validate_city($city)
{
    return preg_match('/^[a-zA-Z\s]+$/', $city);
}

function validate_phone($phone)
{
    return is_numeric($phone);
}

function validate_entry_by($entry_by)
{
    return is_numeric($entry_by);
}

$buyer_ip = getUserIP();
// Get the current date in the local timezone
date_default_timezone_set('Asia/Dhaka'); // Set your local timezone, e.g., 'America/New_York'
$entry_at = date('Y-m-d'); // Format the date as 'YYYY-MM-DD'

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO submissions (amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, city, phone, entry_at, entry_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssssssi", $amount, $buyer, $receipt_id, $items, $buyer_email, $buyer_ip, $note, $city, $phone, $entry_at, $entry_by);

// Set parameters and execute
$amount = $_POST['amount'];
$buyer = $_POST['buyer'];
$receipt_id = $_POST['receipt_id'];
$items = $_POST['items'];
$buyer_email = $_POST['buyer_email'];
$note = $_POST['note'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$entry_by = $_POST['entry_by'];
// Validate each field
$errors = [];
// Check Amount: only numbers.
if (!validate_amount($amount)) {
    $errors[] = "Amount must be a number.";
}
// Check Buyer: only text, spaces and numbers, not more than 20 characters.
if (!validate_buyer($buyer)) {
    $errors[] = "Buyer can only contain text, spaces, and numbers, and must not exceed 20 characters.";
}
// Check Receipt_id: only text.
if (!validate_receipt_id($receipt_id)) {
    $errors[] = "Receipt ID must contain only text.";
}
// Check Items: only text.
if (!validate_items($items)) {
    $errors[] = "Items must contain only text.";
}
// Check Buyer_email: only emails.
if (!validate_buyer_email($buyer_email)) {
    $errors[] = "Buyer email must be a valid email address.";
}
// Check Note: anything, not more than 30 words, and can be input unicode(bangla text) characters too.
if (!validate_note($note)) {
    $errors[] = "Note must be no more than 30 words and can contain up to 300 characters, including Unicode characters.";
}
// Check City: only text and spaces.
if (!validate_city($city)) {
    $errors[] = "City can only contain text and spaces.";
}
// Check Phone: only numbers.
if (!validate_phone($phone)) {
    $errors[] = "Phone must be a number.";
}
// Check Entry_by: only numbers.
if (!validate_entry_by($entry_by)) {
    $errors[] = "Entry by must be a number.";
}

// Check if there are any validation errors
if (!empty($errors)) {
    // Handle errors (e.g., display them to the user)
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
} else {
    $stmt->execute();

    header("Location: report.php");
    exit(); // Always use exit() after a header redirect
}


$stmt->close();
$conn->close();