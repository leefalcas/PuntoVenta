<?php 
  session_start();
  if(!isset($_SESSION['user'])){echo "<script>location.href = 'index.php';</script>";}
  
  //include("layout/datos_basicos_empresa.php");
?>

<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Punto de Venta</title>   

<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/touch-icon-iphone.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/touch-icon-ipad.png" />
<link rel="shortcut icon" href="images/fav.png" />

<!-- PARA DISPOSITIVOS -->
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">
<meta name="HandheldFriendly" content="true"/>
<meta name="MobileOptimized" content="320"/>

<!-- ESTILO GENERAL -->
<link rel="stylesheet" href="css/Bootstrap4.4.1/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome-5.14/css/all.css" >
<link href="css/reset.css" rel="stylesheet">
<link href="css/global.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet" />
<link href="css/menu.css" rel="stylesheet">


<!-- ESTILO DE LAS FUENTES 
<link href="css/fonts.css" rel="stylesheet">-->
<link href="css/jquery.bxslider.css" rel="stylesheet" />

<link rel="stylesheet" href="css/custom.css">
<script src="js/jquery/jquery.js"></script>
<script src="js/jquery/jquery.maskMoney.js"></script> 

<script type="text/javascript" src="js/validaruc.js"></script>
<script type="text/javascript" src="js/valvendedor.js"></script>
<script type="text/javascript" src="js/buscanombre.js"></script>
<script type="text/javascript" src="js/consecuencial.js"></script>
<script type="text/javascript" src="js/buscacod_cliente.js"></script>
<script type="text/javascript" src="js/index.js"></script>

</head>
<body>

<!--HEADER-->
<header>
<section class="navigation">
  
  <h1><a href="#" title="" class="logo"></a></h1>
  <h3 class="logout"><a href="logout.php" class="lnk">Cerrar Sesión<a/></h3>
</section>
<style type="text/css">
  #suggestions {
    
    height: 150px;
    position: absolute;
    margin-top: -4%;
    z-index: 9999;
    width: 408px;
}

#suggestions .suggest-element {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
}

</style>
</header>
<!--HEADER-->

<!----start-text-slider---->
<div class="container" id="cabecera">
  <div class="panel-heading form-check">
    <h4 class="cab"> 
      <form>
        <fieldset class="prueba2 fieldset2">
          <legend class="legend2">Tipo de Documento</legend><br>
            <input type="radio" id="rd_docu" name="rd_docu" value="fact" checked="true"> Factura
            <input type="radio" id="rd_docu1" name="rd_docu" value="notped"> Nota de Pedido
            <input type="radio" id="rd_docu2" name="rd_docu" value="notven"> Nota de Venta
          
        </fieldset>
      </form>    
    </h4> 
    <div id="fact"><span >Nº Serie <input type="text" name="txtserie" readonly="true" class="caja"></span> </div>
    <div id="fact2">N° Secu   <input type="text" name="txtsec" id="txtsec" class="caja" readonly="readonly"></div>
  </div>
  <div id="datos">
  
   <form class="form-horizontal" role="form" id="datos_factura">
      
        <div class="row" style="width:100%;margin-left: 1%;">
          
          <div class="row" style="width:78%; float:left;">
            <fieldset class="prueba fieldset">
              <legend>Datos Clientes</legend>
              <div class="row">
                  <div class="col-sm-3">
                    <label for="nombre_cliente" class="col-md-1 control-label">Código</label>
                    <input type="text" class="form-control input-sm" id="txt_codcli" onKeypress=" if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                     <span id="mensaje" style="color:#E60F23;width:30%;" ></span>
                    <input id="id_cliente" type='hidden'> 
                  </div>
              
                  <div class="col-sm-6">
                    <label for="tel1" class="col-md-2 control-label">Apellidos/Nombres</label>
                    <input type="text" class="form-control input-sm" id="txt_apellido" >
                  </div>
                  <div id="listnombre" name="listnombre" class="buscli"><input type="hidden" name="hd_codcli" id="hd_codcli"></div>
              
                  <div class="col-sm-3">
                    <label for="mail" class=" control-label">Ruc</label>
                    <input type="text" class="form-control input-sm" id="txt_ruc" required="true" maxlength="13" onKeypress=" if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                   
                  </div>
               </div>
                <div class="row">
                  <div class="col-sm-8">
                    <label for="dir" class="col-md-1 control-label">Dirección</label>
                    <input type="text" class="form-control input-sm" id="txt_direc" >
             
                  </div>
                  <div class="col-sm-4">
                    <label for="fono" class="col-md-1 control-label">Teléfono</label>
                    <input type="text" class="form-control input-sm" id="txt_fono" >
                  </div>
                                
               </div>
               <div class="row">
                  <div class="col-sm-8">
                    <label for="tel1" class="col-md-1 control-label">Email</label>
                    <input type="text" class="form-control input-sm" id="txt_correo">
                  </div>
                  <div class="col-sm-4">
                    <label for="ciudad" class="col-md-1 control-label">Ciudad</label>
                    <input type="text" class="form-control input-sm" id="txt_ciudad" >
                  </div>
               </div>

            </fieldset>
        
        </div>
        <div style="float:right;width:22%;">     
              <fieldset class="pago fieldset">
                 <legend>Pago</legend>
                  <div class="row">
                    <div class="pago1">
                      <label for="nombre_cliente" class="col-md-12">Forma de Pago</label>
                      
                      <select id="txt_pago" class="form-control">
                        <option value="C">Contado</option>
                       <!-- <option>Cheque</option> -->
                        <option value="D">Crédito</option>
                      </select>
                    </div>

                
                    <div class="pago2">
                      <label for="plazo" class="col-md-2 control-label">Plazo</label>
                    
                      <select name="txt_plazo"  id="txt_plazo" class="form-control">
                        <option>Ninguno</option>
                        
                      </select>
                    </div>
                
                    <div class="pago3">
                      <label for="mail" class=" control-label">F Vence</label>
                      <input type="text" class="form-control input-sm" id="txt_fvence" readonly="readonly">
                    </div>
                  </div>

              </fieldset>
        </div>
        
        </div>
        <div class="row" style="width:97%;margin-left:2.5%;margin-top:1%;">
          <div class="row" style="width:100%; float:left;">
          <fieldset class="Vendedor fieldset">
            <div class="row" style="float: left;">
              <div class="col-sm-2">
                <label for="Vendedor" class="col-md-1 control-label">Vendedor</label>
                <input type="text" class="form-control input-sm" id="txt_vendedor" required>
                 <span id="txt_vendedor" style="color:#E60F23;"></span>
              </div>
              <div class="col-sm-5">
                <label for="nombre_vendedor" class="col-md-1 control-label">Nombre</label>
                <input type="text" class="form-control input-sm" id="txt_nomven" readonly="readonly" required="true">
              </div>
              <div class="col-sm-2">
                <label for="des" class=" control-label">% Desc.</label>
                <input type="text" class="form-control input-sm" id="txt_descpri" onKeypress=" if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
              </div>
              <div class="col-sm-3">
                <label for="Local" class=" control-label">Local</label>
                  <select id="sel_bodega" name="sel_bodega" class="form-control">
                  <?php 
                    require("php/conexion.php");
                    $sqlllena="select BODE_CODIGO, BODE_DESCRIP from IOC_M_BODEGA";
                    $conbode=odbc_exec($con_db,$sqlllena);
                    $num_reg=odbc_num_rows($conbode);
                    while(odbc_fetch_array($conbode)){
                                      
                  ?>
                   <option value="<?php echo odbc_result($conbode,'BODE_CODIGO');?>"><?php echo odbc_result($conbode,"BODE_DESCRIP");?></option>
                  <?php }
                        
                 ?>
                </select>
              </div>
            </div>
          </fieldset>
          </div>
          <div class="row" style="float:right;margin-top: 6%">
          
            <span id="loader"></span>
          </div>
        </div>
        
  

    <br>

  </div>

 <!-- <div class='outer_div'></div> Carga los datos ajax -->
 <div style="width:400px;margin-left: 5px;">

  <div><label><b>Buscar Producto:</b></label><br>

     <input type="radio" id="rd_codpro" name="prod" value="fact" checked="true"> Código
     <input type="radio" id="rd_despro" name="prod" value="nota"> Descripción
           
  </div>

    
  <input class='form-control input-sm descrip' type='text' id="txt_busca" name="txt_busca"     onkeyup="Uppercase(this)" placeholder="ingrese código/descripción" >
 
 </div> 
</form><br><br>
 <div id="suggestions" name="suggestions" class="bus"><input type="hidden" name="hd_cod" id="hd_cod"></div>
   <div class="">
      <div class="col-md-12 col-11">
        <div class='panel panel-info'><!-- Inicio detalle-->
          <div class="detalle">Detalle de Factura</div></br>
          <div class="table-wrapper" id="div1">
            <input type='hidden' id="hd_num_detalle" name="hd_num_detalle" value='0' >
            <input type='hidden' id="codigoDetalle" name="codigoDetalle" value='' >
            <table  id='tbl_detalleFactura'>
              <thead>
                <tr class="tableactive">
                  <th style="width:20%"><b>Artículo</b></th>
                  <th  style="width:35%" ><b>Descripción</b></th>
                  <th  style="width:2%"><b>Cantidad</b></th>
                  <th style="width:12%"><b>Tip.Prec</b></th>
                  <th  style="width:10%"><b>P.Unit</b></th>
                  <th style="width:15%"><b>Subtotal</b></th>
                  <th style="width:1px"><b>Iva</b></th>
                  <th style="width:20%"><b>Desc</b></th>
                  <th style="width:5%"></th>
                  
                </tr>
              </thead>
              <tbody id="cuerpo_detalle">
                
              </tbody>
            </table>
           <div class="panel-footer" style="padding-top: 1%;">
              <table class="tableañade" style="width: 100%;">
                <tr>
                  <td width='40%' valign='top'>
                   <!-- <button type='action' class=' boton btn btn-primary btn-sm' id="btn_add_row" name="btn_add_row" onclick="js_orders_add_row_detalleFactura();"><i class="fa fa-plus"></i>&nbsp;Añadir fila</button> 
                    <button type='action' class='boton btn btn-primary btn-sm ' onclick='js_botnueva_factura();' id="btn_add_new" name="btn_add_new"><i class="fas fa-edit"></i>&nbsp;Nuevo </button>-->
                    <button type="button" class="btn btn-primary btn-sm" onclick="js_botguardar_factura();" id="btn_guardar" name="btn_guardar"><i class="far fa-save fa-lg"></i>&nbsp;Guardar </button>
                       
                  </td>
                  <td width='60%'>
                    <table width='40%' align='right' id="dv_total" border="0">
                      <tr border=0><td width='100px'>Valor</td>
                        <td>
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class='form-control input-sm' type='text' id="txt_total_bruto" name="txt_total_bruto" readonly='readonly' disabled='disabled' placeholder='0.00'>
                          </div>
                        </td>
                      </tr>
                      <tr><td>(-) Descuento</td>
                        <td><div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class='form-control input-sm' type='text' id="txt_total_descuento" name="txt_total_descuento"  placeholder='0.00' readonly="readonly" onkeyup='js_orders_calculcar_total_price();'>
                          </div>
                        </td>
                      </tr>
                      <tr><td>Subtotal</td>
                        <td><div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class='form-control input-sm' type='text' id="txt_subto" name="txt_subto"  placeholder='0.00' readonly="readonly">
                          </div>
                        </td>
                      </tr>
                      <tr><td> Iva</td>
                        <td><div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class='form-control input-sm' type='text' id="txt_ivat" name="txt_ivat"  placeholder='0.00' readonly="readonly">
                          </div>
                        </td>
                      </tr>
                      <tr><td></td>
                        <td></td>
                      </tr>
                      <tr><td>Total Neto</td>
                        <td><div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class='form-control input-sm' type='text' id="txt_total_neto" name="txt_total_neto" placeholder='0.00' readonly='readonly' disabled='disabled' >
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>

          </div>
        <div id='div_loading'></div>
        </div><!-- Fin detalle-->
        
      
  

      
    </div>  
 </div>
</div>
<!--- footer --->
<section class="footer">
  <?php $addURL = ""; echo "<div>"; include("layout/pie.php"); echo "</div>"; ?> 
</section>

<script src="js/jquery/bootstrap.min.js"></script>
 <script src="js/growl/jquery.growl.js"></script>
<script type="text/javascript">
   $(document).ready(function(){

    $('#txt_direc').prop('disabled', true );
    $('#txt_fono').prop('disabled', true );
    $('#txt_correo').prop('disabled', true );
    $('#txt_ciudad').prop('disabled', true );

    $('#txt_busca').prop('disabled',true);
    $('#btn_guardar').prop('disabled',true);
    $.ajax({
      type:'POST',
      url:"./php/llenacombo.php",
      data:{cod:1},
      success:function(dato){
        
        let data = JSON.parse(dato);
        let strarr = data.length;
        for(i=0;i<strarr;i++){
          let str=data[i].split(",");
          //console.log(str[0]);
          $("#txt_plazo").append('<option value="'+str[1]+'">'+str[0]+'</option>');
        }

      },
      error:function(){
        console.log("Error al Cargar el Combo Plazo Pago");
      }

    });


   });

    // if($("#rd_docu").is(':checked')) {

     $("#rd_docu").click(function(){
       // alert("docu");
        var pre='SECFAC';
        $.ajax({
          type: 'POST',
          url: './php/consecuencial.php',
          data:{'pre':pre},
          success:function(data)
          {  var sec = data;
             var secu;
             secu = parseInt(sec) + 1;
             
             if(sec!=""){
              $("#txtsec").val(secu);
             }
          }

        });
     })
     $("#rd_docu1").click(function(){
        var pre='SECNVS';
        $.ajax({
          type: 'POST',
          url: './php/consecuencial.php',
          data:{'pre':pre},
          success:function(data)
          {  var sec = data;
             var secu;
             secu = parseInt(sec) + 1;
             
             if(sec!=""){
              $("#txtsec").val(secu);
             }
          }

        });
     })
     $("#rd_docu2").click(function(){
        var pre='SECNVT';
        $.ajax({
          type: 'POST',
          url: './php/consecuencial.php',
          data:{'pre':pre},
          success:function(data)
          {  var sec = data;
             var secu;
             secu = parseInt(sec) + 1;
             
             if(sec!=""){
              $("#txtsec").val(secu);
             }
          }

        });
     })

      
  
</script>

</body>
</html>