$(document).ready(function()
{      
 $("#txt_vendedor").keypress(function(e)
 {  
  var codvendedor = $(this).val(); 
  var cod;
  cod = completa_cero(codvendedor,8);
  $("#menven").html('Buscando...');
  if(e.which == 13){ 
   
    $.ajax({
      type : 'POST',
      url  : './php/valvendedor.php',
      data : {'vendedor':codvendedor},

      success : function(data)
        { 
            var jsonobj = JSON.parse(data); 
            $('#txt_vendedor').val(jsonobj.id);
            $('#txt_nomven').val(jsonobj.nombre);
            $("#menven").html("");
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

function completa_cero (str, max) {
 str = str.toString(); 
 return str.length < max ? pad("0" + str, max) : str; }