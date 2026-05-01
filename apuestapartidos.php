<?php include ('inicio.php'); ?>

<script>
function MostrarResultado() {
    if ($mostrarresultado = 1) {
        $mostrarresultado = 0;
    } else {
        $mostrarresultado = 0;
    }
    location.reload();
}
$(document).ready(function(e) {
    $("input.form-check-input").on('change.bootstrapSwitch', function(e) {

       if ($('#resultsFlexSwitchCheckChecked').is(':checked')) {
            $('.pronostico').hide();
            $('.resultado').show();
       }
       else {
            $('.pronostico').show();
            $('.resultado').hide();
       }

       if ($('#openedsFlexSwitchCheckChecked').is(':checked')) {
            $('.closed').hide();
        } else {
            $('.closed').show();
        }

        // if ($(this).is(':checked')) {
        //     $('.closed').hide();
        //     $('.pronostico').hide();
        //     $('.resultado').show();
        // } else {
        //     $('.closed').show();
        //     $('.pronostico').show();
        //     $('.resultado').hide();
        // }
    });
});
</script>
<style>
body {
    background-color: #f5f7fa;
}

.testimonial-card .card-up {
    height: 120px;
    overflow: hidden;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}

.aqua-gradient {
    background: linear-gradient(40deg, #2096ff, #05ffa3) !important;
}

.testimonial-card .avatar {
    width: 120px;
    margin-top: -60px;
    overflow: hidden;
    border: 5px solid #fff;
    border-radius: 50%;
}
</style>
<?php
	$fase = "1";
	//$coJugador = "1";

	$cadenaApostaPartits = "Select Apostes.coJugador, Apostes.IdPartit,  Apostes.dtPartit, Apostes.Resultat1, Apostes.Resultat2, Apostes.IdEncert, Apostes.resfinal,  ";
	$cadenaApostaPartits.= "ttencerts.Encert as resAposta, Apostes.local as local, Apostes.visitant as visitant, ttencerts.punts, CASE WHEN ttencerts.Punts is null THEN 'image4.png' ELSE ttencerts.Imatge END as copa,  ";
	$cadenaApostaPartits.= "Apostes.ResultatLocal, Apostes.ResultatVisitant, Apostes.nomlocal, Apostes.logolocal, Apostes.nomvisitant, Apostes.logovisitant, Apostes.idGrup, Apostes.Grup, POR.porcentajefinal, Apostes.fase, ";
	$cadenaApostaPartits.= "POR.Punts as PuntsPor, (ttencerts.punts + POR.Punts) as PuntsTotals ";
	$cadenaApostaPartits.= "FROM  ";
	$cadenaApostaPartits.= "(  ";
	$cadenaApostaPartits.= "	select A.coJugador, A.idPartit, A.Resultat1, A.Resultat2, P.dtPartit, P.Equip1 as local, P.Equip2 as visitant, P.Resultat1 as resfinal,  ";
	$cadenaApostaPartits.= "	CASE WHEN P.Resultat1 is null THEN 'X' ELSE P.Resultat1 END as ResultatLocal, ";
	$cadenaApostaPartits.= "	CASE WHEN P.Resultat2 is null THEN 'X' ELSE P.Resultat2 END as ResultatVisitant, ";
	$cadenaApostaPartits.= "	e1.vcnom as nomlocal, e1.vclogo as logolocal, e2.vcnom as nomvisitant, e2.vclogo as logovisitant, ";
	$cadenaApostaPartits.= "	CASE WHEN P.Resultat1 is null OR P.Resultat2 is null OR dtPartit > DATE_ADD(now(), INTERVAL 2 HOUR)  ";
	$cadenaApostaPartits.= "	THEN null  ";
	$cadenaApostaPartits.= "	ELSE  ";
	$cadenaApostaPartits.= "		CASE WHEN P.Resultat1= A.Resultat1 AND P.Resultat2= A.Resultat2   ";
	$cadenaApostaPartits.= "			THEN CASE WHEN P.Fase=1 THEN 1 ELSE  5 END   ";
	$cadenaApostaPartits.= "		ELSE	CASE WHEN (P.Resultat1= A.Resultat1 OR P.Resultat2= A.Resultat2) ";
	$cadenaApostaPartits.= "							AND  ";
	$cadenaApostaPartits.= "							((P.Resultat1 > P.Resultat2 AND A.Resultat1 > A.Resultat2) OR  ";
	$cadenaApostaPartits.= "							 (P.Resultat1 < P.Resultat2 AND A.Resultat1 < A.Resultat2) OR  ";
	$cadenaApostaPartits.= "							 (P.Resultat1 = P.Resultat2 AND A.Resultat1 =A.Resultat2))  ";
	$cadenaApostaPartits.= "				THEN CASE WHEN P.Fase=1 THEN 2 ELSE  6 END   ";
	$cadenaApostaPartits.= "				ELSE	CASE WHEN	(P.Resultat1 <> A.Resultat1) AND   ";
	$cadenaApostaPartits.= "									(P.Resultat2 <> A.Resultat2) AND  ";
	$cadenaApostaPartits.= "									((P.Resultat1 > P.Resultat2 AND A.Resultat1 > A.Resultat2) OR  ";
	$cadenaApostaPartits.= "									 (P.Resultat1 < P.Resultat2 AND A.Resultat1 < A.Resultat2) OR  ";
	$cadenaApostaPartits.= "									 (P.Resultat1 = P.Resultat2 AND A.Resultat1 = A.Resultat2))  ";
	$cadenaApostaPartits.= "						THEN CASE WHEN P.Fase=1 THEN 3 ELSE  7 END    ";
	$cadenaApostaPartits.= "						ELSE 4   ";
	$cadenaApostaPartits.= "						END    ";
	$cadenaApostaPartits.= "				END   ";
	$cadenaApostaPartits.= "		END   ";
	$cadenaApostaPartits.= "	END as idEncert,  ";
	$cadenaApostaPartits.= "	ttgrups.idGrup, ttgrups.Grup, P.fase  ";
	$cadenaApostaPartits.= "	from partits P  ";
	$cadenaApostaPartits.= " 	inner join equips as e1 on P.equip1 = e1.coEquip ";
	$cadenaApostaPartits.= " 	inner join equips as e2 on P.equip2 = e2.coEquip ";
	$cadenaApostaPartits.= " 	left outer join ttgrups on P.Grup = ttgrups.IdGrup ";
	$cadenaApostaPartits.= "	left outer JOIN apostapartits A on P.idpartit = A.idpartit "; 
	//$cadenaApostaPartits.= "	where P.fase=".$fase." AND A.coJugador=".$coJugador." ";
	$cadenaApostaPartits.= "	where A.coJugador=".$coJugador." ";
	$cadenaApostaPartits.= ") Apostes ";
	$cadenaApostaPartits.= "    LEFT OUTER JOIN ttencerts ON Apostes.idEncert = ttencerts.idEncert ";
	$cadenaApostaPartits.= "	LEFT OUTER JOIN vista_punts_x_porcentaje POR on Apostes.idPartit = POR.IdPartit AND Apostes.coJugador = POR.coJugador ";
	$cadenaApostaPartits.= " order by Apostes.dtPartit asc, Apostes.IdPartit"; 
	$resultadoApostaPartits = mysqli_query($conexion, $cadenaApostaPartits);
	
	$cadenaPorcentajes = "Select * from vista_porcentajes"; 
	$resultadoPorcentajes = mysqli_query($conexion, $cadenaPorcentajes);
?>
<!-- <style>
	.nav-item {
		background-color: #ced4da;
	}
</style> -->

<div class="pagetitle">
    <!-- <h1>Dashboard</h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php">Pronosticar</a></li>
            <li class="breadcrumb-item active">Partidos</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">


            <div class="card">
                <div class="card-body">
                    <div class="row  justify-content-between">
                        <div class="col-4">
                            <h5 class="card-title">Partidos</h5>
                        </div>
                        <div class="col-4  text-end">
                            <div class="row justify-content-center">
                                <div class="col-auto text-right">
                                    <label class="d-none d-md-block form-check-label text-primary fw-bold" style="color: #012970;" for="openedsFlexSwitchCheckChecked">Todos</label>
                                    <label class="d-md-none form-check-label text-primary fw-bold " for="openedsFlexSwitchCheckChecked"><i class="bi bi-key me-1"></i></label>
                                </div>
                                <div class="col-auto form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="openedsFlexSwitchCheckChecked" data-toggle="toggle">
                                </div>
                                <div class="col-auto text-left p-0 m-0">
                                    <label class="d-none d-md-block form-check-label text-success fw-bold" for="openedsFlexSwitchCheckChecked">Abiertos</label>
                                    <label class="d-md-none form-check-label text-success fw-bold" for="openedsFlexSwitchCheckChecked"><i class="bi bi-key-fill me-1"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-4  text-end">
                            <div class="row justify-content-center">
                                <div class="col-auto text-right">
                                    <label class="d-none d-md-block form-check-label text-primary fw-bold pe-3" style="color: #012970;" for="resultsFlexSwitchCheckChecked">Pronósticos</label>
                                    <label class="d-md-none form-check-label text-primary fw-bold pe-1" for="resultsFlexSwitchCheckChecked"><i class="bi bi-speedometer me-1"></i></label>
                                </div>
                                <div class="col-auto form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="resultsFlexSwitchCheckChecked" data-toggle="toggle">
                                </div>
                                <div class="col-auto text-left p-0 m-0">
                                <!-- /* onClick="MostrarResultado();"> -->
                                    <label class="d-none d-md-block form-check-label text-danger fw-bold" for="resultsFlexSwitchCheckChecked">Resultados</label>
                                    <label class="d-md-none form-check-label text-danger fw-bold" for="resultsFlexSwitchCheckChecked"><i class="bi bi-trophy-fill me-1"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pills Tabs -->
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#faseprevia" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Fase Previa</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#octavos" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Octavos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#cuartos" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Cuartos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#semifinales" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Semifinales</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#final" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Final</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="faseprevia" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row align-items-top grid g-3">
                                <?php
							$faseId = "1";
							include ('apuestapartidosfase.php');
							?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="octavos" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row align-items-top grid g-3">
                                <?php
							$faseId = "2";
							include ('apuestapartidosfase.php');
							?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cuartos" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row align-items-top grid g-3">
                                <?php
						$faseId = "3";
						include ('apuestapartidosfase.php');
						?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="semifinales" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row align-items-top grid g-3">
                                <?php
						$faseId = "4";
						include ('apuestapartidosfase.php');
						?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="final" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row align-items-top grid g-3">
                                <?php
						$faseId = "5";
						include ('apuestapartidosfase.php');
						?>
                            </div>
                        </div>
                    </div><!-- End Pills Tabs -->


                </div>
            </div>

        </div>

    </div>
</section>
<?php 
	mysqli_free_result($resultadoApostaPartits); 
	mysqli_free_result($resultadoPorcentajes); 

?>
<?php include ('fin.php'); ?>