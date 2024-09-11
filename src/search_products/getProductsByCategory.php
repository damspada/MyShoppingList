<?php

function getProductsByCategory($conn, $categoria) {
    if ($categoria == "All") {
        $sql2 = "SELECT * FROM `products`";
    } else if ($categoria == "Healty") {
        $sql2 = "SELECT * FROM `products` WHERE health>=8";
    } else {
        $sql2 = "SELECT * FROM `products` WHERE category = '$categoria'";
    }

    $risultato = $conn->query($sql2);
    $productsC = array();
    if ($risultato->num_rows > 0) {
        while ($row = $risultato->fetch_assoc()) {
            $productsC[] = $row;
        }
    }
    return json_encode($productsC);
}