<?php

	include("conexion.php");

	$html = '';
	$cod = $_POST['cod'];
	$val = $_POST['val'];
	
	//$cod='PPX50';
  
  	$sql_pro = "SELECT ar_precio_dolar,ar_preciodis_dolar,ar_preciopvn_dolar FROM ioc_m_articulo  WHERE ar_codigo = '$cod'";
		

	$rs_pro=odbc_exec($con_db,$sql_pro);

	$rs_filas = odbc_num_rows($rs_pro);

	if($rs_filas>0){
	 
		if($val==1){
			$busca=odbc_result($rs_pro,"ar_precio_dolar");
		}
		if($val==2){
			$busca=odbc_result($rs_pro,"ar_preciodis_dolar");

		}
		if($val==3){
			$busca=odbc_result($rs_pro,"ar_preciopvn_dolar");

		}	
		 echo $busca;	    
			    
	}
	else{echo "no se encontro el valor";}	     
        
   

?>