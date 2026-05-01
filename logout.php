<?php
//	include ('header.php');
	require_once("sesion.class.php");

	$sesion = new sesion();
	$usuario = $sesion->get("usuario");	
	if( $usuario != false )
	{
		$usuario = $sesion->get("usuario");	
		$sesion->termina_sesion();	
		
		// $msg1="<div class='modal-wrapper' id='popup'><div class='popup-contenedor'><div style='text-align: center;' ><h2>AL CARRER!<br></h2><img src='/images/alcarrer.png'></div><a class='popup-cerrar' href='/login.php'>X</a></div></div>";
		// echo $msg1;
		//header("location: login.php");
	}
		
	header("Location: login.php");
?>

	<!-- <link rel="stylesheet" href="/logout.css">
	<div id="slides">
			<div class="slides_container_reglament" style="margin-top: 300px;">&nbsp;
			</div>
	</div> -->


<?php	
	//include ('footer.php');
?>