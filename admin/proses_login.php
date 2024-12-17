<?php
session_start();

// Konfigurasi database
$host = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "webproswusalsa";

$conn = new mysqli($host, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cek username di database
$query = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>
            alert('Password salah!');
            window.location.href = 'login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Username tidak ditemukan!');
        window.location.href = 'login.php';
    </script>";
}

$conn->close();
?>
