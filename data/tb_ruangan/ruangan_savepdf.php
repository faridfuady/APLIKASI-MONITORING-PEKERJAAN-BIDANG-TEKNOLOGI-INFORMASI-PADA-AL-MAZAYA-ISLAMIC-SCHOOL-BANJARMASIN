<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "ruangan_functions.php";

$ruangan = queryTampilruangan("SELECT * FROM tb_ruangan");
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
                <h2><br> LAPORAN DATA ruangan <br>   AL-MAZAYA</h2>
                 <br>
                <center>
               <table border="1" cellpadding="10" cellspacing="0">
                 <tr>
                 <th>No</th>
                 <th>ruangan</th>
                 <th>Guru</th>
                 <th>Jumlah Siswa</th>
                  </tr>';
              $i = 1;
              foreach($ruangan as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["ruangan"] .'</td>
                  <td>'. $row["guru"] .'</td>
                  <td>'. $row["jumlah_siswa"] .'</td>
                 </tr>';
              }      
$html .= '
              </table>
              </center>
            </body>
          </html>';

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Laporan Data ruangan.pdf', \Mpdf\Output\Destination::INLINE);

?>
?>

