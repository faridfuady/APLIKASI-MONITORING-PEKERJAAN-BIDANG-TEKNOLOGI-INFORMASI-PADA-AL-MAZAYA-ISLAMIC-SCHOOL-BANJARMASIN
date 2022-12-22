<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilinventaris($queryTampilinventaris) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilinventaris);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahinventaris($data) {
  global $conn;

  $id_brg = htmlspecialchars($data["id_brg"]);
  $nama_brg = htmlspecialchars($data["nama_brg"]);
  $kondisi   = htmlspecialchars($data["kondisi"]);
  $keterangan = htmlspecialchars($data["keterangan"]);
  $lokasi = $data['lokasi'];
  $tanggal_inventaris = htmlspecialchars($data["tanggal_inventaris"]);
  $anggaran = htmlspecialchars($data["anggaran"]);

  $cekkodeinventaris = mysqli_query($conn, "SELECT id_brg FROM tb_inventaris WHERE id_brg = '$id_brg'");
  if(mysqli_fetch_assoc($cekkodeinventaris)) {
    echo "<script>alert('Kode inventaris Tidak Boleh Sama');</script>";
    return false;
  }

  $gambar = upload();
  if (!$gambar) {
    return false;
}

  $queryTambahinventaris = "INSERT INTO tb_inventaris VALUES ('','$id_brg','$nama_brg','$gambar','$kondisi','$keterangan', '$lokasi','$tanggal_inventaris','$anggaran')";

  mysqli_query($conn, $queryTambahinventaris);
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



function hapusinventaris($id) {
  global $conn;

  $queryHapusinventaris = "DELETE FROM tb_inventaris WHERE id = $id";
  mysqli_query($conn, $queryHapusinventaris);
  return mysqli_affected_rows($conn);
}

function ubahinventaris($data) {
  global $conn;

  $id_brg = htmlspecialchars($data["id_brg"]);
  $nama_brg = htmlspecialchars($data["nama_brg"]);
  $kondisi = $data["kondisi"];
  $keterangan = htmlspecialchars($data["keterangan"]);
  $lokasi = htmlspecialchars($data["lokasi"]);
  $tanggal_inventaris = htmlspecialchars($data["tanggal_inventaris"]);
  $anggaran = htmlspecialchars($data["anggaran"]);

  

  $gambarLama = $data['gambarLama'];

  if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
  } else {
      $gambar = upload();
  }

  $id = ($data["id"]);

  $queryUbahinventaris = "UPDATE tb_inventaris SET 
  id_brg        = '$id_brg',
  nama_brg       = '$nama_brg',
  gambar         = '$gambar',
  kondisi        = '$kondisi',
  keterangan     = '$keterangan',
  lokasi         = '$lokasi',
  tanggal_inventaris           = '$tanggal_inventaris',
  anggaran       = '$anggaran'

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahinventaris);

  return mysqli_affected_rows($conn);
}


function cariinventaris($keyword) {

  $queryCariinventaris = "SELECT * FROM tb_inventaris WHERE nama_brg LIKE '%$keyword%'";
  return queryTampilinventaris($queryCariinventaris);
}

?>