<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "project_functions.php";
$id = $_GET["id"];
$tb_project = queryTampilproject("SELECT * FROM tb_project WHERE id = $id")[0];

if(isset($_POST["submit"])) {
  if(ubahproject($_POST)>0) {
    echo "<script>alert('Data project Berhasil Diubah');document.location.href = 'project_show.php';</script>";
  } else {
    echo mysqli_error($conn);
    
    // echo"<script>alert('Data project Gagal Diubah');document.location.href = 'project_show.php';</script>";
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

    <title>Ubah Data project</title>

  </head>
  <body>

    <!-- NAVBAR -->
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
                <li><a class="dropdown-item" href="../../data/tb_project/project_show.php">project</a></li>
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

    <!-- BODY -->
    <br>
    </br>
    <section id="body">
      <div class="container">
        <h1 class="text-primary-dark mb-5 text-center">Ubah Data project <br>   AL-MAZAYA</h1>
        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index_karyawan.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="project_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data project</button>
            </a>
          </div>
        </div>
        <div class="row">
        <div class="col">
          <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $tb_project["id"]; ?>">
          <input type="hidden" name="gambarLama" value="<?= $tb_project["gambar"]; ?>">
          <div class="mb-3">
              <label for="nama_project" class="form-label">Nama Project</label>
              <input type="text" class="form-control" id="nama_project" name="nama_project" autocomplete="off"required value="<?= $tb_project["nama_project"]; ?>">
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off"required value="<?= $tb_project["keterangan"]; ?>">
            </div>
            <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
                        <img src="../../gambar/<?= $tb_project['gambar']; ?>" width="200px" style="margin-bottom: 10px;">
                        <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                    </div>
            <div class="mb-3">
              <label for="tempat" class="form-label">Tempat</label>
              <input type="text" class="form-control" id="tempat" name="tempat" autocomplete="off"requiredvalue="<?= $tb_project["tempat"]; ?>">
            </div>
            <div class="mb-3">
              <label for="anggaran" class="form-label">Anggaran</label>
              <input type="text" class="form-control" id="anggaran" name="anggaran" autocomplete="off"requiredvalue="<?= $tb_project["anggaran"]; ?>">
            </div>
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai Project</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= $tb_project["tanggal_mulai"]; ?>" required autocomplete="off"required>
              </div>
              <div class="mb-3">
                <label for="nm_kryw" class="form-label">Nama Karyawan</label>
                <select class="form-select" name="nm_kryw" id="nm_kryw">
                  <option selected><?= $tb_project["nm_kryw"]; ?></option>
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
            <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Ubah Data project</button>
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