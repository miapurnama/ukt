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
	session_start();
	require_once "koneksi.php"; //require artinya kita butuh file koneksi.php
	$username = $_REQUEST['username']; //$username isi'y username yang diambil dari halaman login, name
	$password = md5($_REQUEST['password']);//md5 adalah encripsi data password
	// query untuk mendapatkan record dari username
	$query = "SELECT * FROM admin WHERE username = '" .$username. "'"; //$query pilih semua baris dari database admin, cari admn dengan username = username yg dimasukkan
	$hasil = $con->query($query); //$hasil, mysqli_query adalah ambil data dari (parameter'y ada 2, 1 koneksi ke database'y $con dan query'y mau apa (data apa yang kitamau ambil) $query)
	$data = $hasil->fetch_assoc(); //$data adalah ambil data (fetch) mahasiswa dari objek $hasil mengembalikan nilai assosiatif (nama field (baris) dlm tabel DB) (manggil data di database)
	
	// cek kesesuaian password
	if ($password == $data['password']){ //jika $password yang di inputkan sama dg data yang ada di database maka 
	    // menyimpan username dan level ke dalam session
	    $_SESSION['id_admin'] = $data['id_admin']; //variabel id admin= id admin di data,yg diambil dr dtbase
	    $_SESSION['nama_admin'] = $data['nama_admin']; //variabel nama admmin = nama admin yg diambil dr DB

	    ?>
	    <script>
	    	swal('Login berhasil','Selamat! Login berhasil user','success');
	    	setTimeout(function(){
    			location.href ='../index.php?p=dashboard';
	    	},2000);
	    </script>";
		<?php
	}
	else{
		?>
		<script>
	    	swal('Gagal Login','Username tidak ditemukan','error');
	    	setTimeout(function(){
    			location.href ='../login.php';
	    	})
	    </script>
	<?php
	}
	?>