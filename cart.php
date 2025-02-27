<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - BakeWise</title>
    <link rel="stylesheet" href="styless.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
       :root {
    --pink: pink;
    --dark-gray: #333;
    --light-pink: #fff0f3;
    --primary-pink: #d2aab0;
    --hover-pink: #d699a2;
    --background: #fdf0f5;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    outline: none;
    border: none;
    text-decoration: none;
    transition: 0.2s linear;
}

html {
    font-size: 62.5%;
    scroll-behavior: smooth;
    overflow-x: hidden;
}

body {
    background-color: var(--background);
    color: var(--dark-gray);
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--primary-pink);
    padding: 15px 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

header .logo {
    font-size: 1.8rem;
    color: #fff;
    font-weight: bold;
}

header .btn {
    padding: 10px 15px;
    background-color: #fff;
    color: var(--primary-pink);
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

header .btn:hover {
    background-color: var(--hover-pink);
    color: #fff;
}

.cart-section {
    max-width: 900px;
    margin: 100px auto 50px;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    text-align: center;
}

.cart-section h1 {
    font-size: 2rem;
    color: var(--primary-pink);
}

#cart-container {
    margin-top: 20px;
}

.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    background-color: var(--light-pink);
    border-radius: 10px;
    margin-bottom: 10px;
}

.cart-item .item-details {
    text-align: left;
}

.cart-item .item-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cart-item input[type='number'] {
    width: 50px;
    padding: 5px;
    border: 1px solid var(--primary-pink);
    border-radius: 5px;
    text-align: center;
}

.remove-btn {
    padding: 5px 10px;
    background-color: var(--hover-pink);
    color: #fff;
    border-radius: 5px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: 0.3s;
}

.remove-btn:hover {
    background-color: var(--primary-pink);
}

#total-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--dark-gray);
    margin-top: 20px;
}

#checkout-btn {
    margin-top: 20px;
    padding: 12px 20px;
    background-color: var(--primary-pink);
    color: #fff;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: 0.3s;
    display: none;
}

#checkout-btn:hover {
    background-color: var(--hover-pink);
}

@media (max-width: 768px) {
    header {
        padding: 10px;
    }

    header .logo {
        font-size: 1.5rem;
    }

    .cart-section {
        margin-top: 80px;
    }
}

@media (max-width: 450px) {
    html {
        font-size: 50%;
    }

    .cart-item {
        flex-direction: column;
        text-align: center;
    }

    .cart-item .item-controls {
        margin-top: 10px;
    }
}

    </style>
</head>
<body>
    <header>
        <a href="#" class="logo">BakeWise<span>.</span></a>
        <a href="products.php" class="btn">Back to Products</a>
    </header>

    <section class="cart-section">
        <h1>Your Cart</h1>
        <div id="cart-container"></div>
        <h3 id="total-price"></h3>
        <button id="checkout-btn">Checkout</button>
    </section>

    <script>
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        function renderCart() {
            const cartContainer = document.getElementById("cart-container");
            const totalPriceEl = document.getElementById("total-price");
            cartContainer.innerHTML = "";

            if (cart.length === 0) {
                cartContainer.innerHTML = "<p>Your cart is empty.</p>";
                totalPriceEl.textContent = "";
                document.getElementById("checkout-btn").style.display = "none";
                return;
            }

            cart.forEach((item, index) => {
                const cartItem = document.createElement("div");
                cartItem.classList.add("cart-item");
                cartItem.innerHTML = `
                    <div class="item-details">
                        <h4>${item.name}</h4>
                        <p>Price: Rs.${item.price}</p>
                    </div>
                    <div class="item-controls">
                        <input type="number" value="${item.quantity}" min="1" data-index="${index}" />
                        <button class="remove-btn" data-index="${index}">Remove</button>
                    </div>
                `;
                cartContainer.appendChild(cartItem);
            });

            const totalPrice = cart.reduce((total, item) => total + item.price * item.quantity, 0);
            totalPriceEl.textContent = `Total: Rs.${totalPrice}`;
            document.getElementById("checkout-btn").style.display = "block";

            document.querySelectorAll(".remove-btn").forEach(button => {
                button.addEventListener("click", e => {
                    const index = e.target.dataset.index;
                    cart.splice(index, 1);
                    updateCart();
                });
            });

            document.querySelectorAll("input[type='number']").forEach(input => {
                input.addEventListener("change", e => {
                    const index = e.target.dataset.index;
                    const newQuantity = parseInt(e.target.value);
                    cart[index].quantity = newQuantity > 0 ? newQuantity : 1;
                    updateCart();
                });
            });
        }

        function updateCart() {
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCart();
        }

        renderCart();

        document.getElementById("checkout-btn").addEventListener("click", () => {
            alert("Proceeding to checkout...");
        });
        document.getElementById("checkout-btn").addEventListener("click", () => {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    fetch("checkout.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ cart: cart })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Order placed successfully!");
            localStorage.removeItem("cart"); 
            renderCart(); 
            window.location.href = "index.html"; 
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something went wrong!");
    });
});

    </script>
</body>
</html>
