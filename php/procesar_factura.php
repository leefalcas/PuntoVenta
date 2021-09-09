<?php
	session_start();
	error_reporting(E_ALL);
   ini_set('display_errors', '1');
	include("conecta_commit.php");
	include("funciones.php");
	$condb = new conexion();
	$mbd = $condb->conectar();

	$cia  = trim($_SESSION['cia']);
	$user = $_SESSION['user'];

	/*CABECERA FACTURA*/
	$tipdoc = $_POST['tipdoc'];
	$secdoc = $_POST['secuencial'];
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$ruc    = $_POST['ruc'];
	
	$dir 	= $_POST['dir'];
	$correo	= $_POST['correo'];
	$fono 	= $_POST['fono'];
	
	$vendedor = $_POST['vendedor'];
	$bodega 	= $_POST['bodega']; 
	$total_bruto	= $_POST['total_bruto'];
	$total_descuento 	= $_POST['total_descuento'];
	$ivaf 		= $_POST['ivaf'];
	$total_neto	= $_POST['total_neto'];
	$fpago = $_POST['fpago'];
	$codmod   			= "4";
	$codmoneda   		= "2";
	$fec_reg=date("d-m-Y H:i:s");
	$fvence = $_POST['fvence'];
	$esta 				= 'PO';//cuando va PO, AC O IN


	/*$ruc 	= trim($_POST['ruc']);*/
	//$nvendedor 	= $_POST['nvendedor'];
	//$descuento 	= $_POST['descuento'];

	//$plazo 	= $_POST['plazo'];
	//
	//$ciudad = $_POST['ciudad'];
	//$subtofin			= $_POST['subtofin'];
	
	//$CPED_NUMERO		= 90365;
	
	
	
	$valcoti 			= 0;
	//$total_descuento=2333;
	//$total_neto=546;
	//$ivaf=23;
	//$bodega='2';
	$CPED_TIPSEC = "12566";
	$cped_impre="S";
	//$dir="9 de octubre";
	//$fono="203566";
	$refer  			= "23-65";
	$ptovta 			= "2";
	$afestoc 			= "1";
	$desglo  			= "1";
	$plazo=1;
	
	//$tipdoc='fact';
	$key 				= "<VENTAS2>(0)";
	//$correo="leefal@hotmil.com";
	$electro= "1";
	//$nombre="Lidia Falconi";
	//$secdoc=23566;
	//$observacion ="FT.# ".$secdoc." [ ".$codigo." ]". $nombre;
	
	//$observacion ="FT.# ".$secdoc." [ ".$codigo." ]". $nombre;

	
		//$id1=4;			
/*	if(empty($codigo)||empty($ruc)||empty($vendedor))
	{
		echo "No pueden haber campos vacios";	
		exit;			
	}
			
	if(empty($total_bruto)||empty($total_neto))
	{
		echo "No pueden haber campos vacios";	
		exit;			
	}*/
			
		
			
			/*if($cia==1)
			{
			  $idcab=genera_idorder();
			}
			else
			{
			  $idcab=genera_idorderc();
			}
			 $conn = $conexion->conectar();
				
			 $cons1=$conn->prepare("select ID from wp_users where user_ci=?");
			 $cons1->execute(array($ruc));
			 $ruc1=$cons1->fetch(PDO::FETCH_ASSOC);
			 if($cons1->rowCount()>0)
			 {
			    $id1=$ruc1['ID'];
			 }*/
			
			//verificar saldo actual del cliente
			/* $bansaldo = 0;
			 $sqlsaldo = "Select cp_salcred,cp_valcred from asd_m_person,asd_m_claper  Where pe_codcia = '1' and " "pe_codigo = '" & Trim(strCodClte) & "' and pe_codcia = cp_codcia and ""pe_codigo = cp_pers and cp_tipo_pers = '01' AND PE_ESTADO='AC'";
			 $fila = odbc_exec($con_db, $sqlsaldo);
			//S $rsfila = odbc_num_rows($fila);
			/* if($rsfila>0)
			 {
			 	$bansaldo = 1;

			 }
			
			*/
		
   $CPED_NUMERO = fnAct_Num_Tran("SECMOV", "4",$cia);
  
	if($tipdoc=='fact')	
	{
	 $tipocoti = 'F';
	 $numlin=fnAct_Num_Tran("SECFAC", "4", $cia);
	 $CPED_TIPSEC = $numlin+1;
	 $observacion ="FT.# ".$CPED_TIPSEC." [ ".$codigo." ]". $nombre;
	}	
	if($tipdoc=='notped')	
	{
 	 $tipocoti = 'S';
 	 $numlin=fnAct_Num_Tran("SECNVS", "4", $cia);
 	 $CPED_TIPSEC = $numlin+1;
 	 $observacion ="FT.# ".$CPED_TIPSEC." [ ".$codigo." ]". $nombre;}	
	if($tipdoc=='notven')	
	{
	 $tipocoti = 'N';
	 $numlin=fnAct_Num_Tran("SECNVT", "4", $cia);
	 $CPED_TIPSEC = $numlin+1;
	 $observacion ="NV.#".$CPED_TIPSEC."[".$codigo."]".$nombre;}	
	 $mbd->beginTransaction();
	try
	{  
  		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	    $mbd-> exec("INSERT INTO FST_M_CABPEDIDO(CPED_NUMERO,CPED_ESTADO,CPED_USUARIO,CPED_FECHREG,
        CPED_OBSERVACION,CPED_CLIPROV,CPED_VENDEDOR,CPED_FORMAPAGO,CPED_CODCIA,CPED_CODMODULO,CPED_CODMONEDA,CPED_DESCGENERAL,CPED_TOTMOVI,CPED_VALORIVA,CPED_BODEGA,CPED_VTAGRA,CPED_NOMCLIE,CPED_TIPCOT,CPED_CEDIDEN,CPED_TIPSEC,CPED_DIRECC,CPED_TELEFO,CPED_REFERE,CPED_PTOVTA,CPED_AFESTOC,CPED_DESGLO,CPED_CODPLAZO,CPED_FECVENCE,CPED_FECMOD,CPED_KEY,CPED_HORAESTIMA,CPED_EMAIL,CPED_ELECTRONICO) Values ('".$CPED_NUMERO."','".$esta."','".$user."','".$fec_reg."','".$observacion."','".$codigo."',  '".$vendedor."', '".$fpago."','".$cia."','".$codmod."','".$codmoneda."','".$total_descuento."','".$total_neto."','".$ivaf."','".$bodega."','".$VTAGRA."','".$nombre."','".$tipocoti."','".$ruc."','".$CPED_TIPSEC."','".$dir."','".$fono."','".$refer."','".$ptovta."','".$afestoc."','".$desglo."','".$plazo."','".$fvence."','".$fec_reg."','".$key."','".$fec_reg."','".$correo."','".$electro."')");

/* $mbd->commit(); 
   }
   catch (Exception $e) {
  		$mbd->rollBack();
  		echo "Fallo: " . $e->getMessage();
	}*/


	   $datosFactura = array();
      $datosFactura = json_decode($_POST['factura'],true);
		$j = 1;
		$tiprec = "Cu";
		$tilin="N";
		$caja=23;
		//$ultimo=array_pop($datosFactura['detalle']);
        //echo $ultimo['cont']; 
		//var_dump($datosFactura);
		$sql = "INSERT INTO FST_T_DETPEDIDO (DPED_CODCIA,DPED_CABNUMERO,DPED_CODIGO,DPED_ARTICULO,DPED_TIPPRECIO,DPED_COSTOUNI,DPED_CANTIDAD,DPED_IVA,DPED_LINEA,DPED_TIPLIN,DPED_CANTCAJA) Values(?,?,?,?,?,?,?,?,?,?,?)";

		$ejec_sql = $mbd->prepare($sql);
		 $j=1;
		 
		// $mbd->beginTransaction();
		
        $k=0;
        $iva=0;
         $lin=1;
		foreach ($datosFactura['detalle'] as $detalle )
		{     
				 if($detalle['iva']='on'){
				 	$iva = 1;
				 }
				 $cod = $detalle['codigo'];
				 $tipo=$detalle['tipo'];
				 $preuni=$detalle['preuni'];
				 $cantidad=$detalle['cantidad'];
				 $descrip = $detalle['descrip'];
				

				$arr=array($cia,$CPED_NUMERO,$lin,$cod,$tiprec,$preuni,$cantidad,$iva,$lin,$tilin,$caja);
				 $ejec_sql->execute($arr);
				  $lin++;
    				
		
        }///fin for

 $mbd->commit();
 }
 catch (Exception $e){
     $mbd->rollback();
    throw $e;
}	
   
?>
