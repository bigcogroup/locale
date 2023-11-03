<?php
require_once 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Retrieve sender and receiver from the query parameters
    $sender = $_SESSION['user_id']; // Replace with the actual sender (e.g., user or user ID)
    $receiver = $_GET['receiver']; // Replace with the actual receiver (e.g., user or user ID)

    // Perform a database query to fetch messages between the sender and receiver, ordered by timestamps
    $sql = "SELECT * FROM messages WHERE (sender = '$sender' AND receiver = '$receiver') OR (sender = '$receiver' AND receiver = '$sender') ORDER BY timestamp ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Create an array to store the retrieved messages
        $messages = array();
        
        // Fetch the messages and add them to the array
        while ($row = $result->fetch_assoc()) {
            // Create a JSON object for each row and add it to the array
            $message = json_encode(array(
                "sender" => $row["sender"],
                "receiver" => $row["receiver"],
                "message" => $row["message"],
                "product_id" => $row["product_id"],
                "timestamp" => $row["timestamp"]
            ));
            $messages[] = $message;
        }

        header('Content-Type: application/json');
        echo json_encode($messages);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array());
    }
}
?>


