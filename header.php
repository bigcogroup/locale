<?php
  error_reporting(0); 
  require_once 'connection.php';

$sql_cart = "SELECT * FROM cart";
$all_cart = $conn->query($sql_cart);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body onload="getLocation()">

<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
    // create a cookie with the latitude and longitude values
    document.cookie = "latitude=" + position.coords.latitude + "; path=/";
    document.cookie = "longitude=" + position.coords.longitude + "; path=/";
    });
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

</script>
    <header class="bg-primary">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="home.php">
                    <img src="logo.png" alt="Logo" class="logo" width="150" height="40">
                </a>

                <ul class="navbar-nav mx-auto"> <!-- Use "mx-auto" to center align -->
                    <li class="nav-item">
                        <a class="nav-link" href="trending.php">Discover</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="layout.php">Layout</a>
                    </li>
                    
                </ul>

                <div class="user-info ml-auto">
                    <?php
                    if ($loggedIn) { // Check if the user is logged in
                        echo '<span class="username text-light">Username</span>';
                        echo '<div class="dropdown">';
                        echo '   <button class="btn btn-link text-light dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        echo '   </button>';
                        echo '   <div class="dropdown-menu" aria-labelledby="userDropdown">';
                        echo '       <a class="dropdown-item" href="my-account.php">My Account</a>';
                        echo '       <a class="dropdown-item" href="my-shop.php">My Shop</a>';
                        echo '       <a class="dropdown-item" href="my-orders.php">Orders</a>';
                        echo '       <a class="dropdown-item" href="logout.php">Logout</a>';
                        echo '   </div>';
                        echo '</div>';
                    } else {
                        echo '<a href="sign-up.php" class="btn btn-light">Sign In</a>';
                    }
                    ?>
                </div>
                <a href="cart.php" class="btn btn-primary">
                <i class="fas fa-shopping-cart"></i> Cart
                <span id="badge" class="badge badge-danger">
                    <?php echo mysqli_num_rows($all_cart); ?>
                </span>
                </a>
            </nav>
        </div>
    </header>
     <!--
     <header>

        <a class="navbar-brand" href="home.php">
                    <img src="assets/logo.png" alt="Logo" class="logo" width="150" height="40">
        </a>
         <div id="main_tabs" >
             <a href="trending.php">Discover</a>
             <a href="home.php">Deals</a>
             <a href="interests.php">Interests</a>
             <a href="courses.php">Courses</a>
             
         </div>
         <a href="cart.php">Cart <span id="badge"><?php echo mysqli_num_rows($all_cart);  ?></span></a>
     </header>
     -->
</body>
</html>

