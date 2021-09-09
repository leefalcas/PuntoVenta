<?php
//if (isset($_GET['term'])){

include("conexion.php");

/* If connection to database, run sql statement. */
//if ($con)
//{
    //$usu='9999999999999';

    $usu=$_POST['ruc'];
	//$sql_per="select * from ASD_M_PERSON where ((PE_CEDULA='$usu' or PE_RUC='$usu') and  per.PE_ESTADO <>'EL')";
	$sql_per="select * from ASD_M_PERSON per INNER JOIN asd_m_claper cla on (cla.CP_TIPO_PERS = '01') 
			  where ((per.PE_CEDULA = '$usu' or per.PE_RUC='$usu') and (cla.CP_PERS = per.PE_CODIGO and per.PE_ESTADO <>'EL'))";

	$rs_person=odbc_exec($con_db,$sql_per);
	$rs_filas = odbc_num_rows($rs_person);
		 
		if($rs_filas>0){
		 	$nombre=odbc_result($rs_person, "PE_NOMBRE")." ".odbc_result($rs_person, "PE_APELLIDO");
			$row_array['id']=odbc_result($rs_person, "PE_CODIGO");
			$row_array['nombre']=$nombre;
			$row_array['direc'] = odbc_result($rs_person, "PE_DIRECCION");
			$row_array['telefono']=odbc_result($rs_person, "PE_TELEFONO1");
			$row_array['email']=odbc_result($rs_person, "PE_EMAIL");
			$row_array['ciudad']=odbc_result($rs_person, "PE_CIUDADNAC");
			echo json_encode($row_array);
    	}
    	else{echo json_encode(0);}
	//$fetch = mysqli_query($con,"SELECT * FROM clientes where nombre_cliente like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	
	
	
//}

/* Free connection resources. */
//mysqli_close($con);

/* Toss back results as json encoded array. */
//echo json_encode($return_arr);

//}
?>