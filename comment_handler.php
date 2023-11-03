<?php

require_once 'connection.php';
include 'trending.php';

session_start();
$_SESSION['user_id'] = 1;
// Retrieve the post ID and user ID from the form data and session
$user_id = $_SESSION['user_id']; // or retrieve it from the form data if not stored in session

// Sanitize the comment text input to prevent SQL injection attacks
$comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);

// Insert the comment into the database
$sql = "INSERT INTO social_media_comments (product_id, user_id, comment_text) VALUES ('$post_id', '$user_id', '$comment_text')";
if (mysqli_query($conn, $sql)) {
  echo "sent";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>