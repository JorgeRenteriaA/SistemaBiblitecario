<?php
		if(isset($_POST['report'])){
			$file = fopen("reporteTemp.txt","w") or die("Problema innesperado en el archivo");
			fwrite($file,"");
			$conexion = mysqli_connect("localhost","root","");
			mysqli_select_db($conexion, "sistema_bibliotecario");
			$sombreado = TRUE;
			$f1 = explode("/",$_POST["s_fecha_inicio"]);
			$f2 = explode("/",$_POST["s_fecha_termino"]);
			$f1f = $_POST["s_fecha_inicio"];
			$f2f = $_POST["s_fecha_termino"];
			$combo = $_POST["cmbBiblioteca"];
			fwrite($file,"$f1f\n");
			fwrite($file,"$f2f\n");
			fwrite($file,"$combo\n");
			echo '<table border="0" >
				<td align="center" bgcolor="white"> Biblioteca </td>
				<td align="center" bgcolor="white"> Titulo </td>
				<td align="center" bgcolor="white"> Usuario </td>
				<td align="center" bgcolor="white"> Fecha de préstamo </td>
				<td align="center" bgcolor="white"> Fecha de devolución </td>
				';
			if($_POST["cmbBiblioteca"]<>-2){
				$query="SELECT biblioteca.nom_biblioteca AS biblio,libro.titulo AS title, usuario.nom_usuario AS persona, usuario.ape_usuario AS Apellido, enc_prestamo.fecha_prestamo AS fecha1, enc_prestamo.fec_lim_devolucion AS fecha2 FROM det_prestamo
				INNER JOIN enc_prestamo ON enc_prestamo.id_prestamo = det_prestamo.id_enc_prestamo
				INNER JOIN libro_biblioteca ON libro_biblioteca.id_libro_biblioteca = det_prestamo.id_libro_biblioteca
				INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro
				INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca 
				INNER JOIN usuario ON usuario.id_usuario = enc_prestamo.id_usuario
				WHERE enc_prestamo.fecha_prestamo>='$f1[0]' AND enc_prestamo.fec_lim_devolucion<='$f2[0]' AND libro_biblioteca.id_biblioteca = '".$_POST["cmbBiblioteca"]."'
				ORDER BY fecha1 ASC;";
				$cursor = mysqli_query($conexion, $query);
				while($arregloQuery=mysqli_fetch_array($cursor)){
					if ($sombreado) {
						echo "<tr>\n";
						echo "<td bgcolor='#CCCCCC'>".$arregloQuery[0]."</td>";
						echo "<td bgcolor='#CCCCCC'>".$arregloQuery[1]."</td>";
						echo "<td bgcolor='#CCCCCC'>".$arregloQuery[2]." ".$arregloQuery[3]."</td>";
						echo "<td bgcolor='#CCCCCC' align='RIGHT'>".$arregloQuery[4]."</td>";
						echo "<td bgcolor='#CCCCCC'>".$arregloQuery[5]."</td>";
						$sombreado = FALSE;
					}
					else {
						echo "<tr>\n";
						echo "<td align='right'>".$arregloQuery[0]."</td>";
						echo "<td align='right'>".$arregloQuery[1]."</td>";
						echo "<td align='right'>".$arregloQuery[2]." ".$arregloQuery[3]."</td>";
						echo "<td align='right'>".$arregloQuery[4]."</td>";
						echo "<td align='right'>".$arregloQuery[5]."</td>";
						$sombreado = TRUE;
					}
				}
			}else{
				$query="SELECT COUNT(id_biblioteca) AS Limite FROM biblioteca;";
				$cursor = mysqli_query($conexion, $query);
				$arregloQuery=mysqli_fetch_array($cursor);
				$limite=$arregloQuery[0];
				for ($i = 1; $i <= $limite; $i++){
					$query="SELECT biblioteca.nom_biblioteca AS biblio,libro.titulo AS title, usuario.nom_usuario AS persona, usuario.ape_usuario AS Apellido, enc_prestamo.fecha_prestamo AS fecha1, enc_prestamo.fec_lim_devolucion AS fecha2 FROM det_prestamo INNER JOIN enc_prestamo ON enc_prestamo.id_prestamo = det_prestamo.id_enc_prestamo INNER JOIN libro_biblioteca ON libro_biblioteca.id_libro_biblioteca = det_prestamo.id_libro_biblioteca INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca INNER JOIN usuario ON usuario.id_usuario = enc_prestamo.id_usuario WHERE enc_prestamo.fecha_prestamo>='$f1[0]' AND enc_prestamo.fec_lim_devolucion<='$f2[0]' AND libro_biblioteca.id_biblioteca = '$i' ORDER BY fecha1 ASC;";
					$cursor2 = mysqli_query($conexion, $query);
					while($arregloQuery=mysqli_fetch_array($cursor2)){
						if ($sombreado) {
							echo "<tr>\n";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[0]."</td>";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[1]."</td>";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[2]." ".$arregloQuery[3]."</td>";
							echo "<td bgcolor='#CCCCCC' align='RIGHT'>".$arregloQuery[4]."</td>";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[5]."</td>";
							$sombreado = FALSE;
						}
						else {
							echo "<tr>\n";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[0]."</td>";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[1]."</td>";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[2]." ".$arregloQuery[3]."</td>";
							echo "<td bgcolor='#CCCCCC' align='RIGHT'>".$arregloQuery[4]."</td>";
							echo "<td bgcolor='#CCCCCC'>".$arregloQuery[5]."</td>";
							$sombreado = TRUE;
						}
					}
				}
        	}
		
        echo "</table>";
	}
?>
