<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Parameter</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Edit Parameter
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                        <?php
                                        include 'pemroses/koneksi.php';
                                        $id_parameter = $_GET['id_parameter'];
                                        $sql = mysqli_query($con, "SELECT * FROM parameter WHERE id_parameter=" .$id_parameter. "");
                                        $row = mysqli_fetch_assoc($sql);
                                        ?>
                                        <form action="pemroses/editparameter.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_parameter" value="<?php echo $row['id_parameter']; ?>" readonly>
                                        <div class="form-group">
                                            <label>Kode Kriteria</label>
                                            <input type="text" name="kode_kriteria" class="form-control" value="<?php echo $row['kode_kriteria']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Parameter/ Interval</label>
                                            <textarea class="form-control" name="interval" rows="8" placeholder="Masukkan Nama/interval parameter"><?php echo $row['interval_parameter']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Skor</label>
                                            <select name="skor" class="form-control" required>
                                                <option></option>
                                                <option value="5" <?php if($row['skor']==5){echo 'selected';} ?>>5</option>
                                                <option value="4" <?php if($row['skor']==4){echo 'selected';} ?>>4</option>
                                                <option value="3" <?php if($row['skor']==3){echo 'selected';} ?>>3</option>
                                                <option value="2" <?php if($row['skor']==2){echo 'selected';} ?>>2</option>
                                                <option value="1" <?php if($row['skor']==1){echo 'selected';} ?>>1</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
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
