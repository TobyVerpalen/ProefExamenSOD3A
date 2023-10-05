<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Hier kun je content voor ingelogde gebruikers plaatsen
echo "Welcome!";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Home</h2>
    <p>Hello, you are logged in.</p>
    <ul>
        <li><a href="vote.php">Stemmen</a></li>
        <li><a href="reset_password.php">Reset password</a></li>
        <li><a href="logout.php">Log out</a></li>
    </ul>
</body>
</html>
