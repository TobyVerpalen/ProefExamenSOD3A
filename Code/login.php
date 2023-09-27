<?php
session_start();
require_once 'Database.php';
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $user = new User($db->getConnection());

    $username = $_POST['username'];
    $password = $_POST['password'];

    $loggedInUser = $user->login($username, $password);

    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        header('Location: index.php');
        exit;
    } else {
        echo "Login failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
        <p><a href="register.php">Register</a></p>
    </form>
</body>
</html>
