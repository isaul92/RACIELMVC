<?php

class Connect{
   
    
    
    
    public static function conectar(){
        try {
            
        $conexion= new mysqli("localhost","root","","tienda_master");
        $conexion->query("SET NAMES 'utf8'");
             
        return $conexion;
        } catch (Exception $exc) {
            echo "error";
        }

        
   
        
    }


		public static function consulta($consulta){  
			$this->total_consultas++;  
			$resultado = $this->conexion->query($consulta);
			if(!$resultado){  
				echo 'MySQL Error: ' . mysql_error();  
				exit;  
			}  

			return $resultado;   
		} 
 
		public static function fetch_array($consulta){   
			return mysqli_fetch_array($consulta);  
		} 
 
		public static function num_rows($consulta){   
			return mysqli_num_rows($consulta);  
		}  

		public static function getTotalConsultas(){  
			return $this->total_consultas;  
		}  
	




}