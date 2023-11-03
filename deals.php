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


                    ?>
                    <div class="container">
                    <div class="row">
                        <?php while ($rows = mysqli_fetch_assoc($all_product)) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card">
                                <div class="share-button">
                                    <a href="talk-page.php?product_id=<?php echo $rows["product_id"]; ?>">
                                        <i class="fas fa-share text-light"></i>
                                    </a>
                                </div>
                                <p class="card-text" style="font-size: 0.70rem;">
                                        <?php echo $rounded = round($distance, 2) ?> meters away.
                                    </p>
                                <div class="image">
                                    <img src="<?php echo $rows["product_image"]; ?>" class="card-img-top" alt="Product Image" style="margin-bottom: 0.1rem; max-height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body" style="margin-top: 0.1rem; padding: 0.5rem;">
                                    <p class="card-title" style="font-size: 0.75rem; margin-bottom: 0.1rem; margin-top: 0.1rem;"><?php echo $rows["product_name"]; ?></p>
                                    <p class="price" style="font-size: 0.85rem; margin-bottom: 0.1rem;"><b>$<?php echo $rows["price"]; ?></b></p>
                                    <p class="discount" style="font-size: 0.65rem; margin-bottom: 0;"><b><del>$<?php echo $rows["discount"]; ?></del></b></p>
                                    <button class="btn btn-primary add" style="font-size: 0.75rem; margin-top: 0.1rem;" data-id="<?php echo $rows["product_id"]; ?>">Add to cart</button>
                                </div>

                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                    <!--
                    <div class="card">
                        <div class="image">
                            <p><?php echo $rounded = round($distance , 2)?>  meters away.</p>
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
                    -->
                    <?php
            
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