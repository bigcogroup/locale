<?php
// Access the GET variable
$receiver = isset($_GET['receiver']) ? $_GET['receiver'] : '';

// Now include the content page (conversation.php) and pass the receiver variable in the query string
$pageContent = "conversation.php?receiver=" . urlencode($receiver);
$pageTitle = "Chat";

// Include other necessary components (e.g., trending.php)
include('trending.php');
?>
