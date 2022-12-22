<?php


session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}


require "dokumentasi_functions.php";

if (isset($_POST['date_filter'])) {
  $startPost = $_POST['start_date'];
  $endPost = $_POST['end_date'];
  // $_SESSION["date_filter_actived"] = $dateFilter;
  $rowPerPageDateFilter = 10;
  $rowsDateFilter = count(queryTampildokumentasi("SELECT * FROM tb_dokumentasi WHERE tgl_dok BETWEEN '$startPost%' AND '$endPost%'"));
  $pagesDateFilter = ceil($rowsDateFilter / $rowPerPageDateFilter);
  $activePageDateFilter = (isset($_GET["data-page-date-filter"])) ? $_GET["data-page-date-filter"] : 1;
  $firstDataDateFilter = ($rowPerPageDateFilter * $activePageDateFilter) - $rowPerPageDateFilter;
  $dokumentasiDateFilter = queryTampildokumentasi("SELECT * FROM tb_dokumentasi WHERE tgl_dok BETWEEN '$startPost%' AND '$endPost%'");
} 
?>  

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

    <title>Tambah Data Dokumentasi</title>

  </head>
  <body>



<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" a href="../../index_karyawan.php"> ALMAZAYA</a>
            <a class="nav-link-active text-white" a href="../../laporan_data_karyawan.php">Data Al-Mazaya</a>
            
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
                <li><a class="dropdown-item" href="../../data/tb_pinjam/pinjam_print.php">pinjam</a></li>
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
 

<section id="cyclist-read" style="margin-top: 100px;">
  <div class="container">
    <div class="row">
      <div class="col">
        <h3>Data Dokumentasi </h3>

        
          <form action="" method="post" class="">
            <div class="row">
              <div class="col-md-2">
                <input type="date" name="start_date" class="form-control d-inline">
              </div>
              <div class="col-md-2">
                <input type="date" name="end_date" class="form-control d-inline">
              </div>
              <div class="col">

                  <button type="submit" name="date_filter" class="btn btn-info d-inline">Filter</button>
                  
                   <?php if (isset($_POST['date_filter'])) { ?>
                    <a href="dokumentasi-read-date-filter-savepdf.php?start_date=<?= $_POST['start_date']; ?>&end_date=<?= $_POST['end_date']; ?>" target="_blank">
                      <button type="button" class="btn btn-outline-primary"><i class="bi bi-printer-fill"></i> Cetak Data</button>
                    </a>
                      <?php } else { ?>
                        <a href="dokumentasi-read-date-filter-savepdf.php" target="_blank">
                          <button type="button" class="btn btn-outline-primary"><i class="bi bi-printer-fill"></i> Cetak Data</button>
                        </a>
                   <?php } ?>
            </a>
              </div>
            </div>

        </form>


        <div class="row">
              <div class="col">
                <?php if (!isset($_POST['date_filter'])) { ?>
                  <h5 class="">Masukkan Rentang Tanggal</h5>
                <?php } else if ($rowsDateFilter != 0) { ?>
                  <?php
                  $startConvert = date("d-M-Y", strtotime($startPost));
                  $endConvert = date("d-M-Y", strtotime($endPost));
                  ?>
                  <h5 class="">Hasil Pencarian dari Tanggal <?= $startConvert; ?> sampai dengan Tanggal <?= $endConvert; ?>: <?= $rowsDateFilter; ?> Data</h5>
                <?php } else { ?>
                  <h5 class="">Data Tidak Ditemukan, Masukkan Rentang Tanggal dengan Benar</h5>
                <?php } ?>

                <table class="table table-striped table-bordered">
                  <thead>
                  <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Dokumentasi</th>
                <th scope="col">Tanggal Dokumentasi</th>
                <th scope="col">Gambar</th>
                <th scope="col">Tempat</th>
                <th scope="col">Nama Dokumentalis</th>
              </tr>
              </thead>

<?php $i = 1; ?>
<?php if (isset($_POST['date_filter'])) : ?>
  <?php foreach ($dokumentasiDateFilter as $row) : ?>
    <tbody>
      <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $row["nm_dok"]; ?></td>
                <td><?= $row["tgl_dok"]; ?></td>
                <td><img src="../../gambar/<?php echo $row["gambar"]; ?>"width="100px"></td>
                <td><?= $row["tempat"]; ?></td>
                <td><?= $row["nama_dokumentalis"]; ?></td>

                        
                </th>
                        </tr>
                      </tbody>
                      <?php $i++ ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </table>

              </div>
            </div>
         


      </div>
    </div>
  </div>
</section>