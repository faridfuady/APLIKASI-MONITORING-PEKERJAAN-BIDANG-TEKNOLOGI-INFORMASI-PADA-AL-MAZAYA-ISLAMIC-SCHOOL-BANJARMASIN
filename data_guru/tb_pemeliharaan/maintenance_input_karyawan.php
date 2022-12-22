<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "maintenance_functions.php";

if(isset($_POST["submit"])) {
  if(tambahmaintenance($_POST)>0)
  //  {   echo mysqli_error($conn);
     {echo "<script>alert('Data maintenance Berhasil Ditambah');document.location.href = 'maintenance_show.php';</script>";
    } 
  else {
    echo "<script>alert('Data maintenance Gagal Ditambah');document.location.href = 'maintenance_show.php';</script>";
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

    <title>Tambah Data Maintenance</title>

  </head>
  <body>


  <header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" a href="../../index_karyawan.php">  | ALMAZAYA</a>
            <a class="nav-link-active text-white" a href="../../laporan_data_karyawan.php">Data Laporan</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
          
          <li class="nav-item text-light mt-2">
            <?= $_SESSION["level"];?>
          </li>
                    <li class="nav-item">
                    <a class="nav-link"a href="../../user/user_sign_out.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- NAVBAR END -->


    <!-- NAVBAR END -->

    <!-- BODY -->
    <section id="body">
      <div class="container">
        <h1 class="text-primary-dark mb-5 text-center">Tambah Data Maintenance <br>   AL-MAZAYA</h1>

        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="maintenance_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data Maintenance</button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <form method="post">
              <div class="mb-3">
                <label for="nm_maintenance" class="form-label">Nama Maintenance</label>
                <input type="text" class="form-control" id="nm_maintenance" name="nm_maintenance" required autocomplete="off"required>
              </div>
              <div class="mb-3">
                <label for="nm_alat" class="form-label">Menggunakan Alat</label>
                <select class="form-select" name="nm_alat" id="nm_alat">
                  <option selected></option>
                  <?php 
                    $sql_nm_alat = mysqli_query($conn, "SELECT * FROM tb_peralatan ORDER BY nm_alat ASC") or die (mysqli_error($conn));
                    while($data_nm_alat = mysqli_fetch_array($sql_nm_alat)) {
                      echo '
                      <option value="'.$data_nm_alat['nm_alat'].'">
                        '.$data_nm_alat['nm_alat'].'
                      </option>
                      ';
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" required autocomplete="off"required>
              </div>
              <div class="mb-3">
                <label for="jadwal" class="form-label">Jadwal</label>
                <input type="date" class="form-control" id="jadwal" name="jadwal" required autocomplete="off"required>
              </div>
              <div class="mb-3">
                <label for="nm_kryw" class="form-label">Karyawan yang bertugas</label>
                <select class="form-select" name="nm_kryw" id="nm_kryw">
                  <option selected></option>
                  <?php 
                    $sql_nm_kryw = mysqli_query($conn, "SELECT * FROM tb_karyawan ORDER BY nm_kryw ASC") or die (mysqli_error($conn));
                    while($data_nm_kryw = mysqli_fetch_array($sql_nm_kryw)) {
                      echo '
                      <option value="'.$data_nm_kryw['nm_kryw'].'">
                        '.$data_nm_kryw['nm_kryw'].'
                      </option>
                      ';
                    }
                  ?>
                </select>
              </div>
              <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah Data maintenance</button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- BODY END -->

    <!-- FOOTER -->
    <section class="footer mt-3">
      <hr>
      <div class="row justify-content-center mt-3">
        <div class="col-md">
          <p class="text-center text-primary-dark fw-bold">Muhammad Farid Fuady Rahman - 18630631 - UNISKA Banjarmasin</p>
        </div>
      </div>
    </section>
    <!-- FOOTER END -->



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