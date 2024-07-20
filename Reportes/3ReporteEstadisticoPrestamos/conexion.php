<?php  
	session_start();
	class MySQL {  
		private $conexion;  
		private $total_consultas;  
		public function MySQL() {  
			if(!isset($this->conexion)) {  
				$this->conexion = (mysqli_connect("localhost","root","","Sistema_Bibliotecario")) or die(mysql_error());   
			}  
		}  
		public function consulta($consulta){  
			$this->total_consultas++;  
			$resultado = mysqli_query($this->conexion,$consulta);  
			if(!$resultado){  
				echo 'MySQL Error: ' . mysqli_error($consulta);  
				exit;  
			}  

			return $resultado;   
		} 
		public function fetch_array($consulta){   
			return mysqli_fetch_array($consulta);  
		} 
		public function num_rows($consulta){   
			return mysqli_num_rows($consulta);  
		} 
		public function getTotalConsultas(){  
			return $this->total_consultas;  
		}  
	}
?>  