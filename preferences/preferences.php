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





$conn->close();
?>