<?php
// Configurazione del database
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

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $sql = "SELECT email, text FROM recensioni";
    $result = $conn->query($sql);

    $reviews = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }
    echo json_encode($reviews);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    parse_str(file_get_contents("php://input"), $data);

    $email = isset($_POST['email']) ? $_POST['email'] : 'No session ID set';
    $text = $_POST['text'];

    // Concatenazione di email e text
    $fullText = $email . ": " . $text;

    if(isset($data['add']) && $data['add']){
        // Preparazione della query per evitare SQL injection
        $stmt = $conn->prepare("INSERT INTO recensioni (email, text) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $fullText);

        if ($stmt->execute()) {
            echo "Recensione aggiunta con successo!";
        } else {
            echo "Errore: " . $stmt->error;
        }
    }

    // Verifica se è stata effettuata una richiesta MODIFICA
    if (isset($data['mod']) && $data['mod']) {
        
        // modifica vecchia recensione nel database
        $stmt = $conn->prepare("UPDATE recensioni SET text = ? WHERE email = ?");
        $stmt->bind_param("ss", $fullText,$email);

        if ($stmt->execute()) {
            echo "Recensione eliminata con successo!";
        } else {
            echo "Errore: " . $stmt->error;
        }

    }

    $stmt->close();
} 

// Verifica se è stata effettuata una richiesta DELETE
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents("php://input"), $data);
    $email = $data['email'];

    // Preparazione della query per evitare SQL injection
    $stmt = $conn->prepare("DELETE FROM recensioni WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "Recensione eliminata con successo!";
    } else {
        echo "Errore: " . $stmt->error;
    }

}

// Verifica se è stata effettuata una richiesta MODIFICA
if ($_SERVER["REQUEST_METHOD"] == "MODIFICA") {
    parse_str(file_get_contents("php://input"), $data);
    $email = $data['email'];
    $text = $data['text'];

    // Concatenazione di email e text
    $fullText = $email . ": " . $text;

    // elimina vecchia recensione nel database
    $stmt = $conn->prepare("UPDATE recensioni SET text = ? WHERE email = ?");
    $stmt->bind_param("ss", $fullText,$email);

    if ($stmt->execute()) {
        echo "Recensione eliminata con successo!";
    } else {
        echo "Errore: " . $stmt->error;
    }

}



$conn->close();

?>
