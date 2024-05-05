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

    //Per visualizzare i prodotti cercati tramite barra di ricerca
    else if (isset($_GET['Nome'])) {
        $Nome = $_GET['Nome'];
        $sql3 = "SELECT * FROM `products` WHERE Nome LIKE '%$Nome%'";
        $risultato = $conn->query($sql3);
        $productsC = array();
        if ($risultato->num_rows > 0) {
            while ($row = $risultato->fetch_assoc()) {
                $productsC[] = $row;
            }
        }
        echo json_encode($productsC);
    }

    //Per visualizzare i prodotti della categoria desiderata
    else if (isset($_GET['Categoria'])) {
        $categoria = $_GET['Categoria'];
        if ($categoria == "All") {
            $sql2 = "SELECT * FROM `products`";
            $risultato = $conn->query($sql2);
            $productsC = array();
            if ($risultato->num_rows > 0) {
                while ($row = $risultato->fetch_assoc()) {
                    $productsC[] = $row;
                }
            }
            echo json_encode($productsC);
        } else if ($categoria == "Healty") {
            $sql2 = "SELECT * FROM `products` WHERE health>=8";
            $risultato = $conn->query($sql2);
            $productsC = array();
            if ($risultato->num_rows > 0) {
                while ($row = $risultato->fetch_assoc()) {
                    $productsC[] = $row;
                }
            }
            echo json_encode($productsC);
        } else {
            $sql2 = "SELECT * FROM `products` WHERE category = '$categoria'";
            $risultato = $conn->query($sql2);
            $productsC = array();
            if ($risultato->num_rows > 0) {
                while ($row = $risultato->fetch_assoc()) {
                    $productsC[] = $row;
                }
            }
            echo json_encode($productsC);
        }
    }

    // Per inserire nel carrello i prodotti in base alla ricetta selezionata
    else if (isset($_GET['Ricetta'])) {
        $Ricetta = $_GET['Ricetta'];
        if ($Ricetta == "Carbonara") {

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Uova'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Uova'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Uova', 1, 'Dispensa', 'products/uova.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Mezze Maniche Barilla'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Mezze Maniche Barilla'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Mezze Maniche Barilla', 1, 'Dispensa', 'products/mezze_maniche.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Guanciale Beretta'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Guanciale Beretta'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Guanciale Beretta', 1, 'Salumi e Formaggi', 'products/Guanciale_Beretta.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Pecorino Biraghi'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Pecorino Biraghi'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Pecorino Biraghi', 1, 'Salumi e Formaggi', 'products/Pecorino_Biraghi.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Pepe Nero Cannamela'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Pepe Nero Cannamela'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Pepe Nero Cannamela', 1, 'Dispensa', 'products/pepe_nero_cannamela.jpg')";
                $res = $conn->query($insert_product);
            }

            $prodotti = [
                [
                    "Nome" => "Uova",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/uova.jpg"
                ],
                [
                    "Nome" => "Mezze Maniche Barilla",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/mezze_maniche.jpg"
                ],
                [
                    "Nome" => "Guanciale Beretta",
                    "Quantità" => 1,
                    "Categoria" => "Salumi e Formaggi",
                    "Immagine" => "products/Guanciale_Beretta.jpg"
                ],
                [
                    "Nome" => "Pecorino Biraghi",
                    "Quantità" => 1,
                    "Categoria" => "Salumi e Formaggi",
                    "Immagine" => "products/Pecorino_Biraghi.jpg"
                ],
                [
                    "Nome" => "Pepe Nero Cannamela",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/pepe_nero_cannamela.jpg"
                ]
            ];
            $json_prodotti = json_encode($prodotti);
            echo $json_prodotti;
        } else if ($Ricetta == "Amatriciana") {

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Passata di pomodoro Mutti'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Passata di pomodoro Mutti'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Passata di pomodoro Mutti', 1, 'Dispensa', 'products/passata_di_pomodoro_mutti.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Bucatini Rummo'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Bucatini Rummo'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Bucatini Rummo', 1, 'Dispensa', 'products/bucatini_rummo.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Guanciale Beretta'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Guanciale Beretta'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Guanciale Beretta', 1, 'Salumi e Formaggi', 'products/Guanciale_Beretta.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Pecorino Biraghi'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Pecorino Biraghi'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Pecorino Biraghi', 1, 'Salumi e Formaggi', 'products/Pecorino_Biraghi.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Pepe Nero Cannamela'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Pepe Nero Cannamela'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Pepe Nero Cannamela', 1, 'Dispensa', 'products/pepe_nero_cannamela.jpg')";
                $res = $conn->query($insert_product);
            }

            $prodotti = [
                [
                    "Nome" => "Passata di pomodoro Mutti",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/passata_di_pomodoro_mutti.jpg"
                ],
                [
                    "Nome" => "Bucatini Rummo",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/bucatini_rummo.jpg"
                ],
                [
                    "Nome" => "Guanciale Beretta",
                    "Quantità" => 1,
                    "Categoria" => "Salumi e Formaggi",
                    "Immagine" => "products/Guanciale_Beretta.jpg"
                ],
                [
                    "Nome" => "Pecorino Biraghi",
                    "Quantità" => 1,
                    "Categoria" => "Salumi e Formaggi",
                    "Immagine" => "products/Pecorino_Biraghi.jpg"
                ],
                [
                    "Nome" => "Pepe Nero Cannamela",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/pepe_nero_cannamela.jpg"
                ]
            ];
            $json_prodotti = json_encode($prodotti);
            echo $json_prodotti;
        } else if ($Ricetta == "Pollo") {

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Pollo Aia'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Pollo Aia'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Pollo Aia', 1, 'Carne', 'products/Pollo.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Patate'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Patate'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Patate', 1, 'Vegetali', 'products/Patate.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Cipolle'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Cipolle'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Cipolle', 1, 'Vegetali', 'products/Cipolle.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Rosmarino Cannamela'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Rosmarino Cannamela'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Rosmarino Cannamela', 1, 'Dispensa', 'products/rosmarino_cannamela.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Olio De Cecco'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Olio De Cecco'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Olio De Cecco', 1, 'Dispensa', 'products/olio_de_cecco.jpg')";
                $res = $conn->query($insert_product);
            }

            $prodotti = [
                [
                    "Nome" => "Pollo Aia",
                    "Quantità" => 1,
                    "Categoria" => "Carne",
                    "Immagine" => "products/Pollo.jpg"
                ],
                [
                    "Nome" => "Patate",
                    "Quantità" => 1,
                    "Categoria" => "Vegetali",
                    "Immagine" => "products/Patate.jpg"
                ],
                [
                    "Nome" => "Cipolle",
                    "Quantità" => 1,
                    "Categoria" => "Vegetali",
                    "Immagine" => "products/Cipolle.jpg"
                ],
                [
                    "Nome" => "Rosmarino Cannamela",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/rosmarino_cannamela.jpg"
                ],
                [
                    "Nome" => "Olio De Cecco",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/olio_de_cecco.jpg"
                ]
            ];
            $json_prodotti = json_encode($prodotti);
            echo $json_prodotti;
        } else if ($Ricetta == "Lasagna") {

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Passata di pomodoro Mutti'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Passata di pomodoro Mutti'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Passata di pomodoro Mutti', 1, 'Dispensa', 'products/passata_di_pomodoro_mutti.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Lasagne Barilla'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Lasagne Barilla'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Lasagne Barilla', 1, 'Dispensa', 'products/lasagne_barilla.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Cipolle'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Cipolle'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Cipolle', 1, 'Vegetali', 'products/Cipolle.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Carote'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Carote'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Carote', 1, 'Vegetali', 'products/carote.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Sedano'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Sedano'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Sedano', 1, 'Vegetali', 'products/sedano.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Besciamella Chef'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Besciamella Chef'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Besciamella Chef', 1, 'Dispensa', 'products/besciamella_chef.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Macinato'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Macinato'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Macinato', 1, 'Carne', 'products/macinato.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Parmigiano Parmareggio'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Parmigiano Parmareggio'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Parmigiano Parmareggio', 1, 'Salumi e Formaggi', 'products/parmigiano_parmareggio.jpg')";
                $res = $conn->query($insert_product);
            }

            $prodotti = [
                [
                    "Nome" => "Passata di pomodoro Mutti",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ],
                [
                    "Nome" => "Lasagne Barilla",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ],
                [
                    "Nome" => "Cipolle",
                    "Quantità" => 1,
                    "Categoria" => "Vegetali",
                ],
                [
                    "Nome" => "Carote",
                    "Quantità" => 1,
                    "Categoria" => "Vegetali",
                ],
                [
                    "Nome" => "Besciamella Chef",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ],
                [
                    "Nome" => "Sedano",
                    "Quantità" => 1,
                    "Categoria" => "Vegetale",
                ],
                [
                    "Nome" => "Macinato",
                    "Quantità" => 1,
                    "Categoria" => "Carne",
                ],
                [
                    "Nome" => "Parmigiano Parmareggio",
                    "Quantità" => 1,
                    "Categoria" => "Salumi e Formaggi",
                ]
            ];
            $json_prodotti = json_encode($prodotti);
            echo $json_prodotti;
        } else if ($Ricetta == "Tiramisù") {

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Caffè Kimbo'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Caffè Kimbo'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Caffè Kimbo', 1, 'Dispensa', 'products/caffè_kimbo.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Mascarpone Galbani'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Mascarpone Galbani'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Mascarpone Galbani', 1, 'Salumi e Formaggi', 'products/mascarpone_galbani.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Vincezovo Savoiardi'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Vincezovo Savoiardi'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Vincezovo Savoiardi', 1, 'Dolci', 'products/vincenzovo_savoiardi.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Uova'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Uova'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Uova', 1, 'Dispensa', 'products/uova.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Zucchero Eridania'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Zucchero Eridania'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Zucchero Eridania', 1, 'Dispensa', 'products/zucchero_eridania.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Cacao Perugina'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Cacao Perugina'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Cacao Perugina', 1, 'Dispensa', 'products/cacao_perugina.jpg')";
                $res = $conn->query($insert_product);
            }

            $prodotti = [
                [
                    "Nome" => "Caffè Kimbo",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ],
                [
                    "Nome" => "Mascarpone Galbani",
                    "Quantità" => 1,
                    "Categoria" => "Salumi e Formaggi",
                ],
                [
                    "Nome" => "Vincezovo Savoiardi",
                    "Quantità" => 1,
                    "Categoria" => "Dolci",
                ],
                [
                    "Nome" => "Uova",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ],
                [
                    "Nome" => "Zucchero Eridania",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ],
                [
                    "Nome" => "Cacao Perugina",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ]
            ];
            $json_prodotti = json_encode($prodotti);
            echo $json_prodotti;
        } else if ($Ricetta == "Tortellini") {

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Tortellini Barilla'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Tortellini Barilla'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Tortellini Barilla', 1, 'Dispensa', 'products/tortellini_barilla.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Cipolle'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Cipolle'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Cipolle', 1, 'Vegetali', 'products/Cipolle.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Carote'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Carote'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Carote', 1, 'Vegetali', 'products/carote.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Sedano'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Sedano'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Sedano', 1, 'Vegetali', 'products/sedano.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Pomodori San Marzano'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Pomodori San Marzano'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Pomodori San Marzano', 1, 'Vegetali', 'products/pomodori_san_marzano.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Olio De Cecco'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Olio De Cecco'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Olio De Cecco', 1, 'Dispensa', 'products/olio_de_cecco.jpg')";
                $res = $conn->query($insert_product);
            }

            $existingProduct = "SELECT * FROM `Cart` WHERE Nome = 'Parmigiano Parmareggio'";
            $res = $conn->query($existingProduct);
            if ($res->num_rows > 0) {
                $update_product = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = 'Parmigiano Parmareggio'";
                $res = $conn->query($update_product);
            } else {
                $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Parmigiano Parmareggio', 1, 'Salumi e Formaggi', 'products/parmigiano_parmareggio.jpg')";
                $res = $conn->query($insert_product);
            }

            $prodotti = [
                [
                    "Nome" => "Tortellini Barilla",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                ],
                [
                    "Nome" => "Pomodori San Marzano",
                    "Quantità" => 1,
                    "Categoria" => "Vegetali",
                ],
                [
                    "Nome" => "Cipolle",
                    "Quantità" => 1,
                    "Categoria" => "Vegetali",
                ],
                [
                    "Nome" => "Carote",
                    "Quantità" => 1,
                    "Categoria" => "Vegetali",
                ],
                [
                    "Nome" => "Sedano",
                    "Quantità" => 1,
                    "Categoria" => "Vegetale",
                ],
                [
                    "Nome" => "Parmigiano Parmareggio",
                    "Quantità" => 1,
                    "Categoria" => "Salumi e Formaggi",
                ],
                [
                    "Nome" => "Olio De Cecco",
                    "Quantità" => 1,
                    "Categoria" => "Dispensa",
                    "Immagine" => "products/olio_de_cecco.jpg"
                ]
            ];
            $json_prodotti = json_encode($prodotti);
            echo $json_prodotti;
        }
    }

    // Verifica se l'azione è "checkout"
    else if(isset($_GET['action']) && $_GET['action'] === 'checkout') {

        $sessionId = isset($_GET['id']) ? $_GET['id'] : null;

        // Trovo la posizione dell'utente
        $check_session = "SELECT ST_X(location) AS latitude, ST_Y(location) AS longitude FROM `session_location` WHERE SessionID = '$sessionId'";
        $result = $conn->query($check_session);
        
        $row = $result->fetch_assoc();
        $user_latitude = $row['latitude'];
        $user_longitude = $row['longitude'];

        // nearest_supermarket è il supermercato più vicino rispetto alla posizione dell'utente

        // Utilizzando le posizioni dei supermercati nella tabella TABLE `supermarkets` (chain varchar(255) NOT NULL, name varchar(255) NOT NULL, location` point NOT NULL, PRIMARY KEY (`chain`,`name`)); trovo il supermercato più vicino rispetto alla user_latitude e user_longitude e la user_location
        $nearest_supermarket = "SELECT chain, name, ST_X(location) AS latitude, ST_Y(location) AS longitude, ST_Distance_Sphere(location, POINT($user_latitude, $user_longitude)) AS distance FROM `supermarkets` ORDER BY distance LIMIT 1";
        $result = $conn->query($nearest_supermarket);

        $row = $result->fetch_assoc();
        $nearest_supermarket_chain = $row['chain'];
        $nearest_supermarket_name = $row['name'];
        $nearest_supermarket_latitude = $row['latitude'];
        $nearest_supermarket_longitude = $row['longitude'];

        
        // Trovo il supermercato più vicino        
        $supermercatoEconomico = "Supermercato X";
        $supermercatoConsigliato = "Supermercato Z";
        $prezziProdotti = array(
            "Prodotto1" => 1.99,
            "Prodotto2" => 2.49,
            "Prodotto3" => 0.99
        );

        // Create an associative array with the data to return
        $responseData = array(
            "nearestSupermarketChain" => $nearest_supermarket_chain,
            "nearestSupermarketName" => $nearest_supermarket_name,
            "nearestSupermarketLatitude" => $nearest_supermarket_latitude,
            "nearestSupermarketLongitude" => $nearest_supermarket_longitude,
            "supermercatoEconomico" => $supermercatoEconomico,
            "supermercatoConsigliato" => $supermercatoConsigliato,
            "prezziProdotti" => $prezziProdotti,
            "latitude" => $user_latitude, 
            "longitude" => $user_longitude
        );
    
        // Convertiamo l'array in formato JSON e lo restituiamo come risposta
        header('Content-Type: application/json');
        echo json_encode($responseData);

    }
    
    //Per visualizzare tutti i prodotti
    else {
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);


        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        echo json_encode($products);
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aggiungere prodotto al carrello o aumentare la quantità di esso all'interno del carrello
    if (isset($_POST['product_name']) && isset($_POST['product_category']) && isset($_POST['product_image'])) {
        // Sanificazione dei dati
        $product_name = $_POST['product_name'];
        $product_category = $_POST['product_category'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;

        // Query per verificare se il prodotto è già nel carrello
        $select_cart = "SELECT * FROM `Cart` WHERE Nome = '$product_name'";
        $res = $conn->query($select_cart);

        if ($res->num_rows > 0) {
            // Se il prodotto è già nel carrello, aggiorna la quantità
            $update_query = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = '$product_name'";
            $update_result = $conn->query($update_query);
        } else {
            // Se il prodotto non è nel carrello, inseriscilo
            $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('$product_name', '$product_quantity', '$product_category', '$product_image')";
            $res = $conn->query($insert_product);
        }
    }

    //Per aumentare e diminuire la quantità di un prodotto nel carrello 
    if (isset($_POST['elemento']) && isset($_POST['valore'])) {
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
    }

    //Per svuotare il carrello premendo l'icona del cestino
    if (isset($_POST['cestino'])) {
        $Elementi = "DELETE FROM `Cart`";
        $update = $conn->query($Elementi);
    }

    //Per svuotare il carrello alla chiusura della pagina 
    if (isset($_POST['close'])) {
        $Elementi = "DELETE FROM `Cart`";
        $update = $conn->query($Elementi);
    }

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
    } else {
        // Send error response
        echo "Error: Latitude and longitude not provided";
    }
}

$conn->close();
