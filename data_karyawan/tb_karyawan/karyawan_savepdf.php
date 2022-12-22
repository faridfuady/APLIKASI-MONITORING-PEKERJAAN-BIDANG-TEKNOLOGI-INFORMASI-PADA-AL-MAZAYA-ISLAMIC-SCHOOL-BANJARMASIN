<?php 

// session_start();

// if(!isset($_SESSION["signin"])) {
//   header("Location: ../../user/user_sign_in.php");
//   exit;
// }

require_once __DIR__ . '/../../vendor/autoload.php';
require "karyawan_functions.php";

$karyawan = queryTampilkaryawan("SELECT * FROM tb_karyawan");
$jlhjk = queryTampilkaryawan("SELECT * FROM filter_jlhjk");

require "../../user/user_functions.php";

$tb_ttd = queryTampilttd("SELECT * FROM tb_ttd");
// $ttd = $tb_ttd["nama"][0];
// var_dump($jlh_lk);
// die;

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
                    <font size="4">LAPORAN DATA KARYAWAN</font><br>
                    <font size="2"><i>Jl. Cempaka Besar No.57, Mawar, Kec. Banjarmasin Tengah, Kota Banjarmasin. (0511) 3367441</font></i></font><br>
                </td>
                </tr>
              </table>
               <table border="1" cellpadding="10" cellspacing="0">
                 <tr>
                 <th>No</th>
                 <th>NIP</th>
                 <th>Nama Karyawan</th>
                 <th>Email</th>
                 <th>Jenis Kelamin</th>
                 <th>Alamat</th>
                 <th>Tanggal_lahir</th>
                 <th>Gambar</th>
                 <th>Jabatan</th>
                 <th>No Telepon</th>
                  </tr>';
              $i = 1;
              foreach($karyawan as $row) {
$html .= '
                <tr>
                  <td>'. $i++ .'</td>
                  <td>'. $row["nip"] .'</td>
                  <td>'. $row["nm_kryw"] .'</td>
                  <td>'. $row["email"] .'</td>
                  <td>'. $row["jenis_kelamin"] .'</td>
                  <td>'. $row["alamat"] .'</td>
                  <td>'. $row["tanggal_lahir"] .'</td>
                  <td><img src="../../gambar/'. $row["gambar"] .'"width="100px"></td>
                  <td>'. $row["jabatan"] .'</td>
                  <td>'. $row["no_telp"] .'</td>
                 </tr>';
              }      
$html .= '
              </table>
              <br>';
              foreach($jlhjk as $row) {
$html .='
                <p>Jumlah Laki-laki: '. $row["jlh_lk"] .'</p>
                <p style="margin-top: -10px">Jumlah Perempuan: '. $row["jlh_pr"] .'</p>';
              }
$html .='              
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
$mpdf->Output('Laporan Data Karyawan.pdf', \Mpdf\Output\Destination::INLINE);

?>