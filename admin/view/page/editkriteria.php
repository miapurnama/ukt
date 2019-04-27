<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit</h1>
        </div>

    </div>
    
<?php
//include '../../pemroses/koneksi.php';
if(isset($_GET['id']))  //jika dapatkan id dr url
{
 $id_kriteria=$_GET['id']; //$id kriteriaa=id yg ditangkap
}
$sql = "SELECT * FROM kriteria where id_kriteria =".$_GET['id_kriteria']; //select, ambil semua data dikriteria dimana id kriteria = id yg ditangkap

$query=$con->query($sql);
$r = $query->fetch_assoc();

?>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit data 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="pemroses/updatekriteria.php?id_kriteria=<?php echo $r['id_kriteria']?>" method="post" enctype="multipart/form-data"> 
                                        <div class="form-group">
                                            <label>Nama Kriteria</label>
                                            <input class="form-control" type="text" name="nama_kriteria" value="<?php echo $r['nama_kriteria'] ?>" id="input" placeholder="Masukkan Nama Kriteria" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Kriteria</label>
                                            <input class="form-control" type="text" name="kode_kriteria" value="<?php echo $r['kode_kriteria'] ?>" id="input" pattern="[A-Z]+[0-9]+[0-9]" placeholder="Contoh: K01,K02,K03,...dst" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Bobot Kriteria</label>
                                            <input class="form-control" type="text" name="bobot_kriteria" value="<?php echo $r['bobot_kriteria'] ?>" id="input" placeholder="Masukkan Bobot Kriteria" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="kategori" class="form-control" required>
                                                <option></option>
                                                <option value="cost" <?php if($r['kategori']=='cost'){echo 'selected';} ?>>Cost</option>
                                                <option value="benefit" <?php if($r['kategori']=='benefit'){echo 'selected';} ?>>Benefit</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="index.php?p=dashboard" class="btn btn-default">Kembali</a>
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
<!-- jQuery -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/dist/js/sb-admin-2.js"></script>

</body>

</html>
 


