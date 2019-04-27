<?php
	include 'koneksi.php';

	$id_parameter = $_REQUEST['id_parameter'];
	$kode_kriteria = $_REQUEST['kode_kriteria'];
	$interval = $_REQUEST['interval'];
	$skor = $_REQUEST['skor'];

    $input = "UPDATE parameter SET kode_kriteria='" .$kode_kriteria. "', interval_parameter='" .$interval. "', skor='" .$skor. "' WHERE id_parameter='" .$id_parameter. "'";
    $query = mysqli_query($con,$input);
    if(mysqli_affected_rows($con)>0){
	?>
	<!-- ini adalah cara memotong script php -->
    <script> //akan muncul jika data berhasil diinputkan
    	alert('Parameter telah diubah');
    	window.location='../index.php?p=parameter';
    </script>";
	<?php
	}
?>