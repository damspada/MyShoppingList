<?php

// Connessione al database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "myshopping";

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Prendi i valori inviati dal form di login
    if(isset($_POST['email']) && isset($_POST['pass'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Esegui una query per verificare le credenziali dell'utente nel database
        $sql = "SELECT * FROM utenti WHERE email = '$email' AND pass = '$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // L'utente esiste nel database e le credenziali sono valide
            $row = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'admin' => $row['adm']]);
        } else {
            // L'utente non esiste nel database o le credenziali non sono valide
            echo json_encode(['status' => 'failure']);
        }
    }
    
    if (isset($_POST['cestino'])) {
        $Elementi = "DELETE FROM `Cart`";
        $update = $conn->query($Elementi);
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

// Chiudi la connessione al database
$conn->close();
?>
