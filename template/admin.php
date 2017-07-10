<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
	<meta name="viewport" content="width=device-width" />
	<title>Intranet Usuario</title>
	<meta http-equiv="content-type" content="text/html;" charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon"  href=<?php echo funciones::url('/themes/images/logo.jpg');?>>
	<link href=<?php echo funciones::url('/themes/admin.css');?> rel="stylesheet">

	<!-- PARA EXPLORER -->
	<script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/compatibilidad/modernizr-latest.js")?>></script>
	<script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/compatibilidad/placeholders.min.js"); ?>></script>
	
	<link href=<?php echo funciones::url('/themes/jquery/admin/acordion/acordeon.css');?> rel="stylesheet">
	<script src=<?php echo funciones::url('/themes/jquery/admin/acordion/jquery.js');?>></script>
	<script src=<?php echo funciones::url('/themes/jquery/admin/acordion/jquery-ui.js');?>></script>

	<script src=<?php echo funciones::url('/themes/jquery/admin/index.js');?> ></script>
	<script src=<?php echo funciones::url('/themes/jquery/admin/listado.js');?> ></script>
	<script src=<?php echo funciones::url('/themes/jquery/admin/funciones_ajax.js');?> ></script>

	<!--  SCRIPT PARA DATAPICKER DINAMICOS -->
	<link rel="stylesheet" type="text/css" href=<?php echo funciones::url('/themes/jquery/calendar_end/dhtmlxcalendar.css');?> />
	<script src=<?php echo funciones::url("/themes/jquery/calendar_end/dhtmlxcalendar2.js");?> ></script>


	<script src=<?php echo funciones::url('/themes/jquery/admin/Msgbox/msgbox/Scripts/jquery.msgBox.js');?>></script>
	<link href=<?php echo funciones::url('/themes/jquery/admin/Msgbox/msgbox/Styles/msgBoxLight.css');?> rel="stylesheet"/>

	<!-- SCRIPTS DE DATETIME DINAMICO -->
	<link href=<?php echo funciones::url('/themes/jquery/js_time/jquery.ptTimeSelect1.css');?> type="text/css" rel="stylesheet">
	<script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/js_time/jquery.ptTimeSelect.js");?>></script>


	<!-- SCRIPTS DE DIAGRAMA DE GANT -->
	<link rel="stylesheet" type="text/css" href=<?php echo funciones::url('/themes/jquery/gant/jsgantt.css');?> />
  	<script language="javascript" src=<?php echo funciones::url("/themes/jquery/gant/jsgantt.js");?> ></script>



	<!-- SCRIPTS DE DIAGRAMA DE CANVAS -->
  	<script language="javascript" src=<?php echo funciones::url("/themes/jquery/canvas/html2canvas.js");?> ></script>
  	<script language="javascript" src=<?php echo funciones::url("/themes/jquery/canvas/html2canvas.min.js");?> ></script>

</head>

<body>
	<?php
		include("includes/admin/header.php");
		include("includes/admin/left.php");

		echo "<article class='container-right'>";
			$vista=substr(VIEW_FILE, strpos(VIEW_FILE,'/')+1,strpos(VIEW_FILE,'.')-strpos(VIEW_FILE,'/')-1 );
			$val=funciones::validar_rutas($c,$values['usuario'],$vista);
			$val2=funciones::validar_rutas_totales($c,$vista);

			if( $vista=="admin" || $vista=="salir"  || $vista=="funcion"){
				include('./view/'.VIEW_FILE);
			}
			
			if( mysql_num_rows($val)>0 && mysql_num_rows($val2)>0 ){ 
				include('./view/'.VIEW_FILE);
			}
			else if( mysql_num_rows($val)==0 && mysql_num_rows($val2)>0 ){
				include('./view/admin/denegado.php');
			}else{
				include('./view/admin/error.php');
			}
		echo "</article>";

		include("includes/admin/footer.php");
	?>
	<div id="bloque"></div> 
</body>

</html>