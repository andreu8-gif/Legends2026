<?php
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Cabeceras adicionales
	$cabeceras .= 'From: Legends Club <legendsclub000@gmail.com>'. "\r\n";
	$cabeceras .= 'Bcc: legendsclub000@gmail.com'. "\r\n";
	// $cabeceras .= 'To: andreu8@gmail.com'. "\r\n";


		mail("andreu8@gmail.com", 'asunto', 'mensaje', $cabeceras) or die("Error al Enviar el Email");
		echo "OK"
	
?>
