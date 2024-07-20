<html>
	<head>
	<meta charset="utf-8">
	<title>Sistema bibliotecario</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
    <?php
		echo '
		<form name="frmMenu" method="post" action="index.php">
			<div>
			<h1>Catálogos</h1>
			<h1>Selecciona una opción</h1>
				<table border="0">
					 	<tr>
                            <td>Autor: </td>
                            <td>Biblioteca: </td>
                            <td>Editorial: </td>
						</tr>
						<tr>
							<td><input type="button" onclick=window.location.href="Autor/index.php"; value="Entrar"/></td>
							<td><input type="button" onclick=window.location.href="Biblioteca/index.php"; value="Entrar"/></td>
							<td><input type="button" onclick=window.location.href="Editorial/index.php"; value="Entrar"/></td>
						</tr>
						<tr>
                            <td>Empleado: </td>
                            <td>Inventario: </td>
                            <td>Libro: </td>
					 	</tr>
						<tr>
                            <td><input type="button" onclick=window.location.href="Empleado/index.php"; value="Entrar"/></td>
                            <td><input type="button" onclick=window.location.href="Inventario/index.php"; value="Entrar"/></td>
                            <td><input type="button" onclick=window.location.href="Libro/index.php"; value="Entrar"/></td>
						</tr>
						<tr>
							<td>Tema: </td>
                            <td>Usuario: </td>
							<td></td>
						</tr>
						<tr>
							<td><input type="button" onclick=window.location.href="Tema/index.php"; value="Entrar"/></td>
                            <td><input type="button" onclick=window.location.href="Usuario/index.php"; value="Entrar"/></td>
							<td></td>
						</tr>

				</table>
			<div>
		</form>
		';
    ?>
    <a href="/Biblioteca/index.php">Regresar</a>
	</body>
</html>  