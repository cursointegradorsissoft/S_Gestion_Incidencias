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
	<!--<meta name="viewport" content="initial-scale=1.0, width=device-width" />-->
	<!--SCREENWIDTH / 1000 0.768-->
	<meta name="viewport" content="width=device-width" />
	<title>Intranet Acceso</title>
	<meta http-equiv="content-type" content="text/html;" charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon"  href="themes/images/logo.jpg">
	<link rel="stylesheet" type="text/css" href="themes/login.css">

	<!-- PARA EXPLORER -->
	<script src=<?php echo funciones::url('/themes/jquery/admin/acordion/jquery.js');?>></script>
	<script src=<?php echo funciones::url('/themes/jquery/admin/Msgbox/msgbox/Scripts/jquery.msgBox.js');?>></script>
	<link href=<?php echo funciones::url('/themes/jquery/admin/Msgbox/msgbox/Styles/msgBoxLight.css');?> rel="stylesheet"/>
	<script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/login.js");?>></script>	
</head>
<body>
	<?php
		echo "<article>";
		include('./view/'.VIEW_FILE);
		echo "</article>";
	?>
</body>
</html>

