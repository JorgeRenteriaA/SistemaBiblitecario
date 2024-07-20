<?php
	include "conexion.php";
	include "login.php";
?>
<html>
	<head>
	<meta charset="utf-8">
	<title>Realizar préstamo</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
	<form name="frmCombos" method="post">
		<div class="cajaContent">
			<table class="tablaContent" name = "table1" id = "table1" border="1">
				<tr>
				<td colspan = "6"><h1>Realizar préstamo</h1></td>
				</tr>
				<tr>
					<td>Usuario: </td>
					<td>Empleado:</td>
				</tr>
				<tr>
					<td><input type="text" name="txt1" id="txt1" placeholder="Ingresa nombre de usuario"></td>
					<?php $reg = comboDatos(); ?>
					<td><input type="text" value="<?php echo $reg[0].'.- '.$reg[1].' '.$reg[2]; ?>" readonly></td>
				<tr>
					<td>Biblioteca:</td>
					<td><input type="text" value="<?php echo $reg[3].'.- '.$reg[4]; ?>" readonly></td>
				</tr>
				<tr>
					<td>Fecha Préstamo: </td>
					<td>Fecha Lim Devolucion: </td>
				</tr>
				<tr>
					<td><?php echo fechaInicio() ?></td>
					<td><?php echo fechaFin() ?></td>
				</tr>
				<tr>
					<td>Libro:</td>
					<td><?php echo comboLibro() ?></td>
				</tr>
				<tr>
					<td><input type="button" id="AgregarLibro"  value="Agregar" onclick="agregaTabla();" class="button"/></td>
					<td><input type="submit" name="enviar" value="Prestar" class="button"/></td>
				</tr>
				<tr>
					<td><input type="button" onclick=window.location.href="pdf.php"; value="PDF" class="button2"/></td>
					<td><a href="/Biblioteca/index.php">Regresar</a></td>
				</tr>
				<tr>
					<textarea cols="20" rows="2" id="txtM" name="txtM" readonly style="resize: none" class="invisible"></textarea>
					<textarea cols="20" rows="2" id="txtM2" name="txtM2" readonly style="resize: none" class="invisible"></textarea>
				</tr>
				<td colspan="3">
				<table border="1" id=tabla2 class="tablaContent2">
					<tr>
					<td><p>Identificador</p></td>
					<td><p>Titulo</p></td>
					</tr>
					</table>
				</td>
			</table>
		</div>
	</form>
	<script type="text/javascript">
		$(function(){
			$("#txt1").autocomplete({
				source : 'buscaCampo.php'
			});
		});
		var arr = [];
		var arr2 = [];
		var datosF = "";
		var datos2 = "";
		function agregaTabla(){
			var combo = document.getElementById("libro");
			var selected = combo.options[combo.selectedIndex].text;
			var datos = selected.split('/');
			document.getElementById("tabla2").insertRow(-1).innerHTML = '<tr>\n<td>'+combo.value+'</td>\n<td>'+datos[2]+'</td>\n</tr>';
			arr.push(datos[0]);
			arr2.push(datos[2]);
			datosF =datosF +  "*UPDATE libro_biblioteca SET id_estatus='2' WHERE id_libro_biblioteca='"+datos[1]+"';";
			datos2 = datos2+";"+datos[1];
			document.getElementById("txtM").value = datosF;
			document.getElementById("txtM2").value = datos2;
		}
	</script>
    </body>
</html>
<?php
	$conexion = mysqli_connect("localhost","root","");
	mysqli_select_db($conexion, "sistema_bibliotecario");
	function fechaInicio(){
		date_default_timezone_set('America/Mexico_City');
		$hoy = date('Y-m-d');
		return '<input type="date" id="txt1" name="s_fecha_inicio" min="0000-00-00" max="2100-12-31" value = "'.$hoy.'">';
	}
	function fechaFin(){
		date_default_timezone_set('America/Mexico_City');
		$hoy = date('Y-m-d');
		$l1 = (int) date('d');
		$l1 = $l1+5;
		$l2 = '0'.(string) $l1;
		$l2 = date('Y-m-').$l2;
		return '<input type="date" id="txt2" name="s_fecha_termino" min="0000-00-00" max="2100-12-31" value ="'.$l2.'">';
	}
	function comboDatos() {
		$arrArch = [];
		$arch = fopen("archTemp.txt", "r");
		$ia = 0;
		while (!feof($arch)){
		    $linea = fgets($arch);
		    $arrArch[$ia]=$linea;
		    $ia++;
		}
		fclose($arch);
		return $arrArch;
	}
	function comboLibro(){
		$r = comboDatos();
		$db = new MySql();
		$query = "SELECT id_libro_biblioteca AS ID,id_biblioteca AS IDLB,id_libro as a,
		(SELECT titulo FROM libro WHERE id_libro=a) AS Title FROM libro_biblioteca
		WHERE id_biblioteca > 0 AND id_estatus = '1' AND id_biblioteca='$r[3]' ORDER BY 'IDLB' ASC;";
		$consulta = $db->consulta($query);
		$combo = "";
		if ( $db->num_rows($consulta) > 0 ) {
			$combo= '<select name="cmbLibros" id="libro">';
			$i = 0;
			while ( $resultados = $db->fetch_array($consulta)) {
				if ( $i == 0 ){
					$combo .= '<option value="-1">Biblioteca \ ID \ Titulo</option>' . "\n";
				}
				$combo .= '<option value="' . $resultados[0] . '">' . $resultados[1].'/'. $resultados[0].'/'. $resultados[3]. "</option>\n";
				$i++;
			}
			$combo .= "</select>\n";
		}
		return $combo;
	}
	function comboUsuario() {
		$db = new MySql();
		$query = "SELECT * FROM Usuario WHERE id_usuario > 0 ORDER BY nom_usuario ASC;";
		$consulta = $db->consulta($query);
		$combo = "";
		$i = 0;
		if ( $db->num_rows($consulta) > 0 ) {
			$combo= '<select name="cmbUsuario" id="Usuario">';
			while ( $resultados = $db->fetch_array($consulta)) {
				if ( $i == 0 )
					$combo .= '<option value="-1">Selecciona...</option>' . "\n";
				$combo .= '<option value="' . $resultados[0] . '">' . $resultados[2].' '. $resultados[1] ."</option>\n";
				$i++;
			}
			$combo .= "</select>\n";
		}
		return $combo;
	}
	if(isset($_POST["enviar"])){
		$regis = comboDatos();
		$file = fopen("Detalles.txt","w") or die("Problema en crear el archivo");
        fwrite($file,"");
		$id_usu = explode("-",$_POST["txt1"]);
		$f1 = $_POST["s_fecha_inicio"];
		$f2 = $_POST["s_fecha_termino"];
		fwrite($file,"$regis[1]");
		fwrite($file,"$regis[2]");
		fwrite($file,"$regis[4]");
		fwrite($file,"$id_usu[0] $id_usu[1]\n");
		fwrite($file,"$f1\n");
		fwrite($file,"$f2\n");
		$qry1 = "INSERT INTO enc_prestamo VALUES ('0','$regis[0]','$id_usu[0]','".$f1."','".$f2."');";
		$resultado_qry = mysqli_query($conexion_bd,$qry1);
		$regQueries2 = explode("*",$_POST["txtM"]);

		$qry2 = "SELECT MAX(id_prestamo) FROM enc_prestamo;";
		$resultado_qry2 = mysqli_query($conexion_bd,$qry2);
		$regQueries3 = mysqli_fetch_array($resultado_qry2);
		$c = ((int) $regQueries3[0]);
		$clave = (string) $c;
		fwrite($file,"$clave\n");
		$qry2 = "SELECT MAX(id_det_prestamo) FROM det_prestamo;";
		$resultado_qry2 = mysqli_query($conexion_bd,$qry2);
		$regQueries3 = mysqli_fetch_array($resultado_qry2);
		$c2 = ((int) $regQueries3[0])+1;
		$c3 = $c2;
		$regQueries4 = explode(";",$_POST["txtM2"]);
		$cont = count($regQueries4)-1;
		fwrite($file,"$cont\n");
		for($i = 1; $i<count($regQueries2); $i++){
			//$resultado_qry = mysqli_query($conexion_bd,$regQueries2[$i]);
			$qry3 = "INSERT INTO det_prestamo VALUES ('$c2','$clave','".$regQueries4[$i]."');";
			$resultado_qry3 = mysqli_query($conexion_bd,$qry3);
			fwrite($file,"$c2\n");
			$c2++;
		}
		if($resultado_qry3){
			echo '<h3 class="ok">Prestamo registrado registrado con exito</h3>';
		}else{
			echo '<h3 class="bad">Error inesperado</h3>';
		}
	}

?>
