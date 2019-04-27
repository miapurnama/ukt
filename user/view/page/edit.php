<?php
function cek_kriteria($kode_kriteria,$id_mahasiswa){
    $con = mysqli_connect("localhost", "root","");
    mysqli_select_db($con, "ukt");

    $nk = mysqli_query($con, "SELECT nama_kriteria FROM kriteria WHERE kode_kriteria='" .$kode_kriteria. "'");
    $sql = mysqli_fetch_row($nk);
    $nama_kriteria = $sql[0];

    $sk = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id_mahasiswa=" .$id_mahasiswa. "");
    $cek = mysqli_fetch_assoc($sk);
    $skor = $cek[''.$kode_kriteria. ''];

    $keterangan = detail_kriteria($kode_kriteria,$skor);

    return array($nama_kriteria,$keterangan);
}

function detail_kriteria($kode_kriteria,$skor){
    $con = mysqli_connect("localhost", "root","");
    mysqli_select_db($con, "ukt");
    $cs = mysqli_query($con, "SELECT interval_parameter FROM parameter WHERE kode_kriteria='" .$kode_kriteria. "' AND skor=" .$skor. "");
    $sql = mysqli_fetch_row($cs);
    return $sql[0];
}
//include "../../pemroses/koneksi.php";
$pilih_kriteria = mysqli_query($con, "SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
$sql = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id_mahasiswa=" .$_SESSION['id_mahasiswa']. "");
$r = mysqli_fetch_assoc($sql);

$lampiran  = mysqli_query($con,"SELECT * FROM lampiran_mahasiswa WHERE id_mahasiswa=" .$_SESSION['id_mahasiswa']. "");
?>
<style>
    .zoom{
        transition: transform .2s;
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }
    .zoom:hover{
        transform: scale(3.5);
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data <?php echo $_SESSION['nama_mahasiswa'] ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabel Data
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="pemroses/editmahasiswa.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_mahasiswa" value="<?php echo $_SESSION['id_mahasiswa']; ?>">
                                <div class="form-group">
                                    <label>Nama Mahasiswa</label>
                                    <input type="text" name="nama_mahasiswa" class="form-control" value="<?php echo $r['nama_mahasiswa']; ?>">
                                </div>
                                <?php
                                $i = 0;
                                while(($row = mysqli_fetch_assoc($pilih_kriteria))&& ($lam = mysqli_fetch_assoc($lampiran))){
                                ?>
                                <div class="form-group">
                                    <label><?php echo $row['nama_kriteria']; ?></label>
                                    <input type="hidden" name="kode_kriteria[<?php echo $i; ?>]" value="<?php echo $row['kode_kriteria']; ?>" readonly>
                                    <select name="skor[]" class="form-control" readonly>
                                        <option></option>
                                        <?php
                                        $pilih_parameter = mysqli_query($con, "SELECT * FROM parameter WHERE kode_kriteria='" .$row['kode_kriteria']. "' ORDER BY skor DESC");
                                                while($param = mysqli_fetch_assoc($pilih_parameter)){
                                        ?>
                                        <option value="<?php echo $param['id_parameter']; ?>" <?php if($lam['interval_parameter']==$param['interval_parameter']){echo 'selected';} ?>><?php echo $param['interval_parameter']; ?></option>
                                        <?php
                                                }
                                        ?>
                                    </select>
                                    <div class="row">
                                        <label class="col-md-3">Lampiran Bukti (Gambar) :</label>
                                        <div class="col-md-9">
                                            <input type="file" onclick="cek_urut(<?php echo $i ?>)" id="imgInp<?php echo $i; ?>" name="file_img[<?php echo $i; ?>]" accept=".jpeg,.jpg,.png">
                                            <img class="img-responsive zoom" id="tampilkan<?php echo $i; ?>" src="#" alt="" style="width: 40%; height: 30%"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3">Lampiran Sebelumnya :</label>
                                        <div class="col-md-9">
                                            <img class="img-responsive zoom" width="100" height="100" src="../upload/<?php echo $lam['nama_file']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $i++;
                                }
                                ?>
                                <button type="submit" name="proses" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button></right>
                            </form>
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
