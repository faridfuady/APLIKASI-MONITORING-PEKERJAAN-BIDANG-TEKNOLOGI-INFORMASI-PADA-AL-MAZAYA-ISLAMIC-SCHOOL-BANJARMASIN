<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilkinerja($queryTampilkinerja) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilkinerja);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahkinerja($data) {
  global $conn;

  $nip = htmlspecialchars($data["nip"]);
  $kedisiplinan = htmlspecialchars($data["kedisiplinan"]);
  $integritas = htmlspecialchars($data["integritas"]);
  $tanggung_jwb = htmlspecialchars($data["tanggung_jwb"]);
  $komunikasi = htmlspecialchars($data["komunikasi"]);
  $antusiasme = htmlspecialchars($data["antusiasme"]);
  $tahun = htmlspecialchars($data["tahun"]);
  

  $queryTambahkinerja = "INSERT INTO tb_kinerja VALUES ('','$nip', '$kedisiplinan', '$integritas', '$tanggung_jwb', '$komunikasi', '$antusiasme', '$tahun')";

  mysqli_query($conn, $queryTambahkinerja);
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


function hapuskinerja($id) {
  global $conn;

  $queryHapuskinerja = "DELETE FROM tb_kinerja WHERE id = $id";
  mysqli_query($conn, $queryHapuskinerja);
  return mysqli_affected_rows($conn);
}

function ubahkinerja($data) {
  global $conn;

  $nip = htmlspecialchars($data["nip"]);
  $kedisiplinan = htmlspecialchars($data["kedisiplinan"]);
  $integritas = htmlspecialchars($data["integritas"]);
  $tanggung_jwb = htmlspecialchars($data["tanggung_jwb"]);
  $komunikasi = htmlspecialchars($data["komunikasi"]);
  $antusiasme = htmlspecialchars($data["antusiasme"]);
  $tahun = htmlspecialchars($data["tahun"]);

  $id = ($data["id"]);

  $queryUbahkinerja = "UPDATE tb_kinerja SET 
  nip            = '$nip',
  kedisiplinan          = '$kedisiplinan',
  integritas          = '$integritas',
  tanggung_jwb          = '$tanggung_jwb',
  komunikasi          = '$komunikasi',
  antusiasme          = '$antusiasme',
  tahun          = '$tahun'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahkinerja);

  return mysqli_affected_rows($conn);
}


function carikinerja($keyword) {

  $queryCarikinerja = "SELECT * FROM tb_kinerja WHERE nama LIKE '%$keyword%'";
  return queryTampilkinerja($queryCarikinerja);
}

?>