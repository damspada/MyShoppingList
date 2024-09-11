<?php

require_once 'Database.php';

use Mattiaricciardelli\MyShoppingList\Home\Database;

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "MyShopping";


$db = new Database($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prendi i valori inviati dal form di login
    if (isset($_POST['email']) && isset($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Verifica le credenziali dell'utente
        $user = $db->verifyUser($email, $pass);

        if ($user) {
            echo json_encode(['status' => 'success', 'admin' => $user['adm']]);
        } else {
            echo "failure";
        }
    }

    if (isset($_POST['cestino'])) {
        $db->clearCart();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["email"])) {
    $email = $_GET["email"];
    $utente = $db->getUser($email);
    echo json_encode($utente);
}

$db->close();
?>
