<?php
include("conecta.php");
if(isset($_POST['register'])){
	if(strlen($_POST['s_id_tema']) >= 1 && strlen($_POST['s_nom_tema']) >= 1){
		$id_tema = trim($_POST['s_id_tema']);
		$nom_tema = trim($_POST['s_nom_tema']);
		$query = "INSERT INTO tema VALUES ($id_tema,'$nom_tema');";	
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
		if($ejecutaQuery){
			?>
			<h3 class="ok">tema registrado</h3>
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
