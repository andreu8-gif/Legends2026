<?php 
    include ('inicio.php'); 

    $numjugador = 1;
    $resultadoPunts = mysqli_query($conexion, $cadenaPunts);
    $filaLider = mysqli_fetch_assoc($resultadoPunts);

    $cadenaPartits = "select partits.Fase, partits.Grup, partits.dtPartit,";
    $cadenaPartits.= "e1.vcnom as local, e1.vclogo as logolocal, e2.vcnom as visitant, e2.vclogo as logovisitant from partits "; 
    $cadenaPartits.= "inner join equips as e1 on partits.equip1 = e1.coEquip ";
    $cadenaPartits.= "inner join equips as e2 on partits.equip2 = e2.coEquip ";
    // $cadenaPartits.= "where DATE(dtPartit) >= DATE_ADD(curdate(), INTERVAL -4 YEAR) ";
    $cadenaPartits.= "where dtPartit >= now() ";
    $cadenaPartits.= "order by dtPartit asc ";
    $cadenaPartits.= "limit 10;";
    $resultadoPartits = mysqli_query($conexion, $cadenaPartits);
?>

      <!-- Modal -->
      <div class="modal fade" id="inicioModal" tabindex="-1" aria-labelledby="inicioevinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="inicioModalLabel">Bienvenido a Legends Club</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <span class="text-center fuente"><img src="/assets/img/legends_logo.png" width=150px style="float:left;"/></span>
              Ya formas parte del equipo. Si no has jugado nunca antes, te recomendaria que mires la ayuda.<br><br>
              Si ya eres leyenda, podrás descubrir que hay alguna novedad. <br><br>
              Para poder adaptar la visualización a los diferentes dispositivos, puedes comprobar que aparece o desaparece información en función del tamaño de la pantalla. 
              Si utilizas ordenador podras ver todo el contenido, si por el contrario utilizas móvil o tablet, verás una información más simplificada pero con la misma funcionalidad.<br><br>
              Te recomiendo que empieces pronosticando todos los partidos y los extras antes que empiece la Eurocopa.<br><br>
              Buena suerte!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>


    <div class="pagetitle">
      <!-- <h1>Dashboard</h1> -->
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="row grid g-3">

        <!-- Left side columns -->
        <div class="col-lg-9">
          <div class="row grid g-3">




            <!-- Gols -->
            <div class="col-xl-3 col-sm-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Goles <span>| Hasta hoy</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bullseye"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                            $cadenaGoles = "SELECT SUM(Resultat1+resultat2) as Goles, count(idPartit) as NumPartidos FROM partits WHERE Resultat1 is not null and Resultat2 is not null;";
                            $resultadoGoles = mysqli_query($conexion, $cadenaGoles);
                            $filaGoles = mysqli_fetch_assoc($resultadoGoles);
                            //mysqli_free_result($filaGoles);
                            //mysqli_free_result($resultadoGoles);
                      ?>
                      <h6><?php print $filaGoles['Goles']; ?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo $filaGoles['NumPartidos'] ?></span> <span class="text-muted small pt-2 ps-1">partidos</span>
                      <?php
                      //mysqli_free_result($filaGoles);
                       //     mysqli_free_result($resultadoGoles);
                      ?>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Gols -->

            <!--Premios -->
            <div class="col-xl-3 col-sm-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Premios <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-euro"></i>
                    </div>
                    <div class="ps-3">
                    <?php

                        function calcularpremio($totaljugadors, $porcentaje, $redondear = 2) 
                        {
                            return round($totaljugadors * 10 * ($porcentaje /100), $redondear);
                        }

                        $cadenaJugadors = "Select count(*) as NumJugadors FROM jugadors where Actiu=1";
                        $resultadoJugadors = mysqli_query($conexion, $cadenaJugadors);
                        $filaJugadors = mysqli_fetch_assoc($resultadoJugadors);

                        //mysqli_free_result($filaGoles);
                        //mysqli_free_result($resultadoGoles);

                        ?>
                      <h6><?php echo calcularpremio($filaJugadors['NumJugadors'],60, 2);?> €</h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo calcularpremio($filaJugadors['NumJugadors'],30, 2);?> € </span>
                      <span class="text-muted small pt-2 ps-1">y</span> 
                      <span class="text-success small pt-1 fw-bold"><?php echo calcularpremio($filaJugadors['NumJugadors'],10, 2);?> €</span> 

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Premios -->

            <!-- Jugadores -->
            <div class="col-xl-3 col-sm-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Jugadores</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $filaJugadors['NumJugadors'];?></h6>
                      <span class="text-muted small pt-2 ps-1">Sólo</span><span class="text-danger small pt-1 fw-bold"> 3</span><span class="text-muted small pt-2 ps-1">ganan</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- End Jugadores -->

            <!-- Lider -->
            <div class="col-xl-3 col-sm-6 ">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Lider <span>| De momento</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <img src="assets/avatar/<?php echo $filaLider["Avatar"]; ?>" alt="Profile" class="rounded-circle" style="max-width: 64px; width: 64px; height: 64px;max-height: 64px;">
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $filaLider['Puntuacio'];?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo $filaLider['Nickname'];?></span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- End Lider -->

            
            <!-- Clasificación resumida -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Clasificación <span>| Resumida</span></h5>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jugador</th>
                        <th scope="col">Puntos Partidos</th>
                        <th scope="col">Puntos Porcentaje</th>
                        <th scope="col">Puntos Extras</th>
                        <!-- <th scope="col">Extras</th> -->
                        <th scope="col">Puntuación Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //$coJugador = "2";
                      mysqli_data_seek($resultadoPunts,0);
                      while ($filaPunts = mysqli_fetch_assoc($resultadoPunts))			
                      {	
                        $backgroundColor=($filaPunts["coJugador"] == $coJugador) ? "bg-warning text-dark" : "";
                        ?>
                      <tr>
                        <th class="<?php echo $backgroundColor?>" scope="row"><a href="#"><?php echo $numjugador?></a></th>
                        <td class="<?php echo $backgroundColor?>"><?php echo $filaPunts["Nickname"]?></td>
                        <td class="text-center <?php echo $backgroundColor?>"><?php echo $filaPunts["PuntosP1"]+$filaPunts["PuntosP2"]+$filaPunts["PuntosP3"]+$filaPunts["PuntosP5"]+$filaPunts["PuntosP6"]+$filaPunts["PuntosP7"]?></td>
                        <td class="text-center <?php echo $backgroundColor?>"><?php echo $filaPunts["PuntosPorcentaje"]?></td>
                        <td class="text-center <?php echo $backgroundColor?>"><?php echo $filaPunts["PuntosPremis"]?></td>
                        <!-- <td class=" <?php echo $backgroundColor?>"><span class="badge bg-success">Activo</span></td> -->
                        <td class="text-center <?php echo $backgroundColor?>"><b><?php echo $filaPunts["Puntuacio"]?></b></td>
                      </tr>
                      <?php 
                          $numjugador++;
                      } ?>

                      <?php mysqli_free_result($resultadoPunts); ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            <!-- End Clasificación resumida -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-3">

          <!--Logo Alemania -->
          <div class="card">
            <div class="card-body">
              <img src="assets/img/logoeuro2024.jpg" class="w-100">
            </div>
          </div>
          <!-- End Logo Alemania -->

          <!--Proximos Partidos -->
          <div class="card mt-3">
            <div class="card-body">
              <h5 class="card-title">Próximos partidos <span>| Today</span></h5>

              <div class="activity">

              <?php 
              //$filaPartit = mysqli_fetch_assoc($resultadoPartits);
						    mysqli_data_seek($resultadoPartits, 0);
						    while ($filaPartit = mysqli_fetch_assoc($resultadoPartits))
						    {
							    if(!$resultadoPartits)
							    {
                  }
                  else
                  { ?>
                    <div class="activity-item d-flex">
                      <div class="activite-label"><?php echo date('d M Y H:i', strtotime($filaPartit["dtPartit"]));?></div>
                      <i class='bi bi-circle-fill activity-badge text-<?php echo getGroupColorText($filaPartit["Grup"])?> align-self-start'></i>
                      <div class="activity-content"><?php echo $filaPartit["local"];?> - <?php echo $filaPartit["visitant"];?></div>
                    </div><!-- End activity item-->
                    <?php
								    //print $conexion;
							    }
                }
              ?>
              </div>

            </div>
          </div>
          <!-- End Proximos Partidos -->

        </div><!-- End Right side columns -->

      </div>
    </section>

    <?php
      if ($primeracceso == null)
      {
        ?>
        <script>
          $(document).ready(function(){
          $("#inicioModal").modal('show');
          });
        </script>
        <?php

        $cadenaPrimerAcceso="UPDATE jugadors SET PrimerAcceso = now() WHERE coJugador = ".$coJugador;
		    $resultadoPrimerAcceso = mysqli_query($conexion, $cadenaPrimerAcceso);
        $sesion->set("primerAcceso", date_create('now'));
        //mysqli_free_result($resultadoPrimerAcceso);
    
      }
    ?>


<?php include ('fin.php'); ?>
