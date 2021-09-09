$(document).ready(function()
{      
 $("#txt_codcli").keyup(function()
 {  
  var codcli = $(this).val(); 

  if(codcli.length > 7)
  {  
   $("#mensaje").html('Buscando...');
   
    $.ajax({

    type : 'POST',
    url  : './php/validacod.php',
    data : {'codcli':codcli},

    success : function(data)
        { 
          var jsonobj = JSON.parse(data);
                 
          if(jsonobj!=0){
              
            $('#txt_codcli').val(jsonobj.id);
            $('#txt_apellido').val(jsonobj.nombre);
            $('#txt_ruc').val(jsonobj.ruc);
            $('#txt_direc').val(jsonobj.direc);
            $('#txt_fono').val(jsonobj.telefono);
            $('#txt_correo').val(jsonobj.email);
            $('#txt_ciudad').val(jsonobj.ciudad);

            //$('#txt_apellido').prop('disabled', false );
           // $('#txt_ruc').prop('disabled', false );
            $('#txt_direc').prop('disabled', false );
            $('#txt_fono').prop('disabled', false );
            $('#txt_correo').prop('disabled', false );
            $('#txt_ciudad').prop('disabled', false );

            $('#txt_busca').prop('disabled', false );
            $('#btn_guardar').prop('disabled',false);
            $("#mensaje").html("")
          }
          else{if(jsonobj==0){
                  $("#mensaje").html('Código Del Cliente No Existe!!');
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
    return false;
   
  }
  else
  {
   $("#mensaje").html('');
  }
 });
 
});