<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "MyShopping";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['email']) && isset($_POST['pass'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Esegui una query per verificare le credenziali dell'utente nel database
        $sql = "SELECT * FROM utenti WHERE email = '$email' AND pass = '$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "success";
        } else {
            echo "failure";
        }
    }

    else {
        echo "I dati inviati non sono validi.";
    }
}


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["email"])){
    $email=$_GET["email"];

    $sql="SELECT * FROM utenti where email='$email'";
    $result=$conn->query($sql);

    $utente = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $utente[] = $row;
        }
    }
    echo json_encode($utente);
}


$conn->close();
?>
