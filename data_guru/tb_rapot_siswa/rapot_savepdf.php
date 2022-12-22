<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "rapot_functions.php";

$rapot = queryTampilrapot("SELECT * FROM tb_rapot_kkm");
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
          <font size="4">LAPORAN DATA RAPOR SISWA</font><br>
          <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
      </td>
      </tr>
    </table>
    <h4>NIS : </h4>
    <h4>Nama : </h4>
    <h4>Kelas : </h4>

           <table border="1" cellpadding="10" cellspacing="0">
                 <th> Nama</th>
                 <tr>
                 <th colspan="2">NO</th>
                 <th colspan="2">Mata Pelajaran</th>
        <th colspan="2">KKM</th>
				<th colspan="2">Nilai/Mapel</th>
				<th colspan="2">Tugas</th>
				<th colspan="2">UTS</th>
				<th colspan="2">UAS</th>
        <th colspan="2">Rata-Rata</th>
                  </tr>';
              $i = 1;
              foreach($rapot as $row) {
$html .= '
                <tr>
                  <td colspan="2">'. $i++ .'</td>
                  <td colspan="2">'. $row["nis"] .'</td>
                  <td colspan="2">'. $row["mapel"] .'</td>
                  <td colspan="2">'. $row["tugas"] .'</td>
                  <td colspan="2">'. $row["uts"] .'</td>
                  <td colspan="2">'. $row["uas"] .'</td>
                  <td colspan="2"></td>
                  <td colspan="8" class="text-center fw-bold">Total Nilai</td>

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



