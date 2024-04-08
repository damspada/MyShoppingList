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
        </div>
        <?php
    }
} else {
    echo "0 products found.";
}
?>

</body>
</html>
