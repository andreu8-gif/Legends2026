<?php include ('inicio.php'); ?>
<?php
$cadenaJugadors = "Select count(*) as NumJugadors FROM jugadors where Actiu=1";
$resultadoJugadors = mysqli_query($conexion, $cadenaJugadors);
$filaJugadors = mysqli_fetch_assoc($resultadoJugadors);

function calcularpremio($totaljugadors, $porcentaje, $redondear = 2) 
{
    return round($totaljugadors * 10 * ($porcentaje /100), $redondear);
}
?>

<div class="pagetitle">
    <!-- <h1>Dashboard</h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Como se juega?</li>
        </ol>
    </nav>
</div>

<section class="section profile">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cómo se juega?</h5>
                        <div id="slides" class="pt-3">
                            <div class="slides_container_reglament">
                                <div id="reglament">
                                    <div class="accordion" id="accordionFaqs">
                                        <!-- Como pronosticar -->
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0 align-text-bottom d-flex">
                                                    <button class="btn " type="button" data-toggle="collapse"
                                                        data-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        <!-- <i class="bi bi-exclamation-octagon me-1"></i> -->
                                                        <i class="bi bi-info-circle-fill me-1"></i>
                                                        <!-- <i class="material-icons md-24">list</i> -->
                                                        <!-- <span class="material-symbols-outlined size-24">question_exchange</span> -->
                                                        <strong>¿Cómo pronosticar?</strong>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#accordionFaqs">
                                                <div class="card-body">
                                                    <p id="reglament">Hay dos maneras de ganar puntos en el <b>Legends
                                                            Club</b>:
                                                    <ul>
                                                        <li><b>Acertando el resultado de los partidos:</b> Antes de cada
                                                            partido de la Eurocopa, se puede pronosticar el resultado
                                                            del mismo en el menú de <a
                                                                href="apuestapartidos.php"><b>Pronosticar
                                                                    Partidos</b></a>,
                                                            seleccionado el partido y poniendo el resultado. Se pueden
                                                            pronosticar hasta las 23:59 del dia anterior a la fecha del
                                                            partido y cambiar el pronóstico tantas veces como se quiera
                                                            hasta que el partido no este cerrado teniendo en cuenta la
                                                            fecha límite de cada partido. Es recomendable apostar a
                                                            todos los partidos antes que empiece la eurocopa
                                                            y cambiarlos a posteriori. Más abajo te explicamos como se
                                                            puntua en función del resultado que se haya pronosticado.
                                                            </p>
                                                        </li>
                                                        <li><b>Consiguiendo puntos extra definiendo el papel de las
                                                                selecciones en la Eurocopa:</b> Podemos conseguir puntos
                                                            extra acertando por ejemplo que selecciones acabaran primera
                                                            o segunda de su grupo,
                                                            que selección ganará, que selección marcará más goles o cual
                                                            será la que marcará el gol número 50, entre otras opciones.
                                                            Cada tipo de apuesta tendrá un valor de puntos diferente.
                                                            Para ello,
                                                            simplemente se tiene que asignar a cada extra la selección
                                                            nacional que creáis en el menú de <a
                                                                href="apuestaextras.php"><b>Pronosticar Extras</b></a>.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Ver pronosticos -->
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn  collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        <i class="bi bi-person-workspace me-1"></i>
                                                        <strong>¿Puedo ver los pronósticos de los otros
                                                            jugadores?</strong>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordionFaqs">
                                                <div class="card-body">
                                                    <p id="reglament">No, las apuestas de los otros jugadores estarán
                                                        ocultos hasta el dia anterior al partido o hasta la fecha
                                                        indicada en el caso de los puntos extras.
                                                        Una vez esten cerrados los partidos, se mostrarán todos los
                                                        pronósticos del resto de jugadores, ya que en ese momento no se
                                                        podrán cambiar.<br>
                                                        Cada dia se enviará un e-mail antes que empiecen los partidos de
                                                        esa jornada con un resumen de los pronósticos y otro al final de
                                                        la jornada con la puntuación.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Puntos -->
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h5 class="mb-0">
                                                    <button class="btn  collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        <i class="bi bi-123 me-1"></i>
                                                        <strong>¿Como se puntua en función del resultado de los
                                                            partidos?</strong>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                data-parent="#accordionFaqs">
                                                <div class="card-body">
                                                    <p>La puntuación varia según el nivel de acierto del partido:</p>
                                                    <ul style="margin-left: 20px;">
                                                        <li type="disc">
                                                            <img style="width: 30px; height: 30px;" title="" alt=""
                                                                src="assets/img/image1.png"><strong
                                                                style="font-size: 18px;">12</strong> puntos (fase de
                                                            grupos)
                                                            &oacute; <strong style="font-size: 18px;">16</strong> puntos
                                                            (fase
                                                            final): Si se acierta el resultado del partido
                                                        </li>
                                                        <br>
                                                        <li type="disc">
                                                            <img style="width: 30px; height: 30px;" title="" alt=""
                                                                src="assets/img/image2.png"><strong
                                                                style="font-size: 18px;">8</strong> puntos (fase de
                                                            grupos)
                                                            &oacute; <strong style="font-size: 18px;">10</strong> puntos
                                                            (fase
                                                            final): Si se acierta el signo del partido (quién gana) y
                                                            los goles de uno de los dos equipos.
                                                        </li>
                                                        <br>
                                                        <li type="disc">
                                                            <img style="width: 30px; height: 30px;" title="" alt=""
                                                                src="assets/img/image3.png"><strong
                                                                style="font-size: 18px;">5</strong> puntos (fase de
                                                            grupos)
                                                            &oacute; <strong style="font-size: 18px;">7</strong> puntos
                                                            (fase
                                                            final): Si se acierta el signo del
                                                            partido (quién gana) pero no coinciden ninguno de los goles
                                                            de los
                                                            dos equipos
                                                        </li>
                                                        <br>
                                                        <li type="disc">
                                                            <img style="width: 30px; height: 30px;" title="" alt=""
                                                                src="assets/img/image4.png"><strong
                                                                style="font-size: 18px;">0</strong> puntos: Si no
                                                            se acierta el resultado
                                                        </li>
                                                    </ul>

                                                    <p id="reglament">Puedes utilizar el siguiente formulario de simulación para saber como funciona la puntuación de partidos:</p>
                                                    <?php include ('simuladorpartido.php'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Considera ganador -->
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h5 class="mb-0">
                                                    <button class="btn  collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        <i class="bi bi-watch me-1"></i>
                                                        <strong>¿Cual se considera el resultado del partido?</strong>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                data-parent="#accordionFaqs">
                                                <div class="card-body">
                                                    <p id="reglament">Se tendrá en cuenta el resultado de los partidos
                                                        cuando se pite el final del partido y/o la prórroga en el caso
                                                        que la haya. Los penaltis no se van a tener en cuenta ni en el
                                                        resultado ni en la suma de goles.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Porcentajes -->
                                        <div class="card">
                                            <div class="card-header" id="headingFour">
                                                <h5 class="mb-0">
                                                    <button class="btn  collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
                                                        <i class="bi bi-bar-chart-fill me-1"></i>
                                                        <strong>¿Como puedo conseguir más puntos adicionales de los
                                                            partidos con los "porcentajes"?</strong>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                                data-parent="#accordionFaqs">
                                                <div class="card-body">
                                                    <p>Hay una manera de ganar algun punto más, y esta es arriesgando
                                                        más que los
                                                        demás. De eso se tratan los porcentajes. Són puntos extra que
                                                        varian en
                                                        función de lo que hayan apostado
                                                        el resto de jugadores (victoria, empate o derrota). Si eres
                                                        conservador, y
                                                        pronosticas lo mismo que el resto no tendras premio. Si por el
                                                        contrario, te
                                                        arriesgas y te sale bien la jugada
                                                        obtendras unos puntos extras en ese partido. Los puntos
                                                        adicionales se calculan teniendo en cuenta el porcentaje de tu pronostico con respecto al resto pronosotico de los jugadores y puntuan de
                                                        la siguiente manera:</p>
                                                    <ul>
                                                        <li>Si tu pronóstico es <b>10%</b> o menos del resto: <b>10</b> puntos</li>
                                                        <li>Si tu pronóstico esta entre <b>10%</b> y <b>20%</b>: <b>5</b> puntos</li>
                                                        <li>Si tu pronóstico esta entre <b>20%</b> y <b>30%</b>: <b>4</b> puntos </li>
                                                        <li>Si tu pronóstico esta entre <b>30%</b> y <b>40%</b>: <b>3</b> puntos </li>
                                                        <li>Más de <b>40%</b>: <b>0</b> puntos</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Premios -->
                                        <div class="card">
                                            <div class="card-header" id="headingFive">
                                                <h5 class="mb-0">
                                                    <button class="btn collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                        <i class="bi bi-currency-euro me-1"></i>
                                                        <strong>¿Cúal es el premio por ganar?</strong>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                                data-parent="#accordionFaqs">
                                                <div class="card-body">
                                                    <div id="node1">
                                                        <ul style="margin-left: 20px;">
                                                            <p id="reglament">
                                                                Los premios se repartiran de la siguiente manera
                                                                <li type="disc">El campeón ganará un <b>60%</b> del premio, o sea <strong
                                                                        style="font-size: 16px;"><?php echo calcularpremio($filaJugadors['NumJugadors'],60, 2);?>
                                                                        € </strong></li>
                                                                <li type="disc">El segundo clasificado ganará un <b>30%</b> del premio, o sea <strong
                                                                        style="font-size: 16px;"><?php echo calcularpremio($filaJugadors['NumJugadors'],30, 2);?>
                                                                        €</strong></li>
                                                                <li type="disc">Y el tercero cierra el podio con un <b>10%</b>, es decir <strong
                                                                        style="font-size: 16px;"><?php echo calcularpremio($filaJugadors['NumJugadors'],10, 2);?>
                                                                        €</strong></li>
                                                            </p>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Ganadores -->
                                        <div class="card">
                                            <div class="card-header" id="headingSix">
                                                <h5 class="mb-0">
                                                    <button class="btn collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapseSix"
                                                        aria-expanded="false" aria-controls="collapseSix">
                                                        <i class="bi bi-trophy-fill me-1"></i>
                                                        <strong>¿Que pasa si gana más de un jugador?</strong>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                                data-parent="#accordionFaqs">
                                                <div class="card-body">
                                                    <p>Se reparte el premio. Si el primero y el segundo quedan
                                                        empatados, se repartiran a partes iguales el 90% del premio. Si
                                                        queden más personas empatadas, se repartera todo el premio a
                                                        partes iguales.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    <br><br><br><br><br><br><br>
                                    <br><br><br><br><br><br><br>
                                    
                                </div>

                            </div>
                        </div><!-- end slides -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
mysqli_free_result($resultadoJugadors);
mysqli_close($conexion);

// include ('footer.php');
?>

    <?php include ('fin.php'); ?>