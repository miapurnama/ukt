<?php
ini_set('max_execution_time', 30000);
function No_Peserta($id){
    require "pemroses/koneksi.php"; //require = kita butuh file tsb, jika file tsb tdk ada maka script d bwhnya ndk jln
    $sql = $con->query("SELECT no_peserta FROM mahasiswa WHERE id_mahasiswa=" .$id. ""); // mysqli_query = ambil data, $con = koneks databse, mau mengambil dta apa
    $row = $sql->fetch_row(); //
    return $row[0];
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hasil Simulasi</h1>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="data">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kode Kriteria
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $id_kriteria = $_GET['data'];
                            $data_kriteria = $con->query("SELECT kode_kriteria FROM kriteria krit WHERE id_kriteria IN (".$id_kriteria.") ORDER BY FIELD(krit.id_kriteria,".$id_kriteria.")");

                            $kode_kriteria = [];
                            while ($row_kriteria = $data_kriteria->fetch_assoc()) {
                                array_push($kode_kriteria, $row_kriteria['kode_kriteria']);
                            }
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode Kriteria</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kode_kriteria as $value): ?>
                                                <tr>
                                                    <td><?php echo $value; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Mahasiswa
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $kk = "";
                            foreach($kode_kriteria as $value){
                                $kk .= "'" .$value. "',";
                            }
                            $kk = substr($kk, 0, -1);

                            $data_mahasiswa = $con->query("SELECT * FROM lampiran_mahasiswa WHERE kode_kriteria IN({$kk}) ORDER BY id_mahasiswa, kode_kriteria");

                            $data = [];
                            while ($row = $data_mahasiswa->fetch_assoc()) {
                                $data[$row['id_mahasiswa']][$row['kode_kriteria']] = $row['interval_parameter'];
                                $verifikasi[$row['id_mahasiswa']][$row['kode_kriteria']]=$row['interval_parameter'];
                            }

                            foreach ($verifikasi as $row => $value) {
                                foreach ($value as $col => $val) {
                                    $sql = $con->query("SELECT * FROM cek_verifikasi WHERE id_mahasiswa = " .$row. " AND kode_kriteria = '" .$col. "'");
                                    if ($sql->num_rows == 0) {
                                        $data[$row][$col]=5;
                                        $verifikasi[$row][$col] = 5;
                                    }else{
                                        $cek = $sql->fetch_assoc();
                                        if ($cek['status']=='Tidak') {
                                            $data[$row][$col]=5;
                                            $verifikasi[$row][$col] = 5;
                                        }
                                    }
                                }
                            }
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Mahasiswa</th>
                                                <?php foreach ($kode_kriteria as $value): ?>
                                                    <th><?php echo $value; ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key; ?></td>
                                                    <?php foreach ($value as $k => $val): ?>
                                                        <td><?php echo $val ?></td>
                                                    <?php endforeach ?>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Normalisasi Data Mahasiswa
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $idx = array();
                            foreach($data as $key => $value){
                                $idx[] = $key;
                            }

                            $akar_total_kuadrat_kolom = array();
                            foreach($data[min($idx)] as $j => $val){
                                $total_kuadrat = 0;
                                foreach($data as $key => $value){
                                    $total_kuadrat += pow($data[$key][$j], 2);
                                }
                                $akar_total_kuadrat_kolom[$j] = sqrt($total_kuadrat);
                            }// mengkuadratkan data mahasiswa. dan akar kn data 

                            foreach($data as $key => $value){
                                foreach($value as $j => $val){
                                    $data[$key][$j] = round($val/$akar_total_kuadrat_kolom[$j],6);
                                }
                            }//normalisasi data
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Mahasiswa</th>
                                                <?php foreach ($kode_kriteria as $value): ?>
                                                    <th><?php echo $value; ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key; ?></td>
                                                    <?php foreach ($value as $k => $val): ?>
                                                        <td><?php echo $val ?></td>
                                                    <?php endforeach ?>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bobot Kriteria Dengan Rangking
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $ambil_kriteria = $con->query("SELECT ranking_kriteria, kategori, kode_kriteria FROM kriteria krit WHERE id_kriteria IN(".$id_kriteria.") ORDER BY FIELD(krit.id_kriteria,".$id_kriteria.")");
                            $kriteria = array();
                            $rank = 1;
                            while($rk = $ambil_kriteria->fetch_assoc()){
                                $kriteria[$rk['kode_kriteria']][0] = $rank;
                                $kriteria[$rk['kode_kriteria']][1] = $rk['kategori'];
                                $rank++;
                            }

                            $n = count($kriteria);
                            $pembagi = 0;
                            $bobot_kriteria = array();
                            foreach($kriteria as $key => $val){
                                $pembagi += ($n-$val[0]+1);
                            }

                            foreach($kriteria as $key=>$val){
                                $bobot_kriteria[$key][0] = round(($n-$val[0]+1)/$pembagi,6);
                                $bobot_kriteria[$key][1] = $val[1];
                            }//metode ranking
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode Kriteria</th>
                                                <th>Bobot</th>
                                                <th>Kategori</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bobot_kriteria as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key; ?></td>
                                                    <td><?php echo $value[0]; ?></td>
                                                    <td><?php echo $value[1]; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Matrix Normalisasi Terbobot
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $matrix_normalisasi_bobot = array();
                            foreach($data as $key => $value){
                                foreach($bobot_kriteria as $k => $val){
                                    $matrix_normalisasi_bobot[$key][$k] = round($value[$k]*$val[0],6);
                                }
                            }//rating bobot ternormalisasi
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Mahasiswa</th>
                                                <?php foreach ($kode_kriteria as $value): ?>
                                                    <th><?php echo $value; ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($matrix_normalisasi_bobot as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key; ?></td>
                                                    <?php foreach ($value as $k => $val): ?>
                                                        <td><?php echo $val ?></td>
                                                    <?php endforeach ?>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            A+ dan A-
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $a_plus = $a_minus = array();
                            foreach($kriteria as $j => $val){
                                $a = [];
                                foreach($matrix_normalisasi_bobot as $key => $value){
                                   $a[$key] = round($matrix_normalisasi_bobot[$key][$j],6);
                                }
                                if ($kriteria[$j][1]=='benefit') {
                                    $a_plus[$j]= max($a);
                                    $a_minus[$j]= min($a);
                                }else{
                                    $a_plus[$j]= min($a);
                                    $a_minus[$j]= max($a);
                                }
                            }
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode Kriteria</th>
                                                <th>A+</th>
                                                <th>A-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kode_kriteria as $value): ?>
                                                <tr>
                                                    <td><?php echo $value ?></td>
                                                    <td><?php echo $a_plus[$value]; ?></td>
                                                    <td><?php echo $a_minus[$value]; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            D+ dan D-
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $d_plus = $d_minus = array();
                            foreach($matrix_normalisasi_bobot as $key => $value){
                                $total_kuadrat_plus = $total_kuadrat_minus = 0;
                                foreach($value as $j => $val){
                                    $total_kuadrat_plus += pow($val-$a_plus[$j], 2);
                                    $total_kuadrat_minus += pow($val-$a_minus[$j], 2);
                                }
                                $d_plus[$key] = round(sqrt($total_kuadrat_plus),6);//jarak antara alternatif A positif
                                $d_minus[$key] = round(sqrt($total_kuadrat_minus),6); //jarak antara alternatif A negatif
                            }
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Mahasiswa</th>
                                                <th>D+</th>
                                                <th>D-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($d_plus as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $d_plus[$key]; ?></td>
                                                    <td><?php echo $d_minus[$key]; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Preferensi Akhir (V)
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $v = array();
                            foreach($d_plus as $key => $value){
                                $v[$key] = round($d_minus[$key]/($d_plus[$key]+$d_minus[$key]),6);
                            }//nilai preferensi antara alternatif
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Mahasiswa</th>
                                                <th>V</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($v as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $value; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pengurutan hasil Preferensi Akhir (V)
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            $v = array();
                            foreach($d_plus as $key => $value){
                                $v[$key] = round($d_minus[$key]/($d_plus[$key]+$d_minus[$key]),6);
                            }//nilai preferensi antara alternatif
                            ?>
                            <?php arsort($v); ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Mahasiswa</th>
                                                <th>V</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($v as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $value; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kelompok UKT (Preferensi telah disortir)
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                            <div class="panel-body">
                            <?php  
                            arsort($v);
                            $ukt = array();
                            foreach($v as $key => $value){
                                if($value>=0 && $value<=0.199999){
                                    $ukt[$key] = 5;
                                }elseif($value>=0.2 && $value<=0.3999999){
                                    $ukt[$key] = 4;
                                }elseif($value>=0.4 && $value<=0.5999999){
                                    $ukt[$key] = 3;
                                }elseif($value>=0.6 && $value<=0.7999999){
                                    $ukt[$key] = 2;
                                }else{
                                    $ukt[$key] = 1;
                                }
                            }//pembagian kelompok UKT
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Mahasiswa</th>
                                                <th>V</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ukt as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $value; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        </center>
        </div>
    </div>
</div>