<?php
session_start();
require_once 'Database.php';

class VotingPage {
    private $db; // Voeg een privé-databasemember toe

    public function __construct($db) {
        $this->db = $db;
    }

    // ... (andere code)

    public function vote($candidateId) {
        // Controleer of de gebruiker is ingelogd, anders stuur ze naar de inlogpagina
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $conn = $this->db->getConnection();

        // Controleer of de gebruiker al heeft gestemd op deze kandidaat
        $sql = "SELECT * FROM votes WHERE user_id = :user_id AND item_id = :item_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $candidateId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Je hebt al gestemd op deze kandidaat.";
        } else {
            // Voer de stem in de database in
            $sql = "INSERT INTO votes (user_id, item_id) VALUES (:user_id, :item_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':item_id', $candidateId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Je hebt gestemd op kandidaat met ID $candidateId.";
            } else {
                echo "Stemmen mislukt.";
            }
        }

        echo "<p><a href='index.php'>Terug naar de startpagina</a></p>";
    }
}

// ... (andere code)

// Maak een databaseverbinding
$db = new Database();

// Verwerk het stemformulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidateId = $_POST['candidate_id'];
    $votingPage = new VotingPage($db); // Geef de databaseverbinding door aan de klasse
    $votingPage->vote($candidateId);
}

