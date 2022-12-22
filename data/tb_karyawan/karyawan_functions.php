<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilkaryawan($queryTampilkaryawan) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilkaryawan);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahkaryawan($data) {
  global $conn;

  $nip = htmlspecialchars($data["nip"]);
  $nm_kryw = htmlspecialchars($data["nm_kryw"]);
  $email = htmlspecialchars($data["email"]);
  $jenis_kelamin = $data['jenis_kelamin'];
  $alamat = htmlspecialchars($data["alamat"]);
  $tanggal_lahir= $data['tanggal_lahir'];
  $jabatan = htmlspecialchars($data["jabatan"]);
  $no_telp = htmlspecialchars($data["no_telp"]);

  $gambar = upload();
  if (!$gambar) {
    return false;
}

  $queryTambahkaryawan = "INSERT INTO tb_karyawan VALUES ('','$nip', '$nm_kryw','$email','$jenis_kelamin', '$alamat', '$tanggal_lahir','$gambar','$jabatan', '$no_telp')";

  mysqli_query($conn, $queryTambahkaryawan);
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


function hapuskaryawan($id) {
  global $conn;

  $queryHapuskaryawan = "DELETE FROM tb_karyawan WHERE id = $id";
  mysqli_query($conn, $queryHapuskaryawan);
  return mysqli_affected_rows($conn);
}

function ubahkaryawan($data) {
  global $conn;

  $nip = htmlspecialchars($data["nip"]);
  $nm_kryw = htmlspecialchars($data["nm_kryw"]);
  $email = htmlspecialchars($data["email"]);
  $jenis_kelamin = $data["jenis_kelamin"];
  $alamat = htmlspecialchars($data["alamat"]);
  $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
  $jabatan = htmlspecialchars($data["jabatan"]);
  $no_telp = htmlspecialchars($data["no_telp"]);

  $gambarLama = $data['gambarLama'];

  if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
  } else {
      $gambar = upload();
  }

  $id = ($data["id"]);

  $queryUbahkaryawan = "UPDATE tb_karyawan SET 
  nip            = '$nip',
  nm_kryw        = '$nm_kryw',
  email          = '$email',
  jenis_kelamin  = '$jenis_kelamin',
  alamat         = '$alamat',
  tanggal_lahir  = '$tanggal_lahir',
  gambar         = '$gambar',
  jabatan         = '$jabatan',
  no_telp        = '$no_telp'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahkaryawan);

  return mysqli_affected_rows($conn);
}


function carikaryawan($keyword) {

  $queryCarikaryawan = "SELECT * FROM tb_karyawan WHERE nm_kryw LIKE '%$keyword%'";
  return queryTampilkaryawan($queryCarikaryawan);
}

?>