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
                            Form Input Kriteria
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                        <form action="pemroses/kriteria.php" method="post" enctype="multipart/form-data"> <!--  action= saat tombol submit ditekan, maka form akan diarahkan ke pemroses/kriteria.php. post= untuk mengirim data tp disembunyikn dr url -->
                                        <div class="form-group">
                                            <label>Nama Kriteria</label>
                                            <input name="nama_kriteria" class="form-control" placeholder="Masukkan Nama Kriteria" required> <!-- name = nama variabel, required= data hrus diisi-->
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Kriteria</label>
                                            <input name="kode_kriteria" pattern="[A-Z]+[0-9]+[0-9]" class="form-control" placeholder="Contoh: K01,K02,K03...dst" required> <!-- -->
                                        </div>
                                        <div class="form-group">
                                            <label>Bobot Kriteria</label>
                                            <input name="bobot_kriteria" class="form-control" placeholder="Masukkan Bobot Kriteria" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Kategori </label>
                                            <select name="kategori" class="form-control" required="">
                                                <option></option>
                                                <option>Cost</option>
                                                <option>Benefit</option>
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
