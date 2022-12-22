<?php 
$conn = mysqli_connect("localhost", "root", "", "laporan");

function queryTampilperalatan($queryTampilperalatan) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilperalatan);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahPeralatan($data) {
  global $conn;

  // $id_alat = htmlspecialchars($data["id_alat"]);
  $nm_alat = htmlspecialchars($data["nm_alat"]);
  $jenis_alat = htmlspecialchars($data["jenis_alat"]);
  $keterangan = htmlspecialchars($data["keterangan"]);

  // $foto = uploadfoto();
  // if (!$foto){
  //   return false;
  // }

  $queryTambahperalatan = "INSERT INTO tb_peralatan
                VALUES
                  ('', '$nm_alat', '$jenis_alat', '$keterangan')
                  ";

  mysqli_query($conn, $queryTambahperalatan);
  return mysqli_affected_rows($conn);
  }
  function hapusperalatan($id_alat) {
    global $conn;
  
    $queryHapusperalatan = "DELETE FROM tb_peralatan WHERE id_alat = $id_alat";
    mysqli_query($conn, $queryHapusperalatan);
    return mysqli_affected_rows($conn);
  }

function ubahperalatan($data) {
  global $conn;

  $nm_alat = htmlspecialchars($data["nm_alat"]);
  $jenis_alat = $data["jenis_alat"];
  $keterangan = htmlspecialchars($data["keterangan"]);

  $id_alat = ($data["id"]);

  $queryUbahperalatan = "UPDATE tb_peralatan SET 
  nm_alat = '$nm_alat',
  jenis_alat = '$jenis_alat',
  keterangan = '$keterangan'
  WHERE id_alat = '$id_alat'";

  mysqli_query($conn, $queryUbahperalatan);

  return mysqli_affected_rows($conn);
}

function cariperalatan($keyword) {

  $queryCariperalatan = "SELECT * FROM tb_peralatan WHERE nm_alat LIKE '%$keyword%'";
  return queryTampilperalatan($queryCariperalatan);
}
// function uploadfoto() {
//   global $conn;
  
//   $namafile = $_FILES['foto']['name'];
//   $ukuranfile = $_FILES['foto']['size'];
//   $error = $_FILES['foto']['error'];
//   $tmpname = $_FILES['foto']['tmp_name'];

//   //cek apakah gambar sudah diupload
//   if($error === 4) {
//     echo "<script>
//         alert('Pilih Gambar Cover Terlebih Dahulu');
//           </script>";
//           return false;
//   }
//   //ekstensi file yang diupload
//   $ekstensigambarvalid = ['jpg','png'];//menentukan format/ekstensi gambar yang diperbolehkan
//   $ekstensigambar = explode('.', $namafile);//explode untuk memecah string titik dengan nama file
//   $ekstensigambar = strtolower(end($ekstensigambar));//strtolower untuk mengubah nama ekstensi file menjadi huruf kecil, end untuk memilih delimiter terakhir sebagai format/ekstensi gambar
//   if(!in_array($ekstensigambar, $ekstensigambarvalid)) {
//     echo "<script>
//         alert('Format/Ekstensi File Gambar Harus jpg/png');
//           </script>";
//           return false;
//   }

//   //membatasi ukuran file gambar
//   if($ukurnafile > 1000000) {
//     echo "<script>
//         alert('Ukuran File Gambar Terlalu Besar');
//           </script>";
//           return false;
//   }

//   //buat nama file baru untuk file gambar, agar tidak ada kesamaan nama file
//   $namafilebaru = uniqid();
//   $namafilebaru .= '.';
//   $namafilebaru .= $ekstensigambar;

//   //gambar lolos pengecekan ekstensi dan ukuran, pemindahan lokasi file gambar
//   move_uploaded_file($tmpname, 'img/' . $namafilebaru);

//   return $namafilebaru;

// }
?>