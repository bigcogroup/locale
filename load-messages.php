<?php

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve sender and receiver from the query parameters
    $sender = "sender"; // Replace with the actual sender (e.g., user or user ID)
    $receiver = "receiver"; // Replace with the actual receiver (e.g., user or user ID)

    // Perform a database query to fetch messages between the sender and receiver, ordered by timestamps
   
    $sql = "SELECT * FROM messages WHERE (sender = '$sender' AND receiver = '$receiver') OR (sender = '$receiver' AND receiver = '$sender') ORDER BY timestamp ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Create an array to store the retrieved messages
        $messages = array();
        
        // Fetch the messages and add them to the array
        while ($row = $result->fetch_assoc()) {
            $message = array(
                "sender" => $row["sender"],
                "receiver" => $row["receiver"],
                "message" => $row["message"],
                "timestamp" => $row["timestamp"]
            );
            array_push($messages, $message);
        }

        header('Content-Type: application/json');
        // Return the retrieved messages as JSON
        echo json_encode($messages);
        

    } else {

         header('Content-Type: application/json');
        // No messages found
        echo json_encode(array());
    }
}
?>
