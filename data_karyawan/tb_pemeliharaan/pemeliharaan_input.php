<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "pemeliharaan_functions.php";

if(isset($_POST["submit"])) {
  if(tambahpemeliharaan($_POST)>0)
  //  {   echo mysqli_error($conn);
     {echo "<script>alert('Data pemeliharaan Berhasil Ditambah');document.location.href = 'pemeliharaan_show.php';</script>";
    } 
  else {
    echo "<script>alert('Data pemeliharaan Gagal Ditambah');document.location.href = 'pemeliharaan_show.php';</script>";
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

    <title>Tambah Data Pemeliharaan</title>

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



<!-- NAVBAR END -->


    <!-- NAVBAR END -->

    <!-- BODY -->
    <section id="body">
      <div class="container">
        <h1 class="text-primary-dark mb-5 text-center">Tambah Data Pemeliharaan <br>   AL-MAZAYA</h1>

        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index_karyawan.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="pemeliharaan_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data pemeliharaan</button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <form method="post">
            <div class="mb-3">
                <label for="id_brg" class="form-label">Nama Barang</label>
                <select class="form-select" name="id_brg" id="id_brg">
                  <option selected></option>
                  <?php 
                    $sql_id_brg = mysqli_query($conn, "SELECT * FROM tb_inventaris ORDER BY id_brg ASC") or die (mysqli_error($conn));
                    while($data_id_brg = mysqli_fetch_array($sql_id_brg)) {
                      echo '
                      <option value="'.$data_id_brg['id_brg'].'">
                        '.$data_id_brg['id_brg'].' - '.$data_id_brg['nama_brg'].'
                      </option>
                      ';
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="tanggal_pemeliharaan" class="form-label">Tanggal Pemeliharaan</label>
                <input type="date" class="form-control" id="tanggal_pemeliharaan" name="tanggal_pemeliharaan" required autocomplete="off"required>
              </div>
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" required autocomplete="off"required>
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
                        '.$data_nm_kryw['nip'].' - '.$data_nm_kryw['nm_kryw'].'
                      </option>
                      ';
                    }
                  ?>
                </select>
                <div class="mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan</label>
                <input type="text" class="form-control" id="catatan" name="catatan" required autocomplete="off"required>
              </div>
              </div>
              <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah Data pemeliharaan</button>
            </form>
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
                    <p>SMA Almazaya Islamic School Banjarmasin ??? Islamic, discipline, smart, skillful, love the nation and has a global competitive mindset human resource</p>
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