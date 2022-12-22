<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

function queryTampilpinjam($queryTampilpinjam) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilpinjam);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahpinjam($data) {
  global $conn;

  $kd_pinjam = htmlspecialchars($data["kd_pinjam"]);
  $nip = htmlspecialchars($data["nip"]);
  $id_brg = htmlspecialchars($data["id_brg"]);
  $tanggal_pinjam = htmlspecialchars($data["tanggal_pinjam"]);
  $keperluan = htmlspecialchars($data["keperluan"]);
  $status = htmlspecialchars($data["status"]);

  $queryTambahpinjam = "INSERT INTO tb_pinjam VALUES ('','$kd_pinjam','$nip','$id_brg','$tanggal_pinjam','$keperluan','$status')";

  mysqli_query($conn, $queryTambahpinjam);
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


function hapuspinjam($id) {
  global $conn;

  $queryHapuspinjam = "DELETE FROM tb_pinjam WHERE id = $id";
  mysqli_query($conn, $queryHapuspinjam);
  return mysqli_affected_rows($conn);
}

function ubahpinjam($data) {
  global $conn;


  $kd_pinjam = htmlspecialchars($data["kd_pinjam"]);
  $nip = htmlspecialchars($data["nip"]);
  $id_brg = htmlspecialchars($data["id_brg"]);
  $tanggal_pinjam = htmlspecialchars($data["tanggal_pinjam"]);
  $keperluan = htmlspecialchars($data["keperluan"]);
  $status = htmlspecialchars($data["status"]);

  $id = ($data["id"]);

  $queryUbahpinjam = "UPDATE tb_pinjam SET 
  kd_pinjam                = '$kd_pinjam',
  nip                = '$nip',
  id_brg           = '$id_brg',
  tanggal_pinjam     = '$tanggal_pinjam',
  keperluan          = '$keperluan',
  status             = '$status'


  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahpinjam);

  return mysqli_affected_rows($conn);
}


function caripinjam($keyword) {
  $rowPerPage = 5;
  $rows = count(queryTampilpinjam("SELECT * FROM tb_barang_pinjam_karyawan"));
  $pages = ceil($rows / $rowPerPage);
  $activePage = (isset($_GET["data-page"])) ? $_GET["data-page"] : 1;
  $firstData = ($rowPerPage * $activePage) - $rowPerPage;
  $queryCaripinjam = "SELECT * FROM tb_barang_pinjam_karyawan WHERE nama_brg LIKE '%$keyword%' LIMIT $firstData, $rowPerPage";
  return queryTampilpinjam($queryCaripinjam);
}

function querypinjamSearch($keyword)
{
  $rowPerPage = 10;
  $rows = count(querypinjamRead("SELECT * FROM tb_pinjam"));
  $pages = ceil($rows / $rowPerPage);
  $activePage = (isset($_GET["data-page"])) ? $_GET["data-page"] : 1;
  $firstData = ($rowPerPage * $activePage) - $rowPerPage;
  $querypinjamSearch = "SELECT * FROM tb_pinjam WHERE nama LIKE '%$keyword%' LIMIT $firstData, $rowPerPage";
  return querypinjamRead($querypinjamSearch);
}

?>

