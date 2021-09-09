<?
//session_start();
include ("conexion.php");

// if(isset($_POST['accion']) == 'login' and isset($_POST['datos'])){
//    $datos=$_POST['datos'];
    //$usu=$datos['usuario'];
   // $psw=$datos['psw'];
   // $cia = $datos['cia'];
  $cia = "1";
  $usu="SUPERVISOR";
  $psw="123";
    
    $sql_user = "SELECT * FROM ASD_R_USER WHERE (US_CODIGO='$usu' AND US_PASSWORD='$psw') AND (US_ESTADO='AC' AND US_CODCIA='$cia')";
    $rs_user = odbc_exec($con_db, $sql_user);
    $contfila = odbc_num_rows($rs_user);
    echo "registros"."<br>";
   /* if($contfila>0){
      echo "1";
    }
    else{echo "0";}*/

 
    
?>