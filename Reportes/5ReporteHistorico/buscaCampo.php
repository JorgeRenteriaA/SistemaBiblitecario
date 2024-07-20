<?php
require("Conecta.php");
$buscar = $_GET['term'];
$query = mysqli_query($conn,"SELECT * FROM usuario WHERE nom_usuario LIKE '%".$buscar."%' ORDER BY id_usuario ASC");
while($row = mysqli_fetch_array($query)){
        $data[] = $row['id_usuario'].'-'.$row['nom_usuario'];
}
echo json_encode($data);
?>
