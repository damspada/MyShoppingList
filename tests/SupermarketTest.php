<?php

use PHPUnit\Framework\TestCase;
use Mattiaricciardelli\MyShoppingList\Management_Supermarkets\Supermarket;
use Mattiaricciardelli\MyShoppingList\User_page\User;
use Mattiaricciardelli\MyShoppingList\User_page\Admin;

class SupermarketTest extends TestCase
{
    private $conn;
    private $supermarket;
    private $admin;

    protected function setUp(): void
    {
        // Configura la connessione al database (assicurati che il database di test esista)
        $this->conn = new mysqli("127.0.0.1", "root", "", "myshopping");
        
        // Verifica la connessione
        if ($this->conn->connect_error) {
            $this->fail("Connection failed: " . $this->conn->connect_error);
        }

        // Instanzia la classe Supermarket e Admin
        $this->supermarket = new Supermarket("MD", "Anagnina", "41.40338", "2.17403");
        $this->admin = new Admin("1", "admin@example.com", "password", "Admin", "User", "1980-01-01", "1234567890", "Normale", 100);
    }

    protected function tearDown(): void
    {
        // Chiude la connessione al database
        $this->conn->close();
    }

    // Test sui getter/setter della classe Supermarket
    public function testSupermarketCreation()
    {
        // Verifica i valori iniziali del supermercato
        $this->assertEquals("MD", $this->supermarket->getChain());
        $this->assertEquals("Anagnina", $this->supermarket->getName());
        $this->assertEquals("41.40338", $this->supermarket->getLatitude());
        $this->assertEquals("2.17403", $this->supermarket->getLongitude());
    }

    public function testAdminGetters()
    {
        // Verifica i valori dell'admin
        $this->assertEquals("1", $this->admin->getId());
        $this->assertEquals("admin@example.com", $this->admin->getEmail());
        $this->assertEquals("password", $this->admin->getPassword());
        $this->assertEquals("Admin", $this->admin->getFirstName());
        $this->assertEquals("User", $this->admin->getLastName());
        $this->assertEquals("1980-01-01", $this->admin->getBirthDate());
        $this->assertEquals("1234567890", $this->admin->getPhoneNumber());
        $this->assertEquals("Normale", $this->admin->getLifestyle());
        $this->assertEquals(100, $this->admin->getBudget());
        $this->assertTrue($this->admin->isAdmin()); // L'admin è un admin
    }

    // Test CRUD con la classe Admin e il Supermarket
    public function testAdminCRUD()
    {
        $chain = 'MD';
        $name = 'Anagnina';
        $latitude = '41.40338';
        $longitude = '2.17403';

        // Aggiunta di un supermercato con l'Admin
        $result = $this->admin->addSupermarket($this->conn, $this->supermarket);
        $this->assertEquals("Supermercato aggiunto con successo!", $result);

        // Aggiorna la posizione del supermercato con l'Admin
        $newLatitude = '42.0';
        $newLongitude = '3.0';
        $this->supermarket->setLatitude($newLatitude);
        $this->supermarket->setLongitude($newLongitude);

        $result = $this->admin->updateSupermarket($this->conn, $this->supermarket);
        $this->assertEquals("Supermercato aggiornato con successo!", $result);

        // Verifica l'aggiornamento nel database
        $stmt = $this->conn->prepare("SELECT ST_AsText(location) AS location FROM supermarkets WHERE chain = ? AND name = ?");
        $stmt->bind_param("ss", $chain, $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $this->assertEquals("POINT(42 3)", $row['location']);  // Verifica la nuova posizione

        // Elimina il supermercato con l'Admin
        $result = $this->admin->deleteSupermarket($this->conn, $this->supermarket);
        $this->assertEquals("Supermercato eliminato con successo!", $result);

        // Verifica se il supermercato è stato effettivamente eliminato
        $stmt = $this->conn->prepare("SELECT * FROM supermarkets WHERE chain = ? AND name = ?");
        $stmt->bind_param("ss", $chain, $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->assertEquals(0, $result->num_rows);  // Verifica che il supermercato sia stato eliminato
    }
}