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
			<h1>Sistema Bibliotecario</h1>
			<h1>Selecciona una opción</h1>
				<table border="0">
					 	<tr>
                            <td>Catálogos: </td>
                            <td>Reportes: </td>
                            <td>Préstamo: </td>
                            <td>Devolución: </td>
					 	</tr>
						<tr>
                            <td><img src=Imagenes/Catalogo.jpg></td>
                            <td><img src=Imagenes/Reporte.jpg></td>
                            <td><img src=Imagenes/Prestamo.jpg></td>
                            <td><img src=Imagenes/Devolucion.png></td>
						</tr>
						<tr>
                            <td><input type="button" onclick=window.location.href="Catalogos/index.php"; value="Entrar"/></td>
                            <td><input type="button" onclick=window.location.href="Reportes/index.php"; value="Entrar"/></td>
                            <td><input type="button" onclick=window.location.href="Prestamo/index.php"; value="Entrar"/></td>
                            <td><input type="button" onclick=window.location.href="Devolucion/index.php"; value="Entrar"/></td>
						</tr>
				</table>
			<div>
		</form>
		';
    ?>
    </body>
</html>  