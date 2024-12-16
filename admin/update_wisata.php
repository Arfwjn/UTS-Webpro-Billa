<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root'; // Ganti dengan username MySQL Anda
$password = ''; // Ganti dengan password MySQL Anda
$database = 'webproswusalsa'; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah ID tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID tidak ditemukan.");
}

$id = intval($_GET['id']);

// Ambil data dari database berdasarkan ID
$query = "SELECT * FROM data_wisata WHERE id = $id";
$result = $conn->query($query);

if (!$result || $result->num_rows == 0) {
    die("Data tidak ditemukan.");
}

$row = $result->fetch_assoc();

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_wisata = $conn->real_escape_string($_POST['nama_wisata']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $foto_name = $row['foto']; // Nama file foto lama

    // Proses upload foto baru jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $foto_name = time() . '_' . basename($_FILES['foto']['name']);
        $target_file = $upload_dir . $foto_name;

        // Hapus file foto lama
        $fotoPath = $upload_dir . $row['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }

        // Upload foto baru
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            die("Error uploading file.");
        }
    }

    // Update data di database
    $queryUpdate = "UPDATE data_wisata SET 
                    nama_wisata = '$nama_wisata', 
                    deskripsi = '$deskripsi', 
                    foto = '$foto_name', 
                    tanggal_update = CURRENT_TIMESTAMP 
                    WHERE id = $id";

    if ($conn->query($queryUpdate) === TRUE) {
        echo "Data berhasil diperbarui.";
        echo "<br><a href='data_wisata.php'>Kembali ke Daftar Loker</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Wisata</title>
</head>
<body>
    <h1>Update Data Loker</h1>
    <form action="update_loker.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="nama_wisata">Nama Perusahaan:</label>
        <input type="text" id="nama_wisata" name="nama_wisata" value="<?php echo htmlspecialchars($row['nama_wisata']); ?>" required><br><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea><br><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*"><br><br>
        <p>Foto saat ini:</p>
        <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Wisata" width="200"><br><br>

        <button type="submit">Update</button>
        <a href="list_wisata.php">Batal</a>
    </form>
</body>
</html>
