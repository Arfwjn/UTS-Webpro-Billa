<?php
include "header.php";
include "sidebar.php";
?>

<main class="app-main">    
    <!--begin::App Content-->
    <div class="app-content profile-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3 class="profile-heading">Update Profil</h3>
                    <p class="profile-description">Perbarui judul dan deskripsi profil Anda di bawah ini.</p>
                    <form action="update_profil.php" method="post" enctype="multipart/form-data">
                        <!-- Input untuk Judul Profil -->
                        <input type="text" name="judul_profil" class="form-control profile-input" placeholder="Judul Profil" required>
                        
                        <!-- Input untuk Isi Profil -->
                        <textarea name="isi_profil" class="form-control profile-textarea" rows="5" placeholder="Isi Profil" required></textarea>
                        
                        <!-- Input untuk Upload Foto -->
                        <input type="file" name="upload_gambar" class="form-control profile-file" placeholder="Foto" accept="image/*" required>
                        
                        <!-- Tombol Simpan -->
                        <input type="submit" value="Simpan" class="profile-submit-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->
</main>

<?php
include "footer.php";
?>
