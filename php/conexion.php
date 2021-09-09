<?php 

$uid ='sa';
$pwd ='123';
$dsn = "Driver={SQL Server};Server=localhost;Database=BD_TITU;Integrated Security=SSPI;Persist Security Info=False;";
// Se realiza la conexón con los datos especificados anteriormente
$con_db = odbc_connect($dsn,'','');
if (!$con_db) 
{ 
exit( "Error al conectar: " . $con_db);
}
//else {echo "conectado".$con_db;}



?>