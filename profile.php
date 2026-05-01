<?php include ('inicio.php'); ?>
<?php
			//$coJugador = 1;
			$cadenaJugadors ="SELECT * FROM jugadors where coJugador=".$coJugador;
			//$numjugador = 1;
			$resultadoJugadors = mysqli_query($conexion, $cadenaJugadors);
      $filaPerfil = mysqli_fetch_assoc($resultadoJugadors);
      $filaImagen= $filaPerfil["Avatar"];
      $filaPassword= $filaPerfil["Password"];
      // $sesion->set("avatar", $filaImagen);
      // $sesion->set("nickname", $filaPerfil["Nickname"]);
      $cabeceravalidacion = "";
      $mensajevalidacion = "";
      //echo $filaPassword;
?>

<div class="pagetitle">
    <!-- <h1>Clasificación</h1> -->
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Usuarios</li>
        <li class="breadcrumb-item active">Perfil</li>
      </ol>
    </nav>
</div><!-- End Page Title -->


<?php 
      require "uploadImage.php";
      ?>
      <style>
        .avatarJugador {
          /* max-width: 120px;
          width: 200px;
          height: 200px;
          max-height: 120px; */
        }
        </style>
      <script>

        history.replaceState(null, null, location.pathname)
        </script>




    <section class="section profile">

        <!-- Button trigger modal -->
        

                <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header <?php echo $cabeceravalidacion ?> text-white">
                
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> <?php echo $mensajevalidacion ?></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  onclick="ReLoad()">Cerrar</button>
                </div>
              </div>
            </div>
          </div>


      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center avatarJugador">

              <img src="assets/avatar/<?php echo $filaImagen; ?>" alt="Profile" class="rounded-circle" style="max-width: 120px; width: 200px; height: 200px;max-height: 120px;">
              <h2><?php echo $filaPerfil["Nickname"]; ?></h2>
              <h3><?php echo $filaPerfil["Mail"]; ?></h3>
              <div class="social-links mt-2">
                <a href="clasificacion.php" class="twitter"><i class="bi bi-layout-text-window-reverse"></i></a>
                <a href="partidos.php" class="twitter"><i class="bi bi-controller"></i></a>
                <a href="extras.php" class="twitter"><i class="bi bi-trophy-fill"></i></a>
                <a href="faqs.php" class="twitter"><i class="bi bi-question-circle"></i></a>
                <!-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Datos</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                </li>
<!-- 
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!-- <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Detalles</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                    <div class="col-lg-9 col-md-8"><?php echo $filaPerfil["Nom"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nickname</div>
                    <div class="col-lg-9 col-md-8"><?php echo $filaPerfil["Nickname"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Usuario</div>
                    <div class="col-lg-9 col-md-8"><?php echo $filaPerfil["Usuari"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $filaPerfil["Mail"]; ?></div>
                  </div>

                </div>

                <!-- Editar Perfil -->
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Avatar</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/avatar/<?php echo $filaImagen; ?>" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadImageModal" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                        </div>
                      </div>
                    </div>

                      <!-- Modal subir Imagen -->
                      <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Imagen</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="" enctype="multipart/form-data" method="POST">
                                <input type="file" class="form-control mb-4" name="imagen">
                                <input type="submit" class="form-control btn btn-success" name="uploadImage" value="Subir">
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre Completo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo $filaPerfil["Nom"]; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="nickname" class="col-md-4 col-lg-3 col-form-label">Nickname</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nickname" type="text" class="form-control" id="nickname" value="<?php echo $filaPerfil["Nickname"]; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="<?php echo $filaPerfil["Mail"]; ?>">
                      </div>
                    </div>
                    
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="updateProfile">Guardar Cambios</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <!-- <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Actual</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nuevo Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-entrar Nuevo Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewPassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="changePassword">Cambiar Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>



   <!-- End Table with stripped rows -->

   </div>
      </div>
    </div>
  </div>    
</section>

<?php include ('fin.php'); ?>
