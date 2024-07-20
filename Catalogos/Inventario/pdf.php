<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "Sistema_Bibliotecario");
require('C:/XAMPP/FPDF/fpdf.php');
class PDF_nueva extends FPDF
{
   function Header()
   {
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(150, 10,'Libros agregados a inventario',0,0,'C');
		$this->Ln();
		$this->Ln();
   }
   function Footer()
   {
		$fechaActual = date('d-m-Y');
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(80, 10,'rpt_invagr_v1.0',0,0,'L');
		$this->Cell(100, 10,$fechaActual,0,0,'L');
   }
}
$arrArch = [];
$arch = fopen("archTemp.txt", "r");
$ia = 0;
while (!feof($arch)){
    $linea = fgets($arch);
    $arrArch[$ia]=$linea;
    $ia++;
}
fclose($arch);
ob_start();
$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(241,150,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50, 7, utf8_decode("Código de barras"), 1, 0, 'C','True');
$pdf->Cell(70, 7, "Biblioteca", 1, 0, 'C','True');
$pdf->Cell(70, 7, "Titulo", 1, 0, 'C','True');
$pdf->Ln();
$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
$y = 41;
$cont = 0;
for($i=0; $i<COUNT($arrArch)-1; $i++){
    $query= "SELECT libro_biblioteca.id_libro_biblioteca,biblioteca.nom_biblioteca, libro.titulo FROM libro_biblioteca
             INNER JOIN libro ON libro_biblioteca.id_libro = libro.id_libro
             INNER JOIN biblioteca ON libro_biblioteca.id_biblioteca = biblioteca.id_biblioteca
             WHERE libro_biblioteca.id_libro_biblioteca = '$arrArch[$i]';";
    $ejecutaQuery = mysqli_query($conexion_bd,$query);
    while($arregloQuery = mysqli_fetch_array($ejecutaQuery)) {
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(50, 10, $arregloQuery[0].$arregloQuery[0].$arregloQuery[0], 1,0,'C');
            $pdf->Cell(70, 10, utf8_decode($arregloQuery[1]), 1,0,'L');
            $pdf->Cell(70, 10, utf8_decode($arregloQuery[2]), 1,0,'L');
    		$pdf->Ln();
    }
    $y+=30;
    $cont++;
    if($cont == 7 ){
        $y = 44;
        $cont = 0;
    }
}
ob_end_clean();
$pdf->Output();
?>
