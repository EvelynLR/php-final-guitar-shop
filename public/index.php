<?php

require_once('../private/initialize.php');

if (DatabaseObject::$logger) {
    $request_type = $_SERVER['REQUEST_METHOD'];
    $file_name = basename(__FILE__);
    DatabaseObject::$logger->info("Request: $request_type, File: $file_name");
}


// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}




// Get name for selected category

$category = Category::find_by_id($category_id);
if ($category) {
    $category_name = $category->categoryName;  // 获取 categoryName
} else {
    // 处理未找到的情况
    echo "Category not found.";
}


// Get all categories

$categories = Category::find_all();




// Get products for selected category
$products = Product::find_by_sql("SELECT * FROM products WHERE categoryID = $category_id");


?>


<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Product Manager</h1></header>

<main>
    <h1>Product List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category->id; ?>">
                    <?php echo $category->categoryName; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>

            </tr>

            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product->productCode; ?></td>
                <td><?php echo $product->productName; ?></td>
                <td class="right"><?php echo $product->listPrice; ?></td>
                <td><form action="delete_product.php" method="post">
                    <input type="hidden" name="id"
                           value="<?php echo $product->id; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $product->categoryID; ?>">
                    <input type="submit" value="Delete">
                </form></td>
                <td><form action="edit_product_form.php" method="post">
                    <input type="hidden" name="product_id"
                           value="<?php echo $product->id; ?>">
                    <input type="submit" value="Edit">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_product_form.php?category_id=<?php echo $category_id; ?>">Add Product</a></p>
        <p><a href="category_list.php">List Categories</a></p>        
    </section>
</main>
<footer>
    <?php
    use GuzzleHttp\Client;
    $client = new Client();
    $response = $client->request('GET', 'https://binaryjazz.us/wp-json/genrenator/v1/genre/');
    $string = $response->getBody()->getContents();
    $json = json_decode($string);
    ?>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    <br />
    <P>Starting a band and not sure what kind of music to play? Try <?php echo $json; ?>!</P>
</footer>
</body>
</html> 