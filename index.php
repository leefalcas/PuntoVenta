<!DOCTYPE html>
<html lang="es-ES">
<head>
  <meta charset="UTF-8">
  <title>Sistema Facturación Web</title>
  
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> 
 
  <link rel="stylesheet" href="css/Bootstrap4.4.1/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome-5.14/css/all.css" >
  <link href="css/estiloa.css" rel="stylesheet" />

  <script src="js/jquery/jquery.js"></script>
 <!-- <script src="js/jslogin.js"></script>  -->
  <script src="js/jquery/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/normalize.min.css">
</head>
 
<body style="background-color:rgba(191, 220, 251);">
  <div class="container wrapper">

    <div class="row">
      <form class="login">
       
        <p class="title" align="center">Acceso al Sistema</p>
        <div class="form-group">
        <input type="text" id="txt_usu" placeholder="Usuario"  required/>
        <i class="fa fa-user"></i>
        <input type="text" id="txt_clave" placeholder="Contraseña" required />  <i class="fa fa-key"></i>
        </div>
        <div class="form-group"> 
          <label for="clave">Empresa:</label>
          <?php 
          error_reporting(0);
          include("php/conexion.php");
         
          $sql="select * from ASD_M_COMPANIA where CI_ESTADO='AC'";
          $rs=odbc_exec($con_db,$sql);
          $col=odbc_num_rows($rs);
          echo "<select id=sel_cia name=sel_cia class=form-control>";
          while(odbc_fetch_array($rs)) { 
            $val=odbc_result($rs,1);
            $des=odbc_result($rs,"CI_NOMCOMERCIAL");
            echo "</br>";
            echo "<option value=$val>$des</option>";
          }
          echo "</select>";
          ?>
        
        </div>
         
      
        <br>
      
       <button type="submit"  id="btlogin">Iniciar Sesión </button>
      </form>
    </div>
    
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#btlogin').click(function(){  
      
        var u = $('#txt_usu').val();
        var p = $('#txt_clave').val();
        var cia= $('#sel_cia').val();
        //var u = "MARJORIE";
        //var p = "1996MAYO";
        //var cia= 1;
        
        if(u == "" || p == ""){
           alert('Debe ingresar Usuario y Contraseña Válidos.');
           $("#txt_usu").focus();
        }
        else{
         //alert("aproba");        
          $.post('php/buscausuario.php',{'accion': 'login', 'datos':{'usuario': u, 'psw': p, 'cia': cia}}, 
            function(data){ 
              if(data == "1"){
               // alert("login");
                parent.location.href='inicio.php';
              }
              else {alert("Datos Incorrectos");
                    $("#txt_usu").val('');
                    $("#txt_clave").val('');
                    $("#txt_usu").focus();

              }
          });
        
        }
      });
    });
 </script>
 
  

</body>
</html>

