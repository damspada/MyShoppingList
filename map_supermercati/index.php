<?php
// Database connection details
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "msl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            float: left;
        }
        .card img {
            max-width: 100%;
            height: auto;
        }
        .shopping-cart {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            float: right;
        }
        .shopping-cart ul {
            list-style-type: none;
            padding: 0;
        }
        .shopping-cart li {
            margin-bottom: 10px;
        }
        .quantity {
            display: flex;
            align-items: center;
        }
        .quantity input {
            width: 30px;
            text-align: center;
        }
        .quantity button {
            margin: 0 5px;
        }
    </style>
</head>
<body>

<h2>Product Catalog</h2>

<?php
// Check if there are products
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="card">
            <?php if (!empty($row["image"])) { ?>
                <img src="<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>">
            <?php } ?>
            <h3><?php echo $row["name"]; ?></h3>
            <p><strong>Category:</strong> <?php echo $row["category"]; ?></p>
            <p><strong>Description:</strong> <?php echo $row["description"]; ?></p>
            <p><strong>Nutrients:</strong> <?php echo $row["nutrients"]; ?></p>
            <p><strong>Health Rating:</strong> <?php echo $row["health"]; ?>/10</p>
            <div class="quantity">
                <button onclick="decreaseQuantity('<?php echo $row["name"]; ?>')">-</button>
                <input type="number" id="<?php echo $row["name"]; ?>" value="1" min="1">
                <button onclick="increaseQuantity('<?php echo $row["name"]; ?>')">+</button>
            </div>
            <button onclick="addToCart('<?php echo $row["name"]; ?>')">Add to Cart</button>
        </div>
        <?php
    }
} else {
    echo "0 products found.";
}
?>

<div class="shopping-cart">
    <h3>Shopping Cart</h3>
    <ul id="cart-list"></ul>
    <button onclick="checkout()">Checkout</button>
</div>

<script>
    function addToCart(productName) {
        var cartList = document.getElementById("cart-list");
        var listItem = null;
        var quantityInput = document.getElementById(productName);
        var quantity = parseInt(quantityInput.value);

        // Check if the product is already in the cart
        var existingItem = document.querySelector("#cart-list li[data-product='" + productName + "']");
        if (existingItem) {
            listItem = existingItem;
            quantity += parseInt(existingItem.dataset.quantity);
        } else {
            listItem = document.createElement("li");
            listItem.dataset.product = productName;
        }

        quantityInput.value = quantity;
        listItem.innerText = productName + " (Quantity: " + quantity + ")";
        listItem.dataset.quantity = quantity;
        cartList.appendChild(listItem);
    }

    function increaseQuantity(productName) {
        var quantityInput = document.getElementById(productName);
        var quantity = parseInt(quantityInput.value);
        quantityInput.value = quantity + 1;
    }

    function decreaseQuantity(productName) {
        var quantityInput = document.getElementById(productName);
        var quantity = parseInt(quantityInput.value);
        if (quantity > 0) {
            quantityInput.value = quantity - 1;
        }
    }

    function viewCart() {
        // Redirect to the cart page
        window.location.href = "cart.php";
    }

    // NEW CODE 

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Function to get a cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Function to save cart to cookie
    function saveCartToCookie(cart) {
        setCookie("shopping_cart", JSON.stringify(cart), 30);
    }

    // Function to load cart from cookie
    function loadCartFromCookie() {
        var cart = getCookie("shopping_cart");
        return cart ? JSON.parse(cart) : [];
    }

    // Function to update the cart display
    function updateCartDisplay() {
        var cartList = document.getElementById("cart-list");
        cartList.innerHTML = ""; // Clear existing items

        var cart = loadCartFromCookie();

        cart.forEach(function(item) {
            var listItem = document.createElement("li");
            listItem.innerText = item.productName + " (Quantity: " + item.quantity + ")";
            cartList.appendChild(listItem);
        });
    }

    // Function to add a product to the cart
    function addToCart(productName) {
        var cart = loadCartFromCookie();

        var existingItemIndex = cart.findIndex(function(item) {
            return item.productName === productName;
        });

        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity++;
        } else {
            cart.push({ productName: productName, quantity: 1 });
        }

        saveCartToCookie(cart);
        updateCartDisplay();
    }

    // Function to handle checkout
    function checkout() {
        // Implement checkout functionality here
    }

    // Load cart on page load
    window.onload = function() {
        updateCartDisplay();
    };

</script>

</body>
</html>