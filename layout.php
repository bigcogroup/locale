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

    <title><?php echo $pageTitle; ?></title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* ============ desktop view ============ */
    @media all and (min-width: 992px) {
        .dropdown-menu li{ position: relative; 	}
        .nav-item .submenu{ 
            display: none;
            position: absolute;
            left:100%; top:-7px;
        }
        .nav-item .submenu-left{ 
            right:100%; left:auto;
        }
        .dropdown-menu > li:hover{ background-color: #f1f1f1 }
        .dropdown-menu > li:hover > .submenu{ display: block; }
    }	
    /* ============ desktop view .end// ============ */

    /* ============ small devices ============ */
    @media (max-width: 991px) {
    .dropdown-menu .dropdown-menu{
        margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
    }
    }	
    /* ============ small devices .end// ============ */
    </style>


<script
      src="https://kit.fontawesome.com/1a015cf62c.js"
      crossorigin="anonymous"
    ></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
// make it as accordion for smaller screens
if (window.innerWidth < 992) {

  // close all inner dropdowns when parent is closed
  document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
    everydropdown.addEventListener('hidden.bs.dropdown', function () {
      // after dropdown is hidden, then find all submenus
        this.querySelectorAll('.submenu').forEach(function(everysubmenu){
          // hide every submenu as well
          everysubmenu.style.display = 'none';
        });
    })
  });

  document.querySelectorAll('.dropdown-menu a').forEach(function(element){
    element.addEventListener('click', function (e) {
        let nextEl = this.nextElementSibling;
        if(nextEl && nextEl.classList.contains('submenu')) {	
          // prevent opening link if link needs to open dropdown
          e.preventDefault();
          if(nextEl.style.display == 'block'){
            nextEl.style.display = 'none';
          } else {
            nextEl.style.display = 'block';
          }

        }
    });
  })
}
// end if innerWidth
}); 
// DOMContentLoaded  end

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
</head>
<body onload="getLocation()">

<p id="demo"></p>


    <div class="container-fluid">
        <div class="row">
            <!-- Fixed top header -->
            <header class="col-12">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                    <a class="navbar-brand" href="home.php">
                        <img src="logo.png" alt="Logo" class="logo" width="150" height="40">
                    </a>

                    <!-- Add the main navigation for larger screens -->
                    <ul class="navbar-nav mx-auto d-none d-lg-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="deals-page.php">Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="courses.php">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="interests.php">Interests</a>
                        </li>
                        <li>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-mdb-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li>
                                <a class="dropdown-item" href="#">Another action</a>
                                </li>
                                <li>
                                <a class="dropdown-item" href="#">
                                    Submenu &raquo;
                                </a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li>
                                    <a class="dropdown-item" href="#">Submenu item 1</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="#">Submenu item 2</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
                                    <ul class="dropdown-menu dropdown-submenu">
                                        <li>
                                        <a class="dropdown-item" href="#">Multi level 1</a>
                                        </li>
                                        <li>
                                        <a class="dropdown-item" href="#">Multi level 2</a>
                                        </li>
                                    </ul>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="#">Submenu item 4</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="#">Submenu item 5</a>
                                    </li>
                                </ul>
                                </li>
                            </ul>
                            </div>
                        </li>
                    </ul>

                    <!-- Replace the button with a dropdown on smaller screens -->
                    <div class="dropdown d-lg-none">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="mobileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu" aria-labelledby="mobileMenu">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item dropdown" id="myDropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  Treeview menu  </a>
                                <ul class="dropdown-menu">
                                    <li> <a class="dropdown-item" href="#"> Dropdown item 1 </a></li>
                                    <li> <a class="dropdown-item" href="#"> Dropdown item 2 &raquo; </a>
                                    <ul class="submenu dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Submenu item 1</a></li>
                                        <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
                                        <li><a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
                                        <ul class="submenu dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Multi level 1</a></li>
                                            <li><a class="dropdown-item" href="#">Multi level 2</a></li>
                                        </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
                                        <li><a class="dropdown-item" href="#">Submenu item 5</a></li>
                                    </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="#"> Dropdown item 3 </a></li>
                                    <li><a class="dropdown-item" href="#"> Dropdown item 4 </a></li>
                                </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="deals-page.php">Deals</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="courses.php">Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="interests.php">Interests</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                    <!--
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
                    
                    </div>
                   
                </nav>
            -->


                </div>
            </header>

            <nav id="sidebar" class="col-12 col-md-3 col-lg-2 d-md-block bg-light fixed-top">
            <style>
                main {
                    padding-top: 2.5rem; /* Adjust the value based on your fixed-top navbar height */
                }

                #sidebar.fixed-top {
                    top: 4rem; /* Adjust the padding value as needed */
                }
                
                @media (max-width: 768px) {
                    #sidebar {
                        width: 15%;
                    }
                   
                }
            </style>
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="discover.php">
                                <i class="fas fa-search d-md-none"></i> <!-- Hide text on smaller screens -->
                                <span class="d-none d-md-inline">Discover</span> <!-- Show text on medium and larger screens -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="community.php">
                                <i class="fas fa-users d-md-none"></i> <!-- Hide text on smaller screens -->
                                <span class="d-none d-md-inline">Community</span> <!-- Show text on medium and larger screens -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="talk.php">
                                <i class="fas fa-comments d-md-none"></i> <!-- Hide text on smaller screens -->
                                <span class="d-none d-md-inline">Chat</span> <!-- Show text on medium and larger screens -->
                            </a>
                        </li>
                        <!-- Add more links as needed -->
                    </ul>
                </div>
            </nav>

            <!-- Fixed sidebar that shrinks to icons on smaller screens -->
            <!-- Main content area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php include($pageContent); ?>
            </main>
        </div>
    </div>
     

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
<script>
    // Initialize Bootstrap dropdown
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>

</body>
</html>

