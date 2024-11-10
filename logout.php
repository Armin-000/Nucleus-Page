<?php
session_start();
session_unset();  // Uklanja sve sesijske varijable
session_destroy();  // Uništava sesiju

// Preusmjeravanje na početnu stranicu
header("Location: index.php");
exit();
?>
