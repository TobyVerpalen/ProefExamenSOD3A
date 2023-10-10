<?php
class HomePage {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }
    }

    public function render() {
        echo "Welcome!";
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>Home</title>";
        echo "</head>";
        echo "<body>";
        echo "<h2>Home</h2>";
        echo "<p>Hello, you are logged in.</p>";
        echo "<ul>";
        echo "<li><a href='vote.php'>Stemmen</a></li>";
        echo "<li><a href='reset_password.php'>Reset password</a></li>";
        echo "<li><a href='logout.php'>Log out</a></li>";
        echo "<li><a href='information.php'>Informatie</a></li>";
        echo "</ul>";
        echo "</body>";
        echo "</html>";
    }
}