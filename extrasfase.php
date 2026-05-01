<?php
	//$fase = "1";
	//$coJugador = "1";

	/* Ejecutamos la consulta para recuperar los registros UN SOLO EQUIPO*/
	// $cadenaPremis="select P.*,E.coEquip,E.vcNom,E.vcLogo from premis P ";
	// $cadenaPremis.="LEFT OUTER JOIN equips E ON P.idequip = E.idequip ";
	// $cadenaPremis.="where P.Actiu= true  order by P.ordre asc";
	/* Ejecutamos la consulta para recuperar los registros MAS DE UN SOLO EQUIPO*/
	$cadenaPremis="select P.* ,E2.coEquip, E2.vcNom, E2.vcLogo, TOTAL.quants as Quants ";
	$cadenaPremis.="from premis P  ";
	$cadenaPremis.="LEFT OUTER JOIN premisequips PE ON P.idPremi = PE.idPremi ";
	$cadenaPremis.="LEFT OUTER JOIN equips E2 		ON PE.idequip = E2.idequip  ";
	$cadenaPremis.="LEFT OUTER JOIN (select idPremi, count(*) as quants from premisequips group by idPremi) as TOTAL on P.idPremi = TOTAL.idPremi ";
	$cadenaPremis.="where P.Actiu= true and P.IdFase=".$faseId." AND P.idGrup ".$grupId." order by P.ordre asc ";
	$resultadoPremis = mysqli_query($conexion, $cadenaPremis);
	
	//$cadenaPunts ="SELECT * FROM vista_clasificacion";
	$numjugador = 1;
	$resultadoPunts = mysqli_query($conexion, $cadenaPunts);


?>

<!-- Pills Tabs -->
<?php
if(!$resultadoPremis)
{
	print $conexion -> ErrorMsg( );
}
else
{

	$mensaje='<div class="container">';
	$mensaje.='	<div  class="">';
	$mensaje.='		<div class="card-group mt-3">';
	/*  -------------------------PREMIS ------------------------------------------*/ 
	$diferents = false;
	$QuantsAux = 1;
	$mensaje .= '		<div class="card text-center border-info bg-header text-white"><div class="card-body fuente d-flex  align-items-center mx-auto">JUGADORES</div></div>' . "\r\n";
	while ($filaPremis = mysqli_fetch_assoc($resultadoPremis))
	{	
		if ($diferents == false)
		{
			$mensaje.='	<div class="card text-center border-info bg-header text-white">';
			$mensaje.='		<div class="card-body cell">';
			$mensaje .= '';
			$mensaje .= '		<div class="row fuente h-100 mh-100" id="cappremi">' . "\r\n";
			$mensaje .= '			<div class="col-12 cabpre">'.$filaPremis['Nom'].'</div>' . "\r\n";
		}

		if ($filaPremis['Quants'] > 1 && $filaPremis['Quants'] != $QuantsAux)
		{
			$QuantsAux = $QuantsAux +1;
			$diferents = true;
		}
		else
		{
			$QuantsAux = 1;
			$diferents = false;
		}
		
		if ($filaPremis['coEquip'] == null)
		{
			$mensaje .= '				<div class="col-12 "></div>' . "\r\n";
			$mensaje .= '				<div class="col-12 "></div>' . "\r\n";
		}
		else
		{	
			$mensaje .= '				<div class="col-12 cabpre"><img style="width: 25px; height: 25px;" alt="" src="/assets/flags/'.$filaPremis['vcLogo'].'">&nbsp;'.$filaPremis['vcNom'].'</div>' . "\r\n";
		}

		if ($diferents == false)
		{
			$mensaje .= '				<div class="col-12 d-none d-md-block font-weight-normal"><i class="bi bi-trophy-fill px-2">&nbsp;Puntos: <b>'.$filaPremis['Puntuacio'].'</b></i></div>' . "\r\n";			
			$mensaje .= '				<div class="col-12 d-none d-md-block font-weight-normal"><i class="bi bi-clock pe-2">&nbsp;Fecha: <b>'.date('d/m/Y', strtotime($filaPremis['dtPremi'])).'</b></i></div>' . "\r\n";
			$mensaje .= '			</div>' . "\r\n";
			$mensaje .= '		</div>' . "\r\n";
			$mensaje .= '	</div>' . "\r\n";
		}
	}
	$mensaje .= '		<div class="card text-center border-info bg-header text-white"><div class="card-body fuente d-flex  align-items-center mx-auto">PUNTOS</div></div>' . "\r\n";	
	$mensaje.='		</div>';
	$mensaje.='	</div>';

	$mensaje.='<div style="height: 550px !important; overflow: scroll;">';
	/*  -------------------------JUGADORS ------------------------------------------*/  
	while ($filaPunts = mysqli_fetch_assoc($resultadoPunts))
	{
		$mensaje.='<div class="card-group mt-1">';
		$g = ($filaPunts["coJugador"] == $coJugador) ? 'bg-cojugador' : (($numjugador%2 == 1) ? 'bg-alter' : '');
		// $g = ($filaPunts["coJugador"] == $coJugador) ? 'bg-cojugador' : '';
		$mensaje .= '		<div class="card text-center border-info">';
		$mensaje .= '			<div class="card-body cell">';
		$mensaje .= '				<div class="row capjugador mx-0 my-0 '.$g.'">';		
		$mensaje .= '					<div class="col-12 align-middle fuente ms-2 mt-2 text-left">'.$numjugador.' - '.$filaPunts["Nickname"].'</div>' . "\r\n";
		$mensaje .= '					<div class="col-12 align-middle fuente me-2 mb-2 text-right">'.$filaPunts["Puntuacio"].'</div>' . "\r\n";
		$mensaje .= '  				</div>' . "\r\n";
		$mensaje .= '  			</div>' . "\r\n";
		$mensaje .= '  		</div>' . "\r\n";		

		/*----Branca JUGADORS----*/
		$cadenaApostaPremis ="SELECT A.coJugador, A.idPremi, A.idEquip, E.coEquip, E.vcNom, ";
		$cadenaApostaPremis .="CASE WHEN PE.idEquip is null OR PE.idEquip = 0 OR P.dtPremi > now() "; //curdate()
		$cadenaApostaPremis .="THEN null ";
		$cadenaApostaPremis .="ELSE  ";
		$cadenaApostaPremis .="			CASE WHEN PE.IdEquip Is NOT NULL AND PE.idEquip = A.idEquip ";
		$cadenaApostaPremis .="			THEN 1 ";
		$cadenaApostaPremis .="			ELSE 0 ";
		$cadenaApostaPremis .="			END ";
		$cadenaApostaPremis .="END isPremi, E.vcLogo, P.dtPremi,  ";
		$cadenaApostaPremis .="CASE WHEN PE.idEquip is null OR PE.idEquip = 0 OR P.dtPremi > now() "; //curdate()
		$cadenaApostaPremis .="THEN null ";
		$cadenaApostaPremis .="ELSE  ";
		$cadenaApostaPremis .="			CASE WHEN PE.IdEquip Is NOT NULL AND PE.idEquip = A.idEquip ";
		$cadenaApostaPremis .="			THEN P.Puntuacio ";
		$cadenaApostaPremis .="			ELSE 0 ";
		$cadenaApostaPremis .="			END ";
		$cadenaApostaPremis .="END as Punts ";
		//$cadenaApostaPremis .="CASE WHEN P.IdEquip= A.IdEquip THEN P.Puntuacio ELSE 0 END as Punts ";
		$cadenaApostaPremis .="FROM premis P  ";
		$cadenaApostaPremis .="LEFT OUTER JOIN apostapremis A ON P.IdPremi = A.IdPremi ";
		$cadenaApostaPremis .="LEFT OUTER JOIN premisequips PE ON P.idPremi = PE.idPremi ";//" AND A.IdEquip = PE.idEquip ";
		$cadenaApostaPremis .="LEFT OUTER JOIN equips E ON A.idequip = E.idequip  ";
		$cadenaApostaPremis .="INNER JOIN jugadors JJ on A.coJugador = JJ.coJugador ";				
		$cadenaApostaPremis .="WHERE  A.coJugador=".$filaPunts['coJugador']." ";
		$cadenaApostaPremis .=" AND JJ.Actiu=1 ";						
		$cadenaApostaPremis .=" AND P.Actiu=1 ";	
		$cadenaApostaPremis .=" AND P.IdFase=".$faseId;	
		$cadenaApostaPremis .=" AND P.idGrup ".$grupId; 	
		$cadenaApostaPremis .=" order by P.ordre asc, isPremi desc";		
		
		
		
		$totalpunts = 0;
		$idPremi =0;
		$resultadoApostaPremis = mysqli_query($conexion, $cadenaApostaPremis);
		while ($filaApostaPremis = mysqli_fetch_assoc($resultadoApostaPremis))
		{
			if ($idPremi != $filaApostaPremis["idPremi"])
			{
				$idPremi = $filaApostaPremis["idPremi"];
				$totalpunts = $totalpunts + $filaApostaPremis["Punts"];
				$dtFechaPremi = new DateTime($filaApostaPremis["dtPremi"]);
				$dtFormatoFecha=  $dtFechaPremi ->format('d/m/Y');
							
				$mensaje .= '	<div class="card text-center border-info">';
				$mensaje .= '		<div class="card-body cell">';
				$f = ($filaApostaPremis["coJugador"] == $coJugador) ? 'bg-cojugador' : (($numjugador%2 == 1) ? 'bg-alter' : '');
				//$f = ($filaApostaPremis["coJugador"] == $coJugador) ? 'capjugadorscojugador' : '';
				$mensaje .= '			<div class="row align-items-center justify-content-between mx-0 my-0 h-100 fuente '.$f.'"  text-nowrap>';
										
				$mensaje .= '				<div class="col-3 col-md-3 justify';
				if ($filaApostaPremis["isPremi"] == null )
					$mensaje .= '			 	copaapostapremi">&nbsp;' . "\r\n";
				else
					if ($filaApostaPremis["isPremi"] == 1 )
						$mensaje .= '			copaapostapremi"><img style="width: 25px; height: 25px;" src="/assets/img/image1.png">' . "\r\n";
					else
						$mensaje .= '			copaapostapremi"><img style="width: 25px; height: 25px;" src="/assets/img/image4.png">' . "\r\n";				

				$mensaje .= '				</div> ' . "\r\n";
				if ($filaApostaPremis['Punts'] > 0)
				{
					$mensaje .= '			<div class="col-3 col-md-3 justify-content-center d-flex">';
					$mensaje .= '				<div class="circulo c-success text-center"><span class="circulo c-success">' . "\r\n";				
					$mensaje .= '					'.$filaApostaPremis['Punts']."\r\n";				
					$mensaje .= '				</div>' . "\r\n";				
					$mensaje .= '			</div> ' . "\r\n";
				}				
				$mensaje .= '				<div class="col-6 col-md-6"> ' . "\r\n";
				$mensaje .= '					<div class="row  text-nowrap"> ' . "\r\n";

				if ($filaApostaPremis["idEquip"] == null)
				{
					$mensaje .= '					<div class="col-6 col-md-12 banderaapostapremi">&nbsp;</div>' . "\r\n";
					$mensaje .= '					<div class="col-6 col-md-12 equipapostapremi">&nbsp;</div>' . "\r\n";
				} else if ($filaApostaPremis["coJugador"] != $coJugador && compararFechas ($dtFormatoFecha,$fecha_actual) >0) 
					{
						$mensaje .= '				<div class="col-6 col-md-12 banderaapostapremi"><img class="balon" alt="" src="/assets/flags/BAL.png"></div>' . "\r\n";
						$mensaje .= '				<div class="col-6 col-md-12 equipapostapremi">XXX</div>' . "\r\n";
					}
					else
					{
						$mensaje .= '				<div class="col-6 col-md-12 banderaapostapremi"><img style="width: 20px; height: 20px;" alt="" src="/assets/flags/'.$filaApostaPremis["vcLogo"].'"></div>' . "\r\n";
						$mensaje .= '				<div class="col-6 col-md-12 d-sm-none d-xl-block fuente normal"><span class="d-none d-sm-block"><p class="card-text">'.$filaApostaPremis["coEquip"].'</p></span><span class="d-block d-sm-none">'.$filaApostaPremis["vcNom"].'</span></div>' . "\r\n";
					}
				$mensaje .= '					</div>' . "\r\n";	
				$mensaje .= '				</div>' . "\r\n";
				$mensaje .= '			</div>' . "\r\n";
				$mensaje .= '		</div>' . "\r\n";
				$mensaje .= '	</div>' . "\r\n";
			}
		}

		// $k = ($filaPunts["coJugador"] == $coJugador) ? 'bg-cojugador' : '';
		$k = ($filaPunts["coJugador"] == $coJugador) ? 'bg-cojugador' : (($numjugador%2 == 1) ? 'bg-alter' : '');
		$mensaje .= '<div class="card text-center border-info '.$k.'"><div class="card-body fuente big d-flex  align-items-center mx-auto '.$k.'"">'.$totalpunts.'</div></div>' . "\r\n";	
		// $mensaje .= '<div class="card text-center border-info"><div class="card-body cell"><div class="row fuente w-100 h-100 align-items-center d-flex mx-auto '.$k.'">'.$totalpunts.'</div></div></div>' . "\r\n";
		// if ($filaPunts["coJugador"] == $coJugador)
		// 	$mensaje .= '<div class="card text-center border-info"><div class="card-body cell"><div class="capjugadorscojugador" style="color: #000000;"><br>'.$totalpunts.'<br> </div></div></div>' . "\r\n";
		// else
		// 	$mensaje .= '<div class="card text-center border-info"><div class="card-body cell"><div class="capjugadors" style="color: #000000;"><br>'.$totalpunts.' <br></div></div></div>' . "\r\n";
		mysqli_free_result($resultadoApostaPremis);
		$mensaje .= '</div>';
		//$mensaje .= '</tr>';
		$numjugador++;
		

	}
	mysqli_free_result($resultadoPunts);
	$mensaje .= '</div>';
	$mensaje .= '</div>';
	// $mensaje .= '</div>';
	// $mensaje .= '</div>';
}

echo $mensaje;
/*  -------------------------PREMIS ------------------------------------------*/ 
// mysqli_free_result($resultadoPremis);
// mysqli_close($conexion);
	?>


<?php 
// mysqli_free_result($resultadoApostaPartits);
// mysqli_free_result($resultadoPartits);
// mysqli_free_result($resultadoApostaPartits);
// mysqli_free_result($resultadoPunts);
							
 ?>