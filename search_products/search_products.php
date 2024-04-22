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

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

   
    if (isset($_POST['add_to_cart']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Assicurati di aver stabilito la connessione al database ($conn) prima di eseguire le query

        $product_name = $_POST['product_name'];
        $product_category = $_POST['product_category'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;

        $select_cart = "SELECT * FROM `Cart` WHERE Nome = '$product_name'";
        $res = $conn->query($select_cart);

        if ($res->num_rows > 0) {
            $update_query = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = '$product_name'";
            $update_result = $conn->query($update_query);
        } else {
            $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('$product_name', '$product_quantity', '$product_category', '$product_image')";
            $res = $conn->query($insert_product);
            if ($res) {
                $message[] = 'Product added to cart successfully';
            } else {
                $message[] = 'Error adding product to cart';
            }
        }
    }

    // Close the connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="search_products.css">
    <title>MyShoppingList</title>
</head>

<body>

    <!-- NavBar-->
    <div id="navbar_div">
        <header class="header">
            <img src="Icone/MyShoppingList.png" class="logo">
            <nav class="navbar">
                <a href="../home/home.html">Home</a>
                <a href="#">Contacts</a>
                <a href="#">        
                    <button class="Btn">
                    <div class="sign"><ion-icon name="person-circle-outline" size="large"></ion-icon></div>
                    <div class="text_btn">Login</div>
                    </button>
                </a>
            </nav>
        </header>
    </div>

    <div class="top_div">

        <div class="search">
            <input placeholder="Cerca..." type="text">
            <button type="submit"><ion-icon id="search-icon" name="search" size="medium"></ion-icon></button>
        </div>

        <div class="filter-wrapper">
            <div class="filter-card tooltip-top">
                <img src="Icone/icons8-coltello-e-spatchula-50.png">
            </div>
            <div class="filter-card tooltip-top2">
                <img src="Icone/icons8-pasta-64.png">
            </div>
            <div class="filter-card tooltip-top3">
                <img src="Icone/icons8-carre-di-agnello-60.png">
            </div>
            <div class="filter-card tooltip-top4">
                <img src="Icone/icons8-anguria-64.png">
            </div>
            <div class="filter-card tooltip-top5">
                <img src="Icone/icons8-salmone-64.png">
            </div>
            <div class="filter-card tooltip-top6">
                <img src="Icone/icons8-softdrink-64.png">
            </div>
            <div class="filter-card tooltip-top7">
                <img src="Icone/icons8-sapone-60.png"> 
            </div>
            <div class="filter-card tooltip-top8">
                <img src="Icone/icons8-carrot-64.png">
            </div>
            <div class="filter-card tooltip-top9">
                <img src="Icone/icons8-snack-64 (2).png">
            </div>
            <div class="filter-card tooltip-top10">
                <img src="Icone/icons8-barra-di-cioccolato-64 (1).png">
            </div>
            <div class="filter-card tooltip-top11">
                <img src="Icone/icons8-inverno-64.png">
            </div>
            <div class="filter-card tooltip-top12">
                <img src="Icone/icons8-pomodorini-in-salamoia-64.png">
            </div>
        </div>
    </div> 

    <!--Login e Signin-->
    <div id="login_div">
        <div class="wrapper">
            <span class="icon-close">
                <ion-icon name="close-outline"></ion-icon>
            </span>

            <div class="form-box login">
                <h2>Login</h2>
                <form action="#">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input type="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">Remember Me</label>
                        <a href="#">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <div class="login-register">
                        <p>Don't have an account?<a href="#" class="register-link">Register</a></p>
                    </div>
                </form>
            </div>

            <div class="form-box register">
                <h2>Registration</h2>
                <form action="#">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <input type="text" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input type="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">agree to the terms & conditions</label>
                    </div>
                    <button type="submit" class="btn">Register</button>
                    <div class="login-register">
                        <p>Already have an account?<a href="#" class="login-link">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="prodotti_div">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
        ?>
                <div class="card">
                    <div class="card_image">
                        <?php if (!empty($row["image"])) { ?>
                            <img src="<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>">
                        <?php } ?>
                    </div>
                    <h3><?php echo $row["name"]; ?></h3>
                    <form action="" method="post">
                        <input type="hidden" name="product_name" value="<?php echo $row["name"]; ?>">
                        <input type="hidden" name="product_category" value="<?php echo $row["category"]; ?>">
                        <input type="hidden" name="product_immage" value="<?php echo $row["immage"]; ?>">
                        <input class="bottone_carrello" type="submit" value="Add to Cart" name="add_to_cart">
                    </form>
                </div>
        <?php
            }
        }else {
            echo "0 products found.";
        }
        ?>
    </div>

    <div class="carrello_div">
        <div class="carrello_titolo">
            <h2>Shopping Cart</h2>
        </div>
        <div class="carrello_spesa">
            <!--<?php
            //$carrello = "SELECT * FROM Cart";
            //$risultato = $conn->query($carrello);
            //if ($risultato->num_rows > 0) {
                //while ($riga = $risultato->fetch_assoc()) {
            ?> 
                    <div class="carello_elemento">
                        <h3><?php //echo $riga["Nome"]; ?></h3>
                        <h3><?php //echo $riga["Quantità"]; ?></h3>
                    </div>
            <?php
               // }
            //}
            ?>
            -->
            <div class="carello_elemento">
            </div>
        </div>
        <div class="carrello_checkout">
            <button class="bottone_checkout"><h2>Checkout</h2></button>
        </div>
    </div>

</body>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="search_products.js"></script>
<script src="login_script.js"></script>
</html>