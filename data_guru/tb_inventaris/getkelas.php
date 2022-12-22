<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

                    $sql_nama = mysqli_query($conn, "SELECT * FROM tb_kelas ORDER BY kelas ASC") or die (mysqli_error($conn));
                    while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                      echo '
                      <option value="'.$data_kelas['kelas'].'">
                        '.$data_kelas['kelas'].' 
                      </option>
                      ';
                    }
                  ?>

    