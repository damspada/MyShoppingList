<?php

use PHPUnit\Framework\TestCase;
use Mattiaricciardelli\MyShoppingList\Home\Database;

class DatabaseTest extends TestCase {
    private $db;

    protected function setUp(): void {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "myshopping";

        $this->db = new Database($servername, $username, $password, $dbname);
    }

    public function testVerifyUserSuccess() {
        $email = "test@example.com";
        $pass = "password";

        // Simula un utente corretto
        $user = $this->db->verifyUser($email, $pass);
        $this->assertIsArray($user);
        $this->assertEquals('0', $user['adm']);
    }

    public function testVerifyUserFailure() {
        $email = "wrong@example.com";
        $pass = "wrongpassword";

        // Simula un utente non trovato
        $user = $this->db->verifyUser($email, $pass);
        $this->assertFalse($user);
    }

    protected function tearDown(): void {
        $this->db->close();
    }
}

