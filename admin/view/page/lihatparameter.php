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
                            $kode_kriteria = $_GET['kode_kriteria'];
                            $sql = mysqli_query($con, "SELECT * FROM parameter WHERE kode_kriteria='" .$kode_kriteria. "' ORDER BY skor DESC");
                            ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td style="text-align: center;">Kode Kriteria</td>
                                        <td style="text-align: center;">Nama/Interval Parameter</td>
                                        <td>Skor</td>
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
                                        <td><?php echo $row['kode_kriteria']; ?></td>
                                        <td><?php echo $row['interval_parameter']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['skor']; ?></td>
                                        <td style="text-align: center;"><a href="?p=editparameter&id_parameter=<?php echo $row['id_parameter']; ?>" class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Parameter"></a></td>
                                        <td style="text-align: center;"><a href="pemroses/hapusparameter.php?id_parameter=<?php echo $row['id_parameter']; ?>" onclick="return confirm('Hapus Data')" class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Hapus Parameter" ></a></td>
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