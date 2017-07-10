<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
	<meta name="viewport" content="width=device-width" />
	<title>Intranet Usuario</title>
	<meta http-equiv="content-type" content="text/html;" charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<link href=<?php echo funciones::url('/themes/admin/modificar.css');?> type="text/css"  rel="stylesheet">
	<link rel="shortcut icon"  href=<?php echo funciones::url('/themes/images/logo.jpg');?>>

	<script src="../themes/jquery/tabs/jquery-1.11.0.min.js" type="text/javascript"></script>	

	<!-- PARA EXPLORER -->
	<script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/compatibilidad/modernizr-latest.js")?>></script>
	<script type="text/javascript" src=<?php echo funciones::url("/themes/jquery/compatibilidad/placeholders.min.js"); ?>></script>
	<script src="themes/jquery/compatibilidad/modernizr.custom.js" type="text/javascript"></script>
	
	<script src=<?php echo funciones::url('/themes/jquery/admin/funciones_ajax.js');?> ></script>

	<script type="text/javascript">
		$(function(){
		    $("#files2").on('change',function(){
		        $('#imagen').html('');
		        var archivos = document.getElementById('files2').files;
		        var navegador = window.URL || window.webkitURL;

		        for(x=0; x<archivos.length ; x++) 
		        {
		            var size = archivos[x].size;
		            var type = archivos[x].type;
		            var name= archivos[x].name;
		            
		            if(type!= 'image/jpg' && type!= 'image/png' && type!= 'image/jpeg' && type!= 'image/JPG' && type!= 'image/JPEG'  && type!= 'image/gif')
		            {
		                $('#imagen').append("<p style='color:red'>El tipo "+type+" no es permitido</p>");
		            }
		            else
		            {
		                var objeto_url = navegador.createObjectURL(archivos[x]);
		                $("#imagen").append("<img src="+objeto_url+">");
		            }
		        }
		    });
		});
	</script>
</head>
<body>
	<?php
		include('./view/'.VIEW_FILE);
	?>
</body>
</html>