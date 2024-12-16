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

// Proses delete jika ada permintaan
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Hapus file foto dari server
    $queryFoto = "SELECT foto FROM data_wisata WHERE id = $id";
    $resultFoto = $conn->query($queryFoto);
    if ($resultFoto && $resultFoto->num_rows > 0) {
        $rowFoto = $resultFoto->fetch_assoc();
        $fotoPath = 'uploads/' . $rowFoto['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }
    }
    // Hapus data dari database
    $queryDelete = "DELETE FROM data_wisata WHERE id = $id";
    if ($conn->query($queryDelete) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data dari database
$query = "SELECT * FROM data_wisata ORDER BY tanggal_update DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Wisata</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img {
            width: 100px;
            height: auto;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Daftar Wisata</h1>
    <a href="data_wisata.php">Tambah Wisata</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Wisata</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Tanggal Update</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_wisata']); ?></td>
                        <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                        <td>
                            <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Wisata">
                        </td>
                        <td><?php echo $row['tanggal_update']; ?></td>
                        <td>
                        <a href="update_wisata.php?id=<?php echo $row['id']; ?>">Update</a>
                            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
