<?php 

require "functions.php";

if(isset($_POST["submit"])) {
  if(tambahPeserta($_POST)>0) {
    echo "<script>alert('Data Peserta Ajar Berhasil Ditambah');document.location.href = 'peserta_ajar_show.php';</script>";
  } else {
    echo "<script>alert('Data Peserta Ajar Gagal Ditambah');document.location.href = 'peserta_ajar_show.php';</script>";
  }
}

?>

<h1>FORM TAMBAH DATA PESERTA AJAR</h1>
<form action="" method="post">
  <label for="nama_lengkap">Nama Lengkap</label>
  <input type="text" id="nama_lengkap" name="nama_lengkap">
  <br>
  <label for="tanggal_waktu_pelatihan">Tanggal & Waktu Pelatihan</label>
  <input type="text" id="tanggal_waktu_pelatihan" name="tanggal_waktu_pelatihan">
  <br>
  <label for="tempat_pelatihan">Tempat Pelatihan</label>
  <input type="tempat_pelatihan" id="tempat_pelatihan" name="tempat_pelatihan">
  <br><br>
  <button type="submit" name="submit">Tambah Data Peserta Ajar</button>
</form>
<a href="peserta_show.php">Lihat Peserta Ajar</a>