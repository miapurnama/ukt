<?php
	session_start();
    if (!isset($_SESSION["id_verifikator"] ))
    {
        header('location:login.php');
        // break;
    }
	include 'pemroses/koneksi.php';
    include 'view/layout.php';
?>
