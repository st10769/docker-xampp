<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === "xmas" && $password === "rudolf") {
    $_SESSION['auth'] = true;
    $_SESSION['username'] = $username;
    header("Location: pannello.php");
    exit;
} else {
    echo "Credenziali non valide";
}