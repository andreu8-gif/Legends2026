<?php
$tipo_de_bbdd= 2; 	  /*1--SQL SERVER, 2--MYSQL*/
$tipo_de_servidor= 1; /*1--Local, 2--Hostinger*/

/* Definimos nuestro DSN */
if ($tipo_de_bbdd == 1)
{
	$myServer = "localhost"; 
	$myUser = "root"; 
	$myPass = "1234"; 
	$myDB = "legendsusamexiccanada"; 
	$conexion = &ADONewConnection(odbc_mssql);
	$datos = 'Driver={SQL Server};Server=PERSONAL;Database='.$myDB.';';
}
else
{
	if ($tipo_de_servidor == 1)
	{
		/* Variables */
		$myServer = "localhost";
		$myUser = "root"; 
		$myPass = "1234"; 
		$myDB = "legendsusamexiccanada"; 
	}
	else
	{
		$myServer = "enjoy-database.cp6084o0cssa.eu-north-1.rds.amazonaws.com";
		$myUser = "root"; 
		$myPass = "3n.Joy.Ro0t"; 
		$myDB = "germany2024"; 
	}
	$conexion = @mysqli_connect($myServer,  $myUser, $myPass, $myDB);
	@mysqli_set_charset($conexion,"utf8");
	date_default_timezone_set("Europe/Madrid");
	
	// Check connection
	if (!$conexion) {
		echo "NOOOOOO";
		die("Connection failed: " . mysqli_connect_error());
	}
}

?>
