<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once 'connection.php';
// Include your database connection code here
// Example:
// Retrieve values from the URL
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the data from the POST request
    $productID = isset($_POST["product_id"]) ? $_POST["product_id"] : "";
    $sender = $_SESSION["user_id"];
    $receiver = isset($_POST["receiver"]) ? $_POST["receiver"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";
    // Perform data validation and sanitation as needed

    // Insert the data into your database
    $sql = "INSERT INTO messages (product_id, sender, receiver, message) 
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $productID, $sender, $receiver, $message);

    if ($stmt->execute()) {
        // Message inserted successfully
        $response = ["success" => true];
        echo json_encode($response);
    } else {
        // Error occurred while inserting the message
        $response = ["success" => false];
        echo json_encode($response);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    $response = ["success" => false, "error" => "Invalid request method"];
    echo json_encode($response);
}
?>
