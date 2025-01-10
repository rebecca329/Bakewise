
    const cartBtns = document.querySelectorAll(".cart-btn");

    cartBtns.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent navigation to another page

            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);

            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            // Check if the product is already in the cart
            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += 1; // Increment quantity
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }

            localStorage.setItem("cart", JSON.stringify(cart));

            alert(`${name} has been added to your cart!`);
        });
    });

