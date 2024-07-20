<?php
$conn = new mysqli("localhost", "root", "", "sistema_bibliotecario");
if($conn->connect_error){
    die("Conexion fallida". $conn->connect_error);
}else {
}
?>
