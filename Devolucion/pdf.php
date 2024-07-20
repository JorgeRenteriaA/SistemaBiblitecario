<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_bibliotecario");
require('c:/xampp/fpdf/fpdf.php');
class PDF_nueva extends FPDF
{
   function Header()
   {
     	$this->SetFont('Arial','B',18);
		$this->Ln();	
     	$this->Cell(150, 10,utf8_decode('Comprobante de Devolución'),0,0,'C');
		$this->Ln();
		$this->Ln();
   }
   function Footer()
   {
		$this->SetFont('Arial','B',12);
		$this->Cell(60, 10,'cpb_devV1.0',0,0,'L');
		$hoy = date('d-m-Y');
		$this->Cell(60, 10,$hoy,0,0,'L');
   }
}
ob_start();
$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(241, 150, 255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(70, 7, "Libro Devuelto", 1, 0, 'C','True');
$pdf->Cell(25, 7, "ID LB", 1, 0, 'C','True');
$pdf->Cell(35, 7, "IDPrestamo", 1, 0, 'C','True');
$pdf->Ln();
$arrDatos = [];
$arch = fopen("reporteTemp.txt", "r");
$ia = 0;
while (!feof($arch)){
	$linea = fgets($arch);
	$arrDatos[$ia]=$linea;
	$ia++;
}
fclose($arch);
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_bibliotecario");
for($i=0; $i<count($arrDatos); $i++){
	$file = fopen("control.txt","w") or die("Problema innesperado en el archivo");
    fwrite($file,"");
    $query = "SELECT libro.titulo AS Libro, libro_biblioteca.id_libro_biblioteca AS IDLB, det_prestamo.id_det_prestamo AS IDP FROM det_prestamo, libro,libro_biblioteca WHERE det_prestamo.id_det_prestamo='$arrDatos[$i]' AND libro_biblioteca.id_libro_biblioteca = det_prestamo.id_libro_biblioteca AND libro_biblioteca.id_libro=libro.id_libro;";
	$cursor = mysqli_query($conexion, $query);
	fwrite($file,"$query\n");
    while($arrDev = mysqli_fetch_array($cursor)) {
		$pdf->Cell(70, 7, utf8_decode($arrDev[0]), 1);
		$pdf->Cell(25, 7, $arrDev[1], 1);
		$pdf->Cell(35, 7, $arrDev[2], 1);
		$pdf->Ln();
}
}
ob_end_clean();
$pdf->Output();
?>