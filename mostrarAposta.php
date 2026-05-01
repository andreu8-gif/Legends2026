<?php

include ('connexio.php');

if ( isset($_POST['idPartit']) ) 
	$idPartit = $_POST['idPartit']; 
else
	$idPartit = "2";
if ( isset($_POST['coJugador']) ) 
	$coJugador = $_POST['coJugador']; 
else
	$coJugador = "1";	
		
$fecha_actual=date("d/m/Y");	
?>

 
<?php
/* Ejecutamos la consulta para recuperar los registros */
$cadenaPartits = "select *, ";
$cadenaPartits.= "CASE WHEN partits.Resultat1 is null THEN 'X' ELSE partits.Resultat1 END as ResultatLocal, ";
$cadenaPartits.= "CASE WHEN partits.Resultat2 is null THEN 'X' ELSE partits.Resultat2 END as ResultatVisitant, ";
$cadenaPartits.= "e1.VcNom as local, e1.VcLogo as logolocal, e2.VcNom as visitant, e2.VcLogo as logovisitant ";
$cadenaPartits.= "from partits "; 
$cadenaPartits.= "inner join equips as e1 on partits.equip1 = e1.coEquip ";
$cadenaPartits.= "inner join equips as e2 on partits.equip2 = e2.coEquip ";
$cadenaPartits.= "where partits.idpartit=".$idPartit." ";
$resultadoPartits = mysqli_query($conexion, $cadenaPartits);

if(!$resultadoPartits)
{
}
else
{
	while ($filaPartits = mysqli_fetch_assoc($resultadoPartits))
	{
		//$dtFechaPartit = new DateTime($filaPartits[0]);
		//$dtFormatoFecha=  $dtFechaPartit ->format('d/m/Y');
		//if (compararFechas ($dtFormatoFecha,$fecha_actual) >0) 
		//{
			$resultado = $idPartit.",".$filaPartits['local'].",".$filaPartits["visitant"].",".$filaPartits["logolocal"].",".$filaPartits["logovisitant"].",".$coJugador;
		//}
		//else
		//{
			
			//$error = $dom -> createElement("Error", "Ja no es pot apostar en aquest partit");
			
		//}
		//$resultadoPartits -> MoveNext( );
		
		//$resultado = $idPartit.",".$filaPartits["local"].",".$filaPartits["visitant"].",".$filaPartits["logolocal"].",".$filaPartits["logovisitant"];
		echo $resultado;
	}
}

mysqli_free_result($resultadoPartits);
mysqli_close($conexion);


//header("Location:".$_SERVER['HTTP_REFERER']);  
//$resultado = $idPartit.$coJugador.$resultat1.$resultat2;
//echo $resultado;

/********************************************************************
 * Funcions
 *********************************************************************/
function compararFechas($primera, $segunda)
 {
  $valoresPrimera = explode ("/", $primera);   
  $valoresSegunda = explode ("/", $segunda); 

  $diaPrimera    = $valoresPrimera[0];  
  $mesPrimera  = $valoresPrimera[1];  
  $anyoPrimera   = $valoresPrimera[2]; 

  $diaSegunda   = $valoresSegunda[0];  
  $mesSegunda = $valoresSegunda[1];  
  $anyoSegunda  = $valoresSegunda[2];

  $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
  $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     

  if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
    // "La fecha ".$primera." no es v&aacute;lida";
    return 0;
  }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
    // "La fecha ".$segunda." no es v&aacute;lida";
    return 0;
  }else{
    return  $diasPrimeraJuliano - $diasSegundaJuliano;
  } 

}


?>
