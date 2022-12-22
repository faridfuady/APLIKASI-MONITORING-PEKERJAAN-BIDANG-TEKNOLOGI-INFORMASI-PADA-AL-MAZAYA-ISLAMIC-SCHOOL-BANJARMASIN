<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "maintenance_functions.php";
$id_maintenance = $_GET["id_maintenance"];
$tb_maintenance = queryTampilmaintenance("SELECT * FROM tb_maintenance WHERE id_maintenance = $id_maintenance");


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

    <title>Cetak Data Karyawan</title>

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

    <!-- BODY -->
    <br>
    </br>
    <section id="body">
      <div class="container">
        <h1 class="text-primary-dark mb-5 text-center">Cetak Data Maintenance <br>   AL-MAZAYA</h1>
        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="dokumentasi_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data Maintenance</button>
            </a>
          </div>
        </div>

        <div class="container">
        <div class="row mb-3">
          <div class="col-md-3 mt-3">
            <img src="../../gambar/logo-amz.png" width="100px">
          </div>
          <div class="col-md-9 justify-content-center text-center head-print">
            <h2 style="font-family: 'Times New Roman'; font-weight: bold; color: rgb(12, 54, 117);"> <br> LAPORAN DATA MAINTENANCE <br>   AMZ</h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Maintenance</th>
                <th scope="col">Nama Alat</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jadwal</th>
                <th scope="col">Nama Karyawan</th>
              </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($tb_maintenance as $row) : ?>
            <tbody>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $row["nm_maintenance"]; ?></td>
                <td><?= $row["nm_alat"]; ?></td>
                <td><?= $row["keterangan"]; ?></td>
                <td><?= $row["jadwal"]; ?></td>
                <td><?= $row["nm_kryw"]; ?></td>
                <td>
                </td>
              </tr>
            </tbody>
            <?php $i++ ?>
            <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col">
            <form action="" method="post">
                <a href="maintenance_filter_savepdf.php?id_maintenance=<?= $row["id_maintenance"]; ?>" >
                    <button type="button" class="btn btn-danger"><i class="bi bi-x-circle-fill"></i> Cetak Data Maintenance</button>
                </a>
            </form>
          </div>
        </div>
      </div>
      <hr>
    </section>  

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