<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "Sistema_Bibliotecario");
require('C:/xampp/fpdf/fpdf.php');
class PDF_nueva extends FPDF
{
   //Cabecera de página
   function Header()
   {
	$regFecha = [];
	$arch = fopen("Reportetemp.txt", "r");
	$i = 0;
	while (!feof($arch)){
		$text = fgets($arch);
		$regFecha[$i]=$text;
		$i++;
	}
	fclose($arch);
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(150, 10,utf8_decode('Reporte estadístico de préstamos'),0,0,'C');
		$this->Ln();
		$this->Cell(55, 10,'Fecha de inicio: ',0,0,'C');
		$this->Cell(55, 10,$regFecha[0],0,0,'C');
		$this->Ln();
		$this->Cell(55, 10,'Fecha de termino: ',0,0,'C');
		$this->Cell(55, 10,$regFecha[1],0,0,'C');
		$this->Ln();
		$this->Ln();
   }
   function Footer()
   {
		$fechaActual = date('d-m-Y');
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(60, 10,'rpt_estprest_v1.0',0,0,'L');
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
$pdf->Cell(40, 7, utf8_decode("TotalPréstamos"), 1, 0, 'C','True');
$pdf->Ln();
$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
$query="SELECT COUNT(id_biblioteca) AS Limite FROM biblioteca;";
$cursor = mysqli_query($conexion, $query);
$reg=mysqli_fetch_array($cursor);
$limite=$reg[0];
$total1=0;
$total2=0;
$f1 = $_POST["s_fecha_inicio"];
$f2 = $_POST["s_fecha_termino"];
$regFecha = [];
$arch = fopen("Reportetemp.txt", "r");
$i = 0;
while (!feof($arch)){
	$text = fgets($arch);
	$regFecha[$i]=$text;
	$i++;
}
fclose($arch);
for ($i = 1; $i <= $limite; $i++){
	$query="SELECT biblioteca.nom_biblioteca, COUNT(libro_biblioteca.id_libro_biblioteca)
	FROM libro_biblioteca
	INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
	INNER JOIN det_prestamo ON det_prestamo.id_libro_biblioteca = libro_biblioteca.id_libro_biblioteca
	INNER JOIN enc_prestamo ON enc_prestamo.id_prestamo = det_prestamo.id_enc_prestamo
	WHERE biblioteca.id_biblioteca = '$i' AND enc_prestamo.fecha_prestamo >= '$regFecha[0]' AND enc_prestamo.fecha_prestamo <= '$regFecha[1]';";
	$cursor = mysqli_query($conexion, $query);
	$reg=mysqli_fetch_array($cursor);
	$total1+=$reg[1];
	$pdf->Cell(65, 7, utf8_decode($reg[0]), 1,0,'R');
	$pdf->Cell(40, 7, $reg[1], 1,0,'R');
	$pdf->Ln();
}
ob_end_clean();
$pdf->Output();
?>
