<?php
		if(isset($_POST['report'])){
			$file = fopen("Reportetemp.txt","w") or die("Problema en crear el archivo");
			fwrite($file,"");
			$conexion = mysqli_connect("localhost","root","");
			mysqli_select_db($conexion, "sistema_bibliotecario");
			$query="SELECT COUNT(id_biblioteca) AS Limite FROM biblioteca;";
			$cursor = mysqli_query($conexion, $query);
			$arregloQuery=mysqli_fetch_array($cursor);
			$limite=$arregloQuery[0];
			$total1=0;
			$total2=0;
			$f1 = explode("/",$_POST["s_fecha_inicio"]);
			$f2 = explode("/",$_POST["s_fecha_termino"]);
			$f1f = $_POST["s_fecha_inicio"];
			$f2f = $_POST["s_fecha_termino"];
			fwrite($file,"$f1f\n");
			fwrite($file,"$f2f\n");
			$sombreado = TRUE;
			echo '<table align="center" border="1" cellpadding="5" cellspacing="5" name="TablaG">
			<td align="center" bgcolor="white">  Biblioteca </td>
			<td align="center" bgcolor="white"> Total de Préstamos </td>';
			for ($i = 1; $i <= $limite; $i++){
				$query="SELECT biblioteca.nom_biblioteca, COUNT(libro_biblioteca.id_libro_biblioteca)
				FROM libro_biblioteca
				INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
				INNER JOIN det_prestamo ON det_prestamo.id_libro_biblioteca = libro_biblioteca.id_libro_biblioteca
				INNER JOIN enc_prestamo ON enc_prestamo.id_prestamo = det_prestamo.id_enc_prestamo
				WHERE biblioteca.id_biblioteca = '$i' AND enc_prestamo.fecha_prestamo >= '$f1[0]' AND enc_prestamo.fecha_prestamo <= '$f2[0]';";
				$cursor = mysqli_query($conexion, $query);
				$arregloQuery=mysqli_fetch_array($cursor);
				$total1+=$arregloQuery[1];
				if ($sombreado) {
					echo "<tr>\n";
					echo "<td bgcolor='#CCCCCC'>".$arregloQuery[0]."</td>";
					echo "<td bgcolor='#CCCCCC'>".$arregloQuery[1]."</td>";
					$sombreado = FALSE;
				}
				else {
					echo "<tr>\n";
					echo "<td>".$arregloQuery[0]."</td>";
					echo "<td>".$arregloQuery[1]."</td>";
					$sombreado = TRUE;
				}
		}
	}
?>