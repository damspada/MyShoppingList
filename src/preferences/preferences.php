<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "MyShopping";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['email']) && !isset($_GET['cart_name'])) {
        $email = $_GET['email'];
        $sql = "SELECT * FROM preferences WHERE user_id = '$email';";
        $result = $conn->query($sql);

        $preferences = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $preferences[] = array(
                    'email' => $row['user_id'],
                    'name_cart' => $row['name_cart'],
                    'products' => $row['products']
                );
            }
        }

        header('Content-Type: application/json');
        echo json_encode($preferences);
    }
    if(isset($_GET['email']) && isset($_GET['cart_name'])){
        $email=$_GET['email'];
        $cart_name=$_GET['cart_name'];
        $sql = "SELECT * FROM preferences WHERE user_id = '$email' AND name_cart = '$cart_name';";
        $result = $conn->query($sql);
        header('Content-Type: application/json');
        echo json_encode($preferences);
        

    }

}

if($_SERVER['REQUEST_METHOD']=='DELETE'){
    parse_str(file_get_contents("php://input"), $data);
    $name = $data['name'];
    $email= $data['email'];
    $stmt = $conn->prepare("DELETE FROM preferences WHERE user_id = ? AND name_cart = ?");
    $stmt->bind_param("ss", $email, $name);

    if ($stmt->execute()) {
        echo "Prodotto eliminato con successo!";
    } else {
        echo "Errore: " . $stmt->error;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['session_id'])) {
        // Retrieve latitude and longitude
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $sessionId = $_POST['session_id'];

        // Check if session ID already exists in the database
        $check_session = "SELECT * FROM `session_location` WHERE SessionID = '$sessionId'";
        $result = $conn->query($check_session);

        if ($result->num_rows > 0) {
            // If session ID exists, update the location
            $update_location = "UPDATE `session_location` SET location = POINT($latitude, $longitude) WHERE SessionID = '$sessionId'";
            $update = $conn->query($update_location);
        } else {
            // If session ID does not exist, insert a new record
            $insert_location = "INSERT INTO `session_location` (SessionID, location) VALUES ('$sessionId', POINT($latitude, $longitude))";
            $update = $conn->query($insert_location);
        }

        if (!$update) {
            echo "Error: " . mysqli_error($conn);
        } else {
            echo "Location saved successfully";
        }
    }
    if (isset($_POST['email']) && isset($_POST['name_cart'])){
        $email = $_POST['email'];
        $name_cart = $_POST['name_cart'];

        // Svuota il carrello
        $empty_cart = "DELETE FROM `cart`";
        $stmt_empty = $conn->prepare($empty_cart);
        $stmt_empty->execute();

        // Recupera i prodotti dal carrello preferito
        $query_prodotti = "SELECT products FROM `preferences` WHERE user_id = ? AND name_cart = ?";
        $stmt_prodotti = $conn->prepare($query_prodotti);
        $stmt_prodotti->bind_param("ss", $email, $name_cart);
        $stmt_prodotti->execute();
        $result_prodotti = $stmt_prodotti->get_result();

        if ($result_prodotti->num_rows > 0) {
            $row = $result_prodotti->fetch_assoc();
            $arr_products = explode(",", $row['products']);

            foreach ($arr_products as $product) {
                $coppia = explode(":", $product);
                $product_name = $coppia[0];
                $quantity = $coppia[1];

                // Recupera la categoria e l'immagine del prodotto
                $query_categoria = "SELECT category, image FROM `products` WHERE Nome = ?";
                $stmt_categoria = $conn->prepare($query_categoria);
                $stmt_categoria->bind_param("s", $product_name);
                $stmt_categoria->execute();
                $result_categoria = $stmt_categoria->get_result();

                if ($result_categoria->num_rows > 0) {
                    $row_categoria = $result_categoria->fetch_assoc();
                    $category = $row_categoria['category'];
                    $image = $row_categoria['image'];

                    // Inserisci i prodotti nel carrello
                    $query_insert = "INSERT INTO `cart` (Nome, Quantità, Categoria, Immagine) VALUES (?, ?, ?, ?)";
                    $stmt_insert = $conn->prepare($query_insert);
                    $stmt_insert->bind_param("ssss", $product_name, $quantity, $category, $image);
                    $stmt_insert->execute();
                }
            }
            echo "Prodotti aggiunti al carrello con successo";
        } else {
            echo "Nessun prodotto trovato nel carrello preferito";
        }
    }
}





$conn->close();
?>