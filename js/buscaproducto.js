$(document).ready(function()
{      
 $("#txt_ruc").keypress(function(e)
 {  
  var ruc = $(this).val(); 
  
  if(e.witch==13)
  {  
   $("#mensaje").html('Buscando...');
   
    $.ajax({

    type : 'POST',
    url  : './php/validaruc.php',
    data : {'ruc':ruc},

    success : function(data)
        { 
          var jsonobj = $.parseJSON(data); 
          $('#txt_codcli').val(jsonobj.id);
          $('#txt_apellido').val(jsonobj.nombre);
          $('#txt_direc').val(jsonobj.direc);
          $('#txt_fono').val(jsonobj.telefono);
          $('#txt_correo').val(jsonobj.email);
          $('#txt_ciudad').val(jsonobj.ciudad);
          $("#mensaje").html("")
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