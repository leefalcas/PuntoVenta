$(document).ready(function()
{  

  $("#rd_fact").click(function(){
    
    var pre='secfac';
    $.ajax({
      type: 'POST',
      url: './php/consecuencial.php',
      data:{'pre':pre,'cod':'1'},
      success:function(data)
      {  var sec = data;
         var secu;
         secu = parseInt(sec) + 1;
         
         if(sec!=""){
          $("#txtsec").val(secu);
         }
      }

    });

  });//FIN DE EL RADIO FACTURA

   $("#rd_nota").click(function(){
    var pre='secnvs';
    $.ajax({
      type: 'POST',
      url: './php/consecuencial.php',
      data:{'pre':pre,'cod':'2'},
      success:function(data)
      {  var sec = data;
         var secu;
         secu = parseInt(sec) + 1;
         
         if(sec!=""){
          $("#txtsec").val(secu);
         }
      }

    });

  });//FIN RADIO NOTA DE PEDIDO


 $("#rd_not").click(function(){
    var pre='secnvt';
    $.ajax({
      type: 'POST',
      url: './php/consecuencial.php',
      data:{'pre':pre,'cod':'3'},
      success:function(data)
      {  var sec = data;
         var secu;
         secu = parseInt(sec) + 1;
         
         if(sec!=""){
          $("#txtsec").val(secu);
         }
      }

    });

  });

 
});