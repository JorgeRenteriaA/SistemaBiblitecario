<?php
include("conecta.php");
if(isset($_POST['register'])){
	if(strlen($_POST['s_id_empleado']) >= 1 && strlen($_POST['s_nom_empleado']) >= 1){
		$id_empleado = trim($_POST['s_id_empleado']);
		$ape_empleado = trim($_POST['s_ape_empleado']);
		$nom_empleado = trim($_POST['s_nom_empleado']);
		$query = "INSERT INTO empleado VALUES ($id_empleado,'$ape_empleado','$nom_empleado')";	
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
		if($ejecutaQuery){
			?>
			<h3 class="ok">empleado registrado</h3>
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