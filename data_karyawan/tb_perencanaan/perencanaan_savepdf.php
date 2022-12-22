<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "perencanaan_functions.php";

$perencanaan = queryTampilperencanaan("SELECT * FROM tb_perencanaan");
// $totalAnggaran = queryTampilperencanaan("SELECT SUM(anggaran) total_anggaran FROM tb_perencanaan");
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
          <font size="4">LAPORAN DATA PERENCANAAN</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
     <table border="1" cellpadding="10" cellspacing="0">
                 <tr>
                 <th>No</th>
                 <th>Nama</th>
                 <th>Waktu</th>
                 <th>Produksi Anggaran</th>
                 <th>Konsumsi Anggaran</th>
                 <th>Promosi Anggaran</th>
                 <th>Transportasi Anggaran</th>
                 <th>Tempat</th>
                 <th>Penanggung Jawab</th>

                  </tr>';
              $i = 1;
              foreach($perencanaan as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["nama"] .'</td>
                  <td>'. $row["waktu"] .'</td>
                  <td>'. $row["pa"] .'</td>
                  <td>'. $row["ka"] .'</td>
                  <td>'. $row["pro"] .'</td>
                  <td>'. $row["tro"] .'</td>
                  <td>'. $row["tempat"] .'</td>
                  <td>'. $row["penanggung"] .'</td>

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