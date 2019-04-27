<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input Parameter</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Input Parameter
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                        <form action="pemroses/parameter.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="kode_kriteria" value="<?php echo $_GET['kode_kriteria']; ?>" readonly>
                                        <div class="form-group">
                                            <label>Nama Parameter/ Interval</label>
                                            <textarea class="form-control" name="interval" rows="8" placeholder="Masukkan Nama/interval parameter"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Skor</label>
                                            <select name="skor" class="form-control" required>
                                                <option></option>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
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
