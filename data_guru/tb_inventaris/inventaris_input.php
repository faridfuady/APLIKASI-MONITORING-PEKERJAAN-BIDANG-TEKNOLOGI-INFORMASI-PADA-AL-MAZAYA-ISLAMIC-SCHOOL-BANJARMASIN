<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "inventaris_functions.php";

if(isset($_POST["submit"])) {
  if(tambahinventaris($_POST)>0) {
    echo "<script>alert('Data inventaris Berhasil Ditambah');document.location.href = 'inventaris_show.php';</script>";


  } 
  else {
    echo "<script>alert('Data inventaris Gagal Ditambah');document.location.href = 'inventaris_show.php';</script>";
        // echo mysqli_error($conn);
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

    <title>Tambah Data inventaris</title>

  </head>
  <body>

  <header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" a href="../../index_guru.php"> ALMAZAYA</a>
            <a class="nav-link-active text-white" a href="../../laporan_data_guru.php">Data Al-Mazaya</a>
            
            <div class="ms-3 dropdown">
             <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Data Master
            </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="../../data_guru/tb_karyawan/karyawan_show.php">Karyawan</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_guru/guru_show.php">Guru</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_siswa/siswa_show.php">Siswa</a></li>
              </ul>
            </div>

              <div class="ms-3 dropdown">
             <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Data Laporan
            </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="../../data_guru/tb_inventaris/inventaris_print.php">Inventaris</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_pinjam/pinjam_print.php">Pinjaman</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_pengembalian/pengembalian_print.php">pengembalian</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_pemeliharaan/pemeliharaan_print.php">Pemeliharaan Barang</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_dokumentasi/dokumentasi_print.php">Dokumentasi</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_project/project_print.php">Project</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_kinerja/kinerja_print.php">Kinerja</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_guru/guru_print.php">Guru</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_siswa/siswa_print.php">Siswa</a></li>
                <li><a class="dropdown-item" href="../../data_guru/tb_rapot_siswa/rapot_siswa_print.php">rapot Siswa</a></li>
                 
                <li><a class="dropdown-item" href="../../data_guru/tb_mapel/mapel_print.php">Data Mata Pelajaran</a></li>
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
        <h1 class="text-primary-dark mb-5 text-center">Tambah Data inventaris <br>   AL-MAZAYA</h1>
        <div class="row mb-3">
          <div class="col-md-9">
            <a href="../../index.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="inventaris_show.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-table"></i> Tabel Data inventaris</button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col">
          <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
              <label for="id_brg" class="form-label">ID Barang</label>
              <input type="text" class="form-control" id="id_brg" name="id_brg" autocomplete="off"required>
            </div>
          <div class="mb-3">
              <label for="nama_brg" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" id="nama_brg" name="nama_brg" autocomplete="off"required>
            </div>
            <div class="mb-3">
                        <label for="gambar" class="form-label">Foto</label>
                        <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                    </div>
            <div class="mb-3">
              <label for="kondisi" class="form-label">Kondisi Inventaris</label>
              <input type="text" class="form-control" id="kondisi" name="kondisi" autocomplete="off"required>
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off"required>
            </div>
            <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
              <input type="text" class="form-control" id="lokasi" name="lokasi" autocLokasie="off">
                   </div>
            <div class="mb-3">
              <label for="tanggal_inventaris" class="form-label">Tanggal Barang Masuk</label>
              <input type="date" class="form-control" id="tanggal_inventaris" name="tanggal_inventaris" autocomplete="off"required>
            </div>
            <div class="mb-3">
              <label for="anggaran" class="form-label">Anggaran</label>
              <input type="number" class="form-control" id="anggaran" name="anggaran" autocomplete="off"required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah Data inventaris</button>
          </form>

          </div>
        </div>
      </div>
    </section>
    <!-- BODY END -->

    <!-- FOOTER -->
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

<script type="text/javascript">
    $(kelas).ready(function() {
        $.ajax({
            type: 'POST',
            url: "getkelas.php",
            cache: false,
            success: function(msg) {
                $("#kelas").html(msg);
            }
        });

        $("#kelas").change(function() {
            var provinsi = $("#kelas").val();
            $.ajax({
                type: 'POST',
                url: "get_kabupaten.php",
                data: {
                    provinsi: provinsi
                },
                cache: false,
                success: function(msg) {
                    $("#kabupaten_pel").html(msg);
                }
            });
        });

        $("#kabupaten_pel").change(function() {
            var kabupaten = $("#kabupaten_pel").val();
            $.ajax({
                type: 'POST',
                url: "get_kecamatan.php",
                data: {
                    kabupaten: kabupaten
                },
                cache: false,
                success: function(msg) {
                    $("#kecamatan_pel").html(msg);
                }
            });
        });
    });

</script>