<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Registrar autor</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
		<h1>Registro autor</h1>
		<input type="text" name="s_id_autor" placeholder="ID autor"  value='<?php echo IDMax(); ?>' readonly>
		<input type="text" name="s_nom_autor" placeholder="Nombre autor">
		<input type="submit" name="register">
	</form>
<?php
	function IDMax(){
		$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
		$query = "SELECT MAX(id_autor) FROM autor;";
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
		$arregloQuery = mysqli_fetch_array($ejecutaQuery);
		$IDM = ((int) $arregloQuery[0]) + 1;
		$IDMx = (string) $IDM;
		return $IDMx;
	}
	include("altaAutor.php");
?>
<a href="/Biblioteca/Catalogos/index.php">Regresar</a>
</body>	
</html>