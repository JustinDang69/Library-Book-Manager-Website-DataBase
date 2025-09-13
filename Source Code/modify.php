<?php
// modify.php — Edit Name and Price for a single product
require_once('database.php');

$product_id  = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

if (!$product_id || !$category_id) {
    $error = "Invalid request (missing product/category id).";
    include('error.php');
    exit;
}

// Load the product
$q = 'SELECT productID, productName, listPrice FROM products WHERE productID = :pid';
$st = $db->prepare($q);
$st->bindValue(':pid', $product_id, PDO::PARAM_INT);
$st->execute();
$product = $st->fetch();
$st->closeCursor();

if (!$product) {
    $error = "Product not found.";
    include('error.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Modify Book</title>
   <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<header><h1>Library Book Manager</h1></header>

<main>
  <h2>Modify Book</h2>

  <form action="modify_save.php" method="post" id="modify_form">
    <!-- keep track of which product and where to return -->
    <input type="hidden" name="product_id" value="<?php echo (int)$product['productID']; ?>">
    <input type="hidden" name="category_id" value="<?php echo (int)$category_id; ?>">

    <label>Name:</label> 
    <br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['productName']); ?>"><br><br>

    <label>Price:</label>
    <br>
    <input type="text" name="price" value="<?php echo htmlspecialchars(number_format((float)$product['listPrice'], 2, '.', '')); ?>"><br>
    <p class="left">
    <label>&nbsp;</label>
    <input type="submit" value="Modify Book"> 
    </p> <br>
  </form>

  <p class="last_paragraph">
    <a href="index.php?category_id=<?php echo (int)$category_id; ?>">View Book List</a>
  </p>
</main>

<footer><p>&copy; <?php echo date("Y"); ?> My Book Shop, Inc.</p></footer>
</body>
</html>
