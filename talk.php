<?php
require_once 'connection.php';
session_start();

$receiverIds = array();
$receiver_id = 2;

?>

<style>
    .product-card {
        background-image: url('${productData.product_image}');
        background-size: cover;
        color: white; /* Text color for better visibility on the image */
    </style>
    <script src='messages.js'></script>


    
        

    <!-- Container for the user list (initially hidden) -->
    <div class="container vh-75 mt-12" >
    <!-- Button to toggle the user list -->
        <button id="toggleUsers" class="btn btn-primary">
            <i class="fa fa-comment-o"></i> Users
        </button>
        <div id="userListContainer" class="col-md-12" style="display: none;">
            <?php

            
            // Assuming you have the database connection established earlier in your script
            $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 0; // Corrected to handle non-existent 'product_id'

            $sql = "SELECT user_id, username FROM users";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo '<ul>';
                for ($i = 0; $row = $result->fetch_assoc(); $i++) {
                    $receiver_id = $row["user_id"];
                    $receiverIds[$i] = $receiver_id;
                    $sender_id = $_SESSION['user_id'];

                    $divId = 'toggle-div-' . $i;
                

                    if ($product_id !== 0) {
                        $message = "This is a debug message";
                        error_log($message, 3, "debug.log");
                        echo '<li class="user btn btn-light" data-receiver="' . $receiverIds[$i] . '">';
                        echo '<a href="send-product.php?product_id=' . $product_id . '&receiver=' . $receiverIds[$i] . '&sender=' . $sender_id . '&message=product">User ' . $row["username"] . '</a>';
                        echo '</a></li>';
                    } else {
                        echo '        <li class="user accordion-button" data-receiver="' . $receiverIds[$i] . '">User ' . $row["username"] . '</li>';
                        echo '</ul>';
                        echo '<div id="' . $divId . '" class="toggle-div" style="display: none">';
                        echo '<div id="chat-box" class="mt-1 border p-3 rounded" style="max-height: 50vh; margin-bottom: 1rem; overflow-y: scroll;">';
                        
                        
                        echo '    <!-- Messages will be displayed here -->';
                        echo '</div>';
                        echo '      </div>';
                        


                        //echo '<li class="user accordion-button" data-receiver="' . $receiverIds[$i] . '">User ' . $row["username"] . '</li>';
                       
                        //echo '</ul>';
                        
                        //echo '<div id="' . $divId . '" class="toggle-div" style="display: none">';
                        //echo '<div id="chat-box" class="mt-1 border p-3 rounded" style="max-height: 50vh; margin-bottom: 1rem; overflow-y: scroll;">';
                        
                        
                        //echo '    <!-- Messages will be displayed here -->';
                        //echo '</div>';
                       // echo '</div>';

                        

                    }
                    
                }
                

                
            } else {
                echo "No users found in the database.";
            }

            echo $receiverIds[$i];
            ?>
            
        
        
            

        </div>

    </div>

    

