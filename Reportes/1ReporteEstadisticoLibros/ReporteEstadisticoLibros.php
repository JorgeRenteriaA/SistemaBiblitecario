<?php
	$conexion = mysqli_connect("localhost","root","");
	mysqli_select_db($conexion, "sistema_bibliotecario");
	$query="SELECT COUNT(id_biblioteca) AS Limite FROM biblioteca;";
	$cursor = mysqli_query($conexion, $query);
	$arr=mysqli_fetch_array($cursor);
	$limite=$arr[0];
	$total1=0;
	$total2=0;
	$sombreado = TRUE;
	echo '<table align="center" border="1" cellpadding="5" cellspacing="5" name="TablaG">
	<td align="center" bgcolor="white">  Biblioteca </td>
	<td align="center" bgcolor="white"> Total de Titulos </td>
	<td align="center" bgcolor="white"> Total de ejemplares</td>';
	for ($i = 1; $i <= $limite; $i++){
		$query="SELECT biblioteca.nom_biblioteca, COUNT(DISTINCT(libro_biblioteca.id_libro)), COUNT(libro_biblioteca.id_libro_biblioteca)
		FROM libro_biblioteca
		INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
		WHERE biblioteca.id_biblioteca = '$i';";
		$cursor = mysqli_query($conexion, $query);
		$arr=mysqli_fetch_array($cursor);
		$total1+=$arr[1];
		$total2+=$arr[2];
		if ($sombreado) {
			echo "<tr>\n";
			echo "<td bgcolor='#CCCCCC'>".$arr[0]."</td>";
			echo "<td bgcolor='#CCCCCC'>".$arr[1]."</td>";
			echo "<td bgcolor='#CCCCCC' align='RIGHT'>".$arr[2]."</td>";
			$sombreado = FALSE;
		}
		else {
			echo "<tr>\n";
			echo "<td>".$arr[0]."</td>";
			echo "<td>".$arr[1]."</td>";
			echo "<td align='right'>".$arr[2]."</td>";
			$sombreado = TRUE;
		}
	}

?>