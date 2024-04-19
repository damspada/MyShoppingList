<?php
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

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

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
            <div class="filter-card">
                <img src="Icone/icons8-coltello-e-spatchula-50.png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-pasta-64.png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-carre-di-agnello-60.png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-anguria-64.png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-salmone-64.png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-softdrink-64.png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-sapone-60.png"> 
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-carrot-64.png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-snack-64 (2).png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-barra-di-cioccolato-64 (1).png">
            </div>
            <div class="filter-card">
                <img src="Icone/icons8-inverno-64.png">
            </div>
            <div class="filter-card">
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
            <?php if (!empty($row["image"])) { ?>
                <img src="<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>">
            <?php } ?>
            <h3><?php echo $row["name"]; ?></h3>
            <p><strong>Category:</strong> <?php echo $row["category"]; ?></p>
            <p><strong>Description:</strong> <?php echo $row["description"]; ?></p>
            <p><strong>Nutrients:</strong> <?php echo $row["nutrients"]; ?></p>
            <p><strong>Health Rating:</strong> <?php echo $row["health"]; ?>/10</p>
            <div class="quantity">
                <button onclick="decreaseQuantity('<?php echo $row["name"]; ?>')">-</button>
                <input type="number" id="<?php echo $row["name"]; ?>" value="1" min="1">
                <button onclick="increaseQuantity('<?php echo $row["name"]; ?>')">+</button>
            </div>
            <button onclick="addToCart('<?php echo $row["name"]; ?>')">Add to Cart</button>
        </div>
        <?php
            }
        }else {
            echo "0 products found.";
        }
        ?>
    </div>

    <div class="carrello_div">
        
    </div>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="search_products.js"></script>
<script src="login_script.js"></script>
</html>