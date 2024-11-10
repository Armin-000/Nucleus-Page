<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli("student.veleri.hr", "alisic", "11", "alisic");
    if ($conn->connect_error) {
        die("Greška pri povezivanju: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: review_page.php");
            exit();
        } else {
            header("Location: error.php?error=invalid_password");
            exit();
        }
    } else {
        header("Location: error.php?error=user_not_found");
        exit();
    }

    $conn->close();
}
?>
