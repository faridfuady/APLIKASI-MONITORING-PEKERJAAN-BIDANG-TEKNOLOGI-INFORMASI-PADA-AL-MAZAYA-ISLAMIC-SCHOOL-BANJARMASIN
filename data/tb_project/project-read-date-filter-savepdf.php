<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "project_functions.php";

$totalAnggaran = queryTampilproject("SELECT SUM(anggaran) total_anggaran FROM tb_project 
WHERE tanggal_mulai BETWEEN '$start_date%' AND '$end_date%'");


$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$totalAnggaran = queryTampilproject("SELECT SUM(anggaran) total_anggaran FROM tb_project WHERE tanggal_mulai BETWEEN '$start_date%' AND '$end_date%'");


  // $_SESSION["date_filter_actived"] = $dateFilter;
  $projectDateFilter = queryTampilproject("SELECT * FROM tb_project WHERE tanggal_mulai BETWEEN '$start_date%' AND '$end_date%'");

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
                <h2><br> LAPORAN DATA PROJECT <br>   AL-MAZAYA</h2>
                 <br>
                <center>
               <table border="1" cellpadding="10" cellspacing="0">
               <tr>
               <th>No</th>
               <th>Nama Project</th>
               <th>Keterangan</th>
               <th>Foto</th>
               <th>Tempat</th>
               <th>Tanggal Mulai</th>
               <th>Karyawan yang ber-tanggung jawab</th>
               <th>Anggaran</th>

                  </tr>';
              $i = 1;
              foreach($projectDateFilter as $row) {
$html .= '
                <tr>
                <td>'. $i++ .'</td>
                <td>'. $row["nama_project"] .'</td>
                <td>'. $row["keterangan"] .'</td>
                <td><img src="../../gambar/'. $row["gambar"] .'"width="100px"></td>
                <td>'. $row["tempat"] .'</td>
                <td>'. $row["tanggal_mulai"] .'</td>
                <td>'. $row["nm_kryw"] .'</td>
                <td>'. $row["anggaran"] .'</td>

                 </tr>';
              }
    foreach ($totalAnggaran as $total) { 
$html .= '
            <tr>
              <td colspan="7" class="text-center fw-bold">Total Anggaran</td>
              <td>'.$total['total_anggaran'].'</td>';
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
$mpdf->Output('Laporan Data project.pdf', \Mpdf\Output\Destination::INLINE);

?>
?>

