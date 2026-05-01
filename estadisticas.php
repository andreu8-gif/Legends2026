<?php include ('inicio.php'); ?>

<div class="pagetitle">
    <!-- <h1>Clasificación</h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Estadísticas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<?php
	$resultadoEstadistiques = mysqli_query($conexion, $cadenaEstadistiques);
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title pb-4">Estadísticas Selecciones</h5>
                    <?php

                    $tabla='		<div class="card-group">';
                    $tabla.='		  <div class="card text-center border-info bg-header text-white">';
                    $tabla.='			  <div class="card-body cell row fuente big d-flex align-items-center h-100 text-nowrap">';
                    $tabla .= '				    <div class="col-3 text-left text-nowrap"><span class="d-none d-md-block">SELECCIÓN</span><span class="d-md-none"><i class="bi bi-globe2 me-1"></i></span></div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 text-center"><span class="d-none d-md-block">Jugados</span><span class="d-md-none">J</span></div>' . "\r\n";
                    $tabla .= '				    <div class="col text-center"><span class="d-none d-md-block">Victorias</span><span class="d-md-none">V</span></div>' . "\r\n";
                    $tabla .= '				    <div class="col text-center"><span class="d-none d-md-block">Empates</span><span class="d-md-none">E</span></div>' . "\r\n";
                    $tabla .= '				    <div class="col text-center"><span class="d-none d-md-block">Derrotas</span><span class="d-md-none">D</span></div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 text-center"><span class="d-none d-md-block">Goles a Favor</span><span class="d-md-none">G.F.</span></div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 text-center"><span class="d-none d-md-block">Goles en Contra</span><span class="d-md-none">G.C.</span></div>' . "\r\n";
                    $tabla .= '		    </div>' . "\r\n";
                    $tabla .= '	    </div>' . "\r\n";
                    $tabla .= '	</div>';

                    if(!$resultadoEstadistiques)
                    {
                      print $conexion -> ErrorMsg( );
                    }
                    else
                    {
                      $maximo = 0;
                      $tabla.='<div style="height: 600px !important; overflow: scroll;">';
                      /*  -------------------------PREMIS ------------------------------------------*/ 
                      while ($filaEstadistiques = mysqli_fetch_assoc($resultadoEstadistiques))			
                      {	
                        $tabla.='		<div class="card-group">';
                        $tabla .= '		<div class="card text-center border-info">';
                        $tabla .= '			<div class="card-body cell">';
                        $tabla .= '				<div class=" row fuente big d-flex align-items-center text-nowrap">';
                        $tabla .= '					<div class="col-3 text-left text-nowrap d-flex"><span class="me-2"><img src="/assets/flags/'.$filaEstadistiques['logo'].'" width="20" height="20"></span><span class="d-none d-sm-block text-left fuente normal">'.$filaEstadistiques["vcNom"].'</span><span class="d-block d-sm-none text-left fuente normal">'.$filaEstadistiques["coEquip"].'</span></div>' . "\r\n";
                        $tabla .= '					<div class="col-2 text-center">'.$filaEstadistiques["PartidosJugados"].'</div>' . "\r\n";
                        $tabla .= '					<div class="col text-center">'.$filaEstadistiques["Victoria"].'</div>' . "\r\n";
                        $tabla .= '					<div class="col text-center">'.$filaEstadistiques["Empate"].'</div>' . "\r\n";
                        $tabla .= '					<div class="col text-center">'.$filaEstadistiques["Derrota"].'</div>' . "\r\n";
                        $tabla .= '					<div class="col-2 text-center text-success">'.$filaEstadistiques["GolesFavor"].'</div>' . "\r\n";
                        $tabla .= '					<div class="col-2 text-wrap text-center text-danger">'.$filaEstadistiques["GolesContra"].'</div>' . "\r\n";
                        $tabla .= '  			</div>' . "\r\n";
                        $tabla .= '  		</div>' . "\r\n";
                        $tabla .= '  	</div>' . "\r\n";
                        $tabla .='  </div>';  
                        // $numjugador++;
                      }
                      $tabla.='</div>';  
                            
                      mysqli_free_result($resultadoEstadistiques);
                    }	 
                    echo $tabla;
                    mysqli_close($conexion);
                  ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include ('fin.php'); ?>