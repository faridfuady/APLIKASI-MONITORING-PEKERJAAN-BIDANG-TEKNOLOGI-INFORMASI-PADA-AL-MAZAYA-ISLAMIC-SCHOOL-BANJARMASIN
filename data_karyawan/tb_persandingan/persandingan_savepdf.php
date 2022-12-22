<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "persandingan_functions.php";

$persandingan = queryTampilperencanaan("SELECT * FROM tb_persandingan");

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
          <font size="4">LAPORAN DATA persandingan</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
     <table border="1" cellpadding="10" cellspacing="0">
     <tr>
     <th rowspan="2"> </th>
     <th colspan="5" class="text-center">Perencanaan Kegiatan</th>
     <th> </th>
     <th colspan="6" class="text-center">Pelaksanan Kegiatan</th>
   </tr>
   
   <tr>
     <th>Nama Kegiatan</th>
     <th>Waktu Kegiatan</th>
     <th>Anggaran Kegiatan</th>
     <th>Tempat Kegiatan</th>
     <th>PIC Kegiatan</th>
     <th> </th>
     <th>Nama Kegiatan</th>
     <th>Keterangan</th>
     <th>Waktu Kegiatan</th>
     <th>Anggaran Kegiatan</th>
     <th>Tempat Kegiatan</th>
     <th>PIC Kegiatan</th>
   </tr>';
              $i = 1;
              foreach($persandingan as $row) {
                $produksi =  $row["produksi"];
                $konsumsi =  $row["konsumsi"];
                $promosi =  $row["promosi"];
                $transportasi =  $row["transportasi"];
                $tot = $produksi+$konsumsi+$promosi+$transportasi;
                $pa =  $row["pa"];
                $ka =  $row["ka"];
                $pro =  $row["pro"];
                $tro =  $row["tro"];
                $total = $pa+$ka+$pro+$tro;
$html .= '
                <tr>
                  <td>'. $i .'</td>
                  <td>'. $row["nama"] .'</td>
                  <td>'. $row["waktu"] .'</td>
                  <td>'. number_format($total) .'</td>
                  <td>'. $row["tempat"] .'</td>
                  <td>'. $row["penanggung"] .'</td>
                  <td>'. $i .'</td>
                  <td>'. $row["nm_kegiatan"] .'</td>
                  <td>'. $row["keterangan"] .'</td>
                  <td>'. $row["tanggal"] .'</td>
                  <td>'. number_format($tot) .'</td>
                  <td>'. $row["lokasi"] .'</td>
                  <td>'. $row["kryw"] .'</td>

                 </tr>';

                 $i++;
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