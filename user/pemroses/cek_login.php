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
	session_start();
	require_once "koneksi.php";
	$username = $_REQUEST['username'];
	$password = md5($_REQUEST['password']);

	// query untuk mendapatkan record dari username
	$query = "SELECT * FROM mahasiswa WHERE username = '" .$username. "'";
	$hasil = $con->query($query);
	$data = $hasil->fetch_assoc();

	// cek kesesuaian password
	if ($password == $data['password']){
	    // menyimpan username dan level ke dalam session
	    session_regenerate_id();
	    $_SESSION['id_mahasiswa'] = $data['id_mahasiswa'];
	    $_SESSION['nama_mahasiswa'] = $data['nama_mahasiswa'];
	    $_SESSION['jalur_pendaftaran'] = $data['jalur_pendaftaran'];
	    ?>
	    <script>
	    	swal('Login berhasil','Selamat! Login berhasil user','success');
	    	setTimeout(function(){
    			location.href ='../index.php?p=dashboard';
	    	},2000);
	    </script>
		<?php
	}
	else{
	?>
		<script>
	    	swal('Gagal Login','Username tidak ditemukan, silakan mendaftar','error');
	    	setTimeout(function(){
    			location.href ='../login.php';
	    	})
	    </script>
	<?php
	}
	?>