       <section>
        <?php
                
                $latitude = $_COOKIE['latitude'];
                $longitude = $_COOKIE['longitude'];
                
                // Set the radius of the geofence in meters
                $radius = 1609.344;
                
                // Convert latitude and longitude to radians
                $latitude_rad = deg2rad($latitude);
                $longitude_rad = deg2rad($longitude);
                
                // Earth's radius in meters
                $earth_radius = 6371000;
                
                // Calculate the minimum and maximum latitude and longitude
                $min_latitude = rad2deg($latitude_rad - ($radius / $earth_radius));
                $max_latitude = rad2deg($latitude_rad + ($radius / $earth_radius));
                $min_longitude = rad2deg($longitude_rad - ($radius / $earth_radius / cos($latitude_rad)));
                $max_longitude = rad2deg($longitude_rad + ($radius / $earth_radius / cos($latitude_rad)));
                
                // Define the geofence as a polygon
                $geofence = [
                    [$min_latitude, $min_longitude],
                    [$min_latitude, $max_longitude],
                    [$max_latitude, $max_longitude],
                    [$max_latitude, $min_longitude],
                    [$min_latitude, $min_longitude],
                ];
                
                // Define the MySQL query to select locations within the geofence
                $query = "SELECT * FROM places WHERE latitude BETWEEN " . $min_latitude . " AND " . $max_latitude . " AND longitude BETWEEN " . $min_longitude . " AND " . $max_longitude;
                
                // Execute the MySQL query and output the results
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {

                        $lat1 = $latitude; // Replace with the actual latitude
                        $lon1 = $longitude; // Replace with the actual longitude

                        // Set the latitude and longitude of the second point
                        $lat2 = $row["latitude"]; // Replace with the actual latitude
                        $lon2 = $row["longitude"]; // Replace with the actual longitude

                        // Earth's radius in meters
                        $earth_radius = 6371000;

                        // Convert latitude and longitude to radians
                        $lat1_rad = deg2rad($lat1);
                        $lon1_rad = deg2rad($lon1);
                        $lat2_rad = deg2rad($lat2);
                        $lon2_rad = deg2rad($lon2);

                        // Calculate the distance between the two points using the Haversine formula
                        $delta_lat = $lat2_rad - $lat1_rad;
                        $delta_lon = $lon2_rad - $lon1_rad;
                        $a = sin($delta_lat / 2) * sin($delta_lat / 2) + cos($lat1_rad) * cos($lat2_rad) * sin($delta_lon / 2) * sin($delta_lon / 2);
                        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                        $distance = $earth_radius * $c;

                        // Output the distance in meters

                        //echo "Location ID: " . $row["id"] . " - Latitude: " . $row["latitude"] . " - Longitude: " . $row["longitude"] . "<br>";
                        $place = $row['id'];
                        $mysql = "SELECT * FROM product where place_id = $place";
                        $all_product = $conn->query($mysql);
                        while($rows = mysqli_fetch_assoc($all_product)){
                            
                            ?>
                            <div class="post"></div> 
                            <div class="post-info">
                                <div class="user">
                                    <img src="assets/Gypsy.png" alt="avatar">
                                    <div>
                                        <h6>Gypsy</h6>
                                        <p>Cool Video</p>
                                    </div>
                                </div>
                                <button>Follow</button>
                            </div>
                            <div class="post-content">
                            <video autoplay muted controls loop disablepictureinpicture controlslist="nodownload noplaybackrate">
                                    <source src="<?php echo $rows["product_video"]; ?>" type="video/mp4">
                                </video>
                                <div class="video-icons">
                                    <a href="#"><i class="fas fa-heart fa-lg"></i><span>1.6K</span></a>
                                    <a href="#commentModal<?php echo $rows['product_id']; ?> "onclick="document.getElementById('commentModal<?php echo $rows['product_id']; ?>').style.display='block'"><i class="fas fa-comment-dots fa-lg"></i><span>423</span></a>
                                    <!-- The Modal -->
                                    <div id="commentModal<?php echo $rows['product_id']; ?>" class="modal">

                                    <!-- Modal content -->
                                        <div class="modal-content">
                                            <span class="close" onclick="document.getElementById('commentModal<?php echo $rows['product_id']; ?>').style.display='none'">&times;</span>
                                            <div class="comments"> </div>
                                            <?php 

                                                $post_id = $rows['product_id'];
                                                // Check if the post has any comments
                                                $sql = "SELECT * FROM social_media_comments WHERE product_id = '$post_id'";
                                                $result = mysqli_query($conn, $sql);

                                                // Display comments
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $comment_text = $row['comment_text'];
                                                        $user_id = $row['user_id'];
                                                        $comment_timestamp = $row['comment_timestamp'];

                                                        // Retrieve the username of the commenter from the users table
                                                        $sql_user = "SELECT username FROM users WHERE user_id = '$user_id'";
                                                        $result_user = mysqli_query($conn, $sql_user);
                                                        $row_user = mysqli_fetch_assoc($result_user);
                                                        $username = $row_user['username'];

                                                        // Display the comment
                                                        echo '<div class="comments" id="comments_' . $post_id . '_' . $comment_timestamp . '">';
                                                        echo '<p><strong>' . $username . '</strong> said on ' . $comment_timestamp . '</p>';
                                                        echo '<p id="comment">' . $comment_text . '</p>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo '<p>No comments yet. Be the first to leave a comment!</p>';
                                                }
                                                ?>
                                            
                                            <script>
                                            // Update the comments every 5 seconds
                                            setInterval(function() {
                                                // Get the post ID from the comments div
                                                var postId = $('.comments').data('post-id');

                                                // Make an AJAX request to load the latest comments
                                                $.ajax({
                                                    url: 'trending.php',
                                                    type: 'POST',
                                                    data: { post_id: postId },
                                                    dataType: '',
                                                    success: function(comments) {
                                                        // Check if there are any new comments
                                                        var latestCommentTimestamp = $('.comments').first().data('comment-timestamp');
                                                        var newComments = [];

                                                        for (var i = 0; i < comments.length; i++) {
                                                            if (comments[i].comment_timestamp > latestCommentTimestamp) {
                                                                newComments.push(comments[i]);
                                                            }
                                                        }

                                                        // Add the new comments to the comments section
                                                        if (newComments.length > 0) {
                                                            for (var i = 0; i < newComments.length; i++) {
                                                                $('#comments').prepend('<div class="comments" data-post-id="' + postId + '" data-comment-timestamp="' + newComments[i].comment_timestamp + '"><p><strong>' + newComments[i].username + '</strong> said on ' + newComments[i].comment_timestamp + '</p><p id="comment">' + newComments[i].comment_text + '</p></div>');
                                                            }
                                                        }
                                                    },
                                                    error: function(xhr, status, error) {
                                                        // Handle errors
                                                        console.log(status);
                                                        console.log(error);
                                                    }
                                                });
                                            }, 1000);
                                        </script>

                                               

                                               
                                            <h3>Leave a comment</h3>
                                            <form id="myForm" class="commentForm">
                                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                                <label for="comment_text">Comment:</label>
                                                <textarea name="comment_text" id="comment_text"></textarea>
                                                <button type="submit">Submit</button>
                                            </form>

                                            <script>
                                            // Bind the function to the form submission
                                            $('.commentForm').submit(function (e) {
                                                e.preventDefault();
                                                var postId = $(this).find('input[name="post_id"]').val(); // Get the post ID
                                                var commentText = $(this).find('textarea[name="comment_text"]').val(); // Get the comment text

                                                // Send an AJAX request to add the comment to the database
                                                $.ajax({
                                                    url: 'insert_comment.php',
                                                    type: 'POST',
                                                    data: { post_id: postId, comment_text: commentText }, // Send the post ID and comment text as data parameters
                                                    dataType: 'json', // Set the dataType to JSON
                                                    success: function (response) {
                                                        if (!response.error) {
                                                            // Clear the textarea by setting its value to an empty string
                                                            $('.commentForm textarea').val('');

                                                            if (response && response.username && response.comment_text) {
                                                                console.log('New comment added by ' + response.username + ': ' + response.comment_text);
                                                                
                                                            } else {
                                                                console.log('Error adding comment');
                                                            }
                                                        } else {
                                                            console.log(response.error);
                                                        }
                                                    },
                                                    error: function (xhr, status, error) {
                                                        // Handle errors
                                                        console.log(status);
                                                        console.log(error);
                                                    }
                                                });
                                            });
                                            </script>
                                            
                                               
                                                                                
                                            </div>
                                            
                                        
                                    </div>


                                    <a href="#myModal<?php echo $rows['product_id']; ?>" onclick="document.getElementById('myModal<?php echo $rows['product_id']; ?>').style.display='block'"><i class="fa-solid fa-cart-shopping"></i> <span>150</span></a>

                                        <!-- The Modal -->
                                        <div id="myModal<?php echo $rows['product_id']; ?>" class="modal">

                                            <!-- Modal content -->
                                            <div class="modal-content">
                                            <span class="close" onclick="document.getElementById('myModal<?php echo $rows['product_id']; ?>').style.display='none'">&times;</span>
                                            <div class="card">
                                            <div class="image">
                                                <p>The distance between the two points is <?php echo $rounded = round($distance , 2)?>  meters.</p>
                                                <img src="<?php echo $rows["product_image"]; ?>" alt="">
                                            </div>

                                            <div class="caption">
                                                <p class="rate">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </p>
                                                <p class="product_name"><?php echo $rows["product_name"];  ?></p>
                                                <p class="price"><b>$<?php echo $rows["price"]; ?></b></p>
                                                <p class="discount"><b><del>$<?php echo $rows["discount"]; ?></del></b></p>
                                            </div>
                                            <button class="add" data-id="<?php echo $rows["product_id"];  ?>">Add to cart</button>
                                        </div>
                                            
                                            </div>
                                                
                                        </div>
                                                
                                    <a href="#sharingModal<?php echo $rows['product_id']; ?>"><i class="fas fa-share fa-lg"></i> <span>150</span></a>
                                        


                                </div>
                            </div>
                             
                            
                            <?php
                    
                            }
                    
                    }
                } else {
                    echo "No locations found within the geofence.";
                }
                ?>
            
            
        </section>
        <script>
            var product_id = document.getElementsByClassName("add");
            for(var i = 0; i<product_id.length; i++){
                product_id[i].addEventListener("click",function(event){
                    var target = event.target;
                    var id = target.getAttribute("data-id");
                    var xml = new XMLHttpRequest();
                    xml.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            var data = JSON.parse(this.responseText);
                            target.innerHTML = data.in_cart;
                            document.getElementById("badge").innerHTML = data.num_cart + 1;
                        }
                    }

                    xml.open("GET","connection.php?id="+id,true);
                    xml.send();
                    
                })
            }

        </script>

