<?php
function biaya($val){
    switch ($val) {
        case 1:
            return "Biaya UKT Sebesar Rp.500.000";
            break;
        case 2:
            return "Biaya UKT Sebesar Rp.1.000.000";
            break;
        case 3:
            return "Biaya UKT Sebesar Rp.1.500.000";
            break;
        case 4:
            return "Biaya UKT Sebesar Rp.1.700.000";
            break;
        case 5:
            return "Biaya UKT Sebesar Rp.2.000.000";
            break;
    }
}
function keterangan($val){
    switch ($val) {
        case 1:
            return "Selamat";
            break;
        case 2:
            return "Anda masuk ke kelompok UKT 2 karena kuota kelompok 1 sudah terisi";
            break;
        case 3:
            return "Anda masuk ke kelompok UKT 3 karena kuota kelompok 1 dan 2 sudah terisi";
            break;
        case 4:
            return "Anda masuk ke kelompok UKT 4 karena kuota kelompok 1-3 sudah terisi";
            break;
        case 5:
            return "Anda masuk ke kelompok UKT 5 karena kuota kelompok 1-4 sudah terisi";
            break;
    }
}
//include "../../pemroses/koneksi.php";
$cek_ukt = $con->query("SELECT * FROM kelompok_ukt WHERE id_mahasiswa=" .$_SESSION['id_mahasiswa']."");
$r = $cek_ukt->fetch_assoc();

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">HASIL UKT</h1>
        </div>
    </div>
            <!-- /.row -->
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kelompok UKT
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <td>Nama Mahasiswa : </td>
                                            <td><?php echo $r['nama_mahasiswa'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kelompok UKT : </td>
                                            <td><?php echo $r['kelompok'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan :</td>
                                            <td><?php echo biaya($r['kelompok']);?></td>
                                        </tr>
                                        <tr>
                                            <td>Penjelasan :</td>
                                            <td><?php echo keterangan($r['kelompok']);?></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
