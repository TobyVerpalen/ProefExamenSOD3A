<?php
session_start();
require_once 'Database.php';

class VotingPage {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function displayCandidates() {
        // Controleer of de gebruiker is ingelogd, anders stuur ze naar de inlogpagina
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $conn = $this->db->getConnection();

        // Haal de lijst van kandidaten op uit de database
        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
            echo "<h2>Kandidaten</h2>";
            echo "<form method='POST' action='vote.php'>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $itemId = $row['id'];
                $itemName = $row['title'];

                echo "<label>";
                echo "<input type='radio' name='candidate_id' value='$itemId'>";
                echo "$itemName";
                echo "</label><br>";
            }

            echo "<button type='submit'>Stem</button>";
            echo "</form>";
        } else {
            echo "Geen kandidaten gevonden.";
        }

        echo "<p><a href='logout.php'>Log out</a></p>";
    }
}

// Maak een databaseverbinding
$db = new Database();

// Maak een instantie van de VotingPage klasse en toon de kandidaten
$votingPage = new VotingPage($db);
$votingPage->displayCandidates();
?>
