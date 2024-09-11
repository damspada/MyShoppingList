<?php

namespace Mattiaricciardelli\MyShoppingList\User_page;

class Admin extends User
{
    public function __construct($id, $email, $password, $firstName, $lastName, $birthDate, $phoneNumber, $lifestyle, $budget)
    {
        parent::__construct($id, $email, $password, $firstName, $lastName, $birthDate, $phoneNumber, $lifestyle, $budget, 1);
    }

     // Aggiunge un supermercato al database
    public function addSupermarket($conn, $supermarket)
    {
        if (empty($supermarket->getChain()) || empty($supermarket->getName()) || empty($supermarket->getLatitude()) || empty($supermarket->getLongitude())) {
            return "Errore: Tutti i campi sono obbligatori.";
        }

        $location = "POINT(" . $supermarket->getLatitude() . " " . $supermarket->getLongitude() . ")";
        $chain = $supermarket->getChain();
        $name = $supermarket->getName();
        $stmt = $conn->prepare("INSERT INTO supermarkets (chain, name, location) VALUES (?, ?, ST_GeomFromText(?))");
        $stmt->bind_param("sss", $chain, $name, $location);

        if ($stmt->execute()) {
            return "Supermercato aggiunto con successo!";
        } else {
            return "Errore: " . $stmt->error;
        }
    }
 
     // Aggiorna un supermercato nel database
    public function updateSupermarket($conn, $supermarket)
    {
        $location = "POINT(" . $supermarket->getLatitude() . " " . $supermarket->getLongitude() . ")";
        $chain = $supermarket->getChain();
        $name = $supermarket->getName();
        $stmt = $conn->prepare("UPDATE supermarkets SET location = ST_GeomFromText(?) WHERE chain = ? AND name = ?");
        $stmt->bind_param("sss", $location, $chain, $name);
    
        if ($stmt->execute()) {
            return "Supermercato aggiornato con successo!";
        } else {
            return "Errore: " . $stmt->error;
        }
    }
 
     // Elimina un supermercato dal database
    public function deleteSupermarket($conn, $supermarket)
    {
        $chain = $supermarket->getChain();
        $name = $supermarket->getName();
        $stmt = $conn->prepare("DELETE FROM supermarkets WHERE chain = ? AND name = ?");
        $stmt->bind_param("ss", $chain, $name);
    
        if ($stmt->execute()) {
            return "Supermercato eliminato con successo!";
        } else {
            return "Errore: " . $stmt->error;
        }
    }

}