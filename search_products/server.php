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

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['Categoria'])) {
        
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

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Categoria'])){
        $categoria=$_GET['Categoria'];
        $sql2 = "SELECT * FROM `products` WHERE Categoria = '$categoria'";
        $risultato = $conn->query($sql2);
        $productsC = array();
        if ($risultato->num_rows > 0) {
            while ($row = $risultato->fetch_assoc()) {
                $productsC[] = $row;
            }
        }
        echo json_encode($productsC);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verifica se sono stati inviati tutti i dati necessari
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

        if (isset($_POST['cestino'])) {
           $Elementi="DELETE FROM `Cart`";
           $update=$conn->query($Elementi);
        }

        if (isset($_POST['close'])){
            $Elementi="DELETE FROM `Cart`";
           $update=$conn->query($Elementi);
        }
    }

    // if (isset($_POST['update_btn']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $update_name = $_POST['update_quantity_name'];
    //     $update_quantity_query = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = '$update_name'";
    //     $update=$conn->query($update_quantity_query);
    //     if($update){
    //         header('location:search_products.php');
    //      };
    //  }

    //  if (isset($_POST['decrease_btn']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $update_name = $_POST['update_quantity_name'];
    //     $Quantità="SELECT * FROM Cart WHERE  Nome = '$update_name'";
    //     $res=$conn->query($Quantità);
    //     $row = $res->fetch_assoc();
    //     $n=$row['Quantità'];
    //     if($n>1){
    //         $update_quantity_query = "UPDATE `Cart` SET Quantità = Quantità - 1 WHERE Nome = '$update_name'";
    //         $update=$conn->query($update_quantity_query);
    //     }else{
    //         $update_cart = "DELETE FROM `Cart` WHERE Nome = '$update_name'";
    //         $update=$conn->query($update_cart);
    //     }

    //     if($update){
    //         header('location:search_products.php');
    //      };
    //  }


    //  if (isset($_POST['cestino']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $Elementi="DELETE FROM `Cart`";
    //     $update=$conn->query($Elementi);
    //     if($update){
    //         header('location:search_products.php');
    //      };
    //  }
    // Close the connection
    $conn->close();
?>