<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Eliminar editorial</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
        <div class="cajaContent">
            <div>
                <table class="tablaContent">
                        <tr>
                            <td colspan="2"><h1>Eliminar editorial</h1></td>
                        </tr>
                        <tr>
                            <td>ID: </td>
                        </tr>
                        <tr>
                          <td><input type="text" name="s_id_editorial" id="s_id_editorial" placeholder="Ingresa la clave de la editorial" ></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="button" name="register" id="register" value="Buscar"></td>
                        </tr>
                        <tr> 
                            <td> <?php include("borraEditorial.php");?> </td>
                        </tr>
						<tr>
							<td><input type="submit" class="button" name="elimina" id="elimina" value="Eliminar"></td>
						</tr>
                </table>
            </div>
        </div>
	</form>
  <a href="/Biblioteca/Catalogos/Editorial/index.php">Regresar</a>
</body>
</html>
