<?php
include('koneksi.php');
$id_mahasiswa = $_GET['id_mahasiswa'];
mysqli_query($con,"DELETE FROM mahasiswa where id_mahasiswa=" .$id_mahasiswa."");
mysqli_query($con,"DELETE FROM kelompok_ukt WHERE id_mahasiswa=" .$id_mahasiswa. "");
$cek = mysqli_query($con, "SELECT * FROM lampiran_mahasiswa WHERE id_mahasiswa=" .$id_mahasiswa. "");
$result = mysqli_num_rows($cek);
$jumlah_lampiran = $result;
$item = array();
if($jumlah_lampiran>0){
	$dir = "../upload/";
	$dirHandle = opendir($dir);
	while($row = mysqli_fetch_assoc($cek)){
		$item[] = $row['nama_file'];
	}
	for($i=0;$i<$jumlah_lampiran;$i++){
		while($file=readdir($dirHandle)){
			if($file==$item[$i]){
				unlink($dir.'/'.$item[$i]);
			}
		}
		mysqli_query($con,"DELETE FROM lampiran_mahasiswa WHERE id_mahasiswa=" .$id_mahasiswa. "");
	}
}
?>
<script>
    alert('Data berhasil dihapus');
    window.location='../index.php?p=datamahasiswa';
</script>