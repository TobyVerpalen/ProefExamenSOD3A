<?php
class PartiesPage {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function displayPartyInfo() {
        // Check if the user is logged in; otherwise, redirect them to the login page
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $conn = $this->db->getConnection();

        // Query om informatie over politieke partijen op te halen
        $sqlPartyInfo = "SELECT party_name, description, image_path FROM political_parties";

        $result = $conn->query($sqlPartyInfo);

        if ($result->rowCount() > 0) {
            echo "<h2>Informatie over politieke partijen:</h2>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $partyName = $row['party_name'];
                $description = $row['description'];
                $imagePath = $row['image_path'];

                echo "<div>";
                echo "<h3>$partyName</h3>";
                echo "<p>$description</p>";
                echo "<img src='$imagePath' alt='$partyName'>";
                echo "</div>";
            }
        } else {
            echo "Geen informatie over politieke partijen gevonden.";
        }

        echo "<p><a href='index.php'>Startpagina</a></p>";
        echo "<p><a href='logout.php'>Log out</a></p>";
    }
}