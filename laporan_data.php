<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: user/user_sign_in.php");
  exit;
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Data Laporan ·   Al-Mazaya</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
  </head>
  <body>
    
  <header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" a href="index.php"> ALMAZAYA</a>
            <a class="nav-link-active text-white" a href="laporan_data.php">Data Al-Mazaya</a>
            
            <div class="ms-3 dropdown">
             <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Data Master
            </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="data/tb_karyawan/karyawan_show.php">Karyawan</a></li>
                <li><a class="dropdown-item" href="data/tb_guru/guru_show.php">Guru</a></li>
                <li><a class="dropdown-item" href="data/tb_siswa/siswa_show.php">Siswa</a></li>
              </ul>
            </div>

              <div class="ms-3 dropdown">
             <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Data Laporan
            </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="data/tb_inventaris/inventaris_print.php">Inventaris</a></li>
                <li><a class="dropdown-item" href="data/tb_pinjam/pinjam_print.php">Pinjaman</a></li>
                <li><a class="dropdown-item" href="data/tb_pengembalian/pengembalian_print.php">Pengembalian</a></li>
                <li><a class="dropdown-item" href="data/tb_pemeliharaan/pemeliharaan_print.php">Pemeliharaan Barang</a></li>
                <li><a class="dropdown-item" href="data/tb_dokumentasi/dokumentasi_print.php">Dokumentasi</a></li>
                <li><a class="dropdown-item" href="data/tb_project/project_print.php">Project</a></li>
                <li><a class="dropdown-item" href="data/tb_kinerja/kinerja_print.php">Kinerja</a></li>
                <li><a class="dropdown-item" href="data/tb_guru/guru_print.php">Guru</a></li>
                <li><a class="dropdown-item" href="data/tb_siswa/siswa_print.php">Siswa</a></li>
                <li><a class="dropdown-item" href="data/tb_rapot_siswa/rapot_siswa_print.php">Rapor Siswa</a></li>

                <li><a class="dropdown-item" href="data/tb_mapel/mapel_print.php">Data Mata Pelajaran</a></li>
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
                    <a class="nav-link"a href="user/ttd_show.php">Setting ttd</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link"a href="user/user_sign_out.php">Logout</a>
                    </li>
                </ul>
            </div>
            
        </div>
        
    </nav>
</header>


<br>
    </br>
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

    

    
<!-- BODY -->
    <section id="body">
      <div class="container text-dark">
        <div class="row mt-2">
          <div class="col">
            <br>
    </br>
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 40px;" class="fw-bold">
              APLIKASI MONITORING PEKERJAAN BIDANG TEKNOLOGI INFORMASI <br> ALMAZAYA ISLAMIC SCHOOL BANJARMASIN
            </h1>
          </div>
        </div>
        <div class="row mt-3 ms-3 mb-3">
          <div class="col-md-5">
            <ul class="list-group master-data link-dark">
              <h4>Data Al-Mazaya Banjarmasin</h4>
             
              
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_inventaris/inventaris_show.php" class="nav-link text-dark ">
                <i class="bi bi-box-seam"></i> <i class="ms-3"></i> Data Inventaris
                </a>
              </li>
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_pinjam/pinjam_show.php" class="nav-link text-dark ">
                <i class="bi bi-chevron-double-right"></i><i class="ms-3"></i>  Data Pinjaman Inventaris
                </a>
              </li>
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_pengembalian/pengembalian_show.php" class="nav-link text-dark ">
                <i class="bi bi-chevron-double-left"></i><i class="ms-3"></i> Data Pengembalian Inventaris
                </a>
              </li> 
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_pemeliharaan/pemeliharaan_show.php" class="nav-link text-dark ">
                <i class="bi bi-inboxes"></i><i class="ms-3"></i> Data Pemeliharaan Barang
                </a>
              </li>
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_dokumentasi/dokumentasi_show.php" class="nav-link text-dark ">
                <i class="bi bi-camera"></i><i class="ms-3"></i>  Data Dokumentasi
                </a>
              </li>               
               <li class="list-group-item list-group-item-dark">
                <a href="data/tb_project/project_show.php" class="nav-link text-dark ">
                <i class="bi bi-calendar4-week"></i><i class="ms-3"></i>  Data Project
                </a>
              </li>                
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_kinerja/kinerja_show.php" class="nav-link text-dark ">
                <i class="bi bi-bar-chart-line"></i><i class="ms-3"></i>  Data Kinerja Guru
                </a>
              </li>
              <!-- <li class="list-group-item list-group-item-dark">
                <a href="data/tb_ruangan/ruangan_show.php" class="nav-link text-dark ">
                <i class="bi bi-house-door"></i><i class="ms-3"></i>  Data Ruangan
                </a>
              </li> -->
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_kelas/kelas_show.php" class="nav-link text-dark ">
                <i class="bi bi-house-door"></i><i class="ms-3"></i>  Data Kelas
                </a>
              </li>     
                        
               <!-- <li class="list-group-item list-group-item-dark">
                <a href="data/tb_dokumentasi/dokumentasi_show.php" class="nav-link text-dark ">
                <i class="bi bi-book"></i><i class="ms-3"></i>  Data rapot Siswa
                </a>
              </li>           -->
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_rapot_siswa/rapot_show.php" class="nav-link text-dark ">
                <a href="data/tb_rapot_siswa/rapot_show.php" class="nav-link text-dark ">
                <i class="bi bi-journal-text"></i><i class="ms-3"></i>  Data Rapor Siswa
                </a>
              </li>      
              <li class="list-group-item list-group-item-dark">
                <a href="data_karyawan/tb_persandingan/persandingan_show.php" class="nav-link text-dark ">
                <i class="bi bi-box-seam"></i> <i class="ms-3"></i> Data Persandingan
                </a>
              </li>
              <li class="list-group-item list-group-item-dark">
                <a href="data/tb_mapel/mapel_show.php" class="nav-link text-dark ">
                <i class="bi bi-bookmarks"></i><i class="ms-3"></i> Data Mata Pelajaran Siswa
                </a>
              </li>
            </ul>  
          </div>
          <div class="col-md-7">
          <div class="card" style="margin-top:35px;">
              <img src="gambar/Lobby Al-Mazaya.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Al-Mazaya</h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a> -->
              </div>
            </div>
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

