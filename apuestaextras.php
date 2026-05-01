<?php include ('inicio.php'); ?>

<style>
/* .avatar !important {
    width: 2rem;
    height: 2rem;
    line-height: 2rem;
    border-radius: 50%;
    display: inline-block;
    background: #ced4da no-repeat center/cover;
    position: relative;
    text-align: center;
    color: #868e96;
    font-weight: 600;
    vertical-align: bottom
}

.avatar.avatar-lg {
    width: 2rem;
    height: 2rem
} */


.testimonial-card .card-up {
  height: 120px;
  overflow: hidden;
  border-top-left-radius: .50rem;
  border-top-right-radius: .50rem;
  text-align: center;
  color: #fff;
}

.aqua-gradient {
  background-color: #5782c4;
  /* background: linear-gradient(40deg, #2096ff, #05ffa3) !important; */
}

.testimonial-card .avatar {
  width: 120px;
  margin-top: -60px;
  /* overflow: hidden; */
  /* border: 5px solid #fff; */
  /* border-radius: 50%; */
}
.bigFlag !important {
	background: #fff;
}

.points {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    /* background-color: #cc4c4c; */
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
	overflow: visible;
}

</style>
<?php

	//$coJugador = "1";
	// $cadenaApostaPremis ="SELECT A.coJugador, A.idPremi, A.idEquip, E.coEquip, ";
	// $cadenaApostaPremis .="CASE WHEN PE.IdEquip is null OR P.dtPremi > curdate() ";
	// $cadenaApostaPremis .="THEN null ";
	// $cadenaApostaPremis .="ELSE  ";
	// $cadenaApostaPremis .="			CASE WHEN PE.IdEquip Is NOT NULL AND PE.idEquip = A.idEquip ";
	// $cadenaApostaPremis .="			THEN 1 ";
	// $cadenaApostaPremis .="			ELSE 0 ";
	// $cadenaApostaPremis .="			END ";
	// $cadenaApostaPremis .="END isPremi, ";
	// $cadenaApostaPremis .="CASE WHEN PE.idEquip is null OR P.dtPremi > curdate() ";
	// $cadenaApostaPremis .="THEN null ";
	// $cadenaApostaPremis .="ELSE  ";
	// $cadenaApostaPremis .="			CASE WHEN PE.IdEquip Is NOT NULL AND PE.idEquip = A.idEquip ";
	// $cadenaApostaPremis .="			THEN P.Puntuacio ";
	// $cadenaApostaPremis .="			ELSE 0 ";
	// $cadenaApostaPremis .="			END ";
	// $cadenaApostaPremis .="END as Punts, ";
	// $cadenaApostaPremis .="E.vcNom, E.vcLogo, P.dtPremi, E2.vcLogo logoEQ, E2.vcNom NomEQ, E2.IdEquip as IdEQ, ";
	// $cadenaApostaPremis .="P.Nom, P.Puntuacio, P.idFase, P.idGrup,  TOTAL.quants as Quants  ";
	// $cadenaApostaPremis .="FROM premis P  ";
	// $cadenaApostaPremis .="LEFT OUTER JOIN apostapremis A ON P.IdPremi = A.IdPremi ";
	// $cadenaApostaPremis .="LEFT OUTER JOIN equips E ON A.idequip = E.idequip  ";
	// $cadenaApostaPremis .="LEFT OUTER JOIN premisequips PE ON P.idPremi = PE.idPremi  "; //" AND A.IdEquip = PE.idEquip ";
	// $cadenaApostaPremis .="LEFT OUTER JOIN equips E2 ON PE.idequip = E2.idequip  ";
	// $cadenaApostaPremis .="LEFT OUTER JOIN (select idPremi, count(*) as quants from premisequips group by idPremi) as TOTAL on P.idPremi = TOTAL.idPremi ";
	// $cadenaApostaPremis .="INNER JOIN jugadors JJ on A.coJugador = JJ.coJugador ";					
	// $cadenaApostaPremis .="WHERE  A.coJugador=".$coJugador." ";
	// $cadenaApostaPremis .="AND JJ.Actiu=1 ";		
	// $cadenaApostaPremis .="AND P.Actiu=1 ";	
	// $cadenaApostaPremis .="ORDER BY P.Ordre, isPremi ASC ";	
	$cadenaApostaPremis = "select * from vista_apostapremis WHERE  coJugador=".$coJugador;
	$resultadoApostaPremis = mysqli_query($conexion, $cadenaApostaPremis);


	// $cadenaPremis="select P.* ,E2.coEquip, E2.vcNom, E2.vcLogo, TOTAL.quants as Quants ";
	// $cadenaPremis.="from premis P  ";
	// $cadenaPremis.="LEFT OUTER JOIN premisequips PE ON P.idPremi = PE.idPremi ";
	// $cadenaPremis.="LEFT OUTER JOIN equips E2 		ON PE.idequip = E2.idequip  ";
	// $cadenaPremis.="LEFT OUTER JOIN (select idPremi, count(*) as quants from premisequips group by idPremi) as TOTAL on P.idPremi = TOTAL.idPremi ";
	// $cadenaPremis.="where P.Actiu= true  order by P.ordre asc ";
	// $resultadoPremis = mysqli_query($conexion, $cadenaPremis);

	// $filaPremis = mysqli_fetch_all($resultadoPremis);
	//while($filaPremis.)
	//{
		//print $filaPremis(0 => array['Quants'];
//	}
?>

	<div class="pagetitle">
      <!-- <h1>Dashboard</h1> -->
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php">Pronosticar</a></li>
          <li class="breadcrumb-item active">Extras</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Pronosticar Extras</h5>
				  
						<input class="resultat" name="coJugador" type="hidden" maxlength="2" size="50px" value="'.$coJugador.'" id="coJugador">
						<input class="resultat" name="idPremi" type="hidden" maxlength="2" size="50px" value="'.$idpremi.'" id="idPremi">
						<input class="resultat" name="nomLogo" type="hidden" maxlength="2" size="50px" value="" id="nomLogo">
						<input class="resultat" name="coEquip" type="hidden" maxlength="2" size="50px" value="" id="coEquip">
				  
						<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
						<div class="container" style="max-width: 1500px; !important">
							<div class="row align-items-top justify-content-between">
								<?php
								
								$diferents = false;
								$QuantsAux = 1;
								
								while ($filaApostaPremis = mysqli_fetch_assoc($resultadoApostaPremis))
								{ 
									if ($filaApostaPremis['Quants'] > 1 && $filaApostaPremis['Quants'] != $QuantsAux)
									{
										$QuantsAux = $QuantsAux +1;
										$diferents = true;
									}
									else
									{
										$diferents = false;
										$QuantsAux = 1;
									}
									if ($diferents == false)
									{
										if ($filaApostaPremis['idGrup'] == null) 
											$grup=0; 
										else 
											$grup=$filaApostaPremis['idGrup']; 
										$dtFechaPremi = new DateTime($filaApostaPremis["dtPremi"]);
										$dtFormatoFecha=  $dtFechaPremi ->format('d/m/Y');
										
										$mensaje='<div class="col-sm-6 col-md-3">';

										// $mensaje='<div class="container">';
										$mensaje.='<section class="mx-auto my-2" style="max-width: 25rem;">';
										$mensaje.='		<div class="card testimonial-card mt-2 mb-3">';
										$mensaje.='			<div class="card-up aqua-gradient pt-4">'.$filaApostaPremis['Nom'].'</div>';
										// $mensaje.='			<div class="avatar mx-auto " style="background: none;">';
										// $mensaje.='					<div class="widget-49-date-'.$puntscolor.'">';
										// 	$mensaje.='						<span class="widget-49-date-day">5</span>';
										// $mensaje.='					</div>';
										
										// $mensaje.='			</div>';
										$mensaje.='			<div class="avatar mx-auto " style="background: none;" id="ban_'.$filaApostaPremis['idPremi'].'">';
										// $mensaje.='	  			<!-- <img src="assets/img/bigFlags/'.$filaApostaPremis['coEquip'].'.svg" class="rounded-circle img-fluid"           alt="woman avatar">-->';
																$i = ($filaApostaPremis['coEquip'] != null) ? $filaApostaPremis['coEquip'] : 'EUR';
										$mensaje.='	  			<img src="../assets/bigFlags/'.$i.'.png" class="rounded-circle img-fluid" >';
										$mensaje.='			</div>';
										
										$paddingExtra = 'pt-4';
										if ($filaApostaPremis['Punts'] != null)
										{
											$puntscolor = $filaApostaPremis['Punts'] == null || $filaApostaPremis['Punts'] == 0  ? "bg-danger" : 'bg-success';
											$mensaje.='					<div class="" style="margin-top: -60px; padding-top: 20px; padding-left: 20px;">';
											$puntaje = $filaApostaPremis['Punts'] == null ? "-" : $filaApostaPremis['Punts'];
											$mensaje.='						<span class="points text-light '.$puntscolor.'">'.$puntaje.'</span>';
											$mensaje.='					</div>';
											$paddingExtra = 'pt-0';
										}
										$mensaje.='			<div class="card-body text-center '.$paddingExtra.'" id="eq_'.$filaApostaPremis['idPremi'].'">';
																$r = ($filaApostaPremis['idEquip'] != null) ? $filaApostaPremis['vcNom'] : '&nbsp;';
										$mensaje.='	  			<h4 class="card-title font-weight-bold">'.$r.'</h4>';

										$dtFechaPremi = new DateTime($filaApostaPremis["dtPremi"]);
										$dtFormatoFecha=  $dtFechaPremi ->format('d/m/Y');
										if (compararFechas ($dtFormatoFecha,$fecha_actual) >0)
										{
											$mensaje.='				<div class="col-md-12"><span class="badge rounded-pill bg-success"><i class="bi bi-check-circle me-1"></i>Abierto</span></div>';
										}
										else
										{
											$mensaje.='				<div class="col-md-12"><span class="badge rounded-pill bg-danger text-right"><i class="bi bi-exclamation-octagon me-1"></i>Cerrado</span></div>';
										}

										$mensaje.='	  			<hr>';
										$mensaje.='	  			<div class="row">';
										$mensaje.='	  				<div class="col-6">';
										$mensaje.='	  					<h5 class="card-title"><span><i class="bi bi-clock px-2">&nbsp;Fecha límite:</i> <b>'.$dtFormatoFecha.'</b></h5></span>';
										$mensaje.='	  				</div>';
										$mensaje.='	  				<div class="col-6">';
										$mensaje.='	  					<h5 class="card-title"><span><i class="bi bi-trophy-fill px-2">&nbsp;Premio:</i><br> <b>'.$filaApostaPremis['Puntuacio'].' puntos</b></h5></span>';
										$mensaje.='	  				</div>';
										$mensaje.='	  			</div>';
										$mensaje.='	  			<hr>';
										// $mensaje.='	  			<h5 class="card-title"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci</h5></span>';

										$mensaje.='				<div class="row justify-content-evenl">';
										// 			$p = ($filaApostaPremis["isPremi"] != null) ? $filaApostaPremis['Punts'].' de '.$filaApostaPremis['Puntuacio'] : '&nbsp;';
										// $mensaje.='					<div class="col-md-12"><h5 class="card-title"><span>'.$p.' puntos</span>';
										
										
										
										if (compararFechas ($dtFormatoFecha, $fecha_actual) <= 0)
										{
											$cadenaPremis="select P.* ,E2.coEquip, E2.vcNom, E2.vcLogo, TOTAL.quants as Quants ";
											$cadenaPremis.="from premis P  ";
											$cadenaPremis.="LEFT OUTER JOIN premisequips PE ON P.idPremi = PE.idPremi ";
											$cadenaPremis.="LEFT OUTER JOIN equips E2 		ON PE.idequip = E2.idequip  ";
											$cadenaPremis.="LEFT OUTER JOIN (select idPremi, count(*) as quants from premisequips group by idPremi) as TOTAL on P.idPremi = TOTAL.idPremi ";
											$cadenaPremis.="where P.Actiu= true  AND P.idPremi=". $filaApostaPremis['idPremi']." order by P.ordre asc ";

											$resultadoPremis = mysqli_query($conexion, $cadenaPremis);

											mysqli_data_seek($resultadoPremis, 0);
											while ($filaPremis = mysqli_fetch_assoc($resultadoPremis))
											{
												if ($filaPremis['vcLogo'] != null){
													$mensaje.='					<div class="col"><h5 class="card-title"><span>';
													$mensaje.= '	<img src="../assets/flags/'.$filaPremis['vcLogo'].'" class="img-thumbnail rounded float-middle"style="border: 0" width="30" height="15">'.$filaPremis['vcNom'].' ';
													// if ($filaPremis['idpartit'] == $filaApostaPartits['idPartit'])
													// {
													// 	$mensaje.= $filaPorcentajes['Desc'].'&nbsp;-'.$filaPorcentajes['numero'].' apuestas&nbsp;-'.$filaPorcentajes['puntos'].'puntos<br>';
													// }
													$mensaje.='					</span></div>';
												}
											}
										}			
										$mensaje.='				<div/>';
										$mensaje.='				<div class="row">';


										//$mensaje.='</h5></div>';
										
										// $dtFechaPremi = new DateTime($filaApostaPremis["dtPremi"]);
										// $dtFormatoFecha=  $dtFechaPremi ->format('d/m/Y');
										if (compararFechas ($dtFormatoFecha,$fecha_actual) >0)
										{
											//$mensaje.='				<div class="col-md-6"><span class="badge rounded-pill bg-success"><i class="bi bi-check-circle me-1"></i>Abierto</span></div>';
											$mensaje.='             <div class="col-md-12"><button type="button" class="badge rounded-pill bg-primary p-2" data-bs-toggle="modal" data-bs-target="#extra'.$filaApostaPremis['idPremi'].'" onclick="MostrarEquip('.$grup.','.$filaApostaPremis['idFase'].','.$filaApostaPremis['idPremi'].');"><i class="bi bi-play-circle me-1"></i>Pronosticar</button></div>';
										}
										// else
										// {
										// 	$mensaje.='				<div class="col-md-12"><span class="badge rounded-pill bg-danger text-right"><i class="bi bi-exclamation-octagon me-1"></i>Cerrado</span></div>';
										// }

										$mensaje.='				</div>';

										$mensaje.='			</div>';
										$mensaje.='  	</div>';
										$mensaje.='</section>';
										// $mensaje.='</div>';
										//print $mensaje;
										

































										
										// if ($filaApostaPremis["isPremi"] == null)
										// 	$color='bg-primary';
										// else
										// 	if ($filaApostaPremis["isPremi"] == 1)
										// 		$color='bg-success';
										// 	else
										// 		$color='bg-danger';
										// $mensaje.='	<div class="card '.$color.' text-white mb-4 mini-profile-widget bootdey.com">';
										// $mensaje.='		<div class="col-md-12">';
										// $mensaje.='			<div class="image-container">';
										// $mensaje.='				<img src="assets/img/flags/'.$filaApostaPremis['coEquip'].'.svg" class="avatar img-responsive" alt="avatar">';
										// $mensaje.='			</div>  ';
										// $mensaje.='		</div>';
										// $mensaje.='		<div class="col-md-12"> ';
										// $mensaje.='			<div class="details">';
										// $mensaje.='				<h5 class="card-title">'.$filaApostaPremis['Nom'].'<br></h5>';
										// $mensaje.='				<h4 class="card-title">'.$dtFormatoFecha.'</h4>';
										// // $mensaje.='				<hr> ';
										// $mensaje.='				<div class="row"> ';
										// if ($filaApostaPremis['IdEQ'] == null)
										// 	$mensaje.='					<div class="col-md-12">&nbsp;</div>';
										// else
										// 	$mensaje.='					<div class="col-md-12"><h5 class="card-title"><span>'.$filaApostaPremis['vcNom'].'</span></h5></div>';
										
										// if ($filaApostaPremis["isPremi"] == null)
										// 	$mensaje.='					<div class="col-md-12">&nbsp;</div>';
										// else
										// 	$mensaje.='					<div class="col-md-12"><h5 class="card-title"><span>'.$filaApostaPremis['Punts'].' de '.$filaApostaPremis['Puntuacio'].' puntos</span></h5></div>';
										
										// $dtFechaPremi = new DateTime($filaApostaPremis["dtPremi"]);
										// $dtFormatoFecha=  $dtFechaPremi ->format('d/m/Y');
										// if (compararFechas ($dtFormatoFecha,$fecha_actual) >0)
										// {
										// 	$mensaje.='				    <div class="col-md-6"><span class="badge rounded-pill bg-success"><i class="bi bi-check-circle me-1"></i>Abierto</span></div>';
										// 	$mensaje.='                 <div class="col-md-6"><button type="button" class="badge rounded-pill bg-primary" data-bs-toggle="modal" data-bs-target="#extra'.$filaApostaPremis['idPremi'].'" onclick="MostrarEquip('.$grup.','.$filaApostaPremis['idFase'].','.$filaApostaPremis['idPremi'].');"><i class="bi bi-play-circle me-1"></i>Apostar</button></div>';
										// }
										// else
										// {
										// 	$mensaje.='					<div class="col-md-6"><span class="badge rounded-pill bg-danger text-right"><i class="bi bi-exclamation-octagon me-1"></i>Cerrado</span></div>';
										// 	$mensaje.='					<div class="col-md-6"><span class="badge rounded-pill bg-warning text-dark"><i class="bi bi-reception-4 me-1"></i>Porcentajes</span></div>';
										// }
										// $mensaje.='				</div>';
										// $mensaje.='			</div>';
										// $mensaje.='		</div>';
										// $mensaje.='	</div>';
										
										
										$mensaje.='<div class="modal" id="extra'.$filaApostaPremis['idPremi'].'" tabindex="-1">';
										$mensaje.='	<div class="modal-dialog modal-dialog-centered">';
										$mensaje.='	  <div class="modal-content">';
										$mensaje.='		<div class="modal-header bgGroupF">';
										$mensaje.='		  <h5 class="modal-title">'.$filaApostaPremis['Nom'].'</h5>';
										$mensaje.='		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
										$mensaje.='		</div>';
										$mensaje.='		<div class="modal-body">';
										$mensaje.='				<div class="row mb-3">';
										$mensaje.='				  <label class="col-sm-3 col-form-label ">Selección</label>';
										$mensaje.='				  <div class="col-sm-9">';
										$mensaje.='					<select class="form-select" name="equips'.$filaApostaPremis['idPremi'].'" id="equips'.$filaApostaPremis['idPremi'].'" aria-label="Default select example" onChange="MostrarBandera(this.value,'.$filaApostaPremis['idPremi'].')" style="font-size: 18px;"></select>';
										$mensaje.='					<input class="resultat" name="coJugador'.$filaApostaPremis['idPremi'].'" type="hidden" maxlength="2" size="50px" value="117" id="coJugador'.$filaApostaPremis['idPremi'].'">';
										$mensaje.='					<input class="resultat" name="idPremi'.$filaApostaPremis['idPremi'].'" type="hidden" maxlength="2" size="50px" value="5" id="idPremi'.$filaApostaPremis['idPremi'].'">';
										$mensaje.='					<input class="resultat" name="nomLogo'.$filaApostaPremis['idPremi'].'" type="hidden" maxlength="2" size="50px" value="" id="nomLogo'.$filaApostaPremis['idPremi'].'">';
										$mensaje.='					<input class="resultat" name="coEquip'.$filaApostaPremis['idPremi'].'" type="hidden" maxlength="2" size="50px" value="" id="coEquip'.$filaApostaPremis['idPremi'].'">';
										$mensaje.='						<div style="text-align: center;" id="logo"></div> ';
										$mensaje.='				  </div>';
										$mensaje.='				</div>';
										$mensaje.='		</div>';
										$mensaje.='		<div class="modal-footer justify-content-between">';
										$mensaje.='		  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>';
										$mensaje.='		  <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="GuardarPremi($(\'#equips'.$filaApostaPremis['idPremi'].'\').val(),
										'.$filaApostaPremis['idPremi'].', '.$coJugador.');Reload();return false;" >Guardar</button>';
										$mensaje.='		</div>';
										$mensaje.='	  </div>';
										$mensaje.='	</div>';
										$mensaje.='</div>';
										
										
										$mensaje.='</div>';
										print $mensaje;
									}
								}
								mysqli_free_result($resultadoApostaPremis);
								//unset($resultadoApostaPartits,$conexion);
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>

  <?php include ('fin.php'); ?>
