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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : 'No session ID set';
    $text = $_POST['text'];

    // Preparazione della query per evitare SQL injection
    $stmt = $conn->prepare("INSERT INTO recensioni (email, text) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $text);

    if ($stmt->execute()) {
        echo "Recensione aggiunta con successo!";
    } else {
        echo "Errore: " . $stmt->error;
    }

    $stmt->close();
} else {
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

$conn->close();
?>
