<?php include "conexion.php"; ?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Registro inventario</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
		<script language="javascript">
			function agregar(){
				var a = document.getElementById("Biblioteca");
				var selected = a.options[a.selectedIndex].text;
				var b = document.getElementById("Libro");
				var selected2 = b.options[b.selectedIndex].text;
				var c = document.getElementById("txt1");
				var cant = c.value;
				var num = 0;
				var text = document.getElementById("areaTexto");
				var d = document.getElementById("txtCantidad");
				document.getElementById("tabla2").insertRow(-1).innerHTML = '<tr>\n<td>'+selected+'</td>\n<td>'+selected2+'</td>\n<td>'+c.value+'</td>\n</tr>';
				num = num + parseInt(cant,10);
				d.value = num;
				text.value = text.value+','+a.value+','+b.value+','+c.value;
			}
		</script>
	</head>
	<body>
		<?php
			echo '
			<form name="formPrincipal" method="post" action="index.php">
				<div class="cajaContent">
				<h1>Registro de inventario</h1>
			  <table border="0" class="tablaContent">
						  <tr>
							<td>Biblioteca: </td>
							<td>Libro: </td>
							<textarea cols="20" rows="5" id="areaTexto" name="areaTexto" readonly style="resize: none" class="invisible"></textarea>
						  </tr>
						  <tr>
						  </tr>
						  <td>' . comboBiblioteca() . '</td>
							<td>' . comboLibros() . '</td>
						  <tr>
							<td colspan="2">Cantidad:</td>
						  </tr>
						  <tr>
							<td><input type="text" id="txt1" name="s_cantidad" placeholder="Ingresa la cantidad de ejemplares..."></td>
							<td><input type="button" class="button" value="Agregar" onclick="agregar();"/></td>
						  </tr>
						<tr>
							<td><input class="button" type="submit" name="register" value="Registrar"/></td>
							<td><input type="button" class="button" name="pdf" onclick=window.location.href="pdf.php"; value="PDF"/></td>
							<textarea name="txtCantidad" id="txtCantidad" class = "invisible"></textarea>
						</tr>
					   </table>
					   <table border="1" class="tablaContent2" id="tabla2">
					   <tr>
							<td>Biblioteca: </td>
							<td>Libro: </td>
							<td>Cantidad: </td>
					   </tr>
					   </table>
				<div>
			</form>
			';
			include("altaInventario.php");
		?>
		<a href="/Biblioteca/Catalogos/index.php">Regresar</a>
	</body>
</html>

<?php
function comboLibros() {
	$db = new MySql();
	$query = "SELECT id_Libro, titulo FROM Libro WHERE id_libro > 0 ORDER BY titulo ASC;";
	$consulta = $db->consulta($query);
	$combo = "";
	$i = 0;
	if ( $db->num_rows($consulta) > 0 ) {
		$combo= '<select name="cmbLibro" id="Libro">';
		while ( $arregloQuery = $db->fetch_array($consulta)) {
			if ( $i == 0 )
				$combo .= '<option value="-1">Selecciona...</option>' . "\n";
			$combo .= '<option value="' . $arregloQuery[0] . '">' . $arregloQuery[1] . "</option>\n";
			$i++;
		}
		$combo .= "</select>\n";
	}
	return $combo;
}
function comboBiblioteca() {
	$db = new MySql();
	$query = "SELECT * FROM Biblioteca WHERE id_biblioteca > 0 ORDER BY nom_biblioteca ASC;";
	$consulta = $db->consulta($query);
	$combo = "";
	$i = 0;
	if ( $db->num_rows($consulta) > 0 ) {
		$combo= '<select name="cmbBiblioteca" id="Biblioteca">';
		while ( $arregloQuery = $db->fetch_array($consulta)) {
			if ( $i == 0 )
				$combo .= '<option value="-1">Selecciona...</option>' . "\n";
			$combo .= '<option value="' . $arregloQuery[0] . '">' . $arregloQuery[1] . "</option>\n";
			$i++;
		}
		$combo .= "</select>\n";
	}
	return $combo;
}
?>
