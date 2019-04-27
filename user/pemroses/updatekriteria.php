<?php 
    include('koneksi.php');
            
            $nama_kriteria = $_POST['nama_kriteria'];
            $subkriteria = $_POST['subkriteria'];
            $bobot = $_POST['bobot'];
            $id_kriteria=$_GET['id_kriteria'];
    echo "$id_kriteria";
 
    $sql="UPDATE kriteria SET nama_kriteria='$nama_kriteria', 
                                    subkriteria='$subkriteria', 
                                    bobot='$bobot'
                                    WHERE id_kriteria='$id_kriteria'";

 $query=mysql_query($sql);

$query;
?>
 <script>
                alert('Data berhasil diubah');
                window.location='../index.php?p=kriteria';
        </script>

        <?php

?>