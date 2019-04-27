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

    <script src="../assets/sweetalert2.min.js"></script>
</body>
</html>
<?php
include 'koneksi.php';
session_start();
$nama_mahasiswa = $_POST['nama_mahasiswa'];
$no_peserta = $_POST['no_peserta'];
$jalur_pendaftaran = $_POST['jalur_pendaftaran'];
$email_user = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$con->autocommit(false);
$con->query("INSERT INTO mahasiswa(nama_mahasiswa,no_peserta,jalur_pendaftaran,email,username,password,verifikasi)VALUES('" .$nama_mahasiswa. "','" .$no_peserta. "','".$jalur_pendaftaran."','" .$email_user. "','" .$username. "','" .$password. "','Tidak')");
$id_mahasiswa = $con->insert_id;
if ($jalur_pendaftaran == "Non Mandiri") {
    $data = $con->query("SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
    while($row = $data->fetch_assoc()){
        $con->query("INSERT INTO lampiran_mahasiswa(id_mahasiswa,nama_mahasiswa,kode_kriteria,interval_parameter) VALUES(". $id_mahasiswa.",'" .$nama_mahasiswa. "','" .$row['kode_kriteria']. "',5)");
    }
}else{
    $data = $con->query("INSERT INTO kelompok_ukt(id_mahasiswa,nama_mahasiswa,jalur_pendaftaran,kelompok,nilai_total) VALUES(".$id_mahasiswa.",'".$nama_mahasiswa."','".$jalur_pendaftaran."',5,0)");
}
if($con->commit()){
	echo "<script>
	swal('Registrasi sukses!','Kamu dapat login dengan akun ini','success');
    	setTimeout(function(){
			location.href = '../login.php';		
    	},2000)
	</script>";
}else{
	echo "<script>
	swal('Registrasi gagal!','Periksa kembali data anda','error');
    	setTimeout(function(){
			location.href = '../login.php';		
    	},2000)
	</script>";
}
?>