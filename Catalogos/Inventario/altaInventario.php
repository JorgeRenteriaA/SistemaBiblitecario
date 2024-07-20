<?php
	include("conecta.php");
	$file = fopen("archTemp.txt","w") or die("Problema innesperado en el archivo");
	$cont = 0;
	fwrite($file,"");
	if(isset($_POST['register'])){
		if(strlen(strlen($_POST['s_cantidad'])) >= 1){
			$datos = trim($_POST['areaTexto']);
			$limite = substr_count($datos,",");
			$arregloDatos = explode(",",$datos);
			$cursor = mysqli_query($conexion_bd,"SELECT MAX(id_libro_biblioteca) max FROM Libro_Biblioteca;");
			$arr = mysqli_fetch_array($cursor);
			$cont2 = (int) $arr["max"];
			for ($i = 1; $i<=$limite; $i+=3) {
				$lim = (int) $arregloDatos[$i+2];
				for($j = 0; $j<$lim; $j++){
						$cont3 = $i+1;
						$cont2++;
						$query = "INSERT INTO Libro_Biblioteca VALUES ('0','$arregloDatos[$cont3]','$arregloDatos[$i]','1')";
						$ejecutaQuery = mysqli_query($conexion_bd,$query);
						fwrite($file,"$cont2");
						fwrite($file,"\n");
						$cont++;
					}
			}
			if($ejecutaQuery){
				?>
				<h3 class="ok">Inventario registrado</h3>
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
	$nFin = $cont;
?>
