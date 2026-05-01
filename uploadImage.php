<?php

if (!empty($_POST["uploadImage"]))
{
    
    $imagen=$_FILES["imagen"]["tmp_name"];
    $nombreImagen=$_FILES["imagen"]["name"];
    $tipo_imagen=strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
    $sizeimagen=$_FILES["imagen"]["size"];
    $directorio="assets/avatar/";
    //echo "<div> $nombreImagen</div>";

    if ($tipo_imagen == "jpg" or $tipo_imagen == "jpeg" or  $tipo_imagen == "png" or $tipo_imagen == "gif" ){
        if ($sizeimagen > 1900000){
          $cabeceravalidacion = "bg-danger";
          $mensajevalidacion = "El tamaño de la imagen es demasiado grande: ".$sizeimagen." Kbs. Intenta subir otra imagen que ocupe menos";
          //echo "<div>Tamaño enorme $sizeimagen</div>";    
        }
        else{
            
            $ruta = $directorio.$nombreImagen;
            // $destination_path = getcwd().DIRECTORY_SEPARATOR;
            // $ruta = $destination_path . basename($ruta);
            //echo $ruta;
            if (move_uploaded_file($imagen, $ruta)){
                $coJugador = $sesion->get("coJugador");
                $cadenaJugadors="UPDATE jugadors SET avatar='".$nombreImagen."'  WHERE coJugador=".$coJugador;
                $resultadoJugadors = mysqli_query($conexion, $cadenaJugadors);
                $filaImagen = $nombreImagen;

                $cabeceravalidacion = "bg-success";
                $mensajevalidacion = "Se ha cambiado el avatar correctamente";
                $sesion->set("avatar", trim($nombreImagen));
                //$_SESSION['Avatar'] = trim($nombreImagen);
                    ?>
                
                    <script>$(document).ready(function(){
                        $("#exampleModal").modal('show');
                        });
                    </script>
                    <?php
            } else{
                print_r(error_get_last());
                $cabeceravalidacion = "bg-danger";
                $mensajevalidacion = "Error al guardar";
                //echo "<div>Error al guardar</div>";
            }
            
        }
        
    }
    else{
      $cabeceravalidacion = "bg-danger";
      $mensajevalidacion = "No se acepta este formato";
        //echo "<div>No se acepta</div>";
    }

    ?>
    <script>$(document).ready(function(){
      $("#exampleModal").modal('show');
      });
    </script>
    <?php
}
else
{
   // echo "MAL";
}

?>

<?php
  if(isset($_POST["updateProfile"]) )
  {
    $nom = $_POST["fullName"];
    $nickname = $_POST["nickname"];
    //$usuario = $_POST["usuari"];
    $email = $_POST["email"];
        
    //Actualizamos usuario:
    $cadenaJugadors="UPDATE jugadors SET Nom = '".trim($nom)."', Nickname = '".trim($nickname)."', Mail = '".trim($email)."' Where coJugador = ".$coJugador;
    //echo $cadenaJugadors;
    $resultadoJugadors = mysqli_query($conexion, $cadenaJugadors);
    if(!$resultadoJugadors)
    {
      $error = $dom -> createElement("Error", "Error general");
      $info -> appendChild($error);
    }
    else
    {
      $sesion->set("nickname", trim($nickname));
      //$_SESSION['Nickname'] = trim($nickname);
      $_SESSION['Nom'] = trim($nom);
      // mysqli_free_result($resultadoJugadors);
      // mysqli_close($conexion);
      $cabeceravalidacion = "bg-success";
      $mensajevalidacion = "Se ha guardado los cambios correctamente"
          ?>
      
          <script>$(document).ready(function(){
            $("#exampleModal").modal('show');
            });
          </script>
        <?php
    }
  }

  if(isset($_POST["changePassword"]) )
  {
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    $renewPassword = $_POST["renewPassword"];
    $mensajevalidacion = validarPassword($currentPassword, $newPassword, $renewPassword, $filaPassword);
    if($mensajevalidacion == '')
	  {	
        //Actualizamos Password:
        $cadenaPassword="UPDATE jugadors SET Password = '".trim($newPassword)."' Where coJugador = ".$coJugador;
        $resultadoPassword = mysqli_query($conexion, $cadenaPassword);
        if(!$resultadoPassword)
        {
          $error = $dom -> createElement("Error", "Error general");
          $info -> appendChild($error);
        }
        else
        {
            $cabeceravalidacion = "bg-success";
          $mensajevalidacion = "Se ha cambiado el password correctamente"
          ?>
      
          <script>$(document).ready(function(){
            $("#exampleModal").modal('show');
            });
          </script>
        <?php
        }
    }
    else
    {
        $cabeceravalidacion = "bg-danger";
      //echo $mensajevalidacion ;
      ?>
      
		  <script>$(document).ready(function(){
			  $("#exampleModal").modal('show');
		    });
		  </script>
		<?php
    }
  }

  function validarPassword($currentPassword, $newPassword, $renewPassword, $actualPassword)
	{
      if ($currentPassword != $actualPassword) return  "El password actual no coincide con el que has puesto.";
      if ($newPassword != $renewPassword) return  "La confirmación del nuevo password no coincide.";
      return '';
	}
?>