<?php
if($_GET['id_mahasiswa']){
    $id_mahasiswa = $_GET['id_mahasiswa'];
}

if(isset($_POST['id_mahasiswa'])){
    $id_mahasiswa = $_POST['id_mahasiswa'];
}
$sql = $con->query("SELECT * FROM mahasiswa WHERE id_mahasiswa = " .$id_mahasiswa. "");
$data = $sql->fetch_assoc();

if (isset($_POST['verifikasi_total'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $cek = $con->query("SELECT * FROM kriteria");
    $total = $cek->num_rows;

    $cek2 = $con->query("SELECT * FROM cek_verifikasi WHERE id_mahasiswa=" .$id_mahasiswa. " AND status='Ya'");
    $total_terverifikasi = $cek2->num_rows;

    if($total_terverifikasi === $total){
        $sql = $con->query("UPDATE mahasiswa SET verifikasi='Ya' WHERE id_mahasiswa=" .$id_mahasiswa. "");
        if($sql){
            header("Location: index.php?p=datamahasiswa");
        }
    }
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input Kriteria</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data <strong><?php echo $data['nama_mahasiswa']; ?></strong> yang telah diverifikasi 
                        </div>
                        <div class="panel-body">
                            <?php
                            $sql = $con->query("SELECT * FROM cek_verifikasi WHERE id_mahasiswa = " .$id_mahasiswa. "");
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>">
                                        <table class="table table-bordered table-responsive" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Kode Kriteria</th>
                                                    <th>Terverifikasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
                                               while($row = $sql->fetch_assoc()){
                                               ?> 
                                               <tr>
                                                   <td><?php echo $row['kode_kriteria']; ?></td>
                                                   <td><?php echo $row['status']; ?></td>
                                               </tr>
                                               <?php
                                                }
                                               ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        $kriteria = $con->query("SELECT * FROM kriteria");
                                        $total_kriteria = $kriteria->num_rows;

                                        $cek = $con->query("SELECT * FROM cek_verifikasi WHERE id_mahasiswa = " .$id_mahasiswa. " AND status = 'Ya'");
                                        $total = $cek->num_rows;
                                        $m = '';
                                        if ($total === $total_kriteria) {
                                            $m = '';
                                        }else{
                                            $m = 'disabled';
                                        }
                                        ?>
                                        <button type="submit" name="verifikasi_total" class="btn btn-success btn-block" <?php echo $m; ?>>Verifikasi Akhir</button>
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
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lampiran Verifikasi <strong><?php echo $data['nama_mahasiswa']; ?></strong> 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>">
                                        <?php
                                        $sql = $con->query("SELECT * FROM kriteria ORDER BY kode_kriteria");
                                        ?>
                                        <div class="form-group">
                                            <label>Pilih Kriteria</label>
                                            <select name="kode_kriteria" class="form-control">
                                                <?php
                                                while($row = $sql->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo $row['kode_kriteria']; ?>"><?php echo $row['nama_kriteria']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" name="periksa" class="btn btn-success">Periksa</button>
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
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Lampiran <strong><?php echo $data['nama_mahasiswa']; ?></strong> 
                        </div>
                        <?php
                        if (isset($_POST['periksa'])) {
                            $id_mahasiswa = $_POST['id_mahasiswa'];
                            $kode_kriteria = $_POST['kode_kriteria'];

                            $cek = $con->query("SELECT nama_kriteria FROM kriteria WHERE kode_kriteria = '" .$kode_kriteria. "'");
                            $row = $cek->fetch_assoc();
                            $nama_kriteria = $row['nama_kriteria'];
                            $cek2 = $con->query("SELECT interval_parameter FROM lampiran_mahasiswa WHERE kode_kriteria
                                = '" .$kode_kriteria."' AND id_mahasiswa = $id_mahasiswa");
                            $row2 = $cek2->fetch_row();
                            $lam = $row2[0];

                            $sql = $con->query("SELECT * FROM lampiran_mahasiswa WHERE id_mahasiswa = " .$id_mahasiswa. " AND kode_kriteria = '" .$kode_kriteria. "'");
                            $data = $sql->fetch_assoc();
                        ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="pemroses/verifikasi.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>">
                                        <input type="hidden" name="kode_kriteria" value="<?php echo $kode_kriteria; ?>">
                                        <div class="form-group">
                                            <label>Nama Kriteria</label>
                                            <input name="nama_kriteria" class="form-control" value="<?php echo $nama_kriteria; ?>" placeholder="Masukkan Nama Kriteria" readonly>
                                        </div>
                                            <label>Parameter</label>
                                            <input type="text" name="" value="<?php echo $data['nama_parameter']; ?>" class="form-control" readonly>
                                        <div class="form-group">
                                            <label>Lampiran</label>
                                            <img src="../upload/<?php echo $data['nama_file'] ?>" class="img-responsive">
                                        </div>
                                        <div class="form-group">
                                            <label>Verifikasi?</label>
                                            <select name="status" class="form-control">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kirim Pesan <small style="color: red;">jika data verifikasi tidak sesuai dengan kriteria</small></label>
                                            <textarea name="pesan" class="form-control" rows="5"></textarea>
                                        </div>
                                        <button type="submit" name="verifikasi" class="btn btn-success">Verifikasi</button>
                                        <a href="index.php?p=verifikasi&id_mahasiswa=<?php echo $id_mahasiswa ?>" class="btn btn-default">Reset</a></right>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
        </div>
    </div>

</div>

</html>
