<?php
	$coduser = $_REQUEST['cod'];
	echo "<section class='personal'>";
	
		echo "<section class='search'>";
		   echo "<form method='post'>";
		       echo "<tr>";
			   	  echo "<td>";
					  echo "<select name='tipo' class='bus_per'>";
							$cadena2 = " SELECT * FROM PROGRAMA ";
							$resultado2=funciones::listadoReturn($c,$cadena2);
							while($fil2 = mysql_fetch_array($resultado2))
							{
								echo "<option value='".$fil2[0].'-'.$coduser."'/>".$fil2[1];
							}
					  echo "</select>";
				   echo "</td>";
			   echo "</tr>";
		   echo "</form>";
	  	echo "</section>";

		echo "<section style='background:white; width:95%; height:82%; margin:0px auto'>";
		echo "<section class='permisos_list' style='width:100%; height:90%;'></section>";
		echo "<section style='width:100%; height:10%;'>
				<input type='button' value='Salir' class='cerrar_permiso'>
			  </section>";
		echo "<section>";
	echo "</section>";
?>