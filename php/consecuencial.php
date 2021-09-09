<?php
	session_start();
	$cia  = trim($_SESSION['cia']);
	include("conexion.php");

  	$prefi = $_POST['pre'];
  	$sql_sec="select PG_VALOR from ASD_P_PARGEN  where PG_MODULO='4' AND PG_PREFIJO = '$prefi' and PG_CODCIA='$cia'";

	$rs_secu=odbc_exec($con_db,$sql_sec);

	$rs_filas = odbc_num_rows($rs_secu);
	if($rs_filas>0){
		$prefij = odbc_result($rs_secu,"PG_VALOR");
	    
		echo $prefij;   
	} 


	

?>