<?php
	$alerta=$_REQUEST["gr"];
    echo "<section class='ayuda'>";
    echo    "<section class='arriba'>
                    <section class='opt1'>
                        <form method='post'>
                        <table class='tabla'><tr><td class='td'>Agregar Correo</td></tr></table>
                        <input type='text' placeholder='Ingrese Correo' name='dato'>
                    </section>
                    <section class='opt3'>
                        <input type='submit' OnClick=ver_correo_lista() class='boton' value='Agregar' name='boton'/>
                        </form>
                    </section>                        
            </section>";
	if($_POST)
	{
		if($_POST["boton"]=="Agregar")
		{
			$valor=$_POST["dato"];
			if($valor!= ""){
				$consul="SELECT TALSEQ+1 FROM TALD WHERE TACODF='$alerta' ORDER BY TALSEQ DESC LIMIT 1 ";
				$query1=funciones::listadoReturn($c,$consul);
				if(mysql_num_rows($query1)>0){
					$seq=mysql_result($query1, 0,0);
				}else{
					$seq=1;
				}
				$consul2="INSERT INTO TALD VALUES('$alerta','$seq','$valor')";
				$query2=funciones::listadoReturn($c,$consul2);
				$valor=null;
			}
		}
		$query3 = " SELECT TALSEQ, TALCOR FROM TALD WHERE TACODF='$alerta' ";
	}
	else
	{
		$query3 = " SELECT TALSEQ, TALCOR FROM TALD WHERE TACODF='$alerta'";
	}

	$val2=funciones::listadoReturn($c,$query3);
    echo "<section class='medio'><fieldset><section class='tabla'";
    echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
	echo "<th>Secuencia</th><th>Correo</th><th>Eliminar</th>";
	while ($reg = mysql_fetch_array($val2)) {
		$codigo=str_replace(" ", "&nbsp;", $reg[0]);
		echo "<tr>";
			echo "<td>$reg[0]</td>";
			echo "<td>$reg[1]</td>";
			echo "<td><input type='radio' name='boton' value='delete' OnClick=del_correo('$alerta','$reg[0]')></td>";
		echo "</tr>";
	}
	echo "</table></form></section></fieldset></section>";

	echo "<section class='abajo'>
        	<input type='button' name='boton' class='btmod_salir' value='Salir'/> 
        	<input type='button' name='boton' class='btmod_guardar' value='Guardar'/>               
        </section>";

	echo "</section>";

?>