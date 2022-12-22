<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

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

  $nama_project = htmlspecialchars($data["nama_project"]);
  $keterangan = htmlspecialchars($data["keterangan"]);
  $tempat = htmlspecialchars($data["tempat"]);
  $anggaran = htmlspecialchars($data["anggaran"]);
  $tanggal_mulai = htmlspecialchars($data["tanggal_mulai"]);
  $nm_kryw = htmlspecialchars($data["nm_kryw"]);
  
  $gambar = upload();
  if (!$gambar) {
    return false;
}

  $queryTambahproject = "INSERT INTO tb_project VALUES ('','$nama_project', '$keterangan','$gambar', '$tempat' ,'$anggaran','$tanggal_mulai','$nm_kryw' )";

  mysqli_query($conn, $queryTambahproject);
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


function hapusproject($id) {
  global $conn;

  $queryHapusproject = "DELETE FROM tb_project WHERE id = $id";
  mysqli_query($conn, $queryHapusproject);
  return mysqli_affected_rows($conn);
}

function ubahproject($data) {
  global $conn;

  $nama_project = htmlspecialchars($data["nama_project"]);
  $keterangan = htmlspecialchars($data["keterangan"]);
  $tempat = htmlspecialchars($data["tempat"]);
  $anggaran = htmlspecialchars($data["anggaran"]);
  $tanggal_mulai = htmlspecialchars($data["tanggal_mulai"]);
  $nm_kryw = htmlspecialchars($data["nm_kryw"]);

  $gambarLama = $data['gambarLama'];

  if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
  } else {
      $gambar = upload();
  }

  $id = ($data["id"]);

  $queryUbahproject = "UPDATE tb_project SET 
  nama_project                = '$nama_project',
  keterangan                  = '$keterangan',
  gambar                      = '$gambar',
  tempat                      = '$keterangan',
  anggaran                    = '$anggaran',
  tanggal_mulai               = '$tanggal_mulai',
  nm_kryw                    = '$nm_kryw'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahproject);

  return mysqli_affected_rows($conn);
}


function cariproject($keyword) {

  $queryCariproject = "SELECT * FROM tb_project WHERE nama LIKE '%$keyword%'";
  return queryTampilproject($queryCariproject);
}

?>