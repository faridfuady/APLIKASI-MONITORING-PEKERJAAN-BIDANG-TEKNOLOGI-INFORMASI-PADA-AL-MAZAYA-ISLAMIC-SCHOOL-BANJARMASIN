<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampildokumentasi($queryTampildokumentasi) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampildokumentasi);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahdokumentasi($data) {
  global $conn;

  $nm_dok = htmlspecialchars($data["nm_dok"]);
  $tgl_dok = htmlspecialchars($data["tgl_dok"]);
  $tempat = htmlspecialchars($data["tempat"]);
  $nama_dokumentalis = htmlspecialchars($data["nama_dokumentalis"]);

  $gambar = upload();
  if (!$gambar) {
    return false;
}

  $queryTambahdokumentasi = "INSERT INTO tb_dokumentasi VALUES ('','$nm_dok','$tgl_dok','$gambar', '$tempat','$nama_dokumentalis')";

  mysqli_query($conn, $queryTambahdokumentasi);
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

function hapusdokumentasi($id_dok) {
  global $conn;

  $queryHapusdokumentasi = "DELETE FROM tb_dokumentasi WHERE id_dok = $id_dok";
  mysqli_query($conn, $queryHapusdokumentasi);
  return mysqli_affected_rows($conn);
}

function ubahdokumentasi($data) {
  global $conn;

  $nm_dok =htmlspecialchars($data['nm_dok']);
  $tgl_dok = $data['tgl_dok'];
  $tempat = htmlspecialchars($data['tempat']);
  $nama_dokumentalis = htmlspecialchars($data['nama_dokumentalis']);

  $gambarLama = $data['gambarLama'];

  if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
  } else {
      $gambar = upload();
  }
  $id_dok = ($data["id"]);

  $sql = "UPDATE tb_dokumentasi SET nm_dok = '$nm_dok', tgl_dok = '$tgl_dok', gambar = '$gambar', tempat = '$tempat',nama_dokumentalis = '$nama_dokumentalis' WHERE id_dok = $id_dok";

  mysqli_query($conn, $sql);

  return mysqli_affected_rows($conn);
}


function caridokumentasi($keyword) {

  $queryCaridokumentasi = "SELECT * FROM tb_dokumentasi WHERE nm_dok LIKE '%$keyword%'";
  return queryTampildokumentasi($queryCaridokumentasi);
}


?>