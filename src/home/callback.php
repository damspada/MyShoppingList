<?php
session_start();
// Configura i dettagli dell'app GitHub
$clientId = 'Ov23li8fPAWLW5JGKcl1';
$clientSecret = 'e0b792dd27c7fee3b3668176f1d312c9f85fbc7f';
$redirectUri = 'http://localhost/msl/MyShoppingList/src/home/callback.php'; // Assicurati che sia lo stesso di login.php

$_SESSION['logged_github'] = false; // Imposta il flag di accesso GitHub nella sessione
$_SESSION['name'] = '';
$_SESSION['email_git'] = '';


// Verifica se è presente il codice di autorizzazione
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $_SESSION['logged_github'] = false; // Imposta il flag di accesso GitHub nella sessione
    $_SESSION['name'] = '';
    $_SESSION['email_git'] = '';
    
    // Richiedi l'access token a GitHub
    $tokenUrl = 'https://github.com/login/oauth/access_token';
    $postData = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'code' => $code,
        'redirect_uri' => $redirectUri,
    ];

    // Invia la richiesta POST a GitHub
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $accessToken = $data['access_token'];

    // Utilizza l'access token per ottenere i dati dell'utente
    $userUrl = 'https://api.github.com/user';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $userUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'User-Agent: Demo',
        "Authorization: token $accessToken"
    ));
    $userData = curl_exec($ch);
    curl_close($ch);

    $user = json_decode($userData, true);

    // Qui puoi salvare i dati dell'utente nel database o creare una sessione
    echo "Ciao " . htmlspecialchars($user['login']) . ", la tua registrazione è stata completata!<br>";
    if (isset($user['name']) && !empty($user['name'])) {
        echo "Nome: " . htmlspecialchars($user['name']) . "<br>";
    } else {
        echo "Nome: Non disponibile<br>";
    }
    // Gestisci i dati dell'utente
    $_SESSION['user'] = $user; // Salva i dati dell'utente nella sessione
    $_SESSION['name']=$user['name'];

    //stessa cosa ma per ottenere l'email
    $email_url = 'https://api.github.com/user/emails';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $email_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'User-Agent: Demo',
        "Authorization: token $accessToken"
    ));
    $userEmail = curl_exec($ch);
    curl_close($ch);
    $email=json_decode($userEmail, true);

    // Stampa il nome e l'email dell'utente
    
    echo 'Email: ' . $email[0]['email'];
    
    
    // Gestisci i dati dell'utente
    
    $_SESSION['email']=$email[0]['email'];
    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        echo "email settata";
        $_SESSION['logged_github'] = true;
    }
     // Imposta il flag di accesso GitHub nella sessione

    
    // Reindirizza l'utente alla tua applicazione
    header('Location: http://localhost/msl/MyShoppingList/src/User_Page/user.html'); // Modifica questo URL secondo le tue esigenze
    exit;
   
} else {
    echo 'Errore: codice di autorizzazione mancante.';
}



?>