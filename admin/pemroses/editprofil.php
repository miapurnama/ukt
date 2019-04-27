<?php 
include('koneksi.php');
$id_admin = $_GET['id_admin'];
$nama_admin = $_GET['nama_admin'];
$username = $_GET['username'];
$password = $_GET['password'];

$sql = "UPDATE admin SET nama_admin= '".$nama_admin."', username= '".$username."', password= '".$password."' WHERE id_admin = '".$id_admin."'";
$query = mysqli_query($con,$sql);
if(mysqli_affected_rows($con)>0){ 
?>
<script>
	alert ('data berhasil di ubah');
	window.location='../index.php?p=profil';
</script>";
<?php 
}

 ?>