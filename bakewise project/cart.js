document.querySelectorAll('.cart-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const productId = this.getAttribute('data-id');
        const productName = this.getAttribute('data-name');
        const productPrice = this.getAttribute('data-price');
        const productQuantity = 1; // Default quantity

        // Send data to server
        fetch('cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                product_id: productId,
                product_name: productName,
                product_price: productPrice,
                product_quantity: productQuantity,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
