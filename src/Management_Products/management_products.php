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
    $sql = "SELECT image, Nome, peso, category, nutrients, description, health FROM products;";
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $products[] = array(
                'Nome' => $row['Nome'],
                'peso' => $row['peso'],
                'image' => $row['image'],
                'category' => $row['category'],
                'description' => $row['description'],
                'nutrients' => $row['nutrients'] ,
                'health' => $row['health'] 
            );
        }
    }



    header('Content-Type: application/json');
    echo json_encode($products);
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $name = $data['name'];

    // Preparazione della query per evitare SQL injection
    $stmt = $conn->prepare("DELETE FROM products WHERE Nome = ?");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo "Prodotto eliminato con successo!";
    } else {
        echo "Errore: " . $stmt->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['add']) && $data['add']) {
        $nome = $data['nome'];
        $peso = $data['peso'];
        $categoria = $data['categoria'];
        $descrizione = $data['descrizione'];
        $nutrients = $data['nutrients'];
        $health = $data['health'];
        $image = $data['image'];

        if (empty($nome)) {
            echo "Errore: Il campo nome è obbligatorio.";
            $conn->close();
            exit();
        }

        if (empty($peso)) {
            $peso=NULL;
        }
        if (empty($health)) {
            $health=NULL;
        }
        if (empty($descrizione)) {
            $descrizione=NULL;
        }
        if (empty($nutrients)) {
            $nutrients=NULL;
        }
        if (empty($image)) {
            $image=NULL;
        }
        if (empty($categoria)) {
            $categoria=NULL;
        }

        

        $stmt = $conn->prepare("INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nome, $peso, $image, $categoria, $descrizione, $nutrients, $health);

        if ($stmt->execute()) {
            echo "Prodotto aggiunto con successo!";
        } else {
            echo "Errore: " . $stmt->error;
        }
    }
    if (isset($data['mod']) && $data['mod']) {
        $nome = $data['nome'];
        $peso = $data['peso'];
        $descrizione = $data['descrizione'];
        $nutrients = $data['nutrients'];
        $health = $data['health'];
        $image = $data['image'];

        if (empty($nome)) {
            echo "Errore: Il campo nome è obbligatorio.";
            $conn->close();
            exit();
        }

        

        $stmt = $conn->prepare("UPDATE products SET image = ?, peso = ?, description = ?, nutrients = ?, health = ? WHERE Nome = ?");
        $stmt->bind_param("ssssss", $image, $peso, $descrizione, $nutrients, $health, $nome);

        if ($stmt->execute()) {
            echo "Prodotto aggiornato con successo!";
        } else {
            echo "Errore: " . $stmt->error;
        }
    }

}

$conn->close();
?>

