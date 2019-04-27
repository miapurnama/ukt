<?php
$sql = $con->query("SELECT GROUP_CONCAT(id_mahasiswa) AS id FROM mahasiswa");
$row = $sql->fetch_assoc();
// echo $row['id'];
$inp = $con->query("UPDATE kelompok_ukt SET jalur_pendaftaran = 'Non Mandiri' WHERE id_mahasiswa IN(" .$row['id']. ")");
$mhs = $con->query("UPDATE mahasiswa SET jalur_pendaftaran = 'Non Mandiri' WHERE id_mahasiswa IN(".$row['id'].")");
if($mhs){
	echo "sukses";
}else{
	echo "gagal";
}
?>