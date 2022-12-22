<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require_once __DIR__ . '/../../vendor/autoload.php';
require "pemeliharaan_functions.php";

$pemeliharaan = queryTampilpemeliharaan("SELECT * FROM tb_pemeliharaan_inventaris");
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
          <font size="4">LAPORAN DATA PENGEMBALIAN BARANG</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
     <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                  <th>NO</th>
                  <th>ID Barang</th>
                  <th>Nama Barang</th>
                  <th>Tanggal Pemeliharaan</th>
                  <th>Karyawan yang Bertanggung Jawab</th>
                  <th>Catatan Tambahan</th>
                </tr>';
              $i = 1;
              foreach($pemeliharaan as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["id_brg"] .'</td>
                  <td>'. $row["nama_brg"] .'</td>
                  <td>'. $row["tanggal_pemeliharaan"] .'</td>
                  <td>'. $row["nm_kryw"] .'</td>
                  <td>'. $row["catatan"] .'</td>
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


?>