<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "MyShopping";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prendi i valori inviati dal form
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $lifestyle = $_POST['stile_di_vita'];
    $maxamount = $_POST['importo'];
    $password = $_POST['password'];
    $ID = $_POST['id'];

    // Caricamento dell'immagine
    $target_dir = "C:/xampp/htdocs/uploads/";
    $target_file = $target_dir . basename($_FILES["avatar-upload"]["name"]);
    $image_changed = false;

    // Controllo dell'immagine
    if ($_FILES["avatar-upload"]["error"] !== UPLOAD_ERR_OK) {
        echo "Si è verificato un errore durante il caricamento del file: " . $_FILES["avatar-upload"]["error"];
    } else {
        // Se tutto è ok, prova a caricare il file
        if (move_uploaded_file($_FILES["avatar-upload"]["tmp_name"], $target_file)) {
            echo "Il file " . htmlspecialchars(basename($_FILES["avatar-upload"]["name"])) . " è stato caricato.";
            $image_changed = true;
        } else {
            echo "Si è verificato un errore durante il caricamento del file.";
        }
    }

    // Query per aggiornare i dati nella tabella del database
    if ($image_changed) {
        $sql = "UPDATE utenti SET  
                immagine='$target_file', 
                cell='$phone', 
                pass='$password', 
                life='$lifestyle', 
                budget='$maxamount' 
                WHERE email='$email'";
    } else {
        $sql = "UPDATE utenti SET   
                cell='$phone', 
                pass='$password', 
                life='$lifestyle', 
                budget='$maxamount' 
                WHERE email='$email'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Profilo aggiornato con successo";
    } else {
        echo "Errore durante l'aggiornamento del profilo: " . $conn->error;
    }
}

$conn->close();
?>
