<?php  
require("pemroses/koneksi.php");
$sql = $con->query("SELECT * FROM kriteria ORDER BY kode_kriteria");
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Simulasi Topsis</h1>
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
                                        <form action="index.php?p=hasil_simulasi" method="post" enctype="multipart/form-data" id="myForm"> <!--  action= saat tombol submit ditekan, maka form akan diarahkan ke pemroses/kriteria.php. post= untuk mengirim data tp disembunyikn dr url -->
                                        <div class="row">
                                        <?php
                                        while($data = $sql->fetch_assoc()){
                                        ?>
                                            <div class="col-md-3">
                                                <input type="checkbox" name="id_kriteria[]" value="<?php echo $data['id_kriteria'] ?>" class="idk"> <?php echo $data['nama_kriteria']. "(".$data['kode_kriteria'].")"; ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        </div>
                                        <button type="button" class="btn btn-success btn-proses">Proses</button>
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
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/select2/select2.full.min.js"></script>
    <script>
        $('.select2').select2();
        var id_kriteria = [];
        $('.idk').change(function(e){
            if ($(this).is(':checked')) {
                id_kriteria.push($(this).val());
            }else{
                id_kriteria.pop($(this).val());
            }
        });

        $('.btn-proses').click(function(){
            var data  = id_kriteria;
            window.location = "index.php?p=hasil_simulasi&data=" + data;
        })
    </script>

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
