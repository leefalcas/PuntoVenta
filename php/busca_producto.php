<?php
	session_start();
	include("conexion.php");
	$html = '';
	
	$key = $_POST['key'];
	$bode = $_POST['bod'];
	$tip=$_POST['tipo'];
	
	
	if($_POST['tipo']==1){
		$sql_pro = "SELECT * FROM ioc_m_articulo art 
				    LEFT JOIN IOC_T_ARTXBODE abod ON (abod.arti_codigo = art.ar_codgene) 
				    WHERE art.AR_ESTADO = 'AC' AND art.ar_codigo = '$key' AND abod.ARTB_STOCKDISP >0 AND abod.BODE_CODIGO = $bode AND ABOD.ARTB_CODCIA = '$_SESSION[cia]' AND ABOD.ARTB_CODCIA = ART.AR_CODCIA ";
					
		$rs_pro=odbc_exec($con_db,$sql_pro);

		$rs_filas = odbc_num_rows($rs_pro);
		
		if($rs_filas >0){
				$datos["descrip"] = utf8_encode(odbc_result($rs_pro,"ar_descripcion"));
				$datos["iva"] = odbc_result($rs_pro,"ar_iva");
				$datos["unidad"] = odbc_result($rs_pro,"AR_UNIDAD");
				$datos["preuni"] = odbc_result($rs_pro,"AR_PRECIO_DOLAR");
				$datos["docena"] = odbc_result($rs_pro,"AR_DOCENA");
				$datos["predoce"] = odbc_result($rs_pro,"AR_PRECIOPVN_DOLAR");
				$datos["bulto"] = odbc_result($rs_pro,"AR_BULTO");
				$datos["prebulto"] = odbc_result($rs_pro,"AR_PRECIODIS_DOLAR");
				$datos["error"] = '';
				if(odbc_result($rs_pro,"artb_stock") == '')
					{ $datos["stock"] = 0;}
				else{$datos["stock"] = odbc_result($rs_pro,"artb_stock");}
		     echo json_encode($datos);	
		}
		else{$datos["error"] = "error";
			 echo json_encode($datos);}

	}//FIN DE BUSQUEDA POR CODIGO


	if($tip=='2')
	{  $find = "%".$key."%";
		$sql_per = "SELECT * FROM ioc_m_articulo art 
				    LEFT JOIN IOC_T_ARTXBODE abod ON (abod.arti_codigo = art.ar_codgene) 
				    WHERE art.AR_ESTADO = 'AC' AND art.ar_descripcion like '$find' AND abod.ARTB_STOCKDISP >0 AND abod.BODE_CODIGO = '$bode' AND ABOD.ARTB_CODCIA = '$_SESSION[cia]' AND ABOD.ARTB_CODCIA = ART.AR_CODCIA ORDER BY art.ar_descripcion  DESC";

		$rs_descri=odbc_exec($con_db,$sql_per);

		$rs_filas = odbc_num_rows($rs_descri);
		
		if($rs_filas >0){
		while (odbc_fetch_array($rs_descri)) {
		  
		 $html .= '<div><a class="suggest-element" data="'.utf8_encode(odbc_result($rs_descri,"ar_codigo")).'" id='.utf8_encode(odbc_result($rs_descri,"ar_codigo")).' >'.utf8_encode(odbc_result($rs_descri,"ar_descripcion")).'</a></div>';
		
	    }
	    echo $html;
	    
	  
	   }
	   else{
	   	echo $html;
	   }
		
		//odbc_close($con_db);	
	}


?>