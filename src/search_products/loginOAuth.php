<?php
// Configura i dettagli dell'app GitHub
$clientId = 'Ov23li8fPAWLW5JGKcl1';
$redirectUri = 'http://localhost/msl/MyShoppingList/src/home/callback.php'; // Cambia con il percorso corretto se necessario
$scope = 'user user:email'; // Puoi aggiungere altri scope se necessario

// Costruisci l'URL di autorizzazione di GitHub
$authorizeUrl = "https://github.com/login/oauth/authorize?client_id={$clientId}&redirect_uri=" . urlencode($redirectUri) . "&scope=user";

// Redirige l'utente a GitHub per l'autenticazione
header("Location: $authorizeUrl");
exit;
?>