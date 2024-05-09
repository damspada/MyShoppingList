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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
// Prendi i valori inviati dal form
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $lifestyle = $_POST['stile_di_vita'];
    $maxamount = $_POST['importo'];
    $password = $_POST['password'];
    $ID=$_POST['id'];

    // Caricamento dell'immagine
    //  $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/uploads/";
    $target_dir = "../../../uploads/";
    // $target_dir = "/opt/lampp/htdocs/uploads";

    // how to make a relative path if the current directory is /htdocs/msl/MyShoppingList/User_Page
    // use realpath() to get the current directory and then go back to the directory where the uploads folder is

    // $dir = __DIR__;
    // $target_dir = __DIR__ . "/../uploads/";

    $target_file = $target_dir . basename($_FILES["avatar-upload"]["name"]);

    // Controlla se si è verificato un errore durante il caricamento del file
    if ($_FILES["avatar-upload"]["error"] !== UPLOAD_ERR_OK) {
        echo "Si è verificato un errore durante il caricamento del file: " . $_FILES["avatar-upload"]["error"];
    } else {
        // Se tutto è ok, prova a caricare il file
        if (move_uploaded_file($_FILES["avatar-upload"]["tmp_name"], $target_file)) {
            echo "Il file ". htmlspecialchars( basename( $_FILES["avatar-upload"]["name"])). " è stato caricato.";
        } else {
            echo "Si è verificato un errore durante il caricamento del file.";
        }

        // Query per inserire i dati nella tabella del database
        $sql = "INSERT INTO utenti (id,immagine, email, pass, nome, cognome, born, cell, life, budget)
        VALUES ('$ID','$target_file', '$email', '$password', '$name', '$surname', '$birthdate', '$phone', '$lifestyle', '$maxamount')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
