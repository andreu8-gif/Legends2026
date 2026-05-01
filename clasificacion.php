<?php include ('inicio.php'); ?>

<style>
.b-profile {
    /* padding-bottom: 5px; */
    color: #ffffff;
    /* margin-bottom:5px; */
}

.b-profile-name {
    font-size: 20px;
    line-height: 24px;
    text-align: center;
}

.b-profile-avatar {
    /* display: block; */
    width: 32px;
    height: 32px;
    margin-right: 14px;
    /* margin: 2px auto; */
    border-radius: 50%;
}
</style>

<div class="pagetitle">
    <!-- <h1>Clasificación</h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Clasificación</li>
            <li class="breadcrumb-item active">General</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<?php

			//$coJugador = 1;


			/* Ejecutamos la consulta para recuperar los registros */
			/*  -------------------------JUGADORS ------------------------------------------*/  
			
			
			//$cadenaPunts ="SELECT * FROM vista_clasificacion order by Puntuacio desc";
			$numjugador = 1;
			$resultadoPunts = mysqli_query($conexion, $cadenaPunts);
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title pb-4">Clasificación General</h5>
                    <?php

                    // $tabla='<div class="container">';
                    // $tabla.='	<div  class="">';

                    $tabla='		<div class="card-group">';
                    $tabla.='		  <div class="card text-center border-info bg-header text-white">';
                    $tabla.='			  <div class="card-body cell  row fuente big d-flex align-items-center h-100 text-nowrap">';
                    $tabla .= '				    <div class="col">#</div>' . "\r\n";
                    $tabla .= '				    <div class="col-3 col-md-2 text-left"><span class="d-none d-md-block">JUGADORES</span><span class="d-md-none"><i class="bi bi-person-square me-1"></i></span></div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 col-md-3  d-none d-sm-block">' . "\r\n";
                    $tabla .= '				      <div class="row">' . "\r\n";
                    $tabla .= '				        <div class="col-12"><span class="d-none d-md-block">FASE DE GRUPOS</span><span class="d-none d-sm-block d-md-none">F.G.</span></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><img src="/assets/img/image3.png" height=30 width=30></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><span class="circulo c-warning">5</span></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><img src="/assets/img/image2.png" height=30 width=30></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><span class="circulo c-info">8</span></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><img src="/assets/img/image1.png" height=30 width=30></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><span class="circulo c-success">12</span></div>' . "\r\n";
                    $tabla .= '				      </div>' . "\r\n";
                    $tabla .= '				    </div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 col-md-3 d-none d-sm-block">' . "\r\n";
                    $tabla .= '				      <div class="row">' . "\r\n";
                    $tabla .= '				        <div class="col-12"><span class="d-none d-md-block">FASE FINAL</span><span class="d-md-none">F.F.</span></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><img src="/assets/img/image3.png" height=30 width=30></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><span class="circulo c-warning">7</span></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><img src="/assets/img/image2.png" height=30 width=30></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><span class="circulo c-info">10</span></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><img src="/assets/img/image1.png" height=30 width=30></div>' . "\r\n";
                    $tabla .= '				        <div class="col-2 d-none d-md-block"><span class="circulo c-success">16</span></div>' . "\r\n";
                    $tabla .= '				      </div>' . "\r\n";
                    $tabla .= '				    </div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 d-block d-sm-none"><span class="">PAR.</span></div>' . "\r\n";                    
                    $tabla .= '				    <div class="col-2 col-sm col-md"><span class="d-none d-md-block">PORCENTAJES</span><span class="d-md-none"><i class="bi bi-reception-4 me-1"></i></span></div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 col-sm col-md"><span class="d-none d-md-block">EXTRAS</span><span class="d-md-none"><i class="bi bi-trophy-fill me-1"></i></span></div>' . "\r\n";
                    $tabla .= '				    <div class="col-2 col-sm-2 col-md"><span class="d-none d-md-block">TOTAL</span><span class="d-md-none"><i class="bi bi-controller me-1"></i></span></div>' . "\r\n";            
                    $tabla .= '		    </div>' . "\r\n";
                    $tabla .= '	    </div>' . "\r\n";
                    $tabla .= '	</div>';

                    // $tabla.='  </div>';
                    // $tabla.='</div>';

                    if(!$resultadoPunts)
                    {
                      print $conexion -> ErrorMsg( );
                    }
                    else
                    {
                      $maximo = 0;
                      $tabla.='<div style="height: 600px !important; overflow: scroll;">';
                      /*  -------------------------PREMIS ------------------------------------------*/ 
                      while ($filaPunts = mysqli_fetch_assoc($resultadoPunts))			
                      {	
                        if ($maximo == 0) $maximo = $filaPunts["Puntuacio"];
                        if ($filaPunts["Puntuacio"] == 0)
                            $porcentaje = 0;
                        else
                            $porcentaje = round((( $filaPunts["Puntuacio"] / $maximo ) * 100),2);
                        $tabla.='		<div class="card-group">';
                        $g = ($filaPunts["coJugador"] == $coJugador) ? 'bg-cojugador' : (($numjugador%2 == 1) ? 'bg-alter' : '');
                        $tabla .= '		<div class="card text-center border-info '.$g.'">';
                        $tabla .= '			<div class="card-body cell">';
                        $tabla .= '				<div class="row fuente '.$g.' text-nowrap">';
                        $tabla .= '					<div class="col">'.$numjugador.'</div>' . "\r\n";
                        $tabla .= '					<div class="col-3 col-md-2 d-flex text-wrap align-middle"><span style="margin-top: -8px;"><img src="assets/avatar/'.$filaPunts["Avatar"].'" alt="image" class="b-profile-avatar"></span><span class="d-none d-sm-block text-left fuente normal">'.$filaPunts["Nickname"].'</span></div>' . "\r\n";
                        $tabla .= '					<div class="col-2 col-md-3 d-none d-sm-block">';
                        $tabla .= '                     <div class="row">' . "\r\n"; 
                        $tabla .= '                           <div class="col-2 d-none d-md-block fuente normal text-success">'.$filaPunts["P3"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block">'.$filaPunts["PuntosP3"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block fuente normal text-success">'.$filaPunts["P2"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block">'.$filaPunts["PuntosP2"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block fuente normal text-success">'.$filaPunts["P1"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block">'.$filaPunts["PuntosP1"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-12 d-md-none">'.$filaPunts["PuntosP1"] + $filaPunts["PuntosP2"] + $filaPunts["PuntosP3"].'</div>' . "\r\n";
                        $tabla .= '                     </div>' . "\r\n";
                        $tabla .= '                 </div>' . "\r\n";
                        $tabla .= '					<div class="col-2 col-md-3 d-none d-sm-block">';
                        $tabla .= '                     <div class="row">' . "\r\n"; 
                        $tabla .= '                           <div class="col-2 d-none d-md-block fuente normal text-success">'.$filaPunts["P7"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block">'.$filaPunts["PuntosP7"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block fuente normal text-success">'.$filaPunts["P6"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block">'.$filaPunts["PuntosP6"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block fuente normal text-success">'.$filaPunts["P5"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-2 d-none d-md-block">'.$filaPunts["PuntosP5"].'</div>' . "\r\n";
                        $tabla .= '                           <div class="col-12 d-md-none">'.$filaPunts["PuntosP5"] + $filaPunts["PuntosP6"] + $filaPunts["PuntosP7"].'</div>' . "\r\n";                
                        $tabla .= '                     </div>' . "\r\n";
                        $tabla .= '                 </div>' . "\r\n";
                        $tabla .= '                 <div class="col-2 d-block d-sm-none">'.$filaPunts["PuntosP1"] + $filaPunts["PuntosP2"] + $filaPunts["PuntosP3"]+$filaPunts["PuntosP5"] + $filaPunts["PuntosP6"] + $filaPunts["PuntosP7"].'</div>' . "\r\n";                        
                        $tabla .= '                 <div class="col-2 col-sm">'.$filaPunts["PuntosPorcentaje"].'</div>' . "\r\n";
                        $tabla .= '                 <div class="col-2 col-sm">'.$filaPunts["PuntosPremis"].'</div>' . "\r\n";
                        $tabla .= '					<div class="col-2 col-sm-2 col-md text-success">'.$filaPunts["Puntuacio"].'</div>' . "\r\n";                
                        $tabla .= '  			</div>' . "\r\n";
                        $tabla .= '  		</div>' . "\r\n";
                        $tabla .= '  	</div>' . "\r\n";
                        $tabla .='  </div>';  
                        $numjugador++;
                      }
                      $tabla.='</div>';  
                            
                      mysqli_free_result($resultadoPunts);
                    }	 
                    // $tabla.='</div>';  
                    // $tabla.='</div>';  
                    echo $tabla;
                    mysqli_close($conexion);
                  ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include ('fin.php'); ?>