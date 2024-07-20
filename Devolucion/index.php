<?php include "conexion.php"; ?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Devolucion</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
    <?php
		echo '
		<form name="formPrincipal" method="post" action="index.php">
			<div>
			<h1>Devolución</h1>
				<table border="0">
					 	<tr>
						<td colspan = "2">Empleado: </td>
					 	</tr>
						 <tr>
						 <td colspan = "2">'. ComboEmpleado() .'</td>
						 </tr>
						 <tr>
						 	<td colspan = "2" >Fecha de devolución: </td>
						 </tr>
						 <tr>
						 	<td colspan = "2">'.fecha().'</td>
						 </tr>
						 <tr>
                  		  <td colspan = "2">Ingrese su ID de prestamo</td>
               			 </tr>
                    <tr>
						<td colspan = "2"> <input type="text" name="s_ID_prestamo" id="txt1" placeholder="Ingrese..."> </td>
                    </td>
                     </tr>
                     <tr>
                     <td><input type="submit" name="Devolver"  value="Devolver                                  "/></td>
					 <td><input type="button" onclick=window.location.href="pdf.php"; value="PDF"/></td>
                    </tr>
					<tr>
                    </td>
				</table>
			<div>
		</form>
		';
        include("Devolucion.php");
	?>
    </body>
	<a href="/Biblioteca/index.php">Regresar</a>
</html>
<?php
	function ComboEmpleado() {
		$db = new MySql();
		$query = "SELECT * FROM Empleado WHERE id_empleado > 0 ORDER BY nom_empleado ASC;";
		$consulta = $db->consulta($query);
		$combo = "";
		$i = 0;
		if ( $db->num_rows($consulta) > 0 ) {
			$combo= '<select name="cmbEmpleado" id="Empleado">';
			while ( $resultados = $db->fetch_array($consulta)) {
				if ( $i == 0 )
					$combo .= '<option value="-1">Selecciona...</option>' . "\n";
				$combo .= '<option value="' . $resultados[0] . '">' . $resultados[2].' '. $resultados[1] . "</option>\n";
				$i++;
			}
			$combo .= "</select>\n";
		}
		return $combo;
	}
	function fecha(){
		date_default_timezone_set('America/Mexico_City');
		$hoy = date('Y-m-d');
		return '<input type="date" id="txt1" name="s_fecha_inicio" min="0000-00-00" max="2100-12-31" value = "'.$hoy.'">';
	}
?>
