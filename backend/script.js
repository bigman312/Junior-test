document.addEventListener('DOMContentLoaded', function() {
    fetchProducts();

    async function fetchProducts() {
        try {
            const response = await fetch('index.php?action=fetch_products');
            const products = await response.json();
            displayProducts(products);
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    }

    function displayProducts(products) {
        const productContainer = document.getElementById('product-container');
        productContainer.innerHTML = ''; // Clear existing content

        products.forEach(product => {
            const productBox = document.createElement('div');
            productBox.classList.add('box');

            productBox.innerHTML = `
                <p>${product.sku}</p>
                <p>${product.name}</p>
                <p>${product.price} $</p>
                ${product.type === 'book' && product.weight ? `<p>Weight: ${product.weight} KG</p>` : ''}
                ${product.type === 'furniture' && product.height && product.width && product.length ? `<p>Dimension: ${product.height}x${product.width}x${product.length}</p>` : ''}
                ${product.type === 'dvd' && product.size_mb ? `<p>Size: ${product.size_mb} MB</p>` : ''}
                <input type="checkbox" class="delete-checkbox" name="delete_ids[]" value="${product.id}">
            `;

            productContainer.appendChild(productBox);
        });
    }
});
