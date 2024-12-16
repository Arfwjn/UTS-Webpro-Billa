<?php
session_start();

$admin_username = "admin";
$admin_password = "admin123";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $admin_username && $password === $admin_password) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit;
} else {
    echo "Username atau password salah!";
    echo "<br><a href='login.php'>Kembali ke Login</a>";
}
?>
