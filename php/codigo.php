$mbd-> exec("INSERT INTO FST_M_CABPEDIDO(CPED_NUMERO,CPED_ESTADO,CPED_USUARIO,CPED_FECHREG,
        CPED_OBSERVACION,CPED_CLIPROV,CPED_VENDEDOR,CPED_FORMAPAGO,CPED_CODCIA,CPED_CODMODULO,CPED_CODMONEDA,CPED_VALCOTIZA,CPED_DESCGENERAL,CPED_TOTMOVI,CPED_VALORIVA,CPED_BODEGA,CPED_TIPSEC,CPED_IMPRE,CPED_DIRECC,CPED_TELEFO,CPED_REFERE,CPED_PTOVTA,CPED_AFESTOC,CPED_DESGLO,CPED_CODPLAZO,CPED_FECVENCE,CPED_FECMOD,CPED_KEY,CPED_HORAESTIMA,CPED_EMAIL,CPED_ELECTRONICO) Values ('".$CPED_NUMERO."','".$esta."','".$user."','".$fec_reg."','".$observacion."','".$codigo."',  '".$vendedor."', '".$fpago."','".$cia."','".$codmod."','".$codmoneda."','".$valcoti."','".$total_descuento."','".$total_neto."','".$ivaf."','".$bodega."','".$CPED_TIPSEC."','".$cped_impre."','".$dir."','".$fono."','".$refer."','".$ptovta."','".$afestoc."','".$desglo."','".$plazo."','".$fvence."','".$fec_reg."','".$key."','".$fec_reg."','".$correo."','".$electro."')");




             //Guardar Detalle

        /*$datosFactura = array();
        $datosFactura = json_decode($_POST['factura'], true);
		$j = 1;
		$i=0;*/
		//$cont=0;
		//$ultimo=array_pop($datosFactura['detalle']);
		//foreach ( $datosFactura['detalle'] as $detalle )
		//{       $j++;
				//$i=$detalle['cont'];
									    
		
				/*$arti 			    = $detalle['txt_art'];
				$descrip 			= $detalle['txt_descrip'];
				$cantidad 			= $detalle['txt_cant'];
				$tipo 				= $detalle['txt_tipo'];
				$preuni 			= $detalle['txt_preu'];
				$subtotal			= $detalle['txt_subtotal_price'];
				$iva 			    = $detalle['txt_iva'];
				$descuento          = $detalle['txt_descu'];*/

	/*			$arti 			    = '2350';
				$descrip 			= 'fomix';
				$cantidad 			= 30;
				$tipo 				= 'unidad';
				$preuni 			= 0.20;
				$subtotal			= 30;
				$iva 			    = '1';
				$descuento          = 10;
				$codigo=10;
				$lin="1";
		
        $mbd->exec("INSERT INTO FST_T_DETPEDIDO (DPED_CODCIA,DPED_CABNUMERO,DPED_CODIGO,DPED_ARTICULO,DPED_TIPPRECIO,DPED_COSTOUNI,DPED_CANTIDAD,DPED_IVA,DPED_DESC,DPED_LINEA,DPED_TIPLIN,DPED_CANTCAJA,DPED_PVPMUESTRA,DPED_UNDCAJA,DPED_SERIES) Values('".$cia."','".$CPED_NUMERO."','".$codigo."','".$arti."','".$tipo."','".$preuni."','".$cantidad."','".$iva."','".$descuento."','".$lin."','".$lin."','".$cantidad."','".$preuni."','".$tipo."','".$tipo."')");
		  
									
			/*	if ( $j < $ultimo['cont']){
					$sql_script_detalle.=',';
				}else if($j == $ultimo['cont']){
					$sql_script_detalle.=' ';
				}*/				
           // }	fin for
		$mbd->commit(); 
							
	}
	catch (Exception $e) {
  		$mbd->rollBack();
  		echo "Fallo: " . $e->getMessage();
	}
		//echo "1";
			/*DETALLE FACTURA*/
			
            //echo $_POST['factura'];
		/*	$datosFactura = array();
            $datosFactura = json_decode($_POST['factura'], true);
			if($last_id>0){
			 				
			//$i = 1;
			$j = 1;
			$ultimo=array_pop($datosFactura['detalle']);
            echo $ultimo['cont']; 
			$sql_script_detalle = "insert into detalleFactura (cabeFact_codigo,detaFact_secuencia,detafact_reference,detafact_photo,".
						" detafact_cantidad,detafact_unidad,detafact_description,detafact_weight,".
						" detafact_material,detafact_partida_arancelaria,".
						" detaFact_precio_unitario,detaFact_subtotal,detaFact_estado,".
						" detaFact_fechaCreacion,detaFact_usuarioCreacion)".
						" values";
			print_r($datosFactura['detalle']);
			foreach ( $datosFactura['detalle'] as $detalle )
			{   
				$j++;
				$i=$detalle['cont'];
				$docfile = $_FILES['photo_'.$i]['name'];
				
			if( empty($docfile) && empty($detalle['nombre_file']))
			{   
				echo "Subir imagen, por favor." ;
				exit;
			}elseif((empty($docfile)) && (!empty($detalle['nombre_file'])))
			{
				
				$url_file = $detalle['nombre_file'];
				//$archivo = substr($detalle['nombre_file'],8);
				//rename ("pendientes/datos.txt","procesados/datos.txt");
                                //chmod("../uploads_temp/".$archivo, 0777);
				//rename("../uploads_temp/".$archivo,$url_file);
			}elseif((!empty($docfile)))
			{  
				
				$split_name = explode( ".", strtolower( $docfile ) );
				
					if(($split_name[1] == 'jpeg') || ($split_name[1] == 'jpg') || ($split_name[1] == 'png') || ($split_name[1] == 'PNG') ||($split_name[1] == 'gif') || ($split_name[1] == 'GIF'))
					{   $cate_img_small = "photo".date("dmY")."-".rand("100","999").".".$split_name[1];
						move_uploaded_file($_FILES['photo_'.$i]['tmp_name'],"../uploads/".$cate_img_small);
					}
					else
					{   echo "Error al subir la imagen. Por favor, verificar extensi¨®n (png, jpg, jpeg, gif).";
						
						exit;
						
						//break;
					}
					$url_file = "../uploads/".$cate_img_small;

				}
				
			    
		
				$reference 			= $detalle['reference'];
				$photo 				= $url_file;
				$cantidad 			= $detalle['cantidad'];
				$unidad 			= $detalle['unidad'];
				$description 		= $detalle['description'];
				$weight 			= $detalle['weight'];
				$material 			= $detalle['material'];
				$partida_arancelaria= $detalle['partida_arancelaria'];
				$unit_price 		= $detalle['unit_price'];
				$subtotal_price 	= $detalle['subtotal_price'];
				
				$sql_script_detalle .= "(".
						$last_id.
						",'".$i."',".
						"'".$reference."',".
						"'".$photo."',".
						"'".$cantidad."',".
						"'".$unidad."',".
						"'".$description."',".
						"'".$weight."',".
						"'".$material."',".
						"'".$partida_arancelaria."',".
						"'".$unit_price."',".
						"'".$subtotal_price."',".
						"'A', '".$fec_des."', '" . $_SESSION['usua'] . "')";
					
				if ( $j < $ultimo['cont']){
					$sql_script_detalle.=',';
				}else if($j == $ultimo['cont']){
					$sql_script_detalle.=' ';
				}				
            }
            echo $sql_script_detalle;
			$stmt = $conn->prepare( $sql_script_detalle );
			
			$stmt->execute();
			
			echo 'Factura guardada correctamente.';
			break;
		
			}//fin valida insert cabecera
		case 'load_bill':
		
			$cabefact_codigo = $_POST['cabefact_codigo'];
			
			$sql_script_cabecera = '
				select  cabefact_codigo,
						cabefact_enquiry_handle,
						cabefact_order_number,
						cabefact_date,
						cabefact_packages,
						cabefact_forwarders,
						cabefact_trade_terms,			
						cabefact_incoterm,
						cabefact_destination_port,
						cabefact_shipment_cargo,

						cabefact_nombre,
						cabefact_ruc,
						cabefact_direccion,
						cabefact_pais,
						cabefact_telefono,

						cabeFact_totalBruto,		
						cabeFact_totalDescuento,	
						cabeFact_totalComision,		
						cabeFact_totalNeto,		

						cabefact_num_cuenta,		
						cabefact_titular_cuenta,
						cabefact_nota,
						cabefact_descripcion_BL,
						cabefact_termino_contrato,	
						cabefact_datos_bancarios,	

						cabeFact_estado,
						cabeFact_fechaCreacion,
						cabeFact_idu
				   from cabeceraFactura
				  where cabefact_codigo = '.$cabefact_codigo;
			
			$sql_script_detalle = '
				 select cabeFact_codigo,
						detaFact_secuencia,
						detafact_reference,
						detafact_photo,
						detafact_cantidad,
						detafact_unidad,
						detafact_description,
						detafact_weight,
						detafact_material,
						detafact_partida_arancelaria,
						
						detaFact_precio_unitario,
						detaFact_subtotal,
						detaFact_estado,
						detaFact_fechaCreacion,
						detaFact_usuarioCreacion
				   from detallefactura
				  where cabefact_codigo = '.$cabefact_codigo;
				  
			break;
		case 'image_error':
			echo "Error al subir la imagen. Por favor, verificar extensi¨®n (png, jpg, jpeg, gif).";
		default:
			echo 'nothing';
	}
	
	

	if($detalle->iva=='on'){$iva=1;}
			else{$iva=0;}
			$desc=0;
				$codigo=$detalle->codigo;
				$tipo=$detalle->tipo;
				$preuni=$detalle->preuni;
				$cantidad=$detalle->cantidad;
				$descrip = $detalle->descrip;
				$detalle->cantidad;
				
				$subtotal=$detalle->subtotal;
				$ejec_sql->execute([
 				 $cia,
 				 $CPED_NUMERO,
 				 $codigo,
				 $codigo,
				 $tipo,
				 $preuni,
				 $cantidad,
				 $iva,
				 $des,
				 $descrip,
				 $j,
				 $j,
				 $cantidad,
				 $preuni,
				 $tipo,
				 $tipo,
				 $subtotal]);		