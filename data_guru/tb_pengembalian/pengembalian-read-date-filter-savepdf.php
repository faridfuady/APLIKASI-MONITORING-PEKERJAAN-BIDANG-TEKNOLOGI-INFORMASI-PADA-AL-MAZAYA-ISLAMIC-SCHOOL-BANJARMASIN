<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "pinjam_functions.php";

$start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];


  // $_SESSION["date_filter_actived"] = $dateFilter;
  $pinjamDateFilter = queryTampilpinjam("SELECT * FROM tb_kryw_pinjam WHERE tanggal_pinjam BETWEEN '$start_date%' AND '$end_date%'");

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
        <img src="../../gambar/logo-sma.jpg" width="100px">
                <h2><br> LAPORAN DATA PENGEMBALIAN BARANG <br>   AL-MAZAYA</h2>
                 <br>
                <center>
               <table border="1" cellpadding="10" cellspacing="0">
                 <tr>
                 <th>No</th>
                 <th>NIP</th>
                 <th>Nama Karyawan</th>
                 <th>Nama Barang</th>
                 <th>Tanggal Pinjam</th>
                 <th>Keperluan</th>

                  </tr>';
              $i = 1;
              foreach($pinjamDateFilter as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["nip"] .'</td>
                  <td>'. $row["nm_kryw"] .'</td>
                  <td>'. $row["nama_brg"] .'</td>
                  <td>'. $row["tanggal_pinjam"] .'</td>
                  <td>'. $row["keperluan"] .'</td>

                 </tr>';
              }      
$html .= '
              </table>
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
$mpdf->Output('Laporan Data pinjam.pdf', \Mpdf\Output\Destination::INLINE);

?>
?>

