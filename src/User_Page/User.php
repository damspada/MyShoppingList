<?php

namespace Mattiaricciardelli\MyShoppingList\User_page;
use Mattiaricciardelli\MyShoppingList\Search_products\Product;

class User
{
    protected $id;
    protected $email;
    protected $password;
    protected $firstName;
    protected $lastName;
    protected $birthDate;
    protected $phoneNumber;
    protected $lifestyle;
    protected $budget;
    protected $adm; // 0 per utente normale, 1 per admin

    public function __construct($id, $email, $password, $firstName, $lastName, $birthDate, $phoneNumber, $lifestyle, $budget, $adm = 0)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->phoneNumber = $phoneNumber;
        $this->lifestyle = $lifestyle;
        $this->budget = $budget;
        $this->adm = $adm;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getLifestyle()
    {
        return $this->lifestyle;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function isAdmin()
    {
        return $this->adm === 1;
    }

    public function addProductToCart($conn, Product $product)
    {
        $product_name = $product->getName();
        $product_category = $product->getCategory();
        $product_image = $product->getImage();
        $product_quantity = 1;

        $select_cart = "SELECT * FROM `Cart` WHERE Nome = '$product_name'";
        $res = $conn->query($select_cart);

        if ($res->num_rows > 0) {
            // Se il prodotto è già nel carrello, aggiorna la quantità
            $update_query = "UPDATE `Cart` SET Quantità = Quantità + 1 WHERE Nome = '$product_name'";
            if ($conn->query($update_query) === TRUE) {
                return "success";  // Restituisci "success" se l'aggiornamento va a buon fine
            } else {
                return "failed";   // Restituisci "failed" in caso di errore
            }
        } else {
            // Se il prodotto non è nel carrello, inseriscilo
            $insert_product = "INSERT INTO `Cart` (Nome, Quantità, Categoria, Immagine) VALUES ('$product_name', '$product_quantity', '$product_category', '$product_image')";
            if ($conn->query($insert_product) === TRUE) {
                return "success";  // Restituisci "success" se l'inserimento va a buon fine
            } else {
                return "failed";   // Restituisci "failed" in caso di errore
            }
        }
    }
}
