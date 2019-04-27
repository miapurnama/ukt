<?php
//include "../../pemroses/koneksi.php";
$sql = mysqli_query($con, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa ASC");
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Mahasiswa</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="data">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Mahasiswa
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>No Peserta</th>
                                    <th>Jalur Pendaftaran</th>
                                    <th>Verifikasi</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while($row = mysqli_fetch_assoc($sql)) //mulai looping
                                {
                                    $i++;                            
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['nama_mahasiswa']?></td>
                                    <td><?php echo $row['no_peserta']?></td>
                                    <td><?php echo $row['jalur_pendaftaran'] ?></td>
                                    <td><?php if($row['verifikasi']=='Ya'){echo 'Sudah Diverifikasi';}else{ echo 'Belum Diverifikasi'; } ?></td>
                                    <td><a href="index.php?p=lihatdata&id_mahasiswa=<?php echo $row['id_mahasiswa'] ?>">Lihat</a>&nbsp;&nbsp;
                                    <a href="pemroses/hapusdata.php?id_mahasiswa=<?php echo $row['id_mahasiswa'] ?>" onclick="return confirm('Hapus Data?')">Hapus</a></td>
                                </tr>
                                <?php

                                } //tutup looping
                                ?>
                            </tbody>
                        </table>
                            </div>
                    </div>
                </center>
        </div>
    </div>
</div>

