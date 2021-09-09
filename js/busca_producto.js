$(document).ready(function(){
	$("#txt_busca").keypress(function(e)
	{	//event.preventDefault();
		var key = $(this).val();		
		var band = 0;
		var bode = $('#sel_bodega').val();
		  
		if($("#rd_codpro").is(':checked')) { 
		 
		  	if(e.which == 13){
		        $.ajax({
		        	type: 'POST',
		        	dataType: "JSON",
		        	url:"./php/busca_producto.php",
		        	data:{key:key,bod:bode,tipo:1},
		        	success: function(data){
		         	    if(data.error!='error'){
		         	    
						  var descri = data.descrip;
						  var iva = data.iva;
						  var prebul = data.prebulto;
						  var unidad = data.unidad;
						  		
						 js_orders_add_row_detalleFactura(key,descri,iva,unidad,data.docena,data.bulto,data.preuni,data.predoce, prebul);
						 $('#txt_busca').val('');
						}else{alert("No hay stock ");}
		        	}

		        });
	      	}
	    
	    }//FIN DE BUSCA POR CODIGO 

	    if($("#rd_despro").is(':checked')) {  
	        $.ajax({
				type: "POST",
			    url: "./php/busca_producto.php",
			    data: {key:key,bod:bode,tipo:'2'},
			    success: function(data) { 
			    if(data!=''){
			     $('.bus').css({'overflow-y': 'scroll'});
			     $('#suggestions').fadeIn(1000).html(data);
	             $('.suggest-element').on('click', function(){
	             var id = $(this).attr('id');
	             $('#txt_busca').val($('#'+id).attr('data'));
	             $('#suggestions').fadeOut(1000);
			     var cod = id;
			     var lin_det = 0;
			     $('.codigo').each(function(){
			       	lin_det = $(this).val();
			        if(cod==lin_det)
			         {	band = 1;
			         	alert("El Producto " +$('#'+id).attr('data')+ " Ya fue agregado al detalle");
			        	$('#txt_busca').val('');

			         }

			    });
			    if(band==0){
				    alert('Has seleccionado el Producto ' +$('#'+id).attr('data'));
				    $.post('./php/deta_producto.php', { cod : cod }, function(resp) {
					    var datos = JSON.parse(resp);
					    var descri = datos.descrip;
					    var iva = datos.iva;
					    var prebul = datos.prebulto;
						/*console.log(datos.descrip);
						console.log(datos.iva);
						console.log(datos.unidad);
						console.log(datos.docena);
						console.log(datos.bulto);*/
						js_orders_add_row_detalleFactura(cod,descri,iva,datos.unidad,datos.docena,datos.bulto,datos.preuni,datos.predoce, prebul);
					$('#txt_busca').val('');
					});
				} //fin if bandera valida producto repetido en el detalle       
			   });
			   }
			   else{alert("Producto no tiene stock");}
			  },
			   error: function(){
			    alert("Error en la Carga de Datos");
			   }
			 }); 
	    }// FIN DE RADIO DESCRIPCION

    });
});//fin busca producto con la descripción
