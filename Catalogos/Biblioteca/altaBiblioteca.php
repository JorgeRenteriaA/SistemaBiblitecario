<?php
include("conecta.php");
if(isset($_POST['register'])){
	if(strlen($_POST['s_id_biblioteca']) >= 1 && strlen($_POST['s_nom_biblioteca']) >= 1){
		$id_biblioteca = trim($_POST['s_id_biblioteca']);
		$nom_biblioteca = trim($_POST['s_nom_biblioteca']);
		$query="INSERT INTO biblioteca VALUES ($id_biblioteca,'$nom_biblioteca')";	
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
		if($ejecutaQuery){
			?>
			<h3 class="ok">biblioteca registrada</h3>
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
