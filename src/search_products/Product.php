<?php

namespace Mattiaricciardelli\MyShoppingList\Search_products;

class Product
{
    private $name;
    private $peso;
    private $image;
    private $category;
    private $description;
    private $nutrients;
    private $health;

    // Costruttore
    public function __construct($name, $peso, $image, $category, $description, $nutrients, $health)
    {
        $this->name = $name;
        $this->peso = $peso;
        $this->image = $image;
        $this->category = $category;
        $this->description = $description;
        $this->nutrients = $nutrients;
        $this->health = $health;
    }

    // Getter e Setter per 'name'
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter e Setter per 'peso'
    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    // Getter e Setter per 'image'
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    // Getter e Setter per 'category'
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    // Getter e Setter per 'description'
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Getter e Setter per 'nutrients'
    public function getNutrients()
    {
        return $this->nutrients;
    }

    public function setNutrients($nutrients)
    {
        $this->nutrients = $nutrients;
    }

    // Getter e Setter per 'health'
    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    // Funzione per ottenere i prodotti per categoria
    public static function getProductsByCategory($conn, $categoria)
    {
        if ($categoria == "All") {
            $sql = "SELECT * FROM `products`";
        } else if ($categoria == "Healty") {
            $sql = "SELECT * FROM `products` WHERE health >= 8";
        } else {
            $sql = "SELECT * FROM `products` WHERE category = '$categoria'";
        }

        $risultato = $conn->query($sql);
        $productsC = array();
        if ($risultato->num_rows > 0) {
            while ($row = $risultato->fetch_assoc()) {
                $productsC[] = $row;
            }
        }

        return json_encode($productsC);
    }
}