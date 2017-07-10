<?php
	$codigo = $_REQUEST['cod'];
	$nombre = $_REQUEST['nom'];
	echo "<section class='actividad'>";
	$query = "select * from fotoact where codact=$codigo";
	$consul=funciones::listadoReturn($c,$query);
	echo "<section class='title'>Listado de Imagenes Actividades</section>";
	echo "<form method='post' enctype='multipart/form-data'>";
		

	echo "<section class='table'>";
		echo "<table cellpadding='0' cellspacing='0'>";
		while ($reg = mysql_fetch_array($consul)) {
			echo "<tr>";
				echo "<td><img src='../themes/images/Actividades/$codigo/$reg[1]'></br>
							<input type='checkbox' name='eliminar[]' value='$reg[1]'></td>";
			echo "</tr>";
		}
		echo "</table>";
	echo "</section>";


	echo "<section id='list2'>
			<table>
				<section id='imagen'></section>
				<input type='submit' name='boton' value='Eliminar'>
				<input type='submit' value='Guardar' name='boton'>
				<input type='file'  id='files2' name='files2[]' multiple>
			</table>
			</form>
		</section>";
	
	echo "<section class='opcion'>";
	echo "</section>";
	echo "</section>";


	if($_POST)
	{
		if($_POST['boton'] == "Eliminar" )
	   	{
	   		if(isset($_POST['eliminar']))
	  		{	
	  			$directorio = RUTA.'/themes/images/Actividades/'.$codigo."/";
	  			foreach ($_POST['eliminar'] as $key ) {
	  				unlink($directorio.$key); 
		   			$cadena =  "DELETE FROM fotoact WHERE foto='$key' AND codact='$codigo' ";
					funciones::listadoReturn($c,$cadena);
					echo $cadena;
		   		}
	  		}
	  		echo "<script>window.close()</script>";	   		
	   	}
	   	else if($_POST['boton'] == "Guardar")
	   	{
	   		$directorio = RUTA.'/themes/images/Actividades/';
	   		$imagenes=funciones::subirextraimagen($directorio,'files2',$codigo);
	   		foreach ($imagenes as $codfot => $imagen) {
				$datos2 = array(
					'codact' => $codigo,
					'foto' => $imagen,
					'title' => $nombre
				);
				Actividad::insertardetalle($datos2);
			}

			echo "<script>window.close()</script>";	
	   	}
	}
?>