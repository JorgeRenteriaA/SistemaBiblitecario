<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Registrar tema</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
		<h1>Registro tema</h1>
		<input type="text" name="s_id_tema" placeholder="ID tema" value='<?php echo IDMax(); ?>' readonly>
		<input type="text" name="s_nom_tema" placeholder="Nombre tema">
		<input type="submit" name="register">
	</form>
<?php
function IDMax(){
	$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
	$query = "SELECT MAX(id_tema) FROM tema;";
	$ejecutaQuery = mysqli_query($conexion_bd,$query);
	$arregloQuery = mysqli_fetch_array($ejecutaQuery);
	$IDM = ((int) $arregloQuery[0]) + 1;
	$IDMX = (string) $IDM;
	return $IDMX;
}
	include("altaTema.php");
?>
<a href="/Biblioteca/Catalogos/index.php">Regresar</a>
</body>	
</html>