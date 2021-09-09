/* Busca el nombre del cliente */
$(document).ready(function()
{      
  $("#txt_codcli").keypress(function(e)
  { var codcli = $(this).val(); 
    var num;
    num=pad(codcli,8);
    $("#mensaje").html('Buscando...');
    if(e.which == 13){
     $("#txt_codcli").val(num);
     $.ajax({
      type: "POST",
        url: "./php/buscacod_cliente.php",
        data: {codcli:num},
        success: function(dato) {
      
          if(dato!=''){
            $("#mensaje").html(""); 
            var datos = JSON.parse(dato);
            $("#txt_codcli").val(datos.cod);
            $("#txt_apellido").val(datos.nombre);
            $("#txt_ruc").val(datos.ruc);
            $("#txt_direc").val(datos.nombre);
            $("#txt_fono").val(datos.telefono);
            $("#txt_correo").val(datos.email);
            $("#txt_ciudad").val(datos.ciudad);
            $('#txt_busca').prop('disabled', false );
          
            if(datos.fpago=='D')
              { console.log(datos.plazo);
                var id = datos.plazo;
                alert(id);
                            
                id=parseInt(id);
                document.getElementById('txt_pago').selectedIndex=1;
                document.getElementById('txt_plazo').value=id;

              }
            else{console.log(datos.fpago);
              $("#txt_pago option[value='C']").prop("selected",true);}
            
          }
          else{
            $("#mensaje").html('Código Del Cliente No Existe!!');
            $("#txt_ruc").val("");
            $('#txt_codcli').val("");
            $('#txt_apellido').val("");
            $('#txt_direc').val("");
            $('#txt_fono').val("");
            $('#txt_correo').val("");
            $('#txt_ciudad').val("");
   
          }
      },
       error: function(){
        alert("Error en la Carga de Datos");
       }
     }); 
   
    }//fin del enter
 })
});
 
function pad (str, max) {
 str = str.toString(); 
 return str.length < max ? pad("0" + str, max) : str; }

