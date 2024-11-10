<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dohvati podatke iz forme
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Povezivanje s bazom
    $conn = new mysqli("student.veleri.hr", "alisic", "11", "alisic");
    if ($conn->connect_error) {
        die("Greška pri povezivanju: " . $conn->connect_error);
    }

    // Spremi korisnika u bazu
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();

    // Spremi ID novog korisnika u sesiju
    $_SESSION['user_id'] = $conn->insert_id;

    $conn->close();

    // Preusmjerenje na stranicu za unos recenzije
    header("Location: review_page.php");
    exit();
}
?>
