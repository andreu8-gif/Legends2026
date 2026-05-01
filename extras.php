<?php include ('inicio.php'); ?>

<style>
.card-body {
    /* padding: 0px;  !important */
}

.cell {
    padding: 0px;
     !important font-size: smaller;
     !important
}
</style>
<?php
	$fase = "1";
	//$coJugador = "117";
	

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
	$cadenaPremis.="where P.Actiu= true  order by P.ordre asc ";
	$resultadoPremis = mysqli_query($conexion, $cadenaPremis);
	
	//$cadenaPunts ="SELECT * FROM vista_clasificacion";
	$numjugador = 1;
	$resultadoPunts = mysqli_query($conexion, $cadenaPunts);


?>

<div class="pagetitle">
    <!-- <h1>Dashboard</h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php">Clasificación</a></li>
            <li class="breadcrumb-item active">Extras</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<section class="section">
    <div class="row">
        <div class="col-lg-12">


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Extras</h5>

                    <!-- Pills Tabs -->
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#fasedegruposAC" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Fase de Grupos (A-C)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#fasedegruposDF" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="false">Fase de Grupos (D-F)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#resto"
                                type="button" role="tab" aria-controls="pills-home" aria-selected="false">Resto</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="fasedegruposAC" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row align-items-top">
                                <?php 
								$faseId = "1";
								$grupId = "in (1,2,3)";
								include ('extrasfase.php');
								?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="fasedegruposDF" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row align-items-top">
                                <?php 
								$faseId = "1";
								$grupId = " in (4,5,6)";
								include ('extrasfase.php');
								?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="resto" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row align-items-top">
                                <?php 
								$faseId = "2";
								$grupId = "is null";
								include ('extrasfase.php');
								?>
                            </div>
                        </div>
                    </div>

                    <?php

			/*  -------------------------PREMIS ------------------------------------------*/ 
			// mysqli_free_result($resultadoPremis);
			// mysqli_close($conexion);
			  ?>


                </div>
            </div>

        </div>


    </div>
</section>
<?php 
// mysqli_free_result($resultadoApostaPartits);
// mysqli_free_result($resultadoPartits);
// mysqli_free_result($resultadoApostaPartits);
// mysqli_free_result($resultadoPunts);
				
mysqli_free_result($resultadoPremis);
			mysqli_close($conexion);
 ?>
<?php include ('fin.php'); ?>