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
$id = $_POST['id'];
$id_mahasiswa = $_POST['id_mahasiswa'];
$nama_parameter = $_POST['nama_parameter'];
if ($_POST['gaji'] != null) {

	$sql = $con->query("UPDATE lampiran_mahasiswa SET nama_parameter = '".$nama_parameter."' WHERE id = '".$id."'");
	
	$gaji_ayah = $con->query("SELECT nama_parameter FROM lampiran_mahasiswa WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K01'");
	$gaji_ayah_akhir = $gaji_ayah->fetch_assoc();
	$gaji_ibu = $con->query("SELECT nama_parameter FROM lampiran_mahasiswa WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K02'");
	$gaji_ibu_akhir = $gaji_ibu->fetch_assoc();

	if ($gaji_ibu_akhir['nama_parameter'] == '') {
		$penghasilan_ibu = 0;
	} else {
		$penghasilan_ibu = $gaji_ibu_akhir['nama_parameter'];
	}

	if ($gaji_ayah_akhir['nama_parameter'] == '') {
		$penghasilan_ayah = 0;
	} else {
		$penghasilan_ayah = $gaji_ayah_akhir['nama_parameter'];
	}

	$total_gaji = $penghasilan_ayah + $penghasilan_ibu;

	if ($total_gaji <= 500000) {
		$skor = 1;
	} else if ($total_gaji <= 1000000) {
		$skor = 2;
	}  else if ($total_gaji <= 2000000) {
		$skor = 3;
	}  else if ($total_gaji <= 3999999) {
		$skor = 4;
	} else {
		$skor = 5;
	}

	$folder = "../../upload/";
	$kode_kriteria = $_POST['kode_kriteria'];
	$nama_file = basename($_FILES['file_img']['name']);
	$sql;

	if($nama_file != ''){
		if(move_uploaded_file($_FILES['file_img']['tmp_name'], $folder.$nama_file)){
			
			if ($_POST['kode_kriteria'] == 'K01') {
				$sql = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."', nama_file = '".$nama_file."', nama_parameter = '".$nama_parameter."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K01'");
				$sql_2 = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K02'");
			} else {
				$sql = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."', nama_file = '".$nama_file."', nama_parameter = '".$nama_parameter."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K02'");
				$sql_2 = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K01'");
			}
		}
	}else{
		if ($_POST['kode_kriteria'] == 'K01') {
			$sql = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."', nama_parameter = '".$nama_parameter."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K01'");
			$sql_2 = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K02'");
		} else {
			$sql = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."', nama_parameter = '".$nama_parameter."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K02'");
			$sql_2 = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '".$skor."' WHERE id_mahasiswa = '".$id_mahasiswa."' AND kode_kriteria = 'K01'");
		}
	}

} else {
	$skor = $_POST['skor'];

	$folder = "../../upload/";
	$kode_kriteria = $_POST['kode_kriteria'];
	$nama_file = basename($_FILES['file_img']['name']);
	$sql;

	if($nama_file != ''){
		if(move_uploaded_file($_FILES['file_img']['tmp_name'], $folder.$nama_file)){
			$sql = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = '" .$skor. "', nama_file = '" .$nama_file. "', nama_parameter = '" .$nama_parameter. "' WHERE id = '" .$id. "'");
		}
	}else{
		$sql = $con->query("UPDATE lampiran_mahasiswa SET interval_parameter = " .$skor. ", nama_parameter = '" .$nama_parameter. "' WHERE id = " .$id. "");
	}
}

// print_r($_POST);


if($sql){
	echo "<script>
	swal('Sukses!','Data telah diubah','success');
    	setTimeout(function(){
			location.href = '../index.php?p=datamahasiswa';		
    	},2000)
	</script>";
}else{
	echo "<script>
	swal('Gagal!','Data tidak dapat diubah','error');
    	setTimeout(function(){
			location.href = '../index.php?p=datamahasiswa';		
    	},2000)
	</script>";
}
?>