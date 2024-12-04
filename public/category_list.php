<?php

require_once('../private/initialize.php');

if (DatabaseObject::$logger) {
    $request_type = $_SERVER['REQUEST_METHOD'];
    $file_name = basename(__FILE__);
    DatabaseObject::$logger->info("Request: $request_type, File: $file_name");
}

// Get all categories

$categories = Category::find_all();
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
    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        
        <!-- add code for the rest of the table here -->
        <?php 
        foreach ($categories as $category) : 
        echo "<tr><td>" . $category->categoryName . "</td></tr>";
        endforeach; ?>
    
    </table>

    <h2>Add Category</h2>
    
    <!-- add new category  -->
     <form method="post">
        <label for="categoryName">Category Name: </label>
        <input id="categoryName" type="text" name="categoryName">
        <button type="submit">Submit</button>
     </form>
     
     <?php
     
     //add new category name to database
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $categoryName = filter_input(INPUT_POST, 'categoryName');
     //$query = "INSERT INTO categories(categoryName) VALUES('$categoryName')";
     if(empty($categoryName)){
        echo "categoryName cannot be empty!";
     }else {
     //$result = mysqli_query($connection, $query);
     $category = new Category();
     $category->categoryName = $categoryName;

     if($category->save()) {
        echo "New category has been added successfully!";
     }else {
        echo "Category was not added successfully" . mysqli_error($connection);
     }
    }
    }
     ?>
    
    <br>
    <p><a href="index.php">List Products</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>