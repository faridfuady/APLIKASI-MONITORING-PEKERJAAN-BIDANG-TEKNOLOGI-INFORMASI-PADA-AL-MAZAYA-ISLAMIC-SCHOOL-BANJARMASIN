<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilpengembalian($queryTampilpengembalian) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilpengembalian);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahpengembalian($data) {
  global $conn;

  $kd_pinjam = htmlspecialchars($data["kd_pinjam"]);
  $tanggal_pengembalian = htmlspecialchars($data["tanggal_pengembalian"]);
  $status = "Ready";

  

  $queryTambahpengembalian = "INSERT INTO tb_pengembalian VALUES ('','$kd_pinjam', '$tanggal_pengembalian','$status' )";

  mysqli_query($conn, $queryTambahpengembalian);
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


function hapuspengembalian($id) {
  global $conn;

  $queryHapuspengembalian = "DELETE FROM tb_pengembalian WHERE id = $id";
  mysqli_query($conn, $queryHapuspengembalian);
  return mysqli_affected_rows($conn);
}

function ubahpengembalian($data) {
  global $conn;

  $kd_pinjam = htmlspecialchars($data["kd_pinjam"]);
  $tanggal_pengembalian = htmlspecialchars($data["tanggal_pengembalian"]);
  $status = htmlspecialchars($data["status"]);

  $id = ($data["id"]);

  $queryUbahpengembalian = "UPDATE tb_pengembalian SET 
  kd_pinjam                      = '$kd_pinjam',
  tanggal_pengembalian     = '$tanggal_pengembalian',
  status                 = '$status'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahpengembalian);

  return mysqli_affected_rows($conn);
}


function caripengembalian($keyword) {

  $queryCaripengembalian = "SELECT * FROM tb_pengembalian WHERE nama LIKE '%$keyword%'";
  return queryTampilpengembalian($queryCaripengembalian);
}

?>