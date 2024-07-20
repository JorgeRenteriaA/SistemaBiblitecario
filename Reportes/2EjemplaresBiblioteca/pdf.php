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
     	$this->Cell(150, 10,utf8_decode('Reporte ejemplares por biblioteca'),0,0,'C');
		$this->Ln();
		$this->Ln();
   }
   function Footer()
   {
		$fechaActual = date('d-m-Y');
     	$this->SetFont('Arial','B',14);
		$this->Ln();
     	$this->Cell(80, 10,'rpt_Ejemplares_Biblioteca',0,0,'L');
		$this->Cell(60, 10,$fechaActual,0,0,'L');
   }
}
ob_start();
$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$arrDatos = [];
	$arch = fopen("Reporte.txt", "r");
	$i = 0;
while (!feof($arch)){
	$text = fgets($arch);
	$arrDatos[$i]=$text;
	$i++;
}
fclose($arch);
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_bibliotecario");
if($arrDatos[0]==-2){
    $pdf->SetFillColor(241, 150, 255);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(80, 7, "Titulo", 1, 0, 'C','True');
	$pdf->Cell(60, 7, "Biblioteca", 1, 0, 'C','True');
	$pdf->Cell(25, 7, "Cantidad", 1, 0, 'C','True');
	$pdf->Ln();
	$pdf->SetFillColor(0, 0, 0);
    $pdf->SetTextColor(0,0,0);
	$query="SELECT DISTINCT(libro.titulo), biblioteca.nom_biblioteca,
    (SELECT COUNT(*) FROM libro_biblioteca WHERE libro_biblioteca.id_libro = libro.id_libro AND libro_biblioteca.id_biblioteca = biblioteca.id_biblioteca) AS num
    FROM libro_biblioteca
    INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro
    INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
    ORDER BY  libro.titulo ASC;
	";
	$cursor = mysqli_query($conexion, $query);
	while ($arr=mysqli_fetch_array($cursor)) {
        $pdf->Cell(80, 7, utf8_decode($arr[0]), 1, 0, 'L');
		$pdf->Cell(60, 7, utf8_decode($arr[1]), 1, 0, 'L');
		$pdf->Cell(25, 7, $arr[2], 1, 0, 'L');
		$pdf->Ln();
	}
}else{
	$pdf->SetFillColor(241, 150, 255);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(80, 7, "Titulo", 1, 0, 'C','True');
	$pdf->Cell(60, 7, "Biblioteca", 1, 0, 'C','True');
	$pdf->Cell(25, 7, "Cantidad", 1, 0, 'C','True');
	$pdf->Ln();
	$pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0,0,0);
	$query="SELECT DISTINCT(libro.titulo), biblioteca.nom_biblioteca,
                    (SELECT COUNT(*) FROM libro_biblioteca WHERE libro_biblioteca.id_libro = libro.id_libro AND libro_biblioteca.id_biblioteca = biblioteca.id_biblioteca) AS num
                    FROM libro_biblioteca
                    INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro
                    INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
                    WHERE biblioteca.id_biblioteca = '$arrDatos[0]'
                    ORDER BY  libro.titulo ASC;
	";
	$cursor = mysqli_query($conexion, $query);
	while ($arr=mysqli_fetch_array($cursor)) {
		$pdf->Cell(80, 7, utf8_decode($arr[0]), 1, 0, 'L');
		$pdf->Cell(60, 7, utf8_decode($arr[1]), 1, 0, 'L');
		$pdf->Cell(25, 7, $arr[2], 1, 0, 'L');
		$pdf->Ln();
	}
}
ob_end_clean();
$pdf->Output();
?>
