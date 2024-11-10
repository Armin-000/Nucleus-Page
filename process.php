<?php
$server = "ucka.veleri.hr";
$username = "alisic";
$password = "11";
$database = "alisic";

// Povezivanje na bazu podataka
$conn = new mysqli($server, $username, $password, $database);

// Provjera veze
if ($conn->connect_error) {
    die("Povezivanje nije uspjelo: " . $conn->connect_error);
}

// Dohvaćanje podataka iz POST zahtjeva
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Priprema SQL upita za unos podataka
$sql = "INSERT INTO kontakt (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Izvršavanje SQL upita i provjera
if ($stmt->execute()) {
    echo "Poruka je uspješno poslana!";
} else {
    echo "Greška: " . $conn->error;
}

// Zatvaranje konekcije
$stmt->close();
$conn->close();
?>
