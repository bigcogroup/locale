<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>chatDeals</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/1a015cf62c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="test.css">

</head>
<body onload="getLocation()">

    <!-- Your JavaScript code here -->

    <?php
    include 'header.php';
    ?>

    <main class="container">
    <div class="row">
        <!-- Left Column (Sidebar) -->
        <div class="left">
            <div class="btns">
                <a href=""><i class="fas fa-map-marked"></i> <span>Discover</span></a>
                <a href="#"><i class="fas fa-user-friends"></i> <span>Community</span></a>
                <a href="#"><i class="fas fa-comments"></i> <span>Chat</span></a>
            </div>
            <div class="login">
                <p></p>
                <button></button>
            </div>
            <div class="accounts">
                <p>Popular Users</p>
                <div class="user">
                    <img src="assets/Cat.png" alt="avatar" class="img-fluid">
                    <h6 class="username">Cheshire_Cat</h6>
                </div>
                <div class="user">
                    <img src="assets/Frankenstein.png" alt="avatar" class="img-fluid">
                    <h6 class="username">Frank</h6>
                </div>
                <div class="user">
                    <img src="assets/Pirate.png" alt="avatar" class="img-fluid">
                    <h6 class="username">Pirate</h6>
                </div>
                <div class="user">
                    <img src="assets/Gypsy.png" alt="avatar" class="img-fluid">
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
                </div>
            </div>
        </div>

        <!-- Right Column (Main Content) -->
        <div class="col-md-9 right">
            <!-- Your dynamic content here -->
        </div>
    </div>
</main>


    <script src="trending.js"></script>
</body>
</html>
