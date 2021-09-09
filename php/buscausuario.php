<?php
session_start();
include ("conexion.php");

 if(isset($_POST['accion']) == 'login' and isset($_POST['datos'])){
    $datos=$_POST['datos'];
    $usu=$datos['usuario'];
    $psw=$datos['psw'];
    $cia = $datos['cia'];
  
    
   $sql_user = "SELECT * FROM ASD_R_USER WHERE (US_CODIGO='$usu' AND US_PASSWORD='$psw') AND (US_ESTADO='AC' AND US_CODCIA='$cia')";
   $rsuser = odbc_exec($con_db, $sql_user);
   $contfila = odbc_num_rows($rsuser);
   if($contfila>0){
      $_SESSION['user'] = odbc_result($rsuser, "US_CODIGO");
      $_SESSION['psw'] = odbc_result($rsuser, "US_PASSWORD");
      $_SESSION['cia'] = $cia;
      $_SESSION['ucod'] = odbc_result($rsuser, "PE_CODIGO");
      $_SESSION["timeout"] = 600;
      echo "1";
    }
   else{echo "0";}
}
 
    
?>