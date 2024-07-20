<?php
include("conecta.php");
if(isset($_POST['register'])){
	if(strlen($_POST['s_id_autor']) >= 1 && strlen($_POST['s_nom_autor']) >= 1){
		$id_autor = trim($_POST['s_id_autor']);
		$nom_autor = trim($_POST['s_nom_autor']);
		$query= "INSERT INTO autor VALUES ($id_autor,'$nom_autor')";	
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
		if($ejecutaQuery){
			?>
				<h3 class="ok">Autor registrado</h3>
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
