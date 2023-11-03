<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'connection.php';
// Include your database connection code here
// Example:
// Retrieve values from the URL
$product_id = $_GET['product_id'];
$receiver = $_GET['receiver'];
$sender = $_GET['sender'];
$message = $_GET['message'];

// Ensure that you validate and sanitize the input here for security.

// SQL query to insert data into the 'messages' table
$sql = "INSERT INTO messages (product_id, sender, receiver, message) 
        VALUES ('$product_id', '$sender', '$receiver', '$message')";

// Perform the database query
if ($conn->query($sql) === TRUE) {
    echo "Message inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>