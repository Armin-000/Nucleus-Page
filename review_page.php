<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atraktivna Web Stranica</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="review_page.css">
</head>

<body class="bg-light">

<?php
session_start();

// Provjera da li je korisnik prijavljen
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("student.veleri.hr", "alisic", "11", "alisic");
if ($conn->connect_error) {
    die("Greška pri povezivanju: " . $conn->connect_error);
}

// Unos nove recenzije u bazu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review'])) {
    $review = $_POST['review'];
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, review) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $review);
    $stmt->execute();
    
    header("Location: review_page.php");
    exit();
}

// Brisanje recenzije
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_review_id'])) {
    $delete_review_id = $_POST['delete_review_id'];
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $delete_review_id, $_SESSION['user_id']);
    $stmt->execute();
    
    header("Location: review_page.php");
    exit();
}

// Straničenje
$reviews_per_page = 3;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $reviews_per_page;

// Dohvaćanje recenzija s limitom za straničenje
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT id, review, created_at FROM reviews WHERE user_id = $user_id ORDER BY created_at DESC LIMIT $reviews_per_page OFFSET $offset");

// Brojanje ukupnog broja recenzija
$total_reviews_result = $conn->query("SELECT COUNT(*) AS total FROM reviews WHERE user_id = $user_id");
$total_reviews_row = $total_reviews_result->fetch_assoc();
$total_reviews = $total_reviews_row['total'];
$total_pages = ceil($total_reviews / $reviews_per_page);
?>

<div class="container mt-5">
<!-- Gumb za odjavu -->
<div class="container mt-5">
    <!-- Flex container za logo i gumb -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Logo -->
        <div class="logo">
            <img src="cochlear-logo.png" alt="Logo" class="logo-img">
        </div>
        <!-- Gumb za odjavu -->
        <a href="index.php" class="btn custom-btn mb-3">Odjavi se</a>
    </div>



    <h2 class="text-center mb-4">Vaše Recenzije</h2>

    
    <!-- Forma za unos recenzije -->
    <form method="POST" action="review_page.php" class="mb-4">
        <div class="mb-3">
            <textarea name="review" class="form-control" rows="4" placeholder="Vaša recenzija" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj recenziju</button>
    </form>

    <!-- Prikaz korisničkih recenzija -->
    <div class="list-group">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='list-group-item'>";
                echo "<p class='mb-1'>" . htmlspecialchars($row['review']) . "</p>";
                echo "<small class='text-muted'>" . date('d.m.Y', strtotime($row['created_at'])) . "</small>";
                
                // Gumb za brisanje
                echo "<form method='POST' action='review_page.php' class='mt-2'>";
                echo "<input type='hidden' name='delete_review_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' class='btn btn-danger btn-sm'>Izbriši</button>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "<p class='text-muted'>Nema vaših recenzija.</p>";
        }
        ?>
    </div>
    
    
    <!-- Navigacija za straničenje -->
    <div class="pagination mt-4 d-flex justify-content-center">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1; ?>" class="btn btn-outline-primary mx-1">&laquo; Prethodna</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="btn <?php echo $i == $current_page ? 'btn-primary' : 'btn-outline-primary'; ?> mx-1">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?>" class="btn btn-outline-primary mx-1">Sljedeća &raquo;</a>
        <?php endif; ?>
    </div>

    <?php $conn->close(); ?>
</div>


</div> <!-- Zatvaranje .container mt-5 -->
</div> <!-- Zatvaranje glavnog .container -->

<!-- Footer -->
<footer class="custom-footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="logo_stacked_reversed_web.png" alt="Cochlear Logo">
            </div>
            <div class="footer-links">
                <ul>
                    <li>Investors</li>
                    <li>Careers</li>
                    <li>Cochlear Blog</li>
                    <li>Reliability reporting</li>
                </ul>
                <ul>
                    <li>Product manuals</li>
                    <li>Media Center</li>
                    <li>Global warnings</li>
                    <li>Terms of use</li>
                </ul>
                <ul>
                    <li>Privacy commitment</li>
                    <li>Privacy notice</li>
                </ul>
            </div>
            <div class="footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </footer>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
