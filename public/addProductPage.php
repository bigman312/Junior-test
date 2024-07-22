<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../conn/connection.php';
require_once __DIR__ . '/../Services/ProductService.php';

$connection = new Connection();
$conn = $connection->getConnection();
$productService = new ProductService($conn);

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $productType = $_POST['productType'];
    $additionalData = array_filter($_POST, function($key) {
        return !in_array($key, ['sku', 'name', 'price', 'productType']);
    }, ARRAY_FILTER_USE_KEY);

    try {
        $inserted = $productService->insertProduct($sku, $name, $price, $productType, $additionalData);

        if ($inserted) {
            header("Location: index.php");
            exit;
        } else {
            $errorMessage = 'Failed to insert the product. Please try again.';
        }
    } catch (Exception $e) {
        $errorMessage = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/addStyle.css"/>
    <script src="/backend/addScript.js" defer></script>
</head>
<body>
    <form id="product_form" method="post">
        <h1>Product Add</h1>
        <?php if (!empty($errorMessage)): ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <div class="form-group">
            <label for="sku">SKU:</label>
            <input type="text" id="sku" name="sku" placeholder="SKU" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Name Of Product" required>
        </div>
        <div class="form-group">
            <label for="price">Price ($):</label>
            <input type="number" step="0.01" id="price" name="price" min="0.00" placeholder="Price Of Product" required>
        </div>
        <div class="form-group">
            <label for="productType">Type Switcher:</label>
            <select id="productType" name="productType" required>
                <option value="" selected disabled>Choose Type</option>
                <option value="dvd">DVD</option>
                <option value="furniture">Furniture</option>
                <option value="book">Book</option>
            </select>
        </div>
        <div id="dynamic-fields">
            <div id="dvd" class="dynamic-field" style="display: none;">
                <div class="form-group">
                    <label for="size">Size (MB):</label>
                    <input type="number" id="size" name="size" placeholder="MB">
                </div>
            </div>
            <div id="furniture" class="dynamic-field" style="display: none;">
                <div class="form-group">
                    <label for="height">Height (CM):</label>
                    <input type="number" id="height" name="height" placeholder="CM">
                </div>
                <div class="form-group">
                    <label for="width">Width (CM):</label>
                    <input type="number" id="width" name="width" placeholder="CM">
                </div>
                <div class="form-group">
                    <label for="length">Length (CM):</label>
                    <input type="number" id="length" name="length" placeholder="CM">
                </div>
            </div>
            <div id="book" class="dynamic-field" style="display: none;">
                <div class="form-group">
                    <label for="weight">Weight (KG):</label>
                    <input type="number" step="0.01" id="weight" name="weight" placeholder="KG">
                </div>
            </div>
        </div>
        <div class="buttons">
            <button type="submit">Save</button>
            <button type="button" onclick="window.location.href='index.php'">Cancel</button>
        </div>
    </form>
    <footer class="endName">Scandiweb Test assignment</footer>
</body>
</html>
