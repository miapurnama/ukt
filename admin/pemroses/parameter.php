<?php
	include 'koneksi.php';
	
	$kode_kriteria = $_REQUEST['kode_kriteria'];
	$interval = $_REQUEST['interval'];
	$skor = $_REQUEST['skor'];

    $input = "INSERT INTO parameter(kode_kriteria,interval_parameter,skor)VALUES('" .$kode_kriteria. "','" .$interval. "'," .$skor. ")";
    $query = mysqli_query($con,$input);
    if(mysqli_affected_rows($con)>0){
	?>
	<!-- ini adalah cara memotong script php -->
    <script> //akan muncul jika data berhasil diinputkan
    	alert('Parameter telah ditambah');
    	window.location='../index.php?p=parameter';
    </script>";
	<?php
	}
?>