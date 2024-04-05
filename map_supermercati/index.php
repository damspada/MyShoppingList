<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "msl";

try {
    // Connessione al database
    $db = mysqli_connect($servername, $username, $password, $dbname);

    // Verifica della connessione
    if ($db->connect_error) {
        throw new Exception("Connection failed: " . $db->connect_error);
    } else {
        // echo "Database connection successful!";
    }

    // Query per recuperare i dati dei supermercati
    $sql = "SELECT catena, nome, X(posizione) as latitudine, Y(posizione) as longitudine FROM supermercati";
    $result = $db->query($sql);

    // Array per memorizzare i dati dei supermercati
    $supermarkets = [];

    // Elaborazione dei risultati della query
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $supermarkets[] = [
                'catena' => $row['catena'],
                'nome' => $row['nome'],
                'latitudine' => $row['latitudine'],
                'longitudine' => $row['longitudine']
            ];
        }
    } else {
        echo "No supermarkets found in the database.";
    }

} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
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
</head>
<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha384-q18j0E9rtY4twYeAuGi2j7zY2+2Y956u0q/k9zK/kR3YkMYivZqQk5j0Y+l47zX" crossorigin="anonymous"></script>
    <script>
        // Creazione della mappa Leaflet
        var map = L.map('map').setView([41.9, 12.48], 13);

        // Aggiunta di un layer di tile (ad es., OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Processamento dei dati dei supermercati e aggiunta di marker sulla mappa
        var supermarkets = <?php echo json_encode($supermarkets); ?>;

        supermarkets.forEach(function(supermarket) {
            var marker = L.marker([supermarket.latitudine, supermarket.longitudine])
                .bindPopup('<strong>' + supermarket.catena + ' - ' + supermarket.nome + '</strong>');

            marker.addTo(map);
        });
    </script>
</body>
</html>
