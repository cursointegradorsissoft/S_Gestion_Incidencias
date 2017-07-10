<!DOCTYPE html>
<!--[if IE 6]>
<html class="no-js" id="ie6" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html class="no-js" id="ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="no-js" id="ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" lang="en-US">
<!--<![endif]-->
<head>
	<!--meta charset="UTF-8" /-->

	<!-- <meta name="viewport" content="width=device-width, user-scalable=no"/> -->
	<meta name="viewport" content="width=device-width"/>
	
	<title>Braillard Mobile</title>
	<meta http-equiv="content-type" content="text/html;" charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<link rel="shortcut icon"  href=<?php echo funciones::url('/themes/images/logo.jpg');?> >
	<link rel="stylesheet" type="text/css" href=<?php echo funciones::url('/themes/mobile.css');?> >
	
	<!-- PARA EXPLORER -->
	<script src=<?php echo funciones::url('/themes/jquery/admin/acordion/jquery.js');?>></script>
	<script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/mobile.js");?>></script>	
	
	<!-- SCRIPTS DE SLIDER -->
    <script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/slider/jssor.core.js");?>></script>	
    <script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/slider/jssor.utils.js");?>></script>	
    <script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/slider/jssor.slider.js");?>></script>	
    
</head>

<body>
		<?php
			echo "<section class='contenedor'>";
			include("includes/mobile/header.php");

			echo "<section class='body'>";
				echo "<section class='interno'>";
				include('./view/'.VIEW_FILE);
				echo "</section>";
			echo "</section>";

			include("includes/mobile/footer.php");
			include("includes/mobile/menu.php");
			echo "</section>";
		?>
</body>
</html>

