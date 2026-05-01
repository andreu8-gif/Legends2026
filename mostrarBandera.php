<?php

include ('connexio.php');

if ( isset($_POST['idEquip']) ) 
	$idEquip = $_POST['idEquip']; 
else
	$idEquip = "0";

	
/* Ejecutamos la consulta para recuperar los registros */
if ( $idEquip <> "0")
{
	$cadenaEquips = "select * from equips where idEquip=".$idEquip." AND Actiu=true order by vcNom";	
	$resultadoEquips = mysqli_query($conexion, $cadenaEquips);

	if(!$resultadoEquips)
	{
	}
	else
	{

		while ($filaEquips = mysqli_fetch_assoc($resultadoEquips))
		{
				$resultado = $filaEquips['vcLogo'].",".$filaEquips['vcNom'].",".$filaEquips['coEquip'];
		}
		
	}
	mysqli_free_result($resultadoEquips);
	mysqli_close($conexion);
}
else
{
		$resultado = ',,';
		}

		echo $resultado;
		


?>
