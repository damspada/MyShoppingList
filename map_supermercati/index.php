<?php
// Database connection details
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "msl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all supermarket records with position
$sql = "SELECT catena, nome, ST_X(posizione) AS latitude, ST_Y(posizione) AS longitude FROM supermercati";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Catena: " . $row["catena"]. " - Nome: " . $row["nome"]. " - Latitudine: " . $row["latitude"]. " - Longitudine: " . $row["longitude"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
