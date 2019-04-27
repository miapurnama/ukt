<?php
	include 'koneksi.php';
	if (isset($_POST['verifikasi'])) {
        $data = array(
            'id_mahasiswa' => $_POST['id_mahasiswa'],
            'kode_kriteria' => $_POST['kode_kriteria'],
            'status' => $_POST['status'],
            'pesan' => (isset($_POST['pesan']))?$_POST['pesan']:''
        );

        $cek = mysqli_query($con, "SELECT * FROM cek_verifikasi WHERE id_mahasiswa = '" .$data['id_mahasiswa']. "' AND kode_kriteria = '" .$data['kode_kriteria']. "'");
        if(mysqli_num_rows($cek) > 0){
            $update = mysqli_query($con, "UPDATE cek_verifikasi SET status = '" .$data['status']. "' WHERE id_mahasiswa = '" .$data['id_mahasiswa']. "' AND kode_kriteria = '" .$data['kode_kriteria']. "'");
            header("Location: ../index.php?p=verifikasi&id_mahasiswa=" .$data['id_mahasiswa']. "");
        }else{
            $sql = mysqli_query($con, "INSERT INTO cek_verifikasi(id_mahasiswa,kode_kriteria,status) VALUES('" .$data['id_mahasiswa']. "','" .$data['kode_kriteria']. "','" .$data['status']. "')");
            if($sql){
                if ($data['pesan'] != "") {
                    $query = mysqli_query($con, "INSERT INTO notifikasi(id_mahasiswa,pesan) VALUES('" .$data['id_mahasiswa']. "', '" .$data['pesan']. "')");
                }
                header("Location: ../index.php?p=verifikasi&id_mahasiswa=" .$data['id_mahasiswa']. "");
            }
        }
    }
?>