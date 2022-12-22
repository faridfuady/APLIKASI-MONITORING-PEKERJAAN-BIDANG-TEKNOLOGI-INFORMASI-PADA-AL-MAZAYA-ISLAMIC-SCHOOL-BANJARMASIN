<?php 

session_start();

// if(isset($_SESSION["signin"])) {
//   header("Location: ../index.php");
//   exit;
// }

require "user_functions.php";

if(isset($_POST["sign_in"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $querySignin = "SELECT * FROM tb_pengguna WHERE email = '$email'";
  $result = mysqli_query($conn, $querySignin);
  

  //cek email
  if(mysqli_num_rows($result) === 1) {
    // cek password 
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])) {
      // set session
      $_SESSION["signin"] = true;

      $_SESSION['nama_lengkap']=$row['nama_lengkap'];
      $_SESSION['email']=$row['email'];
      $_SESSION['password']=$row['password'];
      $_SESSION['level']=$row['level'];
    

      if($_SESSION["level"] === "Pimpinan") {
        echo "<script>alert('Sign In Berhasil!');document.location.href = '../index.php';</script>";
        exit;
      }
      if($_SESSION["level"] === "Karyawan") {
        echo "<script>alert('Sign In Berhasil!');document.location.href = '../index_karyawan.php';</script>";
        exit;
      }
      if($_SESSION["level"] === "Guru") {
        echo "<script>alert('Sign In Berhasil!');document.location.href = '../index_guru.php';</script>";
        exit;
      }
  }
    }

  else {
    echo "<script>alert('Sign In Gagal!');document.location.href = 'user_sign_in.php';</script>";
        exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <style>
      a {
        text-decoration: none;
      }
    </style>

    <title>Sign In</title>

  </head>
  <body>

    <!-- NAVBAR -->
    <section id="navbar ">
      <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container ">
          <a href="https://senioralmazaya.com/" target="_blank">
            <img src="../gambar/logo-amz.png" width="120px" alt="Almazaya" class="mt-3"/>
          </a>
          <!-- <p class="navbar-brand ms-3 mt-3">Pelatihan Digital Marketing</p> -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <!-- <li class="nav-item">
                <a class="nav-link fw-bold" href="#">Sign Up</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link fw-bold" href="user_sign_up.php">Sign Up</a>
              </li>
            </ul>
        </div>
      </nav>
      <hr>
    </section>
    <!-- NAVBAR END -->

    <!-- BODY -->
    <section id="body">
      <div class="container">
        <div class="row mb-3 justify-content-center">
          <div class="col-md-6">
            <div class="card mb-3">
              <div class="card-body">
                <h2 class="text-primary fw-bold text-center ">Sign Inn</h2>
                <!-- <?php 
                  if(isset($error)) {
                    echo "<script>alert('Sign In Gagal!');document.location.href = 'user_sign_in.php';</script>";
                  }
                ?> -->
                <form method="post">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autocomplete="off"required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="off"required>
                  </div>
                  <button type="submit" class="btn btn-primary" name="sign_in">Sign In</button>
                </form>
              </div>
            </div>
            <!-- <a href="../index.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a> -->
          </div>
        </div>
      </div>
    </section>
    <!-- BODY END -->

    <!-- FOOTER -->
    <div class="container-fluid">
            <div class="row bg-dark text-white">
                <div class="col-md-6 my-2" id="about">
                    <h4 class="fw-bold text-uppercase">Contact Here</h4>
                    <p>SMA Almazaya Islamic School Banjarmasin ⋅ Islamic, discipline, smart, skillful, love the nation and has a global competitive mindset human resource</p>
                    <p><i class="bi bi-geo-alt"></i>&ensp;<strong>Alamat&ensp;: </strong>&emsp; Jl. Cempaka Besar No. 57</p>
                    <p><i class="bi bi-telephone-inbound"></i>&ensp;<strong>Telepon : </strong>&emsp; 08115051123</p>
                    <p><i class="bi bi-envelope"></i>&ensp;<strong>Email &emsp;: </strong>&ensp;&ensp; ALMAZAYAISLAMICSHOOL.BJM@gmail.com</p>
                </div>
                
            </div>
        </div>
        <footer class="bg-dark text-white text-center" style="padding: 5px;">
  
        </footer>
    </main>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>