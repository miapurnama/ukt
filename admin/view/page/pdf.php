<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {border-collapse: collapse; table-layout: fixed; width: 630px;} 
		table td {word-wrap: break-word; width: 20%;}
	</style>
</head>
<body>
<h1 style = "text-align:center;"> Kelompok UKT</h1>
 <table border="1" width="100%">

        <tr>
            <th>Nama Mahasiswa</th>
            <th>Kelompok UKT</th>
        </tr>

<?php
include "../../pemroses/koneksi.php";
$ukt = "SELECT * FROM kelompok_ukt ORDER BY id_mahasiswa ASC";
$sql = mysqli_query($con, $ukt);
$row = mysqli_num_rows($sql);
	if($row>0) {
		while ($data = mysqli_fetch_assoc($sql)) {
			echo "<tr>";
			echo "<td>" .$data['nama_mahasiswa']. "</td>";
			echo "<td>" .$data['kelompok']. "</td>";
			echo "</tr>";
		}
	}
	?> 
</table>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

require_once('../../html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('p','A4','en');
$pdf->WriteHTML($html);
$pdf->Output ('Data ukt.pdf','D');
?>
