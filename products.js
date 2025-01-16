// script.js
document.addEventListener("DOMContentLoaded", () => {
    // Get the product ID from the URL
    const params = new URLSearchParams(window.location.search);
    const productId = params.get("id");

    
    const products = {
        1: { name: "Brownie", price: 150, image: "images/brownie.jpg", description: "Delicious chocolate brownie." },
        2: { name: "Lemon Cookie", price: 100, image: "images/lemon.jpg", description: "Zesty lemon cookie." },
        3: { name: "Banana Bread", price: 120, image: "images/banana.jpg", description: "Moist banana bread." },
        4: { name: "Plain Bread", price: 90, image: "images/pbread.jpg", description: "Soft plain bread." },
        5: { name: "Chocolate Chip Cookie", price: 90, image: "images/cookie.jpg", description: "Crunchy chocolate chip cookie." },
    };

    // Find the product using the ID
    const product = products[productId];

    if (product) {
        // Fill the details page with product info
        document.getElementById("product-name").textContent = product.name;
        document.getElementById("product-price").textContent = product.price;
        document.getElementById("product-image").src = product.image;
        document.getElementById("product-description").textContent = product.description;

        // Add to cart button
        document.getElementById("add-to-cart").addEventListener("click", () => {
            const quantity = document.getElementById("quantity").value;
            alert(`${product.name} (x${quantity}) added to cart!`);
        });
    } else {
        // Show an error if product not found
        document.getElementById("product-details").innerHTML = "<p>Product not found.</p>";
    }
    
    
});
