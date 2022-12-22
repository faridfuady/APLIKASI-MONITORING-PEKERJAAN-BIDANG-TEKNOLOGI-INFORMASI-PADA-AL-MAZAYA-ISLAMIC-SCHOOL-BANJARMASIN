<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "peralatan_functions.php";

$peralatan = queryTampilperalatan("SELECT * FROM tb_peralatan");
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
              <h2>LAPORAN DATA PERALATAN <br>   <br>   AL-MAZAYA</h2>
              <br>
              <center>
              <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                  <th>NO</th>
                  <th>Nama Peralatan</th>
                  <th>Jenis Alat</th>
                  <th>Keterangan</th>
                </tr>';
              $i = 1;
              foreach($peralatan as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["nm_alat"] .'</td>
                  <td>'. $row["jenis_alat"] .'</td>
                  <td>'. $row["keterangan"] .'</td>
                </tr>';
              }
$html .= '
              </table>
              </center>
            </body>
          </html>';

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Laporan Data peralatan.pdf', \Mpdf\Output\Destination::INLINE);

?>

