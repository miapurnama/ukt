<?php
$id_mahasiswa = $_GET['id_mahasiswa'];
$sql = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id_mahasiswa=" .$id_mahasiswa. "");
$row = mysqli_fetch_assoc($sql);
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pesan</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kirim Pesan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                        <form action="pemroses/kirim.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>">
                                        <div class="form-group">
                                            <label>Kepada</label>
                                            <input type="text" name="nama_mahasiswa" class="form-control" value="<?php echo $row['nama_mahasiswa']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Isi Pesan</label>
                                            <textarea name="isi" class="form-control" rows="8" required></textarea>
                                        </div>
                                        <button type="submit" name="kirim" class="btn btn-success">Kirim</button>
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
