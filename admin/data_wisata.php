<?php
// Proses penyimpanan data ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Koneksi ke database
    $host = 'localhost';
    $user = 'root'; // Ganti dengan username MySQL Anda
    $password = ''; // Ganti dengan password MySQL Anda
    $database = 'webproswusalsa'; // Ganti dengan nama database Anda
    
    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $nama_wisata = $conn->real_escape_string($_POST['nama_wisata']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $foto = $_FILES['foto'];

    // Proses upload foto
    $foto_name = '';
    if ($foto['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $foto_name = time() . '_' . basename($foto['name']);
        $target_file = $upload_dir . $foto_name;

        if (!move_uploaded_file($foto['tmp_name'], $target_file)) {
            die("Error uploading file.");
        }
    } else {
        die("Error: File not uploaded.");
    }

    // Simpan data ke database
    $sql = "INSERT INTO data_wisata (nama_wisata, deskripsi, foto) VALUES ('$nama_wisata', '$deskripsi', '$foto_name')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
        echo "<a href='list_wisata.php'>Lihat Data Wisata.</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

include "header.php";
include "sidebar.php";
?>

<!--begin::App Content-->
<div class="app-content wisata-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <h1 class="wisata-heading">Form Input Data wisata</h1>
            <form action="data_wisata.php" method="post" enctype="multipart/form-data" class="wisata-form">
                <label for="nama_wisata" class="wisata-label">Nama Perusahaan:</label>
                <input type="text" id="nama_wisata" name="nama_wisata" class="wisata-input" required><br><br>

                <label for="deskripsi" class="wisata-label">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" rows="5" class="wisata-textarea" required></textarea><br><br>

                <label for="foto" class="wisata-label">Foto:</label>
                <input type="file" id="foto" name="foto" class="wisata-file" accept="image/*" required><br><br>

                <button type="submit" class="wisata-submit-btn">Simpan</button>
            </form>
        </div>
    </div>
</div>
<!--end::App Content-->

<?php
include "footer.php";
?>
