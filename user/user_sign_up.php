<?php 

require "user_functions.php";

if(isset($_POST["sign_up"])) {
  if(signup($_POST) > 0) {
    echo "<script>alert('Sign Up Berhasil!');document.location.href = 'user_sign_in.php'</script>";
  } else {
    echo mysqli_error($conn);
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

    <title>Sign Up</title>

  </head>
  <body>

    <!-- NAVBAR -->
    <section id="navbar">
      <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
          <a href="https://senior.almazayaislamicschool.sch.id//" target="_blank">
          <img src="../gambar/logo-amz.png" width="120px" alt="Almazaya" class="mt-3"/>
          </a>
          <!-- <p class="navbar-brand ms-3 mt-3">  AL-MAZAYA</p> -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <!-- <li class="nav-item">
                <a class="nav-link fw-bold" href="#">Sign Up</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link fw-bold" href="user_sign_in.php">Sign In</a>
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
                <h2 class="text-primary-dark fw-bold text-center">Sign Up</h2>
                <form method="post">
                  <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required autocomplete="off"required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autocomplete="off"required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="off"required>
                  </div>
                  <div class="mb-3">
                    <label for="password2" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" required autocomplete="off"required>
                  </div>
                  <div class="mb-3">
                    <label for="level" class="form-label">Level Pengguna</label>
                    <select class="form-select" name="level" id="level">
                  <option selected></option>
                      <option value="Guru">Guru</option>
                      <option value="Karyawan">Karyawan</option>
                </select>
                  </div>
                  <button type="submit" class="btn btn-primary" name="sign_up">Sign Up</button>
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