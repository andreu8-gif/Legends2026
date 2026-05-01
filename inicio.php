<?php
  include ('connexio.php');

  require_once("sesion.class.php");
  $sesion = new sesion();
  $usuario = $sesion->get("usuario");
  $avatar = $sesion->get("avatar");
  $nickname = $sesion->get("nickname");
  $email = $sesion->get("email");
  $coJugador = $sesion->get("coJugador");
  $primeracceso = $sesion->get("primerAcceso");
  
  if ($usuario == false)  {
    header("Location: login.php");
  }
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <?php include ('head.php'); ?>
</head>
<body>

  <!-- ======= Functions ======= -->
  <?php include ('functions.php'); ?>
  <!-- End Functions -->
  
  <!-- ======= Consultas SQL ======= -->
  <?php include ('queries.php'); ?>
  <!-- End Consultas SQL -->  
  

  <!-- ======= Header ======= -->
  <?php include ('header.php'); ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include ('sidebar.php'); ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    