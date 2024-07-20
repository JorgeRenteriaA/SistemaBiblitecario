<?php
	include("conecta.php");
	if(isset($_POST['register'])){
		if(strlen($_POST['s_id_Libro']) >= 1 && strlen($_POST['s_Titulo']) >= 1 && strlen($_POST['s_isbn']) >= 1){
			$id_libro = trim($_POST['s_id_Libro']);
			$titulo = trim($_POST['s_Titulo']);
			$editorial = trim($_POST['cmbEditorial']);
			$isbn = trim($_POST['s_isbn']);
			$autores = trim($_POST['areaTexto']);
			$temas = trim($_POST['areaTexto2']);
			$query= "INSERT INTO Libro VALUES ($id_libro,'$isbn','$titulo','$editorial')";
			$ejecutaQuery = mysqli_query($conexion_bd,$query);
			$n1 = substr_count($autores,",");
			$n2 = substr_count($temas,",");
			$arregloAutores = explode(",",$autores);
			$arregloTemas = explode(",",$temas);
			for ($i = 1; $i<=$n1; $i++) {
				if($n1==1){
					$query1 = "INSERT INTO Libro_Autor VALUES ('0','$id_libro','$arregloAutores[1]')";
					$ejecutaQuery1 = mysqli_query($conexion_bd,$query1);
				}else{
					$query1 = "INSERT INTO Libro_Autor VALUES ('0','$id_libro','$arregloAutores[$i]')";
					$ejecutaQuery1 = mysqli_query($conexion_bd,$query1);
				}
			}
			for ($i = 1; $i<=$n1; $i++ ) {
				if($n2==1){
					$query2 = "INSERT INTO Libro_Tema VALUES ('0','$id_libro','$arregloTemas[1]')";
					$ejecutaQuery2 = mysqli_query($conexion_bd,$query2);
				}else{
					try {
						$query2 = "INSERT INTO Libro_Tema VALUES ('0','$id_libro','$arregloTemas[$i]')";
						$ejecutaQuery2 = mysqli_query($conexion_bd,$query2);
					} catch (\Exception $e) {

					}

				}
			}
			if($ejecutaQuery){
				?>
				<h3 class="ok">Libro registrado</h3>
			<?php
			}else{
				?>
				<h3 class="bad">Error inesperado</h3>
			<?php
			}
			} 
			else{
				?>
				<h3 class="bad">Complete los campos</h3>
				<?php
		}
	}

?>
