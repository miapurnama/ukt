<!DOCTYPE html><!--DOCTYPE adalah HTML 5-->
<html lang="en">
<?php //error_reporting(0); ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UKT | Admin</title>

    <link href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <link href="assets/dist/css/timeline.css" rel="stylesheet">

    <link href="assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/select2/select2.min.css">
    <!-- DataTables CSS -->
    <link href="assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">



    <link href="assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        a.disabled {
            pointer-events: none;
        }
    </style>
</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?p=dashboard">Aplikasi Penentuan Kelompok UKT</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">

                <!-- Menu logout -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" style="width:auto"> <?php echo $_SESSION['nama_admin']; ?> </i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="pemroses/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                        <li><a href="index.php?p=profil"><i class="fa fa-user fa-fw"></i>Profil</a> 
                        </li>
                    </ul>
                </li>

            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?p=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php
                        //include "../../pemroses/koneksi.php";
                        $sql = $con->query("SELECT COUNT(kode_kriteria) AS kk FROM kriteria"); //$sql ambil data dari (hubunkan ke koneksi, pilih data hitung kode kriteria pada tiap (AS) KK dari tabel kriteria)
                        $row = $sql->num_rows; //$row berapa banyak data yang terpengaruh saat $sql
                        $kk = $row[0]; //$kk = data yang terrpengaruh 0
                        if($kk!=10){ // jika $kk tidak sama dengan 11, maka tampilkan koding dibawah
                        ?>
                         
                         <li>
                            <a href="index.php?p=inputkriteria"><i class="fa fa-plus fa-fw"></i> Input Kriteria</a>
                        </li>
                         <?php
                        }
                        ?>
                        <li>
                            <a href="index.php?p=kriteria"><i class="fa fa-bars fa-fw"></i> Kriteria</a>
                        </li>
                        <li>
                            <a href="index.php?p=parameter"><i class="fa fa-file-text"></i> parameter</a>
                        </li>
                      <li>
                            <a href="index.php?p=verifikator"><i class="fa fa-user"> Verifikator</i></a>
                        </li>
                        <li>
                            <a href="index.php?p=datamahasiswa"><i class="fa fa-list-alt fa-fw"></i> Data Mahasiswa</a>
                        </li>
                        <li>
                            <a href="index.php?p=hasilakhir"><i class="fa fa-check-square fa-fw"></i> Kelompok UKT</a>
                        </li>
                        <li>
                            <a href="index.php?p=formhasil"><i class="fa fa-check-square fa-fw"></i> Uji Akhir</a>
                        </li>
                        <!-- <li>
                            <a href="index.php?p=simulasi"><i class="fa fa-check-square fa-fw"></i> Simulasi Topsis</a>
                        </li> -->
                    </ul>

                </div>

            </div>

        </nav>

       <!-- ISI -->

        <?php
            if(isset($_GET['p']))//apakah $_get p pernah dibuat, jika sudah dibuat maka
            {
                $page = $_GET['p']; //$page = p
            }
            else
            {
                $page = 'dashboard'; //jika tidak maka tampilkan halaman dashboard
            }
        include 'view/page/'.$page.'.php'; // jika kondisi diatas jalan maka masukkan file kedokumen ini (view/page/p.php)
        ?>

    </div>

    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="assets/bower_components/raphael/raphael-min.js"></script>
     <!-- DataTables JavaScript -->
    <script src="assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>    

    <script src="assets/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="../../user/assets/sweetalert2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            'paging' : true,
            'lengthChange': false,
            'searching' : true,
            'ordering' : true,
            'info' : true,
            'autoWidth' : false,
            'responsive' : true
            

        });
    });
    </script>
</body>

</html>
