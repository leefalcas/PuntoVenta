<?php 

class conexion{ 
	public function conectar() {
	    $uid ='sa';
        $pwd ='123';
       
      try{
         return $mbd = new PDO("odbc:Driver={SQL Server};Server=localhost;Database=BD_TITU; Uid=$uid;Pwd=$pwd;");
        
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   } 
 } 
	

 ?>