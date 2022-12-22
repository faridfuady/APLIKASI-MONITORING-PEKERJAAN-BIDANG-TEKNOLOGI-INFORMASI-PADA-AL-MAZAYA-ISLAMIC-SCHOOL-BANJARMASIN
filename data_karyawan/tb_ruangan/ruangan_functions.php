<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilruangan($queryTampilruangan) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilruangan);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahruangan($data) {
  global $conn;

  $ruangan = htmlspecialchars($data["ruangan"]);
  $lokasi = htmlspecialchars($data["lokasi"]);

  $queryTambahruangan = "INSERT INTO tb_ruangan VALUES ('','$ruangan', '$lokasi')";

  mysqli_query($conn, $queryTambahruangan);
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


function hapusruangan($id) {
  global $conn;

  $queryHapusruangan = "DELETE FROM tb_ruangan WHERE id = $id";
  mysqli_query($conn, $queryHapusruangan);
  return mysqli_affected_rows($conn);
}

function ubahruangan($data) {
  global $conn;

  $ruangan = htmlspecialchars($data["ruangan"]);
  $lokasi = htmlspecialchars($data["lokasi"]);

  $id = ($data["id"]);

  $queryUbahruangan = "UPDATE tb_ruangan SET 
  ruangan            = '$ruangan',
  lokasi           = '$lokasi'



  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahruangan);

  return mysqli_affected_rows($conn);
}


function cariruangan($keyword) {

  $queryCariruangan = "SELECT * FROM tb_ruangan WHERE nama LIKE '%$keyword%'";
  return queryTampilruangan($queryCariruangan);
}

?>