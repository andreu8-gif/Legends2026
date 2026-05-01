<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

  <!-- Favicons -->
  <link href="assets/favicons/favicon.ico" rel="icon">
  <link href="assets/favicons/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="apple-touch-icon" href="assets/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="assets/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="assets/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="assets/favicons/site.webmanifest">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</head>

<body>

<?php


include("connexio.php");
require_once("sesion.class.php");
$sesion = new sesion();

$yourName = (!empty($_POST['yourName']) == true) ? $_POST['yourName'] : '';
$yourNickname = (!empty($_POST['yourNickname']) == true) ? $_POST['yourNickname'] : '';
$yourEmail = (!empty($_POST['yourEmail']) == true) ? $_POST['yourEmail'] : '';
$yourUsername = (!empty($_POST['yourUsername']) == true) ? $_POST['yourUsername'] : '';

// if (!empty($_POST['yourName']) == true)
// {
// 	$yourName = $_POST['yourName'];
// }
// if (!empty($_POST['yourNickname']) == true)
// {
//  	$yourNickname = $_POST['yourNickname'];
// }
// if (!empty($_POST['yourEmail']) == true)
// {
//  	$yourEmail = $_POST['yourEmail'];
// }
// if (!empty($_POST['yourUsername']) == true)
// {
//  	$yourUsername = $_POST['yourUsername'];
// }

if(isset($_POST["register"]) )
{
	$name = $_POST["yourName"];
	$nickname = $_POST["yourNickname"];
	$usuario = $_POST["yourUsername"];
	$email = $_POST["yourEmail"];
	$password = $_POST["yourPassword"];
	$confirm_password = $_POST["confirmYourPassword"];


	// $myServer = "localhost";
	// $myUser = "root"; 
	// $myPass = "root"; 
	// $myDB = "enjoyqatar2022";
	//$conexion = new mysqli($myServer,  $myUser, $myPass, $myDB);
	$myServer = "enjoy-database.cp6084o0cssa.eu-north-1.rds.amazonaws.com";
	$myUser = "root"; 
	$myPass = "3n.Joy.Ro0t"; 
	$myDB = "germany2024"; 
	$conexion = @mysqli_connect($myServer,  $myUser, $myPass, $myDB);
	

	$mensajevalidacion = validarUsuario($name, $nickname, $usuario, $email, $password, $confirm_password);
	if($mensajevalidacion == '')
	{			
		//Creamos usuario:
		$cadenaJugadors="INSERT INTO jugadors (Nom, Nickname, Mail, Usuari, Password, isAdmin, Actiu, Avatar, PrimerAcceso) VALUES ('".$name."','".$nickname."','".$email."','".$usuario."','".$password."',false,true,'avatar4.png', null)";
		$resultadoJugadors = mysqli_query($conexion, $cadenaJugadors);
		if(!$resultadoJugadors)
		{
			$error = $dom -> createElement("Error", "Error general");
			$info -> appendChild($error);
		}
		else
		{
			
			$nuevocoJugador = mysqli_insert_id($conexion);
			//echo $nuevocoJugador;
			$cadenaApostaPartits = "INSERT INTO apostapartits (coJugador, idPartit) (SELECT ".$nuevocoJugador.", idPartit FROM partits)";
			$resultadoApostaPartits = mysqli_query($conexion, $cadenaApostaPartits);
			//mysql_free_result($resultadoApostaPartits);
			$cadenaApostaPremis = "INSERT INTO apostapremis (coJugador, idPremi) (SELECT ".$nuevocoJugador.", idPremi FROM premis)";
			$resultadoApostaPremis = mysqli_query($conexion, $cadenaApostaPremis);

			// ENVIO CORREO
			// $asunto='Bienvenido a Legends Club';
			// $mensaje='<html xmlns="http://www.w3.org/1999/xhtml">
			// <head>
			// <title>Legends Club</title>
			// <style>
			// body 			{ margin: 0px; }
			// TH.cabecera		 {	BACKGROUND-COLOR: #8e0507; FONT-FAMILY: Arial; COLOR: #ffffff; font-weight: bold; FONT-SIZE: 9pt; FONT-WEIGHT: bold; HEIGHT: 25px; BORDER-BOTTOM-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px; BORDER-TOP-WIDTH: 1px;}
			// TD.rtabla1 {	BACKGROUND-COLOR: #efefef;  font-family: Arial; font-size: 9pt; font-weight: normal;  }
			// TD.rtabla2 {	BACKGROUND-COLOR: #dee3e7;  font-family: Arial; font-size: 9pt; font-weight: normal;}
			// TD.rtabla3 {	BACKGROUND-COLOR: #d1d7dc;  font-family: Arial; font-size: 11pt; font-weight: bold;}
			// TD.rtabla4 {	BACKGROUND-COLOR: #d1d7dc;  font-family: Arial; font-size: 9pt; font-weight: normal;text-align:center;}
			// </style>
			// </head>
			// <body>
			// <table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0">
			// <tr><td align="center" valign="top" bgcolor="#bac9e3" style="background-color:#bac9e3;"><br>
			// 	<br>
			// 	<table width="600" border="0" cellspacing="0" cellpadding="0">
				
			// 	<tr><td align="left" valign="top"><img src="http://mundial.sergicarrasco.com/emails/image/top.png" width="600" height="13" style="display:block;"></td></tr>
			// 	<tr><td align="left" valign="top" bgcolor="#8e0507" style="background-color:#8e0507; font-family:Arial, Helvetica, sans-serif; padding:0px;">
						
			// 			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
			// 			<tr><td><img src="http://mundial.sergicarrasco.com/emails/image/header.gif" width="600" height="97"></td>			</tr>
			// 			</table>
			// 		</td></tr>
			// 	<tr><td align="left" valign="top" bgcolor="#ffffff" style="background-color:#ffffff;">
						
			// 			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:15px;">
			// 			<tr><td align="left" valign="middle" style="padding:15px; font-family:Arial, Helvetica, sans-serif;">
							
			// 				<p>Benvingut a "Enjoy Rusia 2018"</p>
			// 				<div style="font-size:13px; color:#525252;">
			// 				<p>Ja pots entrar a la web amb el teu usuari i password. Mira les normes per saber el funcionament de la web i la manera d&#39;apostar els partits i els premis. Si tens algun dubte, envia un correu a <a href="enjoyrusia2018@gmail.com" style="color: #8e0507;text-decoration:none;">enjoyrusia2018@gmail.com</a>. Et recomano que de bon principi apostis a tots els partits i a tots els premis, ja que m&eacute;s tard tindr&agrave;s temps de canviar.</p>
			// 				<p>Pot ser que s&#39;afegeixi algun premi m&eacute;s abans que comen&ccedil;i el mundial, per aix&ograve; et recomano que estigui atent els dies previs.</p>
			// 				<p>Et recordo les teves dades:</p>
			// 				<br>
			// 								<table border=0 cellPadding=2 cellSpacing=2 style="background-color: #FFFFFF;width:300px; BORDER: #8e0507 2px solid; ">';
										
			// 								//$row = mysqli_fetch_assoc($destinatari);
										
			// 								$mensaje .= '<tr><th class="cabecera"  style="BACKGROUND-COLOR: #8e0507; FONT-FAMILY: Arial; COLOR: #ffffff; font-weight: bold; FONT-SIZE: 9pt; FONT-WEIGHT: bold; HEIGHT: 25px; BORDER-BOTTOM-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px; BORDER-TOP-WIDTH: 1px;">Nickname</th><td class="rtabla2" style="BACKGROUND-COLOR: #dee3e7;  font-family: Arial; font-size: 9pt; font-weight: bold;">&nbsp;'.$nickname.'</td></tr>';
			// 								$mensaje .= '<tr><th class="cabecera"  style="BACKGROUND-COLOR: #8e0507; FONT-FAMILY: Arial; COLOR: #ffffff; font-weight: bold; FONT-SIZE: 9pt; FONT-WEIGHT: bold; HEIGHT: 25px; BORDER-BOTTOM-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px; BORDER-TOP-WIDTH: 1px;">Usuari</th><td class="rtabla2" style="BACKGROUND-COLOR: #dee3e7;  font-family: Arial; font-size: 9pt; font-weight: bold;">&nbsp;'.$usuario.'</td></tr>';
			// 								$mensaje .= '<tr><th class="cabecera"  style="BACKGROUND-COLOR: #8e0507; FONT-FAMILY: Arial; COLOR: #ffffff; font-weight: bold; FONT-SIZE: 9pt; FONT-WEIGHT: bold; HEIGHT: 25px; BORDER-BOTTOM-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px; BORDER-TOP-WIDTH: 1px;">Password</th><td class="rtabla2" style="BACKGROUND-COLOR: #dee3e7;  font-family: Arial; font-size: 9pt; font-weight: bold;">&nbsp;'.$password.'</td></tr>';
			// 								$mensaje .= '</table>
							
			// 				<br>
			// 				<p>Salutacions i...Enjoy Rusia 2018</p>
			// 				</div>
			// 			</td></tr>
			// 			</table>
			// 			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
			// 			<tr><td><img src="http://mundial.sergicarrasco.com/emails/image/footer.gif" width="600" height="98"></td>			</tr>
			// 			</table>
					  
			// 			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			// 			<tr><td width="50%" align="left" valign="middle" style="padding:10px;">
			// 				<table width="75%" border="0" cellspacing="0" cellpadding="4">
			// 				<tr><td align="left" valign="top" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#000000;"><b>Segueix-nos</b></td></tr>
			// 				<tr><td align="left" valign="top" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#000000;">
			// 					<table width="100%" border="0" cellspacing="0" cellpadding="0">
			// 					<tr><td width="33%" align="left" valign="middle"><img src="http://mundial.sergicarrasco.com/emails/image/tweet48.png" width="48" height="48"></td>
			// 						<td width="34%" align="left" valign="middle"><img src="http://mundial.sergicarrasco.com/emails/image/in48.png" width="48" height="48"></td>
			// 						<td width="33%" align="left" valign="middle"><img src="http://mundial.sergicarrasco.com/emails/image/face48.png" width="48" height="48"></td>
			// 					</tr>
			// 					</table>
			// 				</td>
			// 				</tr>
			// 				</table>
			// 			</td>
			// 			<td width="50%" align="left" valign="middle" style="color:#564319; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:10px;"><b>Informaci&oacute;:</b> <a href="http://www.fifa.com" target="_blank"  style="color:#564319; text-decoration:none;">http://www.fifa.com</a> <br>
			// 				<b>Suport:</b> <a href="mailto:enjoyrusia2018@gmail.com" style="color:#564319; text-decoration:none;">enjoyrusia2018@gmail.com</a><br>
			// 				<br>
			// 				<b>Comit&eacute; de competici&oacute;</b><br>
			// URL: <a href="http://mundial.sergicarrasco.com" target="_blank"  style="color:#564319; text-decoration:none;">http://mundial.sergicarrasco.com</a></td>
			// 			</tr>
			// 			</table></td>
			// 		</tr>
			// 		<tr><td align="left" valign="top"><img src="http://mundial.sergicarrasco.com/emails/image/bot.png" width="600" height="37" style="display:block;"></td></tr>
			// 		</table>
			// 	<br>
			// 	<br></td>
			// 	</tr>
			// </table>
			// </body>
			// </html>';

			//echo $mensaje;
	
			/// Envío del email:
			// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Cabeceras adicionales
			//$cabeceras .= 'To: '.$email. "\r\n";
			$cabeceras .= 'From: Legends Club <legendsclub000@gmail.com>'. "\r\n";
			$cabeceras .= 'Bcc: legendsclub000@gmail.com'. "\r\n";
//			mail($email, $asunto, $mensaje, $cabeceras) or die("Error al Enviar el Email");
			//mail('enjoyrusia2018@gmail.com', $asunto, $mensaje, $cabeceras) or die("Error al Enviar el Email");

			// FIN ENVIO CORREO
			
			//mysql_free_result($resultadoApostaPremis);
			//mysqli_free_result($resultadoJugadors);
			//mysqli_close($conexion);
			
		}
		$msg1="<div class='modal-wrapper' id='popup'><div class='popup-contenedor'><h2>Perfecte!</h2><p>Ho has aconseguit. Ja estas registrat a la millor web d'apostes del Mundial de Rusia 2018. <br> Has de rebre un e-mail amb les teves dades. Si no t'arriba, comprova que no hagi anat a parar a la carpeta d'Spam. <br> Mira't el reglament per saber com funciona i comença a apostar abans que sigui massa tard.</p><div style='text-align: center;' ><img src='/images/registrat.png'></div><a class='popup-cerrar' href='/login.php'>X</a></div></div>";
		echo $msg1;
		header("location: login.php");
	}
	else
	{

		?>
		<script>$(document).ready(function(){
			$("#exampleModal").modal('show');
		  });
		</script>
		<?php
		// $msg1="<div class='modal-wrapper' id='popup'><div class='popup-contenedor'><h2>NOOOOO!</h2><p>Algo no estas fent bé: <br>".$mensajevalidacion."</p><div style='text-align: center;' ><img src='/images/explotacabeza.png'></div><a class='popup-cerrar' href=''>X</a></div></div>";
		// echo $msg1;
	}
}

function validarUsuario($name, $nickname, $usuario, $email, $password, $confirm_password)
{
	// $myServer = "localhost";
	// $myUser = "root"; 
	// $myPass = "root"; 
	// $myDB = "enjoyqatar2022";
	// $conexionlogin = new mysqli($myServer,  $myUser, $myPass, $myDB);

	$myServer = "enjoy-database.cp6084o0cssa.eu-north-1.rds.amazonaws.com";
	$myUser = "root"; 
	$myPass = "3n.Joy.Ro0t"; 
	$myDB = "germany2024"; 
	$conexionlogin = @mysqli_connect($myServer,  $myUser, $myPass, $myDB);

	if (trim ($name) == '') return "El nombre no puede estar vacio.";
	if (trim ($nickname) == '') return "El nickname no puede estar vacio.";
	if (trim ($email) == '') return "El Email no puede estar vacio.";
	//if (!preg_match("/^[A-Z0-9.%-]+@[A-Z0-9.%-]+.[A-Z]{2,4}$/", trim($email))) return "<b>Dirección de E-mail no  válida</b>.<br>";
	//$matches = null;
	//if (!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $trim($email), $matches )) return "Ai, ai, ai!  que l'adreça d'E-mail no es vàlida.";
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "El E-mail no es válido.";
	if (trim ($usuario) == '') return "El usuario no puede estar vacio.";
	if (trim ($password) == '') return "Escribe un password, si no, no podrás entrar.";
	if ($password != $confirm_password) return  "La confirmación del password no coincide.";
	$cadena1 = "select Password, Nom, coJugador from jugadors where usuari = '$usuario';";
	$resultado1 = mysqli_query($conexionlogin, $cadena1);
	if($resultado1->num_rows > 0) return "Este usuario ya existe. Selecciona otro que no es tan difícil.";

	$cadenaEmail = "select Password, Nom, coJugador from jugadors where Mail = '$email';";
	$resultadoEmail = mysqli_query($conexionlogin, $cadenaEmail);
	if($resultadoEmail->num_rows > 0) return "Este email ya existe. Selecciona otro que no es tan difícil.";
	return '';
}




 mysqli_close($conexion);

// $dom->formatOutput = true; 
// echo $dom->saveXML(); 	

?>


  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
 			
		
		
		<!-- Modal -->
 			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Error</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
						Algo no estas fent bé: <?php echo $mensajevalidacion ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>






          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

				
                  <div class="pt-4 pb-2 text-center">
                    <img src="assets/img/legends_logo.png" alt="" width="200" height="200">
                    <h5 class="card-title text-center pb-0 fs-4">Crear una cuenta</h5>
                    <p class="text-center small">Introduce tus datos personales para formar parte del equipo como jugador</p>
                  </div>

                  <form class="row g-3 needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <!-- <form class="row g-3 needs-validation" action="register.php" method="POST"> -->

                  	<div class="col-12">
                      <!-- <label for="yourName" class="form-label">Nombre Completo</label> -->
                      <input type="text" name="yourName" class="form-control" id="yourName" value="<?php echo $yourName; ?>" required  placeholder="Nombre Completo">
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <!-- <label for="yourNickname" class="form-label">Nickname</label> -->
                      <input type="text" name="yourNickname" class="form-control" id="yourNickname" value='<?php echo $yourNickname; ?>' required  placeholder="Nickname">
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <!-- <label for="yourEmail" class="form-label">Email</label> -->
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="yourEmail" class="form-control" id="yourEmail" value='<?php echo $yourEmail; ?>' required placeholder="Email">
                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>                      
                      </div>
                    </div>

                    <div class="col-12">
                      <!-- <label for="yourUsername" class="form-label">Usuario</label> -->
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                        <input type="text" name="yourUsername" class="form-control" id="yourUsername" value='<?php echo $yourUsername; ?>' required placeholder="Usuario">
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <!-- <label for="yourPassword" class="form-label">Password</label> -->
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-key"></i></span>
                        <input type="password" name="yourPassword" class="form-control" id="yourPassword"  maxlength="50" required placeholder="Password">
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    
                    <div class="col-12">
                      <!-- <label for="yourPassword" class="form-label">Confirma Password</label> -->
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-key"></i></span>
                        <input type="password" name="confirmYourPassword" class="form-control" id="confirmYourPassword"  maxlength="50" required placeholder="Confirmar password">
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit"  name="register">Crear Cuenta</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Ya formas parte del equipo? <a href="login.php">Logéate</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

</body>
</html>