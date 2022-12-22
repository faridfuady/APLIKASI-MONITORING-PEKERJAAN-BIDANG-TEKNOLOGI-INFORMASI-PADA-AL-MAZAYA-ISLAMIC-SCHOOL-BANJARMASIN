<?php 

$conn = mysqli_connect("localhost", "root", "", "db_pelatihan_digital_marketing");

function queryTampilttd($queryTampilttd) {
  global $conn; 
  $result = mysqli_query($conn, $queryTampilttd);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


function ubahttd($data) {
  global $conn;

  $nama = htmlspecialchars($data["nama"]);
  

  $id = ($data["id"]);

  $queryUbahttd = "UPDATE tb_ttd SET 
  nama            = '$nama'
  

  WHERE id = '$id'";

  mysqli_query($conn, $queryUbahttd);

  return mysqli_affected_rows($conn);
}


function signup($data) {
  global $conn;

  $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
  $email = htmlspecialchars($data["email"]);
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);
  $level = $data["level"];

  //cek username apakah sudah ada atau belum
  $cekemail = mysqli_query($conn, "SELECT email FROM tb_pengguna WHERE email = '$email'");
  if(mysqli_fetch_assoc($cekemail)) {
    echo "<script>alert('Email Sudah Terdaftar');</script>";
    return false;
  }

  //konfirmasi password
  if($password !== $password2) {
    echo "<script>alert('Password Tidak Sesuai');</script>";
    return false;
  }

  //enkripsi / mengamankan password
  $password = password_hash($password, PASSWORD_DEFAULT);
  // $password = md5($password);


  //tambahkan user baru ke database
  $querySignup = "INSERT INTO tb_pengguna VALUES ('', '$nama_lengkap', '$email', '$password', '$level')";
  mysqli_query($conn, $querySignup);
  return mysqli_affected_rows($conn);

}

// function signin() {
//   global $conn;

//   $email = $_POST["email"];
//   $password = $_POST["password"];

//   $querySignin = "SELECT * FROM tb_pengguna WHERE email = '$email'";
//   $result = mysqli_query($conn, $querySignin);

//   //cek email
//   if(mysqli_num_rows($result) === 1) {
//     // cek password 
//     $row = mysqli_fetch_assoc($result);
//     if(password_verify($password, $row["password"])) {
//       header("Location: '../index.php'");
//       exit;
//     }
//   }
//   $error = true;
// }


?>