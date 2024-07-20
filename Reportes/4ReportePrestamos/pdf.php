<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "Sistema_Bibliotecario");
require('C:/xampp/fpdf/fpdf.php');
class PDF_nueva extends FPDF
{
   function Header()
   {
	$regDatos = [];
	$arch = fopen("reporteTemp.txt", "r");
	$i = 0;
	while (!feof($arch)){
		$text = fgets($arch);
		$regDatos[$i]=$text;
		$i++;
	}
	fclose($arch);
     	$this->SetFont('Arial','B',18);
		$this->Ln();
     	$this->Cell(150, 10,utf8_decode('Reporte préstamos'),0,0,'C');
		$this->Ln();
		$this->Cell(150, 10,utf8_decode('Periodo:'),0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',14);
		$this->Cell(80, 10,' Fecha de inicio: '.$regDatos[0],0,0,'C');
		$this->Cell(80, 10,'  Fecha de termino: '.$regDatos[1],0,0,'C');
		$this->Ln();
   }
   function Footer()
   {
		$fechaActual = date('d-m-Y');
     	$this->SetFont('Arial','B',14);
		$this->Ln();
     	$this->Cell(60, 10,'rpt_prest_v1.0',0,0,'L');
		$this->Cell(60, 10,$fechaActual,0,0,'L');
   }
}
ob_start();
$pdf = new PDF_nueva();
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(241, 150, 255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30, 7, "Biblioteca", 1, 0, 'C','True');
$pdf->Cell(50, 7, "Titulo", 1, 0, 'C','True');
$pdf->Cell(50, 7, "Usuario", 1, 0, 'C','True');
$pdf->Cell(25, 7, "F.Prestamo", 1, 0, 'C','True');
$pdf->Cell(25, 7, "F.Devolucion", 1, 0, 'C','True');
$pdf->Ln();
$regDatos = [];
$arch = fopen("reporteTemp.txt", "r");
$i = 0;
while (!feof($arch)){
	$text = fgets($arch);
	$regDatos[$i]=$text;
	$i++;
}
fclose($arch);
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_bibliotecario");
if($regDatos[2]<>-2){
	$query="SELECT biblioteca.nom_biblioteca AS biblio,libro.titulo AS title, usuario.nom_usuario AS persona, usuario.ape_usuario AS Apellido, enc_prestamo.fecha_prestamo AS fecha1, enc_prestamo.fec_lim_devolucion AS fecha2 FROM det_prestamo
	INNER JOIN enc_prestamo ON enc_prestamo.id_prestamo = det_prestamo.id_enc_prestamo
	INNER JOIN libro_biblioteca ON libro_biblioteca.id_libro_biblioteca = det_prestamo.id_libro_biblioteca
	INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro
	INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca 
	INNER JOIN usuario ON usuario.id_usuario = enc_prestamo.id_usuario
	WHERE enc_prestamo.fecha_prestamo>='$regDatos[0]' AND enc_prestamo.fec_lim_devolucion<='$regDatos[1]' AND libro_biblioteca.id_biblioteca = '$regDatos[2]'
	ORDER BY fecha1 ASC;";
	$cursor = mysqli_query($conexion, $query);
	while($arregloQuery=mysqli_fetch_array($cursor)){
		$pdf->Cell(30,7,utf8_decode($arregloQuery[0]),0,0,'L');
		$pdf->Cell(50,7,utf8_decode($arregloQuery[1]),0,0,'L');
		$pdf->Cell(50,7,utf8_decode($arregloQuery[2])." ".utf8_decode($arregloQuery[3]),0,0,'L');
		$pdf->Cell(25,7,$arregloQuery[4],0,0,'L');
		$pdf->Cell(25,7,$arregloQuery[5],0,0,'L');
    	$pdf->Ln();
	}	
}else{
	$query="SELECT COUNT(id_biblioteca) AS Limite FROM biblioteca;";
	$cursor = mysqli_query($conexion, $query);
	$arregloQuery=mysqli_fetch_array($cursor);
	$limite=$arregloQuery[0];
	for ($i = 1; $i <= $limite; $i++){
		$query="SELECT biblioteca.nom_biblioteca AS biblio,libro.titulo AS title, usuario.nom_usuario AS persona, usuario.ape_usuario AS Apellido, enc_prestamo.fecha_prestamo AS fecha1, enc_prestamo.fec_lim_devolucion AS fecha2 FROM det_prestamo INNER JOIN enc_prestamo ON enc_prestamo.id_prestamo = det_prestamo.id_enc_prestamo INNER JOIN libro_biblioteca ON libro_biblioteca.id_libro_biblioteca = det_prestamo.id_libro_biblioteca INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca INNER JOIN usuario ON usuario.id_usuario = enc_prestamo.id_usuario WHERE enc_prestamo.fecha_prestamo>='$regDatos[0]' AND enc_prestamo.fec_lim_devolucion<='$regDatos[1]' AND libro_biblioteca.id_biblioteca = '$i' ORDER BY fecha1 ASC;";
		$cursor2 = mysqli_query($conexion, $query);
		while($arregloQuery=mysqli_fetch_array($cursor2)){
			$pdf->Cell(30,7,utf8_decode($arregloQuery[0]),0,0,'L');
			$pdf->Cell(50,7,utf8_decode($arregloQuery[1]),0,0,'L');
			$pdf->Cell(50,7,utf8_decode($arregloQuery[2])." ".utf8_decode($arregloQuery[3]),0,0,'L');
			$pdf->Cell(25,7,$arregloQuery[4],0,0,'L');
			$pdf->Cell(25,7,$arregloQuery[5],0,0,'L');
			$pdf->Ln();
		}
	}
	
}
ob_end_clean();
$pdf->Output();
?>
