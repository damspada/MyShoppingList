<?php

use Tests\Support\AcceptanceTester;

class FillCartCest
{
    public function AggiuntaSupermercato (AcceptanceTester $I)
    {
        $I->maximizeWindow();
        // Step 1: Go to the homepage
        $I->amOnPage('/home.html');
        $I->wait(3);
        // Step 2: Check if you are on the homepage
        $I->see('How do we help you?'); // Assuming there's an h1 with this text

        $I->click('Login');

        $I->wait(2);

        $I->fillField('campo1', 'mattiaraffaele@gmail.com'); // Compila il campo email
        $I->fillField('campo2', '123'); // Compila il campo password

        $I->wait(3);

        $I->click('accesso'); // Clicca il pulsante di login
        $I->wait(3);

        $I->click('Home');

        $I->wait(2);

        $I->click('Supermarkets');

        $I->wait(2);

        $I->click('Register a New Supermarket');

            // Compila i campi del modulo
        $I->fillField('#Aggiungi_chainInput', 'AAAA'); // Campo Catena
        $I->fillField('#Aggiungi_nameInput', 'Tiburtina'); // Campo Nome
        $I->fillField('#Aggiungi_latitudineInput', '45.123456'); // Campo Latitudine
        $I->fillField('#Aggiungi_longitudineInput', '9.123456'); // Campo Longitudine

        $I->wait(2);
        
        // Clicca il pulsante per aggiungere il supermercato
        $I->click('#submitAggiungiSupermarkets');


        $I->wait(2);

        $I->click('Edit a Registered Supermarket');

        $I->wait(2);

        $I->fillField('#Modifica_chainInput', 'AAAA');  // Riempi il campo "Catena"
        $I->fillField('#Modifica_nameInput', 'Tiburtina');  // Riempi il campo "Nome"
        $I->fillField('#Modifica_latitudineInput', '40');  // Riempi il campo "Latitudine"
        $I->fillField('#Modifica_longitudineInput', '40');  // Riempi il campo "Longitudine"

        $I->click('#submitModificaSupermarkets');

        $I->wait(2);

        $I->click('Delete a Registered Supermarket');

        $I->wait(2);

        $I->fillField('#Delete_chainInput', 'AAAA');  // Riempi il campo "Catena"
        $I->fillField('#Delete_nameInput', 'Tiburtina');  // Riempi il campo "Nome"

        $I->click('#submitDeleteSupermarkets');  // Clicca per eliminare

        $I->wait(2);

    } 

    public function Checkout (AcceptanceTester $I)
    {
        $I->maximizeWindow();
        // Step 1: Go to the homepage
        $I->amOnPage('/home.html');
        $I->wait(3);
        // Step 2: Check if you are on the homepage
        $I->see('How do we help you?'); // Assuming there's an h1 with this text

        $I->click('Login');

        $I->wait(2);

        $I->fillField('campo1', 'mattiaraffaele.r@outlook.it'); // Compila il campo email
        $I->fillField('campo2', '123'); // Compila il campo password

        $I->wait(3);

        $I->click('accesso'); // Clicca il pulsante di login
        $I->wait(3);

        $I->click('Home');
        $I->seeInCurrentUrl('/home/home.html');

        $I->wait(3);

        $I->click('#TEST');

        $I->wait(5);

        $I->click('Add to Cart');

        $I->wait(2);

        $I->click('Carote');

        $I->wait(2);

        $I->click('Fanta');

        $I->wait(3);

        $I->click('#Carne');

        $I->wait(3);

        $I->click('Salsicce');

        $I->wait(3);

        $I->click('+');

        $latitude = 41;  // Esempio di latitudine
        $longitude = 12; // Esempio di longitudine
        $I->executeJS("
        navigator.geolocation.getCurrentPosition = function(success, error) {
            var position = { coords: { latitude: $latitude, longitude: $longitude } };
            success(position);
        };
        
        // Per assicurarsi che la funzione venga chiamata
        $(document).ready(function () {
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    console.log('Simulated geolocation:', position.coords.latitude, position.coords.longitude);
                    // Simulazione dell'invio dei dati
                    $.post('server.php', {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude,
                        session_id: getSessionId()
                    }, function (response) {
                        console.log('Response from server:', response);
                    });
                });
            } else {
                console.log('Geolocation is not available');
            }
        });
    ");

        $I->click('Checkout');

        $I->wait(5);

        $I->click('SAVE YOUR CART');

        $I->wait(3);
    }
}