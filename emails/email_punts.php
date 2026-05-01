<?php
include('../adodb5/adodb.inc.php');

/* Variables */
$myServer = "enjoy-database.cp6084o0cssa.eu-north-1.rds.amazonaws.com";
$myUser = "root"; 
$myPass = "3n.Joy.Ro0t"; 
$myDB = "germany2024"; 
// $myServer = "localhost";
// $myUser = "root"; 
// $myPass = "root"; 
// $myDB = "enjoyqatar2022"; 

if (isset($_GET["fecha"])) 
{
	$fecha_actual = $_GET["fecha"]; 
	$dia = substr($fecha_actual, 0, 2);
	$mes = substr($fecha_actual, 3, 2);
	$ano = substr($fecha_actual, -4); 
	$fecha_actual = $ano . '/' . $mes . '/' . $dia; 	
	$fecha_asunto = $dia . '/' . $mes . '/' . $ano;
}
else
{
	$fecha_actual = date("Y/m/d");
	$fecha_asunto = date("d/m/Y");
}


$conexion = mysqli_connect($myServer,  $myUser, $myPass)  or die(mysqli_error());
mysqli_set_charset($conexion, "utf8");
mysqli_select_db($conexion, $myDB);


// 1) Ejecutamos query
$numpartits = 1;
$cadenaq = "SELECT count(*) as quants  from partits  where DATE(dtpartit) = '".$fecha_actual."' order by partits.idpartit asc";
$Quants = mysqli_query($conexion, $cadenaq) or die(mysqli_error());
if (mysqli_num_rows($Quants) == 0)
{
	echo "No hi ha jornada avui.". "\r\n"."Emails:".$losemails; 
	die;
}
else
{
	$row_Quants=mysqli_fetch_assoc($Quants);
	$numpartits = $row_Quants['quants'];
}
 
// 2) Elaboramos cadena de emails
$cadena = "SELECT mail, Nom FROM jugadors where actiu=1"; // and cojugador=1";
$tabla = mysqli_query($conexion, $cadena) or die(mysqli_error());
$losemails="andreu8@gmail.com, ";
while ($row_Tabla=mysqli_fetch_assoc($tabla)) {
	$losemails.=($row_Tabla['mail'].", ");
}
$largo=strlen($losemails);
if ($largo>2)
{
	//quitamos ultimos ", "
	$losemails=substr($losemails,0,$largo-2);
} else {
	echo "No hay destinatarios!";
	die();
};


// 3) Ejecutamos query
$cadena = "SELECT E1.vcNom as equip1, Resultat1 as reslocal, E2.vcNom as equip2, Resultat2 as resvisitant from ";
$cadena.= "partits ";
$cadena.= "inner join equips E1 on E1.coequip = partits.equip1 ";
$cadena.= "inner join equips E2 on E2.coequip = partits.equip2 ";
$cadena.= "where DATE(dtPartit) = '".$fecha_actual."' ";
$cadena.= "order by partits.idpartit asc ";
$Partits = mysqli_query($conexion, $cadena) or die(mysqli_error());

if (mysqli_num_rows($Partits) == 0)
{
	echo "No hi ha jornada avui.". "\r\n"."Emails:".$losemails; 
	die;
}
else
{
	$cadena=  "SELECT Apostes.Nom as nom, Apostes.nickname, E1.vcNom as local, Apostes.Resultat1 as reslocal, E2.vcNom as visitant,Apostes.Resultat2 as resvisitant, ttencerts.punts, PuntsTotals.total ";
	$cadena.= "FROM ";
	$cadena.= "( ";
	$cadena.= "	SELECT jugadors.coJugador, jugadors.Nom, jugadors.nickname, apostapartits.Resultat1,  apostapartits.Resultat2 , equip1, equip2, partits.IdPartit, ";
	$cadena.= "	CASE WHEN partits.Resultat1= apostapartits.Resultat1 AND partits.Resultat2= apostapartits.Resultat2  ";
	$cadena.= "					THEN CASE WHEN partits.Fase=1 THEN 1 ELSE  5 END  ";
	$cadena.= "					ELSE	CASE WHEN (partits.Resultat1= apostapartits.Resultat1 OR partits.Resultat2= apostapartits.Resultat2)  ";
	$cadena.= "										AND ";
	$cadena.= "										((partits.Resultat1 >partits.Resultat2 AND apostapartits.Resultat1 >apostapartits.Resultat2) OR  ";
	$cadena.= "										 (partits.Resultat1 <partits.Resultat2 AND apostapartits.Resultat1 <apostapartits.Resultat2) OR  ";
	$cadena.= "										 (partits.Resultat1 =partits.Resultat2 AND apostapartits.Resultat1 =apostapartits.Resultat2))  ";
	$cadena.= "							THEN CASE WHEN partits.Fase=1 THEN 2 ELSE  6 END  ";
	$cadena.= "							ELSE	CASE WHEN	(partits.Resultat1<> apostapartits.Resultat1) AND  ";
	$cadena.= "												(partits.Resultat2<> apostapartits.Resultat2) AND  ";
	$cadena.= "												((partits.Resultat1 >partits.Resultat2 AND apostapartits.Resultat1 >apostapartits.Resultat2) OR  ";
	$cadena.= "												 (partits.Resultat1 <partits.Resultat2 AND apostapartits.Resultat1 <apostapartits.Resultat2) OR  ";
	$cadena.= "												 (partits.Resultat1 =partits.Resultat2 AND apostapartits.Resultat1 =apostapartits.Resultat2))  ";
	$cadena.= "									THEN CASE WHEN partits.Fase=1 THEN 3 ELSE  7 END  ";
	$cadena.= "									ELSE 4  ";
	$cadena.= "							END   ";
	$cadena.= "							END  ";
	$cadena.= "					END as idEncert  ";
	$cadena.= "	FROM `apostapartits`  ";
	$cadena.= "	inner join jugadors on apostapartits.coJugador = jugadors.coJugador ";
	$cadena.= "	inner join partits on apostapartits.idpartit = partits.idpartit ";
	$cadena.= "	where DATE(dtpartit) = '".$fecha_actual."'  and jugadors.actiu=1 ";
	$cadena.= "	order by jugadors.Nom, partits.idpartit asc ";
	$cadena.= ") Apostes ";
	$cadena.= "INNER JOIN equips E1 on E1.coequip = Apostes.equip1 ";
	$cadena.= "INNER JOIN equips E2 on E2.coequip = Apostes.equip2 ";
	$cadena.= "INNER JOIN ttencerts ON Apostes.idEncert = ttencerts.idEncert ";
	$cadena.= "INNER JOIN ( ";
	$cadena.= "			SELECT Apostes2.coJugador, SUM(ttencerts.punts) as Total ";
	$cadena.= "			FROM ";
	$cadena.= "			( ";
	$cadena.= "				SELECT jugadors.coJugador, ";
	$cadena.= "				CASE WHEN partits.Resultat1= apostapartits.Resultat1 AND partits.Resultat2= apostapartits.Resultat2  ";
	$cadena.= "								THEN CASE WHEN partits.Fase=1 THEN 1 ELSE  5 END ";
	$cadena.= "								ELSE	CASE WHEN (partits.Resultat1= apostapartits.Resultat1 OR partits.Resultat2= apostapartits.Resultat2) ";
	$cadena.= "													AND ";
	$cadena.= "													((partits.Resultat1 >partits.Resultat2 AND apostapartits.Resultat1 >apostapartits.Resultat2) OR ";
	$cadena.= "													 (partits.Resultat1 <partits.Resultat2 AND apostapartits.Resultat1 <apostapartits.Resultat2) OR ";
	$cadena.= "													 (partits.Resultat1 =partits.Resultat2 AND apostapartits.Resultat1 =apostapartits.Resultat2)) ";
	$cadena.= "										THEN CASE WHEN partits.Fase=1 THEN 2 ELSE  6 END ";
	$cadena.= "										ELSE	CASE WHEN	(partits.Resultat1<> apostapartits.Resultat1) AND ";
	$cadena.= "															(partits.Resultat2<> apostapartits.Resultat2) AND ";
	$cadena.= "															((partits.Resultat1 >partits.Resultat2 AND apostapartits.Resultat1 >apostapartits.Resultat2) OR ";
	$cadena.= "															 (partits.Resultat1 <partits.Resultat2 AND apostapartits.Resultat1 <apostapartits.Resultat2) OR "; 
	$cadena.= "															 (partits.Resultat1 =partits.Resultat2 AND apostapartits.Resultat1 =apostapartits.Resultat2)) ";
	$cadena.= "												THEN CASE WHEN partits.Fase=1 THEN 3 ELSE  7 END ";
	$cadena.= "												ELSE 4 ";
	$cadena.= "										END  ";
	$cadena.= "										END ";
	$cadena.= "								END as idEncert ";
	$cadena.= "				FROM `apostapartits` ";
	$cadena.= "				inner join jugadors on apostapartits.coJugador = jugadors.coJugador ";
	$cadena.= "				inner join partits on apostapartits.idpartit = partits.idpartit ";
	$cadena.= "				where DATE(dtpartit) = '".$fecha_actual."'  and jugadors.actiu=1 ";
	$cadena.= "				order by jugadors.Nom, partits.idpartit asc ";
	$cadena.= "			) Apostes2 ";
	$cadena.= "			INNER JOIN ttencerts ON Apostes2.idEncert = ttencerts.idEncert ";
	$cadena.= "			GROUP BY Apostes2.coJugador ";
	$cadena.= "			) PuntsTotals ON PuntsTotals.coJugador = Apostes.coJugador ";
	$cadena.= "order by PuntsTotals.total desc, Apostes.nom, Apostes.IdPartit asc ";
		
	$Apostes = mysqli_query($conexion, $cadena) or die(mysqli_error());

	// Se definen los argumentos de mail( ):
	$asunto='Puntuación Legends Club - '.$fecha_asunto;
	$mensaje='<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Puntuación Legends Club</title>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link href="https://fonts.gstatic.com" rel="preconnect">
		<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">
		<style>
			.body 			{ 	margin: 0px; }
			.pagebg 		{ 	background-color: #bac9e3; }
			.pagemn 		{ 	background-color: #ffffff; }
			.header 		{ 	background-color: #5782c4; }
			.fuente 		{   font-family: "Poppins", sans-serif;}
			.fb 			{   color: #5782c4; }
			.big 			{   font-size: 20px; }
			.md 			{   font-size: 20px; }
			.tablapar		{ 	background-color: #ffffff; width:380px; BORDER: #5782c4 2px solid; }
			.tablapto		{	background-color: #ffffff; width:570px; BORDER: #5782c4 2px solid; width: 100%;}
			TH.cabecera		{	background-color: #5782c4; font-family: "Poppins", Arial, Helvetica, sans-serif; color: #ffffff; font-weight: bold; font-size: 9pt; height: 25px; border-top-width: 1px;}
			TD.rtabla2 		{	background-color: #dee3e7; font-family: "Poppins", Arial, Helvetica; font-size: 9pt; font-weight: normal;}
			TD.rtabla3 		{	background-color: #dee3e7; font-family: "Poppins", Arial, Helvetica; font-size: 9pt; font-weight: bold; text-align:center;}
			TD.rtabla4 		{	background-color: #d1d7dc; font-family: "Poppins", Arial, Helvetica; font-size: 9pt; font-weight: bold; text-align:center;}
		</style>
	</head>

	<body>
	<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="center" valign="top" class="pagebg"><br>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
		<tr><td align="left" valign="top" class="header" height="5"></td></tr>
		<tr><td align="left" valign="top" class="pagemn">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td align="left" valign="middle" style="padding:15px;">
					<div class="fuente fb big"> Partidos actuales</div>
				</td></tr>
				</table>

				<table width="95%" align="center">
				<tr><td width="40%" align="center" valign="middle" style="padding:10px;"><img src="http://legendsclub.sergicarrasco.com/assets/img/legends_logo.png" width="169" height="169"></td>
					<td align="left" valign="middle" style="color:#525252; font-family:Arial, Helvetica, sans-serif; padding:10px;">
					
						<table  cellPadding=2 cellSpacing=2 class="tablapar">
						<tr>
						<th class="cabecera" colspan="2">Local</th>
						<th class="cabecera" colspan="2">Visitante</th>
						</tr>';
						
						while ($row_Partit=mysqli_fetch_assoc($Partits)) {
						$mensaje .= '<tr>';
						$mensaje .= '<td class="rtabla4">'.$row_Partit['equip1'].'</td>' . "\r\n";
						$mensaje .= '<td class="rtabla3">&nbsp;'.$row_Partit['reslocal'].'&nbsp;</td>' . "\r\n";
						$mensaje .= '<td class="rtabla4">'.$row_Partit['equip2'].'</td>' . "\r\n";
						$mensaje .= '<td class="rtabla3">&nbsp;'.$row_Partit['resvisitant'].'&nbsp;</td>' . "\r\n";
						$mensaje .= '</tr>' . "\r\n";
						}
						$mensaje .= '</table>
					</td>
				</tr>
				</table>
				
				<table width="100%">
				<tr><td align="center" valign="middle"><img src="http://legendsclub.sergicarrasco.com/emails/image/divider.gif" width="566" height="30"></td></tr>
				</table>
				
				<table width="100%" border="0" align="center" style="margin-bottom: 15px;">
				<tr><td align="left" valign="middle" style="padding:15px;">
					<div class="fuente fb big">Puntuación de los jugadores</div>
					<div style="font-size:13px; color:#525252;">
					<center>
					<br>
						<table cellPadding=2 cellSpacing=2  class="tablapto">
						<tr>
						<th class="cabecera">Jugador</th>
						<th class="cabecera" colspan="2">Local</th>
						<th class="cabecera" colspan="2">Visitante</th>
						<th class="cabecera">Punts</th>
						<th class="cabecera">Total</th>

						</tr>';
		$usuario='';
		while ($row_Aposta=mysqli_fetch_assoc($Apostes)) {
			
			$mensaje .= '<tr>';
			if ($usuario != $row_Aposta['nom'])
				$mensaje .= '<td   rowspan="'.$numpartits.'" class="rtabla4">&nbsp;'.$row_Aposta['nickname'].'</td>' . "\r\n";
			$mensaje .= '<td class="rtabla2">'.$row_Aposta['local'].'</td>' . "\r\n";
			$mensaje .= '<td class="rtabla4">&nbsp;'.$row_Aposta['reslocal'].'&nbsp;</td>' . "\r\n";
			$mensaje .= '<td class="rtabla2">'.$row_Aposta['visitant'].'</td>' . "\r\n";
			$mensaje .= '<td class="rtabla4">&nbsp;'.$row_Aposta['resvisitant'].'&nbsp;</td>' . "\r\n";
			$mensaje .= '<td class="rtabla3" >&nbsp;'.$row_Aposta['punts'].'&nbsp;</td>' . "\r\n";
			if ($usuario != $row_Aposta['nom'])
				$mensaje .= '<td   rowspan="'.$numpartits.'" class="rtabla4">&nbsp;'.$row_Aposta['total'].'&nbsp;</td>' . "\r\n";
			$mensaje .= '</tr>' . "\r\n";
					
			$usuario = $row_Aposta['nom'];
		}
		$mensaje .= '	</table>
					</center>
					<br>
					<p class="fuente">Saludos,</p>
					</div>
				</td></tr>
				</table>
		<tr><td align="left" valign="top" class="header" height="5"></td></tr>
		</table>
	</body>
	</html>';

	/* Aqui debe poner su email en formato HTML */	
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	//$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$cabeceras .= 'From: Legends Club <legendsclub000@gmail.com>'. "\r\n";
	//$cabeceras .= 'Bcc: legendsclub000@gmail.com'. "\r\n";

	//Envio de Emails a todos los jugadores activos
	$cadenaemail = "SELECT mail, Nom FROM jugadors where actiu=1"; // and cojugador=156";
	$Tablaemail = mysqli_query($conexion, $cadenaemail) or die(mysqli_error());
	
	while ($row_Tablaemail=mysqli_fetch_assoc($Tablaemail)) {
		mail( $row_Tablaemail['mail'], $asunto, $mensaje, $cabeceras);// or die("Error al Enviar el Email");
		echo "Mensaje Enviado con &Eacute;xito! ".$row_Tablaemail['mail']." ".$cabeceras. "\r\n"; 
	}
	mail('legendsclub000@gmail.com', $asunto, $mensaje, $cabeceras);// or die("Error al Enviar el Email");
	echo "Email enviat a tothom!";
}

mysqli_free_result($Tabla);
mysqli_free_result($Quants);
mysqli_free_result($Partits);
mysqli_free_result($Apostes);
mysqli_close($conexion);
	
?>
