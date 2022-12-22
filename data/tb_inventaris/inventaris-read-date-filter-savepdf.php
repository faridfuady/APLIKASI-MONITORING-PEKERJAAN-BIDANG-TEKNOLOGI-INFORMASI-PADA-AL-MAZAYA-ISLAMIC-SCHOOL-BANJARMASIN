<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require_once __DIR__ . '/../../vendor/autoload.php';
require "inventaris_functions.php";

$totalAnggaran = queryTampilinventaris("SELECT SUM(anggaran) total_anggaran FROM tb_inventaris 
WHERE tanggal_inventaris BETWEEN '$start_date%' AND '$end_date%'");

$start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];


  // $_SESSION["date_filter_actived"] = $dateFilter;
  $inventarisDateFilter = queryTampilinventaris("SELECT * FROM tb_inventaris WHERE tanggal_inventaris BETWEEN '$start_date%' AND '$end_date%'");


  $stylesheet = file_get_contents('../../src/css/print.css');

  $totalAnggaran = queryTampilinventaris("SELECT SUM(anggaran) total_anggaran FROM tb_inventaris WHERE tanggal_inventaris BETWEEN '$start_date%' AND '$end_date%'");


$mpdf = new \Mpdf\Mpdf();

require "../../user/user_functions.php";

$tb_ttd = queryTampilttd("SELECT * FROM tb_ttd");
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
          <font size="4">LAPORAN DATA INVENTARIS</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
     <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                  <th>NO</th>
                  <th>ID Barang</th>
                  <th style="width: 10%">Nama Barang</th>
                <th>Gambar</th>
                <th>Kondisi</th>
                <th style="width: 10%">Keterangan</th>
                <th>Lokasi Barang</th>
                <th style="width: 10%">Tanggal Barang Masuk</th>
                <th>Anggaran</th>
                </tr>';
              $i = 1;
              foreach($inventarisDateFilter as $row) {
$html .= '
                <tr>
                  <<td>'. $i++ .'</td>
                  <td>'. $row["id_brg"] .'</td>
                  <td>'. $row["nama_brg"] .'</td>
                  <td><img src="../../gambar/'. $row["gambar"] .'"width="100px"></td>
                  <td>'. $row["kondisi"] .'</td>
                  <td>'. $row["keterangan"] .'</td>
                  <td>'. $row["lokasi"] .'</td>
                  <td>'. $row["tanggal_inventaris"] .'</td>
                  <td>'. $row["anggaran"] .'</td>
                 </tr>';
              }
    foreach ($totalAnggaran as $total) { 
$html .= '
            <tr>
              <td colspan="8" class="text-center fw-bold">Total Anggaran</td>
              <td>'.$total['total_anggaran'].'</td></tr>';
          }
$html .='  
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
$mpdf->Output('Laporan Data inventaris.pdf', \Mpdf\Output\Destination::INLINE);

?>