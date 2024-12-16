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
        echo "<a href='list_loker.php'Lihat Data Wisata.</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

include "header.php";
include "sidebar.php";
?>

<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row"> <!--begin::Col-->
    <h1>Form Input Data Loker</h1>
    <form action="data_wisata.php" method="post" enctype="multipart/form-data">
        <label for="nama_wisata">Nama Perusahaan:</label>
        <input type="text" id="nama_wisata" name="nama_wisata" required><br><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" required></textarea><br><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required><br><br>

        <button type="submit">Simpan</button>
    </form>

<?php
include "footer.php";
?>
