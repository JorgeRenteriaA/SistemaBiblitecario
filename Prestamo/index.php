<?php
include "conexion.php";
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Login empleado</title>
     <link rel="stylesheet" href="estilo.css">
</head>
<body>
<form method="post" action="login.php">
	<div class="cajaContent">
	<table border="0">
			<tr>
			<td>
			<div class="formtlo">Iniciar sesión</div>
			<div class="ub1">Ingresa usuario</div>
				<input type="text" name="txtusuario">
			<div class="ub1"> Ingresa contraseña</div>
				<input type="password" name="txtpassword" id="txtpassword">
			<div class="ub1">
				<input type="checkbox" onclick="muestraContrasena()" >Mostrar contraseña
			</div>
			<?php
			include("login.php");
			echo '
			<div class="ub1">
			<div class="ub1">Ingresa biblioteca actual</div>
			' . comboBiblioteca() . '
			</div>
			' ?>
			<div align="center">
				<input type="submit" value="Ingresar" name="register" class="button2">

				<input type="reset" value="Cancelar" class="button3">
			</div>
</tr>
</td>
</table>
		</div>
	
</form>
<a href="/Biblioteca/index.php">Regresar</a>
</body>
<script>
  function muestraContrasena(){
      var tipo = document.getElementById("txtpassword");
      if(tipo.type == "password")
	  {
          tipo.type = "text";
      }
	  else
	  {
          tipo.type = "password";
      }
  }
</script>
</html>
<?php
function comboBiblioteca() {
	$db = new MySql();
	$query = "SELECT * FROM biblioteca WHERE id_biblioteca > 0 ORDER BY id_biblioteca ASC;";
	$consulta = $db->consulta($query);
	$combo = "";
	$i = 0;
	if ( $db->num_rows($consulta) > 0 ) {
		$combo= '<select name="cmbBiblioteca" id="Biblioteca" onchange="cargarLibros();">';
		while ( $resultados = $db->fetch_array($consulta)) {
			if ( $i == 0 ){
				$combo .= '<option value="-1">Selecciona...</option>' . "\n";
			}
			$combo .= '<option value="' . $resultados[0] . '">'. $resultados[0] .'. '. $resultados[1] . "</option>\n";
			$i++;
		}
		$combo .= "</select>\n";
	}
	return $combo;
}
 ?>

