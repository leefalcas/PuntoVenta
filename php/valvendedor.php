<?php
session_start();
include("conexion.php");

  if(isset($_POST['vendedor'])){
    $usu=$_POST['vendedor'];
    //$usu='00000002';
	$sql_per="select pe_nombre,pe_apellido, pe_codigo
			  from ASD_M_PERSON per INNER JOIN asd_m_claper cla on (cla.CP_TIPO_PERS = '09') 
			  where (per.PE_CODIGO = $usu and cla.CP_PERS = $usu and per.PE_ESTADO <>'EL' AND PER.PE_CODCIA = CLA.CP_CODCIA  AND CLA.CP_CODCIA='$_SESSION[cia]' )";

	$rs_person=odbc_exec($con_db,$sql_per);
	$rs_filas = odbc_num_rows($rs_person);
		 //echo $rs_filas;
		if($rs_filas>0){
		 	$nombre=odbc_result($rs_person, "PE_NOMBRE")." ".odbc_result($rs_person, "PE_APELLIDO");
			$row_array['id']=odbc_result($rs_person, "PE_CODIGO");
			$row_array['nombre']=$nombre;
			echo json_encode($row_array);
    	}
    	else{echo 0;}
   }
	

?>