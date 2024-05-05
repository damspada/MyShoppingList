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
$name = $_POST['name'];
$surname = $_POST['surname'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$lifestyle = $_POST['stile_di_vita'];
$maxamount = $_POST['importo'];
$password = $_POST['password'];

// Caricamento dell'immagine
// $target_dir = "uploads/"; // Directory di destinazione per il caricamento dell'immagine
// $target_file = $target_dir . basename($_FILES["avatar-upload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Controlla se il file immagine è valido
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["avatar-upload"]["tmp_name"]);
//     if($check !== false) {
//         echo "Il file è un'immagine - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "Il file non è un'immagine.";
//         $uploadOk = 0;
//     }
// }

if(isset($_POST['avatar-upload'])){
    echo "<prev>", print_r($_FILES['profileImage']['name']), "<prev>";

    $profileImageName = time() . '_' . $_FILES['profileImage']['name'];

    $target = 'uploads/' . $profileImageName ;
    
    move_uploaded_file($_FILES['profileImage']['tmp_name'], $target);
}

// Controllo se il file esiste già
// if (file_exists($target_file)) {
//     echo "Il file già esiste.";
//     $uploadOk = 0;
// }

// Controllo delle dimensioni del file
// if ($_FILES["avatar-upload"]["size"] > 500000) {
//     echo "Il file è troppo grande.";
//     $uploadOk = 0;
// }

// Consentire solo alcuni formati di file
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Sono ammessi solo file JPG, JPEG, PNG & GIF.";
//     $uploadOk = 0;
// }

// Controlla se si è verificato un errore durante il caricamento del file
// if ($_FILES["avatar-upload"]["error"] !== UPLOAD_ERR_OK) {
//     echo "Si è verificato un errore durante il caricamento del file: " . $_FILES["avatar-upload"]["error"];
// } else {
//     // Se tutto è ok, prova a caricare il file
//     if (move_uploaded_file($_FILES["avatar-upload"]["tmp_name"], $target_file)) {
//         echo "Il file ". htmlspecialchars( basename( $_FILES["avatar-upload"]["name"])). " è stato caricato.";
//     } else {
//         echo "Si è verificato un errore durante il caricamento del file.";
//     }
// }

// Query per inserire i dati nella tabella del database
$sql = "INSERT INTO users (immagine, email, pass, nome, cognome, dt, telefono, lifestyle, max_amount)
VALUES ('$target_file', '$email', '$password', '$name', '$surname', '$birthdate', '$phone', '$lifestyle', '$maxamount')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
