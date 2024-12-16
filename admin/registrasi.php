<?php
// registrasi.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="proses_registrasi.php" method="POST">
        <h2>Registrasi Akun Baru</h2>
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
