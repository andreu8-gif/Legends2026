<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Favicons -->
    <link href="assets/favicons/favicon.ico" rel="icon">
    <link href="assets/favicons/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="apple-touch-icon" href="assets/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="assets/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="assets/favicons/site.webmanifest">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
    <!-- <script src="assets/js/snippets.js"></script> -->
</head>

<body>
    <?php

	include("connexio.php");
	require_once("sesion.class.php");
	$sesion = new sesion();
	if( isset($_POST["iniciar"]) )
	{
	
		$usuario = $_POST["yourUsername"];
		$password = $_POST["yourPassword"];

		if(validarUsuario($usuario,$password) == true)
		{			
			$sesion->set("usuario",$usuario);
		  mysqli_close($conexion);
		  header("location: index.php");
		}
		else 
		{
      ?>
    <script>
    $(document).ready(function() {
        $("#exampleModal").modal('show');
    });
    </script>
    <?php
			//$msg1="<div class='modal-wrapper' id='popup'><div class='popup-contenedor'><h2>NO!</h2><p>Eps! No estaras intentant entrar amb un usuari que no es el teu?. <br> Torna a posar el teu usuari i el teu password correctament.</p><div style='text-align: center;' ><img src='/images/hacker2.gif'></div><a class='popup-cerrar' href=''>X</a></div></div>";
			//echo $msg1;
      //$sesion->termina_sesion();
			//echo "Verifica el teu usuari i el teu password";
		}
	}
  else{
   // $sesion->termina_sesion();
  }
	
	function validarUsuario($usuario, $password)
	{
        $myServer = "localhost";
	 	$myUser = "root"; 
	 	$myPass = "1234"; 
	 	$myDB = "legendsusamexiccanada"; 
		// $myServer = "enjoy-database.cp6084o0cssa.eu-north-1.rds.amazonaws.com";
		// $myUser = "root"; 
		// $myPass = "3n.Joy.Ro0t"; 
		// $myDB = "germany2024"; 
		$conexion = @mysqli_connect($myServer,  $myUser, $myPass, $myDB);


		$consulta = "select Password, Nom, Nickname, Avatar, Mail, coJugador, PrimerAcceso from jugadors where usuari = '$usuario';";
	
		$result = $conexion->query($consulta);
		
		if($result->num_rows > 0)
		{
			$fila = $result->fetch_assoc();
			if (strcmp($password,$fila["Password"]) == 0)
			{
				// $_SESSION['coJugador'] = $fila["coJugador"];
				// $_SESSION['Nom'] = $fila["Nom"];
                $_SESSION['Nickname'] = $fila["Nickname"];
                // $_SESSION['Avatar'] = $fila["Avatar"];
                // $_SESSION['Email'] = $fila["Mail"];
                $sesion = new sesion();
                $sesion->set("coJugador", $fila["coJugador"]);
                $sesion->set("avatar", $fila["Avatar"]);
                $sesion->set("nickname", $fila["Nickname"]);
                $sesion->set("email", $fila["Mail"]);
                $sesion->set("primerAcceso", $fila["PrimerAcceso"]);
				return true;						
			}
			else					
				return false;
		}
		else
				return false;
	}
?>

<main>
    <div class="container">

        <section
            class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Error</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Usuario o Password incorrecto. Vuelve a probar
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                            <div class="card-body">

                                <div class="pt-4 pb-2 text-center">
                                    <img src="assets/img/legends_logo.png" alt="" width="250" height="250">
                                    <h5 class="card-title text-center pb-0 fs-4">Bienvenido a Legends Club</h5>
                                    <p class="text-center small">Introduce el usuario y el password para entrar</p>
                                </div>


                                <form class="row g-3 needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                                    method="POST">
                                    <div class="col-12">
                                        <!-- <label for="yourUsername" class="form-label">Usuario</label> -->
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="fas fa-user"></i></span>
                                            <input type="text" name="yourUsername" class="form-control"
                                                id="yourUsername" required placeholder="Usuario" />
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <!-- <label for="yourPassword" class="form-label">Password</label> -->
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="fas fa-key"></i></span>
                                            <input type="password" name="yourPassword" class="form-control"
                                                id="yourPassword" required placeholder="Password" />
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit"
                                            name="iniciar">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">No formas parte del equipo? <a
                                                href="register.php">Crea una cuenta</a></p>
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