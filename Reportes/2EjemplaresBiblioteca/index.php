<?php include "conexion.php"; ?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Reporte ejemplares por biblioteca</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <?php
		echo '
		<form name="formPrincipal" method="post" action="index.php">
			<div class="cajaContent">
			<h1>Reporte de ejemplares por biblioteca</h1>
				<table border="0" class="tablaContent">
					</tr>
                        <td>Biblioteca:</td>
                            <td>' . comboBiblioteca() . '</td>
					<tr>
                        <td  align="center">
                        <input type="submit" name="report" value="Aceptar                         " class="button"/>
                    </td>
					<td  align="center">
					<input type="button" class="button" name="pdf" onclick=window.location.href="pdf.php"; value="PDF"/></td>
                    </tr>
				</table>
			<div>
		</form>
		';
        include("ejemplaresBiblioteca.php");
	?>
	<a href="/Biblioteca/Reportes/index.php">Regresar</a>
    </body>
</html>
<?php
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
