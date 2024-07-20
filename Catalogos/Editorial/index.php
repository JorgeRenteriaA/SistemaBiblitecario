<html>
	<head>
	<meta charset="utf-8">
	<title>Editorial</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
    <?php
		echo '
		<form name="frmMenu" method="post" action="index.php">
			<div>
			<h1>Editorial</h1>
			<h1>Selecciona una opción</h1>
				<table border="0">
					 	<tr>
                            <td>Alta: </td>
                            <td>Baja: </td>
                            <td>Modificar: </td>
						</tr>
						<tr>
							<td><input type="button" onclick=window.location.href="Alta/index.php"; value="Entrar"/></td>
							<td><input type="button" onclick=window.location.href="Baja/index.php"; value="Entrar"/></td>
							<td><input type="button" onclick=window.location.href="Modifica/index.php"; value="Entrar"/></td>
						</tr>

				</table>
			<div>
		</form>
		';
    ?>
    <a href="/Biblioteca/Catalogos/index.php">Regresar</a>
	</body>
</html>  