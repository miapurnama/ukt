<?php 
include 'koneksi.php';
$h = $_GET['id_verifikator'];
mysqli_query($con, "DELETE FROM verifikator WHERE id_verifikator='".$h."' ");
if (mysqli_affected_rows($con)>0) {

?>

<script>
	alert ('Data Telah Dihapus');
	window.location='../index.php?p=verifikator';

</script>
<?php 
}
 ?>