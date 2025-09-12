<?php
// sort_desc.php — list products in the chosen category by productName DESC (Z→A)
require_once('database.php');

// Read category_id; default to 1
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if ($category_id === null || $category_id === false) {
    $category_id = 1;
}

// Get selected category
$qCat = 'SELECT * FROM categories WHERE categoryID = :category_id';
$s1 = $db->prepare($qCat);
$s1->bindValue(':category_id', $category_id, PDO::PARAM_INT);
$s1->execute();
$category = $s1->fetch();
$category_name = $category ? $category['categoryName'] : 'Category';
$s1->closeCursor();

// Get all categories (optional)
$qAllCats = 'SELECT * FROM categories ORDER BY categoryID';
$s2 = $db->prepare($qAllCats);
$s2->execute();
$categories = $s2->fetchAll();
$s2->closeCursor();

// Get products sorted by name DESC
$qProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productName DESC';
$s3 = $db->prepare($qProducts);
$s3->bindValue(':category_id', $category_id, PDO::PARAM_INT);
$s3->execute();
$products = $s3->fetchAll();
$s3->closeCursor();
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sort Descending — <?php echo htmlspecialchars($category_name); ?></title>
  <link rel="stylesheet" href="main.css">
</head>
<body>
<header><h1>Library Book Manager</h1></header>

<main>
  <h1>Book List</h1>
  <aside>
    <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>        
  </aside>
  <section>
        <h2><?php echo htmlspecialchars($category_name); ?> </h2>

        

        <table>
        <tr>
            <th>Name</th>
            <th class="right">Price</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            
            <td><?php echo htmlspecialchars($product['productName']); ?></td>
            <td class="right">$<?php echo number_format($product['listPrice'], 2); ?></td>

            <td><form action="delete_product.php" method="post">
                        <input type="hidden" name="product_id"
                            value="<?php echo $product['productID']; ?>">
                        <input type="hidden" name="category_id"
                            value="<?php echo $product['categoryID']; ?>">
                        <input type="submit" value="Delete">
            </form></td>

            <td><form action="modify.php" method="post">
                            <input type="hidden" name="product_id"
                                value="<?php echo $product['productID']; ?>">
                            <input type="hidden" name="category_id"
                                value="<?php echo $product['categoryID']; ?>">
                            <input type="submit" value="Modify">
                        </form></td>
        </tr>
        <?php endforeach; ?>
        </table>

        <p style="margin-top:1em;">
        <a href="add_product_form.php?category_id=<?php echo $category_id; ?>">Add book </a> <br><br>
        <a href="index.php?category_id=<?php echo $category_id; ?>">View Book List</a> 
        
        </p>
  </section>
</main>

<footer><p>&copy; <?php echo date("Y"); ?> My Book Shop, Inc.</p></footer>
</body>
</html>
