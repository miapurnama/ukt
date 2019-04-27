<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <link href="../assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="../assets//bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/sb-admin-2.js"></script>

    <script src="../../user/assets/sweetalert2.min.js"></script>
</body>
</html>
<?php
include('koneksi.php');
$k	= $_GET['id_kriteria'];
$sql = $con->query("DELETE FROM kriteria where id_kriteria='" .$k."'");
if($sql){
?>
<script>
    swal('Berhasil','Data berhasil dihapus','success');
    setTimeout(function(){
    	location.href = '../index.php?p=kriteria';
    },2000)
</script>
<?php
}
?>

