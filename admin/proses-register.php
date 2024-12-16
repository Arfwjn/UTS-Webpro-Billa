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

// Menyimpan data ke database
$sql = "INSERT INTO admin (username, password) VALUES ('$new_username', '$new_password')";

if ($conn->query($sql) === TRUE) {
    echo "Registrasi berhasil. Silakan <a href='index.php'>login</a>.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
