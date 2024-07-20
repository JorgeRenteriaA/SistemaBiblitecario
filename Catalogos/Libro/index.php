<?php
	include "conexion.php";
	include("conecta.php");
	?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Registrar Libro</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
		<script language="javascript">
			function agregar2(){
				var combo = document.getElementById("Tema");
				var selected = combo.options[combo.selectedIndex].text;
				var a = document.getElementById("Tema");
				var text = document.getElementById("areaTexto2");
				document.getElementById("tabla3").insertRow(-1).innerHTML = '<tr bgcolor="#CCCCCC">\n<td>'+selected+'</td>\n</tr>';
				text.value = text.value+','+a.value;
			}
			function agregar(){
				var combo = document.getElementById("Autor");
				var selected = combo.options[combo.selectedIndex].text;
				document.getElementById("tabla2").insertRow(-1).innerHTML = '<tr bgcolor="#CCCCCC">\n<td>'+selected+'</td>\n</tr>';

				var a = document.getElementById("Autor");
				var text = document.getElementById("areaTexto");

				text.value = text.value+','+a.value;
			}
		</script>
	</head>
	<body>
		<?php
			echo '
			<form name="formPrincipal" method="post" action="index.php">
				<div class="cajaContent">
				<h1>Registro de libro</h1>
					<table border="0" id = "tabla" class="tablaContent">
						<tr>
							<td>ID: </td>
							<td>ISBN: </td>
						</tr>
						<tr>
							<td><input type="text" id="txt1" name="s_id_Libro" value="'.IDMax().'" readonly></td>
							<td><input type="text" id="txt3" name="s_isbn" placeholder="Ingresa ISBN"></td>
						</tr>
						<tr>
							<td>Titulo: </td>
							<td>Editorial:</td>
						</tr>
						<tr>
							<td><input type="text" id="txt2" name="s_Titulo" placeholder="Ingresa titulo"></td>
							<td>' . comboEditorial() . '</td>
						</tr>
						<tr>
							<td>Autor: </td>
							<td>Tema: </td>
						</tr>
						<tr>
							<td>' . comboAutor() . '</td>
							<td>'. comboTema() . '</td>
						</tr>
						<tr>
							<td rowspan="2"><input type="button" class="button" value="Agregar" onclick="agregar();"/></td>
							<td rowspan="2"><input type="button" class="button" value="Agregar" onclick="agregar2();"/></td>
						</tr>
						<tr>
						</tr>
						<tr>
						</tr>
						<tr>
							<textarea class = "invisible" cols="20" rows="2" id="areaTexto" name="areaTexto" readonly style="resize: none"></textarea>
							<textarea class = "invisible" cols="20" rows="2" id="areaTexto2" name="areaTexto2" readonly style="resize: none"></textarea>
						</tr>
						<tr>
							<td><input type="submit" class="button" name="register" value="Registrar"/></td>
							<td><input type="button" class="button" name="pdf" onclick=window.location.href="pdf.php"; value="PDF"/></td>
						</tr>
						<tr>
							<td>
								<table id = "tabla2" class="tablaContent2" >
									<tr>
										<td  bgcolor="white">Autores: </td>
									</tr>
								</table>
							</td>
							<td>
							<table id = "tabla3" class="tablaContent2" >
								<tr  bgcolor="white">
									<td>Temas: </td>
								</tr>
							</table>
							</td>
						</tr>
					</table>
				<div>
			</form>
			';
			include("altaLibro.php");
		?>
	<a href="/Biblioteca/Catalogos/index.php">Regresar</a>
	</body>
</html>

<?php
function IDMax(){
	$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
	$query = "SELECT MAX(id_libro) FROM libro;";
	$ejecutaQuery = mysqli_query($conexion_bd,$query);
	$arregloQuery = mysqli_fetch_array($ejecutaQuery);
	$IDM = ((int) $arregloQuery[0]) + 1;
	$IDMX = (string) $IDM;
	return $IDMX;
}

function comboTema() {
	$db = new MySql();
	$query = "SELECT * FROM Tema WHERE id_tema > 0 ORDER BY nom_tema ASC;";
	$consulta = $db->consulta($query);
	$combo = "";
	$i = 0;
	if ( $db->num_rows($consulta) > 0 ) {
		$combo= '<select name="cmbTema" id="Tema">';
		while ( $resultados = $db->fetch_array($consulta)) {
			if ( $i == 0 )
				$combo .= '<option value="-1">Selecciona...</option>' . "\n";
			$combo .= '<option value="' . $resultados[0] . '">' . $resultados[1] . "</option>\n";
			$i++;
		}
		$combo .= "</select>\n";
	}
	return $combo;
}

function comboEditorial() {
	$db = new MySql();
	$query = "SELECT * FROM Editorial WHERE id_editorial > 0 ORDER BY nom_editorial ASC;";
	$consulta = $db->consulta($query);
	$combo = "";
	$i = 0;
	if ( $db->num_rows($consulta) > 0 ) {
		$combo= '<select name="cmbEditorial" id="Editorial">';
		while ( $resultados = $db->fetch_array($consulta)) {
			if ( $i == 0 )
				$combo .= '<option value="-1">Selecciona...</option>' . "\n";
			$combo .= '<option value="' . $resultados[0] . '">' . $resultados[1] . "</option>\n";
			$i++;
		}
		$combo .= "</select>\n";
	}
	return $combo;
}

	
function comboAutor() {
	$db = new MySql();
	$query = "SELECT * FROM Autor WHERE id_autor > 0 ORDER BY nom_autor ASC;";
	$consulta = $db->consulta($query);
	$combo = "";
	$i = 0;
	if ( $db->num_rows($consulta) > 0 ) {
		$combo= '<select name="cmbAutor" id="Autor">';
		while ( $resultados = $db->fetch_array($consulta)) {
			if ( $i == 0 )
				$combo .= '<option value="-1">Selecciona...</option>' . "\n";
			$combo .= '<option value="' . $resultados[0] . '">' . $resultados[1] . "</option>\n";
			$i++;
		}
		$combo .= "</select>\n";
	}
	return $combo;
}

?>
