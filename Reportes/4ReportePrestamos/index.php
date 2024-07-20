<?php include "conexion.php"; ?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Reporte Préstamos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
    <?php
		echo '
		<form name="formPrincipal" method="post" action="index.php">
			<div>
			<h1>Reporte de préstamos</h1>
				<table border="0">
                <tr>
                    <td colspan = "3"><h1>Defina periodo de reporte</h2></td>
                </tr>

					<tr>
                        <td>Fecha inicio: </td>
                        <td>Fecha termino: </td>
                    <tr>
						<td>'.fechaInicio().' </td>
                        <td>'.fechaFin().'</td>
                    </td>
                     </tr>
					 </tr>
                        <td>Biblioteca:</td>
                        <td>' . comboBiblioteca() . '</td>
					<tr>
                     <tr>
					 <td><input type="submit" name="report" value="Aceptar"/></td>
					 <td><input type="button" class="button" name="pdf" onclick=window.location.href="pdf.php"; value="PDF"/></td>
					 </tr>
				</table>
			<div>
		</form>
		';
        include("ReportePrestamos.php");
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
	function comboBiblioteca() {
		$db = new MySql();
		$query = "SELECT * FROM biblioteca WHERE id_biblioteca > 0 ORDER BY nom_biblioteca ASC;";
		$consulta = $db->consulta($query);
		$combo = "";
		$i = 0;
		if ( $db->num_rows($consulta) > 0 ) {
			$combo= '<select name="cmbBiblioteca" id="Biblioteca">';
			while ( $resultados = $db->fetch_array($consulta)) {
				if ( $i == 0 )
					$combo .= '<option value="-1">Selecciona...</option>' . "\n";
				$combo .= '<option value="' . $resultados[0] . '">' . $resultados[1] . "</option>\n";
				$i++;
			}
            $combo .= '<option value="-2">TODOS</option>' . "\n";
			$combo .= "</select>\n";
		}
		return $combo;
	}
?>
