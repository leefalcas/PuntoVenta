<?php

	include("conexion.php");

	$html = '';
	$cod = $_POST['cod'];
	//$cod='PPX50';
  
  	$sql_per = "SELECT * FROM ioc_m_articulo art 
			    LEFT JOIN IOC_T_ARTXBODE abod ON (abod.arti_codigo = art.ar_codigo) 
			    WHERE art.ar_codigo = '$cod'";
				

	$rs_person=odbc_exec($con_db,$sql_per);

	$rs_filas = odbc_num_rows($rs_person);
	while (odbc_fetch_array($rs_person)) {

		$datos['descrip'] = utf8_encode(odbc_result($rs_person,"ar_descripcion"));
		$datos['iva'] = odbc_result($rs_person,"ar_iva");
		$datos['unidad'] = odbc_result($rs_person,"AR_UNIDAD");
		$datos['preuni'] = odbc_result($rs_person,"AR_PRECIO_DOLAR");
		$datos['docena'] = odbc_result($rs_person,"AR_DOCENA");
		$datos['predoce'] = odbc_result($rs_person,"AR_PRECIOPVN_DOLAR");
		$datos['bulto'] = odbc_result($rs_person,"AR_BULTO");
		$datos['prebulto'] = odbc_result($rs_person,"AR_PRECIODIS_DOLAR");

		if(odbc_result($rs_person,"artb_stock") == '')
			{ $datos['stock'] = 0;}
		else{$datos['stock'] = odbc_result($rs_person,"artb_stock");}

      
        
    }

    echo json_encode($datos);

?>