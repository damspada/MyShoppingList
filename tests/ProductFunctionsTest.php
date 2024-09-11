<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/search_products/getProductsByCategory.php';

class ProductFunctionsTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        // Configura la connessione al database di test
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "MyShopping"; // Usa un database di test

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            $this->fail("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function testGetProductsByCategoryAll() {
        // Testa la funzione con categoria 'All'
        $result = getProductsByCategory($this->conn, 'All');
        $this->assertJson($result);

        $products = json_decode($result, true);
        $this->assertIsArray($products);
    }

    public function testGetProductsByCategoryHealty() {
        // Testa la funzione con categoria 'Healty'
        $result = getProductsByCategory($this->conn, 'Healty');
        $this->assertJson($result);

        $products = json_decode($result, true);
        $this->assertIsArray($products);
        foreach ($products as $product) {
            $this->assertGreaterThanOrEqual(8, $product['health']);
        }
    }

    public function testGetProductsByCategorySpecific() {
        // Testa la funzione con una categoria specifica
        $result = getProductsByCategory($this->conn, 'Carne');
        $this->assertJson($result);

        $products = json_decode($result, true);
        $this->assertIsArray($products);
        foreach ($products as $product) {
            $this->assertEquals('Carne', $product['category']);
        }
    }

    protected function tearDown(): void {
        $this->conn->close();
    }
}