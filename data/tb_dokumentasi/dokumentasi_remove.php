<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "dokumentasi_functions.php";
$id_dok = $_GET["id_dok"];
$tb_dokumentasi = queryTampildokumentasi("SELECT * FROM tb_dokumentasi WHERE id_dok = $id_dok")[0];

if(isset($_POST["submit"])) {
  if(hapusdokumentasi($id_dok)>0) {
    echo "<script>alert('Data dokumentasi Berhasil Dihapus');document.location.href = 'dokumentasi_show.php';</script>";
  } 
  else {
    echo "<script>alert('Data dokumentasi Gagal Dihapus');document.location.href = 'dokumentasi_show.php';</script>";
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

    <title>Hapus Data dokumentasi</title>

  </head>
  <body>

  <header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" a href="../../index.php"> ALMAZAYA</a>
            <a class="nav-link-active text-white" a href="../../laporan_data.php">Data Al-Mazaya</a>
            
            <div class="ms-3 dropdown">
             <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Data Master
            </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="../../data/tb_karyawan/karyawan_show.php">Karyawan</a></li>
                <li><a class="dropdown-item" href="../../data/tb_guru/guru_show.php">Guru</a></li>
                <li><a class="dropdown-item" href="../../data/tb_siswa/siswa_show.php">Siswa</a></li>
              </ul>
            </div>

              <div class="ms-3 dropdown">
             <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Data Laporan
            </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="../../data/tb_inventaris/inventaris_print.php">Inventaris</a></li>
                <li><a class="dropdown-item" href="../../data/tb_pinjam/pinjam_print.php">Pinjaman</a></li>
                <li><a class="dropdown-item" href="../../data/tb_pengembalian/pengembalian_print.php">pengembalian</a></li>
                <li><a class="dropdown-item" href="../../data/tb_pemeliharaan/pemeliharaan_print.php">Pemeliharaan Barang</a></li>
                <li><a class="dropdown-item" href="../../data/tb_dokumentasi/dokumentasi_print.php">Dokumentasi</a></li>
                <li><a class="dropdown-item" href="../../data/tb_project/project_print.php">Project</a></li>
                <li><a class="dropdown-item" href="../../data/tb_kinerja/kinerja_print.php">Kinerja</a></li>
                <li><a class="dropdown-item" href="../../data/tb_guru/guru_print.php">Guru</a></li>
                <li><a class="dropdown-item" href="../../data/tb_siswa/siswa_print.php">Siswa</a></li>
                <li><a class="dropdown-item" href="../../data/tb_rapot_siswa/rapot_siswa_print.php">rapot Siswa</a></li>
                 
                <li><a class="dropdown-item" href="../../data/tb_mapel/mapel_print.php">Data Mata Pelajaran</a></li>
              </ul>
            </div>

           
            
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






    <!-- BODY -->
    <section id="body">
      <div class="container">
        <h1 class="text-primary-dark mb-5 text-center">Hapus Data dokumentasi <br>   AL-MAZAYA</h1>
        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="dokumentasi_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data dokumentasi</button>
            </a>
          </div>
        </div>  
        <div class="row mb-3">
          <div class="col">
            <div class="card">
              <div class="card-header fw-bolder">
                <h5 class="card-title">Konfirmasi Penghapusan Data dokumentasi</h5>
              </div>
              <div class="card-body">
                <ol class="list-group mb-3">
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      Nama dokumentasi
                      <div class="fw-bold"><?= $tb_dokumentasi["nm_dok"] ?></div>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      Tanggal Dokumentasi
                      <div class="fw-bold"><?= $tb_dokumentasi["tgl_dok"] ?></div>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                     <div class="ms-2 me-auto">
                        <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
                        <img src="../../gambar/<?= $tb_dokumentasi['gambar']; ?>" width="200px"  style="margin-bottom: 10px;">
                      </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      Keadaan Cuaca
                      <div class="fw-bold"><?= $tb_dokumentasi["tempat"] ?></div>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      Nama Dokumentalis
                      <div class="fw-bold"><?= $tb_dokumentasi["nama_dokumentalis"] ?></div>
                    </div>
                  </li>
                </ol>
                <p class="text-danger">
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                  <i class="bi bi-exclamation-triangle-fill"></i><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"     aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                  <div>
                  PERHATIAN: Data yang Telah Dihapus Tidak Dapat Dikembalikan!
                  </div>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <form action="" method="post">
              <button type="submit" name="submit" class="btn btn-danger"><i class="bi bi-x-circle-fill"></i> Hapus Data dokumentasi</button>
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