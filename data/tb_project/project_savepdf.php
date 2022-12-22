<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "project_functions.php";

$project = queryTampilproject("SELECT * FROM tb_project");
$totalAnggaran = queryTampilproject("SELECT SUM(anggaran) total_anggaran FROM tb_project");

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
          <font size="4">LAPORAN DATA PROJECT</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
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
              foreach($project as $row) {
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
                    <td colspan="7 " class="text-center fw-bold">Total Anggaran</td>
                    <td>'.$total['total_anggaran'].'</td>';
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