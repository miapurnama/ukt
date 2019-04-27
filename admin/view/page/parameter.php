<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Parameter</h1>
        </div>

    </div>
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Parameter
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body table-responsive">
                            <?php
                            //include "../../pemroses/koneksi.php";
                            $sql = mysqli_query($con, "SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
                            ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Nama Kriteria</td>
                                        <td>Kode Kriteria</td>
                                        <td colspan="2" style="text-align: center;">Opsi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    while($row = mysqli_fetch_assoc($sql)){
                                        $no++;
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['nama_kriteria']; ?></td>
                                        <td><?php echo $row['kode_kriteria']; ?></td>
                                        <td style="text-align: center;"><a href="?p=inputparameter&kode_kriteria=<?php echo $row['kode_kriteria']; ?>" class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Tambah Parameter"></a></td>
                                        <td style="text-align: center;"><a href="?p=lihatparameter&kode_kriteria=<?php echo $row['kode_kriteria']; ?>" class="glyphicon glyphicon-eye-open" data-toggle="tooltip" title="Lihat Parameter"></a></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>