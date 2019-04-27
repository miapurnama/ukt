<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <link href="../assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="../assets//bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/sb-admin-2.js"></script>

    <script src="../../user/assets/sweetalert2.min.js"></script>
</body>
</html>
<?php
	include 'koneksi.php';
	
	$nama_kriteria = $_REQUEST['nama_kriteria'];
	$kode_kriteria = $_REQUEST['kode_kriteria'];
	$bobot_kriteria = $_REQUEST['bobot_kriteria'];
	$kategori = $_REQUEST['kategori'];
    $con->autocommit(false);
	$cek = "SELECT * FROM kriteria WHERE kode_kriteria='" .$kode_kriteria. "'";
	// $cek2 = "SELECT * FROM kriteria WHERE ranking_kriteria=" .$rangking_kriteria. "";
	$query_cek = $con->query($cek);
	// $query_cek2 = $con->query($cek2);

    $sql = $con->query("SELECT DISTINCT id_mahasiswa, nama_mahasiswa FROM lampiran_mahasiswa");
    while($row = $sql->fetch_assoc()){
        $data[] = $row;
    }

	// if(($query_cek->num_rows>0)||($query_cek2->num_rows>0)){
    if($query_cek->num_rows>0){
?>
	<script> //akan muncul jika data berhasil diinputkan
    	swal('Peringatan','Kode Kriteria Sudah Digunakan','error');
    	setTimeout(function(){
    		location='../index.php?p=inputkriteria';
    	},2000)
    </script>";
   <?php
	}else{
		// $input = "INSERT INTO kriteria(nama_kriteria,kode_kriteria,ranking_kriteria,kategori)VALUES('" .$nama_kriteria. "','" .$kode_kriteria. "','" .$rangking_kriteria. "','".$kategori."')";
        $input = "INSERT INTO kriteria(nama_kriteria,kode_kriteria,kategori)VALUES('" .$nama_kriteria. "','" .$kode_kriteria. "','".$kategori."')";
    	$query = $con->query($input);
        foreach ($data as $key => $value) {
            $column = "";
            $values = "";
            foreach($value as $k => $v){
                $column .= $k. ",";
                $values .= "'".$v. "',";
            }
            $column = substr($column,0,-1);
            $values = substr($values,0,-1);
            $save = $con->query("INSERT INTO lampiran_mahasiswa({$column},kode_kriteria,interval_parameter) VALUES({$values},'{$kode_kriteria}','5')");
        }
    	if($con->commit()){
		?>
		<!-- ini adalah cara memotong script php -->
    	<script> //akan muncul jika data berhasil diinputkan
    		swal('Berhasil','Data berhasil disimpan','success');
    		setTimeout(function(){
    			location.href = '../index.php?p=kriteria';
    		},2000)
    	</script>";
		<?php
		}
	}
?>