<?php
include("conecta.php");
if(isset($_POST['register'])){
	if(strlen($_POST['s_id_usuario']) >= 1 && strlen($_POST['s_nom_usuario']) >= 1){
		$id_usuario = trim($_POST['s_id_usuario']);
		$ape_usuario = trim($_POST['s_ape_usuario']);
		$nom_usuario = trim($_POST['s_nom_usuario']);
		$query = "INSERT INTO usuario VALUES ($id_usuario,'$ape_usuario','$nom_usuario')";	
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
		if($ejecutaQuery){
			?>
			<h3 class="ok">Usuario registrado</h3>
		<?php
		}else{
			?>
			<h3 class="bad">Error inesperado</h3>
		<?php
		}
	} else{
			?>
			<h3 class="bad">Complete los campos</h3>

		<?php
	}
}
?>
