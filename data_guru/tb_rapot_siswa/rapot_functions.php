<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilrapot($queryTampilrapot) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilrapot);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahrapot($data) {
  global $conn;

  $nis = htmlspecialchars($data["nis"]);
  $kelas   = htmlspecialchars($data["kelas"]);
  $mapel   = htmlspecialchars($data["mapel"]);
  $tugas = htmlspecialchars($data["tugas"]);
  $uts = htmlspecialchars($data["uts"]);
  $uas = htmlspecialchars($data["uas"]);

  $queryTambahrapot = "INSERT INTO tb_rapot_siswa VALUES ('','$nis','$kelas','$mapel', '$tugas', '$uts', '$uas')";

  mysqli_query($conn, $queryTambahrapot);
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


function hapusrapot($id) {
  global $conn;

  $queryHapusrapot = "DELETE FROM tb_rapot_siswa WHERE id = $id";
  mysqli_query($conn, $queryHapusrapot);
  return mysqli_affected_rows($conn);
}

function ubahrapot($data) {
  global $conn;

  // $nis = htmlspecialchars($data["nis"]);
  $kelas = htmlspecialchars($data["kelas"]);
  $mapel = htmlspecialchars($data["mapel"]);
  $tugas = htmlspecialchars($data["tugas"]);
  $uts = htmlspecialchars($data["uts"]);
  $uas = htmlspecialchars($data["uas"]);
  
  $nis = ($data["nis"]);

  $queryUbahrapot = "UPDATE tb_rapot_siswa SET 
  -- nis            = '$nis',
  kelas          = '$kelas',
  mapel          = '$mapel',
  tugas          = '$tugas',
  uts           = '$uts',
  uas           = '$uas'

  WHERE nis = '$nis' AND mapel = '$mapel'";

  mysqli_query($conn, $queryUbahrapot);

  return mysqli_affected_rows($conn);
}


function carirapot($keyword) {

  $queryCarirapot = "SELECT * FROM tb_rapot_siswa WHERE nama LIKE '%$keyword%'";
  return queryTampirapotar($queryCarirapot);
}

?>