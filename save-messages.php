<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Access-Control-Allow-Origin: https://mtaani.great-site.net");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Max-Age: 86400"); // Cache preflight response for 24 hours.

    $messages = json_decode($_POST['messages']);
    if ($messages !== null) {
        file_put_contents('text_messages.txt', json_encode($messages));
        echo 'Message saved successfully';
    } else {
        echo 'Invalid JSON data';
    }

    exit(0); // Terminate the script after handling the request.
}

?>
