<?php
include "koneksi.php";
if(isset($_POST['kirim'])){
	$id_mahasiswa = $_POST['id_mahasiswa'];
	$pesan = $_POST['isi'];

	$sql = mysqli_query($con, "INSERT INTO notifikasi(id_mahasiswa,pesan,status) VALUES(" .$id_mahasiswa. ",'" .$pesan. "','Belum')");
	if($sql){
?>
	<script>
	    alert('Pesan Telah Dikirim');
    	window.location='../index.php?p=dashboard';
	</script>";
<?php
	}else{
		var_dump($sql);
	}
}
?>