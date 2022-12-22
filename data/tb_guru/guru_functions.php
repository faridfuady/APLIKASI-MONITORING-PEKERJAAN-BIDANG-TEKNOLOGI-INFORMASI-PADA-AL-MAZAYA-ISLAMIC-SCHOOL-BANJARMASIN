<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilguru($queryTampilguru) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilguru);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahguru($data) {
  global $conn;

  $nip = htmlspecialchars($data["nip"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jenis_kelamin = $data['jenis_kelamin'];
  $alamat = htmlspecialchars($data["alamat"]);
  $tanggal_lahir= $data['tanggal_lahir'];
  $no_telp = htmlspecialchars($data["no_telp"]);
  $tahun = htmlspecialchars($data["tahun"]);

  $gambar = upload();
  if (!$gambar) {
    return false;
}

  $queryTambahguru = "INSERT INTO tb_guru VALUES ('','$nip', '$nama','$email','$jenis_kelamin', '$alamat', '$tanggal_lahir','$gambar', '$no_telp', '$tahun')";

  mysqli_query($conn, $queryTambahguru);
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


function hapusguru($id) {
  global $conn;

  $queryHapusguru = "DELETE FROM tb_guru WHERE id = $id";
  mysqli_query($conn, $queryHapusguru);
  return mysqli_affected_rows($conn);
}

function ubahguru($data) {
  global $conn;

  $nip = htmlspecialchars($data["nip"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jenis_kelamin = $data["jenis_kelamin"];
  $alamat = htmlspecialchars($data["alamat"]);
  $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
  $no_telp = htmlspecialchars($data["no_telp"]);
  $tahun = htmlspecialchars($data["tahun"]);

  $gambarLama = $data['gambarLama'];

  if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
  } else {
      $gambar = upload();
  }

  $id = ($data["id"]);

  $queryUbahguru = "UPDATE tb_guru SET 
  nip            = '$nip',
  nama           = '$nama',
  email          = '$email',
  jenis_kelamin  = '$jenis_kelamin',
  alamat         = '$alamat',
  tanggal_lahir  = '$tanggal_lahir',
  gambar         = '$gambar',
  no_telp        = '$no_telp',
  tahun          = '$tahun'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahguru);

  return mysqli_affected_rows($conn);
}


function cariguru($keyword) {

  $queryCariguru = "SELECT * FROM tb_guru WHERE nama LIKE '%$keyword%'";
  return queryTampilguru($queryCariguru);
}

?>