<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "dokumentasi_functions.php";
$dokumentasi = queryTampildokumentasi("SELECT * FROM filterjuli2022");

if ( isset($_POST["caridokumentasi"]) ) {
	$dokumentasi = caridokumentasi($_POST["keyword"]);
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

    <title>Tabel Data dokumentasi</title>

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


    <!-- BODY -->
    <br>
    </br>
    <section id="body">
      <div class="container">
        <h1 class="text-primary-dark mb-5 text-center">Tabel Data Dokumentasi <br>   AL-MAZAYA</h1>
        <div class="row">
          <div class="col-md-7">
            <a href="../../index_karyawan.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="dokumentasi_input.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-person-plus-fill"></i> Tambah Data dokumentasi</button>
            </a>
            <a href="dokumentasi_printjuli.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-printer-fill"></i> Cetak Data dokumentasi</button>
            </a>
            <br>
            <br>
            <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Print perbulan
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="dokumentasi_showjanuari.php">Januari</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showfebruari.php">februari</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showmaret.php">maret</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showapril.php">april</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showmei.php">mei</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showjuni.php">juni</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showjuli.php">juli</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showagustus.php">agustus</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showseptember.php">september</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showoktober.php">oktober</a></li>
    <li><a class="dropdown-item" href="dokumentasi_shownovember.php">november</a></li>
    <li><a class="dropdown-item" href="dokumentasi_showdesember.php">desember</a></li>
  </ul>
</div>
          </div>
          <div class="col-md-5">
            <div class="input-group mb-3">
              <form action="" method="post" class="d-flex">         
                <input type="text" class="form-control" placeholder="Cari Nama dokumentasi" name="keyword" size="70" autofocus autocomplete="off"required>
                <button class="btn btn-outline-primary ms-1" type="submit" name="caridokumentasi"><i class="bi bi-search"></i></button>
              </form>
            </div>
          </div>
        </div>
<br>
<br>
        <div class="row">
          <div class="col">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama dokumentasi</th>
                <th scope="col">Nama Alat</th>
                <th scope="col">Gambar</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Tanggal Dokumentasi</th>
                <th scope="col">Keadaan Cuaca</th>
                <th scope="col">Tempat Pelaksanaan</th>
              </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($dokumentasi as $row) : ?>
            <tbody>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $row["nm_dok"]; ?></td>
                <td><?= $row["nm_alat"]; ?></td>
                <td><img src="../../gambar/<?php echo $row["gambar"]; ?>"width="100px"></td>
                <td><?= $row["keterangan"]; ?></td>
                <td><?= $row["tgl_dok"]; ?></td>
                <td><?= $row["keadaan_cuaca"]; ?></td>
                <td><?= $row["tempat_pelaksanaan"]; ?></td>
                <td>
                <a href="dokumentasi_filter.php?id_dok=<?= $row["id_dok"]; ?>">
                    <span class="badge bg-warning"><i class="bi bi-printer"></i>Cetak</span>
                  </a><br>
                  <a href="dokumentasi_update.php?id_dok=<?= $row["id_dok"]; ?>">
                    <span class="badge bg-success"><i class="bi bi-pen-fill"></i>Edit</span>
                  </a><br>
                  <a href="dokumentasi_remove.php?id_dok=<?= $row["id_dok"]; ?>" >
                    <span class="badge bg-danger"><i class="bi bi-trash-fill"></i></span>
                  </a>
                </td>
              </tr>
            </tbody>
            <?php $i++ ?>
            <?php endforeach; ?>
          </table>
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