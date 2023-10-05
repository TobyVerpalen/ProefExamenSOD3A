<?php
session_start();
require_once 'Database.php';
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();
    $user = new User($db->getConnection());

    $logged_in_user = $user->login($username, $password);

    if ($logged_in_user) {
        $_SESSION['user_id'] = $logged_in_user['id'];
        echo "Inloggen gelukt. Welkom, " . $logged_in_user['username'] . "!<br>";
        echo "<a href='reset_password.php'>Wachtwoord vergeten?</a><br>";
        echo "<a href='vote.php'>Stem op kandidaten</a>"; // Voeg de link naar de vote-pagina toe
    } else {
        echo "Inloggen mislukt. Controleer je gebruikersnaam en wachtwoord.";
    }
} else {
    // Toon het inlogformulier
    echo "<h2>Inloggen</h2>";
    echo "<form method='POST' action='login.php'>";
    echo "Gebruikersnaam: <input type='text' name='username' required><br><br>";
    echo "Wachtwoord: <input type='password' name='password' required><br><br>";
    echo "<button type='submit'>Inloggen</button>";
    echo "<p><a href='register.php'>Log out</a></p>";
    echo "</form>";
}
