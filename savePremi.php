<?php

include ('connexio.php');

if ( isset($_POST['idPremi']) ) 
	$idPremi = $_POST['idPremi']; 
else
	$idPremi = "1";

if ( isset($_POST['idEquip']) ) 
	$idEquip = $_POST['idEquip']; 
else
	$idEquip = "1";

if ( isset($_POST['coJugador']) ) 
	$coJugador = $_POST['coJugador']; 
else
	$coJugador = "1";	
		
$fecha_actual=date("d/m/Y");	

/*
echo $idPartit	;
echo $resultat1	;
echo $coJugador	;
echo $resultat2	;
*/
/* Ejecutamos la consulta para recuperar los registros */
$cadenaPremis = "select dtPremi from premis where idPremi=".$idPremi;	
$resultadoPremis = mysqli_query($conexion, $cadenaPremis);

if ($idEquip == "0")
{
	$permet=2;
}
else {
	if(!$resultadoPremis)
	{
		
	}
	else
	{
		while ($filaPremis = mysqli_fetch_assoc($resultadoPremis))
		{
			$dtFechaPremi = new DateTime($filaPremis['dtPremi']);
			$dtFormatoFecha=  $dtFechaPremi ->format('d/m/Y');
			//if (compararFechas ($dtFormatoFecha,$fecha_actual) >0) 
			//{
				$cadenaResultats = "UPDATE apostapremis SET idEquip=".$idEquip." where idPremi=".$idPremi." And coJugador=".$coJugador;	
				$guardarResultats = mysqli_query($conexion, $cadenaResultats);

				$permet=0;//"L'aposta s'ha guardat correctament";
			//}
			//else
			//{
			//	$permet=1;//"Ja no es pot apostar en aquest partit";
				//$error = $dom -> createElement("Error", "Ja no es pot apostar en aquest partit");
				
			//}
			//$resultadoPremis -> MoveNext( );
		}
	}

	mysqli_free_result($resultadoPremis);
	mysqli_close($conexion);

}
//header("Location:".$_SERVER['HTTP_REFERER']);  
//$resultado = $permet.$idPartit.$coJugador.$resultat1.$resultat2;
$resultado = $idPremi.",".$permet;//.",".$cadenaResultats;
echo $resultado;
//echo $permet;

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
