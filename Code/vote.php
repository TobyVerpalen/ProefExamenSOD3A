<?php
session_start();
require_once 'Database.php';

class VotingPage {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function displayCandidates() {
        // Check if the user is logged in; otherwise, redirect them to the login page
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $conn = $this->db->getConnection();

        // Check if the user has already voted
        if ($this->hasUserVoted($_SESSION['user_id'])) {
            echo "Je hebt al gestemd.";
            echo "<p><a href='index.php'>Startpagina</a></p>";
            echo "<p><a href='index.php'>Log out</a></p>";
            return; // Exit early, preventing the user from voting again
        }

        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['candidate_id'])) {
                $candidateId = $_POST['candidate_id'];
                $this->recordVote($_SESSION['user_id'], $candidateId);
                // Optionally, you can display a confirmation message here.
                header('Location: voted.php'); // Redirect to the voted.php page after voting
                exit;
            }
        }

        // Display the list of candidates
        $sqlCandidates = "SELECT * FROM party_leaders";
        $resultCandidates = $conn->query($sqlCandidates);

        if ($resultCandidates->rowCount() > 0) {
            echo "<h2>Partijleiders</h2>";
            echo "<form method='POST' action=''>"; // Remove action attribute to submit to the same page

            while ($row = $resultCandidates->fetch(PDO::FETCH_ASSOC)) {
                $itemId = $row['id'];
                $itemName = $row['name'];
                $partyName = $row['party_name'];

                echo "<label>";
                echo "<input type='radio' name='candidate_id' value='$itemId'>";
                echo "$itemName ($partyName)";
                echo "</label><br>";
            }

            echo "<button type='submit'>Stem</button>";
            echo "</form>";
        } else {
            echo "Geen partijleiders gevonden.";
        }

        echo "<p><a href='logout.php'>Log out</a></p>";
    }

    // Check if the user has already voted
    private function hasUserVoted($userId) {
        $conn = $this->db->getConnection();
        $sqlCheckVote = "SELECT COUNT(*) FROM votes WHERE user_id = :user_id";
        $stmt = $conn->prepare($sqlCheckVote);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $voteCount = $stmt->fetchColumn();
        return $voteCount > 0;
    }

    // The recordVote method should be defined only once in this class
    public function recordVote($userId, $candidateId) {
        $conn = $this->db->getConnection();

        // Prepare an SQL statement to insert the vote
        $sqlInsertVote = "INSERT INTO votes (user_id, candidate_id) VALUES (:user_id, :candidate_id)";
        $stmt = $conn->prepare($sqlInsertVote);

        // Bind parameters
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':candidate_id', $candidateId, PDO::PARAM_INT);

        // Execute the insert statement
        $stmt->execute();

        // Store the selected candidate's information in the session
        $_SESSION['selected_candidate_id'] = $candidateId;
    }
}

$db = new Database();
$votingPage = new VotingPage($db);
$votingPage->displayCandidates();
?>
