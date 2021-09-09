<?php
	session_start();
	include("conexion.php");
	
	if(isset($_POST['codcli']))
	{ $cod = $_POST['codcli'];
	 	
	// $cod="00003556";
	$sql_pro = "SELECT * from ASD_M_PERSON per INNER JOIN asd_m_claper cla on (cla.CP_TIPO_PERS = '01') 
			  where ((per.PE_CODIGO = '$cod' AND PE_CODCIA='$_SESSION[cia]') and (cla.CP_PERS = per.PE_CODIGO and per.PE_ESTADO <>'EL')) AND CP_CODCIA='$_SESSION[cia]'" ;
 
	  $rs_cli=odbc_exec($con_db,$sql_pro);

	  $rs_filas = odbc_num_rows($rs_cli);
	  
	  if($rs_filas>0){
	  	$ruc=0;
	  	if(odbc_result($rs_cli, "PE_CEDULA")!=''){$ruc=odbc_result($rs_cli, "PE_CEDULA");}
	  	else{
	  	if(odbc_result($rs_cli, "PE_RUC")!=''){$ruc=odbc_result($rs_cli, "PE_RUC");}}

	  	$row_array['cod']=odbc_result($rs_cli, "PE_CODIGO");
		$row_array['nombre'] = odbc_result($rs_cli, "PE_NOMBRE") ." ". odbc_result($rs_cli, "PE_APELLIDO");
		$row_array['ruc']=$ruc;
		$row_array['direc'] = odbc_result($rs_cli, "PE_DIRECCION");
		$row_array['telefono']=odbc_result($rs_cli, "PE_TELEFONO1");
		$row_array['email']=odbc_result($rs_cli, "PE_EMAIL");
		$row_array['ciudad']=odbc_result($rs_cli, "PE_CIUDADNAC");
		$row_array['fpago']=odbc_result($rs_cli, "PE_FPAGO");
		$row_array['plazo']=odbc_result($rs_cli, "PE_PLAZO");
		$datos["error"] = '';
		
		echo json_encode($row_array);
		
      }
      else{$datos["error"] = "error";
			 echo json_encode($datos);}
  	}
 
?>