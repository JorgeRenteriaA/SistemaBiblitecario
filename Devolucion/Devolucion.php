<?php
    include "conecta.php";
    $file = fopen("reporteTemp.txt","w") or die("Problema en crear el archivo");
    fwrite($file,"");
    $conexion = mysqli_connect("localhost","root","");
    mysqli_select_db($conexion, "sistema_bibliotecario");
    $registroDatos = [];
    if(isset($_POST['Devolver'])){
        $db = new MySql();
        $idp = $_POST["s_ID_prestamo"];
        $emp = $_POST["cmbEmpleado"];
        $fecha = $_POST["s_fecha_inicio"];
        $registroDatos = explode(",",$idp);
        echo '<table border="0" >
				<td align="center" bgcolor="white"> Libro devuelto </td>
				<td align="center" bgcolor="white"> IDLB </td>
				<td align="center" bgcolor="white"> IDPrestamo </td>
				';
        for ($i=0; $i<count($registroDatos); $i++){
		    $query="SELECT id_libro_biblioteca FROM det_prestamo WHERE id_det_prestamo = '".$registroDatos[$i]."';";
			$cursor = mysqli_query($conexion, $query);
			$arr=mysqli_fetch_array($cursor);
            $query="INSERT INTO devolucion VALUES ('0','$fecha','".$registroDatos[$i]."','$emp');";
			$cursor = mysqli_query($conexion, $query);
            $queryM = "SELECT libro.titulo AS Libro, libro_biblioteca.id_libro_biblioteca AS IDLB, det_prestamo.id_det_prestamo AS IDP FROM det_prestamo, libro,libro_biblioteca WHERE det_prestamo.id_det_prestamo='$registroDatos[$i]' AND libro_biblioteca.id_libro_biblioteca = det_prestamo.id_libro_biblioteca AND libro_biblioteca.id_libro=libro.id_libro;";
            $cursor = mysqli_query($conexion, $queryM);
            $arrQuery=mysqli_fetch_array($cursor);
            fwrite($file,"$registroDatos[$i]\n");
            echo "<tr>\n";
			echo "<td bgcolor='#CCCCCC'>".$arrQuery[0]."</td>";
			echo "<td bgcolor='#CCCCCC'>".$arrQuery[1]."</td>";
			echo "<td bgcolor='#CCCCCC'>".$arrQuery[2]."</td>";
        }
        echo "</table>";
    }	

?>