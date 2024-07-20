<?php include "conexion.php"; ?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Reporte estadístico préstamos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
	<?php
		echo '<form name="formPrincipal" method="post" action="index.php">
		<div>
		<h1>Reporte estadístico préstamos</h1>
		<table border="0">
			<tr>
				<td colspan = "2"><h1>Defina periodo de reporte</h2></td>
			</tr>
			<tr>
				<td>Fecha inicio: </td>
				<td>Fecha termino: </td>
			</tr>
			<tr>
				<td>'.fechaInicio().' </td>
				<td>'.fechaFin().'</td>
			</tr>
			<tr>
				<td><input type="submit" name="report" value="Aceptar"/></td>
				<td><input type="button" class="button" name="pdf" onclick=window.location.href="pdf.php"; value="PDF"/></td>
			</tr>
		</table>
		<div>
		</form>
		';
		include("ReporteEstadisticoPrestamos.php");
	?>
	<a href="/Biblioteca/Reportes/index.php">Regresar</a>
    </body>
</html>
<?php
	function fechaInicio(){
		date_default_timezone_set('America/Mexico_City');
		$hoy = date('Y-m-d');
		return '<input type="date" id="txt1" name="s_fecha_inicio" min="0000-00-00" max="2100-12-31" value = "'.$hoy.'">';
	}
	function fechaFin(){
		date_default_timezone_set('America/Mexico_City');
		$hoy = date('Y-m-d');
		$l1 = (int) date('d');
		$l1 = $l1+3;
		$l2 = '0'.(string) $l1;
		$l2 = date('Y-m-').$l2;
		return '<input type="date" id="txt2" name="s_fecha_termino" min="0000-00-00" max="2100-12-31" value = "'.$l2.'">';
	}
?>