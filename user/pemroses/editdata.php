<?php  
include('koneksi.php');
$sql = $con->query("SELECT * FROM parameter WHERE kode_kriteria = '" .$_REQUEST['kode_kriteria']. "'");
$data = [];
while($row = $sql->fetch_assoc()){
	array_push($data, $row);
}
echo json_encode($data);
?>