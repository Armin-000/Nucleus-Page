<?php
$error_message = "";
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'invalid_password') {
        $error_message = "Ups, upisali ste krivu lozinku ili nemate račun? Ako nemate račun, registrirajte se.";
    } elseif ($_GET['error'] == 'user_not_found') {
        $error_message = "Korisnik nije pronađen. Molimo provjerite podatke ili se registrirajte.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greška</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('N8_220527_09_Card_Game_8672.jpeg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #fff;
        }
        .error-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .error-container img {
            max-width: 30%;
            height: auto;
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .error-message {
            font-size: 1.4em;
            font-weight: bold;
            margin-bottom: 20px;
            animation: slideIn 1s ease-in-out;
        }
        @keyframes slideIn {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6f61;
            border: none;
            border-radius: 20px;
            color: #fff;
            font-size: 1.1em;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        .back-button:hover {
            background-color: #d9534f;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- Logo -->
        <img src="Cochlear_Limited_Logo_new_branding_from_2020.png" alt="Logo" class="img-fluid">
        <!-- Poruka o grešci -->
        <div class="error-message">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
        <!-- Gumb za povratak -->
        <a href="index.php" class="back-button">Povratak na početnu stranicu</a>
    </div>
</body>
</html>
