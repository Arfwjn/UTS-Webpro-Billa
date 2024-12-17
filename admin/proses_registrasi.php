<?php
// proses_registrasi.php

// Konfigurasi database
$host = "localhost";
$username = "root";
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "webproswusalsa";

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form registrasi
$new_username = $_POST['username'];
$new_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

// Menyimpan data ke database dengan prepared statement
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $new_username, $new_password);

if ($stmt->execute()) {
    // Alert berhasil dan redirect
    echo "<script>
        alert('Registrasi berhasil! Anda akan diarahkan ke halaman login.');
        window.location.href = 'login.php';
    </script>";
} else {
    // Pesan error jika gagal
    echo "<script>
        alert('Registrasi gagal: " . addslashes($stmt->error) . "');
        window.history.back();
    </script>";
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
