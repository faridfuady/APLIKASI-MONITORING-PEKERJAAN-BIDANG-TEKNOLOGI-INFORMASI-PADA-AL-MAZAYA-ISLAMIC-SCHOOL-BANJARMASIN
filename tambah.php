<?php 

session_start();

//cek apakah sudah login atau belum, kalau belum akan masuk ke file login.php
if(!isset($_SESSION["login"])) {
	header("Location: login.php");
}

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");
require "functions.php";
//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {
//ambil data dari tiap elemen dalam form 
	// $kode = $_POST["kode"];
	// $judul = $_POST["judul"];
	// $pengarang = $_POST["pengarang"];
	// $penerbit = $_POST["penerbit"];
	// $tahun = $_POST["tahun"];
	// $cover = $_POST["cover"];

	// $query = "INSERT INTO Komik
	// 			VALUES
	// 				('', '$kode', '$judul', '$pengarang', '$penerbit', '$tahun', '$cover')
	// 				";

	// mysqli_query($conn, $query);

	//cek apakah data berhasil ditambah
	// if(mysqli_affected_rows($conn) > 0) {
	// 	echo "Berhasil";
	// } else {
	// 	echo "Gagal <br>";
	// 	echo mysqli_error($conn);
	// }
	if(tambah($_POST)>0) {
		echo 
		"
		<script>
			alert('Data Komik Berhasil Ditambah!');
			document.location.href = 'index.php';
		</script>
		";
	} else {
		echo 
		"
		<script>
			alert('Data Komik Gagal Ditambah!');
			document.location.href = 'index.php';
		</script>
		";
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Komik</title>
</head>
<body>
	<h1>Tambah Data Komik</h1>

	<form action="" method="post" enctype="multipart/form-data"> <!-- //enctype="multipart/form-data"untuk menangani file -->
		<ul>
			<li>
				<label for="kode">Kode: </label> <br>
				<input type="text" name="kode" id="kode" required="">
			</li>
			<li>
				<label for="judul">Judul: </label> <br>
				<input type="text" name="judul" id="judul">
			</li>
			<li>
				<label for="pengarang">Pengarang: </label> <br>
				<input type="text" name="pengarang" id="pengarang">
			</li>
			<li>
				<label for="penerbit">Penerbit: </label> <br>
				<input type="text" name="penerbit" id="penerbit">
			</li>
			<li>
				<label for="tahun">Tahun: </label> <br>
				<input type="text" name="tahun" id="tahun">
			</li>
			<li>
				<label for="cover">Cover: </label> <br>
				<input type="file" name="cover" id="cover">
			</li>
			<br>
			<li>
				<button type="submit" name="submit">Tambah Data Komik</button>
			</li>
		</ul>


	</form>
</body>
</html>