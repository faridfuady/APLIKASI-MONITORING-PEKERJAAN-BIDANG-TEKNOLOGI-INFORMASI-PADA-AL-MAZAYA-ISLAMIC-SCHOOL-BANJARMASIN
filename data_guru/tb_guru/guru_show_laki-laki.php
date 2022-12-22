<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require "guru_functions.php";
$guru = queryTampilguru("SELECT * FROM tb_guru WHERE jenis_kelamin = 'Laki - Laki'");

if ( isset($_POST["cariguru"]) ) {
	$guru = cariguru($_POST["keyword"]);
}

// $rowPerPage = 5;
// $rows = count(queryTampilguru("SELECT * FROM tb_guru"));
// $pages = ceil($rows / $rowPerPage);
// $activePage = (isset($_GET["data-page"])) ? $_GET["data-page"] : 1;
// $firstData = ($rowPerPage * $activePage) - $rowPerPage;
// $guru = queryTampilguru("SELECT * FROM tb_guru LIMIT $firstData, $rowPerPage");
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

    <title>Tabel Data guru</title>

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




    <!-- NAVBAR END -->

    <!-- BODY -->
    <br>
    </br>
    <section id="body">
      <div class="container">
        <h1 class="text-primary-dark-dark mb-5 text-center">Tabel Data Guru <br> AL-MAZAYA</h1>
        <div class="row">
          <div class="col-md-7">
            <a href="../../index.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</button>
            </a>
            <a href="guru_input.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-person-plus-fill"></i> Tambah Data Guru</button>
            </a>
            <a href="guru_savepdf_laki-laki.php">
              <button type="button" class="btn btn-outline-primary"><i class="bi bi-printer-fill"></i> Cetak Data Guru</button>
            </a>
          </div>
          <div class="col-md-5">
            <div class="input-group mb-3">
              <form action="" method="post" class="d-flex">         
                <input type="text" class="form-control" placeholder="Cari Nama guru" name="keyword" size="70">
                <button class="btn btn-outline-primary ms-1" type="submit" name="cariguru"><i class="bi bi-search"></i></button>
              </form>
            </div>
          </div>
        </div>

        <div class="mb-3 dropdown">
             <a class="btn btn-dark   dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Jenis Kelamin
            </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="../../data/tb_guru/guru_show_laki-laki.php">Laki - Laki</a></li>
                <li><a class="dropdown-item" href="../../data/tb_guru/guru_show_perempuan.php">Perempuan</a></li>
              </ul>
            </div>

        <div class="row">
          <div class="col">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">NIP</th>
                <th scope="col">Nama guru</th>
                <th scope="col">Email</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat Lengkap</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Foto</th>
                <th scope="col">No Telepon</th>
                <th scope="col">Tahun Masuk</th>
              </tr>
            </thead>
            <?php $i = 1  ?>
            <?php foreach ($guru as $row) : ?>
            <tbody>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $row["nip"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["jenis_kelamin"]; ?></td>
                <td><?= $row["alamat"]; ?></td>
                <td><?= $row["tanggal_lahir"]; ?></td>
                <td><img src="../../gambar/<?php echo $row["gambar"]; ?>"width="100px"></td>
                <td><?= $row["no_telp"]; ?></td>
                <td><?= $row["tahun"]; ?></td>
                <td>
                <a href="guru_filter.php?id=<?= $row["id"]; ?>">
                    <span class="badge bg-warning"><i class="bi bi-printer"></i>Cetak</span>
                  </a><br>
                  <a href="guru_update.php?id=<?= $row["id"]; ?>">
                    <span class="badge bg-success"><i class="bi bi-pen-fill"></i>Edit</span>
                  </a><br>
                  <a href="guru_remove.php?id=<?= $row["id"]; ?>" >
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

