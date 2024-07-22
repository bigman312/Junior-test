<?php
// Showing data from the database and handling delete functionality
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../conn/connection.php';
require_once __DIR__ . '/../services/ProductService.php';

$connection = new Connection();
$conn = $connection->getConnection();

if (!$conn) {
    die("Failed to connect to the database.");
}

$productService = new ProductService($conn);

// Fetch data from the products table
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'fetch_products') {
    $products = $productService->getAllProducts();
    echo json_encode($products);
    exit();
}

// Handle delete functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];
    $productService->deleteProducts($delete_ids);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/listStyle.css"/>
</head>
<body>
    <div class="headerContainer">
        <h1>Product List</h1>
        <div class="button-group">
            <a href="addProductPage.php" class="link">
                <button type="button" class="btn">ADD</button>
            </a>
            <button type="submit" form="product-form" id="delete-product-btn" class="btn">MASS DELETE</button>
        </div>
    </div>
    <form id="product-form" method="POST">
        <div class="container" id="product-container">
            <!-- Products will be dynamically inserted here -->
        </div>
    </form>
    <footer class="endName">Scandiweb Test assignment</footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/?action=fetch_products')
                .then(response => response.json())
                .then(products => {
                    const container = document.getElementById('product-container');
                    products.forEach(product => {
                        const productElement = document.createElement('div');
                        productElement.innerHTML = `
                            <input type="checkbox" class="delete-checkbox" name="delete_ids[]" value="${product.id}">
                            <span>${product.name}</span>
                        `;
                        container.appendChild(productElement);
                    });
                });
        });
    </script>
</body>
</html>
