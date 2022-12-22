<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "karyawan_functions.php";
$id = $_GET["id"];
$tb_karyawan = queryTampilkaryawan("SELECT * FROM tb_karyawan WHERE id = $id");


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
        <h1 class="text-primary-dark mb-5 text-center">Cetak Data Karyawan <br>   AL-MAZAYA</h1>
        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="dokumentasi_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data Karyawan</button>
            </a>
          </div>
        </div>

        <div class="container">
        <div class="row mb-3">
          <div class="col-md-3 mt-3">
            <img src="../../gambar/logo-amz.png" width="100px">
          </div>
          <div class="col-md-6 justify-content-center text-center head-print">
            <h2 style="font-family: 'Times New Roman'; font-weight: bold; color: rgb(12, 54, 117);"><br> LAPORAN DATA KARYAWAN <br>   AL-MAZAYA <br> </h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <table class="table table-bordered border-dark" style="font-family: 'Times New Roman';">
              <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Karyawan</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Alamat Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Foto</th>
                <th>Jabatan</th>
                <th>No Telepon</th>
              </tr>
              <?php $i = 1; ?>
              <?php foreach($tb_karyawan as $row) : ?>    
              <tr>
                <td><?= $i ?></td>
                <td><?= $row["nip"]; ?></td>
                <td><?= $row["nm_kryw"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["jenis_kelamin"]; ?></td>
                <td><?= $row["alamat"]; ?></td>
                <td><?= $row["tanggal_lahir"]; ?></td>
                <td><img src="../../gambar/<?php echo $row["gambar"]; ?>"width="100px"></td>
                <td><?= $row["jabatan"]; ?></td>
                <td><?= $row["no_telp"]; ?></td>
              </tr>
              <?php $i++ ?>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col">
            <form action="" method="post">
                <a href="karyawan_filter_savepdf.php?id=<?= $row["id"]; ?>" >
                    <button type="button" class="btn btn-danger"><i class="bi bi-x-circle-fill"></i> Cetak Data Karyawan</button>
                </a>
            </form>
          </div>
        </div>
      </div>
      <hr>
    </section>  

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