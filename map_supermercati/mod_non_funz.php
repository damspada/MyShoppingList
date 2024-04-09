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

// Check if the user has a cart cookie
if (!isset($_COOKIE['cart'])) {
    // Create an empty cart array
    $cart = array();
} else {
    // Retrieve the cart array from the cookie
    $cart = json_decode($_COOKIE['cart'], true);
}

// Check if the user added a product to the cart
if (isset($_POST['product'])) {
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];

    // Add the product to the cart array
    $cart[$product] = $quantity;

    // Store the updated cart array in the cookie
    setcookie('cart', json_encode($cart), time() + (86400 * 30), '/'); // Cookie expires in 30 days
}

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
            <form method="post">
                <div class="quantity">
                    <button onclick="decreaseQuantity('<?php echo $row["name"]; ?>')">-</button>
                    <input type="number" name="quantity" id="<?php echo $row["name"]; ?>" value="1" min="1">
                    <button onclick="increaseQuantity('<?php echo $row["name"]; ?>')">+</button>
                </div>
                <input type="hidden" name="product" value="<?php echo $row["name"]; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <?php
    }
} else {
    echo "0 products found.";
}
?>

<div class="shopping-cart">
    <h3>Shopping Cart</h3>
    <ul id="cart-list">
        <?php
        // Display the items in the cart
        foreach ($cart as $product => $quantity) {
            echo "<li data-product='$product' data-quantity='$quantity'>$product (Quantity: $quantity)</li>";
        }
        ?>
    </ul>
    <button onclick="checkout()">Checkout</button>
</div>

<script>
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

    function checkout() {
        // Redirect to the cart page
        window.location.href = "cart.php";
    }
</script>

</body>
</html>