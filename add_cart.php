<?php

require_once 'connection.php';

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];
    $sql = "SELECT * FROM cart WHERE product_id = $product_id";
    $result = $conn->query($sql);
    $total_cart = "SELECT * FROM cart";
    $total_cart_result = $conn->query($total_cart);
    $cart_num = mysqli_num_rows($total_cart_result);

    if (mysqli_num_rows($result) > 0) {
        $in_cart = "Already in cart";
        
        header('Content-Type: application/json');
        echo json_encode(["num_cart" => $cart_num, "in_cart" => $in_cart]);
    } else {
        $insert = "INSERT INTO cart (product_id) VALUES ($product_id)";
        if ($conn->query($insert) === true) {
            $in_cart = "Added to cart";

            header('Content-Type: application/json');
            echo json_encode(["num_cart" => $cart_num, "in_cart" => $in_cart]);
        } else {
            echo json_encode(["error" => "Failed to insert into cart"]);
        }
    }
}else{
    exit;
}

if (isset($_GET["cart_id"])) {
    $product_id = $_GET["cart_id"];
    $sql = "DELETE FROM cart WHERE product_id = " . $product_id;

    if ($conn->query($sql) === TRUE) {
        header('Content-Type: application/json');
        echo json_encode(["message" => "Removed from cart"]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Failed to remove from cart"]);
    }

}else{
    exit;
}
?>
