<?php

	include("conexion.php");

	$html = '';
	$cod = $_POST['cod'];
	//$val = $_POST['val'];
	
	//$cod='7861161251358';
  
  	$sql_pro = 	"SELECT * FROM ioc_m_articulo art 
			    LEFT JOIN IOC_T_ARTXBODE abod ON (abod.arti_codigo = art.ar_codigo) 
			    WHERE art.ar_codigo='$cod'";
				

	$rs_pro=odbc_exec($con_db,$sql_pro);

	$rs_filas = odbc_num_rows($rs_pro);

	if($rs_filas>0){
	 	
		//limite docena
		$do = explode( '<', odbc_result($rs_pro,"AR_DOCENA") );
		$doc = explode( '>', $do[1] );
		$do1 = explode( '[', $doc[1] );
		$doc1 = explode( ']', $do1[1] );
		
		$uni = explode( '<', odbc_result($rs_pro,"AR_UNIDAD"));
		$unid = explode( '>', $uni[1] );
		$uni2 = explode( '[', $unid[1] );
		$unid2 = explode( ']', $uni2[1] );

		$bul = explode( '<', odbc_result($rs_pro,"AR_BULTO"));
		$bult = explode( '>', $bul[1] );
		$bul2 = explode( '[', $bult[1] );
		$bult2 = explode( ']', $bul2[1] );
		
		$datos['uni'] = $unid[0];
		$datos['uniMax'] = $unid2[0];
		$datos['preuni'] = odbc_result($rs_pro,"AR_PRECIO_DOLAR");
		$datos['doc'] = $doc[0];
		$datos['doceMax'] = $doc1[0];
		$datos['predoce'] = odbc_result($rs_pro,"AR_PRECIOPVN_DOLAR");
		$datos['bul'] = $bult[0];
		$datos['bulMax'] = $bult2[0];
		$datos['prebulto'] = odbc_result($rs_pro,"AR_PRECIODIS_DOLAR");
		$datos['stock'] = odbc_result($rs_pro,"ARTB_STOCKDISP");
		echo json_encode($datos);
			    
	}
	else{echo "no se encontro el valor";}	     
        
   

?>