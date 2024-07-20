<?php include "conexion.php"; ?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Reporte estadístico libros</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
		<form name="formPrincipal" method="post" action="index.php">
		<div>
		<h1>Reporte estadístico libros</h1>
			<table border="0">
				<tr><?php
					include("ReporteEstadisticoLibros.php");
					?>
				</tr>
				<tr>
				<td></td>
				<td><input type="button" class="button" name="pdf" onclick=window.location.href="pdf.php"; value="PDF"/></td>
				<td></td>
				</tr>
			</table>
		<div>
		</form>
		<a href="/Biblioteca/Reportes/index.php">Regresar</a>
    </body>
</html>
</html>
