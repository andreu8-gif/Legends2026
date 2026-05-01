<?php
$fecha_actual=date("d/m/Y");

function getGroupName($groupId)
{
	switch ($groupId) {
		case 1:
			return "GRUPO A";
			break;
		case 2:
			return "Grupo B";
			break;
		case 3:
			return "Grupo C";
			break;
		case 4:
			return "Grupo D";
			break;
		case 5:
			return "Grupo E";
			break;
		case 6:
			return "Grupo F";
			break;
		case 7:
			return "Grupo G";
			break;
		case 8:
			return "Grupo H";
			break;
		default:
        	return "";
	}
}

function getGroupColor($groupId)
{
	switch ($groupId) {
		case 1:
			return "bgGroupA";
			break;
		case 2:
			return "bgGroupB";
			break;
		case 3:
			return "bgGroupC";
			break;
		case 4:
			return "bgGroupD";
			break;
		case 5:
			return "bgGroupE";
			break;
		case 6:
			return "bgGroupF";
			break;
		case 7:
			return "bgGroupG";
			break;
		case 8:
			return "bgGroupH";
			break;
		default:
        	return "bgGroupZ";
	}
}

function getPointsColor($encertId)
{
	switch ($encertId) {
		case 1:
			return "success";
			break;
		case 2:
			return "info";
			break;
		case 3:
			return "warning";
			break;
		case 4:
			return "secondary";
			break;
		case 5:
			return "success";
			break;
		case 6:
			return "info";
			break;
		case 7:
			return "warning";
			break;
		default:
        	return "info";
	}
}

function getPointsPorcentajeColor($value)
{
	if ($value > 0)
	{
		return "success";
	}
	else
	{
		return "secondary";
	}
}

function getGroupColorText($groupId)
{
	switch ($groupId) {
		case 1:
			return "primary";
			break;
		case 2:
			return "danger";
			break;
		case 3:
			return "success";
			break;
		case 4:
			return "warning";
			break;
		case 5:
			return "secondary";
			break;
		case 6:
			return "info";
			break;
		case 7:
			return "muted";
			break;
		case 8:
			return "bgGroupH";
			break;
		default:
        	return "dark";
	}
}

function compararFechas($primera, $segunda)
{
	  $valoresPrimera = explode ("/", $primera);   
	  $valoresSegunda = explode ("/", $segunda); 

	  $diaPrimera    = $valoresPrimera[0];  
	  $mesPrimera  = $valoresPrimera[1];  
	  $anyoPrimera   = $valoresPrimera[2]; 

	  $diaSegunda   = $valoresSegunda[0];  
	  $mesSegunda = $valoresSegunda[1];  
	  $anyoSegunda  = $valoresSegunda[2];

	  $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
	  $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     

	  if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
		// "La fecha ".$primera." no es v&aacute;lida";
		return 0;
	  }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
		// "La fecha ".$segunda." no es v&aacute;lida";
		return 0;
	  }else{
		return  $diasPrimeraJuliano - $diasSegundaJuliano;
	  } 

}
?>	

<script>

// window.onload = function() {
//     var reloading = sessionStorage.getItem("reloading");
//     if (reloading) {
//         sessionStorage.removeItem("reloading");
//         ReLoad();
//     }
// }

function ReLoad(){
	//sessionStorage.setItem("reloading", "true");
	document.location.reload();
}

function GuardarAposta(Resultado1, Resultado2, IdPartit, Cojugador){
	//    alert(Resultado1);
	//    alert(Resultado2);
	  // alert(IdPartit);
	  // alert(Cojugador);
        var parametros = {

                "resultat1" : Resultado1,
                "resultat2" : Resultado2,
				"idPartit" : IdPartit,
                "coJugador" : Cojugador
        };
        $.ajax({
                data:  parametros,
                url:   'saveAposta.php',
                type:  'post',
				// async: true,
				// headers: {
				// 	"cache-control": "no-cache"
				// 	}, 
                beforeSend: function () {
				
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
				
						var recoge=response.split(",");
						idpartit = recoge[0];
						resposta = recoge[1];

                        //$("#resultado").html(response);
						if (resposta == 1)
							alert('Ja no es pot apostar en aquest partit');
						else
						{
							pp1 = '#res_1_'+IdPartit.toString().trim();
							$(pp1).html(Resultado1);
							pp2 = '#res_2_'+IdPartit.toString().trim();
							$(pp2).html(Resultado2);
							//alert('La teva aposta ha estat de '+ Resultado1 + ' a ' + Resultado2);
						}

						//ReLoad();
						//location.reload();
						
						
                }
        });
}
function MostrarAposta(IdPartit, CoJugador){
		  // alert(IdPartit);
	 
 // alert(CoJugador);
        var parametros = {
                "idPartit" : IdPartit,
				"coJugador" : CoJugador
        };
        $.ajax({
                data:  parametros,
                url:   'mostrarAposta.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
						var recoge=response.split(",");
						idpartit = recoge[0];
						nomlocal = recoge[1];
						nomvisitant = recoge[2];
						logolocal = '<img alt="" src="/logos3D/'+recoge[3]+'">';
						logovisitant = '<img alt="" src="/logos3D/'+recoge[4]+'">';
						cojugador = recoge[5];
						
						$("#idPartit_"+IdPartit).val(idpartit);
						//$("#resultado").html(response);
						$("#local_"+IdPartit).html(nomlocal);
						$("#visitant_"+IdPartit).html(nomvisitant);
						$("#logolocal_"+IdPartit).html(logolocal);
						$("#logovisitant_"+IdPartit).html(logovisitant);
						$("#coJugador"+IdPartit).val(cojugador);
						$("#resultat1_"+IdPartit).val('');
						$("#resultat2_"+IdPartit).val('');
						$("#resultat1_"+IdPartit).show();
						$("#resultat2_"+IdPartit).show();
						$("#apostar").show();
                }
        });
}
function GuardarPremi(IdEquip, IdPremi, Cojugador){

	 // alert(IdEquip);
	 
	 // alert(IdPremi);
	 // alert(Cojugador);
        var parametros = {
                "idEquip" : IdEquip,
				"idPremi" : IdPremi,
                "coJugador" : Cojugador
        };
        $.ajax({
                data:  parametros,
                url:   'savePremi.php',
                type:  'post',
                beforeSend: function () {
				        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
						var recoge=response.split(",");
						idpremi = recoge[0];
						resposta = recoge[1];
						//kk = recoge[2];
						
                        //$("#resultado").html(response);
						if (resposta != 2)
						{
							
							if (resposta == 1)
								alert('Ja no es pot apostar en aquest premi');
							else
							{
								logo= "#nomLogo";
								
								pp1 = '#ban_'+IdPremi.toString().trim();
								pp2 = '#eq_'+IdPremi.toString().trim();
								
								$(pp1).html('<img src="../assets/bigFlags/'+$("#nomLogo").val()+'.png" class="rounded-circle img-fluid" >');
								$(pp2).html('<h4 class="card-title font-weight-bold">'+$("#coEquip").val()+'</h4>');
								// $(pp1).html('&nbsp;<img alt="" src="/logos/'+$("#nomLogo").val()+'">');
								// $(pp2).html($("#coEquip").val());

								
								//pp2 = '#eq_'+IdPremi.trim();
								//$(pp12.html(Resultado1);
								//alert('La teva aposta ha estat per '+ $("#coEquip").val());
								location.reload();
							}
						}
                }
        });
}
function MostrarPremi(IdPremi, CoJugador){
	
        var parametros = {
                "idPremi" : IdPremi,
				"coJugador" : CoJugador
			
        };
        $.ajax({
                data:  parametros,
                url:   'mostrarPremi.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
						var recoge=response.split(",");
						idpremi = recoge[0];
						equip = recoge[1];
						logo = '<img alt="" src="/logos3D/'+recoge[2]+'">';
						cojugador = recoge[3];
						//alert(response);
						$("#idPremi").val(idpremi);
						//$("#resultado").html(response);
						$("#logo").html(logo);
						$("#equip").html(equip);
						$("#coJugador").val(cojugador);
						//$("#logo").show();
						$("#equips").show();
						$("#apostar").show();
                }
        });
}
function MostrarEquip(IdGrup, IdFase, IdPremi){

	  //alert(IdGrup);
	 // alert(IdFase);
	 // alert(IdPremi);
        var parametros = {
				"idGrup" : IdGrup,
				"idFase" : IdFase,
				"idPremi" : IdPremi,
        };
        $.ajax({
                data:  parametros,
                url:   'mostrarEquip.php',
                type:  'post',
                beforeSend: function () {

                        //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
						$("#equips"+IdPremi).html(response); 
						$("#equips"+IdPremi).show();
						
                }
        });
}
function MostrarBandera(idEquip, IdPremi){

        var parametros = {
				"idEquip" : idEquip,
				"idPremi" : IdPremi
        };
        $.ajax({
                data:  parametros,
                url:   'mostrarBandera.php',
                type:  'post',
                beforeSend: function () {
				
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
					var recoge=response.split(",");
					logo = recoge[0];
					equip = recoge[1];
					coequip = recoge[2];
					$("#nomLogo"+IdPremi).val(logo);
					$("#coEquip"+IdPremi).val(coequip);
					$("#equip"+IdPremi).html(equip);
					$("#logo"+IdPremi).html('<img alt="" src="/logos3D/'+recoge[0]+'">');
					$("#logo"+IdPremi).show();
					$("#apostar"+IdPremi).show();
						
                }
        });
}
function MostrarPronostic(IdPartit, Victoria, Empate, Derrota, Nulo){
	
        var parametros = {
                "idPartit" : IdPartit,
				"victoria" : Victoria,
				"empate" : Empate,
				"derrota" : Derrota,
				"nulo" : Nulo
			
        };
        $.ajax({
                data:  parametros,
                url:   'mostrarPremi.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
						var recoge=response.split(",");
						idpremi = recoge[0];
						equip = recoge[1];
						logo = '<img alt="" src="/logos3D/'+recoge[2]+'">';
						cojugador = recoge[3];
						//alert(response);
						$("#pieChart"+idPartit).val(idpremi);
						//$("#resultado").html(response);
						$("#logo").html(logo);
						$("#equip").html(equip);
						$("#coJugador").val(cojugador);
						//$("#logo").show();
						$("#equips").show();
						$("#apostar").show();
                }
        });
}
function MostrarChart(IdPartit, Victoria, Empate, Derrota, Nulo){
	
	document.addEventListener("DOMContentLoaded", () => {
			new Chart(document.querySelector('#pieChart'.IdPartit), {
				type: 'pie',
				data: {
				labels: [
					'Derrota',
					'Victoria',
					'Empate'
				],
				datasets: [{
					label: 'My First Dataset',
					data: [Derrota, Victoria, Empate],
					backgroundColor: [
					'rgb(255, 99, 132)',
					'rgb(54, 162, 235)',
					'rgb(255, 205, 86)'
					],
					hoverOffset: 4
				}]
				}
			});
			});
	
}

</script>	