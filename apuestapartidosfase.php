	<?php 
	mysqli_data_seek($resultadoApostaPartits, 0);
	while ($filaApostaPartits = mysqli_fetch_assoc($resultadoApostaPartits))
	{
		if(!$resultadoApostaPartits || $filaApostaPartits['fase'] <> $faseId)
		{
			//print $conexion;
		}
		else
		{ 
	

			$mostrarresultado=1;
			$puntscolor=getPointsColor($filaApostaPartits['idEncert']);
			$headercolor=getGroupColor($filaApostaPartits['idGrup']);
			$dtFechaPartit = new DateTime($filaApostaPartits["dtPartit"]);
			$dtFormatoFecha=  $dtFechaPartit ->format('d/m/Y');
			$grupo = '&nbsp;';
			if ($filaApostaPartits['Grup'] != null) {
				$grupo = 'Grupo ';
			}
			// if ($mostrarresultado = 1) {
			// 	$resultado1 = $filaApostaPartits['Resultat1'];
			// }else{
			// 	$resultado1 = $filaApostaPartits['ResultatLocal'];
			// }
				
			$status = compararFechas ($dtFormatoFecha,$fecha_actual) >0 ? "opened" : "closed";
			$mensaje='<div class="col-lg-3 col-md-6 '.$status.'">';
			$mensaje.='  <!-- Default Card -->';
			$mensaje.='  <div class="card">';
			$mensaje.='		<div class="card-header '.$headercolor.'">'.$grupo.$filaApostaPartits['Grup'].'</div>';
			$mensaje.='		<div class="card-body mt-2">';
			$mensaje.='			<div class="widget-49">';
			$mensaje.='				<div class="widget-49-title-wrapper">';
			$mensaje.='					<div class="widget-49-date-'.$puntscolor.'">';
			$puntaje = $filaApostaPartits['PuntsTotals'] == null ? "-" : $filaApostaPartits['PuntsTotals'];
			$mensaje.='						<span class="widget-49-date-day">'.$puntaje.'</span>';
			// if ($filaApostaPartits['PuntsTotals'] == null)
			// {
			// 	$mensaje.='						<span class="widget-49-date-day">-</span>';
			// } else {
			// 	$mensaje.='						<span class="widget-49-date-day">'.$filaApostaPartits['PuntsTotals'].'</span>';
			// }
			$mensaje.='					</div>';																
			$mensaje.='					<div class="widget-49-meeting-info pr-10">';
			$mensaje.='						<span class="widget-49-pro-title">'.date('d M Y', strtotime($filaApostaPartits['dtPartit'])).'</span>';
			$mensaje.='						<span class="widget-49-meeting-time"><i class="bi bi-clock pe-2"></i>'.date('H:i', strtotime($filaApostaPartits['dtPartit'])).'</span>';
			$mensaje.='					</div>';
			$mensaje.='				</div>';
			$mensaje.='				<div class="container pt-3 px-0 align-items-between">';
			$mensaje.='					<div class="row g-0 justify-content-center text-center  align-items-between">';
			$mensaje.='					  	<div class="col-4 ">';
			$mensaje.='							<img src="assets/flags/'.$filaApostaPartits['logolocal'].'" class="img-thumbnail rounded float-middle"  style="border: 0" width="40" height="20" alt="...">';
			$mensaje.='					  	</div>';
			$mensaje.='					  	<div class="col-1 ">';
			$mensaje.='							<p class="card-title pronostico" id="res_1_'.$filaApostaPartits['idPartit'].'">'.$filaApostaPartits['Resultat1'].'</p>';
			$mensaje.='							<p class="card-title resultado"  style="display:none;  ">'.$filaApostaPartits['ResultatLocal'].'</p>';
			$mensaje.='					  	</div>';
			$mensaje.='					  	<div class="col-2">';
			$mensaje.='							<p class="card-title">-</p>';
			$mensaje.='					  	</div>';
			$mensaje.='					  	<div class="col-1 ">';
			$mensaje.='							<p class="card-title pronostico" id="res_2_'.$filaApostaPartits['idPartit'].'">'.$filaApostaPartits['Resultat2'].'</p>';
			$mensaje.='							<p class="card-title resultado"  style="display:none; ">'.$filaApostaPartits['ResultatVisitant'].'</p>';
			$mensaje.='					  	</div>';
			$mensaje.='					  	<div class="col-4 ">';
			$mensaje.='							<img src="assets/flags/'.$filaApostaPartits['logovisitant'].'" class="img-thumbnail rounded float-middle" style="border: 0" width="40" height="20"  alt="...">';
			$mensaje.='					  	</div>';
			$mensaje.='					  	<div class="col-6">';
			$mensaje.='						    <h5 class="card-title">'.$filaApostaPartits['nomlocal'].'</h5>';
			$mensaje.='					  	</div>';
			$mensaje.='					  	<div class="col-6">';
			$mensaje.='						  <h5 class="card-title">'.$filaApostaPartits['nomvisitant'].'</h5>';								
			$mensaje.='					  	</div>';			
			if (compararFechas ($dtFormatoFecha,$fecha_actual) <=0)
			{
				$mensaje.='						<div class="col-12 percentatge pb-0 text-left">Un <b>'.round($filaApostaPartits['porcentajefinal'],1).'%</b> piensa como tu</div>';								
			}
			$mensaje.='					</div>';
			$mensaje.='				</div>';
			if (compararFechas ($dtFormatoFecha,$fecha_actual) <=0)
			{
				$mensaje.='				<div class="progress" style="height: 8px;">';
				$mensaje.='					<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: '.$filaApostaPartits['porcentajefinal'].'%" aria-valuenow="'.$filaApostaPartits['porcentajefinal'].'" aria-valuemin="0" aria-valuemax="100"></div>';
				$mensaje.='				</div>';
			}
			else
			{
				$mensaje.='				<div style="height: 28px;">&nbsp;</div>';
			}
			$mensaje.='			</div>';
			$mensaje.='		</div>';
			$mensaje.='		<div class="card-footer container">';
			$mensaje.='			<div class="row justify-content-between">';
			if (compararFechas ($dtFormatoFecha,$fecha_actual) >0)
			{
				$mensaje.='				<div class="col-6"><span class="badge rounded-pill bg-success p-2"><i class="bi bi-check-circle me-1"></i>Abierto</span></div>';
				$mensaje.='				<div class="col-6 text-end"><a href="" data-bs-toggle="modal" data-bs-target="#partit'.$filaApostaPartits['idPartit'].'" onclick="MostrarAposta('.$filaApostaPartits['idPartit'].','.$coJugador.');"><span class="badge rounded-pill bg-primary text-white  p-2"><i class="bi bi-vinyl me-1"></i>Pronosticar</span></a></div>';
			}
			else
			{
				$mensaje.='				<div class="col-6"><span class="badge rounded-pill bg-danger p-2"><i class="bi bi-exclamation-octagon me-1"></i>Cerrado</span></div>';
				// $mensaje.='				<div class="col-4">';
				// $mensaje.='					<div class="row justify-content-end">';
				// $mensaje.='						<div class="col-auto"><label class=" text-primary fw-bold pe-1" for="flexSwitchCheckChecked'.$filaApostaPartits['idPartit'].'"><i class="bi bi-speedometer me-1"></i></label></div>';
				// $mensaje.='						<div class="col-auto form-check form-switch"> <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked'.$filaApostaPartits['idPartit'].'" data-toggle="toggle"> </div>';
				// $mensaje.='						<div class="col-auto"><label class="text-danger fw-bold" for="flexSwitchCheckChecked'.$filaApostaPartits['idPartit'].'"><i class="bi bi-trophy-fill me-1"></i></label></div>';
				// $mensaje.='					</div>';
				// $mensaje.='				</div>';
				$mensaje.='				<div class="col-6 text-end"><a href="" data-bs-toggle="modal" data-bs-target="#pronosticpartit'.$filaApostaPartits['idPartit'].'"><span class="badge rounded-pill bg-warning text-dark  p-2"><i class="bi bi-reception-4 me-1"></i>Porcentajes</span></a></div>';
			}
			$mensaje.='			</div>';
			$mensaje.='		</div>';


			// MODEL APOSTAR
			$mensaje.='		<div class="modal fade" id="partit'.$filaApostaPartits['idPartit'].'" tabindex="-1">';
			$mensaje.='			<div class="modal-dialog modal-dialog-centered  justify-content-center d-flex">';
			$mensaje.='			  <div class="modal-content" style="width: 280px;">';
			$mensaje.='				<div class="modal-header bgGroupF">';
			$mensaje.='				  <h6 class="modal-title">'.date('d M Y', strtotime($filaApostaPartits['dtPartit'])).' - '.date('H:i', strtotime($filaApostaPartits['dtPartit']));
			$mensaje.='				 </h6>';			
			$mensaje.='				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$mensaje.='				</div>';
			$mensaje.='				<div class="modal-body" style="background:url('."/assets/img/campo.jpg".'); width: 280px; height:436px;">';
			$mensaje.='					<div style="text-align: center;" id="logolocal_'.$filaApostaPartits['idPartit'].'"></div> ';
			$mensaje.='					<div style="text-align: center;"><h3 class="text-warning"><b id="local_'.$filaApostaPartits['idPartit'].'"></b></h3></div> ';
			$mensaje.='					<div style="text-align: center;"><img src="../assets/flags/'.$filaApostaPartits['logolocal'].'" class=" rounded float-middle"style="border: 0" width="80" height="70"></div> ';
			$mensaje.='					<div style="text-align: center;">';
			$mensaje.='										<span class="custom-dropdown">';
            $mensaje.='					                    <select class="" ';
            $mensaje.='					                        aria-label="" id="resultat1_'.$filaApostaPartits['idPartit'].'">';// name="resultat1_'.$filaApostaPartits['idPartit'].'">';
            $mensaje.='					                        <option value="0" selected>0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option>';
			$mensaje.='											<option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option>';
			$mensaje.='											<option value="8">8</option><option value="9">9</option><option value="10">10</option>';
            $mensaje.='					                    </select>';
			$mensaje.='										</span>';
			$mensaje.='					</div> ';
			$mensaje.='					<div style="text-align: center; ">&nbsp;</div> ';
			$mensaje.='					<div style="text-align: center;"></div> ';
			$mensaje.='					<div style="text-align: center;">';
			$mensaje.='										<span class="custom-dropdown">';
            $mensaje.='					                    <select class="" ';
            $mensaje.='					                        aria-label="" id="resultat2_'.$filaApostaPartits['idPartit'].'">';// name="resultat2_'.$filaApostaPartits['idPartit'].'">';
            $mensaje.='					                        <option value="0" selected>0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option>';
			$mensaje.='											<option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option>';
			$mensaje.='											<option value="8">8</option><option value="9">9</option><option value="10">10</option>';
            $mensaje.='					                    </select>';
			$mensaje.='										</span>';			
			$mensaje.='					</div> ';
			$mensaje.='					<div style="text-align: center;"><img src="../assets/flags/'.$filaApostaPartits['logovisitant'].'" class=" rounded float-middle"style="border: 0" width="80" height="70"></div> ';
			$mensaje.='					<div style="text-align: center;"><h3 class="text-warning"><b id="visitant_'.$filaApostaPartits['idPartit'].'"></b></h3></div> ';
			$mensaje.='					<div style="width: 266px;"> ';
			$mensaje.='					<div style="text-align: center;" id="logovisitant_'.$filaApostaPartits['idPartit'].'"></div> ';
			$mensaje.='					<label><br></label></div> ';							
			$mensaje.='				</div>';
			$mensaje.='				<div class="modal-footer justify-content-between">';
			$mensaje.='				  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>';
			$mensaje.='				  <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="GuardarAposta($(\'#resultat1_'.$filaApostaPartits['idPartit'].'\').val(), $(\'#resultat2_'.$filaApostaPartits['idPartit'].'\').val(), '.$filaApostaPartits['idPartit'].', '.$coJugador.');return false;">Guardar</button>';
			$mensaje.='				</div>';
			$mensaje.='			  </div>';
			$mensaje.='			</div>';
			$mensaje.='		</div><!-- End Vertically centered Modal-->';
			
			// MODAL PRONOSTICOS
			$mensaje.='		<div class="modal fade" id="pronosticpartit'.$filaApostaPartits['idPartit'].'" tabindex="-1">';
			$mensaje.='			<div class="modal-dialog modal-dialog-centered">';
			$mensaje.='			  <div class="modal-content">';
			$mensaje.='				<div class="modal-header bgGroupF">';
			$mensaje.='				  <h6 class="modal-title">';
			$mensaje.='						<img src="assets/flags/'.$filaApostaPartits['logolocal'].'" class=" rounded float-middle"  style="border: 0" width="30" height="30">';
			$mensaje.='						'.$filaApostaPartits['nomlocal'].' vs ';
			$mensaje.='						'.$filaApostaPartits['nomvisitant'].'';
			$mensaje.='						<img src="assets/flags/'.$filaApostaPartits['logovisitant'].'" class=" rounded float-middle"  style="border: 0" width="30" height="30" >';								
			$mensaje.='				 </h6>';	
			$mensaje.='				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
			$mensaje.='				</div>';
			$mensaje.='				<div class="modal-body">';

			$mensaje.='					<div class="row justify-content-end mx-1 px-1 fuente-md">';
			$mensaje.='						<div class="col-5" ></div>';
			$mensaje.='						<div class="col-2 text-center  border-light" >Nº</div>';
			$mensaje.='						<div class="col-3 text-center border-light" >Porcen.</div>';
			$mensaje.='						<div class="col-2 text-center border-light" >Ptos</div>';
			if (compararFechas ($dtFormatoFecha,$fecha_actual) <= 0)
			{
				mysqli_data_seek($resultadoPorcentajes, 0);
				while ($filaPorcentajes = mysqli_fetch_assoc($resultadoPorcentajes))
				{
					if ($filaPorcentajes['idpartit'] == $filaApostaPartits['idPartit'])
					{
						$mensaje.='			<div class="col-5  border-light " >'.$filaPorcentajes['Desc'].'</div>';
						$mensaje.='			<div class="col-2  text-center fw-bold text-success border-light " >'.$filaPorcentajes['numero'].'</div>';
						$mensaje.='			<div class="col-3  text-center fw-bold text-success border-light " >'.round($filaPorcentajes['porcen'],2).'%</div>';
						$mensaje.='			<div class="col-2  text-center fw-bold border-light " >'.$filaPorcentajes['puntos'].'</div>';
					}
				}
			}									
			$mensaje.='			  		</div>';
			$mensaje.='			  	</div>';
			$mensaje.='				<div class="modal-footer">';
			$mensaje.='				  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>';
			$mensaje.='				</div>';
			$mensaje.='			  </div>';
			$mensaje.='			</div>';
			$mensaje.='		</div>';
			$mensaje.='  </div><!-- End Default Card -->';
			$mensaje.='</div>';
			print $mensaje;
		}
	}

	?>