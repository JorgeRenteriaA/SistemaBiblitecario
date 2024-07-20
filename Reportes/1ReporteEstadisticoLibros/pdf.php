<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "Sistema_Bibliotecario");
require('C:/xampp/fpdf/fpdf.php');
class PDF_nueva extends FPDF
{
   function Header()
   {
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(150, 10,utf8_decode('Reporte estadístico de libros'),0,0,'C');
		$this->Ln();
		$this->Ln();
   }
   function Footer()
   {
		$fechaActual = date('d-m-Y');
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(60, 10,'rpt_estlibros_v1.0',0,0,'L');
		$this->Cell(60, 10,$fechaActual,0,0,'L');
   }
}
ob_start();
$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(241, 150, 255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(65, 7, "Biblioteca", 1, 0, 'C','True');
$pdf->Cell(40, 7, "TotalTitulos", 1, 0, 'C','True');
$pdf->Cell(40, 7, "TotalEjemplares", 1, 0, 'C','True');
$pdf->Ln();
$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
$query="SELECT COUNT(id_biblioteca) AS Limite FROM biblioteca;";
$cursor = mysqli_query($conexion, $query);
$arr=mysqli_fetch_array($cursor);
$limite=$arr[0];
$total1=0;
$total2=0;
for ($i = 1; $i <= $limite; $i++){
	$query="SELECT biblioteca.nom_biblioteca, COUNT(DISTINCT(libro_biblioteca.id_libro)), COUNT(libro_biblioteca.id_libro_biblioteca)
	FROM libro_biblioteca
	INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
	WHERE biblioteca.id_biblioteca = '$i';";
	$cursor = mysqli_query($conexion, $query);
	$arr=mysqli_fetch_array($cursor);
	$total1+=$arr[1];
	$total2+=$arr[2];
	$pdf->Cell(65, 7, utf8_decode($arr[0]), 1,0,'R');
	$pdf->Cell(40, 7, $arr[1], 1,0,'R');
	$pdf->Cell(40, 7, $arr[2], 1,0,'R');
	$pdf->Ln();
}
ob_end_clean();
$pdf->Output();
?>
