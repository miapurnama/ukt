<?php
	include 'koneksi.php';

$query=mysql_query("select SUM(bobot) from kriteria");
$jm = mysql_fetch_array($query);
$jml= $jm['SUM(bobot)'];

 $qb=mysql_query("select * from kriteria where id_kriteria='1'");
                            $d1 = mysql_fetch_array($qb);
                            $b1= $d1['bobot'];

                         $qs=mysql_query("select * from kriteria where id_kriteria='1'");
                         $ds = mysql_fetch_array($qs);
                         $s1= $ds['subkriteria'];


$query=mysql_query("select SUM(bobot) from kriteria");
$data3 = mysql_fetch_array($query);
$total= $data3['SUM(bobot)'];

$query=mysql_query("select * from kriteria where id_kriteria='1'");
$data = mysql_fetch_array($query);

$query1=mysql_query("select * from kriteria where id_kriteria='9'");
$data1 = mysql_fetch_array($query1);

$satu= $data['bobot'];
$dua= $data1['bobot'];


$query=mysql_query("select * from kriteria where id_kriteria='14'");
$data14 = mysql_fetch_array($query);
$empatbelas= $data14['bobot'];
$query=mysql_query("select * from kriteria where id_kriteria='14'");
$s14 = mysql_fetch_array($query);
$sk14= $s14['subkriteria'];
$fa = ((($sk14-1)/($sk14-1))*100)*($empatbelas/$jml);

echo $empatbelas;
echo "<br />";
echo $sk14;

echo "<br />";
echo $fa;
echo "<br />";
echo $satu;
 echo "<br />";
echo $dua;
echo "<br />";
echo $total;
echo "<br />";
echo "ini jumlah bobot &nbsp;";
echo $jml;
echo "<br />";
echo "ini  bobot &nbsp;";
echo $b1;
echo "<br />";
echo "ini sub &nbsp;";
echo $s1;
?>
