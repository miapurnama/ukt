<?php
$sql = mysqli_query($con, "SELECT * FROM notifikasi WHERE id_mahasiswa=" .$_SESSION['id_mahasiswa']. "");
if($sql){
    $ubah = mysqli_query($con, "UPDATE notifikasi SET status='Sudah'");
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <center><h1 class="page-header">Selamat Datang 
                <?php
                    echo $_SESSION['nama_mahasiswa'];
                ?></h1></center>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            
                <div class="row">
                <div class="col-lg-12">
                <div padding left = "12px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           PESAN DARI ADMIN
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Pesan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($row = mysqli_fetch_assoc($sql)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['pesan']; ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
</div>