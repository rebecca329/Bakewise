document.querySelectorAll(".cart-btn").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault();

        const id = this.dataset.id;
        const name = this.dataset.name;
        const price = parseFloat(this.dataset.price);

        fetch("add_to_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `product_id=${id}&product_name=${encodeURIComponent(name)}&product_price=${price}`
        })
        .then(response => {
            if (response.ok) {
                alert(`${name} has been added to your cart!`);
            } else {
                alert("Failed to add item to cart.");
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
