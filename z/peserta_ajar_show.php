<?php 

require "functions.php";

$pesertaAjar = queryTampilPesertaAjar("SELECT * FROM tb_peserta_ajar");
// $pesertaAjar = queryTampilPesertaAjar("SELECT p.nama_lengkap, p.email, p.no_telp, pa.tanggal_waktu_pelatihan, pa.tempat_pelatihan FROM tb_peserta as p inner join tb_peserta_ajar as pa on p.nama_lengkap = pa.nama_lengkap");

?>

<h1>Daftar Peserta Baru</h1>
<a href="peserta_input.php">Tambah Data Peserta Ajar</a>
<table border="1" cellpadding="10" cellspacing="0">

<tr>
  <th>NO</th>
  <th>Nama Lengkap</th>
  <th>Email</th>
  <th>No Telepon</th>
  <th>Tanggal dan Waktu Pelatihan</th>
  <th>Tempat Pelatihan</th>
  <th>Aksi</th>
</tr>
<?php $i = 1; ?>
<?php foreach ($pesertaAjar as $row) : ?>
<tr>
  <td><?= $i; ?></td>
  <td><?= $row["p.nama_lengkap"]; ?></td>
  <td><?= $row["p.email"]; ?></td>
  <td><?= $row["p.no_telp"]; ?></td>
  <td><?= $row["pa.tanggal_waktu_pelatihan"]; ?></td>
  <td><?= $row["pa.tempat_pelatihan"]; ?></td>
  <td>
    <a href="peserta_update.php?id_peserta=<?= $row["id_peserta"]; ?>">UBAH</a><br>
    <a href="peserta_delete.php?id_peserta=<?= $row["id_peserta"]; ?>" onclick="return confirm('Yakin?');">HAPUS</a><br>
  </td>
</tr>
<?php $i++ ?>
<?php endforeach; ?>

</table>