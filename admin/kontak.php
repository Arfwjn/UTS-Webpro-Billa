<?php
include "header.php";
include "sidebar.php";
?>
 
<div class="container mt-3">
  <h2>Kirim Email Kepada Author</h2>
  <form action="proses_kontak.php" method="post">
    <div class="mb-3 mt-3">
      <label>Email Tujuan:</label>
      <input type="email" class="form-control"  placeholder="Email Tujuan" name="email" required>
    </div>
    <div class="mb-3 mt-3">
      <label>Judul Pesan:</label>
      <input type="text" class="form-control"  placeholder="Judul Pesan" name="judul" required>
    </div>
    <div class="mb-3 mt-3">
      <label>Isi Pesan:</label>
      <textarea class="form-control" name="pesan" placeholder="Pesan" required></textarea>
    </div>
   
    <button type="submit" class="btn btn-primary">Kirim</button>
  </form>
</div>

<?php
include "footer.php";
?>