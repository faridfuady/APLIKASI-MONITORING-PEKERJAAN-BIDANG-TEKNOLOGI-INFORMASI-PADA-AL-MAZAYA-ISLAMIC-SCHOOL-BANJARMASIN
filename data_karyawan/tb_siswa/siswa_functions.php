<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilsiswa($queryTampilsiswa) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilsiswa);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahsiswa($data) {
  global $conn;

  $nis = htmlspecialchars($data["nis"]);
  $nama = htmlspecialchars($data["nama"]);
  $jenis_kelamin = $data['jenis_kelamin'];
  $alamat = htmlspecialchars($data["alamat"]);
  $tanggal_lahir= $data['tanggal_lahir'];
  $tempat_lahir = htmlspecialchars($data["tempat_lahir"]);

  $gambar = upload();
  if (!$gambar) {
    return false;
}

  $queryTambahsiswa = "INSERT INTO tb_siswa VALUES ('','$nis', '$nama','$jenis_kelamin', '$alamat', '$tanggal_lahir','$tempat_lahir','$gambar')";

  mysqli_query($conn, $queryTambahsiswa);
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


function hapussiswa($id) {
  global $conn;

  $queryHapussiswa = "DELETE FROM tb_siswa WHERE id = $id";
  mysqli_query($conn, $queryHapussiswa);
  return mysqli_affected_rows($conn);
}

function ubahsiswa($data) {
  global $conn;

  $nis = htmlspecialchars($data["nis"]);
  $nama = htmlspecialchars($data["nama"]);
  $jenis_kelamin = $data["jenis_kelamin"];
  $alamat = htmlspecialchars($data["alamat"]);
  $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
  $tempat_lahir = htmlspecialchars($data["tempat_lahir"]);

  $gambarLama = $data['gambarLama'];

  if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
  } else {
      $gambar = upload();
  }

  $id = ($data["id"]);

  $queryUbahsiswa = "UPDATE tb_siswa SET 
  nis            = '$nis',
  nama           = '$nama',
  jenis_kelamin  = '$jenis_kelamin',
  alamat         = '$alamat',
  tanggal_lahir  = '$tanggal_lahir',
  tempat_lahir   = '$tempat_lahir',
  gambar         = '$gambar'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahsiswa);

  return mysqli_affected_rows($conn);
}


function carisiswa($keyword) {

  $queryCarisiswa = "SELECT * FROM tb_siswa WHERE nama LIKE '%$keyword%'";
  return queryTampilsiswa($queryCarisiswa);
}

?>