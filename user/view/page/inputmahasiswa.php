<?php
ini_set('upload_max_filesize','1000M');
include "../../pemroses/koneksi.php";
$pilih_kriteria = mysqli_query($con, "SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
?>
<style>
    .zoom{
        transition: transform .2s;
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }
    .zoom:hover{
        transform: scale(2.5);
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input Data</h1>
        </div>
    </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Input Data Mahasiswa
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="index.php?p=validasi" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $_SESSION['id_mahasiswa']; ?>">
                                        <div class="form-group">
                                            <label>Nama Mahasiswa</label>
                                            <input type="text" name="nama_mahasiswa" class="form-control" value="<?php echo $_SESSION['nama_mahasiswa']; ?>" readonly>
                                        </div>
                                        <?php
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($pilih_kriteria)){
                                        ?>
                                        <div class="form-group">
                                            <label><?php echo $row['nama_kriteria']; ?></label>
                                            <input type="hidden" name="kode_kriteria[<?php echo $i; ?>]" value="<?php echo $row['kode_kriteria']; ?>">
                                            <select name="skor[]" class="form-control" required>
                                                <option></option>
                                                <?php
                                                $pilih_parameter = mysqli_query($con, "SELECT * FROM parameter WHERE kode_kriteria='" .$row['kode_kriteria']. "' ORDER BY skor DESC");
                                                while($param = mysqli_fetch_assoc($pilih_parameter)){
                                                ?>
                                                <option value="<?php echo $param['id_parameter'] ?>"><?php echo $param['interval_parameter']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="row">
                                                <label class="col-md-3">Lampiran Bukti (Gambar) :</label>
                                                <div class="col-md-9">
                                                    <input type='file' onclick="cek_urut(<?php echo $i ?>)" name="file_img[<?php echo $i; ?>]" accept=".jpeg,.jpg,.png" id="imgInp<?php echo $i; ?>" required/>
                                                    <img class="img-responsive zoom gambar-upload" id="tampilkan<?php echo $i; ?>" src="#" alt="your image" style="width: 40%; height: 30%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                        <button type="submit" name="validasi" class="btn btn-success">Submit</button>
                                        <button type="reset" id="btn-reset" class="btn btn-danger">Reset</button></right>
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

    </div>