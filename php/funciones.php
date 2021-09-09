<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("conecta_commit.php");
$conedb = new conexion();
$conodb = $conedb->conectar();


//Funcion que trae el valor del secuencial CPED_NUMERO
Function fnAct_Num_Tran($Cod_Prefijo,$Cod_Modulo,$cia) 
{    
    $consparam = "Select pg_valor from ASD_P_PARGEN WHERE (PG_CODCIA = '$cia' and PG_PREFIJO = '$Cod_Prefijo ' AND PG_MODULO = '$Cod_Modulo')";
    $rsparam = odbc_exec($conodb,$consparam);
    $nfila = odbc_num_rows($rsparam);

    if($nfila>0)
    {
    	$pgvalor = odbc_result($rsparam,"pg_valor");
    	$pgvalor = $pgvalor+1;
        $actparam = "Update ASD_P_PARGEN set pg_valor=$pgvalor  WHERE (pg_Codcia = '$codigo' and PG_PREFIJO = '$Cod_Prefijo' AND PG_MODULO = '$Cod_Modulo')";
        $rsupdate = odbc_exec($conodb,$actparam);
        if(!$rsupdate)
        {
        	echo "NO SE REGISTRO SECUENCIA EN ASD_P_PARGEN ..."
        }
        else{
        	 $actparam = "Select pg_valor from ASD_P_PARGEN WHERE (PG_CODCIA = '$cia' and PG_PREFIJO = '$Cod_Prefijo' AND PG_MODULO = '$Cod_Modulo')";
	         $rsupdate = odbc_exec($conodb,$actparam);
	         if(!$rsupdate)
	         {
	        	echo "NO SE REGISTRO SECUENCIA EN ASD_P_PARGEN ..."
	         }
	         else{
	         	$pgvalor=odbc_result($rsupdate,"pg_valor");
	         	return $pgvalor;}
        }

    }
       
           
   
}// FIN FUNCION TRAE SECUENCIAL CPED_NUMERO


 ?>