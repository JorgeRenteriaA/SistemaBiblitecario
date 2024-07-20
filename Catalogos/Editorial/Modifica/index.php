<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Modificar editorial</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
        <div class="cajaContent">
            <div>
                <table class="tablaContent">
					<tr>
						<td colspan="2"><h1>Modificar editorial</h1></td>
					</tr>
					<tr>
              			<td>ID: </td>
					</tr>
					<tr>
						<td><input type="text" name="s_id_editorial" id="s_id_editorial" placeholder="Ingresa el ID de la editorial"></td>
					</tr>
					<tr >
						
					</tr>
                    <tr>
                        <td><input type="submit" class="button" name="register" id="register" value="Buscar"></td>
                    </tr>
                </table>
				<?php
					include("modificaEditorial.php");
				?>
            </div>
        </div>
	</form>
  <a href="/Biblioteca/Catalogos/Editorial/index.php">Regresar</a>
</body>
</html>
