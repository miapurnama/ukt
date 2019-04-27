<?php
	include 'koneksi.php';

	$id_parameter = $_REQUEST['id_parameter'];
	
    $input = "DELETE FROM parameter WHERE id_parameter='" .$id_parameter. "'";
    $query = mysqli_query($con,$input);

    if(mysqli_affected_rows($con)>0){
	?>
	<!-- ini adalah cara memotong script php -->
    <script> //akan muncul jika data berhasil diinputkan
    	alert('Parameter telah dihapus');
    	window.location='../index.php?p=parameter';
    </script>";
	<?php
	}
?>