<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "ruangan_functions.php";
$id = $_GET["id"];
$tb_ruangan = queryTampilruangan("SELECT * FROM tb_ruangan WHERE id = $id")[0];

if(isset($_POST["submit"])) {
  if(ubahruangan($_POST)>0) {
    echo "<script>alert('Data ruangan Berhasil Diubah');document.location.href = 'ruangan_show.php';</script>";
  } else {
    // echo mysqli_error($conn);
    
    echo"<script>alert('Data ruangan Gagal Diubah');document.location.href = 'ruangan_show.php';</script>";
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

    <title>Ubah Data ruangan</title>

  </head>
  <body>

    <!-- NAVBAR -->
   <header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand"a href="index.php">Al-Mazaya</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="https://senior.almazayaislamicschool.sch.id/">SMA Al-Mazaya</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://junior.almazayaislamicschool.sch.id/">SMP Al-Mazaya</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"a href="../../laporan_data_karyawan.php">Data Laporan</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li> -->
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
        <h1 class="text-primary-dark mb-5 text-center">Ubah Data ruangan <br>   AL-MAZAYA</h1>
        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index_karyawan.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="ruangan_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data ruangan</button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col">
          <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $tb_ruangan["id"]; ?>">
          <!-- <input type="hidden" name="gambarLama" value="<?= $tb_ruangan["gambar"]; ?>"> -->
          <div class="mb-3">
              <label for="ruangan" class="form-label">ruangan</label>
              <input type="text" class="form-control" id="ruangan" name="ruangan" autocomplete="off"required value="<?= $tb_ruangan["ruangan"]; ?>">
            </div>
            <div class="mb-3">
                <label for="guru" class="form-label">Wali ruangan</label>
                <select class="form-select" name="guru" id="guru">
                  <option selected></option>
                  <?php 
                    $sql_nama = mysqli_query($conn, "SELECT * FROM tb_karyawan ORDER BY nama ASC") or die (mysqli_error($conn));
                    while($data_nama = mysqli_fetch_array($sql_nama)) {
                      echo '
                      <option value="'.$data_nama['nama'].'">
                        '.$data_nama['nip'].' - '.$data_nama['nama'].'
                      </option>
                      ';
                    }
                  ?>
                </select>
              </div>
            <div class="mb-3">
              <label for="jumlah_siswa" class="form-label">Jumlah Siswa</label>
              <input type="text" class="form-control" id="jumlah_siswa" name="jumlah_siswa" autocomplete="off"requiredvalue="<?= $tb_ruangan["jumlah_siswa"]; ?>">
            </div>
           
            <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Ubah Data ruangan</button>
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