<?php

	/* AQUI ESTARA LA BASE DE DATOS */
	include(RUTA.'controller/bd/conexion.php');
	
	/* AQUI ESTARA LAS FUNCIONES */
	include(RUTA.'controller/functions/function.php');

	/* AQUI ESTARA LAS CLASES */
	include(RUTA.'controller/clases/usuario.php');
	include(RUTA.'controller/clases/categoria.php');
	

	/* CLASE PARA ENVIO DE CORREO  y GENERACION DE PDF */
	include(RUTA.'controller/clases/class.phpmailer.php');
	include(RUTA.'controller/clases/pdf/html2pdf.class.php');
	
?>