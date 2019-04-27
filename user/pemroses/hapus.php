<?php
include('koneksi.php');
$r	= $_GET['id_mahasiswa'];


mysql_query("DELETE FROM mahasiswa where id_mahasiswa =$r ");


?>
<script>
                alert('Data berhasil dihapus');
                window.location='../index.php?p=daftarpeserta';
        </script>
        <?php
?>

