<?php
include("conecta.php");
if(isset($_POST['elimina'])){
    $arrArch = [];
    $arch = fopen("archTemp.txt", "r");
    $ia = 0;
    while (!feof($arch)){
        $linea = fgets($arch);
        $arrArch[$ia]=$linea;
        $ia++;
    }
    fclose($arch);
    $query= "DELETE FROM editorial WHERE id_editorial='$arrArch[0]';";
    $ejecutaQuery = mysqli_query($conexion_bd,$query);
    if($ejecutaQuery){
        ?>
            <h3 class="ok">Se ha eliminado la editorial</h3>
        <?php
    }else{
        ?>
            <h3 class="bad">Error inesperado</h3>
        <?php
    }
}

if(isset($_POST['register'])){
	if(strlen($_POST['s_id_editorial']) >= 1){
		$id_editorial = trim($_POST['s_id_editorial']);
        $file = fopen("archTemp.txt","w") or die("Problema innesperado en el archivo");
        fwrite($file,"");
        fwrite($file,"$id_editorial");
		$query= "SELECT * FROM editorial WHERE id_editorial='$id_editorial';";
		$ejecutaQuery = mysqli_query($conexion_bd,$query);
        echo '<table align="center" border="1" cellpadding="5" cellspacing="5" name="TablaG" class="tablaContent2">
            <td align="center" bgcolor="white"> ID </td>
            <td align="center" bgcolor="white"> NOMBRE </td>';
        while($arr = mysqli_fetch_array($ejecutaQuery)){
            echo "<tr>\n";
            echo "<td bgcolor='#CCCCCC' align='RIGHT'>".$arr[0]."</td>";
            echo "<td bgcolor='#CCCCCC' align='RIGHT'>".$arr[1]."</td>";
            echo "<tr>\n";
        }
        echo "</table>";
        if($ejecutaQuery){
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
