<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilkegiatan($queryTampilkegiatan) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilkegiatan);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahkegiatan($data) {
  global $conn;

  $nm_kegiatan = htmlspecialchars($data["nm_kegiatan"]);
  $keterangan = htmlspecialchars($data["keterangan"]);
  $tanggal = htmlspecialchars($data["tanggal"]);
  $lokasi = htmlspecialchars($data["lokasi"]);
  $kryw = htmlspecialchars($data["kryw"]);
  $produksi = htmlspecialchars($data["produksi"]);
  $konsumsi = htmlspecialchars($data["konsumsi"]);
  $promosi = htmlspecialchars($data["promosi"]);
  $transportasi = htmlspecialchars($data["transportasi"]);
  $gambar = upload();
  if (!$gambar) {
    return false;
}
  
  $queryTambahkegiatan = "INSERT INTO tb_kegiatan VALUES ('','$nm_kegiatan','$keterangan', '$tanggal','$lokasi', '$kryw' ,'$produksi','$konsumsi','$promosi','$transportasi','$gambar')";

  mysqli_query($conn, $queryTambahkegiatan);
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


function hapuskegiatan($id) {
  global $conn;

  $queryHapuskegiatan = "DELETE FROM tb_kegiatan WHERE id = $id";
  mysqli_query($conn, $queryHapuskegiatan);
  return mysqli_affected_rows($conn);
}

function ubahkegiatan($data) {
  global $conn;

  $nama = htmlspecialchars($data["nama"]);
  $waktu = htmlspecialchars($data["waktu"]);
  $anggaran = htmlspecialchars($data["anggaran"]);
  $tempat = htmlspecialchars($data["tempat"]);
  $nm_kryw = htmlspecialchars($data["nm_kryw"]);

 

  $id = ($data["id"]);

  $queryUbahkegiatan = "UPDATE tb_kegiatan SET 
  nama                         = '$nama',
  waktu                  = '$waktu',
  tempat                      = '$keterangan',
  anggaran                    = '$anggaran',
  nm_kryw                    = '$nm_kryw'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahkegiatan);

  return mysqli_affected_rows($conn);
}


function carikegiatan($keyword) {

  $queryCarikegiatan = "SELECT * FROM tb_kegiatan WHERE nama LIKE '%$keyword%'";
  return queryTampilkegiatan($queryCarikegiatan);
}

?>