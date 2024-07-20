<?php

include('conecta.php');

if(isset($_POST['register'])){
	$usuario = $_POST["txtusuario"];
	$contra = $_POST["txtpassword"];
	$biblio = $_POST["cmbBiblioteca"];
	$query = mysqli_query($conexion_bd,"SELECT * FROM Empleado WHERE nom_empleado ='$usuario' and ape_empleado = '$contra'");
	$nr = mysqli_num_rows($query);
	$file = fopen("archTemp.txt","w") or die("Problema innesperado en el archivo");
	fwrite($file,"");
	$query = mysqli_query($conexion_bd,"SELECT * FROM Empleado WHERE nom_empleado ='$usuario' and ape_empleado = '$contra'");
	while($arr=mysqli_fetch_array($query)){
		fwrite($file,"$arr[0]\n");
		fwrite($file,"$arr[2]\n");
		fwrite($file,"$arr[1]\n");
	}
	$query = mysqli_query($conexion_bd,"SELECT * FROM Biblioteca WHERE id_biblioteca ='$biblio'");
	while($arr2=mysqli_fetch_array($query)){
		fwrite($file,"$arr2[0]\n");
		fwrite($file,"$arr2[1]\n");
	}
	if ($nr == 1 )
		{
			header("Location: Prestamos.php");
		}
	else
		{
		echo "<script> alert('Datos incorrectos, intenta de nuevo');window.location= 'index.php' </script>";
		echo "<br><br><a href='login.php'>Regresar</a>";
		}
}

?>
