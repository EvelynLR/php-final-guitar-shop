<?php
require('../private/initialize.php');

if (DatabaseObject::$logger) {
    $request_type = $_SERVER['REQUEST_METHOD'];
    $file_name = basename(__FILE__);
    DatabaseObject::$logger->info("Request: $request_type, File: $file_name");
}


$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);


$product = Product::find_by_id($product_id);



?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Product Manager</h1></header>

    <main>

        <h1>Edit Product</h1>
        <form action="edit_product.php" method="post"
              id="add_product_form">

            
            <input type="hidden" name="product_id" value="<?php echo $product->id ? htmlspecialchars($product->id) : ''; ?>"><br>


            <label>Code:</label>
            <input type="text" name="code" value="<?php echo $product->productCode ? htmlspecialchars($product->productCode) : ''; ?>"><br>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $product->productName ? htmlspecialchars($product->productName) : ''; ?>"><br>

            <label>List Price:</label>
            <input type="number" name="price" value="<?php echo $product->listPrice ? htmlspecialchars($product->listPrice) : ''; ?>"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Product"><br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>