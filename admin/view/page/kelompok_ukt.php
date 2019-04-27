<?php
ini_set('max_execution_time', 30000);
function No_Peserta($id){
    require "pemroses/koneksi.php"; //require = kita butuh file tsb, jika file tsb tdk ada maka script d bwhnya ndk jln
    $sql = $con->query("SELECT no_peserta FROM mahasiswa WHERE id_mahasiswa=" .$id. ""); // mysqli_query = ambil data, $con = koneks databse, mau mengambil dta apa
    $row = $sql->fetch_row(); // -> artinya mysqli. $sql fungsi, -> untuk manggil kelas
    return $row[0];
}

$id_kriteria = $_GET['data']; //mengambil kriteria yang di imputkan di form hasil
$data_kriteria = $con->query("SELECT kode_kriteria FROM kriteria WHERE id_kriteria IN (".$id_kriteria.") ORDER BY FIELD(kriteria.id_kriteria,".$id_kriteria.")"); //field = kolom,  ambil data kode kriteria dr tabel kriteria dimana id kriteria sama dg $id_kriteria yg di dapat, 

$kode_kriteria = [];
while ($row_kriteria = $data_kriteria->fetch_assoc()) {
    array_push($kode_kriteria, $row_kriteria['kode_kriteria']); //array push menambah array dr belakang array
}

$kk = ""; //string kosong
foreach($kode_kriteria as $value){
    $kk .= "'" .$value. "',"; //mengubah data array menjadi string, .= menambah array, K1,K2,K3,
}
$kk = substr($kk, 0, -1);//substr fungsi string, untuk menghapus carakter string, yg dihapus koma

$data_mahasiswa = $con->query("SELECT * FROM lampiran_mahasiswa WHERE kode_kriteria IN({$kk}) ORDER BY id_mahasiswa, kode_kriteria");

$data = [];
while ($row = $data_mahasiswa->fetch_assoc()) { //mengubah data array ke array assosiatif
    $data[$row['id_mahasiswa']][$row['kode_kriteria']] = $row['interval_parameter'];
    $verifikasi[$row['id_mahasiswa']][$row['kode_kriteria']]=$row['interval_parameter'];
}

foreach ($verifikasi as $row => $value) {
    foreach ($value as $col => $val) {
        $sql = $con->query("SELECT * FROM cek_verifikasi WHERE id_mahasiswa = " .$row. " AND kode_kriteria = '" .$col. "'");
        if ($sql->num_rows == 0) { //data belum di verifikasi
            $data[$row][$col]=5;
            $verifikasi[$row][$col] = 5;
        }else{
            $cek = $sql->fetch_assoc();
            if ($cek['status']=='Tidak') { //data sudah di verifikasi, tp verifikasi tidak
                $data[$row][$col]=5;
                $verifikasi[$row][$col] = 5; //mengecek verifikasi data
            }
        }
    }
}

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
        $data[$key][$j] = $val/$akar_total_kuadrat_kolom[$j];
    }
}//normalisasi data

$ambil_kriteria = $con->query("SELECT kategori, kode_kriteria FROM kriteria WHERE id_kriteria IN(".$id_kriteria.") ORDER BY FIELD(kriteria.id_kriteria,".$id_kriteria.")"); //ngambil data ranking kriteria
$kriteria = array();
$rank = 1; //ranking dimulai dr 1
while($rk = $ambil_kriteria->fetch_assoc()){
    $kriteria[$rk['kode_kriteria']][0] = $rank; //ranking kriteria
    $kriteria[$rk['kode_kriteria']][1] = $rk['kategori']; //kategori kriteria
    $rank++;
} //looping ranking kriteria

$n = count($kriteria);
$pembagi = 0;
$bobot_kriteria = array();
foreach($kriteria as $key => $val){
    $pembagi += ($n-$val[0]+1); // $val[0] kriteria yang dihitung
} //kriteria terus diloopong, kalau di rumus artinya sigma, 

foreach($kriteria as $key=>$val){
    $bobot_kriteria[$key][0] = ($n-$val[0]+1)/$pembagi;
    $bobot_kriteria[$key][1] = $val[1]; //kategori kriteria
}//metode ranking
// echo "<pre>";
// print_r($kriteria);
// echo "</pre>";
$matrix_normalisasi_bobot = array();
foreach($data as $key => $value){
    foreach($bobot_kriteria as $k => $val){
        $matrix_normalisasi_bobot[$key][$k] = $value[$k]*$val[0]; //nilai tiap mahasiswa dikali bobot
    }
}//rating bobot ternormalisasi

$a_plus = $a_minus = array();
foreach($kriteria as $j => $val){
    $a = [];
    foreach($matrix_normalisasi_bobot as $key => $value){
       $a[$key] = $matrix_normalisasi_bobot[$key][$j];
    }
    if ($kriteria[$j][1]=='benefit') {
        $a_plus[$j]= max($a);
        $a_minus[$j]= min($a);
    }else{
        $a_plus[$j]= min($a);
        $a_minus[$j]= max($a);
    }
}

$d_plus = $d_minus = array();
foreach($matrix_normalisasi_bobot as $key => $value){
    $total_kuadrat_plus = $total_kuadrat_minus = 0;
    foreach($value as $j => $val){
        $total_kuadrat_plus += pow($val-$a_plus[$j], 2);
        $total_kuadrat_minus += pow($val-$a_minus[$j], 2);
    }
    $d_plus[$key] = sqrt($total_kuadrat_plus);//jarak antara alternatif A positif
    $d_minus[$key] = sqrt($total_kuadrat_minus); //jarak antara alternatif A negatif
}

$v = array();
foreach($d_plus as $key => $value){
    $v[$key] = round($d_minus[$key]/($d_plus[$key]+$d_minus[$key]),6);
}//nilai preferensi antara alternatif

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

$idm = implode(',', $idx);
$sql = $con->query("SELECT * FROM mahasiswa WHERE id_mahasiswa IN(" .$idm. ")");
$mahasiswa = array();
while($rm = $sql->fetch_assoc()){
    $mahasiswa[$rm['id_mahasiswa']] = $rm['nama_mahasiswa'];
}
// print_r($mahasiswa);
foreach($v as $key => $value){ // => isi nya value
    $update = $con->query("UPDATE mahasiswa SET total=" .$v[$key]. " WHERE id_mahasiswa=" .$key."");
    $cek = $con->query("SELECT * FROM kelompok_ukt WHERE id_mahasiswa=" .$key. "");
    $hasil = $cek->num_rows;
    if($hasil==0){
        $tambah_ukt = $con->query("INSERT INTO kelompok_ukt(id_mahasiswa,nama_mahasiswa,kelompok,nilai_total) VALUES(" .$key. ",'" .$mahasiswa[$key]. "'," .$ukt[$key]. ",'" .$v[$key]. "')");
    }else{
        $updateukt = $con->query("UPDATE kelompok_ukt SET nama_mahasiswa='" .$mahasiswa[$key]. "', kelompok=" .$ukt[$key]. ", nilai_total='" .$v[$key]. "' WHERE id_mahasiswa=" .$key. "");
    }
}
$sql_cek = $con->query("SELECT * FROM kelompok_ukt");
$total = $sql_cek->num_rows;
$batas2 = floor(0.05 * $total);

$sql_1 = $con->query("SELECT * FROM kelompok_ukt WHERE kelompok=1 ORDER BY nilai_total DESC");
$ukt1 = [];
while($r1 = $sql_1->fetch_assoc()){
    $ukt1[$r1['id_mahasiswa']] = $r1['kelompok'];
}

$n1 = count($ukt1);
if($n1>$batas2){
    $sql_up1 = $con->query("SELECT * FROM kelompok_ukt WHERE kelompok=1 ORDER BY nilai_total DESC");
    $nup1 = 0;
    while($rup1 = $sql_up1->fetch_assoc()){
        $nup1++;
        if($nup1>$batas2){
            $updateukt = $con->query("UPDATE kelompok_ukt SET nama_mahasiswa='" .$rup1['nama_mahasiswa']. "', kelompok=2 WHERE id_mahasiswa=" .$rup1['id_mahasiswa']. "");
        }
    }
}

$sql_2 = $con->query("SELECT * FROM kelompok_ukt WHERE kelompok=2 ORDER BY nilai_total DESC");
$ukt2 = [];
while($r2 = $sql_2->fetch_assoc()){
    $ukt2[$r2['id_mahasiswa']] = $r2['kelompok'];
}

$n2 = count($ukt2);
if($n2>$batas2){
    $sql_up2 = $con->query("SELECT * FROM kelompok_ukt WHERE kelompok=2 ORDER BY nilai_total DESC");
    $nup2 = 0;
    while($rup2 = $sql_up2->fetch_assoc()){
        $nup2++;
        if($nup2>$batas2){
            $updateukt = $con->query("UPDATE kelompok_ukt SET nama_mahasiswa='" .$rup2['nama_mahasiswa']. "', kelompok=3 WHERE id_mahasiswa=" .$rup2['id_mahasiswa']. "");
        }
    }
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Kelompok UKT</h1>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="data">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kelompok UKT<br/>
                            <a href="view/page/print.php" class="btn btn-default"><i class="glyphicon glyphicon-print"></i>&nbsp;Cetak</a>
                            <!--<a href="view/page/pdf.php" class="btn btn-default"><i class="fa fa-pdf-o"></i>&nbsp;Cetak PDF</a>-->
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>No peserta</th>
                                            <th>Kelompok UKT</th>
                                            <th>Nilai Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = $con->query("SELECT * FROM kelompok_ukt ORDER BY id_mahasiswa");

                                        $no=0;
                                        while($r = $sql->fetch_assoc()){
                                            $no++;
                                        ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $r['nama_mahasiswa'];?></td>
                                            <td><?php echo No_Peserta($r['id_mahasiswa']);?></td>
                                            <td><?php echo $r['kelompok'];?></td>
                                            <td><?php echo $r['nilai_total']; ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
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