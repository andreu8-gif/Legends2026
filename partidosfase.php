<?php
	//$fase = "1";
	$cadenaPartits = "select partits.Fase, partits.Grup, partits.dtPartit,";
	$cadenaPartits.= "CASE WHEN partits.Resultat1 is null THEN 'X' ELSE partits.Resultat1 END as ResultatLocal, ";
	$cadenaPartits.= "CASE WHEN partits.Resultat2 is null THEN 'X' ELSE partits.Resultat2 END as ResultatVisitant, ";
	$cadenaPartits.= "e1.vcnom as local, e1.coEquip as localabrev, e1.vclogo as logolocal, e2.vcnom as visitant, e2.coEquip as visitantabrev, e2.vclogo as logovisitant from partits "; 
	$cadenaPartits.= "inner join equips as e1 on partits.equip1 = e1.coEquip ";
	$cadenaPartits.= "inner join equips as e2 on partits.equip2 = e2.coEquip ";
	//$cadenaPartits.= "order by dtPartit asc, idPartit;";
	$cadenaPartits.= "where fase ".$faseId." and grup ".$grupId." order by dtPartit asc, idPartit;";
	$resultadoPartits = mysqli_query($conexion, $cadenaPartits);
	$cadenaPunts ="SELECT * FROM vista_clasificacion order by Puntuacio desc";
	$numjugador = 1;
	$resultadoPunts = mysqli_query($conexion, $cadenaPunts);
					
	if (!$resultadoPartits) {
			die("Database selection failed: " . mysqli_error($conexion));
	}
	else
	{ 
		$mensaje='<div class="container">';
		$mensaje.='	<div  class="">';
		// CABECERA
		$mensaje.='		<div class="card-group mt-1 text-nowrap">';
		$mensaje .= '		<div class="card text-center border-info bg-header text-white"><div class="card-body fuente d-flex  align-items-center mx-auto">'.$grupName.'</div></div>' . "\r\n";
		mysqli_data_seek($resultadoPartits, 0);
		mysqli_data_seek($resultadoPunts, 0);
		while ($filaPartits = mysqli_fetch_assoc($resultadoPartits))
		{
			$dtFechaPartit = new DateTime($filaPartits["dtPartit"]);
			$dtFormatoFecha=  $dtFechaPartit ->format('d/m/Y');
			$mensaje .= '';
			$mensaje.='		<div class="card text-center border-info bg-header text-white">';
			$mensaje.='			<div class="card-body cell  px-2 py-2">';
			$mensaje .= '			<div class="row fuente normal h-100 mh-100  text-nowrap" id="cappremi">' . "\r\n";
			$mensaje .= '				<div class="order-1 order-sm-1 col col-sm-3"><img alt="e1" src="/assets/flags/'.$filaPartits['logolocal'].'" width="20" height="20"></div>' . "\r\n";
			$mensaje .= '				<div class="order-2 order-sm-2 col-3 col-sm-6"><span class="d-xs-block d-sm-none d-md-block">'.$filaPartits['local'].'</span><span class="d-none d-sm-block d-md-none">'.$filaPartits['localabrev'].'</span></div>' . "\r\n";
			$mensaje .= '				<div class="order-3 order-sm-3 col col-sm-3">'.$filaPartits['ResultatLocal'].'</div>' . "\r\n";
			$mensaje .= '				<div class="order-4 order-sm-8 col-auto d-block d-sm-none">-</div>' . "\r\n";
			$mensaje .= '				<div class="order-7 order-sm-4 col col-sm-3"><img alt="e2" src="/assets/flags/'.$filaPartits['logovisitant'].'"  width="20" height="20"></div>' . "\r\n";
			$mensaje .= '				<div class="order-6 order-sm-5 col-3 col-sm-6"><span class="d-xs-block d-sm-none d-md-block">'.$filaPartits['visitant'].'</span><span class="d-none d-sm-block d-md-none">'.$filaPartits['visitantabrev'].'</span></div>' . "\r\n";
			$mensaje .= '				<div class="order-5 order-sm-6 col col-sm-3">'.$filaPartits['ResultatVisitant'].'</div>' . "\r\n";
			$mensaje .= '				<div class="order-8 order-sm-7 col-12 col-sm-12 d-none d-lg-block font-weight-normal"><i class="bi bi-clock pe-2">&nbsp;'.date('d/m/Y', strtotime($filaPartits['dtPartit'])).'</i></div>' . "\r\n";
			$mensaje .= '			</div>' . "\r\n";
			$mensaje .= '		</div>' . "\r\n";
			$mensaje .= '	</div>' . "\r\n";
		}
		$mensaje .= '	</div>';

		// DATOS
		$mensaje.='<div style="height: 620px !important; overflow: scroll;">';
		$numjugador = 1;
		while ($filaPunts = mysqli_fetch_assoc($resultadoPunts))
		{
			$cadenaApostaPartits = "Select Apostes.coJugador,  Apostes.dtPartit, Apostes.idPartit, Apostes.Resultat1, Apostes.Resultat2, Apostes.IdEncert, Apostes.resfinal, ";
			$cadenaApostaPartits.= "ttencerts.Encert as resAposta, Apostes.local, Apostes.vcNomLocal, Apostes.visitant, Apostes.vcNomVisitant, ttencerts.punts, ";
			$cadenaApostaPartits.= "CASE WHEN ttencerts.Punts is null THEN 'image4.png' ELSE ttencerts.Imatge END as copa,  ";
			$cadenaApostaPartits.= "vista_punts_x_porcentaje.Punts as PuntsPorcentaje ";
			$cadenaApostaPartits.= "FROM  ";
			$cadenaApostaPartits.= "(  ";
			$cadenaApostaPartits.= "	select A.coJugador, A.idPartit, A.Resultat1, A.Resultat2, P.dtPartit, P.Equip1 as local, e1.vcNom as vcNomLocal, P.Equip2 as visitant, e2.vcNom as vcNomVisitant, P.Resultat1 as resfinal, ";
			$cadenaApostaPartits.= "	CASE WHEN P.Resultat1 is null OR P.Resultat2 is null OR dtPartit > DATE_ADD(now(), INTERVAL 2 HOUR) "; //curdate()
			$cadenaApostaPartits.= "	THEN null  ";
			$cadenaApostaPartits.= "	ELSE  ";
			$cadenaApostaPartits.= "		CASE WHEN P.Resultat1= A.Resultat1 AND P.Resultat2= A.Resultat2   ";
			$cadenaApostaPartits.= "			THEN CASE WHEN P.Fase=1 THEN 1 ELSE  5 END   ";
			$cadenaApostaPartits.= "		ELSE	CASE WHEN (P.Resultat1= A.Resultat1 OR P.Resultat2= A.Resultat2)  ";
			$cadenaApostaPartits.= "							AND  ";
			$cadenaApostaPartits.= "							((P.Resultat1 >P.Resultat2 AND A.Resultat1 >A.Resultat2) OR  ";
			$cadenaApostaPartits.= "							 (P.Resultat1 <P.Resultat2 AND A.Resultat1 <A.Resultat2) OR  ";
			$cadenaApostaPartits.= "							 (P.Resultat1 =P.Resultat2 AND A.Resultat1 =A.Resultat2))  ";
			$cadenaApostaPartits.= "				THEN CASE WHEN P.Fase=1 THEN 2 ELSE  6 END   ";
			$cadenaApostaPartits.= "				ELSE	CASE WHEN	(P.Resultat1<> A.Resultat1) AND   ";
			$cadenaApostaPartits.= "									(P.Resultat2<> A.Resultat2) AND  ";
			$cadenaApostaPartits.= "									((P.Resultat1 >P.Resultat2 AND A.Resultat1 >A.Resultat2) OR  ";
			$cadenaApostaPartits.= "									 (P.Resultat1 <P.Resultat2 AND A.Resultat1 <A.Resultat2) OR  ";
			$cadenaApostaPartits.= "									 (P.Resultat1 =P.Resultat2 AND A.Resultat1 =A.Resultat2))  ";
			$cadenaApostaPartits.= "						THEN CASE WHEN P.Fase=1 THEN 3 ELSE  7 END    ";
			$cadenaApostaPartits.= "						ELSE 4   ";
			$cadenaApostaPartits.= "						END    ";
			$cadenaApostaPartits.= "				END   ";
			$cadenaApostaPartits.= "		END   ";
			$cadenaApostaPartits.= "	END as idEncert  ";
			$cadenaApostaPartits.= "	from partits P  ";
			$cadenaApostaPartits.= " 	inner join equips as e1 on P.equip1 = e1.coEquip ";
			$cadenaApostaPartits.= " 	inner join equips as e2 on P.equip2 = e2.coEquip ";			
			$cadenaApostaPartits.= "	left outer JOIN apostapartits A on P.idpartit = A.idpartit "; 
			$cadenaApostaPartits.= "	where P.fase ".$faseId." AND P.grup ".$grupId." AND A.coJugador=".$filaPunts['coJugador']." ";
			$cadenaApostaPartits.= ") Apostes ";
			$cadenaApostaPartits.= "LEFT OUTER JOIN ttencerts ON Apostes.idEncert = ttencerts.idEncert ";
			$cadenaApostaPartits.= "LEFT OUTER JOIN vista_punts_x_porcentaje ON Apostes.coJugador = vista_punts_x_porcentaje.coJugador And Apostes.IdPartit = vista_punts_x_porcentaje.IdPartit ";
			$cadenaApostaPartits.= "ORDER BY Apostes.dtPartit asc , Apostes.idPartit ";

			$resultadoApostaPartits = mysqli_query($conexion, $cadenaApostaPartits);
		
			
			$mensaje.='		<div class="card-group mt-1">';
			$mensaje .= '		<div class="card text-center border-info">';
			$mensaje .= '			<div class="card-body cell">';
			$g = ($filaPunts["coJugador"] == $coJugador) ? 'bg-cojugador' : (($numjugador%2 == 1) ? 'bg-alter' : '');
			// $g = ($filaPunts["coJugador"] == $coJugador) ? 'bg-cojugador' : '';
			$mensaje .= '				<div class="row capjugador mx-0 my-0 '.$g.'">';
			$mensaje .= '					<div class="col-12 align-middle fuente ms-2 mt-2 text-left">'.$numjugador.' - '.$filaPunts["Nickname"].'</div>' . "\r\n";
			$mensaje .= '					<div class="col-12 align-middle fuente me-2 mb-2 text-right">'.$filaPunts["Puntuacio"].'</div>' . "\r\n";
			$mensaje .= '  				</div>' . "\r\n";
			$mensaje .= '  			</div>' . "\r\n";
			$mensaje .= '  		</div>' . "\r\n";
			
			
			while ($filaApostaPartits = mysqli_fetch_assoc($resultadoApostaPartits))
			{
				$dtFechaPartit = new DateTime($filaApostaPartits["dtPartit"]);
				$dtFormatoFecha=  $dtFechaPartit ->format('d/m/Y');
				
				$mensaje .= '	<div class="card text-center border-info">';
				$mensaje .= '		<div class="card-body cell">';
				$f = ($filaApostaPartits["coJugador"] == $coJugador) ? 'bg-cojugador' : (($numjugador%2 == 1) ? 'bg-alter' : '');
				//$f = ($filaApostaPartits["coJugador"] == $coJugador) ? 'bg-cojugador' : '';
				$mensaje .= '			<div class="row align-items-center justify-content-between mx-0 my-0 h-100 fuente '.$f.'">';
				if ($filaApostaPartits["resfinal"] == null ||
					compararFechas ($dtFormatoFecha,$fecha_actual) >0) 
				{
					$mensaje .= '					<div class="col-7"><img id="image" alt="copa" class="balon" src="assets/img/BAL.png"></div>' . "\r\n";										
				}
				else
				{
					$puntscolor=getPointsColor($filaApostaPartits['idEncert']);
					$puntsporcentajecolor=getPointsPorcentajeColor($filaApostaPartits['PuntsPorcentaje']);
					$mensaje .= '					<div class="col-3 d-none d-md-block vertical-align"><img id="image" alt="copa" class="copa" src="assets/img/'.$filaApostaPartits["copa"].'"></div>' . "\r\n";																						
					$mensaje .= '					<div class="col-2 text-center">' . "\r\n";																													
					$mensaje .= '							<div class="circulo c-'.$puntscolor.' text-center"><span class="circulo c-'.$puntscolor.'">'.$filaApostaPartits['punts'].'</span></div>' . "\r\n";
					$mensaje .= '					</div>' . "\r\n";
					$mensaje .= '					<div class="col-2 text-center"> ' . "\r\n";
					if ($filaApostaPartits['PuntsPorcentaje'] > 0){
						$mensaje .= '					<div class="circulo-s c-'.$puntsporcentajecolor.' text-center"><span class="circulo-s c-'.$puntsporcentajecolor.'">+'.$filaApostaPartits['PuntsPorcentaje'].'</span></div>' . "\r\n";
					}
					$mensaje .= '					</div>' . "\r\n";						
				}
				$mensaje .= '						<div class="col-5 align-self-center d-flex justify-content-end">' . "\r\n";
				$mensaje .= '							<div class="row fuente normal mb-3 pe-3  text-nowrap">' . "\r\n";								
				if ($filaApostaPartits["Resultat1"] != "")	
					$mensaje .= '							<div class="col-8 p-0"><span class="d-none d-sm-block">'.$filaApostaPartits["local"].'</span><span class="d-xs-block d-sm-none">'.$filaApostaPartits["vcNomLocal"].'</span></div>' . "\r\n";
				else
					$mensaje .= '							<div class="col-8 p-0"></div>' . "\r\n";
				if ($filaApostaPartits["coJugador"] != $coJugador && 
					$filaApostaPartits["Resultat1"] != "" && 
					compararFechas ($dtFormatoFecha,$fecha_actual) >0) 
					$mensaje .= '							<div class="col-4 p-0">X</div>' . "\r\n";
				else
					$mensaje .= '							<div class="col-4 p-0">'.$filaApostaPartits["Resultat1"].'</div>' . "\r\n";

				if ($filaApostaPartits["Resultat2"] != "")	
					$mensaje .= '							<div class="col-8 p-0"><span class="d-none d-sm-block">'.$filaApostaPartits["visitant"].'</span><span class="d-xs-block d-sm-none">'.$filaApostaPartits["vcNomVisitant"].'</span></div>' . "\r\n";
				else
					$mensaje .= '							<div class="col-8 p-0"></div>' . "\r\n";
				if ($filaApostaPartits["coJugador"] != $coJugador && 
					$filaApostaPartits["Resultat2"] != "" && 
					compararFechas ($dtFormatoFecha,$fecha_actual) >0) 
					$mensaje .= '							<div class="col-4 p-0">X</div>' . "\r\n";
				else
					$mensaje .= '							<div class="col-4 p-0">'.$filaApostaPartits["Resultat2"].'</div>' . "\r\n";
				$mensaje .= '							</div>' . "\r\n";							
				$mensaje .= '						</div>' . "\r\n";							
				$mensaje .= '					</div>' . "\r\n";							
				$mensaje .= '				</div>' . "\r\n";							
				
				$mensaje .= '</div>' . "\r\n";
			}
			$mensaje .= '	</div>';
			$numjugador++;
		}
		$mensaje .= '</div>';	
		$mensaje .= '</div>';	
		$mensaje .= '</div>';	
				
						
		echo $mensaje;
		/*  -------------------------PARTITS ------------------------------------------*/ 
	}
?>