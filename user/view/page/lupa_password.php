<?php
include "../../pemroses/koneksi.php";
if(isset($_POST['ubah'])){
    $pass1 = md5($_POST['pass1']);
    $pass2 = md5($_POST['pass2']);
    if($pass1!=$pass2){
?>
    <script> //akan muncul jika data berhasil diinputkan
        alert('Periksa Kembali Password Anda');
        window.location='lupa_password.php';
    </script>";
<?php
    }else{
        $sql = mysqli_query($con, "UPDATE mahasiswa SET password='" .$pass1. "' WHERE id_mahasiswa=" .$_POST['id_mahasiswa']. "");
        if($sql){
?>
    <script> //akan muncul jika data berhasil diinputkan
        alert('Password telah diubah');
        window.location='../../login.php';
    </script>";
<?php
        }
    }
}
?>
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
                    <div class="panel-heading">
                        Lupa Password?

                    </div>
                    <div class="panel-body">
                      <div class="row">
                                <div class="col-lg-12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Email : </label>
                                            <input name="email" type="email" class="form-control" value="<?php if(isset($_POST['cek'])){echo $_POST['email'];} ?>" required>
                                        </div>
                                        <button type="submit" name="cek" class="btn btn-success" <?php if(isset($_POST['cek'])){echo 'disabled';} ?>>Cek Password</button>
                                        <button type="reset" class="btn btn-danger">Reset</button></right>
                                    </form>
                                </div>
                            </div>
                    <?php
                    if(isset($_POST['cek'])){
                        $email = $_POST['email'];
                        $sql = mysqli_query($con, "SELECT id_mahasiswa,password FROM mahasiswa WHERE email='" .$email. "'");
                        if(mysqli_num_rows($sql)==0){
                    ?>
                    <script> //akan muncul jika data berhasil diinputkan
                        alert('Email Anda Salah');
                        window.location='../../login.php';
                    </script>";
                    <?php
                        }else{
                            $row = mysqli_fetch_assoc($sql);
                    ?>
                        <div class="row">
                                <div class="col-lg-12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_mahasiswa" value="<?php echo $row['id_mahasiswa']; ?>">
                                        <div class="form-group">
                                            <label>Password Baru : </label>
                                            <input name="pass1" type="password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password Baru : </label>
                                            <input name="pass2" type="password" class="form-control" required>
                                        </div>
                                        <button type="submit" name="ubah" class="btn btn-success">Ubah Password</button>
                                        <button type="reset" class="btn btn-danger">Reset</button></right>
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    }
                ?>
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

</body>

</html>
