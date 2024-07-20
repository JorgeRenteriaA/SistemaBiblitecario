<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Registrar usuario</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
		<h1>Registro usuario</h1>
		<input type="text" name="s_id_usuario" value='<?php echo IDMAX(); ?>' readonly>
		<input type="text" name="s_ape_usuario" placeholder="Apellidos">
		<input type="text" name="s_nom_usuario" placeholder="Nombre(s)">
		<input type="submit" name="register">
	</form>
<?php
function IDMax(){
	$conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
	$query = "SELECT MAX(id_usuario) FROM usuario;";
	$ejecutaQuery = mysqli_query($conexion_bd,$query);
	$arregloQuery = mysqli_fetch_array($ejecutaQuery);
	$IDM = ((int) $arregloQuery[0]) + 1;
	$IDMX = (string) $IDM;
	return $IDMX;
}
	include("altaUsuario.php");
?>
<a href="/Biblioteca/Catalogos/index.php">Regresar</a>
</body>	
</html>