<?php
require_once('../private/initialize.php');

if (DatabaseObject::$logger) {
    $request_type = $_SERVER['REQUEST_METHOD'];
    $file_name = basename(__FILE__);
    DatabaseObject::$logger->info("Request: $request_type, File: $file_name");
}

$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

$product = Product::find_by_id($product_id);

    $product->productCode = $code;
    $product->productName = $name;
    $product->listPrice = $price;


if($product->save()){
    header("Location: index.php");
}else{
    echo "Product was not updated successfully!" . mysqli_error($connection);
}
 ?>