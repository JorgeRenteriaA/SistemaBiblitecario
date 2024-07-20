<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Registro empleado</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
		<h1>Registro empleado</h1>
		<input type="text" name="s_id_empleado" placeholder="ID empleado" value='<?php echo IDMax(); ?>' readonly>
		<input type="text" name="s_ape_empleado" placeholder="Apellidos">
		<input type="text" name="s_nom_empleado" placeholder="Nombre(s)">
		<input type="submit" name="register">
	</form>
<?php
function IDMax(){
	$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
	$query = "SELECT MAX(id_empleado) FROM empleado;";
	$ejecutaQuery = mysqli_query($conexion_bd,$query);
	$arregloQuery = mysqli_fetch_array($ejecutaQuery);
	$IDM = ((int) $arregloQuery[0]) + 1;
	$IDMx = (string) $IDM;
	return $IDMx;
}
	include("altaEmpleado.php");
?>
<a href="/Biblioteca/Catalogos/index.php">Regresar</a>
</body>	
</html>