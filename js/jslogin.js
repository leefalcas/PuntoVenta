  $(document).ready(function() {
    $('#bt_login').click(function(){  
   
      var u = $('#txt_usu').val();
      var p = $('#txt_clave').val();
      var cia= $('#sel_cia').val();
      
      if(u == "" || p == ""){
         alert('Debe ingresar Usuario y Contraseña Válidos.');
         $("#txt_usu").focus();
      }
      else{
       alert("aproba");
        $.ajax({
                type:'POST',
                url: './php/buscausuario.php',
                data: {'usuario': u, 'psw': p, 'cia': cia},
                sucess:function(data){ 
                  alert(data);
                  if(data == "1"){
                    alert("login");
                    parent.location.href='inicio.php';
                  }
                  else {alert("Datos Incorrectos");
                        $("#txt_usu").val('');
                        $("#txt_clave").val('');
                        $("#txt_usu").focus();

                  }
                }

        });
      
      }
    });
  });
 