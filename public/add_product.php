<?php
require_once('../private/initialize.php');

if (DatabaseObject::$logger) {
    $request_type = $_SERVER['REQUEST_METHOD'];
    $file_name = basename(__FILE__);
    DatabaseObject::$logger->info("Request: $request_type, File: $file_name");
}

// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

// Validate inputs
if ($category_id == null || $category_id == false ||
        $code == null || $name == null || $price == null || $price == false) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('../private/initialize.php');

    // Add the product to the database  


    
    $product = new Product();
    $product->categoryID = $category_id;
    $product->productCode = $code;
    $product->productName = $name;
    $product->listPrice = $price;


    // Display the Product List page
    if($product->save()){
        header("Location: index.php");
    }else{
        echo "Product was not added successfully!" . mysqli_error($connection);
    }
}
?>