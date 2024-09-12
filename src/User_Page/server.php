<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "MyShopping";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*$_SESSION['logged_github'] = false; // Imposta il flag di accesso GitHub nella sessione
$_SESSION['name'] = '';
$_SESSION['email_git'] = '';*/


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $lifestyle = $_POST['stile_di_vita'];
    $maxamount = $_POST['importo'];
    $password = $_POST['password'];
    $ID=$_POST['id'];
    $admin=$_POST['admin'];

    // Caricamento dell'immagine
    $target_dir = "../../../../uploads/";
    $target_file = $target_dir . basename($_FILES["avatar-upload"]["name"]);

    if ($_FILES["avatar-upload"]["error"] !== UPLOAD_ERR_OK) {
        echo "Si è verificato un errore durante il caricamento del file: " . $_FILES["avatar-upload"]["error"];

        //Query per inserire i dati nella tabella del database
        $sql = "INSERT INTO utenti (id, email, pass, nome, cognome, born, cell, life, budget, adm)
        VALUES ('$ID', '$email', '$password', '$name', '$surname', '$birthdate', '$phone', '$lifestyle', '$maxamount', '$admin')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        if (move_uploaded_file($_FILES["avatar-upload"]["tmp_name"], $target_file)) {
            echo "Il file ". htmlspecialchars( basename( $_FILES["avatar-upload"]["name"])). " è stato caricato.";
        } else {
            echo "Si è verificato un errore durante il caricamento del file.";
        }

        //Query per inserire i dati nella tabella del database
        $sql = "INSERT INTO utenti (id, immagine, email, pass, nome, cognome, born, cell, life, budget, adm)
        VALUES ('$ID','$target_file', '$email', '$password', '$name', '$surname', '$birthdate', '$phone', '$lifestyle', '$maxamount', '$admin')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}



if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action']=='log' && isset($_GET['email'])){
    $email=$_GET['email'];

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

if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action']=='check_logged_git'){
    $response = array(
        'logged_github' => $_SESSION['logged_github'],
        'email_git' => $_SESSION['email'] ,
        'name' => $_SESSION['name'] 
    );
    echo json_encode($response);
    //$_SESSION['logged_github'] = false; // Imposta il flag di accesso GitHub nella sessione
    //$_SESSION['name'] = '';
    //$_SESSION['email_git'] = '';
    
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action']=='logout'){
    $_SESSION['logged_github'] = false; // Imposta il flag di accesso GitHub nella sessione
    $_SESSION['name'] = '';
    $_SESSION['email'] = '';
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action']=='log_no_git'){
    $_SESSION['logged_github'] = false; // Imposta il flag di accesso GitHub nella sessione
    $_SESSION['name'] = '';
    $_SESSION['email'] = '';
}




$conn->close();
?>
