<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "Sistema_Bibliotecario");
require('c:/xampp/fpdf/fpdf.php');
class PDF_nueva extends FPDF
{
   function Header()
   {
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(150, 10,'Libros dados de alta',0,0,'C');
		$this->Ln();
		$this->Ln();
   }
   function Footer()
   {
		$fechaActual = date('d-m-Y');
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(60, 10,'lib_alta_v1.0',0,0,'L');
		$this->Cell(60, 10,$fechaActual,0,0,'L');
   }
}
ob_start();
$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(241, 150, 255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(15, 7, "ID", 1, 0, 'C','True');
$pdf->Cell(40, 7, "ISBN", 1, 0, 'C','True');
$pdf->Cell(55, 7, "Titulo", 1, 0, 'C','True');
$pdf->Cell(60, 7, "Editorial", 1, 0, 'C','True');
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
$query2 = "SELECT MAX(id_libro) FROM libro;";
$ejecutaQuery = mysqli_query($conexion_bd,$query2);
$arregloQuery = mysqli_fetch_array($ejecutaQuery);
$c = ((int) $arregloQuery[0]);
$clave = (string) $c;
$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
$query2 = "SELECT libro.id_libro, libro.isbn, libro.titulo, editorial.nom_editorial FROM libro
         INNER JOIN editorial ON editorial.id_editorial = libro.id_editorial
         WHERE libro.id_libro = '$clave';";
$ejecutaQuery = mysqli_query($conexion_bd,$query2);
while($arregloQuery = mysqli_fetch_array($ejecutaQuery)) {
		$pdf->Cell(15, 7, $arregloQuery[0], 1,0,'L');
		$pdf->Cell(40, 7, $arregloQuery[1], 1,0,'L');
		$pdf->Cell(55, 7, utf8_decode($arregloQuery[2]), 1,0,'L');
		$pdf->Cell(60, 7, utf8_decode($arregloQuery[3]), 1,0,'L');
		$pdf->Ln();
}
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->Cell(60, 7, "Temas", 1, 0, 'C','True');
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$query = "SELECT nom_tema FROM tema,Libro_Tema WHERE Libro_Tema.id_tema = tema.id_tema AND Libro_Tema.id_libro='$clave'";
$cursor = mysqli_query($conexion, $query);
while($arrP = mysqli_fetch_array($cursor)) {
		$pdf->Cell(60, 7, utf8_decode($arrP[0]), 1,  0, 'L');
		$pdf->Ln();
}
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->Cell(60, 7, "Autores", 1, 0, 'C','True');
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$query = "SELECT autor.nom_autor FROM autor,Libro_Autor WHERE Libro_Autor.id_autor = autor.id_autor AND Libro_Autor.id_libro='$clave'";
$cursor = mysqli_query($conexion, $query);
while($arrP = mysqli_fetch_array($cursor)) {
		$pdf->Cell(60, 7, utf8_decode($arrP[0]), 1, 0, 'L');
		$pdf->Ln();
}
ob_end_clean();
$pdf->Output();
?>
