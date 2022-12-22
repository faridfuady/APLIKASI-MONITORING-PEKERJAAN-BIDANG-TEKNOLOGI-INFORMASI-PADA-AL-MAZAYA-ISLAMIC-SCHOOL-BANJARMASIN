<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../user/user_sign_in.php");
  exit;
}

require_once __DIR__ . '/../../vendor/autoload.php';
require "karyawan_functions.php";

$id = $_GET["id"];
$tb_karyawan = queryTampilkaryawan("SELECT * FROM tb_karyawan WHERE id = $id");
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
                <img src="../../gambar/logo-amz.png" width="100px">
                <h2><br> LAPORAN DATA KARYAWAN <br>   AL-MAZAYA</h2>
                 <br>
                <center>
               <table border="1" cellpadding="10" cellspacing="0">
                 <tr>
                      <th>NO</th>
                      <th>Nama Karyawan</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>Keahlian</th>
                      <th>No Telepon</th>
                  </tr>';
              $i = 1;
              foreach($tb_karyawan as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["nm"] .'</td>
                  <td>'. $row["tempat_lahir"] .'</td>
                  <td>'. $row["tanggal_lahir"] .'</td>
                  <td>'. $row["jenis_kelamin"] .'</td>
                  <td>'. $row["alamat"] .'</td>
                  <td>'. $row["email"] .'</td>
                  <td>'. $row["keahlian"] .'</td>
                  <td>'. $row["no_telp"] .'</td>
                 </tr>';
              }      
$html .= '
              </table>
              </center>
            </body>
          </html>';

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Laporan Data Karyawan.pdf', \Mpdf\Output\Destination::INLINE);

?>
?>