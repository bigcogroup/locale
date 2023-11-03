<?php 
require_once 'connection.php';

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

<!-- The sliding cart menu -->

            
            <div id="cartMenu" class="cart-menu">
            <div class="cart-content">
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

            <script>
                var remove = document.getElementsByClassName("remove");
                for(var i = 0; i<remove.length; i++){
                    remove[i].addEventListener("click",function(event){
                        var target = event.target;
                        var cart_id = target.getAttribute("data-id");
                        var xml = new XMLHttpRequest();
                        xml.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                            target.innerHTML = this.responseText;
                            target.style.opacity = .3;
                            }
                        }

                        xml.open("GET","connection.php?cart_id="+cart_id,true);
                        xml.send();
                    })
                }
            </script>
            </div>
            <a href="#" id="closeCart" class="close-cart">Close Cart</a>
            </div>
        
        <script src="script.js"></script>