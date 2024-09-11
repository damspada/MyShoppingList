<?php

namespace Mattiaricciardelli\MyShoppingList\Home; // Usa la prima lettera maiuscola e il punto e virgola

use mysqli; // Importa la classe mysqli per evitare possibili errori

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Creazione della connessione
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica della connessione
        if ($this->conn->connect_error) {
            die("Connessione al database fallita: " . $this->conn->connect_error);
        }
    }

    public function verifyUser($email, $pass) {
        $sql = "SELECT * FROM utenti WHERE email = '$email' AND pass = '$pass'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function clearCart() {
        $sql = "DELETE FROM `Cart`";
        return $this->conn->query($sql);
    }

    public function getUser($email) {
        $sql = "SELECT * FROM utenti WHERE email='$email'";
        $result = $this->conn->query($sql);

        $utente = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $utente[] = $row;
            }
        }
        return $utente;
    }

    public function close() {
        $this->conn->close();
    }
}