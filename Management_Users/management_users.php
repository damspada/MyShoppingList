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

    // Query SQL per ottenere i dati degli utenti
    $sql = "SELECT email, cell, life, budget FROM utenti WHERE adm = 0 OR adm IS NULL;"; // Sostituire 'utenti' con il nome della tua tabella
    $result = $conn->query($sql);
    
    // Creazione di un array per contenere i dati degli utenti
    $users = array();
    
    if ($result->num_rows > 0) {
        // Ciclo attraverso i risultati e aggiungi ogni utente all'array
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    } else {
        echo "0 risultati";
    }

    // Restituzione dei dati in formato JSON
header('Content-Type: application/json');
echo json_encode($users);
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $email = $data['email'];

    // Preparazione della query per evitare SQL injection
    $stmt = $conn->prepare("DELETE FROM utenti WHERE email = ? AND (adm LIKE 0 OR adm IS NULL)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "Recensione eliminata con successo!";
    } else {
        echo "Errore: " . $stmt->error;
    }
}

$conn->close();




?>