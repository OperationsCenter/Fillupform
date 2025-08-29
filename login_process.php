<?php
session_start();
require 'db.php';
$db = new DB();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $db->pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
$stmt->execute([':username' => $username]);
$user = $stmt->fetch();

if ($user && $user['password'] === $password) { // For demo only; use password_hash in production!
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header("Location: form.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
?>