<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilmapel($queryTampilmapel) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilmapel);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahmapel($data) {
  global $conn;

  $mapel = htmlspecialchars($data["mapel"]);
  $kkm = htmlspecialchars($data["kkm"]);
  $guru = htmlspecialchars($data["guru"]);

  $queryTambahmapel = "INSERT INTO tb_mapel VALUES ('','$mapel', '$kkm', '$guru')";

  mysqli_query($conn, $queryTambahmapel);
  return mysqli_affected_rows($conn);
}
function upload()
{
  global $conn;
    // Syarat
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Jika tidak mengupload gambar atau tidak memenuhi persyaratan diatas maka akan menampilkan alert dibawah
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // format atau ekstensi yang diperbolehkan untuk upload gambar adalah
    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    // Jika format atau ekstensi bukan gambar maka akan menampilkan alert dibawah
    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    // Jika ukuran gambar lebih dari 3.000.000 byte maka akan menampilkan alert dibawah
    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran gambar anda terlalu besar!');</script>";
        return false;
    }

    // nama gambar akan berubah angka acak/unik jika sudah berhasil tersimpan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    // memindahkan file ke dalam folde img dengan nama baru
    move_uploaded_file($tmpName,'../../gambar/' . $namaFileBaru);
    //  move_uploaded_file($_FILES['img'], $namaFile);

    return $namaFileBaru;
}


function hapusmapel($id) {
  global $conn;

  $queryHapusmapel = "DELETE FROM tb_mapel WHERE id = $id";
  mysqli_query($conn, $queryHapusmapel);
  return mysqli_affected_rows($conn);
}

function ubahmapel($data) {
  global $conn;

  $mapel = htmlspecialchars($data["mapel"]);
  $kkm = htmlspecialchars($data["kkm"]);
  $guru = htmlspecialchars($data["guru"]);
  
  $id = ($data["id"]);

  $queryUbahmapel = "UPDATE tb_mapel SET 
  mapel            = '$mapel',
  kkm           = '$kkm',
  guru           = '$guru'

  

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahmapel);

  return mysqli_affected_rows($conn);
}


function carimapel($keyword) {

  $queryCarimapel = "SELECT * FROM tb_mapel WHERE mapel LIKE '%$keyword%'";
  return queryTampilmapel($queryCarimapel);
}

?>