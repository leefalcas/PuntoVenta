<?php 

session_start();
include("conexion.php");
    
$sql="SELECT * FROM CXC_AM_PLAZO WHERE PLZ_ESTA = 'AC' and cod_empr = '$_SESSION[cia]' ORDER BY PLZ_TIPO, PLZ_UNID";
    
$consplazo=odbc_exec($con_db,$sql);
$rsplazo=odbc_num_rows($consplazo);

if($rsplazo>0){
    $j=0;
    while(odbc_fetch_array($consplazo)){
        $tipo=odbc_result($consplazo,"plz_tipo");
       // echo $tipo."<br>";
        switch ($tipo) {
                
            Case "D":
                $dia=odbc_result($consplazo,"plz_unid"). " DIAS".",".odbc_result($consplazo,"plz_codi");
                $datos[] = $dia;
              
                break;
            Case "S":
                $sem=odbc_result($consplazo,"plz_unid"). " SEMANAS".",".odbc_result($consplazo,"plz_codi");
                $datos[]  = $sem;
              
                break;
            Case "Q":
            $quin=odbc_result($consplazo,"plz_unid"). " QUINCENAS".",".odbc_result($consplazo,"plz_codi");
                $datos[] = $quin;
               
                break;
            Case "M":
            $mes=odbc_result($consplazo,"plz_unid"). " MESES".",".odbc_result($consplazo,"plz_codi");
                $datos[]  = $mes;
               
                break;
            Case "T":
            $tri=odbc_result($consplazo,"plz_unid"). " TRIMESTRES"." ".odbc_result($consplazo,"plz_codi");
                $datos[]  = $tri;
                
                break;
            Case "E":
            $sem=odbc_result($consplazo,"plz_unid"). " SEMESTRES".",".odbc_result($consplazo,"plz_codi");
                $datos[]  = $sem;
               
                break;
            Case "A":
             $anio=odbc_result($consplazo,"plz_unid"). " ANOS".",".odbc_result($consplazo,"plz_codi");
                $datos[] = $anio;
               
                break;
        }
        $j++;
    }
   // echo "<br>";
   // echo $datos[2];
    echo json_encode($datos);
        

}

 ?>