<?php 

$conn = mysqli_connect("localhost", "root", "", "monitoringskripsi");

                    $sql_nama = mysqli_query($conn, "SELECT * FROM tb_kelas ORDER BY nama ASC") or die (mysqli_error($conn));
                    while($data_nama = mysqli_fetch_array($sql_nama)) {
                      echo '
                      <option value="'.$data_nama['nama'].'">
                        '.$data_nama['nip'].' - '.$data_nama['nama'].'
                      </option>
                      ';
                    }
                  ?>

    