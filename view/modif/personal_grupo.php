<?php
    echo "<section class='ayuda'>";
    echo    "<section class='arriba'>
                    <section class='opt1'>
                        <form method='post'>
                        <table class='tabla'><tr><td class='td'>Funcion</td></tr></table>
                        <input type='text' placeholder='Ingrese funcion' name='dato'>
                    </section>
                    <section class='opt3'>
                        <input type='submit' class='boton' value='Buscar' name='buscar'/>
                        </form>
                    </section>                        
            </section>";
	$grupo=$_REQUEST["gr"];

	if($_POST)
	{
		if($_POST['dato'] != NULL)
		{
			$query2 = "SELECT PERCOD,CONCAT_WS(' ', CONCAT_WS(', ',PERNOM,PERAPP),PERAPM) FROM tpers WHERE (concat_ws(' ',PERNOM,PERAPP) LIKE '%' '".$_POST['dato']."' '%') or  (PERNOM LIKE '%' '".$_POST['dato']."' '%') group by tpers.percod ";
			$consul=funciones::listadoReturn($c,$query2);

			if(mysql_num_rows($consul)==0){
				echo "<script>alert('No existe el cliente. Intentelo Nuevamente .... ')</script>";
			}
			else
			{
				echo "<section class='medio'><fieldset><section class='tabla'";
                echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
				echo "<th>Codigo</th><th>Nombres y Apellidos</th><th>Agregar</th><th>Eliminar</th>";
				while ($reg = mysql_fetch_array($consul)) {
					$codigo=$reg[0];
					$codigo=str_replace(" ", "&nbsp;", $codigo);
					echo "<tr>";
						echo "<td>$reg[0]</td>";
						echo "<td>$reg[1]</td>";
						echo "<td><input type='radio' name='denegar$reg[0]' OnClick=add_usuario('$reg[0]','$grupo') value='$reg[0]'></td>";
		   				echo "<td><input type='radio' name='denegar$reg[0]'  OnClick=del_usuario('$reg[0]','$grupo') value='$reg[0]'></td>";
					echo "</tr>";
				}
				  echo "</table></form></section></fieldset></section>";
				  echo "<section class='abajo'>
		            		<input type='button' name='boton' class='btmod_salir' value='Salir'/> 
			            	<input type='button' name='boton' class='btmod_guardar' value='Guardar'/>                
			            </section>";
			}
		}
		else
		{
			header("location:personal_grupo?gr=$grupo");
		}
	}
	else
	{

		$query2 = " SELECT PERCOD,CONCAT_WS(' ', CONCAT_WS(', ',PERNOM,PERAPP),PERAPM) FROM TPERS WHERE PERFCS IS NULL AND PEREST<>'A' ";
		$val2=funciones::listadoReturn($c,$query2);
	    echo "<section class='medio'><fieldset><section class='tabla'";
	    echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
		echo "<th>Codigo</th><th>Nombres y Apellidos</th><th>Agregar</th><th>Eliminar</th>";
		while ($reg = mysql_fetch_array($val2)) {
			$codigo=$reg[0];
			$codigo=str_replace(" ", "&nbsp;", $codigo);
			echo "<tr>";
				echo "<td>$reg[0]</td>";
				echo "<td>$reg[1]</td>";
				echo "<td><input type='radio' name='denegar$reg[0]' OnClick=add_usuario('$reg[0]','$grupo') value='$reg[0]'></td>";
   				echo "<td><input type='radio' name='denegar$reg[0]' OnClick=del_usuario('$reg[0]','$grupo') value='$reg[0]'></td>";
			echo "</tr>";
		}
		echo "</table></form></section></fieldset></section>";

		echo "<section class='abajo'>
            	<input type='button' name='boton' class='btmod_salir' value='Salir'/> 
            	<input type='button' name='boton' class='btmod_guardar' value='Guardar'/>               
            </section>";
	}
	echo "</section>";
?>