<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilkelas($queryTampilkelas) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilkelas);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahkelas($data) {
  global $conn;

  $kelas = htmlspecialchars($data["kelas"]);
  $guru = htmlspecialchars($data["guru"]);
  $jumlah_siswa = htmlspecialchars($data["jumlah_siswa"]);

  $queryTambahkelas = "INSERT INTO tb_kelas VALUES ('','$kelas', '$guru','$jumlah_siswa')";

  mysqli_query($conn, $queryTambahkelas);
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


function hapuskelas($id) {
  global $conn;

  $queryHapuskelas = "DELETE FROM tb_kelas WHERE id = $id";
  mysqli_query($conn, $queryHapuskelas);
  return mysqli_affected_rows($conn);
}

function ubahkelas($data) {
  global $conn;

  $kelas = htmlspecialchars($data["kelas"]);
  $guru = htmlspecialchars($data["guru"]);
  $jumlah_siswa = $data["jumlah_siswa"];
 
  $id = ($data["id"]);

  $queryUbahkelas = "UPDATE tb_kelas SET 
  kelas            = '$kelas',
  guru           = '$guru',
  jumlah_siswa          = '$jumlah_siswa'


  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahkelas);

  return mysqli_affected_rows($conn);
}


function carikelas($keyword) {

  $queryCarikelas = "SELECT * FROM tb_kelas WHERE nama LIKE '%$keyword%'";
  return queryTampilkelas($queryCarikelas);
}

?>