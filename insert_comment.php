<?php

    error_reporting(0); 
    require_once 'connection.php';
   include 'trending.php';
                                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
                                                    // Collect input data from form
                                                    $user_id = $_SESSION['user_id'];
                                                    $post_id = $_POST['post_id'];
                                                    $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);
                                                    $comment_timestamp = date('Y-m-d H:i:s');
                                                   
                                                    $sql_check = "SELECT * FROM social_media_comments WHERE product_id = '$post_id' AND user_id = '$user_id' AND comment_text = '$comment_text'";
                                                    $result_check = mysqli_query($conn, $sql_check);
                                                   
                                                    if (mysqli_num_rows($result_check) == 0) {
                                                        // Insert the comment into the database
                                                        $sql_insert = "INSERT INTO social_media_comments (product_id, user_id, comment_text, comment_timestamp) VALUES ('$post_id', '$user_id', '$comment_text', '$comment_timestamp')";
                                                        if (mysqli_query($conn, $sql_insert)) {
                                                            // Retrieve the username of the commenter from the users table
                                                            $sql_user = "SELECT username FROM users WHERE user_id = '$user_id'";
                                                            $result_user = mysqli_query($conn, $sql_user);
                                                            $row_user = mysqli_fetch_assoc($result_user);
                                                            $username = $row_user['username'];
                                                            
                                                            // Return the comment details as JSON
                                                            $response = array(
                                                                'username' => $username,
                                                                'comment_text' => $comment_text,
                                                                'comment_timestamp' => date('F j, Y, g:i a', strtotime($comment_timestamp))
                                                            );
                                                            // Send a JSON response
                                                            header('Content-Type: application/json');
                                                            echo json_encode($response);
                                                        } else {
                                                            echo json_encode(array('error' => 'Error inserting comment'));
                                                        }
                                                    } else {
                                                        echo json_encode(array('error' => 'Comment already exists'));
                                                    }
                                                } else {
                                                    echo json_encode(array('error' => 'Invalid request'));
                                                }
                                                
                                               ?>