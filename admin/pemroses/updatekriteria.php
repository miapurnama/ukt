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
    include('koneksi.php');
    $id_kriteria = $_GET['id_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $kode_kriteria = $_POST['kode_kriteria'];
    $bobot_kriteria = $_POST['bobot_kriteria']; 
    $kategori = $_POST['kategori'];
    $cek = "SELECT * FROM kriteria WHERE kode_kriteria='" .$kode_kriteria. "' AND id_kriteria != " .$id_kriteria. "";
    // $cek2 = "SELECT * FROM kriteria WHERE ranking_kriteria=" .$ranking_kriteria. "";
    $query_cek = mysqli_query($con,$cek);
    // $query_cek2 = mysqli_query($con,$cek2);
    // if((mysqli_num_rows($query_cek)>0)||(mysqli_num_rows($query_cek2)>0)){

  if(mysqli_num_rows($query_cek)>0){
?>
    <script> //akan muncul jika data berhasil diinputkan
        alert('Kode Kriteria Sudah Digunakan');
        window.location='../index.php?p=kriteria';
    </script>";
    <?php
}else{
    $sql = "UPDATE kriteria SET nama_kriteria='" .$nama_kriteria. "', kode_kriteria='" .$kode_kriteria. "', bobot_kriteria='" .$bobot_kriteria. "', kategori='".$kategori."' WHERE id_kriteria='" .$id_kriteria. "'";
    $query=$con->query($sql);
    //  $sql = "UPDATE kriteria SET nama_kriteria='" .$nama_kriteria. "', kode_kriteria='" .$kode_kriteria. "',  kategori='".$kategori."' WHERE id_kriteria='" .$id_kriteria. "'";
    // $query=$con->query($sql);
    if($query){
?>
    <script>
        swal('Berhasil','Data berhasil diubah','success');
        setTimeout(function(){
            location.href ='../index.php?p=kriteria';
        }, 2000)
    </script>
<?php
   // }
}
}
?>