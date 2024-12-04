<?php

require_once('../private/initialize.php');

if (DatabaseObject::$logger) {
    $request_type = $_SERVER['REQUEST_METHOD'];
    $file_name = basename(__FILE__);
    DatabaseObject::$logger->info("Request: $request_type, File: $file_name");
}


// Get IDs
$product_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if($product_id && $category_id) {
    $product = Product::find_by_id($product_id);

//$query = "DELETE FROM products WHERE productID = $product_id AND categoryID = $category_id";
//$result = mysqli_query($connection, $query);


// Display the Product List page
if($product->delete()) {
    header("Location: index.php");
}else {
    echo "Delete failed." . mysqli_error($connection);
}
}
