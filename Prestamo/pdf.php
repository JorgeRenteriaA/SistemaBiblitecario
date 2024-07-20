<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "Sistema_Bibliotecario");
require('c:/xampp/fpdf/fpdf.php');
class PDF_nueva extends FPDF
{
   function Header()
   {
     	$this->SetFont('Arial','B',18);
        $arrArch = [];
        $arch = fopen("archTemp2.txt", "r");
        $ia = 0;
        while (!feof($arch)){
            $linea = fgets($arch);
            $arrArch[$ia]=$linea;
            $ia++;
        }
        fclose($arch);
		$this->Ln();
     	$this->Cell(150, 10,'Recibo de prestamo',0,0,'C');
        $this->SetFont('Arial','B',14);
        $this->Ln();
        $this->Cell(80, 8, 'Usuario: '.utf8_decode($arrArch[3]),0,0,'L');
        $this->Ln();
        $this->Cell(80, 8, 'Fecha de prestamo: '.$arrArch[4],0,0,'L');
        $this->Cell(80, 8, utf8_decode('Fecha lim devolución: '.$arrArch[5]),0,0,'L');
		$this->Ln();
		$this->Ln();
   }
   function Footer()
   {
		$fechaActual = date('d-m-Y');
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(90, 10,'rcb_Prs_v1.0 '.$fechaActual,0,0,'L');
   }
}
$arrArch = [];
$arch = fopen("archTemp2.txt", "r");
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
$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
$query="SELECT nom_usuario, ape_usuario FROM usuario WHERE id_usuario='$arrArch[0]';";
$ejecutaQuery = mysqli_query($conexion_bd,$query);
while ($arregloQuery1 = mysqli_fetch_array($ejecutaQuery)) {
    $pdf->Cell(150,10,$arregloQuery1[0]." ".$arregloQuery1[1],0,0,'C');
    $pdf->Ln();
}
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(241, 150, 255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30, 7, "IDP(devolver)", 1, 0, 'C','True');
$pdf->Cell(40, 7, "ID ejemplar", 1, 0, 'C','True');
$pdf->Cell(80, 7, "Titulo", 1, 0, 'C','True');
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
$lim = (int) $arrArch[6];
for($i=8; $i<$lim; $i++){
    $query="SELECT  det_prestamo.id_det_prestamo, libro_biblioteca.id_libro_biblioteca, libro.titulo FROM det_prestamo
    INNER JOIN libro_biblioteca ON libro_biblioteca.id_libro_biblioteca = det_prestamo.id_libro_biblioteca
    INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro
    WHERE det_prestamo.id_det_prestamo = '$arrArch[$i]';";
    $ejecutaQuery = mysqli_query($conexion_bd,$query);
    while($arregloQuery = mysqli_fetch_array($ejecutaQuery)) {
    		$pdf->Cell(30, 7, $arregloQuery[0], 1,0,'R');
    		$pdf->Cell(40, 7, $arregloQuery[1], 1,0,'R');
    		$pdf->Cell(80, 7, utf8_decode($arregloQuery[2]), 1,0,'R');
    		$pdf->Ln();
    }
}
ob_end_clean();
$pdf->Output();
?>
