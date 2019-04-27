<?php
ini_set('upload_max_filesize','1000M');
include "../../pemroses/koneksi.php";
$pilih_kriteria = mysqli_query($con, "SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Apa anda yakin menyimpan data ini?</h1>
        </div>
    </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Input Data Mahasiswa NO <?php echo $_SESSION['id_mahasiswa'];?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php
                                $lampiran = array();
                                $folder = "../upload/tmp_upload/";
                                $nama_file = '';
                                for($i=0;$i<count($_FILES['file_img']['name']);$i++){
                                    $temp = explode(".",$_FILES['file_img']['name'][$i]);
                                    $nama_file = $_FILES['file_img']['name'][$i];
                                    $lampiran[$i] = $nama_file;
                                    if($nama_file != ''){
                                        move_uploaded_file($_FILES['file_img']['tmp_name'][$i], $folder.$nama_file);
                                    }
                                }
                                ?>
                                <div class="col-lg-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                       <!-- Nama = <?php// echo $_SESSION['id_mahasiswa']; ?>-->
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
                                                $pilih_parameter = mysqli_query($con, "SELECT * FROM parameter WHERE kode_kriteria='" .$row['kode_kriteria']. "' ORDER BY skor DESC");// desc=dr besar ke kecil
                                                while($param = mysqli_fetch_assoc($pilih_parameter)){
                                                ?>
                                                <option value="<?php echo $param['id_parameter'] ?>" <?php if($_POST['skor'][$i]==$param['id_parameter']){echo 'selected';} ?>><?php echo $param['interval_parameter']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="row">
                                                <label class="col-md-3">Lampiran Bukti (Gambar) :</label>
                                                <div class="col-md-9">
                                                    <input type="hidden" name="lampiran[]" value="<?php echo $lampiran[$i]; ?>" >
                                                    <img src="../upload/tmp_upload/<?php echo $lampiran[$i]; ?>" width="150" height="150">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                        <button type="submit" name="proses" class="btn btn-success">Proses</button>
                                      <!-- <button type="submit" name="batal" class="btn btn-danger">Batal</button></right>-->
                                    </form>
                                    <?php
                                    if(isset($_POST['proses'])){
                                        $nama_mahasiswa = $_POST['nama_mahasiswa'];
                                        $id_mahasiswa = $_POST['id_mahasiswa'];
                                        $bobot = array();
                                        $id_parameter = implode(',', $_POST['skor']);
                                        $cek_interval = mysqli_query($con, "SELECT * FROM parameter WHERE id_parameter IN(" .$id_parameter. ") ORDER BY kode_kriteria ASC");
                                        $keterangan = array();

                                        while($rb = mysqli_fetch_assoc($cek_interval)){
                                            $bobot[] = $rb['skor'];
                                            $keterangan[] = $rb['interval_parameter'];
                                        }

                                        $sql = mysqli_query($con,"UPDATE mahasiswa SET K01=" .$bobot[0]. ",K02=" .$bobot[1]. ",K03=" .$bobot[2]. ",K04=" .$bobot[3]. ",K05=" .$bobot[4]. ",K06=" .$bobot[5]. ",K07=" .$bobot[6]. ",K08=" .$bobot[7]. ",K09=" .$bobot[8]. ",K10=" .$bobot[9]. " WHERE id_mahasiswa=".$id_mahasiswa."");

                                        $files = scandir('../upload/tmp_upload/');
                                        $asal = "../upload/tmp_upload/";
                                        $tujuan = "../upload/";

                                        foreach($files as $file){
                                            if(in_array($file, array(".",".."))) continue;
                                            if(copy($asal.$file, $tujuan.$file)){
                                                $delete[] = $asal.$file;
                                            }
                                        }

                                        for($i=0;$i<count($_POST['lampiran']);$i++){
                                            $kode_kriteria = $_POST['kode_kriteria'][$i];
                                            $nama_file = $_POST['lampiran'][$i];
                                            $interval_parameter = $keterangan[$i];
                                            $sql_lampiran = mysqli_query($con, "INSERT INTO lampiran_mahasiswa(id_mahasiswa,nama_mahasiswa,kode_kriteria,interval_parameter,nama_file) VALUES(" .$_SESSION['id_mahasiswa']. ", '" .$nama_mahasiswa. "', '" .$kode_kriteria. "', '" .$interval_parameter. "', '" .$nama_file. "')");
                                        }
                                        foreach($delete as $file){
                                            unlink($file);
                                        }
                                        ?>
                                        <script>
                                        alert('Data berhasil diinput');
                                        window.location='index.php?p=dashboard';
                                    </script>";
                                    <?php
                                    }/*elseif(isset($_POST['batal'])){
                                        $files = scandir('../upload/tmp_upload/');
                                        $asal = "../upload/tmp_upload/";
                                        foreach($files as $file){
                                            $delete[] = $asal.$file;
                                        }

                                        foreach($delete as $file){
                                            unlink($file);
                                        }*/
                                    // }
                                    ?>
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
x