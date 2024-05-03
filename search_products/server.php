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

    //Per visualizzare tutti i prodotti
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['Categoria']) && !isset($_GET['Nome']) && !isset($_GET['Ricetta'])) {
        
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

    //Per visualizzare i prodotti cercati tramite barra di ricerca
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Nome'])){
        $Nome=$_GET['Nome'];
        echo "Il nome inviato è: " . $Nome;
        $sql3 = "SELECT * FROM `products` WHERE `name` LIKE '%$Nome%'";
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
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Categoria'])){
        $categoria=$_GET['Categoria'];
        if($categoria=="All"){
            $sql2 = "SELECT * FROM `products`";
            $risultato = $conn->query($sql2);
            $productsC = array();
            if ($risultato->num_rows > 0) {
                while ($row = $risultato->fetch_assoc()) {
                    $productsC[] = $row;
                }
            }
            echo json_encode($productsC);
        }else{
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

    // if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Ricetta'])){
    //     $Ricetta=$_GET['Ricetta'];
    //     if($Ricetta=="Carbonara"){
    //         $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Uova', 1, 'Dispensa', 'products/uova.jpg')";
    //         $res = $conn->query($insert_product);
    //         $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('Mezze Maniche Barilla', 1, 'Dispensa', 'products/mezze_maniche.jpg')";
    //         $res = $conn->query($insert_product);
    //         $prodotti = [
    //             [
    //                 "name" => "Uova"
    //                 "category"=> "Dispensa"
    //             ],
    //             [
    //                 "name" => "Mezze Maniche Barilla"
    //                 "category"=> "Dispensa"
    //             ]
    //             // Aggiungi altri prodotti qui...
    //         ];
    //         echo json_encode($prodotti);
    //     }
    // }


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
            $prodotto=$_POST['elemento'];
            if($valore == '-1'){
                $Quantità="SELECT * FROM Cart WHERE  Nome = '$prodotto'";
                $res=$conn->query($Quantità);
                $row = $res->fetch_assoc();
                $n=$row['Quantità'];
                if($n>1){
                    $update_quantity_query = "UPDATE `Cart` SET Quantità = Quantità - 1 WHERE Nome = '$prodotto'";
                    $update=$conn->query($update_quantity_query);
                }else{
                    $update_cart = "DELETE FROM `Cart` WHERE Nome = '$prodotto'";
                    $update=$conn->query($update_cart);
                    
                }
            }else{
                $update_quantity_query = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = '$prodotto'";
                $update=$conn->query($update_quantity_query);
            }

        }

        //Per svuotare il carrello premendo l'icona del cestino
        if (isset($_POST['cestino'])) {
           $Elementi="DELETE FROM `Cart`";
           $update=$conn->query($Elementi);
        }

        //Per svuotare il carrello alla chiusura della pagina 
        if (isset($_POST['close'])){
            $Elementi="DELETE FROM `Cart`";
           $update=$conn->query($Elementi);
        }
    }

    $conn->close();
?>