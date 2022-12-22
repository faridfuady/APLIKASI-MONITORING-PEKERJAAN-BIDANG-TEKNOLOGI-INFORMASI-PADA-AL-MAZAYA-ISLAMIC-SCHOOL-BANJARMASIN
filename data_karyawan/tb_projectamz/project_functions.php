<?php 

$conn = mysqli_connect("localhost", "root", "", "laporan");

function queryTampilproject($queryTampilproject) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilproject);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahproject($data) {
  global $conn;

  $nm_project = htmlspecialchars($data["nm_project"]);
  $tempat = htmlspecialchars ($data["tempat"]);
  $tgl_project =($data["tgl_project"]);
  $tujuan = htmlspecialchars($data["tujuan"]);
  $nm_alat = $data["nm_alat"];
  $nm_kryw = $data["nm_kryw"];
  $nm_dok = $data["nm_dok"];

  $queryTambahProject = "INSERT INTO tb_project
  VALUES
    ('', '$nm_project', '$tempat','$tgl_project', ' $tujuan', '$nm_alat', '$nm_kryw', '$nm_dok')
    ";

  mysqli_query($conn, $queryTambahProject);
  return mysqli_affected_rows($conn);
}

function hapusproject($id_project) {
  global $conn;

  $queryHapusproject = "DELETE FROM tb_project WHERE id_project = $id_project";
  mysqli_query($conn, $queryHapusproject);
  return mysqli_affected_rows($conn);
}

function ubahProject($data) {
  global $conn;

  $nm_project = htmlspecialchars($data["nm_project"]);
  $tempat = htmlspecialchars($data["tempat"]);
  $tgl_project = $data["tgl_project"];
  $tujuan = htmlspecialchars($data["tujuan"]);
  $nm_alat = $data["nm_alat"];
  $nm_kryw = $data["nm_kryw"];
  $nm_dok = $data["nm_dok"];
  
  $id_project = ($data["id"]);

  $queryUbahproject = "UPDATE tb_project SET 
  nm_project = '$nm_project',
  tempat = '$tempat',
  tgl_project = '$tgl_project',
  tujuan = '$tujuan',
  nm_alat = '$nm_alat',
  nm_kryw = '$nm_kryw',
  nm_dok = '$nm_dok'


  WHERE id_project = '$id_project'";

  mysqli_query($conn, $queryUbahproject);

  return mysqli_affected_rows($conn);
}

function cariproject($keyword) {

  $queryCariproject = "SELECT * FROM tb_project WHERE nm_project LIKE '%$keyword%'";
  return queryTampilproject($queryCariproject);
}

?>