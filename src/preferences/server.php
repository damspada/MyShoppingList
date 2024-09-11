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


if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    //Per visualizzare tutti i prodotti
    if (isset($_GET['riavvio'])) {
        $sql3 = "SELECT * FROM Cart";
        $risultato = $conn->query($sql3);
        $productsC = array();
        if ($risultato->num_rows > 0) {
            while ($row = $risultato->fetch_assoc()) {
                $productsC[] = $row;
            }
        }
        echo json_encode($productsC);
    }

    

    

    // Verifica se l'azione è "checkout" e calcola il supermercato più vicino, il supermercato più economico, il supermercato consigliato e il prezzi dei prodotti nel carrello per il supermercato consigliato
    else if (isset($_GET['action']) && $_GET['action'] === 'checkout') {

        $sessionId = isset($_GET['id']) ? $_GET['id'] : null;

        // Trovo la posizione dell'utente
        $check_session = "SELECT ST_X(location) AS latitude, ST_Y(location) AS longitude FROM `session_location` WHERE SessionID = '$sessionId'";
        $result = $conn->query($check_session);

        $row = $result->fetch_assoc();
        $user_latitude = $row['latitude'];
        $user_longitude = $row['longitude'];

        // Trovo il supermercato più vicino
        $nearest_supermarket = "SELECT chain, name, ST_X(location) AS latitude, ST_Y(location) AS longitude, ST_Distance_Sphere(location, POINT($user_latitude, $user_longitude)) AS distance FROM `supermarkets` ORDER BY distance LIMIT 1";
        $result = $conn->query($nearest_supermarket);

        $row = $result->fetch_assoc();
        $nearest_supermarket_chain = $row['chain'];
        $nearest_supermarket_name = $row['name'];
        $nearest_supermarket_latitude = $row['latitude'];
        $nearest_supermarket_longitude = $row['longitude'];
        $nearest_supermarket_distance = $row['distance'];
        $nearest_supermarket_distance = round($nearest_supermarket_distance / 1000, 2);
        $nearest_supermarket_distance = strval($nearest_supermarket_distance) . " km";

        // Calcolo il prezzo totale dei prodotti nel carrello per supermercato più vicino
        $nearest_supermarket_totalPrice = "SELECT SUM(price * Quantità) AS totalPrice FROM Cart, supermarkets_products WHERE Cart.Nome = supermarkets_products.product_name AND supermarkets_products.supermarket_chain = '$nearest_supermarket_chain' AND supermarkets_products.supermarket_name = '$nearest_supermarket_name'";
        $result = $conn->query($nearest_supermarket_totalPrice);
        $row = $result->fetch_assoc();
        $nearest_supermarket_totalPrice = $row['totalPrice'];
        $nearest_supermarket_totalPrice = round($nearest_supermarket_totalPrice, 2);

        $nearest_supermarket = [
            "chain" => $nearest_supermarket_chain,
            "name" => $nearest_supermarket_name,
            "latitude" => $nearest_supermarket_latitude,
            "longitude" => $nearest_supermarket_longitude,
            "distance" => $nearest_supermarket_distance,
            "totalPrice" => $nearest_supermarket_totalPrice
        ];

        // Calcolo il prezzo totale dei prodotti nel carrello per supermercato più vicino
        $totalPrice = "SELECT SUM(price * Quantità) AS totalPrice, supermarket_chain, supermarket_name FROM Cart, supermarkets_products WHERE Cart.Nome = supermarkets_products.product_name GROUP BY supermarket_chain, supermarket_name";
        $result = $conn->query($totalPrice);

        // Trovo il supermercato più economico
        $cheapestSupermarket = "SELECT supermarket_chain, supermarket_name, MIN(totalPrice) AS totalPrice FROM ($totalPrice) AS totalPrices GROUP BY supermarket_chain, supermarket_name ORDER BY totalPrice LIMIT 1";
        $result = $conn->query($cheapestSupermarket);
        $row = $result->fetch_assoc();

        $cheapest_supermarket_chain = $row['supermarket_chain'];
        $cheapest_supermarket_name = $row['supermarket_name'];
        $cheapest_supermarket_totalPrice = $row['totalPrice'];
        $cheapest_supermarket_totalPrice = round($cheapest_supermarket_totalPrice, 2);

        // Trovo la posizione del supermercato più economico e la distanza dalla user_location
        $cheapest_supermarket_location = "SELECT ST_X(location) AS latitude, ST_Y(location) AS longitude FROM supermarkets WHERE chain = '$cheapest_supermarket_chain' AND name = '$cheapest_supermarket_name'";
        $result = $conn->query($cheapest_supermarket_location);
        $row = $result->fetch_assoc();
        $cheapest_supermarket_latitude = $row['latitude'];
        $cheapest_supermarket_longitude = $row['longitude'];

        $cheapest_supermarket_distance = "SELECT ST_Distance_Sphere(location, POINT($user_latitude, $user_longitude)) AS distance FROM supermarkets WHERE chain = '$cheapest_supermarket_chain' AND name = '$cheapest_supermarket_name'";
        $result = $conn->query($cheapest_supermarket_distance);
        $row = $result->fetch_assoc();
        $cheapest_supermarket_distance = $row['distance'];
        $cheapest_supermarket_distance = round($cheapest_supermarket_distance / 1000, 2);
        $cheapest_supermarket_distance = strval($cheapest_supermarket_distance) . " km";

        $cheapest_supermarket = [
            "chain" => $cheapest_supermarket_chain,
            "name" => $cheapest_supermarket_name,
            "latitude" => $cheapest_supermarket_latitude,
            "longitude" => $cheapest_supermarket_longitude,
            "distance" => $cheapest_supermarket_distance,
            "totalPrice" => $cheapest_supermarket_totalPrice
        ];

        // Calcola il ranking dei supermercati più vicini
        $nearestSupermarketRanking = "SELECT chain, supermarkets.name, ST_Distance_Sphere(location, POINT($user_latitude, $user_longitude)) AS distance FROM `supermarkets` ORDER BY distance";
        $result = $conn->query($nearestSupermarketRanking);
        $nearestSupermarketRankingArray = array();
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $nearestSupermarketRankingArray[$row['chain']][$row['name']] = $rank;
            $rank++;
        }

        // Calcola il ranking dei supermercati più economici
        $cheapestSupermarketRanking = "SELECT supermarket_chain, supermarket_name, SUM(price * Quantità) AS totalPrice FROM Cart, supermarkets_products WHERE Cart.Nome = supermarkets_products.product_name GROUP BY supermarket_chain, supermarket_name ORDER BY totalPrice";
        $result = $conn->query($cheapestSupermarketRanking);
        $cheapestSupermarketRankingArray = array();
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $cheapestSupermarketRankingArray[$row['supermarket_chain']][$row['supermarket_name']] = $rank;
            $rank++;
        }

        // Calcola il supermercato consigliato
        $recommendedSupermarketRankingArray = array();
        foreach ($nearestSupermarketRankingArray as $chain => $supermarkets) {
            foreach ($supermarkets as $name => $nearestRank) {
                if (isset($cheapestSupermarketRankingArray[$chain][$name])) {
                    $recommendedRank = $nearestRank + $cheapestSupermarketRankingArray[$chain][$name];
                    $recommendedSupermarketRankingArray[$chain][$name] = $recommendedRank;
                }
            }
        }

        // Trova il supermercato consigliato con il ranking più basso
        $recommended_supermarket_chain = null;
        $recommended_supermarket_name = null;
        $recommended_supermarket_rank = PHP_INT_MAX;
        foreach ($recommendedSupermarketRankingArray as $chain => $supermarkets) {
            foreach ($supermarkets as $name => $rank) {
                if ($rank < $recommended_supermarket_rank) {
                    $recommended_supermarket_chain = $chain;
                    $recommended_supermarket_name = $name;
                    $recommended_supermarket_rank = $rank;
                }
            }
        }

        // Trova la posizione del supermercato consigliato
        $recommended_supermarket_location = "SELECT ST_X(location) AS latitude, ST_Y(location) AS longitude FROM supermarkets WHERE chain = '$recommended_supermarket_chain' AND name = '$recommended_supermarket_name'";
        $result = $conn->query($recommended_supermarket_location);
        $row = $result->fetch_assoc();
        $recommended_supermarket_latitude = $row['latitude'];
        $recommended_supermarket_longitude = $row['longitude'];

        // Trova la distanza del supermercato consigliato rispetto alla user_location
        $recommended_supermarket_distance = "SELECT ST_Distance_Sphere(location, POINT($user_latitude, $user_longitude)) AS distance FROM supermarkets WHERE chain = '$recommended_supermarket_chain' AND name = '$recommended_supermarket_name'";
        $result = $conn->query($recommended_supermarket_distance);
        $row = $result->fetch_assoc();
        $recommended_supermarket_distance = $row['distance'];
        $recommended_supermarket_distance = round($recommended_supermarket_distance / 1000, 2);
        $recommended_supermarket_distance = strval($recommended_supermarket_distance) . " km";

        // Calcola il prezzo totale dei prodotti nel carrello per il supermercato consigliato
        $recommended_supermarket_totalPrice = "SELECT SUM(price * Quantità) AS totalPrice FROM Cart, supermarkets_products WHERE Cart.Nome = supermarkets_products.product_name AND supermarkets_products.supermarket_chain = '$recommended_supermarket_chain' AND supermarkets_products.supermarket_name = '$recommended_supermarket_name'";
        $result = $conn->query($recommended_supermarket_totalPrice);
        $row = $result->fetch_assoc();
        $recommended_supermarket_totalPrice = $row['totalPrice'];
        $recommended_supermarket_totalPrice = round($recommended_supermarket_totalPrice, 2);

        $recommended_supermarket = [
            "chain" => $recommended_supermarket_chain,
            "name" => $recommended_supermarket_name,
            "latitude" => $recommended_supermarket_latitude,
            "longitude" => $recommended_supermarket_longitude,
            "distance" => $recommended_supermarket_distance,
            "totalPrice" => $recommended_supermarket_totalPrice
        ];

        // Trova i prezzi dei prodotti nel carrello per il supermercato consigliato
        $productsPrices = "SELECT Cart.Nome, Cart.Quantità, price FROM Cart, supermarkets_products WHERE Cart.Nome = supermarkets_products.product_name AND supermarket_chain = '$recommended_supermarket_chain' AND supermarket_name = '$recommended_supermarket_name'";

        $result = $conn->query($productsPrices);
        $productsPrices = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productsPrices[] = $row;
            }
        }

        $responseData = array(
            "nearestSupermarket" => $nearest_supermarket,
            "cheapestSupermarket" => $cheapest_supermarket,
            "recommendedSupermarket" => $recommended_supermarket,
            "productsPrices" => $productsPrices,
            "user_latitude" => $user_latitude,
            "user_longitude" => $user_longitude
        );

        header('Content-Type: application/json');
        echo json_encode($responseData);

    }

    // Controlla se l'azione richiesta è "check_health"
    else if (isset($_GET['action']) && $_GET['action'] === 'check_health') {
        if (isset($_GET['email']) && isset($_GET['health'])) {

            $email = $_GET['email'];
            $health = $_GET['health'];
            $nome = $_GET['nome'];

            $check_prodotto = "SELECT * FROM `Cart` WHERE Nome = '$nome'";
            $result = $conn->query($check_prodotto);

            if ($result->num_rows > 0) {
                echo json_encode(false);
                exit; 
            }

            if ($health < 6 && $health != null) {
                $check_health = "SELECT * FROM `utenti` WHERE email = '$email' AND life = 'Sportivo'";
                $result = $conn->query($check_health);

                if ($result && $result->num_rows > 0) {
                    echo json_encode(true);
                    exit; 
                }
            }

            echo json_encode(false);
            exit; 
        }
    }

    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aggiungere prodotto al carrello o aumentare la quantità di esso all'interno del carrello
    if (isset($_POST['product_name']) && isset($_POST['product_category']) && isset($_POST['product_image'])) {
        $product_name = $_POST['product_name'];
        $product_category = $_POST['product_category'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;

        $select_cart = "SELECT * FROM `Cart` WHERE Nome = '$product_name'";
        $res = $conn->query($select_cart);

        /*if ($res->num_rows > 0) {
            // Se il prodotto è già nel carrello, aggiorna la quantità
            $update_query = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = '$product_name'";
            $update_result = $conn->query($update_query);
        } else {*/
            // Se il prodotto non è nel carrello, inseriscilo
            $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('$product_name', '$product_quantity', '$product_category', '$product_image')";
            $res = $conn->query($insert_product);
        //}
    }

    //Per aumentare e diminuire la quantità di un prodotto nel carrello 
    /*if (isset($_POST['elemento']) && isset($_POST['valore'])) {
        $valore = $_POST['valore'];
        $prodotto = $_POST['elemento'];
        if ($valore == '-1') {
            $Quantità = "SELECT * FROM Cart WHERE  Nome = '$prodotto'";
            $res = $conn->query($Quantità);
            $row = $res->fetch_assoc();
            $n = $row['Quantità'];
            if ($n > 1) {
                $update_quantity_query = "UPDATE `Cart` SET Quantità = Quantità - 1 WHERE Nome = '$prodotto'";
                $update = $conn->query($update_quantity_query);
            } else {
                $update_cart = "DELETE FROM `Cart` WHERE Nome = '$prodotto'";
                $update = $conn->query($update_cart);
            }
        } else {
            $update_quantity_query = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = '$prodotto'";
            $update = $conn->query($update_quantity_query);
        }
    }*/

    //Per svuotare il carrello premendo l'icona del cestino
    

    //Per svuotare il carrello alla chiusura della pagina 
    if (isset($_POST['close'])) {
        $Elementi = "DELETE FROM `Cart`";
        $update = $conn->query($Elementi);
    }

    //Per salvare la posizione dell'utente
    if (isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['session_id'])) {
        // Retrieve latitude and longitude
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $sessionId = $_POST['session_id'];

        // Check if session ID already exists in the database
        $check_session = "SELECT * FROM `session_location` WHERE SessionID = '$sessionId'";
        $result = $conn->query($check_session);

        if ($result->num_rows > 0) {
            // If session ID exists, update the location
            $update_location = "UPDATE `session_location` SET location = POINT($latitude, $longitude) WHERE SessionID = '$sessionId'";
            $update = $conn->query($update_location);
        } else {
            // If session ID does not exist, insert a new record
            $insert_location = "INSERT INTO `session_location` (SessionID, location) VALUES ('$sessionId', POINT($latitude, $longitude))";
            $update = $conn->query($insert_location);
        }

        if (!$update) {
            echo "Error: " . mysqli_error($conn);
        } else {
            echo "Location saved successfully";
        }
    }

    /*if(isset($_POST['email']) && isset($_POST['nome']) && isset($_POST['contenuto'])){
        $utente=$_POST['email'];
        $nomeCarrello=$_POST['nome'];
        $contenuto=$_POST['contenuto'];
        
        //check if this cart for this user already exists
        $check_cart="SELECT * FROM `preferences` WHERE user_id = '$utente' AND name_cart = '$nomeCarrello'";
        $result_check=$conn->query($check_cart);

        if($result_check->num_rows>0){
            echo "Questo carrello è già presente!";
    
        }
        else{
            $insert_cart="INSERT INTO `preferences` (user_id, name_cart, products) VALUES ('$utente', '$nomeCarrello', '$contenuto')";
            $result_insert=$conn->query($insert_cart);
        }

        if (!$result_insert) {
            echo "Error: " . mysqli_error($conn);
        } else {
            echo "Cart saved correctly";
        }
    }*/
}

$conn->close();
