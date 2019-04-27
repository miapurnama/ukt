<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Kriteria</h1>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="data">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Kriteria
                        </div>
                        <!-- /.panel-heading -->
                        <center>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th>Nama Kriteria</th>
                                        <th>Kode Kriteria</th>
                                        <th>Bobot Kriteria</th>
                                        <th>Kategori</th>
                                        <th colspan="2" style="text-align: center;">Aksi</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //include "../../pemroses/koneksi.php";
                                    $sql = "SELECT * FROM kriteria ORDER BY kode_kriteria ASC"; //ASC mengurutkn datadr yg trkecil kebesar
                                    $query = $con->query($sql);
                                    while($row = $query->fetch_assoc()) //mulai looping
                                    {                                       
                                    ?>
                                    <tr>
                                        <td><?php echo $row['nama_kriteria']?></td>
                                        <td><?php echo $row['kode_kriteria']?></td>
                                        <td><?php echo $row['bobot_kriteria']?></td>
                                        <td><?php echo $row['kategori'] ?></td>
                                        <td><a href="?p=editkriteria&id_kriteria=<?php echo $row['id_kriteria'] ?>">Edit</a></td>
                                        <td><a href="pemroses/hapuskriteria.php?id_kriteria=<?php echo $row['id_kriteria'] ?>" " onclick="return confirm('Hapus Data?')">Hapus</a></td>
                                    </td>
                                    </tr>
                                    <?php
                                    } //tutup looping
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        </center>
                        <ul>
                            <li>Cost (Biaya) semakin kecil nilainya maka semakin baik</li>
                            <li>Benefit (Keuntungan) semakin besar nilainya maka semakin baik</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </center>
        </div>
    </div>
</div>
           