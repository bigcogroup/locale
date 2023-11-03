<?php
    error_reporting(0); 
    require_once 'connection.php';
    
$sql_cart = "SELECT * FROM cart";
$all_cart = $conn->query($sql_cart);

session_start();
$_SESSION['user_id'] = 1;
// Retrieve the post ID and user ID from the form data and session
$user_id = $_SESSION['user_id']; // or retrieve it from the form data if not stored in session



 
                                                  
                                                
?>




<!DOCTYPE html>
<html lang="en">
  <head>
  <header>
    
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle; ?></title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script
      src="https://kit.fontawesome.com/1a015cf62c.js"
      crossorigin="anonymous"
    ></script>
    
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
    <link rel="stylesheet" href="trending.css">
    <style>
        /* Add this CSS to your stylesheet */
        .share-button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px; /* Adjust the width and height as needed for your button size */
            height: 40px;
            background-color: #007bff; /* Background color for the button */
            color: #fff; /* Text color for the button */
            border-radius: 50%; /* Makes the button round */
            position: absolute;
            top: 10px; /* Adjust this value to change the vertical position */
            right: -15px; /* Adjust this value to change the horizontal position */
            cursor: pointer; /* Add pointer cursor for interactivity */
            font-size: 20px; /* Adjust the font size as needed */
        }

        .share-button:hover {
            background-color: #0056b3; /* Change background color on hover */
        }

        /* The Modal (background) */
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        }

        /* The Close Button */
        .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
        </style>
    
  </head>
  <body onload="getLocation()">


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                     <div class="d-flex mx-auto">
                        <a class="navbar-brand" href="trending.php">
                            <img src="logo.png" alt="Logo" class="logo">
                        </a>
                    </div>

                    <!-- Add the main navigation for larger screens -->
                    <div class="navbar-nav mx-auto d-none d-lg-flex">
                    <ul class="navbar-nav mx-auto d-none d-lg-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="deals-page.php">Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="courses-page.php">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="interests-page.php">Interests</a>
                        </li>
                        
                    </ul>
                
                            <?php
                            $loggedIn = true;
                            
                            if ($loggedIn) { // Check if the user is logged in
                                echo '<span class="username text-light">Username</span>';
                                echo '<div class="dropdown">';
                                echo '   <button class="btn btn-link text-dark dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                echo '       My Account'; // Add some text to the button
                                echo '   </button>';
                                echo '   <div class="dropdown-menu" aria-labelledby="userDropdown">';
                                echo '       <a class="dropdown-item" href="dashboard-page.php">Dashboard</a>';
                                echo '       <a class="dropdown-item" href="orders-page.php">Orders</a>';
                                echo '       <a class="dropdown-item" href="logout-page.php">Logout</a>';
                                echo '   </div>';
                                echo '</div>';
                            } else {
                                echo '<a href="sign-up.php" class="btn btn-light">Sign In</a>';
                            }
                            

                            ?>
                        
                        <a href="cart-page.php" class="btn btn-light">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="badge" class="badge badge-danger">
                            <?php echo mysqli_num_rows($all_cart); ?>
                        </span>
                        </a>
                    </div

                    <!-- Replace the button with a dropdown on smaller screens -->
                    
                    <div class="dropdown d-lg-none">
                    <a href="cart-page.php" class="btn btn-light">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="badge" class="badge badge-danger">
                                <?php echo mysqli_num_rows($all_cart); ?>
                            </span>
                        </a>
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="mobileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mobileMenu">

                        <ul class="navbar-nav mx-auto">
                            
                                <?php
                                $loggedIn = false;

                                if ($loggedIn) { // Check if the user is logged in
                                    echo '<li class="nav-item"><a class="nav-link text-center" href="dashboard-page.php">Dashboard</a></li>';
                                    echo '<li class="nav-item"><a class="nav-link text-center" href="orders-page.php">Orders</a></li>';
                                    echo '<li class="nav-item"><a class="nav-link text-center" href="logout-page.php">Logout</a></li>';

                                } else {
                                    echo '<li class="nav-item text-center">';
                                    echo '    <a href="sign-up-page.php" class="btn btn-info">Sign In</a>';
                                    echo '</li>';
                                }
                                ?>
                            <li class="nav-item">
                                <a class="nav-link text-center" href="deals-page.php">Deals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-center" href="courses-page.php">Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-center" href="interests-page.php">Interests</a>
                            </li>
                        </ul>

                        
                    </div>
                </div>

                </nav>


        <!--
        <div class="thehead">
        <header class="theheader">
            
            <h1><a class="home" href="home.php"><img style="width: 160px; height: 50px;" src="logo.png" alt=""></a></h1>
            <div class="main_tabs" >
            <a href="home.php">Deals</a>
                <a href="courses.php">Courses</a>
                <a href="interests.php">Interests</a>
            </div>
            <a href="cart.php">Cart <span id="badge"><?php echo mysqli_num_rows($all_cart);  ?></span></a>

        </header>
        </div>
        -->
    
    
    
    <main>
        <div class="left">
            <div class="btns">
                <a href="discover-page.php"><i class="fas fa-map-marked"></i> <span>Discover</span></a>
                <a href="community-page.php"><i class="fas fa-user-friends"></i> <span>Community</span></a>
                <a href="talk-page.php"><i class="fas fa-comments"></i> <span>Chat</span></a>
              </div>
            <div class="accounts">
                <p>Popular Users</p>
                <div class="user">
                    <img src="assets/Cat.png" alt="avatar">
                    <h6 class="username">Cheshire_Cat</h6>
                </div>
                <div class="user">
                    <img src="assets/Frankenstein.png" alt="avatar">
                    <h6 class="username">Frank</h6>
                </div>
                <div class="user">
                    <img src="assets/Pirate.png" alt="avatar">
                    <h6 class="username">Pirate</h6>
                </div>
                <div class="user">
                    <img src="assets/Gypsy.png" alt="avatar">
                    <h6 class="username">Gypsy</h6>
                </div>
            </div>
            <div class="tags">
                <p>Trends</p>
                <div>
                    <a href="#">#</a>
                    <a href="#"># summeressentials</a>
                    <a href="#"># music</a>
                    <a href="#"># memories</a>
                    <a href="#"># whoisbetter</a>
                    <a href="#">#</a>
                    <a href="#"># summeressentials</a>
                    <a href="#"># music</a>
                    <a href="#"># memories</a>
                    <a href="#"># whoisbetter</a>
                </div>
            </div>
            <div class="links">
                <div>
                    <div class="link">
                        <a href="#">About</a>
                        
                    </div>
                    <div class="copyright">
                        <h6></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="right">
         <?php include($pageContent); ?>

    </main>
    <script src="trending.js"></script>
  
  </body>
</html>
