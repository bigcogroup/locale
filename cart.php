<?php

require_once 'connection.php';



$sql_cart = "SELECT * FROM cart";
$all_cart = $conn->query($sql_cart);

?>

    <section>
        <span><?php echo mysqli_num_rows($all_cart); ?> Items</span>
        <hr>
        <?php
          while($row_cart = mysqli_fetch_assoc($all_cart)){
              $sql = "SELECT * FROM product WHERE product_id=".$row_cart["product_id"];
              $all_product = $conn->query($sql);
              while($row = mysqli_fetch_assoc($all_product)){
        ?>
        <div class="list-group">
            <div class="col-md-4">
            <img src="<?php echo $row["product_image"]; ?>" alt="Product Image" class="card-img">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["product_name"]; ?></h5>
                <p class="rate">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                </p>
                <p class="card-text">
                <b>Price:</b> $<?php echo $row["price"]; ?>
                </p>
                <p class="card-text">
                <b>Discount:</b> <del>$<?php echo $row["discount"]; ?></del>
                </p>
                <button class="btn btn-danger remove" data-id="<?php echo $row["product_id"]; ?>">Remove from Cart</button>
            </div>
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
        xmlhttp.onload = function() {
        // Remove the item from the cart
        var cartItem = document.getElementById('item-' + cartId);
        cartItem.parentNode.removeChild(cartItem);
        
        // Hide the button
        target.style.display = 'none';
        };
    </script>
