<?php

include ('connexio.php');


if (isset($_POST['idGrup'])) 
	$idGrup = $_POST['idGrup']; 
else
	$idGrup = '1';

if (isset($_POST['idFase'])) 
	$idFase = $_POST['idFase']; 
else
	$idFase = "2";

	
/* Ejecutamos la consulta para recuperar los registros */
if ( $idGrup <> 0)
{
	$cadenaEquips  = "select * from equips ";
	$cadenaEquips .= "inner join grups ON equips.idEquip = grups.idEquip ";
	$cadenaEquips .= "where idGrup = ".$idGrup." AND Actiu=true order by Ordre";	
}
else if ($idFase <> "" && $idFase <> "0")
	$cadenaEquips = "select * from equips where idFase=".$idFase." and Actiu=true order by vcNom";	
else
	$cadenaEquips = "select * from equips where Actiu=true order by vcNom";	

/*$cadenaEquips = "select * from equips ";
$cadenaEquips.= "inner join grups on equips.idEquip=grups.idEquip ";
$cadenaEquips.= "where idFase=".$idFase;
if ($idFase == 1) $cadenaEquips.= " AND idGrup=".$idGrup;*/

	
$resultadoEquips = mysqli_query($conexion, $cadenaEquips);

if(!$resultadoEquips)
{
	print $cadenaEquips;
}
else
{
	
	$resultado = '<option value="0"></option>';
	while ($filaEquips = mysqli_fetch_assoc($resultadoEquips))
	{
			$resultado.= '<option value="'.$filaEquips['idEquip'].'">'.$filaEquips['vcNom'].'</option>';
	}
	echo $resultado;
}

mysqli_free_result($resultadoEquips);
mysqli_close($conexion);

?>
