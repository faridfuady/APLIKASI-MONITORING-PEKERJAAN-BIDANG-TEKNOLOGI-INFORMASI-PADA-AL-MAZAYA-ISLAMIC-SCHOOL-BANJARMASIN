<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require_once __DIR__ . '/../../vendor/autoload.php';
require "kinerja_functions.php";



$id = $_GET["id"];
$tb_guru_kinerja = queryTampilkinerja("SELECT * FROM tb_guru_kinerja WHERE id = $id");

require "../../user/user_functions.php";

$tb_ttd = queryTampilttd("SELECT * FROM tb_ttd");
$stylesheet = file_get_contents('../../src/css/print.css');
$mpdf = new \Mpdf\Mpdf();
// $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

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
          <font size="4">LAPORAN DATA KINERJA GURU</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
     <table border="1" cellpadding="10" cellspacing="0">
                 <tr>
                 <th>No</th>
                 <th>NIP</th>
                 <th style="width: 21%">Nama Guru</th>
                 <th>Nilai Kedisiplinan</th>
                 <th>Nilai Integritas</th>
                 <th>Nilai Tanggung Jawab</th>
                 <th>Nilai Komunikasi</th>
                 <th>Nilai Antusiasme</th>
                 <th>Tahun Kinerja</th>
                  </tr>';
              $i = 1;
              foreach($tb_guru_kinerja as $row) {
$html .= '
                <tr>
                <td>'. $i++ .'</td>
                <td>'. $row["nip"] .'</td>
                <td>'. $row["nama"] .'</td>
                <td>'. $row["kedisiplinan"] .'</td>
                <td>'. $row["integritas"] .'</td>
                <td>'. $row["tanggung_jwb"] .'</td>
                <td>'. $row["komunikasi"] .'</td>
                <td>'. $row["antusiasme"] .'</td>
                <td>'. $row["tahun"] .'</td>
                 </tr>';
              }      
$html .= '
              </table>
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

