<?php 

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query); //mengambil data dari database dengan variabel $result
	$rows = []; //array kosong untuk menampung data nanti
	while ($row = mysqli_fetch_assoc($result)) { //mengambil data dari variabel $result
		$rows[] = $row; //memasukkan data $result ke array rows
	}
	return $rows;
}

function tambah($data) {
	global $conn;

	$kode = htmlspecialchars($data["kode"]);
	$judul = htmlspecialchars($data["judul"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$tahun = htmlspecialchars($data["tahun"]);

	//upload gambar cover
	$cover = uploadcover(); //fungsi upload
	if (!$cover) {
		return false;
	}

	$querytambah = "INSERT INTO Komik
				VALUES
					('', '$kode', '$judul', '$pengarang', '$penerbit', '$tahun', '$cover')
					";

	mysqli_query($conn, $querytambah);

	return mysqli_affected_rows($conn);
	}

	function hapus($id) {
		global $conn;

		$queryhapus = "DELETE FROM komik WHERE id = $id";

		mysqli_query($conn, $queryhapus);

		return mysqli_affected_rows($conn);
	}

	function ubah($data) {
	global $conn;

	$kode = htmlspecialchars($data["kode"]);
	$judul = htmlspecialchars($data["judul"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$gambarlama = htmlspecialchars($data["gambarlama"]);
	//cek apakah user mengubah gambar atau tidak
	if($_FILES['cover']['error'] === 4) {
		$cover = $gambarlama;
	} else {
		$cover = upload();
	}
	$id = ($data["id"]);

	$querytambah = "UPDATE Komik SET
					kode = '$kode', 
					judul = '$judul', 
					pengarang = '$pengarang', 
					penerbit = '$penerbit', 
					tahun = '$tahun', 
					cover = '$cover'
					WHERE id = $id;
					";

	mysqli_query($conn, $querytambah);

	return mysqli_affected_rows($conn);
	}

	function cari($keyword) {
		$querycari = "SELECT * FROM komik WHERE
					kode LIKE '%$keyword%' OR
					judul LIKE '%$keyword%' OR
					pengarang LIKE '%$keyword%' OR
					penerbit LIKE '%$keyword%' OR
					tahun LIKE '%$keyword%'

				";
		return query($querycari);
	}

	function uploadcover() {
		$namafile = $_FILES['cover']['name'];
		$ukurnafile = $_FILES['cover']['size'];
		$error = $_FILES['cover']['error'];
		$tmpname = $_FILES['cover']['tmp_name'];

		//cek apakah gambar sudah diupload
		if($error === 4) {
			echo "<script>
					alert('Pilih Gambar Cover Terlebih Dahulu');
			      </script>";
			      return false;
		}
		//ekstensi file yang diupload
		$ekstensigambarvalid = ['jpg','png'];//menentukan format/ekstensi gambar yang diperbolehkan
		$ekstensigambar = explode('.', $namafile);//explode untuk memecah string titik dengan nama file
		$ekstensigambar = strtolower(end($ekstensigambar));//strtolower untuk mengubah nama ekstensi file menjadi huruf kecil, end untuk memilih delimiter terakhir sebagai format/ekstensi gambar
		if(!in_array($ekstensigambar, $ekstensigambarvalid)) {
			echo "<script>
					alert('Format/Ekstensi File Gambar Harus jpg/png');
			      </script>";
			      return false;
		}

		//membatasi ukuran file gambar
		if($ukurnafile > 1000000) {
			echo "<script>
					alert('Ukuran File Gambar Terlalu Besar');
			      </script>";
			      return false;
		}

		//buat nama file baru untuk file gambar, agar tidak ada kesamaan nama file
		$namafilebaru = uniqid();
		$namafilebaru .= '.';
		$namafilebaru .= $ekstensigambar;

		//gambar lolos pengecekan ekstensi dan ukuran, pemindahan lokasi file gambar
		move_uploaded_file($tmpname, 'img/' . $namafilebaru);

		return $namafilebaru;

	}

	function registrasi($data) {
		global $conn;

		$username = strtolower(stripslashes($data["username"])); //stripslashes menghilangkan backslash
		$password = mysqli_real_escape_string($conn, $data["password"]); //untuk memungkinkan memasukkan password dngn tanda kutip
		$password2 = mysqli_real_escape_string($conn, $data["password2"]);

		//cek username apakah sudah ada atau belum
		$cekusername = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");
		if(mysqli_fetch_assoc($cekusername)) {
			echo "<script>
					alert('username dah ada cu');
			      </script>";
			return false;
		}

		//konfirmasi password
		if($password !== $password2) {
			echo "<script>
					alert('Password Tidak Sesuai');
			      </script>";
			return false;
		}

		//enkripsi / mengamankan password
		$password = password_hash($password, PASSWORD_DEFAULT);

		//tambahkan user baru ke database
		mysqli_query($conn, "INSERT INTO pengguna VALUES('', '$username', '$password')");
		return mysqli_affected_rows($conn);

	}

 ?>