<?php
// Uključi konekciju na bazu podataka
include('db_connection.php');

// Dohvati recenzije iz baze podataka
$query = "SELECT reviews.review, reviews.created_at, users.user_name 
          FROM reviews 
          JOIN users ON reviews.user_id = users.id 
          ORDER BY reviews.created_at DESC";  // Sortiraj po datumu (najnovije prvo)

echo "SQL Upit: " . $query;  // Ispisivanje upita za debugiranje

$result = $conn->query($query);

// Prikazivanje recenzija
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="review">';
        echo '<p><strong>' . htmlspecialchars($row['user_name']) . '</strong> (' . date("d-m-Y H:i", strtotime($row['created_at'])) . '):</p>';
        echo '<p>' . htmlspecialchars($row['review']) . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>Još uvijek nema recenzija.</p>';
}

// Zatvaranje konekcije s bazom
$conn->close();
?>
