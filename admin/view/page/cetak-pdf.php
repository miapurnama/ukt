<?php
require('../../assets/fpdf.php');
include "../../pemroses/koneksi.php";
class PDF extends FPDF
{
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(70,10,'Hasil Kelompok UKT',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(20,45, 50);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,$row[2],'LR');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(0,0,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(20,50, 55);
    $this->Cell(30);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell(30);
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(30);
    $this->Cell(array_sum($w),0,'','T');
}
}
$sql = mysqli_query($con, "SELECT * FROM kelompok_ukt");
$hasil = array();
$no = 0;
while($row=mysqli_fetch_assoc($sql)){
    $no++;
	$hasil[] = array($no,$row['nama_mahasiswa'],$row['kelompok']);
}

$pdf = new PDF();
$header = array('No.','Nama Mahasiswa', 'Kelompok UKT');
//$data = $pdf->LoadData($hasil);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header,$hasil);
$pdf->AddPage();
$pdf->Output();
?>