<?php
	session_start();
	include("conexion.php");
	$html = '';
	
	if(isset($_POST['nomcli']))
		{$nomcli = $_POST['nomcli'];
		$find =  "%".$nomcli . "%";}

	if(isset($_POST['cod']))
		{$cod = $_POST['cod'];}

	
	$tipo = $_POST['tipo'];
	if($tipo=='1'){
	  $sql_pro = "SELECT pe_codigo,(CASE pe_juridico WHEN '1' THEN pe_nombre WHEN '0' THEN (pe_apellido+' '+pe_nombre) END)as juridico,(CASE pe_juridico WHEN '1' THEN pe_nombre WHEN '0' THEN (pe_apellido+' '+pe_nombre) END) as persona,pe_ruc+pe_cedula as identifica
	      from asd_m_person,asd_m_claper 
          Where pe_codcia = '$_SESSION[cia]' and pe_codcia = cp_codcia and pe_codigo = cp_pers and  cp_tipo_pers = '01' AND PE_ESTADO='AC' and (PE_NOMBRE like '$find' OR PE_APELLIDO like '$find')";
 
	  $rs_cli=odbc_exec($con_db,$sql_pro);

	  $rs_filas = odbc_num_rows($rs_cli);
	  if($rs_filas>0){
		
		while (odbc_fetch_array($rs_cli)) {
		 
		  $html .= '<div><a class="listcli" data="'.utf8_encode(odbc_result($rs_cli,"pe_codigo")).'" id='.utf8_encode(odbc_result($rs_cli,"pe_codigo")).' >'.utf8_encode(odbc_result($rs_cli,"juridico")).'</a></div>';
		}
	    echo $html;
      }

 	}//fin tipo 1

	
 	if($tipo=='2'){
	  $sql_pro = "SELECT * from asd_m_person 
	              Where pe_codcia ='$_SESSION[cia]' and PE_ESTADO='AC' AND pe_codigo='$cod'" ;
 
	  $rs_cli=odbc_exec($con_db,$sql_pro);

	  $rs_filas = odbc_num_rows($rs_cli);
	  if($rs_filas>0){
	  	if(odbc_result($rs_cli, "PE_CEDULA")>0){$ruc=odbc_result($rs_cli, "PE_CEDULA");}
	  	else{
	  	if(odbc_result($rs_cli, "PE_RUC")>0){$ruc=odbc_result($rs_cli, "PE_RUC");}}

	  	$row_array['cod']=odbc_result($rs_cli, "PE_CODIGO");
		$row_array['nombre'] = odbc_result($rs_cli, "PE_NOMBRE") ." ". odbc_result($rs_cli, "PE_APELLIDO");
		$row_array['ruc']=$ruc;
		$row_array['direc'] = odbc_result($rs_cli, "PE_DIRECCION");
		$row_array['telefono']=odbc_result($rs_cli, "PE_TELEFONO1");
		$row_array['email']=odbc_result($rs_cli, "PE_EMAIL");
		$row_array['ciudad']=odbc_result($rs_cli, "PE_CIUDADNAC");
		echo json_encode($row_array);
		
      }
      else{$row_array['error']='nada';
      	echo json_encode($row_array['error']);}

 	}//fin tipo 2
?>