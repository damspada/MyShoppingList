<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MyShoppingList";

try {
    $db = new mysqli($servername, $username, $password, $dbname);

    if ($db->connect_error) {
        throw new Exception("Connection failed: " . $db->connect_error);
    } else {
        echo "Database connection successful!";
    }
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
}

$sql = "SELECT catena, nome, posizione FROM supermercati";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $supermarkets = [];
    while ($row = $result->fetch_assoc()) {
        $supermarkets[] = [
            'catena' => $row['catena'],
            'nome' => $row['nome'],
            'posizione' => $row['posizione']
        ];
    }
} else {
    echo "No supermarkets found in the database.";
}

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #map .leaflet-marker-icon {
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
    <title>Supermercati su Mappa</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha384-07QQtYvIiPTauqcq9F+B2/6j4r4hIHv553/b7o1Z7t6wNhN7ivh2F4t1y(6Yk)b9I" crossorigin="anonymous">
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha384-q18j0E9rtY4twYeAuGi2j7zY2+2Y956u0q/k9zK/kR3YkMYivZqQk5j0Y+l47zX" crossorigin="anonymous"></script>
</head>
<body>
    <div id="map"></div>

    <script>
        // Create a Leaflet map
        var map = L.map('map').setView([41.9, 12.48], 13);

        // Add a tile layer (e.g., OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Process supermarket data and add markers to the map
        var supermarkets = <?php echo json_encode($supermarkets); ?>;

        for (var i = 0; i < supermarkets.length; i++) {
            var supermarket = supermarkets[i];

            var marker = L.marker(supermarket.posizione)
                .bindPopup(`<strong>${supermarket.catena} - ${supermarket.nome}</strong>`);

            marker.addTo(map);
        }
    </script>
</body>
</html>
