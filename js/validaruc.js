$(document).ready(function()
{      
 $("#txt_ruc").keypress(function(e)
 {  
  var ruc = $(this).val(); 
  $("#mensaje").html('Buscando...');
  if(e.which == 13){
    
    $.ajax({

    type : 'POST',
    url  : './php/validaruc.php',
    data : {'ruc':ruc},

    success : function(data)
        {    console.log(data);
          var jsonobj = JSON.parse(data);
                 
          if(jsonobj!=0){
         
            $('#txt_ruc').val(ruc);
            $('#txt_codcli').val(jsonobj.id);
            $('#txt_apellido').val(jsonobj.nombre);
            $('#txt_direc').val(jsonobj.direc);
            $('#txt_fono').val(jsonobj.telefono);
            $('#txt_correo').val(jsonobj.email);
            $('#txt_ciudad').val(jsonobj.ciudad);

            $('#txt_direc').prop('disabled', false );
            $('#txt_fono').prop('disabled', false );
            $('#txt_correo').prop('disabled', false );
            $('#txt_ciudad').prop('disabled', false );

            $('#txt_busca').prop('disabled', false );
            $('#btn_guardar').prop('disabled',false);
            $("#mensaje").html("")
          }
          else{if(jsonobj==0){
                  $("#mensaje").html('Ruc o Cédula no existe!!');
                  $('#txt_codcli').val("");
                  $('#txt_apellido').val("");
                  $('#txt_direc').val("");
                  $('#txt_fono').val("");
                  $('#txt_correo').val("");
                  $('#txt_ciudad').val("");
              }
          }
        }
    });
   // return false;
   
  }
  else
  {
   $("#mensaje").html('');
  }
 });
 
});