<?php
// modify_save.php — Save Name + Price changes
require_once('database.php');

$product_id  = filter_input(INPUT_POST, 'product_id',  FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$name        = filter_input(INPUT_POST, 'name');
$price       = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

if (!$product_id || !$category_id || !$name || $price === false) {
    $error = "Invalid data. Please check Name and Price.";
    include('error.php');
    exit;
}

try {
    $q = 'UPDATE products
          SET productName = :name,
              listPrice   = :price
          WHERE productID = :pid';
    $st = $db->prepare($q);
    $st->bindValue(':name',  $name);
    $st->bindValue(':price', $price);
    $st->bindValue(':pid',   $product_id, PDO::PARAM_INT);
    $st->execute();
    $st->closeCursor();
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
    include('error.php');
    exit;
}

// Go back to the product list for the same category
header("Location: index.php?category_id=" . (int)$category_id);
exit;
