<?php
include("conecta.php");
if(isset($_POST['register'])){
	if(strlen($_POST['s_id_editorial']) >= 1 && strlen($_POST['s_nom_editorial']) >= 1){
		$id_editorial = trim($_POST['s_id_editorial']);
		$nom_editorial = trim($_POST['s_nom_editorial']);
		$query = "INSERT INTO editorial VALUES ($id_editorial,'$nom_editorial')";	
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
		if($ejecutaQuery){
			?>
			<h3 class="ok">Editorial registrada</h3>
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
