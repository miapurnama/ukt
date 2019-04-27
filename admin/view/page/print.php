<?php
include "../../pemroses/koneksi.php";
$ukt = mysqli_query($con, "SELECT * FROM kelompok_ukt ORDER BY id_mahasiswa ASC");
?>
<!DOCTYPE html>
<html lang="en">
<?php //error_reporting(0); ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UKT | Admin</title>

    <link href="../../assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <link href="../../assets/dist/css/timeline.css" rel="stylesheet">

    <link href="../../assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../../assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">



    <link href="../../assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body onload="window.print()">

    <div class="container">
<div id="content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="data">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekap Kelompok UKT<br/>
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Kelompok UKT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=0;
                                        while($r = mysqli_fetch_assoc($ukt)){
                                            $no++;
                                        ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $r['nama_mahasiswa'];?></td>
                                            <td><?php echo $r['kelompok'];?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>                            
                                </table>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        </center>
        </div>
    </div>
</div>
</div>

    <script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="../../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../../assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="../../assets/bower_components/raphael/raphael-min.js"></script>
     <!-- DataTables JavaScript -->
    <script src="../../assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>    

    <script src="../../assets/dist/js/sb-admin-2.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>

</html>
