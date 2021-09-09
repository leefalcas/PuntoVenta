/* Busca el nombre del cliente */
$(document).ready(function()
{      
  $("#txt_apellido").keypress(function(e)
  { var nomcli = $(this).val(); 
 //   event.preventDefault();
 
    var nombre = $(this).val();    
    var band = 0;

    if(e.which == 13){
     //alert(nomcli);
     $.ajax({
      type: "POST",
        url: "./php/buscacliente.php",
        data: {nomcli:nomcli,tipo:'1'},
        success: function(dato) {
       
        if(dato!=''){
         $('.buscli').css({'overflow-y': 'scroll'});
         $('#listnombre').fadeIn(1000).html(dato);
            $('.listcli').on('click', function(){
             var id = $(this).attr('id');
            
             $('#listnombre').fadeOut(1000);
             var cod = id;
             var lin_det = 0;
             $('.codigo').each(function(){
            lin_det = $(this).val();
            if(cod==lin_det)
             {  band = 1;
              }

            });
            if(band==0){
              $.post('./php/buscacliente.php', { cod : cod, tipo:'2' }, 
                function(resp) {
                  if(resp!='nada'){
                    var datos = JSON.parse(resp);
                    $("#txt_codcli").val(datos.cod);
                    $("#txt_apellido").val(datos.nombre);
                    $("#txt_ruc").val(datos.ruc);
                    $("#txt_direc").val(datos.nombre);
                    $("#txt_fono").val(datos.telefono);
                    $("#txt_correo").val(datos.email);
                    $("#txt_ciudad").val(datos.ciudad);
                    $('#txt_busca').prop('disabled', false ); 
                  }
                  else{alert('No se encontró datos');}          
              });
            } 
          
            });
       }
       else{alert("No se encuentra Cliente");}
      },
       error: function(){
        alert("Error en la Carga de Datos");
       }
     }); 
   
    }//fin del enter
 })
});
 
