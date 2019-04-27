<?php
include('koneksi.php');
$k	= $_GET['id_kriteria'];


mysql_query("DELETE FROM kriteria where id_kriteria =$k ");


?>
<script>
                alert('Data berhasil dihapus');
                window.location='../index.php?p=kriteria';
        </script>
        <?php
?>

