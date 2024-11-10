<?php
session_start();
if (isset($_SESSION["user_id"]) && isset($_POST['review'])) {
    $user_id = $_SESSION["user_id"];
    $review = trim($_POST['review']);
    
    // Poveži se na bazu podataka
    $conn = new mysqli("student.veleri.hr", "alisic", "11", "alisic");
    if ($conn->connect_error) {
        die("Greška pri povezivanju: " . $conn->connect_error);
    }

    // Unesi recenziju u tablicu
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, review, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("is", $user_id, $review); // Bindaj user_id kao INT i review kao STRING
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Recenzija je uspješno spremljena!";
    } else {
        echo "Greška pri unosu recenzije.";
    }

    $stmt->close();
    $conn->close();
    
    // Preusmjeri na index.html
    header("Location: index.php");
    exit();
}
?>
