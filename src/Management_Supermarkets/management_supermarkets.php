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
    $sql = "SELECT chain, name, ST_AsText(location) AS location FROM supermarkets;";
    $result = $conn->query($sql);

    $supermarkets = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Convert the location from "POINT(lat long)" to a more readable format if needed
            $location = str_replace(array('POINT(', ')'), '', $row['location']);
            $supermarkets[] = array(
                'chain' => $row['chain'],
                'name' => $row['name'],
                'location' => $location
            );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($supermarkets);
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $chain = $data['chain'];
    $name = $data['name'];

    // Preparazione della query per evitare SQL injection
    $stmt = $conn->prepare("DELETE FROM supermarkets WHERE chain = ? AND name = ?");
    $stmt->bind_param("ss", $chain, $name);

    if ($stmt->execute()) {
        echo "Recensione eliminata con successo!";
    } else {
        echo "Errore: " . $stmt->error;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['add']) && $data['add']) {
        $chain = $data['chain'];
        $name = $data['name'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];

        if (empty($chain) || empty($name) || empty($latitude) || empty($longitude)) {
            echo "Errore: Tutti i campi sono obbligatori.";
            $conn->close();
            exit();
        }

        $location = "POINT($latitude $longitude)";

        $stmt = $conn->prepare("INSERT INTO supermarkets (chain, name, location) VALUES (?, ?, ST_GeomFromText(?))");
        $stmt->bind_param("sss", $chain, $name, $location);

        if ($stmt->execute()) {
            echo "Supermercato aggiunto con successo!";
        } else {
            echo "Errore: " . $stmt->error;
        }
    }

    if (isset($data['mod']) && $data['mod']) {
        $chain = $data['chain'];
        $name = $data['name'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];

        if (empty($chain) || empty($name) || empty($latitude) || empty($longitude)) {
            echo "Errore: Tutti i campi sono obbligatori.";
            $conn->close();
            exit();
        }

        $location = "POINT($latitude $longitude)";

        $stmt = $conn->prepare("UPDATE supermarkets SET location = ST_GeomFromText(?) WHERE (chain = ? AND name = ?)");
        $stmt->bind_param("sss", $location, $chain, $name);

        if ($stmt->execute()) {
            echo "Supermercato aggiornato con successo!";
        } else {
            echo "Errore: " . $stmt->error;
        }
    }
}

$conn->close();
?>