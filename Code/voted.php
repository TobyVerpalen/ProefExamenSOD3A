<?php
session_start();
require_once 'Database.php';

class VotedPage {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function displaySelectedCandidate() {
        // Check if the user is logged in; otherwise, redirect them to the login page
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        // Check if the selected candidate information is in the session
        if (isset($_SESSION['selected_candidate_id'])) {
            $selectedCandidateId = $_SESSION['selected_candidate_id'];
            $conn = $this->db->getConnection();

            // Query the database to retrieve the details of the selected candidate
            $sqlCandidateDetails = "SELECT * FROM party_leaders WHERE id = :candidate_id";
            $stmt = $conn->prepare($sqlCandidateDetails);
            $stmt->bindParam(':candidate_id', $selectedCandidateId, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $itemName = $row['name'];
                $partyName = $row['party_name'];

                echo "<h2>Je hebt gestemd voor:</h2>";
                echo "<p>Partij: $partyName</p>";
                echo "<p>Partijleider: $itemName</p>";
            } else {
                echo "Geselecteerde kandidaat niet gevonden.";
            }
        } else {
            echo "Geen steminformatie gevonden.";
        }
        echo "<p><a href='index.php'>Startpagina</a></p>";
        echo "<p><a href='logout.php'>Log out</a></p>";
    }
}

$db = new Database();
$votedPage = new VotedPage($db);
$votedPage->displaySelectedCandidate();
?>
