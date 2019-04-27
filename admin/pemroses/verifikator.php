<?php 
include 'koneksi.php';

$nama = $_REQUEST['nama'];
$nip = $_REQUEST['nip'];
// $username = $_REQUEST['username'];
$password = md5($_REQUEST['password']);

$input = "INSERT INTO verifikator(nama,nip,password) VALUES ('" .$nama. "','" .$nip."','" .$password."')";
$query = mysqli_query($con,$input);
if (mysqli_affected_rows($con)>0) {

?>
	<script>
		alert ('Data Berhasil disimpan');
		window.location='../index.php?p=verifikator';
	</script>
<?php 
}
 ?>

