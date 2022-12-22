<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilpemeliharaan($queryTampilpemeliharaan) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilpemeliharaan);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahpemeliharaan($data) {
  global $conn;

  $id_brg = htmlspecialchars($data["id_brg"]);
  $tanggal_pemeliharaan =  $data["tanggal_pemeliharaan"];
  $keterangan =  $data["keterangan"];
  $nm_kryw = htmlspecialchars($data["nm_kryw"]);
  $catatan = htmlspecialchars($data["catatan"]);
  

  $queryTambahpemeliharaan = "INSERT INTO tb_pemeliharaan VALUES ('', '$id_brg', '$tanggal_pemeliharaan', '$keterangan', '$nm_kryw', '$catatan')";

  mysqli_query($conn, $queryTambahpemeliharaan);
  return mysqli_affected_rows($conn);
}

function hapuspemeliharaan($id) {
  global $conn;

  $queryHapuspemeliharaan = "DELETE FROM tb_pemeliharaan WHERE id = $id";
  mysqli_query($conn, $queryHapuspemeliharaan);
  return mysqli_affected_rows($conn);
}

function ubahpemeliharaan($data) {
  global $conn;

  $id_brg = htmlspecialchars($data["id_brg"]);
  $tanggal_pemeliharaan = htmlspecialchars($data["tanggal_pemeliharaan"]);
  $keterangan = htmlspecialchars($data["keterangan"]);
  $nm_kryw = $data["nm_kryw"];
  $catatan = $data["catatan"];
 
  $id = ($data["id"]);

  $queryUbahpemeliharaan = "UPDATE tb_pemeliharaan SET 
  id_brg            = '$id_brg',
  tanggal_pemeliharaan           = '$tanggal_pemeliharaan',
  keterangan           = '$keterangan',
  nm_kryw          = '$nm_kryw',
  catatan          = '$catatan'


  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahpemeliharaan);

  return mysqli_affected_rows($conn);
}


function caripemeliharaan($keyword) {

  $queryCaripemeliharaan = "SELECT * FROM tb_pemeliharaan WHERE id_brg LIKE '%$keyword%'";
  return queryTampilpemeliharaan($queryCaripemeliharaan);
}

?>