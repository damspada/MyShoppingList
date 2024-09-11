<?php

use PHPUnit\Framework\TestCase;
use Mattiaricciardelli\MyShoppingList\Search_products\Product;
use Mattiaricciardelli\MyShoppingList\User_page\User;

class ProductTest extends TestCase {
    private $conn;
    private $product;
    private $user;

    // Configura la connessione al database di test
    protected function setUp(): void {
        $this->conn = new mysqli("localhost", "root", "", "myshopping");

        // Verifica la connessione
        if ($this->conn->connect_error) {
            $this->fail("Connessione al database fallita: " . $this->conn->connect_error);
        }

        $this->product = new Product("Aglio", 1000, "products/aglio.jpg", "Vegetali", "Aglio utilizzato in molte preparazioni", "nutrienti da specificare", 10);
        $this->user = new User(1, "user@example.com", "password123", "John", "Doe", "1990-01-01", "1234567890", "Normale", 50);
    }

    // Chiudi la connessione al database dopo ogni test
    protected function tearDown(): void {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // Test dei getter e setter della classe Product
    public function testProductGettersSetters() {

        // Test dei getter di Product
        $this->assertEquals("Aglio", $this->product->getName());
        $this->assertEquals(1000, $this->product->getPeso());
        $this->assertEquals("products/aglio.jpg", $this->product->getImage());
        $this->assertEquals("Vegetali", $this->product->getCategory());
        $this->assertEquals("Aglio utilizzato in molte preparazioni", $this->product->getDescription());
        $this->assertEquals("nutrienti da specificare", $this->product->getNutrients());
        $this->assertEquals(10, $this->product->getHealth());
    }

    // Test dei getter e setter della classe User
    public function testUserGettersSetters() {
        // Test dei getter di User
        $this->assertEquals(1, $this->user->getId());
        $this->assertEquals("user@example.com", $this->user->getEmail());
        $this->assertEquals("password123", $this->user->getPassword());
        $this->assertEquals("John", $this->user->getFirstName());
        $this->assertEquals("Doe", $this->user->getLastName());
        $this->assertEquals("1990-01-01", $this->user->getBirthDate());
        $this->assertEquals("1234567890", $this->user->getPhoneNumber());
        $this->assertEquals("Normale", $this->user->getLifestyle());
        $this->assertEquals(50, $this->user->getBudget());
    }

    // Test della funzione addToCart di User
    public function testUserAddToCart() {

        // Esegui l'operazione di aggiunta al carrello
        $result = $this->user->addProductToCart($this->conn, $this->product);

        // Verifica che il prodotto sia stato aggiunto correttamente
        $this->assertStringContainsString("success", $result);

        // Controlla se il prodotto esiste nel carrello
        $select_cart = "SELECT * FROM `Cart` WHERE Nome = 'Aglio'";
        $res = $this->conn->query($select_cart);
        $this->assertGreaterThan(0, $res->num_rows); // Verifica che ci siano risultati
    }

    // Test della funzione getProductsByCategory
    public function testGetProductsByCategoryAll()
    {
        // Test con categoria "All"
        $result = Product::getProductsByCategory($this->conn, "All");
        $products = json_decode($result, true);

        $this->assertIsArray($products);
        $this->assertGreaterThan(0, count($products)); // Verifica che ci siano prodotti nel database
    }

    public function testGetProductsByCategoryHealthy()
    {
        // Test con categoria "Healthy"
        $result = Product::getProductsByCategory($this->conn, "Healthy");
        $products = json_decode($result, true);

        $this->assertIsArray($products);
        foreach ($products as $product) {
            $this->assertGreaterThanOrEqual(8, $product['health']);
        }
    }

    public function testGetProductsBySpecificCategory()
    {
        // Test con una categoria specifica, ad esempio "Vegetali"
        $result = Product::getProductsByCategory($this->conn, "Vegetali");
        $products = json_decode($result, true);

        $this->assertIsArray($products);
        foreach ($products as $product) {
            $this->assertEquals("Vegetali", $product['category']);
        }
    }
}