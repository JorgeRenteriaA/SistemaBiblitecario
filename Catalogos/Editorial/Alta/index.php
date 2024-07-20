<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Registrar editorial</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<form method="post">
        <div class="cajaContent">
            <div>
                <table class="tablaContent">
                        <tr>
                            <td><h1>Alta editorial</h1></td>
                        </tr>
                        <tr  rowspan="2">
                            <td>ID: </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="s_id_editorial" id="s_id_editorial" value='<?php echo IDMax(); ?>' readonly></td>
                        </tr>
                        <tr  rowspan="2">
                            <td>Nombre: </td>
                        </tr>
                        <tr >
                            <td><input type="text" name="s_nom_editorial" id="s_nom_editorial" placeholder="Ingresa el nombre" ></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="button" name="register" id="register" value="Registrar"> </td>
                        </tr>
                </table>
            </div>
        </div>
	</form>
<?php
    function IDMax(){
        $conexion_bd = mysqli_connect("localhost","root","","sistema_bibliotecario");
        $query = "SELECT MAX(id_editorial) FROM editorial;";
        $ejecutaQuery = mysqli_query($conexion_bd,$query);
        $arregloQuery = mysqli_fetch_array($ejecutaQuery);
        $IDM = ((int) $arregloQuery[0]) + 1;
        $IDMx = (string) $IDM;
        return $IDMx;
    }
	include("altaEditorial.php");
?>
<a href="/Biblioteca/Catalogos/Editorial/index.php">Regresar</a>
</body>
</html>
