<?php
class ResultsPage {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function displayElectionResults() {
        // Check if the user is logged in; otherwise, redirect them to the login page
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $conn = $this->db->getConnection();

        // Calculate and display election results
        $sqlElectionResults = "SELECT party_name, COUNT(*) AS total_votes FROM votes
                               JOIN party_leaders ON votes.candidate_id = party_leaders.id
                               GROUP BY party_name
                               ORDER BY total_votes DESC";

        $result = $conn->query($sqlElectionResults);

        if ($result->rowCount() > 0) {
            echo "<h2>Verkiezingsresultaten:</h2>";
            echo "<table>";
            echo "<tr><th>Partij</th><th>Totaal aantal stemmen</th></tr>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $partyName = $row['party_name'];
                $totalVotes = $row['total_votes'];

                echo "<tr><td>$partyName</td><td>$totalVotes</td></tr>";
            }

            echo "</table>";
        } else {
            echo "Geen verkiezingsresultaten gevonden.";
        }

        echo "<p><a href='index.php'>Startpagina</a></p>";
        echo "<p><a href='logout.php'>Log out</a></p>";
    }
}