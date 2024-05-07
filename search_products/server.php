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

    // Verifica se l'azione è "checkout" e calcola il supermercato più vicino, il supermercato più economico, il supermercato consigliato e il prezzi dei prodotti nel carrello per il supermercato consigliato
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

        // Calcolo il prezzo totale dei prodotti nel carrello per ogni supermercato e trovo il supermercato più economico
        // i prodotti nel carrello li troviamo nella tabella Cart

        // Nome 	Quantità 	Categoria 	 	
        // Abbracci Mulino Bianco 	2 	Dolci
        // Aglio 	2 	Vegetali
        
        // e i prezzi dei prodotti nei supermercati nella tabella supermarkets_products
        //  supermarket_name 	supermarket_chain 	product_name Crescente 1 	price 	
        // Anagnina 	Carrefour 	Abbracci Mulino Bianco 	10.15
        // Aurelia 	Carrefour 	Abbracci Mulino Bianco 	6.05
        // Axa 	Carrefour 	Abbracci Mulino Bianco 	8.81
        // Anagnina 	Carrefour 	Aglio 	10.27
        // Aurelia 	Carrefour 	Aglio 	1.45
        // Axa 	Carrefour 	Aglio 	5.44

        // Calcolo il prezzo totale dei prodotti nel carrello per ogni supermercato
        $totalPrice = "SELECT SUM(price * Quantità) AS totalPrice, supermarket_chain, supermarket_name FROM Cart, supermarkets_products WHERE Cart.Nome = supermarkets_products.product_name GROUP BY supermarket_chain, supermarket_name";
        $result = $conn->query($totalPrice);

        // $supermarketPrices = array();
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $supermarketPrices[] = $row;
        //     }
        // }

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

        // Trovo il recommended_supermarket che è il supermercato che è abbastanza alto sia nella classifica dei supermercati più vicini rispetto alla posizione dell'utente e allo stesso tempo è anche abbastanza alto nella classifica dei supermercati più economici rispetto ai prodotti nel carrello
        // il recommended_supermarket è il supermercato che ha la somma delle posizioni nella classifica dei supermercati più vicini e nella classifica dei supermercati più economici più bassa
        // va quindi trovato prima il ranking dei supermercati più vicini rispetto alla posizione dell'utente poi il ranking dei supermercati più economici rispetto ai prodotti nel carrello e infine la somma dei due ranking
        // Del recommended_supermarket va trovato
        // $recommended_supermarket = [
        //     "chain" => $recommended_supermarket_chain,
        //     "name" => $recommended_supermarket_name,
        //     "latitude" => $recommended_supermarket_latitude,
        //     "longitude" => $recommended_supermarket_longitude,
        //     "distance" => $recommended_supermarket_distance,
        //     "totalPrice" => $recommended_supermarket_totalPrice
        // ];

        //  Trovo il ranking dei supermercati più vicini rispetto alla posizione dell'utente senza usare RAW_NUMBER or RANK

        // Calcola il ranking dei supermercati più vicini rispetto alla posizione dell'utente
        $nearestSupermarketRanking = "SELECT chain, supermarkets.name, ST_Distance_Sphere(location, POINT($user_latitude, $user_longitude)) AS distance FROM `supermarkets` ORDER BY distance";
        $result = $conn->query($nearestSupermarketRanking);
        $nearestSupermarketRankingArray = array();
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $nearestSupermarketRankingArray[$row['chain']][$row['name']] = $rank;
            $rank++;
        }

        // Calcola il ranking dei supermercati più economici rispetto ai prodotti nel carrello
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
        $recommended_supermarket_rank = PHP_INT_MAX; // Inizializzato con il valore massimo intero per trovare il minimo
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
        
        // Trova la distanza del supermercato consigliato dalla user_location
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

        // Trovo i prezzi del supermercato consigliato dei prodotti nel carrello ossia nella tabella Cart
        // i prodotti nel carrello li troviamo nella tabella Cart

        // Nome 	Quantità 	Categoria 	 	
        // Abbracci Mulino Bianco 	2 	Dolci
        // Aglio 	2 	Vegetali
        
        // e i prezzi dei prodotti nei supermercati nella tabella supermarkets_products
        //  supermarket_name 	supermarket_chain 	product_name Crescente 1 	price 	
        // Anagnina 	Carrefour 	Abbracci Mulino Bianco 	10.15
        // Aurelia 	Carrefour 	Abbracci Mulino Bianco 	6.05
        // Axa 	Carrefour 	Abbracci Mulino Bianco 	8.81
        // Anagnina 	Carrefour 	Aglio 	10.27
        // Aurelia 	Carrefour 	Aglio 	1.45
        // Axa 	Carrefour 	Aglio 	5.44

        // Creo l'array $productPrices, un array con tutti prodotti nel carrello, le loro quantità e i prezzi medi di tutti supermercati
        // [Nome, Quantità, Prezzo]
        $MediumProductsPrices = array();
        $MediumTotalPrice = 0;
        $productPrices = "SELECT product_name, Quantità, AVG(price) AS price FROM Cart, supermarkets_products WHERE Cart.Nome = supermarkets_products.product_name GROUP BY product_name";
        $result = $conn->query($productPrices);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['price'] = round($row['price'], 2);
                $MediumProductsPrices[] = $row;

                $MediumTotalPrice += $row['price'] * $row['Quantità'];
            }
        }
        
        $MediumTotalPrice = round($MediumTotalPrice, 2);
        
        // Create an associative array with the data to return
        $responseData = array(
            "nearestSupermarket" => $nearest_supermarket,
            "cheapestSupermarket" => $cheapest_supermarket,
            "recommendedSupermarket" => $recommended_supermarket,
            "MediumProductsPrices" => $MediumProductsPrices,
            "MediumTotalPrice" => $MediumTotalPrice,
            "user_latitude" => $user_latitude, 
            "user_longitude" => $user_longitude
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

}

$conn->close();
