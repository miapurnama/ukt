<?php 
error_reporting(0); 
$pesan = $con->query("SELECT * FROM notifikasi WHERE id_mahasiswa=" .$_SESSION['id_mahasiswa']. " AND status='Belum'");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UKT | User</title>

    <link href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <link href="assets/dist/css/timeline.css" rel="stylesheet">

    <link href="assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">



    <link href="assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


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
                        </i><?php echo $_SESSION['nama_mahasiswa']; ?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="pemroses/logout.php"> Logout</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <!-- <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?p=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <?php if ($_SESSION['jalur_pendaftaran'] == 'Non Mandiri'): ?>
                            <li>
                                <a href="index.php?p=datamahasiswa"><i class="fa fa-user"></i> Data Mahasiswa</a>
                            </li>
                        <?php endif ?>
                        <li>
                            <a href="index.php?p=hasilakhir"><i class="fa fa-check-square"></i> Kelompok UKT</a>
                        </li>
                        <?php if ($_SESSION['jalur_pendaftaran'] == 'Non Mandiri'): ?>
                            <li>
                                <a href="index.php?p=notifikasi"><i class="fa fa-envelope"></i>Notifikasi <?php if($pesan->num_rows>0){echo "(" .$pesan->num_rows. ")";} ?></a>
                            </li>
                        <?php endif ?>
                    </ul>

                </div>

            </div> -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?p=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                       
                            <li>
                                <a href="index.php?p=datamahasiswa"><i class="fa fa-user"></i> Data Mahasiswa</a>
                            </li>
                      
                        <li>
                            <a href="index.php?p=hasilakhir"><i class="fa fa-check-square"></i> Kelompok UKT</a>
                        </li>
                       
                            <li>
                                <a href="index.php?p=notifikasi"><i class="fa fa-envelope"></i>Notifikasi </a>
                            </li>
                    </ul>

                </div>

            </div>

        </nav>

       <!-- ISI -->

        <?php
            // $page = ( isset($_GET['p']) ) ? $_GET['p'] : 'dashboard'; // operator ternary. jika kondisi true page diisi dg halaman aktif, jika false maka page aktif'y dahboard. ? true : false
               if(isset($_GET['p']))
               {
                   $page = $_GET['p'];
               }
               else
               {
                   $page = 'dashboard';
               }
        include 'view/page/'.$page.'.php';
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
    <script type="text/javascript" src="assets/sweetalert2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    <script>
        function cek_urut(a){
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#tampilkan'+a).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp"+a).change(function(){
                readURL(this);
            });
        };
        
    </script>

    <script type="text/javascript">
        $( "#btn-reset" ).click(function() {
          $('.gambar-upload').attr('src', "#");
        });
    </script>
</body>
</body>

</html>
