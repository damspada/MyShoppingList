<?php
// Inizio della sessione
session_start();

// Connessione al database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "MyShopping";

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Prendi i valori inviati dal form di login
if(isset($_POST['email']) && isset($_POST['pass'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Esegui una query per verificare le credenziali dell'utente nel database
    $sql = "SELECT * FROM utenti WHERE email = '$email' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // L'utente esiste nel database e le credenziali sono valide
        // Memorizza i dettagli dell'utente nella sessione
        $_SESSION['user_details'] = $result->fetch_assoc();
        echo "success";
    } else {
        // L'utente non esiste nel database o le credenziali non sono valide
        echo "failure";
    }
} else {
    echo "I dati inviati non sono validi.";
}

// Chiudi la connessione al database
$conn->close();
?>
