<?php

require_once 'connection.php';


if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Prepare and execute a query to fetch product details
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a product was found
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Return the product details as JSON
        header('Content-Type: application/json');
        echo json_encode($product);
    } else {
        // No product found with the given product_id
        http_response_code(404);
    }
}else{
    http_response_code(400);
}

?>