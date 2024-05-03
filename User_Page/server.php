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

// Prendi i valori inviati dal form
$immagine = $_POST['immagine'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$lifestyle = $_POST['stile_di_vita'];
$maxamount = $_POST['importo'];
$password = $_POST['password'];

// Query per inserire i dati nella tabella del database
$sql = "INSERT INTO user_table (immagine, email, password, nome, cognome, data, telefono, lifestyle, max_amount)
VALUES ('$immagine', '$email', '$password', '$name', '$surname', '$birthdate', '$phone', '$lifestyle', '$maxamount')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>