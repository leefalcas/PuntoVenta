<?php

	include("conexion.php");

    //$usu=$_REQUEST['b'];
    //$usu = "PREGALONAV";
  	$find = filter_input(INPUT_POST, 'nombre');
	(strlen($find) < 1) ? $error = true : $error = false;
	$find = "%" . $find . "%";

	$sql_per="select ar_codigo,ar_descripcion from ioc_m_articulo  where ar_descripcion LIKE '$find'";

	$rs_person=odbc_exec($con_db,$sql_per);

	$rs_filas = odbc_num_rows($rs_person);
	while (odbc_fetch_array($rs_person)) {
		
        $datos[] = [
            "id" => odbc_result($rs_person,"ar_codigo"),
            "nombre" => odbc_result($rs_person,"ar_descripcion")
        ];
     }
   
	echo json_encode([
    "datos" => $datos,
    "error" => $error
	]);
		
?>