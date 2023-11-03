<?php
require_once 'connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$sql_cart = "SELECT * FROM cart";
$all_cart = $conn->query($sql_cart);

?>
<style>

        /* Style the cart menu container */
        .cart-menu {
            width: 0;
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            background-color: #f4f4f4;
            overflow-x: hidden;
            transition: 0.5s;
        }

        /* Style each item within the cart */
        .cart-menu section {
            padding: 20px;
        }

        .cart-menu h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .cart-menu hr {
            border-top: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .cart-menu .card {
            display: flex;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 10px;
        }

        .cart-menu .images {
            flex: 30%;
        }

        .cart-menu img {
            width: 100%;
            height: auto;
        }

        .cart-menu .caption {
            flex: 70%;
            padding-left: 10px;
        }

        .cart-menu .rate {
            color: #ffd700; /* Gold color for stars */
        }

        .cart-menu .product_name {
            font-size: 16px;
            margin: 5px 0;
        }

        .cart-menu .price {
            font-size: 18px;
            color: #333;
        }

        .cart-menu .discount {
            font-size: 14px;
            color: #999;
            text-decoration: line-through;
        }

        .cart-menu .remove {
            background-color: #ff6b6b; /* Red color for remove button */
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
        }

        .cart-menu .remove:hover {
            background-color: #e53935; /* Darker red color on hover */
        }

        .cart-content {
            padding: 20px;
        }

        .cart-item {
            margin-bottom: 10px;
        }

        .close-cart {
            display: block;
            padding: 10px 20px;
            text-align: center;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .close-cart:hover {
            background-color: #555;
        }

</style>
<!--
            <section>
                <h1><?php echo mysqli_num_rows($all_cart); ?> Items</h1>
                <hr>
                <?php
                while($row_cart = mysqli_fetch_assoc($all_cart)){
                    $sql = "SELECT * FROM product WHERE product_id=".$row_cart["product_id"];
                    $all_product = $conn->query($sql);
                    while($row = mysqli_fetch_assoc($all_product)){
                ?>
                <div class="card">
                    <div class="images">
                        <img src="<?php echo $row["product_image"]; ?>" alt="">
                    </div>

                    <div class="caption">
                        <p class="rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </p>
                        <p class="product_name"><?php echo $row["product_name"]; ?></p>
                        <p class="price"><b>$<?php echo $row["price"]; ?></b></p>
                        <p class="discount"><b><del>$<?php echo $row["discount"]; ?></del></b></p>
                        <button class="remove" data-id="<?php echo $row["product_id"]; ?>">Remove from Cart</button>
                    </div>
                </div>
                <?php

                }
                }
            ?>
            </section>
            -->

<?php

 while($row_cart = mysqli_fetch_assoc($all_cart)){
      $sql = "SELECT * FROM product WHERE product_id=".$row_cart["product_id"];
      $all_product = $conn->query($sql);
      while($row = mysqli_fetch_assoc($all_product)){ 
                // Output cart item HTML dynamically
                echo '<div class="card">';
                echo '<div class="images">';
                echo '<img src="' . $row["product_image"] . '" alt="">';
                echo '</div>';

                echo '<div class="caption">';
                echo '<p class="rate">';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '</p>';
                echo '<p class="product_name">' . $row["product_name"] . '</p>';

                echo '<p class="price"><b>' . $row["price"] . '</b></p>';
                echo '<p class="discount"><b><del>' . $row["discount"] . '</del></b></p>';
                echo '<button class="remove" data-id="' . $row["product_id"] . '">Remove from Cart</button>';
                echo '</div>';
                echo '</div>';
                
                }
            }
            

/*
// Execute SQL query to retrieve cart items (replace with your query)
        $sql = "SELECT * FROM product WHERE product_id=" . $row_cart["product_id"];
        $result = $conn->query($sql);

        // Output cart items dynamically
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Output cart item HTML dynamically
                echo '<div class="card">';
                echo '<div class="images">';
                echo '<img src="' . $row["product_image"] . '" alt="">';
                echo '</div>';

                echo '<div class="caption">';
                echo '<p class="rate">';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '<i class="fas fa-star"></i>';
                echo '</p>';
                echo '<p class="product_name">' . $row["product_name"] . '</p>';

                echo '<p class="price"><b>' . $row["price"] . '</b></p>';
                echo '<p class="discount"><b><del>' . $row["discount"] . '</del></b></p>';
                echo '<button class="remove" data-id="' . $row["product_id"] . '">Remove from Cart</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        */
        echo "working";
        ?>