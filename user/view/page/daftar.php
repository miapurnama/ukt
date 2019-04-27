<?php session_start(); error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Penentuan Kelompok UKT</title>

    <link href="../../assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../../assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <link href="../../../assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="../../assets//bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Selamat Datang</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="../../pemroses/daftar.php" method="post" enctype="multipart/form-data" id="form_daftar">
                                <div class="form-group">
                                    <label>Nama Mahasiswa</label>
                                    <input type="text" name="nama_mahasiswa" class="form-control" placeholder="Masukkan Nama Mahasiswa" required>
                                </div>
                                <div class="form-group">
                                    <label>No Peserta</label>
                                    <input type="text" name="no_peserta" class="form-control" placeholder="Masukkan No Peserta" required>
                                </div>
                                <div class="form-group">
                                    <label>Jalur Pendaftaran</label>
                                    <select name="jalur_pendaftaran" class="form-control" required="required">
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="Non Mandiri">Non Mandiri</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukkan E-mail" required>  
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="username" name="username" class="form-control" placeholder="Masukkan Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control" placeholder="Masukkan Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input name="password2" type="password" class="form-control" placeholder="Konfirmasi Password" required>
                                </div>
                                <button type="button" name="daftar" class="btn btn-success btn-daftar">DAFTAR</button>
                                <button type="reset" class="btn btn-danger">Reset</button></right>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                       
 <!-- jQuery -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../../assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../../assets/dist/js/sb-admin-2.js"></script>

<script src="../../assets/sweetalert2.min.js"></script>
<script>
    $('.btn-daftar').click(function(e){
        swal({
            title : 'Kamu yakin?',
            text : 'Kamu akan mendaftar akun dengan data ini',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Mendaftar'
        }).then((result) => {
            if(result.value){
                var password = $('[name="password"]').val();
                var password2 = $('[name="password2"]').val();
                if(password == password2){
                    $('form#form_daftar').submit();
                }else{
                    swal('Peringatan','Password anda tidak cocok, periksa kembali','error');
                }
            }
        })
    })
</script>
</body>

</html>
