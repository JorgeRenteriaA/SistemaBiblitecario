<?php
			$conexion = mysqli_connect("localhost","root","");
			mysqli_select_db($conexion, "sistema_bibliotecario");
			if(isset($_POST['report'])){
				$file = fopen("reporteTemp.txt","w") or die("Problema en crear el archivo");
				fwrite($file,"");
				$cveBiblioteca=TRIM($_POST['cmbBiblioteca']);
				$sombreado = TRUE;
				fwrite($file,"$cveBiblioteca\n");
				echo '</table>
				<table align="center" border="1" cellpadding="5" cellspacing="5" name="Tabla2" class="tablaContent2">
				<td align="center" bgcolor="white"> Titulo </td>
				<td align="center" bgcolor="white">  Biblioteca </td>
				<td align="center" bgcolor="white"> Cantidad </td>
				';
				if ($cveBiblioteca==-2) {
					$query="SELECT DISTINCT(libro.titulo), biblioteca.nom_biblioteca,
									(SELECT COUNT(*) FROM libro_biblioteca WHERE libro_biblioteca.id_libro = libro.id_libro AND libro_biblioteca.id_biblioteca = biblioteca.id_biblioteca) AS num
									FROM libro_biblioteca
									INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro
									INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
									ORDER BY  biblioteca.nom_biblioteca ASC;
									";
				}else{
					$query="SELECT DISTINCT(libro.titulo), biblioteca.nom_biblioteca,
									(SELECT COUNT(*) FROM libro_biblioteca WHERE libro_biblioteca.id_libro = libro.id_libro AND libro_biblioteca.id_biblioteca = biblioteca.id_biblioteca) AS num
									FROM libro_biblioteca
									INNER JOIN libro ON libro.id_libro = libro_biblioteca.id_libro
									INNER JOIN biblioteca ON biblioteca.id_biblioteca = libro_biblioteca.id_biblioteca
									WHERE biblioteca.id_biblioteca = '$cveBiblioteca'
									ORDER BY  biblioteca.nom_biblioteca ASC;
									";
				}
				$cursor = mysqli_query($conexion, $query);
				while ($arr=mysqli_fetch_array($cursor)) {
					if ($sombreado) {
						echo "<tr>\n";
						echo "<td align='RIGHT' bgcolor='#CCCCCC'>".$arr[0]."</td>";
						echo "<td align='RIGHT' bgcolor='#CCCCCC'>".$arr[1]."</td>";
						echo "<td align='RIGHT' bgcolor='#CCCCCC'>".$arr[2]."</td>";
						$sombreado = FALSE;
					}
					else {
						echo "<tr>\n";
						echo "<td align='RIGHT'>".$arr[0]."</td>";
						echo "<td align='RIGHT'>".$arr[1]."</td>";
						echo "<td align='RIGHT'>".$arr[2]."</td>";
						$sombreado = TRUE;
					}
				}
				echo "</table>";
				if($cursor){
				}else{
					?>
					<h3 class="bad">Error inesperado</h3>
					<?php
				}
				}

		?>
