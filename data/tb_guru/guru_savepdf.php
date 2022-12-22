<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "guru_functions.php";

$guru = queryTampilguru("SELECT * FROM tb_guru");
$jlhjk_guru = queryTampilguru("SELECT * FROM filter_jlhjk_guru");

require "../../user/user_functions.php";

$tb_ttd = queryTampilttd("SELECT * FROM tb_ttd");

$stylesheet = file_get_contents('../../src/css/print.css');
$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <table align="center" cellpadding="10" cellspacing="0">
      <tr>
      <td><img src="../../gambar/logo-sma.jpg" width="100px"></td>
      <td><center>
          <font size="5"><b>AL-MAZAYA ISLAMIC SCHOOL BANJARMASIN</b></font><br>
          <font size="4">LAPORAN DATA GURU</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
     <table border="1" cellpadding="10" cellspacing="0">
     <tr>
     <th>No</th>
     <th>NIP</th>
     <th style="width: 15%">Nama Guru</th>
     <th>Email</th>
     <th style="width: 10%">Jenis Kelamin</th>
     <th style="width: 15%">Alamat</th>
                 <th>Tanggal_lahir</th>
                 <th>Gambar</th>
                 <th>No Telepon</th>
                 <th>Tahun Masuk</th>
                  </tr>';
              $i = 1;
              foreach($guru as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["nip"] .'</td>
                  <td>'. $row["nama"] .'</td>
                  <td>'. $row["email"] .'</td>
                  <td>'. $row["jenis_kelamin"] .'</td>
                  <td>'. $row["alamat"] .'</td>
                  <td>'. $row["tanggal_lahir"] .'</td>
                  <td><img src="../../gambar/'. $row["gambar"] .'"width="100px"></td>
                  <td>'. $row["no_telp"] .'</td>
                  <td>'. $row["tahun"] .'</td>
                 </tr>';
              }      
$html .= '
              </table>
              <br>';
              foreach($jlhjk_guru as $row) {
$html .='
                <p>Jumlah Laki-laki: '. $row["jlh_lk"] .'</p>
                <p style="margin-top: -10px">Jumlah Perempuan: '. $row["jlh_pr"] .'</p>';
              }
$html .='              
              <br>
              <br>
              <div class="ttd">
                <div class="mengetahui">Banjarmasin, ' . date("d F Y") . ' <br>Mengetahui,</div>';
              foreach($tb_ttd as $row) {
$html .= '
                <div class="nama">' . $row["nama"] . '</div>';
              }
$html .= ' 
                <div class="jabatan">Pimpinan Al-MAZAYA</div>
              </div>
              </center>
            </body>
          </html>';

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Laporan Data Karyawan.pdf', \Mpdf\Output\Destination::INLINE);

?>

