<?php
include 'koneksi.php';

$nama_mahasiswa = $_POST['nama_mahasiswa'];
$id_mahasiswa = $_POST['id_mahasiswa'];
$id_parameter = implode(',', $_POST['skor']);
$cek_interval = mysqli_query($con, "SELECT * FROM parameter WHERE id_parameter IN(" .$id_parameter. ") ORDER BY kode_kriteria ASC");
$bobot = array();
$keterangan = array();
while($rb = mysqli_fetch_assoc($cek_interval)){
    $bobot[] = $rb['skor'];
    $keterangan[] = $rb['interval_parameter'];
}

$sql = mysqli_query($con,"UPDATE mahasiswa SET K01=" .$bobot[0]. ",K02=" .$bobot[1]. ",K03=" .$bobot[2]. ",K04=" .$bobot[3]. ",K05=" .$bobot[4]. ",K06=" .$bobot[5]. ",K07=" .$bobot[6]. ",K08=" .$bobot[7]. ",K09=" .$bobot[8]. ",K10=" .$bobot[9]. " WHERE id_mahasiswa=".$id_mahasiswa."");

$folder = "../../upload/";
$nama_file = '';
$kode_kriteria ='';
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
	}
}
for($i=0;$i<count($_FILES['file_img']['name']);$i++){
	$nama_file = basename($_FILES['file_img']['name'][$i]);
	$kode_kriteria = $_POST['kode_kriteria'][$i];
	$interval_parameter = $keterangan[$i];
	if($nama_file != ''){
		if(move_uploaded_file($_FILES['file_img']['tmp_name'][$i], $folder.$nama_file)){
			$sql_lampiran = mysqli_query($con,"UPDATE lampiran_mahasiswa SET nama_file='" .$nama_file. "', interval_parameter='" .$interval_parameter. "' WHERE id_mahasiswa=" .$id_mahasiswa. " AND kode_kriteria='" .$kode_kriteria. "'");
		}
	}
}
header("Location: ../index.php?p=edit");
?>