<?php

include ('connexio.php');

if ( isset($_POST['idPartit']) ) 
	$idPartit = $_POST['idPartit']; 
else
	$idPartit = "0";

if ( isset($_POST['resultat1']) ) 
	$resultat1 = $_POST['resultat1']; 
else
	$resultat1 = "0";

if ( isset($_POST['resultat2']) ) 
	$resultat2 = $_POST['resultat2']; 
else
	$resultat2 = "0";	
	
if ( isset($_POST['user']) ) 
	$usuario = $_POST['user']; 
else
	$usuario = "0";	

if ( isset($_POST['coJugador']) ) 
	$coJugador = $_POST['coJugador']; 
else
	$coJugador = "0";	
		
$fecha_actual=date("d/m/Y");	

/*
echo $idPartit	;
echo $resultat1	;
echo $coJugador	;
echo $resultat2	;
*/
/* Ejecutamos la consulta para recuperar los registros */
$cadenaPartits = "select dtPartit from partits where idPartit=".$idPartit;
$resultadoPartits = mysqli_query($conexion, $cadenaPartits);

if(!$resultadoPartits)
{
}
else
{
	while ($filaPartits = mysqli_fetch_assoc($resultadoPartits))
	{
		$dtFechaPartit = new DateTime($filaPartits['dtPartit']);
		$dtFormatoFecha=  $dtFechaPartit ->format('d/m/Y');
		if (compararFechas ($dtFormatoFecha,$fecha_actual) >0) 
		{
			$cadenaResultats = "UPDATE apostapartits SET Resultat1=".$resultat1." , Resultat2=".$resultat2." where idPartit=".$idPartit." And coJugador=".$coJugador;
			$guardarResultats = mysqli_query($conexion, $cadenaResultats);
			$permet=0;//"L'aposta s'ha guardat correctament";
		}
		else
		{
			$permet=1;//"Ja no es pot apostar en aquest partit";
			//$error = $dom -> createElement("Error", "Ja no es pot apostar en aquest partit");
			
		}
		//$resultadoPartits -> MoveNext( );
	}
}

mysqli_free_result($resultadoPartits);
mysqli_close($conexion);


//header("Location:".$_SERVER['HTTP_REFERER']);  
//$resultado = $permet.$idPartit.$coJugador.$resultat1.$resultat2;
$resultado = $idPartit.",".$permet;
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
