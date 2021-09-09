var acum=0.00;
var num_detalle=0;
 var total= new Array(1000);
	for(i=0;i<1000;i++){total[i]=0;}
	
	 var total1= new Array(2);
	 total1[0]=0;
	 var posi = new Array(1000);
	 for(i=0;i<1000;i++){posi[i]=0;}
	 var p=1;
	 var m=1;
	 var ban=0;
	 var k=0;
	 var l=0;


function js_orders_calculcar_subtotal_price(obj, tipo_obj)

{   var num_row_det = "";
	
	
	if ( tipo_obj === 1 )

	{	num_row_det = obj.getAttribute('id').replace("txt_cant_", "");
		
	}

	

	if ( tipo_obj === 2 )

	{	num_row_det = obj.getAttribute('id').replace("txt_preu_", "");

	}

	

	var v_cantida = document.getElementById( 'txt_cant_' + num_row_det ).value;

	if (!v_cantida)

		v_cantida = 1;

	

	var v_precio = document.getElementById( 'txt_preu_' + num_row_det ).value;
	if (!v_precio)

		v_precio = 0.00;

	
	sbt_price= parseInt(v_cantida) * parseFloat(v_precio);
	document.getElementById('txt_subtotal_price_' + num_row_det ).value = sbt_price.toFixed(2);	

	$(function() {$('#txt_subtotal_price_' + num_row_det ).maskMoney({thousands:'', decimal:'.', allowZero:false});});

	js_orders_calculcar_total_price();

}

function js_orders_calculcar_total_price()
{   var sum = 0.00;
    var comi= 0.00;
	var des= 0.00;
	total1[0]= 0.00;
	m=1;
	for ( var i=1; i <= num_detalle; i++ )
	{ 
	     ban=0;
	    
		 for(l=1; l <= num_detalle; l++)
		 { 
		   if(posi[l]==i)
		    {  ban=1;
			   l=num_detalle+1;

			}
				   
	     }
		 if(ban==0){
	      var val=document.getElementById('txt_subtotal_price_' + i).value;
	       
	       total[m]=val;
		   
		  m++;
		   
		 }
	 
	}
	
		var neto = 0.00;
		var net = 0.00;
		var bruto = 0.00;
		var iva = 0.00;
		var iv=0;
		var descu = parseInt(document.getElementById('txt_descpri').value);
		var descu2 = 0.00;
		$('.sub-total').each(function(index, value){
			//neto += parseFloat($(this).val());
			bruto += parseFloat($(this).val());

		});
		var i=1;
		$("input:checkbox:checked").each(   
		    function() {
		     // alert("El checkbox con valor " + $(this).attr("id") + " está seleccionado");
		       
		       num_row_det = $(this).attr("id").replace("txt_iva_", "");
		       iv += parseFloat($('#txt_subtotal_price_' + num_row_det).val());
		      // alert(iva);
		});
		
		iva = iv*0.12;
		net = iva + bruto;

		document.getElementById('txt_total_bruto').value=bruto.toFixed(2);
		document.getElementById('txt_ivat').value=iva.toFixed(2);
		if(descu>0){
			descu2 = (bruto * descu)/100;
			document.getElementById('txt_total_descuento').value = descu2.toFixed(2);
		}
		else{document.getElementById('txt_total_descuento').value=0;}
		document.getElementById('txt_total_neto').value=net.toFixed(2);
		$('#btn_guardar').prop('disabled',false);

		if(descu2>0)
		{ 
		  //neto -= parseFloat(des);
		  totdes = bruto - descu2;
		  totfin = totdes + iva;
		  document.getElementById( 'txt_subto' ).value =  totdes.toFixed(2);
		  document.getElementById( 'txt_total_neto' ).value =  totfin.toFixed(2);
	      //document.getElementById( 'txt_total_neto' ).value =  neto.toFixed(2);
		  //total1[0]=total1[0] - des;
	      //document.getElementById( 'txt_total_neto' ).value =  total1[0];
		}
	
}

function js_orders_add_row_detalleFactura(id,descrip,iva,unidad,docena,bulto,preuni,predoce,prebulto)
{	
	num_detalle = $('#hd_num_detalle').val();

	num_detalle = parseInt(num_detalle) + 1;
	var codigo = id;
	var des = descrip;
	var iva = iva;
	var unidad = unidad;
	var docena = docena;
	
	if(num_detalle>0){

		var nuevaLinea = '<tr id="'+ num_detalle + '" data-num="' + num_detalle +'">';
	    

		nuevaLinea += '<td><input class="form-control input-sm codigo" type="text"  id="txt_art_' + num_detalle + '" 	name="txt_art_' + num_detalle + '" value='+ codigo +' readonly="readonly"></td>';

		nuevaLinea += '<td><input class="form-control input-sm" type="text" id="txt_descrip_' + num_detalle + '"  name="txt_descrip_' + num_detalle +'" readonly="readonly"></td>';

		nuevaLinea += '<td><input class="form-control input-sm cant" type="text" id="txt_cant_'+ num_detalle + '" name="txt_cant_' + num_detalle + '"  onkeyup="js_orders_calculcar_subtotal_price(this,1);"></td>';
		nuevaLinea += '<td><select class="form-control input-sm tipo" id="txt_tipo_'+ num_detalle + '" name="txt_tipo_'+ num_detalle + '"><option value="1">Unidad</option><option value="2">Bulto</option> <option value="3">Docena</option></select></td>';
	    
		nuevaLinea += '<td><input class="form-control input-sm" type="text" id="txt_preu_' + num_detalle + '" name="txt_preu_' + num_detalle + '" value="0.00" placeholder="0.00"  onkeyup="js_orders_calculcar_subtotal_price(this,2);" readonly></td>';

		nuevaLinea += '<td><input class="form-control input-sm sub-total" type="text" id="txt_subtotal_price_' + num_detalle + '" name="txt_subtotal_price_' + num_detalle + '"  value="0.00" readonly="readonly"></td>';

		nuevaLinea += '<td><input  class="form-control input-sm iva" type="checkbox" id="txt_iva_' + num_detalle + '" name="txt_iva_' + num_detalle + '" readonly="readonly"></td>';

		nuevaLinea += '<td><input class="form-control input-sm" type="text" id="txt_desc_' + num_detalle + '"  name="txt_desc_' + num_detalle + '" onKeypress=" if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"></td>';

		nuevaLinea += '<td><button type="action" class="borrar" id="btn_del_row_' + num_detalle + '" name="btn_del_row_' + num_detalle + '"><i class="fa fa-times"></i></button></td>';
			
		nuevaLinea += "</tr>";

	   //reordenar();
		$('#tbl_detalleFactura tbody').append(nuevaLinea);

		$(function() {$('#txt_preu_' + num_detalle ).maskMoney({thousands:'', decimal:'.', allowZero:false});});
		if(iva==1){
		 $('#txt_iva_' + num_detalle).prop('checked',true);
		}
		else{$('#txt_iva_' + num_detalle).prop('checked',false);}
		$('#txt_descrip_' + num_detalle).val(des);
		
		if(unidad[1]>'0'){
			 $('#txt_tipo_'+ num_detalle).val(1);
			 $('#txt_preu_'+ num_detalle).val(preuni);
		}
		else{ 
			if(bulto[1]>'0'){ 
				$('#txt_preu_'+ num_detalle).val(prebulto);
			    $('#txt_tipo_'+ num_detalle).val(2); 
			}
		    else{
		    	if(docena[1]>'0'){
					$('#txt_preu_'+ num_detalle).val(predoce);
				    $('#txt_tipo_'+ num_detalle).val(3); 
				}
		    }

		}
	   
		
	}//fin if
		
	$('#hd_num_detalle').val(num_detalle);
	return false;
}



$(function () {
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
		
		var nFilas = $(this).attr("id");
		var porcion = nFilas.substring(12); 
		var num_detalle = parseInt(porcion);
		var subt =document.getElementById('txt_subtotal_price_' + num_detalle).value;
		var tot = document.getElementById('txt_total_neto').value;
		var bruto=document.getElementById('txt_total_bruto').value;
        $(this).closest('tr').remove();
		posi[p]=porcion;
		
		p++;
	
		
		reordenar();

		var neto = 0.00;
		var bruto = 0.00;
		$('.sub-total').each(function(index, value){
			neto += parseFloat($(this).val());
			bruto += parseFloat($(this).val());
		});
		document.getElementById('txt_total_neto').value=neto;
		document.getElementById('txt_total_bruto').value=bruto;
		$('#txt_total_descuento').keyup();
		
		//$( "#txt_cant_" + num_detalle).numeric({ decimal : false,  negative : false, precision: 8 });
	
		$(function() {$( '#txt_preu_' + num_detalle ).maskMoney({thousands:'', decimal:'.', allowZero:false});});
	
			
    });
});


function reordenar(){
	var num = 1;
		$('#tabla tbody tr').each(function(){
			$(this).find('td').eq(0).text(num);
			$('#hd_num_detalle').val(num);
			num++;
			//alert(num);
		});
	 
}

function createCell(cell, text, style)

{   var div = document.createElement('div'), // create DIV element

    txt = document.createTextNode(text); // create text node

    div.appendChild(txt);                    // append text node to the DIV

    div.setAttribute('class', style);        // set DIV class attribute

    div.setAttribute('className', style);    // set DIV class attribute for IE (?!)

    cell.appendChild(div);                   // append DIV to the table cell

}


$(function(){
	$("#txt_busca").keypress(function(e)
	{	//event.preventDefault();
		var key = $(this).val();	
		//alert(key);
		var band = 0;
		var bode = $('#sel_bodega').val();
		
		if($("#rd_codpro").is(':checked')) { 
		
		  	if(e.which == 13){
		  		
		        $.ajax({
		        	type: 'POST',
		        	dataType: "JSON",
		        	url:"./php/busca_producto.php",
		        	data:{key:key,bod:bode,tipo:'1'},
		        	success: function(data){
		        		//alert('data');
		        		//console.log(data);
		        		var datos = JSON.parse(JSON.stringify(data));
		        		
		         	    if(datos.error!='error'){
						  var descri = datos.descrip;
						  var iva = datos.iva;
						  var prebul = datos.prebulto;
					
						 js_orders_add_row_detalleFactura(key,descri,iva,datos.unidad,datos.docena,datos.bulto,datos.preuni,datos.predoce, prebul);
						 $('#txt_busca').val('');
						}else{alert("No hay stock ");} 
		        	}

		        });
	      	}
	    
	    }//FIN DE BUSCA POR CODIGO 

	    if($("#rd_despro").is(':checked')) {  
	      if(e.which == 13){
	      
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
			         //	alert("El Producto " +$('#'+id).attr('data')+ " Ya fue agregado al detalle");
			        	$('#txt_busca').val('');
			        	 $('#suggestions').fadeOut(1000);

			         }

			    });
			    if(band==0){
				    //alert('Has seleccionado el Producto ' +$('#'+id).attr('data'));
				    $.post('./php/deta_producto.php', { cod : cod }, function(resp) {
					    var datos = JSON.parse(resp);
					    var descri = datos.descrip;
					    var iva = datos.iva;
					    var prebul = datos.prebulto;

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
	       }
	    }// FIN DE RADIO DESCRIPCION


    });
});//fin busca producto con la descripción


$(function () {
    $(document).on('click', '.tipo', function (event) {
        event.preventDefault();
        var tipo = $(this).val();
       
        var Filasb = $(this).attr("id");
		var idFila = Filasb.substring(9); 
		var numFila = parseInt(idFila);
		var codigo = $('#txt_art_' + numFila).val();
		$("#txt_cant_"+ numFila).val('');

       $.ajax({
        	type: 'POST',
        	url:"./php/precio_producto.php",
        	data:{val:tipo,cod:codigo},
        	success:function(data){
        		$('#txt_preu_' + numFila).val(data);
        		if(data==0){
        			alert("No hay precio, seleccione otro tipo de venta");
        		    $('#txt_cant_'+ numFila).prop( "disabled", true );
        		}
        		else{ $('#txt_cant_'+ numFila).prop( "disabled", false );}
        	},
        	error: function(){
        		alert("No se encuentran datos");
        	}

	    });//fin ajax	

    });

});//fin funcion

 $(document).on('keydown', '.cant', function (event) {

 	var cant = $(this).attr("id");
		//alert(cant);
	var nfila = cant.substring(9);
	var filaid = parseInt(nfila);
	//alert(filaid);
	// $("#txt_cant_'+ filaid").keypress(function(e)
	//  {alert("enter");
	  	if(event.which == 13){ 

		  	var codigo = $('#txt_art_' + filaid).val();
		 	var tipo = $('#txt_tipo_'+ filaid).val();
		 	var canti = parseInt($('#txt_cant_'+ filaid).val());
		 	var lon = $(this).val(); 
		 	var bang = 0;
		 	//var longitud =  $(this).length;
		 	if(canti>0){
		 		//alert(lon);
			   $.ajax({
				 		type:'POST',
				 		url:'./php/cant_producto.php',
				 		data:{cod:codigo},
				 		success:function(data){

				 			var datos = $.parseJSON(data); 
				 			var stock = parseInt(datos.stock);
				 			var uniMin = datos.uni;
				 			var doceMin = datos.doc;
				 			var bultoMin = datos.bul;
				 			var uniMax = datos.uniMax;
				 			var doceMax = datos.doceMax;
				 			var bultoMax = datos.bulMax;
				 			var preuni = datos.preuni;
				 			var predoce = datos.predoce;
				 			var prebulto = datos.prebulto;
				 			//console.log(uniMin);
				 			$("#txt_preu_"+ filaid).val('');

				 			if(canti>stock){
				 				alert("La Cantidad supera el stock");
				 				$('#txt_cant_'+ filaid).val('');

				 			}
				 			else{
				 				
				 			if(tipo==1&&uniMin>0){
				 				if(lon.length>=uniMin.length){
									if(canti>=uniMin && canti<=uniMax)
									{	$("#txt_preu_"+ filaid).val(preuni);
										$('#txt_tipo_'+ filaid).val(1);
										

									}
									else{
										alert("Ingrese Cantidad entre " + uniMin + " y "+ uniMax);
			        		  			$('#txt_cant_'+ filaid).val('');
			        		  			$('#txt_subtotal_price_'+ filaid).val('');
			        		  			$('#txt_total_bruto').val('');
			        		  			$('txt_total_descuento').val('');
			        		  			$('txt_subto').val('');
			        		  			$('#txt_ivat').val('');
			        		  			$('#txt_total_neto').val('');
			        		  			$('#txt_cant_'+ filaid).focus();
			        		  			 
									}
								}

							}else{if(tipo==1&&lon.length<uniMin){alert("La cantidad mínima es.:" + uniMin);}}
								//alert("minimo" + bultoMin);
							if(tipo==2&&bultoMin>0)
							{ if(lon.length>=bultoMin.length ){ 
							
								if(canti>=bultoMin)
								{	
									$("#txt_preu_"+ filaid).val(prebulto);
									$('#txt_tipo_'+ filaid).val(2);
									sbt_price= parseFloat(canti) * parseFloat(prebulto);
									document.getElementById( 'txt_subtotal_price_' + filaid ).value = sbt_price.toFixed(2);
									$(function() {$( '#txt_subtotal_price_' + filaid ).maskMoney({thousands:'', decimal:'.', allowZero:false});});
									js_orders_calculcar_total_price();
								}
								else{							
									alert("La cantidad mínima del Bulto es.: " + bultoMin);
				        			$('#txt_cant_'+ filaid).val('');
				        			$('#txt_subtotal_price_'+ filaid).val('');
				        			$('#txt_total_bruto').val('');
			        		  		$('txt_total_descuento').val('');
			        		  		$('txt_subto').val('');
			        		  		$('#txt_ivat').val('');
			        		  		$('#txt_total_neto').val('');
			        		  		$('#txt_cant_'+ filaid).focus();
									}
							  }

							}
							else{if(tipo==2&&lon.length<bultoMin){alert("La cantidad mínima del Bulto es.:" + bultoMin);}}
							
							if(tipo==3&&doceMin>0){
								if(lon.length>=doceMin.length ){
									if(canti>=doceMin && canti<=doceMax)
									{	$("#txt_preu_"+ filaid).val(predoce);
										$('#txt_tipo_'+ filaid).val(3);
									}
									else{
										alert("Ingrese Cantidad entre " + doceMin + " y "+ doceMax);
			        		  			 $('#txt_cant_'+ filaid).val('');
			        		  			 $('#txt_subtotal_price_'+ filaid).val('');
			        		  			 $('#txt_total_bruto').val('');
			        		  			 $('txt_total_descuento').val('');
			        		  			 $('txt_subto').val('');
			        		  			 $('#txt_ivat').val('');
			        		  			 $('#txt_total_neto').val('');
			        		  			 $('#txt_cant_'+ filaid).focus();
									}

								}
								
				 			}
				 			else{if(tipo==3&&lon.length<doceMin){alert("La cantidad mínima de la Docena es.:" + doceMin);}}
						  }
				 		},
				 		error:function(){

				 		}
				 	});
			    }
			    else{alert("Ingrese Cantidad");}
		}//fin enter
	    
	// });
 });

function Uppercase(u) {
  //var x = document.getElementById("txt_busca");
  u.value = u.value.toUpperCase();
}

function js_botguardar_factura()
{ 

	//alert("guardar");
	document.getElementById('div_loading').innerHTML='<br><div align="center" style="height:100%;"><i style="font-size:large;color:darkred;" class="fa fa-cog fa-spin"></i>Guardando</div>';

	var data = new FormData();

	//data.append('event','save_changes');

	/*CABECERA FACTURA*/
	
	data.append('tipdoc',document.getElementById('rd_docu').value);

	data.append('secuencial',document.getElementById('txtsec').value);

	data.append('codigo',document.getElementById('txt_codcli').value);

	data.append('nombre', document.getElementById('txt_apellido').value);

	data.append('ruc', document.getElementById('txt_ruc').value);

	data.append('dir',document.getElementById('txt_direc').value);

	data.append('fono',document.getElementById('txt_fono').value);

	data.append('correo',document.getElementById('txt_correo').value);

    data.append('ciudad', document.getElementById('txt_ciudad').value);

	data.append('vendedor', document.getElementById('txt_vendedor').value);

	data.append('nvendedor', document.getElementById('txt_nomven').value);

	data.append('descuento', document.getElementById('txt_descpri').value);

	data.append('fpago', document.getElementById('txt_pago').value);

	data.append('plazo',document.getElementById('txt_plazo').value);

	data.append('fvence', document.getElementById('txt_fvence').value);

	data.append('bodega',document.getElementById('sel_bodega').value);


	/*CALCULOS FACTURA*/

	data.append('total_bruto', document.getElementById('txt_total_bruto').value);

	data.append('total_descuento', document.getElementById('txt_total_descuento').value);

	data.append('subtofin',document.getElementById('txt_subto').value);

	data.append('ivaf', 	document.getElementById('txt_ivat').value);

	data.append('total_neto', document.getElementById('txt_total_neto').value);

	

	/*DETALLE FACTURA*/

	var factura = {

    detalle: []

    };
    num_detalle = $('#hd_num_detalle').val();
 	console.log('numdetalle..:'+num_detalle);
	for ( var i=1; i <= num_detalle; i++ )
	{   
	   ban=0;
	  for(l=1; l <= num_detalle; l++)
		 { 
		   if(posi[l]==i)
		    {  ban=1;
			   l=num_detalle+1; 
			   //alert(ban); 
                    }
			
	     
	     }
	 if(ban==0){
	    alert("recorre");
	    if(parseInt($('#'+i).data('num')) == i){
		    	//console.log(i);
		    factura.detalle.push({

		    	cont : i,

	            codigo : 	document.getElementById('txt_art_' + i ).value,

	            descrip: 	document.getElementById('txt_descrip_' + i ).value,

	            cantidad : 	document.getElementById('txt_cant_' + i ).value,

	            tipo : 		document.getElementById('txt_tipo_' + i ).value,

	            preuni :   document.getElementById('txt_preu_' + i ).value,

	            subtotal : document.getElementById('txt_subtotal_price_' + i ).value,

	            iva:       document.getElementById('txt_iva_' + i ).value,

	           descu : document.getElementById('txt_desc_' + i ).value,

	            


	        });

			
	    }
	 }///if bandera
	}

	console.log(factura);
	
	data.append( 'factura', JSON.stringify( factura ) );

	data.append( 'num_detalle', num_detalle );
   
	

	var xhr = new XMLHttpRequest();

	xhr.open('POST', 'php/procesar_factura.php',true);

	xhr.onreadystatechange=function()
	{ 
	  if (xhr.readyState==4 && xhr.status==200)

		{   alert("procesado");
		 document.getElementById( 'div_loading' ).innerHTML="";

			$.growl.notice({ title: "Facturación", message: xhr.responseText });
			console.log(xhr.responseText);
			//window.location.reload();
		}

	};

	xhr.send(data);
	
    document.getElementById('txt_codcli').value = " ";

    document.getElementById('txt_apellido').value = " ";

    document.getElementById('txt_ruc').value = " ";

	document.getElementById('txt_direc').value = " ";

	document.getElementById('txt_fono').value = " ";

	document.getElementById('txt_correo').value = " ";

    document.getElementById('txt_ciudad').value = " ";

	document.getElementById('txt_vendedor').value = " ";

	 document.getElementById('txt_nomven').value = " ";

	document.getElementById('txt_descpri').value = " ";

	document.getElementById('txt_pago').value = " ";

	document.getElementById('txt_plazo').value = " ";

	 document.getElementById('txt_fvence').value = " ";

	document.getElementById('sel_bodega').value = " ";


	/*CALCULOS FACTURA*/

	 document.getElementById('txt_total_bruto').value= " ";

	 document.getElementById('txt_total_descuento').value = " ";

	document.getElementById('txt_ivat').value = " ";

	 document.getElementById('txt_total_neto').value = " ";

    for ( var i=1; i <= num_detalle; i++ )
	{   
        if($('#'+i).data('num') == i)
        {

           	
            	document.getElementById('txt_art_' + i ).value = " ";

	            document.getElementById('txt_descrip_' + i ).value= " ";

	            document.getElementById('txt_cant_' + i ).value= " ";

	            document.getElementById('txt_tipo_' + i ).value= " ";

	           document.getElementById('txt_preu_' + i ).value= " ";

	            document.getElementById('txt_subtotal_price_' + i ).value= " ";

	            document.getElementById('txt_iva_' + i ).value= " ";

	             document.getElementById('txt_desc_' + i ).value= " ";
           }
    }
}
