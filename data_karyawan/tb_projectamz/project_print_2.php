<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require_once __DIR__ . '/../../vendor/autoload.php';
require "project_functions.php";

$project = queryTampilproject("SELECT * FROM filter_2_2022");
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
              <h2>LAPORAN DATA PROJECT <br>   AL-MAZAYA <br>  </h2>
              <br>
              <center>
              <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                  <th>NO</th>
                  <th>Nama project</th>
                  <th>Tempat</th>
                  <th>Tanggal Project</th>
                  <th>Tujuan</th>
                  <th>Alat yang digunakan</th>
                  <th>Karyawan yang bertugas</th>
                  <th>Nama Dokumentasi</th>
                </tr>';
              $i = 1;
              foreach($project as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["nm_project"] .'</td>
                  <td>'. $row["tempat"] .'</td>
                  <td>'. $row["tgl_project"] .'</td>
                  <td>'. $row["tujuan"] .'</td>
                  <td>'. $row["nm_alat"] .'</td>
                  <td>'. $row["nm_kryw"] .'</td>
                  <td>'. $row["nm_dok"] .'</td>
                </tr>';
              }
$html .= '
              </table>
              </center>
            </body>
          </html>';

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Laporan Data project.pdf', \Mpdf\Output\Destination::INLINE);

?>

