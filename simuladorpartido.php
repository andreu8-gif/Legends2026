<style>
.fs
{
	width: 128% !important;
}
</style>


<script type="text/javascript">
function ShowSelected() {
    var golLocal = document.getElementById("golLocal").value;
    var golVisitante = document.getElementById("golVisitante").value;
    var porcentaje = document.getElementById("rangeInput").value;
    var puntos = 0;
    puntscolor = 'widget-49-date-secondary';

    if (golLocal > golVisitante) {
        if (golLocal == 3) {
            if (golVisitante == 2) {
                puntos = 12;
                puntscolor = 'widget-49-date-success';
            } else {
                puntos = 8;
                puntscolor = 'widget-49-date-info';
            }
        } else {
            if (golVisitante == 2) {
                puntos = 8;
                puntscolor = 'widget-49-date-info';
            } else {
                puntos = 5;
                puntscolor = 'widget-49-date-warning';
            }
        }
    } 
    if (puntos > 0) {
        if (porcentaje <= 10) {
            puntos = puntos + 10;
        } else if (porcentaje > 10 && porcentaje <= 20) {
            puntos = puntos + 5;
        } else if (porcentaje > 20 && porcentaje <= 30) {
            puntos = puntos + 4;
        } else if (porcentaje > 30 && porcentaje <= 40) {
            puntos = puntos + 3;
        }
    }

    var p = document.getElementById('parrafo');
    p.innerHTML = puntos.toString();
    var classold = document.getElementById("puntos").className;
    document.getElementById("puntos").classList.remove(classold);
    document.getElementById("puntos").classList.add(puntscolor);
}

</script>

<div class="col-lg-5 col-md-5">
    <div class="card">
        <div class="card-header bgGroupZ">Simulación Partido</div>
        <div class="card-body mt-2">
            <div class="widget-49">
                <div class="widget-49-title-wrapper">
                    <div class="widget-49-date-secondary" id="puntos">
                        <span class="widget-49-date-day">
                            <p id="parrafo" class="mx-0 my-0">0</p>
                        </span>
                    </div>
                    <div class="widget-49-meeting-info pr-10">
                        <span class="widget-49-pro-title">20 Jun 2024</span>
                        <span class="widget-49-meeting-time"><i
                                class="bi bi-clock pe-2"></i>15:00</span>
                    </div>
                </div>
                <div class="row justify-content-between px-3 pt-3"><h6>Resultado del partido</h6></div>
                <div class="container pt-3 px-0 pb-2 align-items-between">
                    <div
                        class="row g-0 justify-content-center text-center  align-items-between">
                        <div class="col-4 ">
                            <img src="assets/flags/ALE.png"
                                class="img-thumbnail rounded float-middle" style="border: 0"
                                width="40" height="20" alt="...">
                            <h5 class="card-title">Alemania</h5>
                        </div>
                        <div class="col-1 "><p class="card-title pronostico">3</p></div>
                        <div class="col-2"><p class="card-title">-</p></div>
                        <div class="col-1 "><p class="card-title pronostico">2</p></div>
                        <div class="col-4 ">
                            <img src="assets/flags/ITA.png"
                                class="img-thumbnail rounded float-middle" style="border: 0"
                                width="40" height="20" alt="...">
                            <h5 class="card-title">Italia</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer container">
            <div class="row justify-content-between px-3">

                <h6>Mi pronóstico</h6>
                <div class="container pt-3 px-0 align-items-between">
                    <div
                        class="row g-0 justify-content-center text-center  align-items-between">
                        <div class="col-3 ">
                            <img src="assets/flags/ALE.png"
                                class="img-thumbnail rounded float-middle" style="border: 0"
                                width="40" height="20" alt="...">
                            
                        </div>
                        <div class="col-2 ">
                            <p class="card-title pronostico">
                                <select class="form-select  fs" 
                                    aria-label="Default select example" id="golLocal"
                                    onchange="ShowSelected();">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="card-title">-</p>
                        </div>
                        <div class="col-2 ">
                            <p class="card-title pronostico">
                                <select class="form-select fs"
                                    aria-label="Default select example" id="golVisitante"
                                    onchange="ShowSelected();">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </p>
                        </div>
                        <div class="col-3 ">
                            <img src="assets/flags/ITA.png"
                                class="img-thumbnail rounded float-middle" style="border: 0"
                                width="40" height="20" alt="...">
                            
                        </div>
                        <div class="col-6 "><h5 class="card-title">Alemania</h5></div>
                        <div class="col-6 "><h5 class="card-title">Italia</h5></div>

                        <!-- <div class="col-12 percentatge pb-0 text-left">Un <b>'.round($filaApostaPartits['porcentajefinal'],1).'%</b> piensa como tu</div>								 -->

                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer container">
            <div class="row justify-content-between px-3">
                <h6>Mi porcentaje</h6>
                <div class="col-11 ps-3 d-flex flex-row">
                    <input type="range" name="rangeInput" id="rangeInput" min="1" max="100" class="w-100" value="100"
                    onchange="ShowSelected();"
                    oninput="this.nextElementSibling.value = this.value + '%'">&nbsp;
                    <output>100%</output>
                </div>
                    
                <input type="text" id="textInput" value="" style="visibility: hidden;">
            </div>
        </div>
    </div>
</div>

