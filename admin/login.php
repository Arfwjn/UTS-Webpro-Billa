<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="proses_login.php" method="POST">
        <h2>Login Admin</h2>
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
        <a class="registrasi" href="registrasi.php">Buat Akun</a>
    </form>
</body>
</html>
