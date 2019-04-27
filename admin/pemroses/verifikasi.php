<?php
	include 'koneksi.php';
	$id_mahasiswa = $_GET['id_mahasiswa'];

    $input = "UPDATE mahasiswa SET verifikasi='Ya' WHERE id_mahasiswa=" .$id_mahasiswa. "";
    $query = mysqli_query($con,$input);
    if(mysqli_affected_rows($con)>0){
	?>
	<!-- ini adalah cara memotong script php -->
    <script> //akan muncul jika data berhasil diinputkan
    	alert('Verifikasi berhasil');
    	window.location='../index.php?p=datamahasiswa';
    </script>";
	<?php
	}
?>